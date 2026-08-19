<?php
/*
Template Name: Formation
*/
get_header(); ?>

<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_formation_image' );
$hero_badge     = get_theme_mod( 'hero_formation_badge', '&#127891; Formation professionnelle' );
$hero_titre     = get_theme_mod( 'hero_formation_titre', 'Nos Formations' );
$hero_soustitre = get_theme_mod( 'hero_formation_soustitre', 'Des compétences concrètes pour l\'autonomie des jeunes filles' );
?>

<section class="page-header formation-header">
    <div class="page-photo-zone"
         <?php if ( $hero_image ) : ?>
         style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
         <?php endif; ?>>
    </div>

    <div class="header-caption-band">
        <span class="header-badge"><?php echo $hero_badge; ?></span>
        <h1 class="header-title"><?php echo esc_html( $hero_titre ); ?></h1>
        <div class="header-divider">
            <span class="divider-line"></span>
            <span class="divider-icon">&#128218;</span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
    </div>
</section>

<!-- SECTION NOS FORMATIONS (CPT Formations) -->
<section class="formations-section section-padding">
    <div class="container">
        <div class="formations-grid">
            <?php
            $formations = new WP_Query( [
                'post_type' => 'formation',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ] );
            
            if ( $formations->have_posts() ) :
                while ( $formations->have_posts() ) : $formations->the_post(); ?>
                    <div class="formation-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="card-image">
                                <?php the_post_thumbnail( 'card-thumb' ); ?>
                            </div>
                        <?php else : ?>
                            <div class="card-image">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300' viewBox='0 0 400 300'%3E%3Crect width='400' height='300' fill='%23f0f0f0'/%3E%3Ctext x='200' y='160' font-size='18' text-anchor='middle' fill='%23999' font-family='Arial'%3EFormation%3C/text%3E%3C/svg%3E" 
                                     alt="<?php the_title_attribute(); ?>"
                                     style="width:100%; height:200px; object-fit:cover;">
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <h3><?php the_title(); ?></h3>
                            
                            <?php 
                            $duree = get_post_meta( get_the_ID(), '_dsj_duree', true );
                            $prix = get_post_meta( get_the_ID(), '_dsj_prix', true );
                            $niveau = get_post_meta( get_the_ID(), '_dsj_niveau', true );
                            $places = get_post_meta( get_the_ID(), '_dsj_places', true );
                            ?>
                            
                            <div class="card-meta">
                                <?php if ( $duree ) : ?>
                                    <span class="meta-item">&#128197; <?php echo esc_html( $duree ); ?></span>
                                <?php endif; ?>
                                
                                <?php if ( $prix ) : ?>
                                    <span class="meta-item">&#128176; <?php echo esc_html( $prix ); ?></span>
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
                                    <span class="niveau-badge">&#128218; Niveau: <?php echo esc_html( $niveau ); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="formation-footer">
                                <a href="<?php the_permalink(); ?>" class="btn-link">En savoir plus &#8594;</a>
                                <a href="https://wa.me/<?php echo get_theme_mod( 'whatsapp', '22666605890' ); ?>?text=Bonjour,%20je%20suis%20intéressée%20par%20la%20formation%20<?php echo urlencode( get_the_title() ); ?>" 
                                   class="btn-whatsapp-small" target="_blank">
                                   &#128172; S'inscrire
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <div class="no-formations">
                    <p>Aucune formation disponible pour le moment. Revenez bientôt !</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- SECTION POURQUOI NOUS CHOISIR -->
<section class="pourquoi-section section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">&#11088; Pourquoi nous choisir</span>
            <h2 class="section-title">Une formation de qualité</h2>
            <div class="section-divider"></div>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">&#128105;&#8205;&#127979;</div>
                <h3>Formatrices expérimentées</h3>
                <p>Des professionnelles passionnées qui vous accompagnent tout au long de votre formation.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">&#127942;</div>
                <h3>Certification reconnue</h3>
                <p>Un diplôme valorisable sur le marché du travail local.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">&#129309;</div>
                <h3>Accompagnement personnalisé</h3>
                <p>Un suivi individuel pour garantir votre réussite.</p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION CTA -->
<section class="cta-formation section-padding">
    <div class="container">
        <div class="cta-content">
            <h2>Prête à commencer votre formation ?</h2>
            <p>Contactez-nous dès aujourd'hui pour plus d'informations ou pour vous inscrire.</p>
            <div class="cta-buttons">
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">&#128222; Nous contacter</a>
                <a href="https://wa.me/<?php echo get_theme_mod( 'whatsapp', '22666605890' ); ?>?text=Bonjour,%20je%20souhaite%20des%20informations%20sur%20les%20formations" 
                   class="btn btn-whatsapp" target="_blank">
                   &#128241; WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>