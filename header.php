<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Meta SEO améliorées -->
    <meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
    <meta name="author" content="Domaine Saint Joseph">
    <meta name="theme-color" content="<?php echo get_theme_mod( 'primary_color', '#1A5276' ); ?>">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
    <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
    <meta property="og:image" content="<?php echo esc_url( get_template_directory_uri() . '/assets/images/og-image.jpg' ); ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon-32x32.png' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon-16x16.png' ); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/apple-touch-icon.png' ); ?>">
    
    <?php wp_head(); ?>
    
    <!-- Critical CSS inline pour performance -->
    <style id="critical-css">
        /* Reset et base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #FDFEFE; color: #2C3E50; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        
        /* Header sticky */
        .site-header { background: var(--clr-primary, #1A5276); position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header-inner { display: flex; align-items: center; justify-content: space-between; padding: 0.8rem 0; gap: 1rem; }
        
        /* Logo */
        .site-logo { flex-shrink: 0; }
        .site-logo img { max-height: 60px; width: auto; transition: all 0.3s ease; }
        .logo-text { color: white; font-size: 1.3rem; font-weight: 700; }
        .logo-tagline { font-size: 0.7rem; color: rgba(255,255,255,0.7); display: block; }
        
        /* Menu desktop */
        .nav-menu { display: flex; list-style: none; gap: 2rem; margin: 0; padding: 0; }
        .nav-menu a { color: white; text-decoration: none; font-weight: 500; transition: color 0.3s; position: relative; }
        .nav-menu a:hover { color: var(--clr-accent, #D4AC0D); }
        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--clr-accent, #D4AC0D);
            transition: width 0.3s ease;
        }
        .nav-menu a:hover::after,
        .nav-menu .current-menu-item a::after { width: 100%; }
        
        /* Bouton WhatsApp */
        .btn-whatsapp {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #25D366;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            flex-shrink: 0;
        }
        .btn-whatsapp:hover { background: #128C7E; transform: translateY(-2px); }
        
        /* Menu burger (caché sur desktop) */
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
        .menu-toggle span {
            display: block;
            width: 25px;
            height: 2px;
            background: white;
            transition: 0.3s;
        }
        
        /* Skip link */
        .skip-link { position: absolute; left: -9999px; top: auto; width: 1px; height: 1px; overflow: hidden; }
        .skip-link:focus {
            position: fixed;
            top: 20px;
            left: 20px;
            width: auto;
            height: auto;
            background: white;
            color: #1A5276;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 10000;
            text-decoration: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        /* Top bar */
        .top-bar { background: rgba(0,0,0,0.2); padding: 0.5rem 0; font-size: 0.8rem; }
        .top-bar-content { display: flex; justify-content: flex-end; gap: 1.5rem; flex-wrap: wrap; }
        .top-bar-text { color: rgba(255,255,255,0.8); }
        
        /* Scroll progress */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: var(--clr-accent, #D4AC0D);
            z-index: 1001;
            transition: width 0.1s ease;
        }
        
        /* Responsive mobile */
        @media (max-width: 768px) {
            .menu-toggle { display: flex !important; }
            .site-nav { position: absolute; top: 100%; left: 0; right: 0; background: var(--clr-primary, #1A5276); z-index: 999; }
            .nav-menu {
                display: none !important;
                flex-direction: column !important;
                gap: 0 !important;
                padding: 1rem !important;
                margin: 0 !important;
                background: var(--clr-primary, #1A5276) !important;
                box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
            }
            .nav-menu.is-open { display: flex !important; }
            .nav-menu li { border-bottom: 1px solid rgba(255,255,255,0.1); }
            .nav-menu a { display: block; padding: 12px 0; }
            .nav-menu a::after { display: none; }
            
            .btn-whatsapp { padding: 0.5rem; border-radius: 50%; width: 40px; height: 40px; justify-content: center; }
            .btn-whatsapp-text { display: none; }
            
            .top-bar-content { justify-content: center; gap: 1rem; }
            .top-bar-text { font-size: 0.7rem; }
            .site-logo img { max-height: 45px; }
        }
        
        @media (max-width: 480px) {
            .top-bar { display: none; }
            .site-logo img { max-height: 40px; }
        }
        
        /* Animation menu burger */
        .menu-toggle.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .menu-toggle.active span:nth-child(2) { opacity: 0; transform: scale(0); }
        .menu-toggle.active span:nth-child(3) { transform: rotate(-45deg) translate(7px, -6px); }
    </style>
</head>
<body <?php body_class(); ?>


<!-- BANDEAU D'URGENCE DÉFILANT - VERSION UNIVERSEL -->
<?php if ( get_theme_mod( 'urgence_active', false ) ) : 
    $urgence_lien = get_theme_mod( 'urgence_lien', '/nous-soutenir' );
    $urgence_bouton = get_theme_mod( 'urgence_bouton_texte', 'Je participe' );
    $urgence_couleur = get_theme_mod( 'urgence_couleur', '#e74c3c' );
    $urgence_icone = get_theme_mod( 'urgence_icone', '🚨' );
    $urgence_vitesse = get_theme_mod( 'urgence_vitesse', 'normal' );
    
    // Récupérer les messages non vides
    $messages = [];
    for ( $i = 1; $i <= 5; $i++ ) {
        $msg = get_theme_mod( "urgence_message_{$i}", '' );
        if ( ! empty( $msg ) ) {
            $messages[] = $msg;
        }
    }
    
    // Messages par défaut
    if ( empty( $messages ) ) {
        $messages = [
            '👧 Parrainez une jeune fille pour sa formation',
            '🏗️ Aidez-nous à construire de nouvelles salles',
            '💛 Votre don change des vies',
        ];
    }
    
    // Vitesse d'animation
    $animation_duration = '15s';
    if ( $urgence_vitesse === 'lent' ) $animation_duration = '25s';
    if ( $urgence_vitesse === 'rapide' ) $animation_duration = '10s';
    
    // Sérialiser les messages pour JavaScript
    $messages_json = json_encode($messages);
?>
<div class="urgence-banner" style="background: <?php echo esc_attr( $urgence_couleur ); ?>;" data-messages='<?php echo esc_attr( $messages_json ); ?>' data-speed="<?php echo esc_attr( $animation_duration ); ?>">
    <div class="container">
        <div class="urgence-content">
            <div class="urgence-icone-fixe"><?php echo esc_html( $urgence_icone ); ?></div>
            
            <div class="marquee-wrapper">
                <div class="marquee-track" id="marqueeTrack">
                    <?php foreach ( $messages as $message ) : ?>
                        <span class="marquee-message"><?php echo esc_html( $message ); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <a href="<?php echo esc_url( $urgence_lien ); ?>" class="urgence-bouton">
                <?php echo esc_html( $urgence_bouton ); ?> →
            </a>
            <button class="urgence-close" aria-label="Fermer" onclick="this.closest('.urgence-banner').style.display='none';">✕</button>
        </div>
    </div>
</div>
<?php endif; ?>
    



<?php wp_body_open(); ?>

<!-- Skip to content link -->
<a class="skip-link" href="#main"><?php esc_html_e( 'Aller au contenu', 'domaine-saint-joseph' ); ?></a>

<!-- Top bar (optionnelle) -->
<?php if ( get_theme_mod( 'show_top_bar', false ) ) : ?>
<div class="top-bar">
    <div class="container">
        <div class="top-bar-content">
            <span class="top-bar-text">📞 <?php echo dsj_get_phone(); ?></span>
            <span class="top-bar-text">✉️ <?php echo dsj_get_email(); ?></span>
            <span class="top-bar-text">📍 Secteur 25, Bobo-Dioulasso</span>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Header principal -->
<header class="site-header" role="banner">
    <div class="container">
        <div class="header-inner">
            <!-- Logo -->
            <div class="site-logo">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link" rel="home">
                        <span class="logo-text">Domaine Saint Joseph</span>
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
            <a href="https://wa.me/<?php echo dsj_get_whatsapp(); ?>" 
               class="btn-whatsapp" 
               target="_blank" 
               rel="noopener noreferrer nofollow"
               aria-label="<?php esc_attr_e( 'Contactez-nous sur WhatsApp', 'domaine-saint-joseph' ); ?>">
                <span class="btn-whatsapp-icon">💬</span>
                <span class="btn-whatsapp-text">WhatsApp</span>
            </a>
        </div>
    </div>
</header>

<!-- Indicateur de progression de scroll -->
<div class="scroll-progress"></div>

<main id="main" class="site-content" role="main">