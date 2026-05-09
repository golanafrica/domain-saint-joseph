<?php
/**
 * Template Name: Contact
 */
get_header(); ?>

<!-- HERO SECTION -->
<?php 
$hero_image = get_theme_mod('hero_contact_image');
$hero_opacity = get_theme_mod('hero_contact_opacity', '0.7');
$hero_badge = get_theme_mod('hero_contact_badge', '📞 Restons connectés');
$hero_titre = get_theme_mod('hero_contact_titre', 'Contactez-nous');
$hero_soustitre = get_theme_mod('hero_contact_soustitre', 'Une question ? Une demande d\'information ? Nous sommes à votre écoute.');
?>

<section class="page-header contact-header" <?php if( $hero_image ) : ?>style="background-image: linear-gradient(rgba(0, 0, 0, <?php echo $hero_opacity; ?>), rgba(0, 0, 0, <?php echo $hero_opacity; ?>)), url('<?php echo esc_url( $hero_image ); ?>'); background-size: cover; background-position: center;"<?php endif; ?>>
    <div class="container">
        <div class="header-content">
            <span class="header-badge"><?php echo esc_html( $hero_badge ); ?></span>
            <h1 class="header-title"><?php echo esc_html( $hero_titre ); ?></h1>
            <div class="header-divider">
                <span class="divider-line"></span>
                <span class="divider-icon">✉️</span>
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

<!-- SECTION CONTACT -->
<section class="contact-section section-padding">
    <div class="container">
        <div class="contact-grid">
            <!-- Informations de contact -->
            <div class="contact-infos">
                <h2>📋 Nos coordonnées</h2>
                
                <div class="info-block">
                    <div class="info-icon">📍</div>
                    <div class="info-content">
                        <h3>Adresse</h3>
                        <p>547 rue de Pala, Secteur 25<br>Bobo-Dioulasso, Burkina Faso</p>
                        <p class="info-small">BP: 598 Bobo-Dioulasso 01</p>
                    </div>
                </div>
                
                <div class="info-block">
                    <div class="info-icon">📞</div>
                    <div class="info-content">
                        <h3>Téléphone</h3>
                        <p>
                            <a href="tel:+22620972897">20 97 28 97</a><br>
                            <a href="tel:+22657521929">57 52 19 29</a>
                        </p>
                    </div>
                </div>
                
                <div class="info-block">
                    <div class="info-icon">📱</div>
                    <div class="info-content">
                        <h3>WhatsApp</h3>
                        <p><a href="https://wa.me/22666605890" target="_blank">+226 66 60 58 90</a></p>
                    </div>
                </div>
                
                <div class="info-block">
                    <div class="info-icon">✉️</div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p><a href="mailto:centredsj@gmail.com">centredsj@gmail.com</a></p>
                    </div>
                </div>
                
                <div class="info-block">
                    <div class="info-icon">⏰</div>
                    <div class="info-content">
                        <h3>Horaires d'ouverture</h3>
                        <p>Lundi - Vendredi: 8h00 - 17h00<br>Samedi: 9h00 - 12h00</p>
                    </div>
                </div>
                
                <!-- Carte Google Maps -->
                <div class="map-container">
                    <h3>📍 Nous trouver</h3>
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
                    <h2>✉️ Envoyez-nous un message</h2>
                    <p>Remplissez le formulaire ci-dessous, nous vous répondrons dans les meilleurs délais.</p>
                </div>
                
                <?php if ( isset( $_GET['success'] ) && $_GET['success'] === '1' ) : ?>
                    <div class="alert alert-success">
                        <span class="alert-icon">✅</span>
                        <div class="alert-content">
                            <strong>Message envoyé !</strong> Merci de nous avoir contactés. Nous vous répondrons sous 48h.
                        </div>
                    </div>
                <?php elseif ( isset( $_GET['error'] ) ) : ?>
                    <div class="alert alert-error">
                        <span class="alert-icon">❌</span>
                        <div class="alert-content">
                            <?php
                            $error = $_GET['error'];
                            if ( $error === 'missing' ) echo '<strong>Champs manquants</strong><br>Veuillez remplir tous les champs obligatoires.';
                            elseif ( $error === 'send' ) echo '<strong>Erreur d\'envoi</strong><br>Veuillez réessayer ou nous contacter par WhatsApp.';
                            else echo '<strong>Erreur</strong><br>Une erreur est survenue. Veuillez réessayer.';
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <form class="form-contact" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                    <input type="hidden" name="action" value="dsj_contact_form">
                    <?php wp_nonce_field( 'dsj_contact_nonce', '_wpnonce' ); ?>
                    
                    <div class="form-group">
                        <label for="cf_nom">👤 Nom complet <span class="required">*</span></label>
                        <input type="text" id="cf_nom" name="cf_nom" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cf_contact">📞 Email ou Téléphone <span class="required">*</span></label>
                        <input type="text" id="cf_contact" name="cf_contact" class="form-control" placeholder="exemple@email.com ou 20 97 28 97" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cf_sujet">📝 Sujet <span class="required">*</span></label>
                        <select id="cf_sujet" name="cf_sujet" class="form-control" required>
                            <option value="general">Information générale</option>
                            <option value="formation">Inscription formation</option>
                            <option value="reservation">Réservation hébergement</option>
                            <option value="don">Soutien / Don</option>
                            <option value="partenariat">Partenariat</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="cf_message">💬 Message <span class="required">*</span></label>
                        <textarea id="cf_message" name="cf_message" class="form-control" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn-submit">
                            <span class="btn-icon">✉️</span>
                            Envoyer le message
                        </button>
                    </div>
                </form>
                
                <div class="contact-alternatif">
                    <p>Ou contactez-nous directement sur <strong>WhatsApp</strong> :</p>
                    <a href="https://wa.me/22666605890" class="btn btn-whatsapp" target="_blank">
                        💬 Écrire sur WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>