<?php
$title = 'Syarat dan Ketentuan';
ob_start();
?>

<style>
    .terms-hero {
        position: relative;
        padding: 4rem 0 3rem;
        overflow: hidden;
        text-align: center;
    }
    .terms-hero::before {
        content: '';
        position: absolute;
        inset: -40% -10% auto -10%;
        height: 480px;
        background: radial-gradient(circle at 30% 30%, rgba(168, 85, 247, 0.18), transparent 60%),
                    radial-gradient(circle at 75% 60%, rgba(236, 72, 153, 0.16), transparent 55%);
        filter: blur(10px);
        z-index: 0;
        pointer-events: none;
    }
    .terms-hero .hero-inner { position: relative; z-index: 1; }

    .glow-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.45rem 1.1rem;
        border-radius: 999px;
        background: linear-gradient(135deg, #ede4fb, #fde2f3);
        color: #7e22ce;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 0.03em;
        box-shadow: 0 6px 18px rgba(168, 85, 247, 0.18);
    }

    .gradient-title {
        font-weight: 800;
        margin-top: 1rem;
        background: linear-gradient(120deg, #7c3aed 0%, #a855f7 50%, #db2777 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        letter-spacing: -0.02em;
    }

    .updated-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        margin-top: 0.75rem;
        padding: 0.3rem 0.9rem;
        border-radius: 999px;
        background: #fff;
        border: 1px solid #e9d4f3;
        color: #7e22ce;
        font-size: 0.82rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }

    .intro-banner {
        position: relative;
        border-radius: 26px;
        padding: 1.75rem 2rem;
        margin-bottom: 2.25rem;
        background: linear-gradient(135deg, #f6effe 0%, #fff0f8 100%);
        border: 1px solid rgba(168, 85, 247, 0.14);
        box-shadow: 0 10px 30px rgba(168, 85, 247, 0.08);
    }
    .intro-banner .icon-circle {
        width: 52px;
        height: 52px;
        flex-shrink: 0;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #a855f7, #ec4899);
        color: #fff;
        font-size: 1.3rem;
        box-shadow: 0 8px 18px rgba(168, 85, 247, 0.35);
    }
    .intro-banner p {
        color: #6b5b6e;
        margin: 0;
        line-height: 1.7;
        font-size: 0.96rem;
    }

    /* Table of contents */
    .toc-wrap {
        border-radius: 24px;
        padding: 1.5rem 1.6rem;
        margin-bottom: 2.25rem;
        background: #ffffff;
        border: 1px solid #f0e3f6;
        box-shadow: 0 8px 24px rgba(168, 85, 247, 0.07);
    }
    .toc-wrap h6 {
        font-weight: 800;
        font-size: 0.78rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #a855f7;
        margin-bottom: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .toc-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.55rem;
    }
    @media (max-width: 576px) {
        .toc-grid { grid-template-columns: 1fr; }
    }
    .toc-link {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.55rem 0.8rem;
        border-radius: 14px;
        text-decoration: none;
        color: #6b5b6e;
        font-size: 0.86rem;
        font-weight: 600;
        background: #fbf6fd;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }
    .toc-link:hover {
        background: linear-gradient(135deg, #ede4fb, #fde2f3);
        color: #7e22ce;
        border-color: rgba(168, 85, 247, 0.25);
        transform: translateX(3px);
    }
    .toc-link .toc-num {
        width: 22px;
        height: 22px;
        flex-shrink: 0;
        border-radius: 50%;
        background: linear-gradient(135deg, #a855f7, #ec4899);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Section cards */
    .policy-section {
        scroll-margin-top: 100px;
    }
    .policy-card {
        position: relative;
        display: flex;
        gap: 1.1rem;
        padding: 1.5rem 1.6rem;
        border-radius: 22px;
        background: #fff;
        border: 1px solid #f0e3f6;
        box-shadow: 0 6px 18px rgba(168, 85, 247, 0.06);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        margin-bottom: 1.1rem;
    }
    .policy-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 34px rgba(168, 85, 247, 0.14);
    }
    .policy-card .icon-box {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
    }
    .policy-card h5 {
        font-size: 1.02rem;
        font-weight: 800;
        color: #4a2545;
        margin-bottom: 0.45rem;
    }
    .policy-card p {
        color: #7a6a7c;
        font-size: 0.9rem;
        line-height: 1.7;
        margin: 0;
    }

    .ic-pink { background: linear-gradient(135deg, #fce7f3, #fbcfe8); color: #db2777; }
    .ic-purple { background: linear-gradient(135deg, #f3e8ff, #e9d5ff); color: #9333ea; }
    .ic-teal { background: linear-gradient(135deg, #ccfbf1, #99f6e4); color: #0d9488; }
    .ic-amber { background: linear-gradient(135deg, #fef3c7, #fde68a); color: #d97706; }
    .ic-blue { background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #2563eb; }
    .ic-green { background: linear-gradient(135deg, #dcfce7, #bbf7d0); color: #16a34a; }

    .agree-note {
        position: relative;
        border-radius: 24px;
        padding: 1.85rem 2rem;
        margin-top: 2rem;
        background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
        color: #fff;
        overflow: hidden;
        box-shadow: 0 16px 36px rgba(168, 85, 247, 0.3);
    }
    .agree-note::after {
        content: '';
        position: absolute;
        right: -30px;
        top: -30px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
    }
    .agree-note .icon-circle-light {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: rgba(255,255,255,0.22);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .nav-buttons .btn {
        border-radius: 999px;
        padding: 0.65rem 1.5rem;
        font-weight: 700;
        font-size: 0.9rem;
        border-width: 1.5px;
    }
    .btn-purple-outline {
        border-color: #a855f7;
        color: #7e22ce;
        background: #fff;
    }
    .btn-purple-outline:hover {
        background: linear-gradient(135deg, #a855f7, #ec4899);
        border-color: transparent;
        color: #fff;
    }
    .btn-soft-outline {
        border-color: #d8c7da;
        color: #6b5b6e;
        background: #fff;
    }
    .btn-soft-outline:hover {
        background: #f7eef6;
        color: #4a2545;
        border-color: #d8c7da;
    }
</style>

<section class="terms-hero">
    <div class="container-lg hero-inner">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <span class="glow-badge"><i class="bi bi-file-text-fill"></i> S&amp;K</span>
                <h1 class="gradient-title" style="font-size:2.4rem">Syarat dan Ketentuan MyKit</h1>
                <div>
                    <span class="updated-pill"><i class="bi bi-clock-history"></i> Terakhir diperbarui: 20 Juni 2026</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="intro-banner d-flex align-items-start">
                    <div class="icon-circle me-3"><i class="bi bi-journal-check"></i></div>
                    <p>
                        Dengan menggunakan website, tracker, atau produk MyKit, pengguna dianggap telah membaca
                        dan menyetujui syarat dan ketentuan berikut.
                    </p>
                </div>

                <div class="toc-wrap">
                    <h6><i class="bi bi-list-ul"></i> Daftar Isi</h6>
                    <div class="toc-grid">
                        <a href="#penggunaan-layanan" class="toc-link"><span class="toc-num">1</span> Penggunaan Layanan</a>
                        <a href="#bukan-nasihat-medis" class="toc-link"><span class="toc-num">2</span> Bukan Nasihat Medis</a>
                        <a href="#akun-pengguna" class="toc-link"><span class="toc-num">3</span> Akun Pengguna</a>
                        <a href="#akurasi-data" class="toc-link"><span class="toc-num">4</span> Akurasi Data</a>
                        <a href="#hak-kekayaan-intelektual" class="toc-link"><span class="toc-num">5</span> Hak Kekayaan Intelektual</a>
                        <a href="#perubahan-ketentuan" class="toc-link"><span class="toc-num">6</span> Perubahan Ketentuan</a>
                    </div>
                </div>

                <div class="d-grid">
                    <div id="penggunaan-layanan" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-pink"><i class="bi bi-check2-circle"></i></div>
                            <div>
                                <h5>1. Penggunaan Layanan</h5>
                                <p>MyKit disediakan untuk membantu pengguna mencatat siklus menstruasi, log harian, dan informasi pendukung lainnya. Pengguna wajib memakai layanan secara bertanggung jawab.</p>
                            </div>
                        </div>
                    </div>

                    <div id="bukan-nasihat-medis" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-purple"><i class="bi bi-heart-pulse"></i></div>
                            <div>
                                <h5>2. Bukan Pengganti Nasihat Medis</h5>
                                <p>Prediksi dan insight MyKit bersifat informatif. MyKit bukan alat diagnosis dan tidak menggantikan konsultasi dengan dokter, bidan, psikolog, atau tenaga kesehatan profesional.</p>
                            </div>
                        </div>
                    </div>

                    <div id="akun-pengguna" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-teal"><i class="bi bi-person-lock"></i></div>
                            <div>
                                <h5>3. Akun Pengguna</h5>
                                <p>Pengguna bertanggung jawab menjaga keamanan akun, email, password, dan perangkat yang digunakan untuk mengakses MyKit.</p>
                            </div>
                        </div>
                    </div>

                    <div id="akurasi-data" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-amber"><i class="bi bi-clipboard2-data"></i></div>
                            <div>
                                <h5>4. Akurasi Data</h5>
                                <p>Kualitas prediksi bergantung pada data yang dimasukkan pengguna. MyKit tidak bertanggung jawab atas keputusan yang dibuat hanya berdasarkan estimasi aplikasi.</p>
                            </div>
                        </div>
                    </div>

                    <div id="hak-kekayaan-intelektual" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-blue"><i class="bi bi-palette"></i></div>
                            <div>
                                <h5>5. Hak Kekayaan Intelektual</h5>
                                <p>Nama, logo, tampilan, teks, desain, dan materi MyKit dilindungi sebagai aset MyKit. Penggunaan ulang untuk kepentingan komersial memerlukan izin tertulis.</p>
                            </div>
                        </div>
                    </div>

                    <div id="perubahan-ketentuan" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-green"><i class="bi bi-arrow-repeat"></i></div>
                            <div>
                                <h5>6. Perubahan Ketentuan</h5>
                                <p>MyKit dapat memperbarui ketentuan ini sesuai kebutuhan produk, regulasi, atau kebijakan operasional. Versi terbaru akan tersedia pada halaman ini.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="agree-note d-flex align-items-start">
                    <div class="icon-circle-light me-3"><i class="bi bi-patch-check-fill"></i></div>
                    <div>
                        <strong>Dengan terus menggunakan MyKit,</strong>
                        <span> kamu menyetujui seluruh syarat dan ketentuan di atas. Kalau ada pertanyaan, jangan ragu hubungi tim kami.</span>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap nav-buttons">
                    <a href="/privacy" class="btn btn-purple-outline">
                        <i class="bi bi-shield-check me-2"></i>Baca Kebijakan Privasi
                    </a>
                    <a href="/" class="btn btn-soft-outline">
                        <i class="bi bi-house me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>