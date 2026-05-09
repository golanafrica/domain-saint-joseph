<?php
/**
 * Template pour l'affichage d'une formation individuelle
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <?php while ( have_posts() ) : the_post(); ?>
        
        <!-- Hero section -->
        <section class="page-header formation-single-header">
            <div class="container">
                <div class="header-content">
                    <span class="header-badge">🎓 Formation professionnelle</span>
                    <h1 class="header-title"><?php the_title(); ?></h1>
                    <div class="header-divider">
                        <span class="divider-line"></span>
                        <span class="divider-icon">📚</span>
                        <span class="divider-line"></span>
                    </div>
                </div>
            </div>
            <div class="header-wave">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
                    <path fill="#ffffff" fill-opacity="1" d="M0,64L80,58.7C160,53,320,43,480,48C640,53,800,75,960,80C1120,85,1280,75,1360,69.3L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
                </svg>
            </div>
        </section>

        <!-- Contenu principal -->
        <section class="formation-single section-padding">
            <div class="container">
                <div class="formation-single-grid">
                    <!-- Colonne image -->
                    <div class="formation-single-image">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', [ 'class' => 'img-responsive' ] ); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-formation.jpg" alt="Image de la formation">
                        <?php endif; ?>
                    </div>
                    
                    <!-- Colonne infos -->
                    <div class="formation-single-infos">
                        <div class="infos-card">
                            <h3>📋 Détails de la formation</h3>
                            
                            <?php 
                            $duree = get_post_meta( get_the_ID(), '_dsj_duree', true );
                            $prix = get_post_meta( get_the_ID(), '_dsj_prix', true );
                            $niveau = get_post_meta( get_the_ID(), '_dsj_niveau', true );
                            $places = get_post_meta( get_the_ID(), '_dsj_places', true );
                            $formateur = get_post_meta( get_the_ID(), '_dsj_formateur', true );
                            $horaires = get_post_meta( get_the_ID(), '_dsj_horaires', true );
                            ?>
                            
                            <?php if ( $duree ) : ?>
                            <div class="info-row">
                                <span class="info-label">📅 Durée :</span>
                                <span class="info-value"><?php echo esc_html( $duree ); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $prix ) : ?>
                            <div class="info-row">
                                <span class="info-label">💰 Prix :</span>
                                <span class="info-value"><?php echo esc_html( $prix ); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $niveau ) : ?>
                            <div class="info-row">
                                <span class="info-label">📚 Niveau requis :</span>
                                <span class="info-value"><?php echo esc_html( $niveau ); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $places ) : ?>
                            <div class="info-row">
                                <span class="info-label">👥 Places disponibles :</span>
                                <span class="info-value"><?php echo esc_html( $places ); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $formateur ) : ?>
                            <div class="info-row">
                                <span class="info-label">👩‍🏫 Formatrice :</span>
                                <span class="info-value"><?php echo esc_html( $formateur ); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $horaires ) : ?>
                            <div class="info-row">
                                <span class="info-label">⏰ Horaires :</span>
                                <span class="info-value"><?php echo esc_html( $horaires ); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="inscription-cta">
                            <a href="https://wa.me/<?php echo get_theme_mod( 'whatsapp', '22666605890' ); ?>?text=Bonjour,%20je%20souhaite%20m'inscrire%20à%20la%20formation%20<?php echo urlencode( get_the_title() ); ?>" 
                               class="btn btn-primary btn-large" target="_blank">
                               💬 S'inscrire par WhatsApp
                            </a>
                            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-outline btn-large">
                               📞 Demander un renseignement
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Description complète -->
                <div class="formation-description">
                    <h3>📖 Description de la formation</h3>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>
        
    <?php endwhile; ?>
    
</main>

<?php get_footer(); ?>