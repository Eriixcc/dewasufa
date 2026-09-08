/**
 * Dewasufa - Eksplorasi Keindahan Alam Bali
 * JavaScript Logic & Interactions (Public Site & User Dashboard)
 */

// Data 4 Kategori Wisata Alam Bali
export const categoryData = {
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

// ==========================================
// PUBLIC SITE: MODAL & INTERACTION
// ==========================================

export function openLoginModal() {
    const loginModal = document.getElementById('login-modal');
    if (!loginModal) return;
    loginModal.classList.add('active');
    document.body.style.overflow = 'hidden';
    setTimeout(() => {
        const input = document.getElementById('login-email');
        if (input) input.focus();
    }, 100);
}

export function closeLoginModal() {
    const loginModal = document.getElementById('login-modal');
    if (!loginModal) return;
    loginModal.classList.remove('active');
    document.body.style.overflow = '';
}

export function openDestModal(categoryKey) {
    const data = categoryData[categoryKey];
    if (!data) return;

    const titleEl = document.getElementById('dest-modal-title');
    const subtitleEl = document.getElementById('dest-modal-subtitle');
    const badgeEl = document.getElementById('dest-modal-badge');
    const imageEl = document.getElementById('dest-modal-image');
    const container = document.getElementById('dest-spots-container');
    const destModal = document.getElementById('dest-modal');

    if (titleEl) titleEl.textContent = data.title;
    if (subtitleEl) subtitleEl.textContent = data.subtitle;
    if (badgeEl) badgeEl.textContent = data.badge;
    if (imageEl) imageEl.src = data.image;

    if (container) {
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
    }

    if (destModal) {
        destModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

export function closeDestModal() {
    const destModal = document.getElementById('dest-modal');
    if (!destModal) return;
    destModal.classList.remove('active');
    document.body.style.overflow = '';
}

// Global Toast Notification
export function showToast(message, icon = '✓') {
    const toast = document.getElementById('toast-alert');
    const toastText = document.getElementById('toast-text');
    const toastIcon = document.getElementById('toast-icon');

    if (!toast || !toastText || !toastIcon) return;

    toastText.textContent = message;
    toastIcon.textContent = icon;
    toast.classList.add('show');

    setTimeout(() => {
        toast.classList.remove('show');
    }, 3500);
}

// Form Login Submit: Simulates Auth and redirects to /dashboard
export function handleLoginSubmit(event) {
    if (event) event.preventDefault();
    const emailEl = document.getElementById('login-email');
    const email = emailEl ? emailEl.value : '';
    const username = email ? email.split('@')[0] : 'Wisatawan Bali';
    sessionStorage.setItem('dewasufa_user', username);
    closeLoginModal();
    showToast(`Selamat datang, ${username}! Mengalihkan ke dashboard...`, '🌿');
    setTimeout(() => {
        window.location.href = '/dashboard';
    }, 600);
}

// Social Google Login Simulation
export function simulateGoogleLogin() {
    sessionStorage.setItem('dewasufa_user', 'Arya Wisatawan');
    closeLoginModal();
    showToast('Login berhasil! Mengalihkan ke dashboard...', '🌿');
    setTimeout(() => {
        window.location.href = '/dashboard';
    }, 600);
}

// Filter Category Cards on Public Page
export function filterCards(category, clickedButton) {
    document.querySelectorAll('.filter-tab-btn').forEach(btn => btn.classList.remove('active'));
    if (clickedButton) {
        clickedButton.classList.add('active');
    } else {
        const targetBtn = document.querySelector(`.filter-tab-btn[data-filter="${category}"]`);
        if (targetBtn) targetBtn.classList.add('active');
    }

    const dots = document.querySelectorAll('.pagination-dot');
    dots.forEach(d => d.classList.remove('active'));
    const catIndex = ['all', 'waterfall', 'sunset', 'sunrise', 'mountain'].indexOf(category);
    if (catIndex !== -1 && dots[catIndex]) {
        dots[catIndex].classList.add('active');
    }

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

// Floating Pill Search Handler on Public Page
export function handleSearch(event) {
    if (event) event.preventDefault();
    const keywordEl = document.getElementById('search-keyword');
    const categoryEl = document.getElementById('search-category');
    const keyword = keywordEl ? keywordEl.value.toLowerCase().trim() : '';
    const category = categoryEl ? categoryEl.value : 'all';

    const catSection = document.getElementById('categories');
    if (catSection) catSection.scrollIntoView({ behavior: 'smooth' });

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

// ==========================================
// USER DASHBOARD LOGIC & SLIDER
// ==========================================

export const dashboardSlides = [
    {
        trend: "Trending Destinasi Minggu Ini",
        tags: ["💧 Waterfall", "Buleleng, Bali"],
        title: "Sekumpul Hidden Falls: Mahakarya Tersembunyi Bali Utara",
        desc: "Keanggunan tujuh tingkatan air terjun di lembah tropis yang asri. Nikmati udara murni, pemandangan rimba hijau, serta panduan trekking lengkap bersama pemandu lokal berlisensi.",
        image: "/images/air terjun sekumpul.png",
        fallback: "/images/waterfall.jpg"
    },
    {
        trend: "Sunset Terbaik 2026",
        tags: ["🌇 Sunset Beach", "Badung, Bali"],
        title: "Pantai Melasti Ungasan: Tebing Kapur & Sunset Magis",
        desc: "Pesona tebing kapur putih menjulang tinggi dengan hamparan pasir putih bersih dan panorama matahari terbenam yang memukau di ujung selatan Pulau Dewata.",
        image: "/images/sunset-beach.jpg",
        fallback: "/images/sunset-beach.jpg"
    },
    {
        trend: "Petualangan Fajar Puncak",
        tags: ["⛰️ Mountain", "Kintamani, Bali"],
        title: "Gunung Batur Trekking: Lautan Awan Spektakuler",
        desc: "Sensasi mendaki di keheningan dini hari menyambut mentari terbit di puncak kaldera aktif dengan panorama memukau danau Batur dan siluet Gunung Abang.",
        image: "/images/mountain.jpg",
        fallback: "/images/mountain.jpg"
    },
    {
        trend: "Ketenangan Pesisir Timur",
        tags: ["🌅 Sunrise Beach", "Denpasar, Bali"],
        title: "Pantai Sanur: Panorama Mentari Pagi nan Teduh",
        desc: "Suasana fajar yang damai ditemani jajaran perahu jukung tradisional dan gazebo klasik tepi laut dengan tiupan angin sejuk yang menenangkan jiwa.",
        image: "/images/sunrise-beach.jpg",
        fallback: "/images/sunrise-beach.jpg"
    }
];

let currentSlideIndex = 0;

export function showDashboardSlide(index) {
    const banner = document.getElementById('dash-featured-banner');
    if (!banner) return;

    if (index < 0) {
        currentSlideIndex = dashboardSlides.length - 1;
    } else if (index >= dashboardSlides.length) {
        currentSlideIndex = 0;
    } else {
        currentSlideIndex = index;
    }

    const slide = dashboardSlides[currentSlideIndex];
    const trendEl = document.getElementById('dash-featured-trend');
    const tagsEl = document.getElementById('dash-featured-tags');
    const titleEl = document.getElementById('dash-featured-title');
    const descEl = document.getElementById('dash-featured-desc');
    const imgEl = document.getElementById('dash-featured-img');

    if (trendEl) trendEl.textContent = slide.trend;
    if (titleEl) titleEl.textContent = slide.title;
    if (descEl) descEl.textContent = slide.desc;

    if (tagsEl) {
        tagsEl.innerHTML = slide.tags.map(t => `<span class="dash-hero-tag">${t}</span>`).join('');
    }

    if (imgEl) {
        imgEl.style.backgroundImage = `url('${slide.image}'), url('${slide.fallback || slide.image}')`;
    }
}

export function addToRecentlyViewed(name, category = 'waterfall') {
    const historyContainer = document.getElementById('dash-history-container');
    if (!historyContainer) return;

    const iconMap = {
        waterfall: { icon: '💧', cls: 'bg-forest' },
        sunset: { icon: '🌇', cls: 'bg-sunset' },
        sunrise: { icon: '🌅', cls: 'bg-warm' },
        mountain: { icon: '⛰️', cls: 'bg-emerald' }
    };
    const conf = iconMap[category] || iconMap.waterfall;

    const item = document.createElement('div');
    item.className = 'dash-history-item';
    item.innerHTML = `
        <div class="dash-history-icon-wrap ${conf.cls}">
            <span>${conf.icon}</span>
        </div>
        <div class="dash-history-info">
            <h4>${name}</h4>
            <span class="dash-history-time">🕒 Baru saja dilihat</span>
        </div>
        <button type="button" class="dash-circle-mini-btn" aria-label="Kunjungi Lagi">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <polygon points="5 3 19 12 5 21 5 3"></polygon>
            </svg>
        </button>
    `;
    item.addEventListener('click', () => {
        showToast(`Membuka riwayat: ${name}`, '📍');
    });

    historyContainer.prepend(item);
}

export function openDashSpotDetail(key) {
    const spotMap = {
        sekumpul: { name: 'Air Terjun Sekumpul (Buleleng)', cat: 'waterfall' },
        waterfall: { name: 'Air Terjun Tegenungan (Gianyar)', cat: 'waterfall' },
        sunset: { name: 'Pantai Melasti & Tanah Lot (Sunset Point)', cat: 'sunset' },
        sunrise: { name: 'Pantai Sanur (Sunrise Point)', cat: 'sunrise' },
        mountain: { name: 'Gunung Batur (Kaldera Kintamani)', cat: 'mountain' }
    };
    const spot = spotMap[key] || { name: key, cat: 'waterfall' };
    addToRecentlyViewed(spot.name, spot.cat);
    showToast(`Membuka rute dan panduan: ${spot.name}`, '📍');
}

// Modal Buat Destinasi Baru
export function openCreateDestModal() {
    const modal = document.getElementById('create-dest-modal');
    if (!modal) return;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    setTimeout(() => {
        const input = document.getElementById('new-dest-name');
        if (input) input.focus();
    }, 100);
}

export function closeCreateDestModal() {
    const modal = document.getElementById('create-dest-modal');
    if (!modal) return;
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

export function handleCreateDestSubmit(event) {
    if (event) event.preventDefault();

    const name = document.getElementById('new-dest-name')?.value.trim() || 'Destinasi Baru';
    const category = document.getElementById('new-dest-category')?.value || 'waterfall';
    const location = document.getElementById('new-dest-location')?.value.trim() || 'Bali';
    const time = document.getElementById('new-dest-time')?.value.trim() || '08:00 - 17:00 WITA';
    const desc = document.getElementById('new-dest-desc')?.value.trim() || '';

    const selectedPreset = document.querySelector('input[name="new-dest-preset-img"]:checked')?.value || '/images/waterfall.jpg';

    const categoryBadges = {
        waterfall: { label: '💧 Waterfall', cls: '' },
        sunset: { label: '🌇 Sunset Beach', cls: 'badge-sunset' },
        sunrise: { label: '🌅 Sunrise Beach', cls: 'badge-sunrise' },
        mountain: { label: '⛰️ Mountain', cls: 'badge-mountain' }
    };

    const catInfo = categoryBadges[category] || categoryBadges.waterfall;

    // 1. Prepend to "Destinasi Baru Rilis" widget container
    const newSpotsContainer = document.getElementById('dash-new-spots-container');
    if (newSpotsContainer) {
        const newSpotCard = document.createElement('div');
        newSpotCard.className = 'dash-mini-spot-card';
        newSpotCard.innerHTML = `
            <img src="${selectedPreset}" alt="${name}" class="dash-mini-img">
            <div class="dash-mini-info">
                <span class="dash-badge-launch">✨ Baru Dibuat</span>
                <span class="dash-mini-title">${name} (${location})</span>
            </div>
            <button type="button" class="dash-circle-btn" aria-label="Lihat Rute">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                </svg>
            </button>
        `;
        newSpotCard.addEventListener('click', () => {
            showToast(`Membuka spot buatan Anda: ${name}`, '📍');
        });
        newSpotsContainer.prepend(newSpotCard);
    }

    // 2. Prepend to "Rekomendasi Untuk Anda" grid
    const recomGrid = document.getElementById('dash-recom-grid');
    if (recomGrid) {
        const recomCard = document.createElement('div');
        recomCard.className = 'dash-recom-card';
        recomCard.dataset.category = category;
        recomCard.innerHTML = `
            <div class="dash-recom-img-wrap">
                <img src="${selectedPreset}" alt="${name}" class="dash-recom-img">
                <span class="dash-recom-badge ${catInfo.cls}">${catInfo.label}</span>
                <button type="button" class="dash-recom-more-btn" aria-label="Opsi">•••</button>
            </div>
            <div class="dash-recom-body">
                <h3 class="dash-recom-card-title">${name}</h3>
                <p class="dash-recom-card-desc">${desc || location}</p>
                <div class="dash-recom-footer">
                    <span class="dash-recom-time">⏱ ${time}</span>
                    <button type="button" class="dash-circle-btn" aria-label="Buka Spot">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                    </button>
                </div>
            </div>
        `;
        recomCard.addEventListener('click', () => {
            showToast(`Membuka spot buatan Anda: ${name}`, '📍');
        });
        recomGrid.prepend(recomCard);
    }

    // 3. Add to recently viewed history
    addToRecentlyViewed(name, category);

    // Close & reset
    closeCreateDestModal();
    const form = document.getElementById('create-dest-form');
    if (form) form.reset();

    showToast(`Destinasi "${name}" berhasil dibuat dan ditambahkan ke web!`, '✨');
}

// Expose functions globally to window
Object.assign(window, {
    categoryData,
    dashboardSlides,
    openLoginModal,
    closeLoginModal,
    openDestModal,
    closeDestModal,
    showToast,
    handleLoginSubmit,
    simulateGoogleLogin,
    filterCards,
    handleSearch,
    showDashboardSlide,
    openDashSpotDetail,
    openCreateDestModal,
    closeCreateDestModal,
    handleCreateDestSubmit,
    addToRecentlyViewed,
});

// Setup DOM Event Listeners
function initApp() {
    // 1. PUBLIC LANDING PAGE LISTENERS
    const btnOpenLogin = document.getElementById('btn-open-login');
    const btnCloseLogin = document.getElementById('btn-close-login');
    const loginModal = document.getElementById('login-modal');
    const destModal = document.getElementById('dest-modal');
    const btnQuickSearch = document.getElementById('btn-quick-search');
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const navMenu = document.getElementById('nav-menu');
    const navbar = document.getElementById('navbar');

    if (btnOpenLogin) btnOpenLogin.addEventListener('click', openLoginModal);
    if (btnCloseLogin) btnCloseLogin.addEventListener('click', closeLoginModal);

    if (loginModal) {
        loginModal.addEventListener('click', (e) => {
            if (e.target === loginModal) closeLoginModal();
        });
    }

    if (destModal) {
        destModal.addEventListener('click', (e) => {
            if (e.target === destModal) closeDestModal();
        });
    }

    if (btnQuickSearch) {
        btnQuickSearch.addEventListener('click', () => {
            const input = document.getElementById('search-keyword');
            if (input) {
                input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                setTimeout(() => input.focus(), 400);
            }
        });
    }

    if (hamburgerBtn && navMenu) {
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
    }

    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 40) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }, { passive: true });
    }

    // 2. USER DASHBOARD LISTENERS
    const dashDisplayName = document.getElementById('dash-display-name');
    if (dashDisplayName) {
        const savedUser = sessionStorage.getItem('dewasufa_user');
        if (savedUser) {
            dashDisplayName.textContent = savedUser;
        }
    }

    // User Dropdown Menu
    const userMenuBtn = document.getElementById('dash-user-menu-btn');
    const userDropdown = document.getElementById('dash-user-dropdown');
    if (userMenuBtn && userDropdown) {
        userMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = userDropdown.classList.toggle('show');
            userMenuBtn.setAttribute('aria-expanded', isOpen);
        });

        document.addEventListener('click', () => {
            userDropdown.classList.remove('show');
            userMenuBtn.setAttribute('aria-expanded', 'false');
        });
    }

    // Dashboard Logout Button
    const btnLogout = document.getElementById('dash-btn-logout');
    if (btnLogout) {
        btnLogout.addEventListener('click', () => {
            sessionStorage.removeItem('dewasufa_user');
        });
    }

    // Slider Controls
    const btnPrev = document.getElementById('dash-slider-prev');
    const btnNext = document.getElementById('dash-slider-next');
    if (btnPrev && btnNext) {
        btnPrev.addEventListener('click', () => showDashboardSlide(currentSlideIndex - 1));
        btnNext.addEventListener('click', () => showDashboardSlide(currentSlideIndex + 1));
    }

    // Bookmark Action
    const btnBookmark = document.getElementById('dash-hero-btn-bookmark');
    if (btnBookmark) {
        btnBookmark.addEventListener('click', () => {
            const isBookmarked = btnBookmark.classList.toggle('active');
            const currentTitle = dashboardSlides[currentSlideIndex]?.title || 'Destinasi';
            if (isBookmarked) {
                showToast(`"${currentTitle}" disimpan ke favorit Anda!`, '⭐');
            } else {
                showToast('Dihapus dari daftar favorit.', 'ℹ');
            }
        });
    }

    // Hero Action Buttons
    const btnStart = document.getElementById('dash-hero-btn-start');
    const btnGuide = document.getElementById('dash-hero-btn-guide');
    if (btnStart) {
        btnStart.addEventListener('click', () => {
            const currentTitle = dashboardSlides[currentSlideIndex]?.title || 'Destinasi';
            showToast(`Memulai panduan navigasi rute: ${currentTitle}`, '🧭');
        });
    }
    if (btnGuide) {
        btnGuide.addEventListener('click', () => {
            const currentTitle = dashboardSlides[currentSlideIndex]?.title || 'Destinasi';
            showToast(`Membuka buku panduan lengkap: ${currentTitle}`, '📖');
        });
    }

    // Dashboard Category Filter Pills
    const dashCatPills = document.querySelectorAll('.dash-cat-pill');
    if (dashCatPills.length > 0) {
        dashCatPills.forEach(pill => {
            pill.addEventListener('click', () => {
                dashCatPills.forEach(p => p.classList.remove('active'));
                pill.classList.add('active');

                const filter = pill.dataset.filter;
                const cards = document.querySelectorAll('.dash-recom-card');
                let count = 0;

                cards.forEach(card => {
                    if (filter === 'all' || card.dataset.category === filter) {
                        card.style.display = 'flex';
                        count++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (filter !== 'all') {
                    showToast(`Menampilkan rekomendasi kategori: ${pill.textContent}`, '🔍');
                }
            });
        });
    }

    // Dashboard Search Input
    const dashSearchInput = document.getElementById('dash-search-input');
    if (dashSearchInput) {
        dashSearchInput.addEventListener('input', (e) => {
            const q = e.target.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.dash-recom-card');
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = (!q || text.includes(q)) ? 'flex' : 'none';
            });
        });
    }

    // Notification button
    const btnNotif = document.getElementById('btn-dash-notif');
    if (btnNotif) {
        btnNotif.addEventListener('click', () => {
            showToast('Anda memiliki 3 pembaruan rute dan tips wisata baru hari ini!', '🔔');
        });
    }

    // Clear History button
    const btnClearHistory = document.getElementById('btn-clear-history');
    if (btnClearHistory) {
        btnClearHistory.addEventListener('click', () => {
            const histContainer = document.getElementById('dash-history-container');
            if (histContainer) histContainer.innerHTML = '';
            showToast('Riwayat penelusuran berhasil dibersihkan.', '🧹');
        });
    }

    // Open Create Destination Modal (From Dropdown & Sidebar)
    const btnOpenCreate = document.getElementById('dash-btn-open-create');
    const btnQuickCreate = document.getElementById('btn-quick-create-spot');
    const btnCloseCreate = document.getElementById('btn-close-create-dest');
    const btnCancelCreate = document.getElementById('btn-cancel-create-dest');
    const createModal = document.getElementById('create-dest-modal');

    if (btnOpenCreate) {
        btnOpenCreate.addEventListener('click', () => {
            if (userDropdown) userDropdown.classList.remove('show');
            openCreateDestModal();
        });
    }

    if (btnQuickCreate) {
        btnQuickCreate.addEventListener('click', openCreateDestModal);
    }

    if (btnCloseCreate) btnCloseCreate.addEventListener('click', closeCreateDestModal);
    if (btnCancelCreate) btnCancelCreate.addEventListener('click', closeCreateDestModal);

    if (createModal) {
        createModal.addEventListener('click', (e) => {
            if (e.target === createModal) closeCreateDestModal();
        });
    }

    // Preset Image Selector in Modal
    const presetLabels = document.querySelectorAll('.dash-preset-label');
    presetLabels.forEach(label => {
        const radio = label.querySelector('input[type="radio"]');
        if (radio) {
            radio.addEventListener('change', () => {
                presetLabels.forEach(l => l.classList.remove('active'));
                if (radio.checked) label.classList.add('active');
            });
        }
    });

    // ESC Key Close Modals
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeLoginModal();
            closeDestModal();
            closeCreateDestModal();
            if (userDropdown) userDropdown.classList.remove('show');
        }
    });
}

// Initialize when DOM is loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initApp);
} else {
    initApp();
}
