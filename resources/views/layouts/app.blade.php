<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Halodog</title>
    <link rel="icon" href="{{ asset('images/dog.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* 🎨 Palet warna utama */
        :root {
            --primary-red: #DC143C;
            --accent-pink: #F75270;
            --soft-pink: #F7CAC9;
            --cream: #FDEBD0;
        }

        /* Tombol login dan register */
        .btn-login {
            background-color: var(--primary-red);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: var(--accent-pink);
            color: white;
        }

        .btn-register {
            background-color: var(--accent-pink);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background-color: var(--soft-pink);
            color: var(--primary-red);
        }

        /* Navbar */
        .navbar {
            background-color: var(--cream) !important;
        }

        .nav-link,
        .navbar-brand span {
            color: var(--primary-red) !important;
        }

        .dropdown-item:active {
            background-color: var(--accent-pink);
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('products.index') }}">
                <img src="{{ asset('images/halodoc.png') }}" alt="HaloDog Logo"
                    style="height: 60px; width: auto; margin-right: 8px;">
            </a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="rounded-circle me-2"
                                style="width: 32px; height: 32px;">
                            <span>{{ Auth::user()->username ?? 'User' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="bi bi-person-circle me-2"></i> Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('transactions.index') }}">
                                    <i class="bi bi-clock-history me-2"></i> Riwayat Transaksi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('cart.index') }}">
                                    <i class="bi bi-cart me-2"></i> Keranjang
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="btn btn-login me-2" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-register" href="{{ route('register') }}">Register</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    @stack('scripts')
</body>

</html>