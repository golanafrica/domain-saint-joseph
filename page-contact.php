<?php
/*
Template Name: Contact
*/
get_header(); ?>

<section class="page-header">
    <div class="container">
        <h1>Nous Contacter</h1>
        <p class="page-subtitle">Une question ? Une réservation ? Écrivez-nous.</p>
    </div>
</section>

<section class="contact-grid section-padding">
    <div class="container">
        <div class="grid-2">
            <!-- Coordonnées -->
            <div class="contact-info">
                <h3>📍 Adresse</h3>
                <p>547 rue de Pala, Secteur 25<br>Bobo-Dioulasso, Burkina Faso</p>

                <h3>📞 Téléphones</h3>
                <p>
                    <a href="tel:+22620972897">(+226) 20 97 28 97</a><br>
                    <a href="tel:+22657521929">(+226) 57 52 19 29</a><br>
                    <a href="tel:+226010936712">(+226) 01 09 36 712</a>
                </p>

                <h3>💬 WhatsApp</h3>
                <p>
                    <a href="https://wa.me/22666605890" class="btn-whatsapp" target="_blank" rel="noopener">
                        +226 66 60 58 90 → Discuter maintenant
                    </a>
                </p>

                <h3>✉️ Email</h3>
                <p><a href="mailto:centredsj@gmail.com">centredsj@gmail.com</a></p>

                <h3>🕒 Horaires d'accueil</h3>
                <p>Lundi - Vendredi : 7h30 - 17h30<br>Samedi : 8h00 - 12h00</p>
            </div>

            <!-- Formulaire -->
            <div class="contact-form">
                <h3>Envoyer un message</h3>
                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <input type="hidden" name="action" value="dsj_contact_form">
                    
                    <label for="cf-nom">Nom *</label>
                    <input type="text" id="cf-nom" name="cf_nom" required>

                    <label for="cf-contact">Email ou Téléphone *</label>
                    <input type="text" id="cf-contact" name="cf_contact" required>

                    <label for="cf-sujet">Sujet</label>
                    <select id="cf-sujet" name="cf_sujet">
                        <option value="general">Demande générale</option>
                        <option value="formation">Inscription formation</option>
                        <option value="hebergement">Réservation hébergement</option>
                        <option value="partenariat">Partenariat / Don</option>
                    </select>

                    <label for="cf-message">Message *</label>
                    <textarea id="cf-message" name="cf_message" rows="5" required></textarea>

                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <p class="small">Nous répondons sous 48h ouvrées.</p>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Google Maps (lazy load pour 3G) -->
<section class="map-section">
    <div class="container">
        <div class="map-wrapper">
            <!-- Placeholder léger chargé d'abord -->
            <div class="map-placeholder" id="map-placeholder">
                <p>🗺️ Chargement de la carte...</p>
                <button class="btn btn-small" onclick="loadGoogleMap()">Afficher la carte</button>
            </div>
            <!-- Iframe Google Maps chargée à la demande -->
            <iframe 
                id="google-map"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.5!2d-4.3!3d11.18!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTHCsDEwJzQ4LjAiTiA0wrAxOCcwMC4wIlc!5e0!3m2!1sfr!2sbf!4v1234567890"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                style="border:0; width:100%; height:400px; display:none;"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

<script>
// Chargement différé de Google Maps (optimisation 3G)
function loadGoogleMap() {
    const placeholder = document.getElementById('map-placeholder');
    const iframe = document.getElementById('google-map');
    if (placeholder && iframe) {
        placeholder.style.display = 'none';
        iframe.style.display = 'block';
    }
}
</script>

<?php get_footer(); ?>