<nav class="navbar navbar-expand-lg bg-white shadow-sm">

    <div class="container">

        <a class="navbar-brand fw-bold" href="/">

            MyKit

        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav ms-auto">

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