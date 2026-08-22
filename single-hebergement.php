<?php
/**
 * Template pour l'affichage d'un hébergement individuel
 * Disposition identique aux pages de liste (photo en haut + bande bleue)
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <?php while ( have_posts() ) : the_post(); ?>
        
        <?php 
        // Image du hero : priorité image mise en avant > image du Customizer
        $hero_image_url = '';
        if ( has_post_thumbnail() ) {
            $hero_image_url = get_the_post_thumbnail_url( get_the_ID(), 'hero-size' );
        }
        if ( empty( $hero_image_url ) ) {
            $hero_image_url = get_theme_mod( 'hero_maison_image', '' );
        }
        ?>
        
        <!-- Hero section : MÊME disposition que les pages (photo + bande bleue) -->
        <section class="page-header hebergement-single-header">
            <div class="page-photo-zone"
                 <?php if ( $hero_image_url ) : ?>
                 style="background-image: url('<?php echo esc_url( $hero_image_url ); ?>');"
                 <?php endif; ?>>
            </div>
            <div class="header-caption-band">
                <span class="header-badge">&#127968; Notre hébergement</span>
                <h1 class="header-title"><?php the_title(); ?></h1>
                <div class="header-divider">
                    <span class="divider-line"></span>
                    <span class="divider-icon">&#9962;</span>
                    <span class="divider-line"></span>
                </div>
                <?php if ( has_excerpt() ) : ?>
                    <p class="header-subtitle"><?php echo get_the_excerpt(); ?></p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Contenu principal -->
        <section class="hebergement-single section-padding">
            <div class="container">
                <div class="hebergement-grid">
                    <!-- Colonne image avec galerie -->
                    <div class="hebergement-gallery">
                        <div class="main-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'large', [ 'class' => 'img-responsive' ] ); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-chambre.jpg" alt="Image de la chambre">
                            <?php endif; ?>
                        </div>
                        <?php
                        // Récupérer les images de la galerie (si ajoutées via ACF ou autre)
                        $gallery = get_post_meta( get_the_ID(), '_dsj_gallery', true );
                        if ( $gallery ) : ?>
                        <div class="gallery-thumbs">
                            <?php foreach ( $gallery as $image_id ) : ?>
                                <img src="<?php echo wp_get_attachment_image_url( $image_id, 'thumbnail' ); ?>" alt="Miniature">
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Colonne infos -->
                    <div class="hebergement-infos">
                        <div class="infos-card">
                            <h3>&#128203; Détails de la chambre</h3>
                            
                            <?php 
                            $capacite = get_post_meta( get_the_ID(), '_dsj_capacite', true );
                            $prix_nuit = get_post_meta( get_the_ID(), '_dsj_prix_nuit', true );
                            $dispo = get_post_meta( get_the_ID(), '_dsj_dispo', true );
                            $equipements = get_post_meta( get_the_ID(), '_dsj_equipements', true );
                            ?>
                            
                            <?php if ( $capacite ) : ?>
                            <div class="info-row">
                                <span class="info-label">&#128101; Capacité :</span>
                                <span class="info-value"><?php echo esc_html( $capacite ); ?> personne(s)</span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $prix_nuit ) : ?>
                            <div class="info-row">
                                <span class="info-label">&#128176; Prix par nuit :</span>
                                <span class="info-value"><?php echo esc_html( $prix_nuit ); ?> F CFA</span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $dispo ) : ?>
                            <div class="info-row">
                                <span class="info-label">&#128197; Disponibilité :</span>
                                <span class="info-value">
                                    <?php 
                                    if ( $dispo === 'disponible' ) echo '<span class="badge-disponible">&#9989; Disponible</span>';
                                    elseif ( $dispo === 'sur_reservation' ) echo '<span class="badge-reservation">&#128222; Sur réservation</span>';
                                    else echo '<span class="badge-complet">&#10060; Complet</span>';
                                    ?>
                                </span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $equipements ) : ?>
                            <div class="info-row equipements">
                                <span class="info-label">&#128715; Équipements :</span>
                                <div class="equipements-list">
                                    <?php 
                                    $equipements_clean = preg_split('/[\s,]+/', $equipements);
                                    foreach ( $equipements_clean as $equip ) : 
                                        if( trim($equip) ): ?>
                                            <span class="equipement-tag">&#10003; <?php echo esc_html( ucfirst(trim($equip)) ); ?></span>
                                    <?php 
                                        endif;
                                    endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="reservation-cta">
                            <a href="#reservation" class="btn btn-primary btn-large">&#128197; Réserver cette chambre</a>
                            <a href="https://wa.me/<?php echo get_theme_mod( 'whatsapp', '22666605890' ); ?>?text=Bonjour,%20je%20souhaite%20réserver%20<?php echo urlencode( get_the_title() ); ?>" 
                               class="btn btn-whatsapp btn-large" target="_blank">
                               &#128172; Réserver par WhatsApp
                            </a>
                        </div>
                        
                        <!-- Informations supplémentaires -->
                        <div class="info-extra">
                            <div class="extra-item">
                                <span class="extra-icon">&#128338;</span>
                                <div>
                                    <strong>Check-in / Check-out</strong>
                                    <small>Arrivée: 14h00 | Départ: 12h00</small>
                                </div>
                            </div>
                            <div class="extra-item">
                                <span class="extra-icon">&#127869;</span>
                                <div>
                                    <strong>Petit-déjeuner</strong>
                                    <small>Disponible sur demande</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Description complète -->
                <div class="hebergement-description">
                    <h3>&#128214; Description de la chambre</h3>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Formulaire de réservation stylisé -->
        <section class="reservation section-padding" id="reservation">
            <div class="container">
                <div class="reservation-header">
                    <span class="reservation-badge">&#128197; Réservez votre séjour</span>
                    <h2 class="reservation-title">Demander une Réservation</h2>
                    <div class="reservation-divider"></div>
                    <p class="reservation-subtitle">Remplissez ce formulaire et nous vous répondrons sous 48h</p>
                </div>
                
                <?php if ( isset( $_GET['success'] ) && $_GET['success'] === '1' ) : ?>
                    <div class="alert alert-success">
                        <span class="alert-icon">&#9989;</span>
                        <div class="alert-content">
                            <strong>Merci !</strong> Votre demande a bien été envoyée. Nous vous répondrons sous 48h par WhatsApp ou email.
                        </div>
                    </div>
                <?php elseif ( isset( $_GET['error'] ) ) : ?>
                    <div class="alert alert-error">
                        <span class="alert-icon">&#10060;</span>
                        <div class="alert-content">
                            <?php
                            $error = $_GET['error'] ?? '';
                            if ( $error === 'missing' ) echo '<strong>Champs manquants</strong><br>Veuillez remplir tous les champs obligatoires.';
                            elseif ( $error === 'send' ) echo '<strong>Erreur d\'envoi</strong><br>Veuillez réessayer ou nous contacter par WhatsApp.';
                            elseif ( $error === 'rate_limit' ) echo '<strong>Trop de messages</strong><br>Veuillez attendre quelques minutes avant de réessayer.';
                            elseif ( $error === 'invalid_contact' ) echo '<strong>Contact invalide</strong><br>Veuillez entrer un email ou numéro de téléphone valide.';
                            else echo '<strong>Erreur</strong><br>Une erreur est survenue. Veuillez réessayer.';
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <form class="form-reservation" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                    <input type="hidden" name="action" value="dsj_reservation_form">
                    <?php wp_nonce_field( 'dsj_reservation_nonce', '_wpnonce' ); ?>
                    <input type="hidden" name="type" value="<?php echo esc_attr( get_the_title() ); ?>">
                    
                    <!-- Honeypot anti-spam (invisible pour les humains) -->
                    <div style="position: absolute; left: -9999px;" aria-hidden="true">
                        <label>Ne pas remplir ce champ
                            <input type="text" name="dsj_hp_field" tabindex="-1" autocomplete="off">
                        </label>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nom">
                                <span class="label-icon">&#128100;</span>
                                Nom complet <span class="required">*</span>
                            </label>
                            <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom et prénom" required>
                            <span class="input-border"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact">
                                <span class="label-icon">&#128222;</span>
                                Email ou Téléphone <span class="required">*</span>
                            </label>
                            <input type="text" id="contact" name="contact" class="form-control" placeholder="exemple@email.com ou +226 XX XX XX XX" required>
                            <span class="input-border"></span>
                        </div>
                    </div>
                    
                    <div class="form-grid form-grid-3">
                        <div class="form-group">
                            <label for="arrivee">
                                <span class="label-icon">&#128197;</span>
                                Date d'arrivée <span class="required">*</span>
                            </label>
                            <input type="date" id="arrivee" name="arrivee" class="form-control" required>
                            <span class="input-border"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="depart">
                                <span class="label-icon">&#128197;</span>
                                Date de départ <span class="required">*</span>
                            </label>
                            <input type="date" id="depart" name="depart" class="form-control" required>
                            <span class="input-border"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="type_chambre">
                                <span class="label-icon">&#127968;</span>
                                Type de chambre
                            </label>
                            <input type="text" id="type_chambre" name="type_chambre" class="form-control" value="<?php the_title(); ?>" readonly>
                            <span class="input-border"></span>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="message">
                            <span class="label-icon">&#128172;</span>
                            Besoins particuliers
                        </label>
                        <textarea id="message" name="message" class="form-control" rows="4" placeholder="Ex: régime alimentaire, accès PMR, besoins spécifiques..."></textarea>
                        <span class="input-border"></span>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn-submit">
                            <span class="btn-icon">&#9993;</span>
                            Envoyer ma demande
                        </button>
                        <p class="form-note">
                            <span class="note-icon">&#128274;</span>
                            Nous vous répondrons sous 48h par WhatsApp ou email
                        </p>
                    </div>
                </form>
            </div>
        </section>
        
    <?php endwhile; ?>
    
</main>

<?php get_footer(); ?>