<?php
/**
 * Archive des formations (liste)
 * Domaine Saint Joseph
 */
get_header(); ?>

<main id="main" class="site-main">

    <!-- Hero section -->
    <section class="page-header formation-header">
        <div class="page-photo-zone"
            <?php if ( get_theme_mod( 'hero_formation_image' ) ) : ?>
                style="background-image: url('<?php echo esc_url( get_theme_mod( 'hero_formation_image' ) ); ?>');"
            <?php endif; ?>>
        </div>
        <div class="header-caption-band">
            <span class="header-badge">
                <?php echo esc_html( get_theme_mod( 'hero_formation_badge', '🎓 Formation professionnelle' ) ); ?>
            </span>
            <h1 class="header-title">
                <?php echo esc_html( get_theme_mod( 'hero_formation_titre', 'Nos Formations' ) ); ?>
            </h1>
            <div class="header-divider">
                <span class="divider-line"></span>
                <span class="divider-icon">📚</span>
                <span class="divider-line"></span>
            </div>
            <p class="header-subtitle">
                <?php echo esc_html( get_theme_mod( 'hero_formation_soustitre', 'Des compétences concrètes pour l\'autonomie des jeunes filles' ) ); ?>
            </p>
        </div>
    </section>

    <!-- Liste des formations -->
    <section class="formations-section section-padding">
        <div class="container">
            <div class="formations-grid">

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <div class="formation-card">

                            <!-- Image -->
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="card-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'card-thumb' ); ?>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="card-image">
                                    <div class="card-icon-placeholder">🎓</div>
                                </div>
                            <?php endif; ?>

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
                                        <span class="meta-item">📅 <?php echo esc_html( $duree ); ?></span>
                                    <?php endif; ?>
                                    <?php if ( $prix ) : ?>
                                        <span class="meta-item">💰 <?php echo esc_html( $prix ); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="card-description">
                                    <?php
                                    if ( has_excerpt() ) {
                                        echo wp_trim_words( get_the_excerpt(), 15, '...' );
                                    } else {
                                        echo wp_trim_words( get_the_content(), 15, '...' );
                                    }
                                    ?>
                                </div>

                                <?php if ( $niveau ) : ?>
                                    <div class="formation-niveau">
                                        <span class="niveau-badge">📚 Niveau: <?php echo esc_html( $niveau ); ?></span>
                                    </div>
                                <?php endif; ?>

                                <div class="formation-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn-link">En savoir plus →</a>
                                    <a href="https://wa.me/<?php echo esc_attr( dsj_get_whatsapp() ); ?>?text=<?php echo urlencode( 'Bonjour, je suis intéressée par la formation ' . get_the_title() ); ?>"
                                       class="btn-whatsapp-small"
                                       target="_blank"
                                       rel="noopener noreferrer">
                                        💬 S'inscrire
                                    </a>
                                </div>
                            </div>
                        </div>

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
                        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">
                            📞 Nous contacter
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- Section Pourquoi nous choisir -->
    <section class="pourquoi-section section-padding bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">⭐ Pourquoi nous choisir</span>
                <h2 class="section-title">Une formation de qualité</h2>
                <div class="section-divider"></div>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">👩‍🏫</div>
                    <h3>Formatrices expérimentées</h3>
                    <p>Des professionnelles passionnées qui vous accompagnent tout au long de votre formation.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🆓</div>
                    <h3>Certification reconnue</h3>
                    <p>Un diplôme valorisable sur le marché du travail local.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🤝</div>
                    <h3>Accompagnement personnalisé</h3>
                    <p>Un suivi individuel pour garantir votre réussite.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="cta-formation section-padding">
        <div class="container">
            <div class="cta-content">
                <h2>Prête à commencer votre formation ?</h2>
                <p>Contactez-nous dès aujourd'hui pour plus d'informations ou pour vous inscrire.</p>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">
                        📞 Nous contacter
                    </a>
                    <a href="https://wa.me/<?php echo esc_attr( dsj_get_whatsapp() ); ?>?text=Bonjour,%20je%20souhaite%20des%20informations%20sur%20les%20formations"
                       class="btn btn-whatsapp"
                       target="_blank"
                       rel="noopener noreferrer">
                        💬 WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>