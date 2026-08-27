<?php
/**
 * Template Name: Galerie
 * Phase Perf : Images optimisées + Accessibilité WCAG
 */
get_header(); ?>

<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_galerie_image' );
$hero_badge     = get_theme_mod( 'hero_galerie_badge', '&#128248; Souvenirs et moments' );
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
            <!-- ✅ Contraste corrigé : texte blanc au lieu de doré sur fond bleu -->
            <span class="header-badge"><?php echo wp_kses_post( $hero_badge ); ?></span>
            <h1 class="header-title"><?php echo esc_html( $hero_titre ); ?></h1>
            <div class="header-divider">
                <span class="divider-line"></span>
                <span class="divider-icon">&#128248;</span>
                <span class="divider-line"></span>
            </div>
            <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
        </div>
    </section>

    <!-- FILTRES DE CATÉGORIES -->
    <section class="galerie-filters section-padding">
        <div class="container">
            <div class="filter-buttons" role="toolbar" aria-label="Filtrer les photos">
                <button class="filter-btn active" data-filter="all" aria-pressed="true">
                    &#128248; Toutes les photos
                </button>
                <?php
                $categories = get_terms( [
                    'taxonomy' => 'categorie_galerie',
                    'hide_empty' => true,
                ] );
                
                if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                    foreach ( $categories as $category ) {
                        echo '<button class="filter-btn" data-filter="' . esc_attr( $category->slug ) . '" aria-pressed="false">'
                           . '&#128248; ' . esc_html( $category->name ) 
                           . '</button>';
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
                    <div class="galerie-grid" role="list">
                        <?php 
                        $index = 0;
                        while ( $galerie->have_posts() ) : $galerie->the_post(); 
                            $index++;
                            $categories = get_the_terms( get_the_ID(), 'categorie_galerie' );
                            $cat_slugs = array();
                            if ( $categories && ! is_wp_error( $categories ) ) {
                                foreach ( $categories as $cat ) {
                                    $cat_slugs[] = $cat->slug;
                                }
                            }
                            $cat_classes = implode( ' ', $cat_slugs );
                            
                            // ✅ Récupérer l'ID et les dimensions de l'image
                            $thumb_id = get_post_thumbnail_id();
                            $thumb_url_full = wp_get_attachment_image_url( $thumb_id, 'full' ) ?: wp_get_attachment_image_url( $thumb_id, 'large' );
                            $thumb_url_medium = wp_get_attachment_image_url( $thumb_id, 'gallery-thumb' );
                            $thumb_meta = wp_get_attachment_metadata( $thumb_id );
                            $alt_text = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
                            if ( empty( $alt_text ) ) {
                                $alt_text = get_the_title();
                            }
                            
                            // Précharger uniquement la première image (LCP)
                            $loading = ( $index === 1 ) ? 'eager' : 'lazy';
                            $fetchpriority = ( $index === 1 ) ? 'high' : 'auto';
                        ?>
                            <div class="galerie-item" data-category="<?php echo esc_attr( $cat_classes ); ?>" role="listitem">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php echo esc_url( $thumb_url_full ); ?>" 
                                       class="galerie-link" 
                                       data-lightbox="galerie"
                                       aria-label="Voir la photo : <?php echo esc_attr( $alt_text ); ?>">
                                        
                                        <img src="<?php echo esc_url( $thumb_url_medium ); ?>"
                                             alt="<?php echo esc_attr( $alt_text ); ?>"
                                             class="galerie-image"
                                             width="300"
                                             height="300"
                                             loading="<?php echo $loading; ?>"
                                             decoding="async"
                                             fetchpriority="<?php echo $fetchpriority; ?>">
                                        
                                        <div class="galerie-overlay" aria-hidden="true">
                                            <span class="galerie-icon">&#128269;</span>
                                            <!-- ✅ H4 au lieu de H3 (respect hiérarchie H1 > H2 > H3 sections > H4 items) -->
                                            <h4 class="galerie-title"><?php the_title(); ?></h4>
                                            <?php if ( has_excerpt() ) : ?>
                                                <p class="galerie-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <div class="gallery-empty" style="display: none;" role="status">
                        <p>Aucune photo dans cette catégorie.</p>
                    </div>
                    
                <?php else : ?>
                    <div class="no-content" role="status">
                        <p>Aucune photo dans la galerie pour le moment. Revenez bientôt !</p>
                        <p>&#128231; <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contactez-nous</a> pour partager vos souvenirs.</p>
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
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-large">
                        &#128231; Nous contacter
                    </a>
                    <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', dsj_get_whatsapp() ) ); ?>" 
                       class="btn btn-whatsapp btn-large" 
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Nous contacter sur WhatsApp">
                        &#128241; WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>