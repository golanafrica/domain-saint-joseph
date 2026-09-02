<?php
/**
 * Template pour l'affichage d'un hébergement individuel
 * Version modernisée : même langage visuel que l'accueil
 * (SVG cohérents, reveal au scroll, accessibilité complète)
 */

get_header();

/* ────────────────────────────────────────────────────────────
   ICÔNES SVG (cohérentes sur tous les appareils)
   ──────────────────────────────────────────────────────────── */
$svg_wrap = '<svg class="dsj-icon" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
$svg = [
    'maison'     => $svg_wrap . '<path d="M3 10.5L12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M10 21v-6h4v6"/></svg>',
    'eglise'     => $svg_wrap . '<path d="M18 22V8l-6-6-6 6v14"/><path d="M12 2v4"/><path d="M10 4h4"/><path d="M8 18h8"/><path d="M12 12v6"/></svg>',
    'users'      => $svg_wrap . '<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
    'person'     => $svg_wrap . '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
    'argent'     => $svg_wrap . '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
    'calendrier' => $svg_wrap . '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',
    'horloge'    => $svg_wrap . '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>',
    'coeur'      => $svg_wrap . '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>',
    'check'      => $svg_wrap . '<path d="M20 6L9 17l-5-5"/></svg>',
    'cross'      => $svg_wrap . '<circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
    'clipboard'  => $svg_wrap . '<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>',
    'livre'      => $svg_wrap . '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
    'edit'       => $svg_wrap . '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>',
    'fleche'     => $svg_wrap . '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
    'soleil'     => $svg_wrap . '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>',
    'couverts'   => $svg_wrap . '<path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>',
    'cadenas'    => $svg_wrap . '<rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
    'bed'        => $svg_wrap . '<path d="M2 4v16"/><path d="M2 8h18a2 2 0 0 1 2 2v10"/><path d="M2 17h20"/><circle cx="7" cy="12" r="2"/></svg>',
    'phone'      => $svg_wrap . '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
    'mail'       => $svg_wrap . '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
];

$url_whatsapp = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', get_theme_mod( 'whatsapp', '22666605890' ) );
?>

<main id="main" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php
        // Image du hero : priorité image mise en avant > image du Customizer
        $hero_image_url = '';
        if ( has_post_thumbnail() ) {
            $hero_image_url = get_the_post_thumbnail_url( get_the_ID(), 'hero-size' );
        }
        if ( empty( $hero_image_url ) ) {
            $hero_image_url = get_theme_mod( 'hero_maison_image', '' );
        }
        ?>

        <!-- ═══════════════════════════════════════════
             HERO SECTION
             ═══════════════════════════════════════════ -->
        <section class="page-header hebergement-single-header" aria-labelledby="hebergement-hero-title">
            <div class="page-photo-zone"
                 <?php if ( $hero_image_url ) : ?>
                 style="background-image: url('<?php echo esc_url( $hero_image_url ); ?>');"
                 <?php endif; ?>
                 role="img"
                 aria-label="<?php echo esc_attr( get_the_title() ); ?>">
            </div>
            <div class="header-caption-band">
                <span class="header-badge">
                    <?php echo $svg['maison']; ?>
                    Notre hébergement
                </span>
                <h1 class="header-title" id="hebergement-hero-title"><?php the_title(); ?></h1>
                <div class="header-divider">
                    <span class="divider-line"></span>
                    <span class="divider-icon"><?php echo $svg['bed']; ?></span>
                    <span class="divider-line"></span>
                </div>
                <?php if ( has_excerpt() ) : ?>
                    <p class="header-subtitle"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
                <?php endif; ?>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════
             CONTENU PRINCIPAL (image + infos en grid)
             ═══════════════════════════════════════════ -->
        <section class="hebergement-single section-padding">
            <div class="container">
                <div class="hebergement-grid reveal-section">
                    <!-- Colonne image avec galerie -->
                    <div class="hebergement-gallery">
                        <div class="main-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'large', [
                                    'class'    => 'img-responsive',
                                    'loading'  => 'lazy',
                                    'decoding' => 'async',
                                    'alt'      => esc_attr( get_the_title() ),
                                ] ); ?>
                            <?php else : ?>
                                <div class="hebergement-image-placeholder">
                                    <?php echo $svg['bed']; ?>
                                    <span><?php the_title(); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                        // Récupérer les images de la galerie (si ajoutées via ACF ou autre)
                        $gallery = get_post_meta( get_the_ID(), '_dsj_gallery', true );
                        if ( $gallery ) : ?>
                        <div class="gallery-thumbs">
                            <?php foreach ( $gallery as $image_id ) : ?>
                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'thumbnail' ) ); ?>"
                                     alt="<?php echo esc_attr( get_the_title() ); ?>"
                                     loading="lazy"
                                     decoding="async">
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Colonne infos -->
                    <div class="hebergement-infos">
                        <div class="infos-card">
                            <h3>
                                <?php echo $svg['clipboard']; ?>
                                Détails de la chambre
                            </h3>

                            <?php
                            $capacite    = get_post_meta( get_the_ID(), '_dsj_capacite', true );
                            $prix_nuit   = get_post_meta( get_the_ID(), '_dsj_prix_nuit', true );
                            $dispo       = get_post_meta( get_the_ID(), '_dsj_dispo', true );
                            $equipements = get_post_meta( get_the_ID(), '_dsj_equipements', true );
                            ?>

                            <?php if ( $capacite ) : ?>
                            <div class="info-row">
                                <span class="info-label"><?php echo $svg['users']; ?> Capacité</span>
                                <span class="info-value"><?php echo esc_html( $capacite ); ?> personne(s)</span>
                            </div>
                            <?php endif; ?>

                            <?php if ( $prix_nuit ) : ?>
                            <div class="info-row">
                                <span class="info-label"><?php echo $svg['argent']; ?> Prix par nuit</span>
                                <span class="info-value"><?php echo esc_html( $prix_nuit ); ?> F CFA</span>
                            </div>
                            <?php endif; ?>

                            <?php if ( $dispo ) : ?>
                            <div class="info-row">
                                <span class="info-label"><?php echo $svg['calendrier']; ?> Disponibilité</span>
                                <span class="info-value">
                                    <?php
                                    if ( $dispo === 'disponible' ) {
                                        echo '<span class="badge-disponible">' . $svg['check'] . ' Disponible</span>';
                                    } elseif ( $dispo === 'sur_reservation' ) {
                                        echo '<span class="badge-reservation">' . $svg['phone'] . ' Sur réservation</span>';
                                    } else {
                                        echo '<span class="badge-complet">' . $svg['cross'] . ' Complet</span>';
                                    }
                                    ?>
                                </span>
                            </div>
                            <?php endif; ?>

                            <?php if ( $equipements ) : ?>
                            <div class="info-row equipements">
                                <span class="info-label"><?php echo $svg['bed']; ?> Équipements</span>
                                <div class="equipements-list">
                                    <?php
                                    $equipements_clean = preg_split( '/[\s,]+/', $equipements );
                                    foreach ( $equipements_clean as $equip ) :
                                        if ( trim( $equip ) ) : ?>
                                            <span class="equipement-tag"><?php echo $svg['check']; ?> <?php echo esc_html( ucfirst( trim( $equip ) ) ); ?></span>
                                    <?php
                                        endif;
                                    endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- ✅ CORRIGÉ : btn-secondary (visible sur fond blanc) -->
                        <div class="reservation-cta">
                            <a href="#reservation" class="btn btn-primary btn-large" aria-label="Réserver la chambre <?php echo esc_attr( get_the_title() ); ?>">
                                <?php echo $svg['calendrier']; ?> Réserver cette chambre
                            </a>
                            <a href="<?php echo esc_url( $url_whatsapp ); ?>?text=<?php echo urlencode( 'Bonjour, je souhaite réserver ' . get_the_title() ); ?>"
                               class="btn btn-secondary btn-large"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="Réserver par WhatsApp la chambre <?php echo esc_attr( get_the_title() ); ?>">
                                <?php echo $svg['phone']; ?> Réserver par WhatsApp
                            </a>
                        </div>

                        <!-- Informations supplémentaires -->
                        <div class="info-extra">
                            <div class="extra-item">
                                <span class="extra-icon"><?php echo $svg['horloge']; ?></span>
                                <div>
                                    <strong>Check-in / Check-out</strong>
                                    <small>Arrivée: 14h00 | Départ: 12h00</small>
                                </div>
                            </div>
                            <div class="extra-item">
                                <span class="extra-icon"><?php echo $svg['couverts']; ?></span>
                                <div>
                                    <strong>Petit-déjeuner</strong>
                                    <small>Disponible sur demande</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description complète -->
                <div class="hebergement-description reveal-section">
                    <h3>
                        <?php echo $svg['livre']; ?>
                        Description de la chambre
                    </h3>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════
             FORMULAIRE DE RÉSERVATION
             ═══════════════════════════════════════════ -->
        <section class="reservation section-padding section-alt" id="reservation" aria-labelledby="reservation-hebergement-title">
            <div class="container">
                <div class="reservation-header">
                    <span class="reservation-badge">
                        <?php echo $svg['calendrier']; ?> Réservez votre séjour
                    </span>
                    <h2 class="reservation-title" id="reservation-hebergement-title">Demander une Réservation</h2>
                    <div class="reservation-divider"></div>
                    <p class="reservation-subtitle">Remplissez ce formulaire et nous vous répondrons sous 48h</p>
                </div>

                <?php if ( isset( $_GET['success'] ) && $_GET['success'] === '1' ) : ?>
                    <div class="alert alert-success" role="alert" aria-live="polite">
                        <span class="alert-icon" aria-hidden="true"><?php echo $svg['check']; ?></span>
                        <div class="alert-content">
                            <strong>Demande envoyée !</strong> Merci pour votre demande de réservation. Nous vous répondrons sous 48h par WhatsApp ou email pour confirmer la disponibilité.
                        </div>
                    </div>
                <?php elseif ( isset( $_GET['error'] ) ) : ?>
                    <div class="alert alert-error" role="alert" aria-live="assertive">
                        <span class="alert-icon" aria-hidden="true"><?php echo $svg['cross']; ?></span>
                        <div class="alert-content">
                            <?php
                            $error = sanitize_text_field( wp_unslash( $_GET['error'] ?? '' ) );
                            switch ( $error ) {
                                case 'missing':
                                    echo '<strong>Champs manquants</strong><br>Veuillez remplir tous les champs obligatoires (nom, contact, dates d\'arrivée et de départ).';
                                    break;
                                case 'too_long':
                                    echo '<strong>Message trop long</strong><br>Votre message dépasse la limite de 5000 caractères. Veuillez le raccourcir.';
                                    break;
                                case 'invalid_contact':
                                    echo '<strong>Contact invalide</strong><br>Veuillez entrer un email ou numéro de téléphone valide.';
                                    break;
                                case 'rate_limit':
                                    echo '<strong>Trop de demandes</strong><br>Vous avez envoyé trop de demandes récemment. Veuillez attendre quelques minutes avant de réessayer.';
                                    break;
                                case 'session_expired':
                                    echo '<strong>Session expirée</strong><br>Votre session a expiré pour des raisons de sécurité. Veuillez recharger la page et réessayer.';
                                    break;
                                case 'service_unavailable':
                                    echo '<strong>Service temporairement indisponible</strong><br>Notre service de réservation rencontre un problème technique. Merci de réessayer plus tard ou de nous contacter par WhatsApp.';
                                    break;
                                case 'send':
                                    echo '<strong>Erreur d\'envoi</strong><br>Une erreur est survenue lors de l\'envoi. Veuillez réessayer ou nous contacter directement par WhatsApp.';
                                    break;
                                default:
                                    echo '<strong>Erreur</strong><br>Une erreur est survenue. Veuillez réessayer ou nous contacter par WhatsApp.';
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <form class="form-reservation" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
                    <input type="hidden" name="action" value="dsj_reservation_form">
                    <?php wp_nonce_field( 'dsj_reservation_nonce', '_wpnonce' ); ?>
                    <input type="hidden" name="type" value="<?php echo esc_attr( get_the_title() ); ?>">

                    <!-- Honeypot anti-spam (invisible pour les humains) -->
                    <div class="dsj-honeypot" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;">
                        <label for="dsj_hp_field_resa">Ne pas remplir ce champ</label>
                        <input type="text" id="dsj_hp_field_resa" name="dsj_hp_field" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nom">
                                <?php echo $svg['person']; ?>
                                Nom complet <span class="required" aria-hidden="true">*</span>
                                <span class="screen-reader-text">(obligatoire)</span>
                            </label>
                            <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom et prénom" value="<?php echo isset( $_POST['nom'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['nom'] ) ) ) : ''; ?>" required aria-required="true">
                            <span class="input-border"></span>
                        </div>

                        <div class="form-group">
                            <label for="contact">
                                <?php echo $svg['phone']; ?>
                                Email ou Téléphone <span class="required" aria-hidden="true">*</span>
                                <span class="screen-reader-text">(obligatoire)</span>
                            </label>
                            <input type="text" id="contact" name="contact" class="form-control" placeholder="exemple@email.com ou +226 XX XX XX XX" value="<?php echo isset( $_POST['contact'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['contact'] ) ) ) : ''; ?>" required aria-required="true">
                            <span class="input-border"></span>
                        </div>
                    </div>

                    <div class="form-grid form-grid-3">
                        <div class="form-group">
                            <label for="arrivee">
                                <?php echo $svg['calendrier']; ?>
                                Date d'arrivée <span class="required" aria-hidden="true">*</span>
                                <span class="screen-reader-text">(obligatoire)</span>
                            </label>
                            <input type="date" id="arrivee" name="arrivee" class="form-control" value="<?php echo isset( $_POST['arrivee'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['arrivee'] ) ) ) : ''; ?>" required aria-required="true">
                            <span class="input-border"></span>
                        </div>

                        <div class="form-group">
                            <label for="depart">
                                <?php echo $svg['calendrier']; ?>
                                Date de départ <span class="required" aria-hidden="true">*</span>
                                <span class="screen-reader-text">(obligatoire)</span>
                            </label>
                            <input type="date" id="depart" name="depart" class="form-control" value="<?php echo isset( $_POST['depart'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['depart'] ) ) ) : ''; ?>" required aria-required="true">
                            <span class="input-border"></span>
                        </div>

                        <div class="form-group">
                            <label for="type_chambre">
                                <?php echo $svg['bed']; ?>
                                Type de chambre
                            </label>
                            <input type="text" id="type_chambre" name="type_chambre" class="form-control" value="<?php the_title(); ?>" readonly>
                            <span class="input-border"></span>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="message">
                            <?php echo $svg['edit']; ?>
                            Besoins particuliers <small>(max 5000 caractères)</small>
                        </label>
                        <textarea id="message" name="message" class="form-control" rows="4" maxlength="5000" placeholder="Ex: régime alimentaire, accès PMR, besoins spécifiques..." aria-describedby="message-counter"><?php echo isset( $_POST['message'] ) ? esc_textarea( wp_unslash( $_POST['message'] ) ) : ''; ?></textarea>
                        <small class="form-help" id="message-counter" aria-live="polite">0 / 5000 caractères</small>
                        <span class="input-border"></span>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn-submit btn btn-primary btn-large">
                            <?php echo $svg['fleche']; ?> Envoyer ma demande
                        </button>
                        <p class="form-note">
                            <?php echo $svg['cadenas']; ?>
                            Nous vous répondrons sous 48h par WhatsApp ou email
                        </p>
                    </div>
                </form>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════
             CTA FINAL (fond bleu → btn-outline-light CORRECT)
             ═══════════════════════════════════════════ -->
        <section class="cta-final-section section-padding" aria-labelledby="cta-hebergement-title">
            <div class="container">
                <div class="cta-content reveal-section">
                    <span class="cta-icon"><?php echo $svg['coeur']; ?></span>
                    <h2 id="cta-hebergement-title">Envie de séjourner chez nous ?</h2>
                    <p>La Maison d'Accueil vous accueille pour un séjour paisible, une retraite ou un événement.</p>

                    <div class="cta-actions">
                        <a href="#reservation" class="btn btn-primary btn-large">
                            <?php echo $svg['calendrier']; ?> Réserver maintenant
                        </a>
                        <a href="<?php echo esc_url( $url_whatsapp ); ?>" class="btn btn-outline-light btn-large" target="_blank" rel="noopener noreferrer">
                            <?php echo $svg['phone']; ?> Parler sur WhatsApp
                        </a>
                    </div>

                    <p class="cta-whatsapp">
                        Une question ? <a href="<?php echo esc_url( $url_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">Écrivez-nous sur WhatsApp</a>
                    </p>
                </div>
            </div>
        </section>

    <?php endwhile; ?>

</main>

<!-- Compteur de caractères pour le message -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('message');
    const counter = document.getElementById('message-counter');

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