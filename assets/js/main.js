// ===== MENU BURGER MOBILE =====
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            navMenu.classList.toggle('is-open');
            menuToggle.classList.toggle('active');
            const expanded = navMenu.classList.contains('is-open');
            menuToggle.setAttribute('aria-expanded', expanded);
            document.body.style.overflow = expanded ? 'hidden' : '';
        });
        
        // Fermer le menu en cliquant sur un lien
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('is-open');
                menuToggle.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }
});

// ===== INDICATEUR DE PROGRESSION =====
window.addEventListener('scroll', function() {
    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;
    const progressBar = document.querySelector('.scroll-progress');
    if (progressBar) {
        progressBar.style.width = scrolled + '%';
    }
});

// ===== ANIMATION DES COMPTEURS =====
function animateCounters() {
    const statNumbers = document.querySelectorAll('.stat-number[data-count]');
    statNumbers.forEach(stat => {
        const target = stat.getAttribute('data-count');
        if (target && !stat.classList.contains('animated')) {
            const value = parseInt(target);
            if (!isNaN(value)) {
                stat.classList.add('animated');
                let current = 0;
                const increment = value / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= value) {
                        stat.textContent = target;
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(current);
                    }
                }, 20);
            }
        }
    });
}

// Observer pour les statistiques
const observerOptions = {
    threshold: 0.3,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounters();
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

const statsSection = document.querySelector('.stats-section');
if (statsSection) {
    observer.observe(statsSection);
}

// ===== GALERIE - LIGHTBOX =====
document.addEventListener('DOMContentLoaded', function() {
    const lightboxLinks = document.querySelectorAll('.galerie-link');
    if (lightboxLinks.length) {
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.innerHTML = `
            <button class="lightbox-close">✕</button>
            <img src="" alt="">
            <div class="lightbox-caption"></div>
        `;
        document.body.appendChild(lightbox);
        
        const lightboxImg = lightbox.querySelector('img');
        const lightboxCaption = lightbox.querySelector('.lightbox-caption');
        const lightboxClose = lightbox.querySelector('.lightbox-close');
        
        lightboxLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const imgSrc = this.getAttribute('href');
                const caption = this.querySelector('.galerie-caption h3')?.textContent || '';
                lightboxImg.src = imgSrc;
                lightboxCaption.textContent = caption;
                lightbox.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });
        
        lightboxClose.addEventListener('click', function() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) {
                lightbox.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
});