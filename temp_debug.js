
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
        function openAdminSpotDetail(key, btn) {
            const card = btn ? btn.closest('.dash-recom-card') : document.querySelector('.dash-recom-card[data-key="' + key + '"]');
            const modal = document.getElementById('dest-detail-modal');
            if (!modal) return;
            let title = 'Air Terjun Sekumpul', desc = 'Keindahan alam Bali yang memukau.',
                time = '07:00 - 16:00 WITA', ticket = 'Rp 20.000 / orang', loc = 'Buleleng, Bali',
                cat = 'Waterfall', imgSrc = '/images/waterfall.jpg',
                rating = '4.9', bestVisit = '07:00 – 09:30 WITA (Suasana tenang dan sejuk)',
                status = 'post', tags = 'Air Terjun, Alam, Spot Foto', gmaps = '';
            let thumb1 = '', thumb2 = '', thumb3 = '';

            if (card) {
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
                if (status === 'draft') {
                    statusPill.textContent = '● Draft (Konsep)';
                    statusPill.style.background = 'rgba(234, 179, 8, 0.2)';
                    statusPill.style.color = '#facc15';
                    statusPill.style.borderColor = 'rgba(234, 179, 8, 0.35)';
                } else {
                    statusPill.textContent = '● Terbit Aktif';
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

            // Populate reviews in user portal style
            const counterEl = document.getElementById('dest-comments-counter');
            if (counterEl) counterEl.textContent = '2 Komentar';
            const commentsListEl = document.getElementById('dest-comments-list');
            if (commentsListEl) {
                commentsListEl.innerHTML = `
                    <div class="dash-comment-card">
                        <div class="dash-comment-top">
                            <div class="dash-comment-author-info">
                                <div class="dash-comment-avatar">KD</div>
                                <span class="dash-comment-author-name">
                                    Ketut Dharmayana
                                    <span class="dash-comment-badge-verified">Terverifikasi</span>
                                </span>
                            </div>
                            <div class="dash-comment-meta-right">
                                <span class="dash-comment-date">2 jam lalu</span>
                                <div class="dash-comment-stars">
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" stroke="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" stroke="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" stroke="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" stroke="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" stroke="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                </div>
                            </div>
                        </div>
                        <p class="dash-comment-text">Air terjunnya sangat megah dan asri! Pemandu lokal sangat ramah dan jalur trekking sudah tertata rapi.</p>
                    </div>
                    <div class="dash-comment-card">
                        <div class="dash-comment-top">
                            <div class="dash-comment-author-info">
                                <div class="dash-comment-avatar" style="background:#3b82f6;">WS</div>
                                <span class="dash-comment-author-name">
                                    Wayan Surya
                                    <span class="dash-comment-badge-verified">Terverifikasi</span>
                                </span>
                            </div>
                            <div class="dash-comment-meta-right">
                                <span class="dash-comment-date">1 hari lalu</span>
                                <div class="dash-comment-stars">
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" stroke="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" stroke="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" stroke="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" stroke="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" stroke="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                </div>
                            </div>
                        </div>
                        <p class="dash-comment-text">Sangat direkomendasikan dikunjungi saat pagi hari ketika suasana tenang dan udara masih sejuk!</p>
                    </div>
                `;
            }

            modal.classList.add('active', 'show');
            document.body.style.overflow = 'hidden';
        }
        function closeAdminSpotDetail() {
            const modal = document.getElementById('dest-detail-modal');
            if (modal) { modal.classList.remove('active', 'show'); document.body.style.overflow = ''; }
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
            if (modal) { modal.classList.add('show'); document.body.style.overflow = 'hidden'; }
        }

        function closeEditDestModal() {
            const modal = document.getElementById('admin-edit-dest-modal');
            if (modal) { modal.classList.remove('show'); document.body.style.overflow = ''; }
            currentEditingCard = null;
        }

        function updateDestCounts() {
            const allCards = document.querySelectorAll('#admin-cards-container .dash-recom-card');
            const total = allCards.length;
            let postCount = 0;
            let draftCount = 0;
            allCards.forEach(c => {
                if (c.dataset.status === 'draft') draftCount++;
                else postCount++;
            });
            const badge = document.getElementById('admin-dest-count-badge');
            if (badge) badge.textContent = `${total} Destinasi`;
            const statPost = document.getElementById('stat-post-count');
            if (statPost) statPost.textContent = postCount;
            const statDraft = document.getElementById('stat-draft-count');
            if (statDraft) statDraft.textContent = draftCount;
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
                    if (newStatus === 'draft') {
                        statusPill.className = 'admin-card-status-pill badge-status-draft';
                        statusPill.textContent = '● Draft';
                    } else {
                        statusPill.className = 'admin-card-status-pill badge-status-post';
                        statusPill.textContent = '● Post';
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
                if (c.dataset.status === 'draft') draftCount++;
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
                showAdminToast('Menampilkan destinasi berstatus Post (Terbit)');
            } else if (_currentStatusFilter === 'draft') {
                showAdminToast('Menampilkan destinasi berstatus Draft (Konsep)');
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
                if (_currentStatusFilter === 'draft') draftCard.classList.add('active');
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

                const matchStatus = (_currentStatusFilter === 'all') || (cardStatus === _currentStatusFilter);
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

                    const statusPillClass = status === 'draft' ? 'badge-status-draft' : 'badge-status-post';
                    const statusPillText  = status === 'draft' ? '● Draft' : '● Post';
                    const badgeClass = catKey === 'sunset' ? 'badge-sunset' : (catKey === 'sunrise' ? 'badge-sunrise' : (catKey === 'mountain' ? 'badge-mountain' : ''));

                    card.innerHTML = `
                        <div class="dash-recom-img-wrap">
                            <img src="${resolvedImg}" alt="${name}" class="dash-recom-img" loading="lazy">
                            <span class="dash-recom-badge ${badgeClass}">${cat}</span>
                            <span class="admin-card-status-pill ${statusPillClass}">${statusPillText}</span>
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

            // Scroll to destination section
            const secDest = document.getElementById('admin-destinasi-section');
            if (secDest) {
                secDest.classList.remove('admin-section-hidden');
                setTimeout(() => secDest.scrollIntoView({ behavior: 'smooth', block: 'start' }), 100);
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
    