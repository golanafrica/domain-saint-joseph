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

// ── Galerie : Filtres + Lightbox + Lazy Load ──
document.addEventListener('DOMContentLoaded', function () {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.querySelector('.lightbox-img');
    const lightboxCaption = document.querySelector('.lightbox-caption');
    const lightboxClose = document.querySelector('.lightbox-close');
    const lightboxPrev = document.querySelector('.lightbox-nav.prev');
    const lightboxNext = document.querySelector('.lightbox-nav.next');
    let currentIndex = 0;
    let visibleItems = [];

    // 1. Filtres de catégorie
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            // Mise à jour des boutons actifs
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');
            visibleItems = [];

            galleryItems.forEach(item => {
                const category = item.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    item.style.display = 'block';
                    visibleItems.push(item);
                } else {
                    item.style.display = 'none';
                }
            });

            // Message si vide
            const emptyMsg = document.querySelector('.gallery-empty');
            if (visibleItems.length === 0 && emptyMsg) {
                emptyMsg.style.display = 'block';
            } else if (emptyMsg) {
                emptyMsg.style.display = 'none';
            }
        });
    });

    // 2. Lazy Load des images (Intersection Observer)
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    const src = img.getAttribute('data-src');
                    if (src) {
                        img.src = src;
                        img.removeAttribute('data-src');
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                }
            });
        }, { rootMargin: '100px' });

        document.querySelectorAll('img.lazy').forEach(img => observer.observe(img));
    }

    // 3. Lightbox : Ouvrir
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', function () {
            const img = this.querySelector('img');
            const caption = this.querySelector('figcaption p')?.textContent || '';
            
            lightboxImg.src = img.src;
            lightboxImg.alt = img.alt;
            lightboxCaption.textContent = caption;
            lightbox.classList.add('active');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden'; // Bloquer le scroll
            
            currentIndex = visibleItems.indexOf(item);
        });
    });

    // 4. Lightbox : Fermer
    function closeLightbox() {
        lightbox.classList.remove('active');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        lightboxImg.src = '';
    }
    lightboxClose?.addEventListener('click', closeLightbox);
    lightbox?.addEventListener('click', function(e) {
        if (e.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && lightbox.classList.contains('active')) {
            closeLightbox();
        }
        if (lightbox.classList.contains('active')) {
            if (e.key === 'ArrowLeft') showPrev();
            if (e.key === 'ArrowRight') showNext();
        }
    });

    // 5. Lightbox : Navigation
    function showPrev() {
        if (visibleItems.length === 0) return;
        currentIndex = (currentIndex - 1 + visibleItems.length) % visibleItems.length;
        updateLightboxContent();
    }
    function showNext() {
        if (visibleItems.length === 0) return;
        currentIndex = (currentIndex + 1) % visibleItems.length;
        updateLightboxContent();
    }
    function updateLightboxContent() {
        const item = visibleItems[currentIndex];
        if (!item) return;
        const img = item.querySelector('img');
        const caption = item.querySelector('figcaption p')?.textContent || '';
        lightboxImg.src = img.src;
        lightboxImg.alt = img.alt;
        lightboxCaption.textContent = caption;
    }
    lightboxPrev?.addEventListener('click', showPrev);
    lightboxNext?.addEventListener('click', showNext);
});