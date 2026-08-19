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
                    <span class="header-badge">&#127891; Formation professionnelle</span>
                    <h1 class="header-title"><?php the_title(); ?></h1>
                    <div class="header-divider">
                        <span class="divider-line"></span>
                        <span class="divider-icon">&#128218;</span>
                        <span class="divider-line"></span>
                    </div>
                </div>
            </div>
            <div class="header-wave">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
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
                            <?php the_post_thumbnail( 'large', [ 
                                'class' => 'img-responsive',
                                'loading' => 'lazy'
                            ] ); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-formation.jpg" 
                                 alt="Image de la formation"
                                 loading="lazy">
                        <?php endif; ?>
                    </div>
                    
                    <!-- Colonne infos -->
                    <div class="formation-single-infos">
                        <div class="infos-card">
                            <h3>&#128203; Détails de la formation</h3>
                            
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
                                <span class="info-label">&#128197; Durée :</span>
                                <span class="info-value"><?php echo esc_html( $duree ); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $prix ) : ?>
                            <div class="info-row">
                                <span class="info-label">&#128176; Prix :</span>
                                <span class="info-value"><?php echo esc_html( $prix ); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $niveau ) : ?>
                            <div class="info-row">
                                <span class="info-label">&#128218; Niveau requis :</span>
                                <span class="info-value"><?php echo esc_html( $niveau ); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $places ) : ?>
                            <div class="info-row">
                                <span class="info-label">&#128101; Places disponibles :</span>
                                <span class="info-value"><?php echo esc_html( $places ); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $formateur ) : ?>
                            <div class="info-row">
                                <span class="info-label">&#128105;&#8205;&#127979; Formatrice :</span>
                                <span class="info-value"><?php echo esc_html( $formateur ); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $horaires ) : ?>
                            <div class="info-row">
                                <span class="info-label">&#9200; Horaires :</span>
                                <span class="info-value"><?php echo esc_html( $horaires ); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="inscription-cta">
                            <a href="https://wa.me/<?php echo get_theme_mod( 'whatsapp', '22666605890' ); ?>?text=<?php echo urlencode( 'Bonjour, je souhaite m\'inscrire à la formation ' . get_the_title() ); ?>" 
                               class="btn btn-primary btn-large" 
                               target="_blank"
                               rel="noopener noreferrer">
                               &#128172; S'inscrire par WhatsApp
                            </a>
                            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-outline btn-large">
                               &#128222; Demander un renseignement
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Description complète -->
                <div class="formation-description">
                    <h3>&#128214; Description de la formation</h3>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                </div>
                
                <!-- Badges de la formation (si tu as des catégories ou tags) -->
                <?php 
                $terms = get_the_terms( get_the_ID(), 'formation_category' );
                if ( $terms && ! is_wp_error( $terms ) ) : 
                ?>
                <div class="formation-badges">
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