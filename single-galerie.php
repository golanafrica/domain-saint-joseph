<?php
/**
 * Template : Single Galerie (photo)
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<main id="main" class="site-main">

		<!-- ===== HERO ===== -->
		<section class="page-header galerie-header">
			<div class="page-photo-zone"
				<?php if ( has_post_thumbnail() ) : ?>
					style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'hero-size' ) ); ?>');"
				<?php endif; ?>>
			</div>
			<div class="header-caption-band">
				<span class="header-badge">&#128248; Galerie</span>
				<h1 class="header-title"><?php the_title(); ?></h1>
				<div class="header-divider">
					<span class="divider-line"></span>
					<span class="divider-icon">&#128248;</span>
					<span class="divider-line"></span>
				</div>
				<p class="header-subtitle"><?php echo esc_html( get_the_date( 'd F Y' ) ); ?></p>
			</div>
		</section>

		<!-- ===== PHOTO + TEXTE ===== -->
		<section class="section-padding bg-blanc">
			<div class="container">
				<div class="page-content-wrapper single-galerie-wrapper">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'large' ); ?>
					<?php endif; ?>

					<?php if ( has_excerpt() ) : ?>
						<p><?php echo esc_html( get_the_excerpt() ); ?></p>
					<?php endif; ?>

					<?php the_content(); ?>

					<div class="text-center mt-4">
						<a href="<?php echo esc_url( home_url( '/galerie' ) ); ?>" class="btn btn-secondary btn-animated">
							&#128248; Voir toute la galerie
						</a>
					</div>
				</div>
			</div>
		</section>

	</main>

<?php
endwhile;

get_footer();