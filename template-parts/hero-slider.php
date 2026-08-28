<?php
/**
 * Template Part : Hero Slider
 * Affiche le slider Customizer (5 images max)
 * ✅ Phase LCP : Image préchargée via <img> pour performance 3G
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Construire le tableau des slides
$slides = [];
for ( $i = 1; $i <= 5; $i++ ) {
    $image = get_theme_mod( "hero_slide_{$i}_image" );
    if ( $image ) {
        $slides[] = [
            'image'     => $image,
            'titre'     => get_theme_mod( "hero_slide_{$i}_titre", '' ),
            'soustitre' => get_theme_mod( "hero_slide_{$i}_soustitre", '' ),
        ];
    }
}

// Ne rien afficher si aucune slide
if ( empty( $slides ) ) {
    return;
}
?>

<div class="hero-slider" data-speed="<?php echo esc_attr( get_theme_mod( 'hero_slider_speed', '5000' ) ); ?>">

    <!-- ✅ NOUVEAU : Image LCP préchargée (visible immédiatement) -->
    <?php if ( ! empty( $slides[0] ) ) : ?>
        <img 
            src="<?php echo esc_url( $slides[0]['image'] ); ?>" 
            alt="<?php echo esc_attr( $slides[0]['titre'] ?: 'Domaine Saint Joseph' ); ?>"
            class="hero-lcp-image"
            fetchpriority="high"
            decoding="async"
            style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;z-index:0;opacity:1;"
        >
    <?php endif; ?>

    <!-- Photos en background (transition JS) -->
    <div class="hero-slides-container">
        <?php foreach ( $slides as $index => $slide ) : ?>
            <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>"
                 style="background-image: url('<?php echo esc_url( $slide['image'] ); ?>');
                        <?php echo $index !== 0 ? 'display:none;' : ''; ?>">
            </div>
        <?php endforeach; ?>

        <!-- Flèches navigation -->
        <button class="slider-btn slider-prev" aria-label="<?php esc_attr_e( 'Précédent', 'domaine-saint-joseph' ); ?>">&#8249;</button>
        <button class="slider-btn slider-next" aria-label="<?php esc_attr_e( 'Suivant', 'domaine-saint-joseph' ); ?>">&#8250;</button>

        <!-- Dots -->
        <div class="slider-dots">
            <?php foreach ( $slides as $index => $slide ) : ?>
                <span class="slider-dot <?php echo $index === 0 ? 'active' : ''; ?>"
                      data-index="<?php echo $index; ?>"
                      role="button"
                      tabindex="0"
                      aria-label="<?php echo esc_attr( sprintf( __( 'Aller au slide %d', 'domaine-saint-joseph' ), $index + 1 ) ); ?>"></span>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bande légende sous la photo -->
    <div class="hero-caption-band">
        <div class="hero-caption-text">
            <h1 class="hero-title" id="hero-caption-title">
                <?php echo wp_kses_post( $slides[0]['titre'] ); ?>
            </h1>
            <?php if ( ! empty( $slides[0]['soustitre'] ) ) : ?>
                <p class="hero-subtitle" id="hero-caption-subtitle">
                    <?php echo esc_html( $slides[0]['soustitre'] ); ?>
                </p>
            <?php endif; ?>
        </div>
        <div class="hero-buttons">
            <a href="<?php echo esc_url( home_url( '/formation' ) ); ?>" class="btn btn-primary">
                &#127891; <?php esc_html_e( 'Nos formations', 'domaine-saint-joseph' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/maison-daccueil' ) ); ?>" class="btn btn-secondary">
                &#127968; <?php esc_html_e( "Découvrir l'accueil", 'domaine-saint-joseph' ); ?>
            </a>
        </div>
    </div>

</div>

<!-- Données slides pour le JS (transition dynamique) -->
<script>
var heroSlideData = <?php echo wp_json_encode( array_map( function( $s ) {
    return [
        'titre'     => wp_strip_all_tags( $s['titre'] ),
        'soustitre' => $s['soustitre'],
    ];
}, $slides ) ); ?>;
</script>