<?php
if ( ! defined( 'ABSPATH' ) ) exit;

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