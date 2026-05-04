<?php get_header(); ?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="container">
        <h1>Former les jeunes filles, accueillir avec compassion</h1>
        <p class="hero-subtitle">Centre de formation technique & Maison d'accueil — Bobo-Dioulasso</p>
        <div class="hero-cta">
            <a href="<?php echo esc_url( home_url( '/formation' ) ); ?>" class="btn btn-primary">
                Nos formations
            </a>
            <a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>" class="btn btn-secondary">
                Réserver un séjour
            </a>
        </div>
    </div>
</section>

<!-- 2 ACTIVITÉS -->
<section class="activites section-padding">
    <div class="container">
        <h2 class="text-center">Nos Activités</h2>
        <div class="grid-2">
            <article class="card-activite">
                <div class="card-icon">🎓</div>
                <h3>Formation Technique</h3>
                <p>Couture, Informatique, Entrepreneuriat : des filières concrètes pour l'autonomie des jeunes filles.</p>
                <a href="<?php echo esc_url( home_url( '/formation' ) ); ?>" class="btn-link">Découvrir →</a>
            </article>
            <article class="card-activite">
                <div class="card-icon">🏠</div>
                <h3>Maison d'Accueil</h3>
                <p>Chambres confortables, salles de conférence, chapelle : un lieu de repos et de ressourcement.</p>
                <a href="<?php echo esc_url( home_url( '/maison-accueil' ) ); ?>" class="btn-link">Voir les disponibilités →</a>
            </article>
        </div>
    </div>
</section>

<!-- VALEURS -->
<section class="valeurs section-padding bg-light">
    <div class="container">
        <h2 class="text-center">Nos Valeurs</h2>
        <div class="grid-6">
            <?php 
            $valeurs = ['Respect', 'Honnêteté', 'Compassion', 'Partage', 'Rigueur', 'Excellence'];
            foreach ( $valeurs as $valeur ) : ?>
                <div class="valeur-item"><?php echo esc_html( $valeur ); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- APPEL À L'ACTION -->
<section class="cta section-padding">
    <div class="container text-center">
        <h2>Soutenez notre mission</h2>
        <p>Votre contribution permet de former les leaders de demain.</p>
        <a href="<?php echo esc_url( home_url( '/nous-soutenir' ) ); ?>" class="btn btn-primary">
            Nous Soutenir
        </a>
    </div>
</section>

<?php get_footer(); ?>