<?php
/**
 * Custom Post Types — Formations, Hébergements, Galerie
 * Domaine Saint Joseph
 */

function dsj_register_cpts() {
    
    // ── Formations ──
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

    // ── Hébergements ──
    register_post_type( 'hebergement', [
        'labels' => [
            'name' => __( 'Hébergements', 'domaine-saint-joseph' ),
            'singular_name' => __( 'Hébergement', 'domaine-saint-joseph' ),
            'add_new' => __( 'Ajouter un hébergement', 'domaine-saint-joseph' ),
            'add_new_item' => __( 'Nouvel hébergement', 'domaine-saint-joseph' ),
            'edit_item' => __( "Modifier l'hébergement", 'domaine-saint-joseph' ),
            'view_item' => __( "Voir l'hébergement", 'domaine-saint-joseph' ),
            'all_items' => __( 'Tous les hébergements', 'domaine-saint-joseph' ),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => [ 'slug' => 'hebergements' ],
        'supports' => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'menu_icon' => 'dashicons-building',
        'show_in_rest' => false,
        'menu_position' => 6,
    ]);

    // ── Galerie ──
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

    // ── Taxonomie Catégories Galerie ──
    register_taxonomy( 'categorie_galerie', 'galerie', [
        'labels' => [
            'name' => __( 'Catégories Galerie', 'domaine-saint-joseph' ),
            'singular_name' => __( 'Catégorie', 'domaine-saint-joseph' ),
            'add_new_item' => __( 'Ajouter une catégorie', 'domaine-saint-joseph' ),
            'edit_item' => __( 'Modifier la catégorie', 'domaine-saint-joseph' ),
            'all_items' => __( 'Toutes les catégories', 'domaine-saint-joseph' ),
        ],
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => false,
        'rewrite' => [ 'slug' => 'categorie-galerie' ],
    ]);
}
add_action( 'init', 'dsj_register_cpts' );


// ── Restaurant / Menu ──
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

// ── Taxonomie Catégories de plats ──
register_taxonomy( 'categorie_menu', 'menu', [
    'labels' => [
        'name' => __( 'Catégories de plats', 'domaine-saint-joseph' ),
        'singular_name' => __( 'Catégorie', 'domaine-saint-joseph' ),
        'add_new_item' => __( 'Ajouter une catégorie', 'domaine-saint-joseph' ),
        'edit_item' => __( 'Modifier la catégorie', 'domaine-saint-joseph' ),
        'all_items' => __( 'Toutes les catégories', 'domaine-saint-joseph' ),
    ],
    'public' => true,
    'hierarchical' => true,
    'show_in_rest' => false,
    'rewrite' => [ 'slug' => 'categorie-menu' ],
]);

// ── Témoignages ──
register_post_type( 'temoignage', [
    'labels' => [
        'name' => __( 'Témoignages', 'domaine-saint-joseph' ),
        'singular_name' => __( 'Témoignage', 'domaine-saint-joseph' ),
        'add_new' => __( 'Ajouter un témoignage', 'domaine-saint-joseph' ),
        'add_new_item' => __( 'Nouveau témoignage', 'domaine-saint-joseph' ),
        'edit_item' => __( 'Modifier le témoignage', 'domaine-saint-joseph' ),
        'view_item' => __( 'Voir le témoignage', 'domaine-saint-joseph' ),
        'all_items' => __( 'Tous les témoignages', 'domaine-saint-joseph' ),
    ],
    'public' => true,
    'has_archive' => false,
    'supports' => [ 'title', 'editor' ],
    'menu_icon' => 'dashicons-testimonial',
    'show_in_rest' => false,
    'menu_position' => 9,
]);