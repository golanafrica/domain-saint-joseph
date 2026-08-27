<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="<?php echo esc_attr( get_theme_mod( 'primary_color', '#1A5276' ) ); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="author" content="Domaine Saint Joseph">
    
    <?php
    // ✅ SEO : meta description, OG, Twitter, preload LCP
    // Tout est géré par les hooks dans functions.php (wp_head)
    // → Pas de doublons, une seule source de vérité
    ?>
    
    <?php wp_head(); ?>
    
    <!-- ========================================
         CRITICAL CSS INLINE (performance)
         Styles minimums pour le rendu immédiat
         avant le chargement des 12 fichiers CSS
    ======================================== -->
    <style id="critical-css">
        /* Reset et base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #FDFEFE; color: #2C3E50; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        
        /* Variables */
        :root { --clr-primary: #1A5276; --clr-accent: #D4AC0D; }
        
        /* Header sticky */
        .site-header { background: var(--clr-primary, #1A5276); position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header-inner { display: flex; align-items: center; justify-content: space-between; padding: 0.8rem 0; gap: 1rem; }
        
        /* Logo */
        .site-logo { flex-shrink: 0; }
        .site-logo img { max-height: 60px; width: auto; transition: all 0.3s ease; }
        
        /* Menu desktop */
        .nav-menu { display: flex; list-style: none; gap: 2rem; margin: 0; padding: 0; }
        .nav-menu a { color: white; text-decoration: none; font-weight: 500; transition: color 0.3s; position: relative; }
        .nav-menu a:hover { color: var(--clr-accent, #D4AC0D); }
        .nav-menu a::after { content: ''; position: absolute; bottom: -5px; left: 0; width: 0; height: 2px; background: var(--clr-accent, #D4AC0D); transition: width 0.3s ease; }
        .nav-menu a:hover::after, .nav-menu .current-menu-item a::after { width: 100%; }
        
        /* ✅ Bouton WhatsApp - Contraste WCAG corrigé (vert foncé au lieu de blanc) */
        .site-header .btn-whatsapp {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            background: #25D366 !important;
            color: #06341F !important; /* ✅ Contraste 8.5:1 (WCAG AAA) */
            padding: 8px 16px !important;
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            border-radius: 50px !important;
            text-decoration: none !important;
            transition: all 0.3s ease !important;
            border: none !important;
            cursor: pointer !important;
            flex-shrink: 0 !important;
        }
        .site-header .btn-whatsapp:hover { 
            background: #128C7E !important; 
            color: white !important;
            transform: translateY(-2px) !important; 
        }
        .site-header .btn-whatsapp-icon { font-size: 1rem !important; }
        .site-header .btn-whatsapp-text { display: inline-block !important; font-size: 0.85rem !important; }
        
        /* Menu burger */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            width: 44px;
            height: 44px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        .menu-toggle span { display: block; width: 25px; height: 2px; background: white; transition: 0.3s; }
        
        /* Skip link */
        .skip-link { position: absolute; left: -9999px; top: auto; width: 1px; height: 1px; overflow: hidden; }
        .skip-link:focus { position: fixed; top: 20px; left: 20px; width: auto; height: auto; background: white; color: #1A5276; padding: 10px 20px; border-radius: 5px; z-index: 10000; }
        
        /* Scroll progress */
        .scroll-progress { position: fixed; top: 0; left: 0; width: 0%; height: 3px; background: var(--clr-accent, #D4AC0D); z-index: 1001; transition: width 0.1s ease; }
        
        /* Flash info */
        .flash-info-banner { position: relative; padding: 8px 0; color: white; z-index: 1001; overflow: hidden; }
        .flash-info-content { display: flex; align-items: center; gap: 12px; max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        .flash-info-label { background: rgba(0,0,0,0.55); padding: 4px 10px; border-radius: 4px; font-weight: 700; font-size: 0.7rem; white-space: nowrap; }
        .marquee-wrapper { flex: 1; overflow: hidden; }
        .marquee-track { display: flex; gap: 40px; white-space: nowrap; animation: marqueeScroll 20s linear infinite; }
        .marquee-message { display: inline-flex; align-items: center; padding: 0 20px; font-size: 0.9rem; font-weight: 500; color: white; }
        @keyframes marqueeScroll { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }
        .flash-info-button { background: rgba(255,255,255,0.25); color: white; padding: 5px 14px; border-radius: 50px; font-weight: 600; text-decoration: none; font-size: 0.8rem; }
        .flash-info-close { background: rgba(0,0,0,0.2); border: none; color: white; width: 24px; height: 24px; border-radius: 50%; cursor: pointer; }
        
        /* ========================================
           MENU MOBILE - VERSION FLUIDE
        ======================================== */
        @media (max-width: 768px) {
            .menu-toggle { display: flex !important; }
            .site-nav { position: absolute; top: 100%; left: 0; right: 0; background: var(--clr-primary, #1A5276); z-index: 999; }
            
            .nav-menu { 
                display: flex !important; 
                flex-direction: column !important; 
                padding: 0 !important; 
                background: var(--clr-primary, #1A5276) !important; 
                box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important; 
                max-height: 0;
                overflow: hidden;
                opacity: 0;
                transform: translateY(-20px);
                transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), 
                            opacity 0.3s ease, 
                            transform 0.3s ease,
                            visibility 0.3s ease;
                pointer-events: none;
                visibility: hidden;
            }
            
            .nav-menu.is-open { 
                max-height: 80vh;
                overflow-y: auto;
                opacity: 1; 
                transform: translateY(0); 
                padding: 1rem !important;
                pointer-events: auto;
                visibility: visible;
            }
            
            .nav-menu li { 
                border-bottom: 1px solid rgba(255,255,255,0.1); 
                opacity: 0; 
                transform: translateX(-15px); 
                transition: opacity 0.3s ease, transform 0.3s ease; 
            }
            
            .nav-menu.is-open li { opacity: 1; transform: translateX(0); }
            .nav-menu.is-open li:nth-child(1) { transition-delay: 0.05s; }
            .nav-menu.is-open li:nth-child(2) { transition-delay: 0.1s; }
            .nav-menu.is-open li:nth-child(3) { transition-delay: 0.15s; }
            .nav-menu.is-open li:nth-child(4) { transition-delay: 0.2s; }
            .nav-menu.is-open li:nth-child(5) { transition-delay: 0.25s; }
            .nav-menu.is-open li:nth-child(6) { transition-delay: 0.3s; }
            .nav-menu.is-open li:nth-child(7) { transition-delay: 0.35s; }
            .nav-menu.is-open li:nth-child(8) { transition-delay: 0.4s; }
            
            .nav-menu a { display: block; padding: 12px 0; transition: background 0.2s ease; }
            .nav-menu a:active { background: rgba(255,255,255,0.1); }
            .nav-menu a::after { display: none; }
            
            .site-header .btn-whatsapp { padding: 6px 12px !important; gap: 5px !important; }
            .site-header .btn-whatsapp-icon { font-size: 0.85rem !important; }
            .site-header .btn-whatsapp-text { font-size: 0.7rem !important; }
            
            .top-bar-content { justify-content: center; gap: 1rem; }
            .site-logo img { max-height: 45px; }
            .flash-info-button { display: none; }
        }
        
        @media (max-width: 480px) {
            .site-logo img { max-height: 40px; }
            .site-header .btn-whatsapp { padding: 5px 10px !important; }
            .site-header .btn-whatsapp-text { font-size: 0.65rem !important; }
            .marquee-message { font-size: 0.75rem; padding: 0 10px; }
        }
        
        /* Animation menu burger */
        .menu-toggle.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .menu-toggle.active span:nth-child(2) { opacity: 0; transform: scale(0); }
        .menu-toggle.active span:nth-child(3) { transform: rotate(-45deg) translate(7px, -6px); }
    </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ===== BANDEAU FLASH INFO ===== -->
<?php if ( get_theme_mod( 'urgence_active', false ) ) : 
    $urgence_lien     = get_theme_mod( 'urgence_lien', '/nous-soutenir' );
    $urgence_bouton   = get_theme_mod( 'urgence_bouton_texte', 'Je participe' );
    $urgence_couleur  = get_theme_mod( 'urgence_couleur', '#e74c3c' );
    $urgence_icone    = get_theme_mod( 'urgence_icone', '&#128680;' );
    $urgence_vitesse  = get_theme_mod( 'urgence_vitesse', 'normal' );
    
    $messages = [];
    for ( $i = 1; $i <= 5; $i++ ) {
        $msg = get_theme_mod( "urgence_message_{$i}", '' );
        if ( ! empty( $msg ) ) {
            $messages[] = $msg;
        }
    }
    
    if ( empty( $messages ) ) {
        $messages = [
            '&#127891; Nouvelle formation en informatique - inscriptions ouvertes !',
            '&#128736; Appel aux dons pour la construction de nouvelles salles',
            '&#128103; Devenez parrain d\'une jeune fille - 50 000 F/mois',
        ];
    }
    
    $animation_duration = '15s';
    if ( $urgence_vitesse === 'lent' )   $animation_duration = '25s';
    if ( $urgence_vitesse === 'rapide' ) $animation_duration = '10s';
?>
<div class="flash-info-banner" style="background: <?php echo esc_attr( $urgence_couleur ); ?>;" data-speed="<?php echo esc_attr( $animation_duration ); ?>">
    <div class="container">
        <div class="flash-info-content">
            <div class="flash-info-label">
                <span class="flash-label-text"><?php echo wp_kses_post( $urgence_icone ); ?> INFO</span>
            </div>
            
            <div class="marquee-wrapper">
                <div class="marquee-track">
                    <?php foreach ( $messages as $message ) : ?>
                        <span class="marquee-message"><?php echo wp_kses_post( $message ); ?></span>
                    <?php endforeach; ?>
                    <?php foreach ( $messages as $message ) : ?>
                        <span class="marquee-message"><?php echo wp_kses_post( $message ); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <?php if ( $urgence_bouton && $urgence_lien ) : ?>
                <a href="<?php echo esc_url( home_url( $urgence_lien ) ); ?>" class="flash-info-button">
                    <?php echo esc_html( $urgence_bouton ); ?> &#8594;
                </a>
            <?php endif; ?>
            
            <button class="flash-info-close" aria-label="<?php esc_attr_e( 'Fermer', 'domaine-saint-joseph' ); ?>" onclick="this.closest('.flash-info-banner').style.display='none';">&#10005;</button>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Skip to content link -->
<a class="skip-link" href="#main"><?php esc_html_e( 'Aller au contenu', 'domaine-saint-joseph' ); ?></a>

<!-- Top bar (optionnelle) -->
<?php if ( get_theme_mod( 'show_top_bar', false ) ) : ?>
<div class="top-bar">
    <div class="container">
        <div class="top-bar-content">
            <span class="top-bar-text">&#128222; <?php echo esc_html( dsj_get_phone() ); ?></span>
            <span class="top-bar-text">&#128231; <?php echo esc_html( dsj_get_email() ); ?></span>
            <span class="top-bar-text">&#128205; Secteur 25, Bobo-Dioulasso</span>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ===== HEADER PRINCIPAL ===== -->
<header class="site-header" role="banner">
    <div class="container">
        <div class="header-inner">
            <!-- Logo -->
            <div class="site-logo">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link" rel="home">
                        <span class="logo-text"><?php bloginfo( 'name' ); ?></span>
                        <span class="logo-tagline"><?php bloginfo( 'description' ); ?></span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Menu burger (mobile) -->
            <button class="menu-toggle" 
                    aria-label="<?php esc_attr_e( 'Menu', 'domaine-saint-joseph' ); ?>" 
                    aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- Navigation principale -->
            <nav class="site-nav" role="navigation" aria-label="<?php esc_attr_e( 'Menu principal', 'domaine-saint-joseph' ); ?>">
                <?php wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'depth'          => 2
                ]); ?>
            </nav>

            <!-- Bouton WhatsApp -->
            <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', dsj_get_whatsapp() ) ); ?>" 
               class="btn-whatsapp" 
               target="_blank" 
               rel="noopener noreferrer nofollow"
               aria-label="<?php esc_attr_e( 'Contactez-nous sur WhatsApp', 'domaine-saint-joseph' ); ?>">
                <span class="btn-whatsapp-icon">&#128172;</span>
                <span class="btn-whatsapp-text">WhatsApp</span>
            </a>
        </div>
    </div>
</header>

<!-- Indicateur de progression de scroll -->
<div class="scroll-progress"></div>

<main id="main" class="site-content" role="main">