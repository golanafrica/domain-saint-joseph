<?php
/**
 * Functions du thème Domaine Saint Joseph
 * Version production - Phase 8 (CSS modulaire + Corrections audit Claude)
 * Phase 3 : URLs de redirection dynamiques pour les formulaires
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
// 🔧 PHASE 8 : CHARGEMENT DES ASSETS MODULAIRES AVEC CACHE-BUSTING
// ════════════════════════════════════════════════════════════════
function dsj_assets() {
    $css_dir = get_template_directory() . '/assets/css/';
    $css_uri = get_template_directory_uri() . '/assets/css/';
    
    $css_files = [
        '01-base',
        '02-header',
        '03-hero',
        '04-footer',
        '05-components',
        '06-forms',
        '07-galerie',
        '08-pages',
        '09-singles',
        '10-cta',
        '11-responsive',
        '12-accessibility',
    ];
    
    foreach ( $css_files as $file ) {
        $file_path = $css_dir . $file . '.css';
        $file_url  = $css_uri . $file . '.css';
        $version   = file_exists( $file_path ) ? filemtime( $file_path ) : '1.0';
        
        wp_enqueue_style( 'dsj-' . $file, $file_url, [], $version );
    }
    
    
    
    $script_file = get_template_directory() . '/assets/js/main.js';
    $script_version = file_exists( $script_file ) ? filemtime( $script_file ) : '1.0';
    wp_enqueue_script( 'dsj-main-js', get_template_directory_uri() . '/assets/js/main.js', [], $script_version, true );
    
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
    wp_add_inline_style( 'dsj-01-base', $custom_css );
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
// 🔒 PHASE 3 : URLs DE REDIRECTION DYNAMIQUES POUR FORMULAIRES
// ════════════════════════════════════════════════════════════════
// Récupère l'URL de redirection après soumission d'un formulaire.
// Priorité : 1) Referer (page d'origine) → 2) Page par slug → 3) Accueil
function dsj_get_form_redirect_url( $form_type ) {
    // 1. Priorité au referer (page d'où vient le formulaire)
    $referer = wp_get_referer();
    if ( $referer ) {
        return remove_query_arg( [ 'success', 'error', 'resa_success', 'resa_error' ], $referer );
    }
    
    // 2. Fallback : chercher la page par slug
    $page_slugs = [
        'contact'     => 'contact',
        'reservation' => 'maison-daccueil',
        'restaurant'  => 'restaurant',
    ];
    
    $slug = $page_slugs[ $form_type ] ?? '';
    if ( $slug ) {
        $page = get_page_by_path( $slug );
        if ( $page ) {
            return get_permalink( $page->ID );
        }
    }
    
    // 3. Fallback final : page d'accueil
    return home_url( '/' );
}

// ════════════════════════════════════════════════════════════════
// 🔒 PHASE 6.1 : VÉRIFICATION FAIL-CLOSED SÉCURITÉ FORMULAIRES
// ════════════════════════════════════════════════════════════════
function dsj_verify_security_module_available() {
    $required_functions = [
        'dsj_check_honeypot',
        'dsj_check_rate_limit',
        'dsj_validate_contact',
    ];
    
    foreach ( $required_functions as $func ) {
        if ( ! function_exists( $func ) ) {
            error_log( "DSJ Sécurité: $func() manquant — formulaire bloqué par sécurité." );
            return false;
        }
    }
    
    return true;
}

// ════════════════════════════════════════════════════════════════
// 🔒 PHASE 6.2 : HANDLER FORMULAIRE CONTACT (sécurisé)
// ════════════════════════════════════════════════════════════════

function dsj_handle_contact_form() {
    // ✅ Phase 3 : URL dynamique au lieu de home_url('/contact')
    $fallback_url = dsj_get_form_redirect_url( 'contact' );
    
    // 1. Nonce (sécurité) - redirection propre au lieu de wp_die()
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'dsj_contact_nonce' ) ) {
        wp_safe_redirect( add_query_arg( 'error', 'session_expired', $fallback_url ) );
        exit;
    }
    
    // 2. Fail-closed si sécurité indisponible
    if ( ! dsj_verify_security_module_available() ) {
        wp_safe_redirect( add_query_arg( 'error', 'service_unavailable', $fallback_url ) );
        exit;
    }
    
    // 3. Honeypot (bot)
    if ( ! dsj_check_honeypot() ) {
        wp_safe_redirect( add_query_arg( 'success', '1', $fallback_url ) );
        exit;
    }
    
    // 4. Validation des données (AVANT rate limit)
    $nom     = sanitize_text_field( $_POST['cf_nom'] ?? '' );
    $contact = sanitize_text_field( $_POST['cf_contact'] ?? '' );
    $sujet   = sanitize_text_field( $_POST['cf_sujet'] ?? 'general' );
    $message = sanitize_textarea_field( $_POST['cf_message'] ?? '' );
    
    if ( empty( $nom ) || empty( $contact ) || empty( $message ) ) {
        wp_safe_redirect( add_query_arg( 'error', 'missing', $fallback_url ) );
        exit;
    }
    
    if ( mb_strlen( $message ) > 5000 ) {
        wp_safe_redirect( add_query_arg( 'error', 'too_long', $fallback_url ) );
        exit;
    }
    
    if ( ! dsj_validate_contact( $contact ) ) {
        wp_safe_redirect( add_query_arg( 'error', 'invalid_contact', $fallback_url ) );
        exit;
    }
    
    // 5. Rate limit (APRÈS validation des données)
    if ( ! dsj_check_rate_limit( 'contact' ) ) {
        wp_safe_redirect( add_query_arg( 'error', 'rate_limit', $fallback_url ) );
        exit;
    }
    
    // 6. Enregistrement et envoi
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
    
    wp_safe_redirect( add_query_arg( $sent ? 'success' : 'error', $sent ? '1' : 'send', $fallback_url ) );
    exit;
}
add_action( 'admin_post_dsj_contact_form', 'dsj_handle_contact_form' );
add_action( 'admin_post_nopriv_dsj_contact_form', 'dsj_handle_contact_form' );

// ════════════════════════════════════════════════════════════════
// 🔒 PHASE 6.2 : HANDLER FORMULAIRE RÉSERVATION HÉBERGEMENT
// ════════════════════════════════════════════════════════════════

function dsj_handle_reservation_form() {
    // ✅ Phase 3 : URL dynamique
    $fallback_url = dsj_get_form_redirect_url( 'reservation' );
    
    // 1. Nonce
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'dsj_reservation_nonce' ) ) {
        wp_safe_redirect( add_query_arg( 'error', 'session_expired', $fallback_url ) );
        exit;
    }
    
    // 2. Fail-closed
    if ( ! dsj_verify_security_module_available() ) {
        wp_safe_redirect( add_query_arg( 'error', 'service_unavailable', $fallback_url ) );
        exit;
    }
    
    // 3. Honeypot
    if ( ! dsj_check_honeypot() ) {
        wp_safe_redirect( add_query_arg( 'success', '1', $fallback_url ) );
        exit;
    }
    
    // 4. Validation des données
    $nom     = sanitize_text_field( $_POST['nom'] ?? '' );
    $contact = sanitize_text_field( $_POST['contact'] ?? '' );
    $arrivee = sanitize_text_field( $_POST['arrivee'] ?? '' );
    $depart  = sanitize_text_field( $_POST['depart'] ?? '' );
    $type    = sanitize_text_field( $_POST['type'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );
    
    if ( empty( $nom ) || empty( $contact ) || empty( $arrivee ) || empty( $depart ) ) {
        wp_safe_redirect( add_query_arg( 'error', 'missing', $fallback_url ) );
        exit;
    }
    
    if ( mb_strlen( $message ) > 5000 ) {
        wp_safe_redirect( add_query_arg( 'error', 'too_long', $fallback_url ) );
        exit;
    }
    
    if ( ! dsj_validate_contact( $contact ) ) {
        wp_safe_redirect( add_query_arg( 'error', 'invalid_contact', $fallback_url ) );
        exit;
    }
    
    // 5. Rate limit
    if ( ! dsj_check_rate_limit( 'reservation' ) ) {
        wp_safe_redirect( add_query_arg( 'error', 'rate_limit', $fallback_url ) );
        exit;
    }
    
    // 6. Enregistrement et envoi
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
    
    wp_safe_redirect( add_query_arg( $sent ? 'success' : 'error', $sent ? '1' : 'send', $fallback_url ) );
    exit;
}
add_action( 'admin_post_dsj_reservation_form', 'dsj_handle_reservation_form' );
add_action( 'admin_post_nopriv_dsj_reservation_form', 'dsj_handle_reservation_form' );

// ════════════════════════════════════════════════════════════════
// 🔒 PHASE 6.2 : HANDLER FORMULAIRE RÉSERVATION RESTAURANT
// ════════════════════════════════════════════════════════════════

function dsj_handle_restaurant_reservation() {
    // ✅ Phase 3 : URL dynamique
    $fallback_url = dsj_get_form_redirect_url( 'restaurant' );
    
    // 1. Nonce
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'dsj_restaurant_nonce' ) ) {
        wp_safe_redirect( add_query_arg( 'resa_error', 'session_expired', $fallback_url ) );
        exit;
    }
    
    // 2. Fail-closed
    if ( ! dsj_verify_security_module_available() ) {
        wp_safe_redirect( add_query_arg( 'resa_error', 'service_unavailable', $fallback_url ) );
        exit;
    }
    
    // 3. Honeypot
    if ( ! dsj_check_honeypot() ) {
        wp_safe_redirect( add_query_arg( 'resa_success', '1', $fallback_url ) );
        exit;
    }
    
    // 4. Validation des données
    $nom       = sanitize_text_field( $_POST['resa_nom'] ?? '' );
    $contact   = sanitize_text_field( $_POST['resa_contact'] ?? '' );
    $date      = sanitize_text_field( $_POST['resa_date'] ?? '' );
    $heure     = sanitize_text_field( $_POST['resa_heure'] ?? '' );
    $personnes = sanitize_text_field( $_POST['resa_personnes'] ?? '' );
    $occasion  = sanitize_text_field( $_POST['resa_occasion'] ?? '' );
    $message   = sanitize_textarea_field( $_POST['resa_message'] ?? '' );
    
    if ( empty( $nom ) || empty( $contact ) || empty( $date ) || empty( $heure ) ) {
        wp_safe_redirect( add_query_arg( 'resa_error', 'missing', $fallback_url ) );
        exit;
    }
    
    if ( mb_strlen( $message ) > 5000 ) {
        wp_safe_redirect( add_query_arg( 'resa_error', 'too_long', $fallback_url ) );
        exit;
    }
    
    if ( ! dsj_validate_contact( $contact ) ) {
        wp_safe_redirect( add_query_arg( 'resa_error', 'invalid_contact', $fallback_url ) );
        exit;
    }
    
    // 5. Rate limit
    if ( ! dsj_check_rate_limit( 'restaurant' ) ) {
        wp_safe_redirect( add_query_arg( 'resa_error', 'rate_limit', $fallback_url ) );
        exit;
    }
    
    // 6. Enregistrement et envoi
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
    
    wp_safe_redirect( add_query_arg( $sent ? 'resa_success' : 'resa_error', $sent ? '1' : 'send', $fallback_url ) );
    exit;
}
add_action( 'admin_post_dsj_restaurant_reservation', 'dsj_handle_restaurant_reservation' );
add_action( 'admin_post_nopriv_dsj_restaurant_reservation', 'dsj_handle_restaurant_reservation' );

// ════════════════════════════════════════════════════════════════
// RÔLES & PERMISSIONS - RÔLE SOEUR (COLLABORATION TOTALE + CUSTOMIZER)
// ════════════════════════════════════════════════════════════════

function dsj_add_roles() {
    remove_role( 'soeur' );
    
    add_role( 'soeur', __( 'Sœur', 'domaine-saint-joseph' ), [
        'read'                        => true,
        'edit_posts'                  => true,
        'edit_published_posts'        => true,
        'edit_others_posts'           => true,
        'delete_posts'                => true,
        'delete_published_posts'      => true,
        'delete_others_posts'         => true,
        'publish_posts'               => true,
        'upload_files'                => true,
        'edit_theme_options'          => true,

        'edit_formation'              => true,
        'edit_formations'             => true,
        'edit_others_formations'      => true,
        'edit_published_formation'    => true,
        'edit_published_formations'   => true,
        'delete_formation'            => true,
        'delete_formations'           => true,
        'delete_others_formations'    => true,
        'delete_published_formation'  => true,
        'delete_published_formations' => true,
        'publish_formation'           => true,
        'publish_formations'          => true,
        'read_formation'              => true,

        'edit_hebergement'              => true,
        'edit_hebergements'             => true,
        'edit_others_hebergements'      => true,
        'edit_published_hebergement'    => true,
        'edit_published_hebergements'   => true,
        'delete_hebergement'            => true,
        'delete_hebergements'           => true,
        'delete_others_hebergements'    => true,
        'delete_published_hebergement'  => true,
        'delete_published_hebergements' => true,
        'publish_hebergement'           => true,
        'publish_hebergements'          => true,
        'read_hebergement'              => true,

        'edit_menu'              => true,
        'edit_menus'             => true,
        'edit_others_menus'      => true,
        'edit_published_menu'    => true,
        'edit_published_menus'   => true,
        'delete_menu'            => true,
        'delete_menus'           => true,
        'delete_others_menus'    => true,
        'delete_published_menu'  => true,
        'delete_published_menus' => true,
        'publish_menu'           => true,
        'publish_menus'          => true,
        'read_menu'              => true,

        'edit_galerie'              => true,
        'edit_galeries'             => true,
        'edit_others_galeries'      => true,
        'edit_published_galerie'    => true,
        'edit_published_galeries'   => true,
        'delete_galerie'            => true,
        'delete_galeries'           => true,
        'delete_others_galeries'    => true,
        'delete_published_galerie'  => true,
        'delete_published_galeries' => true,
        'publish_galerie'           => true,
        'publish_galeries'          => true,
        'read_galerie'              => true,

        'edit_temoignage'              => true,
        'edit_temoignages'             => true,
        'edit_others_temoignages'      => true,
        'edit_published_temoignage'    => true,
        'edit_published_temoignages'   => true,
        'delete_temoignage'            => true,
        'delete_temoignages'           => true,
        'delete_others_temoignages'    => true,
        'delete_published_temoignage'  => true,
        'delete_published_temoignages' => true,
        'publish_temoignage'           => true,
        'publish_temoignages'          => true,
        'read_temoignage'              => true,

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
// 🔒 PHASE 6.5 : ADMIN SCRIPTS RESTREINTS + CACHE-BUSTING
// ════════════════════════════════════════════════════════════════

function dsj_admin_widget_scripts( $hook ) {
    if ( ! in_array( $hook, [ 'widgets.php', 'customize.php' ], true ) ) {
        return;
    }
    
    wp_enqueue_media();
    
    $script_file = get_template_directory() . '/assets/js/widget-uploader.js';
    $script_version = file_exists( $script_file ) ? filemtime( $script_file ) : '1.0';
    
    wp_enqueue_script(
        'dsj-widget-uploader',
        get_template_directory_uri() . '/assets/js/widget-uploader.js',
        array( 'jquery' ),
        $script_version,
        true
    );
}
add_action( 'admin_enqueue_scripts', 'dsj_admin_widget_scripts' );

// ════════════════════════════════════════════════════════════════
// 2.2 NOTIFICATIONS ADMIN - CHAMPS MANQUANTS À LA PUBLICATION
// ════════════════════════════════════════════════════════════════

function dsj_check_missing_fields_on_publish( $new_status, $old_status, $post ) {
    if ( $new_status !== 'publish' || $old_status === 'publish' ) {
        return;
    }
    
    $missing_fields = [];
    
    switch ( $post->post_type ) {
        case 'formation':
            $duree  = get_post_meta( $post->ID, '_dsj_duree', true );
            $prix   = get_post_meta( $post->ID, '_dsj_prix', true );
            $niveau = get_post_meta( $post->ID, '_dsj_niveau', true );
            
            if ( empty( $duree ) ) $missing_fields[] = 'durée';
            if ( empty( $prix ) ) $missing_fields[] = 'prix';
            if ( empty( $niveau ) ) $missing_fields[] = 'niveau requis';
            break;
            
        case 'hebergement':
            $capacite  = get_post_meta( $post->ID, '_dsj_capacite', true );
            $prix_nuit = get_post_meta( $post->ID, '_dsj_prix_nuit', true );
            
            if ( empty( $capacite ) ) $missing_fields[] = 'capacité';
            if ( empty( $prix_nuit ) ) $missing_fields[] = 'prix par nuit';
            break;
            
        case 'menu':
            $prix_menu = get_post_meta( $post->ID, '_menu_prix', true );
            $temps     = get_post_meta( $post->ID, '_menu_temps', true );
            
            if ( empty( $prix_menu ) ) $missing_fields[] = 'prix';
            if ( empty( $temps ) ) $missing_fields[] = 'temps de préparation';
            break;
    }
    
    if ( ! empty( $missing_fields ) ) {
        set_transient( 
            'dsj_missing_fields_' . $post->ID, 
            [
                'type'   => $post->post_type,
                'title'  => $post->post_title,
                'fields' => $missing_fields,
            ], 
            120
        );
    }
}
add_action( 'transition_post_status', 'dsj_check_missing_fields_on_publish', 10, 3 );

function dsj_display_missing_fields_notice() {
    global $post;
    
    if ( ! $post ) return;
    
    $transient_key = 'dsj_missing_fields_' . $post->ID;
    $notice_data = get_transient( $transient_key );
    
    if ( ! $notice_data ) return;
    
    delete_transient( $transient_key );
    
    $post_type_label = '';
    switch ( $notice_data['type'] ) {
        case 'formation': $post_type_label = 'formation'; break;
        case 'hebergement': $post_type_label = 'hébergement'; break;
        case 'menu': $post_type_label = 'plat'; break;
    }
    
    $fields_list = implode( ', ', $notice_data['fields'] );
    $edit_url = get_edit_post_link( $post->ID );
    
    echo '<div class="notice notice-warning is-dismissible">';
    echo '<p><strong>⚠️ Attention :</strong> La ' . esc_html( $post_type_label ) . ' "<strong>' . esc_html( $notice_data['title'] ) . '</strong>" a été publiée mais il manque : <strong>' . esc_html( $fields_list ) . '</strong>.';
    echo ' <a href="' . esc_url( $edit_url ) . '">Compléter maintenant →</a></p>';
    echo '<p><small>Ces informations sont importantes pour que le contenu s\'affiche correctement sur le site.</small></p>';
    echo '</div>';
}
add_action( 'admin_notices', 'dsj_display_missing_fields_notice' );

// ════════════════════════════════════════════════════════════════
// 2.3 LIMITER LES BLOCS GUTENBERG POUR LES CPT
// ════════════════════════════════════════════════════════════════

function dsj_limit_blocks( $allowed_blocks, $editor_context ) {
    if ( ! isset( $editor_context->post ) || ! $editor_context->post ) {
        return $allowed_blocks;
    }
    
    $post_type = $editor_context->post->post_type;
    $dsj_cpts = [ 'formation', 'hebergement', 'menu', 'galerie', 'temoignage' ];
    
    if ( ! in_array( $post_type, $dsj_cpts, true ) ) {
        return $allowed_blocks;
    }
    
    if ( current_user_can( 'manage_options' ) ) {
        return $allowed_blocks;
    }
    
    return [
        'core/paragraph',
        'core/heading',
        'core/list',
        'core/list-item',
        'core/image',
        'core/gallery',
        'core/separator',
        'core/spacer',
        'core/group',
        'core/table',
        'core/buttons',
        'core/button',
    ];
}
add_filter( 'allowed_block_types_all', 'dsj_limit_blocks', 10, 2 );


// ╔════════════════════════════════════════════════════════════════╗
// ║              PHASE 3 : SIMPLIFICATION ADMIN POUR SŒURS        ║
// ╚════════════════════════════════════════════════════════════════╝

// ════════════════════════════════════════════════════════════════
// 3.1 NETTOYER LE MENU ADMIN POUR LES SŒURS
// ════════════════════════════════════════════════════════════════

function dsj_simplify_admin_for_soeur() {
    if ( current_user_can( 'manage_options' ) ) {
        return;
    }
    
    // Menus principaux à cacher complètement
    remove_menu_page( 'tools.php' );
    remove_menu_page( 'plugins.php' );
    remove_menu_page( 'options-general.php' );
    remove_menu_page( 'edit-comments.php' );
    remove_menu_page( 'users.php' );
    
    // Sous-menus d'Apparence à cacher
    remove_submenu_page( 'themes.php', 'themes.php' );           // Thèmes
    remove_submenu_page( 'themes.php', 'theme-editor.php' );     // Éditeur de thème
    remove_submenu_page( 'themes.php', 'nav-menus.php' );        // Menus (bloqué aussi côté serveur plus bas)
    remove_submenu_page( 'themes.php', 'theme-install.php' );    // ✅ Corrigé : vrai slug WordPress
}
add_action( 'admin_menu', 'dsj_simplify_admin_for_soeur', 999 );

// ════════════════════════════════════════════════════════════════
// 🔒 PHASE 7.1 : BLOCAGE RÉEL DE NAV-MENUS.PHP (sécurité serveur)
// ════════════════════════════════════════════════════════════════
add_action( 'load-nav-menus.php', function() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 
            'Vous n\'avez pas accès à cette page. Utilisez <a href="' . admin_url( 'customize.php' ) . '">Personnaliser</a> ou <a href="' . admin_url( 'widgets.php' ) . '">Widgets</a> pour modifier le site.', 
            'Accès refusé', 
            [ 'response' => 403 ] 
        );
    }
});

// ════════════════════════════════════════════════════════════════
// 3.1b NETTOYER LA BARRE ADMIN
// ════════════════════════════════════════════════════════════════

add_action( 'admin_bar_menu', function( $wp_admin_bar ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        $wp_admin_bar->remove_node( 'wp-logo' );
        $wp_admin_bar->remove_node( 'updates' );
        $wp_admin_bar->remove_node( 'comments' );
    }
}, 999 );

// ════════════════════════════════════════════════════════════════
// 3.2 NETTOYER LE TABLEAU DE BORD
// ════════════════════════════════════════════════════════════════

function dsj_clean_dashboard() {
    if ( current_user_can( 'manage_options' ) ) {
        return;
    }
    
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
}
add_action( 'wp_dashboard_setup', 'dsj_clean_dashboard' );

// ════════════════════════════════════════════════════════════════
// 3.3 WIDGET "QUE FAIRE AUJOURD'HUI ?" POUR LES SŒURS
// ════════════════════════════════════════════════════════════════

function dsj_add_help_widget() {
    if ( current_user_can( 'manage_options' ) ) {
        return;
    }
    
    wp_add_dashboard_widget(
        'dsj_help_widget',
        '🌟 Que faire aujourd\'hui ?',
        'dsj_render_help_widget'
    );
}
add_action( 'wp_dashboard_setup', 'dsj_add_help_widget' );

function dsj_render_help_widget() {
    ?>
    <style>
        .dsj-help-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .dsj-help-list li {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        .dsj-help-list li:last-child {
            border-bottom: none;
        }
        .dsj-help-list a {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #1A5276;
            font-weight: 500;
            font-size: 14px;
        }
        .dsj-help-list a:hover {
            color: #D4AC0D;
        }
        .dsj-help-list .icon {
            font-size: 20px;
            flex-shrink: 0;
        }
        .dsj-help-list .label {
            flex: 1;
        }
        .dsj-help-list .arrow {
            color: #ccc;
            transition: color 0.2s;
        }
        .dsj-help-list a:hover .arrow {
            color: #D4AC0D;
        }
        .dsj-help-separator {
            padding: 10px 0 5px;
            margin-top: 10px;
            border-top: 2px solid #D4AC0D;
            font-size: 12px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
    
    <ul class="dsj-help-list">
        <div class="dsj-help-separator">📅 Actions courantes</div>
        
        <li>
            <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=formation' ) ); ?>">
                <span class="icon">🎓</span>
                <span class="label">Ajouter une formation</span>
                <span class="arrow">→</span>
            </a>
        </li>
        
        <li>
            <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=hebergement' ) ); ?>">
                <span class="icon">🏠</span>
                <span class="label">Ajouter un hébergement</span>
                <span class="arrow">→</span>
            </a>
        </li>
        
        <li>
            <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=menu' ) ); ?>">
                <span class="icon">🍽️</span>
                <span class="label">Ajouter un plat au restaurant</span>
                <span class="arrow">→</span>
            </a>
        </li>
        
        <li>
            <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=galerie' ) ); ?>">
                <span class="icon">📸</span>
                <span class="label">Ajouter une photo à la galerie</span>
                <span class="arrow">→</span>
            </a>
        </li>
        
        <li>
            <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=temoignage' ) ); ?>">
                <span class="icon">💬</span>
                <span class="label">Ajouter un témoignage</span>
                <span class="arrow">→</span>
            </a>
        </li>
        
        <div class="dsj-help-separator">🎨 Personnaliser le site</div>
        
        <li>
            <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>">
                <span class="icon">🎨</span>
                <span class="label">Personnaliser l'apparence</span>
                <span class="arrow">→</span>
            </a>
        </li>
        
        <li>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=dsj_urgence' ) ); ?>">
                <span class="icon">🚨</span>
                <span class="label">Modifier le bandeau d'urgence</span>
                <span class="arrow">→</span>
            </a>
        </li>
        
        <li>
            <a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>">
                <span class="icon">🧩</span>
                <span class="label">Gérer les widgets</span>
                <span class="arrow">→</span>
            </a>
        </li>
        
        <li>
            <a href="<?php echo esc_url( admin_url( 'upload.php' ) ); ?>">
                <span class="icon">🖼️</span>
                <span class="label">Médiathèque (images/fichiers)</span>
                <span class="arrow">→</span>
            </a>
        </li>
        
        <div class="dsj-help-separator">📬 Consulter</div>
        
        <li>
            <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=dsj_message' ) ); ?>">
                <span class="icon">📧</span>
                <span class="label">Voir les messages reçus</span>
                <span class="arrow">→</span>
            </a>
        </li>
    </ul>
    
    <p style="margin-top: 15px; padding: 10px; background: #f0f6fc; border-left: 3px solid #1A5276; font-size: 13px; color: #555;">
        💡 <strong>Besoin d'aide ?</strong> Cliquez sur l'onglet <em>Aide</em> en haut à droite de chaque écran.
    </p>
    <?php
}

// ════════════════════════════════════════════════════════════════
// 3.4 ONGLETS D'AIDE CONTEXTUELLE
// ════════════════════════════════════════════════════════════════

function dsj_add_help_tabs() {
    $screen = get_current_screen();
    if ( ! $screen || ! isset( $screen->post_type ) ) return;
    
    $help_content = [];
    
    switch ( $screen->post_type ) {
        case 'formation':
            $help_content = [
                'title' => '🎓 Aide - Formation',
                'content' => '
                    <h3>Comment ajouter une formation ?</h3>
                    <ol>
                        <li><strong>Titre</strong> : nom de la formation</li>
                        <li><strong>Description</strong> : détails du programme</li>
                        <li><strong>Image mise en avant</strong> : photo de la formation</li>
                        <li><strong>Détails</strong> : durée, prix, niveau, places, formatrice, horaires</li>
                    </ol>
                    <p>⚠️ Remplissez au moins la durée et le prix.</p>
                    <p>✅ Cliquez sur <strong>Publier</strong> une fois terminé.</p>
                ',
            ];
            break;
            
        case 'hebergement':
            $help_content = [
                'title' => '🏠 Aide - Hébergement',
                'content' => '
                    <h3>Comment ajouter un hébergement ?</h3>
                    <ol>
                        <li><strong>Titre</strong> : nom de la chambre</li>
                        <li><strong>Description</strong> : description de la chambre</li>
                        <li><strong>Image mise en avant</strong> : photo de la chambre</li>
                        <li><strong>Détails</strong> : capacité, prix par nuit, équipements, disponibilité</li>
                    </ol>
                    <p>💡 Équipements séparés par des virgules.</p>
                    <p>⚠️ Mettez à jour la disponibilité dès qu\'une chambre est réservée.</p>
                ',
            ];
            break;
            
        case 'menu':
            $help_content = [
                'title' => '🍽️ Aide - Plat du restaurant',
                'content' => '
                    <h3>Comment ajouter un plat ?</h3>
                    <ol>
                        <li><strong>Titre</strong> : nom du plat</li>
                        <li><strong>Description</strong> : description du plat</li>
                        <li><strong>Image mise en avant</strong> : belle photo du plat</li>
                        <li><strong>Détails</strong> : prix, temps, ingrédients, allergènes</li>
                    </ol>
                    <p>📸 Une belle photo est très importante !</p>
                ',
            ];
            break;
            
        case 'galerie':
            $help_content = [
                'title' => '📸 Aide - Photo galerie',
                'content' => '
                    <h3>Comment ajouter une photo ?</h3>
                    <ol>
                        <li><strong>Titre</strong> : nom de la photo</li>
                        <li><strong>Image mise en avant</strong> : LA photo</li>
                        <li><strong>Catégorie Galerie</strong> : classez la photo</li>
                        <li><strong>Extrait</strong> : courte description (optionnel)</li>
                    </ol>
                    <p>💡 Utilisez des photos lumineuses et de bonne qualité.</p>
                ',
            ];
            break;
            
        case 'temoignage':
            $help_content = [
                'title' => '💬 Aide - Témoignage',
                'content' => '
                    <h3>Comment ajouter un témoignage ?</h3>
                    <ol>
                        <li><strong>Titre</strong> : nom de la personne</li>
                        <li><strong>Contenu</strong> : le témoignage complet</li>
                    </ol>
                    <p>✨ Les témoignages renforcent la confiance des visiteurs.</p>
                ',
            ];
            break;
    }
    
    if ( ! empty( $help_content ) ) {
        $screen->add_help_tab([
            'id'      => 'dsj_help_tab',
            'title'   => 'Aide',
            'content' => $help_content['content'],
        ]);
    }
}
add_action( 'current_screen', 'dsj_add_help_tabs' );