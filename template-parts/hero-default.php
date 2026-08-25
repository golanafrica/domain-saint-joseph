<?php
/**
 * Template Part : Hero par défaut (fallback)
 * Affiché si le slider Customizer est désactivé ou vide
 * 
 * Chargé par front-page.php si :
 * - get_theme_mod('hero_slider_active') === false
 * - OU aucune slide configurée
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="custom-hero">
    <div class="photo-zone"></div>
    <div class="hero-caption-band">
        <div class="hero-caption-text">
            <span class="hero-badge">
                &#9962; <?php esc_html_e( 'Travailleuses Missionnaires de l\'Immaculée', 'domaine-saint-joseph' ); ?>
            </span>
            <h1 class="hero-title">
                <?php esc_html_e( 'Former les jeunes filles,', 'domaine-saint-joseph' ); ?>
                <span class="hero-highlight">
                    <?php esc_html_e( 'accueillir avec compassion', 'domaine-saint-joseph' ); ?>
                </span>
            </h1>
            <p class="hero-subtitle">
                <?php esc_html_e( 'Centre de formation technique & Maison d\'accueil —', 'domaine-saint-joseph' ); ?>
                <?php esc_html_e( 'Bobo-Dioulasso, Burkina Faso, depuis 2022', 'domaine-saint-joseph' ); ?>
            </p>
        </div>
        <div class="hero-buttons">
            <a href="<?php echo esc_url( home_url( '/formation' ) ); ?>" class="btn btn-primary">
                &#127891; <?php esc_html_e( 'Nos formations', 'domaine-saint-joseph' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>" class="btn btn-secondary">
                &#127968; <?php esc_html_e( "Découvrir l'accueil", 'domaine-saint-joseph' ); ?>
            </a>
        </div>
    </div>
</div>