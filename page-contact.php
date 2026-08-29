<?php
/**
 * Template Name: Contact
 * Phase 1 : coordonnées dynamiques via dsj_get_phone / dsj_get_whatsapp / dsj_get_email
 * ✅ Phase A11Y : aria-live sur alertes, iframe title, emojis aria-hidden
 */
get_header(); ?>

<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_contact_image' );
$hero_badge     = get_theme_mod( 'hero_contact_badge', '&#128222; Restons connectés' );
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

<!-- SECTION CONTACT -->
<section class="contact-section section-padding" aria-labelledby="contact-section-title">
    <h2 id="contact-section-title" class="screen-reader-text">Nos coordonnées et formulaire de contact</h2>
    <div class="container">
        <div class="contact-grid">
            <!-- Informations de contact -->
            <div class="contact-infos">
                <h2><span aria-hidden="true">&#128203;</span> Nos coordonnées</h2>
                
                <div class="info-block">
                    <div class="info-icon" aria-hidden="true">&#128205;</div>
                    <div class="info-content">
                        <h3>Adresse</h3>
                        <p>547 rue de Pala, Secteur 25<br>Bobo-Dioulasso, Burkina Faso</p>
                        <p class="info-small">BP: 598 Bobo-Dioulasso 01</p>
                    </div>
                </div>
                
                <!-- ✅ DYNAMIQUE : lu depuis Apparence → Personnaliser -->
                <div class="info-block">
                    <div class="info-icon" aria-hidden="true">&#128222;</div>
                    <div class="info-content">
                        <h3>Téléphone</h3>
                        <p>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', dsj_get_phone() ) ); ?>">
                                <?php echo esc_html( dsj_get_phone() ); ?>
                            </a><br>
                            <!-- Numéro secondaire (à ajouter au Customizer si besoin) -->
                            <a href="tel:+22657521929">57 52 19 29</a>
                        </p>
                    </div>
                </div>
                
                <!-- ✅ DYNAMIQUE -->
                <div class="info-block">
                    <div class="info-icon" aria-hidden="true">&#128241;</div>
                    <div class="info-content">
                        <h3>WhatsApp</h3>
                        <p>
                            <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', dsj_get_whatsapp() ) ); ?>" target="_blank" rel="noopener noreferrer">
                                +<?php echo esc_html( dsj_get_whatsapp() ); ?>
                            </a>
                        </p>
                    </div>
                </div>
                
                <!-- ✅ DYNAMIQUE -->
                <div class="info-block">
                    <div class="info-icon" aria-hidden="true">&#128231;</div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p>
                            <a href="mailto:<?php echo esc_attr( dsj_get_email() ); ?>">
                                <?php echo esc_html( dsj_get_email() ); ?>
                            </a>
                        </p>
                    </div>
                </div>
                
                <div class="info-block">
                    <div class="info-icon" aria-hidden="true">&#128339;</div>
                    <div class="info-content">
                        <h3>Horaires d'ouverture</h3>
                        <p>Lundi - Vendredi: 8h00 - 17h00<br>Samedi: 9h00 - 12h00</p>
                    </div>
                </div>
                
                <!-- Carte Google Maps -->
                <div class="map-container">
                    <h3><span aria-hidden="true">&#128506;</span> Nous trouver</h3>
                    <iframe 
                        src="https://maps.google.com/maps?q=Bobo-Dioulasso+Secteur+25+547+rue+de+Pala&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="200" 
                        style="border:0; border-radius: 12px;" 
                        allowfullscreen="" 
                        loading="lazy"
                        title="Carte de localisation du Domaine Saint Joseph - 547 rue de Pala, Secteur 25, Bobo-Dioulasso">
                    </iframe>
                </div>
            </div>
            
            <!-- Formulaire de contact -->
            <div class="contact-formulaire">
                <div class="form-header">
                    <h2><span aria-hidden="true">&#128172;</span> Envoyez-nous un message</h2>
                    <p>Remplissez le formulaire ci-dessous, nous vous répondrons dans les meilleurs délais.</p>
                </div>
                
                <?php if ( isset( $_GET['success'] ) && $_GET['success'] === '1' ) : ?>
                    <div class="alert alert-success" role="alert" aria-live="polite">
                        <span class="alert-icon" aria-hidden="true">&#9989;</span>
                        <div class="alert-content">
                            <strong>Message envoyé !</strong> Merci de nous avoir contactés. Nous vous répondrons sous 48h.
                        </div>
                    </div>
                <?php elseif ( isset( $_GET['error'] ) ) : ?>
                    <div class="alert alert-error" role="alert" aria-live="assertive">
                        <span class="alert-icon" aria-hidden="true">&#10060;</span>
                        <div class="alert-content">
                            <?php
                            $error = sanitize_text_field( wp_unslash( $_GET['error'] ?? '' ) );
                            switch ( $error ) {
                                case 'missing':
                                    echo '<strong>Champs manquants</strong><br>Veuillez remplir tous les champs obligatoires.';
                                    break;
                                case 'too_long':
                                    echo '<strong>Message trop long</strong><br>Votre message dépasse la limite de 5000 caractères. Veuillez le raccourcir.';
                                    break;
                                case 'invalid_contact':
                                    echo '<strong>Contact invalide</strong><br>Veuillez entrer un email ou numéro de téléphone valide.';
                                    break;
                                case 'rate_limit':
                                    echo '<strong>Trop de messages</strong><br>Vous avez envoyé trop de messages récemment. Veuillez attendre quelques minutes avant de réessayer.';
                                    break;
                                case 'session_expired':
                                    echo '<strong>Session expirée</strong><br>Votre session a expiré pour des raisons de sécurité. Veuillez recharger la page et réessayer.';
                                    break;
                                case 'service_unavailable':
                                    echo '<strong>Service temporairement indisponible</strong><br>Notre service de messagerie rencontre un problème technique. Merci de réessayer plus tard ou de nous contacter par WhatsApp.';
                                    break;
                                case 'send':
                                    echo '<strong>Erreur d\'envoi</strong><br>Une erreur est survenue lors de l\'envoi. Veuillez réessayer ou nous contacter directement par WhatsApp.';
                                    break;
                                default:
                                    echo '<strong>Erreur</strong><br>Une erreur est survenue. Veuillez réessayer.';
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <form class="form-contact" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
                    <input type="hidden" name="action" value="dsj_contact_form">
                    <?php wp_nonce_field( 'dsj_contact_nonce', '_wpnonce' ); ?>
                    
                    <!-- Honeypot anti-spam (invisible pour les humains) -->
                    <div class="dsj-honeypot" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;">
                        <label for="dsj_hp_field_contact">Ne pas remplir ce champ</label>
                        <input type="text" id="dsj_hp_field_contact" name="dsj_hp_field" tabindex="-1" autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                        <label for="cf_nom">
                            <span aria-hidden="true">&#128100;</span> Nom complet <span class="required" aria-hidden="true">*</span>
                            <span class="screen-reader-text">(obligatoire)</span>
                        </label>
                        <input type="text" id="cf_nom" name="cf_nom" class="form-control" value="<?php echo isset( $_POST['cf_nom'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['cf_nom'] ) ) ) : ''; ?>" required aria-required="true">
                    </div>
                    
                    <div class="form-group">
                        <label for="cf_contact">
                            <span aria-hidden="true">&#128222;</span> Email ou Téléphone <span class="required" aria-hidden="true">*</span>
                            <span class="screen-reader-text">(obligatoire)</span>
                        </label>
                        <input type="text" id="cf_contact" name="cf_contact" class="form-control" placeholder="exemple@email.com ou 20 97 28 97" value="<?php echo isset( $_POST['cf_contact'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['cf_contact'] ) ) ) : ''; ?>" required aria-required="true">
                    </div>
                    
                    <div class="form-group">
                        <label for="cf_sujet">
                            <span aria-hidden="true">&#128196;</span> Sujet <span class="required" aria-hidden="true">*</span>
                            <span class="screen-reader-text">(obligatoire)</span>
                        </label>
                        <select id="cf_sujet" name="cf_sujet" class="form-control" required aria-required="true">
                            <option value="general" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'general' ); ?>>Information générale</option>
                            <option value="formation" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'formation' ); ?>>Inscription formation</option>
                            <option value="reservation" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'reservation' ); ?>>Réservation hébergement</option>
                            <option value="don" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'don' ); ?>>Soutien / Don</option>
                            <option value="partenariat" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'partenariat' ); ?>>Partenariat</option>
                            <option value="autre" <?php selected( isset( $_POST['cf_sujet'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_sujet'] ) ) : '', 'autre' ); ?>>Autre</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="cf_message">
                            <span aria-hidden="true">&#128172;</span> Message <span class="required" aria-hidden="true">*</span> <small>(max 5000 caractères)</small>
                            <span class="screen-reader-text">(obligatoire)</span>
                        </label>
                        <textarea id="cf_message" name="cf_message" class="form-control" rows="5" maxlength="5000" required aria-required="true" aria-describedby="cf-message-counter"><?php echo isset( $_POST['cf_message'] ) ? esc_textarea( wp_unslash( $_POST['cf_message'] ) ) : ''; ?></textarea>
                        <small class="form-help" id="cf-message-counter" aria-live="polite">0 / 5000 caractères</small>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn-submit">
                            <span class="btn-icon" aria-hidden="true">&#128232;</span>
                            Envoyer le message
                        </button>
                    </div>
                </form>
                
                <!-- ✅ Bouton WhatsApp DYNAMIQUE -->
                <div class="contact-alternatif">
                    <p>Ou contactez-nous directement sur <strong>WhatsApp</strong> :</p>
                    <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', dsj_get_whatsapp() ) ); ?>" class="btn btn-whatsapp" target="_blank" rel="noopener noreferrer" aria-label="Nous contacter sur WhatsApp">
                        <span aria-hidden="true">&#128172;</span> Écrire sur WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Compteur de caractères pour le message -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('cf_message');
    const counter = document.getElementById('cf-message-counter');
    
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