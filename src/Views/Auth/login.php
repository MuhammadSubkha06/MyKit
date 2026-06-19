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
                    <p style="font-size:0.875rem;color:var(--muted);margin-top:0.5rem">Masuk untuk melanjutkan pencatatanmu</p>
                </div>

                <!-- Card -->
                <div class="card auth-card">
                    <div class="card-body p-4">

                        <?php if (!empty($_SESSION['flash'])): ?>
                        <div class="alert alert-warning d-flex align-items-center gap-2 mb-3" style="border-radius:var(--radius-sm)">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?>
                        </div>
                        <?php endif; ?>

                        <h4 style="font-size:1.1rem;font-weight:700;color:var(--txt);margin-bottom:1.5rem">Selamat datang kembali 👋</h4>

                        <form method="post" action="/login">
                            <input type="hidden" name="_csrf" value="<?php echo \Helpers\Csrf::token(); ?>">

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
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label mb-0">Password</label>
                                    <a href="#" style="font-size:0.78rem;color:var(--pk);text-decoration:none">Lupa password?</a>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:var(--pk4);border-color:var(--border2);border-right:none">
                                        <i class="bi bi-lock" style="color:var(--pk)"></i>
                                    </span>
                                    <input class="form-control" type="password" name="password" placeholder="••••••••" required
                                        style="border-left:none;padding-left:0">
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 py-2" type="submit" style="font-size:0.95rem;border-radius:var(--radius)">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                            </button>
                        </form>

                        <div class="text-center mt-4" style="font-size:0.85rem;color:var(--muted)">
                            Belum punya akun?
                            <a href="/register" style="color:var(--pk);font-weight:600;text-decoration:none">Daftar gratis →</a>
                        </div>
                    </div>
                </div>

                <p class="text-center mt-4" style="font-size:0.75rem;color:var(--muted)">
                    <i class="bi bi-shield-check me-1"></i>Data kamu aman & terlindungi
                </p>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>