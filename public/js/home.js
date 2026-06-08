// WhatsApp redirect (from config)
if (window.homeConfig && window.homeConfig.waUrl) {
    if (sessionStorage.getItem('wa_redirect_id') !== window.homeConfig.waId) {
        sessionStorage.setItem('wa_redirect_id', window.homeConfig.waId);
        window.location.href = window.homeConfig.waUrl;
    }
}

// Navbar scroll effect
window.addEventListener('scroll', function () {
    const nav = document.querySelector('.navbar');
    if (nav) nav.classList.toggle('scrolled', window.scrollY > 50);
});

// ========== SCROLL REVEAL ANIMATION ==========
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.s');
    sections.forEach((section, index) => {
        if (index === 0) {
            section.classList.add('reveal-fade-up');
        } else if (index === 1) {
            section.classList.add('reveal-fade-left');
        } else if (index === 2) {
            section.classList.add('reveal-fade-right');
        } else {
            section.classList.add('reveal-scale');
        }
    });

    const heroBody = document.querySelector('.hero-body');
    if (heroBody && !heroBody.classList.contains('reveal-fade-up')) {
        heroBody.classList.add('reveal-fade-up');
    }

    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const revealElements = document.querySelectorAll('[class*="reveal-"]');
    revealElements.forEach(el => observer.observe(el));

    const menuCards = document.querySelectorAll('.h-menu-card');
    menuCards.forEach(card => {
        if (!card.classList.contains('reveal-scale')) {
            card.style.opacity = '0';
            card.style.animation = 'none';
            observer.observe(card);
        }
    });

    const menuObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, idx) => {
            if (entry.isIntersecting) {
                const card = entry.target;
                const delay = (Array.from(menuCards).indexOf(card) * 0.08);
                card.style.animation = `scaleIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) ${delay}s forwards`;
                menuObserver.unobserve(card);
            }
        });
    }, { threshold: 0.1 });

    menuCards.forEach(card => menuObserver.observe(card));

    // Auto-initialize testimonials carousel
    const testiCarousel = document.querySelector('#testiCarousel');
    if (testiCarousel) {
        new bootstrap.Carousel(testiCarousel, {
            interval: 3500,
            ride: 'carousel',
            wrap: true
        });
    }
});

// Parallax effect for hero background
window.addEventListener('scroll', function() {
    const heroBg = document.querySelector('.hero img, .hero video');
    if (heroBg) {
        const scrolled = window.pageYOffset;
        heroBg.style.transform = `translateY(${scrolled * 0.5}px) scale(1.05)`;
    }
});
