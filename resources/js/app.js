/**
 * Dewasufa - Eksplorasi Keindahan Alam Bali
 * JavaScript Logic & Interactions
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

// Modal Login
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

// Destination Modal
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

// Toast Notification
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

// Form Login Submit
export function handleLoginSubmit(event) {
    if (event) event.preventDefault();
    const emailEl = document.getElementById('login-email');
    const email = emailEl ? emailEl.value : '';
    closeLoginModal();
    const username = email ? email.split('@')[0] : 'Pengguna';
    showToast(`Selamat datang kembali, ${username}! Anda berhasil masuk.`);
}

// Social Login Simulation
export function simulateGoogleLogin() {
    closeLoginModal();
    showToast('Login dengan akun Google berhasil disimulasikan!');
}

// Filter Category Cards
export function filterCards(category, clickedButton) {
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
export function handleSearch(event) {
    if (event) event.preventDefault();
    const keywordEl = document.getElementById('search-keyword');
    const categoryEl = document.getElementById('search-category');
    const keyword = keywordEl ? keywordEl.value.toLowerCase().trim() : '';
    const category = categoryEl ? categoryEl.value : 'all';

    // Scroll to categories section
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

// Expose functions globally to window for any inline Blade onclick/onsubmit attributes
Object.assign(window, {
    categoryData,
    openLoginModal,
    closeLoginModal,
    openDestModal,
    closeDestModal,
    showToast,
    handleLoginSubmit,
    simulateGoogleLogin,
    filterCards,
    handleSearch,
});

// Setup DOM Event Listeners
function initApp() {
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

    // Navbar scrolled shadow
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 40) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }, { passive: true });
    }

    // ESC Key Close Modals
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeLoginModal();
            closeDestModal();
        }
    });
}

// Initialize when DOM is loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initApp);
} else {
    initApp();
}
