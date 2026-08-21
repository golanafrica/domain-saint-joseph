<?php
/**
 * Functions du thème Domaine Saint Joseph
 * Version production - Phase 1 terminée
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ════════════════════════════════════════════════════════════════
// CHARGEMENT CONDITIONNEL DES MODULES
// ════════════════════════════════════════════════════════════════
$inc = get_template_directory() . '/inc';
if ( file_exists( $inc . '/cpt.php' ) ) require_once $inc . '/cpt.php';
if ( file_exists( $inc . '/customizer.php' ) ) require_once $inc . '/customizer.php';
if ( file_exists( $inc . '/metaboxes.php' ) ) require_once $inc . '/metaboxes.php';
if ( file_exists( $inc . '/widgets.php' ) ) require_once $inc . '/widgets.php';
if ( file_exists( $inc . '/admin-dashboard.php' ) ) require_once $inc . '/admin-dashboard.php';
if ( file_exists( $inc . '/form-security.php' ) ) require_once $inc . '/form-security.php';

// ════════════════════════════════════════════════════════════════
// CONFIGURATION DE BASE DU THÈME
// ════════════════════════════════════════════════════════════════
function dsj_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    add_theme_support( 'custom-logo', [
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    add_theme_support( 'widgets' );
    
    register_nav_menus([
        'primary' => __( 'Menu Principal', 'domaine-saint-joseph' ),
        'footer'  => __( 'Menu Footer', 'domaine-saint-joseph' ),
    ]);
    
    add_image_size( 'hero-size', 1920, 600, true );
    add_image_size( 'card-thumb', 400, 300, true );
    add_image_size( 'gallery-thumb', 300, 300, true );
}
add_action( 'after_setup_theme', 'dsj_setup' );

// ════════════════════════════════════════════════════════════════
// ENREGISTREMENT DES ZONES DE WIDGETS
// ════════════════════════════════════════════════════════════════
function dsj_widgets_init() {
    register_sidebar( [
        'name'          => __( 'Zone Hero - Bandeau principal', 'domaine-saint-joseph' ),
        'id'            => 'hero-area',
        'description'   => __( 'Widget pour le bandeau de la page d\'accueil', 'domaine-saint-joseph' ),
        'before_widget' => '<div class="hero-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h1 class="hero-title">',
        'after_title'   => '</h1>',
    ] );
    
    register_sidebar( [
        'name'          => __( 'Pied de page - Colonne 1', 'domaine-saint-joseph' ),
        'id'            => 'footer-col-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ] );
    
    register_sidebar( [
        'name'          => __( 'Pied de page - Colonne 2', 'domaine-saint-joseph' ),
        'id'            => 'footer-col-2',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ] );
    
    register_sidebar( [
        'name'          => __( 'Pied de page - Colonne 3', 'domaine-saint-joseph' ),
        'id'            => 'footer-col-3',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ] );
}
add_action( 'widgets_init', 'dsj_widgets_init' );

// ════════════════════════════════════════════════════════════════
// CHARGEMENT DES ASSETS AVEC CACHE-BUSTING (filemtime)
// ════════════════════════════════════════════════════════════════
function dsj_assets() {
    $style_file  = get_template_directory() . '/assets/css/main.css';
    $script_file = get_template_directory() . '/assets/js/main.js';
    
    $style_version  = file_exists( $style_file ) ? filemtime( $style_file ) : '1.0';
    $script_version = file_exists( $script_file ) ? filemtime( $script_file ) : '1.0';
    
    wp_enqueue_style( 'dsj-main', get_template_directory_uri() . '/assets/css/main.css', [], $style_version );
    wp_enqueue_script( 'dsj-main', get_template_directory_uri() . '/assets/js/main.js', [], $script_version, true );
    
    // Couleurs personnalisées dynamiques
    $primary_color = get_theme_mod( 'primary_color', '#1A5276' );
    $accent_color = get_theme_mod( 'accent_color', '#D4AC0D' );
    $custom_css = "
        :root {
            --clr-primary: {$primary_color};
            --clr-accent: {$accent_color};
        }
        .site-header, .site-footer, .hero-section, .page-header, .cta-final, .stats-section {
            background-color: var(--clr-primary);
        }
        .btn-primary, button:not(.menu-toggle):not(.filter-btn), input[type='submit'] {
            background-color: var(--clr-accent);
            color: var(--clr-primary);
        }
        .btn-primary:hover {
            background-color: var(--clr-primary);
            color: white;
        }
        .stat-number, .section-title h2, .valeur-card h3 {
            color: var(--clr-primary);
        }
        .btn-link, a:not(.btn):hover {
            color: var(--clr-accent);
        }
    ";
    wp_add_inline_style( 'dsj-main', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'dsj_assets' );

// ════════════════════════════════════════════════════════════════
// OPTIMISATIONS DE PERFORMANCE
// ════════════════════════════════════════════════════════════════
function dsj_performance() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}
add_action( 'init', 'dsj_performance' );

// Force lazy loading sur les images
add_filter( 'wp_get_attachment_image_attributes', function( $attr ) {
    if ( ! isset( $attr['loading'] ) ) {
        $attr['loading'] = 'lazy';
    }
    $attr['decoding'] = 'async';
    return $attr;
});

// ════════════════════════════════════════════════════════════════
// CONFIGURATION SMTP (via Customizer)
// ════════════════════════════════════════════════════════════════
function dsj_configure_smtp( $phpmailer ) {
    $host = get_theme_mod( 'smtp_host', '' );
    
    if ( empty( $host ) ) {
        return;
    }
    
    $phpmailer->isSMTP();
    $phpmailer->Host       = $host;
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = get_theme_mod( 'smtp_port', 587 );
    $phpmailer->Username   = get_theme_mod( 'smtp_user', '' );
    $phpmailer->Password   = get_theme_mod( 'smtp_pass', '' );
    $phpmailer->SMTPSecure = get_theme_mod( 'smtp_encryption', 'tls' );
    
    $from_email = get_theme_mod( 'smtp_from_email', get_theme_mod( 'dsj_email', 'centredsj@gmail.com' ) );
    $from_name  = get_theme_mod( 'smtp_from_name', 'Domaine Saint Joseph' );
    $phpmailer->setFrom( $from_email, $from_name );
}
add_action( 'phpmailer_init', 'dsj_configure_smtp' );

// ════════════════════════════════════════════════════════════════
// FONCTIONS HELPER - CONTACT ET WHATSAPP
// ════════════════════════════════════════════════════════════════

function dsj_get_whatsapp() {
    return get_theme_mod( 'whatsapp', '22666605890' );
}

function dsj_get_phone() {
    return get_theme_mod( 'dsj_phone', '(+226) 20 97 28 97' );
}

function dsj_get_email() {
    return get_theme_mod( 'dsj_email', 'centredsj@gmail.com' );
}

// ════════════════════════════════════════════════════════════════
// HANDLER FORMULAIRE DE CONTACT
// ════════════════════════════════════════════════════════════════

function dsj_handle_contact_form() {
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'dsj_contact_nonce' ) ) {
        wp_die( 'Erreur de sécurité', 'Domaine Saint Joseph', [ 'response' => 403 ] );
    }
    
    if ( function_exists( 'dsj_check_honeypot' ) && ! dsj_check_honeypot() ) {
        wp_safe_redirect( home_url( '/contact?success=1' ) );
        exit;
    }
    
    if ( function_exists( 'dsj_check_rate_limit' ) && ! dsj_check_rate_limit( 'contact' ) ) {
        wp_safe_redirect( home_url( '/contact?error=rate_limit' ) );
        exit;
    }
    
    $nom     = sanitize_text_field( $_POST['cf_nom'] ?? '' );
    $contact = sanitize_text_field( $_POST['cf_contact'] ?? '' );
    $sujet   = sanitize_text_field( $_POST['cf_sujet'] ?? 'general' );
    $message = sanitize_textarea_field( $_POST['cf_message'] ?? '' );
    
    if ( empty( $nom ) || empty( $contact ) || empty( $message ) ) {
        wp_safe_redirect( home_url( '/contact?error=missing' ) );
        exit;
    }
    
    if ( function_exists( 'dsj_validate_contact' ) && ! dsj_validate_contact( $contact ) ) {
        wp_safe_redirect( home_url( '/contact?error=invalid_contact' ) );
        exit;
    }
    
    if ( function_exists( 'dsj_save_message' ) ) {
        dsj_save_message( 'contact', [
            'nom'     => $nom,
            'contact' => $contact,
            'sujet'   => $sujet,
            'message' => $message,
        ]);
    }
    
    $to      = dsj_get_email();
    $subject = sprintf( '[DSJ] %s - %s', ucfirst( $sujet ), $nom );
    $body    = "Nouveau message :\n\nNom: $nom\nContact: $contact\nSujet: $sujet\nMessage:\n$message\n---\nEnvoyé depuis: " . home_url();
    $headers = [ 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $contact ];
    
    $sent = wp_mail( $to, $subject, $body, $headers );
    
    wp_safe_redirect( home_url( $sent ? '/contact?success=1' : '/contact?error=send' ) );
    exit;
}
add_action( 'admin_post_dsj_contact_form', 'dsj_handle_contact_form' );
add_action( 'admin_post_nopriv_dsj_contact_form', 'dsj_handle_contact_form' );

// ════════════════════════════════════════════════════════════════
// HANDLER FORMULAIRE DE RÉSERVATION HÉBERGEMENT
// ════════════════════════════════════════════════════════════════

function dsj_handle_reservation_form() {
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'dsj_reservation_nonce' ) ) {
        wp_die( 'Erreur de sécurité', 'Domaine Saint Joseph', [ 'response' => 403 ] );
    }
    
    if ( function_exists( 'dsj_check_honeypot' ) && ! dsj_check_honeypot() ) {
        wp_safe_redirect( home_url( '/maison-accueil?success=1' ) );
        exit;
    }
    
    if ( function_exists( 'dsj_check_rate_limit' ) && ! dsj_check_rate_limit( 'reservation' ) ) {
        wp_safe_redirect( home_url( '/maison-accueil?error=rate_limit' ) );
        exit;
    }
    
    $nom     = sanitize_text_field( $_POST['nom'] ?? '' );
    $contact = sanitize_text_field( $_POST['contact'] ?? '' );
    $arrivee = sanitize_text_field( $_POST['arrivee'] ?? '' );
    $depart  = sanitize_text_field( $_POST['depart'] ?? '' );
    $type    = sanitize_text_field( $_POST['type'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );
    
    if ( empty( $nom ) || empty( $contact ) || empty( $arrivee ) || empty( $depart ) ) {
        wp_safe_redirect( home_url( '/maison-accueil?error=missing' ) );
        exit;
    }
    
    if ( function_exists( 'dsj_validate_contact' ) && ! dsj_validate_contact( $contact ) ) {
        wp_safe_redirect( home_url( '/maison-accueil?error=invalid_contact' ) );
        exit;
    }
    
    if ( function_exists( 'dsj_save_message' ) ) {
        dsj_save_message( 'reservation', [
            'nom'            => $nom,
            'contact'        => $contact,
            'arrivee'        => $arrivee,
            'depart'         => $depart,
            'type_chambre'   => $type,
            'message'        => $message,
        ]);
    }
    
    $to      = dsj_get_email();
    $subject = '[DSJ] Réservation - ' . $nom;
    $body    = "Nouvelle réservation :\n\nNom: $nom\nContact: $contact\nArrivée: $arrivee\nDépart: $depart\nType: $type\nMessage: $message";
    $headers = [ 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $contact ];
    $sent = wp_mail( $to, $subject, $body, $headers );
    
    wp_safe_redirect( home_url( $sent ? '/maison-accueil?success=1' : '/maison-accueil?error=send' ) );
    exit;
}
add_action( 'admin_post_dsj_reservation_form', 'dsj_handle_reservation_form' );
add_action( 'admin_post_nopriv_dsj_reservation_form', 'dsj_handle_reservation_form' );

// ════════════════════════════════════════════════════════════════
// HANDLER FORMULAIRE DE RÉSERVATION RESTAURANT
// ════════════════════════════════════════════════════════════════

function dsj_handle_restaurant_reservation() {
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'dsj_restaurant_nonce' ) ) {
        wp_die( 'Erreur de sécurité', 'Domaine Saint Joseph', [ 'response' => 403 ] );
    }
    
    if ( function_exists( 'dsj_check_honeypot' ) && ! dsj_check_honeypot() ) {
        wp_safe_redirect( home_url( '/restaurant?resa_success=1' ) );
        exit;
    }
    
    if ( function_exists( 'dsj_check_rate_limit' ) && ! dsj_check_rate_limit( 'restaurant' ) ) {
        wp_safe_redirect( home_url( '/restaurant?resa_error=rate_limit' ) );
        exit;
    }
    
    $nom       = sanitize_text_field( $_POST['resa_nom'] ?? '' );
    $contact   = sanitize_text_field( $_POST['resa_contact'] ?? '' );
    $date      = sanitize_text_field( $_POST['resa_date'] ?? '' );
    $heure     = sanitize_text_field( $_POST['resa_heure'] ?? '' );
    $personnes = sanitize_text_field( $_POST['resa_personnes'] ?? '' );
    $occasion  = sanitize_text_field( $_POST['resa_occasion'] ?? '' );
    $message   = sanitize_textarea_field( $_POST['resa_message'] ?? '' );
    
    if ( empty( $nom ) || empty( $contact ) || empty( $date ) || empty( $heure ) ) {
        wp_safe_redirect( home_url( '/restaurant?resa_error=missing' ) );
        exit;
    }
    
    if ( function_exists( 'dsj_validate_contact' ) && ! dsj_validate_contact( $contact ) ) {
        wp_safe_redirect( home_url( '/restaurant?resa_error=invalid_contact' ) );
        exit;
    }
    
    if ( function_exists( 'dsj_save_message' ) ) {
        dsj_save_message( 'restaurant', [
            'nom'       => $nom,
            'contact'   => $contact,
            'date'      => $date,
            'heure'     => $heure,
            'personnes' => $personnes,
            'occasion'  => $occasion,
            'message'   => $message,
        ]);
    }
    
    $to      = dsj_get_email();
    $subject = '[DSJ] Réservation Restaurant - ' . $nom;
    $body    = "Nouvelle réservation restaurant :\n\nNom: $nom\nContact: $contact\nDate: $date\nHeure: $heure\nPersonnes: $personnes\nOccasion: $occasion\nMessage: $message\n---\nEnvoyé depuis: " . home_url();
    $headers = [ 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $contact ];
    $sent = wp_mail( $to, $subject, $body, $headers );
    
    wp_safe_redirect( home_url( $sent ? '/restaurant?resa_success=1' : '/restaurant?resa_error=send' ) );
    exit;
}
add_action( 'admin_post_dsj_restaurant_reservation', 'dsj_handle_restaurant_reservation' );
add_action( 'admin_post_nopriv_dsj_restaurant_reservation', 'dsj_handle_restaurant_reservation' );

// ════════════════════════════════════════════════════════════════
// RÔLES & PERMISSIONS - RÔLE SOEUR (avec toutes les capacités)
// ════════════════════════════════════════════════════════════════

function dsj_add_roles() {
    remove_role( 'soeur' );
    
    add_role( 'soeur', __( 'Sœur', 'domaine-saint-joseph' ), [
        // Capacités de base WordPress
        'read'                        => true,
        'edit_posts'                  => true,
        'edit_published_posts'        => true,
        'delete_posts'                => true,
        'delete_published_posts'      => true,
        'publish_posts'               => true,
        'upload_files'                => true,

        // Capacités CPT Formation
        'edit_formation'              => true,
        'edit_formations'             => true,
        'edit_others_formations'      => true,
        'edit_published_formation'    => true,
        'edit_published_formations'   => true,
        'delete_formation'            => true,
        'delete_formations'           => true,
        'delete_published_formation'  => true,
        'delete_published_formations' => true,
        'publish_formation'           => true,
        'publish_formations'          => true,
        'read_formation'              => true,

        // Capacités CPT Hébergement
        'edit_hebergement'              => true,
        'edit_hebergements'             => true,
        'edit_others_hebergements'      => true,
        'edit_published_hebergement'    => true,
        'edit_published_hebergements'   => true,
        'delete_hebergement'            => true,
        'delete_hebergements'           => true,
        'delete_published_hebergement'  => true,
        'delete_published_hebergements' => true,
        'publish_hebergement'           => true,
        'publish_hebergements'          => true,
        'read_hebergement'              => true,

        // Capacités CPT Menu (Restaurant)
        'edit_menu'              => true,
        'edit_menus'             => true,
        'edit_others_menus'      => true,
        'edit_published_menu'    => true,
        'edit_published_menus'   => true,
        'delete_menu'            => true,
        'delete_menus'           => true,
        'delete_published_menu'  => true,
        'delete_published_menus' => true,
        'publish_menu'           => true,
        'publish_menus'          => true,
        'read_menu'              => true,

        // Capacités CPT Galerie
        'edit_galerie'              => true,
        'edit_galeries'             => true,
        'edit_others_galeries'      => true,
        'edit_published_galerie'    => true,
        'edit_published_galeries'   => true,
        'delete_galerie'            => true,
        'delete_galeries'           => true,
        'delete_published_galerie'  => true,
        'delete_published_galeries' => true,
        'publish_galerie'           => true,
        'publish_galeries'          => true,
        'read_galerie'              => true,

        // Capacités CPT Témoignage
        'edit_temoignage'              => true,
        'edit_temoignages'             => true,
        'edit_others_temoignages'      => true,
        'edit_published_temoignage'    => true,
        'edit_published_temoignages'   => true,
        'delete_temoignage'            => true,
        'delete_temoignages'           => true,
        'delete_published_temoignage'  => true,
        'delete_published_temoignages' => true,
        'publish_temoignage'           => true,
        'publish_temoignages'          => true,
        'read_temoignage'              => true,

        // Capacités Taxonomies
        'manage_categories' => true,
    ] );
}
add_action( 'after_switch_theme', 'dsj_add_roles' );

// ════════════════════════════════════════════════════════════════
// FORCER LES TEMPLATES POUR LES CPT
// ════════════════════════════════════════════════════════════════

function dsj_force_hebergement_template( $template ) {
    if ( is_singular( 'hebergement' ) ) {
        $custom_template = get_template_directory() . '/single-hebergement.php';
        if ( file_exists( $custom_template ) ) {
            return $custom_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'dsj_force_hebergement_template', 99 );

// ════════════════════════════════════════════════════════════════
// ADMIN SCRIPTS (uploader widget)
// ════════════════════════════════════════════════════════════════

function dsj_admin_widget_scripts() {
    wp_enqueue_media();
    wp_enqueue_script(
        'dsj-widget-uploader',
        get_template_directory_uri() . '/assets/js/widget-uploader.js',
        array( 'jquery' ),
        '1.0',
        true
    );
}
add_action( 'admin_enqueue_scripts', 'dsj_admin_widget_scripts' );