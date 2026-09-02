<?php
/**
 * Footer du thème Domaine Saint Joseph
 * ✅ Modernisé : icônes SVG officielles (FB/IG/YT/WhatsApp)
 * ✅ Accessibilité : labels, aria, focus clavier
 * ✅ Cohérent avec le header et les pages modernes
 */
?>
</main><!-- #main -->

<footer class="site-footer" role="contentinfo" aria-label="Pied de page">
    <div class="container">
        <div class="footer-grid">

            <!-- ══════ Colonne 1 : À propos ══════ -->
            <div class="footer-col footer-col-about">
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

                <!-- Horaires -->
                <div class="footer-hours">
                    <svg class="footer-icon footer-icon-clock" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 7v5l3 3"/>
                    </svg>
                    <div>
                        <strong>Horaires d'ouverture</strong>
                        <small>Lun-Ven: 8h00 - 17h00</small>
                        <small>Sam: 9h00 - 12h00</small>
                    </div>
                </div>

                <!-- Réseaux sociaux (SVG officiels) -->
                <div class="footer-social" role="list" aria-label="Réseaux sociaux">
                    <a href="#" class="social-link social-link-facebook" role="listitem" aria-label="Suivez-nous sur Facebook" target="_blank" rel="noopener noreferrer">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="social-link social-link-instagram" role="listitem" aria-label="Suivez-nous sur Instagram" target="_blank" rel="noopener noreferrer">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="#" class="social-link social-link-youtube" role="listitem" aria-label="Abonnez-vous à notre chaîne YouTube" target="_blank" rel="noopener noreferrer">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', dsj_get_whatsapp() ) ); ?>" class="social-link social-link-whatsapp" role="listitem" aria-label="Contactez-nous sur WhatsApp" target="_blank" rel="noopener noreferrer">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                </div>
            </div>

            <!-- ══════ Colonne 2 : Contact (dynamique) ══════ -->
            <div class="footer-col footer-col-contact">
                <h3>
                    <svg class="footer-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    Contact
                </h3>
                <ul class="footer-contact">
                    <li>
                        <svg class="footer-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <span>547 rue de Pala, Secteur 25<br>Bobo-Dioulasso, Burkina Faso</span>
                    </li>
                    <li>
                        <svg class="footer-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        <span>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', dsj_get_phone() ) ); ?>">
                                <?php echo esc_html( dsj_get_phone() ); ?>
                            </a>
                            <br>
                            <a href="tel:+22657521929">+226 57 52 19 29</a>
                        </span>
                    </li>
                    <li>
                        <svg class="footer-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <a href="mailto:<?php echo esc_attr( dsj_get_email() ); ?>">
                            <?php echo esc_html( dsj_get_email() ); ?>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- ══════ Colonne 3 : Liens rapides ══════ -->
            <div class="footer-col footer-col-links">
                <h3>
                    <svg class="footer-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="8" y1="6" x2="21" y2="6"/>
                        <line x1="8" y1="12" x2="21" y2="12"/>
                        <line x1="8" y1="18" x2="21" y2="18"/>
                        <line x1="3" y1="6" x2="3.01" y2="6"/>
                        <line x1="3" y1="12" x2="3.01" y2="12"/>
                        <line x1="3" y1="18" x2="3.01" y2="18"/>
                    </svg>
                    Liens rapides
                </h3>
                <ul class="footer-menu">
                    <li><a href="<?php echo esc_url( home_url( '/formation' ) ); ?>">
                        <svg class="footer-icon-small" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12.5V17c0 1.7 2.7 3 6 3s6-1.3 6-3v-4.5"/></svg>
                        Nos formations
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>">
                        <svg class="footer-icon-small" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5L12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M10 21v-6h4v6"/></svg>
                        Maison d'accueil
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/restaurant' ) ); ?>">
                        <svg class="footer-icon-small" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                        Restaurant
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/a-propos' ) ); ?>">
                        <svg class="footer-icon-small" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        À propos
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/galerie' ) ); ?>">
                        <svg class="footer-icon-small" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                        Galerie
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/nous-soutenir' ) ); ?>">
                        <svg class="footer-icon-small" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>
                        Nous soutenir
                    </a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
                        <svg class="footer-icon-small" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        Contact
                    </a></li>
                </ul>
            </div>

            <!-- ══════ Colonne 4 : Newsletter ══════ -->
            <div class="footer-col footer-col-newsletter">
                <h3>
                    <svg class="footer-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    Restez connectés
                </h3>
                <p class="newsletter-text">Recevez nos actualités, événements et offres spéciales.</p>

                <form class="footer-newsletter" action="#" method="post" onsubmit="return false;">
                    <label for="footer-newsletter-email" class="screen-reader-text">Votre adresse email</label>
                    <div class="newsletter-input-wrap">
                        <input type="email" id="footer-newsletter-email" name="email" placeholder="Votre adresse email" required autocomplete="email">
                        <button type="submit" aria-label="S'abonner à la newsletter">
                            <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </button>
                    </div>
                </form>

                <p class="newsletter-note">
                    <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    Nous respectons votre vie privée. Désabonnement en 1 clic.
                </p>

                <!-- CTA WhatsApp principal -->
                <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', dsj_get_whatsapp() ) ); ?>"
                   class="footer-whatsapp"
                   target="_blank"
                   rel="noopener noreferrer"
                   aria-label="Écrire directement sur WhatsApp">
                    <svg class="footer-whatsapp-icon" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span>Écrire sur WhatsApp</span>
                </a>
            </div>

        </div>

        <!-- ══════ Footer Bottom ══════ -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p class="footer-copyright">
                    &copy; <?php echo date( 'Y' ); ?> <strong>Domaine Saint Joseph</strong>
                    <span class="footer-sep">—</span>
                    Travailleuses Missionnaires de l'Immaculée
                </p>
                <p class="footer-credits">
                    <a href="<?php echo esc_url( home_url( '/mentions-legales' ) ); ?>">Mentions légales</a>
                    <span class="footer-sep">|</span>
                    <a href="<?php echo esc_url( home_url( '/politique-de-confidentialite' ) ); ?>">Confidentialité</a>
                    <span class="footer-sep">|</span>
                    <a href="<?php echo esc_url( home_url( '/cookies' ) ); ?>">Cookies</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Bouton retour en haut (visible au scroll, via JS) -->
    <button class="back-to-top" aria-label="Retour en haut de page" id="backToTop">
        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"/>
        </svg>
    </button>
</footer>

<?php wp_footer(); ?>

<!-- Script retour en haut -->
<script>
(function() {
    const btn = document.getElementById('backToTop');
    if (!btn) return;
    window.addEventListener('scroll', function() {
        if (window.scrollY > 400) btn.classList.add('is-visible');
        else btn.classList.remove('is-visible');
    }, { passive: true });
    btn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
})();
</script>
</body>
</html>