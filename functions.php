<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function cfbf_setup() {
    // Ajoute cette ligne pour la traduction
    load_theme_textdomain( 'domaine-saint-joseph', get_template_directory() . '/languages' );
    
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    
    register_nav_menus([
        'primary' => __( 'Menu Principal', 'domaine-saint-joseph' ),
        'footer'  => __( 'Menu Footer', 'domaine-saint-joseph' ),
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