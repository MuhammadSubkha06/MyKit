<?php
$title = 'Tentang';
ob_start();
?>

<style>
    .about-hero {
        position: relative;
        overflow: hidden;
    }
    .about-hero::before {
        content: '';
        position: absolute;
        inset: -20% -10% auto -10%;
        height: 600px;
        background: radial-gradient(circle at 15% 20%, rgba(232, 49, 106, 0.12), transparent 55%),
                    radial-gradient(circle at 85% 50%, rgba(124, 58, 237, 0.10), transparent 55%);
        z-index: 0;
        pointer-events: none;
    }
    .about-hero > .container-lg { position: relative; z-index: 1; }

    .section-badge.glow {
        background: linear-gradient(135deg, #fde2f3, #ede4fb);
        color: #be185d;
        box-shadow: 0 6px 16px rgba(232, 49, 106, 0.14);
    }

    .about-mini-card {
        position: relative;
        border-radius: var(--radius);
        background: #fff;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        border: 1px solid var(--border2);
    }
    .about-mini-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 32px rgba(232, 49, 106, 0.14);
        border-color: rgba(232, 49, 106, 0.25);
    }
    .about-mini-card .feat-icon-wrap {
        transition: transform 0.25s ease;
    }
    .about-mini-card:hover .feat-icon-wrap {
        transform: scale(1.1) rotate(-4deg);
    }

    .kit-item {
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }
    .kit-item:hover {
        transform: translateY(-3px) translateX(2px);
        box-shadow: 0 10px 22px rgba(232, 49, 106, 0.12);
    }
    .kit-item .icon-pop {
        transition: transform 0.22s ease, background 0.22s ease;
    }
    .kit-item:hover .icon-pop {
        transform: scale(1.12);
        background: linear-gradient(135deg, var(--pk), var(--pu)) !important;
    }
    .kit-item:hover .icon-pop i {
        color: #fff !important;
    }

    .cta-section.glow-cta {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #E8316A 0%, #7C3AED 100%);
    }
    .cta-section.glow-cta::after {
        content: '';
        position: absolute;
        right: -60px;
        bottom: -60px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,0.10);
    }
    .cta-section.glow-cta::before {
        content: '';
        position: absolute;
        left: -40px;
        top: -40px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }
    .cta-section.glow-cta .btn-white:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 26px rgba(0,0,0,0.18);
    }
    .cta-section.glow-cta .btn-white {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    @keyframes floatSoft {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-6px); }
    }
    .float-anim { animation: floatSoft 4s ease-in-out infinite; }
</style>

<section class="py-5 about-hero">
    <div class="container-lg">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="section-badge glow"><i class="bi bi-flower2 me-1"></i> Tentang MyKit</span>
                <h1 class="section-title text-start mt-3" style="max-width:640px">
                    Pouch menstruasi siap pakai, terhubung dengan tracker digital.
                </h1>
                <p class="section-sub text-start" style="max-width:620px">
                    MyKit membantu perempuan tetap tenang saat menstruasi datang tidak terduga. Di dalam satu pouch kecil, kamu mendapatkan perlengkapan darurat yang higienis sekaligus akses ke tracker siklus berbasis website melalui QR code.
                </p>
                <div class="d-flex gap-3 flex-wrap mt-4">
                    <a href="/register" class="btn btn-primary btn-lg">
                        <i class="bi bi-person-plus me-2"></i>Mulai Tracking
                    </a>
                    <a href="https://instagram.com/mykit_id" target="_blank" rel="noopener noreferrer" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-instagram me-2"></i>@mykit_id
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="about-mini-card feat-card h-100">
                            <div class="feat-icon-wrap fi-pk"><i class="bi bi-bag-heart" style="color:var(--pk);font-size:1.4rem"></i></div>
                            <h5 style="font-size:1rem;font-weight:700">Pouch Praktis</h5>
                            <p style="color:var(--txt2);font-size:0.875rem;margin:0">Ringkas untuk dibawa ke sekolah, kampus, kantor, atau perjalanan.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="about-mini-card feat-card h-100 float-anim" style="animation-delay:0.3s">
                            <div class="feat-icon-wrap fi-te"><i class="bi bi-qr-code-scan" style="color:var(--te);font-size:1.4rem"></i></div>
                            <h5 style="font-size:1rem;font-weight:700">QR Tracker</h5>
                            <p style="color:var(--txt2);font-size:0.875rem;margin:0">Scan QR untuk dapat akses pencatatan siklus, mood, gejala, dan energi harian.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="about-mini-card feat-card h-100 float-anim" style="animation-delay:0.6s">
                            <div class="feat-icon-wrap fi-am"><i class="bi bi-thermometer-sun" style="color:var(--am);font-size:1.4rem"></i></div>
                            <h5 style="font-size:1rem;font-weight:700">Lebih Nyaman</h5>
                            <p style="color:var(--txt2);font-size:0.875rem;margin:0">Mini heat patch membantu meredakan rasa tidak nyaman saat kram.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="about-mini-card feat-card h-100">
                            <div class="feat-icon-wrap fi-bl"><i class="bi bi-shield-check" style="color:var(--bl);font-size:1.4rem"></i></div>
                            <h5 style="font-size:1rem;font-weight:700">Higienis</h5>
                            <p style="color:var(--txt2);font-size:0.875rem;margin:0">Kantong sanitasi dan sabun mini menjaga kebersihan saat darurat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background:linear-gradient(170deg,var(--surface) 0%,#FBF6FD 100%)">
    <div class="container-lg">
        <div class="row g-4 align-items-start">
            <div class="col-lg-5">
                <span class="section-badge glow">Isi MyKit</span>
                <h2 class="section-title text-start mt-3">Semua kebutuhan utama dalam satu kit.</h2>
                <p class="section-sub text-start">Setiap item dipilih untuk membantu pengguna bergerak cepat, tetap bersih, dan merasa lebih siap.</p>
            </div>
            <div class="col-lg-7">
                <div class="row g-3">
                    <?php
                    $items = [
                        ['bi-droplet-fill', 'Pembalut', 'Untuk kebutuhan menstruasi darurat yang higienis.'],
                        ['bi-fire', 'Mini Heat Patch', 'Membantu memberi rasa hangat saat kram datang.'],
                        ['bi-trash3-fill', 'Kantong Sanitasi', 'Menyimpan limbah dengan lebih rapi dan bersih.'],
                        ['bi-soap-fill', 'Sabun Cair Mini', 'Menjaga kebersihan tangan dan area sekitar.'],
                        ['bi-phone-fill', 'Web Tracker', 'Mencatat siklus, log harian, dan insight kesehatan.'],
                        ['bi-qr-code', 'QR Access', 'Akses cepat ke tracker tanpa instal aplikasi tambahan.'],
                    ];
                    foreach ($items as $item):
                    ?>
                    <div class="col-md-6">
                        <div class="kit-item d-flex gap-3 p-3 h-100" style="background:var(--pk5);border:1px solid var(--border2);border-radius:var(--radius)">
                            <div class="icon-pop" style="width:42px;height:42px;border-radius:12px;background:#fff;display:flex;align-items:center;justify-content:center;color:var(--pk);flex:0 0 auto">
                                <i class="bi <?php echo $item[0]; ?>"></i>
                            </div>
                            <div>
                                <h3 style="font-size:0.98rem;font-weight:700;margin:0 0 0.25rem"><?php echo $item[1]; ?></h3>
                                <p style="font-size:0.86rem;color:var(--txt2);margin:0"><?php echo $item[2]; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container-lg">
        <div class="cta-section glow-cta">
            <i class="bi bi-heart-pulse-fill" style="font-size:2.3rem;margin-bottom:1rem;display:block;opacity:0.9"></i>
            <h2 style="font-size:1.8rem;font-weight:700;margin-bottom:0.75rem">MyKit dibuat agar kamu tidak perlu panik saat tubuh memberi tanda.</h2>
            <p style="max-width:680px;margin:0 auto 1.5rem;color:rgba(255,255,255,0.88)">Mulai catat siklusmu dan kenali pola tubuh dari hari ke hari.</p>
            <a href="/register" class="btn btn-white btn-lg" style="background:#fff;color:var(--pk);font-weight:600;border-radius:var(--radius);padding:0.85rem 2.5rem;text-decoration:none;display:inline-block">
                Daftar Gratis <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>