<?php
/**
 * Custom Post Types &#8212; Formations, H&#233;bergements, Galerie
 * Domaine Saint Joseph
 */

function dsj_register_cpts() {
    
    // &#127891; Formations &#127891;
    register_post_type( 'formation', [
        'labels' => [
            'name' => __( 'Formations', 'domaine-saint-joseph' ),
            'singular_name' => __( 'Formation', 'domaine-saint-joseph' ),
            'add_new' => __( 'Ajouter une formation', 'domaine-saint-joseph' ),
            'add_new_item' => __( 'Nouvelle formation', 'domaine-saint-joseph' ),
            'edit_item' => __( 'Modifier la formation', 'domaine-saint-joseph' ),
            'view_item' => __( 'Voir la formation', 'domaine-saint-joseph' ),
            'all_items' => __( 'Toutes les formations', 'domaine-saint-joseph' ),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => [ 'slug' => 'formations' ],
        'supports' => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_rest' => false,
        'menu_position' => 5,
    ]);

    // &#127968; H&#233;bergements &#127968;
    register_post_type( 'hebergement', [
        'labels' => [
            'name' => __( 'H&#233;bergements', 'domaine-saint-joseph' ),
            'singular_name' => __( 'H&#233;bergement', 'domaine-saint-joseph' ),
            'add_new' => __( 'Ajouter un h&#233;bergement', 'domaine-saint-joseph' ),
            'add_new_item' => __( 'Nouvel h&#233;bergement', 'domaine-saint-joseph' ),
            'edit_item' => __( "Modifier l'h&#233;bergement", 'domaine-saint-joseph' ),
            'view_item' => __( "Voir l'h&#233;bergement", 'domaine-saint-joseph' ),
            'all_items' => __( 'Tous les h&#233;bergements', 'domaine-saint-joseph' ),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => [ 'slug' => 'hebergements' ],
        'supports' => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'menu_icon' => 'dashicons-building',
        'show_in_rest' => false,
        'menu_position' => 6,
    ]);

    // &#128248; Galerie &#128248;
    register_post_type( 'galerie', [
        'labels' => [
            'name' => __( 'Galerie', 'domaine-saint-joseph' ),
            'singular_name' => __( 'Photo', 'domaine-saint-joseph' ),
            'add_new' => __( 'Ajouter une photo', 'domaine-saint-joseph' ),
            'add_new_item' => __( 'Nouvelle photo', 'domaine-saint-joseph' ),
            'edit_item' => __( 'Modifier la photo', 'domaine-saint-joseph' ),
            'view_item' => __( 'Voir la photo', 'domaine-saint-joseph' ),
            'all_items' => __( 'Toutes les photos', 'domaine-saint-joseph' ),
        ],
        'public' => true,
        'has_archive' => false,
        'rewrite' => [ 'slug' => 'galerie' ],
        'supports' => [ 'title', 'thumbnail', 'excerpt' ],
        'menu_icon' => 'dashicons-format-gallery',
        'show_in_rest' => false,
        'menu_position' => 7,
    ]);

    // &#128193; Taxonomie Cat&#233;gories Galerie &#128193;
    register_taxonomy( 'categorie_galerie', 'galerie', [
        'labels' => [
            'name' => __( 'Cat&#233;gories Galerie', 'domaine-saint-joseph' ),
            'singular_name' => __( 'Cat&#233;gorie', 'domaine-saint-joseph' ),
            'add_new_item' => __( 'Ajouter une cat&#233;gorie', 'domaine-saint-joseph' ),
            'edit_item' => __( 'Modifier la cat&#233;gorie', 'domaine-saint-joseph' ),
            'all_items' => __( 'Toutes les cat&#233;gories', 'domaine-saint-joseph' ),
        ],
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => false,
        'rewrite' => [ 'slug' => 'categorie-galerie' ],
    ]);
}
add_action( 'init', 'dsj_register_cpts' );


// &#127869; Restaurant / Menu &#127869;
register_post_type( 'menu', [
    'labels' => [
        'name' => __( 'Menus Restaurant', 'domaine-saint-joseph' ),
        'singular_name' => __( 'Plat', 'domaine-saint-joseph' ),
        'add_new' => __( 'Ajouter un plat', 'domaine-saint-joseph' ),
        'add_new_item' => __( 'Nouveau plat', 'domaine-saint-joseph' ),
        'edit_item' => __( 'Modifier le plat', 'domaine-saint-joseph' ),
        'view_item' => __( 'Voir le plat', 'domaine-saint-joseph' ),
        'all_items' => __( 'Tous les plats', 'domaine-saint-joseph' ),
    ],
    'public' => true,
    'has_archive' => true,
    'rewrite' => [ 'slug' => 'menu' ],
    'supports' => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
    'menu_icon' => 'dashicons-food',
    'show_in_rest' => false,
    'menu_position' => 8,
]);

// &#128193; Taxonomie Cat&#233;gories de plats &#128193;
register_taxonomy( 'categorie_menu', 'menu', [
    'labels' => [
        'name' => __( 'Cat&#233;gories de plats', 'domaine-saint-joseph' ),
        'singular_name' => __( 'Cat&#233;gorie', 'domaine-saint-joseph' ),
        'add_new_item' => __( 'Ajouter une cat&#233;gorie', 'domaine-saint-joseph' ),
        'edit_item' => __( 'Modifier la cat&#233;gorie', 'domaine-saint-joseph' ),
        'all_items' => __( 'Toutes les cat&#233;gories', 'domaine-saint-joseph' ),
    ],
    'public' => true,
    'hierarchical' => true,
    'show_in_rest' => false,
    'rewrite' => [ 'slug' => 'categorie-menu' ],
]);

// &#128172; T&#233;moignages &#128172;
register_post_type( 'temoignage', [
    'labels' => [
        'name' => __( 'T&#233;moignages', 'domaine-saint-joseph' ),
        'singular_name' => __( 'T&#233;moignage', 'domaine-saint-joseph' ),
        'add_new' => __( 'Ajouter un t&#233;moignage', 'domaine-saint-joseph' ),
        'add_new_item' => __( 'Nouveau t&#233;moignage', 'domaine-saint-joseph' ),
        'edit_item' => __( 'Modifier le t&#233;moignage', 'domaine-saint-joseph' ),
        'view_item' => __( 'Voir le t&#233;moignage', 'domaine-saint-joseph' ),
        'all_items' => __( 'Tous les t&#233;moignages', 'domaine-saint-joseph' ),
    ],
    'public' => true,
    'has_archive' => false,
    'supports' => [ 'title', 'editor' ],
    'menu_icon' => 'dashicons-testimonial',
    'show_in_rest' => false,
    'menu_position' => 9,
]);