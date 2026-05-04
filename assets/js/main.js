document.addEventListener('DOMContentLoaded', function () {

    // ── Menu burger mobile ──
    const toggle = document.querySelector('.menu-toggle');
    const nav    = document.querySelector('.nav-menu');

    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            nav.classList.toggle('is-open');
            toggle.setAttribute(
                'aria-expanded',
                nav.classList.contains('is-open')
            );
        });
    }

    // ── Fermer le menu si on clique ailleurs ──
    document.addEventListener('click', function (e) {
        if (nav && toggle && !nav.contains(e.target) && !toggle.contains(e.target)) {
            nav.classList.remove('is-open');
        }
    });

});


// ── Pré-remplissage WhatsApp par filière (optionnel) ──
document.querySelectorAll('.btn-outline[data-filiere]').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        // Optionnel : ouvrir WhatsApp avec message pré-rempli si l'utilisateur préfère
        // e.preventDefault();
        // const filiere = this.getAttribute('data-filiere');
        // const msg = encodeURIComponent(`Bonjour, je souhaite m'inscrire en ${filiere}. Merci !`);
        // window.open(`https://wa.me/22666605890?text=${msg}`, '_blank');
    });
});