<?php
/**
 * Template Name: Restaurant
 * ✅ Phase A11Y : aria-live sur alertes, emojis aria-hidden, sécurité $_POST
 */
get_header(); ?>

<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_restaurant_image' );
$hero_badge     = get_theme_mod( 'hero_restaurant_badge', '&#127869; Notre cuisine' );
$hero_titre     = get_theme_mod( 'hero_restaurant_titre', 'Restaurant' );
$hero_soustitre = get_theme_mod( 'hero_restaurant_soustitre', 'Découvrez nos plats préparés avec amour et passion' );
?>

<section class="page-header restaurant-header" aria-labelledby="restaurant-hero-title">
    <div class="page-photo-zone"
         <?php if ( $hero_image ) : ?>
         style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
         <?php endif; ?>
         role="img"
         aria-label="<?php echo esc_attr( $hero_titre ); ?>">
    </div>

    <div class="header-caption-band">
        <span class="header-badge" aria-hidden="true"><?php echo wp_kses_post( $hero_badge ); ?></span>
        <h1 class="header-title" id="restaurant-hero-title"><?php echo esc_html( $hero_titre ); ?></h1>
        <div class="header-divider" aria-hidden="true">
            <span class="divider-line"></span>
            <span class="divider-icon">&#127869;</span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
    </div>
</section>

<!-- SECTION CARTES DES MENUS -->
<section class="menu-section section-padding" aria-labelledby="menu-section-title">
    <div class="container">
        <div class="section-header">
            <span class="section-badge" aria-hidden="true">&#127860; Nos spécialités</span>
            <h2 class="section-title" id="menu-section-title">Notre Carte</h2>
            <div class="section-divider" aria-hidden="true"></div>
            <p class="section-subtitle">Des plats préparés avec des produits frais et de saison</p>
        </div>
        
        <?php
        $categories = get_terms( [
            'taxonomy' => 'categorie_menu',
            'hide_empty' => true,
        ] );
        
        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
            <div class="menu-categories" role="tablist" aria-label="Filtrer par catégorie">
                <?php foreach ( $categories as $category ) : ?>
                    <button class="menu-cat-btn" data-cat="<?php echo esc_attr( $category->slug ); ?>" role="tab">
                        <?php echo esc_html( $category->name ); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div class="menu-grid" role="list">
            <?php
            $menus = new WP_Query( [
                'post_type'      => 'menu',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC'
            ] );
            
            if ( $menus->have_posts() ) :
                while ( $menus->have_posts() ) : $menus->the_post();
                    $categories = get_the_terms( get_the_ID(), 'categorie_menu' );
                    $cat_slugs  = [];
                    if ( $categories && ! is_wp_error( $categories ) ) {
                        foreach ( $categories as $cat ) {
                            $cat_slugs[] = $cat->slug;
                        }
                    }
                    $cat_classes = implode( ' ', $cat_slugs );
                    
                    $prix        = get_post_meta( get_the_ID(), '_menu_prix', true );
                    $temps       = get_post_meta( get_the_ID(), '_menu_temps', true );
                    $ingredients = get_post_meta( get_the_ID(), '_menu_ingredients', true );
                    $allergenes  = get_post_meta( get_the_ID(), '_menu_allergenes', true );
                    ?>
                    <article class="menu-card" data-category="<?php echo esc_attr( $cat_classes ); ?>" role="listitem">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="menu-image">
                                <?php the_post_thumbnail( 'card-thumb', [
                                    'alt'      => esc_attr( get_the_title() ),
                                    'loading'  => 'lazy',
                                    'decoding' => 'async',
                                ] ); ?>
                                <?php if ( $prix ) : ?>
                                    <span class="menu-price"><?php echo esc_html( $prix ); ?> F</span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="menu-content">
                            <h3><?php the_title(); ?></h3>
                            
                            <?php if ( $ingredients ) : ?>
                                <p class="menu-ingredients"><?php echo esc_html( $ingredients ); ?></p>
                            <?php endif; ?>
                            
                            <div class="menu-meta">
                                <?php if ( $temps ) : ?>
                                    <span class="menu-time"><span aria-hidden="true">&#9200;</span> <?php echo esc_html( $temps ); ?></span>
                                <?php endif; ?>
                                <?php if ( $allergenes ) : ?>
                                    <span class="menu-allergenes"><span aria-hidden="true">&#9888;</span> <?php echo esc_html( $allergenes ); ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="menu-footer">
                                <a href="#reservation-restaurant" class="btn-reserver" aria-label="Réserver une table pour <?php echo esc_attr( get_the_title() ); ?>">
                                    <span aria-hidden="true">&#128197;</span> Réserver une table
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <div class="no-content">
                    <p>Aucun plat disponible pour le moment. Revenez bientôt !</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- SECTION HORAIRES -->
<section class="horaires-section section-padding bg-light" aria-labelledby="horaires-title">
    <div class="container">
        <div class="section-header">
            <span class="section-badge" aria-hidden="true">&#128339; Horaires d'ouverture</span>
            <h2 class="section-title" id="horaires-title">Horaires du Restaurant</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
        
        <div class="horaires-grid" role="list">
            <div class="horaire-card" role="listitem">
                <div class="horaire-icon" aria-hidden="true">&#127749;</div>
                <h3>Petit-déjeuner</h3>
                <p>Lundi - Vendredi: 7h00 - 9h30</p>
                <p>Samedi - Dimanche: 8h00 - 10h30</p>
            </div>
            <div class="horaire-card" role="listitem">
                <div class="horaire-icon" aria-hidden="true">&#127869;</div>
                <h3>Déjeuner</h3>
                <p>Tous les jours: 12h00 - 14h30</p>
            </div>
            <div class="horaire-card" role="listitem">
                <div class="horaire-icon" aria-hidden="true">&#127769;</div>
                <h3>Dîner</h3>
                <p>Tous les jours: 19h00 - 21h30</p>
                <p class="small">Sur réservation le dimanche soir</p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION RÉSERVATION RESTAURANT -->
<section id="reservation-restaurant" class="reservation-restaurant section-padding" aria-labelledby="reservation-restaurant-title">
    <div class="container">
        <div class="reservation-header">
            <span class="reservation-badge" aria-hidden="true">&#128197; Réservez votre table</span>
            <h2 class="reservation-title" id="reservation-restaurant-title">Réservation Restaurant</h2>
            <div class="reservation-divider" aria-hidden="true"></div>
            <p class="reservation-subtitle">Réservez votre table pour un déjeuner ou dîner inoubliable</p>
        </div>
        
        <?php if ( isset( $_GET['resa_success'] ) && $_GET['resa_success'] === '1' ) : ?>
            <div class="alert alert-success" role="alert" aria-live="polite">
                <span class="alert-icon" aria-hidden="true">&#9989;</span>
                <div class="alert-content">
                    <strong>Réservation envoyée !</strong> Nous vous confirmerons votre réservation par téléphone ou WhatsApp dans les plus brefs délais.
                </div>
            </div>
        <?php elseif ( isset( $_GET['resa_error'] ) ) : ?>
            <div class="alert alert-error" role="alert" aria-live="assertive">
                <span class="alert-icon" aria-hidden="true">&#10060;</span>
                <div class="alert-content">
                    <?php
                    $error = sanitize_text_field( wp_unslash( $_GET['resa_error'] ?? '' ) );
                    switch ( $error ) {
                        case 'missing':
                            echo '<strong>Champs manquants</strong><br>Veuillez remplir tous les champs obligatoires.';
                            break;
                        case 'too_long':
                            echo '<strong>Message trop long</strong><br>Votre message dépasse la limite de 5000 caractères. Veuillez le raccourcir.';
                            break;
                        case 'invalid_contact':
                            echo '<strong>Contact invalide</strong><br>Veuillez entrer un numéro de téléphone valide.';
                            break;
                        case 'rate_limit':
                            echo '<strong>Trop de réservations</strong><br>Vous avez envoyé trop de demandes récemment. Veuillez attendre quelques minutes avant de réessayer.';
                            break;
                        case 'session_expired':
                            echo '<strong>Session expirée</strong><br>Votre session a expiré pour des raisons de sécurité. Veuillez recharger la page et réessayer.';
                            break;
                        case 'service_unavailable':
                            echo '<strong>Service temporairement indisponible</strong><br>Notre service de réservation rencontre un problème technique. Merci de réessayer plus tard ou de nous contacter par téléphone.';
                            break;
                        case 'send':
                            echo '<strong>Erreur d\'envoi</strong><br>Une erreur est survenue lors de l\'envoi. Veuillez réessayer ou nous contacter directement par téléphone.';
                            break;
                        default:
                            echo '<strong>Erreur</strong><br>Veuillez réessayer ou nous contacter par téléphone.';
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>
        
        <form class="form-reservation-restaurant" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
            <input type="hidden" name="action" value="dsj_restaurant_reservation">
            <?php wp_nonce_field( 'dsj_restaurant_nonce', '_wpnonce' ); ?>
            
            <!-- Honeypot anti-spam (invisible pour les humains) -->
            <div class="dsj-honeypot" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;">
                <label for="dsj_hp_field_resa">Ne pas remplir ce champ</label>
                <input type="text" id="dsj_hp_field_resa" name="dsj_hp_field" tabindex="-1" autocomplete="off">
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="resa_nom">
                        <span aria-hidden="true">&#128100;</span> Nom complet <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="text" id="resa_nom" name="resa_nom" class="form-control" value="<?php echo isset( $_POST['resa_nom'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['resa_nom'] ) ) ) : ''; ?>" required aria-required="true">
                </div>
                
                <div class="form-group">
                    <label for="resa_contact">
                        <span aria-hidden="true">&#128222;</span> Téléphone <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="tel" id="resa_contact" name="resa_contact" class="form-control" value="<?php echo isset( $_POST['resa_contact'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['resa_contact'] ) ) ) : ''; ?>" required aria-required="true">
                </div>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="resa_date">
                        <span aria-hidden="true">&#128197;</span> Date <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="date" id="resa_date" name="resa_date" class="form-control" value="<?php echo isset( $_POST['resa_date'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['resa_date'] ) ) ) : ''; ?>" required aria-required="true">
                </div>
                
                <div class="form-group">
                    <label for="resa_heure">
                        <span aria-hidden="true">&#9200;</span> Heure <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <select id="resa_heure" name="resa_heure" class="form-control" required aria-required="true">
                        <option value="12h00" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '12h00' ); ?>>12h00</option>
                        <option value="12h30" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '12h30' ); ?>>12h30</option>
                        <option value="13h00" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '13h00' ); ?>>13h00</option>
                        <option value="13h30" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '13h30' ); ?>>13h30</option>
                        <option value="19h00" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '19h00' ); ?>>19h00</option>
                        <option value="19h30" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '19h30' ); ?>>19h30</option>
                        <option value="20h00" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '20h00' ); ?>>20h00</option>
                        <option value="20h30" <?php selected( isset( $_POST['resa_heure'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_heure'] ) ) : '', '20h30' ); ?>>20h30</option>
                    </select>
                </div>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="resa_personnes">
                        <span aria-hidden="true">&#128101;</span> Nombre de personnes <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <select id="resa_personnes" name="resa_personnes" class="form-control" required aria-required="true">
                        <option value="1" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '1' ); ?>>1 personne</option>
                        <option value="2" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '2' ); ?>>2 personnes</option>
                        <option value="3" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '3' ); ?>>3 personnes</option>
                        <option value="4" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '4' ); ?>>4 personnes</option>
                        <option value="5" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '5' ); ?>>5 personnes</option>
                        <option value="6" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '6' ); ?>>6 personnes</option>
                        <option value="7" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '7' ); ?>>7 personnes</option>
                        <option value="8+" <?php selected( isset( $_POST['resa_personnes'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_personnes'] ) ) : '', '8+' ); ?>>8+ personnes</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="resa_occasion">
                        <span aria-hidden="true">&#127881;</span> Occasion spéciale
                    </label>
                    <select id="resa_occasion" name="resa_occasion" class="form-control">
                        <option value="" <?php selected( isset( $_POST['resa_occasion'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_occasion'] ) ) : '', '' ); ?>>Aucune</option>
                        <option value="anniversaire" <?php selected( isset( $_POST['resa_occasion'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_occasion'] ) ) : '', 'anniversaire' ); ?>>Anniversaire</option>
                        <option value="mariage" <?php selected( isset( $_POST['resa_occasion'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_occasion'] ) ) : '', 'mariage' ); ?>>Mariage</option>
                        <option value="professionnel" <?php selected( isset( $_POST['resa_occasion'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_occasion'] ) ) : '', 'professionnel' ); ?>>Professionnel</option>
                        <option value="autre" <?php selected( isset( $_POST['resa_occasion'] ) ? sanitize_text_field( wp_unslash( $_POST['resa_occasion'] ) ) : '', 'autre' ); ?>>Autre</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group full-width">
                <label for="resa_message">
                    <span aria-hidden="true">&#128172;</span> Message / Demande particulière <small>(max 5000 caractères)</small>
                </label>
                <textarea id="resa_message" name="resa_message" class="form-control" rows="3" maxlength="5000" placeholder="Régime alimentaire, allergies, demande spéciale..." aria-describedby="resa-message-counter"><?php echo isset( $_POST['resa_message'] ) ? esc_textarea( wp_unslash( $_POST['resa_message'] ) ) : ''; ?></textarea>
                <small class="form-help" id="resa-message-counter" aria-live="polite">0 / 5000 caractères</small>
            </div>
            
            <div class="form-footer">
                <button type="submit" class="btn-submit">
                    <span class="btn-icon" aria-hidden="true">&#127869;</span>
                    Réserver ma table
                </button>
                <p class="form-note">
                    <span class="note-icon" aria-hidden="true">&#128274;</span>
                    Nous vous confirmerons votre réservation par téléphone ou WhatsApp
                </p>
            </div>
        </form>
    </div>
</section>

<!-- Compteur de caractères pour le message -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('resa_message');
    const counter = document.getElementById('resa-message-counter');
    
    if (textarea && counter) {
        function updateCounter() {
            const length = textarea.value.length;
            counter.textContent = length + ' / 5000 caractères';
            
            if (length > 4500) {
                counter.style.color = '#dc3545';
                counter.style.fontWeight = 'bold';
            } else if (length > 4000) {
                counter.style.color = '#ffc107';
                counter.style.fontWeight = 'normal';
            } else {
                counter.style.color = '#666';
                counter.style.fontWeight = 'normal';
            }
        }
        
        textarea.addEventListener('input', updateCounter);
        updateCounter();
    }
});
</script>

<?php get_footer(); ?>