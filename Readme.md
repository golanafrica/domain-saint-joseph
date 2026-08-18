markdown
# ?? Domaine Saint Joseph ? Thème WordPress

**Centre de formation technique & Maison d'accueil**  
? Secteur 25, Bobo-Dioulasso, Burkina Faso  
? Inspiré de l'architecture de Roussel House (Kenya)

---

## ? Description

Thème WordPress personnalisé, léger et optimisé pour le **Domaine Saint Joseph**, géré par les **Travailleuses Missionnaires de l'Immaculée**.

Conçu pour fonctionner parfaitement en connexion **3G**, facilement maintenable par des **non-techniciennes**, et sans dépendance à des plugins lourds.

---

## ? Fonctionnalités clés

| Catégorie | Détails |
|-----------|---------|
| ? **Formations** | CPT dédié avec métadonnées (durée, prix, niveau, lien WhatsApp) |
| ? **Hébergements** | CPT dédié (capacité, prix/nuit, disponibilité, équipements) |
| ?? **Restaurant** | CPT "Menu" + catégories + réservation |
| ?? **Galerie** | CPT + taxonomie catégories + filtres JS + lightbox native |
| ?? **Customizer** | Stats hero, contacts, couleurs, CTA modifiables sans code |
| ? **Mobile-First** | Menu burger animé, boutons tactiles, grilles adaptatives |
| ? **Performance 3G** | CSS < 30 Ko, JS < 5 Ko, lazy loading, suppression emojis/oEmbed |
| ? **Sécurité** | Nonce WordPress, sanitization stricte, redirections sécurisées |
| ? **WhatsApp First** | Boutons flottants & liens pré-remplis pour inscriptions/dons |
| ? **Bandeau d'urgence** | Messages défilants personnalisables (parrainage, construction, dons) |

---

## ?? Stack Technique

| Outil | Version |
|-------|---------|
| CMS | WordPress 6.5+ |
| Langages | PHP 7.4+, HTML5, CSS3, Vanilla JS (ES6+) |
| Dev Local | LocalWP |
| Versioning | Git |
| Hébergement cible | Serveur PHP/MySQL standard (compatible .bf) |

---

## ? Structure du thème
college-filles-bf/
??? style.css ? Déclaration du thème
??? functions.php ? Hooks, CPT, customizer, handlers formulaires
??? header.php / footer.php
??? front-page.php ? Homepage (hero + contenu Gutenberg)
??? page.php ? Template générique
??? page-formation.php ? Liste formations
??? single-formation.php ? Détail formation
??? page-maison-accueil.php ? Hébergements + services + équipements
??? single-hebergement.php ? Détail hébergement
??? page-restaurant.php ? Carte du restaurant + réservation
??? page-nous-soutenir.php ? Appel aux dons et parrainage
??? page-galerie.php ? Galerie photos avec filtres
??? page-contact.php ? Formulaire de contact + coordonnées
??? page-a-propos.php ? Histoire, mission, valeurs, équipe
??? inc/
? ??? cpt.php ? Déclaration des CPT
? ??? customizer.php ? Options thème (stats, contact, couleurs, hero)
? ??? metaboxes.php ? Champs personnalisés CPT
? ??? widgets.php ? Widget hero personnalisable
??? assets/
??? css/main.css ? Styles optimisés & responsive
??? js/main.js ? Menu burger, galerie, lazy load, animations
??? images/ ? Assets optimisés (WebP < 200 Ko)

text

---

## ? Installation & Configuration

### 1. Environnement local

```bash
# Cloner le thème dans votre installation LocalWP
git clone <url-du-repo> wp-content/themes/college-filles-bf

# Activer le thème
Tableau de bord ? Apparence ? Thèmes ? Activer "Domaine Saint Joseph"
2. Réglages WordPress recommandés
Permaliens : Titres des publications

Fuseau horaire : Africa/Ouagadougou

Langue : Français

Page d'accueil : Créer une page "Accueil" ? Réglages ? Lecture ? Page statique ? Accueil

3. Menu principal
Apparence ? Menus ? Créer un menu "Principal" avec :

text
Accueil | Formations | Maison d'Accueil | Restaurant | À propos | Galerie | Contact | Nous Soutenir
4. Configuration des formulaires
Les formulaires (contact, réservation hébergement, réservation restaurant) envoient les emails à :

text
centredsj@gmail.com
Pour modifier ce destinataire, éditez functions.php et recherchez $to = 'centredsj@gmail.com'.

? Guide de personnalisation (Pour les s?urs)
Action	Chemin	Fréquence
?? Changer la photo du hero	Accueil ? Modifier le widget dans Apparence ? Widgets	Mensuel
? Modifier les chiffres hero	Apparence ? Personnaliser ? ? Statistiques Hero	Trimestriel
? Mettre à jour contacts	Apparence ? Personnaliser ? ? Contact & WhatsApp	Si changement
? Ajuster couleurs	Apparence ? Personnaliser ? ? Couleurs	Optionnel
? Activer bandeau d'urgence	Apparence ? Personnaliser ? ? Bandeau d'urgence	En campagne
? Ajouter une formation	Formations ? Ajouter ? Remplir titre, contenu, métadonnées	À chaque rentrée
? Ajouter un hébergement	Hébergements ? Ajouter ? Type, capacité, prix, dispo	Si rénovation/nouveauté
?? Ajouter un plat au menu	Menu Restaurant ? Ajouter ? Titre, prix, ingrédients	Saisonnière
? Ajouter une photo galerie	Galerie ? Ajouter ? Image + catégorie	Régulier
? Modifier appel aux dons	Apparence ? Personnaliser ? ? Appel à l'aide (Accueil)	Mensuel
? Astuce : Toujours vider le cache navigateur (Ctrl+F5) après une modification majeure.

? Dépannage rapide
Problème	Solution
Le menu mobile ne s'ouvre pas	Vider le cache navigateur (Ctrl+Shift+Suppr)
Les images ne s'affichent pas	Vérifier la bibliothèque médias ? régénérer les miniatures
Le formulaire de contact ne s'envoie pas	Vérifier les paramètres SMTP ou contacter l'hébergeur
La galerie est vide	Ajouter au moins une photo dans Galerie ? Ajouter
Erreur 404 sur une page	Réglages ? Permaliens ? Enregistrer
Le bandeau d'urgence n'apparaît pas	Apparence ? Personnaliser ? Bandeau d'urgence ? Activer
? Déploiement & Migration
Préparation
bash
git checkout main
git pull
Export LocalWP
Outils ? Exporter ? Tout le contenu ? Télécharger

Sauvegarder la base via phpMyAdmin ou Adminer (bouton "DB" dans LocalWP)

Upload Production (ex: Hostinger, Pantheon)
Transférer le dossier thème via FTP/SFTP dans wp-content/themes/

Importer le fichier .xml via Outils ? Importer (ou utiliser All-in-One WP Migration)

Importer la base de données via phpMyAdmin

Régénérer les permaliens (Réglages ? Permaliens ? Enregistrer)

Post-migration
Vérifier formulaires, liens WhatsApp, affichage mobile

Activer HTTPS & cache serveur si disponible

? Performance & Optimisations 3G
Optimisation	Impact
Suppression emojis & oEmbed	-15 Ko HTML
CSS critique inliné + différé	-40% temps de rendu
loading="lazy" natif	Économie bande passante
Images WebP < 200 Ko	Chargement < 1.5s en 3G
Aucun plugin bloquant	Maintenance simplifiée
Score cible PageSpeed : ? > 85 (Mobile) / ? > 95 (Desktop)

?? Évolutions futures (prévues)
Version en langue anglaise

Calendrier interactif des formations

Blog d'actualités (actualités du centre)

Newsletter intégrée

Module de dons en ligne sécurisé

? Support & Contact technique
Pour toute assistance technique :

? Email : [ifbburkia@gmail.com]

? WhatsApp : [76619457]

Les s?urs peuvent également se référer au guide de personnalisation ci-dessus pour les modifications courantes.

? Contributeurs & Crédits
Développement : [Yoda Lassina]

Inspiration UX : Roussel House (Nairobi, Kenya)

Client : Travailleuses Missionnaires de l'Immaculée ? Domaine Saint Joseph

Remerciements : Communauté WordPress, LocalWP, Open Source

? Licence
Ce thème est distribué sous licence GPL v2 ou ultérieure.

Libre d'utilisation, modification et redistribution dans le respect de la mission éducative et sociale du Domaine Saint Joseph.

?? Former les jeunes filles, accueillir avec compassion.

Dernière mise à jour : Mai 2026 | Version : 1.0.0

? Instructions d'utilisation rapide
Copiez ce contenu dans un fichier README.md à la racine du thème

Adaptez <url-du-repo> et [Votre Nom/Agence] si nécessaire

Committez :

bash
git add README.md
git commit -m "docs: ajout README projet complet"
git push
Documentation générée pour le Domaine Saint Joseph - Bobo-Dioulasso, Burkina Faso

text

## ? **Résumé des ajouts**

| Section | Contenu ajouté |
|---------|----------------|
| ?? Restaurant | Mention du CPT Menu dans fonctionnalités |
| ? Bandeau d'urgence | Ajout dans fonctionnalités |
| ? Dépannage rapide | Tableau des problèmes et solutions |
| ?? Évolutions futures | Roadmap du projet |
| ? Support technique | Contact pour assistance |
| ? Guide de perso | Tableau des fréquences |