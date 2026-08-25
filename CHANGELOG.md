# Changelog

Toutes les modifications notables du thème Domaine Saint Joseph.

## [Phase 8] - 2026-08-25

### 🎨 CSS
- Découpage modulaire : 1 fichier (4700 lignes) → 12 fichiers thématiques (150-700 lignes)
- Cache-busting individuel par fichier CSS via `filemtime()`
- Suppression de `main.css` monolithique (remplacé par 12 modules)
- Correction image single formation (plus de débordement)

### 🔒 Sécurité
- Coordonnées dynamiques via `dsj_get_phone/whatsapp/email()`
- Échappement complet des `theme_mod` (esc_html/esc_attr/wp_kses_post)
- Fail-closed sur handlers de formulaires
- Validation longueur messages (5000 caractères max)
- URLs de redirection dynamiques (referer → slug → accueil)
- Blocage serveur de `nav-menus.php` pour les non-admins

### 🏗️ Architecture
- Unification du Hero page d'accueil (slider Customizer uniquement)
- Suppression du widget `hero-area` obsolète
- Extraction template-parts : `hero-slider.php`, `hero-default.php`
- Heroes pages internes conservés inline (simples, pas de duplication)

### 👥 Expérience Sœurs
- Admin simplifié (menus cachés, dashboard épuré)
- Widget "Que faire aujourd'hui ?" avec raccourcis
- Onglets d'aide contextuelle par CPT
- Notifications champs manquants à la publication

### 🐛 Corrections
- Slug `theme-install.php` corrigé (était `theme-installer`)
- Cache-busting sur `widget-uploader.js`
- Restriction admin scripts aux pages widgets/customizer