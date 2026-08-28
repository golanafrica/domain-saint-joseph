<?php
/**
 * Page d'accueil — Version modernisée stable + Accessibilité
 * Contenu 100% dynamique : affiche les DERNIERS éléments publiés
 * (formations, chambres, menus, photos) — max 3 à 4 par section.
 * + Icônes personnalisées pour les Valeurs (Customizer)
 * ✅ Phase A11Y : aria-label sur tous les liens + alt corrigés (vides si texte visible)
 */

get_header();

/* ────────────────────────────────────────────────────────────
   HELPERS
   ──────────────────────────────────────────────────────────── */

/** Sépare un nombre de son suffixe (ex : "100%" → 100 + "%"). */
$dsj_split_stat = function ( $value ) {
	$number = preg_replace( '/[^0-9]/', '', $value );
	$suffix = str_replace( $number, '', $value );

	return [
		'number' => $number ?: '0',
		'suffix' => $suffix,
		'label'  => $value,
	];
};

/** Dernières images publiées d'un CPT (url + titre + lien). */
$dsj_recent_images = function ( $post_type, $limit = 3, $size = 'medium_large' ) {
	$images = [];

	$posts = get_posts( [
		'post_type'      => $post_type,
		'posts_per_page' => $limit,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );

	foreach ( $posts as $post ) {
		if ( has_post_thumbnail( $post->ID ) ) {
			$images[] = [
				'url'   => get_the_post_thumbnail_url( $post->ID, $size ),
				'title' => get_the_title( $post->ID ),
				'link'  => get_permalink( $post->ID ),
			];
		}
	}

	return $images;
};

$stat1 = $dsj_split_stat( get_theme_mod( 'stat1_nb', '2022' ) );
$stat2 = $dsj_split_stat( get_theme_mod( 'stat2_nb', '3+' ) );
$stat3 = $dsj_split_stat( get_theme_mod( 'stat3_nb', '100%' ) );

$chambres_recentes = $dsj_recent_images( 'hebergement', 3 );
$menus_recents     = $dsj_recent_images( 'menu', 4 );
$photos_recentes   = $dsj_recent_images( 'galerie', 4 );
?>

<div class="site-main">

	<!-- ===== HERO SECTION ===== -->
	<?php if ( get_theme_mod( 'hero_slider_active', false ) ) : ?>
		<?php get_template_part( 'template-parts/hero', 'slider' ); ?>
	<?php else : ?>
		<?php get_template_part( 'template-parts/hero', 'default' ); ?>
	<?php endif; ?>

	<!-- ===== NOTRE HISTOIRE ===== -->
	<?php
	$histoire_texte = get_theme_mod(
		'histoire_texte',
		'Le Domaine Saint Joseph a été créé en <strong>2022</strong>. Ce centre est une expression du charisme des <strong>Travailleuses Missionnaires de l\'Immaculée</strong>.'
	);
	?>

	<section class="home-histoire section-padding bg-bleu-clair reveal-section" aria-labelledby="histoire-title">
		<div class="container">
			<div class="section-header">
				<span class="section-badge section-badge-dark" aria-hidden="true">&#128214; Notre histoire</span>
				<h2 class="section-title" id="histoire-title">Le Domaine Saint Joseph</h2>
				<div class="section-divider" aria-hidden="true"></div>
			</div>

			<div class="histoire-content">
				<?php echo wp_kses_post( $histoire_texte ); ?>
			</div>
		</div>
	</section>

	<!-- ===== STATISTIQUES ===== -->
	<section class="stats-section bg-gradient-primary reveal-section" aria-labelledby="stats-title">
		<div class="container">
			<h2 class="screen-reader-text" id="stats-title">Chiffres clés</h2>
			<div class="stats-grid">

				<div class="stat-item stat-card">
					<div class="stat-icon" aria-hidden="true">&#127942;</div>
					<div
						class="stat-number"
						data-count="<?php echo esc_attr( $stat1['number'] ); ?>"
						data-suffix="<?php echo esc_attr( $stat1['suffix'] ); ?>"
					>
						<?php echo esc_html( $stat1['label'] ); ?>
					</div>
					<div class="stat-label">
						<?php echo esc_html( get_theme_mod( 'stat1_lbl', 'Fondé en' ) ); ?>
					</div>
				</div>

				<div class="stat-item stat-card">
					<div class="stat-icon" aria-hidden="true">&#127891;</div>
					<div
						class="stat-number"
						data-count="<?php echo esc_attr( $stat2['number'] ); ?>"
						data-suffix="<?php echo esc_attr( $stat2['suffix'] ); ?>"
					>
						<?php echo esc_html( $stat2['label'] ); ?>
					</div>
					<div class="stat-label">
						<?php echo esc_html( get_theme_mod( 'stat2_lbl', 'Filières' ) ); ?>
					</div>
				</div>

				<div class="stat-item stat-card">
					<div class="stat-icon" aria-hidden="true">&#128170;</div>
					<div
						class="stat-number"
						data-count="<?php echo esc_attr( $stat3['number'] ); ?>"
						data-suffix="<?php echo esc_attr( $stat3['suffix'] ); ?>"
					>
						<?php echo esc_html( $stat3['label'] ); ?>
					</div>
					<div class="stat-label">
						<?php echo esc_html( get_theme_mod( 'stat3_lbl', 'Dédié aux femmes' ) ); ?>
					</div>
				</div>

				<div class="stat-item stat-card">
					<div class="stat-icon" aria-hidden="true">&#128205;</div>
					<div class="stat-number">S25</div>
					<div class="stat-label">Bobo-Dioulasso</div>
				</div>

			</div>
		</div>
	</section>

	<!-- ===== NOS FORMATIONS (3 dernières publiées) ===== -->
	<section class="home-formations section-padding bg-blanc reveal-section" aria-labelledby="formations-title">
		<div class="container">
			<div class="section-header">
				<span class="section-badge section-badge-dark" aria-hidden="true">&#127891; Excellence académique</span>
				<h2 class="section-title" id="formations-title">Nos Formations</h2>
				<div class="section-divider" aria-hidden="true"></div>
				<p class="section-subtitle">Des filières concrètes pour l'autonomie des jeunes filles.</p>
			</div>

			<div class="formations-grid">
				<?php
				$formations = new WP_Query( [
					'post_type'      => 'formation',
					'posts_per_page' => 3,
					'orderby'        => 'date',
					'order'          => 'DESC',
				] );

				if ( $formations->have_posts() ) :
					while ( $formations->have_posts() ) :
						$formations->the_post();

						$duree = get_post_meta( get_the_ID(), '_dsj_duree', true );
						$prix  = get_post_meta( get_the_ID(), '_dsj_prix', true );
						?>

						<article class="formation-card card-modern">
							<div class="card-image">
								<a href="<?php the_permalink(); ?>" aria-label="En savoir plus sur la formation <?php echo esc_attr( get_the_title() ); ?>">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'card-thumb', [
											'alt' => esc_attr( get_the_title() ),
											'loading' => 'lazy',
											'decoding' => 'async',
										] ); ?>
									<?php else : ?>
										<div class="card-icon-placeholder" aria-hidden="true">&#127891;</div>
									<?php endif; ?>
								</a>
								<div class="card-image-overlay" aria-hidden="true"></div>
							</div>

							<div class="card-content">
								<h3>
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h3>

								<div class="card-meta">
									<?php if ( $duree ) : ?>
										<span class="meta-item"><span aria-hidden="true">&#128197;</span> <?php echo esc_html( $duree ); ?></span>
									<?php endif; ?>

									<?php if ( $prix ) : ?>
										<span class="meta-item"><span aria-hidden="true">&#128176;</span> <?php echo esc_html( $prix ); ?></span>
									<?php endif; ?>
								</div>

								<div class="card-description">
									<?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 14, '...' ) ); ?>
								</div>

								<div class="card-footer">
									<a href="<?php the_permalink(); ?>" class="btn-link" aria-label="En savoir plus sur <?php echo esc_attr( get_the_title() ); ?>">
										En savoir plus <span class="arrow" aria-hidden="true">&#8594;</span>
									</a>
								</div>
							</div>
						</article>

					<?php
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<div class="no-content">
						<p>Aucune formation disponible pour le moment.</p>
					</div>
				<?php endif; ?>
			</div>

			<div class="text-center mt-4">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'formation' ) ); ?>" class="btn btn-primary btn-animated">
					Voir toutes les formations
				</a>
			</div>
		</div>
	</section>

	<!-- ===== MAISON D'ACCUEIL (3 dernières chambres en images) ===== -->
	<section class="home-maison-presentation section-padding bg-vert-menthe reveal-section" aria-labelledby="maison-title">
		<div class="container">
			<div class="maison-layout">

				<div class="maison-content-left">
					<span class="section-badge section-badge-dark" aria-hidden="true">&#127968; Ouverte à tous</span>
					<h2 class="section-title" id="maison-title">La Maison d'Accueil</h2>
					<div class="section-divider left" aria-hidden="true"></div>

					<p class="maison-intro">
						La Maison d'Accueil a pour but l'autoprise en charge du Centre pour soutenir la formation.
					</p>

					<div class="services-grid-modern">
						<div class="service-modern-item">
							<span class="service-icon" aria-hidden="true">&#128524;</span>
							<span class="service-text">Retraites, récollections</span>
						</div>
						<div class="service-modern-item">
							<span class="service-icon" aria-hidden="true">&#127881;</span>
							<span class="service-text">Événements</span>
						</div>
						<div class="service-modern-item">
							<span class="service-icon" aria-hidden="true">&#128106;</span>
							<span class="service-text">Réunions de famille</span>
						</div>
						<div class="service-modern-item">
							<span class="service-icon" aria-hidden="true">&#128188;</span>
							<span class="service-text">Sessions de travail</span>
						</div>
						<div class="service-modern-item">
							<span class="service-icon" aria-hidden="true">&#128218;</span>
							<span class="service-text">Conférences</span>
						</div>
						<div class="service-modern-item">
							<span class="service-icon" aria-hidden="true">&#128214;</span>
							<span class="service-text">Journées d'étude</span>
						</div>
					</div>

					<a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>" class="btn btn-primary btn-animated">
						Découvrir la maison
					</a>
				</div>

				<div class="maison-visual-right">
					<?php if ( ! empty( $chambres_recentes ) ) : ?>
						<div class="maison-image-stack">
							<?php foreach ( $chambres_recentes as $index => $image ) : ?>
								<a href="<?php echo esc_url( $image['link'] ); ?>" class="maison-img maison-img-<?php echo esc_attr( $index + 1 ); ?>" aria-label="Voir l'hébergement <?php echo esc_attr( $image['title'] ); ?>">
									<img
										src="<?php echo esc_url( $image['url'] ); ?>"
										alt=""
										loading="lazy"
										decoding="async"
									>
								</a>
							<?php endforeach; ?>
						</div>
					<?php else : ?>
						<div class="section-image-placeholder">
							<span aria-hidden="true">&#127968;</span>
							<p>Maison d'accueil</p>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</section>

	<!-- ===== NOS HÉBERGEMENTS (3 dernières chambres publiées) ===== -->
	<section class="home-hebergements section-padding bg-gris reveal-section" aria-labelledby="hebergements-title">
		<div class="container">
			<div class="section-header">
				<span class="section-badge section-badge-dark" aria-hidden="true">&#127968; Lieu d'accueil</span>
				<h2 class="section-title" id="hebergements-title">Nos Hébergements</h2>
				<div class="section-divider" aria-hidden="true"></div>
				<p class="section-subtitle">Un cadre paisible pour votre séjour.</p>
			</div>

			<div class="hebergements-grid">
				<?php
				$hebergements = new WP_Query( [
					'post_type'      => 'hebergement',
					'posts_per_page' => 3,
					'orderby'        => 'date',
					'order'          => 'DESC',
				] );

				if ( $hebergements->have_posts() ) :
					while ( $hebergements->have_posts() ) :
						$hebergements->the_post();

						$capacite  = get_post_meta( get_the_ID(), '_dsj_capacite', true );
						$prix_nuit = get_post_meta( get_the_ID(), '_dsj_prix_nuit', true );
						?>

						<article class="hebergement-card card-modern">
							<div class="card-image">
								<a href="<?php the_permalink(); ?>" aria-label="En savoir plus sur l'hébergement <?php echo esc_attr( get_the_title() ); ?>">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'card-thumb', [
											'alt' => '',
											'loading' => 'lazy',
											'decoding' => 'async',
										] ); ?>
									<?php else : ?>
										<div class="card-icon-placeholder" aria-hidden="true">&#127968;</div>
									<?php endif; ?>
								</a>
								<div class="card-image-overlay" aria-hidden="true"></div>
							</div>

							<div class="card-content">
								<h3>
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h3>

								<div class="card-meta">
									<?php if ( $capacite ) : ?>
										<span class="meta-item"><span aria-hidden="true">&#128101;</span> <?php echo esc_html( $capacite ); ?> pers.</span>
									<?php endif; ?>

									<?php if ( $prix_nuit ) : ?>
										<span class="meta-item"><span aria-hidden="true">&#128176;</span> <?php echo esc_html( $prix_nuit ); ?>/nuit</span>
									<?php endif; ?>
								</div>

								<div class="card-description">
									<?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 14, '...' ) ); ?>
								</div>

								<a href="<?php the_permalink(); ?>" class="btn-link" aria-label="Voir les détails de <?php echo esc_attr( get_the_title() ); ?>">
									Voir les détails <span class="arrow" aria-hidden="true">&#8594;</span>
								</a>
							</div>
						</article>

					<?php
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<div class="no-content">
						<p>Aucun hébergement disponible pour le moment.</p>
					</div>
				<?php endif; ?>
			</div>

			<div class="text-center mt-4">
				<a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>" class="btn btn-primary btn-animated">
					Voir tous les hébergements
				</a>
			</div>
		</div>
	</section>

	<!-- ===== COMMENT NOUS AIDER ===== -->
	<?php if ( get_theme_mod( 'aide_accueil_active', true ) ) : ?>
		<section class="aide-urgence section-padding bg-creme reveal-section" aria-labelledby="aide-title">
			<div class="container">
				<div class="section-header">
					<span class="section-badge section-badge-dark" aria-hidden="true">&#128157; Soutenez notre mission</span>
					<h2 class="section-title" id="aide-title">Comment nous aider ?</h2>
					<div class="section-divider" aria-hidden="true"></div>
					<p class="section-subtitle">Votre générosité change des vies et soutient la formation des jeunes filles.</p>
				</div>

				<div class="aide-urgence-grid">

					<article class="aide-card aide-card-modern">
						<div class="aide-card-gradient" aria-hidden="true"></div>
						<div class="aide-card-content">
							<div class="aide-card-icon" aria-hidden="true">
								<?php echo function_exists( 'dsj_icon' ) ? dsj_icon( get_theme_mod( 'aide_parrainage_icone', '&#128103;' ) ) : wp_kses_post( get_theme_mod( 'aide_parrainage_icone', '&#128103;' ) ); ?>
							</div>
							<h3><?php echo esc_html( get_theme_mod( 'aide_parrainage_titre', 'Parrainez une jeune fille' ) ); ?></h3>
							<p>
								<?php echo wp_kses_post( get_theme_mod( 'aide_parrainage_texte', 'Pour seulement <strong>50 000 F CFA par mois</strong>, vous offrez une formation technique complète à une jeune fille.' ) ); ?>
							</p>

							<ul class="aide-list">
								<?php
								for ( $i = 1; $i <= 3; $i++ ) :
									$avantage = get_theme_mod( "aide_parrainage_avantage_{$i}", '' );

									if ( ! empty( $avantage ) ) :
										?>
										<li><?php echo esc_html( $avantage ); ?></li>
									<?php
									endif;
								endfor;
								?>
							</ul>

							<a href="<?php echo esc_url( home_url( '/nous-soutenir' ) ); ?>" class="btn btn-primary btn-animated">
								<?php echo esc_html( get_theme_mod( 'aide_parrainage_bouton', 'Je parraine' ) ); ?> <span aria-hidden="true">&#8594;</span>
							</a>
						</div>
					</article>

					<article class="aide-card aide-card-modern">
						<div class="aide-card-gradient" aria-hidden="true"></div>
						<div class="aide-card-content">
							<div class="aide-card-icon" aria-hidden="true">
								<?php echo function_exists( 'dsj_icon' ) ? dsj_icon( get_theme_mod( 'aide_construction_icone', '&#128736;' ) ) : wp_kses_post( get_theme_mod( 'aide_construction_icone', '&#128736;' ) ); ?>
							</div>
							<h3><?php echo esc_html( get_theme_mod( 'aide_construction_titre', 'Construisons ensemble' ) ); ?></h3>
							<p>
								<?php echo wp_kses_post( get_theme_mod( 'aide_construction_texte', 'Nous avons besoin de <strong>nouvelles salles de formation</strong> pour accueillir plus de jeunes filles.' ) ); ?>
							</p>

							<ul class="aide-list">
								<?php
								for ( $i = 1; $i <= 3; $i++ ) :
									$besoin = get_theme_mod( "aide_construction_besoin_{$i}", '' );

									if ( ! empty( $besoin ) ) :
										?>
										<li><?php echo esc_html( $besoin ); ?></li>
									<?php
									endif;
								endfor;
								?>
							</ul>

							<a href="<?php echo esc_url( home_url( '/nous-soutenir' ) ); ?>" class="btn btn-primary btn-animated">
								<?php echo esc_html( get_theme_mod( 'aide_construction_bouton', 'Je contribue' ) ); ?> <span aria-hidden="true">&#8594;</span>
							</a>
						</div>
					</article>

					<article class="aide-card aide-card-modern">
						<div class="aide-card-gradient" aria-hidden="true"></div>
						<div class="aide-card-content">
							<div class="aide-card-icon" aria-hidden="true">
								<?php echo function_exists( 'dsj_icon' ) ? dsj_icon( '&#128155;' ) : '&#128155;'; ?>
							</div>
							<h3>Faire un don</h3>
							<p>
								Votre don, petit ou grand, soutient la formation des jeunes filles et l'entretien du centre.
							</p>

							<ul class="aide-list">
								<li>Don ponctuel ou mensuel</li>
								<li>Reçu fiscal sur demande</li>
								<li>100% dédié à la mission</li>
							</ul>

							<a href="<?php echo esc_url( home_url( '/nous-soutenir' ) ); ?>" class="btn btn-primary btn-animated">
								<span aria-hidden="true">&#128155;</span> Je donne <span aria-hidden="true">&#8594;</span>
							</a>
						</div>
					</article>

				</div>

				<div class="aide-texte-supplementaire text-center mt-4">
					<p><span aria-hidden="true">&#128222;</span> Un doute ? Contactez-nous par WhatsApp pour toute question sur les dons ou parrainages.</p>
					<a
						href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', get_theme_mod( 'whatsapp', '22666605890' ) ) ); ?>"
						class="btn btn-whatsapp btn-animated"
						target="_blank"
						rel="noopener noreferrer"
						aria-label="Nous contacter sur WhatsApp"
					>
						<span aria-hidden="true">&#128172;</span> Nous contacter
					</a>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- ===== RESTAURANT (4 derniers menus publiés) ===== -->
	<section class="home-restaurant section-padding bg-blanc reveal-section" aria-labelledby="restaurant-title">
		<div class="container">
			<div class="section-header">
				<span class="section-badge section-badge-dark" aria-hidden="true">&#127869; Table d'hôte</span>
				<h2 class="section-title" id="restaurant-title">Notre Restaurant</h2>
				<div class="section-divider" aria-hidden="true"></div>
				<p class="section-subtitle">Cuisine locale et internationale, préparée avec amour.</p>
			</div>

			<div class="restaurant-preview-modern">

				<div class="restaurant-info-card">
					<h3><span aria-hidden="true">&#128339;</span> Horaires</h3>

					<?php
					$petitdej = get_theme_mod( 'restaurant_petitdej', '7h00 - 9h30' );
					$dejeuner = get_theme_mod( 'restaurant_dejeuner', '12h00 - 14h30' );
					$diner    = get_theme_mod( 'restaurant_diner', '19h00 - 21h30' );
					?>

					<div class="horaire-item">
						<span class="horaire-icon" aria-hidden="true">&#9728;&#65039;</span>
						<div>
							<strong>Petit-déjeuner</strong>
							<span><?php echo esc_html( $petitdej ); ?></span>
						</div>
					</div>

					<div class="horaire-item">
						<span class="horaire-icon" aria-hidden="true">&#127860;</span>
						<div>
							<strong>Déjeuner</strong>
							<span><?php echo esc_html( $dejeuner ); ?></span>
						</div>
					</div>

					<div class="horaire-item">
						<span class="horaire-icon" aria-hidden="true">&#127769;</span>
						<div>
							<strong>Dîner</strong>
							<span><?php echo esc_html( $diner ); ?></span>
						</div>
					</div>

					<div class="restaurant-cta-home mt-3">
						<a href="<?php echo esc_url( home_url( '/restaurant' ) ); ?>" class="btn btn-primary btn-animated">
							<span aria-hidden="true">&#127869;</span> Découvrir la carte
						</a>
						<a href="<?php echo esc_url( home_url( '/restaurant#reservation-restaurant' ) ); ?>" class="btn btn-secondary btn-animated">
							<span aria-hidden="true">&#128197;</span> Réserver une table
						</a>
					</div>
				</div>

				<div class="restaurant-gallery">
					<?php if ( ! empty( $menus_recents ) ) : ?>
						<?php foreach ( $menus_recents as $image ) : ?>
							<a href="<?php echo esc_url( $image['link'] ); ?>" class="plat-thumb" aria-label="Voir le plat <?php echo esc_attr( $image['title'] ); ?>">
								<img
									src="<?php echo esc_url( $image['url'] ); ?>"
									alt=""
									loading="lazy"
									decoding="async"
								>
								<span class="plat-overlay">
									<span><?php echo esc_html( $image['title'] ); ?></span>
								</span>
							</a>
						<?php endforeach; ?>
					<?php else : ?>
						<div class="section-image-placeholder">
							<span aria-hidden="true">&#127869;</span>
							<p>Restaurant</p>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</section>

	<!-- ===== NOS VALEURS (avec icônes personnalisées via Customizer) ===== -->
	<section class="valeurs-section section-padding bg-creme reveal-section" aria-labelledby="valeurs-title">
		<div class="container">
			<div class="section-header">
				<span class="section-badge section-badge-dark" aria-hidden="true">&#11088; Nos fondamentaux</span>
				<h2 class="section-title" id="valeurs-title">Nos Valeurs</h2>
				<div class="section-divider" aria-hidden="true"></div>
				<p class="section-subtitle">Ce qui nous guide au quotidien.</p>
			</div>

			<div class="valeurs-grid-modern">
				<?php
				/**
				 * Tableau des valeurs :
				 * [0] = clé du Customizer (valeur_{clé}_icone)
				 * [1] = emoji par défaut (fallback)
				 * [2] = titre
				 * [3] = description
				 */
				$valeurs = [
					[ 'respect',    '&#129309;',        'Respect',    'De chaque personne humaine dans sa dignité.' ],
					[ 'honnetete',  '&#128142;',        'Honnêteté',  'Dans toutes nos relations et engagements.' ],
					[ 'compassion', '&#10084;&#65039;', 'Compassion', 'Envers les plus vulnérables.' ],
					[ 'partage',    '&#127807;',        'Partage',    'Des savoirs, ressources et expériences.' ],
					[ 'rigueur',    '&#128220;',        'Rigueur',    'Dans le travail sérieux et bien accompli.' ],
					[ 'excellence', '&#11088;',         'Excellence', 'Toujours viser le meilleur de soi-même.' ],
				];

				foreach ( $valeurs as $v ) :
					// Icône personnalisée depuis le Customizer, sinon emoji par défaut
					$icone_custom = get_theme_mod( 'valeur_' . $v[0] . '_icone', '' );
					$icone_html   = '';

					if ( function_exists( 'dsj_icon' ) ) {
						$icone_html = $icone_custom
							? dsj_icon( $icone_custom, 'valeur-icon' )
							: dsj_icon( $v[1], 'valeur-icon' );
					} else {
						// Fallback si la fonction n'existe pas encore
						$icone_html = '<span class="valeur-icon">' . ( $icone_custom ? esc_url( $icone_custom ) : $v[1] ) . '</span>';
					}
					?>
					<article class="valeur-card-modern">
						<div class="valeur-icon-wrapper" aria-hidden="true">
							<?php echo $icone_html; ?>
						</div>
						<h3><?php echo esc_html( $v[2] ); ?></h3>
						<p><?php echo esc_html( $v[3] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ===== GALERIE (4 dernières photos publiées) ===== -->
	<?php if ( ! empty( $photos_recentes ) ) : ?>
		<section class="home-galerie section-padding bg-gris reveal-section" aria-labelledby="galerie-title">
			<div class="container">
				<div class="section-header">
					<span class="section-badge section-badge-dark" aria-hidden="true">&#128248; En images</span>
					<h2 class="section-title" id="galerie-title">Galerie</h2>
					<div class="section-divider" aria-hidden="true"></div>
					<p class="section-subtitle">Découvrez notre cadre de vie.</p>
				</div>

				<div class="galerie-grid-masonry galerie-grid-<?php echo esc_attr( count( $photos_recentes ) ); ?>">
					<?php foreach ( $photos_recentes as $image ) : ?>
						<article class="galerie-item-masonry">
							<a href="<?php echo esc_url( $image['link'] ); ?>" class="galerie-link" aria-label="Voir la photo <?php echo esc_attr( $image['title'] ); ?>">
								<img
									src="<?php echo esc_url( $image['url'] ); ?>"
									alt=""
									loading="lazy"
									decoding="async"
								>
								<span class="galerie-overlay">
									<span class="galerie-icon" aria-hidden="true">&#128269;</span>
									<span class="galerie-title"><?php echo esc_html( $image['title'] ); ?></span>
								</span>
							</a>
						</article>
					<?php endforeach; ?>
				</div>

				<div class="text-center mt-4">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'galerie' ) ); ?>" class="btn btn-secondary btn-animated">
						Voir toute la galerie
					</a>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- ===== TÉMOIGNAGES (3 derniers publiés) ===== -->
	<?php
	$temoignages = new WP_Query( [
		'post_type'      => 'temoignage',
		'posts_per_page' => 3,
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );

	if ( $temoignages->have_posts() ) :
		?>
		<section class="temoignages-section section-padding bg-blanc reveal-section" aria-labelledby="temoignages-title">
			<div class="container">
				<div class="section-header">
					<span class="section-badge section-badge-dark" aria-hidden="true">&#128172; Ils parlent de nous</span>
					<h2 class="section-title" id="temoignages-title">Témoignages</h2>
					<div class="section-divider" aria-hidden="true"></div>
				</div>

				<div class="temoignages-grid-modern">
					<?php
					while ( $temoignages->have_posts() ) :
						$temoignages->the_post();
						?>
						<article class="temoignage-card-modern">
							<div class="temoignage-quote" aria-hidden="true">&#8220;</div>
							<div class="temoignage-content">
								<?php echo esc_html( wp_trim_words( get_the_content(), 30, '...' ) ); ?>
							</div>
							<div class="temoignage-author">
								<strong><?php the_title(); ?></strong>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
		<?php
		wp_reset_postdata();
	endif;
	?>

	<!-- ===== CTA FINAL ===== -->
	<section class="cta-home-section section-padding bg-gradient-primary reveal-section" aria-labelledby="cta-title">
		<div class="container">
			<div class="cta-content">
				<h2 id="cta-title">
					<?php echo esc_html( get_theme_mod( 'cta_title', 'Soutenez notre mission' ) ); ?>
				</h2>

				<p>
					<?php echo wp_kses_post( get_theme_mod( 'cta_text', 'Votre contribution permet de former les leaders de demain. Parrainez une jeune fille ou faites un don pour soutenir le Domaine Saint Joseph.' ) ); ?>
				</p>

				<div class="cta-buttons">
					<a href="<?php echo esc_url( home_url( get_theme_mod( 'cta_button_url', '/nous-soutenir' ) ) ); ?>" class="btn btn-primary btn-large btn-animated">
						<span aria-hidden="true">&#128155;</span> Nous soutenir
					</a>

					<a
						href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', get_theme_mod( 'whatsapp', '22666605890' ) ) ); ?>"
						class="btn btn-whatsapp btn-large btn-animated"
						target="_blank"
						rel="noopener noreferrer"
						aria-label="Nous contacter sur WhatsApp"
					>
						<span aria-hidden="true">&#128241;</span> WhatsApp
					</a>
				</div>
			</div>
		</div>
	</section>

</div>

<?php get_footer(); ?>