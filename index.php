<?php get_header(); ?>

<div class="container">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class(); ?>>
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php esc_html_e( 'Aucun contenu pour le moment.', 'college-filles-bf' ); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>