@extends('layouts.app_1')

@section('title', 'Daftar Paket')

@section('content')

{{-- HERO SECTION - UPDATED DESIGN --}}
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

    <!-- Animated Cards -->
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

{{-- PAKET AKTIF SECTION - LOGIC TETAP TIDAK BERUBAH --}}
@if($activeOrders->count())
<section class="active-package-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-success px-4 py-2 mb-3 rounded-pill">
                <i class="fas fa-check-circle me-2"></i>Paket Aktif Anda
            </span>
            <h2 class="fw-bold display-6">Paket yang Sedang Aktif</h2>
            <p class="text-muted lead">Paket WiFi yang saat ini sedang Anda gunakan</p>
        </div>

        <div class="row justify-content-center">
            @foreach($activeOrders as $order)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center h-100 shadow-lg border-0" style="border-radius: 1rem; overflow: hidden; border: 3px solid #198754 !important;">
                    <div class="card-header bg-success text-white py-4 border-0">
                        <h3 class="h4 mb-0 fw-bold">{{ $order->paket->nama_paket }}</h3>
                    </div>
                    <div class="card-body py-4">
                        <div class="mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                <i class="fas fa-gauge-high me-1"></i>Kecepatan Internet
                            </span>
                        </div>

                        <p class="display-4 fw-bold text-success mb-0">{{ $order->paket->kecepatan }}</p>
                        <p class="text-muted small mb-4">Download & Upload</p>

                        <hr class="my-3">

                        <p class="text-muted small mb-1">Harga Bulanan</p>
                        <p class="h2 fw-bold mb-0 text-success">Rp {{ number_format($order->paket->harga, 0, ',', '.') }}</p>

                        <p class="text-muted mt-3 mb-1">Durasi Paket</p>
                        <p class="h5 fw-bold text-success">{{ $order->qty }} bulan</p>

                        <span class="badge bg-success mt-3 px-4 py-2">
                            <i class="fas fa-check-circle me-1"></i>Status: Aktif
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- WHY CHOOSE US SECTION --}}
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

{{-- PACKAGE SECTION - LOGIC TETAP TIDAK BERUBAH --}}
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
            @forelse($pakets as $index => $paket)
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

                        {{-- PERUBAHAN DI SINI: Pindahkan gradient ke inline style --}}
                        <div class="card-header text-white py-4 border-0"
                            style="background: linear-gradient(135deg, {{ $index === 1 ? '#dc3545, #c82333' : '#0d6efd, #0a58ca' }});">
                            <h3 class="h4 mb-0 fw-bold">{{ $paket->nama_paket }}</h3>
                        </div>

                        <div class="card-body py-4">
                            <div class="mb-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                    <i class="fas fa-gauge-high me-1"></i>Kecepatan Internet
                                </span>
                            </div>

                            <p class="display-4 fw-bold text-primary mb-0">{{ $paket->kecepatan }}</p>
                            <p class="text-muted small mb-4">Download & Upload</p>

                            <hr class="my-3">

                            <p class="text-muted small mb-1">Harga Bulanan</p>
                            <p class="h2 fw-bold mb-0">Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
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
                            @php
                            $hasActive = $activeOrders->count() > 0;
                            @endphp

                            <a href="{{ $hasActive ? '#' : route('pakets.show', $paket->id) }}"
                                class="btn w-100 btn-lg rounded-pill shadow fw-bold {{ $hasActive ? 'btn-secondary disabled' : ($index === 1 ? 'btn-danger' : 'btn-primary') }}">
                                <i class="fas fa-{{ $hasActive ? 'lock' : 'bolt' }} me-2"></i>
                                {{ $hasActive ? 'Paket Sedang Aktif' : 'Berlangganan Sekarang' }}
                            </a>
                            <p class="text-muted small mt-2 mb-0">
                                <i class="fas fa-clock me-1"></i>{{ $hasActive ? 'Hanya bisa 1 paket aktif' : 'Aktif dalam 24 jam' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Saat ini belum ada paket yang tersedia.
                </div>
            </div>
            @endforelse
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

{{-- TESTIMONIAL SECTION --}}
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
                <a href="{{ route('pakets.index') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow-lg hover-lift d-inline-block mb-3">
                    <i class="fas fa-rocket me-2"></i>
                    <strong>Pilih Paket Sekarang</strong>
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

@endsection

@push('styles')
<style>
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.2s ease-in-out;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }

    .popular-card {
        transform: scale(1.05);
        border: 3px solid #ffc107 !important;
        z-index: 10;
    }

    @media (max-width: 992px) {
        .popular-card {
            transform: scale(1);
        }
    }
</style>
@endpush