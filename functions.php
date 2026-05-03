<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Sécurité

// Configuration du thème
function cfbf_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    
    // Enregistrement des menus
    register_nav_menus([
        'primary' => __( 'Menu Principal', 'college-filles-bf' ),
        'footer'  => __( 'Menu Footer', 'college-filles-bf' ),
    ]);
}
add_action( 'after_setup_theme', 'cfbf_setup' );

// Chargement des CSS/JS
function cfbf_enqueue_assets() {
    // CSS principal depuis assets/css/
    wp_enqueue_style(
        'cfbf-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        wp_get_theme()->get( 'Version' )
    );
    
    // JS principal depuis assets/js/ (chargé en footer, async)
    wp_enqueue_script(
        'cfbf-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        wp_get_theme()->get( 'Version' ),
        true // true = chargé dans le footer
    );
}
add_action( 'wp_enqueue_scripts', 'cfbf_enqueue_assets' );