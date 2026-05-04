</main><!-- #main -->

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h4>Collège Filles BF</h4>
                <p>Formation technique et autonomie<br>pour les jeunes filles du Burkina Faso</p>
            </div>
            <div class="footer-col">
                <h4>Navigation</h4>
                <?php wp_nav_menu([
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'container'      => false,
                ]); ?>
            </div>
            <div class="footer-col">
    <h4>Contact</h4>
    <p>📍 547 rue de Pala, Secteur 25<br>Bobo-Dioulasso, Burkina Faso</p>
    <p>📞 (+226) 20 97 28 97</p>
    <p>📱 (+226) 57 52 19 29 / 01 09 36 712</p>
    <p>✉️ centredsj@gmail.com</p>
    <p>💬 <a href="https://wa.me/22666605890">WhatsApp : +226 66 60 58 90</a></p>
</div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date( 'Y' ); ?> Collège Filles BF. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>