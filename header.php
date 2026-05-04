<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<a class="skip-link" href="#main"><?php esc_html_e( 'Aller au contenu', 'domaine-saint-joseph' ); ?></a>

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <div class="site-logo">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <span class="logo-text">Domaine Saint Joseph</span>
                    </a>
                <?php endif; ?>
            </div>

            <nav class="site-nav">
                <?php wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                ]); ?>
            </nav>

            <a href="https://wa.me/22666605890" class="btn-whatsapp" target="_blank" rel="noopener">
                💬 WhatsApp
            </a>

            <button class="menu-toggle" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

<main id="main" class="site-content">