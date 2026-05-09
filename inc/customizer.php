<?php
/**
 * Options du thème via Apparence > Personnaliser
 * Domaine Saint Joseph
 */

function dsj_customize_register( $wp_customize ) {
    
    // ── SECTION : STATISTIQUES HERO ──
    $wp_customize->add_section( 'dsj_stats', [
        'title'    => __( '📊 Statistiques Hero', 'domaine-saint-joseph' ),
        'priority' => 30,
        'description' => __( 'Modifiez les chiffres sous le bandeau principal', 'domaine-saint-joseph' ),
    ]);
    
    $stats = [
        ['id' => 'stat1_nb', 'def' => '2022', 'label' => 'Statistique 1 — Nombre'],
        ['id' => 'stat1_lbl', 'def' => 'Fondé en', 'label' => 'Statistique 1 — Label'],
        ['id' => 'stat2_nb', 'def' => '3+', 'label' => 'Statistique 2 — Nombre'],
        ['id' => 'stat2_lbl', 'def' => 'Filières', 'label' => 'Statistique 2 — Label'],
        ['id' => 'stat3_nb', 'def' => '100%', 'label' => 'Statistique 3 — Nombre'],
        ['id' => 'stat3_lbl', 'def' => 'Dédié aux femmes', 'label' => 'Statistique 3 — Label'],
    ];
    
    foreach ( $stats as $s ) {
        $wp_customize->add_setting( $s['id'], [ 
            'default' => $s['def'], 
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
        ]);
        $wp_customize->add_control( $s['id'], [ 
            'label' => $s['label'], 
            'section' => 'dsj_stats', 
            'type' => 'text' 
        ]);
    }

    // ── SECTION : CONTACT & WHATSAPP ──
    $wp_customize->add_section( 'dsj_contact', [
        'title'    => __( '📞 Contact & WhatsApp', 'domaine-saint-joseph' ),
        'priority' => 40,
        'description' => __( 'Ces informations apparaîtront dans le footer et les boutons', 'domaine-saint-joseph' ),
    ]);
    
    $wp_customize->add_setting( 'whatsapp', [ 
        'default' => '22666605890', 
        'sanitize_callback' => 'sanitize_text_field' 
    ]);
    $wp_customize->add_control( 'whatsapp', [ 
        'label' => 'Numéro WhatsApp (sans +)', 
        'section' => 'dsj_contact', 
        'type' => 'text',
        'input_attrs' => [ 'placeholder' => '226XXXXXXXX' ]
    ]);
    
    $wp_customize->add_setting( 'dsj_phone', [ 
        'default' => '(+226) 20 97 28 97', 
        'sanitize_callback' => 'sanitize_text_field' 
    ]);
    $wp_customize->add_control( 'dsj_phone', [ 
        'label' => 'Téléphone principal', 
        'section' => 'dsj_contact', 
        'type' => 'tel' 
    ]);

    $wp_customize->add_setting( 'dsj_email', [ 
        'default' => 'centredsj@gmail.com', 
        'sanitize_callback' => 'sanitize_email' 
    ]);
    $wp_customize->add_control( 'dsj_email', [ 
        'label' => 'Email de contact', 
        'section' => 'dsj_contact', 
        'type' => 'email' 
    ]);

    // ── SECTION : COULEURS ──
    $wp_customize->add_section( 'dsj_colors', [
        'title'    => __( '🎨 Couleurs', 'domaine-saint-joseph' ),
        'priority' => 50,
        'description' => __( 'Personnalisez les couleurs du site', 'domaine-saint-joseph' ),
    ]);
    
    $wp_customize->add_setting( 'primary_color', [ 
        'default' => '#1A5276', 
        'sanitize_callback' => 'sanitize_hex_color', 
        'transport' => 'postMessage' 
    ]);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', [ 
        'label' => __( 'Couleur principale (bleu)', 'domaine-saint-joseph' ), 
        'section' => 'dsj_colors' 
    ]));
    
    $wp_customize->add_setting( 'accent_color', [ 
        'default' => '#D4AC0D', 
        'sanitize_callback' => 'sanitize_hex_color', 
        'transport' => 'postMessage' 
    ]);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', [ 
        'label' => __( 'Couleur d\'accent (or)', 'domaine-saint-joseph' ), 
        'section' => 'dsj_colors' 
    ]));

    // ── SECTION : CTA "NOUS SOUTENIR" ──
    $wp_customize->add_section( 'dsj_cta', [
        'title'    => __( '🎯 Appel à l\'action', 'domaine-saint-joseph' ),
        'priority' => 60,
    ]);
    
    $wp_customize->add_setting( 'cta_title', [ 
        'default' => 'Soutenez notre mission', 
        'sanitize_callback' => 'sanitize_text_field' 
    ]);
    $wp_customize->add_control( 'cta_title', [ 
        'label' => 'Titre du CTA', 
        'section' => 'dsj_cta', 
        'type' => 'text' 
    ]);
    
    $wp_customize->add_setting( 'cta_text', [ 
        'default' => 'Votre contribution permet de former les leaders de demain. Parrainez une jeune fille ou faites un don pour soutenir le Domaine Saint Joseph.', 
        'sanitize_callback' => 'sanitize_textarea_field' 
    ]);
    $wp_customize->add_control( 'cta_text', [ 
        'label' => 'Texte du CTA', 
        'section' => 'dsj_cta', 
        'type' => 'textarea' 
    ]);
    
    $wp_customize->add_setting( 'cta_button_url', [ 
        'default' => '/nous-soutenir', 
        'sanitize_callback' => 'esc_url_raw' 
    ]);
    $wp_customize->add_control( 'cta_button_url', [ 
        'label' => 'Lien du bouton', 
        'section' => 'dsj_cta', 
        'type' => 'url' 
    ]);

    // ========================================
    // SECTION: MISSION (À PROPOS)
    // ========================================
    $wp_customize->add_section( 'dsj_mission', [
        'title'    => __( '🎯 Mission - Page À propos', 'domaine-saint-joseph' ),
        'priority' => 80,
    ] );

    // Mission 1
    $wp_customize->add_setting( 'mission_1_titre', [ 'default' => 'Former', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'mission_1_titre', [ 'label' => 'Mission 1 - Titre', 'section' => 'dsj_mission', 'type' => 'text' ] );

    $wp_customize->add_setting( 'mission_1_texte', [ 'default' => 'Offrir une formation technique de qualité aux jeunes filles pour leur autonomie financière et sociale.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'mission_1_texte', [ 'label' => 'Mission 1 - Texte', 'section' => 'dsj_mission', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'mission_1_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mission_1_image', [
        'label' => 'Mission 1 - Image (optionnelle)',
        'section' => 'dsj_mission',
        'settings' => 'mission_1_image',
    ] ) );

    // Mission 2
    $wp_customize->add_setting( 'mission_2_titre', [ 'default' => 'Accueillir', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'mission_2_titre', [ 'label' => 'Mission 2 - Titre', 'section' => 'dsj_mission', 'type' => 'text' ] );

    $wp_customize->add_setting( 'mission_2_texte', [ 'default' => 'Procurer un lieu de repos, de ressourcement et de rencontres dans un cadre paisible et sécurisé.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'mission_2_texte', [ 'label' => 'Mission 2 - Texte', 'section' => 'dsj_mission', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'mission_2_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mission_2_image', [
        'label' => 'Mission 2 - Image (optionnelle)',
        'section' => 'dsj_mission',
        'settings' => 'mission_2_image',
    ] ) );

    // Mission 3
    $wp_customize->add_setting( 'mission_3_titre', [ 'default' => 'Accompagner', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'mission_3_titre', [ 'label' => 'Mission 3 - Titre', 'section' => 'dsj_mission', 'type' => 'text' ] );

    $wp_customize->add_setting( 'mission_3_texte', [ 'default' => 'Soutenir les plus vulnérables avec compassion et bienveillance dans leurs projets de vie.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'mission_3_texte', [ 'label' => 'Mission 3 - Texte', 'section' => 'dsj_mission', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'mission_3_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mission_3_image', [
        'label' => 'Mission 3 - Image (optionnelle)',
        'section' => 'dsj_mission',
        'settings' => 'mission_3_image',
    ] ) );

    // ========================================
    // SECTION: ÉQUIPE (À PROPOS)
    // ========================================
    $wp_customize->add_section( 'dsj_equipe', [
        'title'    => __( '👥 Équipe - Page À propos', 'domaine-saint-joseph' ),
        'priority' => 81,
    ] );

    // Membre 1
    $wp_customize->add_setting( 'equipe_1_nom', [ 'default' => 'Sœur Marie-Bernadette', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'equipe_1_nom', [ 'label' => 'Membre 1 - Nom', 'section' => 'dsj_equipe', 'type' => 'text' ] );

    $wp_customize->add_setting( 'equipe_1_fonction', [ 'default' => 'Supérieure de la communauté', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'equipe_1_fonction', [ 'label' => 'Membre 1 - Fonction', 'section' => 'dsj_equipe', 'type' => 'text' ] );

    $wp_customize->add_setting( 'equipe_1_description', [ 'default' => 'Responsable du Domaine Saint Joseph et de l\'orientation pastorale.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'equipe_1_description', [ 'label' => 'Membre 1 - Description', 'section' => 'dsj_equipe', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'equipe_1_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'equipe_1_image', [
        'label' => 'Membre 1 - Photo (optionnelle)',
        'section' => 'dsj_equipe',
        'settings' => 'equipe_1_image',
    ] ) );

    // Membre 2
    $wp_customize->add_setting( 'equipe_2_nom', [ 'default' => 'Sœur Thérèse', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'equipe_2_nom', [ 'label' => 'Membre 2 - Nom', 'section' => 'dsj_equipe', 'type' => 'text' ] );

    $wp_customize->add_setting( 'equipe_2_fonction', [ 'default' => 'Responsable des formations', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'equipe_2_fonction', [ 'label' => 'Membre 2 - Fonction', 'section' => 'dsj_equipe', 'type' => 'text' ] );

    $wp_customize->add_setting( 'equipe_2_description', [ 'default' => 'Coordinatrice des filières techniques et du suivi pédagogique.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'equipe_2_description', [ 'label' => 'Membre 2 - Description', 'section' => 'dsj_equipe', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'equipe_2_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'equipe_2_image', [
        'label' => 'Membre 2 - Photo (optionnelle)',
        'section' => 'dsj_equipe',
        'settings' => 'equipe_2_image',
    ] ) );

    // Membre 3
    $wp_customize->add_setting( 'equipe_3_nom', [ 'default' => 'Sœur Claire', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'equipe_3_nom', [ 'label' => 'Membre 3 - Nom', 'section' => 'dsj_equipe', 'type' => 'text' ] );

    $wp_customize->add_setting( 'equipe_3_fonction', [ 'default' => 'Responsable de l\'accueil', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'equipe_3_fonction', [ 'label' => 'Membre 3 - Fonction', 'section' => 'dsj_equipe', 'type' => 'text' ] );

    $wp_customize->add_setting( 'equipe_3_description', [ 'default' => 'Gère l\'hébergement et le bien-être des hôtes et résidentes.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'equipe_3_description', [ 'label' => 'Membre 3 - Description', 'section' => 'dsj_equipe', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'equipe_3_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'equipe_3_image', [
        'label' => 'Membre 3 - Photo (optionnelle)',
        'section' => 'dsj_equipe',
        'settings' => 'equipe_3_image',
    ] ) );

    // ========================================
    // SECTION: HERO DES PAGES
    // ========================================

    // Section Hero - Page Formation
    $wp_customize->add_section( 'dsj_hero_formation', [
        'title'    => __( '🎓 Hero - Page Formation', 'domaine-saint-joseph' ),
        'priority' => 90,
        'description' => __( 'Personnalisez le bandeau de la page Formation', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_formation_badge', [ 'default' => '🎓 Formation professionnelle', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_formation_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_formation', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_formation_titre', [ 'default' => 'Nos Formations', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_formation_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_formation', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_formation_soustitre', [ 'default' => 'Des compétences concrètes pour l\'autonomie des jeunes filles', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_formation_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_formation', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_formation_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_formation_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_formation',
        'settings' => 'hero_formation_image',
    ] ) );

    $wp_customize->add_setting( 'hero_formation_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_formation_opacity', [
        'label' => 'Opacité du fond',
        'section' => 'dsj_hero_formation',
        'type' => 'select',
        'choices' => [
            '0.3' => 'Légère (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Très forte (90%)',
        ]
    ] );

    // Section Hero - Page Maison d'Accueil
    $wp_customize->add_section( 'dsj_hero_maison', [
        'title'    => __( '🏠 Hero - Page Maison d\'Accueil', 'domaine-saint-joseph' ),
        'priority' => 91,
        'description' => __( 'Personnalisez le bandeau de la page Maison d\'Accueil', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_maison_badge', [ 'default' => '🏠 Nos hébergements', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_maison_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_maison', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_maison_titre', [ 'default' => 'Maison d\'Accueil', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_maison_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_maison', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_maison_soustitre', [ 'default' => 'Un lieu de repos, de ressourcement et de rencontres', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_maison_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_maison', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_maison_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_maison_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_maison',
        'settings' => 'hero_maison_image',
    ] ) );

    $wp_customize->add_setting( 'hero_maison_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_maison_opacity', [
        'label' => 'Opacité du fond',
        'section' => 'dsj_hero_maison',
        'type' => 'select',
        'choices' => [
            '0.3' => 'Légère (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Très forte (90%)',
        ]
    ] );

    // Section Hero - Page À propos
    $wp_customize->add_section( 'dsj_hero_apropos', [
        'title'    => __( '🙏 Hero - Page À propos', 'domaine-saint-joseph' ),
        'priority' => 92,
        'description' => __( 'Personnalisez le bandeau de la page À propos', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_apropos_badge', [ 'default' => '🙏 Notre histoire', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_apropos_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_apropos', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_apropos_titre', [ 'default' => 'À propos de nous', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_apropos_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_apropos', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_apropos_soustitre', [ 'default' => 'Travailleuses Missionnaires de l\'Immaculée - Un engagement au service des femmes et des familles', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_apropos_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_apropos', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_apropos_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_apropos_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_apropos',
        'settings' => 'hero_apropos_image',
    ] ) );

    $wp_customize->add_setting( 'hero_apropos_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_apropos_opacity', [
        'label' => 'Opacité du fond',
        'section' => 'dsj_hero_apropos',
        'type' => 'select',
        'choices' => [
            '0.3' => 'Légère (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Très forte (90%)',
        ]
    ] );

    // Section Hero - Page Contact
    $wp_customize->add_section( 'dsj_hero_contact', [
        'title'    => __( '📞 Hero - Page Contact', 'domaine-saint-joseph' ),
        'priority' => 93,
        'description' => __( 'Personnalisez le bandeau de la page Contact', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_contact_badge', [ 'default' => '📞 Restons connectés', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_contact_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_contact', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_contact_titre', [ 'default' => 'Contactez-nous', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_contact_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_contact', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_contact_soustitre', [ 'default' => 'Une question ? Une demande d\'information ? Nous sommes à votre écoute.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_contact_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_contact', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_contact_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_contact_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_contact',
        'settings' => 'hero_contact_image',
    ] ) );

    $wp_customize->add_setting( 'hero_contact_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_contact_opacity', [
        'label' => 'Opacité du fond',
        'section' => 'dsj_hero_contact',
        'type' => 'select',
        'choices' => [
            '0.3' => 'Légère (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Très forte (90%)',
        ]
    ] );

    // Section Hero - Page Galerie
    $wp_customize->add_section( 'dsj_hero_galerie', [
        'title'    => __( '📸 Hero - Page Galerie', 'domaine-saint-joseph' ),
        'priority' => 94,
        'description' => __( 'Personnalisez le bandeau de la page Galerie', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_galerie_badge', [ 'default' => '📸 Souvenirs et moments', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_galerie_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_galerie', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_galerie_titre', [ 'default' => 'Notre Galerie', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_galerie_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_galerie', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_galerie_soustitre', [ 'default' => 'Découvrez notre cadre de vie, nos formations et nos événements en images', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_galerie_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_galerie', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_galerie_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_galerie_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_galerie',
        'settings' => 'hero_galerie_image',
    ] ) );

    $wp_customize->add_setting( 'hero_galerie_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_galerie_opacity', [
        'label' => 'Opacité du fond',
        'section' => 'dsj_hero_galerie',
        'type' => 'select',
        'choices' => [
            '0.3' => 'Légère (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Très forte (90%)',
        ]
    ] );

    // ========================================
    // SECTION HERO - PAGE NOUS SOUTENIR
    // ========================================
    $wp_customize->add_section( 'dsj_hero_soutenir', [
        'title'    => __( '🤝 Hero - Page Nous soutenir', 'domaine-saint-joseph' ),
        'priority' => 95,
        'description' => __( 'Personnalisez le bandeau de la page Nous soutenir', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_soutenir_badge', [ 'default' => '🤝 Votre soutien compte', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_soutenir_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_soutenir', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_soutenir_titre', [ 'default' => 'Soutenez Notre Mission', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_soutenir_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_soutenir', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_soutenir_soustitre', [ 'default' => 'Votre générosité forme une jeune fille, accueille une famille et fait vivre le charisme des Travailleuses Missionnaires', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_soutenir_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_soutenir', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_soutenir_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_soutenir_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_soutenir',
        'settings' => 'hero_soutenir_image',
    ] ) );

    $wp_customize->add_setting( 'hero_soutenir_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_soutenir_opacity', [
        'label' => 'Opacité du fond',
        'section' => 'dsj_hero_soutenir',
        'type' => 'select',
        'choices' => [
            '0.3' => 'Légère (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Très forte (90%)',
        ]
    ] );

    // ========================================
    // SECTION HERO - PAGE RESTAURANT (NOUVEAU)
    // ========================================
    $wp_customize->add_section( 'dsj_hero_restaurant', [
        'title'    => __( '🍽️ Hero - Page Restaurant', 'domaine-saint-joseph' ),
        'priority' => 96,
        'description' => __( 'Personnalisez le bandeau de la page Restaurant', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_restaurant_badge', [ 'default' => '🍽️ Notre cuisine', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_restaurant_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_restaurant', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_restaurant_titre', [ 'default' => 'Restaurant', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_restaurant_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_restaurant', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_restaurant_soustitre', [ 'default' => 'Découvrez nos plats préparés avec amour et passion', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_restaurant_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_restaurant', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_restaurant_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_restaurant_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_restaurant',
        'settings' => 'hero_restaurant_image',
    ] ) );

    $wp_customize->add_setting( 'hero_restaurant_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_restaurant_opacity', [
        'label' => 'Opacité du fond',
        'section' => 'dsj_hero_restaurant',
        'type' => 'select',
        'choices' => [
            '0.3' => 'Légère (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Très forte (90%)',
        ]
    ] );

}
add_action( 'customize_register', 'dsj_customize_register' );

// Appliquer les couleurs personnalisées dynamiquement
function dsj_custom_colors_css() {
    $primary = get_theme_mod( 'primary_color', '#1A5276' );
    $accent = get_theme_mod( 'accent_color', '#D4AC0D' );
    ?>
    <style>
        :root {
            --clr-primary: <?php echo esc_attr( $primary ); ?>;
            --clr-accent: <?php echo esc_attr( $accent ); ?>;
        }
        /* Application automatique des couleurs */
        .site-header,
        .site-footer,
        .hero-section,
        .page-header,
        .cta-final,
        .stats-section {
            background-color: var(--clr-primary);
        }
        .btn-primary,
        button:not(.menu-toggle):not(.filter-btn),
        input[type="submit"] {
            background-color: var(--clr-accent);
            color: var(--clr-primary);
        }
        .btn-primary:hover {
            background-color: var(--clr-primary);
            color: white;
        }
        .stat-number,
        .section-title h2,
        .valeur-card h3 {
            color: var(--clr-primary);
        }
        .btn-link,
        a:not(.btn):hover {
            color: var(--clr-accent);
        }
    </style>
    <?php
}
add_action( 'wp_head', 'dsj_custom_colors_css' );

// JavaScript pour preview en direct dans le customizer
function dsj_customize_preview_js() {
    if ( ! is_customize_preview() ) {
        return;
    }
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Preview de la couleur principale
        wp.customize('primary_color', function(value) {
            value.bind(function(newval) {
                $('.site-header, .site-footer, .hero-section, .page-header, .cta-final, .stats-section').css('background-color', newval);
                $('.stat-number, .section-title h2, .valeur-card h3').css('color', newval);
                $('.btn-primary').css({
                    'background-color': wp.customize('accent_color')(),
                    'color': newval
                });
            });
        });
        
        // Preview de la couleur d'accent
        wp.customize('accent_color', function(value) {
            value.bind(function(newval) {
                $('.btn-primary, button:not(.menu-toggle):not(.filter-btn), input[type="submit"]').css('background-color', newval);
                $('.btn-link, a:not(.btn):hover').css('color', newval);
                $('.btn-primary').css('background-color', newval);
            });
        });
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'dsj_customize_preview_js' );