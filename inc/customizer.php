<?php
/**
 * Options du th&#232;me via Apparence > Personnaliser
 * Domaine Saint Joseph
 */

function dsj_customize_register( $wp_customize ) {
    
    // &#128202; SECTION : STATISTIQUES HERO &#128202;
    $wp_customize->add_section( 'dsj_stats', [
        'title'    => __( '&#128202; Statistiques Hero', 'domaine-saint-joseph' ),
        'priority' => 30,
        'description' => __( 'Modifiez les chiffres sous le bandeau principal', 'domaine-saint-joseph' ),
    ]);
    
    $stats = [
        ['id' => 'stat1_nb', 'def' => '2022', 'label' => 'Statistique 1 &#8212; Nombre'],
        ['id' => 'stat1_lbl', 'def' => 'Fond&#233; en', 'label' => 'Statistique 1 &#8212; Label'],
        ['id' => 'stat2_nb', 'def' => '3+', 'label' => 'Statistique 2 &#8212; Nombre'],
        ['id' => 'stat2_lbl', 'def' => 'Fili&#232;res', 'label' => 'Statistique 2 &#8212; Label'],
        ['id' => 'stat3_nb', 'def' => '100%', 'label' => 'Statistique 3 &#8212; Nombre'],
        ['id' => 'stat3_lbl', 'def' => 'D&#233;di&#233; aux femmes', 'label' => 'Statistique 3 &#8212; Label'],
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

    // &#128222; SECTION : CONTACT & WHATSAPP &#128222;
    $wp_customize->add_section( 'dsj_contact', [
        'title'    => __( '&#128222; Contact & WhatsApp', 'domaine-saint-joseph' ),
        'priority' => 40,
        'description' => __( 'Ces informations appara&#238;tront dans le footer et les boutons', 'domaine-saint-joseph' ),
    ]);
    
    $wp_customize->add_setting( 'whatsapp', [ 
        'default' => '22666605890', 
        'sanitize_callback' => 'sanitize_text_field' 
    ]);
    $wp_customize->add_control( 'whatsapp', [ 
        'label' => 'Num&#233;ro WhatsApp (sans +)', 
        'section' => 'dsj_contact', 
        'type' => 'text',
        'input_attrs' => [ 'placeholder' => '226XXXXXXXX' ]
    ]);
    
    $wp_customize->add_setting( 'dsj_phone', [ 
        'default' => '(+226) 20 97 28 97', 
        'sanitize_callback' => 'sanitize_text_field' 
    ]);
    $wp_customize->add_control( 'dsj_phone', [ 
        'label' => 'T&#233;l&#233;phone principal', 
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

    // &#127912; SECTION : COULEURS &#127912;
    $wp_customize->add_section( 'dsj_colors', [
        'title'    => __( '&#127912; Couleurs', 'domaine-saint-joseph' ),
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

    // &#127919; SECTION : CTA "NOUS SOUTENIR" &#127919;
    $wp_customize->add_section( 'dsj_cta', [
        'title'    => __( '&#127919; Appel &#224; l\'action', 'domaine-saint-joseph' ),
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
    // SECTION: MISSION (&#192; PROPOS)
    // ========================================
    $wp_customize->add_section( 'dsj_mission', [
        'title'    => __( '&#127919; Mission - Page &#192; propos', 'domaine-saint-joseph' ),
        'priority' => 80,
    ] );

    // Mission 1
    $wp_customize->add_setting( 'mission_1_titre', [ 'default' => 'Former', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'mission_1_titre', [ 'label' => 'Mission 1 - Titre', 'section' => 'dsj_mission', 'type' => 'text' ] );

    $wp_customize->add_setting( 'mission_1_texte', [ 'default' => 'Offrir une formation technique de qualit&#233; aux jeunes filles pour leur autonomie financi&#232;re et sociale.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
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

    $wp_customize->add_setting( 'mission_2_texte', [ 'default' => 'Procurer un lieu de repos, de ressourcement et de rencontres dans un cadre paisible et s&#233;curis&#233;.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
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

    $wp_customize->add_setting( 'mission_3_texte', [ 'default' => 'Soutenir les plus vuln&#233;rables avec compassion et bienveillance dans leurs projets de vie.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'mission_3_texte', [ 'label' => 'Mission 3 - Texte', 'section' => 'dsj_mission', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'mission_3_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mission_3_image', [
        'label' => 'Mission 3 - Image (optionnelle)',
        'section' => 'dsj_mission',
        'settings' => 'mission_3_image',
    ] ) );

    // ========================================
    // SECTION: &#201;QUIPE (&#192; PROPOS)
    // ========================================
    $wp_customize->add_section( 'dsj_equipe', [
        'title'    => __( '&#128101; &#201;quipe - Page &#192; propos', 'domaine-saint-joseph' ),
        'priority' => 81,
    ] );

    // Membre 1
    $wp_customize->add_setting( 'equipe_1_nom', [ 'default' => 'S&#339;ur Marie-Bernadette', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'equipe_1_nom', [ 'label' => 'Membre 1 - Nom', 'section' => 'dsj_equipe', 'type' => 'text' ] );

    $wp_customize->add_setting( 'equipe_1_fonction', [ 'default' => 'Sup&#233;rieure de la communaut&#233;', 'sanitize_callback' => 'sanitize_text_field' ] );
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
    $wp_customize->add_setting( 'equipe_2_nom', [ 'default' => 'S&#339;ur Th&#233;r&#232;se', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'equipe_2_nom', [ 'label' => 'Membre 2 - Nom', 'section' => 'dsj_equipe', 'type' => 'text' ] );

    $wp_customize->add_setting( 'equipe_2_fonction', [ 'default' => 'Responsable des formations', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'equipe_2_fonction', [ 'label' => 'Membre 2 - Fonction', 'section' => 'dsj_equipe', 'type' => 'text' ] );

    $wp_customize->add_setting( 'equipe_2_description', [ 'default' => 'Coordinatrice des fili&#232;res techniques et du suivi p&#233;dagogique.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'equipe_2_description', [ 'label' => 'Membre 2 - Description', 'section' => 'dsj_equipe', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'equipe_2_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'equipe_2_image', [
        'label' => 'Membre 2 - Photo (optionnelle)',
        'section' => 'dsj_equipe',
        'settings' => 'equipe_2_image',
    ] ) );

    // Membre 3
    $wp_customize->add_setting( 'equipe_3_nom', [ 'default' => 'S&#339;ur Claire', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'equipe_3_nom', [ 'label' => 'Membre 3 - Nom', 'section' => 'dsj_equipe', 'type' => 'text' ] );

    $wp_customize->add_setting( 'equipe_3_fonction', [ 'default' => 'Responsable de l\'accueil', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'equipe_3_fonction', [ 'label' => 'Membre 3 - Fonction', 'section' => 'dsj_equipe', 'type' => 'text' ] );

    $wp_customize->add_setting( 'equipe_3_description', [ 'default' => 'G&#232;re l\'h&#233;bergement et le bien-&#234;tre des h&#244;tes et r&#233;sidentes.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
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
        'title'    => __( '&#127891; Hero - Page Formation', 'domaine-saint-joseph' ),
        'priority' => 90,
        'description' => __( 'Personnalisez le bandeau de la page Formation', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_formation_badge', [ 'default' => '&#127891; Formation professionnelle', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_formation_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_formation', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_formation_titre', [ 'default' => 'Nos Formations', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_formation_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_formation', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_formation_soustitre', [ 'default' => 'Des comp&#233;tences concr&#232;tes pour l\'autonomie des jeunes filles', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_formation_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_formation', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_formation_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_formation_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_formation',
        'settings' => 'hero_formation_image',
    ] ) );

    $wp_customize->add_setting( 'hero_formation_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_formation_opacity', [
        'label' => 'Opacit&#233; du fond',
        'section' => 'dsj_hero_formation',
        'type' => 'select',
        'choices' => [
            '0.3' => 'L&#233;g&#232;re (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Tr&#232;s forte (90%)',
        ]
    ] );

    // Section Hero - Page Maison d'Accueil
    $wp_customize->add_section( 'dsj_hero_maison', [
        'title'    => __( '&#127968; Hero - Page Maison d\'Accueil', 'domaine-saint-joseph' ),
        'priority' => 91,
        'description' => __( 'Personnalisez le bandeau de la page Maison d\'Accueil', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_maison_badge', [ 'default' => '&#127968; Nos h&#233;bergements', 'sanitize_callback' => 'sanitize_text_field' ] );
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
        'label' => 'Opacit&#233; du fond',
        'section' => 'dsj_hero_maison',
        'type' => 'select',
        'choices' => [
            '0.3' => 'L&#233;g&#232;re (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Tr&#232;s forte (90%)',
        ]
    ] );

    // Section Hero - Page &#192; propos
    $wp_customize->add_section( 'dsj_hero_apropos', [
        'title'    => __( '&#128214; Hero - Page &#192; propos', 'domaine-saint-joseph' ),
        'priority' => 92,
        'description' => __( 'Personnalisez le bandeau de la page &#192; propos', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_apropos_badge', [ 'default' => '&#128214; Notre histoire', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_apropos_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_apropos', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_apropos_titre', [ 'default' => '&#192; propos de nous', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_apropos_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_apropos', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_apropos_soustitre', [ 'default' => 'Travailleuses Missionnaires de l\'Immacul&#233;e - Un engagement au service des femmes et des familles', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_apropos_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_apropos', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_apropos_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_apropos_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_apropos',
        'settings' => 'hero_apropos_image',
    ] ) );

    $wp_customize->add_setting( 'hero_apropos_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_apropos_opacity', [
        'label' => 'Opacit&#233; du fond',
        'section' => 'dsj_hero_apropos',
        'type' => 'select',
        'choices' => [
            '0.3' => 'L&#233;g&#232;re (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Tr&#232;s forte (90%)',
        ]
    ] );

    // Section Hero - Page Contact
    $wp_customize->add_section( 'dsj_hero_contact', [
        'title'    => __( '&#128222; Hero - Page Contact', 'domaine-saint-joseph' ),
        'priority' => 93,
        'description' => __( 'Personnalisez le bandeau de la page Contact', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_contact_badge', [ 'default' => '&#128222; Restons connect&#233;s', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_contact_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_contact', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_contact_titre', [ 'default' => 'Contactez-nous', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_contact_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_contact', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_contact_soustitre', [ 'default' => 'Une question ? Une demande d\'information ? Nous sommes &#224; votre &#233;coute.', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_contact_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_contact', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_contact_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_contact_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_contact',
        'settings' => 'hero_contact_image',
    ] ) );

    $wp_customize->add_setting( 'hero_contact_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_contact_opacity', [
        'label' => 'Opacit&#233; du fond',
        'section' => 'dsj_hero_contact',
        'type' => 'select',
        'choices' => [
            '0.3' => 'L&#233;g&#232;re (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Tr&#232;s forte (90%)',
        ]
    ] );

    // Section Hero - Page Galerie
    $wp_customize->add_section( 'dsj_hero_galerie', [
        'title'    => __( '&#128248; Hero - Page Galerie', 'domaine-saint-joseph' ),
        'priority' => 94,
        'description' => __( 'Personnalisez le bandeau de la page Galerie', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_galerie_badge', [ 'default' => '&#128248; Souvenirs et moments', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_galerie_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_galerie', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_galerie_titre', [ 'default' => 'Notre Galerie', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_galerie_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_galerie', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_galerie_soustitre', [ 'default' => 'D&#233;couvrez notre cadre de vie, nos formations et nos &#233;v&#233;nements en images', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_galerie_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_galerie', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_galerie_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_galerie_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_galerie',
        'settings' => 'hero_galerie_image',
    ] ) );

    $wp_customize->add_setting( 'hero_galerie_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_galerie_opacity', [
        'label' => 'Opacit&#233; du fond',
        'section' => 'dsj_hero_galerie',
        'type' => 'select',
        'choices' => [
            '0.3' => 'L&#233;g&#232;re (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Tr&#232;s forte (90%)',
        ]
    ] );

    // ========================================
    // SECTION HERO - PAGE NOUS SOUTENIR
    // ========================================
    $wp_customize->add_section( 'dsj_hero_soutenir', [
        'title'    => __( '&#128157; Hero - Page Nous soutenir', 'domaine-saint-joseph' ),
        'priority' => 95,
        'description' => __( 'Personnalisez le bandeau de la page Nous soutenir', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_soutenir_badge', [ 'default' => '&#128157; Votre soutien compte', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_soutenir_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_soutenir', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_soutenir_titre', [ 'default' => 'Soutenez Notre Mission', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_soutenir_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_soutenir', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_soutenir_soustitre', [ 'default' => 'Votre g&#233;n&#233;rosit&#233; forme une jeune fille, accueille une famille et fait vivre le charisme des Travailleuses Missionnaires', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_soutenir_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_soutenir', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_soutenir_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_soutenir_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_soutenir',
        'settings' => 'hero_soutenir_image',
    ] ) );

    $wp_customize->add_setting( 'hero_soutenir_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_soutenir_opacity', [
        'label' => 'Opacit&#233; du fond',
        'section' => 'dsj_hero_soutenir',
        'type' => 'select',
        'choices' => [
            '0.3' => 'L&#233;g&#232;re (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Tr&#232;s forte (90%)',
        ]
    ] );

    // ========================================
    // SECTION: CONTENU PAGE NOUS SOUTENIR (RENDU MODIFIABLE)
    // ========================================
    $wp_customize->add_section( 'dsj_soutenir_contenu', [
        'title'    => __( '&#128221; Contenu - Page Nous soutenir', 'domaine-saint-joseph' ),
        'priority' => 96,
        'description' => __( 'Personnalisez les textes et montants de la page Nous soutenir', 'domaine-saint-joseph' ),
    ] );

    // --- Section besoins urgents ---
    $wp_customize->add_setting( 'besoins_urgents_titre', [
        'default' => 'Besoin imm&#233;diat',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'besoins_urgents_titre', [
        'label' => __( 'Titre - Besoins urgents', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'besoins_urgents_texte', [
        'default' => 'Nous recherchons 5 ordinateurs portables pour notre laboratoire informatique.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ] );
    $wp_customize->add_control( 'besoins_urgents_texte', [
        'label' => __( 'Texte - Besoins urgents', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'textarea',
    ] );

    $wp_customize->add_setting( 'besoins_urgents_objectif', [
        'default' => '5 ordinateurs (2 collect&#233;s)',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'besoins_urgents_objectif', [
        'label' => __( 'Objectif / Progression - Besoins urgents', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'besoins_urgents_progress', [
        'default' => '40',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( 'besoins_urgents_progress', [
        'label' => __( 'Pourcentage de progression (0-100)', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'number',
        'input_attrs' => [ 'min' => 0, 'max' => 100 ],
    ] );

    // --- Section Pourquoi soutenir ---
    $wp_customize->add_setting( 'soutenir_texte_intro', [
        'default' => 'Depuis 2022, le Domaine Saint Joseph accompagne des dizaines de jeunes filles vers l\'autonomie gr&#226;ce &#224; la formation technique et offre un lieu d\'accueil bienveillant aux voyageurs et familles.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ] );
    $wp_customize->add_control( 'soutenir_texte_intro', [
        'label' => __( 'Texte d\'introduction - Pourquoi soutenir', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'textarea',
    ] );

    // --- Montants sugg&#233;r&#233;s ---
    $wp_customize->add_setting( 'montants_suggeres', [
        'default' => '5 000 F,10 000 F,25 000 F,50 000 F,Autre',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'montants_suggeres', [
        'label' => __( 'Montants sugg&#233;r&#233;s (s&#233;par&#233;s par des virgules)', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'text',
    ] );

    // --- Prix parrainage ---
    $wp_customize->add_setting( 'parrainage_prix', [
        'default' => '50 000 F CFA / mois',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'parrainage_prix', [
        'label' => __( 'Prix du parrainage', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'text',
    ] );

    // --- Texte transparence ---
    $wp_customize->add_setting( 'transparence_texte', [
        'default' => 'Chaque contribution est utilis&#233;e conform&#233;ment &#224; la mission du centre. Un re&#231;u ou un accus&#233; de r&#233;ception vous est envoy&#233;. Les rapports d\'activit&#233; annuels sont disponibles sur demande.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ] );
    $wp_customize->add_control( 'transparence_texte', [
        'label' => __( 'Texte de transparence', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'textarea',
    ] );

    // --- Message final CTA ---
    $wp_customize->add_setting( 'cta_final_titre', [
        'default' => 'Pr&#234;t &#224; faire la diff&#233;rence ?',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'cta_final_titre', [
        'label' => __( 'Titre - CTA final', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'cta_final_texte', [
        'default' => 'Votre don, petit ou grand, change des vies.',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'cta_final_texte', [
        'label' => __( 'Texte - CTA final', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'text',
    ] );

    // ========================================
    // SECTION: BANDEAU D'URGENCE (PAGE TOP BAR)
    // ========================================
    $wp_customize->add_section( 'dsj_urgence', [
        'title'    => __( '&#128680; Bandeau d\'urgence (d&#233;filant)', 'domaine-saint-joseph' ),
        'priority' => 25,
        'description' => __( 'Affichez plusieurs messages qui d&#233;filent en haut du site', 'domaine-saint-joseph' ),
    ] );

    // Activer/d&#233;sactiver le bandeau
    $wp_customize->add_setting( 'urgence_active', [
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ] );
    $wp_customize->add_control( 'urgence_active', [
        'label' => __( '&#9989; Activer le bandeau d\'urgence', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
        'type' => 'checkbox',
    ] );

    // Vitesse de d&#233;filement
    $wp_customize->add_setting( 'urgence_vitesse', [
        'default' => 'normal',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'urgence_vitesse', [
        'label' => __( 'Vitesse de d&#233;filement', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
        'type' => 'select',
        'choices' => [
            'lent' => '&#128338; Lente (20s)',
            'normal' => '&#9654; Normale (15s)',
            'rapide' => '&#128640; Rapide (10s)',
        ],
    ] );

    // Messages d&#233;filants (r&#233;p&#233;teur)
    for ( $i = 1; $i <= 5; $i++ ) {
        $wp_customize->add_setting( "urgence_message_{$i}", [
            'default' => $i === 1 ? '&#128103; Parrainez une jeune fille pour sa formation' : '',
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( "urgence_message_{$i}", [
            'label' => sprintf( __( 'Message %d', 'domaine-saint-joseph' ), $i ),
            'section' => 'dsj_urgence',
            'type' => 'text',
            'input_attrs' => [ 'placeholder' => 'Entrez votre message...' ],
        ] );
    }

    // Lien du bouton
    $wp_customize->add_setting( 'urgence_lien', [
        'default' => '/nous-soutenir',
        'sanitize_callback' => 'esc_url_raw',
    ] );
    $wp_customize->add_control( 'urgence_lien', [
        'label' => __( 'Lien du bouton', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
        'type' => 'url',
    ] );

    // Texte du bouton
    $wp_customize->add_setting( 'urgence_bouton_texte', [
        'default' => 'Je participe',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'urgence_bouton_texte', [
        'label' => __( 'Texte du bouton', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
        'type' => 'text',
    ] );

    // Couleur du bandeau
    $wp_customize->add_setting( 'urgence_couleur', [
        'default' => '#e74c3c',
        'sanitize_callback' => 'sanitize_hex_color',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'urgence_couleur', [
        'label' => __( 'Couleur du bandeau', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
    ] ) );

    // Ic&#244;ne
    $wp_customize->add_setting( 'urgence_icone', [
        'default' => '&#128680;',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'urgence_icone', [
        'label' => __( 'Ic&#244;ne (emoji)', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
        'type' => 'text',
        'input_attrs' => [ 'placeholder' => '&#128680;' ],
    ] );

    // ========================================
    // SECTION: APPEL &#192; L'AIDE (ACCUEIL)
    // ========================================
    $wp_customize->add_section( 'dsj_aide_accueil', [
        'title'    => __( '&#128157; Appel &#224; l\'aide - Page Accueil', 'domaine-saint-joseph' ),
        'priority' => 85,
        'description' => __( 'Personnalisez la section appel &#224; l\'aide (parrainage et construction)', 'domaine-saint-joseph' ),
    ] );

    // Activer/d&#233;sactiver la section
    $wp_customize->add_setting( 'aide_accueil_active', [
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ] );
    $wp_customize->add_control( 'aide_accueil_active', [
        'label' => __( '&#9989; Activer la section appel &#224; l\'aide', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'checkbox',
    ] );

    // ===== CARTE PARRAINAGE =====
    $wp_customize->add_setting( 'aide_parrainage_icone', [
        'default' => '&#128103;',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'aide_parrainage_icone', [
        'label' => __( 'Ic&#244;ne Parrainage', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'aide_parrainage_titre', [
        'default' => 'Parrainez une jeune fille',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'aide_parrainage_titre', [
        'label' => __( 'Titre Parrainage', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'aide_parrainage_texte', [
        'default' => 'Pour seulement <strong>50 000 F CFA par mois</strong>, vous offrez une formation technique compl&#232;te &#224; une jeune fille.',
        'sanitize_callback' => 'wp_kses_post',
    ] );
    $wp_customize->add_control( 'aide_parrainage_texte', [
        'label' => __( 'Texte Parrainage', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'textarea',
    ] );

    // Avantages Parrainage (r&#233;p&#233;teur)
    for ( $i = 1; $i <= 3; $i++ ) {
        $wp_customize->add_setting( "aide_parrainage_avantage_{$i}", [
            'default' => $i === 1 ? '&#9989; Formation de qualit&#233;' : ( $i === 2 ? '&#9989; Mat&#233;riel p&#233;dagogique fourni' : '&#9989; Suivi personnalis&#233;' ),
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( "aide_parrainage_avantage_{$i}", [
            'label' => sprintf( __( 'Avantage %d (Parrainage)', 'domaine-saint-joseph' ), $i ),
            'section' => 'dsj_aide_accueil',
            'type' => 'text',
        ] );
    }

    $wp_customize->add_setting( 'aide_parrainage_bouton', [
        'default' => 'Je parraine',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'aide_parrainage_bouton', [
        'label' => __( 'Texte du bouton Parrainage', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'aide_parrainage_lien', [
        'default' => '/nous-soutenir',
        'sanitize_callback' => 'esc_url_raw',
    ] );
    $wp_customize->add_control( 'aide_parrainage_lien', [
        'label' => __( 'Lien du bouton Parrainage', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'url',
    ] );

    // ===== CARTE CONSTRUCTION =====
    $wp_customize->add_setting( 'aide_construction_icone', [
        'default' => '&#128736;',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'aide_construction_icone', [
        'label' => __( 'Ic&#244;ne Construction', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'aide_construction_titre', [
        'default' => 'Construisons ensemble',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'aide_construction_titre', [
        'label' => __( 'Titre Construction', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'aide_construction_texte', [
        'default' => 'Nous avons besoin de <strong>nouvelles salles de formation</strong> pour accueillir plus de jeunes filles.',
        'sanitize_callback' => 'wp_kses_post',
    ] );
    $wp_customize->add_control( 'aide_construction_texte', [
        'label' => __( 'Texte Construction', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'textarea',
    ] );

    // Besoins Construction (r&#233;p&#233;teur)
    for ( $i = 1; $i <= 3; $i++ ) {
        $wp_customize->add_setting( "aide_construction_besoin_{$i}", [
            'default' => $i === 1 ? '&#127979; Salles de classe suppl&#233;mentaires' : ( $i === 2 ? '&#128187; Laboratoire informatique' : '&#9986; Atelier de couture agrandi' ),
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( "aide_construction_besoin_{$i}", [
            'label' => sprintf( __( 'Besoin %d (Construction)', 'domaine-saint-joseph' ), $i ),
            'section' => 'dsj_aide_accueil',
            'type' => 'text',
        ] );
    }

    $wp_customize->add_setting( 'aide_construction_bouton', [
        'default' => 'Je contribue',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'aide_construction_bouton', [
        'label' => __( 'Texte du bouton Construction', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'aide_construction_lien', [
        'default' => '/nous-soutenir',
        'sanitize_callback' => 'esc_url_raw',
    ] );
    $wp_customize->add_control( 'aide_construction_lien', [
        'label' => __( 'Lien du bouton Construction', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'url',
    ] );

    // ========================================
    // SECTION: HISTOIRE (ACCUEIL)
    // ========================================
    $wp_customize->add_section( 'dsj_histoire', [
        'title'    => __( '&#128214; Histoire - Page Accueil', 'domaine-saint-joseph' ),
        'priority' => 86,
    ] );

    $wp_customize->add_setting( 'histoire_texte', [
        'default' => 'Le Domaine Saint Joseph a &#233;t&#233; cr&#233;&#233; en <strong>2022</strong>. Ce centre est une expression du charisme des <strong>Travailleuses Missionnaires de l\'Immacul&#233;e</strong>.',
        'sanitize_callback' => 'wp_kses_post',
    ] );
    $wp_customize->add_control( 'histoire_texte', [
        'label' => __( 'Texte de la section Histoire', 'domaine-saint-joseph' ),
        'section' => 'dsj_histoire',
        'type' => 'textarea',
    ] );

    // ========================================
    // SECTION: HORAIRES RESTAURANT
    // ========================================
    $wp_customize->add_section( 'dsj_restaurant_horaires', [
        'title'    => __( '&#128339; Horaires Restaurant', 'domaine-saint-joseph' ),
        'priority' => 97,
    ] );

    $wp_customize->add_setting( 'restaurant_petitdej', [ 'default' => '7h00 - 9h30', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'restaurant_petitdej', [ 'label' => 'Petit-d&#233;jeuner', 'section' => 'dsj_restaurant_horaires', 'type' => 'text' ] );

    $wp_customize->add_setting( 'restaurant_dejeuner', [ 'default' => '12h00 - 14h30', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'restaurant_dejeuner', [ 'label' => 'D&#233;jeuner', 'section' => 'dsj_restaurant_horaires', 'type' => 'text' ] );

    $wp_customize->add_setting( 'restaurant_diner', [ 'default' => '19h00 - 21h30', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'restaurant_diner', [ 'label' => 'D&#238;ner', 'section' => 'dsj_restaurant_horaires', 'type' => 'text' ] );

    // ========================================
    // SECTION: HERO SLIDER (ACCUEIL)
    // ========================================
    $wp_customize->add_section( 'dsj_hero_slider', [
        'title'    => __( '&#127916; Hero Slider - Page Accueil', 'domaine-saint-joseph' ),
        'priority' => 5,
        'description' => __( 'Activez le slider et ajoutez jusqu\'&#224; 5 slides', 'domaine-saint-joseph' ),
    ] );

    // Activer le slider
    $wp_customize->add_setting( 'hero_slider_active', [
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ] );
    $wp_customize->add_control( 'hero_slider_active', [
        'label' => __( '&#9989; Activer le slider Hero', 'domaine-saint-joseph' ),
        'section' => 'dsj_hero_slider',
        'type' => 'checkbox',
    ] );

    // Vitesse du slider
    $wp_customize->add_setting( 'hero_slider_speed', [
        'default' => '5000',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( 'hero_slider_speed', [
        'label' => __( '&#9200; Vitesse du slider (ms)', 'domaine-saint-joseph' ),
        'section' => 'dsj_hero_slider',
        'type' => 'select',
        'choices' => [
            '3000' => 'Rapide (3s)',
            '5000' => 'Normal (5s)',
            '7000' => 'Lent (7s)',
            '10000' => 'Tr&#232;s lent (10s)',
        ],
    ] );

    // Slides (5 slides max)
    for ( $i = 1; $i <= 5; $i++ ) {
        $wp_customize->add_setting( "hero_slide_{$i}_image", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ] );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "hero_slide_{$i}_image", [
            'label'    => sprintf( __( 'Slide %d - Image', 'domaine-saint-joseph' ), $i ),
            'section'  => 'dsj_hero_slider',
        ] ) );
        
        $wp_customize->add_setting( "hero_slide_{$i}_titre", [
            'default' => $i === 1 ? 'Former les jeunes filles, accueillir avec compassion' : '',
            'sanitize_callback' => 'wp_kses_post',
        ] );
        $wp_customize->add_control( "hero_slide_{$i}_titre", [
            'label'    => sprintf( __( 'Slide %d - Titre', 'domaine-saint-joseph' ), $i ),
            'section'  => 'dsj_hero_slider',
            'type'     => 'text',
        ] );
        
        $wp_customize->add_setting( "hero_slide_{$i}_soustitre", [
            'default' => $i === 1 ? 'Centre de formation technique & Maison d\'accueil Bobo-Dioulasso, Burkina Faso &#8212; depuis 2022' : '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ] );
        $wp_customize->add_control( "hero_slide_{$i}_soustitre", [
            'label'    => sprintf( __( 'Slide %d - Sous-titre', 'domaine-saint-joseph' ), $i ),
            'section'  => 'dsj_hero_slider',
            'type'     => 'textarea',
        ] );
        
        $wp_customize->add_setting( "hero_slide_{$i}_badge", [
            'default' => $i === 1 ? '&#9962; Travailleuses Missionnaires de l\'Immacul&#233;e' : '',
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( "hero_slide_{$i}_badge", [
            'label'    => sprintf( __( 'Slide %d - Badge', 'domaine-saint-joseph' ), $i ),
            'section'  => 'dsj_hero_slider',
            'type'     => 'text',
        ] );
    }

    // ========================================
    // SECTION HERO - PAGE RESTAURANT
    // ========================================
    $wp_customize->add_section( 'dsj_hero_restaurant', [
        'title'    => __( '&#127869; Hero - Page Restaurant', 'domaine-saint-joseph' ),
        'priority' => 97,
        'description' => __( 'Personnalisez le bandeau de la page Restaurant', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_restaurant_badge', [ 'default' => '&#127869; Notre cuisine', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_restaurant_badge', [ 'label' => 'Badge', 'section' => 'dsj_hero_restaurant', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_restaurant_titre', [ 'default' => 'Restaurant', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_restaurant_titre', [ 'label' => 'Titre principal', 'section' => 'dsj_hero_restaurant', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hero_restaurant_soustitre', [ 'default' => 'D&#233;couvrez nos plats pr&#233;par&#233;s avec amour et passion', 'sanitize_callback' => 'sanitize_textarea_field' ] );
    $wp_customize->add_control( 'hero_restaurant_soustitre', [ 'label' => 'Sous-titre', 'section' => 'dsj_hero_restaurant', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hero_restaurant_image', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_restaurant_image', [
        'label' => 'Image de fond',
        'section' => 'dsj_hero_restaurant',
        'settings' => 'hero_restaurant_image',
    ] ) );

    $wp_customize->add_setting( 'hero_restaurant_opacity', [ 'default' => '0.7', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hero_restaurant_opacity', [
        'label' => 'Opacit&#233; du fond',
        'section' => 'dsj_hero_restaurant',
        'type' => 'select',
        'choices' => [
            '0.3' => 'L&#233;g&#232;re (30%)',
            '0.5' => 'Moyenne (50%)',
            '0.7' => 'Forte (70%)',
            '0.9' => 'Tr&#232;s forte (90%)',
        ]
    ] );

}
add_action( 'customize_register', 'dsj_customize_register' );

// Appliquer les couleurs personnalis&#233;es dynamiquement
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