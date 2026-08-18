CONTEXT.MD ? Domaine Saint Joseph
Fichier de contexte unique pour développeur ou IA
? Instructions : Colle ce fichier entier dans une nouvelle conversation Claude pour reprendre le projet exactement là où il en est.
? Résumé du projet en une phrase
Site WordPress custom pour le Domaine Saint Joseph ? centre de formation technique et maison d'accueil des Travailleuses Missionnaires de l'Immaculée à Bobo-Dioulasso, Burkina Faso ? hébergé sur Pantheon.io, optimisé 3G, maintenable par des non-techniciennes.
? État actuel du projet (Mai 2026)

? Thème PHP custom codé de bout en bout (zéro plugin externe)
? Site déployé sur Pantheon Dev et fonctionnel
? Base de données migrée depuis LocalWP
? Images uploadées via SFTP WinSCP
? Toutes les sections de l'accueil fonctionnelles
? CPT Formation, Hébergement, Galerie créés + taxonomie
? Customizer configuré (hero, stats, contact, couleurs, CTA)
? Formulaires contact/réservation sécurisés (nonce + sanitization)
? Menu mobile responsive + galerie lightbox native
? Rôle "soeur" créé avec permissions limitées
? CSS/JS optimisés pour 3G (< 30 Ko CSS, < 5 Ko JS)

? À faire avant lancement :
- Remplacer les Lorem ipsum par vrais textes
- Acheter et configurer domaine domainesaintjoseph.bf sur Pantheon
- Passer environnement Dev ? Live
- Former la s?ur responsable (guide imprimé)
- Tests finaux performance mobile (PageSpeed > 80)
- Backup final + documentation utilisateur

?? Environnements et accès

Local (développement) :
- URL          : http://college-filles-bf.local (LocalWP Windows)
- Thème        : C:\Users\ifbbu\Local Sites\college-filles-bf\app\public\wp-content\themes\college-filles-bf
- DB           : host=127.0.0.1, port=10005, user=root, pass=root, db=local
- WP login     : college-filles-bf (admin par défaut)

Pantheon (production) :
- Dev URL      : https://dev-domaine-saint-joseph.pantheonsite.io
- Dashboard    : https://dashboard.pantheon.io/sites/c1012814-a224-44ec-9f3a-76530cc929a5
- Git clone    : ssh://codeserver.dev.c1012814-a224-44ec-9f3a-76530cc929a5@codeserver.dev.c1012814-a224-44ec-9f3a-76530cc929a5.drush.in:2222/~/repository.git
- Repo local   : C:\Users\ifbbu\Desktop\domaine-saint-joseph
- SFTP host    : appserver.dev.c1012814-a224-44ec-9f3a-76530cc929a5.drush.in:2222
- SFTP user    : dev.c1012814-a224-44ec-9f3a-76530cc929a5

?? Architecture technique

CMS        : WordPress 6.5+
Thème      : PHP classique custom (pas Elementor, pas Gutenberg FSE)
Approche   : Hybride ? sections fixes en PHP + contenu éditable Gutenberg
CPT        : formation, hebergement, galerie (+ taxonomie categorie_galerie)
Customizer : hero, stats, contact, couleurs, CTA, mission, équipe
Rôle WP    : "soeur" ? peut publier contenus, pas administrer
Performance: WebP, lazy load natif, suppression emojis/oEmbed, CSS/JS minifiés
Sécurité   : Nonce WordPress, sanitization stricte, escaping à l'affichage

? Structure du thème

college-filles-bf/
??? style.css                 ? Déclaration thème WordPress
??? functions.php             ? Configuration, hooks, handlers formulaires
??? index.php, 404.php, page.php
??? front-page.php            ? Accueil hybride (PHP fixe + Gutenberg)
??? header.php                ? Nav sticky, logo, WhatsApp btn, menu burger
??? footer.php                ? 4 colonnes, newsletter, social, vague décorative
??? page-a-propos.php         ? Mission + équipe (Customizer)
??? page-formation.php        ? Liste formations (CPT)
??? single-formation.php      ? Détail formation + métadonnées + bouton WhatsApp
??? page-maison-accueil.php   ? Présentation + formulaire réservation
??? single-hebergement.php    ? Détail hébergement + équipements + dispo
??? archive-hebergement.php   ? Archive hébergements
??? page-galerie.php          ? Galerie avec filtres JS + lightbox native
??? page-nous-soutenir.php    ? Dons, parrainage, Mobile Money
??? page-contact.php          ? Formulaire wp_mail sécurisé
??? page-restaurant.php       ? (optionnel, futur)
??? assets/
?   ??? css/
?   ?   ??? main.css          ? TOUT le CSS, organisé par sections, responsive
?   ??? js/
?   ?   ??? main.js           ? Menu burger, galerie, scroll, animations
?   ?   ??? widget-uploader.js# Uploader images pour widget hero (optionnel)
?   ??? images/               ? Assets optimisés WebP < 200 Ko
??? inc/
?   ??? cpt.php               ? register_post_type + taxonomie galerie
?   ??? customizer.php        ? Options thème (stats, contact, couleurs, CTA, mission, équipe)
?   ??? metaboxes.php         ? Champs personnalisés formations/hébergements
?   ??? widgets.php           ? Widget hero personnalisable (optionnel)
??? template-parts/           ? Réservé pour composants réutilisables futurs

? Design tokens & variables CSS

:root {
    /* Couleurs */
    --clr-primary:   #1A5276;  /* Bleu principal */
    --clr-secondary: #2980B9;  /* Bleu clair */
    --clr-accent:    #D4AC0D;  /* Or / accent */
    --clr-text:      #2C3E50;  /* Texte principal */
    --clr-bg:        #FDFEFE;  /* Fond clair */
    --clr-white:     #FFFFFF;
    --clr-green:     #25D366;  /* WhatsApp */
    
    /* Dimensions & effets */
    --radius: 8px;
    --shadow: 0 2px 16px rgba(0,0,0,0.10);
    --container: 1200px;
    --transition: 0.3s ease;
    
    /* Typographie */
    --font-main: 'Segoe UI', Arial, sans-serif;
}

/* Breakpoints responsive */
@media (max-width: 1024px) { /* Tablettes */ }
@media (max-width: 768px)  { /* Mobile */ }
@media (max-width: 480px)  { /* Très petits écrans */ }

?? Custom Post Types (CPT)

CPT
Slug archive
Supports
Metaboxes personnalisées
Formation
formations
title, editor, thumbnail, excerpt
_dsj_duree, _dsj_prix, _dsj_niveau, _dsj_places, _dsj_wa_link
Hébergement
hebergements
title, editor, thumbnail, excerpt
_dsj_capacite, _dsj_prix_nuit, _dsj_dispo, _dsj_equipements
Galerie
galerie
title, thumbnail, excerpt
Taxonomie categorie_galerie (Formation, Hébergement, Événements, Équipe)
Exemple d'utilisation dans un template :

<?php
// Récupérer métadonnées formation
$duree = get_post_meta(get_the_ID(), '_dsj_duree', true);
$prix  = get_post_meta(get_the_ID(), '_dsj_prix', true);
?>
<p>? <?php echo esc_html($duree); ?> ? <?php echo esc_html($prix); ?></p>

?? Options Customizer (Apparence > Personnaliser)

Section
Paramètres
Usage
? Statistiques Hero
3 stats (nombre + label)
Chiffres clés affichés sur l'accueil
? Contact & WhatsApp
numéro WhatsApp, téléphone, email
Liens contact + boutons WhatsApp pré-remplis
? Couleurs
primaire (bleu), accent (or)
Personnalisation thème sans code
? Appel à l'action
titre, texte, lien bouton
Section CTA "Nous Soutenir"
? Mission (À propos)
3 cartes (titre, texte, image)
Section mission sur page À propos
? Équipe (À propos)
3 membres (nom, fonction, description, photo)
Présentation équipe dirigeante
Exemple d'appel dans un template :

<?php echo esc_html(get_theme_mod('stat1_nb', '2022')); ?>

? Widgets personnalisés
Zone disponible : hero-area (Bandeau principal)
Widget : ? Bandeau Hero DSJ (DSJ_Hero_Widget)
Paramètres : badge, titre principal, sous-titre, image de fond, opacité, 2 boutons (texte + lien)
Usage : Alternative au hero PHP pour plus de flexibilité (optionnel)
? Formulaires sécurisés
Formulaire
Action WordPress
Destinataire
Nonce
Contact
admin-post.php?action=dsj_contact_form
centredsj@gmail.com
dsj_contact_nonce
Réservation
admin-post.php?action=dsj_reservation_form
centredsj@gmail.com
dsj_reservation_nonce
Sécurité implémentée :
? Vérification nonce WordPress
? Sanitization des entrées (sanitize_text_field, sanitize_textarea_field)
? Redirections sécurisées (wp_safe_redirect)
? Logging des erreurs (error_log)
? Fonctions helpers disponibles

// Dans functions.php ou fichier dédié
function dsj_get_whatsapp() {
    return get_theme_mod('whatsapp', '22666605890');
}
function dsj_get_email() {
    return get_theme_mod('dsj_email', 'centredsj@gmail.com');
}
function dsj_get_phone() {
    return get_theme_mod('dsj_phone', '(+226) 20 97 28 97');
}

// Usage dans un template :
<a href="https://wa.me/<?php echo dsj_get_whatsapp(); ?>">WhatsApp</a>

? Workflow déploiement Pantheon

# 1. Développer en local (LocalWP)
# 2. Copier thème vers repo Pantheon local
$source = "C:\Users\ifbbu\Local Sites\college-filles-bf\app\public\wp-content\themes\college-filles-bf"
$dest   = "C:\Users\ifbbu\Desktop\domaine-saint-joseph\wp-content\themes\college-filles-bf"
Get-ChildItem -Path $source -Recurse |
    Where-Object { $_.FullName -notlike "*\.git*" } |
    ForEach-Object {
        $destPath = $_.FullName.Replace($source, $dest)
        if ($_.PSIsContainer) { New-Item -ItemType Directory -Force -Path $destPath | Out-Null }
        else { Copy-Item -Path $_.FullName -Destination $destPath -Force }
    }

# 3. Pantheon Dashboard ? Dev ? Connection Mode ? Git
# 4. Commit et push
cd C:\Users\ifbbu\Desktop\domaine-saint-joseph
git add wp-content/themes/college-filles-bf/
git commit -m "feat: description des changements"
git push origin master

# 5. Déploiement Dev ? Live via Dashboard Pantheon

?? Règles Pantheon importantes

1. wp-content/uploads/ ? JAMAIS dans Git ? Utiliser SFTP WinSCP ? /files/
2. Avant git push     ? Dashboard ? Connection Mode ? Git
3. Pour plugins WP    ? Dashboard ? Connection Mode ? SFTP (si nécessaire)
4. Ne pas modifier    ? pantheon.upstream.yml, wp-config-pantheon.php
5. DB export local    ? mysqldump -u root -proot -h 127.0.0.1 -P 10005 local > backup.sql
6. DB import Pantheon ? Dashboard ? Database/Files ? Import
7. Search-replace URL ? Better Search Replace plugin dans wp-admin (après import)
8. Cache Pantheon     ? Dashboard ? Clear Cache après déploiement

? Configuration SSH
Clés SSH sur cette machine (Windows)

Emplacement : C:\Users\ifbbu\.ssh\
Clé privée  : id_ed25519 (JAMAIS partager/commmiter)
Clé publique: id_ed25519.pub (peut être partagée)
Type        : ED25519
Email       : ifbburkina@gmail.com

Clé publique enregistrée sur Pantheon

dashboard.pantheon.io ? profil ? Personal Settings ? SSH Keys
? Ajouter id_ed25519.pub

Pour un nouveau développeur qui rejoint le projet :

# 1. Générer sa propre clé SSH
ssh-keygen -t ed25519 -C "son-email@gmail.com"

# 2. Copier sa clé publique
Get-Content C:\Users\[son-nom]\.ssh\id_ed25519.pub | Set-Clipboard

# 3. L'ajouter sur Pantheon (Dashboard ? profil ? SSH Keys)

# 4. Tester la connexion Git
git clone ssh://codeserver.dev.c1012814-a224-44ec-9f3a-76530cc929a5@codeserver.dev.c1012814-a224-44ec-9f3a-76530cc929a5.drush.in:2222/~/repository.git

# 5. Configurer WinSCP (SFTP)
Protocole  : SFTP
Hôte       : appserver.dev.c1012814-a224-44ec-9f3a-76530cc929a5.drush.in
Port       : 2222
Auth       : Fichier de clé (id_ed25519)
Utilisateur: dev.c1012814-a224-44ec-9f3a-76530cc929a5

? Rôles utilisateurs
Rôle "soeur" (créé à l'activation du thème)

// Permissions accordées :
- read, edit_posts, publish_posts, upload_files
- edit_formation, edit_published_formation, publish_formation
- edit_hebergement, edit_published_hebergement, publish_hebergement
// Permissions refusées :
- manage_options, edit_plugins, edit_themes, delete_users, etc.

Guide rapide pour les s?urs
Action
Chemin WordPress
Fréquence
?? Changer photo hero
Pages ? Accueil ? Modifier ? Image mise en avant
Mensuel
? Modifier stats hero
Apparence ? Personnaliser ? ? Statistiques
Trimestriel
? Mettre à jour contacts
Apparence ? Personnaliser ? ? Contact
Si changement
? Ajuster couleurs
Apparence ? Personnaliser ? ? Couleurs
Optionnel
? Ajouter formation
Formations ? Ajouter ? Remplir titre/métadonnées
À chaque rentrée
? Ajouter hébergement
Hébergements ? Ajouter ? Type/capacité/prix
Si rénovation
?? Ajouter photo galerie
Galerie ? Ajouter ? Image + catégorie
Régulier
?? Modifier texte page
Pages ? [Nom] ? Modifier (Gutenberg)
Au besoin
? Astuce : Toujours vider le cache navigateur (Ctrl+F5) après une modification majeure.
? Dépannage rapide
Problème
Solution probable
Menu mobile n'apparaît pas
Vérifier CSS .nav-menu.is-open { display: flex !important; } dans main.css
Bouton WhatsApp rond sur mobile
Modifier media query @media (max-width: 768px) pour .btn-whatsapp
Erreur classe DSJ_Hero_Widget
Le widget est dans inc/widgets.php ? vérifier qu'il est bien inclus dans functions.php
Images galerie ne chargent pas
Vérifier tailles d'images (add_image_size) et régénérer via plugin "Regenerate Thumbnails"
Formulaire ne fonctionne pas
Vérifier nonce, action admin-post.php, et logs d'erreur WordPress
Customizer options non affichées
Vérifier que customizer.php est bien inclus dans functions.php
CPT n'apparaît pas dans menu
Vérifier register_post_type dans inc/cpt.php et flush rewrite rules (flush_rewrite_rules())
? Dépendances et compatibilité

WordPress : 6.5+ (testé jusqu'à 6.9)
PHP       : 7.4+ (recommandé 8.0+)
MySQL     : 5.7+ ou MariaDB 10.3+
Navigateurs : Chrome, Firefox, Safari, Edge (dernières versions)
Mobile    : Android 8+, iOS 12+ (optimisé 3G)

Plugins requis : AUCUN (100% code natif WordPress)

??? Développement : ajouter une fonctionnalité
Ajouter une nouvelle section dans Customizer
Dans inc/customizer.php, à l'intérieur de dsj_customize_register() :

$wp_customize->add_section('ma_section', [
    'title' => 'Ma section',
    'priority' => 100,
]);
$wp_customize->add_setting('mon_setting', [
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'refresh',
]);
$wp_customize->add_control('mon_setting', [
    'label' => 'Mon champ',
    'section' => 'ma_section',
    'type' => 'text',
]);

Ajouter un nouveau champ metabox pour un CPT
Dans inc/metaboxes.php :
php

// 1. Ajouter le champ dans le formulaire
<input type="text" name="mon_champ" value="<?php echo esc_attr(get_post_meta($post->ID, '_mon_champ', true)); ?>">

// 2. Ajouter la sauvegarde dans dsj_save_meta()
if (isset($_POST['mon_champ'])) {
    update_post_meta($post_id, '_mon_champ', sanitize_text_field($_POST['mon_champ']));
}

// 3. Afficher dans le template
echo esc_html(get_post_meta(get_the_ID(), '_mon_champ', true));

Ajouter un nouveau CPT
Dans inc/cpt.php :


register_post_type('mon_cpt', [
    'labels' => ['name' => 'Mes éléments', 'singular_name' => 'Mon élément'],
    'public' => true,
    'supports' => ['title', 'editor', 'thumbnail'],
    'menu_icon' => 'dashicons-admin-page',
    'show_in_rest' => false, // Éditeur classique pour simplicité
]);

? Contacts projet
Client    : S?urs Travailleuses Missionnaires de l'Immaculée
Email     : centredsj@gmail.com
WhatsApp  : +226 66 60 58 90
Adresse   : Secteur 25, Bobo-Dioulasso, Burkina Faso

Développeur : ifbburkina@gmail.com - Yoda lassina

