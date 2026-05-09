

```markdown
# Domaine Saint Joseph - Thème WordPress

## 📋 Contexte du projet

**Client** : Sœurs Travailleuses Missionnaires de l'Immaculée  
**Lieu** : Bobo-Dioulasso, Burkina Faso  
**Objectif** : Site vitrine pour centre de formation technique et maison d'accueil  

**Contraintes** :
- Aucun plugin externe (100% code natif)
- Interface d'administration simple pour les sœurs
- Modifiable via Apparence > Personnaliser et Apparence > Widgets

---

## 🗂️ Structure du thème

```
college-filles-bf/
├── inc/
│   ├── cpt.php              # Custom Post Types
│   ├── customizer.php       # Options du thème (stats, couleurs, mission, équipe)
│   ├── metaboxes.php        # Champs personnalisés formations/hébergements
│   └── widgets.php          # Widget hero personnalisable
├── assets/
│   ├── css/
│   │   └── main.css         # Styles complets
│   └── js/
│       ├── main.js          # JavaScript principal (menu, animations, galerie)
│       └── widget-uploader.js # Uploader d'images pour widget
├── template-parts/          # (réservé pour futures extensions)
├── front-page.php           # Page d'accueil
├── page-formation.php       # Page formations
├── single-formation.php     # Détail formation
├── page-maison-accueil.php  # Page hébergements
├── single-hebergement.php   # Détail hébergement
├── archive-hebergement.php  # Archive hébergements
├── page-a-propos.php        # Page À propos (mission + équipe)
├── page-contact.php         # Page contact (formulaire)
├── page-galerie.php         # Page galerie (filtres + lightbox)
├── header.php               # En-tête (menu mobile géré)
├── footer.php               # Pied de page
├── functions.php            # Configuration principale
└── style.css               # En-tête du thème
```

---

## 🎨 Custom Post Types

| CPT | Slug | Supports | Metaboxes |
|-----|------|----------|-----------|
| Formation | `formations` | title, editor, thumbnail, excerpt | durée, prix, niveau, places, formateur, horaires |
| Hébergement | `hebergements` | title, editor, thumbnail, excerpt | capacité, prix/nuit, disponibilité, équipements |
| Galerie | `galerie` | title, thumbnail, excerpt | catégories (taxonomie) |

---

## 🎛️ Options Customizer

| Section | Paramètres |
|---------|-----------|
| 📊 Statistiques Hero | 3 stats (nombre + label) |
| 📞 Contact & WhatsApp | numéro, téléphone, email |
| 🎨 Couleurs | primaire (bleu), secondaire (or) |
| 🎯 Appel à l'action | titre, texte, lien bouton |
| 🎯 Mission (À propos) | 3 cartes (titre, texte, image) |
| 👥 Équipe (À propos) | 3 membres (nom, fonction, description, photo) |

---

## 📱 Widgets disponibles

**Zone Hero - Bandeau principal** (`hero-area`) :
- Widget `🌟 Bandeau Hero DSJ`
- Paramètres : badge, titre, sous-titre, image de fond, opacité, 2 boutons

---

## 🎨 Couleurs du thème

```css
--clr-primary: #1A5276;  /* Bleu principal */
--clr-accent: #D4AC0D;   /* Or / accent */
```

---

## 📝 Formulaires

| Formulaire | Action | Destinataire |
|------------|--------|--------------|
| Contact | `admin-post.php?action=dsj_contact_form` | centredsj@gmail.com |
| Réservation | `admin-post.php?action=dsj_reservation_form` | centredsj@gmail.com |

**Nonces utilisés** : `dsj_contact_nonce`, `dsj_reservation_nonce`

---

## 🔧 Fonctions helpers disponibles

```php
dsj_get_whatsapp()  // Retourne le numéro WhatsApp
dsj_get_email()     // Retourne l'email de contact
dsj_get_phone()     // Retourne le téléphone
```

---

## 📱 Menu mobile

- Breakpoint : `768px`
- Bouton burger `.menu-toggle`
- Menu `.nav-menu` avec classe `.is-open` pour affichage
- Animation CSS incluse

---

## 🖼️ Tailles d'images

| Nom | Dimensions | Utilisation |
|-----|-----------|-------------|
| hero-size | 1920x600 | Bandeau hero |
| card-thumb | 400x300 | Cartes formations/hébergements |
| gallery-thumb | 300x300 | Miniatures galerie |

---

## 👤 Rôle utilisateur

Un rôle `soeur` est créé automatiquement à l'activation du thème avec les droits :
- Lecture et édition des publications
- Upload de fichiers
- Gestion des CPT (formations, hébergements)

---

## 🚀 Instructions pour les sœurs

### Modifier le bandeau hero
1. Apparence > Widgets
2. Zone Hero > Ajouter "Bandeau Hero DSJ"
3. Remplir les champs

### Modifier les statistiques
1. Apparence > Personnaliser > Statistiques Hero

### Modifier les missions / équipe
1. Apparence > Personnaliser > Mission / Équipe

### Ajouter une formation
1. Formations > Ajouter

### Ajouter un hébergement
1. Hébergements > Ajouter

### Ajouter une photo à la galerie
1. Galerie > Ajouter

---

## 🐛 Problèmes connus et solutions

| Problème | Solution |
|----------|----------|
| Menu mobile n'apparaît pas | Vérifier CSS `.nav-menu.is-open { display: flex !important; }` |
| Bouton WhatsApp rond | Modifier media query `@media (max-width: 768px)` |
| Erreur classe DSJ_Hero_Widget | Le widget est dans `inc/widgets.php`, ne pas le dupliquer |
| Images galerie ne chargent pas | Vérifier les tailles d'images et régénérer |

---

## 📦 Dépendances

- WordPress 6.0+
- PHP 7.4+
- Pas de plugins requis

---

## 👨‍💻 Développement

### Fichiers de configuration principaux

| Fichier | Rôle |
|---------|------|
| `functions.php` | Inclusion des modules, assets, formulaires |
| `inc/cpt.php` | Déclaration des CPT et taxonomies |
| `inc/customizer.php` | Toutes les options personnalisables |
| `inc/metaboxes.php` | Champs supplémentaires pour CPT |
| `inc/widgets.php` | Widgets personnalisés |

### Ajouter une nouvelle section dans Customizer

Dans `inc/customizer.php`, ajouter à l'intérieur de `dsj_customize_register()` :

```php
$wp_customize->add_section( 'ma_section', [
    'title' => 'Ma section',
    'priority' => 100,
] );

$wp_customize->add_setting( 'mon_setting', [ 'default' => '' ] );
$wp_customize->add_control( 'mon_setting', [
    'label' => 'Mon champ',
    'section' => 'ma_section',
    'type' => 'text',
] );
```

---

## 📄 Licence

GPL v2 ou ultérieure

---

## 📅 Historique

| Date | Version | Modifications |
|------|---------|---------------|
| 05/2026 | 1.0 | Version initiale complète |

---

**Pour toute question, contacter le développeur.** 🎯
```

## ✅ **Avantages de ce fichier**

1. **Pour vous** : mémoire complète du projet
2. **Pour un autre développeur** : reprend facilement le code
3. **Pour moi (dans un nouveau chat)** : je peux lire ce fichier et comprendre tout le projet
4. **Pour les sœurs** : documentation simple des modifications possibles

## 📝 **Comment l'utiliser**

Au début d'un nouveau chat, vous pourrez simplement écrire :

> "Voici le contexte de mon projet : [copier-coller le CONTEXT.md]"

Ou joindre le fichier si la plateforme le permet.

Voulez-vous que j'ajoute d'autres informations à ce fichier ?