<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard Pengguna Dewasufa - Jelajahi dan kelola rencana destinasi wisata alam Bali Anda.">
    <title>Dashboard Pengguna - Dewasufa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="dashboard-body">

    <!-- Scenic Ambient Background (Blurred Glassmorphism Layer) -->
    <div class="dashboard-scenic-bg" aria-hidden="true">
        <div class="dashboard-bg-img"></div>
        <div class="dashboard-bg-overlay"></div>
    </div>

    <div class="dashboard-container">

        <!-- ===== TOP HEADER NAVIGATION ===== -->
        <header class="dash-topbar" role="banner">
            <!-- Search Bar -->
            <div class="dash-search-pill">
                <svg class="dash-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="dash-search-input" placeholder="Cari destinasi wisata Bali..." aria-label="Cari destinasi">
            </div>

            <!-- Category Filter Pills -->
            <nav class="dash-category-nav" aria-label="Filter Kategori">
                <button type="button" class="dash-cat-pill active" data-filter="all">Semua</button>
                <button type="button" class="dash-cat-pill" data-filter="waterfall">Waterfall</button>
                <button type="button" class="dash-cat-pill" data-filter="sunset">Sunset Beach</button>
                <button type="button" class="dash-cat-pill" data-filter="sunrise">Sunrise Beach</button>
                <button type="button" class="dash-cat-pill" data-filter="mountain">Mountain</button>
                <button type="button" class="dash-cat-pill" data-filter="trekking">Trekking</button>
            </nav>

            <!-- Right Actions: Notifications & User Profile -->
            <div class="dash-top-actions">
                <!-- Notification Bell -->
                <button type="button" class="dash-btn-icon-pill" id="btn-dash-notif" aria-label="Notifikasi">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    <span class="dash-notif-dot" aria-label="Pemberitahuan baru"></span>
                </button>

                <!-- User Profile Pill with Dropdown -->
                <div class="dash-user-dropdown-wrap">
                    <button type="button" class="dash-user-pill" id="dash-user-menu-btn" aria-haspopup="true" aria-expanded="false">
                        <div class="dash-avatar">
                            <span>🌿</span>
                        </div>
                        <div class="dash-user-info">
                            <span class="dash-user-name" id="dash-display-name">Wisatawan Bali</span>
                            <span class="dash-user-role">Member Dewasufa</span>
                        </div>
                        <svg class="dash-chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="dash-dropdown-menu" id="dash-user-dropdown">
                        <a href="javascript:void(0)" class="dash-dropdown-item text-gold" id="dash-btn-open-create">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                            <span>Buat Destinasi Baru</span>
                        </a>
                        <a href="{{ route('home') }}" class="dash-dropdown-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            </svg>
                            <span>Kembali ke Beranda</span>
                        </a>
                        <a href="javascript:void(0)" class="dash-dropdown-item" id="dash-btn-my-plan">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <span>Rencana Tersimpan</span>
                        </a>
                        <hr class="dash-dropdown-divider">
                        <a href="{{ route('home') }}" class="dash-dropdown-item text-danger" id="dash-btn-logout">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span>Keluar (Logout)</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>


        <!-- ===== MAIN DASHBOARD GRID ===== -->
        <main class="dash-main-grid" role="main">

            <!-- ===== LEFT COLUMN (SIDEBAR WIDGETS) ===== -->
            <aside class="dash-sidebar" aria-label="Widget Destinasi">

                <!-- Widget 1: Destinasi Baru Rilis / Baru Dibuat -->
                <div class="dash-glass-card dash-card-new">
                    <div class="dash-card-header">
                        <div class="dash-widget-title-wrap">
                            <h2 class="dash-widget-title">Destinasi Baru Rilis</h2>
                            <span class="dash-widget-subtitle">Baru Diunggah & Terverifikasi</span>
                        </div>
                        <button type="button" class="dash-btn-add-mini" id="btn-quick-create-spot" title="Buat Destinasi Baru" aria-label="Buat Destinasi Baru">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </button>
                    </div>

                    <div class="dash-new-spots-list" id="dash-new-spots-container">
                        <!-- Spot 1 -->
                        <div class="dash-mini-spot-card" onclick="openDashSpotDetail('sekumpul')">
                            <img src="/images/waterfall.jpg" alt="Air Terjun Sekumpul" class="dash-mini-img">
                            <div class="dash-mini-info">
                                <span class="dash-badge-launch">✨ Rilis Hari Ini</span>
                                <span class="dash-mini-title">Air Terjun Sekumpul Buleleng</span>
                            </div>
                            <button type="button" class="dash-circle-btn" aria-label="Lihat Rute">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </button>
                        </div>

                        <!-- Spot 2 -->
                        <div class="dash-mini-spot-card" onclick="openDashSpotDetail('sunset')">
                            <img src="/images/sunset-beach.jpg" alt="Sunset Melasti" class="dash-mini-img">
                            <div class="dash-mini-info">
                                <span class="dash-badge-launch badge-warm">✨ Spot Anyar</span>
                                <span class="dash-mini-title">Tebing Pantai Melasti Ungasan</span>
                            </div>
                            <button type="button" class="dash-circle-btn" aria-label="Lihat Rute">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Widget 2: Riwayat Terakhir Dilihat (Recently Viewed Destinations) -->
                <div class="dash-glass-card dash-card-history">
                    <div class="dash-card-header">
                        <div class="dash-widget-title-wrap">
                            <h2 class="dash-widget-title">Riwayat Terakhir Dilihat</h2>
                            <span class="dash-widget-subtitle">Aktivitas penelusuran Anda</span>
                        </div>
                        <button type="button" class="dash-see-all-link" id="btn-clear-history">Bersihkan</button>
                    </div>

                    <div class="dash-history-list" id="dash-history-container">
                        <!-- Item 1 -->
                        <div class="dash-history-item" onclick="openDashSpotDetail('waterfall')">
                            <div class="dash-history-icon-wrap bg-forest">
                                <span>💧</span>
                            </div>
                            <div class="dash-history-info">
                                <h4>Air Terjun Tegenungan</h4>
                                <span class="dash-history-time">🕒 Dilihat 5 menit lalu</span>
                            </div>
                            <button type="button" class="dash-circle-mini-btn" aria-label="Kunjungi Lagi">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </button>
                        </div>

                        <!-- Item 2 -->
                        <div class="dash-history-item" onclick="openDashSpotDetail('sunrise')">
                            <div class="dash-history-icon-wrap bg-warm">
                                <span>🌅</span>
                            </div>
                            <div class="dash-history-info">
                                <h4>Pantai Sanur Denpasar</h4>
                                <span class="dash-history-time">🕒 Dilihat 25 menit lalu</span>
                            </div>
                            <button type="button" class="dash-circle-mini-btn" aria-label="Kunjungi Lagi">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </button>
                        </div>

                        <!-- Item 3 -->
                        <div class="dash-history-item" onclick="openDashSpotDetail('mountain')">
                            <div class="dash-history-icon-wrap bg-emerald">
                                <span>⛰️</span>
                            </div>
                            <div class="dash-history-info">
                                <h4>Gunung Batur Kintamani</h4>
                                <span class="dash-history-time">🕒 Dilihat 1 jam lalu</span>
                            </div>
                            <button type="button" class="dash-circle-mini-btn" aria-label="Kunjungi Lagi">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </button>
                        </div>

                        <!-- Item 4 -->
                        <div class="dash-history-item" onclick="openDashSpotDetail('sunset')">
                            <div class="dash-history-icon-wrap bg-sunset">
                                <span>🌇</span>
                            </div>
                            <div class="dash-history-info">
                                <h4>Pura Luhur Uluwatu</h4>
                                <span class="dash-history-time">🕒 Dilihat kemarin</span>
                            </div>
                            <button type="button" class="dash-circle-mini-btn" aria-label="Kunjungi Lagi">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </aside>


            <!-- ===== RIGHT COLUMN (MAIN CONTENT & HERO) ===== -->
            <section class="dash-content-area" aria-label="Konten Utama Dashboard">

                <!-- Featured Hero Banner Card -->
                <article class="dash-hero-card" id="dash-featured-banner">
                    <div class="dash-hero-bg-img" id="dash-featured-img"></div>
                    <div class="dash-hero-overlay"></div>

                    <div class="dash-hero-content">
                        <!-- Trending Badge -->
                        <div class="dash-hero-badge">
                            <span>🔥</span>
                            <span id="dash-featured-trend">Trending Destinasi Minggu Ini</span>
                        </div>

                        <!-- Tag Pills -->
                        <div class="dash-hero-tags" id="dash-featured-tags">
                            <span class="dash-hero-tag">💧 Waterfall</span>
                            <span class="dash-hero-tag">Buleleng, Bali</span>
                        </div>

                        <!-- Title & Description -->
                        <h1 class="dash-hero-title" id="dash-featured-title">Sekumpul Hidden Falls: Mahakarya Tersembunyi Bali Utara</h1>
                        <p class="dash-hero-desc" id="dash-featured-desc">
                            Keanggunan tujuh tingkatan air terjun di lembah tropis yang asri. Nikmati udara murni,
                            pemandangan rimba hijau, serta panduan trekking lengkap bersama pemandu lokal berlisensi.
                        </p>

                        <!-- Action Buttons Row -->
                        <div class="dash-hero-actions">
                            <button type="button" class="dash-btn-primary" id="dash-hero-btn-start">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                                <span>Mulai Eksplorasi</span>
                            </button>

                            <button type="button" class="dash-btn-secondary" id="dash-hero-btn-guide">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>
                                <span>Panduan Rute</span>
                            </button>

                            <button type="button" class="dash-btn-bookmark" id="dash-hero-btn-bookmark" aria-label="Simpan ke Favorit">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Slider Arrow Controls (Bottom Right) -->
                    <div class="dash-slider-controls">
                        <button type="button" class="dash-slider-arrow" id="dash-slider-prev" aria-label="Slide Sebelumnya">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>
                        <button type="button" class="dash-slider-arrow" id="dash-slider-next" aria-label="Slide Berikutnya">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>
                </article>


                <!-- Bottom Recommendations Section ("You Might Like") -->
                <section class="dash-recom-section" aria-label="Rekomendasi Untuk Anda">
                    <div class="dash-section-header">
                        <h2 class="dash-section-title">Rekomendasi Untuk Anda</h2>
                        <a href="{{ route('home') }}#categories" class="dash-see-all-pill">Lihat Semua</a>
                    </div>

                    <div class="dash-recom-grid" id="dash-recom-grid">
                        <!-- Card 1: Waterfall -->
                        <div class="dash-recom-card" data-category="waterfall">
                            <div class="dash-recom-img-wrap">
                                <img src="/images/waterfall.jpg" alt="Air Terjun Tegenungan" class="dash-recom-img">
                                <span class="dash-recom-badge">💧 Waterfall</span>
                                <button type="button" class="dash-recom-more-btn" aria-label="Opsi">•••</button>
                            </div>
                            <div class="dash-recom-body">
                                <h3 class="dash-recom-card-title">Tegenungan Waterfall</h3>
                                <p class="dash-recom-card-desc">Kolam alami segar di lembah Gianyar dekat Ubud.</p>
                                <div class="dash-recom-footer">
                                    <span class="dash-recom-time">⏱ 06:30 - 18:00</span>
                                    <button type="button" class="dash-circle-btn" aria-label="Buka Spot" onclick="openDashSpotDetail('waterfall')">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Sunset Beach -->
                        <div class="dash-recom-card" data-category="sunset">
                            <div class="dash-recom-img-wrap">
                                <img src="/images/sunset-beach.jpg" alt="Pantai Tanah Lot" class="dash-recom-img">
                                <span class="dash-recom-badge badge-sunset">🌇 Sunset Beach</span>
                                <button type="button" class="dash-recom-more-btn" aria-label="Opsi">•••</button>
                            </div>
                            <div class="dash-recom-body">
                                <h3 class="dash-recom-card-title">Pantai Tanah Lot</h3>
                                <p class="dash-recom-card-desc">Siluet pura agung di atas karang laut saat senja.</p>
                                <div class="dash-recom-footer">
                                    <span class="dash-recom-time">⏱ 17:00 - 18:45</span>
                                    <button type="button" class="dash-circle-btn" aria-label="Buka Spot" onclick="openDashSpotDetail('sunset')">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Sunrise Beach -->
                        <div class="dash-recom-card" data-category="sunrise">
                            <div class="dash-recom-img-wrap">
                                <img src="/images/sunrise-beach.jpg" alt="Pantai Sanur" class="dash-recom-img">
                                <span class="dash-recom-badge badge-sunrise">🌅 Sunrise Beach</span>
                                <button type="button" class="dash-recom-more-btn" aria-label="Opsi">•••</button>
                            </div>
                            <div class="dash-recom-body">
                                <h3 class="dash-recom-card-title">Pantai Sanur</h3>
                                <p class="dash-recom-card-desc">Fajar hening nan damai dengan gazebo klasik tepi laut.</p>
                                <div class="dash-recom-footer">
                                    <span class="dash-recom-time">⏱ 05:45 - 06:45</span>
                                    <button type="button" class="dash-circle-btn" aria-label="Buka Spot" onclick="openDashSpotDetail('sunrise')">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Mountain -->
                        <div class="dash-recom-card" data-category="mountain">
                            <div class="dash-recom-img-wrap">
                                <img src="/images/mountain.jpg" alt="Gunung Batur" class="dash-recom-img">
                                <span class="dash-recom-badge badge-mountain">⛰️ Mountain</span>
                                <button type="button" class="dash-recom-more-btn" aria-label="Opsi">•••</button>
                            </div>
                            <div class="dash-recom-body">
                                <h3 class="dash-recom-card-title">Gunung Batur (1.717 mdpl)</h3>
                                <p class="dash-recom-card-desc">Trekking kaldera aktif dan samudera awan spektakuler.</p>
                                <div class="dash-recom-footer">
                                    <span class="dash-recom-time">⏱ 03:30 - 09:00</span>
                                    <button type="button" class="dash-circle-btn" aria-label="Buka Spot" onclick="openDashSpotDetail('mountain')">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </section>
        </main>
    </div>

    <!-- ===== MODAL BUAT DESTINASI BARU ===== -->
    <div class="dash-modal-backdrop" id="create-dest-modal" role="dialog" aria-modal="true" aria-labelledby="create-dest-title">
        <div class="dash-modal-card">
            <div class="dash-modal-header">
                <div class="dash-modal-title-wrap">
                    <span class="dash-modal-badge">✨ Kontribusi Wisatawan</span>
                    <h3 id="create-dest-title" class="dash-modal-title">Buat Destinasi Wisata Baru</h3>
                    <p class="dash-modal-subtitle">Tambahkan pesona alam Bali yang belum ada di platform Dewasufa.</p>
                </div>
                <button type="button" class="dash-modal-close" id="btn-close-create-dest" aria-label="Tutup Modal">&times;</button>
            </div>

            <form id="create-dest-form" onsubmit="handleCreateDestSubmit(event)">
                <div class="dash-form-grid">
                    <div class="dash-form-group">
                        <label for="new-dest-name">Nama Destinasi Wisata <span class="required">*</span></label>
                        <input type="text" id="new-dest-name" placeholder="Contoh: Air Terjun Banyumala Twin" required>
                    </div>

                    <div class="dash-form-group">
                        <label for="new-dest-category">Kategori Alam <span class="required">*</span></label>
                        <select id="new-dest-category" required>
                            <option value="waterfall">💧 Waterfall (Air Terjun)</option>
                            <option value="sunset">🌇 Sunset Beach (Pantai Senja)</option>
                            <option value="sunrise">🌅 Sunrise Beach (Pantai Fajar)</option>
                            <option value="mountain">⛰️ Mountain (Gunung & Bukit)</option>
                        </select>
                    </div>

                    <div class="dash-form-group">
                        <label for="new-dest-location">Wilayah / Kabupaten Bali <span class="required">*</span></label>
                        <input type="text" id="new-dest-location" placeholder="Contoh: Wanagiri, Buleleng, Bali" required>
                    </div>

                    <div class="dash-form-group">
                        <label for="new-dest-time">Jam Kunjungan Terbaik</label>
                        <input type="text" id="new-dest-time" placeholder="Contoh: 07:00 - 17:00 WITA" value="07:00 - 17:00 WITA">
                    </div>
                </div>

                <div class="dash-form-group">
                    <label for="new-dest-desc">Deskripsi & Keunikan Spot <span class="required">*</span></label>
                    <textarea id="new-dest-desc" rows="3" placeholder="Ceritakan keindahan panorama, daya tarik utama, akses trekking, atau tips berkunjung..." required></textarea>
                </div>

                <div class="dash-form-group">
                    <label>Pilih Gambar Representatif</label>
                    <div class="dash-preset-images">
                        <label class="dash-preset-label active">
                            <input type="radio" name="new-dest-preset-img" value="/images/waterfall.jpg" checked>
                            <img src="/images/waterfall.jpg" alt="Waterfall Preset">
                            <span>Waterfall</span>
                        </label>
                        <label class="dash-preset-label">
                            <input type="radio" name="new-dest-preset-img" value="/images/sunset-beach.jpg">
                            <img src="/images/sunset-beach.jpg" alt="Sunset Preset">
                            <span>Sunset</span>
                        </label>
                        <label class="dash-preset-label">
                            <input type="radio" name="new-dest-preset-img" value="/images/sunrise-beach.jpg">
                            <img src="/images/sunrise-beach.jpg" alt="Sunrise Preset">
                            <span>Sunrise</span>
                        </label>
                        <label class="dash-preset-label">
                            <input type="radio" name="new-dest-preset-img" value="/images/mountain.jpg">
                            <img src="/images/mountain.jpg" alt="Mountain Preset">
                            <span>Mountain</span>
                        </label>
                    </div>
                </div>

                <div class="dash-modal-actions">
                    <button type="button" class="dash-btn-secondary" id="btn-cancel-create-dest">Batal</button>
                    <button type="submit" class="dash-btn-primary">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Publikasikan Destinasi</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== TOAST ALERT NOTIFICATION ===== -->
    <div class="toast-alert" id="toast-alert">
        <span id="toast-icon">✓</span>
        <span id="toast-text">Berhasil!</span>
    </div>

</body>
</html>
