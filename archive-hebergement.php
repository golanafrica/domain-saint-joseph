<?php
/**
 * Archive pour les hébergements (liste)
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <!-- Header de la page -->
    <section class="page-header">
        <div class="container">
            <h1>Nos Hébergements</h1>
            <p class="page-subtitle">Chambres confortables, salles de conférence, chapelle : un lieu de repos et de ressourcement.</p>
        </div>
    </section>

    <!-- Liste des hébergements -->
    <section class="hebergements-archive section-padding">
        <div class="container">
            <div class="hebergements-grid">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="hebergement-card">
                            <!-- Image avec fallback -->
                            <div class="card-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if ( has_post_thumbnail() ) : 
                                        the_post_thumbnail( 'card-thumb' );
                                    else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-chambre.jpg" 
                                             alt="Image par défaut"
                                             style="width:100%; height:200px; object-fit:cover; background:#f0f0f0;">
                                    <?php endif; ?>
                                </a>
                            </div>
                            
                            <div class="card-content">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                
                                <?php 
                                $capacite = get_post_meta( get_the_ID(), '_dsj_capacite', true );
                                $prix_nuit = get_post_meta( get_the_ID(), '_dsj_prix_nuit', true );
                                $dispo = get_post_meta( get_the_ID(), '_dsj_dispo', true );
                                ?>
                                
                                <div class="card-meta">
                                    <?php if ( $capacite ) : ?>
                                        <span class="meta-item">👥 <?php echo esc_html( $capacite ); ?> pers.</span>
                                    <?php endif; ?>
                                    
                                    <?php if ( $prix_nuit ) : ?>
                                        <span class="meta-item">💰 <?php echo esc_html( $prix_nuit ); ?> F/nuit</span>
                                    <?php endif; ?>
                                    
                                    <?php if ( $dispo ) : ?>
                                        <span class="meta-item">
                                            <?php 
                                            if ( $dispo === 'disponible' ) echo '✅ Disponible';
                                            elseif ( $dispo === 'sur_reservation' ) echo '📞 Sur réservation';
                                            else echo '❌ Complet';
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Petite description -->
                                <div class="card-description">
                                    <?php 
                                    if ( has_excerpt() ) {
                                        echo wp_trim_words( get_the_excerpt(), 15, '...' );
                                    } else {
                                        echo wp_trim_words( get_the_content(), 15, '...' );
                                    }
                                    ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="btn-link">
                                    Voir les détails →
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    
                    <div class="pagination">
                        <?php 
                        the_posts_pagination( [
                            'mid_size' => 2,
                            'prev_text' => '← Précédent',
                            'next_text' => 'Suivant →',
                        ] ); 
                        ?>
                    </div>
                    
                <?php else : ?>
                    <p>Aucun hébergement disponible pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
</main>

<?php get_footer(); ?>