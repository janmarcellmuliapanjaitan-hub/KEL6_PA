document.addEventListener('DOMContentLoaded', function() {
    // ========== SCROLL REVEAL ANIMATION ==========
    const sections = document.querySelectorAll('.s, .order-banner, .about-grid, .img-wrap, .about-content');
    
    sections.forEach((section, index) => {
        if (!section.classList.contains('reveal-fade-up') && 
            !section.classList.contains('reveal-fade-left') && 
            !section.classList.contains('reveal-fade-right') && 
            !section.classList.contains('reveal-scale')) {
            
            if (index % 3 === 0) {
                section.classList.add('reveal-fade-up');
            } else if (index % 3 === 1) {
                section.classList.add('reveal-fade-left');
            } else {
                section.classList.add('reveal-fade-right');
            }
        }
    });

    // Intersection Observer
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -30px 0px'
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

    // ========== PARALLAX EFFECT ==========
    window.addEventListener('scroll', function() {
        const heroImg = document.querySelector('.page-hero img');
        if (heroImg) {
            const scrolled = window.pageYOffset;
            heroImg.style.transform = `translateY(${scrolled * 0.4}px) scale(1.05)`;
        }
    });

    // ========== SMOOTH SCROLL ==========
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
