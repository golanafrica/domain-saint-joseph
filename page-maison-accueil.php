<?php
/**
 * Template Name: Maison d'Accueil
 * Version modernisée : même langage visuel que l'accueil
 * (SVG cohérents, reveal au scroll, accessibilité complète)
 */
get_header();

/* ────────────────────────────────────────────────────────────
   ICÔNES SVG (cohérents sur tous les appareils)
   ──────────────────────────────────────────────────────────── */
$svg_wrap = '<svg class="dsj-icon" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
$svg = [
    'maison'    => $svg_wrap . '<path d="M3 10.5L12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M10 21v-6h4v6"/></svg>',
    'users'     => $svg_wrap . '<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
    'coeur'     => $svg_wrap . '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>',
    'check'     => $svg_wrap . '<path d="M20 6L9 17l-5-5"/></svg>',
    'horloge'   => $svg_wrap . '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>',
    'calendrier'=> $svg_wrap . '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',
    'etoile'    => $svg_wrap . '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
    'eglise'    => $svg_wrap . '<path d="M18 22V8l-6-6-6 6v14"/><path d="M12 2v4"/><path d="M10 4h4"/><path d="M8 18h8"/><path d="M12 12v6"/></svg>',
    'soleil'    => $svg_wrap . '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>',
    'neige'     => $svg_wrap . '<line x1="12" y1="2" x2="12" y2="22"/><line x1="2" y1="12" x2="22" y2="12"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/><line x1="19.07" y1="4.93" x2="4.93" y2="19.07"/></svg>',
    'livre'     => $svg_wrap . '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
    'micro'     => $svg_wrap . '<path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>',
    'ordi'      => $svg_wrap . '<rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
    'couverts'  => $svg_wrap . '<path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>',
    'edit'      => $svg_wrap . '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>',
    'fleche'    => $svg_wrap . '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
];

$url_whatsapp = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', get_theme_mod( 'whatsapp', '22666605890' ) );
?>

<!-- ═══════════════════════════════════════════
     HERO SECTION
     ═══════════════════════════════════════════ -->
<?php
$hero_image     = get_theme_mod( 'hero_maison_image' );
$hero_titre     = get_theme_mod( 'hero_maison_titre', 'Maison d\'Accueil' );
$hero_soustitre = get_theme_mod( 'hero_maison_soustitre', 'Un lieu de repos, de ressourcement et de rencontres' );
?>

<section class="page-header maison-accueil-header" aria-labelledby="maison-hero-title">
    <div class="page-photo-zone"
         <?php if ( $hero_image ) : ?>
         style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
         <?php endif; ?>
         role="img"
         aria-label="<?php echo esc_attr( $hero_titre ); ?>">
    </div>

    <div class="header-caption-band">
        <span class="header-badge">
            <?php echo $svg['maison']; ?>
            Nos hébergements
        </span>
        <h1 class="header-title" id="maison-hero-title"><?php echo esc_html( $hero_titre ); ?></h1>
        <div class="header-divider">
            <span class="divider-line"></span>
            <span class="divider-icon"><?php echo $svg['eglise']; ?></span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
        <div class="header-buttons">
            <a href="#nos-chambres" class="btn-scroll" aria-label="Découvrir nos chambres">
                <?php echo $svg['maison']; ?> Découvrir nos chambres
            </a>
            <a href="#reservation" class="btn-scroll btn-outline" aria-label="Réserver une chambre maintenant">
                <?php echo $svg['calendrier']; ?> Réserver maintenant
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION ACCUEIL ET HÉBERGEMENT
     ✅ TEXTE + PHOTO MODIFIABLES VIA CUSTOMIZER
     Personnaliser → Maison d'Accueil — Présentation
     ═══════════════════════════════════════════ -->
<?php
$ma_titre  = get_theme_mod( 'maison_accueil_titre', 'Accueil et Hébergement' );
$ma_texte1 = get_theme_mod( 'maison_accueil_texte1', 'L\'accueil et l\'hébergement ont pour but de vous offrir un <strong>cadre simple, propre et paisible</strong>, propice au repos, au recueillement et à la convivialité.' );
$ma_texte2 = get_theme_mod( 'maison_accueil_texte2', 'Que vous soyez en déplacement, en retraite spirituelle, en session de formation, en réunion ou simplement en séjour de repos, seul, en famille ou en groupe de réflexion, nous mettons à votre disposition un <strong>environnement chaleureux</strong> favorisant votre confort et votre bien-être.' );
$ma_texte3 = get_theme_mod( 'maison_accueil_texte3', 'En choisissant de séjourner au Domaine Saint Joseph, vous participez directement à une <strong>œuvre de solidarité</strong>. Les revenus de l\'accueil et de l\'hébergement sont entièrement réinvestis dans les actions du Centre afin de soutenir la formation humaine, professionnelle et spirituelle des jeunes, en particulier des jeunes qui ne bénéficient d\'aucun soutien financier.' );

// Priorité photo : Customizer > image mise en avant de la page > placeholder
$ma_photo = get_theme_mod( 'maison_accueil_photo', '' );
if ( empty( $ma_photo ) && has_post_thumbnail() ) {
    $ma_photo = get_the_post_thumbnail_url( get_the_ID(), 'large' );
}
?>
<section class="maison-accueil-presentation section-padding" aria-labelledby="accueil-hebergement-title">
    <div class="container">
        <div class="maison-accueil-layout reveal-section">

            <!-- Colonne texte -->
            <div class="maison-accueil-texte">
                <span class="section-badge-light"><?php echo $svg['coeur']; ?> Notre mission d'accueil</span>
                <h2 class="section-title" id="accueil-hebergement-title"><?php echo esc_html( $ma_titre ); ?></h2>
                <div class="section-divider left" aria-hidden="true"></div>

                <div class="accueil-hebergement-content">
                    <?php if ( $ma_texte1 ) : ?><p><?php echo wp_kses_post( $ma_texte1 ); ?></p><?php endif; ?>
                    <?php if ( $ma_texte2 ) : ?><p><?php echo wp_kses_post( $ma_texte2 ); ?></p><?php endif; ?>
                    <?php if ( $ma_texte3 ) : ?><p><?php echo wp_kses_post( $ma_texte3 ); ?></p><?php endif; ?>
                </div>
            </div>

            <!-- Colonne image -->
            <div class="maison-accueil-image">
                <?php if ( $ma_photo ) : ?>
                    <img src="<?php echo esc_url( $ma_photo ); ?>"
                         class="accueil-hebergement-photo"
                         alt="<?php echo esc_attr( 'Maison d\'accueil du Domaine Saint Joseph' ); ?>"
                         loading="lazy" decoding="async">
                <?php else : ?>
                    <div class="accueil-hebergement-placeholder">
                        <?php echo $svg['maison']; ?>
                        <span>Ajoutez une photo : Personnaliser → Maison d'Accueil — Présentation</span>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     CONTENU ÉDITABLE (Gutenberg)
     ═══════════════════════════════════════════ -->
<section class="contenu-maison-accueil section-padding" aria-labelledby="maison-contenu-title">
    <div class="container">
        <h2 id="maison-contenu-title" class="screen-reader-text">Présentation</h2>
        <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
        ?>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     PRÉSENTATION + SERVICES
     ═══════════════════════════════════════════ -->
<section class="maison-presentation section-padding section-alt reveal-section" aria-labelledby="maison-presentation-title">
    <div class="container">
        <div class="section-header">
            <span class="section-badge-light"><?php echo $svg['maison']; ?> Un lieu pour tous</span>
            <h2 class="section-title" id="maison-presentation-title">La Maison d'Accueil</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
        <div class="presentation-content">
            <p>La Maison d'Accueil, ouverte à tous, a pour but l'autoprise en charge du Centre pour soutenir la formation.</p>
        </div>

        <div class="services-list">
            <h3>Nos espaces sont disponibles pour :</h3>
            <ul class="services-compact" role="list">
                <li><?php echo $svg['horloge']; ?> Retraites, récollections</li>
                <li><?php echo $svg['etoile']; ?> Événements</li>
                <li><?php echo $svg['users']; ?> Réunions de famille</li>
                <li><?php echo $svg['edit']; ?> Sessions de travail</li>
                <li><?php echo $svg['micro']; ?> Conférences</li>
                <li><?php echo $svg['livre']; ?> Journées d'étude</li>
            </ul>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     ÉQUIPEMENTS (feature grid moderne)
     ═══════════════════════════════════════════ -->
<section class="equipements-section section-padding reveal-section" aria-labelledby="equipements-title">
    <div class="container">
        <div class="section-header">
            <span class="section-badge-light"><?php echo $svg['etoile']; ?> Nos équipements</span>
            <h2 class="section-title" id="equipements-title">Le Centre est doté</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['soleil']; ?></div>
                <h3>Chambres ventilées</h3>
                <p>Confort naturel pour un repos paisible.</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['neige']; ?></div>
                <h3>Chambres climatisées</h3>
                <p>Fraîcheur garantie pour les nuits tropicales.</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['coeur']; ?></div>
                <h3>Cadre de recueillement</h3>
                <p>Un environnement propice à la réflexion.</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['eglise']; ?></div>
                <h3>Chapelle</h3>
                <p>Lieu de prière et de silence ouvert à tous.</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['micro']; ?></div>
                <h3>Salle de conférence</h3>
                <p>Équipée pour vos événements professionnels.</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['livre']; ?></div>
                <h3>Salles de formation</h3>
                <p>Espaces dédiés à l'apprentissage.</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['ordi']; ?></div>
                <h3>Cadre de travail</h3>
                <p>Un environnement calme pour vos projets.</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['couverts']; ?></div>
                <h3>Salle à manger</h3>
                <p>Convivialité et cuisine locale.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     NOS CHAMBRES (CPT Hébergements — cards modernes)
     ═══════════════════════════════════════════ -->
<section id="nos-chambres" class="nos-chambres section-padding section-alt" aria-labelledby="nos-chambres-title">
    <div class="container">
        <div class="section-header reveal-section">
            <span class="section-badge-light"><?php echo $svg['maison']; ?> Notre espace</span>
            <h2 class="section-title" id="nos-chambres-title">Nos Chambres</h2>
            <div class="section-divider" aria-hidden="true"></div>
            <p class="section-subtitle">Des chambres confortables pour votre séjour</p>
        </div>

        <div class="formations-grid">
            <?php
            $hebergements = new WP_Query( [
                'post_type'      => 'hebergement',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ] );

            if ( $hebergements->have_posts() ) :
                while ( $hebergements->have_posts() ) : $hebergements->the_post(); ?>
                    <article class="formation-card card-modern reveal-section">
                        <div class="card-image">
                            <a href="<?php the_permalink(); ?>" aria-label="Voir l'hébergement : <?php echo esc_attr( get_the_title() ); ?>">
                                <?php if ( has_post_thumbnail() ) :
                                    the_post_thumbnail( 'medium_large', [
                                        'alt'      => '',
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                    ] );
                                else : ?>
                                    <div class="card-icon-placeholder"><?php echo $svg['maison']; ?></div>
                                <?php endif; ?>
                            </a>
                            <?php
                            $dispo = get_post_meta( get_the_ID(), '_dsj_dispo', true );
                            if ( $dispo === 'disponible' ) : ?>
                                <span class="card-badge disponible">Disponible</span>
                            <?php elseif ( $dispo === 'sur_reservation' ) : ?>
                                <span class="card-badge reservation">Sur réservation</span>
                            <?php elseif ( $dispo === 'complet' ) : ?>
                                <span class="card-badge complet">Complet</span>
                            <?php endif; ?>
                        </div>

                        <div class="card-content">
                            <h3>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <?php
                            $capacite  = get_post_meta( get_the_ID(), '_dsj_capacite', true );
                            $prix_nuit = get_post_meta( get_the_ID(), '_dsj_prix_nuit', true );
                            ?>

                            <div class="card-meta">
                                <?php if ( $capacite ) : ?>
                                    <span class="meta-item"><?php echo $svg['users']; ?> <?php echo esc_html( $capacite ); ?> pers.</span>
                                <?php endif; ?>
                                <?php if ( $prix_nuit ) : ?>
                                    <span class="meta-item"><?php echo esc_html( $prix_nuit ); ?> F/nuit</span>
                                <?php endif; ?>
                            </div>

                            <div class="card-description">
                                <?php
                                if ( has_excerpt() ) {
                                    echo esc_html( wp_trim_words( get_the_excerpt(), 14, '...' ) );
                                } else {
                                    echo esc_html( wp_trim_words( get_the_content(), 14, '...' ) );
                                }
                                ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="btn-link" aria-label="Voir les détails de <?php echo esc_attr( get_the_title() ); ?>">
                                Voir les détails <span class="arrow" aria-hidden="true">→</span>
                            </a>
                        </div>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="text-center">Aucune chambre disponible pour le moment. Revenez bientôt !</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     FORMULAIRE DE RÉSERVATION
     ═══════════════════════════════════════════ -->
<section id="reservation" class="reservation section-padding reveal-section" aria-labelledby="reservation-title">
    <div class="container">
        <div class="reservation-header">
            <span class="reservation-badge">
                <?php echo $svg['calendrier']; ?> Réservation
            </span>
            <h2 class="reservation-title" id="reservation-title">Demander une Réservation</h2>
            <div class="reservation-divider" aria-hidden="true"></div>
            <p class="reservation-subtitle">Remplissez ce formulaire et nous vous répondrons sous 48h</p>
        </div>

        <?php if ( isset( $_GET['success'] ) && $_GET['success'] === '1' ) : ?>
            <div class="alert alert-success" role="alert" aria-live="polite">
                <span class="alert-icon" aria-hidden="true"><?php echo $svg['check']; ?></span>
                <div class="alert-content">
                    <strong>Merci !</strong> Votre demande a bien été envoyée. Nous vous répondrons sous 48h par WhatsApp ou email.
                </div>
            </div>
        <?php elseif ( isset( $_GET['error'] ) ) : ?>
            <div class="alert alert-error" role="alert" aria-live="assertive">
                <span class="alert-icon" aria-hidden="true">✕</span>
                <div class="alert-content">
                    <?php
                    $error = sanitize_text_field( wp_unslash( $_GET['error'] ?? '' ) );
                    switch ( $error ) {
                        case 'missing':
                            echo '<strong>Champs manquants</strong><br>Veuillez remplir tous les champs obligatoires.';
                            break;
                        case 'session_expired':
                            echo '<strong>Session expirée</strong><br>Veuillez recharger la page et réessayer.';
                            break;
                        case 'send':
                            echo '<strong>Erreur d\'envoi</strong><br>Veuillez réessayer ou nous contacter par WhatsApp.';
                            break;
                        case 'rate_limit':
                            echo '<strong>Trop de messages</strong><br>Veuillez attendre quelques minutes avant de réessayer.';
                            break;
                        case 'invalid_contact':
                            echo '<strong>Contact invalide</strong><br>Veuillez entrer un email ou numéro de téléphone valide.';
                            break;
                        default:
                            echo '<strong>Erreur</strong><br>Une erreur est survenue. Veuillez réessayer.';
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <form class="form-reservation" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
            <input type="hidden" name="action" value="dsj_reservation_form">
            <?php wp_nonce_field( 'dsj_reservation_nonce', '_wpnonce' ); ?>

            <div class="dsj-honeypot" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;">
                <label for="dsj_hp_field">Ne pas remplir ce champ</label>
                <input type="text" id="dsj_hp_field" name="dsj_hp_field" tabindex="-1" autocomplete="off">
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="resa-nom">
                        <?php echo $svg['users']; ?>
                        Nom complet <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="text" id="resa-nom" name="nom" class="form-control" placeholder="Votre nom et prénom" required aria-required="true">
                    <span class="input-border" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                    <label for="resa-contact">
                        <?php echo $svg['fleche']; ?>
                        Email ou Téléphone <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="text" id="resa-contact" name="contact" class="form-control" placeholder="exemple@email.com ou +226 XX XX XX XX" required aria-required="true">
                    <span class="input-border" aria-hidden="true"></span>
                </div>
            </div>

            <div class="form-grid form-grid-3">
                <div class="form-group">
                    <label for="resa-arrivee">
                        <?php echo $svg['calendrier']; ?>
                        Date d'arrivée <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="date" id="resa-arrivee" name="arrivee" class="form-control" required aria-required="true">
                    <span class="input-border" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                    <label for="resa-depart">
                        <?php echo $svg['calendrier']; ?>
                        Date de départ <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="date" id="resa-depart" name="depart" class="form-control" required aria-required="true">
                    <span class="input-border" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                    <label for="resa-type">
                        <?php echo $svg['maison']; ?>
                        Type de chambre
                    </label>
                    <div class="select-wrapper">
                        <select id="resa-type" name="type" class="form-control">
                            <option value="">-- Au choix --</option>
                            <?php
                            $chambres = new WP_Query( [ 'post_type' => 'hebergement', 'posts_per_page' => -1 ] );
                            if ( $chambres->have_posts() ) :
                                while ( $chambres->have_posts() ) : $chambres->the_post(); ?>
                                    <option value="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></option>
                                <?php endwhile;
                                wp_reset_postdata();
                            endif; ?>
                        </select>
                        <span class="select-arrow" aria-hidden="true">▾</span>
                    </div>
                    <span class="input-border" aria-hidden="true"></span>
                </div>
            </div>

            <div class="form-group full-width">
                <label for="resa-message">
                    <?php echo $svg['edit']; ?>
                    Besoins particuliers
                </label>
                <textarea id="resa-message" name="message" class="form-control" rows="4" placeholder="Ex: régime alimentaire, accès PMR, besoins spécifiques..."></textarea>
                <span class="input-border" aria-hidden="true"></span>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit btn btn-primary btn-large">
                    <?php echo $svg['fleche']; ?> Envoyer ma demande
                </button>
                <p class="form-note">
                    <?php echo $svg['check']; ?>
                    Nous vous répondrons sous 48h par WhatsApp ou email
                </p>
            </div>
        </form>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     CTA FINAL
     ═══════════════════════════════════════════ -->
<section class="cta-final-section section-padding" aria-labelledby="cta-maison-title">
    <div class="container">
        <div class="cta-content reveal-section">
            <span class="cta-icon"><?php echo $svg['coeur']; ?></span>
            <h2 id="cta-maison-title">Besoin d'un hébergement ?</h2>
            <p>Notre Maison d'Accueil vous accueille pour un séjour, une retraite ou un événement. Contactez-nous pour toute information.</p>

            <div class="cta-actions">
                <a href="#reservation" class="btn btn-primary btn-large">
                    <?php echo $svg['calendrier']; ?> Réserver maintenant
                </a>
                <a href="<?php echo esc_url( $url_whatsapp ); ?>" class="btn btn-outline-light btn-large" target="_blank" rel="noopener noreferrer">Parler sur WhatsApp</a>
            </div>

            <p class="cta-whatsapp">
                Une question ? <a href="<?php echo esc_url( $url_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">Écrivez-nous sur WhatsApp</a>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>