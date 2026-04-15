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

    function showFloatingAlert(message) {
        const existing = document.querySelector('.ui-alert');
        if (existing) {
            existing.remove();
        }
        const alert = document.createElement('div');
        alert.className = 'ui-alert';
        alert.textContent = message;
        document.body.appendChild(alert);
        setTimeout(() => alert.classList.add('show'), 10);
        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 250);
        }, 2500);
    }

    // Register form validation (real-time password match)
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        const passwordInput = registerForm.querySelector('input[name="password"]');
        const confirmInput = registerForm.querySelector('input[name="password_confirm"]');
        const submitBtn = document.getElementById('registerSubmitBtn');
        const message = document.getElementById('passwordMatchMessage');

        const syncPasswordState = () => {
            const pass = passwordInput.value;
            const passConfirm = confirmInput.value;

            if (!passConfirm) {
                message.textContent = '';
                submitBtn.disabled = false;
                return;
            }

            if (pass !== passConfirm) {
                message.textContent = 'Passwords do not match';
                submitBtn.disabled = true;
            } else {
                message.textContent = '';
                submitBtn.disabled = false;
            }
        };

        passwordInput.addEventListener('input', syncPasswordState);
        confirmInput.addEventListener('input', syncPasswordState);

        registerForm.addEventListener('submit', function(e) {
            const pass = passwordInput.value;
            const passConfirm = confirmInput.value;
            if (pass.length < 6) {
                e.preventDefault();
                showFloatingAlert('Password must be at least 6 characters.');
            } else if (pass !== passConfirm) {
                e.preventDefault();
                message.textContent = 'Passwords do not match';
                submitBtn.disabled = true;
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

    // Size selection required before add to cart
    document.querySelectorAll('.requires-size-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const sizeSelect = form.querySelector('select[name="size"]');
            const error = form.querySelector('.field-error');
            if (!sizeSelect || !sizeSelect.value) {
                e.preventDefault();
                if (error) {
                    error.textContent = 'Please select a size before adding to cart.';
                }
                showFloatingAlert('Please select a size before adding to cart.');
                sizeSelect.focus();
                return;
            }
            if (error) {
                error.textContent = '';
            }
        });
    });

    // Card payment form handlers
    const cardNumberInput = document.getElementById('cardNumber');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let formattedValue = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedValue += ' ';
                }
                formattedValue += value[i];
            }
            e.target.value = formattedValue;
        });
    }

    const expiryInput = document.getElementById('expiryDate');
    if (expiryInput) {
        expiryInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
        });
    }

    const cvvInput = document.getElementById('cvv');
    if (cvvInput) {
        cvvInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0, 4);
        });
    }

    // Payment method selection
    const paymentCards = document.querySelectorAll('.payment-method-card:not(.coming-soon)');
    paymentCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove active class from all cards
            document.querySelectorAll('.payment-method-card').forEach(c => {
                c.classList.remove('active');
            });
            // Add active class to clicked card
            this.classList.add('active');
            // Check the radio button
            const radio = this.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
            }
        });
    });
});

// Page transition animations
window.addEventListener('beforeunload', function() {
    document.body.style.opacity = '0.5';
});
