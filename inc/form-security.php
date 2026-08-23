<?php
/**
 * Securite et gestion des formulaires
 * Domaine Saint Joseph
 * - Honeypot anti-spam
 * - Validation renforcee
 * - Rate limiting (adapte au contexte Burkina Faso)
 * - Enregistrement des messages
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ========================================
// CPT PRIVE : MESSAGES RECUS
// ========================================
function dsj_register_messages_cpt() {
    register_post_type( 'dsj_message', [
        'labels' => [
            'name'          => 'Messages recus',
            'singular_name' => 'Message',
            'add_new'       => 'Nouveau message',
            'add_new_item'  => 'Nouveau message',
            'edit_item'     => 'Voir le message',
            'view_item'     => 'Voir le message',
            'all_items'     => 'Tous les messages',
            'search_items'  => 'Rechercher un message',
            'menu_name'     => '&#128233; Messages recus',
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => 'dsj-gestion-site',
        'menu_icon'           => 'dashicons-email-alt',
        'menu_position'       => 3,
        'capability_type'     => 'post',
        'capabilities'        => [
            'create_posts' => 'do_not_allow',
        ],
        'map_meta_cap'        => true,
        'supports'            => [ 'title', 'editor', 'custom-fields' ],
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'has_archive'         => false,
    ]);
}
add_action( 'init', 'dsj_register_messages_cpt' );

// ========================================
// COLONNES PERSONNALISEES ADMIN
// ========================================
function dsj_messages_columns( $columns ) {
    $new_columns = [];
    $new_columns['cb']        = $columns['cb'];
    $new_columns['type']      = 'Type';
    $new_columns['title']     = $columns['title'];
    $new_columns['contact']   = 'Contact';
    $new_columns['date']      = $columns['date'];
    $new_columns['status']    = 'Statut';
    return $new_columns;
}
add_filter( 'manage_dsj_message_posts_columns', 'dsj_messages_columns' );

function dsj_messages_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'type':
            $type = get_post_meta( $post_id, '_dsj_msg_type', true );
            $icons = [
                'contact'     => '&#128233;',
                'reservation' => '&#127968;',
                'restaurant'  => '&#127869;',
            ];
            echo isset( $icons[ $type ] ) ? $icons[ $type ] : '&#128172;';
            break;
        case 'contact':
            $contact = get_post_meta( $post_id, '_dsj_msg_contact', true );
            echo esc_html( $contact );
            break;
        case 'status':
            $read = get_post_meta( $post_id, '_dsj_msg_read', true );
            if ( $read ) {
                echo '<span style="color: #28a745;">&#9989; Lu</span>';
            } else {
                echo '<span style="color: #dc3545; font-weight: 700;">&#128308; Nouveau</span>';
            }
            break;
    }
}
add_action( 'manage_dsj_message_posts_custom_column', 'dsj_messages_column_content', 10, 2 );

// ========================================
// 🔒 PHASE 7.2 : DÉTECTION IP RÉELLE (CDN, proxy, NAT)
// ========================================
// Au Burkina Faso, beaucoup d'utilisateurs partagent la même IP publique
// via NAT opérateur. Si le site est derrière Cloudflare ou un proxy,
// il faut lire la vraie IP du visiteur, pas celle du proxy.

function dsj_get_real_ip() {
    // Cloudflare (priorité max si le site est derrière CF)
    if ( ! empty( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
        return sanitize_text_field( $_SERVER['HTTP_CF_CONNECTING_IP'] );
    }
    
    // Proxy générique (AWS, Nginx, Apache derrière proxy)
    if ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $ips = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
        $ip = trim( $ips[0] );
        if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
            return $ip;
        }
    }
    
    // Autre proxy
    if ( ! empty( $_SERVER['HTTP_X_REAL_IP'] ) ) {
        return sanitize_text_field( $_SERVER['HTTP_X_REAL_IP'] );
    }
    
    // IP directe (fallback)
    return sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? 'unknown' );
}

// ========================================
// FONCTIONS HELPER SECURITE
// ========================================

/**
 * Verifie le honeypot (champ piege pour les bots)
 */
function dsj_check_honeypot( $field_name = 'dsj_hp_field' ) {
    if ( ! empty( $_POST[ $field_name ] ) ) {
        $ip = dsj_get_real_ip();
        error_log( 'DSJ: Bot detecte via honeypot depuis ' . $ip );
        return false;
    }
    return true;
}

/**
 * Verifie le rate limiting
 * 
 * 🔒 PHASE 7.2 : Seuil augmenté de 5 à 15/heure
 * Au Burkina Faso, le NAT opérateur fait que plusieurs utilisateurs
 * partagent la même IP publique. Un seuil de 5 bloquerait trop de vrais visiteurs.
 */
function dsj_check_rate_limit( $form_type = 'contact' ) {
    $ip = dsj_get_real_ip();
    $key = 'dsj_rate_' . $form_type . '_' . md5( $ip );
    $count = (int) get_transient( $key );
    
    // Seuil : 15 envois par heure (adapté au contexte africain)
    if ( $count >= 15 ) {
        error_log( 'DSJ: Rate limit atteint pour IP ' . $ip . ' (' . $count . ' envois/heure)' );
        return false;
    }
    
    set_transient( $key, $count + 1, HOUR_IN_SECONDS );
    return true;
}

/**
 * Valide email ou telephone
 */
function dsj_validate_contact( $contact ) {
    $contact = sanitize_text_field( $contact );
    
    if ( filter_var( $contact, FILTER_VALIDATE_EMAIL ) ) {
        return $contact;
    }
    
    $phone = preg_replace( '/[^0-9+]/', '', $contact );
    if ( strlen( $phone ) >= 8 && strlen( $phone ) <= 15 ) {
        return $contact;
    }
    
    return false;
}

/**
 * 🔒 PHASE 7.2 : Trouver dynamiquement un administrateur
 * Ne pas dépendre de l'ID=1 (bonne pratique sécurité WordPress)
 */
function dsj_get_admin_author_id() {
    $admin = get_users( [
        'role'     => 'administrator',
        'number'   => 1,
        'orderby'  => 'ID',
        'order'    => 'ASC',
        'fields'   => 'ID',
    ] );
    
    return ! empty( $admin ) ? (int) $admin[0] : 1;
}

/**
 * Enregistre un message dans le CPT
 */
function dsj_save_message( $type, $data ) {
    $title = sprintf( '[%s] %s - %s', 
        strtoupper( $type ), 
        $data['sujet'] ?? $type,
        $data['nom'] ?? 'Anonyme'
    );
    
    // 🔒 PHASE 7.2 : post_author dynamique
    $author_id = dsj_get_admin_author_id();
    
    $post_id = wp_insert_post([
        'post_type'   => 'dsj_message',
        'post_title'  => $title,
        'post_content'=> $data['message'] ?? '',
        'post_status' => 'publish',
        'post_author' => $author_id,
    ]);
    
    if ( $post_id && ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, '_dsj_msg_type', $type );
        update_post_meta( $post_id, '_dsj_msg_nom', $data['nom'] ?? '' );
        update_post_meta( $post_id, '_dsj_msg_contact', $data['contact'] ?? '' );
        update_post_meta( $post_id, '_dsj_msg_sujet', $data['sujet'] ?? '' );
        update_post_meta( $post_id, '_dsj_msg_ip', dsj_get_real_ip() );
        update_post_meta( $post_id, '_dsj_msg_read', 0 );
        
        foreach ( $data as $key => $value ) {
            if ( ! in_array( $key, [ 'nom', 'contact', 'sujet', 'message' ] ) ) {
                update_post_meta( $post_id, '_dsj_msg_' . $key, sanitize_text_field( $value ) );
            }
        }
        
        return $post_id;
    }
    
    return false;
}

// ========================================
// METABOX DETAILS DU MESSAGE
// ========================================
function dsj_add_message_metabox() {
    add_meta_box(
        'dsj_message_details',
        '&#128233; Details du message',
        'dsj_message_details_callback',
        'dsj_message',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'dsj_add_message_metabox' );

function dsj_message_details_callback( $post ) {
    update_post_meta( $post->ID, '_dsj_msg_read', 1 );
    
    $type    = get_post_meta( $post->ID, '_dsj_msg_type', true );
    $nom     = get_post_meta( $post->ID, '_dsj_msg_nom', true );
    $contact = get_post_meta( $post->ID, '_dsj_msg_contact', true );
    $sujet   = get_post_meta( $post->ID, '_dsj_msg_sujet', true );
    $ip      = get_post_meta( $post->ID, '_dsj_msg_ip', true );
    
    $arrivee   = get_post_meta( $post->ID, '_dsj_msg_arrivee', true );
    $depart    = get_post_meta( $post->ID, '_dsj_msg_depart', true );
    $chambre   = get_post_meta( $post->ID, '_dsj_msg_type_chambre', true );
    $date      = get_post_meta( $post->ID, '_dsj_msg_date', true );
    $heure     = get_post_meta( $post->ID, '_dsj_msg_heure', true );
    $personnes = get_post_meta( $post->ID, '_dsj_msg_personnes', true );
    $occasion  = get_post_meta( $post->ID, '_dsj_msg_occasion', true );
    ?>
    <style>
        .dsj-msg-info { 
            background: #f8f9fa; 
            padding: 15px; 
            border-radius: 8px; 
            margin-bottom: 15px;
            border-left: 4px solid #1A5276;
        }
        .dsj-msg-info p { margin: 8px 0; }
        .dsj-msg-info strong { 
            color: #1A5276; 
            display: inline-block; 
            min-width: 130px;
        }
        .dsj-msg-actions { 
            display: flex; 
            gap: 10px; 
            flex-wrap: wrap; 
            margin-top: 15px;
        }
        .dsj-msg-actions a { 
            display: inline-flex; 
            align-items: center; 
            gap: 6px;
            padding: 8px 16px; 
            background: #25D366; 
            color: white; 
            text-decoration: none; 
            border-radius: 50px;
            font-weight: 600;
        }
        .dsj-msg-actions a.email-btn { 
            background: #1A5276; 
        }
        .dsj-msg-actions a:hover { 
            opacity: 0.9; 
            transform: translateY(-2px);
        }
    </style>
    
    <div class="dsj-msg-info">
        <p><strong>&#128100; Nom :</strong> <?php echo esc_html( $nom ); ?></p>
        <p><strong>&#128231; Contact :</strong> <?php echo esc_html( $contact ); ?></p>
        <p><strong>&#128196; Sujet :</strong> <?php echo esc_html( $sujet ?: $type ); ?></p>
        <p><strong>&#127760; IP :</strong> <code><?php echo esc_html( $ip ); ?></code></p>
        
        <?php if ( $type === 'reservation' ) : ?>
            <hr>
            <p><strong>&#128197; Arrivee :</strong> <?php echo esc_html( $arrivee ); ?></p>
            <p><strong>&#128197; Depart :</strong> <?php echo esc_html( $depart ); ?></p>
            <p><strong>&#127968; Chambre :</strong> <?php echo esc_html( $chambre ); ?></p>
        <?php endif; ?>
        
        <?php if ( $type === 'restaurant' ) : ?>
            <hr>
            <p><strong>&#128197; Date :</strong> <?php echo esc_html( $date ); ?></p>
            <p><strong>&#9200; Heure :</strong> <?php echo esc_html( $heure ); ?></p>
            <p><strong>&#128101; Personnes :</strong> <?php echo esc_html( $personnes ); ?></p>
            <?php if ( $occasion ) : ?>
                <p><strong>&#127881; Occasion :</strong> <?php echo esc_html( $occasion ); ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <div class="dsj-msg-actions">
        <?php if ( strpos( $contact, '@' ) !== false ) : ?>
            <a href="mailto:<?php echo esc_attr( $contact ); ?>?subject=Re: <?php echo urlencode( $sujet ); ?>" class="email-btn">
                &#128231; Repondre par email
            </a>
        <?php else : ?>
            <a href="https://wa.me/<?php echo preg_replace( '/[^0-9]/', '', $contact ); ?>" target="_blank">
                &#128172; Repondre sur WhatsApp
            </a>
        <?php endif; ?>
    </div>
    <?php
}

// ========================================
// BADGE "NON LU" DANS LA LISTE ADMIN
// ========================================
function dsj_messages_admin_styles() {
    global $post_type;
    if ( 'dsj_message' !== $post_type ) return;
    ?>
    <style>
        .post-type-dsj_message tr:not(.status-publish) {
            background: #fff3cd !important;
        }
        .post-type-dsj_message .column-status span {
            font-size: 0.9rem;
        }
    </style>
    <?php
}
add_action( 'admin_head', 'dsj_messages_admin_styles' );

// ========================================
// WIDGET DASHBOARD : MESSAGES RECENTS
// ========================================
function dsj_dashboard_messages_widget() {
    $messages = new WP_Query([
        'post_type'      => 'dsj_message',
        'posts_per_page' => 5,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);
    
    $unread = new WP_Query([
        'post_type'   => 'dsj_message',
        'post_status' => 'publish',
        'meta_query'  => [
            [
                'key'   => '_dsj_msg_read',
                'value' => '0',
            ],
        ],
    ]);
    
    echo '<div style="padding: 10px 0;">';
    echo '<p><strong>&#128233; ' . $messages->found_posts . ' message(s) recu(s)</strong>';
    if ( $unread->found_posts > 0 ) {
        echo ' <span style="background: #dc3545; color: white; padding: 2px 8px; border-radius: 50px; font-size: 0.85rem;">' . $unread->found_posts . ' nouveau(x)</span>';
    }
    echo '</p>';
    
    if ( $messages->have_posts() ) {
        echo '<ul style="margin: 10px 0;">';
        while ( $messages->have_posts() ) {
            $messages->the_post();
            $read = get_post_meta( get_the_ID(), '_dsj_msg_read', true );
            $style = $read ? '' : 'font-weight: 700;';
            echo '<li style="' . $style . '">';
            echo '<a href="' . get_edit_post_link() . '">' . get_the_title() . '</a>';
            echo ' <small style="color: #666;">- ' . get_the_date() . '</small>';
            echo '</li>';
        }
        echo '</ul>';
        wp_reset_postdata();
    } else {
        echo '<p style="color: #666;">Aucun message pour le moment.</p>';
    }
    
    echo '<p style="margin-top: 15px;">';
    echo '<a href="' . esc_url( admin_url( 'edit.php?post_type=dsj_message' ) ) . '" class="button button-primary" style="background: #1A5276; border-color: #1A5276;">';
    echo 'Voir tous les messages';
    echo '</a>';
    echo '</p>';
    echo '</div>';
}

function dsj_add_messages_widget() {
    wp_add_dashboard_widget(
        'dsj_messages_widget',
        '&#128233; Messages recus recemment',
        'dsj_dashboard_messages_widget'
    );
}
add_action( 'wp_dashboard_setup', 'dsj_add_messages_widget' );