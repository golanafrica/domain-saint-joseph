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

## [1.1.0] - 2026-08-29
### Added
- Concaténation CSS automatique (12 fichiers → 1)
- Slider dots accessibles (target-size 24px)
- Logo optimisé en WebP (1.8 Ko)
- Page maison-accueil entièrement accessible (aria-label, role=alert)

### Fixed
- Double balise <main> corrigée sur toutes les pages
- Alt redondants sur images avec overlay
- Contraste bouton WhatsApp (WCAG AAA)
- Fichier main.css.legacy supprimé

### Performance
- TBT : 5170ms → 0ms (Forced Reflow éliminé)
- Requête CSS : 12 → 1
- Logo : 23 Ko → 1.8 Ko (WebP)