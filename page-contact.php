<?php
/**
 * Template Name: Contact
 * ✅ Modernisé : icônes SVG, design system cohérent
 * ✅ Accessibilité WCAG AAA maintenue
 */
get_header(); ?>

<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_contact_image' );
$hero_badge     = get_theme_mod( 'hero_contact_badge', '✉️ Restons connectés' );
$hero_titre     = get_theme_mod( 'hero_contact_titre', 'Contactez-nous' );
$hero_soustitre = get_theme_mod( 'hero_contact_soustitre', 'Une question ? Une demande d\'information ? Nous sommes à votre écoute.' );
?>

<section class="page-header contact-header" aria-labelledby="contact-hero-title">
    <div class="page-photo-zone"
         <?php if ( $hero_image ) : ?>
         style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
         <?php endif; ?>
         role="img"
         aria-label="<?php echo esc_attr( $hero_titre ); ?>">
    </div>
    <div class="header-caption-band">
        <span class="header-badge" aria-hidden="true"><?php echo wp_kses_post( $hero_badge ); ?></span>
        <h1 class="header-title" id="contact-hero-title"><?php echo esc_html( $hero_titre ); ?></h1>
        <div class="header-divider" aria-hidden="true">
            <span class="divider-line"></span>
            <span class="divider-icon">&#9993;</span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
    </div>
</section>

<!-- SECTION CONTACT MODERNISÉE -->
<section class="contact-section section-padding" aria-labelledby="contact-section-title">
    <h2 id="contact-section-title" class="screen-reader-text">Nos coordonnées et formulaire de contact</h2>
    <div class="container">

        <!-- ══════ Intro ══════ -->
        <div class="contact-intro">
            <span class="section-badge-light">
                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                Contact
            </span>
            <h2 class="section-title">Nous sommes là pour vous</h2>
            <div class="section-divider"></div>
            <p class="section-subtitle">Choisissez le moyen qui vous convient le mieux pour nous joindre. Nous répondons généralement sous 24-48h.</p>
        </div>

        <div class="contact-grid">

            <!-- ══════ Colonne gauche : Coordonnées ══════ -->
            <div class="contact-infos">

                <div class="info-block info-block-card">
                    <div class="info-icon info-icon-primary">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>Adresse</h3>
                        <p>547 rue de Pala, Secteur 25<br>Bobo-Dioulasso, Burkina Faso</p>
                        <p class="info-small">BP: 598 Bobo-Dioulasso 01</p>
                    </div>
                </div>

                <div class="info-block info-block-card">
                    <div class="info-icon info-icon-success">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>Téléphone</h3>
                        <p>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', dsj_get_phone() ) ); ?>">
                                <?php echo esc_html( dsj_get_phone() ); ?>
                            </a><br>
                            <a href="tel:+22657521929">+226 57 52 19 29</a>
                        </p>
                    </div>
                </div>

                <div class="info-block info-block-card">
                    <div class="info-icon info-icon-whatsapp">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </div>
                    <div class="info-content">
                        <h3>WhatsApp</h3>
                        <p>
                            <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', dsj_get_whatsapp() ) ); ?>" target="_blank" rel="noopener noreferrer">
                                +<?php echo esc_html( dsj_get_whatsapp() ); ?>
                            </a>
                        </p>
                    </div>
                </div>

                <div class="info-block info-block-card">
                    <div class="info-icon info-icon-accent">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p>
                            <a href="mailto:<?php echo esc_attr( dsj_get_email() ); ?>">
                                <?php echo esc_html( dsj_get_email() ); ?>
                            </a>
                        </p>
                    </div>
                </div>

                <div class="info-block info-block-card">
                    <div class="info-icon info-icon-warning">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 7v5l3 3"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>Horaires d'ouverture</h3>
                        <p>Lundi - Vendredi: <strong>8h00 - 17h00</strong><br>Samedi: <strong>9h00 - 12h00</strong></p>
                    </div>
                </div>

                <!-- Carte Google Maps -->
                <div class="map-container">
                    <h3>
                        <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 6v16l7-4 8 4 7-4V2l-7 4-8-4-7 4z"/>
                            <line x1="8" y1="2" x2="8" y2="18"/>
                            <line x1="16" y1="6" x2="16" y2="22"/>
                        </svg>
                        Nous trouver
                    </h3>
                    <div class="map-wrapper">
                        <iframe
                            src="https://maps.google.com/maps?q=Bobo-Dioulasso+Secteur+25+547+rue+de+Pala&t=&z=15&ie=UTF8&iwloc=&output=embed"
                            width="100%"
                            height="300"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            title="Carte de localisation du Domaine Saint Joseph - 547 rue de Pala, Secteur 25, Bobo-Dioulasso">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- ══════ Colonne droite : Formulaire ══════ -->
            <div class="contact-formulaire">
                <div class="form-card">
                    <div class="form-header">
                        <div class="form-header-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                        </div>
                        <h2>Envoyez-nous un message</h2>
                        <p>Remplissez le formulaire ci-dessous, nous vous répondrons dans les meilleurs délais.</p>
                    </div>

                    <?php if ( isset( $_GET['success'] ) && $_GET['success'] === '1' ) : ?>
                        <div class="alert alert-success" role="alert" aria-live="polite">
                            <span class="alert-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                            </span>
                            <div class="alert-content">
                                <strong>Message envoyé !</strong>
                                <span>Merci de nous avoir contactés. Nous vous répondrons sous 48h.</span>
                            </div>
                        </div>
                    <?php elseif ( isset( $_GET['error'] ) ) : ?>
                        <div class="alert alert-error" role="alert" aria-live="assertive">
                            <span class="alert-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                            </span>
                            <div class="alert-content">
                                <?php
                                $error = sanitize_text_field( wp_unslash( $_GET['error'] ?? '' ) );
                                switch ( $error ) {
                                    case 'missing':
                                        echo '<strong>Champs manquants</strong><span>Veuillez remplir tous les champs obligatoires.</span>';
                                        break;
                                    case 'too_long':
                                        echo '<strong>Message trop long</strong><span>Votre message dépasse la limite de 5000 caractères.</span>';
                                        break;
                                    case 'invalid_contact':
                                        echo '<strong>Contact invalide</strong><span>Veuillez entrer un email ou numéro de téléphone valide.</span>';
                                        break;
                                    case 'rate_limit':
                                        echo '<strong>Trop de messages</strong><span>Veuillez attendre quelques minutes avant de réessayer.</span>';
                                        break;
                                    case 'session_expired':
                                        echo '<strong>Session expirée</strong><span>Veuillez recharger la page et réessayer.</span>';
                                        break;
                                    case 'service_unavailable':
                                        echo '<strong>Service indisponible</strong><span>Réessayez plus tard ou contactez-nous par WhatsApp.</span>';
                                        break;
                                    case 'send':
                                        echo '<strong>Erreur d\'envoi</strong><span>Veuillez réessayer ou nous contacter par WhatsApp.</span>';
                                        break;
                                    default:
                                        echo '<strong>Erreur</strong><span>Une erreur est survenue. Veuillez réessayer.</span>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form class="form-contact" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
                        <input type="hidden" name="action" value="dsj_contact_form">
                        <?php wp_nonce_field( 'dsj_contact_nonce', '_wpnonce' ); ?>

                        <!-- Honeypot anti-spam -->
                        <div class="dsj-honeypot" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;">
                            <label for="dsj_hp_field_contact">Ne pas remplir ce champ</label>
                            <input type="text" id="dsj_hp_field_contact" name="dsj_hp_field" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="cf_nom">
                                    <svg class="label-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                    Nom complet <span class="required" aria-hidden="true">*</span>
                                </label>
                                <input type="text" id="cf_nom" name="cf_nom" class="form-control" placeholder="Jean Dupont" value="<?php echo isset( $_POST['cf_nom'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['cf_nom'] ) ) ) : ''; ?>" required aria-required="true">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="cf_contact">
                                    <svg class="label-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                        <polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                    Email ou Téléphone <span class="required" aria-hidden="true">*</span>
                                </label>
                                <input type="text" id="cf_contact" name="cf_contact" class="form-control" placeholder="exemple@email.com ou +226 70 00 00 00" value="<?php echo isset( $_POST['cf_contact'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['cf_contact'] ) ) ) : ''; ?>" required aria-required="true">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="cf_sujet">
                                    <svg class="label-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                    </svg>
                                    Sujet <span class="required" aria-hidden="true">*</span>
                                </label>
                                <div class="select-wrap">
                                    <select id="cf_sujet" name="cf_sujet" class="form-control" required aria-required="true">
                                        <option value="general" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'general' ); ?>>Information générale</option>
                                        <option value="formation" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'formation' ); ?>>Inscription formation</option>
                                        <option value="reservation" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'reservation' ); ?>>Réservation hébergement</option>
                                        <option value="don" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'don' ); ?>>Soutien / Don</option>
                                        <option value="partenariat" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'partenariat' ); ?>>Partenariat</option>
                                        <option value="autre" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'autre' ); ?>>Autre</option>
                                    </select>
                                    <svg class="select-arrow" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="cf_message">
                                    <svg class="label-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                    </svg>
                                    Message <span class="required" aria-hidden="true">*</span>
                                </label>
                                <textarea id="cf_message" name="cf_message" class="form-control" rows="6" maxlength="5000" required aria-required="true" aria-describedby="cf-message-counter" placeholder="Comment pouvons-nous vous aider ?"></textarea>
                                <small class="form-help" id="cf-message-counter" aria-live="polite">0 / 5000 caractères</small>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <svg class="dsj-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="22" y1="2" x2="11" y2="13"/>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                                </svg>
                                Envoyer le message
                            </button>
                        </div>
                    </form>

                    <!-- CTA WhatsApp -->
                    <div class="contact-alternatif">
                        <div class="alt-divider"><span>ou</span></div>
                        <p>Contactez-nous directement sur WhatsApp pour une réponse immédiate :</p>
                        <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', dsj_get_whatsapp() ) ); ?>" class="btn btn-whatsapp-contact" target="_blank" rel="noopener noreferrer" aria-label="Nous contacter sur WhatsApp">
                            <svg aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Écrire sur WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Compteur de caractères -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('cf_message');
    const counter = document.getElementById('cf-message-counter');
    if (textarea && counter) {
        function updateCounter() {
            const length = textarea.value.length;
            counter.textContent = length + ' / 5000 caractères';
            if (length > 4500) { counter.style.color = '#dc3545'; counter.style.fontWeight = '700'; }
            else if (length > 4000) { counter.style.color = '#ffc107'; counter.style.fontWeight = 'normal'; }
            else { counter.style.color = '#888'; counter.style.fontWeight = 'normal'; }
        }
        textarea.addEventListener('input', updateCounter);
        updateCounter();
    }
});
</script>

<?php get_footer(); ?>