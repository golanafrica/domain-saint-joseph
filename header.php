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
         CRITICAL CSS INLINE (version ALLÉGÉE)
         Uniquement l'anti-FOUC : le détail vit
         dans 02-header.css (plus de doublons)
    ======================================== -->
    <style id="critical-css">
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #FDFEFE; color: #2C3E50; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        :root { --clr-primary: #1A5276; --clr-accent: #D4AC0D; }

        /* Header sticky (anti flash de layout) */
        .site-header { background: var(--clr-primary, #1A5276); position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header-inner { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 0.8rem 0; }
        .site-logo img { max-height: 60px; width: auto; }

        /* Nav desktop (anti-FOUC minimal) */
        .nav-menu { display: flex; list-style: none; gap: 2rem; margin: 0; padding: 0; }
        .nav-menu a { color: #fff; text-decoration: none; font-weight: 500; }
        .menu-toggle { display: none; background: none; border: none; width: 44px; height: 44px; }

        /* Bouton WhatsApp (anti-FOUC minimal) */
        .site-header .btn-whatsapp { display: inline-flex; align-items: center; gap: 8px; background: #25D366; color: #06341F; padding: 8px 16px; border-radius: 50px; font-weight: 700; font-size: 0.85rem; text-decoration: none; }
        .btn-whatsapp-icon { width: 1rem; height: 1rem; }

        /* Skip link (accessibilité immédiate) */
        .skip-link { position: absolute; left: -9999px; top: auto; width: 1px; height: 1px; overflow: hidden; }
        .skip-link:focus { position: fixed; top: 20px; left: 20px; width: auto; height: auto; background: white; color: #1A5276; padding: 10px 20px; border-radius: 5px; z-index: 10000; }

        /* Scroll progress */
        .scroll-progress { position: fixed; top: 0; left: 0; width: 0%; height: 3px; background: var(--clr-accent, #D4AC0D); z-index: 1001; transition: width 0.1s ease; }

        /* Flash info (visible avant CSS externe) */
        .flash-info-banner { position: relative; padding: 8px 0; color: white; z-index: 1001; overflow: hidden; }
        .flash-info-content { display: flex; align-items: center; gap: 12px; max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        .flash-info-label { background: rgba(0,0,0,0.55); padding: 4px 10px; border-radius: 4px; font-weight: 700; font-size: 0.7rem; white-space: nowrap; }
        .marquee-wrapper { flex: 1; overflow: hidden; }
        .marquee-track { display: flex; gap: 40px; white-space: nowrap; animation: marqueeScroll 20s linear infinite; }
        .marquee-message { display: inline-flex; align-items: center; padding: 0 20px; font-size: 0.9rem; font-weight: 500; }
        @keyframes marqueeScroll { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }
        .flash-info-button { background: rgba(255,255,255,0.25); color: white; padding: 5px 14px; border-radius: 50px; font-weight: 600; text-decoration: none; font-size: 0.8rem; }
        .flash-info-close { background: rgba(0,0,0,0.2); border: none; color: white; width: 24px; height: 24px; border-radius: 50%; cursor: pointer; }

        /* Mobile : menu caché par défaut (anti-FOUC), burger visible */
        @media (max-width: 768px) {
            .menu-toggle { display: flex; }
            .site-nav { position: absolute; top: 100%; left: 0; right: 0; background: var(--clr-primary, #1A5276); }
            .nav-menu { display: none; }
            .nav-menu.is-open { display: flex; flex-direction: column; gap: 0; padding: 1rem; }
            .nav-menu a { display: block; padding: 12px 0; }
            .site-logo img { max-height: 45px; }
            .flash-info-button { display: none; }
        }
        @media (max-width: 480px) {
            .site-logo img { max-height: 40px; }
            .marquee-message { font-size: 0.75rem; padding: 0 10px; }
        }
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

<!-- Top bar (optionnelle) — icônes SVG -->
<?php if ( get_theme_mod( 'show_top_bar', false ) ) : ?>
<div class="top-bar">
    <div class="container">
        <div class="top-bar-content">
            <span class="top-bar-text">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <?php echo esc_html( dsj_get_phone() ); ?>
            </span>
            <span class="top-bar-text">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <?php echo esc_html( dsj_get_email() ); ?>
            </span>
            <span class="top-bar-text">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
                Secteur 25, Bobo-Dioulasso
            </span>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ===== HEADER PRINCIPAL =====
     ✅ Ordre DOM = ordre visuel : Logo → Nav → WhatsApp → Burger
     (plus de hacks CSS `order` ; tab clavier cohérent) -->
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

            <!-- Navigation principale -->
            <nav id="site-navigation" class="site-nav" role="navigation" aria-label="<?php esc_attr_e( 'Menu principal', 'domaine-saint-joseph' ); ?>">
                <?php wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'depth'          => 2
                ]); ?>
            </nav>

            <!-- Bouton WhatsApp (vrai logo SVG) -->
            <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', dsj_get_whatsapp() ) ); ?>"
               class="btn-whatsapp"
               target="_blank"
               rel="noopener noreferrer nofollow"
               aria-label="<?php esc_attr_e( 'Contactez-nous sur WhatsApp', 'domaine-saint-joseph' ); ?>">
                <svg class="btn-whatsapp-icon" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                <span class="btn-whatsapp-text">WhatsApp</span>
            </a>

            <!-- Menu burger (mobile, à droite) -->
            <button class="menu-toggle"
                    aria-label="<?php esc_attr_e( 'Menu', 'domaine-saint-joseph' ); ?>"
                    aria-expanded="false"
                    aria-controls="site-navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<!-- Indicateur de progression de scroll -->
<div class="scroll-progress"></div>

<main id="main" class="site-content" role="main">