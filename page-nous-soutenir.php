<?php
/**
 * Template Name: Nous soutenir
 * Version modernisée : même langage visuel que la page d'accueil
 */

get_header(); ?>

<!-- ═══════════════════════════════════════════
     HERO SECTION
     ═══════════════════════════════════════════ -->
<?php
$hero_image     = get_theme_mod( 'hero_soutenir_image' );
$hero_badge     = get_theme_mod( 'hero_soutenir_badge', '&#128157; Votre soutien compte' );
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
        <span class="header-badge">
            <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>
            Votre soutien compte
        </span>
        <h1 class="header-title"><?php echo esc_html( $hero_titre ); ?></h1>
        <div class="header-divider">
            <span class="divider-line"></span>
            <span class="divider-icon">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>
            </span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION 1 : BESOINS URGENTS (bandeau d'alerte)
     ═══════════════════════════════════════════ -->
<?php 
$besoins_titre    = get_theme_mod('besoins_urgents_titre', 'Besoin immédiat');
$besoins_texte    = get_theme_mod('besoins_urgents_texte', 'Nous recherchons 5 ordinateurs portables pour notre laboratoire informatique.');
$besoins_objectif = get_theme_mod('besoins_urgents_objectif', '5 ordinateurs (2 collectés)');
$besoins_progress = get_theme_mod('besoins_urgents_progress', '40');
?>
<section class="besoins-urgents section-padding reveal-section">
    <div class="container">
        <div class="besoins-urgents-content">
            <div class="besoins-urgents-icon">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
            <h2><?php echo esc_html( $besoins_titre ); ?></h2>
            <p><?php echo esc_html( $besoins_texte ); ?></p>
            <div class="progress-bar">
                <div class="progress-bar-bg">
                    <div class="progress" style="width: <?php echo esc_attr( $besoins_progress ); ?>%;"><?php echo esc_html( $besoins_progress ); ?>%</div>
                </div>
            </div>
            <p class="montant-objectif"><?php echo esc_html( $besoins_objectif ); ?></p>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-large">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>
                Contribuer maintenant
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION 2 : POURQUOI NOUS SOUTENIR
     ═══════════════════════════════════════════ -->
<?php 
$soutenir_texte_intro = get_theme_mod('soutenir_texte_intro', 'Depuis 2022, le Domaine Saint Joseph accompagne des dizaines de jeunes filles vers l\'autonomie grâce à la formation technique et offre un lieu d\'accueil bienveillant aux voyageurs et familles.');
?>
<section class="pourquoi-soutenir section-padding reveal-section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge-light">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                Pourquoi donner ?
            </span>
            <h2 class="section-title">Pourquoi votre soutien compte ?</h2>
            <div class="section-divider"></div>
        </div>
        <div class="pourquoi-content">
            <p><?php echo wp_kses_post( $soutenir_texte_intro ); ?></p>
            <p><strong>Votre contribution permet de :</strong></p>
            <div class="pourquoi-list">
                <div class="pourquoi-item">
                    <span class="pourquoi-icon">
                        <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                        </svg>
                    </span>
                    <div>
                        <h3>Financer une inscription</h3>
                        <p>Frais de scolarité, matériel de couture/informatique</p>
                    </div>
                </div>
                <div class="pourquoi-item">
                    <span class="pourquoi-icon">
                        <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                        </svg>
                    </span>
                    <div>
                        <h3>Entretenir les locaux</h3>
                        <p>Chambres, chapelle, salles de formation</p>
                    </div>
                </div>
                <div class="pourquoi-item">
                    <span class="pourquoi-icon">
                        <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </span>
                    <div>
                        <h3>Accompagner les plus fragiles</h3>
                        <p>Bourses sociales, hébergement d'urgence</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION 3 : MODALITÉS DE CONTRIBUTION
     ═══════════════════════════════════════════ -->
<?php 
$montants_suggeres = get_theme_mod('montants_suggeres', '5 000 F,10 000 F,25 000 F,50 000 F,Autre');
$montants_array    = explode(',', $montants_suggeres);
$parrainage_prix   = get_theme_mod('parrainage_prix', '50 000 F CFA / mois');
?>
<section class="modalites-section section-padding bg-light reveal-section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge-light">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                Comment contribuer ?
            </span>
            <h2 class="section-title">Modalités de contribution</h2>
            <div class="section-divider"></div>
        </div>
        
        <div class="modalites-grid">
            <!-- Don Financier -->
            <div class="modalite-card">
                <div class="modalite-icon">
                    <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="6" width="20" height="12" rx="2"/>
                        <circle cx="12" cy="12" r="2"/>
                        <path d="M6 12h.01M18 12h.01"/>
                    </svg>
                </div>
                <h3>Don Financier</h3>
                <p>Un don ponctuel ou mensuel pour soutenir les frais de fonctionnement et les bourses.</p>
                <div class="montants-suggeres">
                    <?php foreach ( $montants_array as $montant ) : ?>
                        <span class="montant"><?php echo esc_html( trim( $montant ) ); ?></span>
                    <?php endforeach; ?>
                </div>
                <a href="#paiement" class="btn-link">Voir les moyens de paiement →</a>
            </div>
            
            <!-- Parrainage -->
            <div class="modalite-card">
                <div class="modalite-icon">
                    <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3>Parrainage Élève</h3>
                <p>Parrainez une jeune fille pour toute sa formation. Suivi régulier et rapport d'activité.</p>
                <p class="prix-parrainage"><strong><?php echo esc_html( $parrainage_prix ); ?></strong></p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?sujet=parrainage" class="btn btn-primary btn-large">
                    <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>
                    Je parraine
                </a>
                <a href="#paiement" class="btn-link">Voir les moyens de paiement →</a>
            </div>
            
            <!-- Don Matériel -->
            <div class="modalite-card">
                <div class="modalite-icon">
                    <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 12 20 22 4 22 4 12"/>
                        <rect x="2" y="7" width="20" height="5"/>
                        <line x1="12" y1="22" x2="12" y2="7"/>
                        <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/>
                        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/>
                    </svg>
                </div>
                <h3>Don Matériel</h3>
                <p>Machines à coudre, ordinateurs, livres, matériel de construction ou denrées alimentaires.</p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?sujet=don-materiel" class="btn btn-primary btn-large">
                    <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 12 20 22 4 22 4 12"/>
                        <rect x="2" y="7" width="20" height="5"/>
                        <line x1="12" y1="22" x2="12" y2="7"/>
                    </svg>
                    Proposer un don
                </a>
                <a href="#paiement" class="btn-link">Voir les besoins →</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION 4 : MOYENS DE PAIEMENT
     ═══════════════════════════════════════════ -->
<section id="paiement" class="paiement-section section-padding reveal-section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge-light">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                Options de paiement
            </span>
            <h2 class="section-title">Moyens de Paiement</h2>
            <div class="section-divider"></div>
            <p class="section-subtitle">Sécurité et simplicité adaptées au contexte local</p>
        </div>
        
        <div class="paiement-grid">
            <!-- Mobile Money -->
            <div class="paiement-card">
                <div class="paiement-icon">
                    <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                        <line x1="12" y1="18" x2="12.01" y2="18"/>
                    </svg>
                </div>
                <h3>Mobile Money</h3>
                <ul class="paiement-list">
                    <li><strong>Orange Money :</strong> <span>+226 <?php echo esc_html( dsj_get_whatsapp() ); ?></span></li>
                    <li><strong>Moov Money :</strong> <span>+226 <?php echo esc_html( dsj_get_whatsapp() ); ?></span></li>
                    <li><strong>Airtel Money :</strong> <span>+226 <?php echo esc_html( dsj_get_whatsapp() ); ?></span></li>
                </ul>
                <p class="paiement-note">
                    <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    Référence à indiquer : <em>DSJ-Don-[Votre Nom]</em>
                </p>
            </div>
            
            <!-- Virement -->
            <div class="paiement-card">
                <div class="paiement-icon">
                    <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="22" x2="21" y2="22"/>
                        <line x1="6" y1="18" x2="6" y2="11"/>
                        <line x1="10" y1="18" x2="10" y2="11"/>
                        <line x1="14" y1="18" x2="14" y2="11"/>
                        <line x1="18" y1="18" x2="18" y2="11"/>
                        <polygon points="12 2 20 7 4 7"/>
                    </svg>
                </div>
                <h3>Virement Bancaire</h3>
                <p>Pour les dons institutionnels ou internationaux :</p>
                <ul class="paiement-list">
                    <li><strong>Banque :</strong> Contactez-nous</li>
                    <li><strong>IBAN / RIB :</strong> Sur demande</li>
                    <li><strong>Titulaire :</strong> Domaine Saint Joseph</li>
                </ul>
                <p class="paiement-note">
                    <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Demandez le RIB complet par WhatsApp.
                </p>
            </div>
        </div>
        
        <div class="paiement-cta">
            <a href="https://wa.me/<?php echo esc_attr( dsj_get_whatsapp() ); ?>?text=Bonjour,%20je%20souhaite%20faire%20un%20don%20au%20Domaine%20Saint%20Joseph.%20Merci%20de%20me%20guider." class="btn btn-primary btn-large" target="_blank" rel="noopener noreferrer">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/></svg>
                Confirmer mon don par WhatsApp
            </a>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?sujet=don" class="btn btn-secondary btn-large">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                Formulaire de contact
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION 5 : TÉMOIGNAGES (CPT Témoignages)
     ═══════════════════════════════════════════ -->
<section class="temoignages-donateurs section-padding bg-light reveal-section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge-light">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Ils témoignent
            </span>
            <h2 class="section-title">Ils nous soutiennent</h2>
            <div class="section-divider"></div>
        </div>
        
        <div class="temoignages-donateurs-grid">
            <?php
            $temoignages = new WP_Query( [
                'post_type'      => 'temoignage',
                'posts_per_page' => 2,
                'orderby'        => 'date',
                'order'          => 'DESC'
            ] );
            
            if ( $temoignages->have_posts() ) :
                while ( $temoignages->have_posts() ) : $temoignages->the_post(); ?>
                    <div class="temoignage-donateur-card">
                        <div class="temoignage-quote">
                            <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M9.17 6C5.77 7.22 3 10.56 3 14.25V18h6v-6H6c0-2.97 2.16-5.43 5-5.91V4.04C8.99 4.3 7.07 5 9.17 6zm11 0c-3.4 1.22-6.17 4.56-6.17 8.25V18h6v-6h-3c0-2.97 2.16-5.43 5-5.91V4.04c-2.01.26-3.93.96-1.83 1.96z"/></svg>
                        </div>
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
                    <div class="temoignage-quote">
                        <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M9.17 6C5.77 7.22 3 10.56 3 14.25V18h6v-6H6c0-2.97 2.16-5.43 5-5.91V4.04C8.99 4.3 7.07 5 9.17 6zm11 0c-3.4 1.22-6.17 4.56-6.17 8.25V18h6v-6h-3c0-2.97 2.16-5.43 5-5.91V4.04c-2.01.26-3.93.96-1.83 1.96z"/></svg>
                    </div>
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

<!-- ═══════════════════════════════════════════
     SECTION 6 : TRANSPARENCE
     ═══════════════════════════════════════════ -->
<?php 
$transparence_texte = get_theme_mod('transparence_texte', 'Chaque contribution est utilisée conformément à la mission du centre. Un reçu ou un accusé de réception vous est envoyé. Les rapports d\'activité annuels sont disponibles sur demande.');
?>
<section class="transparence-section section-padding reveal-section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge-light">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Notre engagement
            </span>
            <h2 class="section-title">Transparence</h2>
            <div class="section-divider"></div>
        </div>
        <div class="transparence-content">
            <p><?php echo wp_kses_post( $transparence_texte ); ?></p>
            <p class="transparence-mission"><strong>« Rigueur et Honnêteté guident notre gestion. »</strong></p>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION 7 : CTA FINAL (identique à l'accueil)
     ═══════════════════════════════════════════ -->
<?php 
$cta_final_titre = get_theme_mod('cta_final_titre', 'Prêt à faire la différence ?');
$cta_final_texte = get_theme_mod('cta_final_texte', 'Votre don, petit ou grand, change des vies.');
?>
<section class="cta-final-section section-padding reveal-section" aria-labelledby="cta-soutenir-title">
    <div class="container">
        <div class="cta-content">
            <span class="cta-icon">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>
            </span>
            <h2 id="cta-soutenir-title"><?php echo esc_html( $cta_final_titre ); ?></h2>
            <p><?php echo esc_html( $cta_final_texte ); ?></p>
            
            <div class="cta-actions">
                <a href="#paiement" class="btn btn-primary btn-large">
                    <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>
                    Je donne maintenant
                </a>
                <a href="https://wa.me/<?php echo esc_attr( dsj_get_whatsapp() ); ?>" class="btn btn-outline-light btn-large" target="_blank" rel="noopener noreferrer">Parler sur WhatsApp</a>
            </div>
            
            <p class="cta-whatsapp">
                Une question ? <a href="https://wa.me/<?php echo esc_attr( dsj_get_whatsapp() ); ?>" target="_blank" rel="noopener noreferrer">Écrivez-nous sur WhatsApp</a>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>