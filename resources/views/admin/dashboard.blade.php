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
                    <span class="admin-nav-pill">53</span>
                </a>

                <a href="javascript:void(0)" class="admin-nav-item" data-nav="author" onclick="handleNavClick(this, 'pending')">
                    <div class="admin-nav-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                    </div>
                    <span class="admin-nav-label">Verifikasi Author</span>
                    <span class="admin-nav-pill pill-alert" id="badge-pending-count">4</span>
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

                <a href="javascript:void(0)" class="admin-nav-item" data-nav="rencana" onclick="handleNavClick(this, 'rencana')">
                    <div class="admin-nav-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <span class="admin-nav-label">Rencana Wisata</span>
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

                <a href="javascript:void(0)" class="admin-nav-item" data-nav="pengaturan" onclick="handleNavClick(this, 'pengaturan')">
                    <div class="admin-nav-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </div>
                    <span class="admin-nav-label">Pengaturan</span>
                </a>
            </nav>

            <!-- Bottom Links: Switch to User Portal & Logout -->
            <div class="admin-sidebar-footer">
                <a href="{{ route('dashboard') }}" class="admin-portal-switch" title="Lihat Tampilan Wisatawan">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    <span>Portal Pengguna</span>
                </a>

                <a href="{{ route('home') }}" class="admin-logout-btn" id="btn-admin-logout">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Logout</span>
                </a>
            </div>
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
                    <input type="text" id="admin-search-input" placeholder="Cari destinasi, author, pemohon, ulasan..." aria-label="Cari data admin">
                </div>

                <div class="admin-topbar-actions">
                    <button type="button" class="btn-admin-add-new" id="btn-open-create-modal" onclick="openAdminCreateModal()">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Tambah Baru</span>
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Big Welcome Banner (Like Reference Image's Hero Banner) -->
            <section class="admin-hero-banner">
                <div class="admin-hero-text">
                    <span class="admin-hero-badge">🌿 Portal Pengelola Dewasufa</span>
                    <h1 class="admin-hero-title">Selamat Pagi, Admin Dewasufa!</h1>
                    <p class="admin-hero-subtitle">Ada <strong id="hero-pending-text">4 permohonan author baru</strong> dan <strong>12 ulasan wisatawan</strong> yang menunggu verifikasi Anda hari ini. Kelola keindahan wisata alam Bali dengan prima.</p>
                    <div class="admin-hero-actions">
                        <button type="button" class="btn-hero-review" onclick="filterAdminTable('pending'); scrollToTable();">Tinjau Sekarang</button>
                        <button type="button" class="btn-hero-outline" onclick="openAdminCreateModal()">+ Tambah Destinasi</button>
                    </div>
                </div>
                <div class="admin-hero-illustration" aria-hidden="true">
                    <div class="hero-illustration-art">
                        <svg viewBox="0 0 180 180" class="hero-character-svg" preserveAspectRatio="xMidYMid meet">
                            <defs>
                                <linearGradient id="leafGrad1" x1="0%" y1="100%" x2="0%" y2="0%">
                                    <stop offset="0%" stop-color="rgba(36, 75, 44, 0.45)" />
                                    <stop offset="100%" stop-color="rgba(74, 222, 128, 0.3)" />
                                </linearGradient>
                                <linearGradient id="leafGrad2" x1="0%" y1="100%" x2="0%" y2="0%">
                                    <stop offset="0%" stop-color="rgba(245, 184, 66, 0.25)" />
                                    <stop offset="100%" stop-color="rgba(245, 184, 66, 0.5)" />
                                </linearGradient>
                                <linearGradient id="laptopScreenGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#38bdf8" />
                                    <stop offset="100%" stop-color="#0f172a" />
                                </linearGradient>
                            </defs>

                            <!-- Organic Backdrop Petals/Leaves (Matching reference image) -->
                            <path d="M90 145 C45 125 30 75 55 35 C80 65 90 105 90 145 Z" fill="url(#leafGrad1)" />
                            <path d="M90 145 C75 90 75 40 90 18 C105 40 105 90 90 145 Z" fill="url(#leafGrad2)" />
                            <path d="M90 145 C90 105 100 65 125 35 C150 75 135 125 90 145 Z" fill="url(#leafGrad1)" />
                            <circle cx="90" cy="95" r="55" fill="rgba(245, 184, 66, 0.12)" stroke="rgba(255, 255, 255, 0.15)" stroke-width="1.2" />

                            <!-- Administrator Figure (Proportionate, elegant character) -->
                            <!-- Hair Bun -->
                            <circle cx="90" cy="38" r="10" fill="#122115" />
                            <circle cx="95" cy="36" r="5.5" fill="#1b3821" />
                            <!-- Face & Neck -->
                            <path d="M86 57 L86 67 L94 67 L94 57 Z" fill="#fbd7b5" />
                            <ellipse cx="90" cy="49" rx="10" ry="12" fill="#fbd7b5" />
                            <!-- Hair Front / Bangs -->
                            <path d="M80 47 C80 37 100 37 100 47 C97 43 93 41 90 41 C87 41 83 43 80 47 Z" fill="#122115" />
                            <!-- Eyes & Smile -->
                            <ellipse cx="86.5" cy="49" rx="1.2" ry="1.2" fill="#122115" />
                            <ellipse cx="93.5" cy="49" rx="1.2" ry="1.2" fill="#122115" />
                            <path d="M88 54 Q90 56 92 54" stroke="#c27847" stroke-width="0.9" fill="none" stroke-linecap="round" />

                            <!-- Raised Left Arm / Greeting Hand (like reference image) -->
                            <path d="M78 70 C72 63 67 54 68 45 C70 45 74 48 76 54 L78 68 Z" fill="#fbd7b5" />
                            <circle cx="68" cy="44" r="2.8" fill="#fbd7b5" />

                            <!-- Crisp White Shirt / Blouse -->
                            <path d="M76 68 C76 64 83 64 90 64 C97 64 104 64 104 68 L107 102 C107 105 101 107 90 107 C79 107 73 105 73 102 Z" fill="#ffffff" />
                            <path d="M85 64 L90 72 L95 64 Z" fill="#e2e8f0" />
                            <path d="M84 64 L87 71 L90 74 L93 71 L96 64" stroke="#244b2c" stroke-width="1.2" fill="none" />

                            <!-- Hands Holding Laptop -->
                            <path d="M73 84 C71 93 73 102 78 103 L82 96 Z" fill="#fbd7b5" />
                            <path d="M107 84 C109 93 107 102 102 103 L98 96 Z" fill="#fbd7b5" />

                            <!-- Open Laptop with Glowing Nature Stats -->
                            <polygon points="69,106 111,106 107,112 73,112" fill="#cbd5e1" stroke="#94a3b8" stroke-width="0.8" />
                            <polygon points="74,89 106,89 108,106 72,106" fill="#ffffff" stroke="#cbd5e1" stroke-width="1" />
                            <rect x="76" y="91" width="28" height="13" rx="1.5" fill="url(#laptopScreenGrad)" />
                            <line x1="79" y1="95" x2="88" y2="95" stroke="#f5b842" stroke-width="1" stroke-linecap="round" />
                            <line x1="79" y1="98" x2="100" y2="98" stroke="#4ade80" stroke-width="1" stroke-linecap="round" />
                            <line x1="79" y1="101" x2="93" y2="101" stroke="#ffffff" stroke-width="0.8" stroke-linecap="round" />

                            <!-- Skirt / Base -->
                            <path d="M73 110 C73 107 81 107 90 107 C99 107 107 107 107 110 L110 152 C110 156 70 156 70 152 Z" fill="#1b3821" />

                            <!-- Hair Flower Accent -->
                            <circle cx="79" cy="41" r="2.8" fill="#f5b842" />
                            <circle cx="79" cy="41" r="1.1" fill="#ffffff" />
                        </svg>
                    </div>
                </div>
            </section>

            <!-- Status Ringkasan Destinasi (Post, Pending, Draft) -->
            <section class="admin-status-section" aria-label="Status Ringkasan Destinasi">
                <div class="admin-status-grid">
                    <!-- 1. POST (Terbit) -->
                    <div class="admin-status-card stat-card-post" onclick="filterAdminTable('active'); updateNavActive('destinasi');" role="button" tabindex="0" title="Klik untuk memfilter destinasi aktif yang tayang">
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
                                <span class="stat-main-number" id="stat-post-count">53</span>
                                <span class="stat-unit">Destinasi</span>
                            </div>
                            <p class="stat-card-desc">Konten aktif tayang di katalog publik</p>
                        </div>
                    </div>

                    <!-- 2. PENDING (Menunggu Verifikasi) -->
                    <div class="admin-status-card stat-card-pending" onclick="filterAdminTable('pending'); updateNavActive('author');" role="button" tabindex="0" title="Klik untuk memfilter permohonan pending">
                        <div class="stat-card-icon-wrap icon-pending">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-header">
                                <span class="stat-card-title">Pending</span>
                                <span class="stat-pill-badge badge-waiting">● Perlu Aksi</span>
                            </div>
                            <div class="stat-card-value-group">
                                <span class="stat-main-number" id="stat-pending-count">4</span>
                                <span class="stat-unit">Permohonan</span>
                            </div>
                            <p class="stat-card-desc">Verifikasi author & konten destinasi</p>
                        </div>
                    </div>

                    <!-- 3. DRAFT (Konsep / Siap Rilis) -->
                    <div class="admin-status-card stat-card-draft" onclick="showAdminToast('Menampilkan 3 draft destinasi siap rilis'); scrollToTable();" role="button" tabindex="0" title="Klik untuk melihat draft">
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
                            <p class="stat-card-desc">Destinasi siap uji & rilis ke publik</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Kategori Destinasi Dewasufa ("You Need to hire" Section in Reference) -->
            <section class="admin-categories-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">Kategori Destinasi Dewasufa</h2>
                    <a href="javascript:void(0)" class="admin-link-view-all" onclick="filterAdminTable('all')">Lihat Semua</a>
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

                    <!-- Culture / Heritage -->
                    <div class="admin-cat-card" onclick="filterByCategory('all')">
                        <div class="admin-cat-icon-box cat-all">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </div>
                        <div class="admin-cat-info">
                            <h3 class="admin-cat-name">Semua Wisata</h3>
                            <span class="admin-cat-count">(53 Destinasi)</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tabel Verifikasi & Destinasi ("Recruitment Progress" Section in Reference) -->
            <section class="admin-table-section" id="admin-table-container">
                <div class="admin-section-header">
                    <div class="admin-table-title-group">
                        <h2 class="admin-section-title">Verifikasi & Pengelolaan Destinasi</h2>
                        <span class="admin-table-count-badge" id="admin-table-count">6 Data Terpilih</span>
                    </div>

                    <!-- Filter Tabs -->
                    <div class="admin-table-filters">
                        <button type="button" class="admin-tab-btn active" onclick="filterAdminTable('all', this)">Semua</button>
                        <button type="button" class="admin-tab-btn" onclick="filterAdminTable('pending', this)">Menunggu Verifikasi</button>
                        <button type="button" class="admin-tab-btn" onclick="filterAdminTable('active', this)">Terverifikasi</button>
                        <button type="button" class="admin-tab-btn" onclick="filterAdminTable('review', this)">Ulasan Baru</button>
                    </div>
                </div>

                <div class="admin-table-card">
                    <div class="admin-table-responsive">
                        <table class="admin-data-table" id="admin-main-table">
                            <thead>
                                <tr>
                                    <th>Nama / Entitas</th>
                                    <th>Peran / Kategori</th>
                                    <th>Status Verifikasi</th>
                                    <th>Kontak / Wilayah</th>
                                    <th style="text-align: right;">Aksi Cepat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 (Highlight Active Row, matching reference image) -->
                                <tr class="admin-row-active" data-type="pending" data-category="Waterfall">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #e59b2b; color: #122115;">PA</div>
                                            <div>
                                                <div class="admin-cell-title">Putu Arya Wiguna</div>
                                                <div class="admin-cell-sub">Pendaftaran Author Wisata Alam</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="admin-role-tag role-author">Calon Author</span></td>
                                    <td><span class="admin-status-dot dot-pending" id="status-1">● Menunggu Verifikasi</span></td>
                                    <td><span class="admin-location-cell">Buleleng, Bali</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-approve" onclick="approveAuthor(1, 'Putu Arya Wiguna')">Setujui</button>
                                            <button type="button" class="btn-action-reject" onclick="rejectAuthor(1)">Tolak</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr data-type="active" data-category="Waterfall">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #244b2c; color: #ffffff;">AS</div>
                                            <div>
                                                <div class="admin-cell-title">Air Terjun Sekumpul</div>
                                                <div class="admin-cell-sub">Destinasi Rekomendasi Utama</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="admin-role-tag role-dest">Waterfall</span></td>
                                    <td><span class="admin-status-dot dot-active">● Terverifikasi (Aktif)</span></td>
                                    <td><span class="admin-location-cell">Sawan, Buleleng</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-view" onclick="viewDestination('sekumpul')">Detail</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr data-type="pending" data-category="Sunset Beach">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #df6a3e; color: #ffffff;">SW</div>
                                            <div>
                                                <div class="admin-cell-title">Sarah Wijaya</div>
                                                <div class="admin-cell-sub">Permohonan Pengelola Konten</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="admin-role-tag role-author">Calon Author</span></td>
                                    <td><span class="admin-status-dot dot-pending" id="status-2">● Menunggu Verifikasi</span></td>
                                    <td><span class="admin-location-cell">Ubud, Gianyar</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-approve" onclick="approveAuthor(2, 'Sarah Wijaya')">Setujui</button>
                                            <button type="button" class="btn-action-reject" onclick="rejectAuthor(2)">Tolak</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 4 -->
                                <tr data-type="review" data-category="Waterfall">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #5e8967; color: #ffffff;">KD</div>
                                            <div>
                                                <div class="admin-cell-title">Ketut Dharmayana</div>
                                                <div class="admin-cell-sub">Ulasan Pengunjung Baru (4.0 ★)</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="admin-role-tag role-review">Ulasan Wisata</span></td>
                                    <td><span class="admin-status-dot dot-review" id="status-3">● Perlu Tinjauan Ulasan</span></td>
                                    <td><span class="admin-location-cell">Air Terjun Tegenungan</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-approve" onclick="approveReview(3)">Terbitkan</button>
                                            <button type="button" class="btn-action-reject" onclick="rejectReview(3)">Hapus</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 5 -->
                                <tr data-type="active" data-category="Sunset Beach">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #e59b2b; color: #122115;">PM</div>
                                            <div>
                                                <div class="admin-cell-title">Pantai Melasti & Tebing Karang</div>
                                                <div class="admin-cell-sub">Destinasi Sunset Favorit</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="admin-role-tag role-dest">Sunset Beach</span></td>
                                    <td><span class="admin-status-dot dot-active">● Terverifikasi (Aktif)</span></td>
                                    <td><span class="admin-location-cell">Ungasan, Badung</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-view" onclick="viewDestination('sunset')">Detail</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 6 -->
                                <tr data-type="pending" data-category="Gunung">
                                    <td>
                                        <div class="admin-user-cell">
                                            <div class="admin-avatar-mini" style="background: #497a53; color: #ffffff;">GB</div>
                                            <div>
                                                <div class="admin-cell-title">Gede Batur Tour & Guide</div>
                                                <div class="admin-cell-sub">Pendaftaran Author Pemandu Trekking</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="admin-role-tag role-author">Calon Author</span></td>
                                    <td><span class="admin-status-dot dot-pending" id="status-4">● Menunggu Verifikasi</span></td>
                                    <td><span class="admin-location-cell">Kintamani, Bangli</span></td>
                                    <td style="text-align: right;">
                                        <div class="admin-row-actions">
                                            <button type="button" class="btn-action-approve" onclick="approveAuthor(4, 'Gede Batur Guide')">Setujui</button>
                                            <button type="button" class="btn-action-reject" onclick="rejectAuthor(4)">Tolak</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>


        <!-- ============================================== -->
        <!-- 3. RIGHT SIDEBAR / ACTIVITY PANEL              -->
        <!-- ============================================== -->
        <aside class="admin-right-sidebar">

            <!-- Top Profile & Icon Utilities Bar -->
            <div class="admin-profile-top">
                <div class="admin-icon-tools">
                    <button type="button" class="admin-tool-icon-btn" title="Pengaturan Sistem">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </button>
                    <button type="button" class="admin-tool-icon-btn admin-notif-btn" title="Notifikasi Admin">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="admin-notif-indicator"></span>
                    </button>
                </div>

                <div class="admin-profile-badge">
                    <div class="admin-profile-meta">
                        <span class="admin-profile-name">Erick</span>
                        <span class="admin-profile-role">Admin</span>
                    </div>
                    <div class="admin-profile-avatar">
                        <span>ER</span>
                    </div>
                </div>
            </div>

            <!-- Schedule Calendar (Matching Reference) -->
            <div class="admin-panel-widget">
                <div class="admin-widget-header">
                    <div class="admin-widget-title-row">
                        <h3 class="admin-widget-title">Jadwal & Agenda</h3>
                        <div class="admin-cal-nav">
                            <button type="button" class="cal-nav-arrow" aria-label="Sebelumnya">&lt;</button>
                            <button type="button" class="cal-nav-arrow" aria-label="Berikutnya">&gt;</button>
                        </div>
                    </div>
                    <span class="admin-cal-month">
                        <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>Mei 2026</span>
                    </span>
                </div>

                <!-- Calendar Day Pills -->
                <div class="admin-calendar-days">
                    <div class="cal-day-pill">
                        <span class="cal-day-label">Sen</span>
                        <span class="cal-day-num">22</span>
                    </div>
                    <div class="cal-day-pill">
                        <span class="cal-day-label">Sel</span>
                        <span class="cal-day-num">23</span>
                    </div>
                    <!-- Active Highlighted Day (Matching blue pill in reference) -->
                    <div class="cal-day-pill active">
                        <span class="cal-day-label">Rab</span>
                        <span class="cal-day-num">24</span>
                    </div>
                    <div class="cal-day-pill">
                        <span class="cal-day-label">Kam</span>
                        <span class="cal-day-num">25</span>
                    </div>
                    <div class="cal-day-pill">
                        <span class="cal-day-label">Jum</span>
                        <span class="cal-day-num">26</span>
                    </div>
                </div>
            </div>

            <!-- New Author Applicants ("New Applicants" in Reference) -->
            <div class="admin-panel-widget">
                <div class="admin-widget-header">
                    <h3 class="admin-widget-title">Permohonan Author</h3>
                    <a href="javascript:void(0)" class="admin-link-sm" onclick="filterAdminTable('pending')">Lihat Semua</a>
                </div>

                <div class="admin-applicants-list" id="applicants-sidebar-list">
                    <!-- Applicant 1 -->
                    <div class="admin-applicant-card" id="applicant-card-1">
                        <div class="applicant-avatar" style="background: #244b2c; color: #fff;">PA</div>
                        <div class="applicant-info">
                            <h4 class="applicant-name">Putu Arya Wiguna</h4>
                            <p class="applicant-applied">Author Destinasi Buleleng</p>
                        </div>
                        <div class="applicant-actions">
                            <button type="button" class="btn-app-action btn-app-chat" title="Kirim Email" onclick="showAdminToast('Membuka kontak Putu Arya: arya@wisata.bali')">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </button>
                            <button type="button" class="btn-app-action btn-app-approve" title="Setujui" onclick="approveAuthor(1, 'Putu Arya Wiguna')">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Applicant 2 -->
                    <div class="admin-applicant-card" id="applicant-card-2">
                        <div class="applicant-avatar" style="background: #df6a3e; color: #fff;">SW</div>
                        <div class="applicant-info">
                            <h4 class="applicant-name">Sarah Wijaya</h4>
                            <p class="applicant-applied">Kontributor Wisata Ubud</p>
                        </div>
                        <div class="applicant-actions">
                            <button type="button" class="btn-app-action btn-app-chat" title="Kirim Email" onclick="showAdminToast('Membuka kontak Sarah Wijaya')">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </button>
                            <button type="button" class="btn-app-action btn-app-approve" title="Setujui" onclick="approveAuthor(2, 'Sarah Wijaya')">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Applicant 3 -->
                    <div class="admin-applicant-card" id="applicant-card-3">
                        <div class="applicant-avatar" style="background: #e59b2b; color: #122115;">KD</div>
                        <div class="applicant-info">
                            <h4 class="applicant-name">Ketut Dharmayana</h4>
                            <p class="applicant-applied">Fotografer Pantai Badung</p>
                        </div>
                        <div class="applicant-actions">
                            <button type="button" class="btn-app-action btn-app-chat" title="Kirim Email" onclick="showAdminToast('Membuka kontak Ketut Dharmayana')">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </button>
                            <button type="button" class="btn-app-action btn-app-approve" title="Setujui" onclick="approveAuthor(3, 'Ketut Dharmayana')">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ready for Publishing Destinasi ("Ready For Training" in Reference) -->
            <div class="admin-panel-widget">
                <div class="admin-widget-header">
                    <h3 class="admin-widget-title">Destinasi Siap Rilis</h3>
                    <a href="javascript:void(0)" class="admin-link-sm" onclick="showAdminToast('Memuat semua draft destinasi...')">Semua Draft</a>
                </div>

                <div class="admin-ready-grid">
                    <!-- Destinasi 1 -->
                    <div class="admin-ready-card" id="ready-card-1">
                        <div class="ready-thumb">
                            <img src="/images/waterfall.jpg" alt="Hidden Canyon" class="ready-img">
                        </div>
                        <h4 class="ready-title">Hidden Canyon</h4>
                        <p class="ready-cat">Gianyar (Trekking)</p>
                        <button type="button" class="btn-ready-action" onclick="publishDraft(1, 'Hidden Canyon Beji Guwang')">Publikasikan</button>
                    </div>

                    <!-- Destinasi 2 -->
                    <div class="admin-ready-card" id="ready-card-2">
                        <div class="ready-thumb">
                            <img src="/images/mountain.jpg" alt="Savana Tianyar" class="ready-img">
                        </div>
                        <h4 class="ready-title">Savana Tianyar</h4>
                        <p class="ready-cat">Karangasem</p>
                        <button type="button" class="btn-ready-action" onclick="publishDraft(2, 'Savana Tianyar')">Publikasikan</button>
                    </div>

                    <!-- Destinasi 3 -->
                    <div class="admin-ready-card" id="ready-card-3">
                        <div class="ready-thumb">
                            <img src="/images/air terjun sekumpul.png" alt="Banyumala" class="ready-img">
                        </div>
                        <h4 class="ready-title">Banyumala Twin</h4>
                        <p class="ready-cat">Buleleng</p>
                        <button type="button" class="btn-ready-action" onclick="publishDraft(3, 'Air Terjun Banyumala Twin')">Publikasikan</button>
                    </div>
                </div>
            </div>

        </aside>

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


    <!-- ============================================== -->
    <!-- TOAST NOTIFICATION                            -->
    <!-- ============================================== -->
    <div class="admin-toast" id="admin-toast">
        <span class="admin-toast-icon">✓</span>
        <span class="admin-toast-msg" id="admin-toast-text">Berhasil memperbarui data.</span>
    </div>

    <!-- Live Interactive Client Logic for Admin Portal -->
    <script>
        // Handle Left Navigation Item Click (Lights up active menu in yellow gold)
        function handleNavClick(element, type) {
            document.querySelectorAll('.admin-nav-item').forEach(item => item.classList.remove('active'));
            element.classList.add('active');

            if (type === 'destinasi') {
                filterAdminTable('destinasi');
                syncTableFilterTab('active');
                showAdminToast('Menampilkan Kelola Destinasi (Destinasi Aktif)');
                scrollToTable();
            } else if (type === 'pending') {
                filterAdminTable('pending');
                syncTableFilterTab('pending');
                showAdminToast('Menampilkan Verifikasi Author');
                scrollToTable();
            } else if (type === 'ulasan') {
                filterAdminTable('review');
                syncTableFilterTab('review');
                showAdminToast('Menampilkan Moderasi Ulasan');
                scrollToTable();
            } else if (type === 'all') {
                filterAdminTable('all');
                syncTableFilterTab('all');
                showAdminToast('Kembali ke Dashboard Utama');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else if (type === 'kategori') {
                scrollToCategories();
                showAdminToast('Menampilkan Kategori Alam Dewasufa');
            } else {
                const label = element.querySelector('.admin-nav-label')?.textContent || type;
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

        function scrollToCategories() {
            const el = document.querySelector('.admin-categories-section');
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
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

        // Filter by Category
        function filterByCategory(cat) {
            const rows = document.querySelectorAll('#admin-main-table tbody tr');
            let count = 0;

            rows.forEach(row => {
                const rowCat = row.dataset.category;
                if (cat === 'all' || (rowCat && rowCat.toLowerCase().includes(cat.toLowerCase()))) {
                    row.style.display = '';
                    count++;
                } else {
                    row.style.display = 'none';
                }
            });

            const badge = document.getElementById('admin-table-count');
            if (badge) badge.textContent = `${count} Destinasi Kategori "${cat}"`;

            showAdminToast(`Memfilter kategori: ${cat}`);
            scrollToTable();
        }

        // Live Search in Main Table
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('admin-search-input');
            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase().trim();
                    const rows = document.querySelectorAll('#admin-main-table tbody tr');
                    let count = 0;

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        if (!query || text.includes(query)) {
                            row.style.display = '';
                            count++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    const badge = document.getElementById('admin-table-count');
                    if (badge) badge.textContent = `${count} Hasil Ditemukan`;
                });
            }
        });

        // Approve Author
        function approveAuthor(id, name) {
            const statusEl = document.getElementById(`status-${id}`);
            if (statusEl) {
                statusEl.className = 'admin-status-dot dot-active';
                statusEl.textContent = '● Terverifikasi (Aktif)';
            }

            const card = document.getElementById(`applicant-card-${id}`);
            if (card) {
                card.style.opacity = '0.4';
                card.style.pointerEvents = 'none';
            }

            updatePendingCount(-1);
            showAdminToast(`Author "${name}" berhasil disetujui & diverifikasi!`);
        }

        // Reject Author
        function rejectAuthor(id) {
            const statusEl = document.getElementById(`status-${id}`);
            if (statusEl) {
                statusEl.className = 'admin-status-dot dot-rejected';
                statusEl.textContent = '● Permohonan Ditolak';
            }

            const card = document.getElementById(`applicant-card-${id}`);
            if (card) {
                card.style.display = 'none';
            }

            updatePendingCount(-1);
            showAdminToast('Permohonan author ditolak.', '⚠️');
        }

        // Approve Review
        function approveReview(id) {
            const statusEl = document.getElementById(`status-${id}`);
            if (statusEl) {
                statusEl.className = 'admin-status-dot dot-active';
                statusEl.textContent = '● Ulasan Diterbitkan';
            }
            showAdminToast('Ulasan berhasil disetujui dan kini tampil publik!');
        }

        // Reject Review
        function rejectReview(id) {
            const statusEl = document.getElementById(`status-${id}`);
            if (statusEl) {
                statusEl.className = 'admin-status-dot dot-rejected';
                statusEl.textContent = '● Ulasan Disembunyikan';
            }
            showAdminToast('Ulasan disembunyikan/dihapus.', '⚠️');
        }

        // Publish Draft Destination
        function publishDraft(id, title) {
            const card = document.getElementById(`ready-card-${id}`);
            if (card) {
                const btn = card.querySelector('.btn-ready-action');
                if (btn) {
                    btn.textContent = '✓ Terbit';
                    btn.style.background = 'rgba(74, 222, 128, 0.2)';
                    btn.style.color = '#4ade80';
                    btn.style.borderColor = 'rgba(74, 222, 128, 0.4)';
                    btn.disabled = true;
                }
            }
            showAdminToast(`Destinasi "${title}" berhasil dipublikasikan ke katalog!`);
        }

        // Update Counter
        let currentPending = 4;
        function updatePendingCount(diff) {
            currentPending = Math.max(0, currentPending + diff);
            const badge = document.getElementById('badge-pending-count');
            if (badge) badge.textContent = currentPending;
            const heroText = document.getElementById('hero-pending-text');
            if (heroText) heroText.textContent = `${currentPending} permohonan author baru`;
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
