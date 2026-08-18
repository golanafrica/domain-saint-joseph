<?php
/**
 * Dashboard "Gestion du site" pour les soeurs
 * Domaine Saint Joseph
 * Emojis en entites HTML : affichage garanti quel que soit l'encodage
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ========================================
// MENU PRINCIPAL "GESTION DU SITE"
// ========================================
function dsj_add_dashboard_menu() {
    add_menu_page(
        'Gestion du site',
        '&#127968; Gestion du site',
        'edit_posts',
        'dsj-gestion-site',
        'dsj_render_dashboard_page',
        'dashicons-home',
        2
    );
}
add_action( 'admin_menu', 'dsj_add_dashboard_menu', 1 );

// ========================================
// REDIRIGER LES SOEURS VERS LE DASHBOARD A LA CONNEXION
// ========================================
function dsj_redirect_after_login( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'soeur', $user->roles ) || in_array( 'editor', $user->roles ) ) {
            return admin_url( 'admin.php?page=dsj-gestion-site' );
        }
    }
    return $redirect_to;
}
add_filter( 'login_redirect', 'dsj_redirect_after_login', 10, 3 );

// ========================================
// RENDU DE LA PAGE DASHBOARD
// ========================================
function dsj_render_dashboard_page() {
    $count_formations   = wp_count_posts( 'formation' )->publish ?? 0;
    $count_hebergements = wp_count_posts( 'hebergement' )->publish ?? 0;
    $count_galerie      = wp_count_posts( 'galerie' )->publish ?? 0;
    $count_menu         = wp_count_posts( 'menu' )->publish ?? 0;
    $count_temoignages  = wp_count_posts( 'temoignage' )->publish ?? 0;
    $count_pages        = wp_count_posts( 'page' )->publish ?? 0;

    $current_user = wp_get_current_user();
    $user_name    = $current_user->display_name;
    ?>

    <div class="wrap dsj-dashboard">
        <!-- En-tête -->
        <div class="dsj-dashboard-header">
            <div class="dsj-welcome">
                <h1>&#128075; Bonjour, <?php echo esc_html( $user_name ); ?> !</h1>
                <p class="dsj-welcome-subtitle">Bienvenue sur votre espace de gestion du Domaine Saint Joseph.</p>
            </div>
            <div class="dsj-quick-stats">
                <div class="dsj-stat-badge">
                    <span class="dsj-stat-number"><?php echo esc_html( $count_formations ); ?></span>
                    <span class="dsj-stat-label">Formations</span>
                </div>
                <div class="dsj-stat-badge">
                    <span class="dsj-stat-number"><?php echo esc_html( $count_hebergements ); ?></span>
                    <span class="dsj-stat-label">Hébergements</span>
                </div>
                <div class="dsj-stat-badge">
                    <span class="dsj-stat-number"><?php echo esc_html( $count_galerie ); ?></span>
                    <span class="dsj-stat-label">Photos</span>
                </div>
                <div class="dsj-stat-badge">
                    <span class="dsj-stat-number"><?php echo esc_html( $count_temoignages ); ?></span>
                    <span class="dsj-stat-label">Témoignages</span>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="dsj-section">
            <h2>&#9889; Actions rapides</h2>
            <div class="dsj-quick-actions">
                <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=formation' ) ); ?>" class="dsj-action-card">
                    <span class="dsj-action-icon">&#127891;</span>
                    <span class="dsj-action-title">Ajouter une formation</span>
                    <span class="dsj-action-desc">Créer une nouvelle filière de formation</span>
                </a>
                <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=hebergement' ) ); ?>" class="dsj-action-card">
                    <span class="dsj-action-icon">&#127968;</span>
                    <span class="dsj-action-title">Ajouter un hébergement</span>
                    <span class="dsj-action-desc">Créer une nouvelle chambre ou espace</span>
                </a>
                <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=galerie' ) ); ?>" class="dsj-action-card">
                    <span class="dsj-action-icon">&#128248;</span>
                    <span class="dsj-action-title">Ajouter une photo</span>
                    <span class="dsj-action-desc">Ajouter une photo à la galerie</span>
                </a>
                <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=menu' ) ); ?>" class="dsj-action-card">
                    <span class="dsj-action-icon">&#127869;</span>
                    <span class="dsj-action-title">Ajouter un plat</span>
                    <span class="dsj-action-desc">Ajouter un plat au menu du restaurant</span>
                </a>
                <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=temoignage' ) ); ?>" class="dsj-action-card">
                    <span class="dsj-action-icon">&#128172;</span>
                    <span class="dsj-action-title">Ajouter un témoignage</span>
                    <span class="dsj-action-desc">Partager un retour d'expérience</span>
                </a>
                <a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" class="dsj-action-card">
                    <span class="dsj-action-icon">&#128279;</span>
                    <span class="dsj-action-title">Modifier le menu</span>
                    <span class="dsj-action-desc">Gérer la navigation du site</span>
                </a>
            </div>
        </div>

        <!-- Gestion des contenus -->
        <div class="dsj-section">
            <h2>&#128203; Gérer les contenus existants</h2>
            <div class="dsj-content-grid">
                <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=formation' ) ); ?>" class="dsj-content-card">
                    <div class="dsj-content-icon">&#127891;</div>
                    <div class="dsj-content-info">
                        <h3>Nos Formations</h3>
                        <p><?php echo esc_html( $count_formations ); ?> formation(s) publiée(s)</p>
                    </div>
                    <span class="dsj-content-arrow">&#8594;</span>
                </a>
                <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=hebergement' ) ); ?>" class="dsj-content-card">
                    <div class="dsj-content-icon">&#127968;</div>
                    <div class="dsj-content-info">
                        <h3>Nos Hébergements</h3>
                        <p><?php echo esc_html( $count_hebergements ); ?> hébergement(s) publié(s)</p>
                    </div>
                    <span class="dsj-content-arrow">&#8594;</span>
                </a>
                <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=galerie' ) ); ?>" class="dsj-content-card">
                    <div class="dsj-content-icon">&#128248;</div>
                    <div class="dsj-content-info">
                        <h3>Galerie Photos</h3>
                        <p><?php echo esc_html( $count_galerie ); ?> photo(s) publiée(s)</p>
                    </div>
                    <span class="dsj-content-arrow">&#8594;</span>
                </a>
                <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=menu' ) ); ?>" class="dsj-content-card">
                    <div class="dsj-content-icon">&#127869;</div>
                    <div class="dsj-content-info">
                        <h3>Menu Restaurant</h3>
                        <p><?php echo esc_html( $count_menu ); ?> plat(s) publié(s)</p>
                    </div>
                    <span class="dsj-content-arrow">&#8594;</span>
                </a>
                <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=temoignage' ) ); ?>" class="dsj-content-card">
                    <div class="dsj-content-icon">&#128172;</div>
                    <div class="dsj-content-info">
                        <h3>Témoignages</h3>
                        <p><?php echo esc_html( $count_temoignages ); ?> témoignage(s) publié(s)</p>
                    </div>
                    <span class="dsj-content-arrow">&#8594;</span>
                </a>
                <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=page' ) ); ?>" class="dsj-content-card">
                    <div class="dsj-content-icon">&#128196;</div>
                    <div class="dsj-content-info">
                        <h3>Pages du site</h3>
                        <p><?php echo esc_html( $count_pages ); ?> page(s) publiée(s)</p>
                    </div>
                    <span class="dsj-content-arrow">&#8594;</span>
                </a>
            </div>
        </div>

        <!-- Personnalisation -->
        <div class="dsj-section">
            <h2>&#127912; Personnaliser le site</h2>
            <div class="dsj-customize-grid">
                <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="dsj-customize-card">
                    <span class="dsj-customize-icon">&#127912;</span>
                    <h3>Personnaliser</h3>
                    <p>Couleurs, hero, logos, textes des pages</p>
                </a>
                <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=dsj_contact' ) ); ?>" class="dsj-customize-card">
                    <span class="dsj-customize-icon">&#128222;</span>
                    <h3>Coordonnées</h3>
                    <p>Téléphone, email, WhatsApp</p>
                </a>
                <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=dsj_urgence' ) ); ?>" class="dsj-customize-card">
                    <span class="dsj-customize-icon">&#128680;</span>
                    <h3>Bandeau d'urgence</h3>
                    <p>Messages défilants en haut du site</p>
                </a>
                <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=dsj_aide_accueil' ) ); ?>" class="dsj-customize-card">
                    <span class="dsj-customize-icon">&#128157;</span>
                    <h3>Appel à l'aide</h3>
                    <p>Parrainage et construction (accueil)</p>
                </a>
                <a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="dsj-customize-card">
                    <span class="dsj-customize-icon">&#129513;</span>
                    <h3>Widgets</h3>
                    <p>Bandeau hero, footer</p>
                </a>
                <a href="<?php echo esc_url( admin_url( 'upload.php' ) ); ?>" class="dsj-customize-card">
                    <span class="dsj-customize-icon">&#128444;</span>
                    <h3>Médiathèque</h3>
                    <p>Gérer les images et fichiers</p>
                </a>
            </div>
        </div>

        <!-- Guide d'utilisation -->
        <div class="dsj-section dsj-guide-section">
            <h2>&#128214; Guide d'utilisation</h2>
            <div class="dsj-guide-content">
                <div class="dsj-guide-item">
                    <h3>&#128248; Ajouter une photo à la galerie</h3>
                    <ol>
                        <li>Cliquez sur <strong>"Ajouter une photo"</strong> ci-dessus</li>
                        <li>Donnez un titre (ex : "Cérémonie de fin d'année")</li>
                        <li>Cliquez sur <strong>"Image mise en avant"</strong> à droite, puis choisissez votre photo</li>
                        <li>Dans la section <strong>"Catégories Galerie"</strong>, cochez la catégorie appropriée</li>
                        <li>Cliquez sur <strong>"Publier"</strong> en haut à droite</li>
                    </ol>
                </div>
                <div class="dsj-guide-item">
                    <h3>&#127891; Ajouter une nouvelle formation</h3>
                    <ol>
                        <li>Cliquez sur <strong>"Ajouter une formation"</strong></li>
                        <li>Donnez un titre (ex : "Formation en couture")</li>
                        <li>Rédigez la description complète de la formation</li>
                        <li>Dans <strong>"&#128218; Détails de la formation"</strong> en dessous, remplissez : durée, prix, niveau, places, formatrice, horaires</li>
                        <li>Ajoutez une image mise en avant</li>
                        <li>Cliquez sur <strong>"Publier"</strong></li>
                    </ol>
                </div>
                <div class="dsj-guide-item">
                    <h3>&#127968; Modifier les disponibilités des chambres</h3>
                    <ol>
                        <li>Allez dans <strong>"Nos Hébergements"</strong> puis cliquez sur la chambre à modifier</li>
                        <li>Dans <strong>"&#127968; Détails de l'hébergement"</strong>, changez la <strong>"Disponibilité"</strong> : Disponible, Sur réservation ou Complet</li>
                        <li>Mettez à jour le prix si nécessaire</li>
                        <li>Cliquez sur <strong>"Mettre à jour"</strong></li>
                    </ol>
                </div>
                <div class="dsj-guide-item">
                    <h3>&#127912; Modifier les textes de la page d'accueil</h3>
                    <ol>
                        <li>Cliquez sur <strong>"Personnaliser"</strong> dans le menu ci-dessus</li>
                        <li>Choisissez la section à modifier : <strong>"Statistiques Hero"</strong>, <strong>"Hero Slider"</strong>, <strong>"Appel à l'aide"</strong>, etc.</li>
                        <li>Modifiez les textes, couleurs ou images</li>
                        <li>Cliquez sur <strong>"Publier"</strong> en haut</li>
                    </ol>
                </div>
                <div class="dsj-guide-item">
                    <h3>&#128222; Modifier les coordonnées</h3>
                    <ol>
                        <li>Cliquez sur <strong>"Coordonnées"</strong> dans la section Personnaliser</li>
                        <li>Modifiez le numéro WhatsApp, téléphone ou email</li>
                        <li>Cliquez sur <strong>"Publier"</strong></li>
                    </ol>
                </div>
                <div class="dsj-guide-item dsj-guide-tip">
                    <h3>&#128161; Astuces importantes</h3>
                    <ul>
                        <li><strong>Toujours vider le cache</strong> (Ctrl+F5) après modification pour voir les changements</li>
                        <li><strong>Images</strong> : Privilégiez les images <strong>WebP</strong> ou <strong>JPG</strong> de moins de 200 Ko pour la 3G</li>
                        <li><strong>Permaliens</strong> : Si une page donne une erreur 404, allez dans Réglages &#8594; Permaliens &#8594; Enregistrer</li>
                        <li><strong>Formulaires</strong> : Les messages arrivent sur <strong>centredsj@gmail.com</strong></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Support -->
        <div class="dsj-section dsj-support-section">
            <h2>&#127384; Besoin d'aide ?</h2>
            <div class="dsj-support-content">
                <p>Pour toute question technique, contactez le support :</p>
                <div class="dsj-support-contacts">
                    <div class="dsj-support-item">
                        <span class="dsj-support-icon">&#128231;</span>
                        <div>
                            <strong>Email</strong><br>
                            <a href="mailto:ifbburkina@gmail.com">ifbburkina@gmail.com</a>
                        </div>
                    </div>
                    <div class="dsj-support-item">
                        <span class="dsj-support-icon">&#128172;</span>
                        <div>
                            <strong>WhatsApp</strong><br>
                            <a href="https://wa.me/22676619457" target="_blank">+226 76 61 94 57</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php
}

// ========================================
// CHARGER LE CSS ADMIN
// ========================================
function dsj_admin_dashboard_styles( $hook ) {
    if ( 'toplevel_page_dsj-gestion-site' !== $hook ) {
        return;
    }
    wp_enqueue_style(
        'dsj-admin-dashboard',
        get_template_directory_uri() . '/assets/css/admin.css',
        [],
        '1.0.0'
    );
}
add_action( 'admin_enqueue_scripts', 'dsj_admin_dashboard_styles' );

// ========================================
// WIDGET DASHBOARD BIENVENUE
// ========================================
function dsj_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'dsj_welcome_widget',
        '&#127968; Domaine Saint Joseph &mdash; Gestion du site',
        'dsj_welcome_widget_callback'
    );
}
add_action( 'wp_dashboard_setup', 'dsj_add_dashboard_widgets' );

function dsj_welcome_widget_callback() {
    echo '<div style="padding: 10px 0;">';
    echo '<p>&#128075; Bienvenue sur votre espace de gestion !</p>';
    echo '<p>Utilisez le menu <strong>"&#127968; Gestion du site"</strong> à gauche pour accéder rapidement à toutes les fonctionnalités.</p>';
    echo '<p style="margin-top: 15px;">';
    echo '<a href="' . esc_url( admin_url( 'admin.php?page=dsj-gestion-site' ) ) . '" class="button button-primary" style="background: #1A5276; border-color: #1A5276;">';
    echo 'Ouvrir le tableau de bord';
    echo '</a>';
    echo '</p>';
    echo '</div>';
}

// ========================================
// PIED DE PAGE ADMIN PERSONNALISÉ
// ========================================
function dsj_custom_admin_footer_text( $text ) {
    return '&#128591; Domaine Saint Joseph &mdash; Travailleuses Missionnaires de l\'Immaculée | Thème personnalisé v1.0';
}
add_filter( 'admin_footer_text', 'dsj_custom_admin_footer_text' );