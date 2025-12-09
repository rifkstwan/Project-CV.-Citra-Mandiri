<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CV. Citra Mandiri</title>

    <link rel="icon" type="image/jpeg" href="{{ asset('image/profile.jpg') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">
                    <img src="image/profile.jpg" alt="profile" width="40" class="rounded-circle me-2">
                    CV. Citra Mandiri
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#paket-internet">Paket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#informasi">Informasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#informasi">Hubungi Kami</a>
                        </li>

                        @if (Route::has('login'))
                        @auth
                        <li class="nav-item ms-lg-2">
                            <a href="{{ auth()->user()->hasAnyPermission('admin-access') ? route('admin.index') : route('user.index') }}" class="btn btn-outline-primary">
                                Dashboard
                            </a>
                        </li>
                        @else
                        <li class="nav-item ms-lg-2 mb-2 mb-lg-0">
                            <a href="{{ route('login') }}" type="button" class="btn btn-primary w-100">
                                Log in
                            </a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item ms-lg-2">
                            <a href="{{ route('register') }}" type="button" class="btn btn-danger w-100">
                                Daftar Sekarang
                            </a>
                        </li>
                        @endif
                        @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero-section position-relative overflow-hidden">
            <div class="container hero-content py-4">
                <div class="row align-items-center">
                    <!-- Kolom KIRI: Gambar -->
                    <div class="col-lg-5">
                        <div class="hero-image-wrapper">
                            <img src="{{ asset('image/Herosectionbackground.png') }}"
                                alt="WiFi Tercepat di Grobogan"
                                class="img-fluid hero-image">
                        </div>
                    </div>

                    <!-- Kolom KANAN: Content -->
                    <div class="col-lg-7">
                        <div class="text-white">
                            <!-- Badge Kuning -->
                            <div class="mb-3 mt-3">
                                <span class="badge bg-warning text-dark px-4 py-2 rounded-pill shadow-lg fw-bold">
                                    <i class="fas fa-trophy me-2"></i>
                                    #1 WiFi Tercepat & Terstabil di Grobogan
                                </span>
                            </div>

                            <!-- Heading -->
                            <h1 class="fw-bold mb-3" style="font-size: 2.5rem; line-height: 1.2;">
                                Selamat Datang di Era Internet Ngebut...
                            </h1>
                            <p class="mb-4 fs-6" style="line-height: 1.6;">
                                Apapun aktivitas digitalmu streaming film 4K, meeting online, atau push rank pastikan koneksi WiFi kami yang jadi andalanmu
                            </p>

                            <!-- Trust Indicators -->
                            <div class="row g-3 mb-4">
                                <div class="col-4">
                                    <div class="trust-box text-center p-3 bg-white rounded-3 shadow">
                                        <h4 class="fw-bold text-primary mb-0" style="font-size: 1.75rem;">1000+</h4>
                                        <small class="text-muted d-block">Pelanggan</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="trust-box text-center p-3 bg-white rounded-3 shadow">
                                        <h4 class="fw-bold text-success mb-0" style="font-size: 1.75rem;">99.9%</h4>
                                        <small class="text-muted d-block">Uptime</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="trust-box text-center p-3 bg-white rounded-3 shadow">
                                        <h4 class="fw-bold text-danger mb-0" style="font-size: 1.75rem;">100Mbps</h4>
                                        <small class="text-muted d-block">Max Speed</small>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA Buttons -->
                            <div class="d-flex gap-3 mb-4">
                                <a href="#paket-internet" class="btn btn-primary btn-lg px-5 rounded-pill shadow-lg">
                                    <i class="fas fa-bolt me-2"></i>Lihat Paket
                                </a>
                                <a href="#informasi" class="btn btn-outline-light btn-lg px-5 rounded-pill" style="border-width: 2px;">
                                    <i class="fas fa-phone me-2"></i>Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Animated Cards Container - HANYA 1 KALI -->
            <div class="animated-cards-container">
                <div class="animated-card-wrapper">
                    @for ($i = 0; $i < 2; $i++)
                        <div class="feature-card">
                        <i class="fas fa-globe"></i>
                        <div class="text-content">
                            <span class="title">Unlimited</span>
                            <span class="description">Nikmati internetan tanpa batas</span>
                        </div>
                </div>
                <div class="feature-card">
                    <i class="fas fa-credit-card"></i>
                    <div class="text-content">
                        <span class="title">Kemudahan Pembayaran</span>
                        <span class="description">Pembayaran bisa lewat mana saja</span>
                    </div>
                </div>
                <div class="feature-card">
                    <i class="fas fa-user-shield"></i>
                    <div class="text-content">
                        <span class="title">Privasi Pelanggan</span>
                        <span class="description">Keamanan wifi terjamin</span>
                    </div>
                </div>
                @endfor
            </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="py-5 bg-white">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge bg-primary px-4 py-2 mb-3 rounded-pill">Keunggulan Kami</span>
                    <h2 class="fw-bold display-6">Mengapa WiFi Kami Tercepat & Terstabil di Grobogan?</h2>
                    <p class="text-muted lead">Teknologi terdepan untuk pengalaman internet maksimal</p>
                </div>

                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="text-center p-4 h-100 border rounded-4 shadow-sm hover-lift">
                            <div class="icon-circle bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="fas fa-rocket fa-2x text-primary"></i>
                            </div>
                            <h5 class="fw-bold">Fiber Optik</h5>
                            <p class="text-muted small mb-0">Teknologi kabel optik tercepat untuk koneksi super stabil</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="text-center p-4 h-100 border rounded-4 shadow-sm hover-lift">
                            <div class="icon-circle bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="fas fa-signal fa-2x text-success"></i>
                            </div>
                            <h5 class="fw-bold">24/7 Uptime</h5>
                            <p class="text-muted small mb-0">Jaminan koneksi non-stop tanpa gangguan, 99.9% uptime</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="text-center p-4 h-100 border rounded-4 shadow-sm hover-lift">
                            <div class="icon-circle bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="fas fa-headset fa-2x text-warning"></i>
                            </div>
                            <h5 class="fw-bold">Support Cepat</h5>
                            <p class="text-muted small mb-0">Tim teknisi siap bantu dalam 1 jam, support 24/7</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="text-center p-4 h-100 border rounded-4 shadow-sm hover-lift">
                            <div class="icon-circle bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="fas fa-shield-alt fa-2x text-danger"></i>
                            </div>
                            <h5 class="fw-bold">Anti Lag</h5>
                            <p class="text-muted small mb-0">Cocok untuk gaming & streaming tanpa buffering</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Package Section -->
        <section id="paket-internet" class="package-section py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge bg-success px-4 py-2 mb-3">
                        <i class="fas fa-fire me-2"></i>Paket Terpopuler
                    </span>
                    <h2 class="fw-bold display-6">Pilihan Paket Internet Terbaik</h2>
                    <p class="text-muted lead">
                        Koneksi Tercepat & Terstabil di Grobogan
                        <span class="text-primary fw-bold">| 1000+ Pelanggan Puas</span>
                    </p>
                </div>

                <div class="row" style="padding-top: 3rem;">
                    @foreach($pakets as $index => $paket)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="position-relative" style="padding-top: {{ $index === 1 ? '1.5rem' : '0' }};">

                            @if($index === 1)
                            <div class="position-absolute start-50 translate-middle-x" style="top: -0.5rem; z-index: 100;">
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-lg fw-bold" style="border: 2px solid #fff;">
                                    <i class="fas fa-star me-1"></i>TERPOPULER
                                </span>
                            </div>
                            @endif

                            <div class="card text-center h-100 shadow-lg border-0 {{ $index === 1 ? 'popular-card' : '' }}" style="border-radius: 1rem; overflow: hidden;">

                                <div class="card-header text-white py-4" style="background: linear-gradient(135deg, {{ $index === 1 ? '#dc3545, #c82333' : '#0d6efd, #0a58ca' }});">
                                    <h3 class="h4 mb-0 fw-bold">{{ $paket['nama_paket'] }}</h3>
                                </div>

                                <div class="card-body py-4">
                                    <div class="mb-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                            <i class="fas fa-gauge-high me-1"></i>Kecepatan Internet
                                        </span>
                                    </div>

                                    <p class="display-4 fw-bold text-primary mb-0">{{ $paket['kecepatan'] }}</p>
                                    <p class="text-muted small mb-4">Download & Upload</p>

                                    <hr class="my-3">

                                    <p class="text-muted small mb-1">Harga Bulanan</p>
                                    <p class="h2 fw-bold mb-0">Rp {{ number_format($paket['harga'], 0, ',', '.') }}</p>
                                    <p class="text-success small fw-bold">
                                        <i class="fas fa-check-circle me-1"></i>Hemat & Terjangkau
                                    </p>

                                    <div class="mt-4">
                                        <p class="badge bg-success mb-2 w-100 py-2">
                                            <i class="fas fa-infinity me-1"></i>Unlimited Kuota
                                        </p>
                                        <p class="badge bg-info mb-2 w-100 py-2">
                                            <i class="fas fa-shield-alt me-1"></i>Gratis Router WiFi
                                        </p>
                                        <p class="badge bg-warning text-dark mb-2 w-100 py-2">
                                            <i class="fas fa-tools me-1"></i>Gratis Instalasi
                                        </p>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent border-0 pb-4 px-4">
                                    <a href="{{ route('register') }}" class="btn {{ $index === 1 ? 'btn-danger' : 'btn-primary' }} btn-lg w-100 rounded-pill shadow">
                                        <i class="fas fa-bolt me-2"></i>Berlangganan Sekarang
                                    </a>
                                    <p class="text-muted small mt-2 mb-0">
                                        <i class="fas fa-clock me-1"></i>Aktif dalam 24 jam
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="alert alert-primary d-flex align-items-center justify-content-center gap-3 py-3 rounded-4 shadow-sm" role="alert">
                            <i class="fas fa-check-circle fa-2x"></i>
                            <div>
                                <strong>Garansi Kepuasan 100%</strong>
                                <p class="mb-0 small">Tidak puas? Uang kembali dalam 7 hari pertama!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial Section - CLEAN VERSION -->
        <section class="py-5 bg-primary text-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                        <h2 class="fw-bold mb-3" style="font-size: 2.2rem; line-height: 1.3;">
                            <i class="fas fa-users me-2"></i>
                            Dipercaya oleh <span class="text-warning">1000+</span> Rumah & Bisnis di Grobogan
                        </h2>

                        <p class="lead mb-0" style="font-size: 1.1rem; line-height: 1.6;">
                            Bergabunglah dengan ribuan pelanggan yang sudah merasakan internet super cepat dan stabil dari CV. Citra Mandiri
                        </p>
                    </div>

                    <div class="col-lg-4 text-center text-lg-end">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow-lg hover-lift d-inline-block mb-3">
                            <i class="fas fa-rocket me-2"></i>
                            <strong>Daftar Sekarang</strong>
                        </a>

                        <div class="d-flex align-items-center justify-content-center justify-content-lg-end gap-3 flex-wrap">
                            <small class="text-white d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                Gratis instalasi
                            </small>
                            <small class="text-white d-flex align-items-center">
                                <i class="fas fa-headset me-2"></i>
                                Konsultasi gratis
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="py-5 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div id="alamat" class="col-lg-4 col-md-6 mb-4">
                    <h5>Alamat</h5>
                    <div class="ratio ratio-16x9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d506749.9288553105!2d110.56452652142337!3d-7.127867649295776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70babb25fc5b4b%3A0x3027a76e352baf0!2sGrobogan%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1760631750437!5m2!1sen!2sid"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <div id="informasi" class="col-lg-4 col-md-6 mb-4">
                    <h5>Informasi</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <p><i class="fa-solid fa-phone me-2"></i>+628122577686</p>
                        </li>
                        <li class="mb-3">
                            <p><i class="fa-solid fa-envelope me-2"></i>citramandiri@gmail.com</p>
                        </li>
                        <li class="mb-3">
                            <p><i class="fa-solid fa-location-dot me-2"></i>Rt.02/Rw.01, Tegowanu Wetan, Kec. Tegowanu, Kab. Grobogan</p>
                        </li>
                    </ul>
                </div>

                <div id="about" class="col-lg-4 col-md-12 mb-4">
                    <h5>About Me</h5>
                    <p class="text-light">
                        CV. Citra Mandiri adalah perusahaan yang bergerak di bidang teknologi dan layanan WiFi profesional. Kami menyediakan solusi konektivitas internet berkualitas tinggi untuk rumah, kantor, dan bisnis Anda.
                    </p>
                    <h6 class="mt-4">Layanan Kami</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fa-solid fa-check-circle text-success me-2"></i>Paket WiFi Unlimited
                        </li>
                        <li class="mb-2">
                            <i class="fa-solid fa-check-circle text-success me-2"></i>Instalasi Profesional
                        </li>
                        <li class="mb-2">
                            <i class="fa-solid fa-check-circle text-success me-2"></i>Support 24/7
                        </li>
                        <li class="mb-2">
                            <i class="fa-solid fa-check-circle text-success me-2"></i>Harga Kompetitif
                        </li>
                    </ul>
                </div>
            </div>

            <div class="text-center pt-3 border-top border-secondary">
                <p class="mb-0">© {{ date('Y') }} CV. Citra Mandiri. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>