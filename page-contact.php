<?php
/**
 * Template Name: Contact
 */
get_header(); ?>

<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_contact_image' );
$hero_badge     = get_theme_mod( 'hero_contact_badge', '&#128222; Restons connectés' );
$hero_titre     = get_theme_mod( 'hero_contact_titre', 'Contactez-nous' );
$hero_soustitre = get_theme_mod( 'hero_contact_soustitre', 'Une question ? Une demande d\'information ? Nous sommes à votre écoute.' );
?>

<section class="page-header contact-header">
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
            <span class="divider-icon">&#9993;</span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
    </div>
</section>

<!-- SECTION CONTACT -->
<section class="contact-section section-padding">
    <div class="container">
        <div class="contact-grid">
            <!-- Informations de contact -->
            <div class="contact-infos">
                <h2>&#128203; Nos coordonnées</h2>
                
                <div class="info-block">
                    <div class="info-icon">&#128205;</div>
                    <div class="info-content">
                        <h3>Adresse</h3>
                        <p>547 rue de Pala, Secteur 25<br>Bobo-Dioulasso, Burkina Faso</p>
                        <p class="info-small">BP: 598 Bobo-Dioulasso 01</p>
                    </div>
                </div>
                
                <div class="info-block">
                    <div class="info-icon">&#128222;</div>
                    <div class="info-content">
                        <h3>Téléphone</h3>
                        <p>
                            <a href="tel:+22620972897">20 97 28 97</a><br>
                            <a href="tel:+22657521929">57 52 19 29</a>
                        </p>
                    </div>
                </div>
                
                <div class="info-block">
                    <div class="info-icon">&#128241;</div>
                    <div class="info-content">
                        <h3>WhatsApp</h3>
                        <p><a href="https://wa.me/22666605890" target="_blank">+226 66 60 58 90</a></p>
                    </div>
                </div>
                
                <div class="info-block">
                    <div class="info-icon">&#128231;</div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p><a href="mailto:centredsj@gmail.com">centredsj@gmail.com</a></p>
                    </div>
                </div>
                
                <div class="info-block">
                    <div class="info-icon">&#128339;</div>
                    <div class="info-content">
                        <h3>Horaires d'ouverture</h3>
                        <p>Lundi - Vendredi: 8h00 - 17h00<br>Samedi: 9h00 - 12h00</p>
                    </div>
                </div>
                
                <!-- Carte Google Maps -->
                <div class="map-container">
                    <h3>&#128506; Nous trouver</h3>
                    <iframe 
                        src="https://maps.google.com/maps?q=Bobo-Dioulasso+Secteur+25+547+rue+de+Pala&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="200" 
                        style="border:0; border-radius: 12px;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
            
            <!-- Formulaire de contact -->
            <div class="contact-formulaire">
                <div class="form-header">
                    <h2>&#128172; Envoyez-nous un message</h2>
                    <p>Remplissez le formulaire ci-dessous, nous vous répondrons dans les meilleurs délais.</p>
                </div>
                
                <?php if ( isset( $_GET['success'] ) && $_GET['success'] === '1' ) : ?>
                    <div class="alert alert-success">
                        <span class="alert-icon">&#9989;</span>
                        <div class="alert-content">
                            <strong>Message envoyé !</strong> Merci de nous avoir contactés. Nous vous répondrons sous 48h.
                        </div>
                    </div>
                <?php elseif ( isset( $_GET['error'] ) ) : ?>
                    <div class="alert alert-error">
                        <span class="alert-icon">&#10060;</span>
                        <div class="alert-content">
                            <?php
                            $error = $_GET['error'] ?? '';
                            if ( $error === 'missing' ) {
                                echo '<strong>Champs manquants</strong><br>Veuillez remplir tous les champs obligatoires.';
                            } elseif ( $error === 'too_long' ) {
                                echo '<strong>Message trop long</strong><br>Votre message dépasse la limite de 5000 caractères. Veuillez le raccourcir.';
                            } elseif ( $error === 'invalid_contact' ) {
                                echo '<strong>Contact invalide</strong><br>Veuillez entrer un email ou numéro de téléphone valide.';
                            } elseif ( $error === 'rate_limit' ) {
                                echo '<strong>Trop de messages</strong><br>Vous avez envoyé trop de messages récemment. Veuillez attendre quelques minutes avant de réessayer.';
                            } elseif ( $error === 'session_expired' ) {
                                echo '<strong>Session expirée</strong><br>Votre session a expiré pour des raisons de sécurité. Veuillez recharger la page et réessayer.';
                            } elseif ( $error === 'service_unavailable' ) {
                                echo '<strong>Service temporairement indisponible</strong><br>Notre service de messagerie rencontre un problème technique. Merci de réessayer plus tard ou de nous contacter par WhatsApp.';
                            } elseif ( $error === 'send' ) {
                                echo '<strong>Erreur d\'envoi</strong><br>Une erreur est survenue lors de l\'envoi. Veuillez réessayer ou nous contacter directement par WhatsApp.';
                            } else {
                                echo '<strong>Erreur</strong><br>Une erreur est survenue. Veuillez réessayer.';
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <form class="form-contact" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                    <input type="hidden" name="action" value="dsj_contact_form">
                    <?php wp_nonce_field( 'dsj_contact_nonce', '_wpnonce' ); ?>
                    
                    <!-- Honeypot anti-spam (invisible pour les humains) -->
                    <div style="position: absolute; left: -9999px;" aria-hidden="true">
                        <label>Ne pas remplir ce champ
                            <input type="text" name="dsj_hp_field" tabindex="-1" autocomplete="off">
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label for="cf_nom">&#128100; Nom complet <span class="required">*</span></label>
                        <input type="text" id="cf_nom" name="cf_nom" class="form-control" value="<?php echo isset( $_POST['cf_nom'] ) ? esc_attr( $_POST['cf_nom'] ) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cf_contact">&#128222; Email ou Téléphone <span class="required">*</span></label>
                        <input type="text" id="cf_contact" name="cf_contact" class="form-control" placeholder="exemple@email.com ou 20 97 28 97" value="<?php echo isset( $_POST['cf_contact'] ) ? esc_attr( $_POST['cf_contact'] ) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cf_sujet">&#128196; Sujet <span class="required">*</span></label>
                        <select id="cf_sujet" name="cf_sujet" class="form-control" required>
                            <option value="general" <?php selected( $_POST['cf_sujet'] ?? '', 'general' ); ?>>Information générale</option>
                            <option value="formation" <?php selected( $_POST['cf_sujet'] ?? '', 'formation' ); ?>>Inscription formation</option>
                            <option value="reservation" <?php selected( $_POST['cf_sujet'] ?? '', 'reservation' ); ?>>Réservation hébergement</option>
                            <option value="don" <?php selected( $_POST['cf_sujet'] ?? '', 'don' ); ?>>Soutien / Don</option>
                            <option value="partenariat" <?php selected( $_POST['cf_sujet'] ?? '', 'partenariat' ); ?>>Partenariat</option>
                            <option value="autre" <?php selected( $_POST['cf_sujet'] ?? '', 'autre' ); ?>>Autre</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="cf_message">&#128172; Message <span class="required">*</span> <small>(max 5000 caractères)</small></label>
                        <textarea id="cf_message" name="cf_message" class="form-control" rows="5" maxlength="5000" required><?php echo isset( $_POST['cf_message'] ) ? esc_textarea( $_POST['cf_message'] ) : ''; ?></textarea>
                        <small class="form-help" id="message-counter">0 / 5000 caractères</small>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn-submit">
                            <span class="btn-icon">&#128232;</span>
                            Envoyer le message
                        </button>
                    </div>
                </form>
                
                <div class="contact-alternatif">
                    <p>Ou contactez-nous directement sur <strong>WhatsApp</strong> :</p>
                    <a href="https://wa.me/22666605890" class="btn btn-whatsapp" target="_blank">
                        &#128172; Écrire sur WhatsApp
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
        updateCounter(); // Mise à jour initiale
    }
});
</script>

<?php get_footer(); ?>