<nav class="navbar navbar-expand-lg bg-white shadow-sm">

    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="/" aria-label="MyKit">
            <img src="/assets/images/logo.svg" alt="MyKit" height="42">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item d-flex align-items-center me-2">
                    <a class="nav-link" href="/about">
                        About
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center me-2">
                    <a class="nav-link" href="https://instagram.com/mykit_id" target="_blank" rel="noopener noreferrer" aria-label="Instagram MyKit">
                        <i class="bi bi-instagram" style="font-size:1.2rem;color:var(--pk)"></i>
                    </a>
                </li>

                <?php if (\Helpers\Auth::check()): ?>

                    <li class="nav-item">

                        <a class="nav-link" href="/dashboard">

                            Dashboard

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="/insights">

                            Insights

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="btn btn-outline-danger ms-2" href="/logout">

                            Logout

                        </a>

                    </li>

                <?php else: ?>

                    <li class="nav-item">

                        <a class="nav-link" href="/login">

                            Login

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="btn btn-primary ms-2" href="/register">

                            Register

                        </a>

                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>

</nav>
