<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dewasufa - Jelajahi 4 Pesona Alam Bali: Waterfall, Sunset Beach, Sunrise Beach, dan Mountain. Temukan surga tersembunyi Pulau Dewata dengan panduan terlengkap.">
    <meta name="keywords" content="Dewasufa, Bali, Waterfall Bali, Sunset Beach Bali, Sunrise Beach Bali, Mountain Bali, Wisata Alam Bali">
    <meta property="og:title" content="Dewasufa - Eksplorasi Keindahan Alam Bali">
    <meta property="og:description" content="Jelajahi 4 kategori alam Bali terbaik: Waterfall, Sunset Beach, Sunrise Beach, dan Mountain.">
    <meta property="og:type" content="website">

    <title>Dewasufa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- ===== FIXED SCENIC BACKGROUND (LOW OPACITY & DARK) ===== -->
    <div class="fixed-scenery-bg" aria-hidden="true">
        <div class="scenery-img"></div>
        <div class="scenery-dark-overlay"></div>
    </div>

    <!-- ===== FLOATING PILL NAVBAR ===== -->
    <header class="navbar-wrapper">
        <nav class="navbar" id="navbar" role="navigation" aria-label="Navigasi Utama">
            <!-- Brand Logo -->
            @php
                $logoFile = null;
                $possibleLogos = [
                    'images/logo.png',
                    'images/logo.svg',
                    'images/logo.webp',
                    'images/logo.jpg',
                    'images/logo.jpeg',
                    'logo.png',
                    'logo.svg',
                    'logo.webp',
                ];
                foreach ($possibleLogos as $file) {
                    if (file_exists(public_path($file))) {
                        $logoFile = $file;
                        break;
                    }
                }
            @endphp
            <a href="#home" class="nav-logo" aria-label="Dewasufa - Beranda">
                @if($logoFile)
                    <img src="{{ asset($logoFile) }}" alt="Dewasufa Logo" class="nav-logo-img">
                @else
                    <div class="nav-logo-leaf" aria-hidden="true">
                        <span>🌿</span>
                    </div>
                @endif
                <span class="nav-logo-text">Dewasufa</span>
            </a>

            <!-- Navigation Links -->
            <ul class="nav-menu" id="nav-menu">
                <li><a href="#home" class="active">Beranda</a></li>
                <li><a href="#welcome">Tentang</a></li>
                <li><a href="#categories">Kategori</a></li>
                <li><a href="#stats">Statistik</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>

            <!-- Nav Actions: LOGIN Button & Hamburger (Top Right) -->
            <div class="nav-actions">
                <!-- Tombol LOGIN di pojok kanan atas -->
                <button type="button" class="btn-nav-login" id="btn-open-login" aria-label="Masuk ke Akun Dewasufa">
                    <span>Login</span>
                </button>

                <!-- Mobile Hamburger -->
                <button class="nav-hamburger" id="hamburger-btn" aria-label="Buka Menu Navigasi" aria-expanded="false" aria-controls="nav-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </nav>
    </header>


    <!-- ===== HERO SECTION (ROUNDED CARD BANNER) ===== -->
    <section id="home" class="hero-wrapper" aria-label="Banner Utama Dewasufa">
        <div class="hero-card">
            <div class="hero-inner">
                <div class="hero-overlay" aria-hidden="true"></div>

                <div class="hero-content">
                    <!-- Top Pill Badge -->
                    <div class="hero-badge">
                        <span>Pesona Wisata Alam Bali</span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="hero-title">
                        Temukan Pesona Alami Bali dengan Mudah
                    </h1>

                    <!-- Subtitle -->
                    <p class="hero-subtitle">
                        Panduan eksklusif menyusuri 4 surga alam Pulau Dewata: gemuruh air terjun tropis,
                        hangatnya pantai sunset, ketenangan pantai sunrise, hingga kemegahan puncak gunung berapi.
                    </p>

                    <!-- Hero CTA Button -->
                    <div class="hero-action-row">
                        <a href="#categories" class="btn-hero-cta" id="btn-hero-explore">
                            <span>Mulai Eksplorasi</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ===== FLOATING PILL SEARCH & FILTER BAR (MATCHING SCREENSHOT) ===== -->
            <div class="search-pill-wrapper" id="search-bar">
                <div class="search-pill-outer">
                    <form class="search-pill-inner" id="search-form" onsubmit="handleSearch(event)">
                        <!-- Input Field -->
                        <div class="search-field">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#9ec7a6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <input
                                type="text"
                                id="search-keyword"
                                placeholder="Cari nama destinasi / spot di Bali..."
                                aria-label="Cari nama destinasi"
                                autocomplete="off"
                            >
                        </div>

                        <div class="search-divider" aria-hidden="true"></div>

                        <!-- Category Select Dropdown (4 Kategori) -->
                        <div class="search-category-select">
                            <select id="search-category" aria-label="Pilih Kategori Alam">
                                <option value="all">Pilih Kategori (Semua)</option>
                                <option value="waterfall">Waterfall (Air Terjun)</option>
                                <option value="sunset">Sunset Beach (Pantai Senja)</option>
                                <option value="sunrise">Sunrise Beach (Pantai Fajar)</option>
                                <option value="mountain">Mountain (Puncak Gunung)</option>
                            </select>
                        </div>

                        <!-- Search Icons Group -->
                        <div class="search-icons-group" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-search-submit" aria-label="Cari Sekarang">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            <span>Cari Destinasi</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- ===== WELCOME / FEATURE HIGHLIGHT SECTION ===== -->
    <section id="welcome" class="welcome-section">
        <div class="container">
            <div class="welcome-grid">
                <!-- Left Visual with Floating Badges -->
                <div class="welcome-visual-wrap">
                    <img
                        src="/images/eco-villa.jpg"
                        alt="Villa kayu alami di perbukitan Bali nan asri saat mentari pagi"
                        class="welcome-card-img"
                        loading="lazy"
                    >

                    <!-- Top-Left Circular Green Badge -->
                    <div class="badge-circle-top" title="Eksplorasi Alam Asli">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h-2v-6h2v6zm4 0h-2v-6h2v6zm-2-8a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                        </svg>
                        <span>Alam Asli</span>
                    </div>

                    <!-- Bottom-Right Circular Warm Sun Badge -->
                    <div class="badge-circle-bottom" title="Pulau Seribu Pura">
                        <span>☀️</span>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="welcome-content">
                    <span class="section-tag-pill" style="align-self: flex-start;">✦ Tentang Dewasufa</span>
                    <h2 class="welcome-title">Selamat Datang di Dewasufa Bali</h2>
                    <p class="welcome-desc">
                        Dewasufa mempersembahkan panduan terpercaya untuk menyusuri keasrian Pulau Dewata.
                        Kami mengelompokkan keindahan Bali ke dalam 4 kategori alam esensial: kesegaran <strong>Waterfall</strong>,
                        kehangatan magis <strong>Sunset Beach</strong>, ketenangan <strong>Sunrise Beach</strong>, dan kemegahan kaldera <strong>Mountain</strong>.
                    </p>

                    <!-- Key Feature Points -->
                    <div class="welcome-points">
                        <div class="welcome-point-item">
                            <div class="welcome-point-icon">✓</div>
                            <span>Akses Rute & Titik Akurat</span>
                        </div>
                        <div class="welcome-point-item">
                            <div class="welcome-point-icon">✓</div>
                            <span>Waktu Kunjungan Terbaik</span>
                        </div>
                        <div class="welcome-point-item">
                            <div class="welcome-point-icon">✓</div>
                            <span>50+ Spot Terverifikasi</span>
                        </div>
                        <div class="welcome-point-item">
                            <div class="welcome-point-icon">✓</div>
                            <span>Eksplorasi Ramah Lingkungan</span>
                        </div>
                    </div>

                    <div class="welcome-actions">
                        <a href="#categories" class="btn-welcome-cta">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                            </svg>
                            <span>Jelajahi 4 Kategori</span>
                        </a>
                        <a href="#stats" class="btn-welcome-secondary">
                            <span>Pelajari Selengkapnya →</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===== 4 CATEGORIES SECTION (WATERFALL, SUNSET BEACH, SUNRISE BEACH, MOUNTAIN) ===== -->
    <section id="categories" class="categories-section">
        <div class="container">
            <!-- Header -->
            <div class="section-title-wrap">
                <span class="section-tag-pill">Kategori Unggulan</span>
                <h2 class="section-heading">4 Kategori Pesona Alam Bali</h2>
                <p class="section-subhead">
                    Setiap sudut Pulau Dewata menyimpan keajaiban alam yang berbeda.
                    Pilih kategori favorit Anda untuk memulai penjelajahan tak terlupakan.
                </p>
            </div>

            <!-- Interactive Category Filter Tabs -->
            <div class="category-filter-tabs" role="tablist" aria-label="Filter Kategori">
                <button type="button" class="filter-tab-btn active" data-filter="all" onclick="filterCards('all', this)">Semua</button>
                <button type="button" class="filter-tab-btn" data-filter="waterfall" onclick="filterCards('waterfall', this)">Waterfall</button>
                <button type="button" class="filter-tab-btn" data-filter="sunset" onclick="filterCards('sunset', this)">Sunset Beach</button>
                <button type="button" class="filter-tab-btn" data-filter="sunrise" onclick="filterCards('sunrise', this)">Sunrise Beach</button>
                <button type="button" class="filter-tab-btn" data-filter="mountain" onclick="filterCards('mountain', this)">Mountain</button>
            </div>

            <!-- Cards Grid (Matching reference layout with 4 categories) -->
            <div class="category-cards-grid" id="cards-container">

                <!-- 1. WATERFALL -->
                <article class="cat-card" data-category="waterfall" id="card-waterfall">
                    <div class="cat-card-img-wrap">
                        <img
                            src="/images/waterfall.jpg"
                            alt="Air terjun tropis asri di pedalaman Bali yang dikelilingi hutan hijau"
                            class="cat-card-img"
                            loading="lazy"
                        >
                        <div class="cat-card-badge">
                            <span>💧</span>
                            <span>Waterfall</span>
                        </div>
                        <div class="cat-card-count">15+ Destinasi</div>
                    </div>
                    <div class="cat-card-body">
                        <h3 class="cat-card-title">Waterfall</h3>
                        <div class="cat-card-subtitle">Air Terjun Alami Tropis</div>
                        <p class="cat-card-desc">
                            Gemuruh air jernih dan segar yang membelah keheningan hutan tropis Bali. Nikmati kedamaian di Sekumpul, Gitgit, Aling-Aling, dan Tegenungan.
                        </p>
                        <button
                            type="button"
                            class="btn-card-action"
                            onclick="openDestModal('waterfall')"
                            aria-label="Lihat destinasi Waterfall"
                        >
                            <span>Jelajahi Waterfall</span>
                        </button>
                    </div>
                </article>

                <!-- 2. SUNSET BEACH -->
                <article class="cat-card" data-category="sunset" id="card-sunset">
                    <div class="cat-card-img-wrap">
                        <img
                            src="/images/sunset-beach.jpg"
                            alt="Pantai Tanah Lot Bali saat matahari terbenam dengan siluet pura di atas karang"
                            class="cat-card-img"
                            loading="lazy"
                        >
                        <div class="cat-card-badge">
                            <span>🌇</span>
                            <span>Sunset Beach</span>
                        </div>
                        <div class="cat-card-count">18+ Destinasi</div>
                    </div>
                    <div class="cat-card-body">
                        <h3 class="cat-card-title">Sunset Beach</h3>
                        <div class="cat-card-subtitle">Pantai Matahari Terbenam</div>
                        <p class="cat-card-desc">
                            Langit yang terbakar oleh semburat jingga dan emas di ufuk barat. Saksikan mahakarya senja dramatis di Tanah Lot, Uluwatu, Melasti, dan Kuta.
                        </p>
                        <button
                            type="button"
                            class="btn-card-action"
                            onclick="openDestModal('sunset')"
                            aria-label="Lihat destinasi Sunset Beach"
                        >
                            <span>Jelajahi Sunset Beach</span>
                        </button>
                    </div>
                </article>

                <!-- 3. SUNRISE BEACH -->
                <article class="cat-card" data-category="sunrise" id="card-sunrise">
                    <div class="cat-card-img-wrap">
                        <img
                            src="/images/sunrise-beach.jpg"
                            alt="Pantai Sanur Bali saat fajar pagi dengan kilau cahaya mentari pertama di atas air"
                            class="cat-card-img"
                            loading="lazy"
                        >
                        <div class="cat-card-badge">
                            <span>🌅</span>
                            <span>Sunrise Beach</span>
                        </div>
                        <div class="cat-card-count">12+ Destinasi</div>
                    </div>
                    <div class="cat-card-body">
                        <h3 class="cat-card-title">Sunrise Beach</h3>
                        <div class="cat-card-subtitle">Pantai Matahari Terbit</div>
                        <p class="cat-card-desc">
                            Sambut fajar dengan ketenangan magis saat sinar mentari pertama menyentuh pesisir timur Bali. Pilihan syahdu di Sanur, Candidasa, Kusamba, dan Amed.
                        </p>
                        <button
                            type="button"
                            class="btn-card-action"
                            onclick="openDestModal('sunrise')"
                            aria-label="Lihat destinasi Sunrise Beach"
                        >
                            <span>Jelajahi Sunrise Beach</span>
                        </button>
                    </div>
                </article>

                <!-- 4. MOUNTAIN -->
                <article class="cat-card" data-category="mountain" id="card-mountain">
                    <div class="cat-card-img-wrap">
                        <img
                            src="/images/mountain.jpg"
                            alt="Pemandangan udara Gunung Batur Bali dengan danau kawah dan sawah terasering"
                            class="cat-card-img"
                            loading="lazy"
                        >
                        <div class="cat-card-badge">
                            <span>⛰️</span>
                            <span>Mountain</span>
                        </div>
                        <div class="cat-card-count">8+ Destinasi</div>
                    </div>
                    <div class="cat-card-body">
                        <h3 class="cat-card-title">Mountain</h3>
                        <div class="cat-card-subtitle">Puncak Gunung & Kaldera</div>
                        <p class="cat-card-desc">
                            Berdiri di atas samudera awan kaldera Gunung Batur dan puncak Gunung Agung. Nikmati pemandangan tak berbatas yang menggetarkan jiwa.
                        </p>
                        <button
                            type="button"
                            class="btn-card-action"
                            onclick="openDestModal('mountain')"
                            aria-label="Lihat destinasi Mountain"
                        >
                            <span>Jelajahi Mountain</span>
                        </button>
                    </div>
                </article>

            </div>

            <!-- Pagination Dots (Matching screenshot) -->
            <div class="cards-pagination-dots" aria-label="Pagination Kategori">
                <span class="pagination-dot active" onclick="filterCards('all', document.querySelector('.filter-tab-btn[data-filter=\"all\"]'))"></span>
                <span class="pagination-dot" onclick="filterCards('waterfall', document.querySelector('.filter-tab-btn[data-filter=\"waterfall\"]'))"></span>
                <span class="pagination-dot" onclick="filterCards('sunset', document.querySelector('.filter-tab-btn[data-filter=\"sunset\"]'))"></span>
                <span class="pagination-dot" onclick="filterCards('sunrise', document.querySelector('.filter-tab-btn[data-filter=\"sunrise\"]'))"></span>
                <span class="pagination-dot" onclick="filterCards('mountain', document.querySelector('.filter-tab-btn[data-filter=\"mountain\"]'))"></span>
            </div>
        </div>
    </section>


    <!-- ===== STATS STRIP ===== -->
    <section id="stats" class="container">
        <div class="stats-strip">
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-icon" aria-hidden="true">💧</span>
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Air Terjun Alami</div>
                </div>
                <div class="stat-item">
                    <span class="stat-icon" aria-hidden="true">🌇</span>
                    <div class="stat-number">30+</div>
                    <div class="stat-label">Pantai Sunset Menawan</div>
                </div>
                <div class="stat-item">
                    <span class="stat-icon" aria-hidden="true">🌅</span>
                    <div class="stat-number">25+</div>
                    <div class="stat-label">Pantai Sunrise Syahdu</div>
                </div>
                <div class="stat-item">
                    <span class="stat-icon" aria-hidden="true">⛰️</span>
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Puncak & Jalur Trekking</div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===== BALI PHILOSOPHY BANNER ===== -->
    <section class="container">
        <div class="quote-banner">
            <blockquote>
                "Tri Hita Karana mengajarkan keharmonisan abadi antara manusia, alam semesta, dan sang pencipta.
                Jelajahi Bali dengan rasa hormat dan lestarikan keasrian alamnya untuk generasi mendatang."
            </blockquote>
            <p class="quote-author">✦ Filosofi Alam Dewasufa Bali ✦</p>
        </div>
    </section>


    <!-- ===== SITE FOOTER ===== -->
    <footer id="contact" class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <!-- Brand Col -->
                <div class="footer-brand">
                    <a href="#home" class="nav-logo" aria-label="Dewasufa Beranda">
                        @if($logoFile)
                            <img src="{{ asset($logoFile) }}" alt="Dewasufa Logo" class="nav-logo-img">
                        @else
                            <div class="nav-logo-leaf" aria-hidden="true">
                                <span>🌿</span>
                            </div>
                        @endif
                        <span class="nav-logo-text">Dewasufa</span>
                    </a>
                    <p class="footer-about">
                        Platform kurasi dan panduan keindahan alam Bali. Temukan inspirasi penjelajahan dari 4 kategori alam terbaik di Pulau Dewata.
                    </p>
                </div>

                <!-- 4 Kategori Col -->
                <div class="footer-col">
                    <h4>4 Kategori Alam</h4>
                    <ul>
                        <li><a href="javascript:void(0)" onclick="openDestModal('waterfall')">💧 Waterfall</a></li>
                        <li><a href="javascript:void(0)" onclick="openDestModal('sunset')">🌇 Sunset Beach</a></li>
                        <li><a href="javascript:void(0)" onclick="openDestModal('sunrise')">🌅 Sunrise Beach</a></li>
                        <li><a href="javascript:void(0)" onclick="openDestModal('mountain')">⛰️ Mountain</a></li>
                    </ul>
                </div>

                <!-- Navigasi Col -->
                <div class="footer-col">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="#home">Beranda</a></li>
                        <li><a href="#welcome">Tentang Kami</a></li>
                        <li><a href="#categories">Kategori Destinasi</a></li>
                        <li><a href="#stats">Statistik Spot</a></li>
                    </ul>
                </div>

                <!-- Hubungi & Sosial -->
                <div class="footer-col">
                    <h4>Terhubung</h4>
                    <ul>
                        <li><a href="javascript:void(0)" onclick="openLoginModal()">Login Anggota</a></li>
                        <li><a href="mailto:info@dewasufa.bali">info@dewasufa.bali</a></li>
                        <li><a href="#home">Denpasar, Bali - Indonesia</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Dewasufa Bali. Seluruh hak cipta dilindungi.</p>
                <div class="social-links" aria-label="Media Sosial Dewasufa">
                    <a href="#" class="social-btn" aria-label="Instagram Dewasufa" title="Instagram">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-btn" aria-label="YouTube Dewasufa" title="YouTube">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>


    <!-- ===== MODAL: LOGIN POPUP (DIBUKA LEWAT TOMBOL LOGIN DI POJOK KANAN ATAS) ===== -->
    <div class="modal-overlay" id="login-modal" role="dialog" aria-modal="true" aria-labelledby="login-title">
        <div class="modal-box">
            <button type="button" class="modal-close-btn" id="btn-close-login" aria-label="Tutup Login Modal">&times;</button>

            <div class="modal-header">
                <div class="modal-logo-leaf" aria-hidden="true">🌿</div>
                <h3 class="modal-title" id="login-title">Masuk ke Dewasufa</h3>
                <p class="modal-subtitle">Akses panduan eksklusif dan simpan destinasi favorit Anda</p>
            </div>

            <form id="login-form" onsubmit="handleLoginSubmit(event)">
                <div class="form-group">
                    <label for="login-email" class="form-label">Email Anda</label>
                    <input type="email" id="login-email" class="form-input" placeholder="nama@email.com" required autocomplete="email">
                </div>

                <div class="form-group">
                    <label for="login-password" class="form-label">Kata Sandi</label>
                    <input type="password" id="login-password" class="form-input" placeholder="••••••••" required autocomplete="current-password">
                </div>

                <div class="form-options">
                    <label class="form-checkbox">
                        <input type="checkbox" id="remember-me" checked>
                        <span>Ingat saya</span>
                    </label>
                    <a href="javascript:void(0)" class="form-forgot-link" onclick="showToast('Fitur reset sandi telah dikirim ke email.')">Lupa sandi?</a>
                </div>

                <button type="submit" class="btn-modal-submit">
                    <span>Masuk Sekarang</span>
                </button>

                <div class="modal-divider">
                    <span>atau masuk dengan</span>
                </div>

                <button type="button" class="btn-social-login" onclick="simulateGoogleLogin()">
                    <svg width="18" height="18" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.26v3.15C3.27 21.37 7.34 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.26C.46 8.17 0 9.99 0 12s.46 3.83 1.26 5.42l4.02-3.15z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.27 2.63 1.26 6.58l4.02 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                    </svg>
                    <span>Masuk dengan Google</span>
                </button>
            </form>
        </div>
    </div>


    <!-- ===== MODAL: DESTINATION DETAILS ===== -->
    <div class="modal-overlay" id="dest-modal" role="dialog" aria-modal="true" aria-labelledby="dest-modal-title">
        <div class="modal-box dest-modal-box">
            <button type="button" class="modal-close-btn" id="btn-close-dest" onclick="closeDestModal()">&times;</button>

            <img id="dest-modal-image" src="/images/waterfall.jpg" alt="Destinasi Alam Bali" class="dest-modal-img">

            <div class="modal-header" style="text-align: left; margin-bottom: 12px;">
                <span id="dest-modal-badge" class="section-tag-pill" style="margin-bottom: 8px;">Waterfall</span>
                <h3 class="modal-title" id="dest-modal-title">Spot Unggulan Air Terjun Bali</h3>
                <p class="modal-subtitle" id="dest-modal-subtitle">Daftar lokasi terindah yang wajib Anda kunjungi di Bali</p>
            </div>

            <div class="dest-spots-list" id="dest-spots-container">
                <!-- Injected via JavaScript -->
            </div>

            <button type="button" class="btn-modal-submit" onclick="closeDestModal()">
                <span>Tutup Panduan</span>
            </button>
        </div>
    </div>


    <!-- ===== TOAST ALERT ===== -->
    <div class="toast-alert" id="toast-alert">
        <span id="toast-icon">✓</span>
        <span id="toast-text">Berhasil!</span>
    </div>


    <!-- ===== JAVASCRIPT LOGIC ===== -->
    <script>
        // Data 4 Kategori Wisata Alam Bali
        const categoryData = {
            waterfall: {
                title: "Spot Unggulan Waterfall (Air Terjun) Bali",
                subtitle: "Suara gemuruh air sejuk berpadu dengan ketenangan hutan tropis",
                badge: "💧 Waterfall Bali",
                image: "/images/waterfall.jpg",
                spots: [
                    { name: "Air Terjun Sekumpul", desc: "Dikenal sebagai air terjun terindah di Buleleng, utara Bali.", time: "07:00 - 16:00 WITA" },
                    { name: "Air Terjun Tegenungan", desc: "Akses mudah di Gianyar, dekat Ubud dengan kolam alami.", time: "06:30 - 18:00 WITA" },
                    { name: "Air Terjun Gitgit", desc: "Air terjun legendaris dengan ketinggian 35 meter di Singaraja.", time: "08:00 - 17:00 WITA" },
                    { name: "Air Terjun Aling-Aling", desc: "Sensasi seluncur alami dan cliff jumping yang menantang.", time: "08:00 - 16:30 WITA" }
                ]
            },
            sunset: {
                title: "Spot Unggulan Sunset Beach (Pantai Senja) Bali",
                subtitle: "Kilau keemasan senja yang membakar langit barat Pulau Dewata",
                badge: "🌇 Sunset Beach Bali",
                image: "/images/sunset-beach.jpg",
                spots: [
                    { name: "Pantai Tanah Lot", desc: "Pura suci di atas bongkahan karang dengan siluet matahari terbenam spektakuler.", time: "17:00 - 18:45 WITA" },
                    { name: "Pantai Uluwatu / Suluban", desc: "Tebing karang megah dengan ombak peselancar kelas dunia.", time: "16:30 - 18:30 WITA" },
                    { name: "Pantai Melasti Ungasan", desc: "Tebing kapur menjulang dengan pasir putih bersih dan sunset magis.", time: "16:00 - 19:00 WITA" },
                    { name: "Pantai Kuta & Legian", desc: "Garis pantai ikonik nan landai untuk menikmati senja santai.", time: "17:00 - 18:30 WITA" }
                ]
            },
            sunrise: {
                title: "Spot Unggulan Sunrise Beach (Pantai Fajar) Bali",
                subtitle: "Ketenangan pagi menyambut cahaya mentari pertama di pesisir timur",
                badge: "🌅 Sunrise Beach Bali",
                image: "/images/sunrise-beach.jpg",
                spots: [
                    { name: "Pantai Sanur", desc: "Suasana pagi yang tenang dengan gazebo klasik dan jalur sepeda tepi laut.", time: "05:45 - 06:45 WITA" },
                    { name: "Pantai Candidasa", desc: "Ketenangan pesisir Karangasem dengan pemandangan pulau kecil di kejauhan.", time: "05:30 - 06:30 WITA" },
                    { name: "Pantai Kusamba Klungkung", desc: "Pasir hitam eksotis dan aktivitas pembuat garam tradisional saat fajar.", time: "05:30 - 06:30 WITA" },
                    { name: "Pantai Amed", desc: "Perahu jukung tradisional bersandar dengan latar fajar dan siluet Gunung Agung.", time: "05:15 - 06:30 WITA" }
                ]
            },
            mountain: {
                title: "Spot Unggulan Mountain (Puncak Gunung) Bali",
                subtitle: "Keagungan kaldera berapi dan panorama samudera awan yang megah",
                badge: "⛰️ Mountain Bali",
                image: "/images/mountain.jpg",
                spots: [
                    { name: "Gunung Batur (1.717 mdpl)", desc: "Sunrise trekking paling populer dengan kaldera luas dan Danau Batur.", time: "03:30 - 09:00 WITA" },
                    { name: "Gunung Agung (3.142 mdpl)", desc: "Titik tertinggi dan tersuci di Bali untuk pendaki berpengalaman.", time: "Pendakian Malam Hari" },
                    { name: "Bukit Campuhan Ubud", desc: "Jalur punggung bukit ilalang hijau yang sejuk dan ramah keluarga.", time: "06:00 - 08:30 WITA" },
                    { name: "Gunung Abang (2.152 mdpl)", desc: "Puncak berhutan rindang di seberang Kaldera Batur yang damai.", time: "03:00 - 10:00 WITA" }
                ]
            }
        };

        // Modal Login Elements
        const loginModal = document.getElementById('login-modal');
        const btnOpenLogin = document.getElementById('btn-open-login');
        const btnCloseLogin = document.getElementById('btn-close-login');

        function openLoginModal() {
            loginModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                document.getElementById('login-email').focus();
            }, 100);
        }

        function closeLoginModal() {
            loginModal.classList.remove('active');
            document.body.style.overflow = '';
        }

        btnOpenLogin.addEventListener('click', openLoginModal);
        btnCloseLogin.addEventListener('click', closeLoginModal);
        loginModal.addEventListener('click', (e) => {
            if (e.target === loginModal) closeLoginModal();
        });

        // Quick search icon triggers focus on search input
        document.getElementById('btn-quick-search').addEventListener('click', () => {
            const input = document.getElementById('search-keyword');
            input.scrollIntoView({ behavior: 'smooth', block: 'center' });
            setTimeout(() => input.focus(), 400);
        });

        // Destination Modal Elements
        const destModal = document.getElementById('dest-modal');

        function openDestModal(categoryKey) {
            const data = categoryData[categoryKey];
            if (!data) return;

            document.getElementById('dest-modal-title').textContent = data.title;
            document.getElementById('dest-modal-subtitle').textContent = data.subtitle;
            document.getElementById('dest-modal-badge').textContent = data.badge;
            document.getElementById('dest-modal-image').src = data.image;

            const container = document.getElementById('dest-spots-container');
            container.innerHTML = '';

            data.spots.forEach(spot => {
                const item = document.createElement('div');
                item.className = 'dest-spot-card';
                item.innerHTML = `
                    <div class="dest-spot-info">
                        <h5>${spot.name}</h5>
                        <p>${spot.desc}</p>
                    </div>
                    <div class="dest-spot-time">⏱ ${spot.time}</div>
                `;
                container.appendChild(item);
            });

            destModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeDestModal() {
            destModal.classList.remove('active');
            document.body.style.overflow = '';
        }

        destModal.addEventListener('click', (e) => {
            if (e.target === destModal) closeDestModal();
        });

        // ESC Key Close Modals
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeLoginModal();
                closeDestModal();
            }
        });

        // Toast Notification Function
        function showToast(message, icon = '✓') {
            const toast = document.getElementById('toast-alert');
            const toastText = document.getElementById('toast-text');
            const toastIcon = document.getElementById('toast-icon');

            toastText.textContent = message;
            toastIcon.textContent = icon;
            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3500);
        }

        // Form Login Submit
        function handleLoginSubmit(event) {
            event.preventDefault();
            const email = document.getElementById('login-email').value;
            closeLoginModal();
            showToast(`Selamat datang kembali, ${email.split('@')[0]}! Anda berhasil masuk.`);
        }

        function simulateGoogleLogin() {
            closeLoginModal();
            showToast('Login dengan akun Google berhasil disimulasikan!');
        }

        // Filter Category Cards
        function filterCards(category, clickedButton) {
            // Update active tab buttons
            document.querySelectorAll('.filter-tab-btn').forEach(btn => btn.classList.remove('active'));
            if (clickedButton) {
                clickedButton.classList.add('active');
            } else {
                const targetBtn = document.querySelector(`.filter-tab-btn[data-filter="${category}"]`);
                if (targetBtn) targetBtn.classList.add('active');
            }

            // Update pagination dots
            const dots = document.querySelectorAll('.pagination-dot');
            dots.forEach(d => d.classList.remove('active'));
            const catIndex = ['all', 'waterfall', 'sunset', 'sunrise', 'mountain'].indexOf(category);
            if (catIndex !== -1 && dots[catIndex]) {
                dots[catIndex].classList.add('active');
            }

            // Filter cards display
            const cards = document.querySelectorAll('.cat-card');
            cards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'flex';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Floating Pill Search Handler
        function handleSearch(event) {
            event.preventDefault();
            const keyword = document.getElementById('search-keyword').value.toLowerCase().trim();
            const category = document.getElementById('search-category').value;

            // Scroll to categories section
            document.getElementById('categories').scrollIntoView({ behavior: 'smooth' });

            const cards = document.querySelectorAll('.cat-card');
            let matchedCount = 0;

            cards.forEach(card => {
                const cardCat = card.dataset.category;
                const cardText = card.textContent.toLowerCase();

                const matchesCat = (category === 'all' || cardCat === category);
                const matchesKeyword = !keyword || cardText.includes(keyword);

                if (matchesCat && matchesKeyword) {
                    card.style.display = 'flex';
                    matchedCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (matchedCount === 0) {
                showToast(`Tidak ditemukan destinasi untuk "${keyword}". Menampilkan semua.`, 'ℹ');
                setTimeout(() => filterCards('all'), 1800);
            } else {
                showToast(`Ditemukan ${matchedCount} kategori destinasi sesuai pencarian.`, '🔍');
            }
        }

        // Mobile Hamburger Menu
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const navMenu = document.getElementById('nav-menu');

        hamburgerBtn.addEventListener('click', () => {
            const isOpen = navMenu.classList.toggle('open');
            hamburgerBtn.setAttribute('aria-expanded', isOpen);
        });

        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('open');
                hamburgerBtn.setAttribute('aria-expanded', 'false');
            });
        });

        // Navbar scrolled shadow
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 40) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }, { passive: true });
    </script>

</body>
</html>