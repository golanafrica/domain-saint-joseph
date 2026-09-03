<?php
/**
 * Options du thème via Apparence > Personnaliser
 * Domaine Saint Joseph
 * ✅ Phase A11Y : Validation contraste WCAG des couleurs Customizer
 */

/* ────────────────────────────────────────────────────────────
   HELPERS : Calcul de contraste WCAG 2.1
   ──────────────────────────────────────────────────────────── */

/**
 * Convertit un code hex (#RRGGBB) en tableau RGB.
 */
function dsj_hex_to_rgb( $hex ) {
    $hex = ltrim( $hex, '#' );
    if ( strlen( $hex ) === 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    return [
        'r' => hexdec( substr( $hex, 0, 2 ) ),
        'g' => hexdec( substr( $hex, 2, 2 ) ),
        'b' => hexdec( substr( $hex, 4, 2 ) ),
    ];
}

/**
 * Calcule la luminance relative WCAG 2.1.
 * @see https://www.w3.org/TR/WCAG21/#dfn-relative-luminance
 */
function dsj_relative_luminance( $hex ) {
    $rgb = dsj_hex_to_rgb( $hex );
    $channels = [];
    foreach ( [ 'r', 'g', 'b' ] as $c ) {
        $val = $rgb[ $c ] / 255;
        $channels[] = ( $val <= 0.03928 ) ? $val / 12.92 : pow( ( $val + 0.055 ) / 1.055, 2.4 );
    }
    return 0.2126 * $channels[0] + 0.7152 * $channels[1] + 0.0722 * $channels[2];
}

/**
 * Calcule le ratio de contraste entre 2 couleurs hex.
 * @return float Ratio entre 1 et 21
 */
function dsj_contrast_ratio( $hex1, $hex2 ) {
    $l1 = dsj_relative_luminance( $hex1 );
    $l2 = dsj_relative_luminance( $hex2 );
    $lighter = max( $l1, $l2 );
    $darker  = min( $l1, $l2 );
    return ( $lighter + 0.05 ) / ( $darker + 0.05 );
}

/**
 * Retourne un message HTML d'avertissement contraste.
 */
function dsj_contrast_warning_html() {
    $primary = get_theme_mod( 'primary_color', '#1A5276' );
    $accent  = get_theme_mod( 'accent_color', '#D4AC0D' );
    
    $ratio_btn  = dsj_contrast_ratio( $accent, $primary );
    $ratio_text = dsj_contrast_ratio( '#FFFFFF', $primary );
    
    $warnings = [];
    if ( $ratio_btn < 4.5 ) {
        $warnings[] = sprintf(
            '⚠️ Boutons : ratio %.1f:1 (minimum WCAG AA : 4.5:1)',
            $ratio_btn
        );
    }
    if ( $ratio_text < 4.5 ) {
        $warnings[] = sprintf(
            '⚠️ Texte blanc sur fond principal : ratio %.1f:1 (minimum WCAG AA : 4.5:1)',
            $ratio_text
        );
    }
    
    if ( empty( $warnings ) ) {
        return '<div id="dsj-contrast-status" style="background:#d4edda;color:#155724;padding:8px 12px;border-radius:4px;margin-top:8px;font-size:12px;border-left:3px solid #28a745;"><strong>✅ Contrastes WCAG AA valides</strong><br>Boutons : ' . number_format( $ratio_btn, 1 ) . ':1 | Texte : ' . number_format( $ratio_text, 1 ) . ':1</div>';
    }
    
    return '<div id="dsj-contrast-status" style="background:#fff3cd;color:#856404;padding:8px 12px;border-radius:4px;margin-top:8px;font-size:12px;border-left:3px solid #ffc107;"><strong>⚠️ Contraste insuffisant</strong><br>' . implode( '<br>', $warnings ) . '<br><small>Modifiez les couleurs pour garantir la lisibilité.</small></div>';
}


function dsj_customize_register( $wp_customize ) {
    
    // 📊 SECTION : STATISTIQUES HERO 📊
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

    // 📞 SECTION : CONTACT & WHATSAPP 📞
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

    // ========================================
    // ✅ SECTION : CONFIGURATION SMTP (CORRECTION 1.3)
    // ========================================
    $wp_customize->add_section( 'dsj_smtp', [
        'title'       => __( '📧 Configuration Email (SMTP)', 'domaine-saint-joseph' ),
        'priority'    => 45,
        'description' => __( 'Configurez le serveur SMTP pour garantir la réception des emails des formulaires. Laissez vide pour utiliser l\'envoi par défaut.', 'domaine-saint-joseph' ),
    ] );
    
    $wp_customize->add_setting( 'smtp_host', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'smtp_host', [
        'label'       => __( 'Hôte SMTP', 'domaine-saint-joseph' ),
        'section'     => 'dsj_smtp',
        'type'        => 'text',
        'description' => 'Ex: smtp.gmail.com, smtp.office365.com, mail.infos.bf',
    ] );
    
    $wp_customize->add_setting( 'smtp_port', [
        'default'           => 587,
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( 'smtp_port', [
        'label'       => __( 'Port SMTP', 'domaine-saint-joseph' ),
        'section'     => 'dsj_smtp',
        'type'        => 'number',
        'description' => '587 (TLS) ou 465 (SSL)',
    ] );
    
    $wp_customize->add_setting( 'smtp_user', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ] );
    $wp_customize->add_control( 'smtp_user', [
        'label'   => __( 'Utilisateur SMTP (email)', 'domaine-saint-joseph' ),
        'section' => 'dsj_smtp',
        'type'    => 'email',
    ] );
    
    $wp_customize->add_setting( 'smtp_pass', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'smtp_pass', [
        'label'       => __( 'Mot de passe SMTP', 'domaine-saint-joseph' ),
        'section'     => 'dsj_smtp',
        'type'        => 'password',
        'description' => '⚠️ Ne jamais partager ce mot de passe',
    ] );
    
    $wp_customize->add_setting( 'smtp_encryption', [
        'default'           => 'tls',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'smtp_encryption', [
        'label'   => __( 'Chiffrement', 'domaine-saint-joseph' ),
        'section' => 'dsj_smtp',
        'type'    => 'select',
        'choices' => [
            'tls' => 'TLS (recommandé - port 587)',
            'ssl' => 'SSL (port 465)',
            ''    => 'Aucun (non sécurisé)',
        ],
    ] );
    
    $wp_customize->add_setting( 'smtp_from_email', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ] );
    $wp_customize->add_control( 'smtp_from_email', [
        'label'       => __( 'Email expéditeur', 'domaine-saint-joseph' ),
        'section'     => 'dsj_smtp',
        'type'        => 'email',
        'description' => 'Laisser vide pour utiliser l\'email de contact',
    ] );
    
    $wp_customize->add_setting( 'smtp_from_name', [
        'default'           => 'Domaine Saint Joseph',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'smtp_from_name', [
        'label'   => __( 'Nom expéditeur', 'domaine-saint-joseph' ),
        'section' => 'dsj_smtp',
        'type'    => 'text',
    ] );

    // 🎨 SECTION : COULEURS 🎨
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

    // ✅ Avertissement contraste WCAG (dynamique via JS)
    $wp_customize->add_setting( 'dsj_contrast_warning', [
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dsj_contrast_warning', [
        'label'       => __( 'État des contrastes', 'domaine-saint-joseph' ),
        'section'     => 'dsj_colors',
        'type'        => 'hidden',
        'description' => dsj_contrast_warning_html(),
        'priority'    => 999,
    ] ) );

    // 🎯 SECTION : CTA "NOUS SOUTENIR" 🎯
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
    // SECTION: APPEL À L'AIDE (ACCUEIL)
    // ========================================
    $wp_customize->add_section( 'dsj_aide_accueil', [
        'title'    => __( '💝 Appel à l\'aide - Page Accueil', 'domaine-saint-joseph' ),
        'priority' => 85,
        'description' => __( 'Personnalisez la section appel à l\'aide (parrainage et construction)', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'aide_accueil_active', [
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ] );
    $wp_customize->add_control( 'aide_accueil_active', [
        'label' => __( '✅ Activer la section appel à l\'aide', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'checkbox',
    ] );

    $wp_customize->add_setting( 'aide_parrainage_icone', [
        'default' => '👧',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'aide_parrainage_icone', [
        'label' => __( 'Icône Parrainage', 'domaine-saint-joseph' ),
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
        'default' => 'Pour seulement <strong>50 000 F CFA par mois</strong>, vous offrez une formation technique complète à une jeune fille.',
        'sanitize_callback' => 'wp_kses_post',
    ] );
    $wp_customize->add_control( 'aide_parrainage_texte', [
        'label' => __( 'Texte Parrainage', 'domaine-saint-joseph' ),
        'section' => 'dsj_aide_accueil',
        'type' => 'textarea',
    ] );

    for ( $i = 1; $i <= 3; $i++ ) {
        $wp_customize->add_setting( "aide_parrainage_avantage_{$i}", [
            'default' => $i === 1 ? '✅ Formation de qualité' : ( $i === 2 ? '✅ Matériel pédagogique fourni' : '✅ Suivi personnalisé' ),
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

    $wp_customize->add_setting( 'aide_construction_icone', [
        'default' => '🛠',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'aide_construction_icone', [
        'label' => __( 'Icône Construction', 'domaine-saint-joseph' ),
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

    for ( $i = 1; $i <= 3; $i++ ) {
        $wp_customize->add_setting( "aide_construction_besoin_{$i}", [
            'default' => $i === 1 ? '🏫 Salles de classe supplémentaires' : ( $i === 2 ? '💻 Laboratoire informatique' : '⚒ Atelier de couture agrandi' ),
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
        'title'    => __( '📖 Histoire - Page Accueil', 'domaine-saint-joseph' ),
        'priority' => 86,
    ] );

    $wp_customize->add_setting( 'histoire_texte', [
        'default' => 'Le Domaine Saint Joseph a été créé en <strong>2022</strong>. Ce centre est une expression du charisme des <strong>Travailleuses Missionnaires de l\'Immaculée</strong>.',
        'sanitize_callback' => 'wp_kses_post',
    ] );
    $wp_customize->add_control( 'histoire_texte', [
        'label' => __( 'Texte de la section Histoire', 'domaine-saint-joseph' ),
        'section' => 'dsj_histoire',
        'type' => 'textarea',
    ] );

    // ========================================
    // SECTION HERO DES PAGES
    // ========================================

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

    $wp_customize->add_section( 'dsj_hero_apropos', [
        'title'    => __( '📖 Hero - Page À propos', 'domaine-saint-joseph' ),
        'priority' => 92,
        'description' => __( 'Personnalisez le bandeau de la page À propos', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_apropos_badge', [ 'default' => '📖 Notre histoire', 'sanitize_callback' => 'sanitize_text_field' ] );
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

    $wp_customize->add_section( 'dsj_hero_soutenir', [
        'title'    => __( '💝 Hero - Page Nous soutenir', 'domaine-saint-joseph' ),
        'priority' => 95,
        'description' => __( 'Personnalisez le bandeau de la page Nous soutenir', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_soutenir_badge', [ 'default' => '💝 Votre soutien compte', 'sanitize_callback' => 'sanitize_text_field' ] );
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

    $wp_customize->add_section( 'dsj_soutenir_contenu', [
        'title'    => __( '📝 Contenu - Page Nous soutenir', 'domaine-saint-joseph' ),
        'priority' => 96,
        'description' => __( 'Personnalisez les textes et montants de la page Nous soutenir', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'besoins_urgents_titre', [
        'default' => 'Besoin immédiat',
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
        'default' => '5 ordinateurs (2 collectés)',
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

    $wp_customize->add_setting( 'soutenir_texte_intro', [
        'default' => 'Depuis 2022, le Domaine Saint Joseph accompagne des dizaines de jeunes filles vers l\'autonomie grâce à la formation technique et offre un lieu d\'accueil bienveillant aux voyageurs et familles.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ] );
    $wp_customize->add_control( 'soutenir_texte_intro', [
        'label' => __( 'Texte d\'introduction - Pourquoi soutenir', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'textarea',
    ] );

    $wp_customize->add_setting( 'montants_suggeres', [
        'default' => '5 000 F,10 000 F,25 000 F,50 000 F,Autre',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'montants_suggeres', [
        'label' => __( 'Montants suggérés (séparés par des virgules)', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'parrainage_prix', [
        'default' => '50 000 F CFA / mois',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'parrainage_prix', [
        'label' => __( 'Prix du parrainage', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'transparence_texte', [
        'default' => 'Chaque contribution est utilisée conformément à la mission du centre. Un reçu ou un accusé de réception vous est envoyé. Les rapports d\'activité annuels sont disponibles sur demande.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ] );
    $wp_customize->add_control( 'transparence_texte', [
        'label' => __( 'Texte de transparence', 'domaine-saint-joseph' ),
        'section' => 'dsj_soutenir_contenu',
        'type' => 'textarea',
    ] );

    $wp_customize->add_setting( 'cta_final_titre', [
        'default' => 'Prêt à faire la différence ?',
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
    // SECTION: BANDEAU D'URGENCE
    // ========================================
    $wp_customize->add_section( 'dsj_urgence', [
        'title'    => __( '🚨 Bandeau d\'urgence (défilant)', 'domaine-saint-joseph' ),
        'priority' => 25,
        'description' => __( 'Affichez plusieurs messages qui défilent en haut du site', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'urgence_active', [
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ] );
    $wp_customize->add_control( 'urgence_active', [
        'label' => __( '✅ Activer le bandeau d\'urgence', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
        'type' => 'checkbox',
    ] );

    $wp_customize->add_setting( 'urgence_vitesse', [
        'default' => 'normal',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'urgence_vitesse', [
        'label' => __( 'Vitesse de défilement', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
        'type' => 'select',
        'choices' => [
            'lent' => '🕰 Lente (20s)',
            'normal' => '▶ Normale (15s)',
            'rapide' => '🚀 Rapide (10s)',
        ],
    ] );

    for ( $i = 1; $i <= 5; $i++ ) {
        $wp_customize->add_setting( "urgence_message_{$i}", [
            'default' => $i === 1 ? '👧 Parrainez une jeune fille pour sa formation' : '',
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( "urgence_message_{$i}", [
            'label' => sprintf( __( 'Message %d', 'domaine-saint-joseph' ), $i ),
            'section' => 'dsj_urgence',
            'type' => 'text',
            'input_attrs' => [ 'placeholder' => 'Entrez votre message...' ],
        ] );
    }

    $wp_customize->add_setting( 'urgence_lien', [
        'default' => '/nous-soutenir',
        'sanitize_callback' => 'esc_url_raw',
    ] );
    $wp_customize->add_control( 'urgence_lien', [
        'label' => __( 'Lien du bouton', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
        'type' => 'url',
    ] );

    $wp_customize->add_setting( 'urgence_bouton_texte', [
        'default' => 'Je participe',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'urgence_bouton_texte', [
        'label' => __( 'Texte du bouton', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
        'type' => 'text',
    ] );

    $wp_customize->add_setting( 'urgence_couleur', [
        'default' => '#e74c3c',
        'sanitize_callback' => 'sanitize_hex_color',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'urgence_couleur', [
        'label' => __( 'Couleur du bandeau', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
    ] ) );

    $wp_customize->add_setting( 'urgence_icone', [
        'default' => '🚨',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'urgence_icone', [
        'label' => __( 'Icône (emoji)', 'domaine-saint-joseph' ),
        'section' => 'dsj_urgence',
        'type' => 'text',
        'input_attrs' => [ 'placeholder' => '🚨' ],
    ] );

    // ========================================
    // SECTION: HORAIRES RESTAURANT
    // ========================================
    $wp_customize->add_section( 'dsj_restaurant_horaires', [
        'title'    => __( '🕐 Horaires Restaurant', 'domaine-saint-joseph' ),
        'priority' => 97,
    ] );

    $wp_customize->add_setting( 'restaurant_petitdej', [ 'default' => '7h00 - 9h30', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'restaurant_petitdej', [ 'label' => 'Petit-déjeuner', 'section' => 'dsj_restaurant_horaires', 'type' => 'text' ] );

    $wp_customize->add_setting( 'restaurant_dejeuner', [ 'default' => '12h00 - 14h30', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'restaurant_dejeuner', [ 'label' => 'Déjeuner', 'section' => 'dsj_restaurant_horaires', 'type' => 'text' ] );

    $wp_customize->add_setting( 'restaurant_diner', [ 'default' => '19h00 - 21h30', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'restaurant_diner', [ 'label' => 'Dîner', 'section' => 'dsj_restaurant_horaires', 'type' => 'text' ] );

    // ========================================
    // SECTION: HERO SLIDER (ACCUEIL)
    // ========================================
    $wp_customize->add_section( 'dsj_hero_slider', [
        'title'    => __( '🎞 Hero Slider - Page Accueil', 'domaine-saint-joseph' ),
        'priority' => 5,
        'description' => __( 'Activez le slider et ajoutez jusqu\'à 5 slides', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_slider_active', [
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ] );
    $wp_customize->add_control( 'hero_slider_active', [
        'label' => __( '✅ Activer le slider Hero', 'domaine-saint-joseph' ),
        'section' => 'dsj_hero_slider',
        'type' => 'checkbox',
    ] );

    $wp_customize->add_setting( 'hero_slider_speed', [
        'default' => '5000',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( 'hero_slider_speed', [
        'label' => __( '⏱ Vitesse du slider (ms)', 'domaine-saint-joseph' ),
        'section' => 'dsj_hero_slider',
        'type' => 'select',
        'choices' => [
            '3000' => 'Rapide (3s)',
            '5000' => 'Normal (5s)',
            '7000' => 'Lent (7s)',
            '10000' => 'Très lent (10s)',
        ],
    ] );

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
            'default' => $i === 1 ? 'Centre de formation technique & Maison d\'accueil Bobo-Dioulasso, Burkina Faso — depuis 2022' : '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ] );
        $wp_customize->add_control( "hero_slide_{$i}_soustitre", [
            'label'    => sprintf( __( 'Slide %d - Sous-titre', 'domaine-saint-joseph' ), $i ),
            'section'  => 'dsj_hero_slider',
            'type'     => 'textarea',
        ] );
        
        $wp_customize->add_setting( "hero_slide_{$i}_badge", [
            'default' => $i === 1 ? '⛪ Travailleuses Missionnaires de l\'Immaculée' : '',
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
        'title'    => __( '🍽 Hero - Page Restaurant', 'domaine-saint-joseph' ),
        'priority' => 97,
        'description' => __( 'Personnalisez le bandeau de la page Restaurant', 'domaine-saint-joseph' ),
    ] );

    $wp_customize->add_setting( 'hero_restaurant_badge', [ 'default' => '🍽 Notre cuisine', 'sanitize_callback' => 'sanitize_text_field' ] );
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

} // ✅ FIN DE LA FONCTION dsj_customize_register
add_action( 'customize_register', 'dsj_customize_register' );

// ========================================
// COULEURS DYNAMIQUES (EN DEHORS DE LA FONCTION - C'EST NORMAL)
// ========================================
function dsj_custom_colors_css() {
    $primary = get_theme_mod( 'primary_color', '#1A5276' );
    $accent = get_theme_mod( 'accent_color', '#D4AC0D' );
    ?>
    <style id="dsj-custom-colors">
        :root {
            --clr-primary: <?php echo esc_attr( $primary ); ?> !important;
            --clr-accent: <?php echo esc_attr( $accent ); ?> !important;
        }
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

// ========================================
// ✅ JavaScript pour preview en direct + calcul contraste WCAG
// ========================================
function dsj_customize_preview_js() {
    if ( ! is_customize_preview() ) {
        return;
    }
    ?>
    <script>
    /**
     * Calcul de contraste WCAG en JavaScript
     * Permet la mise à jour en temps réel dans le Customizer
     */
    function dsjHexToRgb(hex) {
        hex = hex.replace('#', '');
        if (hex.length === 3) {
            hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
        }
        return {
            r: parseInt(hex.substr(0,2), 16),
            g: parseInt(hex.substr(2,2), 16),
            b: parseInt(hex.substr(4,2), 16)
        };
    }
    
    function dsjRelativeLuminance(hex) {
        var rgb = dsjHexToRgb(hex);
        var channels = ['r','g','b'].map(function(c) {
            var v = rgb[c] / 255;
            return v <= 0.03928 ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4);
        });
        return 0.2126 * channels[0] + 0.7152 * channels[1] + 0.0722 * channels[2];
    }
    
    function dsjContrastRatio(hex1, hex2) {
        var l1 = dsjRelativeLuminance(hex1);
        var l2 = dsjRelativeLuminance(hex2);
        var lighter = Math.max(l1, l2);
        var darker = Math.min(l1, l2);
        return (lighter + 0.05) / (darker + 0.05);
    }
    
    function dsjUpdateContrastStatus(primary, accent) {
        var statusEl = document.getElementById('dsj-contrast-status');
        if (!statusEl) return;
        
        var ratioBtn = dsjContrastRatio(accent, primary);
        var ratioText = dsjContrastRatio('#FFFFFF', primary);
        
        var warnings = [];
        if (ratioBtn < 4.5) {
            warnings.push('⚠️ Boutons : ratio ' + ratioBtn.toFixed(1) + ':1 (min 4.5:1)');
        }
        if (ratioText < 4.5) {
            warnings.push('⚠️ Texte blanc sur fond : ratio ' + ratioText.toFixed(1) + ':1 (min 4.5:1)');
        }
        
        if (warnings.length === 0) {
            statusEl.style.background = '#d4edda';
            statusEl.style.color = '#155724';
            statusEl.style.borderLeft = '3px solid #28a745';
            statusEl.innerHTML = '<strong>✅ Contrastes WCAG AA valides</strong><br>' +
                'Boutons : ' + ratioBtn.toFixed(1) + ':1 | Texte : ' + ratioText.toFixed(1) + ':1';
        } else {
            statusEl.style.background = '#fff3cd';
            statusEl.style.color = '#856404';
            statusEl.style.borderLeft = '3px solid #ffc107';
            statusEl.innerHTML = '<strong>⚠️ Contraste insuffisant</strong><br>' +
                warnings.join('<br>') + '<br><small>Modifiez les couleurs pour garantir la lisibilité.</small>';
        }
    }
    
    jQuery(document).ready(function($) {
        // Preview des couleurs + mise à jour contraste
        wp.customize('primary_color', function(value) {
            value.bind(function(newval) {
                $('.site-header, .site-footer, .hero-section, .page-header, .cta-final, .stats-section').css('background-color', newval);
                $('.stat-number, .section-title h2, .valeur-card h3').css('color', newval);
                var accent = wp.customize('accent_color')();
                $('.btn-primary').css({
                    'background-color': accent,
                    'color': newval
                });
                dsjUpdateContrastStatus(newval, accent);
            });
        });
        
        wp.customize('accent_color', function(value) {
            value.bind(function(newval) {
                $('.btn-primary, button:not(.menu-toggle):not(.filter-btn), input[type="submit"]').css('background-color', newval);
                $('.btn-link, a:not(.btn):hover').css('color', newval);
                $('.btn-primary').css('background-color', newval);
                var primary = wp.customize('primary_color')();
                dsjUpdateContrastStatus(primary, newval);
            });
        });
        
        // Mise à jour initiale au chargement du Customizer
        setTimeout(function() {
            try {
                var primary = wp.customize('primary_color')();
                var accent = wp.customize('accent_color')();
                dsjUpdateContrastStatus(primary, accent);
            } catch(e) {
                console.log('Contrast check waiting...', e);
            }
        }, 500);
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'dsj_customize_preview_js' );

/* ═══════════════════════════════════════════
   SECTION MAISON D'ACCUEIL — PRÉSENTATION
   Texte + photo modifiables par les sœurs
   ═══════════════════════════════════════════ */
function dsj_customize_maison_accueil( $wp_customize ) {

	$wp_customize->add_section( 'dsj_maison_accueil', array(
		'title'       => __( 'Maison d\'Accueil — Présentation', 'domaine-saint-joseph' ),
		'description' => __( 'Texte et photo de la section « Accueil et Hébergement ».', 'domaine-saint-joseph' ),
		'priority'    => 35,
	) );

	// Titre de la section
	$wp_customize->add_setting( 'maison_accueil_titre', array(
		'default'           => 'Accueil et Hébergement',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'maison_accueil_titre', array(
		'label'   => __( 'Titre de la section', 'domaine-saint-joseph' ),
		'section' => 'dsj_maison_accueil',
		'type'    => 'text',
	) );

	// Paragraphe 1 — le cadre
	$wp_customize->add_setting( 'maison_accueil_texte1', array(
		'default'           => 'L\'accueil et l\'hébergement ont pour but de vous offrir un cadre simple, propre et paisible, propice au repos, au recueillement et à la convivialité.',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'maison_accueil_texte1', array(
		'label'   => __( 'Paragraphe 1 — Le cadre', 'domaine-saint-joseph' ),
		'section' => 'dsj_maison_accueil',
		'type'    => 'textarea',
	) );

	// Paragraphe 2 — pour qui
	$wp_customize->add_setting( 'maison_accueil_texte2', array(
		'default'           => 'Que vous soyez en déplacement, en retraite spirituelle, en session de formation, en réunion ou simplement en séjour de repos, seul, en famille ou en groupe de réflexion, nous mettons à votre disposition un environnement chaleureux favorisant votre confort et votre bien-être.',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'maison_accueil_texte2', array(
		'label'   => __( 'Paragraphe 2 — Pour qui ?', 'domaine-saint-joseph' ),
		'section' => 'dsj_maison_accueil',
		'type'    => 'textarea',
	) );

	// Paragraphe 3 — solidarité
	$wp_customize->add_setting( 'maison_accueil_texte3', array(
		'default'           => 'En choisissant de séjourner au Domaine Saint Joseph, vous participez directement à une œuvre de solidarité. Les revenus de l\'accueil et de l\'hébergement sont entièrement réinvestis dans les actions du Centre afin de soutenir la formation humaine, professionnelle et spirituelle des jeunes, en particulier des jeunes qui ne bénéficient d\'aucun soutien financier.',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'maison_accueil_texte3', array(
		'label'   => __( 'Paragraphe 3 — Œuvre de solidarité', 'domaine-saint-joseph' ),
		'section' => 'dsj_maison_accueil',
		'type'    => 'textarea',
	) );

	// Photo de la maison d'accueil
	$wp_customize->add_setting( 'maison_accueil_photo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'maison_accueil_photo', array(
		'label'       => __( 'Photo de la maison d\'accueil', 'domaine-saint-joseph' ),
		'description' => __( 'Image affichée à droite du texte (format conseillé : paysage 4:3).', 'domaine-saint-joseph' ),
		'section'     => 'dsj_maison_accueil',
	) ) );
}
add_action( 'customize_register', 'dsj_customize_maison_accueil' );