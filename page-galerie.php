<?php
/**
 * Template Name: Galerie
 */
get_header(); ?>

<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_galerie_image' );
$hero_badge     = get_theme_mod( 'hero_galerie_badge', '📸 Souvenirs et moments' );
$hero_titre     = get_theme_mod( 'hero_galerie_titre', 'Notre Galerie' );
$hero_soustitre = get_theme_mod( 'hero_galerie_soustitre', 'Découvrez notre cadre de vie, nos formations et nos événements en images' );
?>

<main id="main" class="site-main">

    <section class="page-header galerie-header">
        <div class="page-photo-zone"
             <?php if ( $hero_image ) : ?>
             style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
             <?php endif; ?>>
        </div>
        <div class="header-caption-band">
            <span class="header-badge"><?php echo esc_html( $hero_badge ); ?></span>
            <h1 class="header-title"><?php echo esc_html( $hero_titre ); ?></h1>
            <div class="header-divider">
                <span class="divider-line"></span>
                <span class="divider-icon">📷</span>
                <span class="divider-line"></span>
            </div>
            <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
        </div>
    </section>

   

    <!-- FILTRES DE CATÉGORIES -->
    <section class="galerie-filters section-padding">
        <div class="container">
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">📷 Toutes les photos</button>
                <?php
                // Récupérer toutes les catégories de la galerie
                $categories = get_terms( [
                    'taxonomy' => 'categorie_galerie',
                    'hide_empty' => true,
                ] );
                
                if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                    foreach ( $categories as $category ) {
                        echo '<button class="filter-btn" data-filter="' . esc_attr( $category->slug ) . '">📁 ' . esc_html( $category->name ) . '</button>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- GRILLE GALERIE -->
    <section class="galerie-grid-section section-padding bg-light">
        <div class="container">
            <div class="galerie-container">
                <?php
                $galerie = new WP_Query( [
                    'post_type' => 'galerie',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ] );
                
                if ( $galerie->have_posts() ) : ?>
                    <div class="galerie-grid">
                        <?php while ( $galerie->have_posts() ) : $galerie->the_post(); 
                            $categories = get_the_terms( get_the_ID(), 'categorie_galerie' );
                            $cat_slugs = array();
                            if ( $categories && ! is_wp_error( $categories ) ) {
                                foreach ( $categories as $cat ) {
                                    $cat_slugs[] = $cat->slug;
                                }
                            }
                            $cat_classes = implode( ' ', $cat_slugs );
                        ?>
                            <div class="galerie-item" data-category="<?php echo esc_attr( $cat_classes ); ?>">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php echo esc_url( wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' ) ); ?>" class="galerie-link" data-lightbox="galerie">
                                        <?php the_post_thumbnail( 'medium', [ 'class' => 'galerie-image', 'loading' => 'lazy' ] ); ?>
                                        <div class="galerie-overlay">
                                            <span class="galerie-icon">🔍</span>
                                            <div class="galerie-caption">
                                                <h3><?php the_title(); ?></h3>
                                                <?php if ( has_excerpt() ) : ?>
                                                    <p><?php echo get_the_excerpt(); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <div class="gallery-empty" style="display: none; text-align: center; padding: 60px;">
                        <p>Aucune photo dans cette catégorie.</p>
                    </div>
                    
                <?php else : ?>
                    <div class="no-content" style="text-align: center; padding: 60px;">
                        <p>Aucune photo dans la galerie pour le moment. Revenez bientôt !</p>
                        <p>📸 <a href="/contact">Contactez-nous</a> pour partager vos souvenirs.</p>
                    </div>
                <?php 
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION CTA -->
    <section class="cta-home-section section-padding">
        <div class="container">
            <div class="cta-content">
                <h2>Vous avez visité le Domaine Saint Joseph ?</h2>
                <p>Partagez vos photos avec nous ou venez découvrir notre cadre exceptionnel !</p>
                <div class="cta-buttons">
                    <a href="/contact" class="btn btn-primary btn-large">📞 Nous contacter</a>
                    <a href="https://wa.me/<?php echo dsj_get_whatsapp(); ?>" class="btn btn-whatsapp btn-large" target="_blank">💬 WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>