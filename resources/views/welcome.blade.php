<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dewasufa - Jelajahi keindahan alam Bali yang memukau. Temukan air terjun tersembunyi, pantai sunset yang dramatis, sunrise di tepi laut, dan puncak gunung berapi yang megah.">
    <meta name="keywords" content="Bali, wisata alam Bali, air terjun Bali, pantai Bali, gunung Bali, dewasufa">
    <meta property="og:title" content="Dewasufa">
    <meta property="og:description" content="Jelajahi keindahan alam Bali yang menakjubkan bersama Dewasufa.">
    <meta property="og:type" content="website">

    <title>Dewasufa - Keindahan Alam Bali</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="Navigasi utama">
        <a href="#home" class="nav-logo" aria-label="Dewasufa - Beranda">
            <div class="nav-logo-icon" aria-hidden="true">D</div>
            <span class="nav-logo-text">Dewasufa</span>
        </a>

        <div class="nav-links" id="nav-links" role="menubar">
            <a href="#home" role="menuitem">Beranda</a>
            <a href="#categories" role="menuitem">Kategori</a>
            <a href="#highlights" role="menuitem">Sorotan</a>
            <a href="#contact" class="nav-cta" role="menuitem">Jelajahi</a>
        </div>

        <button class="nav-hamburger" id="hamburger" aria-label="Buka menu" aria-expanded="false" aria-controls="nav-links">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>


    <!-- ===== HERO ===== -->
    <section id="home" class="hero" aria-label="Hero utama">
        <div class="hero-bg" aria-hidden="true"></div>
        <div class="hero-overlay" aria-hidden="true"></div>

        <!-- Floating particles -->
        <div class="hero-particles" id="hero-particles" aria-hidden="true"></div>

        <div class="hero-content">
            <div class="hero-badge" aria-label="Status">
                <span class="hero-badge-icon" aria-hidden="true">🌿</span>
                Pulau Dewata
            </div>

            <h1>
                Keindahan<br>
                <span class="gradient-text">Alam Bali</span>
            </h1>

            <p class="hero-subtitle">Surga tersembunyi di ujung timur nusantara</p>

            <p class="hero-description">
                Jelajahi pesona alam Bali yang tiada duanya. Dari air terjun yang menyejukkan,
                pantai dengan senja yang membakar langit, hingga puncak gunung yang menyentuh awan.
            </p>

            <div class="hero-actions">
                <a href="#categories" class="btn-primary" id="hero-cta-primary">
                    ✦ Mulai Jelajahi
                </a>
                <a href="#highlights" class="btn-secondary" id="hero-cta-secondary">
                    Kenali Lebih Jauh →
                </a>
            </div>
        </div>

        <div class="hero-scroll" aria-hidden="true">
            <span></span>
            <div class="scroll-line"></div>
        </div>
    </section>


    <!-- ===== MARQUEE STRIP ===== -->
    <div class="marquee-strip" aria-hidden="true">
        <div class="marquee-track">
            <!-- Duplicated for seamless loop -->
            <span class="marquee-item"><span class="marquee-dot"></span>Air Terjun Tegenungan</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Pantai Tanah Lot</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Gunung Batur</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Sunrise Sanur</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Air Terjun Gitgit</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Sunset Kuta Beach</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Gunung Agung</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Sunrise Candidasa</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Air Terjun Tegenungan</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Pantai Tanah Lot</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Gunung Batur</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Sunrise Sanur</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Air Terjun Gitgit</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Sunset Kuta Beach</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Gunung Agung</span>
            <span class="marquee-item"><span class="marquee-dot"></span>Sunrise Candidasa</span>
        </div>
    </div>


    <!-- ===== STATS STRIP ===== -->
    <section class="stats-strip" aria-label="Statistik Dewasufa">
        <div class="stats-grid">
            <div class="stat-item reveal">
                <span class="stat-icon" aria-hidden="true">💧</span>
                <h3>50+</h3>
                <p>Air Terjun</p>
            </div>
            <div class="stat-item reveal" style="transition-delay: 0.1s">
                <span class="stat-icon" aria-hidden="true">🌅</span>
                <h3>30+</h3>
                <p>Pantai Sunset</p>
            </div>
            <div class="stat-item reveal" style="transition-delay: 0.2s">
                <span class="stat-icon" aria-hidden="true">🌄</span>
                <h3>25+</h3>
                <p>Pantai Sunrise</p>
            </div>
            <div class="stat-item reveal" style="transition-delay: 0.3s">
                <span class="stat-icon" aria-hidden="true">⛰️</span>
                <h3>10+</h3>
                <p>Puncak Gunung</p>
            </div>
        </div>
    </section>


    <!-- ===== CATEGORIES ===== -->
    <section id="categories" class="categories">
        <div class="section-header reveal">
            <span class="section-tag">✦ Kategori Alam</span>
            <h2>Empat Pesona<br>Alam Bali</h2>
            <p>
                Setiap sudut Bali menyimpan keajaiban yang berbeda.
                Temukan momen yang paling berkesan dari setiap kategori keindahan alam.
            </p>
        </div>

        <div class="categories-grid">

            <!-- Waterfall -->
            <a href="#" class="category-card category-card--waterfall reveal" id="card-waterfall" style="transition-delay: 0.05s" aria-label="Jelajahi kategori Air Terjun">
                <img
                    src="/images/waterfall.jpg"
                    alt="Air terjun di Bali yang mengalir di tengah hutan tropis lebat"
                    class="category-card-img"
                    loading="lazy"
                >
                <div class="category-card-overlay"></div>
                <div class="category-card-body">
                    <div class="category-card-badge">
                        <span class="category-card-icon" aria-hidden="true">💧</span>
                        Waterfall
                    </div>
                    <h3>Air Terjun</h3>
                    <p>Tersembunyi di balik hutan tropis Bali, air terjun kristal yang dingin dan menyegarkan siap memeluk petualangan Anda.</p>
                    <div class="category-card-cta">
                        <span>Jelajahi Sekarang</span>
                        <span class="cta-arrow" aria-hidden="true">→</span>
                    </div>
                </div>
            </a>

            <!-- Sunset Beach -->
            <a href="#" class="category-card category-card--sunset reveal" id="card-sunset" style="transition-delay: 0.15s" aria-label="Jelajahi kategori Pantai Sunset">
                <img
                    src="/images/sunset-beach.jpg"
                    alt="Pantai Tanah Lot Bali dengan siluet pura saat matahari terbenam"
                    class="category-card-img"
                    loading="lazy"
                >
                <div class="category-card-overlay"></div>
                <div class="category-card-body">
                    <div class="category-card-badge">
                        <span class="category-card-icon" aria-hidden="true">🌇</span>
                        Sunset Beach
                    </div>
                    <h3>Pantai Sunset</h3>
                    <p>Langit yang terbakar oleh semburat oranye dan merah di ufuk barat. Setiap senja di Bali adalah mahakarya alam.</p>
                    <div class="category-card-cta">
                        <span>Jelajahi Sekarang</span>
                        <span class="cta-arrow" aria-hidden="true">→</span>
                    </div>
                </div>
            </a>

            <!-- Sunrise Beach -->
            <a href="#" class="category-card category-card--sunrise reveal" id="card-sunrise" style="transition-delay: 0.25s" aria-label="Jelajahi kategori Pantai Sunrise">
                <img
                    src="/images/sunrise-beach.jpg"
                    alt="Pantai Sanur Bali saat matahari terbit dengan warna langit keemasan dan merah muda"
                    class="category-card-img"
                    loading="lazy"
                >
                <div class="category-card-overlay"></div>
                <div class="category-card-body">
                    <div class="category-card-badge">
                        <span class="category-card-icon" aria-hidden="true">🌅</span>
                        Sunrise Beach
                    </div>
                    <h3>Pantai Sunrise</h3>
                    <p>Sambut pagi bersama cahaya pertama yang lembut menyentuh permukaan laut. Ketenangan yang hanya bisa ditemukan di tepi pantai Bali.</p>
                    <div class="category-card-cta">
                        <span>Jelajahi Sekarang</span>
                        <span class="cta-arrow" aria-hidden="true">→</span>
                    </div>
                </div>
            </a>

            <!-- Mountain -->
            <a href="#" class="category-card category-card--mountain reveal" id="card-mountain" style="transition-delay: 0.35s" aria-label="Jelajahi kategori Gunung">
                <img
                    src="/images/mountain.jpg"
                    alt="Gunung Batur Bali yang megah dikelilingi awan dan sawah terasering hijau"
                    class="category-card-img"
                    loading="lazy"
                >
                <div class="category-card-overlay"></div>
                <div class="category-card-body">
                    <div class="category-card-badge">
                        <span class="category-card-icon" aria-hidden="true">⛰️</span>
                        Mountain
                    </div>
                    <h3>Gunung</h3>
                    <p>Berdiri di puncak gunung berapi Bali, saksikan hamparan alam yang tak terbatas. Perjalanan yang akan mengubah cara pandang Anda.</p>
                    <div class="category-card-cta">
                        <span>Jelajahi Sekarang</span>
                        <span class="cta-arrow" aria-hidden="true">→</span>
                    </div>
                </div>
            </a>

        </div>
    </section>


    <!-- ===== HIGHLIGHT SECTION ===== -->
    <section id="highlights" class="highlight">
        <div class="highlight-inner">
            <div class="highlight-content reveal-left">
                <span class="section-tag">✦ Tentang Dewasufa</span>
                <h2>Panduan Alam Bali yang Paling Lengkap</h2>
                <p>
                    Dewasufa hadir sebagai teman perjalanan Anda dalam mengeksplorasi
                    keajaiban alam Bali. Dari lokasi tersembunyi hingga spot foto terbaik,
                    semua terangkum dalam satu platform.
                </p>

                <div class="highlight-features">
                    <div class="highlight-feature-item">Foto dan video berkualitas tinggi dari setiap lokasi</div>
                    <div class="highlight-feature-item">Informasi lengkap jalur dan waktu terbaik kunjungan</div>
                    <div class="highlight-feature-item">Koleksi 100 lebih destinasi alam pilihan di seluruh Bali</div>
                    <div class="highlight-feature-item">Diperbarui secara berkala oleh tim penjelajah lokal</div>
                </div>

                <div class="hero-actions" style="justify-content: flex-start;">
                    <a href="#categories" class="btn-primary" id="highlight-cta">
                        ✦ Lihat Semua Kategori
                    </a>
                </div>
            </div>

            <div class="highlight-visual reveal-right">
                <div class="highlight-img-wrap">
                    <img
                        src="/images/mountain.jpg"
                        alt="Pemandangan udara Gunung Batur dengan danau kawah dan sawah terasering"
                        loading="lazy"
                    >
                </div>
                <div class="highlight-badge-float" aria-label="Statistik konten">
                    <span class="badge-icon" aria-hidden="true">🗺️</span>
                    <div class="badge-text">
                        <strong>100+</strong>
                        <span>Destinasi Alam</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===== QUOTE SECTION ===== -->
    <section class="quote-section" aria-label="Kutipan inspirasi">
        <div class="quote-inner reveal">
            <span class="quote-mark" aria-hidden="true">"</span>
            <blockquote>
                Bali bukan sekadar tempat tujuan. Ia adalah pengalaman yang meresap ke dalam jiwa dan tidak pernah benar-benar meninggalkan diri Anda.
            </blockquote>
            <p class="quote-author">Dewasufa &mdash; Penjelajah Alam Bali</p>
        </div>
    </section>


    <!-- ===== FOOTER ===== -->
    <footer id="contact">
        <div class="footer-inner">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="#home" class="nav-logo" aria-label="Dewasufa Beranda">
                        <div class="nav-logo-icon" aria-hidden="true">D</div>
                        <span class="nav-logo-text">Dewasufa</span>
                    </a>
                    <p>Platform panduan keindahan alam Bali. Temukan, jelajahi, dan abadikan momen terbaik dari setiap sudut Pulau Dewata.</p>
                </div>

                <div class="footer-col">
                    <h4>Kategori</h4>
                    <a href="#" id="footer-waterfall">Air Terjun</a>
                    <a href="#" id="footer-sunset">Pantai Sunset</a>
                    <a href="#" id="footer-sunrise">Pantai Sunrise</a>
                    <a href="#" id="footer-mountain">Gunung</a>
                </div>

                <div class="footer-col">
                    <h4>Navigasi</h4>
                    <a href="#home" id="footer-home">Beranda</a>
                    <a href="#categories" id="footer-categories">Kategori Alam</a>
                    <a href="#highlights" id="footer-highlights">Sorotan</a>
                </div>

                <div class="footer-col">
                    <h4>Ikuti Kami</h4>
                    <a href="#" id="footer-instagram" rel="noopener noreferrer">Instagram</a>
                    <a href="#" id="footer-youtube" rel="noopener noreferrer">YouTube</a>
                    <a href="#" id="footer-tiktok" rel="noopener noreferrer">TikTok</a>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Dewasufa. <span aria-label="cinta"></span> Untuk keindahan alam Bali.</p>
                <div class="social-links" aria-label="Media sosial">
                    <a href="#" class="social-link" id="social-instagram" aria-label="Instagram Dewasufa" title="Instagram">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link" id="social-youtube" aria-label="YouTube Dewasufa" title="YouTube">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link" id="social-tiktok" aria-label="TikTok Dewasufa" title="TikTok">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>


    <script>
        // ---- Navbar scroll ----
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });

        // ---- Hamburger menu ----
        const hamburger = document.getElementById('hamburger');
        const navLinks  = document.getElementById('nav-links');
        hamburger.addEventListener('click', () => {
            const isOpen = navLinks.classList.toggle('open');
            hamburger.setAttribute('aria-expanded', isOpen);
            hamburger.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
        });

        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('open');
                hamburger.setAttribute('aria-expanded', 'false');
                hamburger.setAttribute('aria-label', 'Buka menu');
            });
        });

        // ---- Scroll reveal ----
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => {
            revealObserver.observe(el);
        });

        // ---- Hero parallax ----
        const heroBg = document.querySelector('.hero-bg');
        if (heroBg) {
            window.addEventListener('scroll', () => {
                const scrolled = window.scrollY;
                if (scrolled < window.innerHeight) {
                    heroBg.style.transform = `scale(1.05) translateY(${scrolled * 0.25}px)`;
                }
            }, { passive: true });
        }

        // ---- Floating particles ----
        (function spawnParticles() {
            const container = document.getElementById('hero-particles');
            if (!container) return;

            const colors = [
                'rgba(29,185,84,0.7)',
                'rgba(72,199,142,0.6)',
                'rgba(244,168,50,0.5)',
                'rgba(6,182,212,0.5)',
            ];

            function createParticle() {
                const p = document.createElement('div');
                p.classList.add('particle');
                const size    = Math.random() * 6 + 2;
                const left    = Math.random() * 100;
                const delay   = Math.random() * 6;
                const dur     = Math.random() * 10 + 8;
                const color   = colors[Math.floor(Math.random() * colors.length)];

                p.style.cssText = `
                    width: ${size}px;
                    height: ${size}px;
                    left: ${left}%;
                    bottom: -10px;
                    background: radial-gradient(circle, ${color}, transparent);
                    animation-duration: ${dur}s;
                    animation-delay: ${delay}s;
                `;
                container.appendChild(p);

                p.addEventListener('animationend', () => p.remove());
            }

            // Spawn continuously
            setInterval(createParticle, 600);
            for (let i = 0; i < 10; i++) createParticle();
        })();

        // ---- Smooth active nav link ----
        const sections = document.querySelectorAll('section[id], footer[id]');
        const navItems = document.querySelectorAll('.nav-links a');

        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    navItems.forEach(a => a.classList.remove('active'));
                    const active = document.querySelector(`.nav-links a[href="#${entry.target.id}"]`);
                    if (active) active.classList.add('active');
                }
            });
        }, { threshold: 0.4 });

        sections.forEach(s => sectionObserver.observe(s));
    </script>

</body>
</html>