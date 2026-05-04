<?php
/*
Template Name: Maison d'Accueil
*/
get_header(); ?>

<section class="page-header">
    <div class="container">
        <h1>Maison d'Accueil</h1>
        <p class="page-subtitle">Un lieu de repos, de ressourcement et de rencontres</p>
    </div>
</section>

<section class="chambres section-padding">
    <div class="container">
        <h2 class="text-center">Nos Chambres</h2>
        <div class="grid-3">
            <!-- Chambre 1 lit -->
            <article class="card-chambre">
                <div class="chambre-badge">1 lit</div>
                <h3>Chambre Simple</h3>
                <p>Ventilée, lit confortable, bureau, salle d'eau privative.</p>
                <p class="prix">À partir de 8 000 F CFA / nuit</p>
            </article>

            <!-- Chambre 2 lits -->
            <article class="card-chambre">
                <div class="chambre-badge">2 lits</div>
                <h3>Chambre Double</h3>
                <p>Ventilée ou climatisée, 2 lits, espace de travail, salle d'eau.</p>
                <p class="prix">À partir de 12 000 F CFA / nuit</p>
            </article>

            <!-- Chambre 3 lits -->
            <article class="card-chambre">
                <div class="chambre-badge">3 lits</div>
                <h3>Chambre Familiale</h3>
                <p>Climatisée, 3 lits, coin détente, salle d'eau, idéale pour familles.</p>
                <p class="prix">À partir de 18 000 F CFA / nuit</p>
            </article>
        </div>
    </div>
</section>

<!-- Équipements -->
<section class="equipements bg-light section-padding">
    <div class="container">
        <h2 class="text-center">Équipements & Services</h2>
        <div class="grid-4">
            <div class="equip-item">🍽️ Restauration sur demande</div>
            <div class="equip-item">📶 Wi-Fi gratuit</div>
            <div class="equip-item">⛪ Chapelle sur place</div>
            <div class="equip-item">🚗 Parking sécurisé</div>
            <div class="equip-item">👥 Salles de conférence</div>
            <div class="equip-item">🧺 Blanchisserie</div>
            <div class="equip-item">🚑 Infirmerie de proximité</div>
            <div class="equip-item">🙏 Accompagnement spirituel</div>
        </div>
    </div>
</section>

<!-- Formulaire de réservation simplifié -->
<section class="reservation section-padding">
    <div class="container">
        <h2 class="text-center">Demander une Réservation</h2>
        <form class="form-reservation" action="<?php echo esc_url( home_url( '/contact' ) ); ?>" method="get">
            <div class="grid-2">
                <div>
                    <label for="nom">Nom complet *</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div>
                    <label for="email">Email ou Téléphone *</label>
                    <input type="text" id="contact" name="contact" required>
                </div>
            </div>
            <div class="grid-3">
                <div>
                    <label for="arrivee">Arrivée *</label>
                    <input type="date" id="arrivee" name="arrivee" required>
                </div>
                <div>
                    <label for="depart">Départ *</label>
                    <input type="date" id="depart" name="depart" required>
                </div>
                <div>
                    <label for="type">Type de chambre</label>
                    <select id="type" name="type">
                        <option value="">Au choix</option>
                        <option value="simple">Simple (1 lit)</option>
                        <option value="double">Double (2 lits)</option>
                        <option value="familiale">Familiale (3 lits)</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="message">Besoins particuliers</label>
                <textarea id="message" name="message" rows="3" placeholder="Ex: régime alimentaire, accès PMR..."></textarea>
            </div>
            <p class="text-center">
                <button type="submit" class="btn btn-primary">Envoyer ma demande</button>
            </p>
            <p class="text-center small">
                <small>Nous vous répondrons sous 48h par WhatsApp ou email.</small>
            </p>
        </form>
    </div>
</section>

<?php get_footer(); ?>