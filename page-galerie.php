<?php
/**
 * Template Name: Galerie
 * Version modernisée : même langage visuel que l'accueil
 * (SVG cohérents, reveal au scroll, accessibilité complète, lightbox conservé)
 */
get_header();

/* ────────────────────────────────────────────────────────────
   ICÔNES SVG (cohérentes sur tous les appareils)
   ──────────────────────────────────────────────────────────── */
$svg_wrap = '<svg class="dsj-icon" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
$svg = [
    'camera'    => $svg_wrap . '<path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>',
    'loupe'     => $svg_wrap . '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
    'mail'      => $svg_wrap . '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
    'phone'     => $svg_wrap . '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
    'coeur'     => $svg_wrap . '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>',
    'etoile'    => $svg_wrap . '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
    'fleche'    => $svg_wrap . '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
    'image'     => $svg_wrap . '<rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>',
];

$url_whatsapp = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', get_theme_mod( 'whatsapp', '22666605890' ) );
?>

<main id="main" class="site-main">

    <!-- ═══════════════════════════════════════════
         HERO SECTION
         ═══════════════════════════════════════════ -->
    <?php
    $hero_image     = get_theme_mod( 'hero_galerie_image' );
    $hero_titre     = get_theme_mod( 'hero_galerie_titre', 'Notre Galerie' );
    $hero_soustitre = get_theme_mod( 'hero_galerie_soustitre', 'Découvrez notre cadre de vie, nos formations et nos événements en images' );
    ?>

    <section class="page-header galerie-header" aria-labelledby="galerie-hero-title">
        <div class="page-photo-zone"
             <?php if ( $hero_image ) : ?>
             style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
             <?php endif; ?>
             role="img"
             aria-label="<?php echo esc_attr( $hero_titre ); ?>">
        </div>
        <div class="header-caption-band">
            <span class="header-badge">
                <?php echo $svg['camera']; ?>
                Souvenirs et moments
            </span>
            <h1 class="header-title" id="galerie-hero-title"><?php echo esc_html( $hero_titre ); ?></h1>
            <div class="header-divider">
                <span class="divider-line"></span>
                <span class="divider-icon"><?php echo $svg['image']; ?></span>
                <span class="divider-line"></span>
            </div>
            <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
         FILTRES DE CATÉGORIES
         ═══════════════════════════════════════════ -->
    <section class="galerie-filters section-padding reveal-section">
        <div class="container">
            <div class="filter-buttons" role="toolbar" aria-label="Filtrer les photos">
                <button class="filter-btn active" data-filter="all" aria-pressed="true">
                    <?php echo $svg['camera']; ?> Toutes les photos
                </button>
                <?php
                $categories = get_terms( [
                    'taxonomy'   => 'categorie_galerie',
                    'hide_empty' => true,
                ] );

                if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                    foreach ( $categories as $category ) {
                        echo '<button class="filter-btn" data-filter="' . esc_attr( $category->slug ) . '" aria-pressed="false">'
                           . $svg['image'] . ' ' . esc_html( $category->name )
                           . '</button>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
         GRILLE GALERIE
         ═══════════════════════════════════════════ -->
    <section class="galerie-grid-section section-padding section-alt">
        <div class="container">
            <div class="galerie-container">
                <?php
                $galerie = new WP_Query( [
                    'post_type'      => 'galerie',
                    'posts_per_page' => -1,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ] );

                if ( $galerie->have_posts() ) : ?>
                    <div class="galerie-grid galerie-grid-masonry" role="list">
                        <?php
                        $index = 0;
                        while ( $galerie->have_posts() ) : $galerie->the_post();
                            $index++;
                            $categories  = get_the_terms( get_the_ID(), 'categorie_galerie' );
                            $cat_slugs   = array();
                            if ( $categories && ! is_wp_error( $categories ) ) {
                                foreach ( $categories as $cat ) {
                                    $cat_slugs[] = $cat->slug;
                                }
                            }
                            $cat_classes = implode( ' ', $cat_slugs );

                            // Récupérer l'ID et les dimensions de l'image
                            $thumb_id          = get_post_thumbnail_id();
                            $thumb_url_full    = wp_get_attachment_image_url( $thumb_id, 'full' ) ?: wp_get_attachment_image_url( $thumb_id, 'large' );
                            $thumb_url_medium  = wp_get_attachment_image_url( $thumb_id, 'medium_large' ) ?: wp_get_attachment_image_url( $thumb_id, 'gallery-thumb' );
                            $alt_text          = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
                            if ( empty( $alt_text ) ) {
                                $alt_text = get_the_title();
                            }

                            // Précharger uniquement la première image (LCP)
                            $loading       = ( $index === 1 ) ? 'eager' : 'lazy';
                            $fetchpriority = ( $index === 1 ) ? 'high' : 'auto';
                        ?>
                            <div class="galerie-item galerie-item-masonry reveal-section" data-category="<?php echo esc_attr( $cat_classes ); ?>" role="listitem">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php echo esc_url( $thumb_url_full ); ?>"
                                       class="galerie-link"
                                       data-lightbox="galerie"
                                       aria-label="Voir la photo : <?php echo esc_attr( $alt_text ); ?>">

                                        <img src="<?php echo esc_url( $thumb_url_medium ); ?>"
                                             alt="<?php echo esc_attr( $alt_text ); ?>"
                                             class="galerie-image"
                                             width="400"
                                             height="400"
                                             loading="<?php echo $loading; ?>"
                                             decoding="async"
                                             fetchpriority="<?php echo $fetchpriority; ?>">

                                        <div class="galerie-overlay" aria-hidden="true">
                                            <span class="galerie-icon"><?php echo $svg['loupe']; ?></span>
                                            <h4 class="galerie-title galerie-title-overlay"><?php the_title(); ?></h4>
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
                    <div class="no-content" role="status" style="text-align: center; padding: 60px 20px;">
                        <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;">
                            <?php echo $svg['image']; ?>
                        </div>
                        <p>Aucune photo dans la galerie pour le moment. Revenez bientôt !</p>
                        <p style="margin-top: 1rem;">
                            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">
                                <?php echo $svg['mail']; ?> Contactez-nous
                            </a>
                        </p>
                    </div>
                <?php
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
         CTA FINAL (identique aux autres pages)
         ═══════════════════════════════════════════ -->
    <section class="cta-final-section section-padding" aria-labelledby="cta-galerie-title">
        <div class="container">
            <div class="cta-content reveal-section">
                <span class="cta-icon"><?php echo $svg['coeur']; ?></span>
                <h2 id="cta-galerie-title">Vous avez visité le Domaine Saint Joseph ?</h2>
                <p>Partagez vos photos avec nous ou venez découvrir notre cadre exceptionnel !</p>

                <div class="cta-actions">
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-large" aria-label="Nous contacter pour partager vos photos">
                        <?php echo $svg['mail']; ?> Nous contacter
                    </a>
                    <a href="<?php echo esc_url( $url_whatsapp ); ?>"
                       class="btn btn-outline-light btn-large"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Nous contacter sur WhatsApp">
                        <?php echo $svg['phone']; ?> Parler sur WhatsApp
                    </a>
                </div>

                <p class="cta-whatsapp">
                    Une question ? <a href="<?php echo esc_url( $url_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">Écrivez-nous sur WhatsApp</a>
                </p>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>