<?php
/**
 * Page d'accueil — Avec palette de couleurs discrète
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <!-- ===== HERO SLIDER OPTIMISÉ ===== -->
    <?php if ( get_theme_mod( 'hero_slider_active', false ) ) : 
        $slides = [];
        for ( $i = 1; $i <= 5; $i++ ) {
            $image = get_theme_mod( "hero_slide_{$i}_image" );
            if ( $image ) {
                $slides[] = [
                    'image' => $image,
                    'titre' => get_theme_mod( "hero_slide_{$i}_titre", '' ),
                    'soustitre' => get_theme_mod( "hero_slide_{$i}_soustitre", '' ),
                    'badge' => get_theme_mod( "hero_slide_{$i}_badge", '' ),
                ];
            }
        }
        
        if ( ! empty( $slides ) ) : ?>
            <div class="hero-slider" data-speed="<?php echo get_theme_mod( 'hero_slider_speed', '5000' ); ?>">
                <div class="hero-slides-container">
                    <?php foreach ( $slides as $index => $slide ) : ?>
                        <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>" 
                             style="background-image: url(<?php echo esc_url( $slide['image'] ); ?>); 
                                    <?php echo $index !== 0 ? 'display: none;' : ''; ?>">
                            <div class="hero-overlay" style="background: rgba(26, 60, 94, 0.5);"></div>
                            <div class="hero-content-wrapper">
                                <div class="container">
                                    <div class="hero-content <?php echo $index === 0 ? 'active' : ''; ?>">
                                        <?php if ( $slide['badge'] ) : ?>
                                            <span class="hero-badge"><?php echo esc_html( $slide['badge'] ); ?></span>
                                        <?php endif; ?>
                                        
                                        <h1 class="hero-title"><?php echo wp_kses_post( $slide['titre'] ); ?></h1>
                                        
                                        <?php if ( $slide['soustitre'] ) : ?>
                                            <p class="hero-subtitle"><?php echo esc_html( $slide['soustitre'] ); ?></p>
                                        <?php endif; ?>
                                        
                                        <div class="hero-buttons">
                                            <a href="<?php echo esc_url( home_url( '/formation' ) ); ?>" class="btn btn-primary btn-large">🎓 Nos formations</a>
                                            <a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>" class="btn btn-secondary btn-large">🏠 Découvrir l'accueil</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Navigation -->
                <button class="slider-btn slider-prev" aria-label="Précédent">‹</button>
                <button class="slider-btn slider-next" aria-label="Suivant">›</button>
                
                <div class="slider-dots">
                    <?php foreach ( $slides as $index => $slide ) : ?>
                        <span class="slider-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>"></span>
                    <?php endforeach; ?>
                </div>
            </div>
            
        <?php endif; ?>
    <?php elseif ( is_active_sidebar( 'hero-area' ) ) : ?>
        <div class="hero-widget-container">
            <?php dynamic_sidebar( 'hero-area' ); ?>
        </div>
    <?php else : ?>
        <!-- Hero par défaut (sans slider) -->
        <section class="custom-hero default-hero" style="background: linear-gradient(135deg, var(--clr-primary, #1A5276) 0%, #1a3c5e 100%);">
            <div class="hero-overlay" style="background: rgba(26, 60, 94, 0.5);"></div>
            <div class="hero-content-wrapper">
                <div class="container">
                    <div class="hero-content">
                        <span class="hero-badge">✝ Travailleuses Missionnaires de l'Immaculée</span>
                        <h1 class="hero-title">Former les jeunes filles,<br><span class="hero-highlight">accueillir avec compassion</span></h1>
                        <p class="hero-subtitle">Centre de formation technique & Maison d'accueil<br>Bobo-Dioulasso, Burkina Faso — depuis 2022</p>
                        <div class="hero-buttons">
                            <a href="<?php echo esc_url( home_url( '/formation' ) ); ?>" class="btn btn-primary btn-large">🎓 Nos formations</a>
                            <a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>" class="btn btn-secondary btn-large">🏠 Découvrir l'accueil</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
    <?php endif; ?>

    <!-- ===== NOTRE HISTOIRE ===== -->
    <?php 
    $histoire_texte = get_theme_mod('histoire_texte', 'Le Domaine Saint Joseph a été créé en <strong>2022</strong>. Ce centre est une expression du charisme des <strong>Travailleuses Missionnaires de l\'Immaculée</strong>.');
    ?>
    <section class="home-histoire section-padding bg-bleu-clair">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">📖 Notre histoire</span>
                <h2 class="section-title">Le Domaine Saint Joseph</h2>
                <div class="section-divider"></div>
            </div>
            <div class="histoire-content">
                <?php echo wp_kses_post( $histoire_texte ); ?>
            </div>
        </div>
    </section>

    <!-- ===== STATISTIQUES ===== -->
    <section class="stats-section bg-gris">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item" data-count="2022">
                    <div class="stat-label"><?php echo get_theme_mod( 'stat1_lbl', 'Fondé en' ); ?></div>
                    <div class="stat-number"><?php echo get_theme_mod( 'stat1_nb', '2022' ); ?></div>
                </div>
                <div class="stat-item" data-count="3">
                    <div class="stat-label"><?php echo get_theme_mod( 'stat2_lbl', 'Filières' ); ?></div>
                    <div class="stat-number"><?php echo get_theme_mod( 'stat2_nb', '3+' ); ?></div>
                </div>
                <div class="stat-item" data-count="100">
                    <div class="stat-label"><?php echo get_theme_mod( 'stat3_lbl', 'Dédié aux femmes' ); ?></div>
                    <div class="stat-number"><?php echo get_theme_mod( 'stat3_nb', '100%' ); ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Bobo-Dioulasso</div>
                    <div class="stat-number">Secteur 25</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== NOS FORMATIONS ===== -->
    <section class="home-formations section-padding bg-blanc">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🎓 Excellence académique</span>
                <h2 class="section-title">Nos Formations</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">Des filières concrètes pour l'autonomie des jeunes filles</p>
            </div>
            
            <div class="formations-grid">
                <?php
                $formations = new WP_Query( [
                    'post_type' => 'formation',
                    'posts_per_page' => 3,
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
                                    <div class="card-icon-placeholder">🎓</div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-content">
                                <h3><?php the_title(); ?></h3>
                                
                                <?php 
                                $duree = get_post_meta( get_the_ID(), '_dsj_duree', true );
                                $prix = get_post_meta( get_the_ID(), '_dsj_prix', true );
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
                                    <?php echo wp_trim_words( get_the_excerpt() ?: get_the_content(), 12, '...' ); ?>
                                </div>
                                
                                <div class="card-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn-link">En savoir plus →</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <div class="no-content">
                        <p>Aucune formation disponible pour le moment.</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="<?php echo esc_url( home_url( '/formation' ) ); ?>" class="btn btn-primary">Voir toutes les formations</a>
            </div>
        </div>
    </section>

    <!-- ===== LA MAISON D'ACCUEIL ===== -->
    <section class="home-maison-presentation section-padding bg-vert-menthe">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🏡 Ouverte à tous</span>
                <h2 class="section-title">La Maison d'Accueil</h2>
                <div class="section-divider"></div>
            </div>
            <div class="maison-content">
                <p>La Maison d'Accueil a pour but l'autoprise en charge du Centre pour soutenir la formation.</p>
                <div class="services-list-home">
                    <div class="service-home-item">🕊️ Retraites, récollections</div>
                    <div class="service-home-item">🎉 Événements</div>
                    <div class="service-home-item">👨‍👩‍👧‍👦 Réunions de famille</div>
                    <div class="service-home-item">💼 Sessions de travail</div>
                    <div class="service-home-item">📊 Conférences</div>
                    <div class="service-home-item">📚 Journées d'étude</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== NOS HÉBERGEMENTS ===== -->
    <section class="home-hebergements section-padding bg-gris">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🏠 Lieu d'accueil</span>
                <h2 class="section-title">Nos Hébergements</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">Un cadre paisible pour votre séjour</p>
            </div>
            
            <div class="hebergements-grid">
                <?php
                $hebergements = new WP_Query( [
                    'post_type' => 'hebergement',
                    'posts_per_page' => 3,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ] );
                
                if ( $hebergements->have_posts() ) :
                    while ( $hebergements->have_posts() ) : $hebergements->the_post(); ?>
                        <div class="hebergement-card">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="card-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'card-thumb' ); ?>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="card-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="card-icon-placeholder">🏠</div>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-content">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                
                                <?php 
                                $capacite = get_post_meta( get_the_ID(), '_dsj_capacite', true );
                                $prix_nuit = get_post_meta( get_the_ID(), '_dsj_prix_nuit', true );
                                ?>
                                
                                <div class="card-meta">
                                    <?php if ( $capacite ) : ?>
                                        <span class="meta-item">👥 <?php echo esc_html( $capacite ); ?> pers.</span>
                                    <?php endif; ?>
                                    
                                    <?php if ( $prix_nuit ) : ?>
                                        <span class="meta-item">💰 <?php echo esc_html( $prix_nuit ); ?>/nuit</span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="card-description">
                                    <?php echo wp_trim_words( get_the_excerpt() ?: get_the_content(), 12, '...' ); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="btn-link">Voir les détails →</a>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <div class="no-content">
                        <p>Aucun hébergement disponible pour le moment.</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>" class="btn btn-primary">Voir tous les hébergements</a>
            </div>
        </div>
    </section>

    <!-- ===== SECTION APPEL À L'AIDE ===== -->
    <?php if ( get_theme_mod( 'aide_accueil_active', true ) ) : ?>
    <section class="aide-urgence section-padding bg-creme">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🤝 Soutenez notre mission</span>
                <h2 class="section-title">Comment nous aider ?</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">Votre générosité change des vies</p>
            </div>
            
            <div class="aide-urgence-grid">
                <!-- Carte Parrainage -->
                <div class="aide-card">
                    <div class="aide-card-icon"><?php echo get_theme_mod( 'aide_parrainage_icone', '👧' ); ?></div>
                    <h3><?php echo get_theme_mod( 'aide_parrainage_titre', 'Parrainez une jeune fille' ); ?></h3>
                    <p><?php echo wp_kses_post( get_theme_mod( 'aide_parrainage_texte', 'Pour seulement <strong>50 000 F CFA par mois</strong>, vous offrez une formation technique complète à une jeune fille.' ) ); ?></p>
                    <ul class="aide-list">
                        <?php for ( $i = 1; $i <= 3; $i++ ) : 
                            $avantage = get_theme_mod( "aide_parrainage_avantage_{$i}", '' );
                            if ( ! empty( $avantage ) ) : ?>
                                <li><?php echo esc_html( $avantage ); ?></li>
                            <?php endif; 
                        endfor; ?>
                    </ul>
                    <a href="<?php echo esc_url( get_theme_mod( 'aide_parrainage_lien', '/nous-soutenir' ) ); ?>" class="btn btn-primary">
                        <?php echo esc_html( get_theme_mod( 'aide_parrainage_bouton', 'Je parraine' ) ); ?> →
                    </a>
                </div>
                
                <!-- Carte Construction -->
                <div class="aide-card">
                    <div class="aide-card-icon"><?php echo get_theme_mod( 'aide_construction_icone', '🏗️' ); ?></div>
                    <h3><?php echo get_theme_mod( 'aide_construction_titre', 'Construisons ensemble' ); ?></h3>
                    <p><?php echo wp_kses_post( get_theme_mod( 'aide_construction_texte', 'Nous avons besoin de <strong>nouvelles salles de formation</strong> pour accueillir plus de jeunes filles.' ) ); ?></p>
                    <ul class="aide-list">
                        <?php for ( $i = 1; $i <= 3; $i++ ) : 
                            $besoin = get_theme_mod( "aide_construction_besoin_{$i}", '' );
                            if ( ! empty( $besoin ) ) : ?>
                                <li><?php echo esc_html( $besoin ); ?></li>
                            <?php endif; 
                        endfor; ?>
                    </ul>
                    <a href="<?php echo esc_url( get_theme_mod( 'aide_construction_lien', '/nous-soutenir' ) ); ?>" class="btn btn-primary">
                        <?php echo esc_html( get_theme_mod( 'aide_construction_bouton', 'Je contribue' ) ); ?> →
                    </a>
                </div>
                
                <!-- Carte Dons -->
                <div class="aide-card">
                    <div class="aide-card-icon">💛</div>
                    <h3>Faire un don</h3>
                    <p>Votre don, petit ou grand, soutient la formation des jeunes filles et l'entretien du centre.</p>
                    <ul class="aide-list">
                        <li>✅ Don ponctuel ou mensuel</li>
                        <li>✅ Reçu fiscal sur demande</li>
                        <li>✅ 100% dédié à la mission</li>
                    </ul>
                    <a href="<?php echo esc_url( home_url( '/nous-soutenir' ) ); ?>" class="btn btn-primary">
                        💛 Je donne →</a>
                </div>
            </div>
            
            <div class="aide-texte-supplementaire text-center mt-4">
                <p>📞 Un doute ? Contactez-nous par WhatsApp pour toute question sur les dons ou parrainages.</p>
                <a href="https://wa.me/<?php echo get_theme_mod( 'whatsapp', '22666605890' ); ?>" class="btn btn-whatsapp" target="_blank">💬 Nous contacter</a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ===== SECTION RESTAURANT ===== -->
    <section class="home-restaurant section-padding bg-blanc">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🍽️ Table d'hôte</span>
                <h2 class="section-title">Notre Restaurant</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">Cuisine locale et internationale, préparée avec amour</p>
            </div>
            
            <div class="restaurant-preview">
                <div class="restaurant-info">
                    <div class="horaires-restaurant">
                        <h3>🍳 Horaires</h3>
                        <?php 
                        $petitdej = get_theme_mod('restaurant_petitdej', '7h00 - 9h30');
                        $dejeuner = get_theme_mod('restaurant_dejeuner', '12h00 - 14h30');
                        $diner = get_theme_mod('restaurant_diner', '19h00 - 21h30');
                        ?>
                        <p><strong>Petit-déjeuner :</strong> <?php echo esc_html( $petitdej ); ?></p>
                        <p><strong>Déjeuner :</strong> <?php echo esc_html( $dejeuner ); ?></p>
                        <p><strong>Dîner :</strong> <?php echo esc_html( $diner ); ?></p>
                    </div>
                    <div class="restaurant-cta-home">
                        <a href="<?php echo esc_url( home_url( '/restaurant' ) ); ?>" class="btn btn-primary">🍽️ Découvrir la carte</a>
                        <a href="<?php echo esc_url( home_url( '/restaurant#reservation-restaurant' ) ); ?>" class="btn btn-secondary">📅 Réserver une table</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== NOS VALEURS ===== -->
    <section class="valeurs-section section-padding bg-creme">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">⭐ Nos fondamentaux</span>
                <h2 class="section-title">Nos Valeurs</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">Ce qui nous guide au quotidien</p>
            </div>
            
            <div class="valeurs-grid">
                <div class="valeur-card">
                    <div class="valeur-icon">🤝</div>
                    <h3>Respect</h3>
                    <p>De chaque personne humaine dans sa dignité</p>
                </div>
                <div class="valeur-card">
                    <div class="valeur-icon">💎</div>
                    <h3>Honnêteté</h3>
                    <p>Dans toutes nos relations et engagements</p>
                </div>
                <div class="valeur-card">
                    <div class="valeur-icon">❤️</div>
                    <h3>Compassion</h3>
                    <p>Envers les plus vulnérables</p>
                </div>
                <div class="valeur-card">
                    <div class="valeur-icon">🌿</div>
                    <h3>Partage</h3>
                    <p>Des savoirs, ressources et expériences</p>
                </div>
                <div class="valeur-card">
                    <div class="valeur-icon">📐</div>
                    <h3>Rigueur</h3>
                    <p>Dans le travail sérieux et bien accompli</p>
                </div>
                <div class="valeur-card">
                    <div class="valeur-icon">⭐</div>
                    <h3>Excellence</h3>
                    <p>Toujours viser le meilleur de soi-même</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== GALERIE ===== -->
    <?php
    $galerie = new WP_Query( [
        'post_type' => 'galerie',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC'
    ] );
    
    if ( $galerie->have_posts() ) : ?>
    <section class="home-galerie section-padding bg-gris">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">📸 En images</span>
                <h2 class="section-title">Galerie</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">Découvrez notre cadre de vie</p>
            </div>
            
            <div class="galerie-grid">
                <?php while ( $galerie->have_posts() ) : $galerie->the_post(); ?>
                    <div class="galerie-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" class="galerie-link">
                                <?php the_post_thumbnail( 'gallery-thumb' ); ?>
                                <div class="galerie-overlay">
                                    <span class="galerie-icon">🔍</span>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="<?php echo esc_url( home_url( '/galerie' ) ); ?>" class="btn btn-secondary">Voir toute la galerie</a>
            </div>
        </div>
    </section>
    <?php 
    wp_reset_postdata();
    endif; ?>

    <!-- ===== TÉMOIGNAGES ===== -->
    <?php
    $temoignages = new WP_Query( [
        'post_type' => 'temoignage',
        'posts_per_page' => 2,
        'orderby' => 'date',
        'order' => 'DESC'
    ] );
    
    if ( $temoignages->have_posts() ) : ?>
    <section class="temoignages-section section-padding bg-blanc">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">💬 Ils parlent de nous</span>
                <h2 class="section-title">Témoignages</h2>
                <div class="section-divider"></div>
            </div>
            
            <div class="temoignages-grid">
                <?php while ( $temoignages->have_posts() ) : $temoignages->the_post(); ?>
                    <div class="temoignage-card">
                        <div class="temoignage-quote">"</div>
                        <div class="temoignage-content">
                            <?php echo wp_trim_words( get_the_content(), 30, '...' ); ?>
                        </div>
                        <div class="temoignage-author">
                            <strong><?php the_title(); ?></strong>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php 
    wp_reset_postdata();
    endif; ?>

    <!-- ===== CTA FINAL ===== -->
    <section class="cta-home-section section-padding bg-primaire">
        <div class="container">
            <div class="cta-content">
                <h2><?php echo get_theme_mod( 'cta_title', 'Soutenez notre mission' ); ?></h2>
                <p><?php echo get_theme_mod( 'cta_text', 'Votre contribution permet de former les leaders de demain. Parrainez une jeune fille ou faites un don pour soutenir le Domaine Saint Joseph.' ); ?></p>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url( home_url( get_theme_mod( 'cta_button_url', '/nous-soutenir' ) ) ); ?>" class="btn btn-primary btn-large">💛 Nous soutenir</a>
                    <a href="https://wa.me/<?php echo get_theme_mod( 'whatsapp', '22666605890' ); ?>" class="btn btn-whatsapp btn-large" target="_blank">📱 WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>