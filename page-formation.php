<?php
/*
Template Name: Formation Technique
*/
get_header(); ?>

<!-- HERO SECTION -->
<section class="page-header">
    <div class="container">
        <h1>Nos Filières de Formation</h1>
        <p class="page-subtitle">Des compétences concrètes pour l'autonomie des jeunes filles</p>
    </div>
</section>

<!-- FILIÈRES -->
<section class="formations-list section-padding">
    <div class="container">
        <div class="grid-3">
            <!-- Couture & Mode -->
            <article class="card-formation">
                <div class="card-icon">🧵</div>
                <h3>Couture & Mode</h3>
                <ul>
                    <li>Techniques de coupe et assemblage</li>
                    <li>Stylisme et création de modèles</li>
                    <li>Gestion d'un atelier de couture</li>
                </ul>
                <p class="prix">🎓 6 mois • 45 000 F CFA</p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?filiere=couture" 
                   class="btn btn-outline" 
                   data-filiere="Couture & Mode">
                    S'inscrire →
                </a>
                <a href="https://wa.me/22666605890?text=Bonjour,%20je%20souhaite%20m'inscrire%20en%20Couture%20%26%20Mode.%20Merci!" 
                   class="btn-whatsapp-small" 
                   target="_blank" 
                   rel="noopener">
                    💬 WhatsApp
                </a>
            </article>

            <!-- Informatique -->
            <article class="card-formation">
                <div class="card-icon">💻</div>
                <h3>Informatique</h3>
                <ul>
                    <li>Bureautique (Word, Excel, PowerPoint)</li>
                    <li>Initiation à la programmation</li>
                    <li>Création de contenu numérique</li>
                </ul>
                <p class="prix">🎓 9 mois • 60 000 F CFA</p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?filiere=informatique" 
                   class="btn btn-outline"
                   data-filiere="Informatique">
                    S'inscrire →
                </a>
                <a href="https://wa.me/22666605890?text=Bonjour,%20je%20souhaite%20m'inscrire%20en%20Informatique.%20Merci!" 
                   class="btn-whatsapp-small" 
                   target="_blank" 
                   rel="noopener">
                    💬 WhatsApp
                </a>
            </article>

            <!-- Entrepreneuriat -->
            <article class="card-formation">
                <div class="card-icon">🚀</div>
                <h3>Entrepreneuriat</h3>
                <ul>
                    <li>Élaboration de business plan</li>
                    <li>Gestion financière de base</li>
                    <li>Marketing digital pour TPE</li>
                </ul>
                <p class="prix">🎓 6 mois • 50 000 F CFA</p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>?filiere=entrepreneuriat" 
                   class="btn btn-outline"
                   data-filiere="Entrepreneuriat">
                    S'inscrire →
                </a>
                <a href="https://wa.me/22666605890?text=Bonjour,%20je%20souhaite%20m'inscrire%20en%20Entrepreneuriat.%20Merci!" 
                   class="btn-whatsapp-small" 
                   target="_blank" 
                   rel="noopener">
                    💬 WhatsApp
                </a>
            </article>
        </div>
    </div>
</section>

<!-- TÉMOIGNAGES -->
<section class="temoignages section-padding bg-light">
    <div class="container">
        <h2 class="text-center">Elles témoignent</h2>
        <div class="grid-2">
            <blockquote class="card-temoignage">
                <p>"Grâce à la formation en couture, j'ai pu ouvrir mon propre atelier. Je suis fière de subvenir aux besoins de ma famille."</p>
                <footer>— Aïssa, promotion 2024</footer>
            </blockquote>
            <blockquote class="card-temoignage">
                <p>"L'informatique m'a donné confiance en moi. Aujourd'hui, je gère la comptabilité d'une petite entreprise."</p>
                <footer>— Fatou, promotion 2023</footer>
            </blockquote>
        </div>
    </div>
</section>

<!-- INFOS PRATIQUES -->
<section class="infos-pratiques section-padding">
    <div class="container">
        <h2 class="text-center">Informations Pratiques</h2>
        <div class="grid-3">
            <div class="info-item">
                <span class="info-icon">📅</span>
                <h4>Durée</h4>
                <p>6 à 12 mois selon la filière, avec stages pratiques inclus.</p>
            </div>
            <div class="info-item">
                <span class="info-icon">💰</span>
                <h4>Paiement</h4>
                <p>Échelonné possible. Bourses d'excellence sur critères sociaux.</p>
            </div>
            <div class="info-item">
                <span class="info-icon">📜</span>
                <h4>Certification</h4>
                <p>Attestation de fin de formation reconnue localement.</p>
            </div>
        </div>
        <p class="text-center" style="margin-top: 2rem;">
            <a href="#" class="btn btn-primary" onclick="alert('Brochure en préparation — contactez-nous par WhatsApp !'); return false;">
                📥 Télécharger la brochure (PDF)
            </a>
        </p>
    </div>
</section>

<!-- CTA FINAL -->
<section class="cta-final section-padding" style="background: var(--clr-primary); color: var(--clr-white); text-align: center;">
    <div class="container">
        <h2>Prête à commencer votre formation ?</h2>
        <p style="margin: 1rem 0 2rem; opacity: 0.95;">Contactez-nous dès aujourd'hui pour réserver votre place.</p>
        <div class="hero-cta" style="justify-content: center;">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-secondary">
                Formulaire d'inscription
            </a>
            <a href="https://wa.me/22666605890?text=Bonjour,%20je%20souhaite%20des%20informations%20sur%20les%20formations.%20Merci!" 
               class="btn" 
               style="background: #25D366; color: white;"
               target="_blank" 
               rel="noopener">
                💬 WhatsApp direct
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>