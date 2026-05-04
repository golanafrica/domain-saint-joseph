<?php
/*
Template Name: Formation Technique
*/
get_header(); ?>

<section class="page-header">
    <div class="container">
        <h1>Nos Filières de Formation</h1>
        <p class="page-subtitle">Des compétences concrètes pour l'autonomie des jeunes filles</p>
    </div>
</section>

<section class="formations-list section-padding">
    <div class="container">
        <div class="grid-3">
            <!-- Couture & Mode -->
            <article class="card-formation">
                <div class="card-icon">🧵</div>
                <h3>Couture & Mode</h3>
                <ul>
                    <li>Techniques de coupe et assemblage</li>
                    <li>Stylisme et création de modèles</li>
                    <li>Gestion d'un atelier de couture</li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?filiere=couture" class="btn btn-outline">
                    S'inscrire →
                </a>
            </article>

            <!-- Informatique -->
            <article class="card-formation">
                <div class="card-icon">💻</div>
                <h3>Informatique</h3>
                <ul>
                    <li>Bureautique (Word, Excel, PowerPoint)</li>
                    <li>Initiation à la programmation</li>
                    <li>Création de contenu numérique</li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?filiere=informatique" class="btn btn-outline">
                    S'inscrire →
                </a>
            </article>

            <!-- Entrepreneuriat -->
            <article class="card-formation">
                <div class="card-icon">🚀</div>
                <h3>Entrepreneuriat</h3>
                <ul>
                    <li>Élaboration de business plan</li>
                    <li>Gestion financière de base</li>
                    <li>Marketing digital pour TPE</li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?filiere=entrepreneuriat" class="btn btn-outline">
                    S'inscrire →
                </a>
            </article>
        </div>

        <!-- Infos pratiques -->
        <div class="infos-pratiques bg-light section-padding">
            <h2 class="text-center">Informations Pratiques</h2>
            <div class="grid-2">
                <div>
                    <h4>📅 Durée des formations</h4>
                    <p>6 à 12 mois selon la filière, avec stages pratiques inclus.</p>
                </div>
                <div>
                    <h4>💰 Modalités</h4>
                    <p>Paiement échelonné possible. Bourses d'excellence sur critères sociaux.</p>
                </div>
            </div>
            <p class="text-center">
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">
                    Télécharger la brochure (PDF)
                </a>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>