// CyberShield Theme - Main JS

document.addEventListener('DOMContentLoaded', () => {

    // =====================
    // PAGE LOADER
    // =====================
    const loader = document.getElementById('pageLoader');
    if (loader) {
        setTimeout(() => loader.classList.add('loaded'), 1800);
    }

    // =====================
    // CUSTOM CURSOR
    // =====================
    const cursor = document.getElementById('cursor');
    const follower = document.getElementById('cursorFollower');

    if (cursor && follower) {
        let mouseX = 0, mouseY = 0;
        let followerX = 0, followerY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursor.style.left = mouseX + 'px';
            cursor.style.top = mouseY + 'px';
        });

        function animateFollower() {
            followerX += (mouseX - followerX) * 0.12;
            followerY += (mouseY - followerY) * 0.12;
            follower.style.left = followerX + 'px';
            follower.style.top = followerY + 'px';
            requestAnimationFrame(animateFollower);
        }
        animateFollower();

        // Hover effect
        document.querySelectorAll('a, button, .btn').forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.style.transform = 'translate(-50%, -50%) scale(2)';
                cursor.style.background = 'var(--accent-cyan)';
                follower.style.opacity = '0';
            });
            el.addEventListener('mouseleave', () => {
                cursor.style.transform = 'translate(-50%, -50%) scale(1)';
                cursor.style.background = 'var(--accent-green)';
                follower.style.opacity = '0.5';
            });
        });
    }

    // =====================
    // STICKY HEADER
    // =====================
    const header = document.getElementById('siteHeader');
    if (header) {
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    // =====================
    // MOBILE MENU
    // =====================
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', () => {
            mainNav.classList.toggle('open');
            const spans = menuToggle.querySelectorAll('span');
            if (mainNav.classList.contains('open')) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
            } else {
                spans.forEach(s => { s.style.transform = ''; s.style.opacity = ''; });
            }
        });
    }

    // =====================
    // MATRIX CANVAS
    // =====================
    const canvas = document.getElementById('matrixCanvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');

        function resize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        const chars = '01アイウエオカキクケコサシスセソ@#$%&<>/\\[]{}|';
        const fontSize = 13;
        let columns = Math.floor(canvas.width / fontSize);
        let drops = Array(columns).fill(0).map(() => Math.random() * -100);

        function drawMatrix() {
            ctx.fillStyle = 'rgba(2, 12, 14, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.font = fontSize + 'px Share Tech Mono, monospace';

            for (let i = 0; i < drops.length; i++) {
                const char = chars[Math.floor(Math.random() * chars.length)];
                const brightness = Math.random();

                if (brightness > 0.95) {
                    ctx.fillStyle = '#ffffff';
                } else if (brightness > 0.8) {
                    ctx.fillStyle = '#00ff88';
                } else {
                    ctx.fillStyle = 'rgba(0, 255, 136, 0.3)';
                }

                ctx.fillText(char, i * fontSize, drops[i] * fontSize);

                if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                    drops[i] = 0;
                }
                drops[i] += 0.5;
            }
        }

        setInterval(drawMatrix, 50);

        window.addEventListener('resize', () => {
            columns = Math.floor(canvas.width / fontSize);
            drops = Array(columns).fill(0).map(() => Math.random() * -100);
        });
    }

    // =====================
    // SCROLL ANIMATIONS
    // =====================
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.post-card, .widget, .stat-item').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // =====================
    // THREAT BAR ANIMATION
    // =====================
    const threatBars = document.querySelectorAll('.threat-fill');
    const threatObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const width = entry.target.style.width;
                entry.target.style.width = '0';
                setTimeout(() => { entry.target.style.width = width; }, 100);
                threatObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    threatBars.forEach(bar => threatObserver.observe(bar));

    // =====================
    // TERMINAL TYPING EFFECT
    // =====================
    function typeEffect(element, text, speed = 50) {
        element.textContent = '';
        let i = 0;
        const timer = setInterval(() => {
            if (i < text.length) {
                element.textContent += text[i++];
            } else {
                clearInterval(timer);
            }
        }, speed);
    }

    // Activate typing on visible terminal outputs
    const terminalObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const outputs = entry.target.querySelectorAll('.terminal-output');
                outputs.forEach((out, i) => {
                    const text = out.textContent;
                    setTimeout(() => typeEffect(out, text, 30), i * 400);
                });
                terminalObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    document.querySelectorAll('.terminal').forEach(t => terminalObserver.observe(t));

    // =====================
    // GLITCH ON HOVER
    // =====================
    document.querySelectorAll('.post-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            const title = card.querySelector('.post-title a');
            if (title) {
                title.style.animation = 'none';
                setTimeout(() => { title.style.animation = ''; }, 10);
            }
        });
    });

    // =====================
    // SEARCH FORM
    // =====================
    const searchFields = document.querySelectorAll('.search-field');
    searchFields.forEach(field => {
        field.setAttribute('placeholder', '$ search --query "..."');
    });

});
