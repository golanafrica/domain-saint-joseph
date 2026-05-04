<?php
/*
Template Name: Galerie
*/
get_header(); ?>

<!-- HERO SECTION -->
<section class="page-header">
    <div class="container">
        <h1>Galerie Photos</h1>
        <p class="page-subtitle">Découvrez nos activités, nos locaux et nos apprenantes en images</p>
    </div>
</section>

<!-- FILTRES GALERIE -->
<section class="gallery-filters section-padding">
    <div class="container">
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all">Toutes</button>
            <button class="filter-btn" data-filter="formation">Formation</button>
            <button class="filter-btn" data-filter="maison">Maison d'Accueil</button>
            <button class="filter-btn" data-filter="evenements">Événements</button>
            <button class="filter-btn" data-filter="equipe">Équipe</button>
        </div>
    </div>
</section>

<!-- GRILLE GALERIE -->
<section class="gallery-grid section-padding">
    <div class="container">
        <div class="grid-gallery">
            <!-- Exemple : Photo Formation -->
            <figure class="gallery-item" data-category="formation">
                <img 
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-formation.jpg" 
                    data-src="<?php echo get_template_directory_uri(); ?>/assets/images/formation-couture.jpg" 
                    alt="Apprenantes en atelier de couture"
                    class="lazy"
                    loading="lazy"
                    width="400"
                    height="300"
                >
                <figcaption>
                    <span class="gallery-category">Formation</span>
                    <p>Atelier de couture — Promotion 2024</p>
                </figcaption>
            </figure>

            <!-- Exemple : Photo Maison d'Accueil -->
            <figure class="gallery-item" data-category="maison">
                <img 
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-maison.jpg" 
                    data-src="<?php echo get_template_directory_uri(); ?>/assets/images/chambre-simple.jpg" 
                    alt="Chambre simple ventilée"
                    class="lazy"
                    loading="lazy"
                    width="400"
                    height="300"
                >
                <figcaption>
                    <span class="gallery-category">Maison d'Accueil</span>
                    <p>Chambre simple — Confort et calme</p>
                </figcaption>
            </figure>

            <!-- Exemple : Photo Événement -->
            <figure class="gallery-item" data-category="evenements">
                <img 
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-event.jpg" 
                    data-src="<?php echo get_template_directory_uri(); ?>/assets/images/ceremonie-remise.jpg" 
                    alt="Cérémonie de remise des attestations"
                    class="lazy"
                    loading="lazy"
                    width="400"
                    height="300"
                >
                <figcaption>
                    <span class="gallery-category">Événements</span>
                    <p>Remise des attestations — Décembre 2024</p>
                </figcaption>
            </figure>

            <!-- Exemple : Photo Équipe -->
            <figure class="gallery-item" data-category="equipe">
                <img 
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-equipe.jpg" 
                    data-src="<?php echo get_template_directory_uri(); ?>/assets/images/equipe-accueil.jpg" 
                    alt="L'équipe d'accueil du Domaine Saint Joseph"
                    class="lazy"
                    loading="lazy"
                    width="400"
                    height="300"
                >
                <figcaption>
                    <span class="gallery-category">Équipe</span>
                    <p>L'équipe d'accueil — Bienveillance et professionnalisme</p>
                </figcaption>
            </figure>

            <!-- Dupliquer ce bloc <figure> pour ajouter plus de photos -->
            <!-- Important : remplacer les src par vos vraies images dans assets/images/ -->

        </div>

        <!-- Message si aucune photo -->
        <p class="gallery-empty text-center" style="display:none;">
            <em>Aucune photo dans cette catégorie pour le moment.</em>
        </p>
    </div>
</section>

<!-- LIGHTBOX (modale simple) -->
<div class="lightbox" id="lightbox" aria-hidden="true">
    <button class="lightbox-close" aria-label="Fermer">&times;</button>
    <img class="lightbox-img" src="" alt="">
    <p class="lightbox-caption"></p>
    <button class="lightbox-nav prev" aria-label="Précédent">&#10094;</button>
    <button class="lightbox-nav next" aria-label="Suivant">&#10095;</button>
</div>

<?php get_footer(); ?>