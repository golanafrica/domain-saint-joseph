<?php
/**
 * Archive des formations (liste) — Version moderne humanitaire
 * ✅ Même langage visuel que l'accueil (badges légers, SVG, reveal, cartes 4:3)
 * ✅ Requête principale + pagination native WordPress
 * Contenu 100% dynamique (CPT formation + Customizer)
 */
get_header();

/* ────────────────────────────────────────────────────────────
   ICÔNES SVG (cohérentes sur tous les appareils)
   ──────────────────────────────────────────────────────────── */
$svg_wrap = '<svg class="dsj-icon" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
$svg = [
	'diplome'   => $svg_wrap . '<path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12.5V17c0 1.7 2.7 3 6 3s6-1.3 6-3v-4.5"/></svg>',
	'horloge'   => $svg_wrap . '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>',
	'check'     => $svg_wrap . '<path d="M20 6L9 17l-5-5"/></svg>',
	'coeur'     => $svg_wrap . '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>',
	'livre'     => $svg_wrap . '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
	'users'     => $svg_wrap . '<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
	'award'     => $svg_wrap . '<circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>',
	'target'    => $svg_wrap . '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
];

$url_whatsapp = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', get_theme_mod( 'whatsapp', '22666605890' ) );
$hero_image   = get_theme_mod( 'hero_formation_image' );
?>

<main id="main" class="site-main">

    <!-- ═══════════════════════════════════════════
         1. HERO
         ═══════════════════════════════════════════ -->
    <section class="page-header formation-header">
        <div class="page-photo-zone"
            <?php if ( $hero_image ) : ?>
                style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
            <?php endif; ?>>
        </div>
        <div class="header-caption-band">
            <span class="header-badge">
                <?php echo $svg['diplome']; ?>
                <?php echo esc_html( get_theme_mod( 'hero_formation_badge', 'Formation professionnelle' ) ); ?>
            </span>
            <h1 class="header-title">
                <?php echo esc_html( get_theme_mod( 'hero_formation_titre', 'Nos Formations' ) ); ?>
            </h1>
            <div class="header-divider">
                <span class="divider-line"></span>
                <span class="divider-icon"><?php echo $svg['diplome']; ?></span>
                <span class="divider-line"></span>
            </div>
            <p class="header-subtitle">
                <?php echo esc_html( get_theme_mod( 'hero_formation_soustitre', 'Des compétences concrètes pour l\'autonomie des jeunes filles' ) ); ?>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
         2. GRILLE DES FORMATIONS + PAGINATION
         ═══════════════════════════════════════════ -->
    <section class="formations-archive section-padding section-alt" aria-labelledby="formations-archive-title">
        <div class="container">
            <div class="section-header">
                <span class="section-badge-light"><?php echo $svg['livre']; ?> Catalogue</span>
                <h2 class="section-title" id="formations-archive-title">Toutes nos formations</h2>
                <div class="section-divider" aria-hidden="true"></div>
                <p class="section-subtitle">Chaque filière combine théorie, pratique et accompagnement personnalisé.</p>
            </div>

            <div class="formations-grid">

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <article class="formation-card card-modern reveal-section">

                            <!-- Image -->
                            <div class="card-image">
                                <a href="<?php the_permalink(); ?>" aria-label="En savoir plus sur la formation <?php echo esc_attr( get_the_title() ); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'card-thumb', [ 'alt' => '', 'loading' => 'lazy', 'decoding' => 'async' ] ); ?>
                                    <?php else : ?>
                                        <div class="card-icon-placeholder"><?php echo $svg['diplome']; ?></div>
                                    <?php endif; ?>
                                </a>
                            </div>

                            <!-- Contenu -->
                            <div class="card-content">
                                <h3>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                                <?php
                                $duree  = get_post_meta( get_the_ID(), '_dsj_duree', true );
                                $prix   = get_post_meta( get_the_ID(), '_dsj_prix', true );
                                $niveau = get_post_meta( get_the_ID(), '_dsj_niveau', true );
                                $places = get_post_meta( get_the_ID(), '_dsj_places', true );
                                ?>

                                <div class="card-meta">
                                    <?php if ( $duree ) : ?>
                                        <span class="meta-item"><?php echo $svg['horloge']; ?> <?php echo esc_html( $duree ); ?></span>
                                    <?php endif; ?>
                                    <?php if ( $prix ) : ?>
                                        <span class="meta-item"><?php echo esc_html( $prix ); ?></span>
                                    <?php endif; ?>
                                    <?php if ( $niveau ) : ?>
                                        <span class="meta-item"><?php echo esc_html( $niveau ); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="card-description">
                                    <?php
                                    if ( has_excerpt() ) {
                                        echo esc_html( wp_trim_words( get_the_excerpt(), 14, '...' ) );
                                    } else {
                                        echo esc_html( wp_trim_words( get_the_content(), 14, '...' ) );
                                    }
                                    ?>
                                </div>

                                <a href="<?php the_permalink(); ?>" class="btn-link" aria-label="En savoir plus sur <?php echo esc_attr( get_the_title() ); ?>">
                                    En savoir plus <span class="arrow" aria-hidden="true">→</span>
                                </a>
                            </div>
                        </article>

                    <?php endwhile; ?>

                    <!-- Pagination -->
                    <div class="pagination" style="grid-column: 1 / -1; margin-top: 40px;">
                        <?php
                        the_posts_pagination( [
                            'mid_size'  => 2,
                            'prev_text' => '← Précédent',
                            'next_text' => 'Suivant →',
                        ] );
                        ?>
                    </div>

                <?php else : ?>
                    <div class="no-formations" style="text-align: center; padding: 60px; grid-column: 1 / -1;">
                        <p>Aucune formation disponible pour le moment. Revenez bientôt !</p>
                        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-large">
                            <?php echo $svg['coeur']; ?> Nous contacter
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
         3. POURQUOI NOUS CHOISIR (features grid)
         ═══════════════════════════════════════════ -->
    <section class="pourquoi-section section-padding" aria-labelledby="pourquoi-title">
        <div class="container">
            <div class="section-header">
                <span class="section-badge-light"><?php echo $svg['check']; ?> Pourquoi nous choisir</span>
                <h2 class="section-title" id="pourquoi-title">Une formation de qualité</h2>
                <div class="section-divider" aria-hidden="true"></div>
            </div>
            <div class="features-grid">
                <div class="feature-card reveal-section">
                    <div class="feature-icon"><?php echo $svg['users']; ?></div>
                    <h3>Formatrices expérimentées</h3>
                    <p>Des professionnelles passionnées qui vous accompagnent tout au long de votre formation.</p>
                </div>
                <div class="feature-card reveal-section">
                    <div class="feature-icon"><?php echo $svg['award']; ?></div>
                    <h3>Certification reconnue</h3>
                    <p>Un diplôme valorisable sur le marché du travail local.</p>
                </div>
                <div class="feature-card reveal-section">
                    <div class="feature-icon"><?php echo $svg['target']; ?></div>
                    <h3>Accompagnement personnalisé</h3>
                    <p>Un suivi individuel pour garantir votre réussite.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
         4. CTA FINAL (structure identique accueil/soutenir)
         ═══════════════════════════════════════════ -->
    <section class="cta-final-section section-padding" aria-labelledby="cta-formation-title">
        <div class="container">
            <div class="cta-content reveal-section">
                <span class="cta-icon"><?php echo $svg['coeur']; ?></span>
                <h2 id="cta-formation-title">Prête à commencer votre formation ?</h2>
                <p>Contactez-nous dès aujourd'hui pour plus d'informations ou pour vous inscrire.</p>
                
                <div class="cta-actions">
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?sujet=inscription" class="btn btn-primary btn-large">
                        <?php echo $svg['diplome']; ?> Je m'inscris
                    </a>
                    <a href="<?php echo esc_url( $url_whatsapp ); ?>" class="btn btn-outline-light btn-large" target="_blank" rel="noopener noreferrer">Parler sur WhatsApp</a>
                </div>
                
                <p class="cta-whatsapp">
                    Une question ? <a href="<?php echo esc_url( $url_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">Écrivez-nous sur WhatsApp</a>
                </p>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>