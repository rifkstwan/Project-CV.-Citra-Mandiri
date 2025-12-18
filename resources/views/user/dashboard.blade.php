@extends('layouts.app_1')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-wrapper">
    <div class="container-fluid px-4 py-4" style="background-color: #f8f9fa;">

        {{-- WELCOME BANNER --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-9">
                                <h3 class="text-white fw-bold mb-2">
                                    Selamat Datang, {{ Auth::user()->name }}! 👋
                                </h3>
                                <p class="text-white mb-1 opacity-90">{{ Auth::user()->email }}</p>
                                <p class="text-white mb-0 small opacity-75">Member sejak {{ Auth::user()->created_at->isoFormat('MMMM YYYY') }}</p>
                            </div>
                            <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                <div class="bg-white rounded-3 p-3 d-inline-block">
                                    <div class="text-muted small mb-1">Status Akun</div>
                                    <div class="fw-bold text-success fs-4">
                                        <i class="fas fa-check-circle me-1"></i>Aktif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATISTIK CARDS - HANYA 3 CARD --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-4 col-md-4">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-2 small fw-medium">Status Koneksi</p>
                                <h3 class="mb-0 fw-bold {{ $activeOrders->count() > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $activeOrders->count() > 0 ? 'Aktif' : 'Tidak Aktif' }}
                                </h3>
                            </div>
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-wifi fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-2 small fw-medium">Paket Aktif</p>
                                <h3 class="mb-0 fw-bold text-primary">{{ $activeOrders->count() }}</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-box fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-2 small fw-medium">Total Transaksi</p>
                                <h3 class="mb-0 fw-bold text-warning">{{ Auth::user()->orders->count() }}</h3>
                            </div>
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-receipt fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="row g-4">
            {{-- LEFT COLUMN - 8 cols --}}
            <div class="col-lg-8">

                {{-- PAKET AKTIF --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-signal text-success me-2"></i>Paket Internet Saya
                            </h5>
                            @if($activeOrders->count() > 0)
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">
                                {{ $activeOrders->count() }} Aktif
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if($activeOrders->count())
                        @foreach($activeOrders as $order)
                        <div class="border border-2 border-success rounded-4 p-4 mb-3 bg-light bg-opacity-50">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-success bg-opacity-10 rounded-3 p-3 flex-shrink-0">
                                            <i class="fas fa-wifi fa-2x text-success"></i>
                                        </div>
                                        <div>
                                            <h4 class="mb-2 fw-bold">{{ $order->paket->nama_paket }}</h4>
                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                <span class="badge bg-white text-dark border">
                                                    <i class="fas fa-gauge-high me-1"></i>{{ $order->paket->kecepatan }}
                                                </span>
                                                <span class="badge bg-white text-dark border">
                                                    <i class="fas fa-infinity me-1"></i>Unlimited
                                                </span>
                                            </div>
                                            <p class="text-muted small mb-0">
                                                <i class="fas fa-hashtag me-1"></i>{{ $order->order_number }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mt-3 mt-md-0">
                                    <div class="text-md-end">
                                        <div class="mb-3">
                                            <span class="badge bg-success px-4 py-2 rounded-pill">
                                                <i class="fas fa-check-circle me-1"></i>Aktif
                                            </span>
                                        </div>
                                        <h4 class="mb-1 fw-bold text-success">Rp {{ number_format($order->paket->harga, 0, ',', '.') }}</h4>
                                        <p class="text-muted small mb-3">per bulan × {{ $order->qty }} bulan</p>
                                        <div class="d-flex gap-2 justify-content-md-end flex-wrap">
                                            <button class="btn btn-success rounded-pill px-4">
                                                <i class="fas fa-refresh me-1"></i>Perpanjang
                                            </button>
                                            <button class="btn btn-outline-primary rounded-pill px-4">
                                                <i class="fas fa-arrow-up me-1"></i>Upgrade
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                                <i class="fas fa-wifi-slash fa-3x text-muted"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Belum Ada Paket Aktif</h5>
                            <p class="text-muted mb-4">Anda belum memiliki paket internet aktif</p>
                            <a href="{{ route('user.pakets.index') }}" class="btn btn-primary btn-lg rounded-pill px-5">
                                <i class="fas fa-plus me-2"></i>Pilih Paket
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- RIWAYAT TRANSAKSI --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-history text-primary me-2"></i>Riwayat Transaksi
                            </h5>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="fas fa-eye me-1"></i>Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead style="background-color: #f8f9fa;">
                                    <tr>
                                        <th class="px-4 py-3 border-0 fw-semibold">Tanggal</th>
                                        <th class="py-3 border-0 fw-semibold">Paket</th>
                                        <th class="py-3 border-0 fw-semibold">Total</th>
                                        <th class="py-3 border-0 fw-semibold">Status</th>
                                        <th class="py-3 border-0 fw-semibold text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(Auth::user()->orders()->latest()->take(5)->get() as $order)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="fw-semibold">{{ $order->created_at->format('d M Y') }}</div>
                                            <div class="text-muted small">{{ $order->created_at->format('H:i') }} WIB</div>
                                        </td>
                                        <td class="py-3">
                                            <div class="fw-bold">{{ $order->paket->nama_paket }}</div>
                                            <div class="small text-muted">#{{ $order->order_number }}</div>
                                        </td>
                                        <td class="py-3">
                                            <span class="fw-bold text-dark">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="py-3">
                                            @if($order->status == 'paid')
                                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                                <i class="fas fa-check-circle me-1"></i>Lunas
                                            </span>
                                            @elseif($order->status == 'pending')
                                            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                            @else
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                                <i class="fas fa-times-circle me-1"></i>Gagal
                                            </span>
                                            @endif
                                        </td>
                                        <td class="py-3 text-center">
                                            <button class="btn btn-sm btn-outline-secondary rounded-pill">
                                                <i class="fas fa-download me-1"></i>Invoice
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3 d-block opacity-50"></i>
                                                <p class="mb-0">Belum ada transaksi</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT COLUMN - 4 cols --}}
            <div class="col-lg-4">

                {{-- PROFIL SAYA - TANPA TOMBOL EDIT --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-user-circle text-info me-2"></i>Profil Saya
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-user fa-3x text-muted"></i>
                            </div>
                        </div>

                        <div class="mb-3 pb-3 border-bottom">
                            <label class="text-muted small mb-1 fw-medium">Nama Lengkap</label>
                            <p class="fw-bold mb-0">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="mb-3 pb-3 border-bottom">
                            <label class="text-muted small mb-1 fw-medium">Email</label>
                            <p class="fw-bold mb-0 text-break">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="mb-3 pb-3 border-bottom">
                            <label class="text-muted small mb-1 fw-medium">Nomor HP</label>
                            <p class="fw-bold mb-0">{{ Auth::user()->phone ?? '-' }}</p>
                        </div>
                        <div class="mb-0">
                            <label class="text-muted small mb-1 fw-medium">Alamat</label>
                            <p class="fw-bold mb-0">{{ Auth::user()->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- MENU CEPAT --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-bolt text-warning me-2"></i>Menu Cepat
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-grid gap-2">
                            <a href="{{ route('user.pakets.index') }}" class="btn btn-outline-primary text-start rounded-3">
                                <i class="fas fa-shopping-bag me-2 text-primary"></i>
                                <span class="fw-semibold">Lihat Paket</span>
                            </a>
                            <a href="#" class="btn btn-outline-success text-start rounded-3">
                                <i class="fas fa-file-invoice me-2 text-success"></i>
                                <span class="fw-semibold">Semua Invoice</span>
                            </a>
                            <a href="#" class="btn btn-outline-warning text-start rounded-3">
                                <i class="fas fa-ticket-alt me-2 text-warning"></i>
                                <span class="fw-semibold">Buat Tiket</span>
                            </a>
                            <a href="#" class="btn btn-outline-danger text-start rounded-3">
                                <i class="fas fa-headset me-2 text-danger"></i>
                                <span class="fw-semibold">Hubungi CS</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- BANTUAN --}}
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="card-body text-center p-4 text-white">
                        <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-question-circle fa-3x text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Butuh Bantuan?</h5>
                        <p class="mb-4 opacity-90">Tim support kami siap membantu Anda 24/7</p>
                        <a href="#" class="btn btn-light btn-lg rounded-pill px-4 fw-semibold">
                            <i class="fas fa-phone me-2"></i>Hubungi Kami
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }

    .dashboard-wrapper {
        margin-top: 0;
        padding-top: 0;
    }

    @supports (position: sticky) {
        .dashboard-wrapper {
            padding-top: 20px;
        }
    }

    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, .12) !important;
    }

    .card {
        transition: all 0.3s ease;
    }

    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .container-fluid {
        overflow: visible !important;
    }

    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .dashboard-wrapper {
            padding-top: 10px;
        }
    }
</style>
@endpush