<?php
/**
 * Template Name: À propos
 */
get_header(); ?>

<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_apropos_image' );
$hero_badge     = get_theme_mod( 'hero_apropos_badge', '? Notre histoire' );
$hero_titre     = get_theme_mod( 'hero_apropos_titre', 'À propos de nous' );
$hero_soustitre = get_theme_mod( 'hero_apropos_soustitre', 'Travailleuses Missionnaires de l\'Immaculée - Un engagement au service des femmes et des familles' );
?>

<section class="page-header apropos-header">
    <div class="page-photo-zone"
         <?php if ( $hero_image ) : ?>
         style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
         <?php endif; ?>>
    </div>
    <div class="header-caption-band">
        <span class="header-badge"><?php echo esc_html( $hero_badge ); ?></span>
        <h1 class="header-title"><?php echo esc_html( $hero_titre ); ?></h1>
        <div class="header-divider">
            <span class="divider-line"></span>
            <span class="divider-icon">?</span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
    </div>
</section>

<!-- SECTION NOTRE HISTOIRE -->
<section class="histoire-section section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">? Notre histoire</span>
            <h2 class="section-title">Le Domaine Saint Joseph</h2>
            <div class="section-divider"></div>
        </div>
        <div class="histoire-content">
            <p>Le Domaine Saint Joseph a été créé en <strong>2022</strong>. Ce centre est une expression du charisme des <strong>Travailleuses Missionnaires de l'Immaculée</strong>.</p>
            <p>Notre centre est dédié à la formation technique et à l'accueil, dans un esprit de service et de partage selon les valeurs de notre communauté.</p>
        </div>
    </div>
</section>

<!-- SECTION NOTRE MISSION (Personnalisable via Customizer) -->
<section class="mission-section section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">? Notre raison d'être</span>
            <h2 class="section-title">Notre Mission</h2>
            <div class="section-divider"></div>
        </div>
        
        <div class="mission-detail">
            <p class="mission-statement">Soutenir, encourager les jeunes filles et les jeunes mamans à acquérir des compétences techniques dans le but d'assumer des responsabilités dans la vie courante.</p>
        </div>
        
        <div class="mission-grid">
            <!-- Mission 1 - Former -->
            <div class="mission-card">
                <?php if ( get_theme_mod( 'mission_1_image' ) ) : ?>
                    <img src="<?php echo esc_url( get_theme_mod( 'mission_1_image' ) ); ?>" alt="<?php echo get_theme_mod( 'mission_1_titre', 'Former' ); ?>" class="mission-image">
                <?php else : ?>
                    <div class="mission-icon">?</div>
                <?php endif; ?>
                <h3><?php echo get_theme_mod( 'mission_1_titre', 'Former' ); ?></h3>
                <p><?php echo get_theme_mod( 'mission_1_texte', 'Offrir une formation technique de qualité aux jeunes filles pour leur autonomie financière et sociale.' ); ?></p>
            </div>
            
            <!-- Mission 2 - Accueillir -->
            <div class="mission-card">
                <?php if ( get_theme_mod( 'mission_2_image' ) ) : ?>
                    <img src="<?php echo esc_url( get_theme_mod( 'mission_2_image' ) ); ?>" alt="<?php echo get_theme_mod( 'mission_2_titre', 'Accueillir' ); ?>" class="mission-image">
                <?php else : ?>
                    <div class="mission-icon">?</div>
                <?php endif; ?>
                <h3><?php echo get_theme_mod( 'mission_2_titre', 'Accueillir' ); ?></h3>
                <p><?php echo get_theme_mod( 'mission_2_texte', 'Procurer un lieu de repos, de ressourcement et de rencontres dans un cadre paisible et sécurisé.' ); ?></p>
            </div>
            
            <!-- Mission 3 - Accompagner -->
            <div class="mission-card">
                <?php if ( get_theme_mod( 'mission_3_image' ) ) : ?>
                    <img src="<?php echo esc_url( get_theme_mod( 'mission_3_image' ) ); ?>" alt="<?php echo get_theme_mod( 'mission_3_titre', 'Accompagner' ); ?>" class="mission-image">
                <?php else : ?>
                    <div class="mission-icon">??</div>
                <?php endif; ?>
                <h3><?php echo get_theme_mod( 'mission_3_titre', 'Accompagner' ); ?></h3>
                <p><?php echo get_theme_mod( 'mission_3_texte', 'Soutenir les plus vulnérables avec compassion et bienveillance dans leurs projets de vie.' ); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION NOS VALEURS -->
<section class="nos-valeurs-section section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">? Nos fondamentaux</span>
            <h2 class="section-title">Nos Valeurs</h2>
            <div class="section-divider"></div>
            <p class="section-subtitle">Ce qui nous guide au quotidien</p>
        </div>
        
        <div class="valeurs-list">
            <div class="valeur-item">
                <span class="valeur-emoji">?</span>
                <span class="valeur-titre">Respect</span>
                <span class="valeur-desc">De la personne humaine dans sa dignité</span>
            </div>
            <div class="valeur-item">
                <span class="valeur-emoji">?</span>
                <span class="valeur-titre">Honnêteté</span>
                <span class="valeur-desc">Dans toutes nos relations et engagements</span>
            </div>
            <div class="valeur-item">
                <span class="valeur-emoji">??</span>
                <span class="valeur-titre">Compassion</span>
                <span class="valeur-desc">Envers les plus vulnérables</span>
            </div>
            <div class="valeur-item">
                <span class="valeur-emoji">?</span>
                <span class="valeur-titre">Partage</span>
                <span class="valeur-desc">Des savoirs, ressources et expériences</span>
            </div>
            <div class="valeur-item">
                <span class="valeur-emoji">?</span>
                <span class="valeur-titre">Rigueur</span>
                <span class="valeur-desc">Dans le travail sérieux et bien accompli</span>
            </div>
            <div class="valeur-item">
                <span class="valeur-emoji">?</span>
                <span class="valeur-titre">Excellence</span>
                <span class="valeur-desc">Toujours viser le meilleur de soi-même</span>
            </div>
        </div>
    </div>
</section>

<!-- SECTION NOTRE ÉQUIPE (Personnalisable via Customizer) -->
<section class="equipe-section section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">? Notre communauté</span>
            <h2 class="section-title">Notre Équipe</h2>
            <div class="section-divider"></div>
            <p class="section-subtitle">Des personnes dévouées au service des autres</p>
        </div>
        
        <div class="equipe-grid">
            <!-- Équipe 1 -->
            <div class="equipe-card">
                <div class="equipe-image">
                    <?php if ( get_theme_mod( 'equipe_1_image' ) ) : ?>
                        <img src="<?php echo esc_url( get_theme_mod( 'equipe_1_image' ) ); ?>" alt="<?php echo get_theme_mod( 'equipe_1_nom', 'S?ur Marie-Bernadette' ); ?>" class="equipe-photo">
                    <?php else : ?>
                        <div class="equipe-placeholder">?</div>
                    <?php endif; ?>
                </div>
                <h3><?php echo get_theme_mod( 'equipe_1_nom', 'S?ur Marie-Bernadette' ); ?></h3>
                <p class="equipe-fonction"><?php echo get_theme_mod( 'equipe_1_fonction', 'Supérieure de la communauté' ); ?></p>
                <p><?php echo get_theme_mod( 'equipe_1_description', 'Responsable du Domaine Saint Joseph et de l\'orientation pastorale.' ); ?></p>
            </div>
            
            <!-- Équipe 2 -->
            <div class="equipe-card">
                <div class="equipe-image">
                    <?php if ( get_theme_mod( 'equipe_2_image' ) ) : ?>
                        <img src="<?php echo esc_url( get_theme_mod( 'equipe_2_image' ) ); ?>" alt="<?php echo get_theme_mod( 'equipe_2_nom', 'S?ur Thérèse' ); ?>" class="equipe-photo">
                    <?php else : ?>
                        <div class="equipe-placeholder">?</div>
                    <?php endif; ?>
                </div>
                <h3><?php echo get_theme_mod( 'equipe_2_nom', 'S?ur Thérèse' ); ?></h3>
                <p class="equipe-fonction"><?php echo get_theme_mod( 'equipe_2_fonction', 'Responsable des formations' ); ?></p>
                <p><?php echo get_theme_mod( 'equipe_2_description', 'Coordinatrice des filières techniques et du suivi pédagogique.' ); ?></p>
            </div>
            
            <!-- Équipe 3 -->
            <div class="equipe-card">
                <div class="equipe-image">
                    <?php if ( get_theme_mod( 'equipe_3_image' ) ) : ?>
                        <img src="<?php echo esc_url( get_theme_mod( 'equipe_3_image' ) ); ?>" alt="<?php echo get_theme_mod( 'equipe_3_nom', 'S?ur Claire' ); ?>" class="equipe-photo">
                    <?php else : ?>
                        <div class="equipe-placeholder">?</div>
                    <?php endif; ?>
                </div>
                <h3><?php echo get_theme_mod( 'equipe_3_nom', 'S?ur Claire' ); ?></h3>
                <p class="equipe-fonction"><?php echo get_theme_mod( 'equipe_3_fonction', 'Responsable de l\'accueil' ); ?></p>
                <p><?php echo get_theme_mod( 'equipe_3_description', 'Gère l\'hébergement et le bien-être des hôtes et résidentes.' ); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION APPEL À L'AIDE -->
<section class="aide-section section-padding">
    <div class="container">
        <div class="aide-content">
            <span class="aide-badge">? Votre soutien compte</span>
            <h2>Nous sollicitons votre aide</h2>
            <p>Nous vous remercions pour votre contribution à la formation de ces jeunes par le moyen de parrainages ou de dons.</p>
            <div class="aide-buttons">
                <a href="<?php echo esc_url( home_url( '/nous-soutenir' ) ); ?>" class="btn btn-primary btn-large">? Faire un don</a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-secondary btn-large">? Nous contacter</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>