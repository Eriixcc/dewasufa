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

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        window.dbDestinations = @json($destinations ?? []);
    </script>
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

                <a href="javascript:void(0)" class="admin-nav-item" data-nav="ulasan" onclick="handleNavClick(this, 'ulasan')">
                    <div class="admin-nav-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </div>
                    <span class="admin-nav-label">Moderasi Ulasan</span>
                    <span class="admin-nav-pill">{{ count($comments ?? []) }}</span>
                </a>

                <!-- Divider -->
                <div class="admin-nav-divider"></div>

                <!-- + Tambah Baru -->
                <button type="button" class="admin-nav-add-btn" id="btn-open-create-modal" onclick="openAdminCreateModal()">
                    <div class="admin-nav-add-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </div>
                    <span class="admin-nav-add-label">Tambah Baru</span>
                </button>

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

                    <!-- Profile Pill with Dropdown (Matching User Dashboard) -->
                    <div class="dash-user-dropdown-wrap admin-user-dropdown-wrap">
                        <button type="button" class="dash-user-pill" id="admin-user-menu-btn" onclick="toggleAdminUserMenu(event)" aria-haspopup="true" aria-expanded="false">
                            <div class="dash-avatar" style="background: linear-gradient(135deg, #1b3821 0%, #244b2c 100%);">
                                @if(Auth::check() && Auth::user()->avatar)
                                    <img src="{{ asset(Auth::user()->avatar) }}" alt="Foto Profil Admin" class="dash-avatar-img" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                                @else
                                    <span class="dash-avatar-initials">{{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 2)) : 'ER' }}</span>
                                @endif
                            </div>
                            <div class="dash-user-info">
                                <span class="dash-user-name">{{ Auth::check() ? Auth::user()->name : 'Erick' }}</span>
                                <span class="dash-user-role" id="admin-user-role">{{ Auth::check() ? ucfirst(Auth::user()->role) : 'Admin' }}</span>
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
            <section class="admin-status-section" id="admin-status-section" aria-label="Status Ringkasan Destinasi">
                <div class="admin-status-grid">
                    <!-- 1. POST (Terbit) -->
                    <div class="admin-status-card stat-card-post" onclick="filterByStatus('post')" role="button" tabindex="0" title="Klik untuk memfilter destinasi aktif yang terbit">
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
                                <span class="stat-main-number" id="stat-post-count">{{ $stats['post'] ?? count($destinations) }}</span>
                                <span class="stat-unit">Destinasi</span>
                            </div>
                            <p class="stat-card-desc">Konten aktif tayang di katalog publik Dewasufa</p>
                        </div>
                    </div>

                    <!-- 2. PENDING (Hanya Admin yang Melihat) -->
                    <div class="admin-status-card stat-card-draft" onclick="filterByStatus('pending')" role="button" tabindex="0" title="Klik untuk memfilter destinasi pending (khusus admin)">
                        <div class="stat-card-icon-wrap icon-draft">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-header">
                                <span class="stat-card-title">Pending</span>
                                <span class="stat-pill-badge badge-draft" style="background: rgba(234, 179, 8, 0.2); color: #facc15; border: 1px solid rgba(234, 179, 8, 0.35);">● Admin Only</span>
                            </div>
                            <div class="stat-card-value-group">
                                <span class="stat-main-number" id="stat-draft-count">{{ $stats['pending'] ?? 0 }}</span>
                                <span class="stat-unit">Pending</span>
                            </div>
                            <p class="stat-card-desc">Hanya admin yang dapat melihat konten ini</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Kategori Destinasi Wisata (4 Kategori Unggulan) -->
            <section class="admin-categories-section" id="admin-categories-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">Kategori Destinasi Wisata</h2>
                </div>

                <div class="admin-category-grid">
                    <!-- Waterfall -->
                    <div class="admin-cat-card" data-cat="waterfall" onclick="filterByCategory('waterfall')" role="button" tabindex="0" title="Filter Destinasi Waterfall">
                        <div class="admin-cat-icon-box cat-waterfall">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                            </svg>
                        </div>
                        <div class="admin-cat-info">
                            <h3 class="admin-cat-name">Waterfall</h3>
                            <span class="admin-cat-count" id="admin-count-waterfall">({{ $stats['waterfall'] ?? 0 }} Destinasi)</span>
                        </div>
                    </div>

                    <!-- Sunset Beach -->
                    <div class="admin-cat-card" data-cat="sunset" onclick="filterByCategory('sunset')" role="button" tabindex="0" title="Filter Destinasi Sunset Beach">
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
                            <span class="admin-cat-count" id="admin-count-sunset">({{ $stats['sunset'] ?? 0 }} Destinasi)</span>
                        </div>
                    </div>

                    <!-- Sunrise Beach -->
                    <div class="admin-cat-card" data-cat="sunrise" onclick="filterByCategory('sunrise')" role="button" tabindex="0" title="Filter Destinasi Sunrise Beach">
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
                            <span class="admin-cat-count" id="admin-count-sunrise">({{ $stats['sunrise'] ?? 0 }} Destinasi)</span>
                        </div>
                    </div>

                    <!-- Mountain -->
                    <div class="admin-cat-card" data-cat="mountain" onclick="filterByCategory('mountain')" role="button" tabindex="0" title="Filter Destinasi Mountain">
                        <div class="admin-cat-icon-box cat-mountain">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="3 20 9 7 13 14 17 9 21 20 3 20"></polygon>
                            </svg>
                        </div>
                        <div class="admin-cat-info">
                            <h3 class="admin-cat-name">Mountain</h3>
                            <span class="admin-cat-count" id="admin-count-mountain">({{ $stats['mountain'] ?? 0 }} Destinasi)</span>
                        </div>
                    </div>

                    <!-- Lihat Semua -->
                    <div class="admin-cat-card" data-cat="all" onclick="filterByCategory('all')" role="button" tabindex="0" title="Tampilkan Semua Kategori Destinasi">
                        <div class="admin-cat-icon-box cat-all">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7" rx="1.5"></rect>
                                <rect x="14" y="3" width="7" height="7" rx="1.5"></rect>
                                <rect x="14" y="14" width="7" height="7" rx="1.5"></rect>
                                <rect x="3" y="14" width="7" height="7" rx="1.5"></rect>
                            </svg>
                        </div>
                        <div class="admin-cat-info">
                            <h3 class="admin-cat-name">Lihat Semua</h3>
                            <span class="admin-cat-count" id="admin-count-all">({{ count($destinations) }} Destinasi)</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================== -->
            <!-- 3. DESTINASI WISATA (KELOLA DESTINASI)         -->
            <!-- ============================================== -->
            <section class="dash-recom-section admin-dest-section" id="admin-destinasi-section" aria-label="Destinasi Wisata">
                <div class="dash-section-header">
                    <div class="admin-table-title-group">
                        <h2 class="dash-section-title">Destinasi Wisata</h2>
                        <span class="admin-table-count-badge" id="admin-dest-count-badge">{{ count($destinations) }} Destinasi</span>
                    </div>
                </div>

                <div class="dash-recom-grid admin-dest-cards-grid" id="admin-cards-container">
                    @forelse($destinations as $dest)
                        @php
                            $catSlug = $dest->category_slug;
                            $badgeClass = match($catSlug) {
                                'sunset' => 'badge-sunset',
                                'sunrise' => 'badge-sunrise',
                                'mountain' => 'badge-mountain',
                                default => '',
                            };
                        @endphp
                        <div class="dash-recom-card"
                            data-id="{{ $dest->id }}"
                            data-category="{{ $catSlug }}"
                            data-status="{{ $dest->status ?? 'post' }}"
                            data-key="{{ $dest->id }}"
                            data-title="{{ $dest->name }}"
                            data-desc="{{ $dest->description }}"
                            data-time="07:00 - 18:00 WITA"
                            data-ticket="{{ $dest->formatted_price }}"
                            data-price="{{ $dest->price }}"
                            data-loc="Bali, Indonesia"
                            data-rating="{{ number_format($dest->rating ?? 0.0, 1) }}"
                            data-reviews-count="{{ $dest->reviews_count ?? 0 }}"
                            data-best-visit="07:00 – 09:30 WITA"
                            data-tags="{{ $dest->category }}, Bali, Spot Foto"
                            data-gmaps="https://maps.google.com/?q={{ urlencode($dest->name . ' Bali') }}"
                            data-thumb1="{{ $dest->image_url }}"
                            data-thumb2="{{ $dest->image_url }}"
                            data-thumb3="{{ $dest->image_url }}">
                            <div class="dash-recom-img-wrap">
                                <img src="{{ $dest->image_url }}" alt="{{ $dest->name }}" class="dash-recom-img" loading="lazy">
                                <span class="dash-recom-badge {{ $badgeClass }}">{{ $dest->category }}</span>
                                @if(($dest->status ?? 'post') === 'pending')
                                    <span class="admin-card-status-pill badge-status-draft" style="background: rgba(234, 179, 8, 0.2); color: #facc15; border: 1px solid rgba(234, 179, 8, 0.35);">● Pending (Admin Only)</span>
                                @else
                                    <span class="admin-card-status-pill badge-status-post">● Post (Publik)</span>
                                @endif
                            </div>
                            <div class="dash-recom-body">
                                <h3 class="dash-recom-card-title">{{ $dest->name }}</h3>
                                <p class="dash-recom-card-desc">{{ $dest->description }}</p>
                                <div class="dash-recom-footer">
                                    <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('{{ $dest->id }}', this)">Detail</button>
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
                    @empty
                        <div class="admin-empty-state" style="grid-column: 1 / -1; padding: 48px; text-align: center; color: rgba(255,255,255,0.6);">
                            <p>Belum ada destinasi tersimpan di database dewasufa.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- Tabel Moderasi Ulasan & Komentar Destinasi -->
            <section class="admin-table-section" id="admin-table-container">
                <div class="admin-section-header admin-comments-section-header">
                    <div class="admin-table-title-group">
                        <h2 class="admin-section-title">Moderasi Komentar &amp; Ulasan Destinasi</h2>
                        <span class="admin-table-count-badge" id="admin-table-count">{{ count($comments ?? []) }} Komentar Pengunjung</span>
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
                                @forelse($comments as $comment)
                                    @php
                                        $catSlug = strtolower($comment->destination?->category_slug ?? $comment->destination_slug ?? 'waterfall');
                                        if (str_contains($catSlug, 'waterfall') || str_contains($catSlug, 'terjun')) {
                                            $catClass = 'waterfall';
                                            $tagStyle = 'background: rgba(36, 75, 44, 0.4); color: #5eead4; border-color: rgba(36, 75, 44, 0.6);';
                                        } elseif (str_contains($catSlug, 'sunset') || str_contains($catSlug, 'kuta') || str_contains($catSlug, 'melasti')) {
                                            $catClass = 'sunset';
                                            $tagStyle = 'background: rgba(251, 146, 60, 0.18); color: #fb923c; border-color: rgba(251, 146, 60, 0.3);';
                                        } elseif (str_contains($catSlug, 'sunrise') || str_contains($catSlug, 'sanur')) {
                                            $catClass = 'sunrise';
                                            $tagStyle = 'background: rgba(245, 184, 66, 0.18); color: #f5b842; border-color: rgba(245, 184, 66, 0.3);';
                                        } elseif (str_contains($catSlug, 'mountain') || str_contains($catSlug, 'gunung') || str_contains($catSlug, 'batur')) {
                                            $catClass = 'mountain';
                                            $tagStyle = 'background: rgba(168, 85, 247, 0.18); color: #c084fc; border-color: rgba(168, 85, 247, 0.3);';
                                        } else {
                                            $catClass = 'waterfall';
                                            $tagStyle = 'background: rgba(36, 75, 44, 0.4); color: #5eead4; border-color: rgba(36, 75, 44, 0.6);';
                                        }
                                        $destName = $comment->destination?->name ?? $comment->destination_name ?? 'Destinasi Wisata';
                                        $photosJson = json_encode($comment->photo_urls ?? []);
                                    @endphp
                                    <tr data-id="{{ $comment->id }}" data-category="{{ $catClass }}" data-user="{{ $comment->author_name }}" data-dest="{{ $destName }}" data-rating="{{ number_format($comment->rating, 1) }}" data-time="{{ $comment->formatted_date }}" data-comment="{{ $comment->comment }}" data-photos="{{ $photosJson }}">
                                        <td>
                                            <div class="admin-user-cell">
                                                <div class="admin-avatar-mini" style="background: {{ $comment->avatar_bg }}; color: #ffffff;">{{ $comment->avatar_text }}</div>
                                                <div>
                                                    <div class="admin-cell-title">{{ $comment->author_name }}</div>
                                                    <div class="admin-cell-sub">
                                                        <span style="color: #f5b842;">★ {{ number_format($comment->rating, 1) }}</span> • {{ $comment->author_role }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <span class="admin-role-tag role-dest" style="{{ $tagStyle }}">{{ $destName }}</span>
                                                <div class="admin-cell-sub" style="margin-top: 2px;">{{ $comment->destination?->category ?? 'Bali, Indonesia' }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="admin-comment-snippet" style="max-width: 320px; font-size: 12.5px; color: rgba(255,255,255,0.85); line-height: 1.4;">
                                                "{{ \Illuminate\Support\Str::limit($comment->comment, 90) }}"
                                                @if(!empty($comment->photos) && count($comment->photos) > 0)
                                                    <span style="display:inline-flex; align-items:center; gap:3px; margin-left:4px; font-size:11px; padding:1px 6px; border-radius:4px; background:rgba(94,234,212,0.15); color:#5eead4;">
                                                        <svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                                        {{ count($comment->photos) }} Foto
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td><span class="admin-location-cell">{{ $comment->formatted_date }}</span></td>
                                        <td style="text-align: right;">
                                            <div class="admin-row-actions">
                                                <button type="button" class="btn-action-view" onclick="openReviewDetailModal(this)">Detail</button>
                                                <button type="button" class="btn-action-reject" onclick="deleteCommentRow(this, event)">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 35px 20px; color: rgba(255,255,255,0.5); font-size: 13.5px;">
                                            Belum ada komentar wisatawan di database.
                                        </td>
                                    </tr>
                                @endforelse
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
    <!-- ============================================== -->
    <!-- MODAL TAMBAH DESTINASI BARU (ADMIN)           -->
    <!-- ============================================== -->
    <div class="admin-modal-backdrop" id="admin-create-dest-modal" role="dialog" aria-modal="true" aria-labelledby="modal-dest-title">
        <div class="admin-modal-card admin-modal-card-lg">
            <div class="admin-modal-header">
                <div>
                    <span class="admin-modal-badge">Kelola Konten Dewasufa</span>
                    <h3 id="modal-dest-title" class="admin-modal-title">Tambah Destinasi Wisata Baru</h3>
                    <p class="admin-modal-subtitle">Upload foto dari komputer, tentukan waktu operasional, dan lengkapi detail destinasi sesuai tampilan pengunjung.</p>
                </div>
                <button type="button" class="admin-modal-close" onclick="closeAdminCreateModal()" aria-label="Tutup Modal">&times;</button>
            </div>

            <form id="admin-add-dest-form" onsubmit="handleAdminAddDest(event)">

                <!-- 1. Galeri Foto & Visual Destinasi (Upload dari Komputer) -->
                <div class="admin-form-section-title">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span>1. Foto &amp; Galeri Visual (Upload dari Komputer)</span>
                </div>

                <!-- Live Preview of User Destination Photo Layout (1 Tall + 1 Wide + 2 Small) -->
                <div class="admin-preview-grid-wrap" title="Pratinjau galeri foto destinasi (sesuai tata letak detail destinasi pengguna)">
                    <div class="admin-preview-tall">
                        <img id="create-preview-img-main" src="/images/waterfall.jpg" alt="Foto Utama">
                        <span class="admin-preview-tag">Cover Utama</span>
                    </div>
                    <div class="admin-preview-stack">
                        <div class="admin-preview-wide">
                            <img id="create-preview-img-thumb1" src="/images/waterfall.jpg" alt="Foto 2">
                            <span class="admin-preview-tag">Foto 2 (Wide)</span>
                        </div>
                        <div class="admin-preview-row-sm">
                            <div class="admin-preview-sm">
                                <img id="create-preview-img-thumb2" src="/images/waterfall.jpg" alt="Foto 3">
                                <span class="admin-preview-tag">Foto 3</span>
                            </div>
                            <div class="admin-preview-sm">
                                <img id="create-preview-img-thumb3" src="/images/waterfall.jpg" alt="Foto 4">
                                <span class="admin-preview-tag">Foto 4</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload Foto Utama dari Komputer -->
                <div class="admin-file-upload-card" onclick="document.getElementById('dest-file-main').click()" role="button" tabindex="0">
                    <input type="file" id="dest-file-main" accept="image/*" onchange="handleAdminPhotoFile(event, 'main')" style="display:none;">
                    <div class="admin-file-upload-inner">
                        <div class="admin-file-upload-icon">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                        </div>
                        <div>
                            <span class="admin-file-upload-btn-text">Upload Foto Utama / Cover dari Komputer</span>
                            <p class="admin-file-upload-subtext" id="dest-file-main-name">Klik di sini untuk memilih file gambar dari file komputer (JPG, PNG, WEBP)</p>
                        </div>
                    </div>
                </div>

                <!-- Upload 3 Foto Tambahan dari Komputer -->
                <div class="admin-form-row-3">
                    <div class="admin-file-mini-upload" onclick="document.getElementById('dest-file-thumb1').click()" role="button" tabindex="0">
                        <input type="file" id="dest-file-thumb1" accept="image/*" onchange="handleAdminPhotoFile(event, 'thumb1')" style="display:none;">
                        <span class="admin-file-mini-title">Foto Galeri 2 (Wide)</span>
                        <span class="admin-file-mini-name" id="dest-file-thumb1-name">+ Upload dari File</span>
                    </div>
                    <div class="admin-file-mini-upload" onclick="document.getElementById('dest-file-thumb2').click()" role="button" tabindex="0">
                        <input type="file" id="dest-file-thumb2" accept="image/*" onchange="handleAdminPhotoFile(event, 'thumb2')" style="display:none;">
                        <span class="admin-file-mini-title">Foto Galeri 3</span>
                        <span class="admin-file-mini-name" id="dest-file-thumb2-name">+ Upload dari File</span>
                    </div>
                    <div class="admin-file-mini-upload" onclick="document.getElementById('dest-file-thumb3').click()" role="button" tabindex="0">
                        <input type="file" id="dest-file-thumb3" accept="image/*" onchange="handleAdminPhotoFile(event, 'thumb3')" style="display:none;">
                        <span class="admin-file-mini-title">Foto Galeri 4</span>
                        <span class="admin-file-mini-name" id="dest-file-thumb3-name">+ Upload dari File</span>
                    </div>
                </div>
                <span class="admin-input-hint" style="display:block; margin-top: 6px;">Jika foto tambahan tidak diunggah, sistem otomatis menyalin foto utama untuk mengisi galeri.</span>

                <!-- 2. Identitas Destinasi -->
                <div class="admin-form-section-title">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span>2. Identitas &amp; Klasifikasi Destinasi</span>
                </div>

                <div class="admin-form-row-2">
                    <div class="admin-form-group">
                        <label for="dest-input-name" class="admin-form-label">Nama Destinasi Wisata</label>
                        <input type="text" id="dest-input-name" class="admin-form-input" placeholder="Contoh: Air Terjun Tegenungan" required>
                    </div>
                    <div class="admin-form-group">
                        <label for="dest-input-category" class="admin-form-label">Kategori Wisata</label>
                        <select id="dest-input-category" class="admin-form-select" required>
                            <option value="Waterfall">Waterfall (Air Terjun)</option>
                            <option value="Sunset Beach">Sunset Beach (Pantai Senja)</option>
                            <option value="Sunrise Beach">Sunrise Beach (Pantai Fajar)</option>
                            <option value="Mountain">Mountain (Pegunungan)</option>
                        </select>
                    </div>
                </div>

                <div class="admin-form-row-2">
                    <div class="admin-form-group">
                        <label for="dest-input-location" class="admin-form-label">Lokasi / Alamat Lengkap di Bali</label>
                        <input type="text" id="dest-input-location" class="admin-form-input" placeholder="Contoh: Kemenuh, Sukawati, Gianyar" required>
                    </div>
                    <div class="admin-form-group">
                        <label for="dest-input-ticket" class="admin-form-label">Harga Tiket Masuk</label>
                        <input type="text" id="dest-input-ticket" class="admin-form-input" value="Rp 25.000 / orang" placeholder="Contoh: Rp 25.000 / orang" required>
                    </div>
                </div>

                <div class="admin-form-group">
                    <label for="dest-input-tags" class="admin-form-label">Tag / Sorotan Fitur Destinasi</label>
                    <input type="text" id="dest-input-tags" class="admin-form-input" placeholder="Contoh: Air Terjun, Akses Mudah, Spot Foto, Dekat Ubud">
                    <span class="admin-input-hint">Pisahkan tag dengan tanda koma (,). Tag akan tampil sebagai badge fitur di halaman pengunjung.</span>
                </div>

                <!-- 3. Informasi Waktu & Fasilitas (Input Jam, Menit, & Zona Waktu) -->
                <div class="admin-form-section-title">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span>3. Waktu Operasional &amp; Kunjungan Terbaik</span>
                </div>

                <!-- Jam Buka / Operasional (Jam, Menit, Zona Waktu) -->
                <div class="admin-form-group">
                    <label class="admin-form-label">Jam Buka / Operasional (Pilih Jam, Menit, &amp; Zona Waktu)</label>
                    <div class="admin-time-picker-group">
                        <div class="admin-time-range-row">
                            <div class="admin-time-block">
                                <span class="admin-time-tag-lbl">Buka:</span>
                                <select id="dest-time-open-h" class="admin-time-select" onchange="updateTimePreviews()">
                                    <option value="05">05</option>
                                    <option value="06" selected>06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                </select>
                                <span class="admin-time-separator">:</span>
                                <select id="dest-time-open-m" class="admin-time-select" onchange="updateTimePreviews()">
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30" selected>30</option>
                                    <option value="45">45</option>
                                </select>
                            </div>

                            <span class="admin-time-divider">s/d</span>

                            <div class="admin-time-block">
                                <span class="admin-time-tag-lbl">Tutup:</span>
                                <select id="dest-time-close-h" class="admin-time-select" onchange="updateTimePreviews()">
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18" selected>18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                </select>
                                <span class="admin-time-separator">:</span>
                                <select id="dest-time-close-m" class="admin-time-select" onchange="updateTimePreviews()">
                                    <option value="00" selected>00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                <select id="dest-time-tz" class="admin-time-select" onchange="updateTimePreviews()">
                                    <option value="WITA" selected>WITA</option>
                                    <option value="WIB">WIB</option>
                                    <option value="WIT">WIT</option>
                                </select>
                            </div>
                        </div>

                        <span class="admin-time-preview-badge" id="preview-time-badge">06:30 – 18:00 WITA</span>
                    </div>
                </div>

                <!-- Waktu Terbaik Berkunjung (Jam, Menit, Zona Waktu, Suasana) -->
                <div class="admin-form-group">
                    <label class="admin-form-label">Waktu Terbaik Berkunjung (Pilih Jam, Menit, Zona Waktu, &amp; Kondisi)</label>
                    <div class="admin-time-picker-group">
                        <div class="admin-time-range-row">
                            <div class="admin-time-block">
                                <span class="admin-time-tag-lbl">Mulai:</span>
                                <select id="dest-best-start-h" class="admin-time-select" onchange="updateTimePreviews()">
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07" selected>07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                </select>
                                <span class="admin-time-separator">:</span>
                                <select id="dest-best-start-m" class="admin-time-select" onchange="updateTimePreviews()">
                                    <option value="00" selected>00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                            </div>

                            <span class="admin-time-divider">s/d</span>

                            <div class="admin-time-block">
                                <span class="admin-time-tag-lbl">Selesai:</span>
                                <select id="dest-best-end-h" class="admin-time-select" onchange="updateTimePreviews()">
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09" selected>09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                </select>
                                <span class="admin-time-separator">:</span>
                                <select id="dest-best-end-m" class="admin-time-select" onchange="updateTimePreviews()">
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30" selected>30</option>
                                    <option value="45">45</option>
                                </select>
                                <select id="dest-best-tz" class="admin-time-select" onchange="updateTimePreviews()">
                                    <option value="WITA" selected>WITA</option>
                                    <option value="WIB">WIB</option>
                                    <option value="WIT">WIT</option>
                                </select>
                            </div>
                        </div>

                        <select id="dest-best-condition" class="admin-time-select admin-time-condition-select" onchange="updateTimePreviews()">
                            <option value="(Suasana tenang dan udara sejuk)" selected>Suasana tenang &amp; sejuk</option>
                            <option value="(Matahari terbit yang cerah)">Sunrise yang cerah</option>
                            <option value="(Matahari terbenam keemasan)">Sunset keemasan</option>
                            <option value="(Pencahayaan foto optimal)">Pencahayaan foto optimal</option>
                            <option value="(Debit air optimal dan jernih)">Debit air optimal &amp; jernih</option>
                            <option value="">Tanpa catatan suasana</option>
                        </select>

                        <span class="admin-time-preview-badge" id="preview-best-badge">07:00 – 09:30 WITA (Suasana tenang dan udara sejuk)</span>
                    </div>
                </div>

                <!-- 4. Deskripsi & Peta Google Maps -->
                <div class="admin-form-section-title">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span>4. Tentang Destinasi &amp; Tautan Peta</span>
                </div>

                <div class="admin-form-group">
                    <label for="dest-input-desc" class="admin-form-label">Tentang Destinasi (Deskripsi Lengkap)</label>
                    <textarea id="dest-input-desc" class="admin-form-textarea" rows="3" placeholder="Tuliskan deskripsi lengkap, daya tarik utama, akses jalan, dan fasilitas bagi wisatawan..." required></textarea>
                </div>

                <div class="admin-form-group">
                    <label for="dest-input-gmaps" class="admin-form-label">Tautan Google Maps</label>
                    <input type="text" id="dest-input-gmaps" class="admin-form-input" placeholder="Contoh: https://maps.google.com/?q=Air+Terjun+Tegenungan+Bali">
                    <span class="admin-input-hint">Jika dikosongkan, tautan otomatis dicari berdasarkan nama destinasi di Google Maps.</span>
                </div>

                <!-- 5. Status Destinasi (Paling Bawah - Tanpa Dots) -->
                <div class="admin-form-group" style="margin-top: 20px; padding-top: 16px; border-top: 1px solid rgba(255, 255, 255, 0.08);">
                    <label for="dest-input-status" class="admin-form-label">Status Destinasi</label>
                    <select id="dest-input-status" class="admin-form-select" required>
                        <option value="post">Post (Semua Bisa Melihat / Terbit)</option>
                        <option value="pending">Pending (Hanya Admin yang Bisa Melihat)</option>
                    </select>
                    <span class="admin-input-hint">Post: Semua pengunjung dapat melihat destinasi ini. Pending: Hanya admin yang dapat melihat di portal admin.</span>
                </div>

                <div class="admin-modal-actions">
                    <button type="button" class="btn-admin-cancel" onclick="closeAdminCreateModal()">Batal</button>
                    <button type="submit" class="btn-admin-submit-save">+ Simpan &amp; Publikasikan Destinasi</button>
                </div>
            </form>
        </div>
    </div>


    <!-- ===== MODAL DETAIL DESTINASI (SESUAI PORTAL PENGGUNA) ===== -->
    <div class="dash-modal-backdrop" id="dest-detail-modal" role="dialog" aria-modal="true" aria-labelledby="dest-detail-title">
        <div class="dash-modal-card dash-dest-detail-card">
            <!-- Modal Close Button -->
            <button type="button" class="dash-dest-close-btn" onclick="closeAdminSpotDetail()" id="btn-close-dest-detail" aria-label="Tutup Detail Destinasi">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <!-- Two Column Main Layout -->
            <div class="dash-dest-main-layout">
                <!-- Left Column (Layout & Photos matching user portal) -->
                <div class="dash-dest-left-col">
                    <!-- Photo Grid: 1 Tall Main Image (Left) + 1 Wide Top Right + 2 Small Bottom Right -->
                    <div class="dash-dest-photo-grid">
                        <div class="dash-dest-photo-tall">
                            <img id="dest-detail-img" src="/images/waterfall.jpg" alt="Destinasi Utama" class="dash-dest-img-main">
                        </div>
                        <div class="dash-dest-photo-stack">
                            <div class="dash-dest-photo-wide">
                                <img id="dest-detail-img-thumb-1" src="/images/waterfall.jpg" alt="Foto Destinasi 2" class="dash-dest-img-thumb">
                            </div>
                            <div class="dash-dest-photo-row">
                                <div class="dash-dest-photo-small">
                                    <img id="dest-detail-img-thumb-2" src="/images/waterfall.jpg" alt="Foto Destinasi 3" class="dash-dest-img-thumb">
                                </div>
                                <div class="dash-dest-photo-small">
                                    <img id="dest-detail-img-thumb-3" src="/images/waterfall.jpg" alt="Foto Destinasi 4" class="dash-dest-img-thumb">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Destination Header: Title & Badges -->
                    <div class="dash-dest-header-info">
                        <div class="dash-dest-title-row">
                            <h2 class="dash-dest-detail-title" id="dest-detail-title">Air Terjun Sekumpul</h2>
                            <span id="dest-detail-status-pill" style="display:inline-block;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700;border:1px solid rgba(255,255,255,0.12);">● Terbit Aktif</span>
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
                                    <span class="dash-dest-feat-val"><strong id="dest-detail-score">0.0</strong> / 5.0</span>
                                    <span id="dest-detail-reviews-count" style="font-size: 11px; color: #94a3b8; display: block; margin-top: 1px;">(0 Ulasan)</span>
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

                        <!-- Waktu Terbaik Banner -->
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

                <!-- Right Column (Comments & Reviews Section) -->
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

                        <!-- Comments Counter & List -->
                        <div class="dash-dest-comments-divider">
                            <span class="dash-dest-comment-badge" id="dest-comments-counter">0 Komentar</span>
                            <span id="dest-detail-rating-summary" class="dash-dest-rating-summary">★ 0.0 (0 Ulasan)</span>
                        </div>

                        <!-- Rating Star Filter Bar -->
                        <div class="dash-rating-filter-bar" id="admin-dest-rating-filter-bar" role="group" aria-label="Filter ulasan berdasarkan rating bintang">
                            <button type="button" class="dash-rating-chip active" data-star="all" onclick="filterAdminCommentsByStar('all', this)">
                                <span>Semua</span>
                                <span class="chip-count" id="admin-chip-cnt-all">(0)</span>
                            </button>
                            <button type="button" class="dash-rating-chip" data-star="5" onclick="filterAdminCommentsByStar(5, this)">
                                <span class="chip-star-icon">★</span> 5
                                <span class="chip-count" id="admin-chip-cnt-5">(0)</span>
                            </button>
                            <button type="button" class="dash-rating-chip" data-star="4" onclick="filterAdminCommentsByStar(4, this)">
                                <span class="chip-star-icon">★</span> 4
                                <span class="chip-count" id="admin-chip-cnt-4">(0)</span>
                            </button>
                            <button type="button" class="dash-rating-chip" data-star="3" onclick="filterAdminCommentsByStar(3, this)">
                                <span class="chip-star-icon">★</span> 3
                                <span class="chip-count" id="admin-chip-cnt-3">(0)</span>
                            </button>
                            <button type="button" class="dash-rating-chip" data-star="2" onclick="filterAdminCommentsByStar(2, this)">
                                <span class="chip-star-icon">★</span> 2
                                <span class="chip-count" id="admin-chip-cnt-2">(0)</span>
                            </button>
                            <button type="button" class="dash-rating-chip" data-star="1" onclick="filterAdminCommentsByStar(1, this)">
                                <span class="chip-star-icon">★</span> 1
                                <span class="chip-count" id="admin-chip-cnt-1">(0)</span>
                            </button>
                        </div>

                        <div class="dash-comments-list dash-comments-list-compact" id="dest-comments-list">
                            <!-- Injected dynamically via JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MODAL EDIT DESTINASI (SESUAI DENGAN TAMBAH BARU & DETAIL DESTINASI) ===== -->
    <div class="admin-modal-backdrop" id="admin-edit-dest-modal" role="dialog" aria-modal="true" aria-labelledby="edit-dest-modal-title">
        <div class="admin-modal-card admin-modal-card-lg">
            <div class="admin-modal-header">
                <div>
                    <span class="admin-modal-badge">Kelola Konten Dewasufa</span>
                    <h3 id="edit-dest-modal-title" class="admin-modal-title">Edit Destinasi Wisata</h3>
                    <p class="admin-modal-subtitle">Upload foto dari komputer, perbarui waktu operasional, dan sesuaikan detail destinasi sesuai tampilan pengunjung.</p>
                </div>
                <button type="button" class="admin-modal-close" onclick="closeEditDestModal()" aria-label="Tutup Modal">&times;</button>
            </div>

            <form id="admin-edit-dest-form" onsubmit="handleEditDestSubmit(event)">

                <!-- 1. Galeri Foto & Visual Destinasi (Upload dari Komputer) -->
                <div class="admin-form-section-title">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span>1. Foto &amp; Galeri Visual (Upload dari Komputer)</span>
                </div>

                <!-- Live Preview of User Destination Photo Layout (1 Tall + 1 Wide + 2 Small) -->
                <div class="admin-preview-grid-wrap" title="Pratinjau galeri foto destinasi (sesuai tata letak detail destinasi pengguna)">
                    <div class="admin-preview-tall">
                        <img id="edit-preview-img-main" src="/images/waterfall.jpg" alt="Foto Utama">
                        <span class="admin-preview-tag">Cover Utama</span>
                    </div>
                    <div class="admin-preview-stack">
                        <div class="admin-preview-wide">
                            <img id="edit-preview-img-thumb1" src="/images/waterfall.jpg" alt="Foto 2">
                            <span class="admin-preview-tag">Foto 2 (Wide)</span>
                        </div>
                        <div class="admin-preview-row-sm">
                            <div class="admin-preview-sm">
                                <img id="edit-preview-img-thumb2" src="/images/waterfall.jpg" alt="Foto 3">
                                <span class="admin-preview-tag">Foto 3</span>
                            </div>
                            <div class="admin-preview-sm">
                                <img id="edit-preview-img-thumb3" src="/images/waterfall.jpg" alt="Foto 4">
                                <span class="admin-preview-tag">Foto 4</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload Foto Utama dari Komputer -->
                <div class="admin-file-upload-card" onclick="document.getElementById('edit-dest-file-main').click()" role="button" tabindex="0">
                    <input type="file" id="edit-dest-file-main" accept="image/*" onchange="handleEditPhotoFile(event, 'main')" style="display:none;">
                    <div class="admin-file-upload-inner">
                        <div class="admin-file-upload-icon">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                        </div>
                        <div>
                            <span class="admin-file-upload-btn-text">Ganti Foto Utama / Cover dari Komputer</span>
                            <p class="admin-file-upload-subtext" id="edit-dest-file-main-name">Klik di sini untuk memilih file gambar dari file komputer (JPG, PNG, WEBP)</p>
                        </div>
                    </div>
                </div>

                <!-- Upload 3 Foto Tambahan dari Komputer -->
                <div class="admin-form-row-3">
                    <div class="admin-file-mini-upload" onclick="document.getElementById('edit-dest-file-thumb1').click()" role="button" tabindex="0">
                        <input type="file" id="edit-dest-file-thumb1" accept="image/*" onchange="handleEditPhotoFile(event, 'thumb1')" style="display:none;">
                        <span class="admin-file-mini-title">Foto Galeri 2 (Wide)</span>
                        <span class="admin-file-mini-name" id="edit-dest-file-thumb1-name">+ Upload dari File</span>
                    </div>
                    <div class="admin-file-mini-upload" onclick="document.getElementById('edit-dest-file-thumb2').click()" role="button" tabindex="0">
                        <input type="file" id="edit-dest-file-thumb2" accept="image/*" onchange="handleEditPhotoFile(event, 'thumb2')" style="display:none;">
                        <span class="admin-file-mini-title">Foto Galeri 3</span>
                        <span class="admin-file-mini-name" id="edit-dest-file-thumb2-name">+ Upload dari File</span>
                    </div>
                    <div class="admin-file-mini-upload" onclick="document.getElementById('edit-dest-file-thumb3').click()" role="button" tabindex="0">
                        <input type="file" id="edit-dest-file-thumb3" accept="image/*" onchange="handleEditPhotoFile(event, 'thumb3')" style="display:none;">
                        <span class="admin-file-mini-title">Foto Galeri 4</span>
                        <span class="admin-file-mini-name" id="edit-dest-file-thumb3-name">+ Upload dari File</span>
                    </div>
                </div>
                <span class="admin-input-hint" style="display:block; margin-top: 6px;">Pilih file gambar baru untuk memperbarui galeri visual destinasi ini.</span>

                <!-- 2. Identitas Destinasi -->
                <div class="admin-form-section-title">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span>2. Identitas &amp; Klasifikasi Destinasi</span>
                </div>

                <div class="admin-form-row-2">
                    <div class="admin-form-group">
                        <label for="edit-dest-title" class="admin-form-label">Nama Destinasi Wisata</label>
                        <input type="text" id="edit-dest-title" class="admin-form-input" placeholder="Contoh: Air Terjun Tegenungan" required>
                    </div>
                    <div class="admin-form-group">
                        <label for="edit-dest-category" class="admin-form-label">Kategori Wisata</label>
                        <select id="edit-dest-category" class="admin-form-select" required>
                            <option value="Waterfall">Waterfall (Air Terjun)</option>
                            <option value="Sunset Beach">Sunset Beach (Pantai Senja)</option>
                            <option value="Sunrise Beach">Sunrise Beach (Pantai Fajar)</option>
                            <option value="Mountain">Mountain (Pegunungan)</option>
                        </select>
                    </div>
                </div>

                <div class="admin-form-row-2">
                    <div class="admin-form-group">
                        <label for="edit-dest-loc" class="admin-form-label">Lokasi / Alamat Lengkap di Bali</label>
                        <input type="text" id="edit-dest-loc" class="admin-form-input" placeholder="Contoh: Kemenuh, Sukawati, Gianyar" required>
                    </div>
                    <div class="admin-form-group">
                        <label for="edit-dest-ticket" class="admin-form-label">Harga Tiket Masuk</label>
                        <input type="text" id="edit-dest-ticket" class="admin-form-input" placeholder="Contoh: Rp 25.000 / orang" required>
                    </div>
                </div>

                <div class="admin-form-group">
                    <label for="edit-dest-tags" class="admin-form-label">Tag / Sorotan Fitur Destinasi</label>
                    <input type="text" id="edit-dest-tags" class="admin-form-input" placeholder="Contoh: Air Terjun, Akses Mudah, Spot Foto, Dekat Ubud">
                    <span class="admin-input-hint">Pisahkan tag dengan tanda koma (,). Tag akan tampil sebagai badge fitur di halaman pengunjung.</span>
                </div>

                <!-- 3. Informasi Waktu & Fasilitas (Input Jam, Menit, & Zona Waktu) -->
                <div class="admin-form-section-title">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span>3. Waktu Operasional &amp; Kunjungan Terbaik</span>
                </div>

                <!-- Jam Buka / Operasional (Jam, Menit, Zona Waktu) -->
                <div class="admin-form-group">
                    <label class="admin-form-label">Jam Buka / Operasional (Pilih Jam, Menit, &amp; Zona Waktu)</label>
                    <div class="admin-time-picker-group">
                        <div class="admin-time-range-row">
                            <div class="admin-time-block">
                                <span class="admin-time-tag-lbl">Buka:</span>
                                <select id="edit-dest-time-open-h" class="admin-time-select" onchange="updateEditTimePreviews()">
                                    <option value="05">05</option>
                                    <option value="06" selected>06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                </select>
                                <span class="admin-time-separator">:</span>
                                <select id="edit-dest-time-open-m" class="admin-time-select" onchange="updateEditTimePreviews()">
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30" selected>30</option>
                                    <option value="45">45</option>
                                </select>
                            </div>

                            <span class="admin-time-divider">s/d</span>

                            <div class="admin-time-block">
                                <span class="admin-time-tag-lbl">Tutup:</span>
                                <select id="edit-dest-time-close-h" class="admin-time-select" onchange="updateEditTimePreviews()">
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18" selected>18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                </select>
                                <span class="admin-time-separator">:</span>
                                <select id="edit-dest-time-close-m" class="admin-time-select" onchange="updateEditTimePreviews()">
                                    <option value="00" selected>00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                <select id="edit-dest-time-tz" class="admin-time-select" onchange="updateEditTimePreviews()">
                                    <option value="WITA" selected>WITA</option>
                                    <option value="WIB">WIB</option>
                                    <option value="WIT">WIT</option>
                                </select>
                            </div>
                        </div>

                        <span class="admin-time-preview-badge" id="edit-preview-time-badge">06:30 – 18:00 WITA</span>
                    </div>
                </div>

                <!-- Waktu Terbaik Berkunjung (Jam, Menit, Zona Waktu, Suasana) -->
                <div class="admin-form-group">
                    <label class="admin-form-label">Waktu Terbaik Berkunjung (Pilih Jam, Menit, Zona Waktu, &amp; Kondisi)</label>
                    <div class="admin-time-picker-group">
                        <div class="admin-time-range-row">
                            <div class="admin-time-block">
                                <span class="admin-time-tag-lbl">Mulai:</span>
                                <select id="edit-dest-best-start-h" class="admin-time-select" onchange="updateEditTimePreviews()">
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07" selected>07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                </select>
                                <span class="admin-time-separator">:</span>
                                <select id="edit-dest-best-start-m" class="admin-time-select" onchange="updateEditTimePreviews()">
                                    <option value="00" selected>00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                            </div>

                            <span class="admin-time-divider">s/d</span>

                            <div class="admin-time-block">
                                <span class="admin-time-tag-lbl">Selesai:</span>
                                <select id="edit-dest-best-end-h" class="admin-time-select" onchange="updateEditTimePreviews()">
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09" selected>09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                </select>
                                <span class="admin-time-separator">:</span>
                                <select id="edit-dest-best-end-m" class="admin-time-select" onchange="updateEditTimePreviews()">
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30" selected>30</option>
                                    <option value="45">45</option>
                                </select>
                                <select id="edit-dest-best-tz" class="admin-time-select" onchange="updateEditTimePreviews()">
                                    <option value="WITA" selected>WITA</option>
                                    <option value="WIB">WIB</option>
                                    <option value="WIT">WIT</option>
                                </select>
                            </div>
                        </div>

                        <select id="edit-dest-best-condition" class="admin-time-select admin-time-condition-select" onchange="updateEditTimePreviews()">
                            <option value="(Suasana tenang dan udara sejuk)" selected>Suasana tenang &amp; sejuk</option>
                            <option value="(Matahari terbit yang cerah)">Sunrise yang cerah</option>
                            <option value="(Matahari terbenam keemasan)">Sunset keemasan</option>
                            <option value="(Pencahayaan foto optimal)">Pencahayaan foto optimal</option>
                            <option value="(Debit air optimal dan jernih)">Debit air optimal &amp; jernih</option>
                            <option value="">Tanpa catatan suasana</option>
                        </select>

                        <span class="admin-time-preview-badge" id="edit-preview-best-badge">07:00 – 09:30 WITA (Suasana tenang dan udara sejuk)</span>
                    </div>
                </div>

                <!-- 4. Deskripsi & Peta Google Maps -->
                <div class="admin-form-section-title">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span>4. Tentang Destinasi &amp; Tautan Peta</span>
                </div>

                <div class="admin-form-group">
                    <label for="edit-dest-desc" class="admin-form-label">Tentang Destinasi (Deskripsi Lengkap)</label>
                    <textarea id="edit-dest-desc" class="admin-form-textarea" rows="3" placeholder="Tuliskan deskripsi lengkap, daya tarik utama, akses jalan, dan fasilitas bagi wisatawan..." required></textarea>
                </div>

                <div class="admin-form-group">
                    <label for="edit-dest-gmaps" class="admin-form-label">Tautan Google Maps</label>
                    <input type="text" id="edit-dest-gmaps" class="admin-form-input" placeholder="Contoh: https://maps.google.com/?q=Air+Terjun+Tegenungan+Bali">
                    <span class="admin-input-hint">Jika dikosongkan, tautan otomatis dicari berdasarkan nama destinasi di Google Maps.</span>
                </div>

                <!-- 5. Status Destinasi (Paling Bawah - Tanpa Dots) -->
                <div class="admin-form-group" style="margin-top: 20px; padding-top: 16px; border-top: 1px solid rgba(255, 255, 255, 0.08);">
                    <label for="edit-dest-status" class="admin-form-label">Status Destinasi</label>
                    <select id="edit-dest-status" class="admin-form-select" required>
                        <option value="post">Post (Semua Bisa Melihat / Terbit)</option>
                        <option value="pending">Pending (Hanya Admin yang Bisa Melihat)</option>
                    </select>
                    <span class="admin-input-hint">Post: Semua pengunjung dapat melihat destinasi ini. Pending: Hanya admin yang dapat melihat di portal admin.</span>
                </div>

                <div class="admin-modal-actions">
                    <button type="button" class="btn-admin-cancel" onclick="closeEditDestModal()">Batal</button>
                    <button type="submit" class="btn-admin-submit-save">Simpan Perubahan Destinasi</button>
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
                    <div id="review-detail-photos" style="display:none;gap:10px;margin-top:14px;flex-wrap:wrap;"></div>
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

    <!-- ===== MODAL PENGATURAN (SETTINGS) PROFIL ADMIN ===== -->
    <div class="dash-modal-backdrop admin-modal-backdrop" id="admin-settings-modal" role="dialog" aria-modal="true" aria-labelledby="admin-settings-modal-title">
        <div class="dash-modal-card dash-settings-card">
            <div class="dash-modal-header">
                <div class="dash-modal-title-wrap">
                    <span class="dash-modal-badge">Pengaturan Akun</span>
                    <h3 id="admin-settings-modal-title" class="dash-modal-title">Pengaturan &amp; Preferensi</h3>
                    <p class="dash-modal-subtitle">Kelola informasi profil, preferensi sistem administrator, dan sesi akun Anda.</p>
                </div>
                <button type="button" class="dash-modal-close" onclick="closeAdminSettingsModal()" aria-label="Tutup Pengaturan">&times;</button>
            </div>

            <!-- Form Edit Profil Admin -->
            <form id="admin-settings-form" onsubmit="saveAdminSettings(event)">
                <div class="dash-settings-section">
                    <h4 class="dash-settings-sec-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>Informasi Profil</span>
                    </h4>

                    <!-- Upload Foto Profil Admin -->
                    <div class="dash-settings-avatar-wrap">
                        <div class="dash-avatar-preview-box" id="admin-avatar-preview-box">
                            <img id="admin-settings-avatar-preview" src="" alt="Avatar Admin" style="display: none;" class="dash-avatar-preview-img">
                            <span id="admin-settings-avatar-fallback" class="dash-avatar-preview-fallback">ER</span>
                        </div>
                        <div class="dash-avatar-upload-actions">
                            <label for="admin-settings-avatar-input" class="dash-btn-upload-avatar">
                                <span>Pilih Foto Profil</span>
                            </label>
                            <input type="file" id="admin-settings-avatar-input" accept="image/*" style="display: none;">
                            <div class="dash-avatar-btns">
                                <button type="button" class="dash-btn-remove-avatar" id="btn-admin-remove-avatar" style="display: none;" onclick="removeAdminAvatar()">Hapus Foto</button>
                            </div>
                            <span class="dash-avatar-hint">Format JPG, PNG, WEBP. Maksimal 2MB.</span>
                        </div>
                    </div>

                    <div class="dash-form-grid">
                        <div class="dash-form-group">
                            <label for="admin-settings-name">Nama Lengkap</label>
                            <input type="text" id="admin-settings-name" placeholder="Nama Anda" value="Erick">
                        </div>
                        <div class="dash-form-group">
                            <label for="admin-settings-email">
                                <span>Email Terdaftar</span>
                                <span class="dash-comment-author-lock-tag" title="Email akun admin terkunci dan tidak dapat diubah">
                                    <svg viewBox="0 0 24 24" width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    Terkunci
                                </span>
                            </label>
                            <input type="email" id="admin-settings-email" class="dash-input-readonly" value="admin@dewasufa.com" readonly aria-readonly="true" tabindex="-1" title="Email akun aktif terkunci dan tidak dapat diubah">
                        </div>
                    </div>

                    <div class="dash-form-grid">
                        <div class="dash-form-group">
                            <label for="admin-settings-role">Status Akun</label>
                            <input type="text" id="admin-settings-role" value="Admin" readonly class="dash-input-readonly" title="Status akun Administrator dikelola oleh sistem Dewasufa">
                        </div>
                        <div class="dash-form-group">
                            <label for="admin-settings-phone">
                                <span>Nomor Telepon</span>
                                <span class="dash-comment-author-lock-tag" title="Nomor telepon akun admin terkunci dan tidak dapat diubah">
                                    <svg viewBox="0 0 24 24" width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    Terkunci
                                </span>
                            </label>
                            <input type="tel" id="admin-settings-phone" class="dash-input-readonly" value="+62 811-2345-6789" readonly aria-readonly="true" tabindex="-1" title="Nomor telepon akun aktif terkunci dan tidak dapat diubah">
                        </div>
                    </div>

                    <div class="dash-form-grid">
                        <div class="dash-form-group">
                            <label for="admin-settings-reset-password">Reset Password</label>
                            <input type="password" id="admin-settings-reset-password" name="reset_password" placeholder="Masukkan password baru" autocomplete="new-password">
                        </div>
                        <div class="dash-form-group">
                            <label for="admin-settings-confirm-password">Konfirmasi Password</label>
                            <input type="password" id="admin-settings-confirm-password" name="confirm_password" placeholder="Ulangi password baru" autocomplete="new-password">
                        </div>
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
                    <h4 class="dash-danger-title">Sesi Akun &amp; Logout</h4>
                    <p class="dash-danger-desc">
                        Ingin mengakhiri sesi administrator Anda di Dewasufa? Anda dapat masuk kembali kapan saja.
                    </p>
                </div>
                <a href="{{ route('home') }}" class="dash-btn-logout-inside" id="admin-btn-logout-inside" style="text-decoration: none;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Logout Admin</span>
                </a>
            </div>
        </div>
    </div>

    <!-- ===== MODAL KONFIRMASI HAPUS (DESTINASI / KOMENTAR) ===== -->
    <div class="admin-modal-backdrop" id="admin-delete-confirm-modal" role="dialog" aria-modal="true" aria-labelledby="admin-confirm-title">
        <div class="admin-modal-card admin-confirm-modal-card">
            <div class="admin-confirm-header">
                <div class="admin-confirm-icon-wrap" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                        <span class="admin-modal-badge" id="admin-confirm-badge" style="color: #f87171;">Konfirmasi Penghapusan</span>
                        <button type="button" class="admin-modal-close" onclick="closeAdminDeleteConfirmModal()" aria-label="Tutup">&times;</button>
                    </div>
                    <h3 id="admin-confirm-title" class="admin-modal-title" style="margin-top: 4px; font-size: 18.5px;">Hapus Data Ini?</h3>
                </div>
            </div>

            <p id="admin-confirm-desc" class="admin-confirm-desc">
                Apakah Anda yakin ingin menghapus data ini?
            </p>

            <!-- Container for dynamic preview card -->
            <div id="admin-confirm-preview-box" class="admin-confirm-preview-box">
                <!-- Injected via JavaScript -->
            </div>

            <div class="admin-confirm-warning-note">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>Tindakan ini tidak dapat dibatalkan. Data akan dihapus secara permanen.</span>
            </div>

            <div class="admin-confirm-actions">
                <button type="button" class="btn-admin-cancel" id="btn-cancel-delete" onclick="closeAdminDeleteConfirmModal()">
                    Batal
                </button>
                <button type="button" class="btn-admin-danger-delete" id="btn-execute-delete" onclick="executePendingDelete()">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                    <span id="btn-execute-delete-text">Ya, Hapus Sekarang</span>
                </button>
            </div>
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

        // ===== ADMIN SETTINGS & AVATAR MANAGER =====
        function initAdminProfile() {
            const savedName = localStorage.getItem('dewasufa_admin_name') || 'Erick';
            document.querySelectorAll('.dash-user-name').forEach(el => el.textContent = savedName);
            document.querySelectorAll('.dash-user-role').forEach(el => el.textContent = 'Admin');

            const savedAvatar = localStorage.getItem('dewasufa_admin_avatar');
            const headerAvatar = document.querySelector('#admin-user-menu-btn .dash-avatar');
            if (savedAvatar && headerAvatar) {
                headerAvatar.innerHTML = `<img src="${savedAvatar}" alt="Avatar Admin" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">`;
            }
        }

        function openAdminSettingsModal() {
            const modal = document.getElementById('admin-settings-modal');
            if (!modal) return;

            // Prefill nama
            const nameInput = document.getElementById('admin-settings-name');
            const savedName = localStorage.getItem('dewasufa_admin_name') || 'Erick';
            if (nameInput) nameInput.value = savedName;

            // Prefill email & phone & role (locked/readonly)
            const emailInput = document.getElementById('admin-settings-email');
            const phoneInput = document.getElementById('admin-settings-phone');
            const roleInput = document.getElementById('admin-settings-role');
            if (emailInput) {
                emailInput.value = localStorage.getItem('dewasufa_admin_email') || 'admin@dewasufa.com';
                emailInput.readOnly = true;
            }
            if (phoneInput) {
                phoneInput.value = localStorage.getItem('dewasufa_admin_phone') || '+62 811-2345-6789';
                phoneInput.readOnly = true;
            }
            if (roleInput) {
                roleInput.value = 'Admin';
                roleInput.readOnly = true;
            }

            // Reset password inputs
            const resetPass = document.getElementById('admin-settings-reset-password');
            const confirmPass = document.getElementById('admin-settings-confirm-password');
            if (resetPass) resetPass.value = '';
            if (confirmPass) confirmPass.value = '';

            // Avatar preview
            const savedAvatar = localStorage.getItem('dewasufa_admin_avatar');
            const previewImg = document.getElementById('admin-settings-avatar-preview');
            const fallbackSpan = document.getElementById('admin-settings-avatar-fallback');
            const removeBtn = document.getElementById('btn-admin-remove-avatar');
            if (savedAvatar && previewImg && fallbackSpan) {
                previewImg.src = savedAvatar;
                previewImg.style.display = 'block';
                fallbackSpan.style.display = 'none';
                if (removeBtn) removeBtn.style.display = 'inline-flex';
            } else if (previewImg && fallbackSpan) {
                previewImg.src = '';
                previewImg.style.display = 'none';
                fallbackSpan.style.display = 'block';
                if (removeBtn) removeBtn.style.display = 'none';
            }

            modal.classList.add('show', 'active');
            document.body.style.overflow = 'hidden';

            const dropdown = document.getElementById('admin-user-dropdown');
            if (dropdown) dropdown.classList.remove('show');
        }

        function closeAdminSettingsModal() {
            const modal = document.getElementById('admin-settings-modal');
            if (modal) {
                modal.classList.remove('show', 'active');
                document.body.style.overflow = '';
            }
        }

        function saveAdminSettings(e) {
            e.preventDefault();
            const nameInput = document.getElementById('admin-settings-name');
            const newName = nameInput ? nameInput.value.trim() : 'Erick';

            if (newName) {
                localStorage.setItem('dewasufa_admin_name', newName);
                document.querySelectorAll('.dash-user-name').forEach(el => el.textContent = newName);
            }

            const resetPass = document.getElementById('admin-settings-reset-password');
            const confirmPass = document.getElementById('admin-settings-confirm-password');
            const newPass = resetPass ? resetPass.value : '';
            const confPass = confirmPass ? confirmPass.value : '';

            if (newPass || confPass) {
                if (newPass.length < 6) {
                    showAdminToast('Password baru admin minimal 6 karakter.');
                    return;
                }
                if (newPass !== confPass) {
                    showAdminToast('Konfirmasi password tidak cocok.');
                    return;
                }
                showAdminToast('Password berhasil direset & profil admin disimpan!');
            } else {
                showAdminToast('Pengaturan profil admin dan preferensi berhasil disimpan!');
            }

            closeAdminSettingsModal();
        }

        function initAdminAvatarManager() {
            const avatarInput = document.getElementById('admin-settings-avatar-input');
            const previewImg = document.getElementById('admin-settings-avatar-preview');
            const fallbackSpan = document.getElementById('admin-settings-avatar-fallback');
            const removeBtn = document.getElementById('btn-admin-remove-avatar');
            const headerAvatar = document.querySelector('#admin-user-menu-btn .dash-avatar');

            function applyAdminAvatar(dataUrl) {
                if (dataUrl) {
                    if (previewImg) {
                        previewImg.src = dataUrl;
                        previewImg.style.display = 'block';
                    }
                    if (fallbackSpan) fallbackSpan.style.display = 'none';
                    if (removeBtn) removeBtn.style.display = 'inline-flex';
                    if (headerAvatar) {
                        headerAvatar.innerHTML = `<img src="${dataUrl}" alt="Avatar Admin" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">`;
                    }
                } else {
                    if (previewImg) {
                        previewImg.src = '';
                        previewImg.style.display = 'none';
                    }
                    if (fallbackSpan) fallbackSpan.style.display = 'block';
                    if (removeBtn) removeBtn.style.display = 'none';
                    if (headerAvatar) {
                        headerAvatar.innerHTML = `<span class="dash-avatar-initials">ER</span>`;
                    }
                }
            }

            if (avatarInput) {
                avatarInput.addEventListener('change', (e) => {
                    const file = e.target.files?.[0];
                    if (!file) return;
                    if (file.size > 2 * 1024 * 1024) {
                        showAdminToast('Ukuran gambar maksimal 2MB.');
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        const dataUrl = evt.target?.result;
                        if (dataUrl) {
                            localStorage.setItem('dewasufa_admin_avatar', dataUrl);
                            applyAdminAvatar(dataUrl);
                            showAdminToast('Foto profil admin berhasil diperbarui!');
                        }
                    };
                    reader.readAsDataURL(file);
                });
            }

            window.removeAdminAvatar = function() {
                localStorage.removeItem('dewasufa_admin_avatar');
                if (avatarInput) avatarInput.value = '';
                applyAdminAvatar(null);
                showAdminToast('Foto profil admin dihapus.');
            };
        }

        // ===== DESTINATION DETAIL MODAL (NO PORTAL REDIRECT) =====
        // ===== DESTINATION DETAIL MODAL (MATCHING USER PORTAL) =====
        async function openAdminSpotDetail(key, btn) {
            const card = btn ? btn.closest('.dash-recom-card') : document.querySelector('.dash-recom-card[data-key="' + key + '"]');
            const modal = document.getElementById('dest-detail-modal');
            if (!modal) return;
            let destId = (card && (card.dataset.id || card.dataset.key)) ? (card.dataset.id || card.dataset.key) : key;
            let title = 'Air Terjun Sekumpul', desc = 'Keindahan alam Bali yang memukau.',
                time = '07:00 - 18:00 WITA', ticket = 'Rp 20.000 / orang', loc = 'Buleleng, Bali',
                cat = 'Waterfall', imgSrc = '/images/waterfall.jpg',
                rating = '5.0', bestVisit = '07:00 – 09:30 WITA (Suasana tenang dan sejuk)',
                status = 'post', tags = 'Air Terjun, Alam, Spot Foto', gmaps = '';
            let thumb1 = '', thumb2 = '', thumb3 = '';

            if (card) {
                destId = card.dataset.id || card.dataset.key || destId;
                title  = card.dataset.title  || card.querySelector('.dash-recom-card-title')?.textContent  || title;
                desc   = card.dataset.desc   || card.querySelector('.dash-recom-card-desc')?.textContent   || desc;
                time   = card.dataset.time   || time;
                ticket = card.dataset.ticket || ticket;
                loc    = card.dataset.loc    || loc;
                cat    = card.dataset.category || cat;
                rating = card.dataset.rating || rating;
                bestVisit = card.dataset.bestVisit || bestVisit;
                status = card.dataset.status || status;
                tags   = card.dataset.tags || tags;
                gmaps  = card.dataset.gmaps || '';
                thumb1 = card.dataset.thumb1 || '';
                thumb2 = card.dataset.thumb2 || '';
                thumb3 = card.dataset.thumb3 || '';
                const img = card.querySelector('.dash-recom-img');
                if (img) imgSrc = img.src;
            }

            const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
            set('dest-detail-title', title);
            set('dest-detail-desc', desc);
            set('dest-detail-time', time);
            set('dest-detail-ticket', ticket);
            set('dest-detail-location-text', loc);
            set('dest-detail-score', rating);
            set('dest-detail-score-side', rating);
            set('dest-detail-best-visit', bestVisit);
            set('dest-detail-category', cat.charAt(0).toUpperCase() + cat.slice(1));

            const statusPill = document.getElementById('dest-detail-status-pill');
            if (statusPill) {
                if (status === 'pending') {
                    statusPill.textContent = '● Pending (Hanya Admin)';
                    statusPill.style.background = 'rgba(234, 179, 8, 0.2)';
                    statusPill.style.color = '#facc15';
                    statusPill.style.borderColor = 'rgba(234, 179, 8, 0.35)';
                } else {
                    statusPill.textContent = '● Terbit Aktif (Post)';
                    statusPill.style.background = 'rgba(36, 75, 44, 0.5)';
                    statusPill.style.color = '#86efac';
                    statusPill.style.borderColor = 'rgba(34, 197, 94, 0.3)';
                }
            }

            const tagsContainer = document.getElementById('dest-detail-tags');
            if (tagsContainer) {
                if (tags) {
                    const tagArr = tags.split(',').map(t => t.trim()).filter(Boolean);
                    tagsContainer.innerHTML = tagArr.map(t => `<span class="dash-dest-tag-pill" style="display:inline-block;padding:3px 10px;border-radius:14px;background:rgba(255,255,255,0.08);color:rgba(255,255,255,0.85);font-size:11px;font-weight:600;border:1px solid rgba(255,255,255,0.12);">${t}</span>`).join(' ');
                } else {
                    tagsContainer.innerHTML = '';
                }
            }

            const gmapsLink = document.getElementById('dest-detail-gmaps-link');
            if (gmapsLink) {
                gmapsLink.href = gmaps || `https://maps.google.com/?q=${encodeURIComponent(title + ' ' + loc)}`;
            }

            const mainImg = document.getElementById('dest-detail-img');
            if (mainImg) mainImg.src = imgSrc;
            const t1 = document.getElementById('dest-detail-img-thumb-1');
            if (t1) t1.src = thumb1 || imgSrc;
            const t2 = document.getElementById('dest-detail-img-thumb-2');
            if (t2) t2.src = thumb2 || imgSrc;
            const t3 = document.getElementById('dest-detail-img-thumb-3');
            if (t3) t3.src = thumb3 || imgSrc;

            // Load realtime comments from database API
            const counterEl = document.getElementById('dest-comments-counter');
            const commentsListEl = document.getElementById('dest-comments-list');
            if (counterEl) counterEl.textContent = 'Memuat...';
            if (commentsListEl) {
                commentsListEl.innerHTML = '<div style="text-align: center; padding: 25px 15px; color: rgba(255,255,255,0.45); font-size: 13px;">Sedang memuat ulasan...</div>';
            }

            modal.classList.add('active', 'show');
            document.body.style.overflow = 'hidden';

            try {
                let fetchUrl = `/api/comments?destination_id=${encodeURIComponent(destId)}`;
                if (key && key !== destId) {
                    fetchUrl += `&destination_slug=${encodeURIComponent(key)}`;
                }
                const res = await fetch(fetchUrl, {
                    headers: { 'Accept': 'application/json' }
                });
                if (res.ok) {
                    const data = await res.json();
                    const comments = (data && Array.isArray(data.comments)) ? data.comments : [];
                    window._adminAllCurrentComments = comments;

                    const totalRev = Number(data.count ?? comments.length ?? 0);
                    const avgR = (data.avg_rating !== undefined && Number(data.avg_rating) > 0) ? Number(data.avg_rating).toFixed(1) : (totalRev > 0 ? '5.0' : '0.0');

                    set('dest-detail-score', avgR);
                    set('dest-detail-score-side', avgR);
                    set('dest-detail-reviews-count', `(${totalRev} Ulasan)`);
                    set('dest-detail-rating-summary', `★ ${avgR} (${totalRev} Ulasan)`);
                    if (counterEl) counterEl.textContent = `${totalRev} Komentar`;

                    // Update filter counts
                    const bd = data.rating_breakdown || { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 };
                    set('admin-chip-cnt-all', `(${totalRev})`);
                    set('admin-chip-cnt-5', `(${bd[5] || 0})`);
                    set('admin-chip-cnt-4', `(${bd[4] || 0})`);
                    set('admin-chip-cnt-3', `(${bd[3] || 0})`);
                    set('admin-chip-cnt-2', `(${bd[2] || 0})`);
                    set('admin-chip-cnt-1', `(${bd[1] || 0})`);

                    // Reset active chip
                    document.querySelectorAll('#admin-dest-rating-filter-bar .dash-rating-chip').forEach(c => c.classList.remove('active'));
                    document.querySelector('#admin-dest-rating-filter-bar .dash-rating-chip[data-star="all"]')?.classList.add('active');

                    renderAdminCommentsList(comments);
                }
            } catch (err) {
                console.error('Error fetching admin comments:', err);
                if (commentsListEl) {
                    commentsListEl.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444; font-size: 13px;">Gagal memuat ulasan dari server.</div>';
                }
            }
        }

        function renderAdminCommentsList(comments) {
            const commentsListEl = document.getElementById('dest-comments-list');
            if (!commentsListEl) return;

            if (!comments || comments.length === 0) {
                commentsListEl.innerHTML = `
                    <div style="text-align: center; padding: 30px 15px; color: rgba(255,255,255,0.45); font-size: 13px;">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 10px; display: block; opacity: 0.5;">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        Belum ada ulasan untuk destinasi ini.
                    </div>
                `;
                return;
            }

            commentsListEl.innerHTML = comments.map(c => {
                const initial = (c.author_name || 'W').slice(0, 2).toUpperCase();
                const photos = c.photo_urls || c.photos || [];
                const photosHtml = (Array.isArray(photos) && photos.length > 0)
                    ? `
                        <div class="dash-comment-photos-grid" style="display:flex;gap:6px;margin-top:8px;flex-wrap:wrap;">
                            ${photos.map((photoUrl, idx) => `
                                <div style="width:52px;height:52px;border-radius:8px;overflow:hidden;border:1px solid rgba(255,255,255,0.12);background:rgba(0,0,0,0.3);cursor:pointer;" onclick="openAdminPhotoModal('${photoUrl}')" title="Klik untuk memperbesar foto">
                                    <img src="${photoUrl}" alt="Foto ulasan ${idx + 1}" style="width:100%;height:100%;object-fit:cover;" loading="lazy">
                                </div>
                            `).join('')}
                        </div>
                    `
                    : '';

                const ratingNum = Math.round(Number(c.rating)) || 5;
                let starsSvg = '';
                for (let s = 1; s <= 5; s++) {
                    const fill = s <= ratingNum ? '#f5b842' : 'none';
                    const stroke = s <= ratingNum ? '#f5b842' : 'rgba(255,255,255,0.3)';
                    starsSvg += `<svg viewBox="0 0 24 24" width="13" height="13" fill="${fill}" stroke="${stroke}" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>`;
                }

                return `
                    <div class="dash-comment-card" data-comment-id="${c.id}">
                        <div class="dash-comment-top">
                            <div class="dash-comment-author-info">
                                <div class="dash-comment-avatar" style="background:#244b2c;color:#ffffff;">${initial}</div>
                                <span class="dash-comment-author-name">
                                    ${c.author_name}
                                    <span class="dash-comment-badge-verified">${c.author_role || 'Terverifikasi'}</span>
                                </span>
                            </div>
                            <div class="dash-comment-meta-right">
                                <span class="dash-comment-date">${c.formatted_date || 'Baru saja'}</span>
                                <div class="dash-comment-stars" style="display:flex;gap:2px;">
                                    ${starsSvg}
                                </div>
                            </div>
                        </div>
                        <p class="dash-comment-text">${c.comment}</p>
                        ${photosHtml}
                    </div>
                `;
            }).join('');
        }

        function filterAdminCommentsByStar(star, btn) {
            document.querySelectorAll('#admin-dest-rating-filter-bar .dash-rating-chip').forEach(c => c.classList.remove('active'));
            if (btn) btn.classList.add('active');

            const allComments = window._adminAllCurrentComments || [];
            let filtered = allComments;
            if (star !== 'all') {
                const targetStar = Number(star);
                filtered = allComments.filter(c => Math.round(Number(c.rating)) === targetStar);
            }

            renderAdminCommentsList(filtered);
            const counterEl = document.getElementById('dest-comments-counter');
            if (counterEl) {
                counterEl.textContent = `${filtered.length} Komentar ${star !== 'all' ? '(★ ' + star + ')' : ''}`;
            }
        }
        function closeAdminSpotDetail() {
            const modal = document.getElementById('dest-detail-modal');
            if (modal) { modal.classList.remove('active', 'show'); document.body.style.overflow = ''; }
        }

        function openAdminPhotoModal(imgSrc) {
            let lightbox = document.getElementById('admin-photo-lightbox');
            if (!lightbox) {
                lightbox = document.createElement('div');
                lightbox.id = 'admin-photo-lightbox';
                lightbox.className = 'dash-modal-backdrop active';
                lightbox.style.zIndex = '99999';
                lightbox.innerHTML = `
                    <div class="dash-lightbox-content" style="position:relative;max-width:90vw;max-height:90vh;display:flex;align-items:center;justify-content:center;">
                        <button type="button" class="dash-lightbox-close" onclick="closeAdminPhotoModal()" style="position:absolute;top:-40px;right:0;background:rgba(0,0,0,0.6);border:none;color:#fff;font-size:28px;cursor:pointer;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;">&times;</button>
                        <img id="admin-lightbox-img" src="${imgSrc}" alt="Pratinjau Foto" style="max-width:100%;max-height:85vh;border-radius:12px;box-shadow:0 20px 50px rgba(0,0,0,0.8);object-fit:contain;">
                    </div>
                `;
                lightbox.onclick = (e) => { if (e.target === lightbox) closeAdminPhotoModal(); };
                document.body.appendChild(lightbox);
            } else {
                const img = document.getElementById('admin-lightbox-img');
                if (img) img.src = imgSrc;
                lightbox.classList.add('active');
            }
        }
        function closeAdminPhotoModal() {
            const lightbox = document.getElementById('admin-photo-lightbox');
            if (lightbox) lightbox.classList.remove('active');
        }

        // ===== EDIT DESTINATION MODAL LOGIC (IDENTICAL TO CREATE MODAL & DETAIL) =====
        let currentEditingCard = null;
        let editUploadedPhotos = { main: '', thumb1: '', thumb2: '', thumb3: '' };
        let editUploadedPhotoFiles = { main: null, thumb1: null, thumb2: null, thumb3: null };

        function setSelectVal(id, val) {
            const el = document.getElementById(id);
            if (!el || val === undefined || val === null) return;
            for (let i = 0; i < el.options.length; i++) {
                if (el.options[i].value === String(val)) {
                    el.selectedIndex = i;
                    return;
                }
            }
        }

        function initEditHourSelects() {
            const populate = (id, def) => {
                const el = document.getElementById(id);
                if (!el || el.children.length > 10) return;
                el.innerHTML = '';
                for (let h = 0; h < 24; h++) {
                    const val = String(h).padStart(2, '0');
                    const opt = document.createElement('option');
                    opt.value = val;
                    opt.textContent = val;
                    if (val === String(def).padStart(2, '0')) opt.selected = true;
                    el.appendChild(opt);
                }
            };
            populate('edit-dest-time-open-h', '06');
            populate('edit-dest-time-close-h', '18');
            populate('edit-dest-best-start-h', '07');
            populate('edit-dest-best-end-h', '09');
        }

        function updateEditTimePreviews() {
            const openH = document.getElementById('edit-dest-time-open-h')?.value || '06';
            const openM = document.getElementById('edit-dest-time-open-m')?.value || '30';
            const closeH = document.getElementById('edit-dest-time-close-h')?.value || '18';
            const closeM = document.getElementById('edit-dest-time-close-m')?.value || '00';
            const tz = document.getElementById('edit-dest-time-tz')?.value || 'WITA';

            const badgeTime = document.getElementById('edit-preview-time-badge');
            if (badgeTime) {
                badgeTime.textContent = `${openH}:${openM} – ${closeH}:${closeM} ${tz}`;
            }

            const startH = document.getElementById('edit-dest-best-start-h')?.value || '07';
            const startM = document.getElementById('edit-dest-best-start-m')?.value || '00';
            const endH = document.getElementById('edit-dest-best-end-h')?.value || '09';
            const endM = document.getElementById('edit-dest-best-end-m')?.value || '30';
            const bestTz = document.getElementById('edit-dest-best-tz')?.value || 'WITA';
            const cond = document.getElementById('edit-dest-best-condition')?.value || '';

            const badgeBest = document.getElementById('edit-preview-best-badge');
            if (badgeBest) {
                badgeBest.textContent = `${startH}:${startM} – ${endH}:${endM} ${bestTz}` + (cond ? ` ${cond}` : '');
            }
        }

        function handleEditPhotoFile(event, slot) {
            const file = event.target.files && event.target.files[0];
            if (!file) return;
            editUploadedPhotoFiles[slot] = file;

            const reader = new FileReader();
            reader.onload = function(e) {
                const dataUrl = e.target.result;
                editUploadedPhotos[slot] = dataUrl;

                if (slot === 'main') {
                    const pMain = document.getElementById('edit-preview-img-main');
                    if (pMain) pMain.src = dataUrl;

                    ['thumb1', 'thumb2', 'thumb3'].forEach(t => {
                        if (!editUploadedPhotos[t]) {
                            const pThumb = document.getElementById('edit-preview-img-' + t);
                            if (pThumb) pThumb.src = dataUrl;
                        }
                    });

                    const labelEl = document.getElementById('edit-dest-file-main-name');
                    if (labelEl) labelEl.textContent = '✓ File terpilih: ' + file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
                } else {
                    const pThumb = document.getElementById('edit-preview-img-' + slot);
                    if (pThumb) pThumb.src = dataUrl;
                    const labelEl = document.getElementById('edit-dest-file-' + slot + '-name');
                    if (labelEl) labelEl.textContent = '✓ ' + file.name;
                }
            };
            reader.readAsDataURL(file);
        }

        function resetEditModalPhotos() {
            editUploadedPhotos = { main: '', thumb1: '', thumb2: '', thumb3: '' };
            editUploadedPhotoFiles = { main: null, thumb1: null, thumb2: null, thumb3: null };
            const mainLabel = document.getElementById('edit-dest-file-main-name');
            if (mainLabel) mainLabel.textContent = 'Klik di sini untuk memilih file gambar dari file komputer (JPG, PNG, WEBP)';
            ['thumb1', 'thumb2', 'thumb3'].forEach(k => {
                const l = document.getElementById('edit-dest-file-' + k + '-name');
                if (l) l.textContent = '+ Upload dari File';
            });
            const fMain = document.getElementById('edit-dest-file-main');
            if (fMain) fMain.value = '';
            ['thumb1', 'thumb2', 'thumb3'].forEach(k => {
                const f = document.getElementById('edit-dest-file-' + k);
                if (f) f.value = '';
            });
        }

        function openEditDestModal(btn, e) {
            if (e) e.stopPropagation();
            const card = btn.closest('.dash-recom-card');
            if (!card) return;
            currentEditingCard = card;

            initEditHourSelects();
            resetEditModalPhotos();

            const title = card.dataset.title || card.querySelector('.dash-recom-card-title')?.textContent?.trim() || '';
            const rawCat = card.dataset.category || 'Waterfall';
            const status = card.dataset.status || 'post';
            const ticket = card.dataset.ticket || 'Rp 25.000 / orang';
            const loc = card.dataset.loc || 'Bali, Indonesia';
            const desc = card.dataset.desc || card.querySelector('.dash-recom-card-desc')?.textContent?.trim() || '';
            const tags = card.dataset.tags || '';
            const gmaps = card.dataset.gmaps || '';
            const timeStr = card.dataset.time || '06:30 - 18:00 WITA';
            const bestVisitStr = card.dataset.bestVisit || '07:00 – 09:30 WITA (Suasana tenang dan udara sejuk)';

            // Photos from card
            const mainImg = card.querySelector('.dash-recom-img')?.src || '/images/waterfall.jpg';
            const thumb1 = card.dataset.thumb1 || mainImg;
            const thumb2 = card.dataset.thumb2 || mainImg;
            const thumb3 = card.dataset.thumb3 || mainImg;

            // Set previews in edit modal
            const pMain = document.getElementById('edit-preview-img-main');
            if (pMain) pMain.src = mainImg;
            const pT1 = document.getElementById('edit-preview-img-thumb1');
            if (pT1) pT1.src = thumb1;
            const pT2 = document.getElementById('edit-preview-img-thumb2');
            if (pT2) pT2.src = thumb2;
            const pT3 = document.getElementById('edit-preview-img-thumb3');
            if (pT3) pT3.src = thumb3;

            // Form inputs
            const setVal = (id, val) => { const el = document.getElementById(id); if (el) el.value = val; };
            setVal('edit-dest-title', title);
            setVal('edit-dest-loc', loc);
            setVal('edit-dest-ticket', ticket);
            setVal('edit-dest-tags', tags);
            setVal('edit-dest-desc', desc);
            setVal('edit-dest-gmaps', gmaps);
            setSelectVal('edit-dest-status', status);

            // Normalize category to Match options: Waterfall, Sunset Beach, Sunrise Beach, Mountain
            let catNormalized = 'Waterfall';
            const catLower = rawCat.toLowerCase();
            if (catLower.includes('sunset')) catNormalized = 'Sunset Beach';
            else if (catLower.includes('sunrise')) catNormalized = 'Sunrise Beach';
            else if (catLower.includes('mountain') || catLower.includes('gunung')) catNormalized = 'Mountain';
            else if (catLower.includes('waterfall') || catLower.includes('terjun')) catNormalized = 'Waterfall';
            setSelectVal('edit-dest-category', catNormalized);

            // Parse operational time (e.g. "06:30 – 18:00 WITA" or "07:00 - 16:00")
            const timeMatch = timeStr.match(/(\d{1,2}):(\d{2})\s*[-–]\s*(\d{1,2}):(\d{2})(?:\s*([A-Za-z]+))?/);
            if (timeMatch) {
                setSelectVal('edit-dest-time-open-h', String(timeMatch[1]).padStart(2, '0'));
                setSelectVal('edit-dest-time-open-m', String(timeMatch[2]).padStart(2, '0'));
                setSelectVal('edit-dest-time-close-h', String(timeMatch[3]).padStart(2, '0'));
                setSelectVal('edit-dest-time-close-m', String(timeMatch[4]).padStart(2, '0'));
                if (timeMatch[5]) setSelectVal('edit-dest-time-tz', timeMatch[5].toUpperCase());
            }

            // Parse best visit (e.g. "07:00 – 09:30 WITA (Suasana tenang dan udara sejuk)")
            const bestMatch = bestVisitStr.match(/(\d{1,2}):(\d{2})\s*[-–]\s*(\d{1,2}):(\d{2})(?:\s*([A-Za-z]+))?(?:\s*(\([^)]+\)))?/);
            if (bestMatch) {
                setSelectVal('edit-dest-best-start-h', String(bestMatch[1]).padStart(2, '0'));
                setSelectVal('edit-dest-best-start-m', String(bestMatch[2]).padStart(2, '0'));
                setSelectVal('edit-dest-best-end-h', String(bestMatch[3]).padStart(2, '0'));
                setSelectVal('edit-dest-best-end-m', String(bestMatch[4]).padStart(2, '0'));
                if (bestMatch[5]) setSelectVal('edit-dest-best-tz', bestMatch[5].toUpperCase());
                if (bestMatch[6]) {
                    setSelectVal('edit-dest-best-condition', bestMatch[6].trim());
                }
            }

            updateEditTimePreviews();

            const modal = document.getElementById('admin-edit-dest-modal');
            if (modal) { modal.classList.add('show', 'active'); document.body.style.overflow = 'hidden'; }
        }

        function closeEditDestModal() {
            const modal = document.getElementById('admin-edit-dest-modal');
            if (modal) { modal.classList.remove('show', 'active'); document.body.style.overflow = ''; }
            currentEditingCard = null;
        }

        async function handleEditDestSubmit(e) {
            e.preventDefault();
            if (!currentEditingCard) return;
            const destId = currentEditingCard.dataset.id;
            const val = id => document.getElementById(id)?.value?.trim() || '';

            const newTitle  = val('edit-dest-title'),
                  newCat    = document.getElementById('edit-dest-category')?.value || 'Waterfall',
                  newStatus = document.getElementById('edit-dest-status')?.value || 'post',
                  newTicket = val('edit-dest-ticket'),
                  newLoc    = val('edit-dest-loc'),
                  newTags   = val('edit-dest-tags'),
                  newDesc   = val('edit-dest-desc'),
                  newGmaps  = val('edit-dest-gmaps');

            // Format time string
            const openH = document.getElementById('edit-dest-time-open-h')?.value || '06';
            const openM = document.getElementById('edit-dest-time-open-m')?.value || '30';
            const closeH = document.getElementById('edit-dest-time-close-h')?.value || '18';
            const closeM = document.getElementById('edit-dest-time-close-m')?.value || '00';
            const tz = document.getElementById('edit-dest-time-tz')?.value || 'WITA';
            const newTime = `${openH}:${openM} – ${closeH}:${closeM} ${tz}`;

            // Format best visit string
            const startH = document.getElementById('edit-dest-best-start-h')?.value || '07';
            const startM = document.getElementById('edit-dest-best-start-m')?.value || '00';
            const endH = document.getElementById('edit-dest-best-end-h')?.value || '09';
            const endM = document.getElementById('edit-dest-best-end-m')?.value || '30';
            const bestTz = document.getElementById('edit-dest-best-tz')?.value || 'WITA';
            const cond = document.getElementById('edit-dest-best-condition')?.value || '';
            const newBestVisit = `${startH}:${startM} – ${endH}:${endM} ${bestTz}` + (cond ? ` ${cond}` : '');

            // Normalize category key for filtering
            let catKey = 'waterfall';
            if (newCat === 'Sunset Beach' || newCat.toLowerCase().includes('sunset')) catKey = 'sunset';
            else if (newCat === 'Sunrise Beach' || newCat.toLowerCase().includes('sunrise')) catKey = 'sunrise';
            else if (newCat === 'Mountain' || newCat.toLowerCase().includes('mountain')) catKey = 'mountain';

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const formData = new FormData();
            formData.append('name', newTitle);
            formData.append('category', newCat);
            formData.append('description', newDesc);
            formData.append('price', newTicket);
            formData.append('status', newStatus);
            if (editUploadedPhotoFiles.main) {
                formData.append('image', editUploadedPhotoFiles.main);
            }

            try {
                if (destId) {
                    const response = await fetch(`/admin/destinations/${destId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });
                    const res = await response.json();
                    if (!response.ok) {
                        showAdminToast(res.message || 'Gagal memperbarui di database.', '✕');
                        return;
                    }
                    if (res.destination && res.destination.image_url) {
                        const cardImg = currentEditingCard.querySelector('.dash-recom-img');
                        if (cardImg) cardImg.src = res.destination.image_url;
                    }
                }

                // Update card dataset
                currentEditingCard.dataset.title    = newTitle;
                currentEditingCard.dataset.category = catKey;
                currentEditingCard.dataset.status   = newStatus;
                currentEditingCard.dataset.ticket   = newTicket;
                currentEditingCard.dataset.time     = newTime;
                currentEditingCard.dataset.loc      = newLoc;
                currentEditingCard.dataset.tags     = newTags;
                currentEditingCard.dataset.desc     = newDesc;
                currentEditingCard.dataset.gmaps    = newGmaps;
                currentEditingCard.dataset.bestVisit = newBestVisit;

                // Update photos if newly uploaded
                if (editUploadedPhotos.main) {
                    const cardImg = currentEditingCard.querySelector('.dash-recom-img');
                    if (cardImg) cardImg.src = editUploadedPhotos.main;
                }
                if (editUploadedPhotos.thumb1) currentEditingCard.dataset.thumb1 = editUploadedPhotos.thumb1;
                if (editUploadedPhotos.thumb2) currentEditingCard.dataset.thumb2 = editUploadedPhotos.thumb2;
                if (editUploadedPhotos.thumb3) currentEditingCard.dataset.thumb3 = editUploadedPhotos.thumb3;

                // Update Card DOM
                const t = currentEditingCard.querySelector('.dash-recom-card-title');
                if (t) t.textContent = newTitle;
                const d = currentEditingCard.querySelector('.dash-recom-card-desc');
                if (d) d.textContent = newDesc;
                const b = currentEditingCard.querySelector('.dash-recom-badge');
                if (b) {
                    b.textContent = newCat;
                    b.className = 'dash-recom-badge ' + (catKey === 'sunset' ? 'badge-sunset' : (catKey === 'sunrise' ? 'badge-sunrise' : (catKey === 'mountain' ? 'badge-mountain' : '')));
                }

                // Update status pill badge on card
                const statusPill = currentEditingCard.querySelector('.admin-card-status-pill');
                if (statusPill) {
                    const isPending = (newStatus === 'pending' || newStatus === 'draft');
                    if (isPending) {
                        statusPill.className = 'admin-card-status-pill badge-status-draft';
                        statusPill.textContent = '● Pending (Admin Only)';
                        statusPill.style.background = 'rgba(234, 179, 8, 0.2)';
                        statusPill.style.color = '#facc15';
                        statusPill.style.border = '1px solid rgba(234, 179, 8, 0.35)';
                    } else {
                        statusPill.className = 'admin-card-status-pill badge-status-post';
                        statusPill.textContent = '● Post (Publik)';
                        statusPill.style.background = '';
                        statusPill.style.color = '';
                        statusPill.style.border = '';
                    }
                }

                closeEditDestModal();
                updateDestCounts();
                showAdminToast('Destinasi "' + newTitle + '" berhasil diperbarui di database! ✨');
            } catch (err) {
                console.error(err);
                showAdminToast('Gagal memperbarui di database.', '✕');
            }
        }

        // ===== CUSTOM CONFIRMATION POPUP MODAL =====
        let pendingDeleteAction = null;

        function openAdminDeleteConfirmModal(config) {
            const modal = document.getElementById('admin-delete-confirm-modal');
            if (!modal) return;

            const badgeEl = document.getElementById('admin-confirm-badge');
            const titleEl = document.getElementById('admin-confirm-title');
            const descEl  = document.getElementById('admin-confirm-desc');
            const boxEl   = document.getElementById('admin-confirm-preview-box');
            const btnText = document.getElementById('btn-execute-delete-text');

            if (badgeEl) badgeEl.textContent = config.badge || 'Konfirmasi Penghapusan';
            if (titleEl) titleEl.textContent = config.title || 'Hapus Data Ini?';
            if (descEl)  descEl.textContent  = config.desc  || 'Apakah Anda yakin ingin menghapus data ini?';
            if (boxEl)   boxEl.innerHTML     = config.previewHtml || '';
            if (btnText) btnText.textContent = config.btnText || 'Ya, Hapus Sekarang';

            pendingDeleteAction = config.onConfirm;

            modal.classList.add('show', 'active');
            document.body.style.overflow = 'hidden';

            const cancelBtn = document.getElementById('btn-cancel-delete');
            if (cancelBtn) cancelBtn.focus();
        }

        function closeAdminDeleteConfirmModal() {
            const modal = document.getElementById('admin-delete-confirm-modal');
            if (modal) {
                modal.classList.remove('show', 'active');
            }
            const reviewModal = document.getElementById('admin-review-detail-modal');
            if (!reviewModal || !reviewModal.classList.contains('show')) {
                document.body.style.overflow = '';
            }
            pendingDeleteAction = null;
        }

        function executePendingDelete() {
            if (typeof pendingDeleteAction === 'function') {
                const action = pendingDeleteAction;
                pendingDeleteAction = null;
                action();
            } else {
                closeAdminDeleteConfirmModal();
            }
        }

        // ===== DELETE DESTINATION CARD (TRASH ICON) =====
        function confirmDeleteCard(btn, e) {
            if (e) e.stopPropagation();
            const card = btn.closest('.dash-recom-card');
            if (!card) return;

            const title = card.dataset.title || card.querySelector('.dash-recom-card-title')?.textContent?.trim() || 'Destinasi';
            const cat = card.dataset.category || card.querySelector('.dash-recom-badge')?.textContent?.trim() || 'Wisata';
            const status = card.dataset.status || 'post';
            const loc = card.dataset.loc || card.querySelector('.dash-recom-card-desc')?.textContent?.trim() || 'Bali, Indonesia';
            const imgEl = card.querySelector('.dash-recom-img');
            const imgSrc = imgEl ? imgEl.src : '/images/waterfall.jpg';

            const isPost = status === 'post';
            const statusBadgeStyle = isPost
                ? 'background:rgba(34,197,94,0.18);color:#4ade80;border:1px solid rgba(74,222,128,0.4);'
                : 'background:rgba(245,158,11,0.18);color:#fbbf24;border:1px solid rgba(251,191,36,0.4);';
            const statusLabel = isPost ? '● Post (Terbit)' : '● Draft (Konsep)';

            const previewHtml = `
                <div style="display:flex;align-items:center;gap:12px;">
                    <img src="${imgSrc}" alt="${title}" style="width:54px;height:54px;border-radius:12px;object-fit:cover;border:1px solid rgba(255,255,255,0.14);flex-shrink:0;">
                    <div style="flex:1;min-width:0;">
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:4px;flex-wrap:wrap;">
                            <span style="font-size:11px;font-weight:700;padding:2px 8px;border-radius:9999px;background:rgba(94,234,212,0.15);color:#5eead4;border:1px solid rgba(94,234,212,0.3);text-transform:capitalize;">${cat}</span>
                            <span style="font-size:11px;font-weight:700;padding:2px 8px;border-radius:9999px;${statusBadgeStyle}">${statusLabel}</span>
                        </div>
                        <h4 style="font-size:14.5px;font-weight:700;color:#ffffff;margin:0 0 2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${title}</h4>
                        <div style="font-size:11.5px;color:rgba(255,255,255,0.6);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${loc}</div>
                    </div>
                </div>
            `;

            openAdminDeleteConfirmModal({
                badge: 'Hapus Destinasi Wisata',
                title: 'Hapus Destinasi Ini?',
                desc: `Apakah Anda yakin ingin menghapus "${title}" dari katalog destinasi?`,
                previewHtml: previewHtml,
                btnText: 'Ya, Hapus Destinasi',
                onConfirm: async () => {
                    closeAdminDeleteConfirmModal();
                    const destId = card.dataset.id;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                    if (destId) {
                        try {
                            const res = await fetch(`/admin/destinations/${destId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                }
                            });
                            const result = await res.json();
                            if (!res.ok) {
                                showAdminToast(result.message || 'Gagal menghapus dari database.', '✕');
                                return;
                            }
                        } catch (err) {
                            console.error(err);
                            showAdminToast('Gagal menghubungi database.', '✕');
                            return;
                        }
                    }

                    card.style.transition = 'all 0.35s ease';
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.88)';
                    setTimeout(() => {
                        card.remove();
                        updateDestCounts();
                        showAdminToast('Destinasi "' + title + '" berhasil dihapus dari database.');
                    }, 350);
                }
            });
        }

        function updateDestCounts() {
            const allCards = document.querySelectorAll('#admin-cards-container .dash-recom-card');
            let postCount = 0, draftCount = 0;
            let wfCount = 0, sunCount = 0, sriCount = 0, mtnCount = 0;

            allCards.forEach(c => {
                if (c.dataset.status === 'draft' || c.dataset.status === 'pending') draftCount++;
                else postCount++;
                const cat = (c.dataset.category || '').toLowerCase();
                if (cat === 'waterfall' || cat.includes('terjun')) wfCount++;
                else if (cat === 'sunset') sunCount++;
                else if (cat === 'sunrise') sriCount++;
                else if (cat === 'mountain' || cat.includes('gunung')) mtnCount++;
            });

            const statPost = document.getElementById('stat-post-count');
            if (statPost) statPost.textContent = postCount;
            const statDraft = document.getElementById('stat-draft-count');
            if (statDraft) statDraft.textContent = draftCount;
            const navPill = document.querySelector('.admin-nav-item[data-nav="destinasi"] .admin-nav-pill');
            if (navPill) navPill.textContent = allCards.length;
            const badge = document.getElementById('admin-dest-count-badge');
            if (badge) badge.textContent = `${allCards.length} Destinasi`;

            const setCat = (id, count) => {
                const el = document.getElementById(id);
                if (el) el.textContent = `(${count} Destinasi)`;
            };
            setCat('admin-count-waterfall', wfCount);
            setCat('admin-count-sunset', sunCount);
            setCat('admin-count-sunrise', sriCount);
            setCat('admin-count-mountain', mtnCount);
            setCat('admin-count-all', allCards.length);
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

            // Handle photos preview in detail modal
            const photosContainer = document.getElementById('review-detail-photos');
            if (photosContainer) {
                let photos = [];
                try {
                    photos = JSON.parse(row.dataset.photos || '[]');
                } catch (e) {
                    photos = [];
                }
                if (Array.isArray(photos) && photos.length > 0) {
                    photosContainer.innerHTML = photos.map((p, idx) => `
                        <a href="${p}" target="_blank" rel="noopener" style="display:inline-block;border-radius:8px;overflow:hidden;border:1px solid rgba(255,255,255,0.15);width:64px;height:64px;">
                            <img src="${p}" alt="Foto ulasan ${idx+1}" style="width:100%;height:100%;object-fit:cover;">
                        </a>
                    `).join('');
                    photosContainer.style.display = 'flex';
                } else {
                    photosContainer.innerHTML = '';
                    photosContainer.style.display = 'none';
                }
            }

            const modal = document.getElementById('admin-review-detail-modal');
            if (modal) { modal.classList.add('show', 'active'); document.body.style.overflow = 'hidden'; }
        }

        function closeReviewDetailModal() {
            const modal = document.getElementById('admin-review-detail-modal');
            if (modal) { modal.classList.remove('show', 'active'); document.body.style.overflow = ''; }
            currentCommentRow = null;
        }

        function deleteCurrentReviewFromModal() {
            if (!currentCommentRow) return;
            const targetRow = currentCommentRow;
            const commentId = targetRow.dataset.id;
            const user    = targetRow.dataset.user    || targetRow.querySelector('.admin-cell-title')?.textContent || 'Pengguna';
            const dest    = targetRow.dataset.dest    || targetRow.querySelector('.admin-role-tag')?.textContent   || 'Destinasi';
            const rating  = targetRow.dataset.rating  || '5.0';
            const time    = targetRow.dataset.time    || 'Baru saja';
            const comment = targetRow.dataset.comment || targetRow.querySelector('.admin-comment-snippet')?.textContent?.replace(/"/g,'').trim() || '';
            const avatarMini = targetRow.querySelector('.admin-avatar-mini');
            const avatarText = avatarMini ? avatarMini.textContent.trim() : user.slice(0,2).toUpperCase();
            const avatarBg   = avatarMini ? (avatarMini.style.background || '#244b2c') : '#244b2c';
            const avatarColor= avatarMini ? (avatarMini.style.color || '#ffffff') : '#ffffff';

            const previewHtml = `
                <div style="display:flex;flex-direction:column;gap:8px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                        <div style="display:flex;align-items:center;gap:10px;min-width:0;">
                            <div style="width:36px;height:36px;border-radius:50%;background:${avatarBg};color:${avatarColor};display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;flex-shrink:0;">${avatarText}</div>
                            <div style="min-width:0;">
                                <h4 style="font-size:13.5px;font-weight:700;color:#ffffff;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${user}</h4>
                                <div style="font-size:11px;color:rgba(255,255,255,0.5);">${time} • <span style="color:#f5b842;">★ ${rating}</span></div>
                            </div>
                        </div>
                        <span style="font-size:11px;font-weight:600;padding:3px 9px;border-radius:8px;background:rgba(36,75,44,0.4);color:#5eead4;border:1px solid rgba(36,75,44,0.6);white-space:nowrap;flex-shrink:0;">${dest}</span>
                    </div>
                    <div style="padding:9px 12px;background:rgba(0,0,0,0.25);border-radius:10px;font-size:12px;line-height:1.45;color:rgba(255,255,255,0.85);font-style:italic;border-left:3px solid #ef4444;max-height:80px;overflow:hidden;">
                        "${comment}"
                    </div>
                </div>
            `;

            openAdminDeleteConfirmModal({
                badge: 'Moderasi Komentar',
                title: 'Hapus Komentar Wisatawan?',
                desc: `Apakah Anda yakin ingin menghapus komentar dari "${user}"?`,
                previewHtml: previewHtml,
                btnText: 'Ya, Hapus Komentar',
                onConfirm: async () => {
                    closeAdminDeleteConfirmModal();
                    if (commentId) {
                        try {
                            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                            await fetch(`/admin/comments/${commentId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrf,
                                    'Accept': 'application/json'
                                }
                            });
                        } catch (err) {
                            console.error('Gagal menghapus komentar dari server:', err);
                        }
                    }
                    targetRow.style.transition = 'all 0.3s ease';
                    targetRow.style.opacity = '0';
                    setTimeout(() => {
                        targetRow.remove();
                        updateCommentsCount();
                        closeReviewDetailModal();
                        showAdminToast('Ulasan dari ' + user + ' berhasil dihapus.');
                    }, 300);
                }
            });
        }

        function deleteCommentRow(btn, e) {
            if (e) e.stopPropagation();
            const row = btn.closest('tr');
            if (!row) return;

            const commentId = row.dataset.id;
            const user    = row.dataset.user    || row.querySelector('.admin-cell-title')?.textContent || 'Pengguna';
            const dest    = row.dataset.dest    || row.querySelector('.admin-role-tag')?.textContent   || 'Destinasi';
            const rating  = row.dataset.rating  || '5.0';
            const time    = row.dataset.time    || 'Baru saja';
            const comment = row.dataset.comment || row.querySelector('.admin-comment-snippet')?.textContent?.replace(/"/g,'').trim() || '';
            const avatarMini = row.querySelector('.admin-avatar-mini');
            const avatarText = avatarMini ? avatarMini.textContent.trim() : user.slice(0,2).toUpperCase();
            const avatarBg   = avatarMini ? (avatarMini.style.background || '#244b2c') : '#244b2c';
            const avatarColor= avatarMini ? (avatarMini.style.color || '#ffffff') : '#ffffff';

            const previewHtml = `
                <div style="display:flex;flex-direction:column;gap:8px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                        <div style="display:flex;align-items:center;gap:10px;min-width:0;">
                            <div style="width:36px;height:36px;border-radius:50%;background:${avatarBg};color:${avatarColor};display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;flex-shrink:0;">${avatarText}</div>
                            <div style="min-width:0;">
                                <h4 style="font-size:13.5px;font-weight:700;color:#ffffff;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${user}</h4>
                                <div style="font-size:11px;color:rgba(255,255,255,0.5);">${time} • <span style="color:#f5b842;">★ ${rating}</span></div>
                            </div>
                        </div>
                        <span style="font-size:11px;font-weight:600;padding:3px 9px;border-radius:8px;background:rgba(36,75,44,0.4);color:#5eead4;border:1px solid rgba(36,75,44,0.6);white-space:nowrap;flex-shrink:0;">${dest}</span>
                    </div>
                    <div style="padding:9px 12px;background:rgba(0,0,0,0.25);border-radius:10px;font-size:12px;line-height:1.45;color:rgba(255,255,255,0.85);font-style:italic;border-left:3px solid #ef4444;max-height:80px;overflow:hidden;">
                        "${comment}"
                    </div>
                </div>
            `;

            openAdminDeleteConfirmModal({
                badge: 'Moderasi Komentar',
                title: 'Hapus Komentar Wisatawan?',
                desc: `Apakah Anda yakin ingin menghapus komentar dari "${user}"?`,
                previewHtml: previewHtml,
                btnText: 'Ya, Hapus Komentar',
                onConfirm: async () => {
                    closeAdminDeleteConfirmModal();
                    if (commentId) {
                        try {
                            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                            await fetch(`/admin/comments/${commentId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrf,
                                    'Accept': 'application/json'
                                }
                            });
                        } catch (err) {
                            console.error('Gagal menghapus komentar dari server:', err);
                        }
                    }
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    setTimeout(() => {
                        row.remove();
                        updateCommentsCount();
                        showAdminToast('Ulasan dari ' + user + ' dihapus.');
                    }, 300);
                }
            });
        }

        function updateCommentsCount() {
            const count = document.querySelectorAll('#admin-comments-tbody tr').length;
            const badge = document.getElementById('admin-table-count');
            if (badge) badge.textContent = count + ' Komentar Pengunjung';
            const pill = document.querySelector('.admin-nav-item[data-nav="ulasan"] .admin-nav-pill');
            if (pill) pill.textContent = count;
        }

        // ===== CLOSE MODALS ON BACKDROP CLICK & INIT ADMIN PROFILE =====
        document.addEventListener('DOMContentLoaded', () => {
            initAdminProfile();
            initAdminAvatarManager();

            ['dest-detail-modal','admin-edit-dest-modal','admin-review-detail-modal','admin-settings-modal','admin-create-dest-modal','admin-delete-confirm-modal'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('click', (e) => {
                    if (e.target === el) {
                        if (id === 'admin-delete-confirm-modal') {
                            closeAdminDeleteConfirmModal();
                        } else {
                            el.classList.remove('show','active');
                            document.body.style.overflow = '';
                            currentEditingCard = null;
                            currentCommentRow = null;
                        }
                    }
                });
            });
        });

        // ===== ESC KEY CLOSES ALL ADMIN MODALS =====
        document.addEventListener('keydown', (e) => {
            if (e.key !== 'Escape') return;
            const confirmModal = document.getElementById('admin-delete-confirm-modal');
            if (confirmModal && confirmModal.classList.contains('show')) {
                closeAdminDeleteConfirmModal();
                return;
            }
            ['dest-detail-modal','admin-edit-dest-modal','admin-review-detail-modal','admin-settings-modal','admin-create-dest-modal'].forEach(id => {
                const el = document.getElementById(id);
                if (el) { el.classList.remove('show','active'); document.body.style.overflow = ''; }
            });
            currentEditingCard = null; currentCommentRow = null;
        });

        // ==============================================
        // IN-PLACE SECTION FILTERING (NO SCROLL, FILTER & HIDE OTHERS)
        // ==============================================
        // State filtering global destinasi admin
        let _currentStatusFilter = 'all';
        let _currentCategoryFilter = 'all';

        // Navigasi Utama Sidebar (Dashboard vs Moderasi Ulasan)
        function handleNavClick(element, type) {
            document.querySelectorAll('.admin-nav-item').forEach(item => item.classList.remove('active'));
            if (element) {
                element.classList.add('active');
            } else {
                const target = document.querySelector(`.admin-nav-item[data-nav="${type}"]`);
                if (target) target.classList.add('active');
            }

            const secStatus     = document.getElementById('admin-status-section');
            const secCategories = document.getElementById('admin-categories-section');
            const secDestinasi  = document.getElementById('admin-destinasi-section');
            const secUlasan     = document.getElementById('admin-table-container');

            if (type === 'all' || type === 'dashboard') {
                if (secStatus)     secStatus.classList.remove('admin-section-hidden');
                if (secCategories) secCategories.classList.remove('admin-section-hidden');
                if (secDestinasi)  secDestinasi.classList.remove('admin-section-hidden');
                if (secUlasan)     secUlasan.classList.remove('admin-section-hidden');

                // Reset filter saat klik Dashboard
                _currentStatusFilter = 'all';
                _currentCategoryFilter = 'all';
                applyDestFilters();
                filterCommentsTable('all');
                showAdminToast('Dashboard: Menampilkan seluruh ringkasan panel');
            } else if (type === 'ulasan') {
                if (secStatus)     secStatus.classList.add('admin-section-hidden');
                if (secCategories) secCategories.classList.add('admin-section-hidden');
                if (secDestinasi)  secDestinasi.classList.add('admin-section-hidden');
                if (secUlasan)     secUlasan.classList.remove('admin-section-hidden');

                filterCommentsTable('all');
                showAdminToast('Moderasi Ulasan: Menampilkan daftar komentar pengunjung');
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

        // Filter Destinasi berdasarkan Status (Post / Draft) - Tetap menampilkan Kategori
        function filterByStatus(status) {
            if (_currentStatusFilter === status) {
                _currentStatusFilter = 'all';
            } else {
                _currentStatusFilter = status;
            }

            // Pastikan Kategori dan Destinasi TIDAK disembunyikan
            const secStatus     = document.getElementById('admin-status-section');
            const secCategories = document.getElementById('admin-categories-section');
            const secDestinasi  = document.getElementById('admin-destinasi-section');

            if (secStatus)     secStatus.classList.remove('admin-section-hidden');
            if (secCategories) secCategories.classList.remove('admin-section-hidden');
            if (secDestinasi)  secDestinasi.classList.remove('admin-section-hidden');

            applyDestFilters();

            if (_currentStatusFilter === 'all') {
                showAdminToast('Menampilkan semua status destinasi');
            } else if (_currentStatusFilter === 'post') {
                showAdminToast('Menampilkan destinasi berstatus Post (Terbit ke Semua)');
            } else if (_currentStatusFilter === 'draft' || _currentStatusFilter === 'pending') {
                showAdminToast('Menampilkan destinasi berstatus Pending (Khusus Admin)');
            }

            if (secDestinasi) {
                secDestinasi.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }

        // Filter Destinasi dari Shortcut Kategori Destinasi Wisata
        function filterByCategory(cat) {
            let filterKey = 'all';
            const catLower = (cat || '').toLowerCase();
            if (catLower.includes('waterfall') || catLower.includes('terjun')) filterKey = 'waterfall';
            else if (catLower.includes('sunset')) filterKey = 'sunset';
            else if (catLower.includes('sunrise')) filterKey = 'sunrise';
            else if (catLower.includes('mountain') || catLower.includes('gunung')) filterKey = 'mountain';
            else if (catLower === 'all' || catLower.includes('semua')) filterKey = 'all';

            if (_currentCategoryFilter === filterKey && filterKey !== 'all') {
                _currentCategoryFilter = 'all';
            } else {
                _currentCategoryFilter = filterKey;
            }

            // Pastikan Kategori dan Destinasi terlihat
            const secCategories = document.getElementById('admin-categories-section');
            const secDestinasi  = document.getElementById('admin-destinasi-section');
            if (secCategories) secCategories.classList.remove('admin-section-hidden');
            if (secDestinasi)  secDestinasi.classList.remove('admin-section-hidden');

            applyDestFilters();

            const catTitle = _currentCategoryFilter === 'all' ? 'Semua Kategori' : cat;
            showAdminToast(`Filter kategori: ${catTitle}`);

            if (secDestinasi) {
                secDestinasi.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // Terapkan Filter Gabungan (Status + Kategori) ke Kartu Destinasi
        function applyDestFilters() {
            // 1. Update status cards active state
            const postCard = document.querySelector('.admin-status-card.stat-card-post');
            const draftCard = document.querySelector('.admin-status-card.stat-card-draft');
            if (postCard) {
                if (_currentStatusFilter === 'post') postCard.classList.add('active');
                else postCard.classList.remove('active');
            }
            if (draftCard) {
                if (_currentStatusFilter === 'draft' || _currentStatusFilter === 'pending') draftCard.classList.add('active');
                else draftCard.classList.remove('active');
            }

            // 2. Update category cards active state
            document.querySelectorAll('.admin-cat-card').forEach(card => {
                const cardCat = card.getAttribute('data-cat') || '';
                if (_currentCategoryFilter === 'all') {
                    if (cardCat === 'all') card.classList.add('active');
                    else card.classList.remove('active');
                } else {
                    if (cardCat === _currentCategoryFilter) card.classList.add('active');
                    else card.classList.remove('active');
                }
            });

            // 3. Filter cards
            const cards = document.querySelectorAll('#admin-cards-container .dash-recom-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const cardCat = (card.dataset.category || '').toLowerCase();
                const cardStatus = (card.dataset.status || 'post').toLowerCase();

                const matchStatus = (_currentStatusFilter === 'all')
                    || (cardStatus === _currentStatusFilter)
                    || ((_currentStatusFilter === 'draft' || _currentStatusFilter === 'pending') && (cardStatus === 'draft' || cardStatus === 'pending'));
                const matchCategory = (_currentCategoryFilter === 'all') || (cardCat === _currentCategoryFilter);

                if (matchStatus && matchCategory) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // 4. Update count badge
            const badge = document.getElementById('admin-dest-count-badge');
            if (badge) {
                let badgeText = `${visibleCount} Destinasi`;
                const statusLabel = _currentStatusFilter === 'post' ? 'Post' : (_currentStatusFilter === 'draft' ? 'Draft' : '');
                const catLabel = _currentCategoryFilter !== 'all' ? (_currentCategoryFilter.charAt(0).toUpperCase() + _currentCategoryFilter.slice(1)) : '';

                if (statusLabel && catLabel) {
                    badgeText = `${visibleCount} Destinasi (${statusLabel} • ${catLabel})`;
                } else if (statusLabel) {
                    badgeText = `${visibleCount} Destinasi (${statusLabel})`;
                } else if (catLabel) {
                    badgeText = `${visibleCount} Destinasi (${catLabel})`;
                }
                badge.textContent = badgeText;
            }
        }

        // Backward compatibility wrapper
        function filterDestCards(filter, clickedBtn) {
            if (filter === 'status-post') {
                filterByStatus('post');
            } else if (filter === 'status-draft') {
                filterByStatus('draft');
            } else {
                filterByCategory(filter);
            }
        }

        // Filter Table Rows in Moderasi Ulasan
        function filterCommentsTable(cat, clickedBtn) {
            if (clickedBtn) {
                document.querySelectorAll('.admin-table-filters .admin-tab-btn').forEach(btn => btn.classList.remove('active'));
                clickedBtn.classList.add('active');
            } else {
                document.querySelectorAll('.admin-table-filters .admin-tab-btn').forEach(btn => {
                    const fn = btn.getAttribute('onclick') || '';
                    if (fn.includes(`'${cat}'`)) btn.classList.add('active');
                    else btn.classList.remove('active');
                });
            }

            const rows = document.querySelectorAll('#admin-comments-tbody tr');
            let count = 0;

            rows.forEach(row => {
                const rowCat = row.dataset.category;
                const isMatch = (cat === 'all') || (rowCat === cat);

                if (isMatch) {
                    row.style.display = '';
                    count++;
                } else {
                    row.style.display = 'none';
                }
            });

            const badge = document.getElementById('admin-table-count');
            if (badge) badge.textContent = `${count} Komentar Pengunjung`;
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
                initAdminHourSelects();
                updateTimePreviews();
                modal.classList.add('show', 'active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeAdminCreateModal() {
            const modal = document.getElementById('admin-create-dest-modal');
            if (modal) {
                modal.classList.remove('show', 'active');
                document.body.style.overflow = '';
            }
        }

        // ===== FILE UPLOAD & PREVIEWS FOR CREATE MODAL =====
        let uploadedPhotos = { main: '', thumb1: '', thumb2: '', thumb3: '' };
        let uploadedPhotoFiles = { main: null, thumb1: null, thumb2: null, thumb3: null };

        function handleAdminPhotoFile(event, slot) {
            const file = event.target.files && event.target.files[0];
            if (!file) return;
            uploadedPhotoFiles[slot] = file;

            const reader = new FileReader();
            reader.onload = function(e) {
                const dataUrl = e.target.result;
                uploadedPhotos[slot] = dataUrl;

                if (slot === 'main') {
                    const pMain = document.getElementById('create-preview-img-main');
                    if (pMain) pMain.src = dataUrl;

                    // Fill remaining thumbs with main photo if not yet set
                    ['thumb1', 'thumb2', 'thumb3'].forEach(t => {
                        if (!uploadedPhotos[t]) {
                            const pThumb = document.getElementById('create-preview-img-' + t);
                            if (pThumb) pThumb.src = dataUrl;
                        }
                    });

                    const labelEl = document.getElementById('dest-file-main-name');
                    if (labelEl) labelEl.textContent = '✓ File terpilih: ' + file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
                } else {
                    const pThumb = document.getElementById('create-preview-img-' + slot);
                    if (pThumb) pThumb.src = dataUrl;
                    const labelEl = document.getElementById('dest-file-' + slot + '-name');
                    if (labelEl) labelEl.textContent = '✓ ' + file.name;
                }
            };
            reader.readAsDataURL(file);
        }

        function resetCreateModalPhotos() {
            uploadedPhotos = { main: '', thumb1: '', thumb2: '', thumb3: '' };
            uploadedPhotoFiles = { main: null, thumb1: null, thumb2: null, thumb3: null };
            const defaultImg = '/images/waterfall.jpg';
            ['main', 'thumb1', 'thumb2', 'thumb3'].forEach(k => {
                const img = document.getElementById('create-preview-img-' + k);
                if (img) img.src = defaultImg;
            });
            const mainLabel = document.getElementById('dest-file-main-name');
            if (mainLabel) mainLabel.textContent = 'Klik di sini untuk memilih file gambar dari file komputer (JPG, PNG, WEBP)';
            ['thumb1', 'thumb2', 'thumb3'].forEach(k => {
                const l = document.getElementById('dest-file-' + k + '-name');
                if (l) l.textContent = '+ Upload dari File';
            });
            const fMain = document.getElementById('dest-file-main');
            if (fMain) fMain.value = '';
            ['thumb1', 'thumb2', 'thumb3'].forEach(k => {
                const f = document.getElementById('dest-file-' + k);
                if (f) f.value = '';
            });
        }

        // ===== TIME PREVIEW HELPER (JAM, MENIT, ZONA WAKTU) =====
        function updateTimePreviews() {
            const openH = document.getElementById('dest-time-open-h')?.value || '06';
            const openM = document.getElementById('dest-time-open-m')?.value || '30';
            const closeH = document.getElementById('dest-time-close-h')?.value || '18';
            const closeM = document.getElementById('dest-time-close-m')?.value || '00';
            const tz = document.getElementById('dest-time-tz')?.value || 'WITA';

            const badgeTime = document.getElementById('preview-time-badge');
            if (badgeTime) {
                badgeTime.textContent = `${openH}:${openM} – ${closeH}:${closeM} ${tz}`;
            }

            const startH = document.getElementById('dest-best-start-h')?.value || '07';
            const startM = document.getElementById('dest-best-start-m')?.value || '00';
            const endH = document.getElementById('dest-best-end-h')?.value || '09';
            const endM = document.getElementById('dest-best-end-m')?.value || '30';
            const bestTz = document.getElementById('dest-best-tz')?.value || 'WITA';
            const cond = document.getElementById('dest-best-condition')?.value || '';

            const badgeBest = document.getElementById('preview-best-badge');
            if (badgeBest) {
                badgeBest.textContent = `${startH}:${startM} – ${endH}:${endM} ${bestTz}` + (cond ? ` ${cond}` : '');
            }
        }

        // Initialize hour options for 24-hour picker
        function initAdminHourSelects() {
            const populate = (id, def) => {
                const el = document.getElementById(id);
                if (!el || el.children.length > 10) return;
                el.innerHTML = '';
                for (let h = 0; h < 24; h++) {
                    const val = String(h).padStart(2, '0');
                    const opt = document.createElement('option');
                    opt.value = val;
                    opt.textContent = val;
                    if (val === String(def).padStart(2, '0')) opt.selected = true;
                    el.appendChild(opt);
                }
            };
            populate('dest-time-open-h', '06');
            populate('dest-time-close-h', '18');
            populate('dest-best-start-h', '07');
            populate('dest-best-end-h', '09');
            updateTimePreviews();
        }
        document.addEventListener('DOMContentLoaded', initAdminHourSelects);

        // Handle Add New Destination Form Submit (Synced with User Destination View)
        async function handleAdminAddDest(event) {
            event.preventDefault();
            const name = document.getElementById('dest-input-name')?.value.trim();
            const cat = document.getElementById('dest-input-category')?.value || 'Waterfall';
            const location = document.getElementById('dest-input-location')?.value.trim() || 'Bali';
            const ticket = document.getElementById('dest-input-ticket')?.value.trim() || 'Rp 25.000 / orang';
            const tags = document.getElementById('dest-input-tags')?.value.trim() || '';
            const desc = document.getElementById('dest-input-desc')?.value.trim() || '';
            const gmaps = document.getElementById('dest-input-gmaps')?.value.trim() || '';
            const status = document.getElementById('dest-input-status')?.value || 'post';

            if (!name) return;

            // Automatic time calculations from dropdowns (Jam, Menit, Zona Waktu)
            const openH = document.getElementById('dest-time-open-h')?.value || '06';
            const openM = document.getElementById('dest-time-open-m')?.value || '30';
            const closeH = document.getElementById('dest-time-close-h')?.value || '18';
            const closeM = document.getElementById('dest-time-close-m')?.value || '00';
            const tz = document.getElementById('dest-time-tz')?.value || 'WITA';
            const time = `${openH}:${openM} – ${closeH}:${closeM} ${tz}`;

            // Automatic best visit calculation from dropdowns (Jam, Menit, Zona Waktu, Kondisi)
            const startH = document.getElementById('dest-best-start-h')?.value || '07';
            const startM = document.getElementById('dest-best-start-m')?.value || '00';
            const endH = document.getElementById('dest-best-end-h')?.value || '09';
            const endM = document.getElementById('dest-best-end-m')?.value || '30';
            const bestTz = document.getElementById('dest-best-tz')?.value || 'WITA';
            const cond = document.getElementById('dest-best-condition')?.value || '';
            const bestVisit = `${startH}:${startM} – ${endH}:${endM} ${bestTz}` + (cond ? ` ${cond}` : '');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const formData = new FormData();
            formData.append('name', name);
            formData.append('category', cat);
            formData.append('description', desc);
            formData.append('price', ticket);
            formData.append('status', status);
            if (uploadedPhotoFiles.main) {
                formData.append('image', uploadedPhotoFiles.main);
            }

            try {
                const response = await fetch('/admin/destinations', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const result = await response.json();
                if (!response.ok) {
                    showAdminToast(result.message || 'Gagal menyimpan ke database.', '✕');
                    return;
                }

                const newDest = result.destination;
                const destId = newDest.id;
                const resolvedImg = newDest.image_url || uploadedPhotos.main || '/images/waterfall.jpg';
                const formattedPrice = newDest.formatted_price || ticket;

                // Normalize category key
                let catKey = 'waterfall';
                if (cat === 'Sunset Beach' || cat.toLowerCase().includes('sunset')) catKey = 'sunset';
                else if (cat === 'Sunrise Beach' || cat.toLowerCase().includes('sunrise')) catKey = 'sunrise';
                else if (cat === 'Mountain' || cat.toLowerCase().includes('mountain')) catKey = 'mountain';

                // Create new destination card in #admin-cards-container
                const container = document.getElementById('admin-cards-container');
                if (container) {
                    const emptyState = container.querySelector('.admin-empty-state');
                    if (emptyState) emptyState.remove();

                    const card = document.createElement('div');
                    card.className = 'dash-recom-card';
                    card.dataset.id = destId;
                    card.dataset.category = catKey;
                    card.dataset.status = status;
                    card.dataset.key = destId;
                    card.dataset.title = name;
                    card.dataset.desc = desc;
                    card.dataset.time = time;
                    card.dataset.ticket = formattedPrice;
                    card.dataset.price = newDest.price;
                    card.dataset.loc = location;
                    card.dataset.rating = '5.0';
                    card.dataset.bestVisit = bestVisit;
                    card.dataset.tags = tags || `${cat}, Bali, Spot Foto`;
                    card.dataset.gmaps = gmaps || `https://maps.google.com/?q=${encodeURIComponent(name + ' Bali')}`;
                    card.dataset.thumb1 = resolvedImg;
                    card.dataset.thumb2 = resolvedImg;
                    card.dataset.thumb3 = resolvedImg;

                    const isPending = (status === 'pending' || status === 'draft');
                    const statusPillClass = isPending ? 'badge-status-draft' : 'badge-status-post';
                    const statusPillText  = isPending ? '● Pending (Admin Only)' : '● Post (Publik)';
                    const statusPillStyle = isPending ? 'style="background: rgba(234, 179, 8, 0.2); color: #facc15; border: 1px solid rgba(234, 179, 8, 0.35);"' : '';
                    const badgeClass = catKey === 'sunset' ? 'badge-sunset' : (catKey === 'sunrise' ? 'badge-sunrise' : (catKey === 'mountain' ? 'badge-mountain' : ''));

                    card.innerHTML = `
                        <div class="dash-recom-img-wrap">
                            <img src="${resolvedImg}" alt="${name}" class="dash-recom-img" loading="lazy">
                            <span class="dash-recom-badge ${badgeClass}">${cat}</span>
                            <span class="admin-card-status-pill ${statusPillClass}" ${statusPillStyle}>${statusPillText}</span>
                        </div>
                        <div class="dash-recom-body">
                            <h3 class="dash-recom-card-title">${name}</h3>
                            <p class="dash-recom-card-desc">${desc}</p>
                            <div class="dash-recom-footer">
                                <button type="button" class="dash-btn-lihat" aria-label="Detail" onclick="openAdminSpotDetail('${destId}', this)">Detail</button>
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
                    `;

                    container.prepend(card);
                    updateDestCounts();
                }

                closeAdminCreateModal();
                document.getElementById('admin-add-dest-form')?.reset();
                resetCreateModalPhotos();
                showAdminToast(`Destinasi "${name}" berhasil disimpan ke database dewasufa! 🌿`);

                // Scroll to destination section
                const secDest = document.getElementById('admin-destinasi-section');
                if (secDest) {
                    secDest.classList.remove('admin-section-hidden');
                    setTimeout(() => secDest.scrollIntoView({ behavior: 'smooth', block: 'start' }), 100);
                }
            } catch (err) {
                console.error(err);
                showAdminToast('Terjadi gangguan saat menyimpan ke database.', '✕');
            }
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
