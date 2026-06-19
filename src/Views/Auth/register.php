<?php ob_start(); ?>

<div style="min-height:80vh;display:flex;align-items:center;background:linear-gradient(170deg,#FFF5F8 0%,#F8F0FF 100%);padding:3rem 0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">

                <!-- Logo & Heading -->
                <div class="text-center mb-4">
                    <a href="/" style="text-decoration:none">
                        <div class="auth-brand">My<span>Kit</span></div>
                    </a>
                    <p style="font-size:0.875rem;color:var(--muted);margin-top:0.5rem">Mulai perjalanan kesehatanmu hari ini — gratis!</p>
                </div>

                <!-- Card -->
                <div class="card auth-card">
                    <div class="card-body p-4">

                        <?php if (!empty($_SESSION['flash'])): ?>
                        <div class="alert alert-warning d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?>
                        </div>
                        <?php endif; ?>

                        <h4 style="font-size:1.1rem;font-weight:700;color:var(--txt);margin-bottom:0.25rem">Buat akun baru 🌸</h4>
                        <p style="font-size:0.82rem;color:var(--muted);margin-bottom:1.5rem">Tidak perlu kartu kredit. Mulai dalam 1 menit.</p>

                        <form method="post" action="/register">
                            <input type="hidden" name="_csrf" value="<?php echo \Helpers\Csrf::token(); ?>">

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:var(--pk4);border-color:var(--border2);border-right:none">
                                        <i class="bi bi-person" style="color:var(--pk)"></i>
                                    </span>
                                    <input class="form-control" type="text" name="name" placeholder="Nama kamu"
                                        style="border-left:none;padding-left:0">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:var(--pk4);border-color:var(--border2);border-right:none">
                                        <i class="bi bi-envelope" style="color:var(--pk)"></i>
                                    </span>
                                    <input class="form-control" type="email" name="email" placeholder="kamu@email.com" required
                                        style="border-left:none;padding-left:0">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:var(--pk4);border-color:var(--border2);border-right:none">
                                        <i class="bi bi-lock" style="color:var(--pk)"></i>
                                    </span>
                                    <input class="form-control" type="password" name="password" placeholder="Min. 8 karakter" required
                                        style="border-left:none;padding-left:0">
                                </div>
                                <div style="font-size:0.72rem;color:var(--muted);margin-top:4px">
                                    <i class="bi bi-shield-check me-1"></i>Password dienkripsi dan tidak pernah dibagikan
                                </div>
                            </div>

                            <!-- Benefits mini list -->
                            <div style="background:var(--pk5);border-radius:var(--radius-sm);padding:0.75rem 1rem;margin-bottom:1rem;border:0.5px solid var(--pk3)">
                                <div style="font-size:0.75rem;color:var(--txt2)">
                                    <div class="mb-1"><i class="bi bi-check-circle-fill me-2" style="color:var(--pk)"></i>Gratis selamanya</div>
                                    <div class="mb-1"><i class="bi bi-check-circle-fill me-2" style="color:var(--pk)"></i>Prediksi siklus akurat</div>
                                    <div><i class="bi bi-check-circle-fill me-2" style="color:var(--pk)"></i>Data privat & aman</div>
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 py-2" type="submit" style="font-size:0.95rem;border-radius:var(--radius)">
                                <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                            </button>
                        </form>

                        <div class="text-center mt-4" style="font-size:0.85rem;color:var(--muted)">
                            Sudah punya akun?
                            <a href="/login" style="color:var(--pk);font-weight:600;text-decoration:none">Masuk →</a>
                        </div>
                    </div>
                </div>

                <p class="text-center mt-4" style="font-size:0.72rem;color:var(--muted)">
                    Dengan mendaftar, kamu menyetujui <a href="#" style="color:var(--pk)">Syarat & Ketentuan</a> dan <a href="#" style="color:var(--pk)">Kebijakan Privasi</a> kami.
                </p>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>