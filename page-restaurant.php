<?php
/**
 * Template Name: Restaurant
 */
get_header(); ?>

<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_restaurant_image' );
$hero_badge     = get_theme_mod( 'hero_restaurant_badge', '&#127869; Notre cuisine' );
$hero_titre     = get_theme_mod( 'hero_restaurant_titre', 'Restaurant' );
$hero_soustitre = get_theme_mod( 'hero_restaurant_soustitre', 'Découvrez nos plats préparés avec amour et passion' );
?>

<section class="page-header restaurant-header">
    <div class="page-photo-zone"
         <?php if ( $hero_image ) : ?>
         style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
         <?php endif; ?>>
    </div>

    <div class="header-caption-band">
        <span class="header-badge"><?php echo esc_html( $hero_badge ); ?></span>
        <h1 class="header-title"><?php echo esc_html( $hero_titre ); ?></h1>
        <div class="header-divider">
            <span class="divider-line"></span>
            <span class="divider-icon">&#127869;</span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
    </div>
</section>

<!-- SECTION CARTES DES MENUS -->
<section class="menu-section section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">&#127860; Nos spécialités</span>
            <h2 class="section-title">Notre Carte</h2>
            <div class="section-divider"></div>
            <p class="section-subtitle">Des plats préparés avec des produits frais et de saison</p>
        </div>
        
        <?php
        $categories = get_terms( [
            'taxonomy' => 'categorie_menu',
            'hide_empty' => true,
        ] );
        
        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
            <div class="menu-categories">
                <?php foreach ( $categories as $category ) : ?>
                    <button class="menu-cat-btn" data-cat="<?php echo esc_attr( $category->slug ); ?>">
                        <?php echo esc_html( $category->name ); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div class="menu-grid">
            <?php
            $menus = new WP_Query( [
                'post_type' => 'menu',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ] );
            
            if ( $menus->have_posts() ) :
                while ( $menus->have_posts() ) : $menus->the_post();
                    $categories = get_the_terms( get_the_ID(), 'categorie_menu' );
                    $cat_slugs = array();
                    if ( $categories && ! is_wp_error( $categories ) ) {
                        foreach ( $categories as $cat ) {
                            $cat_slugs[] = $cat->slug;
                        }
                    }
                    $cat_classes = implode( ' ', $cat_slugs );
                    
                    $prix = get_post_meta( get_the_ID(), '_menu_prix', true );
                    $temps = get_post_meta( get_the_ID(), '_menu_temps', true );
                    $ingredients = get_post_meta( get_the_ID(), '_menu_ingredients', true );
                    $allergenes = get_post_meta( get_the_ID(), '_menu_allergenes', true );
                    ?>
                    <div class="menu-card" data-category="<?php echo esc_attr( $cat_classes ); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="menu-image">
                                <?php the_post_thumbnail( 'card-thumb' ); ?>
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
                                    <span class="menu-time">&#9200; <?php echo esc_html( $temps ); ?></span>
                                <?php endif; ?>
                                <?php if ( $allergenes ) : ?>
                                    <span class="menu-allergenes">&#9888; <?php echo esc_html( $allergenes ); ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="menu-footer">
                                <a href="#reservation-restaurant" class="btn-reserver">&#128197; Réserver une table</a>
                            </div>
                        </div>
                    </div>
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
<section class="horaires-section section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">&#128339; Horaires d'ouverture</span>
            <h2 class="section-title">Horaires du Restaurant</h2>
            <div class="section-divider"></div>
        </div>
        
        <div class="horaires-grid">
            <div class="horaire-card">
                <div class="horaire-icon">&#127749;</div>
                <h3>Petit-déjeuner</h3>
                <p>Lundi - Vendredi: 7h00 - 9h30</p>
                <p>Samedi - Dimanche: 8h00 - 10h30</p>
            </div>
            <div class="horaire-card">
                <div class="horaire-icon">&#127869;</div>
                <h3>Déjeuner</h3>
                <p>Tous les jours: 12h00 - 14h30</p>
            </div>
            <div class="horaire-card">
                <div class="horaire-icon">&#127769;</div>
                <h3>Dîner</h3>
                <p>Tous les jours: 19h00 - 21h30</p>
                <p class="small">Sur réservation le dimanche soir</p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION RÉSERVATION RESTAURANT -->
<section id="reservation-restaurant" class="reservation-restaurant section-padding">
    <div class="container">
        <div class="reservation-header">
            <span class="reservation-badge">&#128197; Réservez votre table</span>
            <h2 class="reservation-title">Réservation Restaurant</h2>
            <div class="reservation-divider"></div>
            <p class="reservation-subtitle">Réservez votre table pour un déjeuner ou dîner inoubliable</p>
        </div>
        
        <?php if ( isset( $_GET['resa_success'] ) && $_GET['resa_success'] === '1' ) : ?>
            <div class="alert alert-success">
                <span class="alert-icon">&#9989;</span>
                <div class="alert-content">
                    <strong>Réservation confirmée !</strong> Nous vous attendons. Un email de confirmation vous a été envoyé.
                </div>
            </div>
        <?php elseif ( isset( $_GET['resa_error'] ) ) : ?>
            <div class="alert alert-error">
                <span class="alert-icon">&#10060;</span>
                <div class="alert-content">
                    <?php
                    $error = $_GET['resa_error'] ?? '';
                    if ( $error === 'missing' ) echo '<strong>Champs manquants</strong><br>Veuillez remplir tous les champs obligatoires.';
                    elseif ( $error === 'send' ) echo '<strong>Erreur d\'envoi</strong><br>Veuillez réessayer ou nous contacter par téléphone.';
                    elseif ( $error === 'rate_limit' ) echo '<strong>Trop de messages</strong><br>Veuillez attendre quelques minutes avant de réessayer.';
                    elseif ( $error === 'invalid_contact' ) echo '<strong>Contact invalide</strong><br>Veuillez entrer un numéro de téléphone valide.';
                    else echo '<strong>Erreur</strong><br>Veuillez réessayer ou nous contacter par téléphone.';
                    ?>
                </div>
            </div>
        <?php endif; ?>
        
        <form class="form-reservation-restaurant" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
            <input type="hidden" name="action" value="dsj_restaurant_reservation">
            <?php wp_nonce_field( 'dsj_restaurant_nonce', '_wpnonce' ); ?>
            
            <!-- Honeypot anti-spam (invisible pour les humains) -->
            <div style="position: absolute; left: -9999px;" aria-hidden="true">
                <label>Ne pas remplir ce champ
                    <input type="text" name="dsj_hp_field" tabindex="-1" autocomplete="off">
                </label>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="resa_nom">&#128100; Nom complet <span class="required">*</span></label>
                    <input type="text" id="resa_nom" name="resa_nom" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="resa_contact">&#128222; Téléphone <span class="required">*</span></label>
                    <input type="tel" id="resa_contact" name="resa_contact" class="form-control" required>
                </div>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="resa_date">&#128197; Date <span class="required">*</span></label>
                    <input type="date" id="resa_date" name="resa_date" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="resa_heure">&#9200; Heure <span class="required">*</span></label>
                    <select id="resa_heure" name="resa_heure" class="form-control" required>
                        <option value="12h00">12h00</option>
                        <option value="12h30">12h30</option>
                        <option value="13h00">13h00</option>
                        <option value="13h30">13h30</option>
                        <option value="19h00">19h00</option>
                        <option value="19h30">19h30</option>
                        <option value="20h00">20h00</option>
                        <option value="20h30">20h30</option>
                    </select>
                </div>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="resa_personnes">&#128101; Nombre de personnes <span class="required">*</span></label>
                    <select id="resa_personnes" name="resa_personnes" class="form-control" required>
                        <option value="1">1 personne</option>
                        <option value="2">2 personnes</option>
                        <option value="3">3 personnes</option>
                        <option value="4">4 personnes</option>
                        <option value="5">5 personnes</option>
                        <option value="6">6 personnes</option>
                        <option value="7">7 personnes</option>
                        <option value="8+">8+ personnes</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="resa_occasion">&#127881; Occasion spéciale</label>
                    <select id="resa_occasion" name="resa_occasion" class="form-control">
                        <option value="">Aucune</option>
                        <option value="anniversaire">Anniversaire</option>
                        <option value="mariage">Mariage</option>
                        <option value="professionnel">Professionnel</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group full-width">
                <label for="resa_message">&#128172; Message / Demande particulière</label>
                <textarea id="resa_message" name="resa_message" class="form-control" rows="3" placeholder="Régime alimentaire, allergies, demande spéciale..."></textarea>
            </div>
            
            <div class="form-footer">
                <button type="submit" class="btn-submit">
                    <span class="btn-icon">&#127869;</span>
                    Réserver ma table
                </button>
                <p class="form-note">
                    <span class="note-icon">&#128274;</span>
                    Nous vous confirmerons votre réservation par téléphone ou WhatsApp
                </p>
            </div>
        </form>
    </div>
</section>

<?php get_footer(); ?>