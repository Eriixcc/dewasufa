/**
 * Dewasufa - Eksplorasi Keindahan Alam Bali
 * JavaScript Logic & Interactions (Public Site & User Dashboard)
 */

// Data 4 Kategori Wisata Alam Bali
export const categoryData = {
    waterfall: {
        title: "Spot Unggulan Waterfall (Air Terjun) Bali",
        subtitle: "Suara gemuruh air sejuk berpadu dengan ketenangan hutan tropis",
        badge: "Waterfall Bali",
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
        badge: "Sunset Beach Bali",
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
        badge: "Sunrise Beach Bali",
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
        badge: "Mountain Bali",
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
    showToast(`Selamat datang, ${username}! Mengalihkan ke dashboard...`, '');
    setTimeout(() => {
        window.location.href = '/dashboard';
    }, 600);
}

// Social Google Login Simulation
export function simulateGoogleLogin() {
    sessionStorage.setItem('dewasufa_user', 'Arya Wisatawan');
    closeLoginModal();
    showToast('Login berhasil! Mengalihkan ke dashboard...', '');
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
        key: "sekumpul",
        trend: "Trending Destinasi Minggu Ini",
        tags: ["Waterfall", "Buleleng, Bali"],
        title: "Sekumpul Hidden Falls: Mahakarya Tersembunyi Bali Utara",
        desc: "Keanggunan tujuh tingkatan air terjun di lembah tropis yang asri. Nikmati udara murni, pemandangan rimba hijau, serta panduan trekking lengkap bersama pemandu lokal berlisensi.",
        image: "/images/air terjun sekumpul.png",
        fallback: "/images/waterfall.jpg"
    },
    {
        key: "sunset",
        trend: "Sunset Terbaik 2026",
        tags: ["Sunset Beach", "Badung, Bali"],
        title: "Pantai Melasti Ungasan: Tebing Kapur & Sunset Magis",
        desc: "Pesona tebing kapur putih menjulang tinggi dengan hamparan pasir putih bersih dan panorama matahari terbenam yang memukau di ujung selatan Pulau Dewata.",
        image: "/images/sunset-beach.jpg",
        fallback: "/images/sunset-beach.jpg"
    },
    {
        key: "mountain",
        trend: "Petualangan Fajar Puncak",
        tags: ["Mountain", "Kintamani, Bali"],
        title: "Gunung Batur Trekking: Lautan Awan Spektakuler",
        desc: "Sensasi mendaki di keheningan dini hari menyambut mentari terbit di puncak kaldera aktif dengan panorama memukau danau Batur dan siluet Gunung Abang.",
        image: "/images/mountain.jpg",
        fallback: "/images/mountain.jpg"
    },
    {
        key: "sunrise",
        trend: "Ketenangan Pesisir Timur",
        tags: ["Sunrise Beach", "Denpasar, Bali"],
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

    updateHeroBookmarkState();
}

export function bringHistoryCardToTop(key) {
    const historyContainer = document.getElementById('dash-history-container');
    if (!historyContainer) return;

    // Config map for each spot key
    const spotConfig = {
        sekumpul:  { name: 'Air Terjun Sekumpul Buleleng',    cat: 'waterfall', img: '/images/waterfall.jpg',       badge: 'Waterfall',  badgeCls: '' },
        waterfall: { name: 'Air Terjun Tegenungan',            cat: 'waterfall', img: '/images/waterfall.jpg',       badge: 'Waterfall',  badgeCls: '' },
        sunset:    { name: 'Pura Luhur Uluwatu',               cat: 'sunset',    img: '/images/sunset-beach.jpg',    badge: 'Sunset',     badgeCls: 'badge-sunset-h' },
        sunrise:   { name: 'Pantai Sanur Denpasar',            cat: 'sunrise',   img: '/images/sunrise-beach.jpg',   badge: 'Sunrise',    badgeCls: 'badge-sunrise-h' },
        mountain:  { name: 'Gunung Batur Kintamani',           cat: 'mountain',  img: '/images/mountain.jpg',        badge: 'Mountain',   badgeCls: 'badge-mountain-h' }
    };
    const conf = spotConfig[key] || spotConfig.waterfall;

    // Check if card already exists in history
    const existing = historyContainer.querySelector(`[data-spot-key="${key}"]`);
    if (existing) {
        // Move to top without duplicating
        historyContainer.prepend(existing);
        // Update the timestamp text
        const timeEl = existing.querySelector('.dash-history-mini-time');
        if (timeEl) timeEl.textContent = 'Baru saja dilihat';
        // Trigger highlight animation
        existing.classList.remove('dash-history-highlight');
        void existing.offsetWidth; // reflow
        existing.classList.add('dash-history-highlight');
        setTimeout(() => existing.classList.remove('dash-history-highlight'), 1400);
        // Enforce max 5 items in history
        while (historyContainer.children.length > 5) {
            historyContainer.removeChild(historyContainer.lastElementChild);
        }
        return;
    }

    // Create a new mini-card in the same style as "Destinasi Baru Rilis"
    const card = document.createElement('div');
    card.className = 'dash-history-mini-card';
    card.dataset.spotKey = key;
    card.innerHTML = `
        <img src="${conf.img}" alt="${conf.name}" class="dash-mini-img">
        <div class="dash-mini-info">
            <span class="dash-mini-title">${conf.name}</span>
        </div>
        <button type="button" class="dash-btn-lihat" aria-label="Lihat">
            Lihat
        </button>
    `;
    card.onclick = () => openDashSpotDetail(key);
    historyContainer.prepend(card);

    // Enforce max 5 items in history
    while (historyContainer.children.length > 5) {
        historyContainer.removeChild(historyContainer.lastElementChild);
    }

    // Animate newly added card
    card.classList.add('dash-history-highlight');
    setTimeout(() => card.classList.remove('dash-history-highlight'), 1400);
}

// Detail Destinasi Data (Deskripsi, Rating, dan Komentar)
const spotDetailsData = {
    sekumpul: {
        title: 'Air Terjun Sekumpul',
        location: 'Sawan, Buleleng, Bali Utara',
        category: 'Air Terjun',
        image: '/images/air terjun sekumpul.png',
        gallery: [
            '/images/air terjun sekumpul.png',
            '/images/waterfall.jpg',
            '/images/hero-bg.jpg',
            '/images/mountain.jpg'
        ],
        rating: 4.9,
        reviewsCount: 142,
        bestTime: '07:00 - 16:00 WITA',
        bestVisit: '08:00 - 11:00 WITA (Sinar pagi menembus lembah)',
        ticket: 'Rp 20.000 / orang',
        gmapsUrl: 'https://maps.google.com/?q=Air+Terjun+Sekumpul+Buleleng+Bali',
        tags: ['Trekking Alami', 'Fotografi Lanskap', 'Air Sejuk Pegunungan'],
        desc: 'Air Terjun Sekumpul dinobatkan sebagai salah satu air terjun terindah di Bali. Tersembunyi di rimbunnya lembah Buleleng, destinasi ini menampilkan gugusan air terjun kembar megah berketinggian lebih dari 80 meter yang dikelilingi vegetasi hutan tropis dan perkebunan cengkeh asri.',
        initialComments: [
            {
                name: 'Putu Arya Wiguna',
                date: '2 hari lalu',
                rating: 5,
                comment: 'Trek menuju lokasi cukup menantang namun terbayar lunas saat melihat hempasan air terjun yang begitu megah. Disarankan datang pagi hari saat udara masih sejuk.'
            },
            {
                name: 'Sarah Wijaya',
                date: '1 minggu lalu',
                rating: 5,
                comment: 'Airnya luar biasa jernih dan segar. Pemandu lokal sangat ramah dan jalur trekking tertata baik.'
            }
        ]
    },
    waterfall: {
        title: 'Air Terjun Tegenungan',
        location: 'Kemenuh, Sukawati, Gianyar',
        category: 'Air Terjun',
        image: '/images/waterfall.jpg',
        gallery: [
            '/images/waterfall.jpg',
            '/images/air terjun sekumpul.png',
            '/images/hero-bg.jpg',
            '/images/sunset-beach.jpg'
        ],
        rating: 4.8,
        reviewsCount: 236,
        bestTime: '06:30 - 18:00 WITA',
        bestVisit: '07:00 - 09:30 WITA (Suasana tenang dan udara sejuk)',
        ticket: 'Rp 25.000 / orang',
        gmapsUrl: 'https://maps.google.com/?q=Air+Terjun+Tegenungan+Gianyar+Bali',
        tags: ['Akses Mudah', 'Spot Foto', 'Dekat Ubud'],
        desc: 'Air Terjun Tegenungan menawarkan debit air deras nan mempesona di lembah hijau Sukawati. Dengan akses tangga terawat, spot foto ayunan estetik, dan fasilitas lengkap, tempat ini menjadi tujuan favorit wisatawan yang ingin menikmati alam tanpa pendakian terjal.',
        initialComments: [
            {
                name: 'Budi Santoso',
                date: 'Kemarin',
                rating: 5,
                comment: 'Lokasi sangat strategis dekat Ubud. Fasilitas toilet dan kafe sekitar tertata rapi. Sangat nyaman untuk liburan keluarga.'
            },
            {
                name: 'Ketut Dharmayana',
                date: '5 hari lalu',
                rating: 4,
                comment: 'Pemandangan air terjun sangat indah. Datanglah sebelum jam 10 pagi agar tidak terlalu padat pengunjung.'
            }
        ]
    },
    sunset: {
        title: 'Pantai Melasti & Tebing Karang',
        location: 'Ungasan, Kuta Selatan, Badung',
        category: 'Sunset Beach',
        image: '/images/sunset-beach.jpg',
        gallery: [
            '/images/sunset-beach.jpg',
            '/images/sunrise-beach.jpg',
            '/images/hero-bg.jpg',
            '/images/mountain.jpg'
        ],
        rating: 4.9,
        reviewsCount: 318,
        bestTime: '16:00 - 18:45 WITA',
        bestVisit: '16:30 - 18:30 WITA (Golden hour sunset spektakuler)',
        ticket: 'Rp 10.000 / orang',
        gmapsUrl: 'https://maps.google.com/?q=Pantai+Melasti+Ungasan+Bali',
        tags: ['Sunset Epik', 'Pasir Putih Bersih', 'Tebing Kapur Megah'],
        desc: 'Pantai Melasti menyajikan perpaduan spektakuler tebing kapur putih menjulang tinggi dengan hamparan pasir putih bersih dan laut biru kehijauan. Jalan aspal berliku yang membelah tebing menjadi spot foto ikonik, disempurnakan momen matahari terbenam yang memukau.',
        initialComments: [
            {
                name: 'Ni Made Anindya',
                date: '3 hari lalu',
                rating: 5,
                comment: 'Sunset terindah di semenanjung Bukit Bali. Akses jalan mulus dan area parkir luas. Sangat direkomendasikan!'
            },
            {
                name: 'Rizky Ramadhan',
                date: '6 hari lalu',
                rating: 5,
                comment: 'Pantainya sangat bersih dan air lautnya jernih saat surut. Suasana sore hari sangat tenang dan damai.'
            }
        ]
    },
    sunrise: {
        title: 'Pantai Sanur & Matahari Terbit',
        location: 'Sanur, Denpasar Selatan',
        category: 'Sunrise Beach',
        image: '/images/sunrise-beach.jpg',
        gallery: [
            '/images/sunrise-beach.jpg',
            '/images/sunset-beach.jpg',
            '/images/hero-bg.jpg',
            '/images/waterfall.jpg'
        ],
        rating: 4.8,
        reviewsCount: 189,
        bestTime: '05:30 - 07:00 WITA',
        bestVisit: '05:30 - 06:45 WITA (Fajar tenang berlatar siluet gazebo)',
        ticket: 'Gratis (Parkir Rp 2.000)',
        gmapsUrl: 'https://maps.google.com/?q=Pantai+Sanur+Denpasar+Bali',
        tags: ['Jogging Track Tepi Laut', 'Sunrise Damai', 'Ramah Keluarga'],
        desc: 'Pantai Sanur merupakan surga fajar terbaik di pulau Dewata. Ombak tenang, jalur pedestrian sepanjang 5 kilometer yang nyaman untuk bersepeda, serta siluet gazebo tradisional di atas karang menjadikan Sanur destinasi ideal untuk memulai hari dengan ketenangan.',
        initialComments: [
            {
                name: 'I Wayan Gede',
                date: '4 hari lalu',
                rating: 5,
                comment: 'Matahari terbit di Pantai Sanur selalu menenangkan jiwa. Udara pagi segar dan banyak pilihan sarapan khas Bali di sekitar.'
            },
            {
                name: 'Dewi Lestari',
                date: '1 minggu lalu',
                rating: 4,
                comment: 'Tempat favorit untuk bersepeda pagi bersama keluarga. Pemandangan Gunung Agung di kejauhan saat cuaca cerah sangat menakjubkan.'
            }
        ]
    },
    mountain: {
        title: 'Gunung Batur (1.717 mdpl)',
        location: 'Kintamani, Kabupaten Bangli',
        category: 'Gunung & Kaldera',
        image: '/images/mountain.jpg',
        gallery: [
            '/images/mountain.jpg',
            '/images/sunrise-beach.jpg',
            '/images/hero-bg.jpg',
            '/images/air terjun sekumpul.png'
        ],
        rating: 4.9,
        reviewsCount: 275,
        bestTime: '03:30 - 08:30 WITA',
        bestVisit: '04:00 - 07:00 WITA (Samudera awan magis saat sunrise)',
        ticket: 'Retribusi Kintamani Rp 25.000',
        gmapsUrl: 'https://maps.google.com/?q=Gunung+Batur+Kintamani+Bali',
        tags: ['Sunrise Trekking', 'Samudera Awan', 'Kaldera Vulkanik'],
        desc: 'Gunung Batur menawarkan pengalaman pendakian berdurasi sekitar 2 jam menuju kawah aktif. Di puncak, pendaki disambut pemandangan magis matahari terbit di atas samudera awan tebal dengan latar megah Danau Batur, Gunung Abang, dan siluet Gunung Rinjani Lombok.',
        initialComments: [
            {
                name: 'Agus Pratama',
                date: 'Kemarin',
                rating: 5,
                comment: 'Pengalaman mendaki yang luar biasa. Pemandangan samudera awan saat fajar benar-benar memanjakan mata. Jangan lupa bawa jaket tebal.'
            },
            {
                name: 'Jessica Tan',
                date: '3 hari lalu',
                rating: 5,
                comment: 'Trek cukup bersahabat untuk pemula. Pemandu lokal sangat membantu dan sarapan telur rebus uap belerang di kawah sangat berkesan.'
            }
        ]
    }
};

let currentDetailSpotKey = 'waterfall';
let currentCommentRating = 5;
let currentSpotGallery = [];

// Helper star SVG generator
function generateStarIconsHtml(rating, max = 5, size = 15) {
    let html = '';
    const rounded = Math.round(rating);
    for (let i = 1; i <= max; i++) {
        const fill = i <= rounded ? 'currentColor' : 'none';
        const opacity = i <= rounded ? '1' : '0.25';
        html += `<svg viewBox="0 0 24 24" width="${size}" height="${size}" fill="${fill}" stroke="currentColor" stroke-width="1.8" style="opacity:${opacity};"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>`;
    }
    return html;
}

export function swapDestDetailImage(thumbIndex) {
    if (!currentSpotGallery || currentSpotGallery.length <= thumbIndex) return;
    const temp = currentSpotGallery[0];
    currentSpotGallery[0] = currentSpotGallery[thumbIndex];
    currentSpotGallery[thumbIndex] = temp;

    const imgMain = document.getElementById('dest-detail-img');
    const thumb1 = document.getElementById('dest-detail-img-thumb-1');
    const thumb2 = document.getElementById('dest-detail-img-thumb-2');
    const thumb3 = document.getElementById('dest-detail-img-thumb-3');

    if (imgMain && currentSpotGallery[0]) imgMain.src = currentSpotGallery[0];
    if (thumb1 && currentSpotGallery[1]) thumb1.src = currentSpotGallery[1];
    if (thumb2 && currentSpotGallery[2]) thumb2.src = currentSpotGallery[2];
    if (thumb3 && currentSpotGallery[3]) thumb3.src = currentSpotGallery[3];
}

export function openDashSpotDetail(key) {
    // Bring history card to top
    bringHistoryCardToTop(key);

    const data = spotDetailsData[key] || spotDetailsData.waterfall;
    currentDetailSpotKey = key;

    const modal = document.getElementById('dest-detail-modal');
    if (!modal) return;

    // Populate gallery images
    currentSpotGallery = data.gallery ? [...data.gallery] : [data.image, data.image, data.image, data.image];
    const imgMain = document.getElementById('dest-detail-img');
    const thumb1 = document.getElementById('dest-detail-img-thumb-1');
    const thumb2 = document.getElementById('dest-detail-img-thumb-2');
    const thumb3 = document.getElementById('dest-detail-img-thumb-3');

    if (imgMain && currentSpotGallery[0]) {
        imgMain.src = currentSpotGallery[0];
        imgMain.alt = data.title;
    }
    if (thumb1 && currentSpotGallery[1]) {
        thumb1.src = currentSpotGallery[1];
        thumb1.alt = `${data.title} 2`;
    }
    if (thumb2 && currentSpotGallery[2]) {
        thumb2.src = currentSpotGallery[2];
        thumb2.alt = `${data.title} 3`;
    }
    if (thumb3 && currentSpotGallery[3]) {
        thumb3.src = currentSpotGallery[3];
        thumb3.alt = `${data.title} 4`;
    }

    // Populate data
    const titleEl = document.getElementById('dest-detail-title');
    const catEl = document.getElementById('dest-detail-category');
    const locTextEl = document.getElementById('dest-detail-location-text');
    const scoreEl = document.getElementById('dest-detail-score');
    const sideScoreEl = document.getElementById('dest-detail-score-side');
    const timeEl = document.getElementById('dest-detail-time');
    const bestVisitEl = document.getElementById('dest-detail-best-visit');
    const ticketEl = document.getElementById('dest-detail-ticket');
    const descEl = document.getElementById('dest-detail-desc');
    const tagsEl = document.getElementById('dest-detail-tags');
    const gmapsLink = document.getElementById('dest-detail-gmaps-link');

    if (titleEl) titleEl.textContent = data.title;
    if (catEl) catEl.textContent = data.category;
    if (locTextEl) locTextEl.textContent = data.location;
    if (scoreEl) scoreEl.textContent = Number(data.rating).toFixed(1);
    if (sideScoreEl) sideScoreEl.textContent = Number(data.rating).toFixed(1);
    if (timeEl) timeEl.textContent = data.bestTime;
    if (bestVisitEl) bestVisitEl.textContent = data.bestVisit || data.bestTime;
    if (ticketEl) ticketEl.textContent = data.ticket;
    if (descEl) descEl.textContent = data.desc;

    if (gmapsLink) {
        gmapsLink.href = data.gmapsUrl || `https://maps.google.com/?q=${encodeURIComponent(data.title + ' Bali')}`;
    }

    if (tagsEl && data.tags) {
        tagsEl.innerHTML = data.tags.map(tag => `<span class="dash-dest-tag-pill">${tag}</span>`).join('');
    }

    // Reset comment form
    setCommentRating(5);
    const textarea = document.getElementById('comment-textarea');
    if (textarea) textarea.value = '';
    const authorInput = document.getElementById('comment-author-name');
    if (authorInput) {
        authorInput.value = getCurrentUsername();
        authorInput.readOnly = true;
    }

    // Reset comment photo upload
    resetCommentPhotoUpload();

    // Render Comments
    renderDestinationComments(key);

    // Update Save/Bookmark button state
    updateDestModalSaveButtonState(key);

    // Open modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

export function closeDestDetailModal() {
    const modal = document.getElementById('dest-detail-modal');
    if (!modal) return;
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

// ===== RENCANA TERSIMPAN (SAVED PLANS) =====
export function getSavedPlans() {
    try {
        const saved = localStorage.getItem('dewasufa_saved_plans');
        return saved ? JSON.parse(saved) : [];
    } catch (e) {
        return [];
    }
}

export function isSpotSaved(key) {
    const plans = getSavedPlans();
    return plans.includes(key);
}

let isTogglingPlan = false;

export function updateDestModalSaveButtonState(key) {
    const isSaved = isSpotSaved(key);
    const saveBtn = document.getElementById('btn-save-dest-plan');
    const saveText = document.getElementById('dash-dest-save-text');
    const saveIcon = document.getElementById('dash-dest-save-icon');

    if (saveBtn) {
        saveBtn.classList.toggle('is-saved', isSaved);
        saveBtn.classList.toggle('active', isSaved);
        if (isSaved) {
            saveBtn.style.setProperty('background', '#f5b842', 'important');
            saveBtn.style.setProperty('background-color', '#f5b842', 'important');
            saveBtn.style.setProperty('border-color', '#f5b842', 'important');
            saveBtn.style.setProperty('color', '#122115', 'important');
        } else {
            saveBtn.style.removeProperty('background');
            saveBtn.style.removeProperty('background-color');
            saveBtn.style.removeProperty('border-color');
            saveBtn.style.removeProperty('color');
        }
    }
    if (saveText) {
        saveText.textContent = isSaved ? 'Tersimpan di Rencana' : 'Simpan ke Rencana';
        if (isSaved) {
            saveText.style.setProperty('color', '#122115', 'important');
        } else {
            saveText.style.removeProperty('color');
        }
    }
    if (saveIcon) {
        saveIcon.setAttribute('fill', isSaved ? '#122115' : 'none');
        saveIcon.setAttribute('stroke', isSaved ? '#122115' : 'currentColor');
    }
}

export function updateHeroBookmarkState() {
    const btnBookmark = document.getElementById('dash-hero-btn-bookmark');
    if (!btnBookmark) return;
    const currentKey = dashboardSlides[currentSlideIndex]?.key || 'sekumpul';
    const isSaved = isSpotSaved(currentKey);
    btnBookmark.classList.toggle('active', isSaved);
    const svg = btnBookmark.querySelector('svg');
    if (svg) {
        svg.setAttribute('fill', isSaved ? 'currentColor' : 'none');
    }
}

export function toggleSavePlanByKey(key) {
    if (isTogglingPlan) return;
    isTogglingPlan = true;
    setTimeout(() => { isTogglingPlan = false; }, 200);

    let plans = getSavedPlans();
    const data = spotDetailsData[key] || spotDetailsData.waterfall;
    const title = data.title || 'Destinasi';

    if (plans.includes(key)) {
        plans = plans.filter(k => k !== key);
        localStorage.setItem('dewasufa_saved_plans', JSON.stringify(plans));
        if (currentDetailSpotKey === key) {
            updateDestModalSaveButtonState(key);
        }
        updateHeroBookmarkState();
        showToast(`"${title}" dihapus dari Rencana Tersimpan.`, '');
    } else {
        plans.push(key);
        localStorage.setItem('dewasufa_saved_plans', JSON.stringify(plans));
        if (currentDetailSpotKey === key) {
            updateDestModalSaveButtonState(key);
        }
        updateHeroBookmarkState();
        showToast(`"${title}" berhasil disimpan ke Rencana Tersimpan!`, '');
    }
    renderSavedPlansList();
}

export function toggleSaveCurrentPlan() {
    if (!currentDetailSpotKey) return;
    toggleSavePlanByKey(currentDetailSpotKey);
}

export function handleHeroLihatClick() {
    const slide = dashboardSlides[currentSlideIndex];
    const key = slide?.key || 'sekumpul';
    openDashSpotDetail(key);
}

export function openSavedPlansModal() {
    renderSavedPlansList();
    const modal = document.getElementById('dash-saved-plans-modal');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

export function closeSavedPlansModal() {
    const modal = document.getElementById('dash-saved-plans-modal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

export function removeSavedPlan(key, event) {
    if (event) event.stopPropagation();
    let plans = getSavedPlans();
    const data = spotDetailsData[key] || spotDetailsData.waterfall;
    const title = data.title || 'Destinasi';
    plans = plans.filter(k => k !== key);
    localStorage.setItem('dewasufa_saved_plans', JSON.stringify(plans));
    if (currentDetailSpotKey === key) {
        updateDestModalSaveButtonState(key);
    }
    updateHeroBookmarkState();
    renderSavedPlansList();
    showToast(`"${title}" dihapus dari Rencana Tersimpan.`, '');
}

export function renderSavedPlansList() {
    const listEl = document.getElementById('dash-saved-plans-list');
    if (!listEl) return;
    const plans = getSavedPlans();

    if (plans.length === 0) {
        listEl.innerHTML = `
            <div class="dash-saved-plans-empty">
                <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                </svg>
                <p>Belum ada destinasi di Rencana Tersimpan Anda.<br>Buka destinasi dan klik ikon simpan untuk menyimpannya.</p>
            </div>
        `;
        return;
    }

    listEl.innerHTML = plans.map(key => {
        const item = spotDetailsData[key] || spotDetailsData.waterfall;
        return `
            <div class="dash-saved-plan-item" onclick="closeSavedPlansModal(); openDashSpotDetail('${key}')">
                <img src="${item.image}" alt="${item.title}" class="dash-saved-plan-img">
                <div class="dash-saved-plan-info">
                    <span class="dash-saved-plan-title">${item.title}</span>
                    <span class="dash-saved-plan-loc">${item.location} &bull; ${item.category}</span>
                </div>
                <div class="dash-saved-plan-actions">
                    <button type="button" class="dash-btn-lihat" onclick="event.stopPropagation(); closeSavedPlansModal(); openDashSpotDetail('${key}')">Lihat</button>
                    <button type="button" class="dash-saved-plan-remove" aria-label="Hapus dari Rencana" title="Hapus dari Rencana" onclick="removeSavedPlan('${key}', event)">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;
    }).join('');
}

function getStoredComments(key) {
    try {
        const stored = localStorage.getItem('dewasufa_comments_' + key);
        if (stored) return JSON.parse(stored);
    } catch (e) {
        console.warn(e);
    }
    const defaultData = spotDetailsData[key] || spotDetailsData.waterfall;
    return defaultData.initialComments ? [...defaultData.initialComments] : [];
}

function saveStoredComments(key, comments) {
    try {
        localStorage.setItem('dewasufa_comments_' + key, JSON.stringify(comments));
    } catch (e) {
        console.warn(e);
    }
}

// State Foto Komentar (Maksimal 3 Foto)
let currentCommentPhotos = [];

function compressImageFile(file, maxWidth = 600, quality = 0.7) {
    return new Promise((resolve) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const img = new Image();
            img.onload = () => {
                const canvas = document.createElement('canvas');
                let width = img.width;
                let height = img.height;
                if (width > maxWidth) {
                    height = Math.round((height * maxWidth) / width);
                    width = maxWidth;
                }
                canvas.width = width;
                canvas.height = height;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);
                resolve(canvas.toDataURL('image/jpeg', quality));
            };
            img.onerror = () => resolve(e.target.result);
            img.src = e.target.result;
        };
        reader.onerror = () => resolve('');
        reader.readAsDataURL(file);
    });
}

export async function handleCommentPhotoSelect(event) {
    const input = event.target;
    if (!input || !input.files || input.files.length === 0) return;

    const files = Array.from(input.files);
    const availableSlots = 3 - currentCommentPhotos.length;

    if (availableSlots <= 0) {
        showToast('Maksimal 3 foto per ulasan.', '');
        input.value = '';
        return;
    }

    if (files.length > availableSlots) {
        showToast(`Hanya dapat menambahkan ${availableSlots} foto lagi (Maksimal 3 foto).`, '');
    }

    const filesToProcess = files.slice(0, availableSlots);

    for (const file of filesToProcess) {
        if (!file.type.startsWith('image/')) {
            showToast('Hanya format gambar yang diperbolehkan.', '');
            continue;
        }
        try {
            const compressed = await compressImageFile(file, 600, 0.7);
            if (compressed && currentCommentPhotos.length < 3) {
                currentCommentPhotos.push(compressed);
            }
        } catch (err) {
            console.error(err);
        }
    }

    input.value = '';
    renderCommentPhotoPreviews();
}

export function removeCommentPhoto(index) {
    if (index >= 0 && index < currentCommentPhotos.length) {
        currentCommentPhotos.splice(index, 1);
        renderCommentPhotoPreviews();
    }
}

export function renderCommentPhotoPreviews() {
    const previewContainer = document.getElementById('comment-photos-preview');
    const counterEl = document.getElementById('comment-photo-count');
    const labelBtn = document.getElementById('label-comment-photo');

    if (counterEl) {
        counterEl.textContent = `${currentCommentPhotos.length}/3 Foto`;
    }

    if (labelBtn) {
        if (currentCommentPhotos.length >= 3) {
            labelBtn.style.opacity = '0.5';
            labelBtn.style.pointerEvents = 'none';
        } else {
            labelBtn.style.opacity = '1';
            labelBtn.style.pointerEvents = 'auto';
        }
    }

    if (!previewContainer) return;

    if (currentCommentPhotos.length === 0) {
        previewContainer.innerHTML = '';
        return;
    }

    previewContainer.innerHTML = currentCommentPhotos.map((photoData, idx) => `
        <div class="dash-comment-photo-preview-item">
            <img src="${photoData}" alt="Foto ${idx + 1}">
            <button type="button" class="dash-comment-photo-remove-btn" aria-label="Hapus foto" onclick="removeCommentPhoto(${idx})">&times;</button>
        </div>
    `).join('');
}

export function resetCommentPhotoUpload() {
    currentCommentPhotos = [];
    renderCommentPhotoPreviews();
    const input = document.getElementById('comment-photo-input');
    if (input) input.value = '';
}

export function openCommentPhotoModal(imgSrc) {
    const modal = document.getElementById('comment-photo-lightbox');
    const img = document.getElementById('lightbox-img');
    if (!modal || !img) return;

    img.src = imgSrc;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

export function closeCommentPhotoModal() {
    const modal = document.getElementById('comment-photo-lightbox');
    if (!modal) return;

    modal.classList.remove('active');
    const anyOtherModalActive = document.querySelector('.dash-modal-backdrop.active:not(#comment-photo-lightbox)');
    if (!anyOtherModalActive) {
        document.body.style.overflow = '';
    }
}

export const openPhotoModal = openCommentPhotoModal;
export const closePhotoModal = closeCommentPhotoModal;

export function renderDestinationComments(key) {
    const commentsList = document.getElementById('dest-comments-list');
    const counterEl = document.getElementById('dest-comments-counter');
    if (!commentsList) return;

    const comments = getStoredComments(key);

    if (counterEl) {
        counterEl.textContent = `${comments.length} Komentar`;
    }

    if (comments.length === 0) {
        commentsList.innerHTML = '<div style="text-align: center; padding: 20px; color: rgba(255,255,255,0.45); font-size: 13px;">Belum ada ulasan untuk destinasi ini. Jadilah yang pertama memberikan ulasan!</div>';
        return;
    }

    commentsList.innerHTML = comments.map(c => {
        const initial = (c.name || 'W').charAt(0).toUpperCase();
        const photosHtml = (c.photos && Array.isArray(c.photos) && c.photos.length > 0)
            ? `
                <div class="dash-comment-photos-grid">
                    ${c.photos.map((photoUrl, idx) => `
                        <div class="dash-comment-photo-thumb" onclick="openCommentPhotoModal('${photoUrl}')" title="Klik untuk memperbesar foto">
                            <img src="${photoUrl}" alt="Foto ulasan ${idx + 1}" loading="lazy">
                        </div>
                    `).join('')}
                </div>
            `
            : '';

        return `
            <div class="dash-comment-card">
                <div class="dash-comment-top">
                    <div class="dash-comment-author-info">
                        <div class="dash-comment-avatar">${initial}</div>
                        <span class="dash-comment-author-name">
                            ${c.name}
                            <span class="dash-comment-badge-verified">Terverifikasi</span>
                        </span>
                    </div>
                    <div class="dash-comment-meta-right">
                        <span class="dash-comment-date">${c.date || 'Baru saja'}</span>
                        <div class="dash-comment-stars">
                            ${generateStarIconsHtml(c.rating || 5, 5, 13)}
                        </div>
                    </div>
                </div>
                <p class="dash-comment-text">${c.comment}</p>
                ${photosHtml}
            </div>
        `;
    }).join('');
}

export function setCommentRating(rating) {
    currentCommentRating = Math.max(1, Math.min(5, rating));
    const starPicker = document.getElementById('comment-star-picker');
    const ratingVal = document.getElementById('comment-rating-val');

    if (starPicker) {
        const btns = starPicker.querySelectorAll('.dash-star-btn');
        btns.forEach(btn => {
            const starNum = parseInt(btn.dataset.rating, 10);
            if (starNum <= currentCommentRating) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }

    if (ratingVal) {
        ratingVal.textContent = `${currentCommentRating}.0 / 5.0`;
    }
}

// Get username of currently logged-in account
export function getCurrentUsername() {
    const fromSession = sessionStorage.getItem('dewasufa_user');
    if (fromSession && fromSession.trim()) {
        return fromSession.trim();
    }
    const fromDisplay = document.getElementById('dash-display-name')?.textContent?.trim();
    if (fromDisplay) {
        return fromDisplay;
    }
    return 'Wisatawan Bali';
}

export function handleCommentSubmit(event) {
    if (event) event.preventDefault();

    const textarea = document.getElementById('comment-textarea');
    if (!textarea) return;

    const commentText = textarea.value.trim();
    if (!commentText) {
        showToast('Mohon tuliskan ulasan Anda terlebih dahulu.', '');
        textarea.focus();
        return;
    }

    // Username akun yang sedang digunakan (tidak dapat diubah)
    const authorName = getCurrentUsername();
    const nameInput = document.getElementById('comment-author-name');
    if (nameInput) {
        nameInput.value = authorName;
        nameInput.readOnly = true;
    }

    const newComment = {
        name: authorName,
        date: 'Baru saja',
        rating: currentCommentRating,
        comment: commentText,
        photos: [...currentCommentPhotos]
    };

    const comments = getStoredComments(currentDetailSpotKey);
    comments.unshift(newComment);
    saveStoredComments(currentDetailSpotKey, comments);

    // Reset photo uploads
    resetCommentPhotoUpload();

    // Re-render
    renderDestinationComments(currentDetailSpotKey);

    // Highlight the newly added comment
    const listEl = document.getElementById('dest-comments-list');
    if (listEl && listEl.firstElementChild) {
        listEl.firstElementChild.classList.add('newly-added');
    }

    textarea.value = '';
    showToast('Ulasan Anda berhasil dikirimkan.', '');
}

// Modal Daftar sebagai Author
export function openCreateDestModal() {
    const modal = document.getElementById('create-dest-modal');
    if (!modal) return;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    setTimeout(() => {
        const input = document.getElementById('author-username');
        if (input && !input.disabled) input.focus();
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

    const usernameInput = document.getElementById('author-username');
    const emailInput = document.getElementById('author-email');
    const passwordInput = document.getElementById('author-password');

    const username = usernameInput ? usernameInput.value.trim() : '';
    const email = emailInput ? emailInput.value.trim() : '';
    const password = passwordInput ? passwordInput.value : '';

    if (!username || !email || !password) {
        showToast('Mohon lengkapi username, email, dan password Anda.', '⚠️');
        return;
    }

    // Tampilkan tulisan sedang diverifikasi oleh admin
    const statusBox = document.getElementById('author-verification-status');
    const statusText = document.getElementById('dash-verification-text');
    if (statusBox) {
        statusBox.style.display = 'flex';
    }
    if (statusText) {
        statusText.textContent = 'sedang diverifikasi oleh admin';
    }

    // Ubah teks dan state tombol daftar
    const submitBtn = document.getElementById('btn-submit-author-reg');
    const btnText = document.getElementById('btn-author-reg-text');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.classList.add('btn-pending');
    }
    if (btnText) {
        btnText.textContent = 'sedang diverifikasi oleh admin';
    }

    // Nonaktifkan input selama proses verifikasi
    if (usernameInput) usernameInput.disabled = true;
    if (emailInput) emailInput.disabled = true;
    if (passwordInput) passwordInput.disabled = true;

    // Perbarui status role pengguna di header
    const roleEl = document.querySelector('.dash-user-role');
    if (roleEl) {
        roleEl.textContent = 'Verifikasi Admin';
    }

    showToast('Pendaftaran terkirim! sedang diverifikasi oleh admin', '');
}

// Modal Pengaturan (Settings)
export function openSettingsModal() {
    const modal = document.getElementById('dash-settings-modal');
    if (!modal) return;

    // Prefill username
    const nameInput = document.getElementById('settings-name');
    const currentName = sessionStorage.getItem('dewasufa_user') || document.getElementById('dash-display-name')?.textContent || 'Wisatawan Bali';
    if (nameInput) nameInput.value = currentName.trim();

    // Prefill Status Akun (readonly - cannot be edited manually)
    const roleInput = document.getElementById('settings-role');
    const currentRole = sessionStorage.getItem('dewasufa_role') || 'User';
    if (roleInput) roleInput.value = currentRole;

    // Reset password fields
    const resetPassInput = document.getElementById('settings-reset-password');
    const confirmPassInput = document.getElementById('settings-confirm-password');
    if (resetPassInput) resetPassInput.value = '';
    if (confirmPassInput) confirmPassInput.value = '';

    // Prefill avatar preview
    const savedAvatar = localStorage.getItem('dewasufa_avatar') || sessionStorage.getItem('dewasufa_avatar');
    const previewImg = document.getElementById('settings-avatar-preview');
    const fallbackSpan = document.getElementById('settings-avatar-fallback');
    const removeBtn = document.getElementById('btn-remove-avatar');
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

    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

export function closeSettingsModal() {
    const modal = document.getElementById('dash-settings-modal');
    if (!modal) return;
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

export function handleSaveSettings(event) {
    if (event) event.preventDefault();

    const nameInput = document.getElementById('settings-name');
    const newName = nameInput ? nameInput.value.trim() : 'Wisatawan Bali';

    if (newName) {
        sessionStorage.setItem('dewasufa_user', newName);
        const displayName = document.getElementById('dash-display-name');
        if (displayName) displayName.textContent = newName;
        const authorInput = document.getElementById('comment-author-name');
        if (authorInput) {
            authorInput.value = newName;
            authorInput.readOnly = true;
        }
    }

    // Handle Reset Password
    const resetPassInput = document.getElementById('settings-reset-password');
    const confirmPassInput = document.getElementById('settings-confirm-password');
    const newPassword = resetPassInput ? resetPassInput.value : '';
    const confirmPassword = confirmPassInput ? confirmPassInput.value : '';

    if (newPassword || confirmPassword) {
        if (newPassword.length < 6) {
            showToast('Password baru minimal 6 karakter.', '⚠️');
            return;
        }
        if (newPassword !== confirmPassword) {
            showToast('Konfirmasi password tidak cocok.', '⚠️');
            return;
        }
        showToast('Password berhasil direset & pengaturan profil disimpan!', '🔒');
    } else {
        showToast('Pengaturan profil dan preferensi berhasil disimpan!', '⚙️');
    }

    closeSettingsModal();
}

// Manager Unggah Foto Profil Sendiri
export function initAvatarManager() {
    const avatarInput = document.getElementById('settings-avatar-input');
    const previewImg = document.getElementById('settings-avatar-preview');
    const fallbackSpan = document.getElementById('settings-avatar-fallback');
    const removeBtn = document.getElementById('btn-remove-avatar');
    const headerAvatar = document.getElementById('dash-header-avatar');

    function applyAvatar(dataUrl) {
        if (dataUrl) {
            if (previewImg) {
                previewImg.src = dataUrl;
                previewImg.style.display = 'block';
            }
            if (fallbackSpan) fallbackSpan.style.display = 'none';
            if (removeBtn) removeBtn.style.display = 'inline-flex';

            if (headerAvatar) {
                headerAvatar.innerHTML = `<img src="${dataUrl}" alt="Foto Profil" class="dash-avatar-img">`;
            }
        } else {
            if (previewImg) {
                previewImg.src = '';
                previewImg.style.display = 'none';
            }
            if (fallbackSpan) fallbackSpan.style.display = 'block';
            if (removeBtn) removeBtn.style.display = 'none';

            if (headerAvatar) {
                headerAvatar.innerHTML = `<span class="dash-avatar-initials">W</span>`;
            }
        }
    }

    const savedAvatar = localStorage.getItem('dewasufa_avatar') || sessionStorage.getItem('dewasufa_avatar');
    if (savedAvatar) {
        applyAvatar(savedAvatar);
    }

    if (avatarInput) {
        avatarInput.addEventListener('change', (e) => {
            const file = e.target.files?.[0];
            if (!file) return;

            if (file.size > 2 * 1024 * 1024) {
                showToast('Ukuran gambar maksimal 2MB.', '⚠️');
                avatarInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = (event) => {
                const base64 = event.target?.result;
                if (base64) {
                    localStorage.setItem('dewasufa_avatar', base64);
                    sessionStorage.setItem('dewasufa_avatar', base64);
                    applyAvatar(base64);
                    showToast('Foto profil berhasil diperbarui!', '📷');
                }
            };
            reader.readAsDataURL(file);
        });
    }

    if (removeBtn) {
        removeBtn.addEventListener('click', () => {
            localStorage.removeItem('dewasufa_avatar');
            sessionStorage.removeItem('dewasufa_avatar');
            if (avatarInput) avatarInput.value = '';
            applyAvatar(null);
            showToast('Foto profil dihapus.', '');
        });
    }
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
    closeDestDetailModal,
    swapDestDetailImage,
    handleCommentSubmit,
    setCommentRating,
    openCreateDestModal,
    closeCreateDestModal,
    handleCreateDestSubmit,
    bringHistoryCardToTop,
    openSettingsModal,
    closeSettingsModal,
    handleSaveSettings,
    toggleSaveCurrentPlan,
    toggleSavePlanByKey,
    handleHeroLihatClick,
    openSavedPlansModal,
    closeSavedPlansModal,
    removeSavedPlan,
    getSavedPlans,
    handleCommentPhotoSelect,
    removeCommentPhoto,
    openCommentPhotoModal,
    closeCommentPhotoModal,
    openPhotoModal,
    closePhotoModal,
    getCurrentUsername,
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
    const dashRole = document.querySelector('.dash-user-role');
    if (dashRole) {
        const savedRole = sessionStorage.getItem('dewasufa_role');
        dashRole.textContent = savedRole || 'User';
    }

    // Initialize locked comment author name with active account
    const commentAuthorInput = document.getElementById('comment-author-name');
    if (commentAuthorInput) {
        commentAuthorInput.value = getCurrentUsername();
        commentAuthorInput.readOnly = true;
    }

    // Initialize Avatar Upload Manager
    initAvatarManager();

    // Enforce max 5 history cards on startup
    const initialHistContainer = document.getElementById('dash-history-container');
    if (initialHistContainer) {
        while (initialHistContainer.children.length > 5) {
            initialHistContainer.removeChild(initialHistContainer.lastElementChild);
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

    // Bookmark Action (Trending Topic / Hero Banner)
    const btnBookmark = document.getElementById('dash-hero-btn-bookmark');
    if (btnBookmark) {
        btnBookmark.addEventListener('click', () => {
            const currentSlide = dashboardSlides[currentSlideIndex];
            const currentKey = currentSlide?.key || 'sekumpul';
            toggleSavePlanByKey(currentKey);
        });
    }

    // Hero Action Buttons (Lihat Modal Detail Destinasi)
    const btnStart = document.getElementById('dash-hero-btn-start');
    if (btnStart) {
        btnStart.addEventListener('click', () => {
            handleHeroLihatClick();
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
                    showToast(`Menampilkan rekomendasi kategori: ${pill.textContent}`, '');
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

    // Notification button & Popover
    const btnNotif = document.getElementById('btn-dash-notif');
    const notifPopover = document.getElementById('dash-notif-popover');
    const btnMarkNotif = document.getElementById('btn-mark-notif-read');
    const notifBadge = document.getElementById('dash-notif-badge');

    if (btnNotif && notifPopover) {
        btnNotif.addEventListener('click', (e) => {
            e.stopPropagation();
            if (userDropdown) userDropdown.classList.remove('show');
            const isOpen = notifPopover.classList.toggle('show');
            btnNotif.setAttribute('aria-expanded', isOpen);
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('#dash-notif-wrap')) {
                notifPopover.classList.remove('show');
                btnNotif.setAttribute('aria-expanded', 'false');
            }
        });
    }

    if (btnMarkNotif) {
        btnMarkNotif.addEventListener('click', () => {
            const unreadItems = document.querySelectorAll('.dash-notif-pop-item.unread');
            unreadItems.forEach(item => item.classList.remove('unread'));
            if (notifBadge) notifBadge.style.display = 'none';
            showToast('Semua notifikasi telah ditandai dibaca.', '');
        });
    }

    // Clear History button
    const btnClearHistory = document.getElementById('btn-clear-history');
    if (btnClearHistory) {
        btnClearHistory.addEventListener('click', () => {
            const histContainer = document.getElementById('dash-history-container');
            if (histContainer) histContainer.innerHTML = '';
            showToast('Riwayat penelusuran berhasil dibersihkan.', '');
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

    // Open Settings Modal (From Dropdown)
    const btnOpenSettings = document.getElementById('dash-btn-open-settings');
    const btnCloseSettings = document.getElementById('btn-close-settings');
    const settingsModal = document.getElementById('dash-settings-modal');

    if (btnOpenSettings) {
        btnOpenSettings.addEventListener('click', () => {
            if (userDropdown) userDropdown.classList.remove('show');
            openSettingsModal();
        });
    }

    if (btnCloseSettings) btnCloseSettings.addEventListener('click', closeSettingsModal);

    if (settingsModal) {
        settingsModal.addEventListener('click', (e) => {
            if (e.target === settingsModal) closeSettingsModal();
        });
    }

    // Log Out Button INSIDE Settings Modal
    const btnLogoutInside = document.getElementById('dash-btn-logout-inside');
    if (btnLogoutInside) {
        btnLogoutInside.addEventListener('click', () => {
            sessionStorage.removeItem('dewasufa_user');
            sessionStorage.removeItem('dewasufa_role');
            closeSettingsModal();
            showToast('Anda telah logout. Mengalihkan ke beranda...', '');
            setTimeout(() => {
                window.location.href = '/';
            }, 600);
        });
    }

    // Destination Detail Modal Listeners
    const btnCloseDestDetail = document.getElementById('btn-close-dest-detail');
    const destDetailModal = document.getElementById('dest-detail-modal');

    if (btnCloseDestDetail) {
        btnCloseDestDetail.addEventListener('click', closeDestDetailModal);
    }

    if (destDetailModal) {
        destDetailModal.addEventListener('click', (e) => {
            if (e.target === destDetailModal) closeDestDetailModal();
        });
    }

    // Save button in Destination Detail Modal
    const btnSaveDest = document.getElementById('btn-save-dest-plan');
    if (btnSaveDest) {
        btnSaveDest.addEventListener('click', toggleSaveCurrentPlan);
    }

    // Saved Plans (Rencana Tersimpan) Modal Listeners
    const btnMyPlan = document.getElementById('dash-btn-my-plan');
    const btnCloseSavedPlans = document.getElementById('btn-close-saved-plans');
    const savedPlansModal = document.getElementById('dash-saved-plans-modal');

    if (btnMyPlan) {
        btnMyPlan.addEventListener('click', () => {
            if (userDropdown) userDropdown.classList.remove('show');
            openSavedPlansModal();
        });
    }

    if (btnCloseSavedPlans) {
        btnCloseSavedPlans.addEventListener('click', closeSavedPlansModal);
    }

    if (savedPlansModal) {
        savedPlansModal.addEventListener('click', (e) => {
            if (e.target === savedPlansModal) closeSavedPlansModal();
        });
    }

    // Initialize Hero Bookmark State
    updateHeroBookmarkState();

    // Star Picker in Comment Form
    const starPicker = document.getElementById('comment-star-picker');
    if (starPicker) {
        const starBtns = starPicker.querySelectorAll('.dash-star-btn');
        starBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const rating = parseInt(btn.dataset.rating, 10);
                setCommentRating(rating);
            });
        });
    }

    // Comment Photo Upload Listener
    const commentPhotoInput = document.getElementById('comment-photo-input');
    if (commentPhotoInput) {
        commentPhotoInput.addEventListener('change', handleCommentPhotoSelect);
    }

    // Comment Photo Lightbox Modal
    const btnCloseLightbox = document.getElementById('btn-close-lightbox');
    const lightboxModal = document.getElementById('comment-photo-lightbox');
    if (btnCloseLightbox) {
        btnCloseLightbox.addEventListener('click', closeCommentPhotoModal);
    }
    if (lightboxModal) {
        lightboxModal.addEventListener('click', (e) => {
            if (e.target === lightboxModal) closeCommentPhotoModal();
        });
    }

    // ESC Key Close Modals
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            const lightbox = document.getElementById('comment-photo-lightbox');
            if (lightbox && lightbox.classList.contains('active')) {
                closeCommentPhotoModal();
                return;
            }
            closeLoginModal();
            closeDestModal();
            closeCreateDestModal();
            closeSettingsModal();
            closeDestDetailModal();
            closeSavedPlansModal();
            if (userDropdown) userDropdown.classList.remove('show');
            if (notifPopover) notifPopover.classList.remove('show');
        }
    });
}

// Initialize when DOM is loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initApp);
} else {
    initApp();
}
