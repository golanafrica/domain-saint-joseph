<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// ── Configuration du thème ──
function dsj_setup() {
    load_theme_textdomain( 'domaine-saint-joseph', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    
    register_nav_menus([
        'primary' => __( 'Menu Principal', 'domaine-saint-joseph' ),
        'footer'  => __( 'Menu Footer', 'domaine-saint-joseph' ),
    ]);
}
add_action( 'after_setup_theme', 'dsj_setup' );

// ── Chargement des assets ──
function dsj_enqueue_assets() {
    wp_enqueue_style(
        'dsj-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        wp_get_theme()->get( 'Version' )
    );
    wp_enqueue_script(
        'dsj-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'dsj_enqueue_assets' );

// ── Handler formulaire de contact (sécurisé) ──
add_action( 'admin_post_dsj_contact_form', 'dsj_handle_contact_form' );
add_action( 'admin_post_nopriv_dsj_contact_form', 'dsj_handle_contact_form' );

function dsj_handle_contact_form() {
    // 1. Vérification nonce (sécurité anti-CSRF)
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'dsj_contact_nonce' ) ) {
        wp_die( 'Erreur de sécurité : demande non autorisée.', 'Domaine Saint Joseph', [ 'response' => 403 ] );
    }

    // 2. Sanitization des entrées
    $nom     = sanitize_text_field( $_POST['cf_nom'] ?? '' );
    $contact = sanitize_text_field( $_POST['cf_contact'] ?? '' );
    $sujet   = sanitize_text_field( $_POST['cf_sujet'] ?? 'general' );
    $message = sanitize_textarea_field( $_POST['cf_message'] ?? '' );

    // 3. Validation basique
    if ( empty( $nom ) || empty( $contact ) || empty( $message ) ) {
        wp_safe_redirect( home_url( '/contact?error=missing' ) );
        exit;
    }

    // 4. Préparation de l'email
    $to      = 'centredsj@gmail.com';
    $subject = sprintf( '[DSJ] %s - %s', ucfirst( $sujet ), $nom );
    $body    = "Nouveau message depuis le site Domaine Saint Joseph :\n\n";
    $body   .= "Nom : $nom\n";
    $body   .= "Contact : $contact\n";
    $body   .= "Sujet : $sujet\n";
    $body   .= "Message :\n$message\n";
    $body   .= "\n---\nEnvoyé depuis : " . home_url() . "\n";
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $contact,
    ];

    // 5. Envoi avec gestion d'erreur
    $sent = wp_mail( $to, $subject, $body, $headers );

    // 6. Redirection avec feedback
    if ( $sent ) {
        wp_safe_redirect( home_url( '/contact?success=1' ) );
    } else {
        // Log l'erreur pour debug (optionnel)
        error_log( '[DSJ Contact] wp_mail failed for: ' . $contact );
        wp_safe_redirect( home_url( '/contact?error=send' ) );
    }
    exit;
}