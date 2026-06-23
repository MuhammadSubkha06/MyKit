<?php
$title = 'Kebijakan Privasi';
ob_start();
?>

<style>
    .privacy-hero {
        position: relative;
        padding: 4rem 0 3rem;
        overflow: hidden;
        text-align: center;
    }
    .privacy-hero::before {
        content: '';
        position: absolute;
        inset: -40% -10% auto -10%;
        height: 480px;
        background: radial-gradient(circle at 30% 30%, rgba(236, 72, 153, 0.18), transparent 60%),
                    radial-gradient(circle at 75% 60%, rgba(168, 85, 247, 0.16), transparent 55%);
        filter: blur(10px);
        z-index: 0;
        pointer-events: none;
    }
    .privacy-hero .hero-inner { position: relative; z-index: 1; }

    .glow-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.45rem 1.1rem;
        border-radius: 999px;
        background: linear-gradient(135deg, #fde2f3, #ede4fb);
        color: #c026a3;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 0.03em;
        box-shadow: 0 6px 18px rgba(236, 72, 153, 0.18);
    }

    .gradient-title {
        font-weight: 800;
        margin-top: 1rem;
        background: linear-gradient(120deg, #db2777 0%, #a855f7 60%, #7c3aed 100%);
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
        border: 1px solid #f3d4ec;
        color: #9d174d;
        font-size: 0.82rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }

    .intro-banner {
        position: relative;
        border-radius: 26px;
        padding: 1.75rem 2rem;
        margin-bottom: 2.25rem;
        background: linear-gradient(135deg, #fff0f8 0%, #f6effe 100%);
        border: 1px solid rgba(219, 39, 119, 0.12);
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
        background: linear-gradient(135deg, #ec4899, #a855f7);
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
        border: 1px solid #f3e3f6;
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
        background: #fdf6fb;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }
    .toc-link:hover {
        background: linear-gradient(135deg, #fde2f3, #ede4fb);
        color: #be185d;
        border-color: rgba(236, 72, 153, 0.25);
        transform: translateX(3px);
    }
    .toc-link .toc-num {
        width: 22px;
        height: 22px;
        flex-shrink: 0;
        border-radius: 50%;
        background: linear-gradient(135deg, #ec4899, #a855f7);
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
        border: 1px solid #f3e3f6;
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

    .contact-card {
        position: relative;
        border-radius: 24px;
        padding: 1.85rem 2rem;
        margin-top: 2rem;
        background: linear-gradient(135deg, #ec4899 0%, #a855f7 100%);
        color: #fff;
        overflow: hidden;
        box-shadow: 0 16px 36px rgba(168, 85, 247, 0.3);
    }
    .contact-card::after {
        content: '';
        position: absolute;
        right: -30px;
        top: -30px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
    }
    .contact-card .icon-circle-light {
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
    .contact-card a.ig-link {
        color: #fff;
        font-weight: 800;
        text-decoration: underline;
        text-decoration-color: rgba(255,255,255,0.5);
    }
    .contact-card a.ig-link:hover { text-decoration-color: #fff; }

    .nav-buttons .btn {
        border-radius: 999px;
        padding: 0.65rem 1.5rem;
        font-weight: 700;
        font-size: 0.9rem;
        border-width: 1.5px;
    }
    .btn-pink-outline {
        border-color: #ec4899;
        color: #db2777;
        background: #fff;
    }
    .btn-pink-outline:hover {
        background: linear-gradient(135deg, #ec4899, #a855f7);
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

<section class="privacy-hero">
    <div class="container-lg hero-inner">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <span class="glow-badge"><i class="bi bi-shield-lock-fill"></i> Privasi</span>
                <h1 class="gradient-title" style="font-size:2.4rem">Kebijakan Privasi MyKit</h1>
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
                    <div class="icon-circle me-3"><i class="bi bi-heart-fill"></i></div>
                    <p>
                        MyKit menghormati privasi pengguna. Kebijakan ini menjelaskan data apa yang kami kumpulkan,
                        bagaimana data digunakan, serta pilihan pengguna dalam mengelola informasi pribadi.
                    </p>
                </div>

                <div class="toc-wrap">
                    <h6><i class="bi bi-list-ul"></i> Daftar Isi</h6>
                    <div class="toc-grid">
                        <a href="#data-dikumpulkan" class="toc-link"><span class="toc-num">1</span> Data yang Dikumpulkan</a>
                        <a href="#penggunaan-data" class="toc-link"><span class="toc-num">2</span> Penggunaan Data</a>
                        <a href="#keamanan-data" class="toc-link"><span class="toc-num">3</span> Keamanan Data</a>
                        <a href="#berbagi-data" class="toc-link"><span class="toc-num">4</span> Berbagi Data</a>
                        <a href="#hak-pengguna" class="toc-link"><span class="toc-num">5</span> Hak Pengguna</a>
                        <a href="#perubahan-kebijakan" class="toc-link"><span class="toc-num">6</span> Perubahan Kebijakan</a>
                    </div>
                </div>

                <div class="d-grid">
                    <div id="data-dikumpulkan" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-pink"><i class="bi bi-database-check"></i></div>
                            <div>
                                <h5>1. Data yang Dikumpulkan</h5>
                                <p>Kami dapat mengumpulkan nama, email, data akun, tanggal siklus, panjang siklus, log mood, gejala, tingkat energi, dan catatan yang pengguna masukkan secara sadar di aplikasi.</p>
                            </div>
                        </div>
                    </div>

                    <div id="penggunaan-data" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-purple"><i class="bi bi-stars"></i></div>
                            <div>
                                <h5>2. Penggunaan Data</h5>
                                <p>Data digunakan untuk menjalankan fitur utama MyKit, seperti prediksi siklus, kalender, jurnal harian, insight, autentikasi akun, dan peningkatan kualitas layanan.</p>
                            </div>
                        </div>
                    </div>

                    <div id="keamanan-data" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-teal"><i class="bi bi-shield-lock"></i></div>
                            <div>
                                <h5>3. Keamanan Data</h5>
                                <p>Kami menerapkan praktik keamanan yang wajar untuk melindungi data pengguna. Namun, pengguna tetap perlu menjaga kerahasiaan email, password, dan akses perangkat pribadi.</p>
                            </div>
                        </div>
                    </div>

                    <div id="berbagi-data" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-amber"><i class="bi bi-share"></i></div>
                            <div>
                                <h5>4. Berbagi Data</h5>
                                <p>MyKit tidak menjual data pribadi pengguna. Data hanya dapat diproses oleh layanan pendukung yang diperlukan untuk menjalankan aplikasi, atau jika diwajibkan oleh hukum yang berlaku.</p>
                            </div>
                        </div>
                    </div>

                    <div id="hak-pengguna" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-blue"><i class="bi bi-person-gear"></i></div>
                            <div>
                                <h5>5. Hak Pengguna</h5>
                                <p>Pengguna dapat memperbarui data akun, berhenti menggunakan layanan, atau meminta bantuan terkait pengelolaan data melalui kanal resmi MyKit.</p>
                            </div>
                        </div>
                    </div>

                    <div id="perubahan-kebijakan" class="policy-section">
                        <div class="policy-card">
                            <div class="icon-box ic-green"><i class="bi bi-arrow-repeat"></i></div>
                            <div>
                                <h5>6. Perubahan Kebijakan</h5>
                                <p>Kebijakan ini dapat diperbarui sewaktu-waktu. Perubahan penting akan ditampilkan melalui halaman ini atau kanal resmi MyKit.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-card d-flex align-items-start">
                    <div class="icon-circle-light me-3"><i class="bi bi-chat-heart-fill"></i></div>
                    <div>
                        <strong>Kontak:</strong>
                        <span> Untuk pertanyaan privasi, hubungi MyKit melalui Instagram </span>
                        <a href="https://instagram.com/mykit_id" target="_blank" rel="noopener noreferrer" class="ig-link">@mykit_id</a>.
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap nav-buttons">
                    <a href="/terms" class="btn btn-pink-outline">
                        <i class="bi bi-file-text me-2"></i>Baca Syarat &amp; Ketentuan
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