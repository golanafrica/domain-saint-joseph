<?php
/**
 * Template Name: Restaurant
 * Version modernisée : même langage visuel que l'accueil
 * (SVG cohérents, reveal au scroll, accessibilité complète)
 */
get_header();

/* ────────────────────────────────────────────────────────────
   ICÔNES SVG (cohérentes sur tous les appareils)
   ──────────────────────────────────────────────────────────── */
$svg_wrap = '<svg class="dsj-icon" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
$svg = [
    'couverts'  => $svg_wrap . '<path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>',
    'horloge'   => $svg_wrap . '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>',
    'calendrier'=> $svg_wrap . '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',
    'coeur'     => $svg_wrap . '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>',
    'check'     => $svg_wrap . '<path d="M20 6L9 17l-5-5"/></svg>',
    'soleil'    => $svg_wrap . '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>',
    'lune'      => $svg_wrap . '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>',
    'etoile'    => $svg_wrap . '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
    'users'     => $svg_wrap . '<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
    'edit'      => $svg_wrap . '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>',
    'fleche'    => $svg_wrap . '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
    'warning'   => $svg_wrap . '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
    'telephone' => $svg_wrap . '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
];

$url_whatsapp = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', get_theme_mod( 'whatsapp', '22666605890' ) );
?>

<!-- ═══════════════════════════════════════════
     HERO SECTION
     ═══════════════════════════════════════════ -->
<?php
$hero_image     = get_theme_mod( 'hero_restaurant_image' );
$hero_titre     = get_theme_mod( 'hero_restaurant_titre', 'Restaurant' );
$hero_soustitre = get_theme_mod( 'hero_restaurant_soustitre', 'Découvrez nos plats préparés avec amour et passion' );
?>

<section class="page-header restaurant-header" aria-labelledby="restaurant-hero-title">
    <div class="page-photo-zone"
         <?php if ( $hero_image ) : ?>
         style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
         <?php endif; ?>
         role="img"
         aria-label="<?php echo esc_attr( $hero_titre ); ?>">
    </div>

    <div class="header-caption-band">
        <span class="header-badge">
            <?php echo $svg['couverts']; ?>
            Notre cuisine
        </span>
        <h1 class="header-title" id="restaurant-hero-title"><?php echo esc_html( $hero_titre ); ?></h1>
        <div class="header-divider">
            <span class="divider-line"></span>
            <span class="divider-icon"><?php echo $svg['couverts']; ?></span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION CARTES DES MENUS
     ═══════════════════════════════════════════ -->
<section class="menu-section section-padding" aria-labelledby="menu-section-title">
    <div class="container">
        <div class="section-header reveal-section">
            <span class="section-badge-light"><?php echo $svg['etoile']; ?> Nos spécialités</span>
            <h2 class="section-title" id="menu-section-title">Notre Carte</h2>
            <div class="section-divider" aria-hidden="true"></div>
            <p class="section-subtitle">Des plats préparés avec des produits frais et de saison</p>
        </div>

        <?php
        $categories = get_terms( [
            'taxonomy'   => 'categorie_menu',
            'hide_empty' => true,
        ] );

        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
            <div class="menu-categories" role="tablist" aria-label="Filtrer par catégorie">
                <button class="menu-cat-btn active" data-cat="all" role="tab" aria-selected="true">
                    Tous
                </button>
                <?php foreach ( $categories as $category ) : ?>
                    <button class="menu-cat-btn" data-cat="<?php echo esc_attr( $category->slug ); ?>" role="tab" aria-selected="false">
                        <?php echo esc_html( $category->name ); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="menu-grid" role="list">
            <?php
            $menus = new WP_Query( [
                'post_type'      => 'menu',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ] );

            if ( $menus->have_posts() ) :
                while ( $menus->have_posts() ) : $menus->the_post();
                    $categories = get_the_terms( get_the_ID(), 'categorie_menu' );
                    $cat_slugs  = [];
                    if ( $categories && ! is_wp_error( $categories ) ) {
                        foreach ( $categories as $cat ) {
                            $cat_slugs[] = $cat->slug;
                        }
                    }
                    $cat_classes = implode( ' ', $cat_slugs );

                    $prix        = get_post_meta( get_the_ID(), '_menu_prix', true );
                    $temps       = get_post_meta( get_the_ID(), '_menu_temps', true );
                    $ingredients = get_post_meta( get_the_ID(), '_menu_ingredients', true );
                    $allergenes  = get_post_meta( get_the_ID(), '_menu_allergenes', true );
                    ?>
                    <article class="menu-card reveal-section" data-category="<?php echo esc_attr( $cat_classes ); ?>" role="listitem">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="menu-image">
                                <?php the_post_thumbnail( 'medium_large', [
                                    'alt'      => esc_attr( get_the_title() ),
                                    'loading'  => 'lazy',
                                    'decoding' => 'async',
                                ] ); ?>
                                <?php if ( $prix ) : ?>
                                    <span class="menu-price"><?php echo esc_html( $prix ); ?> F</span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="menu-content">
                            <h3><?php the_title(); ?></h3>

                            <?php if ( $ingredients ) : ?>
                                <p class="menu-ingredients"><?php echo esc_html( $ingredients ); ?></p>
                            <?php endif; ?>

                            <div class="menu-meta">
                                <?php if ( $temps ) : ?>
                                    <span class="menu-time">
                                        <?php echo $svg['horloge']; ?>
                                        <?php echo esc_html( $temps ); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $allergenes ) : ?>
                                    <span class="menu-allergenes">
                                        <?php echo $svg['warning']; ?>
                                        <?php echo esc_html( $allergenes ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="menu-footer">
                                <a href="#reservation-restaurant" class="btn-link" aria-label="Réserver une table pour <?php echo esc_attr( get_the_title() ); ?>">
                                    <?php echo $svg['calendrier']; ?> Réserver une table
                                    <span class="arrow" aria-hidden="true">→</span>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <div class="no-content">
                    <p>Aucun plat disponible pour le moment. Revenez bientôt !</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION HORAIRES (feature cards)
     ═══════════════════════════════════════════ -->
<section class="horaires-section section-padding section-alt reveal-section" aria-labelledby="horaires-title">
    <div class="container">
        <div class="section-header">
            <span class="section-badge-light"><?php echo $svg['horloge']; ?> Horaires d'ouverture</span>
            <h2 class="section-title" id="horaires-title">Horaires du Restaurant</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['soleil']; ?></div>
                <h3>Petit-déjeuner</h3>
                <p><strong>Lundi - Vendredi</strong><br>7h00 - 9h30</p>
                <p><strong>Samedi - Dimanche</strong><br>8h00 - 10h30</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['couverts']; ?></div>
                <h3>Déjeuner</h3>
                <p><strong>Tous les jours</strong><br>12h00 - 14h30</p>
            </div>
            <div class="feature-card reveal-section">
                <div class="feature-icon"><?php echo $svg['lune']; ?></div>
                <h3>Dîner</h3>
                <p><strong>Tous les jours</strong><br>19h00 - 21h30</p>
                <p><em>Sur réservation le dimanche soir</em></p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION RÉSERVATION RESTAURANT
     ═══════════════════════════════════════════ -->
<section id="reservation-restaurant" class="reservation-restaurant section-padding reveal-section" aria-labelledby="reservation-restaurant-title">
    <div class="container">
        <div class="reservation-header">
            <span class="reservation-badge">
                <?php echo $svg['calendrier']; ?> Réservez votre table
            </span>
            <h2 class="reservation-title" id="reservation-restaurant-title">Réservation Restaurant</h2>
            <div class="reservation-divider" aria-hidden="true"></div>
            <p class="reservation-subtitle">Réservez votre table pour un déjeuner ou dîner inoubliable</p>
        </div>

        <?php if ( isset( $_GET['resa_success'] ) && $_GET['resa_success'] === '1' ) : ?>
            <div class="alert alert-success" role="alert" aria-live="polite">
                <span class="alert-icon" aria-hidden="true"><?php echo $svg['check']; ?></span>
                <div class="alert-content">
                    <strong>Réservation envoyée !</strong> Nous vous confirmerons votre réservation par téléphone ou WhatsApp dans les plus brefs délais.
                </div>
            </div>
        <?php elseif ( isset( $_GET['resa_error'] ) ) : ?>
            <div class="alert alert-error" role="alert" aria-live="assertive">
                <span class="alert-icon" aria-hidden="true">✕</span>
                <div class="alert-content">
                    <?php
                    $error = sanitize_text_field( wp_unslash( $_GET['resa_error'] ?? '' ) );
                    switch ( $error ) {
                        case 'missing':
                            echo '<strong>Champs manquants</strong><br>Veuillez remplir tous les champs obligatoires.';
                            break;
                        case 'too_long':
                            echo '<strong>Message trop long</strong><br>Votre message dépasse la limite de 5000 caractères. Veuillez le raccourcir.';
                            break;
                        case 'invalid_contact':
                            echo '<strong>Contact invalide</strong><br>Veuillez entrer un numéro de téléphone valide.';
                            break;
                        case 'rate_limit':
                            echo '<strong>Trop de réservations</strong><br>Vous avez envoyé trop de demandes récemment. Veuillez attendre quelques minutes avant de réessayer.';
                            break;
                        case 'session_expired':
                            echo '<strong>Session expirée</strong><br>Votre session a expiré pour des raisons de sécurité. Veuillez recharger la page et réessayer.';
                            break;
                        case 'service_unavailable':
                            echo '<strong>Service temporairement indisponible</strong><br>Notre service de réservation rencontre un problème technique. Merci de réessayer plus tard ou de nous contacter par téléphone.';
                            break;
                        case 'send':
                            echo '<strong>Erreur d\'envoi</strong><br>Une erreur est survenue lors de l\'envoi. Veuillez réessayer ou nous contacter directement par téléphone.';
                            break;
                        default:
                            echo '<strong>Erreur</strong><br>Veuillez réessayer ou nous contacter par téléphone.';
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <form class="form-reservation-restaurant" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
            <input type="hidden" name="action" value="dsj_restaurant_reservation">
            <?php wp_nonce_field( 'dsj_restaurant_nonce', '_wpnonce' ); ?>

            <!-- Honeypot anti-spam (invisible pour les humains) -->
            <div class="dsj-honeypot" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;">
                <label for="dsj_hp_field_resa">Ne pas remplir ce champ</label>
                <input type="text" id="dsj_hp_field_resa" name="dsj_hp_field" tabindex="-1" autocomplete="off">
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="resa_nom">
                        <?php echo $svg['users']; ?>
                        Nom complet <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="text" id="resa_nom" name="resa_nom" class="form-control" value="<?php echo isset( $_POST['resa_nom'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['resa_nom'] ) ) ) : ''; ?>" required aria-required="true">
                </div>

                <div class="form-group">
                    <label for="resa_contact">
                        <?php echo $svg['telephone']; ?>
                        Téléphone <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="tel" id="resa_contact" name="resa_contact" class="form-control" value="<?php echo isset( $_POST['resa_contact'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['resa_contact'] ) ) ) : ''; ?>" required aria-required="true">
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="resa_date">
                        <?php echo $svg['calendrier']; ?>
                        Date <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="date" id="resa_date" name="resa_date" class="form-control" value="<?php echo isset( $_POST['resa_date'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['resa_date'] ) ) ) : ''; ?>" required aria-required="true">
                </div>

                <div class="form-group">
                    <label for="resa_heure">
                        <?php echo $svg['horloge']; ?>
                        Heure <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <select id="resa_heure" name="resa_heure" class="form-control" required aria-required="true">
                        <option value="12h00" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '12h00' ); ?>>12h00</option>
                        <option value="12h30" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '12h30' ); ?>>12h30</option>
                        <option value="13h00" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '13h00' ); ?>>13h00</option>
                        <option value="13h30" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '13h30' ); ?>>13h30</option>
                        <option value="19h00" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '19h00' ); ?>>19h00</option>
                        <option value="19h30" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '19h30' ); ?>>19h30</option>
                        <option value="20h00" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '20h00' ); ?>>20h00</option>
                        <option value="20h30" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '20h30' ); ?>>20h30</option>
                    </select>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="resa_personnes">
                        <?php echo $svg['users']; ?>
                        Nombre de personnes <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <select id="resa_personnes" name="resa_personnes" class="form-control" required aria-required="true">
                        <option value="1" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '1' ); ?>>1 personne</option>
                        <option value="2" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '2' ); ?>>2 personnes</option>
                        <option value="3" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '3' ); ?>>3 personnes</option>
                        <option value="4" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '4' ); ?>>4 personnes</option>
                        <option value="5" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '5' ); ?>>5 personnes</option>
                        <option value="6" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '6' ); ?>>6 personnes</option>
                        <option value="7" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '7' ); ?>>7 personnes</option>
                        <option value="8+" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '8+' ); ?>>8+ personnes</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="resa_occasion">
                        <?php echo $svg['etoile']; ?>
                        Occasion spéciale
                    </label>
                    <select id="resa_occasion" name="resa_occasion" class="form-control">
                        <option value="" <?php selected( isset( $_POST['resa_occasion'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_occasion'] ) ) : '', '' ); ?>>Aucune</option>
                        <option value="anniversaire" <?php selected( isset( $_POST['resa_occasion'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_occasion'] ) ) : '', 'anniversaire' ); ?>>Anniversaire</option>
                        <option value="mariage" <?php selected( isset( $_POST['resa_occasion'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_occasion'] ) ) : '', 'mariage' ); ?>>Mariage</option>
                        <option value="professionnel" <?php selected( isset( $_POST['resa_occasion'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_occasion'] ) ) : '', 'professionnel' ); ?>>Professionnel</option>
                        <option value="autre" <?php selected( isset( $_POST['resa_occasion'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_occasion'] ) ) : '', 'autre' ); ?>>Autre</option>
                    </select>
                </div>
            </div>

            <div class="form-group full-width">
                <label for="resa_message">
                    <?php echo $svg['edit']; ?>
                    Message / Demande particulière <small>(max 5000 caractères)</small>
                </label>
                <textarea id="resa_message" name="resa_message" class="form-control" rows="3" maxlength="5000" placeholder="Régime alimentaire, allergies, demande spéciale..." aria-describedby="resa-message-counter"><?php echo isset( $_POST['resa_message'] ) ? esc_textarea( wp_unslash( $_POST['resa_message'] ) ) : ''; ?></textarea>
                <small class="form-help" id="resa-message-counter" aria-live="polite">0 / 5000 caractères</small>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit btn btn-primary btn-large">
                    <?php echo $svg['fleche']; ?> Réserver ma table
                </button>
                <p class="form-note">
                    <?php echo $svg['check']; ?>
                    Nous vous confirmerons votre réservation par téléphone ou WhatsApp
                </p>
            </div>
        </form>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     CTA FINAL (identique aux autres pages)
     ═══════════════════════════════════════════ -->
<section class="cta-final-section section-padding" aria-labelledby="cta-restaurant-title">
    <div class="container">
        <div class="cta-content reveal-section">
            <span class="cta-icon"><?php echo $svg['coeur']; ?></span>
            <h2 id="cta-restaurant-title">Envie de découvrir notre cuisine ?</h2>
            <p>Réservez votre table et laissez-vous surprendre par nos plats préparés avec passion et des produits frais.</p>

            <div class="cta-actions">
                <a href="#reservation-restaurant" class="btn btn-primary btn-large">
                    <?php echo $svg['calendrier']; ?> Réserver une table
                </a>
                <a href="<?php echo esc_url( $url_whatsapp ); ?>" class="btn btn-outline-light btn-large" target="_blank" rel="noopener noreferrer">Parler sur WhatsApp</a>
            </div>

            <p class="cta-whatsapp">
                Une question ? <a href="<?php echo esc_url( $url_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">Écrivez-nous sur WhatsApp</a>
            </p>
        </div>
    </div>
</section>

<!-- Compteur de caractères pour le message -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('resa_message');
    const counter = document.getElementById('resa-message-counter');

    if (textarea && counter) {
        function updateCounter() {
            const length = textarea.value.length;
            counter.textContent = length + ' / 5000 caractères';

            if (length > 4500) {
                counter.style.color = '#dc3545';
                counter.style.fontWeight = 'bold';
            } else if (length > 4000) {
                counter.style.color = '#ffc107';
                counter.style.fontWeight = 'normal';
            } else {
                counter.style.color = '#666';
                counter.style.fontWeight = 'normal';
            }
        }

        textarea.addEventListener('input', updateCounter);
        updateCounter();
    }
});
</script>

<?php get_footer(); ?>