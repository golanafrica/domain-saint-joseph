<?php
/**
 * Template Name: Nous soutenir
 */

get_header(); ?>

<!-- HERO SECTION -->
<?php 
$hero_image = get_theme_mod('hero_soutenir_image');
$hero_opacity = get_theme_mod('hero_soutenir_opacity', '0.7');
$hero_badge = get_theme_mod('hero_soutenir_badge', '🤝 Votre soutien compte');
$hero_titre = get_theme_mod('hero_soutenir_titre', 'Soutenez Notre Mission');
$hero_soustitre = get_theme_mod('hero_soutenir_soustitre', 'Votre générosité forme une jeune fille, accueille une famille et fait vivre le charisme des Travailleuses Missionnaires');
?>

<section class="page-header soutenir-header" <?php if( $hero_image ) : ?>style="background-image: linear-gradient(rgba(0, 0, 0, <?php echo $hero_opacity; ?>), rgba(0, 0, 0, <?php echo $hero_opacity; ?>)), url('<?php echo esc_url( $hero_image ); ?>'); background-size: cover; background-position: center;"<?php endif; ?>>
    <div class="container">
        <div class="header-content">
            <span class="header-badge"><?php echo esc_html( $hero_badge ); ?></span>
            <h1 class="header-title"><?php echo esc_html( $hero_titre ); ?></h1>
            <div class="header-divider">
                <span class="divider-line"></span>
                <span class="divider-icon">💛</span>
                <span class="divider-line"></span>
            </div>
            <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
        </div>
    </div>
    <div class="header-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
            <path fill="#ffffff" fill-opacity="1" d="M0,64L80,58.7C160,53,320,43,480,48C640,53,800,75,960,80C1120,85,1280,75,1360,69.3L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>

<!-- SECTION POURQUOI NOUS SOUTENIR -->
<section class="pourquoi-soutenir section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">💚 Pourquoi donner ?</span>
            <h2 class="section-title">Pourquoi votre soutien compte ?</h2>
            <div class="section-divider"></div>
        </div>
        <div class="pourquoi-content">
            <p>Depuis 2022, le Domaine Saint Joseph accompagne des dizaines de jeunes filles vers l'autonomie grâce à la formation technique et offre un lieu d'accueil bienveillant aux voyageurs et familles.</p>
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
                <a href="#paiement" class="btn-link">Voir les moyens de paiement →</a>
            </div>
            
            <div class="modalite-card">
                <div class="modalite-icon">🤲</div>
                <h3>Parrainage Élève</h3>
                <p>Parrainez une jeune fille pour toute sa formation. Suivi régulier et rapport d'activité.</p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?sujet=parrainage" class="btn-link">Demander à parrainer →</a>
            </div>
            
            <div class="modalite-card">
                <div class="modalite-icon">📦</div>
                <h3>Don Matériel</h3>
                <p>Machines à coudre, ordinateurs, livres, matériel de construction ou denrées alimentaires.</p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?sujet=don-materiel" class="btn-link">Proposer un don →</a>
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
                    <li><strong>Orange Money :</strong> <span>+226 66 60 58 90</span></li>
                    <li><strong>Moov Money :</strong> <span>+226 66 60 58 90</span></li>
                    <li><strong>Airtel Money :</strong> <span>+226 66 60 58 90</span></li>
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
            <a href="https://wa.me/22666605890?text=Bonjour,%20je%20souhaite%20faire%20un%20don%20au%20Domaine%20Saint%20Joseph.%20Merci%20de%20me%20guider." class="btn btn-primary btn-large" target="_blank">
                💬 Confirmer mon don par WhatsApp
            </a>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?sujet=don" class="btn btn-secondary btn-large">
                📝 Formulaire de contact
            </a>
        </div>
    </div>
</section>

<!-- SECTION TÉMOIGNAGE D'UN PARRAIN (optionnel) -->
<section class="temoignage-donateur section-padding bg-light">
    <div class="container">
        <div class="temoignage-donateur-content">
            <div class="temoignage-donateur-quote">"</div>
            <p>"Chaque don, même modeste, est une semence d'espérance. Il ne s'agit pas seulement de donner de l'argent, mais de croire en l'avenir de nos jeunes filles."</p>
            <footer>— Sœur Responsable, Domaine Saint Joseph</footer>
        </div>
    </div>
</section>

<!-- SECTION TRANSPARENCE -->
<section class="transparence-section section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">🔒 Notre engagement</span>
            <h2 class="section-title">Transparence</h2>
            <div class="section-divider"></div>
        </div>
        <div class="transparence-content">
            <p>Chaque contribution est utilisée conformément à la mission du centre. Un reçu ou un accusé de réception vous est envoyé. Les rapports d'activité annuels sont disponibles sur demande.</p>
            <p class="transparence-mission"><strong>"Rigueur et Honnêteté guident notre gestion."</strong></p>
        </div>
    </div>
</section>

<!-- SECTION CTA FINAL -->
<section class="cta-final-section section-padding" style="background: linear-gradient(135deg, var(--clr-primary, #1A5276) 0%, #1a3c5e 100%);">
    <div class="container">
        <div class="cta-final-content">
            <h2>Prêt à faire la différence ?</h2>
            <p>Votre don, petit ou grand, change des vies.</p>
            <div class="cta-final-buttons">
                <a href="#paiement" class="btn btn-primary btn-large">💛 Je donne maintenant</a>
                <a href="https://wa.me/22666605890" class="btn btn-whatsapp btn-large" target="_blank">💬 Parler sur WhatsApp</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>