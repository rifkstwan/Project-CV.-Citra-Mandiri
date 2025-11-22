<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CV. Citra Mandiri - @yield('title', 'Solusi Internet Cepat')</title>

    <link rel="icon" type="image/jpeg" href="{{ asset('image/profile.jpg') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script type="text/javascript"
        src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    <img src="{{ asset('image/profile.jpg') }}" alt="profile" width="40"
                        class="rounded-circle me-2">
                    CV. Citra Mandiri

                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#paket-internet">Paket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#informasi">Informasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tentang-kami">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sosial-media">Hubungi Kami</a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center">
                        @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Log In</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                        @endif
                        @else
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if (auth()->user()->hasAnyPermission('admin-access'))
                                <li><a class="dropdown-item" href="{{ route('admin.index') }}">Admin Dashboard</a>
                                </li>
                                @else
                                <li><a class="dropdown-item" href="{{ route('user.index') }}">My Profile</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div>
        <main class="flex-shrink-0">
            @yield('content')
        </main>
    </div>

    <footer class="py-5 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div id="alamat" class="col-lg-4 col-md-6 mb-4">
                    <h5>Alamat</h5>
                    <div class="ratio ratio-16x9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d506749.9288553105!2d110.56452652142337!3d-7.127867649295776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70babb25fc5b4b%3A0x3027a76e352baf0!2sGrobogan%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1760631750437!5m2!1sen!2sid"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <div id="informasi" class="col-lg-4 col-md-6 mb-4">
                    <h5>Informasi</h5>
                    <ul class="list-unstyled">
                        <li>
                            <p><i class="fa-solid fa-phone me-2"></i>+628122577686</p>
                        </li>
                        <li>
                            <p><i class="fa-solid fa-envelope me-2"></i>citramandiri@gmail.com</p>
                        </li>
                        <li>
                            <p><i class="fa-solid fa-location-dot me-2"></i>Rt.02/Rw.01, Tegowanu Wetan, Kec. Tegowanu, Kab. Grobogan</p>
                        </li>
                    </ul>
                </div>
                <div class="text-center pt-3 border-top border-secondary">
                    <p>© {{ date('Y') }}
                    <p> CV. Citra Mandiri. All Rights Reserved.</p>
                    </p>
                </div>
            </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>