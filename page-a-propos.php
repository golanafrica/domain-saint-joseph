<?php
/*
Template Name: À propos
*/
get_header(); ?>

<!-- HERO SECTION -->
<section class="page-header">
    <div class="container">
        <h1>À propos du Domaine Saint Joseph</h1>
        <p class="page-subtitle">Former les jeunes filles, accueillir avec compassion depuis 2022</p>
    </div>
</section>

<!-- HISTOIRE & MISSION -->
<section class="histoire-mission section-padding">
    <div class="container">
        <div class="grid-2">
            <!-- Histoire -->
            <article class="card-text">
                <h2>📜 Notre Histoire</h2>
                <p>Fondé en <strong>2022</strong> à Bobo-Dioulasso, le Domaine Saint Joseph est né de la volonté des <strong>Travailleuses Missionnaires de l'Immaculée</strong> de répondre aux besoins éducatifs et sociaux des jeunes filles du Burkina Faso.</p>
                <p>Sur un terrain de 547 rue de Pala, Secteur 25, le centre a progressivement développé deux pôles complémentaires : un centre de formation technique et une maison d'accueil ouverte à tous.</p>
                <p>Aujourd'hui, nous accompagnons chaque année des dizaines de jeunes vers l'autonomie, tout en offrant un lieu de repos et de ressourcement aux voyageurs et pèlerins.</p>
            </article>

            <!-- Mission & Charisme -->
            <article class="card-text bg-light">
                <h2>✨ Notre Charisme</h2>
                <p>Le Domaine Saint Joseph s'inspire du charisme des <strong>Travailleuses Missionnaires de l'Immaculée</strong> :</p>
                <ul class="liste-icone">
                    <li>🙏 <strong>Prière et contemplation</strong> : ancrer l'action dans la foi</li>
                    <li>🤝 <strong>Service des plus fragiles</strong> : prioriser celles qui ont le plus besoin</li>
                    <li>🌱 <strong>Éducation libératrice</strong> : former pour transformer</li>
                    <li>🕊️ <strong>Accueil inconditionnel</strong> : chaque personne est un don</li>
                </ul>

                <h3 style="margin-top: 1.5rem;">🎯 Notre Mission</h3>
                <p><em>"Promouvoir la jeune fille par l'éducation, la formation humaine et technique"</em></p>
                <p>Nous croyons que l'autonomie des jeunes filles est un levier puissant de développement pour leurs familles et pour le Burkina Faso tout entier.</p>
            </article>
        </div>
    </div>
</section>

<!-- VALEURS -->
<section class="valeurs section-padding">
    <div class="container">
        <h2 class="text-center">Nos Valeurs</h2>
        <p class="text-center mb-2">Six piliers qui guident chacune de nos actions</p>
        
        <div class="grid-6">
            <div class="valeur-card">
                <span class="valeur-icon">🤲</span>
                <h3>Respect</h3>
                <p>De la dignité de chaque personne, sans distinction</p>
            </div>
            <div class="valeur-card">
                <span class="valeur-icon">⚖️</span>
                <h3>Honnêteté</h3>
                <p>Transparence dans la gestion et les relations</p>
            </div>
            <div class="valeur-card">
                <span class="valeur-icon">❤️</span>
                <h3>Compassion</h3>
                <p>Écoute active et accompagnement bienveillant</p>
            </div>
            <div class="valeur-card">
                <span class="valeur-icon">🤗</span>
                <h3>Partage</h3>
                <p>Mutualiser les compétences et les ressources</p>
            </div>
            <div class="valeur-card">
                <span class="valeur-icon">📏</span>
                <h3>Rigueur</h3>
                <p>Exigence dans la formation et la gestion</p>
            </div>
            <div class="valeur-card">
                <span class="valeur-icon">🏆</span>
                <h3>Excellence</h3>
                <p>Viser le meilleur pour celles que nous servons</p>
            </div>
        </div>
    </div>
</section>

<!-- ÉQUIPE -->
<section class="equipe section-padding bg-light">
    <div class="container">
        <h2 class="text-center">Notre Équipe</h2>
        <p class="text-center mb-2">Des femmes engagées au service de la mission</p>
        
        <div class="grid-3">
            <!-- Sœur responsable -->
            <article class="card-membre">
                <div class="membre-photo">👩‍🦰</div>
                <h3>Sœur [Prénom]</h3>
                <p class="membre-role">Responsable du centre</p>
                <p>Coordination générale, formation spirituelle et relations extérieures.</p>
            </article>

            <!-- Formatrice -->
            <article class="card-membre">
                <div class="membre-photo">👩‍🏫</div>
                <h3>[Prénom Nom]</h3>
                <p class="membre-role">Formatrice technique</p>
                <p>Enseignement des filières couture, informatique et entrepreneuriat.</p>
            </article>

            <!-- Gestionnaire -->
            <article class="card-membre">
                <div class="membre-photo">👩‍💼</div>
                <h3>[Prénom Nom]</h3>
                <p class="membre-role">Gestion & Accueil</p>
                <p>Administration, réservations et accompagnement des hôtes.</p>
            </article>
        </div>

        <p class="text-center small" style="margin-top: 2rem;">
            <em>📸 <strong>À venir</strong> : photos réelles de l'équipe après la prochaine session de shooting.</em>
        </p>
    </div>
</section>

<!-- CTA -->
<section class="cta section-padding">
    <div class="container text-center">
        <h2>Vous souhaitez nous soutenir ?</h2>
        <p>Votre don ou votre bénévolat permet de former une jeune fille, d'accueillir une famille, de faire vivre la mission.</p>
        <div class="hero-cta">
            <a href="<?php echo esc_url( home_url( '/nous-soutenir' ) ); ?>" class="btn btn-primary">
                Nous Soutenir
            </a>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-secondary">
                Nous Contacter
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>