<?php
/**
 * Footer du thème Domaine Saint Joseph
 * Phase 1 : coordonnées dynamiques via dsj_get_phone / dsj_get_whatsapp / dsj_get_email
 * Phase A11Y : hiérarchie des titres corrigée (H3 au lieu de H4)
 */
?>
</main><!-- #main -->

<footer class="site-footer" role="contentinfo">
    
    </div>

    <div class="container">
        <div class="footer-grid">
            <!-- Colonne 1 - À propos & Réseaux sociaux -->
            <div class="footer-col">
                <div class="footer-logo">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <h3 class="footer-title">Domaine Saint Joseph</h3>
                    <?php endif; ?>
                </div>
                <p class="footer-description">
                    Centre de formation technique & Maison d'accueil<br>
                    <strong>Bobo-Dioulasso, Burkina Faso</strong>
                </p>
                
                <!-- Horaires d'ouverture intégrés -->
                <div class="footer-hours">
                    <span class="hours-icon">&#128339;</span>
                    <div>
                        <strong>Horaires d'ouverture</strong>
                        <small>Lun-Ven: 8h00 - 17h00</small>
                        <small>Sam: 9h00 - 12h00</small>
                    </div>
                </div>
                
                <!-- Réseaux sociaux stylisés -->
                <div class="footer-social">
                    <a href="#" class="social-link" aria-label="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <circle cx="12" cy="12" r="3"/>
                            <line x1="17" y1="7" x2="17" y2="7"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="YouTube">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/>
                            <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Colonne 2 - Contact (✅ DYNAMIQUE) -->
            <div class="footer-col">
                <h3>&#128222; Contact</h3>
                <ul class="footer-contact">
                    <li>
                        <span class="contact-icon">&#128205;</span>
                        <span>547 rue de Pala, Secteur 25<br>Bobo-Dioulasso, Burkina Faso</span>
                    </li>
                    <li>
                        <span class="contact-icon">&#128222;</span>
                        <span>
                            <!-- ✅ DYNAMIQUE : téléphone principal -->
                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', dsj_get_phone() ) ); ?>">
                                <?php echo esc_html( dsj_get_phone() ); ?>
                            </a> / 
                            <!-- Numéro secondaire (pas de Customizer pour celui-ci) -->
                            <a href="tel:+22657521929">57 52 19 29</a>
                        </span>
                    </li>
                    <li>
                        <span class="contact-icon">&#128241;</span>
                        <!-- ✅ DYNAMIQUE : WhatsApp -->
                        <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', dsj_get_whatsapp() ) ); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            WhatsApp: <?php echo esc_html( dsj_get_whatsapp() ); ?>
                        </a>
                    </li>
                    <li>
                        <span class="contact-icon">&#128231;</span>
                        <!-- ✅ DYNAMIQUE : Email -->
                        <a href="mailto:<?php echo esc_attr( dsj_get_email() ); ?>">
                            <?php echo esc_html( dsj_get_email() ); ?>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Colonne 3 - Liens rapides -->
            <div class="footer-col">
                <h3>&#128279; Liens rapides</h3>
                <ul class="footer-menu">
                    <li><a href="<?php echo esc_url( home_url( '/formation' ) ); ?>">&#127891; Nos formations</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>">&#127968; Maison d'accueil</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/restaurant' ) ); ?>">&#127869; Restaurant</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/a-propos' ) ); ?>">&#128214; À propos</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/galerie' ) ); ?>">&#128248; Galerie</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/nous-soutenir' ) ); ?>">&#128157; Nous soutenir</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">&#128233; Contact</a></li>
                </ul>
            </div>

            <!-- Colonne 4 - Newsletter -->
            <div class="footer-col">
                <h3>&#128232; Restez connectés</h3>
                <p class="newsletter-text">Recevez nos actualités, événements et offres spéciales.</p>
                
                <form class="footer-newsletter" action="#" method="post" onsubmit="return false;">
                    <input type="email" name="email" placeholder="Votre adresse email" required>
                    <button type="submit" aria-label="S'abonner">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                    </button>
                </form>
                
                <p class="newsletter-note">&#128241; Suivez-nous aussi sur WhatsApp pour l'actualité du centre.</p>
                
                <!-- ✅ Bouton WhatsApp DYNAMIQUE dans le footer -->
                <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', dsj_get_whatsapp() ) ); ?>" 
                   class="footer-whatsapp" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    <span class="footer-whatsapp-icon">&#128172;</span>
                    <span>Écrire sur WhatsApp</span>
                </a>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>
                    &copy; <?php echo date( 'Y' ); ?> Domaine Saint Joseph &#8212;
                    Travailleuses Missionnaires de l'Immaculée
                </p>
                <p class="footer-credits">
                    <a href="<?php echo esc_url( home_url( '/mentions-legales' ) ); ?>">Mentions légales</a> | 
                    <a href="<?php echo esc_url( home_url( '/politique-de-confidentialite' ) ); ?>">Politique de confidentialité</a> |
                    <a href="<?php echo esc_url( home_url( '/cookies' ) ); ?>">Cookies</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>