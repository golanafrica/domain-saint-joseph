<?php
/**
 * Page d'accueil — Version moderne humanitaire (7 sections)
 * ✅ 1 CTA prioritaire (parrainage) + icônes SVG + palette réduite
 * Contenu 100% dynamique (Customizer + CPT)
 * ✅ Phase A11Y : aria-label sur tous les liens + alt corrigés
 */

get_header();

/* ────────────────────────────────────────────────────────────
   HELPERS
   ──────────────────────────────────────────────────────────── */

/** Sépare un nombre de son suffixe (ex : "100%" → 100 + "%"). */
$dsj_split_stat = function ( $value ) {
	$number = preg_replace( '/[^0-9]/', '', $value );
	$suffix = str_replace( $number, '', $value );
	return [ 'number' => $number ?: '0', 'suffix' => $suffix, 'label' => $value ];
};

/** Dernières images publiées d'un CPT. */
$dsj_recent_images = function ( $post_type, $limit = 4, $size = 'medium_large' ) {
	$images = [];
	$posts  = get_posts( [
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

/* ────────────────────────────────────────────────────────────
   ICÔNES SVG (cohérentes sur tous les appareils)
   ──────────────────────────────────────────────────────────── */
$svg_wrap = '<svg class="dsj-icon" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
$svg = [
	'coeur'     => $svg_wrap . '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>',
	'diplome'   => $svg_wrap . '<path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12.5V17c0 1.7 2.7 3 6 3s6-1.3 6-3v-4.5"/></svg>',
	'maison'    => $svg_wrap . '<path d="M3 10.5L12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M10 21v-6h4v6"/></svg>',
	'repas'     => $svg_wrap . '<path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>',
	'camera'    => $svg_wrap . '<path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>',
	'horloge'   => $svg_wrap . '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>',
	'pin'       => $svg_wrap . '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>',
	'personnes' => $svg_wrap . '<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
	'check'     => $svg_wrap . '<path d="M20 6L9 17l-5-5"/></svg>',
	'main'      => $svg_wrap . '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21.2l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>',
	'livre'     => $svg_wrap . '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
	'etoile'    => $svg_wrap . '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
	'soleil'    => $svg_wrap . '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>',
	'lune'      => $svg_wrap . '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>',
];

/* ────────────────────────────────────────────────────────────
   DONNÉES DYNAMIQUES
   ──────────────────────────────────────────────────────────── */
$stat1 = $dsj_split_stat( get_theme_mod( 'stat1_nb', '2022' ) );
$stat2 = $dsj_split_stat( get_theme_mod( 'stat2_nb', '3+' ) );
$stat3 = $dsj_split_stat( get_theme_mod( 'stat3_nb', '100%' ) );

$menus_recents   = $dsj_recent_images( 'menu', 4 );
$photos_recentes = $dsj_recent_images( 'galerie', 4 );

$url_soutenir = esc_url( home_url( '/nous-soutenir' ) );
$url_whatsapp = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', get_theme_mod( 'whatsapp', '22666605890' ) );

$histoire_texte = get_theme_mod(
	'histoire_texte',
	'Le Domaine Saint Joseph a été créé en <strong>2022</strong>. Ce centre est une expression du charisme des <strong>Travailleuses Missionnaires de l\'Immaculée</strong>.'
);
?>

<div class="site-main">

	<!-- ===== 1. HERO ===== -->
	<?php if ( get_theme_mod( 'hero_slider_active', false ) ) : ?>
		<?php get_template_part( 'template-parts/hero', 'slider' ); ?>
	<?php else : ?>
		<?php get_template_part( 'template-parts/hero', 'default' ); ?>
	<?php endif; ?>

	<!-- ===== 2. HISTOIRE + STATS + VALEURS (fusionnées) ===== -->
	<section class="home-histoire section-padding" aria-labelledby="histoire-title">
		<div class="container">
			<div class="histoire-stats-layout">

				<div class="histoire-text reveal-section">
					<span class="section-badge-light"><?php echo $svg['main']; ?> Notre histoire</span>
					<h2 class="section-title" id="histoire-title">Le Domaine Saint Joseph</h2>
					<div class="section-divider left" aria-hidden="true"></div>
					<div class="histoire-content"><?php echo wp_kses_post( $histoire_texte ); ?></div>

					<ul class="valeurs-strip" aria-label="Nos valeurs fondamentales">
						<li><?php echo $svg['check']; ?> <span>Respect</span></li>
						<li><?php echo $svg['check']; ?> <span>Compassion</span></li>
						<li><?php echo $svg['check']; ?> <span>Excellence</span></li>
					</ul>

					<a href="<?php echo esc_url( home_url( '/a-propos' ) ); ?>" class="btn-link">
						En savoir plus sur nous <span class="arrow" aria-hidden="true">→</span>
					</a>
				</div>

				<div class="histoire-stats reveal-section">
					<div class="stat-block">
						<span class="stat-icon"><?php echo $svg['diplome']; ?></span>
						<span class="stat-number" data-count="<?php echo esc_attr( $stat1['number'] ); ?>" data-suffix="<?php echo esc_attr( $stat1['suffix'] ); ?>"><?php echo esc_html( $stat1['label'] ); ?></span>
						<span class="stat-label"><?php echo esc_html( get_theme_mod( 'stat1_lbl', 'Fondé en' ) ); ?></span>
					</div>
					<div class="stat-block">
						<span class="stat-icon"><?php echo $svg['livre']; ?></span>
						<span class="stat-number" data-count="<?php echo esc_attr( $stat2['number'] ); ?>" data-suffix="<?php echo esc_attr( $stat2['suffix'] ); ?>"><?php echo esc_html( $stat2['label'] ); ?></span>
						<span class="stat-label"><?php echo esc_html( get_theme_mod( 'stat2_lbl', 'Filières' ) ); ?></span>
					</div>
					<div class="stat-block">
						<span class="stat-icon"><?php echo $svg['personnes']; ?></span>
						<span class="stat-number" data-count="<?php echo esc_attr( $stat3['number'] ); ?>" data-suffix="<?php echo esc_attr( $stat3['suffix'] ); ?>"><?php echo esc_html( $stat3['label'] ); ?></span>
						<span class="stat-label"><?php echo esc_html( get_theme_mod( 'stat3_lbl', 'Dédié aux femmes' ) ); ?></span>
					</div>
					<div class="stat-block">
						<span class="stat-icon"><?php echo $svg['pin']; ?></span>
						<span class="stat-number">S25</span>
						<span class="stat-label">Bobo-Dioulasso</span>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- ===== 3. NOS FORMATIONS ===== -->
	<section class="home-formations section-padding section-alt" aria-labelledby="formations-title">
		<div class="container">
			<div class="section-header">
				<span class="section-badge-light"><?php echo $svg['diplome']; ?> Excellence académique</span>
				<h2 class="section-title" id="formations-title">Nos Formations</h2>
				<div class="section-divider" aria-hidden="true"></div>
				<p class="section-subtitle">Des filières concrètes pour l'autonomie des jeunes filles.</p>
			</div>

			<div class="formations-grid">
				<?php
				$formations = new WP_Query( [ 'post_type' => 'formation', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC' ] );
				if ( $formations->have_posts() ) :
					while ( $formations->have_posts() ) : $formations->the_post();
						$duree = get_post_meta( get_the_ID(), '_dsj_duree', true );
						$prix  = get_post_meta( get_the_ID(), '_dsj_prix', true );
						?>
						<article class="formation-card card-modern">
							<div class="card-image">
								<a href="<?php the_permalink(); ?>" aria-label="En savoir plus sur la formation <?php echo esc_attr( get_the_title() ); ?>">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'card-thumb', [ 'alt' => '', 'loading' => 'lazy', 'decoding' => 'async' ] ); ?>
									<?php else : ?>
										<div class="card-icon-placeholder"><?php echo $svg['diplome']; ?></div>
									<?php endif; ?>
								</a>
							</div>
							<div class="card-content">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="card-meta">
									<?php if ( $duree ) : ?><span class="meta-item"><?php echo $svg['horloge']; ?> <?php echo esc_html( $duree ); ?></span><?php endif; ?>
									<?php if ( $prix ) : ?><span class="meta-item"><?php echo esc_html( $prix ); ?></span><?php endif; ?>
								</div>
								<div class="card-description"><?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 14, '...' ) ); ?></div>
								<a href="<?php the_permalink(); ?>" class="btn-link" aria-label="En savoir plus sur <?php echo esc_attr( get_the_title() ); ?>">
									En savoir plus <span class="arrow" aria-hidden="true">→</span>
								</a>
							</div>
						</article>
					<?php endwhile; wp_reset_postdata();
				else : ?>
					<p class="no-content">Aucune formation disponible pour le moment.</p>
				<?php endif; ?>
			</div>

			<div class="text-center mt-4">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'formation' ) ); ?>" class="btn btn-secondary">Voir toutes les formations</a>
			</div>
		</div>
	</section>

	<!-- ===== 4. MAISON D'ACCUEIL + HÉBERGEMENTS (fusionnées) ===== -->
	<section class="home-maison section-padding" aria-labelledby="maison-title">
		<div class="container">
			<div class="maison-layout">

				<div class="maison-intro reveal-section">
					<span class="section-badge-light"><?php echo $svg['maison']; ?> Ouverte à tous</span>
					<h2 class="section-title" id="maison-title">La Maison d'Accueil</h2>
					<div class="section-divider left" aria-hidden="true"></div>
					<p class="maison-intro-texte">
						Un lieu de repos et de ressourcement dont les recettes soutiennent directement la formation des jeunes filles.
					</p>

					<ul class="services-compact">
						<li><?php echo $svg['check']; ?> <span>Retraites &amp; récollections</span></li>
						<li><?php echo $svg['check']; ?> <span>Événements &amp; familles</span></li>
						<li><?php echo $svg['check']; ?> <span>Sessions de travail</span></li>
						<li><?php echo $svg['check']; ?> <span>Conférences &amp; études</span></li>
					</ul>

					<a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>" class="btn btn-primary">
						Découvrir &amp; réserver
					</a>
				</div>

				<div class="maison-cards reveal-section">
					<?php
					$chambres = new WP_Query( [ 'post_type' => 'hebergement', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC' ] );
					if ( $chambres->have_posts() ) :
						while ( $chambres->have_posts() ) : $chambres->the_post();
							$capacite  = get_post_meta( get_the_ID(), '_dsj_capacite', true );
							$prix_nuit = get_post_meta( get_the_ID(), '_dsj_prix_nuit', true );
							?>
							<article class="room-card">
								<a href="<?php the_permalink(); ?>" class="room-card-link" aria-label="Voir l'hébergement <?php echo esc_attr( get_the_title() ); ?>">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'card-thumb', [ 'alt' => '', 'loading' => 'lazy', 'decoding' => 'async' ] ); ?>
									<?php endif; ?>
									<div class="room-card-body">
										<h3><?php the_title(); ?></h3>
										<p class="room-card-meta">
											<?php if ( $capacite ) : ?><?php echo $svg['personnes']; ?> <?php echo esc_html( $capacite ); ?> pers.<?php endif; ?>
											<?php if ( $prix_nuit ) : ?> <span class="meta-sep">·</span> <?php echo esc_html( $prix_nuit ); ?>/nuit<?php endif; ?>
										</p>
									</div>
								</a>
							</article>
						<?php endwhile; wp_reset_postdata();
					endif; ?>
				</div>

			</div>
		</div>
	</section>

	<!-- ===== 5. RESTAURANT (compact) ===== -->
	<section class="home-restaurant section-padding section-alt" aria-labelledby="restaurant-title">
		<div class="container">
			<div class="resto-layout">

				<div class="resto-info reveal-section">
					<span class="section-badge-light"><?php echo $svg['repas']; ?> Table d'hôte</span>
					<h2 class="section-title" id="restaurant-title">Notre Restaurant</h2>
					<div class="section-divider left" aria-hidden="true"></div>
					<p>Cuisine locale et internationale, préparée avec amour.</p>

					<div class="resto-horaires">
						<div class="horaire-ligne"><?php echo $svg['soleil']; ?> <strong>Petit-déjeuner</strong> <span><?php echo esc_html( get_theme_mod( 'restaurant_petitdej', '7h00 - 9h30' ) ); ?></span></div>
						<div class="horaire-ligne"><?php echo $svg['horloge']; ?> <strong>Déjeuner</strong> <span><?php echo esc_html( get_theme_mod( 'restaurant_dejeuner', '12h00 - 14h30' ) ); ?></span></div>
						<div class="horaire-ligne"><?php echo $svg['lune']; ?> <strong>Dîner</strong> <span><?php echo esc_html( get_theme_mod( 'restaurant_diner', '19h00 - 21h30' ) ); ?></span></div>
					</div>

					<div class="resto-cta">
						<a href="<?php echo esc_url( home_url( '/restaurant' ) ); ?>" class="btn btn-primary">Découvrir la carte</a>
						<a href="<?php echo esc_url( home_url( '/restaurant#reservation-restaurant' ) ); ?>" class="btn-link">Réserver une table <span class="arrow" aria-hidden="true">→</span></a>
					</div>
				</div>

				<div class="resto-gallery reveal-section">
					<?php if ( ! empty( $menus_recents ) ) : ?>
						<?php foreach ( $menus_recents as $plat ) : ?>
							<a href="<?php echo esc_url( $plat['link'] ); ?>" class="plat-thumb" aria-label="Voir le plat <?php echo esc_attr( $plat['title'] ); ?>">
								<img src="<?php echo esc_url( $plat['url'] ); ?>" alt="" loading="lazy" decoding="async">
								<span class="plat-overlay"><span><?php echo esc_html( $plat['title'] ); ?></span></span>
							</a>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</section>

	<!-- ===== 6. GALERIE + TÉMOIGNAGES (fusionnées) ===== -->
	<section class="home-galerie section-padding" aria-labelledby="galerie-title">
		<div class="container">
			<div class="section-header">
				<span class="section-badge-light"><?php echo $svg['camera']; ?> En images</span>
				<h2 class="section-title" id="galerie-title">Galerie &amp; témoignages</h2>
				<div class="section-divider" aria-hidden="true"></div>
			</div>

			<?php if ( ! empty( $photos_recentes ) ) : ?>
				<div class="galerie-grid-masonry galerie-grid-<?php echo esc_attr( count( $photos_recentes ) ); ?>">
					<?php foreach ( $photos_recentes as $photo ) : ?>
						<article class="galerie-item-masonry">
							<a href="<?php echo esc_url( $photo['link'] ); ?>" class="galerie-link" aria-label="Voir la photo <?php echo esc_attr( $photo['title'] ); ?>">
								<img src="<?php echo esc_url( $photo['url'] ); ?>" alt="" loading="lazy" decoding="async">
								<span class="galerie-overlay">
									<span class="galerie-title"><?php echo esc_html( $photo['title'] ); ?></span>
								</span>
							</a>
						</article>
					<?php endforeach; ?>
				</div>
				<div class="text-center mt-4">
					<a href="<?php echo esc_url( home_url( '/galerie' ) ); ?>" class="btn btn-secondary">Voir toute la galerie</a>
				</div>
			<?php endif; ?>

			<?php
			$temoignages = new WP_Query( [ 'post_type' => 'temoignage', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC' ] );
			if ( $temoignages->have_posts() ) : ?>
				<div class="temoignages-strip">
					<?php while ( $temoignages->have_posts() ) : $temoignages->the_post(); ?>
						<blockquote class="temoignage-mini">
							<p><?php echo esc_html( wp_trim_words( get_the_content(), 20, '...' ) ); ?></p>
							<footer>— <?php the_title(); ?></footer>
						</blockquote>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- ===== 7. CTA FINAL (action prioritaire UNIQUE) ===== -->
	<section class="cta-final-section section-padding" aria-labelledby="cta-title">
		<div class="container">
			<div class="cta-content reveal-section">
				<span class="cta-icon"><?php echo $svg['coeur']; ?></span>
				<h2 id="cta-title"><?php echo esc_html( get_theme_mod( 'cta_title', 'Soutenez notre mission' ) ); ?></h2>
				<p><?php echo wp_kses_post( get_theme_mod( 'cta_text', 'Votre contribution permet de former les leaders de demain. Parrainez une jeune fille ou faites un don pour soutenir le Domaine Saint Joseph.' ) ); ?></p>

				<div class="cta-actions">
					<a href="<?php echo esc_url( home_url( get_theme_mod( 'cta_button_url', '/nous-soutenir' ) ) ); ?>" class="btn btn-primary btn-large">
						<?php echo $svg['coeur']; ?> Je parraine une jeune fille
					</a>
					<a href="<?php echo $url_soutenir; ?>" class="btn btn-outline-light btn-large">Je fais un don libre</a>
				</div>

				<p class="cta-whatsapp">
					Une question ? <a href="<?php echo esc_url( $url_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">Écrivez-nous sur WhatsApp</a>
				</p>
			</div>
		</div>
	</section>

</div>

<?php get_footer(); ?>