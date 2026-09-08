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
            </nav>

            <!-- Right Actions: Notifications & User Profile -->
            <div class="dash-top-actions">
                <!-- Notification Bell & Small Popover Modal -->
                <div class="dash-notif-wrap" id="dash-notif-wrap">
                    <button type="button" class="dash-btn-icon-pill" id="btn-dash-notif" aria-label="Notifikasi" aria-haspopup="true" aria-expanded="false">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="dash-notif-dot" id="dash-notif-badge" aria-label="Pemberitahuan baru"></span>
                    </button>

                    <!-- Small Notification Popover Modal -->
                    <div class="dash-notif-popover" id="dash-notif-popover" role="dialog" aria-label="Notifikasi Anda">
                        <div class="dash-notif-pop-header">
                            <span class="dash-notif-pop-title">Notifikasi</span>
                            <button type="button" class="dash-notif-pop-clear" id="btn-mark-notif-read">Tandai Dibaca</button>
                        </div>
                        <div class="dash-notif-pop-list">
                            <div class="dash-notif-pop-item unread">
                                <span class="dash-notif-indicator"></span>
                                <div class="dash-notif-pop-body">
                                    <p class="dash-notif-item-title">Verifikasi Akun</p>
                                    <p class="dash-notif-item-text">Pendaftaran status akun Anda sedang diverifikasi oleh admin.</p>
                                    <span class="dash-notif-item-time">Baru saja</span>
                                </div>
                            </div>
                            <div class="dash-notif-pop-item">
                                <span class="dash-notif-indicator"></span>
                                <div class="dash-notif-pop-body">
                                    <p class="dash-notif-item-title">Spot Populer Hari Ini</p>
                                    <p class="dash-notif-item-text">Air Terjun Sekumpul mendapatkan 120 ulasan wisatawan baru.</p>
                                    <span class="dash-notif-item-time">1 jam lalu</span>
                                </div>
                            </div>
                            <div class="dash-notif-pop-item">
                                <span class="dash-notif-indicator"></span>
                                <div class="dash-notif-pop-body">
                                    <p class="dash-notif-item-title">Pembaruan Rute</p>
                                    <p class="dash-notif-item-text">Jalur akses menuju Pantai Melasti telah diperbarui.</p>
                                    <span class="dash-notif-item-time">3 jam lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Profile Pill with Dropdown -->
                <div class="dash-user-dropdown-wrap">
                    <button type="button" class="dash-user-pill" id="dash-user-menu-btn" aria-haspopup="true" aria-expanded="false">
                        <div class="dash-avatar" id="dash-header-avatar">
                            <span class="dash-avatar-initials">W</span>
                        </div>
                        <div class="dash-user-info">
                            <span class="dash-user-name" id="dash-display-name">Wisatawan Bali</span>
                            <span class="dash-user-role" id="dash-user-role">User</span>
                        </div>
                        <svg class="dash-chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="dash-dropdown-menu" id="dash-user-dropdown">
                        <a href="javascript:void(0)" class="dash-dropdown-item text-gold" id="dash-btn-open-create">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                                <line x1="16" y1="8" x2="2" y2="22"></line>
                                <line x1="17.5" y1="15" x2="9" y2="15"></line>
                            </svg>
                            <span>Daftar sebagai Author</span>
                        </a>
                        <a href="javascript:void(0)" class="dash-dropdown-item" id="dash-btn-my-plan">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <span>Rencana Tersimpan</span>
                        </a>
                        <hr class="dash-dropdown-divider">
                        <a href="javascript:void(0)" class="dash-dropdown-item" id="dash-btn-open-settings">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                            <span>Pengaturan (Settings)</span>
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
                            <span class="dash-widget-subtitle">Baru Diunggah &amp; Terverifikasi</span>
                        </div>
                    </div>

                    <div class="dash-new-spots-list" id="dash-new-spots-container">
                        <!-- Spot 1 -->
                        <div class="dash-mini-spot-card" onclick="openDashSpotDetail('sekumpul')">
                            <img src="/images/waterfall.jpg" alt="Air Terjun Sekumpul" class="dash-mini-img">
                            <div class="dash-mini-info">
                                <span class="dash-mini-title">Air Terjun Sekumpul Buleleng</span>
                            </div>
                            <button type="button" class="dash-btn-lihat" aria-label="Lihat Rute">Lihat</button>
                        </div>

                        <!-- Spot 2 -->
                        <div class="dash-mini-spot-card" onclick="openDashSpotDetail('sunset')">
                            <img src="/images/sunset-beach.jpg" alt="Sunset Melasti" class="dash-mini-img">
                            <div class="dash-mini-info">
                                <span class="dash-mini-title">Tebing Pantai Melasti Ungasan</span>
                            </div>
                            <button type="button" class="dash-btn-lihat" aria-label="Lihat Rute">Lihat</button>
                        </div>
                    </div>
                </div>

                <!-- Widget 2: Riwayat Terakhir Dilihat (Recently Viewed Destinations) -->
                <div class="dash-glass-card dash-card-history">
                    <div class="dash-card-header">
                        <div class="dash-widget-title-wrap">
                            <h2 class="dash-widget-title">Riwayat Terakhir Dilihat</h2>
                            <span class="dash-widget-subtitle">Aktivitas penelusuran Anda </span>
                        </div>
                        <button type="button" class="dash-see-all-link dash-btn-clear-history" id="btn-clear-history" aria-label="Bersihkan riwayat">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                <path d="M10 11v6"></path>
                                <path d="M14 11v6"></path>
                                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="dash-history-list" id="dash-history-container">
                        <!-- Card 1 -->
                        <div class="dash-history-mini-card" data-spot-key="waterfall" onclick="openDashSpotDetail('waterfall')">
                            <img src="/images/waterfall.jpg" alt="Air Terjun Tegenungan" class="dash-mini-img">
                            <div class="dash-mini-info">
                                <span class="dash-mini-title">Air Terjun Tegenungan</span>
                            </div>
                            <button type="button" class="dash-btn-lihat" aria-label="Lihat">Lihat</button>
                        </div>

                        <!-- Card 2 -->
                        <div class="dash-history-mini-card" data-spot-key="sunrise" onclick="openDashSpotDetail('sunrise')">
                            <img src="/images/sunrise-beach.jpg" alt="Pantai Sanur" class="dash-mini-img">
                            <div class="dash-mini-info">
                                <span class="dash-mini-title">Pantai Sanur Denpasar</span>
                            </div>
                            <button type="button" class="dash-btn-lihat" aria-label="Lihat">Lihat</button>
                        </div>

                        <!-- Card 3 -->
                        <div class="dash-history-mini-card" data-spot-key="mountain" onclick="openDashSpotDetail('mountain')">
                            <img src="/images/mountain.jpg" alt="Gunung Batur" class="dash-mini-img">
                            <div class="dash-mini-info">
                                <span class="dash-mini-title">Gunung Batur Kintamani</span>
                            </div>
                            <button type="button" class="dash-btn-lihat" aria-label="Lihat">Lihat</button>
                        </div>

                        <!-- Card 4 -->
                        <div class="dash-history-mini-card" data-spot-key="sunset" onclick="openDashSpotDetail('sunset')">
                            <img src="/images/sunset-beach.jpg" alt="Pura Luhur Uluwatu" class="dash-mini-img">
                            <div class="dash-mini-info">
                                <span class="dash-mini-title">Pura Luhur Uluwatu</span>
                            </div>
                            <button type="button" class="dash-btn-lihat" aria-label="Lihat">Lihat</button>
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
                            <span id="dash-featured-trend">Trending Destinasi Minggu Ini</span>
                        </div>

                        <!-- Tag Pills -->
                        <div class="dash-hero-tags" id="dash-featured-tags">
                            <span class="dash-hero-tag">Waterfall</span>
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
                            <button type="button" class="dash-btn-primary" id="dash-hero-btn-start" aria-label="Lihat Destinasi" onclick="handleHeroLihatClick()">
                                <span>Lihat</span>
                            </button>

                            <button type="button" class="dash-btn-bookmark" id="dash-hero-btn-bookmark" aria-label="Simpan ke Rencana Tersimpan" title="Simpan ke Rencana Tersimpan">
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
                    </div>

                    <div class="dash-recom-grid" id="dash-recom-grid">
                        <!-- Card 1: Waterfall -->
                        <div class="dash-recom-card" data-category="waterfall">
                            <div class="dash-recom-img-wrap">
                                <img src="/images/waterfall.jpg" alt="Air Terjun Tegenungan" class="dash-recom-img">
                                <span class="dash-recom-badge">Waterfall</span>
                            </div>
                            <div class="dash-recom-body">
                                <h3 class="dash-recom-card-title">Tegenungan Waterfall</h3>
                                <p class="dash-recom-card-desc">Kolam alami segar di lembah Gianyar dekat Ubud.</p>
                                <div class="dash-recom-footer">
                                    <span class="dash-recom-time">06:30 - 18:00</span>
                                    <button type="button" class="dash-btn-lihat" aria-label="Lihat" onclick="openDashSpotDetail('waterfall')">Lihat</button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Sunset Beach -->
                        <div class="dash-recom-card" data-category="sunset">
                            <div class="dash-recom-img-wrap">
                                <img src="/images/sunset-beach.jpg" alt="Pantai Tanah Lot" class="dash-recom-img">
                                <span class="dash-recom-badge badge-sunset">Sunset Beach</span>
                            </div>
                            <div class="dash-recom-body">
                                <h3 class="dash-recom-card-title">Pantai Tanah Lot</h3>
                                <p class="dash-recom-card-desc">Siluet pura agung di atas karang laut saat senja.</p>
                                <div class="dash-recom-footer">
                                    <span class="dash-recom-time">17:00 - 18:45</span>
                                    <button type="button" class="dash-btn-lihat" aria-label="Lihat" onclick="openDashSpotDetail('sunset')">Lihat</button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Sunrise Beach -->
                        <div class="dash-recom-card" data-category="sunrise">
                            <div class="dash-recom-img-wrap">
                                <img src="/images/sunrise-beach.jpg" alt="Pantai Sanur" class="dash-recom-img">
                                <span class="dash-recom-badge badge-sunrise">Sunrise Beach</span>
                            </div>
                            <div class="dash-recom-body">
                                <h3 class="dash-recom-card-title">Pantai Sanur</h3>
                                <p class="dash-recom-card-desc">Fajar hening nan damai dengan gazebo klasik tepi laut.</p>
                                <div class="dash-recom-footer">
                                    <span class="dash-recom-time">05:45 - 06:45</span>
                                    <button type="button" class="dash-btn-lihat" aria-label="Lihat" onclick="openDashSpotDetail('sunrise')">Lihat</button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Mountain -->
                        <div class="dash-recom-card" data-category="mountain">
                            <div class="dash-recom-img-wrap">
                                <img src="/images/mountain.jpg" alt="Gunung Batur" class="dash-recom-img">
                                <span class="dash-recom-badge badge-mountain">Mountain</span>
                            </div>
                            <div class="dash-recom-body">
                                <h3 class="dash-recom-card-title">Gunung Batur (1.717 mdpl)</h3>
                                <p class="dash-recom-card-desc">Trekking kaldera aktif dan samudera awan spektakuler.</p>
                                <div class="dash-recom-footer">
                                    <span class="dash-recom-time">03:30 - 09:00</span>
                                    <button type="button" class="dash-btn-lihat" aria-label="Lihat" onclick="openDashSpotDetail('mountain')">Lihat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </section>
        </main>
    </div>

    <!-- ===== MODAL DAFTAR SEBAGAI AUTHOR ===== -->
    <div class="dash-modal-backdrop" id="create-dest-modal" role="dialog" aria-modal="true" aria-labelledby="create-dest-title">
        <div class="dash-modal-card">
            <div class="dash-modal-header">
                <div class="dash-modal-title-wrap">
                    <span class="dash-modal-badge">Komunitas Penulis Dewasufa</span>
                    <h3 id="create-dest-title" class="dash-modal-title">Daftar sebagai Author</h3>
                    <p class="dash-modal-subtitle">Lengkapi formulir akun di bawah ini untuk mendaftar menjadi Author resmi Dewasufa.</p>
                </div>
                <button type="button" class="dash-modal-close" id="btn-close-create-dest" aria-label="Tutup Modal">&times;</button>
            </div>

            <form id="create-dest-form" onsubmit="handleCreateDestSubmit(event)">
                <div class="dash-form-group">
                    <label for="author-username">Username <span class="required">*</span></label>
                    <input type="text" id="author-username" name="username" placeholder="Masukkan username Anda" required autocomplete="username">
                </div>

                <div class="dash-form-group">
                    <label for="author-email">Email <span class="required">*</span></label>
                    <input type="email" id="author-email" name="email" placeholder="contoh@email.com" required autocomplete="email">
                </div>

                <div class="dash-form-group">
                    <label for="author-password">Password <span class="required">*</span></label>
                    <input type="password" id="author-password" name="password" placeholder="Masukkan kata sandi akun" required autocomplete="new-password">
                </div>

                <!-- Pesan Status Verifikasi -->
                <div id="author-verification-status" class="dash-verification-notice" style="display: none;">
                    <div class="dash-verification-icon-box">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="dash-verification-info">
                        <span class="dash-verification-badge">Status Pendaftaran</span>
                        <p class="dash-verification-msg" id="dash-verification-text">sedang diverifikasi oleh admin</p>
                    </div>
                </div>

                <div class="dash-modal-actions">
                    <button type="button" class="dash-btn-secondary" id="btn-cancel-create-dest">Batal</button>
                    <button type="submit" class="dash-btn-primary" id="btn-submit-author-reg">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                        <span id="btn-author-reg-text">Daftar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL PENGATURAN (SETTINGS) ===== -->
    <div class="dash-modal-backdrop" id="dash-settings-modal" role="dialog" aria-modal="true" aria-labelledby="settings-modal-title">
        <div class="dash-modal-card dash-settings-card">
            <div class="dash-modal-header">
                <div class="dash-modal-title-wrap">
                    <span class="dash-modal-badge">Pengaturan Akun</span>
                    <h3 id="settings-modal-title" class="dash-modal-title">Pengaturan &amp; Preferensi</h3>
                    <p class="dash-modal-subtitle">Kelola informasi profil, preferensi eksplorasi wisata, dan sesi akun Anda.</p>
                </div>
                <button type="button" class="dash-modal-close" id="btn-close-settings" aria-label="Tutup Pengaturan">&times;</button>
            </div>

            <!-- Form Edit Profil Pengguna -->
            <form id="dash-settings-form" onsubmit="handleSaveSettings(event)">
                <div class="dash-settings-section">
                    <h4 class="dash-settings-sec-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>Informasi Profil</span>
                    </h4>

                    <!-- Upload Foto Profil Sendiri -->
                    <div class="dash-settings-avatar-wrap">
                        <div class="dash-avatar-preview-box" id="dash-avatar-preview-box">
                            <img id="settings-avatar-preview" src="" alt="Avatar" style="display: none;" class="dash-avatar-preview-img">
                            <span id="settings-avatar-fallback" class="dash-avatar-preview-fallback">W</span>
                        </div>
                        <div class="dash-avatar-upload-actions">
                            <label for="settings-avatar-input" class="dash-btn-upload-avatar">
                                <span>Pilih Foto Profil</span>
                            </label>
                            <input type="file" id="settings-avatar-input" accept="image/*" style="display: none;">
                            <div class="dash-avatar-btns">
                                <button type="button" class="dash-btn-remove-avatar" id="btn-remove-avatar" style="display: none;">Hapus Foto</button>
                            </div>
                            <span class="dash-avatar-hint">Format JPG, PNG, WEBP. Maksimal 2MB.</span>
                        </div>
                    </div>

                    <div class="dash-form-grid">
                        <div class="dash-form-group">
                            <label for="settings-name">Nama Lengkap</label>
                            <input type="text" id="settings-name" placeholder="Nama Anda" value="Wisatawan Bali">
                        </div>
                        <div class="dash-form-group">
                            <label for="settings-email">Email Terdaftar</label>
                            <input type="email" id="settings-email" placeholder="email@example.com" value="user@dewasufa.com">
                        </div>
                    </div>

                    <div class="dash-form-grid">
                        <div class="dash-form-group">
                            <label for="settings-role">Status Akun</label>
                            <input type="text" id="settings-role" value="User" readonly class="dash-input-readonly" title="Status akun hanya dapat diubah oleh sistem atau persetujuan Admin">
                            <span class="dash-field-hint">Hanya dapat diubah oleh sistem atau persetujuan Admin.</span>
                        </div>
                        <div class="dash-form-group">
                            <label for="settings-distance">Satuan Jarak Rute</label>
                            <select id="settings-distance">
                                <option value="km" selected>Kilometer (km)</option>
                                <option value="miles">Mil (miles)</option>
                            </select>
                        </div>
                    </div>

                    <div class="dash-form-grid">
                        <div class="dash-form-group">
                            <label for="settings-reset-password">Reset Password</label>
                            <input type="password" id="settings-reset-password" name="reset_password" placeholder="Masukkan password baru" autocomplete="new-password">
                        </div>
                        <div class="dash-form-group">
                            <label for="settings-confirm-password">Konfirmasi Password</label>
                            <input type="password" id="settings-confirm-password" name="confirm_password" placeholder="Ulangi password baru" autocomplete="new-password">
                        </div>
                    </div>
                </div>

                <!-- Preferensi Notifikasi & Eksplorasi -->
                <div class="dash-settings-section">
                    <h4 class="dash-settings-sec-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span>Preferensi Aplikasi</span>
                    </h4>

                    <div class="dash-settings-toggle-row">
                        <div class="dash-toggle-info">
                            <span class="dash-toggle-title">Pemberitahuan Rekomendasi Destinasi</span>
                            <span class="dash-toggle-sub">Terima tips wisata Bali dan spot anyar setiap minggu</span>
                        </div>
                        <label class="dash-switch">
                            <input type="checkbox" id="settings-toggle-notif" checked>
                            <span class="dash-switch-slider"></span>
                        </label>
                    </div>
                </div>

                <div class="dash-modal-actions" style="margin-bottom: 24px;">
                    <button type="submit" class="dash-btn-primary">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>

            <!-- ZONA LOGOUT (MASUK DI DALAM FITUR SETTING) -->
            <div class="dash-settings-danger-zone">
                <div class="dash-danger-info">
                    <h4 class="dash-danger-title">Sesi Akun & Logout</h4>
                    <p class="dash-danger-desc">
                        Ingin mengakhiri sesi penjelajahan Anda di Dewasufa? Anda dapat masuk kembali kapan saja.
                    </p>
                </div>
                <button type="button" class="dash-btn-logout-inside" id="dash-btn-logout-inside">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Logout</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ===== MODAL DETAIL DESTINASI (DESKRIPSI, RATING & KOMENTAR) ===== -->
    <div class="dash-modal-backdrop" id="dest-detail-modal" role="dialog" aria-modal="true" aria-labelledby="dest-detail-title">
        <div class="dash-modal-card dash-dest-detail-card">
            <!-- Modal Close Button -->
            <button type="button" class="dash-dest-close-btn" id="btn-close-dest-detail" aria-label="Tutup Detail Destinasi">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <!-- Two Column Main Layout -->
            <div class="dash-dest-main-layout">
                <!-- Left Column (Layout & Photos matching reference image) -->
                <div class="dash-dest-left-col">
                    <!-- Photo Grid: 1 Tall Main Image (Left) + 1 Wide Top Right + 2 Small Bottom Right -->
                    <div class="dash-dest-photo-grid">
                        <div class="dash-dest-photo-tall">
                            <img id="dest-detail-img" src="/images/waterfall.jpg" alt="Destinasi Utama" class="dash-dest-img-main">
                        </div>
                        <div class="dash-dest-photo-stack">
                            <div class="dash-dest-photo-wide">
                                <img id="dest-detail-img-thumb-1" src="/images/waterfall.jpg" alt="Foto Destinasi 2" class="dash-dest-img-thumb" onclick="swapDestDetailImage(1)">
                            </div>
                            <div class="dash-dest-photo-row">
                                <div class="dash-dest-photo-small">
                                    <img id="dest-detail-img-thumb-2" src="/images/waterfall.jpg" alt="Foto Destinasi 3" class="dash-dest-img-thumb" onclick="swapDestDetailImage(2)">
                                </div>
                                <div class="dash-dest-photo-small">
                                    <img id="dest-detail-img-thumb-3" src="/images/waterfall.jpg" alt="Foto Destinasi 4" class="dash-dest-img-thumb" onclick="swapDestDetailImage(3)">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Destination Header: Title & Badges -->
                    <div class="dash-dest-header-info">
                        <div class="dash-dest-title-row">
                            <h2 class="dash-dest-detail-title" id="dest-detail-title">Air Terjun Sekumpul</h2>
                            <button type="button" class="dash-dest-save-btn" id="btn-save-dest-plan" aria-label="Simpan ke Rencana Tersimpan" title="Simpan ke Rencana">
                                <svg id="dash-dest-save-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <span id="dash-dest-save-text">Simpan ke Rencana</span>
                            </button>
                        </div>
                        <div class="dash-dest-location-row">
                            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span id="dest-detail-location-text">Buleleng, Bali</span>
                        </div>
                        <!-- Tag Pills & Category -->
                        <div class="dash-dest-pills-row">
                            <span class="dash-dest-cat-pill" id="dest-detail-category">Air Terjun</span>
                            <div class="dash-dest-tags-wrap" id="dest-detail-tags"></div>
                        </div>
                    </div>

                    <!-- Features & Info Strip (Rating, Jam Buka, Tiket Masuk) -->
                    <div class="dash-dest-features-section">
                        <h4 class="dash-dest-subheading">Informasi & Fasilitas Destinasi</h4>
                        <div class="dash-dest-features-grid">
                            <div class="dash-dest-feat-item">
                                <div class="dash-dest-feat-icon">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                </div>
                                <div class="dash-dest-feat-text">
                                    <span class="dash-dest-feat-label">Rating</span>
                                    <span class="dash-dest-feat-val"><strong id="dest-detail-score">4.9</strong> / 5.0</span>
                                </div>
                            </div>
                            <div class="dash-dest-feat-item">
                                <div class="dash-dest-feat-icon">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </div>
                                <div class="dash-dest-feat-text">
                                    <span class="dash-dest-feat-label">Jam Buka</span>
                                    <span class="dash-dest-feat-val" id="dest-detail-time">07:00 - 16:00 WITA</span>
                                </div>
                            </div>
                            <div class="dash-dest-feat-item">
                                <div class="dash-dest-feat-icon">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
                                </div>
                                <div class="dash-dest-feat-text">
                                    <span class="dash-dest-feat-label">Tiket Masuk</span>
                                    <span class="dash-dest-feat-val" id="dest-detail-ticket">Rp 20.000</span>
                                </div>
                            </div>
                        </div>

                        <!-- Waktu Terbaik ditaruh di bawah agar tidak ada scroll ke samping -->
                        <div class="dash-dest-best-time-banner">
                            <div class="dash-dest-best-time-icon">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                </svg>
                            </div>
                            <div class="dash-dest-best-time-content">
                                <span class="dash-dest-best-time-label">Waktu Terbaik:</span>
                                <span class="dash-dest-best-time-val" id="dest-detail-best-visit">Pagi Hari</span>
                            </div>
                        </div>
                    </div>

                    <!-- Description & Mini Map Preview Section -->
                    <div class="dash-dest-desc-and-map">
                        <div class="dash-dest-desc-box">
                            <h4 class="dash-dest-subheading">Tentang Destinasi</h4>
                            <p class="dash-dest-desc-text" id="dest-detail-desc"></p>
                        </div>
                        <div class="dash-dest-map-card">
                            <div class="dash-dest-map-bg">
                                <div class="dash-dest-map-grid-pattern"></div>
                                <div class="dash-dest-map-pin">
                                    <svg viewBox="0 0 24 24" width="22" height="22" fill="#ef4444" stroke="#ffffff" stroke-width="1.5">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3" fill="#ffffff"></circle>
                                    </svg>
                                    <span class="dash-dest-map-pulse"></span>
                                </div>
                            </div>
                            <div class="dash-dest-map-footer">
                                <a id="dest-detail-gmaps-link" href="https://maps.google.com" target="_blank" rel="noopener noreferrer" class="dash-dest-gmaps-btn">
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                                    </svg>
                                    <span>Buka di Google Maps</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Comments & Reviews Section - takes smaller width) -->
                <div class="dash-dest-right-col">
                    <div class="dash-dest-reviews-card">
                        <!-- Card Header -->
                        <div class="dash-dest-reviews-card-header">
                            <div>
                                <h3 class="dash-dest-card-title">Ulasan Pengunjung</h3>
                                <p class="dash-dest-card-subtitle">Pengalaman wisatawan di destinasi ini</p>
                            </div>
                            <div class="dash-dest-rating-pill">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                <span id="dest-detail-score-side">4.9</span>
                            </div>
                        </div>

                        <!-- Add Comment Form -->
                        <form id="dest-comment-form" class="dash-comment-form-compact" onsubmit="handleCommentSubmit(event)">
                            <div class="dash-comment-rating-row">
                                <span class="dash-comment-rating-label">Beri Penilaian:</span>
                                <div class="dash-star-picker" id="comment-star-picker" role="radiogroup" aria-label="Pilih Bintang">
                                    <button type="button" class="dash-star-btn active" data-rating="1" aria-label="1 Bintang"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></button>
                                    <button type="button" class="dash-star-btn active" data-rating="2" aria-label="2 Bintang"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></button>
                                    <button type="button" class="dash-star-btn active" data-rating="3" aria-label="3 Bintang"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></button>
                                    <button type="button" class="dash-star-btn active" data-rating="4" aria-label="4 Bintang"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></button>
                                    <button type="button" class="dash-star-btn active" data-rating="5" aria-label="5 Bintang"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></button>
                                    <span class="dash-star-picker-val" id="comment-rating-val">5.0 / 5.0</span>
                                </div>
                            </div>

                            <input type="text" id="comment-author-name" class="dash-comment-name-input" placeholder="Nama Anda (Opsional)" maxlength="40">
                            <textarea id="comment-textarea" class="dash-comment-textarea" rows="2" placeholder="Bagikan ulasan atau tips kunjungan..." required></textarea>

                            <button type="submit" class="dash-btn-submit-comment" id="btn-submit-comment">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                </svg>
                                <span>Kirim Ulasan</span>
                            </button>
                        </form>

                        <!-- Comments Counter & List -->
                        <div class="dash-dest-comments-divider">
                            <span class="dash-dest-comment-badge" id="dest-comments-counter">2 Komentar</span>
                        </div>

                        <div class="dash-comments-list dash-comments-list-compact" id="dest-comments-list">
                            <!-- Injected dynamically -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MODAL RENCANA TERSIMPAN ===== -->
    <div class="dash-modal-backdrop" id="dash-saved-plans-modal" role="dialog" aria-modal="true" aria-labelledby="saved-plans-title">
        <div class="dash-modal-card dash-saved-plans-card">
            <div class="dash-modal-header">
                <div class="dash-modal-title-wrap">
                    <span class="dash-modal-badge">Koleksi Wisata Anda</span>
                    <h3 id="saved-plans-title" class="dash-modal-title">Rencana Tersimpan</h3>
                    <p class="dash-modal-subtitle">Daftar destinasi wisata alam Bali yang Anda simpan untuk rencana perjalanan.</p>
                </div>
                <button type="button" class="dash-modal-close" id="btn-close-saved-plans" aria-label="Tutup Rencana Tersimpan">&times;</button>
            </div>

            <div class="dash-saved-plans-content" id="dash-saved-plans-list">
                <!-- Diisi secara dinamis oleh JavaScript -->
            </div>
        </div>
    </div>

    <!-- ===== TOAST ALERT NOTIFICATION ===== -->
    <div class="toast-alert" id="toast-alert">
        <span id="toast-text">Berhasil!</span>
    </div>

</body>
</html>
