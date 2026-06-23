<?php
function asset($path)
{
    echo '/assets/' . ltrim($path, '/');
}
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>
        <?php echo isset($title) ? htmlspecialchars($title) . ' — MyKit' : 'MyKit · Pendamping Siklus Menstruasimu'; ?>
    </title>
    <link rel="icon" type="image/png" href="/assets/images/logo2.png">
    <link rel="shortcut icon" type="image/png" href="/assets/images/logo2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- ===== Navbar ===== -->
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container-lg">
            <a class="navbar-brand d-flex align-items-center" href="/" aria-label="MyKit">
                <img src="/assets/images/logo2.png" alt="MyKit" height="50" width="50" class="me-2">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navCollapse" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
                    <?php $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>
                    <li class="nav-item"><a class="nav-link <?php echo $currentPath === '/' ? 'active' : ''; ?>"
                            href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo $currentPath === '/about' ? 'active' : ''; ?>"
                            href="/about">About</a></li>
                    <li class="nav-item"><a
                            class="nav-link <?php echo $currentPath === '/dashboard' ? 'active' : ''; ?>"
                            href="/dashboard"><i class="bi bi-calendar3 me-1"></i>Pelacak</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo $currentPath === '/insights' ? 'active' : ''; ?>"
                            href="/insights"><i class="bi bi-graph-up me-1"></i>Insights</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <?php if (!empty($_SESSION['user_id'])):
                        $u = (new \Models\User($GLOBALS['app']->db()))->find($_SESSION['user_id']);
                        ?>
                        <div class="d-flex align-items-center gap-2">
                            <div
                                style="width:40px;height:40px;border-radius:50%;background:var(--pk4);border:2px solid var(--pk3);display:flex;align-items:center;justify-content:center;font-size:0.8rem;font-weight:700;color:var(--pk)">
                                <?php echo strtoupper(substr($u['name'] ?? 'U', 0, 1)); ?>
                            </div>
                            <span
                                style="font-size:1rem;font-weight:500;color:var(--txt2)"><?php echo htmlspecialchars($u['name'] ?? 'User'); ?></span>
                        </div>
                        <a class="btn btn-outline-secondary btn-sm" href="/logout">
                            <i class="bi bi-box-arrow-right me-1"></i>Keluar
                        </a>
                    <?php else: ?>
                        <a class="btn btn-outline-primary btn-sm" href="/login">Masuk</a>
                        <a class="btn btn-primary btn-sm" href="/register">Daftar Gratis</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- ===== Flash Message ===== -->
    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="container-lg pt-3">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle me-2"></i>
                <?php echo htmlspecialchars($_SESSION['flash']);
                unset($_SESSION['flash']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        </div>
    <?php endif; ?>

    <!-- ===== Main Content ===== -->
    <main class="flex-grow-1">
        <?php if (isset($content))
            echo $content; ?>
    </main>

    <!-- ===== Footer ===== -->
    <footer class="mt-auto">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-md-4 mb-2 mb-md-0">
                    <img src="/assets/images/logo2.png" alt="MyKit" height="50" width="120" class="me-2">
                    <span class="ms-2">— Pendamping siklus menstruasimu</span>
                </div>
                <div class="col-md-4 text-center mb-2 mb-md-0">
                    <small>© 2026 MyKit. Dibuat dengan <i class="bi bi-heart-fill" style="color:var(--pk)"></i> untuk
                        wanita Indonesia.</small>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="/privacy" class="text-decoration-none me-3"
                        style="color:var(--muted);font-size:0.85rem">Privasi</a>
                    <a href="/terms" class="text-decoration-none" style="color:var(--muted);font-size:0.85rem">Syarat &
                        Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>