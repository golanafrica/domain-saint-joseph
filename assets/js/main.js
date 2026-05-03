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