/* ========================================
   DOMAINE SAINT JOSEPH — JavaScript Principal
   Optimisé 3G, accessible, performant
   ======================================== */

(function() {
    'use strict';

    // ── Utilitaires ──
    const utils = {
        debounce: function(func, wait) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        },
        throttle: function(func, limit) {
            let inThrottle;
            return function(...args) {
                if (!inThrottle) {
                    func.apply(this, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        },
        isMobile: () => window.innerWidth <= 768
    };

    // ── MENU BURGER MOBILE ──
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        
        if (!menuToggle || !navMenu) return;
        
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            const isOpen = navMenu.classList.toggle('is-open');
            menuToggle.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', isOpen);
            document.body.style.overflow = isOpen ? 'hidden' : '';
            
            if (isOpen) {
                const firstLink = navMenu.querySelector('a');
                if (firstLink) firstLink.focus();
            }
        });
        
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('is-open');
                menuToggle.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            });
        });
        
        if (utils.isMobile()) {
            window.addEventListener('scroll', utils.throttle(() => {
                if (navMenu.classList.contains('is-open')) {
                    navMenu.classList.remove('is-open');
                    menuToggle.classList.remove('active');
                    menuToggle.setAttribute('aria-expanded', 'false');
                    document.body.style.overflow = '';
                }
            }, 200));
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && navMenu.classList.contains('is-open')) {
                navMenu.classList.remove('is-open');
                menuToggle.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
                menuToggle.focus();
            }
        });
    }

    // ── INDICATEUR DE PROGRESSION ──
    function initScrollProgress() {
        const progressBar = document.querySelector('.scroll-progress');
        if (!progressBar) return;
        
        window.addEventListener('scroll', utils.throttle(() => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = height > 0 ? (winScroll / height) * 100 : 0;
            progressBar.style.width = scrolled + '%';
        }, 16));
    }

    // ── ANIMATION DES COMPTEURS STATS ──
    function animateCounters() {
        const statNumbers = document.querySelectorAll('.stat-number[data-count]');
        statNumbers.forEach(stat => {
            if (stat.classList.contains('animated')) return;
            
            const target = parseInt(stat.getAttribute('data-count'), 10);
            if (isNaN(target)) return;
            
            stat.classList.add('animated');
            let current = 0;
            const steps = 50;
            const stepValue = target / steps;
            let count = 0;
            
            const timer = setInterval(() => {
                count++;
                current += stepValue;
                if (count >= steps) {
                    stat.textContent = target + (stat.dataset.suffix || '');
                    clearInterval(timer);
                } else {
                    stat.textContent = Math.floor(current) + (stat.dataset.suffix || '');
                }
            }, 20);
        });
    }
    
    function initStatsObserver() {
        const statsSection = document.querySelector('.stats-section');
        if (!statsSection) return;
        
        if (!('IntersectionObserver' in window)) {
            animateCounters();
            return;
        }
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3, rootMargin: '0px 0px -100px 0px' });
        
        observer.observe(statsSection);
    }

    // ── GALERIE LIGHTBOX ──
    function initGalleryLightbox() {
        const lightboxLinks = document.querySelectorAll('.galerie-link, .gallery-item');
        if (!lightboxLinks.length) return;
        
        let lightbox = document.getElementById('dsj-lightbox');
        if (!lightbox) {
            lightbox = document.createElement('div');
            lightbox.id = 'dsj-lightbox';
            lightbox.className = 'lightbox';
            lightbox.setAttribute('role', 'dialog');
            lightbox.setAttribute('aria-modal', 'true');
            lightbox.innerHTML = `
                <button class="lightbox-close" aria-label="Fermer">✕</button>
                <img src="" alt="" class="lightbox-img">
                <div class="lightbox-caption"></div>
                <button class="lightbox-nav prev" aria-label="Précédent">‹</button>
                <button class="lightbox-nav next" aria-label="Suivant">›</button>
            `;
            document.body.appendChild(lightbox);
        }
        
        const lightboxImg = lightbox.querySelector('.lightbox-img');
        const lightboxCaption = lightbox.querySelector('.lightbox-caption');
        const lightboxClose = lightbox.querySelector('.lightbox-close');
        const lightboxPrev = lightbox.querySelector('.lightbox-nav.prev');
        const lightboxNext = lightbox.querySelector('.lightbox-nav.next');
        
        let currentIndex = 0;
        let galleryItems = Array.from(lightboxLinks);
        
        function openLightbox(index) {
            const item = galleryItems[index];
            if (!item) return;
            
            const img = item.querySelector('img') || item;
            const captionElem = item.querySelector('.galerie-caption h3, figcaption p');
            const caption = captionElem ? captionElem.textContent : '';
            
            lightboxImg.src = img.src || img.getAttribute('href');
            lightboxImg.alt = img.alt || caption;
            lightboxCaption.textContent = caption;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
            currentIndex = index;
            
            setTimeout(() => lightboxClose.focus(), 100);
        }
        
        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
            lightboxImg.src = '';
        }
        
        function navigateLightbox(direction) {
            currentIndex = (currentIndex + direction + galleryItems.length) % galleryItems.length;
            openLightbox(currentIndex);
        }
        
        galleryItems.forEach((item, index) => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                openLightbox(index);
            });
        });
        
        lightboxClose.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) closeLightbox();
        });
        
        if (lightboxPrev) lightboxPrev.addEventListener('click', () => navigateLightbox(-1));
        if (lightboxNext) lightboxNext.addEventListener('click', () => navigateLightbox(1));
        
        document.addEventListener('keydown', function(e) {
            if (!lightbox.classList.contains('active')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') navigateLightbox(-1);
            if (e.key === 'ArrowRight') navigateLightbox(1);
        });
        
        let touchStartX = 0;
        lightbox.addEventListener('touchstart', function(e) {
            touchStartX = e.touches[0].clientX;
        }, { passive: true });
        
        lightbox.addEventListener('touchend', function(e) {
            const touchEndX = e.changedTouches[0].clientX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                navigateLightbox(diff > 0 ? 1 : -1);
            }
        }, { passive: true });
    }

    // ── BANDEAU FLASH INFO (MARQUEE) ──
    function initFlashInfoMarquee() {
        const banner = document.querySelector('.flash-info-banner');
        if (!banner) return;
        
        const track = banner.querySelector('.marquee-track');
        if (!track) return;
        
        const messages = Array.from(track.querySelectorAll('.marquee-message'));
        if (messages.length === 0) return;
        
        const originalHTML = messages.map(msg => msg.outerHTML).join('');
        track.innerHTML = originalHTML + originalHTML;
        
        const speed = banner.getAttribute('data-speed') || '20s';
        track.style.setProperty('--speed', speed);
        
        let isPaused = false;
        const pauseMarquee = () => { 
            isPaused = true; 
            track.style.animationPlayState = 'paused'; 
        };
        const resumeMarquee = () => { 
            isPaused = false; 
            track.style.animationPlayState = 'running'; 
        };
        
        if (utils.isMobile()) {
            track.addEventListener('touchstart', pauseMarquee, { passive: true });
            track.addEventListener('touchend', resumeMarquee);
        } else {
            track.addEventListener('mouseenter', pauseMarquee);
            track.addEventListener('mouseleave', resumeMarquee);
        }
        
        window.addEventListener('resize', utils.debounce(() => {
            track.style.animation = 'none';
            setTimeout(() => {
                track.style.animation = `marqueeScroll var(--speed, 20s) linear infinite`;
            }, 50);
        }, 250));
    }

    // ── LAZY LOAD FALLBACK ──
    function initLazyLoadFallback() {
        if ('loading' in HTMLImageElement.prototype) return;
        
        const images = document.querySelectorAll('img[loading="lazy"]');
        if (!('IntersectionObserver' in window)) {
            images.forEach(img => {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
            });
            return;
        }
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        img.classList.add('loaded');
                    }
                    observer.unobserve(img);
                }
            });
        }, { rootMargin: '100px' });
        
        images.forEach(img => observer.observe(img));
    }

    // ── FILTRES GALERIE ──
    function initGalleryFilters() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.galerie-item');
        
        if (!filterButtons.length || !galleryItems.length) return;
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');
                
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                galleryItems.forEach(item => {
                    if (filterValue === 'all' || !filterValue) {
                        item.classList.remove('hide');
                    } else {
                        const categories = item.getAttribute('data-category') || '';
                        if (categories.includes(filterValue)) {
                            item.classList.remove('hide');
                        } else {
                            item.classList.add('hide');
                        }
                    }
                });
            });
        });
    }

    // ========================================
    // HERO SLIDER - VERSION SIMPLE ET EFFICACE
    // ========================================
    function initHeroSlider() {
        const slider = document.querySelector('.hero-slider');
        if (!slider) return;
        
        const slides = Array.from(document.querySelectorAll('.hero-slide'));
        const dots = Array.from(document.querySelectorAll('.slider-dot'));
        const prevBtn = document.querySelector('.slider-prev');
        const nextBtn = document.querySelector('.slider-next');
        
        if (slides.length === 0) return;
        
        let currentIndex = 0;
        let interval;
        let isTransitioning = false;
        const speed = parseInt(slider.dataset.speed) || 5000;
        
        // Trouver l'index du slide actif
        slides.forEach((slide, i) => {
            if (slide.classList.contains('active')) {
                currentIndex = i;
            }
        });
        
        // Masquer tous les slides sauf l'actif
        function showSlide(index) {
            if (isTransitioning || index === currentIndex) return;
            isTransitioning = true;
            
            const currentSlide = slides[currentIndex];
            const nextSlide = slides[index];
            
            // Afficher le prochain slide
            nextSlide.style.display = 'block';
            nextSlide.style.opacity = '0';
            
            // Animation de transition
            setTimeout(() => {
                currentSlide.style.opacity = '0';
                currentSlide.style.zIndex = '1';
                currentSlide.classList.remove('active');
                
                nextSlide.style.opacity = '1';
                nextSlide.style.zIndex = '2';
                nextSlide.classList.add('active');
                
                setTimeout(() => {
                    currentSlide.style.display = 'none';
                    isTransitioning = false;
                }, 800);
            }, 50);
            
            // Mettre à jour les dots
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
            
            currentIndex = index;
        }
        
        function nextSlide() {
            let newIndex = currentIndex + 1;
            if (newIndex >= slides.length) newIndex = 0;
            showSlide(newIndex);
            resetInterval();
        }
        
        function prevSlide() {
            let newIndex = currentIndex - 1;
            if (newIndex < 0) newIndex = slides.length - 1;
            showSlide(newIndex);
            resetInterval();
        }
        
        function resetInterval() {
            if (interval) clearInterval(interval);
            interval = setInterval(nextSlide, speed);
        }
        
        // S'assurer que le premier slide est visible
        slides[currentIndex].style.display = 'block';
        slides[currentIndex].style.opacity = '1';
        slides[currentIndex].style.zIndex = '2';
        
        // Event listeners
        if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); resetInterval(); });
        if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); resetInterval(); });
        
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => { showSlide(i); resetInterval(); });
        });
        
        // Pause au survol
        slider.addEventListener('mouseenter', () => { if (interval) clearInterval(interval); });
        slider.addEventListener('mouseleave', resetInterval);
        
        // Démarrer l'autoplay
        resetInterval();
    }

    // ── ANIMATIONS HERO ──
    function initHeroAnimations() {
        const heroContent = document.querySelector('.hero-content, .hero-inner');
        const heroWave = document.querySelector('.hero-wave');
        
        if (heroContent) {
            setTimeout(() => heroContent.classList.add('hero-animated'), 200);
        }
        
        if (heroWave && !utils.isMobile()) {
            window.addEventListener('scroll', utils.throttle(() => {
                const scrolled = window.pageYOffset;
                heroWave.style.transform = `translateY(${scrolled * 0.2}px)`;
            }, 16));
        }
    }

    // ── INITIALISATION GÉNÉRALE ──
    function init() {
        initMobileMenu();
        initScrollProgress();
        initStatsObserver();
        initGalleryLightbox();
        initFlashInfoMarquee();
        initHeroSlider();
        initHeroAnimations();
        initLazyLoadFallback();
        initGalleryFilters();
        
        console.log('✅ Domaine Saint Joseph — JS initialisé');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();