<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// ── Chargement conditionnel des modules ──
$inc = get_template_directory() . '/inc';
if ( file_exists( $inc . '/cpt.php' ) ) require_once $inc . '/cpt.php';
if ( file_exists( $inc . '/customizer.php' ) ) require_once $inc . '/customizer.php';
if ( file_exists( $inc . '/metaboxes.php' ) ) require_once $inc . '/metaboxes.php';
if ( file_exists( $inc . '/widgets.php' ) ) require_once $inc . '/widgets.php';

// ── Configuration de base ──
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

// ── Enregistrement des zones de widgets ──
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

// ── Chargement des assets optimisés ──
function dsj_assets() {
    wp_enqueue_style( 'dsj-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.0' );
    wp_enqueue_script( 'dsj-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true );
    
    // Ajouter les couleurs personnalisées dynamiquement
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

// ── Optimisations 3G ──
function dsj_performance() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'wp_lazy_loading_enabled', '__return_false' );
}
add_action( 'init', 'dsj_performance' );

add_filter( 'wp_get_attachment_image_attributes', function( $attr ) {
    if ( ! isset( $attr['loading'] ) ) {
        $attr['loading'] = 'lazy';
    }
    $attr['decoding'] = 'async';
    return $attr;
});

// ========================================
// FONCTIONS HELPER - CONTACT ET WHATSAPP
// ========================================

// Récupérer le numéro WhatsApp
function dsj_get_whatsapp() {
    return get_theme_mod( 'whatsapp', '22666605890' );
}

// Récupérer le téléphone
function dsj_get_phone() {
    return get_theme_mod( 'dsj_phone', '(+226) 20 97 28 97' );
}

// Récupérer l'email
function dsj_get_email() {
    return get_theme_mod( 'dsj_email', 'centredsj@gmail.com' );
}

// ========================================
// HANDLERS DE FORMULAIRES
// ========================================

// Formulaire de contact
add_action( 'admin_post_dsj_contact_form', 'dsj_handle_contact_form' );
add_action( 'admin_post_nopriv_dsj_contact_form', 'dsj_handle_contact_form' );

function dsj_handle_contact_form() {
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'dsj_contact_nonce' ) ) {
        wp_die( 'Erreur de sécurité', 'Domaine Saint Joseph', [ 'response' => 403 ] );
    }
    $nom = sanitize_text_field( $_POST['cf_nom'] ?? '' );
    $contact = sanitize_text_field( $_POST['cf_contact'] ?? '' );
    $sujet = sanitize_text_field( $_POST['cf_sujet'] ?? 'general' );
    $message = sanitize_textarea_field( $_POST['cf_message'] ?? '' );
    
    if ( empty( $nom ) || empty( $contact ) || empty( $message ) ) {
        wp_safe_redirect( home_url( '/contact?error=missing' ) ); 
        exit;
    }
    
    $to = dsj_get_email();
    $subject = sprintf( '[DSJ] %s - %s', ucfirst( $sujet ), $nom );
    $body = "Nouveau message :\n\nNom: $nom\nContact: $contact\nSujet: $sujet\nMessage:\n$message\n---\nEnvoyé depuis: " . home_url();
    $headers = [ 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $contact ];
    $sent = wp_mail( $to, $subject, $body, $headers );
    
    wp_safe_redirect( home_url( $sent ? '/contact?success=1' : '/contact?error=send' ) );
    exit;
}

// Formulaire de réservation hébergement
add_action( 'admin_post_dsj_reservation_form', 'dsj_handle_reservation_form' );
add_action( 'admin_post_nopriv_dsj_reservation_form', 'dsj_handle_reservation_form' );

function dsj_handle_reservation_form() {
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'dsj_reservation_nonce' ) ) {
        wp_die( 'Erreur de sécurité', 'Domaine Saint Joseph', [ 'response' => 403 ] );
    }
    $nom = sanitize_text_field( $_POST['nom'] ?? '' );
    $contact = sanitize_text_field( $_POST['contact'] ?? '' );
    $arrivee = sanitize_text_field( $_POST['arrivee'] ?? '' );
    $depart = sanitize_text_field( $_POST['depart'] ?? '' );
    $type = sanitize_text_field( $_POST['type'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );
    
    if ( empty( $nom ) || empty( $contact ) || empty( $arrivee ) || empty( $depart ) ) {
        wp_safe_redirect( home_url( '/maison-accueil?error=missing' ) ); 
        exit;
    }
    
    $to = dsj_get_email();
    $subject = '[DSJ] Réservation - ' . $nom;
    $body = "Nouvelle réservation :\n\nNom: $nom\nContact: $contact\nArrivée: $arrivee\nDépart: $depart\nType: $type\nMessage: $message";
    $headers = [ 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $contact ];
    $sent = wp_mail( $to, $subject, $body, $headers );
    
    wp_safe_redirect( home_url( $sent ? '/maison-accueil?success=1' : '/maison-accueil?error=send' ) );
    exit;
}

// Formulaire de réservation restaurant
add_action( 'admin_post_dsj_restaurant_reservation', 'dsj_handle_restaurant_reservation' );
add_action( 'admin_post_nopriv_dsj_restaurant_reservation', 'dsj_handle_restaurant_reservation' );

function dsj_handle_restaurant_reservation() {
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'dsj_restaurant_nonce' ) ) {
        wp_die( 'Erreur de sécurité', 'Domaine Saint Joseph', [ 'response' => 403 ] );
    }
    
    $nom = sanitize_text_field( $_POST['resa_nom'] ?? '' );
    $contact = sanitize_text_field( $_POST['resa_contact'] ?? '' );
    $date = sanitize_text_field( $_POST['resa_date'] ?? '' );
    $heure = sanitize_text_field( $_POST['resa_heure'] ?? '' );
    $personnes = sanitize_text_field( $_POST['resa_personnes'] ?? '' );
    $occasion = sanitize_text_field( $_POST['resa_occasion'] ?? '' );
    $message = sanitize_textarea_field( $_POST['resa_message'] ?? '' );
    
    if ( empty( $nom ) || empty( $contact ) || empty( $date ) || empty( $heure ) ) {
        wp_safe_redirect( home_url( '/restaurant?resa_error=missing' ) ); 
        exit;
    }
    
    $to = dsj_get_email();
    $subject = '[DSJ] Réservation Restaurant - ' . $nom;
    $body = "Nouvelle réservation restaurant :\n\n";
    $body .= "Nom: $nom\n";
    $body .= "Contact: $contact\n";
    $body .= "Date: $date\n";
    $body .= "Heure: $heure\n";
    $body .= "Nombre de personnes: $personnes\n";
    $body .= "Occasion: $occasion\n";
    $body .= "Message: $message\n";
    $body .= "---\nEnvoyé depuis: " . home_url();
    
    $headers = [ 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $contact ];
    $sent = wp_mail( $to, $subject, $body, $headers );
    
    wp_safe_redirect( home_url( $sent ? '/restaurant?resa_success=1' : '/restaurant?resa_error=send' ) );
    exit;
}

// ========================================
// RÔLES & PERMISSIONS
// ========================================

// Création d'un rôle "Soeur" si inexistant
function dsj_add_roles() {
    if ( ! get_role( 'soeur' ) ) {
        add_role( 'soeur', __( 'Sœur', 'domaine-saint-joseph' ), [
            'read' => true,
            'edit_posts' => true,
            'edit_published_posts' => true,
            'upload_files' => true,
            'publish_posts' => true,
            'delete_posts' => true,
            'edit_formation' => true,
            'edit_published_formation' => true,
            'publish_formation' => true,
            'delete_formation' => true,
            'edit_hebergement' => true,
            'edit_published_hebergement' => true,
            'publish_hebergement' => true,
        ] );
    }
}
add_action( 'after_switch_theme', 'dsj_add_roles' );

// ========================================
// FORCER LES TEMPLATES
// ========================================

// Forcer l'utilisation du template single-hebergement.php
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

// ========================================
// ADMIN SCRIPTS
// ========================================

// Charger les scripts pour l'uploader d'images dans les widgets
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