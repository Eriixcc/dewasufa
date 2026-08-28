<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dewasufa — Website personal yang dibangun dengan Laravel. Eksplorasi, kreasi, dan inovasi digital.">
    <meta property="og:title" content="Dewasufa">
    <meta property="og:description" content="Website personal yang dibangun dengan Laravel.">

    <title>Dewaprabs — Digital Creative</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="Main navigation">
        <a href="#home" class="nav-logo" aria-label="Dewasufa Home">
            <div class="nav-logo-icon">D</div>
            <span class="nav-logo-text">Dewaprabs</span>
        </a>

        <div class="nav-links" id="nav-links">
            <a href="#home">Home</a>
            <a href="#features">Layanan</a>
            <a href="#about">Tentang</a>
            <a href="#contact" class="nav-cta">Hubungi Saya</a>
        </div>

        <button class="nav-hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false" aria-controls="nav-links">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>


    <!-- ===== HERO ===== -->
    <section id="home" class="hero">
        <!-- decorative orbs -->
        <div class="orb orb-1" aria-hidden="true"></div>
        <div class="orb orb-2" aria-hidden="true"></div>
        <div class="orb orb-3" aria-hidden="true"></div>

        <div class="hero-content">
            <div class="hero-badge">
                <span class="hero-badge-dot" aria-hidden="true"></span>
                Tersedia untuk Kolaborasi
            </div>

            <h1>
                Selamat Datang di<br>
                <span class="gradient-text">Dewasufa</span>
            </h1>

            <p class="hero-description">
                Website personal saya — tempat saya berbagi proyek, eksplorasi teknologi,
                dan perjalanan belajar di dunia digital.
            </p>

            <div class="hero-actions">
                <a href="#features" class="btn-primary" id="hero-cta-primary">
                    ✦ Jelajahi
                </a>
                <a href="#about" class="btn-secondary" id="hero-cta-secondary">
                    Tentang Saya →
                </a>
            </div>
        </div>

        <div class="hero-scroll" aria-hidden="true">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>
    </section>


    <!-- ===== STATS STRIP ===== -->
    <section class="stats-strip" aria-label="Statistics">
        <div class="stats-grid">
            <div class="stat-item reveal">
                <h3>Laravel</h3>
                <p>Framework Pilihan</p>
            </div>
            <div class="stat-item reveal" style="transition-delay: 0.1s">
                <h3>2026</h3>
                <p>Tahun Dibuat</p>
            </div>
            <div class="stat-item reveal" style="transition-delay: 0.2s">
                <h3>100%</h3>
                <p>Penuh Semangat</p>
            </div>
        </div>
    </section>


    <!-- ===== FEATURES ===== -->
    <section id="features" class="features">
        <div class="section-header reveal">
            <span class="section-tag">Layanan</span>
            <h2>Apa yang Saya Kerjakan</h2>
            <p>Dari desain hingga deployment, saya mengerjakan berbagai hal di dunia web modern.</p>
        </div>

        <div class="features-grid">
            <article class="feature-card reveal" style="transition-delay: 0.05s">
                <div class="feature-icon" aria-hidden="true">🎨</div>
                <h3>UI / UX Design</h3>
                <p>Merancang tampilan yang indah, intuitif, dan menyenangkan untuk pengguna.</p>
            </article>

            <article class="feature-card reveal" style="transition-delay: 0.15s">
                <div class="feature-icon" aria-hidden="true">⚙️</div>
                <h3>Web Development</h3>
                <p>Membangun aplikasi web modern menggunakan Laravel, Blade, Vite, dan teknologi terkini.</p>
            </article>

            <article class="feature-card reveal" style="transition-delay: 0.25s">
                <div class="feature-icon" aria-hidden="true">🚀</div>
                <h3>Deployment & Hosting</h3>
                <p>Mengonfigurasi server, domain, dan infrastruktur agar situs selalu cepat dan stabil.</p>
            </article>

            <article class="feature-card reveal" style="transition-delay: 0.35s">
                <div class="feature-icon" aria-hidden="true">🔒</div>
                <h3>Keamanan Web</h3>
                <p>Menerapkan best practice keamanan agar data dan pengguna selalu terlindungi.</p>
            </article>

            <article class="feature-card reveal" style="transition-delay: 0.45s">
                <div class="feature-icon" aria-hidden="true">📱</div>
                <h3>Responsive Design</h3>
                <p>Tampilan yang sempurna di semua perangkat — desktop, tablet, maupun mobile.</p>
            </article>

            <article class="feature-card reveal" style="transition-delay: 0.55s">
                <div class="feature-icon" aria-hidden="true">📊</div>
                <h3>Database & API</h3>
                <p>Mendesain skema database yang efisien dan membangun API yang handal dan cepat.</p>
            </article>
        </div>
    </section>


    <!-- ===== ABOUT ===== -->
    <section id="about" class="about">
        <div class="about-inner">
            <div class="about-content reveal">
                <span class="section-tag">Tentang</span>
                <h2>Siapa Saya?</h2>
                <p>
                    Halo! Saya adalah pengembang web yang bersemangat dalam membangun
                    pengalaman digital yang bermakna. Website ini adalah ruang saya
                    untuk bereksperimen, belajar, dan berbagi.
                </p>
                <p>
                    Saya menggunakan <strong>Laravel</strong> sebagai framework utama,
                    dengan kombinasi <strong>Blade</strong>, <strong>CSS</strong>, dan
                    <strong>Vite</strong> untuk menciptakan tampilan yang modern dan performan.
                </p>
                <a href="#contact" class="btn-primary" id="about-cta">
                    Hubungi Saya ✦
                </a>
            </div>

            <div class="about-visual reveal" style="transition-delay: 0.2s">
                <article class="about-card">
                    <div class="about-card-icon purple" aria-hidden="true">⚡</div>
                    <div>
                        <h4>Laravel Framework</h4>
                        <p>Dibangun di atas fondasi yang kuat dan elegan.</p>
                    </div>
                </article>

                <article class="about-card">
                    <div class="about-card-icon pink" aria-hidden="true">🎯</div>
                    <div>
                        <h4>Clean Code</h4>
                        <p>Kode yang rapi, terbaca, dan mudah di-maintain.</p>
                    </div>
                </article>

                <article class="about-card">
                    <div class="about-card-icon blue" aria-hidden="true">🌐</div>
                    <div>
                        <h4>Modern Web Stack</h4>
                        <p>Vite, CSS modern, dan tools terkini untuk pengembangan cepat.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>


    <!-- ===== CTA / CONTACT ===== -->
    <section id="contact" class="cta-section">
        <h2 class="reveal">Mari <span class="gradient-text">Berkolaborasi</span></h2>
        <p class="reveal" style="transition-delay: 0.1s">
            Punya ide proyek menarik? Atau sekadar ingin menyapa?
            Saya selalu terbuka untuk diskusi dan kolaborasi baru.
        </p>
        <div class="hero-actions reveal" style="transition-delay: 0.2s">
            <a href="mailto:hello@dewasufa.com" class="btn-primary" id="contact-email">
                ✉️ Kirim Email
            </a>
            <a href="#home" class="btn-secondary" id="contact-back-top">
                ↑ Kembali ke Atas
            </a>
        </div>
    </section>


    <!-- ===== FOOTER ===== -->
    <footer>
        <div class="footer-inner">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="#home" class="nav-logo" aria-label="Dewasufa Home">
                        <div class="nav-logo-icon">D</div>
                        <span class="nav-logo-text">Dewasufa</span>
                    </a>
                    <p>Website personal yang dibangun dengan passion menggunakan Laravel dan teknologi web modern.</p>
                </div>

                <div class="footer-col">
                    <h4>Navigasi</h4>
                    <a href="#home">Home</a>
                    <a href="#features">Layanan</a>
                    <a href="#about">Tentang</a>
                    <a href="#contact">Kontak</a>
                </div>

                <div class="footer-col">
                    <h4>Teknologi</h4>
                    <a href="https://laravel.com" target="_blank" rel="noopener noreferrer">Laravel</a>
                    <a href="https://vitejs.dev" target="_blank" rel="noopener noreferrer">Vite</a>
                    <a href="https://php.net" target="_blank" rel="noopener noreferrer">PHP</a>
                    <a href="https://mysql.com" target="_blank" rel="noopener noreferrer">MySQL</a>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2026 Dewasufa. Dibuat dengan ❤️ menggunakan Laravel.</p>
                <div class="social-links" aria-label="Social media links">
                    <a href="#" class="social-link" aria-label="GitHub" title="GitHub">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter / X" title="Twitter">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram" title="Instagram">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>


    <script>
        // Navbar scroll behavior
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });

        // Hamburger menu toggle
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('nav-links');
        hamburger.addEventListener('click', () => {
            const isOpen = navLinks.classList.toggle('open');
            hamburger.setAttribute('aria-expanded', isOpen);
        });

        // Close menu on link click (mobile)
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('open');
                hamburger.setAttribute('aria-expanded', 'false');
            });
        });

        // Scroll reveal animation
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
    </script>

</body>
</html>