<?php ob_start(); ?>

<style>
    /* ===== Home Enhancement Layer ===== */
    .hero-section {
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        inset: -25% -15% auto -15%;
        height: 700px;
        background: radial-gradient(circle at 12% 25%, rgba(232, 49, 106, 0.13), transparent 55%),
                    radial-gradient(circle at 88% 15%, rgba(124, 58, 237, 0.12), transparent 50%),
                    radial-gradient(circle at 50% 80%, rgba(232, 49, 106, 0.06), transparent 60%);
        z-index: 0;
        pointer-events: none;
    }
    .hero-section > .container-lg { position: relative; z-index: 1; }

    .hero-badge {
        box-shadow: 0 8px 20px rgba(232, 49, 106, 0.18);
    }

    .hero-title em {
        position: relative;
        font-style: normal;
        background: linear-gradient(120deg, #E8316A, #7C3AED);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    @keyframes floatCard {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    .hero-float-card {
        animation: floatCard 5s ease-in-out infinite;
        transition: box-shadow 0.25s ease;
    }
    .hero-float-card:hover {
        box-shadow: 0 18px 36px rgba(232, 49, 106, 0.18);
    }

    .stats-section {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #E8316A 0%, #7C3AED 100%) !important;
    }
    .stats-section::before {
        content: '';
        position: absolute;
        right: -50px;
        top: -50px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }
    .stats-section::after {
        content: '';
        position: absolute;
        left: -30px;
        bottom: -30px;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
    }
    .stats-section .stat-num,
    .stats-section .stat-label {
        position: relative;
        z-index: 1;
        color: #fff;
    }

    .feat-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }
    .feat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 36px rgba(232, 49, 106, 0.14);
    }
    .feat-card .feat-icon-wrap {
        transition: transform 0.25s ease;
    }
    .feat-card:hover .feat-icon-wrap {
        transform: scale(1.12) rotate(-5deg);
    }

    .step-card {
        position: relative;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 32px rgba(124, 58, 237, 0.14);
    }
    .step-card .step-num {
        transition: transform 0.25s ease, background 0.25s ease;
    }
    .step-card:hover .step-num {
        transform: scale(1.1);
        background: linear-gradient(135deg, var(--pk), var(--pu));
        color: #fff;
    }

    .cta-section {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #E8316A 0%, #7C3AED 100%);
    }
    .cta-section::before {
        content: '';
        position: absolute;
        left: -50px;
        top: -50px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }
    .cta-section::after {
        content: '';
        position: absolute;
        right: -40px;
        bottom: -40px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
    }
    .cta-section .btn-white {
        position: relative;
        z-index: 1;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .cta-section .btn-white:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 26px rgba(0,0,0,0.2);
    }
    .cta-section > * { position: relative; z-index: 1; }

    .c-dot {
        transition: transform 0.15s ease;
    }
    .c-dot:hover { transform: scale(1.25); }
</style>

<!-- ===== HERO SECTION ===== -->
<section class="hero-section">
    <div class="container-lg">
        <div class="row align-items-center g-5">
            <!-- Left: Text -->
            <div class="col-lg-6">
                <div class="hero-badge">
                    <i class="bi bi-heart-pulse-fill"></i>
                    Pendamping kesehatan reproduksimu
                </div>
                <h1 class="hero-title">
                    Pahami Siklus-mu,<br>
                    Kenali Tubuh-mu<br>
                    dengan <em>Lebih Baik</em>
                </h1>
                <p class="hero-subtitle">
                    MyKit membantu kamu melacak siklus menstruasi, memantau gejala harian,
                    dan mendapatkan wawasan yang personal. Cerdas, privat, dan mudah digunakan.
                </p>

                <?php if (!empty($_SESSION['user_id'])): ?>
                    <div class="card p-4 mb-3" style="border:1.5px solid var(--pk3);border-radius:var(--radius-lg)">
                        <h6 style="font-weight:600;color:var(--txt);margin-bottom:1rem">
                            <i class="bi bi-plus-circle-fill me-2" style="color:var(--pk)"></i>Mulai Siklus Baru
                        </h6>
                        <form action="/cycle/create" method="post" class="row g-2">
                            <input type="hidden" name="_csrf" value="<?php echo \Helpers\Csrf::token(); ?>">
                            <div class="col-12">
                                <label class="form-label">Tanggal Mulai Menstruasi</label>
                                <input class="form-control" type="date" name="start_date"
                                    value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Durasi Siklus (hari)</label>
                                <input class="form-control" type="number" name="cycle_length" value="28" min="21" max="35"
                                    required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Durasi Menstruasi (hari)</label>
                                <input class="form-control" type="number" name="period_length" value="5" min="2" max="10"
                                    required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <a class="btn btn-outline-secondary" href="/dashboard">
                        <i class="bi bi-speedometer2 me-2"></i>Buka Dashboard
                    </a>
                <?php else: ?>
                    <div class="d-flex gap-3 flex-wrap">
                        <a class="btn btn-primary btn-lg" href="/register">
                            <i class="bi bi-person-plus me-2"></i>Daftar Gratis
                        </a>
                        <a class="btn btn-outline-secondary btn-lg" href="/login">
                            Masuk <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <p class="mt-3" style="font-size:0.82rem;color:var(--muted)">
                        <i class="bi bi-shield-check me-1"></i>Gratis selamanya · Tidak perlu kartu kredit · Data
                        terlindungi
                    </p>
                <?php endif; ?>
            </div>

            <!-- Right: Floating Cards Visual -->
            <div class="col-lg-6 d-none d-lg-block">
                <div style="position:relative;height:420px">

                    <!-- Card 1: Next period -->
                    <div class="hero-float-card" style="position:absolute;top:0;left:0;width:200px">
                        <div class="hfc-label"><i class="bi bi-calendar-event me-1"></i>Siklus berikutnya</div>
                        <div class="hfc-value">14 hari</div>
                        <div class="hfc-sub">Estimasi: 1 Juli 2025</div>
                        <span
                            style="display:inline-block;margin-top:6px;background:var(--pk4);color:var(--pk);font-size:0.7rem;font-weight:600;padding:3px 10px;border-radius:20px">
                            <i class="bi bi-check-circle me-1"></i>Prediksi akurat
                        </span>
                    </div>

                    <!-- Card 2: Calendar dots -->
                    <div class="hero-float-card" style="position:absolute;top:20px;right:0;width:220px;animation-delay:0.4s">
                        <div class="hfc-label"><i class="bi bi-grid me-1"></i>Kalender</div>
                        <div class="cycle-dots mt-2">
                            <?php
                            $states = ['p', 'p', 'p', 'p', 'p', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'pr', 'pr', 'pr', 'pr', '', '', ''];
                            foreach (array_slice($states, 0, 28) as $s):
                                $cls = $s === 'p' ? 'period' : ($s === 'pr' ? 'predicted' : '');
                                ?>
                                <div class="c-dot <?php echo $cls; ?>"></div>
                            <?php endforeach; ?>
                        </div>
                        <div class="d-flex gap-2 mt-2" style="font-size:0.7rem;color:var(--muted)">
                            <span><span
                                    style="display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--pk);margin-right:3px"></span>Menstruasi</span>
                            <span><span
                                    style="display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--pk3);margin-right:3px"></span>Prediksi</span>
                        </div>
                    </div>

                    <!-- Card 3: Mood -->
                    <div class="hero-float-card" style="position:absolute;top:160px;left:40px;width:190px;animation-delay:0.8s">
                        <div class="hfc-label"><i class="bi bi-emoji-smile me-1"></i>Log hari ini</div>
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <span style="font-size:1.8rem">😊</span>
                            <div>
                                <div style="font-size:0.9rem;font-weight:600;color:var(--txt)">Sangat Baik</div>
                                <div style="font-size:0.72rem;color:var(--muted)">Energi ●●●●○</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Insight -->
                    <div class="hero-float-card" style="position:absolute;bottom:60px;right:10px;width:210px;animation-delay:1.2s">
                        <div class="hfc-label"><i class="bi bi-graph-up-arrow me-1"></i>Insight minggu ini</div>
                        <div style="margin-top:8px">
                            <div style="display:flex;justify-content:space-between;font-size:0.75rem;margin-bottom:4px">
                                <span style="color:var(--txt2)">Energi rata-rata</span>
                                <span style="font-weight:600;color:var(--pk)">4.2 / 5</span>
                            </div>
                            <div style="height:6px;background:var(--pk4);border-radius:4px;overflow:hidden">
                                <div
                                    style="width:84%;height:100%;background:linear-gradient(90deg,var(--pk),var(--pk2));border-radius:4px">
                                </div>
                            </div>
                            <div style="display:flex;justify-content:space-between;font-size:0.75rem;margin:8px 0 4px">
                                <span style="color:var(--txt2)">Mood positif</span>
                                <span style="font-weight:600;color:var(--gr)">6 dari 7 hari</span>
                            </div>
                            <div style="height:6px;background:var(--gr4);border-radius:4px;overflow:hidden">
                                <div style="width:86%;height:100%;background:var(--gr);border-radius:4px"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== STATS SECTION ===== -->
<div class="container-lg my-5">
    <div class="stats-section">
        <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
            <div class="stat-num">98%</div>
            <div class="stat-label">Akurasi prediksi siklus</div>
        </div>
    </div>
</div>

<!-- ===== FEATURES SECTION ===== -->
<section class="py-5">
    <div class="container-lg">
        <div class="text-center mb-5">
            <span class="section-badge">Fitur Unggulan</span>
            <h2 class="section-title">Semua yang kamu butuhkan,<br>dalam satu tempat</h2>
            <p class="section-sub mx-auto">Dirancang khusus untuk mendampingi perjalanan kesehatan reproduksimu setiap
                hari.</p>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="feat-card">
                    <div class="feat-icon-wrap fi-pk">
                        <i class="bi bi-calendar-heart" style="color:var(--pk);font-size:1.4rem"></i>
                    </div>
                    <h5 style="font-size:1rem;font-weight:600;margin-bottom:0.5rem">Pelacak Siklus</h5>
                    <p style="font-size:0.875rem;color:var(--txt2);line-height:1.65;margin:0">Catat tanggal mulai,
                        durasi siklus, dan menstruasi. Dapatkan prediksi otomatis untuk bulan-bulan ke depan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card">
                    <div class="feat-icon-wrap fi-pu">
                        <i class="bi bi-journal-richtext" style="color:var(--pu);font-size:1.4rem"></i>
                    </div>
                    <h5 style="font-size:1rem;font-weight:600;margin-bottom:0.5rem">Jurnal Harian</h5>
                    <p style="font-size:0.875rem;color:var(--txt2);line-height:1.65;margin:0">Log mood, tingkat energi,
                        dan gejala setiap hari. Temukan pola tersembunyi dalam 30 detik.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card">
                    <div class="feat-icon-wrap fi-te">
                        <i class="bi bi-graph-up-arrow" style="color:var(--te);font-size:1.4rem"></i>
                    </div>
                    <h5 style="font-size:1rem;font-weight:600;margin-bottom:0.5rem">Insights & Analitik</h5>
                    <p style="font-size:0.875rem;color:var(--txt2);line-height:1.65;margin:0">Visualisasi tren mood dan
                        energi. Lihat gejala paling sering dan pola siklus dalam grafik interaktif.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card">
                    <div class="feat-icon-wrap fi-am">
                        <i class="bi bi-bell-fill" style="color:var(--am);font-size:1.4rem"></i>
                    </div>
                    <h5 style="font-size:1rem;font-weight:600;margin-bottom:0.5rem">Pengingat Pintar</h5>
                    <p style="font-size:0.875rem;color:var(--txt2);line-height:1.65;margin:0">Notifikasi H-3 sebelum
                        menstruasi tiba. Tidak ada lagi momen yang terlewat tanpa persiapan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card">
                    <div class="feat-icon-wrap fi-bl">
                        <i class="bi bi-shield-lock-fill" style="color:var(--bl);font-size:1.4rem"></i>
                    </div>
                    <h5 style="font-size:1rem;font-weight:600;margin-bottom:0.5rem">Privasi Terjaga</h5>
                    <p style="font-size:0.875rem;color:var(--txt2);line-height:1.65;margin:0">Data kesehatanmu
                        dilindungi sepenuhnya dengan enkripsi. Hanya kamu yang bisa melihat catatanmu.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card">
                    <div class="feat-icon-wrap fi-gr">
                        <i class="bi bi-phone-fill" style="color:var(--gr);font-size:1.4rem"></i>
                    </div>
                    <h5 style="font-size:1rem;font-weight:600;margin-bottom:0.5rem">Akses di Mana Saja</h5>
                    <p style="font-size:0.875rem;color:var(--txt2);line-height:1.65;margin:0">Gunakan MyKit di browser,
                        ponsel, atau tablet. Data tersinkronisasi otomatis di semua perangkat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== HOW IT WORKS ===== -->
<section class="py-5" style="background:linear-gradient(170deg,var(--pk5) 0%,#F8F0FF 100%)">
    <div class="container-lg">
        <div class="text-center mb-5">
            <span class="section-badge">Cara Kerja</span>
            <h2 class="section-title">Mulai dalam 4 langkah mudah</h2>
            <p class="section-sub mx-auto">Tidak perlu pengalaman teknologi. Cukup ikuti langkahnya.</p>
        </div>
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="step-card">
                    <div class="step-num">1</div>
                    <h6 style="font-weight:600;margin-bottom:0.5rem">Daftar Akun</h6>
                    <p style="font-size:0.83rem;color:var(--txt2);margin:0">Buat akun gratis hanya dengan email. Tidak
                        perlu kartu kredit.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="step-card">
                    <div class="step-num">2</div>
                    <h6 style="font-weight:600;margin-bottom:0.5rem">Input Siklus Pertama</h6>
                    <p style="font-size:0.83rem;color:var(--txt2);margin:0">Masukkan tanggal terakhir menstruasi dan
                        panjang siklusmu.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="step-card">
                    <div class="step-num">3</div>
                    <h6 style="font-weight:600;margin-bottom:0.5rem">Catat Setiap Hari</h6>
                    <p style="font-size:0.83rem;color:var(--txt2);margin:0">Log mood, energi, dan gejala hanya dalam 30
                        detik per hari.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="step-card">
                    <div class="step-num">4</div>
                    <h6 style="font-weight:600;margin-bottom:0.5rem">Lihat Insights</h6>
                    <p style="font-size:0.83rem;color:var(--txt2);margin:0">Temukan pola dan prediksi yang
                        dipersonalisasi khusus untukmu.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<!-- <section class="py-5">
    <div class="container-lg">
        <div class="text-center mb-5">
            <span class="section-badge">Testimoni</span>
            <h2 class="section-title">Apa kata pengguna MyKit?</h2>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <p style="font-size:0.875rem;color:var(--txt2);line-height:1.7;margin-bottom:1rem">"Aplikasi ini benar-benar mengubah cara aku memahami tubuhku sendiri. Prediksinya sangat akurat!"</p>
                    <div class="d-flex align-items-center gap-2">
                        <div class="testi-avatar">R</div>
                        <div>
                            <div style="font-size:0.85rem;font-weight:600">Rina, 24</div>
                            <div style="font-size:0.75rem;color:var(--muted)">Jakarta</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <p style="font-size:0.875rem;color:var(--txt2);line-height:1.7;margin-bottom:1rem">"Simple, bersih, dan tidak bikin overwhelmed. Akhirnya aku konsisten mencatat siklus setiap bulan."</p>
                    <div class="d-flex align-items-center gap-2">
                        <div class="testi-avatar" style="background:var(--pu4);color:var(--pu)">S</div>
                        <div>
                            <div style="font-size:0.85rem;font-weight:600">Sari, 29</div>
                            <div style="font-size:0.75rem;color:var(--muted)">Bandung</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <p style="font-size:0.875rem;color:var(--txt2);line-height:1.7;margin-bottom:1rem">"Insights-nya membantu aku menjelaskan ke dokter tentang pola gejala yang aku rasakan. Sangat berguna!"</p>
                    <div class="d-flex align-items-center gap-2">
                        <div class="testi-avatar" style="background:var(--te4);color:var(--te)">D</div>
                        <div>
                            <div style="font-size:0.85rem;font-weight:600"></div>
                            <div style="font-size:0.75rem;color:var(--muted)">Surabaya</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- ===== CTA SECTION ===== -->
<div class="container-lg pb-5">
    <div class="cta-section">
        <i class="bi bi-heart-pulse-fill" style="font-size:2.5rem;margin-bottom:1rem;display:block;opacity:0.9"></i>
        <h2 style="font-size:1.8rem;font-weight:700;margin-bottom:0.75rem">Mulai perjalanan menuju<br>kesehatan yang
            lebih baik hari ini</h2>
        <a href="/register" class="btn btn-white btn-lg"
            style="background:#fff;color:var(--pk);font-weight:600;border-radius:var(--radius);padding:0.85rem 2.5rem;text-decoration:none;display:inline-block">
            Daftar Gratis Sekarang <i class="bi bi-arrow-right ms-2"></i>
        </a>
    </div>
</div>

<?php $content = ob_get_clean();
require __DIR__ . '/layout.php'; ?>