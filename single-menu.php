<?php
/**
 * Template : Single Menu (plat du restaurant)
 * Photo, prix, temps, ingrédients, allergènes + plats similaires.
 */

get_header();

while ( have_posts() ) :
	the_post();

	$prix        = get_post_meta( get_the_ID(), '_menu_prix', true );
	$temps       = get_post_meta( get_the_ID(), '_menu_temps', true );
	$ingredients = get_post_meta( get_the_ID(), '_menu_ingredients', true );
	$allergenes  = get_post_meta( get_the_ID(), '_menu_allergenes', true );
	$categories  = get_the_terms( get_the_ID(), 'categorie_menu' );
	?>

	<main id="main" class="site-main">

		<!-- ===== HERO ===== -->
		<section class="page-header restaurant-header">
			<div class="page-photo-zone"
				<?php if ( has_post_thumbnail() ) : ?>
					style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'hero-size' ) ); ?>');"
				<?php endif; ?>>
			</div>
			<div class="header-caption-band">
				<span class="header-badge">&#127869; Notre carte</span>
				<h1 class="header-title"><?php the_title(); ?></h1>
				<div class="header-divider">
					<span class="divider-line"></span>
					<span class="divider-icon">&#127860;</span>
					<span class="divider-line"></span>
				</div>
				<?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
					<p class="header-subtitle">
						<?php echo esc_html( implode( ' • ', wp_list_pluck( $categories, 'name' ) ) ); ?>
					</p>
				<?php endif; ?>
			</div>
		</section>

		<!-- ===== DÉTAIL DU PLAT ===== -->
		<section class="section-padding bg-blanc">
			<div class="container">
				<div class="restaurant-preview-modern">

					<!-- Colonne infos -->
					<div class="restaurant-info-card">
						<h3>&#128203; Détails du plat</h3>

						<?php if ( $prix ) : ?>
							<div class="horaire-item">
								<span class="horaire-icon">&#128176;</span>
								<div>
									<strong>Prix</strong>
									<span><?php echo esc_html( $prix ); ?> F CFA</span>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( $temps ) : ?>
							<div class="horaire-item">
								<span class="horaire-icon">&#9200;</span>
								<div>
									<strong>Temps de préparation</strong>
									<span><?php echo esc_html( $temps ); ?></span>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( $allergenes ) : ?>
							<div class="horaire-item">
								<span class="horaire-icon">&#9888;&#65039;</span>
								<div>
									<strong>Allergènes</strong>
									<span><?php echo esc_html( $allergenes ); ?></span>
								</div>
							</div>
						<?php endif; ?>

						<div class="restaurant-cta-home mt-3">
							<a href="<?php echo esc_url( home_url( '/restaurant#reservation-restaurant' ) ); ?>" class="btn btn-primary btn-animated">
								&#128197; Réserver une table
							</a>
							<a href="<?php echo esc_url( home_url( '/restaurant' ) ); ?>" class="btn btn-secondary btn-animated">
								&#127869; Voir la carte
							</a>
						</div>
					</div>

					<!-- Colonne description -->
					<div class="page-content-wrapper single-detail-content">
						<?php if ( $ingredients ) : ?>
							<h2>&#129396; Ingrédients</h2>
							<p><?php echo esc_html( $ingredients ); ?></p>
						<?php endif; ?>

						<h2>&#128221; Description</h2>
						<?php the_content(); ?>
					</div>

				</div>
			</div>
		</section>

		<!-- ===== AUTRES PLATS ===== -->
		<?php
		$related_args = [
			'post_type'      => 'menu',
			'posts_per_page' => 3,
			'post__not_in'   => [ get_the_ID() ],
			'orderby'        => 'date',
			'order'          => 'DESC',
		];

		if ( $categories && ! is_wp_error( $categories ) ) {
			$related_args['tax_query'] = [ [
				'taxonomy' => 'categorie_menu',
				'field'    => 'term_id',
				'terms'    => wp_list_pluck( $categories, 'term_id' ),
			] ];
		}

		$related = new WP_Query( $related_args );

		if ( $related->have_posts() ) :
			?>
			<section class="section-padding bg-gris">
				<div class="container">
					<div class="section-header">
						<span class="section-badge section-badge-dark">&#127869; À découvrir aussi</span>
						<h2 class="section-title">Autres plats</h2>
						<div class="section-divider"></div>
					</div>

					<div class="menu-grid">
						<?php
						while ( $related->have_posts() ) :
							$related->the_post();

							$r_prix  = get_post_meta( get_the_ID(), '_menu_prix', true );
							$r_temps = get_post_meta( get_the_ID(), '_menu_temps', true );
							?>
							<div class="menu-card">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="menu-image">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'card-thumb' ); ?>
										</a>
										<?php if ( $r_prix ) : ?>
											<span class="menu-price"><?php echo esc_html( $r_prix ); ?> F</span>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<div class="menu-content">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="menu-meta">
										<?php if ( $r_temps ) : ?>
											<span class="menu-time">&#9200; <?php echo esc_html( $r_temps ); ?></span>
										<?php endif; ?>
									</div>
									<a href="<?php the_permalink(); ?>" class="btn-reserver">Voir ce plat</a>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
			<?php
			wp_reset_postdata();
		endif;
		?>

	</main>

<?php
endwhile;

get_footer();