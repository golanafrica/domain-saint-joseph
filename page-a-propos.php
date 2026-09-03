<?php
/**
 * Template Name: À propos
 * Version modernisée : même langage visuel que l'accueil
 * (SVG cohérents, reveal au scroll, accessibilité complète)
 */
get_header();

/* ────────────────────────────────────────────────────────────
   ICÔNES SVG (cohérentes sur tous les appareils)
   ──────────────────────────────────────────────────────────── */
$svg_wrap = '<svg class="dsj-icon" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
$svg = [
    'livre'     => $svg_wrap . '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
    'eglise'    => $svg_wrap . '<path d="M18 22V8l-6-6-6 6v14"/><path d="M12 2v4"/><path d="M10 4h4"/><path d="M8 18h8"/><path d="M12 12v6"/></svg>',
    'target'    => $svg_wrap . '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
    'diplome'   => $svg_wrap . '<path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12.5V17c0 1.7 2.7 3 6 3s6-1.3 6-3v-4.5"/></svg>',
    'maison'    => $svg_wrap . '<path d="M3 10.5L12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M10 21v-6h4v6"/></svg>',
    'coeur'     => $svg_wrap . '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>',
    'etoile'    => $svg_wrap . '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
    'users'     => $svg_wrap . '<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
    'person'    => $svg_wrap . '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
    'hands'     => $svg_wrap . '<path d="M18 11V6a2 2 0 0 0-2-2a2 2 0 0 0-2 2"/><path d="M14 10V4a2 2 0 0 0-2-2a2 2 0 0 0-2 2v2"/><path d="M10 10.5V6a2 2 0 0 0-2-2a2 2 0 0 0-2 2v8"/><path d="M18 8a2 2 0 1 1 4 0v6a8 8 0 0 1-8 8h-2c-2.8 0-4.5-.86-5.99-2.34l-3.6-3.6a2 2 0 0 1 2.83-2.82L7 15"/></svg>',
    'shield'    => $svg_wrap . '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
    'check'     => $svg_wrap . '<path d="M20 6L9 17l-5-5"/></svg>',
    'award'     => $svg_wrap . '<circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>',
    'share'     => $svg_wrap . '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>',
    'clipboard' => $svg_wrap . '<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>',
    'mail'      => $svg_wrap . '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
    'fleche'    => $svg_wrap . '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
];

$url_whatsapp = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', get_theme_mod( 'whatsapp', '22666605890' ) );
?>

<!-- ═══════════════════════════════════════════
     HERO SECTION
     ═══════════════════════════════════════════ -->
<?php
$hero_image     = get_theme_mod( 'hero_apropos_image' );
$hero_titre     = get_theme_mod( 'hero_apropos_titre', 'À propos de nous' );
$hero_soustitre = get_theme_mod( 'hero_apropos_soustitre', 'Travailleuses Missionnaires de l\'Immaculée - Un engagement au service des femmes et des familles' );
?>

<section class="page-header apropos-header" aria-labelledby="apropos-hero-title">
    <div class="page-photo-zone"
         <?php if ( $hero_image ) : ?>
         style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
         <?php endif; ?>
         role="img"
         aria-label="<?php echo esc_attr( $hero_titre ); ?>">
    </div>
    <div class="header-caption-band">
        <span class="header-badge">
            <?php echo $svg['livre']; ?>
            Notre histoire
        </span>
        <h1 class="header-title" id="apropos-hero-title"><?php echo esc_html( $hero_titre ); ?></h1>
        <div class="header-divider">
            <span class="divider-line"></span>
            <span class="divider-icon"><?php echo $svg['eglise']; ?></span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION NOTRE HISTOIRE (Customizer)
     Texte + photo modifiables par les sœurs
     ═══════════════════════════════════════════ -->
<?php
$h_titre        = get_theme_mod( 'apropos_histoire_titre', 'Le Domaine Saint Joseph' );
$h_p1           = get_theme_mod( 'apropos_histoire_p1', 'Le Centre a été créé en <strong>2022</strong> et ouvert en <strong>2023</strong>. Il offre des formations humaines, techniques, professionnelles et spirituelles adaptées aux réalités du Burkina Faso.' );
$h_p2           = get_theme_mod( 'apropos_histoire_p2', 'Son objectif est de permettre aux apprenantes d\'acquérir des <strong>compétences solides</strong>, de développer leur autonomie et de réussir leur insertion sociale et professionnelle.' );
$h_p3           = get_theme_mod( 'apropos_histoire_p3', 'Au-delà de sa mission de formation, le Domaine Saint Joseph dispose également d\'un service d\'accueil, d\'hébergement et de restauration. Les revenus générés par ces activités sont entièrement réinvestis dans la formation des jeunes, en particulier de celles qui ne bénéficient d\'aucun soutien financier.' );
$h_p4           = get_theme_mod( 'apropos_histoire_p4', 'Aujourd\'hui, le Centre de Formation du Domaine Saint Joseph est un <strong>lieu d\'espérance</strong> où l\'apprentissage, le travail, la solidarité et les valeurs humaines se conjuguent pour bâtir un avenir meilleur pour chaque jeune accueillie.' );
$h_accompagner  = get_theme_mod( 'apropos_histoire_accompagner', 'Accompagner les jeunes en situation de précarité avec compassion et bienveillance dans leurs projets de vie.' );
$h_photo        = get_theme_mod( 'apropos_histoire_photo', '' );
?>
<section class="histoire-section section-padding reveal-section" aria-labelledby="histoire-title">
    <div class="container">
        <div class="apropos-histoire-layout">

            <!-- Colonne texte -->
            <div class="apropos-histoire-texte">
                <span class="section-badge-light"><?php echo $svg['livre']; ?> Notre histoire</span>
                <h2 class="section-title" id="histoire-title"><?php echo esc_html( $h_titre ); ?></h2>
                <div class="section-divider left" aria-hidden="true"></div>

                <div class="apropos-histoire-content">
                    <?php if ( $h_p1 ) : ?><p><?php echo wp_kses_post( $h_p1 ); ?></p><?php endif; ?>
                    <?php if ( $h_p2 ) : ?><p><?php echo wp_kses_post( $h_p2 ); ?></p><?php endif; ?>
                    <?php if ( $h_p3 ) : ?><p><?php echo wp_kses_post( $h_p3 ); ?></p><?php endif; ?>
                    <?php if ( $h_p4 ) : ?><p><?php echo wp_kses_post( $h_p4 ); ?></p><?php endif; ?>
                </div>

                <?php if ( $h_accompagner ) : ?>
                    <div class="apropos-accompagner">
                        <span class="apropos-accompagner-icon"><?php echo $svg['hands']; ?></span>
                        <p><?php echo esc_html( $h_accompagner ); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Colonne photo -->
            <div class="apropos-histoire-image">
                <?php if ( $h_photo ) : ?>
                    <img src="<?php echo esc_url( $h_photo ); ?>"
                         class="apropos-histoire-photo"
                         alt="<?php echo esc_attr( $h_titre ); ?>"
                         loading="lazy" decoding="async">
                <?php else : ?>
                    <div class="apropos-histoire-placeholder">
                        <?php echo $svg['livre']; ?>
                        <span>Ajoutez une photo : Personnaliser → 📖 À propos — Notre Histoire</span>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<!-- ═══════════════════════════════════════════
     SECTION NOTRE MISSION (Customizer)
     ═══════════════════════════════════════════ -->
<?php
$m_badge   = get_theme_mod( 'mission_badge', 'Notre raison d\'être' );
$m_titre   = get_theme_mod( 'mission_titre', 'Notre Mission' );
$m_citation = get_theme_mod( 'mission_citation', 'Soutenir, encourager les jeunes filles et les jeunes mamans à acquérir des compétences techniques dans le but d\'assumer des responsabilités dans la vie courante.' );
?>
<section class="mission-section section-padding section-alt" aria-labelledby="mission-title">
    <div class="container">
        <div class="section-header reveal-section">
            <span class="section-badge-light"><?php echo $svg['target']; ?> <?php echo esc_html( $m_badge ); ?></span>
            <h2 class="section-title" id="mission-title"><?php echo esc_html( $m_titre ); ?></h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>

        <?php if ( $m_citation ) : ?>
        <div class="mission-detail reveal-section">
            <p class="mission-statement"><?php echo wp_kses_post( $m_citation ); ?></p>
        </div>
        <?php endif; ?>

        <div class="features-grid">
            <?php for ( $i = 1; $i <= 3; $i++ ) :
                $titre = get_theme_mod( "mission_{$i}_titre", $i === 1 ? 'Former' : ( $i === 2 ? 'Accueillir' : 'Accompagner' ) );
                $texte = get_theme_mod( "mission_{$i}_texte", '' );
                $image = get_theme_mod( "mission_{$i}_image", '' );
                $icon  = ( $i === 1 ) ? $svg['diplome'] : ( ( $i === 2 ) ? $svg['maison'] : $svg['hands'] );
            ?>
                <div class="feature-card reveal-section">
                    <div class="feature-icon">
                        <?php if ( $image ) : ?>
                            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $titre ); ?>" class="feature-image">
                        <?php else : ?>
                            <?php echo $icon; ?>
                        <?php endif; ?>
                    </div>
                    <h3><?php echo esc_html( $titre ); ?></h3>
                    <p><?php echo wp_kses_post( $texte ); ?></p>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
<!-- ═══════════════════════════════════════════
     SECTION NOS VALEURS (feature cards compactes)
     ═══════════════════════════════════════════ -->
<section class="nos-valeurs-section section-padding" aria-labelledby="valeurs-title">
    <div class="container">
        <div class="section-header reveal-section">
            <span class="section-badge-light"><?php echo $svg['etoile']; ?> Nos fondamentaux</span>
            <h2 class="section-title" id="valeurs-title">Nos Valeurs</h2>
            <div class="section-divider" aria-hidden="true"></div>
            <p class="section-subtitle">Ce qui nous guide au quotidien</p>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['hands']; ?></div>
                <h3>Respect</h3>
                <p>De la personne humaine dans sa dignité</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['shield']; ?></div>
                <h3>Honnêteté</h3>
                <p>Dans toutes nos relations et engagements</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['coeur']; ?></div>
                <h3>Compassion</h3>
                <p>Envers les plus vulnérables</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['share']; ?></div>
                <h3>Partage</h3>
                <p>Des savoirs, ressources et expériences</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['clipboard']; ?></div>
                <h3>Rigueur</h3>
                <p>Dans le travail sérieux et bien accompli</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['award']; ?></div>
                <h3>Excellence</h3>
                <p>Toujours viser le meilleur de soi-même</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION NOTRE ÉQUIPE (Dynamique — Customizer)
     Les sœurs activent/désactivent les membres
     ═══════════════════════════════════════════ -->
<?php
$eq_badge    = get_theme_mod( 'equipe_badge', 'Notre communauté' );
$eq_titre    = get_theme_mod( 'equipe_titre', 'Notre Équipe' );
$eq_soustitre = get_theme_mod( 'equipe_soustitre', 'Des personnes dévouées au service des autres' );

// Collecter les membres actifs
$membres_actifs = array();
for ( $i = 1; $i <= 8; $i++ ) {
    if ( get_theme_mod( "equipe_membre_{$i}_active", ( $i <= 3 ) ) ) {
        $membres_actifs[] = array(
            'nom'         => get_theme_mod( "equipe_membre_{$i}_nom", '' ),
            'fonction'    => get_theme_mod( "equipe_membre_{$i}_fonction", '' ),
            'description' => get_theme_mod( "equipe_membre_{$i}_description", '' ),
            'image'       => get_theme_mod( "equipe_membre_{$i}_image", '' ),
        );
    }
}
?>
<?php if ( ! empty( $membres_actifs ) ) : ?>
<section class="equipe-section section-padding section-alt" aria-labelledby="equipe-title">
    <div class="container">
        <div class="section-header reveal-section">
            <span class="section-badge-light"><?php echo $svg['users']; ?> <?php echo esc_html( $eq_badge ); ?></span>
            <h2 class="section-title" id="equipe-title"><?php echo esc_html( $eq_titre ); ?></h2>
            <div class="section-divider" aria-hidden="true"></div>
            <p class="section-subtitle"><?php echo esc_html( $eq_soustitre ); ?></p>
        </div>

        <div class="equipe-grid">
            <?php foreach ( $membres_actifs as $m ) : ?>
                <div class="equipe-card reveal-section">
                    <div class="equipe-image">
                        <?php if ( $m['image'] ) : ?>
                            <img src="<?php echo esc_url( $m['image'] ); ?>" alt="<?php echo esc_attr( $m['nom'] ); ?>" class="equipe-photo">
                        <?php else : ?>
                            <div class="equipe-placeholder"><?php echo $svg['person']; ?></div>
                        <?php endif; ?>
                    </div>
                    <h3><?php echo esc_html( $m['nom'] ); ?></h3>
                    <p class="equipe-fonction"><?php echo esc_html( $m['fonction'] ); ?></p>
                    <p><?php echo esc_html( $m['description'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ═══════════════════════════════════════════
     SECTION APPEL À L'AIDE
     ═══════════════════════════════════════════ -->
<section class="aide-section section-padding reveal-section" aria-labelledby="aide-title">
    <div class="container">
        <div class="aide-content">
            <span class="aide-badge">
                <?php echo $svg['coeur']; ?>
                Votre soutien compte
            </span>
            <h2 id="aide-title">Nous sollicitons votre aide</h2>
            <p>Nous vous remercions pour votre contribution à la formation de ces jeunes par le moyen de parrainages ou de dons.</p>
            <div class="aide-buttons">
                <a href="<?php echo esc_url( home_url( '/nous-soutenir' ) ); ?>" class="btn btn-primary btn-large" aria-label="Faire un don pour soutenir le Domaine">
                    <?php echo $svg['coeur']; ?> Faire un don
                </a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-secondary btn-large" aria-label="Nous contacter pour en savoir plus">
                    <?php echo $svg['mail']; ?> Nous contacter
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     CTA FINAL (identique aux autres pages)
     ═══════════════════════════════════════════ -->
<section class="cta-final-section section-padding" aria-labelledby="cta-apropos-title">
    <div class="container">
        <div class="cta-content reveal-section">
            <span class="cta-icon"><?php echo $svg['coeur']; ?></span>
            <h2 id="cta-apropos-title">Envie d'en savoir plus ?</h2>
            <p>Découvrez nos formations, notre Maison d'Accueil ou contactez-nous pour toute question.</p>

            <div class="cta-actions">
                <a href="<?php echo esc_url( home_url( '/formation' ) ); ?>" class="btn btn-primary btn-large" aria-label="Découvrir nos formations">
                    <?php echo $svg['diplome']; ?> Nos formations
                </a>
                <a href="<?php echo esc_url( $url_whatsapp ); ?>" class="btn btn-outline-light btn-large" target="_blank" rel="noopener noreferrer" aria-label="Nous contacter sur WhatsApp">
                    <?php echo $svg['fleche']; ?> Parler sur WhatsApp
                </a>
            </div>

            <p class="cta-whatsapp">
                Une question ? <a href="<?php echo esc_url( $url_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">Écrivez-nous sur WhatsApp</a>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>