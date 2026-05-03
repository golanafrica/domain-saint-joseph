<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<a class="skip-link" href="#main"><?php esc_html_e( 'Aller au contenu', 'college-filles-bf' ); ?></a>

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <!-- Logo -->
            <div class="site-logo">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <span class="logo-text">Collège Filles BF</span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Navigation -->
            <nav class="site-nav">
                <?php wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                ]); ?>
            </nav>

            <!-- Burger mobile (CSS pur plus tard) -->
            <button class="menu-toggle" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

<main id="main" class="site-content">