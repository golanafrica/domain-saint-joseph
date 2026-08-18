<?php
/**
 * Template générique pour les pages standards
 * Domaine Saint Joseph
 */
get_header(); ?>

<main id="main" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>

        <!-- Header de page avec titre -->
        <?php if ( ! is_front_page() ) : ?>
            <section class="page-header generic-header">
                <div class="page-photo-zone"></div>
                <div class="header-caption-band">
                    <span class="header-badge">? <?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ?? 'Page' ); ?></span>
                    <h1 class="header-title"><?php the_title(); ?></h1>
                    <div class="header-divider">
                        <span class="divider-line"></span>
                        <span class="divider-icon">?</span>
                        <span class="divider-line"></span>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Contenu de la page -->
        <section class="page-content section-padding">
            <div class="container">
                <div class="page-content-wrapper">
                    <?php
                    the_content();

                    wp_link_pages( [
                        'before' => '<div class="page-links">' . __( 'Pages:', 'domaine-saint-joseph' ),
                        'after'  => '</div>',
                    ] );
                    ?>
                </div>
            </div>
        </section>

        <!-- CTA Contact (optionnel, sauf sur page contact) -->
        <?php if ( ! is_page( 'contact' ) && ! is_page( 'nous-soutenir' ) ) : ?>
            <section class="cta-page section-padding bg-light">
                <div class="container">
                    <div class="cta-page-content">
                        <h2>Une question ? Besoin d'informations ?</h2>
                        <p>N'hésitez pas à nous contacter, nous vous répondrons avec plaisir.</p>
                        <div class="cta-buttons">
                            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">
                                ? Nous contacter
                            </a>
                            <a href="https://wa.me/<?php echo esc_attr( dsj_get_whatsapp() ); ?>"
                               class="btn btn-whatsapp"
                               target="_blank"
                               rel="noopener noreferrer">
                                ? WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    <?php endwhile; ?>

</main>

<?php
get_footer();