<?php
/**
 * Template par défaut
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <h1><?php the_title(); ?></h1>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p><?php esc_html_e( 'Aucun contenu pour le moment.', 'domaine-saint-joseph' ); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>