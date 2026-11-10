/**
 * Kawiarnia Specialty Theme - Anime.js & Continuous Ambient Coffee Animation
 */

document.addEventListener('DOMContentLoaded', function () {
    /* ==========================================================================
       1. Continuous Ambient Coffee Canvas Animation (Floating Beans & Aroma Particles)
       ========================================================================== */
    initCoffeeHeroCanvas();

    // Sprawdź czy biblioteka Anime.js jest dostępna
    if (typeof anime === 'undefined') {
        console.warn('Anime.js not loaded, skipping timeline animations.');
        return;
    }

    /* ==========================================================================
       2. Hero Entrance Timeline
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
       3. Scroll Reveal for Features and Posts Grid (IntersectionObserver + Stagger)
       ========================================================================== */
    const createScrollObserver = (selector, itemSelector, staggerDelay = 110) => {
        const container = document.querySelector(selector);
        if (!container) return;

        const items = container.querySelectorAll(itemSelector);
        if (!items.length) return;

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
       4. Elastic Click Feedback for Buttons
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
       5. 404 Page Animation (Elastic Coffee Cup Bounce)
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
       6. Navbar Subtle Shadow on Scroll
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
       7. Feature Card Icon Hover Physics
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

/**
 * Ciągła, ambientowa animacja ziaren kawy i unoszącego się aromatu na Canvasie (60 FPS)
 */
function initCoffeeHeroCanvas() {
    const canvas = document.getElementById('coffee-hero-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const heroSection = canvas.closest('.hero-section');
    if (!heroSection) return;

    let width = 0;
    let height = 0;
    let animFrameId = null;
    let isVisible = true;

    // Pozycja myszy dla subtelnej interaktywności
    const mouse = { x: -1000, y: -1000, radius: 120 };

    heroSection.addEventListener('mousemove', function (e) {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    });

    heroSection.addEventListener('mouseleave', function () {
        mouse.x = -1000;
        mouse.y = -1000;
    });

    function resize() {
        width = canvas.width = heroSection.offsetWidth;
        height = canvas.height = heroSection.offsetHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    // ==========================================
    // Cząsteczki ziaren kawy
    // ==========================================
    const BEAN_COUNT = 24;
    const beans = [];

    class CoffeeBean {
        constructor() {
            this.reset(true);
        }

        reset(initial = false) {
            this.x = Math.random() * width;
            this.y = initial ? Math.random() * height : height + 30;
            // Zróżnicowana wielkość dla efektu głębi ostrości (bokeh)
            this.depth = 0.5 + Math.random() * 0.8; // 0.5 (daleko) do 1.3 (blisko)
            this.rx = (10 + Math.random() * 10) * this.depth; // promień X
            this.ry = this.rx * 1.35; // promień Y (ziarno jest owalne)
            
            this.angle = Math.random() * Math.PI * 2;
            this.rotSpeed = (Math.random() - 0.5) * 0.015;

            this.vy = -(0.35 + Math.random() * 0.55) * this.depth; // unosi się powoli w górę
            this.oscillationSpeed = 0.01 + Math.random() * 0.015;
            this.oscillationAmp = (0.4 + Math.random() * 0.8) * this.depth;
            this.oscStep = Math.random() * Math.PI * 2;

            // Paleta barw rzemieślniczych ziaren
            const tones = [
                { r: 184, g: 103, b: 40 },   // karmel roast amber
                { r: 156, g: 83,  b: 26 },   // ciemny karmel
                { r: 92,  g: 52,  b: 30 },   // palone ziarno
                { r: 215, g: 145, b: 85 }    // złocisty filtr
            ];
            this.color = tones[Math.floor(Math.random() * tones.length)];
            this.baseOpacity = (0.18 + Math.random() * 0.32) * (this.depth > 1 ? 0.9 : 0.6);
            this.opacity = this.baseOpacity;
        }

        update() {
            this.y += this.vy;
            this.oscStep += this.oscillationSpeed;
            this.x += Math.sin(this.oscStep) * this.oscillationAmp;
            this.angle += this.rotSpeed;

            // Interakcja z myszką (delikatne odpychanie)
            const dx = this.x - mouse.x;
            const dy = this.y - mouse.y;
            const dist = Math.sqrt(dx * dx + dy * dy);
            if (dist < mouse.radius && dist > 0) {
                const force = (mouse.radius - dist) / mouse.radius;
                this.x += (dx / dist) * force * 2.5;
                this.y += (dy / dist) * force * 2.5;
            }

            // Reset gdy ziarno wyleci powyżej ekranu
            if (this.y < -40 || this.x < -40 || this.x > width + 40) {
                this.reset(false);
            }
        }

        draw(c) {
            c.save();
            c.translate(this.x, this.y);
            c.rotate(this.angle);

            // Korpus ziarna kawy (owal)
            c.beginPath();
            c.ellipse(0, 0, this.rx, this.ry, 0, 0, Math.PI * 2);
            c.fillStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${this.opacity})`;
            c.fill();

            // Delikatne obramowanie ziarna
            c.lineWidth = 1.2;
            c.strokeStyle = `rgba(237, 220, 200, ${this.opacity * 0.4})`;
            c.stroke();

            // Pęknięcie ziarna (charakterystyczna esowata bruzda pośrodku)
            c.beginPath();
            const h = this.ry * 0.75;
            const curve = this.rx * 0.35;
            c.moveTo(0, -h);
            c.bezierCurveTo(curve, -h * 0.3, -curve, h * 0.3, 0, h);
            c.lineWidth = Math.max(1, 1.8 * this.depth);
            c.strokeStyle = `rgba(18, 9, 5, ${this.opacity * 1.5})`;
            c.stroke();

            c.restore();
        }
    }

    // ==========================================
    // Cząsteczki unoszącego się aromatu (Steam Sparks)
    // ==========================================
    const SPARK_COUNT = 30;
    const sparks = [];

    class AromaSpark {
        constructor() {
            this.reset(true);
        }

        reset(initial = false) {
            this.x = Math.random() * width;
            this.y = initial ? Math.random() * height : height + 10;
            this.radius = 1 + Math.random() * 2;
            this.vy = -(0.5 + Math.random() * 0.8);
            this.vx = (Math.random() - 0.5) * 0.4;
            this.opacity = 0.1 + Math.random() * 0.35;
            this.pulseSpeed = 0.02 + Math.random() * 0.03;
            this.pulseStep = Math.random() * Math.PI;
        }

        update() {
            this.y += this.vy;
            this.x += this.vx;
            this.pulseStep += this.pulseSpeed;

            if (this.y < -10) {
                this.reset(false);
            }
        }

        draw(c) {
            const currentOpacity = this.opacity * (0.6 + 0.4 * Math.sin(this.pulseStep));
            c.beginPath();
            c.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            c.fillStyle = `rgba(237, 220, 200, ${currentOpacity})`;
            c.fill();
        }
    }

    // Inicjalizacja cząsteczek
    for (let i = 0; i < BEAN_COUNT; i++) {
        beans.push(new CoffeeBean());
    }
    for (let i = 0; i < SPARK_COUNT; i++) {
        sparks.push(new AromaSpark());
    }

    // Pętla animacji 60 FPS
    function loop() {
        if (!isVisible) {
            animFrameId = null;
            return;
        }

        ctx.clearRect(0, 0, width, height);

        // Rysuj drobinki aromatu
        for (let i = 0; i < sparks.length; i++) {
            sparks[i].update();
            sparks[i].draw(ctx);
        }

        // Rysuj pływające ziarna kawy
        for (let i = 0; i < beans.length; i++) {
            beans[i].update();
            beans[i].draw(ctx);
        }

        animFrameId = requestAnimationFrame(loop);
    }

    // Wstrzymanie pętli gdy sekcja nie jest na ekranie (oszczędność baterii i CPU)
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            isVisible = entry.isIntersecting;
            if (isVisible && !animFrameId) {
                animFrameId = requestAnimationFrame(loop);
            }
        });
    }, { threshold: 0.05 });

    observer.observe(heroSection);
}
