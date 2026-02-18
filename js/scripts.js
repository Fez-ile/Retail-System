// AMMS - Luxury Retail Scripts
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Register form validation
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const pass = registerForm.querySelector('input[name="password"]').value;
            if (pass.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters.');
            }
        });
    }

    // Smooth fade-in animations for elements
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all product cards and sections
    document.querySelectorAll('.product-card, .featured-card, .about-section, .value-item').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Hover effects for product cards
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
            this.style.opacity = '0.95';
        });
        card.addEventListener('mouseleave', function() {
            this.style.opacity = '1';
        });
    });

    // Button hover effects
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });

    // Add smooth scrolling to header on page load
    window.addEventListener('load', function() {
        document.body.style.opacity = '0';
        document.body.style.transition = 'opacity 0.5s ease';
        setTimeout(() => {
            document.body.style.opacity = '1';
        }, 10);
    });

    // Toggle mobile menu (if needed)
    const navToggle = document.querySelector('.nav-toggle');
    const nav = document.querySelector('nav');
    
    if (navToggle) {
        navToggle.addEventListener('click', function() {
            nav.classList.toggle('active');
        });
    }

    // Close menu when link is clicked
    document.querySelectorAll('nav a').forEach(link => {
        link.addEventListener('click', function() {
            if (nav) nav.classList.remove('active');
        });
    });

    // Smooth number counting animation (for stats if added)
    function animateCountUp(element, target, duration = 2000) {
        let current = 0;
        const increment = target / (duration / 16);
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    }

    // Form input animations
    document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], textarea, select').forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#000';
            this.style.boxShadow = '0 0 0 1px #000';
        });
        input.addEventListener('blur', function() {
            this.style.boxShadow = 'none';
        });
    });

    // Newsletter subscription
    document.querySelectorAll('.newsletter button').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const input = this.previousElementSibling;
            if (input && input.value) {
                const email = input.value;
                // Simple feedback
                this.textContent = 'Subscribed';
                this.style.opacity = '0.5';
                this.disabled = true;
                setTimeout(() => {
                    input.value = '';
                    this.textContent = 'Subscribe';
                    this.style.opacity = '1';
                    this.disabled = false;
                }, 3000);
            }
        });
    });
});

// Page transition animations
window.addEventListener('beforeunload', function() {
    document.body.style.opacity = '0.5';
});
