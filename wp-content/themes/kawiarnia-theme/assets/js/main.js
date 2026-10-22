/**
 * Kawiarnia Specialty Theme - Anime.js Animations & Interactive Micro-features
 */

document.addEventListener('DOMContentLoaded', function () {
    // Sprawdź czy biblioteka Anime.js jest dostępna
    if (typeof anime === 'undefined') {
        console.warn('Anime.js not loaded, skipping enhanced animations.');
        return;
    }

    /* ==========================================================================
       1. Hero Entrance Animation
       ========================================================================== */
    if (document.querySelector('.hero-section')) {
        anime.timeline({
            easing: 'easeOutCubic'
        })
        .add({
            targets: '.hero-label',
            opacity: [0, 1],
            translateY: [16, 0],
            duration: 600
        })
        .add({
            targets: '.hero-title',
            opacity: [0, 1],
            translateY: [24, 0],
            duration: 800
        }, '-=400')
        .add({
            targets: '.hero-description',
            opacity: [0, 1],
            translateY: [20, 0],
            duration: 700
        }, '-=500')
        .add({
            targets: '.hero-actions .btn',
            opacity: [0, 1],
            translateY: [18, 0],
            delay: anime.stagger(100),
            duration: 600
        }, '-=400')
        .add({
            targets: '.spec-item',
            opacity: [0, 1],
            translateY: [16, 0],
            delay: anime.stagger(90),
            duration: 600
        }, '-=300');
    }

    /* ==========================================================================
       2. Scroll Reveal for Features and Posts Grid (IntersectionObserver + Stagger)
       ========================================================================== */
    const createScrollObserver = (selector, itemSelector, staggerDelay = 110) => {
        const container = document.querySelector(selector);
        if (!container) return;

        const items = container.querySelectorAll(itemSelector);
        if (!items.length) return;

        // Ustaw stan początkowy
        items.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(28px)';
        });

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    anime({
                        targets: items,
                        opacity: [0, 1],
                        translateY: [28, 0],
                        delay: anime.stagger(staggerDelay),
                        duration: 750,
                        easing: 'easeOutCubic'
                    });
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        observer.observe(container);
    };

    createScrollObserver('.features-grid', '.feature-card', 120);
    createScrollObserver('.posts-grid', '.kawiarnia-card', 130);

    /* ==========================================================================
       3. Elastic Click Feedback for Buttons
       ========================================================================== */
    const interactiveButtons = document.querySelectorAll('.btn, button, input[type="submit"], .page-numbers');
    interactiveButtons.forEach(button => {
        button.addEventListener('mousedown', function () {
            anime({
                targets: this,
                scale: 0.95,
                duration: 120,
                easing: 'easeInOutQuad'
            });
        });

        button.addEventListener('mouseup', function () {
            anime({
                targets: this,
                scale: 1,
                duration: 400,
                easing: 'easeOutElastic(1, .5)'
            });
        });

        button.addEventListener('mouseleave', function () {
            anime({
                targets: this,
                scale: 1,
                duration: 250,
                easing: 'easeOutQuad'
            });
        });
    });

    /* ==========================================================================
       4. 404 Page Animation (Elastic Coffee Cup Bounce)
       ========================================================================== */
    const cupContainer = document.querySelector('.coffee-404-illustration');
    if (cupContainer) {
        anime.timeline({
            easing: 'easeOutCubic'
        })
        .add({
            targets: cupContainer,
            opacity: [0, 1],
            scale: [0.75, 1],
            rotate: [-6, 0],
            duration: 1000,
            easing: 'easeOutElastic(1, .5)'
        })
        .add({
            targets: '.error-heading, .error-description',
            opacity: [0, 1],
            translateY: [18, 0],
            delay: anime.stagger(100),
            duration: 650
        }, '-=500')
        .add({
            targets: '.error-actions .btn, .error-search-box',
            opacity: [0, 1],
            translateY: [16, 0],
            delay: anime.stagger(100),
            duration: 600
        }, '-=300');
    }

    /* ==========================================================================
       5. Navbar Subtle Shadow on Scroll
       ========================================================================== */
    const header = document.querySelector('.site-header');
    if (header) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 25) {
                header.style.boxShadow = '0 6px 20px rgba(15, 10, 7, 0.08)';
            } else {
                header.style.boxShadow = 'none';
            }
        });
    }

    /* ==========================================================================
       6. Feature Card Icon Hover Physics
       ========================================================================== */
    const featureCards = document.querySelectorAll('.feature-card');
    featureCards.forEach(card => {
        const icon = card.querySelector('.feature-icon-wrapper');
        if (!icon) return;

        card.addEventListener('mouseenter', function () {
            anime({
                targets: icon,
                rotate: [0, -8, 6, 0],
                duration: 600,
                easing: 'easeOutBack'
            });
        });
    });
});
