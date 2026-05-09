</main><!-- #main -->

<footer class="site-footer" role="contentinfo">
    <!-- Vague décorative avant le footer -->
    <div class="footer-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
            <path fill="#1A5276" fill-opacity="1" d="M0,64L80,58.7C160,53,320,43,480,48C640,53,800,75,960,80C1120,85,1280,75,1360,69.3L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>

    <div class="container">
        <div class="footer-grid">
            <!-- Colonne 1 - À propos -->
            <div class="footer-col">
                <div class="footer-logo">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <h3 class="footer-title">Domaine Saint Joseph</h3>
                    <?php endif; ?>
                </div>
                <p class="footer-description">Centre de formation technique & Maison d'accueil<br>Bobo-Dioulasso, Burkina Faso</p>
                <p class="footer-address">📍 547 rue de Pala, Secteur 25<br>BP: 598 Bobo-Dioulasso 01</p>
                <div class="footer-social">
                    <a href="#" class="social-link" aria-label="Facebook">📘</a>
                    <a href="#" class="social-link" aria-label="Instagram">📷</a>
                    <a href="#" class="social-link" aria-label="YouTube">🎥</a>
                </div>
            </div>

            <!-- Colonne 2 - Contact -->
            <div class="footer-col">
                <h4>📞 Contact</h4>
                <ul class="footer-contact">
                    <li>
                        <span class="contact-icon">📍</span>
                        <span>547 rue de Pala, Secteur 25<br>Bobo-Dioulasso</span>
                    </li>
                    <li>
                        <span class="contact-icon">📞</span>
                        <span>20 97 28 97 / 57 52 19 29</span>
                    </li>
                    <li>
                        <span class="contact-icon">📱</span>
                        <a href="https://wa.me/22666605890" target="_blank" rel="noopener">WhatsApp: 66 60 58 90</a>
                    </li>
                    <li>
                        <span class="contact-icon">✉️</span>
                        <a href="mailto:centredsj@gmail.com">centredsj@gmail.com</a>
                    </li>
                </ul>
            </div>

            <!-- Colonne 3 - Liens rapides -->
            <div class="footer-col">
                <h4>🔗 Liens rapides</h4>
                <ul class="footer-menu">
                    <li><a href="<?php echo esc_url( home_url( '/formation' ) ); ?>">🎓 Nos formations</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>">🏠 Maison d'accueil</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/a-propos' ) ); ?>">🙏 À propos</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/galerie' ) ); ?>">📸 Galerie</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/nous-soutenir' ) ); ?>">💛 Nous soutenir</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">📞 Contact</a></li>
                </ul>
            </div>

            <!-- Colonne 4 - Newsletter & Horaires -->
            <div class="footer-col">
                <h4>📧 Restez connectés</h4>
                <p class="newsletter-text">Recevez nos actualités et événements</p>
                <form class="footer-newsletter" action="#" method="post">
                    <input type="email" placeholder="Votre email" required>
                    <button type="submit">📧</button>
                </form>
                <div class="footer-hours">
                    <span class="hours-icon">🕒</span>
                    <div>
                        <strong>Horaires d'ouverture</strong>
                        <small>Lun-Ven: 8h-17h | Sam: 9h-12h</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; <?php echo date( 'Y' ); ?> Domaine Saint Joseph — Travailleuses Missionnaires de l'Immaculée</p>
                <p class="footer-credits">
                    <a href="#">Mentions légales</a> | 
                    <a href="#">Politique de confidentialité</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>