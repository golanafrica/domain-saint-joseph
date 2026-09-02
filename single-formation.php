<?php
/**
 * Template pour l'affichage d'une formation individuelle
 * Version modernisée : même langage visuel que l'accueil
 * (SVG cohérents, reveal au scroll, accessibilité complète)
 */

get_header();

/* ────────────────────────────────────────────────────────────
   ICÔNES SVG (cohérentes sur tous les appareils)
   ──────────────────────────────────────────────────────────── */
$svg_wrap = '<svg class="dsj-icon" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
$svg = [
    'diplome'   => $svg_wrap . '<path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12.5V17c0 1.7 2.7 3 6 3s6-1.3 6-3v-4.5"/></svg>',
    'livre'     => $svg_wrap . '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
    'horloge'   => $svg_wrap . '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>',
    'argent'    => $svg_wrap . '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
    'users'     => $svg_wrap . '<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
    'person'    => $svg_wrap . '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
    'clock'     => $svg_wrap . '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
    'clipboard' => $svg_wrap . '<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>',
    'coeur'     => $svg_wrap . '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>',
    'edit'      => $svg_wrap . '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>',
    'phone'     => $svg_wrap . '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
    'award'     => $svg_wrap . '<circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>',
];

$url_whatsapp = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', get_theme_mod( 'whatsapp', '22666605890' ) );
?>

<main id="main" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php
        // Image du hero : priorité image mise en avant > image du Customizer
        $hero_image_url = '';
        if ( has_post_thumbnail() ) {
            $hero_image_url = get_the_post_thumbnail_url( get_the_ID(), 'hero-size' );
        }
        if ( empty( $hero_image_url ) ) {
            $hero_image_url = get_theme_mod( 'hero_formation_image', '' );
        }
        ?>

        <!-- ═══════════════════════════════════════════
             HERO SECTION (même disposition que liste)
             ═══════════════════════════════════════════ -->
        <section class="page-header formation-single-header">
            <div class="page-photo-zone"
                 <?php if ( $hero_image_url ) : ?>
                 style="background-image: url('<?php echo esc_url( $hero_image_url ); ?>');"
                 <?php endif; ?>>
            </div>
            <div class="header-caption-band">
                <span class="header-badge">
                    <?php echo $svg['diplome']; ?>
                    Formation professionnelle
                </span>
                <h1 class="header-title"><?php the_title(); ?></h1>
                <div class="header-divider">
                    <span class="divider-line"></span>
                    <span class="divider-icon"><?php echo $svg['livre']; ?></span>
                    <span class="divider-line"></span>
                </div>
                <?php if ( has_excerpt() ) : ?>
                    <p class="header-subtitle"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
                <?php endif; ?>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════
             CONTENU PRINCIPAL (image + infos en grid)
             ═══════════════════════════════════════════ -->
        <section class="formation-single section-padding">
            <div class="container">
                <div class="formation-single-grid reveal-section">
                    <!-- Colonne image -->
                    <div class="formation-single-image">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', [
                                'class'   => 'img-responsive',
                                'loading' => 'lazy',
                                'decoding' => 'async',
                                'alt'     => esc_attr( get_the_title() ),
                            ] ); ?>
                        <?php else : ?>
                            <div class="formation-image-placeholder">
                                <?php echo $svg['diplome']; ?>
                                <span><?php the_title(); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Colonne infos -->
                    <div class="formation-single-infos">
                        <div class="infos-card">
                            <h3>
                                <?php echo $svg['clipboard']; ?>
                                Détails de la formation
                            </h3>

                            <?php
                            $duree     = get_post_meta( get_the_ID(), '_dsj_duree', true );
                            $prix      = get_post_meta( get_the_ID(), '_dsj_prix', true );
                            $niveau    = get_post_meta( get_the_ID(), '_dsj_niveau', true );
                            $places    = get_post_meta( get_the_ID(), '_dsj_places', true );
                            $formateur = get_post_meta( get_the_ID(), '_dsj_formateur', true );
                            $horaires  = get_post_meta( get_the_ID(), '_dsj_horaires', true );
                            ?>

                            <?php if ( $duree ) : ?>
                            <div class="info-row">
                                <span class="info-label"><?php echo $svg['horloge']; ?> Durée</span>
                                <span class="info-value"><?php echo esc_html( $duree ); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if ( $prix ) : ?>
                            <div class="info-row">
                                <span class="info-label"><?php echo $svg['argent']; ?> Prix</span>
                                <span class="info-value"><?php echo esc_html( $prix ); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if ( $niveau ) : ?>
                            <div class="info-row">
                                <span class="info-label"><?php echo $svg['award']; ?> Niveau requis</span>
                                <span class="info-value"><?php echo esc_html( $niveau ); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if ( $places ) : ?>
                            <div class="info-row">
                                <span class="info-label"><?php echo $svg['users']; ?> Places disponibles</span>
                                <span class="info-value"><?php echo esc_html( $places ); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if ( $formateur ) : ?>
                            <div class="info-row">
                                <span class="info-label"><?php echo $svg['person']; ?> Formatrice</span>
                                <span class="info-value"><?php echo esc_html( $formateur ); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if ( $horaires ) : ?>
                            <div class="info-row">
                                <span class="info-label"><?php echo $svg['clock']; ?> Horaires</span>
                                <span class="info-value"><?php echo esc_html( $horaires ); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="inscription-cta">
                            <a href="<?php echo esc_url( $url_whatsapp ); ?>?text=<?php echo urlencode( 'Bonjour, je souhaite m\'inscrire à la formation ' . get_the_title() ); ?>"
                               class="btn btn-primary btn-large"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="S'inscrire par WhatsApp à la formation <?php echo esc_attr( get_the_title() ); ?>">
                                <?php echo $svg['edit']; ?> S'inscrire par WhatsApp
                            </a>
                            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?sujet=formation-<?php echo sanitize_title( get_the_title() ); ?>"
                               class="btn btn-secondary btn-large"
                               aria-label="Demander un renseignement sur <?php echo esc_attr( get_the_title() ); ?>">
                                <?php echo $svg['phone']; ?> Demander un renseignement
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Description complète -->
                <div class="formation-description reveal-section">
                    <h3>
                        <?php echo $svg['livre']; ?>
                        Description de la formation
                    </h3>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Badges de la formation (catégories) -->
                <?php
                $terms = get_the_terms( get_the_ID(), 'formation_category' );
                if ( $terms && ! is_wp_error( $terms ) ) :
                ?>
                <div class="formation-badges reveal-section">
                    <?php foreach ( $terms as $term ) : ?>
                        <span class="formation-badge"><?php echo esc_html( $term->name ); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

            </div>
        </section>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>