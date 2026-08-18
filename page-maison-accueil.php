<?php
/*
Template Name: Maison d'Accueil
*/
get_header(); ?>

<!-- HERO SECTION -->
<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_maison_image' );
$hero_badge     = get_theme_mod( 'hero_maison_badge', '🏠 Nos hébergements' );
$hero_titre     = get_theme_mod( 'hero_maison_titre', 'Maison d\'Accueil' );
$hero_soustitre = get_theme_mod( 'hero_maison_soustitre', 'Un lieu de repos, de ressourcement et de rencontres' );
?>

<section class="page-header maison-accueil-header">

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
            <span class="divider-icon">⛪</span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
        <div class="header-buttons">
            <a href="#nos-chambres" class="btn-scroll">📅 Découvrir nos chambres</a>
            <a href="#reservation" class="btn-scroll btn-outline">📞 Réserver maintenant</a>
        </div>
    </div>

</section>

<!-- CONTENU ÉDITABLE (Gutenberg) -->
<section class="contenu-maison-accueil section-padding">
    <div class="container">
        <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
        ?>
    </div>
</section>

<!-- SECTION PRÉSENTATION DE LA MAISON D'ACCUEIL -->
<section class="maison-presentation section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">🏡 Un lieu pour tous</span>
            <h2 class="section-title">La Maison d'Accueil</h2>
            <div class="section-divider"></div>
        </div>
        <div class="presentation-content">
            <p>La Maison d'Accueil, ouverte à tous, a pour but l'autoprise en charge du Centre pour soutenir la formation.</p>
        </div>
        
        <div class="services-list">
            <h3>Nos espaces sont disponibles pour :</h3>
            <div class="services-grid">
                <div class="service-item">🕊️ Retraites, récollections</div>
                <div class="service-item">🎉 Événements</div>
                <div class="service-item">👨‍👩‍👧‍👦 Réunions de famille</div>
                <div class="service-item">💼 Sessions de travail</div>
                <div class="service-item">📊 Conférences</div>
                <div class="service-item">📚 Journées d'étude</div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION ÉQUIPEMENTS DU CENTRE -->
<section class="equipements-section section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">🛋️ Nos équipements</span>
            <h2 class="section-title">Le Centre est doté</h2>
            <div class="section-divider"></div>
        </div>
        
        <div class="equipements-grid">
            <div class="equipement-item">
                <span class="equipement-icon">🛏️</span>
                <span class="equipement-name">Chambres ventilées</span>
            </div>
            <div class="equipement-item">
                <span class="equipement-icon">❄️</span>
                <span class="equipement-name">Chambres climatisées</span>
            </div>
            <div class="equipement-item">
                <span class="equipement-icon">🙏</span>
                <span class="equipement-name">Cadre de recueillement</span>
            </div>
            <div class="equipement-item">
                <span class="equipement-icon">⛪</span>
                <span class="equipement-name">Chapelle</span>
            </div>
            <div class="equipement-item">
                <span class="equipement-icon">🏢</span>
                <span class="equipement-name">Salle de conférence</span>
            </div>
            <div class="equipement-item">
                <span class="equipement-icon">📚</span>
                <span class="equipement-name">Salles de formation</span>
            </div>
            <div class="equipement-item">
                <span class="equipement-icon">💻</span>
                <span class="equipement-name">Cadre de travail</span>
            </div>
            <div class="equipement-item">
                <span class="equipement-icon">🍽️</span>
                <span class="equipement-name">Salle à manger</span>
            </div>
        </div>
    </div>
</section>

<!-- SECTION NOS CHAMBRES (CPT Hébergements) -->
<section id="nos-chambres" class="nos-chambres section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">🏠 Notre espace</span>
            <h2 class="section-title">Nos Chambres</h2>
            <div class="section-divider"></div>
            <p class="section-subtitle">Des chambres confortables pour votre séjour</p>
        </div>
        
        <div class="hebergements-grid">
            <?php
            $hebergements = new WP_Query( [
                'post_type' => 'hebergement',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ] );
            
            if ( $hebergements->have_posts() ) :
                while ( $hebergements->have_posts() ) : $hebergements->the_post(); ?>
                    <div class="hebergement-card">
                        <div class="card-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) : 
                                    the_post_thumbnail( 'card-thumb' );
                                else : ?>
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300' viewBox='0 0 400 300'%3E%3Crect width='400' height='300' fill='%23f0f0f0'/%3E%3Ctext x='200' y='160' font-size='18' text-anchor='middle' fill='%23999' font-family='Arial'%3E🏠 Chambre%3C/text%3E%3C/svg%3E" 
                                         alt="<?php the_title_attribute(); ?>"
                                         style="width:100%; height:200px; object-fit:cover;">
                                <?php endif; ?>
                            </a>
                            <?php 
                            $dispo = get_post_meta( get_the_ID(), '_dsj_dispo', true );
                            if ( $dispo === 'disponible' ) : ?>
                                <span class="card-badge disponible">Disponible</span>
                            <?php elseif ( $dispo === 'sur_reservation' ) : ?>
                                <span class="card-badge reservation">Sur réservation</span>
                            <?php elseif ( $dispo === 'complet' ) : ?>
                                <span class="card-badge complet">Complet</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            
                            <?php 
                            $capacite = get_post_meta( get_the_ID(), '_dsj_capacite', true );
                            $prix_nuit = get_post_meta( get_the_ID(), '_dsj_prix_nuit', true );
                            ?>
                            
                            <div class="card-meta">
                                <?php if ( $capacite ) : ?>
                                    <span class="meta-item">👥 <?php echo esc_html( $capacite ); ?> pers.</span>
                                <?php endif; ?>
                                
                                <?php if ( $prix_nuit ) : ?>
                                    <span class="meta-item">💰 <?php echo esc_html( $prix_nuit ); ?> F/nuit</span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-description">
                                <?php 
                                if ( has_excerpt() ) {
                                    echo wp_trim_words( get_the_excerpt(), 12, '...' );
                                } else {
                                    echo wp_trim_words( get_the_content(), 12, '...' );
                                }
                                ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="btn-link">
                                Voir les détails →
                            </a>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="text-center">Aucune chambre disponible pour le moment. Revenez bientôt !</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- FORMULAIRE DE RÉSERVATION STYLISÉ -->
<section id="reservation" class="reservation section-padding">
    <div class="container">
        <div class="reservation-header">
            <span class="reservation-badge">📅 Réservation</span>
            <h2 class="reservation-title">Demander une Réservation</h2>
            <div class="reservation-divider"></div>
            <p class="reservation-subtitle">Remplissez ce formulaire et nous vous répondrons sous 48h</p>
        </div>
        
        <?php if ( isset( $_GET['success'] ) && $_GET['success'] === '1' ) : ?>
            <div class="alert alert-success">
                <span class="alert-icon">✅</span>
                <div class="alert-content">
                    <strong>Merci !</strong> Votre demande a bien été envoyée. Nous vous répondrons sous 48h par WhatsApp ou email.
                </div>
            </div>
        <?php elseif ( isset( $_GET['error'] ) ) : ?>
            <div class="alert alert-error">
                <span class="alert-icon">❌</span>
                <div class="alert-content">
                    <?php
                    $error = $_GET['error'];
                    if ( $error === 'missing' ) echo '<strong>Champs manquants</strong><br>Veuillez remplir tous les champs obligatoires.';
                    elseif ( $error === 'send' ) echo '<strong>Erreur d\'envoi</strong><br>Veuillez réessayer ou nous contacter par WhatsApp.';
                    else echo '<strong>Erreur</strong><br>Une erreur est survenue. Veuillez réessayer.';
                    ?>
                </div>
            </div>
        <?php endif; ?>
        
        <form class="form-reservation" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
            <input type="hidden" name="action" value="dsj_reservation_form">
            <?php wp_nonce_field( 'dsj_reservation_nonce', '_wpnonce' ); ?>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="nom">
                        <span class="label-icon">👤</span>
                        Nom complet <span class="required">*</span>
                    </label>
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom et prénom" required>
                    <span class="input-border"></span>
                </div>
                
                <div class="form-group">
                    <label for="contact">
                        <span class="label-icon">📞</span>
                        Email ou Téléphone <span class="required">*</span>
                    </label>
                    <input type="text" id="contact" name="contact" class="form-control" placeholder="exemple@email.com ou +226 XX XX XX XX" required>
                    <span class="input-border"></span>
                </div>
            </div>
            
            <div class="form-grid form-grid-3">
                <div class="form-group">
                    <label for="arrivee">
                        <span class="label-icon">📅</span>
                        Date d'arrivée <span class="required">*</span>
                    </label>
                    <input type="date" id="arrivee" name="arrivee" class="form-control" required>
                    <span class="input-border"></span>
                </div>
                
                <div class="form-group">
                    <label for="depart">
                        <span class="label-icon">📅</span>
                        Date de départ <span class="required">*</span>
                    </label>
                    <input type="date" id="depart" name="depart" class="form-control" required>
                    <span class="input-border"></span>
                </div>
                
                <div class="form-group">
                    <label for="type">
                        <span class="label-icon">🏠</span>
                        Type de chambre
                    </label>
                    <div class="select-wrapper">
                        <select id="type" name="type" class="form-control">
                            <option value="">-- Au choix --</option>
                            <?php
                            $chambres = new WP_Query( [ 'post_type' => 'hebergement', 'posts_per_page' => -1 ] );
                            if ( $chambres->have_posts() ) :
                                while ( $chambres->have_posts() ) : $chambres->the_post(); ?>
                                    <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                                <?php endwhile;
                                wp_reset_postdata();
                            endif; ?>
                        </select>
                        <span class="select-arrow">▼</span>
                    </div>
                    <span class="input-border"></span>
                </div>
            </div>
            
            <div class="form-group full-width">
                <label for="message">
                    <span class="label-icon">💬</span>
                    Besoins particuliers
                </label>
                <textarea id="message" name="message" class="form-control" rows="4" placeholder="Ex: régime alimentaire, accès PMR, besoins spécifiques..."></textarea>
                <span class="input-border"></span>
            </div>
            
            <div class="form-footer">
                <button type="submit" class="btn-submit">
                    <span class="btn-icon">✉️</span>
                    Envoyer ma demande
                </button>
                <p class="form-note">
                    <span class="note-icon">🔒</span>
                    Nous vous répondrons sous 48h par WhatsApp ou email
                </p>
            </div>
        </form>
    </div>
</section>

<?php get_footer(); ?>