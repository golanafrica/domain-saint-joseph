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
## [1.2.0] - 2026-08-30 — Production Ready

### 🎯 Accessibilité WCAG 2.1 AA
- **aria-live** sur toutes les alertes de formulaires (contact, restaurant, maison-accueil)
- **iframe Google Maps** avec title descriptif (WCAG 4.1.2)
- **Bandeau d'urgence** : pause au hover/focus (WCAG 2.2.2)
- **Validation contraste** temps réel dans le Customizer (ratio 4.5:1 minimum)
- **aria-label** sur tous les liens d'images (formations, hébergements, galerie, restaurant)
- **alt=""** sur images avec overlay texte visible
- **Slider dots** : target-size 24px (WCAG 2.5.8)
- **1 seul `<main>`** par page (landmark-one-main corrigé)
- **aria-hidden** sur emojis décoratifs
- **role="alert"** et aria-live sur messages formulaires

### 🚀 Performance 3G (Burkina Faso)
- Logo optimisé : 23 Ko → **1.8 Ko** (WebP, -92%)
- Suppression `main.css.legacy` (145 Ko, 4417 lignes)
- Concaténation CSS : 12 fichiers → 1 requête HTTP
- JavaScript : TBT 5170ms → **0ms** (Forced Reflow éliminé)
- Preload LCP dynamique
- Lazy loading natif + decoding="async"

### 🔒 Sécurité
- Honeypot + rate limiting (15/h adapté NAT)
- Nonces CSRF sur 3 formulaires
- Sanitization/escaping systématique (wp_unslash + sanitize_text_field)
- Messages enregistrés en CPT privé avant envoi
- Validation contraste empêche les couleurs illisibles
- Couleurs Customizer avec !important (override cache CSS)

### 📚 Documentation
- `GUIDE_SOEURS.md` complet
- README avec procédures
- CHANGELOG détaillé
- Commentaires de phase dans le code

### 🏗️ Architecture
- 6 CPT (formation, hébergement, galerie, menu, témoignage, message privé)
- 3 formulaires sécurisés avec handlers unifiés
- Dashboard admin simplifié pour les sœurs
- Customizer riche avec preview temps réel