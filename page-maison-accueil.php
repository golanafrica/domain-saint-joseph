<?php
/**
 * Template Name: Maison d'Accueil
 * ✅ Phase A11Y : aria-label, alt vides, role=alert, contrastes
 */
get_header(); ?>

<!-- HERO SECTION -->
<?php
$hero_image     = get_theme_mod( 'hero_maison_image' );
$hero_badge     = get_theme_mod( 'hero_maison_badge', '&#127968; Nos hébergements' );
$hero_titre     = get_theme_mod( 'hero_maison_titre', 'Maison d\'Accueil' );
$hero_soustitre = get_theme_mod( 'hero_maison_soustitre', 'Un lieu de repos, de ressourcement et de rencontres' );
?>

<section class="page-header maison-accueil-header" aria-labelledby="maison-hero-title">
    <div class="page-photo-zone"
         <?php if ( $hero_image ) : ?>
         style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
         <?php endif; ?>
         role="img"
         aria-label="<?php echo esc_attr( $hero_titre ); ?>">
    </div>

    <div class="header-caption-band">
        <span class="header-badge" aria-hidden="true"><?php echo wp_kses_post( $hero_badge ); ?></span>
        <h1 class="header-title" id="maison-hero-title"><?php echo esc_html( $hero_titre ); ?></h1>
        <div class="header-divider" aria-hidden="true">
            <span class="divider-line"></span>
            <span class="divider-icon">&#9962;</span>
            <span class="divider-line"></span>
        </div>
        <p class="header-subtitle"><?php echo esc_html( $hero_soustitre ); ?></p>
        <div class="header-buttons">
            <a href="#nos-chambres" class="btn-scroll" aria-label="Découvrir nos chambres">
                <span aria-hidden="true">&#128270;</span> Découvrir nos chambres
            </a>
            <a href="#reservation" class="btn-scroll btn-outline" aria-label="Réserver une chambre maintenant">
                <span aria-hidden="true">&#128197;</span> Réserver maintenant
            </a>
        </div>
    </div>
</section>

<!-- CONTENU ÉDITABLE (Gutenberg) -->
<section class="contenu-maison-accueil section-padding" aria-labelledby="maison-contenu-title">
    <div class="container">
        <h2 id="maison-contenu-title" class="screen-reader-text">Présentation</h2>
        <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
        ?>
    </div>
</section>

<!-- SECTION PRÉSENTATION DE LA MAISON D'ACCUEIL -->
<section class="maison-presentation section-padding bg-light" aria-labelledby="maison-presentation-title">
    <div class="container">
        <div class="section-header">
            <span class="section-badge" aria-hidden="true">&#127968; Un lieu pour tous</span>
            <h2 class="section-title" id="maison-presentation-title">La Maison d'Accueil</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
        <div class="presentation-content">
            <p>La Maison d'Accueil, ouverte à tous, a pour but l'autoprise en charge du Centre pour soutenir la formation.</p>
        </div>
        
        <div class="services-list">
            <h3>Nos espaces sont disponibles pour :</h3>
            <div class="services-grid" role="list">
                <div class="service-item" role="listitem"><span aria-hidden="true">&#128332;</span> Retraites, récollections</div>
                <div class="service-item" role="listitem"><span aria-hidden="true">&#127881;</span> Événements</div>
                <div class="service-item" role="listitem"><span aria-hidden="true">&#128104;&#8205;&#128105;&#8205;&#128103;&#8205;&#128102;</span> Réunions de famille</div>
                <div class="service-item" role="listitem"><span aria-hidden="true">&#128188;</span> Sessions de travail</div>
                <div class="service-item" role="listitem"><span aria-hidden="true">&#128218;</span> Conférences</div>
                <div class="service-item" role="listitem"><span aria-hidden="true">&#128214;</span> Journées d'étude</div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION ÉQUIPEMENTS DU CENTRE -->
<section class="equipements-section section-padding" aria-labelledby="equipements-title">
    <div class="container">
        <div class="section-header">
            <span class="section-badge" aria-hidden="true">&#128295; Nos équipements</span>
            <h2 class="section-title" id="equipements-title">Le Centre est doté</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
        
        <div class="equipements-grid" role="list">
            <div class="equipement-item" role="listitem">
                <span class="equipement-icon" aria-hidden="true">&#127744;</span>
                <span class="equipement-name">Chambres ventilées</span>
            </div>
            <div class="equipement-item" role="listitem">
                <span class="equipement-icon" aria-hidden="true">&#10052;</span>
                <span class="equipement-name">Chambres climatisées</span>
            </div>
            <div class="equipement-item" role="listitem">
                <span class="equipement-icon" aria-hidden="true">&#128524;</span>
                <span class="equipement-name">Cadre de recueillement</span>
            </div>
            <div class="equipement-item" role="listitem">
                <span class="equipement-icon" aria-hidden="true">&#9962;</span>
                <span class="equipement-name">Chapelle</span>
            </div>
            <div class="equipement-item" role="listitem">
                <span class="equipement-icon" aria-hidden="true">&#127897;</span>
                <span class="equipement-name">Salle de conférence</span>
            </div>
            <div class="equipement-item" role="listitem">
                <span class="equipement-icon" aria-hidden="true">&#128218;</span>
                <span class="equipement-name">Salles de formation</span>
            </div>
            <div class="equipement-item" role="listitem">
                <span class="equipement-icon" aria-hidden="true">&#128187;</span>
                <span class="equipement-name">Cadre de travail</span>
            </div>
            <div class="equipement-item" role="listitem">
                <span class="equipement-icon" aria-hidden="true">&#127869;</span>
                <span class="equipement-name">Salle à manger</span>
            </div>
        </div>
    </div>
</section>

<!-- SECTION NOS CHAMBRES (CPT Hébergements) -->
<section id="nos-chambres" class="nos-chambres section-padding bg-light" aria-labelledby="nos-chambres-title">
    <div class="container">
        <div class="section-header">
            <span class="section-badge" aria-hidden="true">&#127968; Notre espace</span>
            <h2 class="section-title" id="nos-chambres-title">Nos Chambres</h2>
            <div class="section-divider" aria-hidden="true"></div>
            <p class="section-subtitle">Des chambres confortables pour votre séjour</p>
        </div>
        
        <div class="hebergements-grid">
            <?php
            $hebergements = new WP_Query( [
                'post_type'      => 'hebergement',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC'
            ] );
            
            if ( $hebergements->have_posts() ) :
                while ( $hebergements->have_posts() ) : $hebergements->the_post(); ?>
                    <article class="hebergement-card card-modern">
                        <div class="card-image">
                            <a href="<?php the_permalink(); ?>" aria-label="Voir l'hébergement : <?php echo esc_attr( get_the_title() ); ?>">
                                <?php if ( has_post_thumbnail() ) : 
                                    the_post_thumbnail( 'card-thumb', [
                                        'alt'      => '',
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                    ] );
                                else : ?>
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300' viewBox='0 0 400 300'%3E%3Crect width='400' height='300' fill='%23f0f0f0'/%3E%3Ctext x='200' y='160' font-size='18' text-anchor='middle' fill='%23999' font-family='Arial'%3E%F0%9F%8F%A0 Chambre%3C/text%3E%3C/svg%3E" 
                                         alt=""
                                         loading="lazy"
                                         decoding="async"
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
                            <h3>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <?php 
                            $capacite  = get_post_meta( get_the_ID(), '_dsj_capacite', true );
                            $prix_nuit = get_post_meta( get_the_ID(), '_dsj_prix_nuit', true );
                            ?>
                            
                            <div class="card-meta">
                                <?php if ( $capacite ) : ?>
                                    <span class="meta-item">
                                        <span aria-hidden="true">&#128101;</span> <?php echo esc_html( $capacite ); ?> pers.
                                    </span>
                                <?php endif; ?>
                                
                                <?php if ( $prix_nuit ) : ?>
                                    <span class="meta-item">
                                        <span aria-hidden="true">&#128176;</span> <?php echo esc_html( $prix_nuit ); ?> F/nuit
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-description">
                                <?php 
                                if ( has_excerpt() ) {
                                    echo esc_html( wp_trim_words( get_the_excerpt(), 12, '...' ) );
                                } else {
                                    echo esc_html( wp_trim_words( get_the_content(), 12, '...' ) );
                                }
                                ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="btn-link" aria-label="Voir les détails de <?php echo esc_attr( get_the_title() ); ?>">
                                Voir les détails <span class="arrow" aria-hidden="true">&#8594;</span>
                            </a>
                        </div>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="text-center">Aucune chambre disponible pour le moment. Revenez bientôt !</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- FORMULAIRE DE RÉSERVATION -->
<section id="reservation" class="reservation section-padding" aria-labelledby="reservation-title">
    <div class="container">
        <div class="reservation-header">
            <span class="reservation-badge" aria-hidden="true">&#128197; Réservation</span>
            <h2 class="reservation-title" id="reservation-title">Demander une Réservation</h2>
            <div class="reservation-divider" aria-hidden="true"></div>
            <p class="reservation-subtitle">Remplissez ce formulaire et nous vous répondrons sous 48h</p>
        </div>
        
        <?php if ( isset( $_GET['success'] ) && $_GET['success'] === '1' ) : ?>
            <div class="alert alert-success" role="alert" aria-live="polite">
                <span class="alert-icon" aria-hidden="true">&#9989;</span>
                <div class="alert-content">
                    <strong>Merci !</strong> Votre demande a bien été envoyée. Nous vous répondrons sous 48h par WhatsApp ou email.
                </div>
            </div>
        <?php elseif ( isset( $_GET['error'] ) ) : ?>
            <div class="alert alert-error" role="alert" aria-live="assertive">
                <span class="alert-icon" aria-hidden="true">&#10060;</span>
                <div class="alert-content">
                    <?php
                    $error = sanitize_text_field( wp_unslash( $_GET['error'] ?? '' ) );
                    switch ( $error ) {
                        case 'missing':
                            echo '<strong>Champs manquants</strong><br>Veuillez remplir tous les champs obligatoires.';
                            break;
                        case 'session_expired':
                            echo '<strong>Session expirée</strong><br>Veuillez recharger la page et réessayer.';
                            break;
                        case 'send':
                            echo '<strong>Erreur d\'envoi</strong><br>Veuillez réessayer ou nous contacter par WhatsApp.';
                            break;
                        case 'rate_limit':
                            echo '<strong>Trop de messages</strong><br>Veuillez attendre quelques minutes avant de réessayer.';
                            break;
                        case 'invalid_contact':
                            echo '<strong>Contact invalide</strong><br>Veuillez entrer un email ou numéro de téléphone valide.';
                            break;
                        default:
                            echo '<strong>Erreur</strong><br>Une erreur est survenue. Veuillez réessayer.';
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>
        
        <form class="form-reservation" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
            <input type="hidden" name="action" value="dsj_reservation_form">
            <?php wp_nonce_field( 'dsj_reservation_nonce', '_wpnonce' ); ?>
            
            <!-- Honeypot anti-spam -->
            <div class="dsj-honeypot" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;">
                <label for="dsj_hp_field">Ne pas remplir ce champ</label>
                <input type="text" id="dsj_hp_field" name="dsj_hp_field" tabindex="-1" autocomplete="off">
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="resa-nom">
                        <span class="label-icon" aria-hidden="true">&#128100;</span>
                        Nom complet <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="text" id="resa-nom" name="nom" class="form-control" placeholder="Votre nom et prénom" required aria-required="true">
                    <span class="input-border" aria-hidden="true"></span>
                </div>
                
                <div class="form-group">
                    <label for="resa-contact">
                        <span class="label-icon" aria-hidden="true">&#128222;</span>
                        Email ou Téléphone <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="text" id="resa-contact" name="contact" class="form-control" placeholder="exemple@email.com ou +226 XX XX XX XX" required aria-required="true">
                    <span class="input-border" aria-hidden="true"></span>
                </div>
            </div>
            
            <div class="form-grid form-grid-3">
                <div class="form-group">
                    <label for="resa-arrivee">
                        <span class="label-icon" aria-hidden="true">&#128197;</span>
                        Date d'arrivée <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="date" id="resa-arrivee" name="arrivee" class="form-control" required aria-required="true">
                    <span class="input-border" aria-hidden="true"></span>
                </div>
                
                <div class="form-group">
                    <label for="resa-depart">
                        <span class="label-icon" aria-hidden="true">&#128197;</span>
                        Date de départ <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text">(obligatoire)</span>
                    </label>
                    <input type="date" id="resa-depart" name="depart" class="form-control" required aria-required="true">
                    <span class="input-border" aria-hidden="true"></span>
                </div>
                
                <div class="form-group">
                    <label for="resa-type">
                        <span class="label-icon" aria-hidden="true">&#127968;</span>
                        Type de chambre
                    </label>
                    <div class="select-wrapper">
                        <select id="resa-type" name="type" class="form-control">
                            <option value="">-- Au choix --</option>
                            <?php
                            $chambres = new WP_Query( [ 'post_type' => 'hebergement', 'posts_per_page' => -1 ] );
                            if ( $chambres->have_posts() ) :
                                while ( $chambres->have_posts() ) : $chambres->the_post(); ?>
                                    <option value="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></option>
                                <?php endwhile;
                                wp_reset_postdata();
                            endif; ?>
                        </select>
                        <span class="select-arrow" aria-hidden="true">&#9660;</span>
                    </div>
                    <span class="input-border" aria-hidden="true"></span>
                </div>
            </div>
            
            <div class="form-group full-width">
                <label for="resa-message">
                    <span class="label-icon" aria-hidden="true">&#128172;</span>
                    Besoins particuliers
                </label>
                <textarea id="resa-message" name="message" class="form-control" rows="4" placeholder="Ex: régime alimentaire, accès PMR, besoins spécifiques..."></textarea>
                <span class="input-border" aria-hidden="true"></span>
            </div>
            
            <div class="form-footer">
                <button type="submit" class="btn-submit">
                    <span class="btn-icon" aria-hidden="true">&#9993;</span>
                    Envoyer ma demande
                </button>
                <p class="form-note">
                    <span class="note-icon" aria-hidden="true">&#128274;</span>
                    Nous vous répondrons sous 48h par WhatsApp ou email
                </p>
            </div>
        </form>
    </div>
</section>

<?php get_footer(); ?>