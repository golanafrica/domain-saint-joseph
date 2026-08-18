<?php
/**
 * Template Name: Nous soutenir
 */

get_header(); ?>

<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_soutenir_image' );
$hero_badge     = get_theme_mod( 'hero_soutenir_badge', '🤝 Votre soutien compte' );
$hero_titre     = get_theme_mod( 'hero_soutenir_titre', 'Soutenez Notre Mission' );
$hero_soustitre = get_theme_mod( 'hero_soutenir_soustitre', 'Votre générosité forme une jeune fille, accueille une famille et fait vivre le charisme des Travailleuses Missionnaires' );
?>

<section class="page-header soutenir-header">
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
            <span class="divider-icon">💛</span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
    </div>
</section>

<!-- SECTION BESOINS URGENTS -->
<?php 
$besoins_titre = get_theme_mod('besoins_urgents_titre', 'Besoin immédiat');
$besoins_texte = get_theme_mod('besoins_urgents_texte', 'Nous recherchons 5 ordinateurs portables pour notre laboratoire informatique.');
$besoins_objectif = get_theme_mod('besoins_urgents_objectif', '5 ordinateurs (2 collectés)');
$besoins_progress = get_theme_mod('besoins_urgents_progress', '40');
?>
<section class="besoins-urgents section-padding">
    <div class="container">
        <div class="besoins-urgents-content">
            <div class="besoins-urgents-icon">🚨</div>
            <h2><?php echo esc_html( $besoins_titre ); ?></h2>
            <p><?php echo esc_html( $besoins_texte ); ?></p>
            <div class="progress-bar">
                <div class="progress-bar-bg">
                    <div class="progress" style="width: <?php echo esc_attr( $besoins_progress ); ?>%;"><?php echo esc_html( $besoins_progress ); ?>%</div>
                </div>
            </div>
            <p class="montant-objectif"><?php echo esc_html( $besoins_objectif ); ?></p>
            <a href="/contact" class="btn btn-primary">Contribuer →</a>
        </div>
    </div>
</section>

<!-- SECTION POURQUOI NOUS SOUTENIR -->
<?php 
$soutenir_texte_intro = get_theme_mod('soutenir_texte_intro', 'Depuis 2022, le Domaine Saint Joseph accompagne des dizaines de jeunes filles vers l\'autonomie grâce à la formation technique et offre un lieu d\'accueil bienveillant aux voyageurs et familles.');
?>
<section class="pourquoi-soutenir section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">💚 Pourquoi donner ?</span>
            <h2 class="section-title">Pourquoi votre soutien compte ?</h2>
            <div class="section-divider"></div>
        </div>
        <div class="pourquoi-content">
            <p><?php echo wp_kses_post( $soutenir_texte_intro ); ?></p>
            <p>Votre contribution permet de :</p>
            <div class="pourquoi-list">
                <div class="pourquoi-item">
                    <span class="pourquoi-icon">🎓</span>
                    <div>
                        <h3>Financer une inscription</h3>
                        <p>Frais de scolarité, matériel de couture/informatique</p>
                    </div>
                </div>
                <div class="pourquoi-item">
                    <span class="pourquoi-icon">🏠</span>
                    <div>
                        <h3>Entretenir les locaux</h3>
                        <p>Chambres, chapelle, salles de formation</p>
                    </div>
                </div>
                <div class="pourquoi-item">
                    <span class="pourquoi-icon">🤝</span>
                    <div>
                        <h3>Accompagner les plus fragiles</h3>
                        <p>Bourses sociales, hébergement d'urgence</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION MODALITÉS DE CONTRIBUTION -->
<?php 
$montants_suggeres = get_theme_mod('montants_suggeres', '5 000 F,10 000 F,25 000 F,50 000 F,Autre');
$montants_array = explode(',', $montants_suggeres);
$parrainage_prix = get_theme_mod('parrainage_prix', '50 000 F CFA / mois');
?>
<section class="modalites-section section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">💝 Comment contribuer ?</span>
            <h2 class="section-title">Modalités de contribution</h2>
            <div class="section-divider"></div>
        </div>
        
        <div class="modalites-grid">
            <div class="modalite-card">
                <div class="modalite-icon">💰</div>
                <h3>Don Financier</h3>
                <p>Un don ponctuel ou mensuel pour soutenir les frais de fonctionnement et les bourses.</p>
                <div class="montants-suggeres">
                    <?php foreach ( $montants_array as $montant ) : ?>
                        <span class="montant"><?php echo esc_html( trim( $montant ) ); ?></span>
                    <?php endforeach; ?>
                </div>
                <a href="#paiement" class="btn-link">Voir les moyens de paiement →</a>
            </div>
            
            <div class="modalite-card">
                <div class="modalite-icon">🤲</div>
                <h3>Parrainage Élève</h3>
                <p>Parrainez une jeune fille pour toute sa formation. Suivi régulier et rapport d'activité.</p>
                <p class="prix-parrainage"><strong><?php echo esc_html( $parrainage_prix ); ?></strong></p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?sujet=parrainage" class="btn btn-primary btn-small">🤲 Je parraine</a>
                <a href="#paiement" class="btn-link">Voir les moyens de paiement →</a>
            </div>
            
            <div class="modalite-card">
                <div class="modalite-icon">📦</div>
                <h3>Don Matériel</h3>
                <p>Machines à coudre, ordinateurs, livres, matériel de construction ou denrées alimentaires.</p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?sujet=don-materiel" class="btn btn-primary btn-small">📦 Proposer un don</a>
                <a href="#paiement" class="btn-link">Voir les besoins →</a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION MOYENS DE PAIEMENT -->
<section id="paiement" class="paiement-section section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">💳 Options de paiement</span>
            <h2 class="section-title">Moyens de Paiement</h2>
            <div class="section-divider"></div>
            <p class="section-subtitle">Sécurité et simplicité adaptées au contexte local</p>
        </div>
        
        <div class="paiement-grid">
            <div class="paiement-card">
                <div class="paiement-icon">📱</div>
                <h3>Mobile Money</h3>
                <ul class="paiement-list">
                    <li><strong>Orange Money :</strong> <span>+226 <?php echo esc_html( dsj_get_whatsapp() ); ?></span></li>
                    <li><strong>Moov Money :</strong> <span>+226 <?php echo esc_html( dsj_get_whatsapp() ); ?></span></li>
                    <li><strong>Airtel Money :</strong> <span>+226 <?php echo esc_html( dsj_get_whatsapp() ); ?></span></li>
                </ul>
                <p class="paiement-note">Référence à indiquer : <em>DSJ-Don-[Votre Nom]</em></p>
            </div>
            
            <div class="paiement-card">
                <div class="paiement-icon">🏦</div>
                <h3>Virement Bancaire</h3>
                <p>Pour les dons institutionnels ou internationaux :</p>
                <ul class="paiement-list">
                    <li><strong>Banque :</strong> Contactez-nous</li>
                    <li><strong>IBAN / RIB :</strong> Sur demande</li>
                    <li><strong>Titulaire :</strong> Domaine Saint Joseph</li>
                </ul>
                <p class="paiement-note">💬 Demandez le RIB complet par WhatsApp.</p>
            </div>
        </div>
        
        <div class="paiement-cta">
            <a href="https://wa.me/<?php echo esc_attr( dsj_get_whatsapp() ); ?>?text=Bonjour,%20je%20souhaite%20faire%20un%20don%20au%20Domaine%20Saint%20Joseph.%20Merci%20de%20me%20guider." class="btn btn-primary btn-large" target="_blank">
                💬 Confirmer mon don par WhatsApp
            </a>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?sujet=don" class="btn btn-secondary btn-large">
                📝 Formulaire de contact
            </a>
        </div>
    </div>
</section>

<!-- SECTION TÉMOIGNAGES (CPT Témoignages) -->
<section class="temoignages-donateurs section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">💬 Ils témoignent</span>
            <h2 class="section-title">Ils nous soutiennent</h2>
            <div class="section-divider"></div>
        </div>
        
        <div class="temoignages-donateurs-grid">
            <?php
            $temoignages = new WP_Query( [
                'post_type' => 'temoignage',
                'posts_per_page' => 2,
                'orderby' => 'date',
                'order' => 'DESC'
            ] );
            
            if ( $temoignages->have_posts() ) :
                while ( $temoignages->have_posts() ) : $temoignages->the_post(); ?>
                    <div class="temoignage-donateur-card">
                        <div class="temoignage-quote">"</div>
                        <div class="temoignage-content">
                            <?php echo wp_trim_words( get_the_content(), 25, '...' ); ?>
                        </div>
                        <div class="temoignage-author">
                            <strong><?php the_title(); ?></strong>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <div class="temoignage-donateur-card">
                    <div class="temoignage-quote">"</div>
                    <div class="temoignage-content">
                        Chaque don, même modeste, est une semence d'espérance. Il ne s'agit pas seulement de donner de l'argent, mais de croire en l'avenir de nos jeunes filles.
                    </div>
                    <div class="temoignage-author">
                        <strong>Sœur Responsable, Domaine Saint Joseph</strong>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- SECTION TRANSPARENCE -->
<?php 
$transparence_texte = get_theme_mod('transparence_texte', 'Chaque contribution est utilisée conformément à la mission du centre. Un reçu ou un accusé de réception vous est envoyé. Les rapports d\'activité annuels sont disponibles sur demande.');
?>
<section class="transparence-section section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">🔒 Notre engagement</span>
            <h2 class="section-title">Transparence</h2>
            <div class="section-divider"></div>
        </div>
        <div class="transparence-content">
            <p><?php echo wp_kses_post( $transparence_texte ); ?></p>
            <p class="transparence-mission"><strong>"Rigueur et Honnêteté guident notre gestion."</strong></p>
        </div>
    </div>
</section>

<!-- SECTION CTA FINAL -->
<?php 
$cta_final_titre = get_theme_mod('cta_final_titre', 'Prêt à faire la différence ?');
$cta_final_texte = get_theme_mod('cta_final_texte', 'Votre don, petit ou grand, change des vies.');
?>
<section class="cta-final-section section-padding" style="background: linear-gradient(135deg, var(--clr-primary, #1A5276) 0%, #1a3c5e 100%);">
    <div class="container">
        <div class="cta-final-content">
            <h2><?php echo esc_html( $cta_final_titre ); ?></h2>
            <p><?php echo esc_html( $cta_final_texte ); ?></p>
            <div class="cta-final-buttons">
                <a href="#paiement" class="btn btn-primary btn-large">💛 Je donne maintenant</a>
                <a href="https://wa.me/<?php echo esc_attr( dsj_get_whatsapp() ); ?>" class="btn btn-whatsapp btn-large" target="_blank">💬 Parler sur WhatsApp</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>