<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard Admin Dewasufa - Panel pengelolaan destinasi wisata alam Bali, verifikasi author, moderasi ulasan, dan statistik ekosistem.">
    <title>Admin Dashboard - Dewasufa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="dashboard-body admin-body">

    <!-- Scenic Ambient Background (Blurred Glassmorphism Layer) -->
    <div class="dashboard-scenic-bg" aria-hidden="true">
        <div class="dashboard-bg-img"></div>
        <div class="dashboard-bg-overlay"></div>
    </div>

    <!-- MAIN ADMIN APP CONTAINER (Matching Modern Rounded Dashboard Layout with Dark Luxury Glassmorphism) -->
    <div class="admin-app-shell">

        <!-- ============================================== -->
        <!-- 1. LEFT NAVIGATION SIDEBAR                    -->
        <!-- ============================================== -->
        <aside class="admin-sidebar" role="navigation" aria-label="Menu Utama Admin">
            <!-- Brand Logo -->
            <div class="admin-brand-wrap">
                <a href="{{ route('admin.dashboard') }}" class="admin-brand-link">
                    <div class="admin-brand-icon">
                        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <div class="admin-brand-text">
                        <span class="admin-brand-title">Dewasufa</span>
                        <span class="admin-brand-badge">Admin Portal</span>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="admin-nav-menu">
                <a href="javascript:void(0)" class="admin-nav-item active" data-nav="dashboard" onclick="handleNavClick(this, 'all')">
                    <div class="admin-nav-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                            <rect x="3" y="3" width="7" height="7" rx="2"></rect>
                            <rect x="14" y="3" width="7" height="7" rx="2"></rect>
                            <rect x="14" y="14" width="7" height="7" rx="2"></rect>
                            <rect x="3" y="14" width="7" height="7" rx="2"></rect>
                        </svg>
                    </div>
                    <span class="admin-nav-label">Dashboard</span>
                </a>

                <a href="javascript:void(0)" class="admin-nav-item" data-nav="destinasi" onclick="handleNavClick(this, 'destinasi')">
                    <div class="admin-nav-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <span class="admin-nav-label">Kelola Destinasi</span>
                    <span class="admin-nav-pill">16</span>
                </a>

                <a href="javascript:void(0)" class="admin-nav-item" data-nav="ulasan" onclick="handleNavClick(this, 'ulasan')">
                    <div class="admin-nav-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </div>
                    <span class="admin-nav-label">Moderasi Ulasan</span>
                    <span class="admin-nav-pill">12</span>
                </a>

                <a href="javascript:void(0)" class="admin-nav-item" data-nav="kategori" onclick="handleNavClick(this, 'kategori')">
                    <div class="admin-nav-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="8" y1="6" x2="21" y2="6"></line>
                            <line x1="8" y1="12" x2="21" y2="12"></line>
                            <line x1="8" y1="18" x2="21" y2="18"></line>
                            <line x1="3" y1="6" x2="3.01" y2="6"></line>
                            <line x1="3" y1="12" x2="3.01" y2="12"></line>
                            <line x1="3" y1="18" x2="3.01" y2="18"></line>
                        </svg>
                    </div>
                    <span class="admin-nav-label">Kategori Alam</span>
                </a>

            </nav>
        </aside>


        <!-- ============================================== -->
        <!-- 2. CENTER MAIN CONTENT                         -->
        <!-- ============================================== -->
        <main class="admin-main-content">

            <!-- Top Search & Quick Actions Bar -->
            <header class="admin-topbar">
                <div class="admin-search-wrapper">
                    <svg class="admin-search-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" id="admin-search-input" placeholder="Cari destinasi wisata Bali, ulasan, wilayah..." aria-label="Cari data admin">
                </div>

                <div class="admin-topbar-actions">
                    <button type="button" class="btn-admin-add-new" id="btn-open-create-modal" onclick="openAdminCreateModal()">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Tambah Baru</span>
                    </button>

                    <!-- Icon Tools -->
                    <div class="admin-icon-tools">
                        <button type="button" class="admin-tool-icon-btn admin-notif-btn" title="Notifikasi Admin" onclick="showAdminToast('Tidak ada notifikasi baru.')">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                            <span class="admin-notif-indicator"></span>
                        </button>
                    </div>

                    <!-- Profile Pill with Dropdown (Matching User Dashboard) -->
                    <div class="dash-user-dropdown-wrap admin-user-dropdown-wrap">
                        <button type="button" class="dash-user-pill" id="admin-user-menu-btn" onclick="toggleAdminUserMenu(event)" aria-haspopup="true" aria-expanded="false">
                            <div class="dash-avatar" style="background: linear-gradient(135deg, #1b3821 0%, #244b2c 100%);">
                                <span class="dash-avatar-initials">ER</span>
                            </div>
                            <div class="dash-user-info">
                                <span class="dash-user-name">Erick</span>
                                <span class="dash-user-role">Admin</span>
                            </div>
                            <svg class="dash-chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="dash-dropdown-menu" id="admin-user-dropdown">
                            <a href="javascript:void(0)" class="dash-dropdown-item" onclick="openAdminSettingsModal()">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                </svg>
                                <span>Pengaturan</span>
                            </a>
                            <a href="{{ route('dashboard') }}" class="dash-dropdown-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                    <polyline points="15 3 21 3 21 9"></polyline>
                                    <line x1="10" y1="14" x2="21" y2="3"></line>
                                </svg>
                                <span>Portal Pengguna</span>
                            </a>
                            <hr class="dash-dropdown-divider">
                            <a href="{{ route('home') }}" class="dash-dropdown-item text-danger" id="btn-admin-logout">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Status Ringkasan Destinasi (Post & Draft - Equal Width) -->
            <section class="admin-status-section" aria-label="Status Ringkasan Destinasi">
                <div class="admin-status-grid">
                    <!-- 1. POST (Terbit) -->
                    <div class="admin-status-card stat-card-post" onclick="handleNavClick(document.querySelector('.admin-nav-item[data-nav=destinasi]'), 'destinasi')" role="button" tabindex="0" title="Klik untuk mengelola destinasi aktif yang tayang">
                        <div class="stat-card-icon-wrap icon-post">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-header">
                                <span class="stat-card-title">Post</span>
                                <span class="stat-pill-badge badge-published">● Terbit</span>
                            </div>
                            <div class="stat-card-value-group">
                                <span class="stat-main-number" id="stat-post-count">16</span>
                                <span class="stat-unit">Destinasi</span>
                            </div>
                            <p class="stat-card-desc">Konten aktif tayang di katalog publik Dewasufa</p>
                        </div>
                    </div>

                    <!-- 2. DRAFT (Konsep / Siap Rilis) -->
                    <div class="admin-status-card stat-card-draft" onclick="showAdminToast('Menampilkan draft destinasi siap rilis'); scrollToDestCards();" role="button" tabindex="0" title="Klik untuk melihat draft destinasi">
                        <div class="stat-card-icon-wrap icon-draft">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-header">
                                <span class="stat-card-title">Draft</span>
                                <span class="stat-pill-badge badge-draft">● Konsep</span>
                            </div>
                            <div class="stat-card-value-group">
                                <span class="stat-main-number" id="stat-draft-count">3</span>
                                <span class="stat-unit">Tersimpan</span>
                            </div>
                            <p class="stat-card-desc">Destinasi siap uji &amp; rilis ke publik</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Kategori Destinasi Dewasufa -->
            <section class="admin-categories-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">Kategori Destinasi Dewasufa</h2>
                </div>

                <div class="admin-category-grid">
                    <!-- Waterfall -->
                    <div class="admin-cat-card" onclick="filterByCategory('Waterfall')">
                        <div class="admin-cat-icon-box cat-waterfall">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                            </svg>
                        </div>
                        <div class="admin-cat-info">
                            <h3 class="admin-cat-name">Air Terjun</h3>
                            <span class="admin-cat-count">(15 Destinasi)</span>
                        </div>
                    </div>

                    <!-- Sunset Beach -->
                    <div class="admin-cat-card" onclick="filterByCategory('Sunset Beach')">
                        <div class="admin-cat-icon-box cat-sunset">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="5"></circle>
                                <line x1="12" y1="1" x2="12" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="23"></line>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                <line x1="1" y1="12" x2="3" y2="12"></line>
                                <line x1="21" y1="12" x2="23" y2="12"></line>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                            </svg>
                        </div>
                        <div class="admin-cat-info">
                            <h3 class="admin-cat-name">Sunset Beach</h3>
                            <span class="admin-cat-count">(18 Destinasi)</span>
                        </div>
                    </div>

                    <!-- Sunrise Beach -->
                    <div class="admin-cat-card" onclick="filterByCategory('Sunrise Beach')">
                        <div class="admin-cat-icon-box cat-sunrise">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 18a5 5 0 0 0-10 0"></path>
                                <line x1="12" y1="2" x2="12" y2="9"></line>
                                <line x1="4.22" y1="10.22" x2="5.64" y2="11.64"></line>
                                <line x1="1" y1="18" x2="3" y2="18"></line>
                                <line x1="21" y1="18" x2="23" y2="18"></line>
                                <line x1="18.36" y1="11.64" x2="19.78" y2="10.22"></line>
                                <line x1="23" y1="22" x2="1" y2="22"></line>
                            </svg>
                        </div>
                        <div class="admin-cat-info">
                            <h3 class="admin-cat-name">Sunrise Beach</h3>
                            <span class="admin-cat-count">(12 Destinasi)</span>
                        </div>
                    </div>

                    <!-- Mountain -->
                    <div class="admin-cat-card" onclick="filterByCategory('Gunung')">
                        <div class="admin-cat-icon-box cat-mountain">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="3 20 9 7 13 14 17 9 21 20 3 20"></polygon>
                            </svg>
                        </div>
                        <div class="admin-cat-info">
                            <h3 class="admin-cat-name">Pegunungan</h3>
                            <span class="admin-cat-count">(8 Destinasi)</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================== -->
            <!-- 3. KOLEKSI DESTINASI DEWASUFA (KELOLA DESTINASI) -->
            <!-- ============================================== -->
            <section class="dash-recom-section admin-dest-section" id="admin-destinasi-section" aria-label="Koleksi Destinasi Dewasufa">
                <div class="dash-section-header">
                    <div class="admin-table-title-group">
                        <h2 class="dash-section-title">Koleksi Destinasi Dewasufa</h2>
                        <span class="admin-table-count-badge" id="admin-dest-count-badge">16 Destinasi Aktif</span>
                    </div>

                    <!-- Category Filter Pills (Matching User Dashboard) -->
                    <nav class="dash-category-nav" aria-label="Filter Kategori Destinasi">
                        <button type="button" class="dash-cat-pill active" onclick="filterDestCards('all', this)">Semua</button>
                        <button type="button" class="dash-cat-pill" onclick="filterDestCards('waterfall', this)">Waterfall</button>
                        <button type="button" class="dash-cat-pill" onclick="filterDestCards('sunset', this)">Sunset Beach</button>
                        <button type="button" class="dash-cat-pill" onclick="filterDestCards('sunrise', this)">Sunrise Beach</button>
                        <button type="button" class="dash-cat-pill" onclick="filterDestCards('mountain', this)">Mountain</button>
                    </nav>
                </div>

                <div class="dash-recom-grid admin-dest-cards-grid" id="admin-cards-container">
                    <!-- Waterfall 1 -->
                    <div class="dash-recom-card" data-category="waterfall" data-key="sekumpul" data-title="Air Terjun Sekumpul" data-desc="Gugusan air terjun kembar megah berketinggian 80m di lembah Buleleng." data-time="07:00 - 16:00" data-ticket="Rp 20.000 / orang" data-loc="Sawan, Buleleng, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/waterfall.jpg" alt="Air Terjun Sekumpul" class="dash-recom-img">
                            <span class="dash-recom-badge">Waterfall</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Air Terjun Sekumpul</h3>
                            <p class="dash-recom-card-desc">Gugusan air terjun kembar megah berketinggian 80m di lembah Buleleng.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('sekumpul', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Waterfall 2 -->
                    <div class="dash-recom-card" data-category="waterfall" data-key="waterfall" data-title="Air Terjun Tegenungan" data-desc="Kolam alami segar di lembah Gianyar dengan akses mudah dekat Ubud." data-time="06:30 - 18:00" data-ticket="Rp 25.000 / orang" data-loc="Kemenuh, Gianyar, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/waterfall.jpg" alt="Air Terjun Tegenungan" class="dash-recom-img">
                            <span class="dash-recom-badge">Waterfall</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Air Terjun Tegenungan</h3>
                            <p class="dash-recom-card-desc">Kolam alami segar di lembah Gianyar dengan akses mudah dekat Ubud.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('waterfall', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Waterfall 3 -->
                    <div class="dash-recom-card" data-category="waterfall" data-key="sekumpul" data-title="Air Terjun Gitgit" data-desc="Air terjun legendaris dengan ketinggian 35 meter di lereng perbukitan Singaraja." data-time="08:00 - 17:00" data-ticket="Rp 20.000 / orang" data-loc="Sukasada, Buleleng, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/waterfall.jpg" alt="Air Terjun Gitgit" class="dash-recom-img">
                            <span class="dash-recom-badge">Waterfall</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Air Terjun Gitgit</h3>
                            <p class="dash-recom-card-desc">Air terjun legendaris dengan ketinggian 35 meter di Singaraja.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('sekumpul', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Waterfall 4 -->
                    <div class="dash-recom-card" data-category="waterfall" data-key="sekumpul" data-title="Air Terjun Aling-Aling" data-desc="Sensasi seluncur alami dan cliff jumping yang menantang di Sambangan." data-time="08:00 - 16:30" data-ticket="Rp 30.000 / orang" data-loc="Sambangan, Buleleng, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/waterfall.jpg" alt="Air Terjun Aling-Aling" class="dash-recom-img">
                            <span class="dash-recom-badge">Waterfall</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Air Terjun Aling-Aling</h3>
                            <p class="dash-recom-card-desc">Sensasi seluncur alami dan cliff jumping yang menantang di Sambangan.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('sekumpul', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sunset Beach 1 -->
                    <div class="dash-recom-card" data-category="sunset" data-key="sunset" data-title="Pantai Tanah Lot" data-desc="Siluet pura agung di atas karang laut saat matahari terbenam." data-time="17:00 - 18:45" data-ticket="Rp 20.000 / orang" data-loc="Beraban, Tabanan, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/sunset-beach.jpg" alt="Pantai Tanah Lot" class="dash-recom-img">
                            <span class="dash-recom-badge badge-sunset">Sunset Beach</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Pantai Tanah Lot</h3>
                            <p class="dash-recom-card-desc">Siluet pura agung di atas karang laut saat matahari terbenam.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('sunset', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sunset Beach 2 -->
                    <div class="dash-recom-card" data-category="sunset" data-key="sunset" data-title="Pantai Melasti Ungasan" data-desc="Tebing kapur menjulang tinggi dengan pasir putih bersih dan sunset magis." data-time="16:00 - 19:00" data-ticket="Rp 10.000 / orang" data-loc="Ungasan, Badung, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/sunset-beach.jpg" alt="Pantai Melasti & Tebing Karang" class="dash-recom-img">
                            <span class="dash-recom-badge badge-sunset">Sunset Beach</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Pantai Melasti Ungasan</h3>
                            <p class="dash-recom-card-desc">Tebing kapur menjulang tinggi dengan pasir putih bersih dan sunset magis.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('sunset', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sunset Beach 3 -->
                    <div class="dash-recom-card" data-category="sunset" data-key="sunset" data-title="Pantai Uluwatu / Suluban" data-desc="Tebing karang megah dengan ombak peselancar kelas dunia di Bukit." data-time="16:30 - 18:30" data-ticket="Rp 15.000 / orang" data-loc="Pecatu, Badung, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/sunset-beach.jpg" alt="Pantai Uluwatu / Suluban" class="dash-recom-img">
                            <span class="dash-recom-badge badge-sunset">Sunset Beach</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Pantai Uluwatu / Suluban</h3>
                            <p class="dash-recom-card-desc">Tebing karang megah dengan ombak peselancar kelas dunia di Bukit.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('sunset', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sunset Beach 4 -->
                    <div class="dash-recom-card" data-category="sunset" data-key="sunset" data-title="Pantai Kuta & Legian" data-desc="Garis pantai ikonik nan landai untuk menikmati senja santai Bali." data-time="17:00 - 18:30" data-ticket="Gratis" data-loc="Kuta, Badung, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/sunset-beach.jpg" alt="Pantai Kuta & Legian" class="dash-recom-img">
                            <span class="dash-recom-badge badge-sunset">Sunset Beach</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Pantai Kuta &amp; Legian</h3>
                            <p class="dash-recom-card-desc">Garis pantai ikonik nan landai untuk menikmati senja santai Bali.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('sunset', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sunrise Beach 1 -->
                    <div class="dash-recom-card" data-category="sunrise" data-key="sunrise" data-title="Pantai Sanur Denpasar" data-desc="Fajar hening nan damai dengan gazebo klasik dan jalur sepeda tepi laut." data-time="05:45 - 06:45" data-ticket="Gratis" data-loc="Sanur, Denpasar, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/sunrise-beach.jpg" alt="Pantai Sanur" class="dash-recom-img">
                            <span class="dash-recom-badge badge-sunrise">Sunrise Beach</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Pantai Sanur Denpasar</h3>
                            <p class="dash-recom-card-desc">Fajar hening nan damai dengan gazebo klasik dan jalur sepeda tepi laut.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('sunrise', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sunrise Beach 2 -->
                    <div class="dash-recom-card" data-category="sunrise" data-key="sunrise" data-title="Pantai Candidasa" data-desc="Ketenangan pesisir Karangasem dengan pemandangan pulau karang." data-time="05:30 - 06:30" data-ticket="Rp 10.000 / orang" data-loc="Candidasa, Karangasem, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/sunrise-beach.jpg" alt="Pantai Candidasa" class="dash-recom-img">
                            <span class="dash-recom-badge badge-sunrise">Sunrise Beach</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Pantai Candidasa</h3>
                            <p class="dash-recom-card-desc">Ketenangan pesisir Karangasem dengan pemandangan pulau karang.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('sunrise', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sunrise Beach 3 -->
                    <div class="dash-recom-card" data-category="sunrise" data-key="sunrise" data-title="Pantai Kusamba Klungkung" data-desc="Pasir hitam eksotis dan aktivitas pembuat garam tradisional saat fajar." data-time="05:30 - 06:30" data-ticket="Gratis" data-loc="Dawan, Klungkung, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/sunrise-beach.jpg" alt="Pantai Kusamba" class="dash-recom-img">
                            <span class="dash-recom-badge badge-sunrise">Sunrise Beach</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Pantai Kusamba Klungkung</h3>
                            <p class="dash-recom-card-desc">Pasir hitam eksotis dan aktivitas pembuat garam tradisional saat fajar.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('sunrise', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sunrise Beach 4 -->
                    <div class="dash-recom-card" data-category="sunrise" data-key="sunrise" data-title="Pantai Amed" data-desc="Perahu jukung tradisional bersandar dengan latar fajar Gunung Agung." data-time="05:15 - 06:30" data-ticket="Rp 10.000 / orang" data-loc="Abang, Karangasem, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/sunrise-beach.jpg" alt="Pantai Amed" class="dash-recom-img">
                            <span class="dash-recom-badge badge-sunrise">Sunrise Beach</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Pantai Amed</h3>
                            <p class="dash-recom-card-desc">Perahu jukung tradisional bersandar dengan latar fajar Gunung Agung.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('sunrise', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mountain 1 -->
                    <div class="dash-recom-card" data-category="mountain" data-key="mountain" data-title="Gunung Batur (1.717 mdpl)" data-desc="Sunrise trekking paling populer dengan kaldera luas dan Danau Batur." data-time="03:30 - 09:00" data-ticket="Rp 100.000 / guide" data-loc="Kintamani, Bangli, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/mountain.jpg" alt="Gunung Batur" class="dash-recom-img">
                            <span class="dash-recom-badge badge-mountain">Mountain</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Gunung Batur (1.717 mdpl)</h3>
                            <p class="dash-recom-card-desc">Sunrise trekking paling populer dengan kaldera luas dan Danau Batur.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('mountain', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mountain 2 -->
                    <div class="dash-recom-card" data-category="mountain" data-key="mountain" data-title="Gunung Agung (3.142 mdpl)" data-desc="Titik tertinggi dan tersuci di Bali untuk pendaki berpengalaman." data-time="Malam Hari" data-ticket="Rp 150.000 / guide" data-loc="Rendang, Karangasem, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/mountain.jpg" alt="Gunung Agung" class="dash-recom-img">
                            <span class="dash-recom-badge badge-mountain">Mountain</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Gunung Agung (3.142 mdpl)</h3>
                            <p class="dash-recom-card-desc">Titik tertinggi dan tersuci di Bali untuk pendaki berpengalaman.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('mountain', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mountain 3 -->
                    <div class="dash-recom-card" data-category="mountain" data-key="mountain" data-title="Bukit Campuhan Ubud" data-desc="Jalur punggung bukit ilalang hijau yang sejuk dan ramah keluarga." data-time="06:00 - 08:30" data-ticket="Gratis" data-loc="Ubud, Gianyar, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/mountain.jpg" alt="Bukit Campuhan Ubud" class="dash-recom-img">
                            <span class="dash-recom-badge badge-mountain">Mountain</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Bukit Campuhan Ubud</h3>
                            <p class="dash-recom-card-desc">Jalur punggung bukit ilalang hijau yang sejuk dan ramah keluarga.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('mountain', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mountain 4 -->
                    <div class="dash-recom-card" data-category="mountain" data-key="mountain" data-title="Gunung Abang (2.152 mdpl)" data-desc="Puncak berhutan rindang di seberang Kaldera Batur yang damai." data-time="03:00 - 10:00" data-ticket="Rp 50.000 / orang" data-loc="Kintamani, Bangli, Bali">
                        <div class="dash-recom-img-wrap">
                            <img src="/images/mountain.jpg" alt="Gunung Abang" class="dash-recom-img">
                            <span class="dash-recom-badge badge-mountain">Mountain</span>
                            <span class="admin-card-status-pill" style="position: absolute; top: 10px; right: 10px;">● Terbit</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">Gunung Abang (2.152 mdpl)</h3>
                            <p class="dash-recom-card-desc">Puncak berhutan rindang di seberang Kaldera Batur yang damai.</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('mountain', this)">Detail</button>
                                <div class="admin-card-actions">
                                    <button type="button" class="admin-card-action-btn btn-card-edit" onclick="openEditDestModal(this, event)" title="Edit Destinasi" aria-label="Edit Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="admin-card-action-btn btn-card-delete" onclick="confirmDeleteCard(this, event)" title="Hapus Destinasi" aria-label="Hapus Destinasi">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tabel Moderasi Ulasan & Komentar Destinasi -->
            <section class="admin-table-section" id="admin-table-container">
                <div class="admin-section-header">
                    <div class="admin-table-title-group">
                        <h2 class="admin-section-title">Moderasi Komentar &amp; Ulasan Destinasi</h2>
                        <span class="admin-table-count-badge" id="admin-table-count">6 Komentar Pengunjung</span>
                    </div>

                    <!-- Filter Tabs -->
                    <div class="admin-table-filters">
                        <button type="button" class="admin-tab-btn active" onclick="filterCommentsTable('all', this)">Semua</button>
                        <button type="button" class="admin-tab-btn" onclick="filterCommentsTable('waterfall', this)">Waterfall</button>
                        <button type="button" class="admin-tab-btn" onclick="filterCommentsTable('sunset', this)">Sunset Beach</button>
                        <button type="button" class="admin-tab-btn" onclick="filterCommentsTable('sunrise', this)">Sunrise Beach</button>
                        <button type="button" class="admin-tab-btn" onclick="filterCommentsTable('mountain', this)">Mountain</button>
                    </div>
                </div>

                <div class="admin-table-card">
                    <div class="admin-table-responsive">
                        <table class="admin-data-table" id="admin-main-table">
                            <thead>
                                <tr>
                                    <th>Pengguna / Akun</th>
                                    <th>Destinasi Wisata</th>
                                    <th>Isi Komentar &amp; Penilaian</th>
                                    <th>Waktu</th>
                                    <th style="text-align: right;">Aksi Cepat</th>
                                </tr>
                            </thead>
                            <tbody id="admin-comments-tbody">
                                <!-- Comment 1 -->
                                <tr data-category="waterfall" data-user="Ketut Dharmayana" data-dest="Air Terjun Sekumpul" data-rating="5.0" data-time="2 jam lalu" data-comment="Air terjun Sekumpul sangat megah dan asri! Trekking tangganya menantang tapi terbayar lunas dengan kesegaran air dan keindahan tebing hijau. Pemandu lokal sangat ramah dan sigap.">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #244b2c; color: #ffffff;">KD</div>
                                            <div>
                                                <div class="admin-cell-title">Ketut Dharmayana</div>
                                                <div class="admin-cell-sub">
                                                    <span style="color: #f5b842;">★ 5.0</span> • Wisatawan Terverifikasi
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="admin-role-tag role-dest">Air Terjun Sekumpul</span>
                                            <div class="admin-cell-sub" style="margin-top: 2px;">Buleleng, Bali</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="admin-comment-snippet" style="max-width: 320px; font-size: 12.5px; color: rgba(255,255,255,0.85); line-height: 1.4;">
                                            "Air terjun Sekumpul sangat megah dan asri! Trekking tangganya menantang tapi terbayar lunas dengan kesegaran air..."
                                        </div>
                                    </td>
                                    <td><span class="admin-location-cell">2 jam lalu</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-view" onclick="openReviewDetailModal(this)">Detail</button>
                                            <button type="button" class="btn-action-reject" onclick="deleteCommentRow(this, event)">Hapus</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Comment 2 -->
                                <tr data-category="sunset" data-user="Ni Made Ayu Lestari" data-dest="Pantai Melasti Ungasan" data-rating="4.9" data-time="5 jam lalu" data-comment="Sunset tercantik di semenanjung Bukit Bali! Tebing kapur putihnya spektakuler, akses jalan berliku sangat estetik untuk spot foto, dan pantainya bersih terawat.">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #e59b2b; color: #122115;">MA</div>
                                            <div>
                                                <div class="admin-cell-title">Ni Made Ayu Lestari</div>
                                                <div class="admin-cell-sub">
                                                    <span style="color: #f5b842;">★ 4.9</span> • Wisatawan Terverifikasi
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="admin-role-tag role-review" style="background: rgba(251, 146, 60, 0.18); color: #fb923c; border-color: rgba(251, 146, 60, 0.3);">Pantai Melasti Ungasan</span>
                                            <div class="admin-cell-sub" style="margin-top: 2px;">Badung, Bali</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="admin-comment-snippet" style="max-width: 320px; font-size: 12.5px; color: rgba(255,255,255,0.85); line-height: 1.4;">
                                            "Sunset tercantik di semenanjung Bukit Bali! Tebing kapur putihnya spektakuler, akses jalan berliku sangat estetik..."
                                        </div>
                                    </td>
                                    <td><span class="admin-location-cell">5 jam lalu</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-view" onclick="openReviewDetailModal(this)">Detail</button>
                                            <button type="button" class="btn-action-reject" onclick="deleteCommentRow(this, event)">Hapus</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Comment 3 -->
                                <tr data-category="mountain" data-user="Wayan Surya Putra" data-dest="Gunung Batur (1.717 mdpl)" data-rating="4.8" data-time="1 hari lalu" data-comment="Pendakian sunrise yang magis. Pemandangan samudera awan dari puncak sungguh luar biasa spektakuler. Pastikan membawa jaket tebal karena angin pagi cukup kencang.">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #3b82f6; color: #ffffff;">WS</div>
                                            <div>
                                                <div class="admin-cell-title">Wayan Surya Putra</div>
                                                <div class="admin-cell-sub">
                                                    <span style="color: #f5b842;">★ 4.8</span> • Pendaki Terverifikasi
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="admin-role-tag role-dest" style="background: rgba(168, 85, 247, 0.18); color: #c084fc; border-color: rgba(168, 85, 247, 0.3);">Gunung Batur (1.717 mdpl)</span>
                                            <div class="admin-cell-sub" style="margin-top: 2px;">Kintamani, Bangli</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="admin-comment-snippet" style="max-width: 320px; font-size: 12.5px; color: rgba(255,255,255,0.85); line-height: 1.4;">
                                            "Pendakian sunrise yang magis. Pemandangan samudera awan dari puncak sungguh luar biasa spektakuler..."
                                        </div>
                                    </td>
                                    <td><span class="admin-location-cell">1 hari lalu</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-view" onclick="openReviewDetailModal(this)">Detail</button>
                                            <button type="button" class="btn-action-reject" onclick="deleteCommentRow(this, event)">Hapus</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Comment 4 -->
                                <tr data-category="sunrise" data-user="Sarah Wijaya" data-dest="Pantai Sanur Denpasar" data-rating="4.7" data-time="2 hari lalu" data-comment="Suasana fajar nan tenang di tepi pantai Sanur. Sangat menyenangkan untuk jogging pagi dan bersepeda santai di jalur pantai sambil menunggu terbit matahari.">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #ec4899; color: #ffffff;">SW</div>
                                            <div>
                                                <div class="admin-cell-title">Sarah Wijaya</div>
                                                <div class="admin-cell-sub">
                                                    <span style="color: #f5b842;">★ 4.7</span> • Wisatawan Terverifikasi
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="admin-role-tag role-review" style="background: rgba(245, 184, 66, 0.18); color: #f5b842; border-color: rgba(245, 184, 66, 0.3);">Pantai Sanur Denpasar</span>
                                            <div class="admin-cell-sub" style="margin-top: 2px;">Denpasar, Bali</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="admin-comment-snippet" style="max-width: 320px; font-size: 12.5px; color: rgba(255,255,255,0.85); line-height: 1.4;">
                                            "Suasana fajar nan tenang di tepi pantai Sanur. Sangat menyenangkan untuk jogging pagi dan bersepeda santai..."
                                        </div>
                                    </td>
                                    <td><span class="admin-location-cell">2 hari lalu</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-view" onclick="openReviewDetailModal(this)">Detail</button>
                                            <button type="button" class="btn-action-reject" onclick="deleteCommentRow(this, event)">Hapus</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Comment 5 -->
                                <tr data-category="waterfall" data-user="Budi Santoso" data-dest="Air Terjun Tegenungan" data-rating="4.6" data-time="3 hari lalu" data-comment="Kolam alaminya segar sekali dan lokasinya sangat dekat dari Ubud. Datang pagi hari jauh lebih sepi dan nyaman untuk berfoto tanpa antrean panjang.">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #14b8a6; color: #ffffff;">BS</div>
                                            <div>
                                                <div class="admin-cell-title">Budi Santoso</div>
                                                <div class="admin-cell-sub">
                                                    <span style="color: #f5b842;">★ 4.6</span> • Wisatawan Terverifikasi
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="admin-role-tag role-dest">Air Terjun Tegenungan</span>
                                            <div class="admin-cell-sub" style="margin-top: 2px;">Gianyar, Bali</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="admin-comment-snippet" style="max-width: 320px; font-size: 12.5px; color: rgba(255,255,255,0.85); line-height: 1.4;">
                                            "Kolam alaminya segar sekali dan lokasinya sangat dekat dari Ubud. Datang pagi hari jauh lebih sepi dan nyaman..."
                                        </div>
                                    </td>
                                    <td><span class="admin-location-cell">3 hari lalu</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-view" onclick="openReviewDetailModal(this)">Detail</button>
                                            <button type="button" class="btn-action-reject" onclick="deleteCommentRow(this, event)">Hapus</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Comment 6 -->
                                <tr data-category="mountain" data-user="Komang Gede" data-dest="Gunung Agung (3.142 mdpl)" data-rating="5.0" data-time="4 hari lalu" data-comment="Trekking via jalur Pura Pasar Agung sangat menantang dan memacu adrenalin. Panorama matahari terbit di atas puncak tertinggi Bali sungguh membuat takjub!">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #8b5cf6; color: #ffffff;">KG</div>
                                            <div>
                                                <div class="admin-cell-title">Komang Gede</div>
                                                <div class="admin-cell-sub">
                                                    <span style="color: #f5b842;">★ 5.0</span> • Pendaki Berpengalaman
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="admin-role-tag role-dest" style="background: rgba(168, 85, 247, 0.18); color: #c084fc; border-color: rgba(168, 85, 247, 0.3);">Gunung Agung (3.142 mdpl)</span>
                                            <div class="admin-cell-sub" style="margin-top: 2px;">Karangasem, Bali</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="admin-comment-snippet" style="max-width: 320px; font-size: 12.5px; color: rgba(255,255,255,0.85); line-height: 1.4;">
                                            "Trekking via jalur Pura Pasar Agung sangat menantang dan memacu adrenalin. Panorama matahari terbit sungguh membuat takjub!"
                                        </div>
                                    </td>
                                    <td><span class="admin-location-cell">4 hari lalu</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-view" onclick="openReviewDetailModal(this)">Detail</button>
                                            <button type="button" class="btn-action-reject" onclick="deleteCommentRow(this, event)">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>

    </div>


    <!-- ============================================== -->
    <!-- MODAL TAMBAH DESTINASI BARU (ADMIN)           -->
    <!-- ============================================== -->
    <div class="admin-modal-backdrop" id="admin-create-dest-modal" role="dialog" aria-modal="true" aria-labelledby="modal-dest-title">
        <div class="admin-modal-card">
            <div class="admin-modal-header">
                <div>
                    <span class="admin-modal-badge">Kelola Konten Dewasufa</span>
                    <h3 id="modal-dest-title" class="admin-modal-title">Tambah Destinasi Wisata Baru</h3>
                </div>
                <button type="button" class="admin-modal-close" onclick="closeAdminCreateModal()" aria-label="Tutup Modal">&times;</button>
            </div>

            <form id="admin-add-dest-form" onsubmit="handleAdminAddDest(event)">
                <div class="admin-form-group">
                    <label for="dest-input-name" class="admin-form-label">Nama Destinasi Wisata</label>
                    <input type="text" id="dest-input-name" class="admin-form-input" placeholder="Contoh: Air Terjun Aling-Aling" required>
                </div>

                <div class="admin-form-row-2">
                    <div class="admin-form-group">
                        <label for="dest-input-category" class="admin-form-label">Kategori Wisata</label>
                        <select id="dest-input-category" class="admin-form-select" required>
                            <option value="Waterfall">Waterfall</option>
                            <option value="Sunset Beach">Sunset Beach</option>
                            <option value="Sunrise Beach">Sunrise Beach</option>
                            <option value="Mountain">Mountain</option>
                        </select>
                    </div>
                    <div class="admin-form-group">
                        <label for="dest-input-ticket" class="admin-form-label">Harga Tiket Masuk</label>
                        <input type="text" id="dest-input-ticket" class="admin-form-input" placeholder="Rp 20.000 / orang" required>
                    </div>
                </div>

                <div class="admin-form-group">
                    <label for="dest-input-location" class="admin-form-label">Kabupaten / Lokasi di Bali</label>
                    <input type="text" id="dest-input-location" class="admin-form-input" placeholder="Contoh: Sambangan, Sukasada, Buleleng" required>
                </div>

                <div class="admin-form-group">
                    <label for="dest-input-desc" class="admin-form-label">Deskripsi Singkat</label>
                    <textarea id="dest-input-desc" class="admin-form-textarea" rows="3" placeholder="Tuliskan daya tarik keindahan alam destinasi ini..." required></textarea>
                </div>

                <div class="admin-modal-actions">
                    <button type="button" class="btn-admin-cancel" onclick="closeAdminCreateModal()">Batal</button>
                    <button type="submit" class="btn-admin-submit-save">+ Simpan & Publikasikan</button>
                </div>
            </form>
        </div>
    </div>


    <!-- ===== MODAL DETAIL DESTINASI (TANPA REDIRECT KE PORTAL USER) ===== -->
    <div class="dash-modal-backdrop" id="dest-detail-modal" role="dialog" aria-modal="true" aria-labelledby="dest-detail-title" style="z-index:12000;">
        <div class="dash-modal-card" style="max-width:900px;width:100%;max-height:90vh;overflow-y:auto;border-radius:28px;padding:28px;position:relative;">
            <button type="button" onclick="closeAdminSpotDetail()" aria-label="Tutup" style="position:absolute;top:18px;right:18px;width:34px;height:34px;border-radius:50%;border:1px solid rgba(255,255,255,0.15);background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.8);font-size:18px;display:flex;align-items:center;justify-content:center;cursor:pointer;">✕</button>

            <div style="display:grid;grid-template-columns:1.4fr 1fr;gap:24px;">
                <!-- Left -->
                <div>
                    <img id="dest-detail-img" src="/images/waterfall.jpg" alt="Destinasi" style="width:100%;height:220px;object-fit:cover;border-radius:18px;display:block;margin-bottom:16px;">
                    <h2 id="dest-detail-title" style="font-size:22px;font-weight:800;color:#fff;margin:0 0 6px;letter-spacing:-0.02em;">Air Terjun Sekumpul</h2>
                    <div style="display:flex;align-items:center;gap:6px;color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:12px;">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span id="dest-detail-location-text">Buleleng, Bali</span>
                    </div>
                    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:16px;">
                        <span id="dest-detail-category" style="display:inline-block;padding:4px 12px;border-radius:20px;background:rgba(94,234,212,0.15);color:#5eead4;font-size:12px;font-weight:600;border:1px solid rgba(94,234,212,0.25);">Waterfall</span>
                        <span style="display:inline-block;padding:4px 12px;border-radius:20px;background:rgba(36,75,44,0.5);color:rgba(255,255,255,0.7);font-size:12px;font-weight:600;border:1px solid rgba(255,255,255,0.1);">● Terbit Aktif</span>
                    </div>
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:16px;">
                        <div style="padding:12px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:14px;text-align:center;">
                            <div style="font-size:11px;color:rgba(255,255,255,0.5);margin-bottom:4px;">★ Rating</div>
                            <div style="font-size:16px;font-weight:700;color:#f5b842;" id="dest-detail-score">4.9</div>
                        </div>
                        <div style="padding:12px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:14px;text-align:center;">
                            <div style="font-size:11px;color:rgba(255,255,255,0.5);margin-bottom:4px;">Jam Buka</div>
                            <div style="font-size:12px;font-weight:600;color:#fff;" id="dest-detail-time">07:00 - 16:00</div>
                        </div>
                        <div style="padding:12px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:14px;text-align:center;">
                            <div style="font-size:11px;color:rgba(255,255,255,0.5);margin-bottom:4px;">Tiket Masuk</div>
                            <div style="font-size:12px;font-weight:600;color:#fff;" id="dest-detail-ticket">Rp 20.000</div>
                        </div>
                    </div>
                    <h4 style="font-size:13px;font-weight:600;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:8px;">Tentang Destinasi</h4>
                    <p id="dest-detail-desc" style="font-size:14px;line-height:1.65;color:rgba(255,255,255,0.8);margin:0;">Deskripsi destinasi wisata ini.</p>
                </div>
                <!-- Right -->
                <div style="display:flex;flex-direction:column;gap:14px;">
                    <div style="padding:16px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);border-radius:18px;">
                        <h3 style="font-size:15px;font-weight:700;color:#fff;margin:0 0 4px;">Ulasan Wisatawan</h3>
                        <p style="font-size:12px;color:rgba(255,255,255,0.5);margin:0 0 12px;">Komentar dari pengunjung destinasi</p>
                        <div style="display:flex;flex-direction:column;gap:10px;">
                            <div style="padding:12px;background:rgba(0,0,0,0.2);border-radius:12px;">
                                <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                                    <div style="width:32px;height:32px;border-radius:50%;background:#244b2c;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#fff;">KD</div>
                                    <div><div style="font-size:13px;font-weight:600;color:#fff;">Ketut Dharmayana</div><div style="font-size:11px;color:rgba(255,255,255,0.5);">2 jam lalu · ★ 5.0</div></div>
                                </div>
                                <p style="font-size:13px;line-height:1.5;color:rgba(255,255,255,0.75);margin:0;">Air terjunnya sangat megah dan asri! Pemandu lokal sangat ramah.</p>
                            </div>
                            <div style="padding:12px;background:rgba(0,0,0,0.2);border-radius:12px;">
                                <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                                    <div style="width:32px;height:32px;border-radius:50%;background:#3b82f6;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#fff;">WS</div>
                                    <div><div style="font-size:13px;font-weight:600;color:#fff;">Wayan Surya</div><div style="font-size:11px;color:rgba(255,255,255,0.5);">1 hari lalu · ★ 5.0</div></div>
                                </div>
                                <p style="font-size:13px;line-height:1.5;color:rgba(255,255,255,0.75);margin:0;">Sangat direkomendasikan dikunjungi saat pagi hari!</p>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="closeAdminSpotDetail()" style="padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,0.15);background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.8);font-size:14px;font-weight:600;cursor:pointer;margin-top:auto;">Tutup Rincian</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MODAL EDIT DESTINASI (IKON PENSIL) ===== -->
    <div class="admin-modal-backdrop" id="admin-edit-dest-modal" role="dialog" aria-modal="true" aria-labelledby="edit-dest-modal-title">
        <div class="admin-modal-card">
            <div class="admin-modal-header">
                <div><span class="admin-modal-badge">Kelola Konten Admin</span><h3 id="edit-dest-modal-title" class="admin-modal-title">Edit Destinasi Wisata</h3></div>
                <button type="button" class="admin-modal-close" onclick="closeEditDestModal()" aria-label="Tutup">&times;</button>
            </div>
            <form id="admin-edit-dest-form" onsubmit="handleEditDestSubmit(event)">
                <div class="admin-form-group">
                    <label for="edit-dest-title" class="admin-form-label">Nama Destinasi Wisata</label>
                    <input type="text" id="edit-dest-title" class="admin-form-input" required>
                </div>
                <div class="admin-form-row-2">
                    <div class="admin-form-group">
                        <label for="edit-dest-category" class="admin-form-label">Kategori Wisata</label>
                        <select id="edit-dest-category" class="admin-form-select" required>
                            <option value="waterfall">Waterfall</option>
                            <option value="sunset">Sunset Beach</option>
                            <option value="sunrise">Sunrise Beach</option>
                            <option value="mountain">Mountain</option>
                        </select>
                    </div>
                    <div class="admin-form-group">
                        <label for="edit-dest-ticket" class="admin-form-label">Harga Tiket Masuk</label>
                        <input type="text" id="edit-dest-ticket" class="admin-form-input" required>
                    </div>
                </div>
                <div class="admin-form-row-2">
                    <div class="admin-form-group">
                        <label for="edit-dest-time" class="admin-form-label">Jam Operasional</label>
                        <input type="text" id="edit-dest-time" class="admin-form-input" required>
                    </div>
                    <div class="admin-form-group">
                        <label for="edit-dest-loc" class="admin-form-label">Lokasi di Bali</label>
                        <input type="text" id="edit-dest-loc" class="admin-form-input" required>
                    </div>
                </div>
                <div class="admin-form-group">
                    <label for="edit-dest-desc" class="admin-form-label">Deskripsi Singkat Destinasi</label>
                    <textarea id="edit-dest-desc" class="admin-form-textarea" rows="3" required></textarea>
                </div>
                <div class="admin-modal-actions">
                    <button type="button" class="btn-admin-cancel" onclick="closeEditDestModal()">Batal</button>
                    <button type="submit" class="btn-admin-submit-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL TINJAU ULASAN (MODERASI) ===== -->
    <div class="admin-modal-backdrop" id="admin-review-detail-modal" role="dialog" aria-modal="true" aria-labelledby="review-modal-title">
        <div class="admin-modal-card">
            <div class="admin-modal-header">
                <div><span class="admin-modal-badge">Moderasi Ulasan Wisata</span><h3 id="review-modal-title" class="admin-modal-title">Tinjau Komentar Wisatawan</h3></div>
                <button type="button" class="admin-modal-close" onclick="closeReviewDetailModal()" aria-label="Tutup">&times;</button>
            </div>
            <div style="display:flex;flex-direction:column;gap:14px;margin:16px 0;">
                <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;padding:14px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:14px;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div id="review-detail-avatar" style="width:44px;height:44px;border-radius:50%;background:#244b2c;display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:700;color:#fff;">KD</div>
                        <div>
                            <div id="review-detail-user" style="font-size:15px;font-weight:700;color:#fff;">Ketut Dharmayana</div>
                            <div id="review-detail-time" style="font-size:12px;color:rgba(255,255,255,0.5);">2 jam lalu</div>
                        </div>
                    </div>
                    <span id="review-detail-rating" style="padding:4px 12px;border-radius:20px;background:rgba(245,184,66,0.15);color:#f5b842;font-weight:700;font-size:13px;">★ 5.0 / 5.0</span>
                </div>
                <div style="padding:12px 14px;background:rgba(36,75,44,0.14);border:1px solid rgba(36,75,44,0.3);border-radius:12px;display:flex;align-items:center;gap:8px;">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#5eead4" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span style="font-size:12px;color:rgba(255,255,255,0.6);">Destinasi:</span>
                    <strong id="review-detail-dest" style="font-size:13px;color:#5eead4;">Air Terjun Sekumpul</strong>
                </div>
                <div style="padding:16px;background:rgba(0,0,0,0.25);border:1px solid rgba(255,255,255,0.08);border-radius:14px;">
                    <label style="display:block;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:rgba(255,255,255,0.5);margin-bottom:8px;">Isi Ulasan:</label>
                    <p id="review-detail-comment" style="font-size:14px;line-height:1.6;color:#f1f5f9;margin:0;font-style:italic;"></p>
                </div>
            </div>
            <div class="admin-modal-actions" style="justify-content:space-between;">
                <button type="button" class="btn-action-reject" style="padding:10px 18px;border-radius:12px;font-size:13px;font-weight:600;display:inline-flex;align-items:center;gap:6px;" onclick="deleteCurrentReviewFromModal()">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    Hapus Komentar
                </button>
                <button type="button" class="btn-admin-cancel" onclick="closeReviewDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- ===== MODAL PENGATURAN PROFIL ADMIN ===== -->
    <div class="admin-modal-backdrop" id="admin-settings-modal" role="dialog" aria-modal="true" aria-labelledby="admin-settings-modal-title">
        <div class="admin-modal-card">
            <div class="admin-modal-header">
                <div><span class="admin-modal-badge">Panel Administrator</span><h3 id="admin-settings-modal-title" class="admin-modal-title">Pengaturan Akun &amp; Sistem</h3></div>
                <button type="button" class="admin-modal-close" onclick="closeAdminSettingsModal()" aria-label="Tutup">&times;</button>
            </div>
            <form id="admin-settings-form" onsubmit="saveAdminSettings(event)">
                <div style="display:flex;align-items:center;gap:16px;margin:16px 0;padding:16px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:16px;">
                    <div style="width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,#1b3821,#244b2c);display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:800;color:#fff;flex-shrink:0;">ER</div>
                    <div>
                        <h4 style="font-size:16px;font-weight:700;color:#fff;margin:0 0 4px;">Erick</h4>
                        <span class="admin-role-tag role-admin" style="font-size:11px;">Super Administrator</span>
                    </div>
                </div>
                <div class="admin-form-group">
                    <label for="admin-settings-email" class="admin-form-label">Email Administrator</label>
                    <input type="email" id="admin-settings-email" class="admin-form-input" value="admin@dewasufa.com" required>
                </div>
                <div class="admin-form-group">
                    <label for="admin-settings-role" class="admin-form-label">Hak Akses Sistem</label>
                    <input type="text" id="admin-settings-role" class="admin-form-input" value="Full System Administrator" readonly style="opacity:0.7;cursor:not-allowed;">
                </div>
                <div class="admin-modal-actions">
                    <button type="button" class="btn-admin-cancel" onclick="closeAdminSettingsModal()">Batal</button>
                    <button type="submit" class="btn-admin-submit-save">Simpan Pengaturan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- TOAST NOTIFICATION                            -->
    <!-- ============================================== -->
    <div class="admin-toast" id="admin-toast">
        <span class="admin-toast-icon">✓</span>
        <span class="admin-toast-msg" id="admin-toast-text">Berhasil memperbarui data.</span>
    </div>

    <!-- Live Interactive Client Logic for Admin Portal -->
    <script>
        // ===== PROFILE DROPDOWN TOGGLE =====
        function toggleAdminUserMenu(e) {
            if (e) e.stopPropagation();
            const dropdown = document.getElementById('admin-user-dropdown');
            const btn = document.getElementById('admin-user-menu-btn');
            if (dropdown) {
                const isOpen = dropdown.classList.contains('show');
                dropdown.classList.toggle('show', !isOpen);
                if (btn) btn.setAttribute('aria-expanded', String(!isOpen));
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const wrap = document.querySelector('.admin-user-dropdown-wrap');
            const dropdown = document.getElementById('admin-user-dropdown');
            if (dropdown && wrap && !wrap.contains(e.target)) {
                dropdown.classList.remove('show');
                const btn = document.getElementById('admin-user-menu-btn');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            }
        });

        // ===== ADMIN SETTINGS MODAL =====
        function openAdminSettingsModal() {
            const modal = document.getElementById('admin-settings-modal');
            if (modal) { modal.classList.add('show'); document.body.style.overflow = 'hidden'; }
            const dropdown = document.getElementById('admin-user-dropdown');
            if (dropdown) dropdown.classList.remove('show');
        }
        function closeAdminSettingsModal() {
            const modal = document.getElementById('admin-settings-modal');
            if (modal) { modal.classList.remove('show'); document.body.style.overflow = ''; }
        }
        function saveAdminSettings(e) {
            e.preventDefault();
            closeAdminSettingsModal();
            showAdminToast('Pengaturan profil admin berhasil diperbarui!');
        }

        // ===== DESTINATION DETAIL MODAL (NO PORTAL REDIRECT) =====
        function openAdminSpotDetail(key, btn) {
            const card = btn ? btn.closest('.dash-recom-card') : document.querySelector('.dash-recom-card[data-key="' + key + '"]');
            const modal = document.getElementById('dest-detail-modal');
            if (!modal) return;
            let title = 'Air Terjun Sekumpul', desc = 'Keindahan alam Bali yang memukau.',
                time = '07:00 - 16:00 WITA', ticket = 'Rp 20.000', loc = 'Buleleng, Bali',
                cat = 'Waterfall', imgSrc = '/images/waterfall.jpg';
            if (card) {
                title  = card.dataset.title  || card.querySelector('.dash-recom-card-title')?.textContent  || title;
                desc   = card.dataset.desc   || card.querySelector('.dash-recom-card-desc')?.textContent   || desc;
                time   = card.dataset.time   || time;
                ticket = card.dataset.ticket || ticket;
                loc    = card.dataset.loc    || loc;
                cat    = card.dataset.category || cat;
                const img = card.querySelector('.dash-recom-img');
                if (img) imgSrc = img.src;
            }
            const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
            set('dest-detail-title', title);
            set('dest-detail-desc', desc);
            set('dest-detail-time', time);
            set('dest-detail-ticket', ticket);
            set('dest-detail-location-text', loc);
            set('dest-detail-category', cat.charAt(0).toUpperCase() + cat.slice(1));
            ['dest-detail-img','dest-detail-img-thumb-1','dest-detail-img-thumb-2','dest-detail-img-thumb-3'].forEach(id => {
                const el = document.getElementById(id); if (el) el.src = imgSrc;
            });
            modal.classList.add('active', 'show');
            document.body.style.overflow = 'hidden';
        }
        function closeAdminSpotDetail() {
            const modal = document.getElementById('dest-detail-modal');
            if (modal) { modal.classList.remove('active', 'show'); document.body.style.overflow = ''; }
        }

        // ===== EDIT DESTINATION MODAL (PENCIL ICON) =====
        let currentEditingCard = null;
        function openEditDestModal(btn, e) {
            if (e) e.stopPropagation();
            const card = btn.closest('.dash-recom-card');
            if (!card) return;
            currentEditingCard = card;
            const get = (id, val) => { const el = document.getElementById(id); if (el) el.value = val; };
            get('edit-dest-title',    card.dataset.title    || card.querySelector('.dash-recom-card-title')?.textContent || '');
            get('edit-dest-category', card.dataset.category || 'waterfall');
            get('edit-dest-ticket',   card.dataset.ticket   || 'Rp 20.000 / orang');
            get('edit-dest-time',     card.dataset.time     || '08:00 - 17:00');
            get('edit-dest-loc',      card.dataset.loc      || 'Bali, Indonesia');
            get('edit-dest-desc',     card.dataset.desc     || card.querySelector('.dash-recom-card-desc')?.textContent || '');
            const modal = document.getElementById('admin-edit-dest-modal');
            if (modal) { modal.classList.add('show'); document.body.style.overflow = 'hidden'; }
        }
        function closeEditDestModal() {
            const modal = document.getElementById('admin-edit-dest-modal');
            if (modal) { modal.classList.remove('show'); document.body.style.overflow = ''; }
            currentEditingCard = null;
        }
        function handleEditDestSubmit(e) {
            e.preventDefault();
            if (!currentEditingCard) return;
            const val = id => document.getElementById(id)?.value || '';
            const newTitle = val('edit-dest-title'), newCat = val('edit-dest-category'),
                  newTicket = val('edit-dest-ticket'), newTime = val('edit-dest-time'),
                  newLoc = val('edit-dest-loc'), newDesc = val('edit-dest-desc');
            currentEditingCard.dataset.title   = newTitle;
            currentEditingCard.dataset.category = newCat;
            currentEditingCard.dataset.ticket  = newTicket;
            currentEditingCard.dataset.time    = newTime;
            currentEditingCard.dataset.loc     = newLoc;
            currentEditingCard.dataset.desc    = newDesc;
            const t = currentEditingCard.querySelector('.dash-recom-card-title');
            if (t) t.textContent = newTitle;
            const d = currentEditingCard.querySelector('.dash-recom-card-desc');
            if (d) d.textContent = newDesc;
            const b = currentEditingCard.querySelector('.dash-recom-badge');
            if (b) b.textContent = newCat.charAt(0).toUpperCase() + newCat.slice(1);
            closeEditDestModal();
            showAdminToast('Destinasi "' + newTitle + '" berhasil diperbarui! ✨');
        }

        // ===== DELETE DESTINATION CARD (TRASH ICON) =====
        function confirmDeleteCard(btn, e) {
            if (e) e.stopPropagation();
            const card = btn.closest('.dash-recom-card');
            if (!card) return;
            const title = card.dataset.title || card.querySelector('.dash-recom-card-title')?.textContent || 'Destinasi';
            if (confirm('Hapus "' + title + '" dari katalog destinasi?')) {
                card.style.transition = 'all 0.35s ease';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.88)';
                setTimeout(() => {
                    card.remove();
                    const count = document.querySelectorAll('#admin-cards-container .dash-recom-card').length;
                    const badge = document.getElementById('admin-dest-count-badge');
                    if (badge) badge.textContent = count + ' Destinasi Aktif';
                    const stat = document.getElementById('stat-post-count');
                    if (stat) stat.textContent = count;
                    showAdminToast('Destinasi "' + title + '" berhasil dihapus.');
                }, 350);
            }
        }

        // ===== REVIEW MODERATION DETAIL MODAL =====
        let currentCommentRow = null;
        function openReviewDetailModal(btn) {
            const row = btn.closest('tr');
            if (!row) return;
            currentCommentRow = row;
            const user    = row.dataset.user    || row.querySelector('.admin-cell-title')?.textContent || 'Pengguna';
            const dest    = row.dataset.dest    || row.querySelector('.admin-role-tag')?.textContent   || 'Destinasi';
            const rating  = row.dataset.rating  || '5.0';
            const time    = row.dataset.time    || 'Baru saja';
            const comment = row.dataset.comment || row.querySelector('.admin-comment-snippet')?.textContent?.replace(/"/g,'').trim() || '';
            const avatarMini = row.querySelector('.admin-avatar-mini');
            const avatarText = avatarMini ? avatarMini.textContent : user.slice(0,2).toUpperCase();
            const avatarBg   = avatarMini ? (avatarMini.style.background || '#244b2c') : '#244b2c';
            const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
            set('review-detail-user',    user);
            set('review-detail-dest',    dest);
            set('review-detail-rating',  '★ ' + rating + ' / 5.0');
            set('review-detail-time',    time);
            set('review-detail-comment', '"' + comment + '"');
            const av = document.getElementById('review-detail-avatar');
            if (av) { av.textContent = avatarText; av.style.background = avatarBg; }
            const modal = document.getElementById('admin-review-detail-modal');
            if (modal) { modal.classList.add('show'); document.body.style.overflow = 'hidden'; }
        }
        function closeReviewDetailModal() {
            const modal = document.getElementById('admin-review-detail-modal');
            if (modal) { modal.classList.remove('show'); document.body.style.overflow = ''; }
            currentCommentRow = null;
        }
        function deleteCurrentReviewFromModal() {
            if (!currentCommentRow) return;
            const user = currentCommentRow.dataset.user || 'Ulasan';
            currentCommentRow.style.transition = 'all 0.3s ease';
            currentCommentRow.style.opacity = '0';
            setTimeout(() => {
                if (currentCommentRow) currentCommentRow.remove();
                updateCommentsCount();
                closeReviewDetailModal();
                showAdminToast('Ulasan dari ' + user + ' berhasil dihapus.');
            }, 300);
        }
        function deleteCommentRow(btn, e) {
            if (e) e.stopPropagation();
            const row = btn.closest('tr');
            if (!row) return;
            const user = row.dataset.user || 'Pengguna';
            if (confirm('Hapus komentar dari "' + user + '"?')) {
                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '0';
                setTimeout(() => { row.remove(); updateCommentsCount(); showAdminToast('Ulasan dari ' + user + ' dihapus.'); }, 300);
            }
        }
        function updateCommentsCount() {
            const count = document.querySelectorAll('#admin-comments-tbody tr').length;
            const badge = document.getElementById('admin-table-count');
            if (badge) badge.textContent = count + ' Ulasan Aktif';
            const pill = document.querySelector('.admin-nav-item[data-nav="ulasan"] .admin-nav-pill');
            if (pill) pill.textContent = count;
        }

        // ===== CLOSE MODALS ON BACKDROP CLICK =====
        document.addEventListener('DOMContentLoaded', () => {
            ['dest-detail-modal','admin-edit-dest-modal','admin-review-detail-modal','admin-settings-modal','admin-create-dest-modal'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('click', (e) => {
                    if (e.target === el) {
                        el.classList.remove('show','active');
                        document.body.style.overflow = '';
                        currentEditingCard = null;
                        currentCommentRow = null;
                    }
                });
            });
        });

        // ===== ESC KEY CLOSES ALL ADMIN MODALS =====
        document.addEventListener('keydown', (e) => {
            if (e.key !== 'Escape') return;
            ['dest-detail-modal','admin-edit-dest-modal','admin-review-detail-modal','admin-settings-modal','admin-create-dest-modal'].forEach(id => {
                const el = document.getElementById(id);
                if (el) { el.classList.remove('show','active'); document.body.style.overflow = ''; }
            });
            currentEditingCard = null; currentCommentRow = null;
        });

        // Handle Left Navigation Item Click
        function handleNavClick(element, type) {
            document.querySelectorAll('.admin-nav-item').forEach(item => item.classList.remove('active'));
            if (element) element.classList.add('active');

            if (type === 'destinasi') {
                filterDestCards('all');
                showAdminToast('Menampilkan Kelola Destinasi (Seluruh Katalog Dewasufa)');
                scrollToDestCards();
            } else if (type === 'ulasan') {
                filterAdminTable('review');
                syncTableFilterTab('review');
                showAdminToast('Menampilkan Moderasi Ulasan');
                scrollToTable();
            } else if (type === 'all') {
                filterDestCards('all');
                filterAdminTable('all');
                syncTableFilterTab('all');
                showAdminToast('Kembali ke Dashboard Utama');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else if (type === 'kategori') {
                scrollToCategories();
                showAdminToast('Menampilkan Kategori Alam Dewasufa');
            } else {
                const label = element?.querySelector('.admin-nav-label')?.textContent || type;
                showAdminToast(`Menu "${label}" aktif`);
            }
        }

        // Programmatically update active nav item
        function updateNavActive(navKey) {
            const target = document.querySelector(`.admin-nav-item[data-nav="${navKey}"]`);
            if (target) {
                document.querySelectorAll('.admin-nav-item').forEach(item => item.classList.remove('active'));
                target.classList.add('active');
            }
        }

        // Filter Destination Cards (Identical to User Dashboard behavior)
        function filterDestCards(cat, clickedBtn) {
            if (clickedBtn) {
                document.querySelectorAll('#admin-destinasi-section .dash-cat-pill').forEach(btn => btn.classList.remove('active'));
                clickedBtn.classList.add('active');
            } else {
                document.querySelectorAll('#admin-destinasi-section .dash-cat-pill').forEach(btn => {
                    const fn = btn.getAttribute('onclick') || '';
                    if (fn.includes(`'${cat}'`)) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
            }

            const cards = document.querySelectorAll('#admin-cards-container .dash-recom-card');
            let count = 0;

            cards.forEach(card => {
                const cardCat = card.dataset.category;
                const isMatch = (cat === 'all') || (cardCat === cat);

                if (isMatch) {
                    card.style.display = 'flex';
                    count++;
                } else {
                    card.style.display = 'none';
                }
            });

            const badge = document.getElementById('admin-dest-count-badge');
            if (badge) {
                badge.textContent = `${count} Destinasi Ditampilkan`;
            }
        }

        function scrollToDestCards() {
            const el = document.getElementById('admin-destinasi-section');
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function scrollToCategories() {
            const el = document.querySelector('.admin-categories-section');
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function scrollToTable() {
            const target = document.getElementById('admin-table-container');
            if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // Filter by Category from Category Grid
        function filterByCategory(cat) {
            let filterKey = 'all';
            if (cat === 'Waterfall') filterKey = 'waterfall';
            else if (cat === 'Sunset Beach') filterKey = 'sunset';
            else if (cat === 'Sunrise Beach') filterKey = 'sunrise';
            else if (cat === 'Gunung') filterKey = 'mountain';

            filterDestCards(filterKey);
            showAdminToast(`Memfilter kategori: ${cat}`);
            scrollToDestCards();
        }

        // Synchronize Table Filter Tabs
        function syncTableFilterTab(tabType) {
            document.querySelectorAll('.admin-tab-btn').forEach(btn => {
                const onclickAttr = btn.getAttribute('onclick') || '';
                if (onclickAttr.includes(`'${tabType}'`)) {
                    document.querySelectorAll('.admin-tab-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                }
            });
        }

        // Filter Table Rows
        function filterAdminTable(type, clickedBtn) {
            if (clickedBtn) {
                document.querySelectorAll('.admin-tab-btn').forEach(btn => btn.classList.remove('active'));
                clickedBtn.classList.add('active');
            }

            const rows = document.querySelectorAll('#admin-main-table tbody tr');
            let count = 0;

            rows.forEach(row => {
                const rowType = row.dataset.type;
                const isMatch = (type === 'all') || 
                                (type === 'destinasi' && rowType === 'active') || 
                                (rowType === type);

                if (isMatch) {
                    row.style.display = '';
                    count++;
                } else {
                    row.style.display = 'none';
                }
            });

            const badge = document.getElementById('admin-table-count');
            if (badge) badge.textContent = `${count} Data Terpilih`;
        }

        // Live Search in Destination Cards & Main Table
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('admin-search-input');
            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase().trim();

                    // Filter Cards
                    const cards = document.querySelectorAll('#admin-cards-container .dash-recom-card');
                    let cardCount = 0;
                    cards.forEach(card => {
                        const text = card.textContent.toLowerCase();
                        if (!query || text.includes(query)) {
                            card.style.display = 'flex';
                            cardCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    const cardBadge = document.getElementById('admin-dest-count-badge');
                    if (cardBadge) cardBadge.textContent = `${cardCount} Destinasi Ditemukan`;

                    // Filter Table
                    const rows = document.querySelectorAll('#admin-main-table tbody tr');
                    let rowCount = 0;
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        if (!query || text.includes(query)) {
                            row.style.display = '';
                            rowCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    const badge = document.getElementById('admin-table-count');
                    if (badge) badge.textContent = `${rowCount} Data Ditemukan`;
                });
            }
        });

        // Approve Review
        function approveReview(id) {
            const statusEl = document.getElementById(`status-${id}`);
            if (statusEl) {
                statusEl.className = 'admin-status-dot dot-active';
                statusEl.textContent = '● Ulasan Diterbitkan';
            }
            showAdminToast('Ulasan berhasil disetujui dan kini tampil publik!');
        }

        // Reject / Delete Review or Item
        function rejectReview(id) {
            const targetRow = window.event?.target?.closest('tr');
            if (targetRow) {
                targetRow.style.transition = 'all 0.3s ease';
                targetRow.style.opacity = '0';
                targetRow.style.transform = 'scale(0.96)';
                setTimeout(() => {
                    targetRow.remove();
                    const badge = document.getElementById('admin-table-count');
                    const remaining = document.querySelectorAll('#admin-main-table tbody tr').length;
                    if (badge) badge.textContent = `${remaining} Data Terpilih`;
                    showAdminToast('Data/ulasan berhasil dihapus.');
                }, 300);
            } else {
                const statusEl = document.getElementById(`status-${id}`);
                if (statusEl) {
                    statusEl.className = 'admin-status-dot dot-rejected';
                    statusEl.textContent = '● Dihapus';
                }
                showAdminToast('Data/ulasan berhasil dihapus.');
            }
        }

        // View Destination helper
        function viewDestination(key) {
            showAdminToast(`Membuka rincian destinasi: ${key}`);
            window.location.href = `/dashboard`;
        }

        function scrollToTable() {
            const target = document.getElementById('admin-table-container');
            if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // Modal Handlers
        function openAdminCreateModal() {
            const modal = document.getElementById('admin-create-dest-modal');
            if (modal) {
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeAdminCreateModal() {
            const modal = document.getElementById('admin-create-dest-modal');
            if (modal) {
                modal.classList.remove('show');
                document.body.style.overflow = '';
            }
        }

        // Handle Add New Destination Form Submit
        function handleAdminAddDest(event) {
            event.preventDefault();
            const name = document.getElementById('dest-input-name')?.value;
            const cat = document.getElementById('dest-input-category')?.value || 'Waterfall';
            const location = document.getElementById('dest-input-location')?.value || 'Bali';

            if (!name) return;

            // Prepend new row to table
            const tbody = document.querySelector('#admin-main-table tbody');
            if (tbody) {
                const tr = document.createElement('tr');
                tr.dataset.type = 'active';
                tr.dataset.category = cat;
                tr.innerHTML = `
                    <td>
                        <div class="admin-user-cell">
                            <div class="admin-avatar-mini" style="background: #f5b842; color: #122115;">${name.charAt(0).toUpperCase()}</div>
                            <div>
                                <div class="admin-cell-title">${name}</div>
                                <div class="admin-cell-sub">Destinasi Baru Ditambahkan</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="admin-role-tag role-dest">${cat}</span></td>
                    <td><span class="admin-status-dot dot-active">● Terverifikasi (Aktif)</span></td>
                    <td><span class="admin-location-cell">${location}</span></td>
                    <td style="text-align: right;">
                        <div class="admin-row-actions">
                            <button type="button" class="btn-action-view" onclick="showAdminToast('Destinasi aktif di katalog!')">Detail</button>
                        </div>
                    </td>
                `;
                tbody.prepend(tr);
            }

            closeAdminCreateModal();
            document.getElementById('admin-add-dest-form')?.reset();
            showAdminToast(`Destinasi "${name}" berhasil ditambahkan ke katalog Dewasufa! 🌿`);
            scrollToTable();
        }

        // Admin Toast Alert
        let adminToastTimer = null;
        function showAdminToast(msg, icon = '✓') {
            const toast = document.getElementById('admin-toast');
            const toastMsg = document.getElementById('admin-toast-text');
            const toastIcon = toast?.querySelector('.admin-toast-icon');

            if (!toast || !toastMsg) return;

            toastMsg.textContent = msg;
            if (toastIcon) toastIcon.textContent = icon;

            toast.classList.add('show');
            clearTimeout(adminToastTimer);
            adminToastTimer = setTimeout(() => {
                toast.classList.remove('show');
            }, 3200);
        }
    </script>
</body>
</html>
