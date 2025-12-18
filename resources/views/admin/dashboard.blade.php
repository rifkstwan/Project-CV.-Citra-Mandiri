<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <div class="container">
                            <h2 class="fw-semibold fs-6 mb-4 text-dark dark:text-white">Dashboard</h2>

                            <!-- ============================================ -->
                            <!-- NOTIFIKASI ORDER BARU -->
                            <!-- ============================================ -->
                            @if($pendingCount > 0)
                            <div class="mb-4 p-4 bg-blue-50 dark:bg-blue-900 border-l-4 border-blue-500 rounded-lg shadow-md">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-blue-800 dark:text-blue-200 text-lg">
                                            🔔 {{ $pendingCount }} Pesanan Baru Menunggu Konfirmasi Pembayaran
                                        </h4>
                                        <p class="text-sm text-blue-700 dark:text-blue-300 mt-1">
                                            Cek WhatsApp untuk bukti transfer dari customer, lalu konfirmasi pembayaran di bawah
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- TABEL ORDER PENDING -->
                            @if($pendingOrders->count() > 0)
                            <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-blue-200 dark:border-blue-800">
                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                                    <h3 class="text-lg font-bold text-white flex items-center">
                                        📋 Pesanan Menunggu Konfirmasi Pembayaran
                                        <span class="ml-3 bg-white text-blue-600 text-xs font-bold px-3 py-1 rounded-full">{{ $pendingCount }}</span>
                                    </h3>
                                </div>
                                <div class="p-4">
                                    <table class="table-auto w-full text-sm">
                                        <thead>
                                            <tr class="bg-gray-100 dark:bg-gray-700 text-left">
                                                <th class="p-3 font-semibold">Order ID</th>
                                                <th class="p-3 font-semibold">Nama Customer</th>
                                                <th class="p-3 font-semibold">Paket</th>
                                                <th class="p-3 font-semibold">Total Bayar</th>
                                                <th class="p-3 font-semibold">Waktu Order</th>
                                                <th class="p-3 font-semibold">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pendingOrders as $pending)
                                            <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-750">
                                                <td class="p-3">
                                                    <span class="font-mono text-xs bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                                        {{ Str::limit($pending->midtrans_order_id, 20) }}
                                                    </span>
                                                </td>
                                                <td class="p-3 font-medium">{{ $pending->user->name ?? '-' }}</td>
                                                <td class="p-3">
                                                    <span class="text-blue-600 dark:text-blue-400 font-semibold">
                                                        {{ $pending->paket->nama_paket ?? '-' }}
                                                    </span>
                                                </td>
                                                <td class="p-3">
                                                    <span class="font-bold text-green-600 dark:text-green-400">
                                                        Rp {{ number_format($pending->gross_amount, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="p-3 text-gray-600 dark:text-gray-400 text-xs">
                                                    {{ $pending->created_at->diffForHumans() }}
                                                    <br>
                                                    <span class="text-xs">{{ $pending->created_at->format('d M Y, H:i') }}</span>
                                                </td>
                                                <td class="p-3">
                                                    <form method="POST" action="{{ route('admin.orders.confirmPayment', $pending->id) }}" class="inline">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return confirm('Apakah pembayaran sudah diterima untuk order ini?')"
                                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold text-xs shadow-md hover:shadow-lg transition duration-200">
                                                            ✅ Konfirmasi Bayar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            @else
                            <div class="mb-4 p-4 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                                <p class="text-gray-600 dark:text-gray-400 text-center">
                                    ✨ Tidak ada pesanan baru saat ini
                                </p>
                            </div>
                            @endif
                            <!-- ============================================ -->
                            <!-- AKHIR NOTIFIKASI ORDER BARU -->
                            <!-- ============================================ -->

                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                                <div>
                                    <p class="small-text fw-semibold mb-1 dark:text-gray-300">Revenue</p>
                                    <p class="fw-bold fs-5 mb-1 text-dark dark:text-white">IDR {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                                    <p class="{{ $growthPercentage >= 0 ? 'text-green' : 'text-red' }} d-flex align-items-center gap-1 mb-0">
                                        <i class="fas fa-arrow-{{ $growthPercentage >= 0 ? 'up' : 'down' }}"></i> {{ number_format(abs($growthPercentage), 1) }}%
                                        <span class="fw-normal text-muted ms-1">vs last week</span>
                                    </p>
                                    <p class="small-text text-muted mt-1 mb-0">Sales from {{ $salesDateRange }}</p>
                                </div>
                                <button class="btn btn-sm text-primary bg-light rounded-2 fw-semibold px-3 py-1 dark:bg-gray-700 dark:text-primary-300" type="button">View Report</button>
                            </div>

                            <svg aria-label="Bar chart showing sales data" class="bar-chart" fill="none" viewbox="0 0 360 100" xmlns="http://www.w3.org/2000/svg" role="img" width="100%" height="100">
                                @php
                                $maxAmount = max(array_column($chartData, 'amount'));
                                $maxAmount = $maxAmount > 0 ? $maxAmount : 1;
                                @endphp
                                @foreach($chartData as $index => $data)
                                @php
                                $height = $maxAmount > 0 ? ($data['amount'] / $maxAmount) * 65 : 10;
                                $x = 10 + ($index * 25);
                                $y = 90 - $height;
                                $color = $index % 2 == 0 ? '#5C5EDD' : '#B3B7F5';
                                @endphp
                                <rect fill="{{ $color }}" height="{{ $height }}" width="15" x="{{ $x }}" y="{{ $y }}"></rect>
                                @endforeach
                            </svg>

                            <div class="bar-labels">
                                @foreach($chartData as $data)
                                <span>{{ $data['day'] }}</span>
                                @endforeach
                            </div>

                            <div class="legend">
                                <div class="d-flex align-items-center gap-1">
                                    <span class="legend-dot legend-dot-1"></span> Last 6 days
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="legend-dot legend-dot-2"></span> Last Week
                                </div>
                            </div>

                            <div class="card-container p-4 d-flex flex-column flex-md-row justify-content-between gap-4">
                                <div class="d-flex align-items-center gap-3 flex-grow-1 min-w-0">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle card-icon-bg-1" style="width:56px; height:56px;">
                                        <i class="fas fa-dollar-sign fs-4"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="card-text-small mb-1 dark:text-gray-300">Earning</p>
                                        <p class="fw-bold fs-4 mb-1 text-dark dark:text-white text-truncate">Rp{{ number_format($earningThisMonth / 1000, 1) }}JT</p>
                                        <p class="card-text-{{ $earningGrowth >= 0 ? 'green' : 'red' }} mb-0">
                                            <i class="fas fa-arrow-{{ $earningGrowth >= 0 ? 'up' : 'down' }}"></i>
                                            <span class="{{ $earningGrowth >= 0 ? 'underline-green' : '' }}">{{ number_format(abs($earningGrowth), 1) }}%</span> this month
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-3 flex-grow-1 min-w-0">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle card-icon-bg-2" style="width:56px; height:56px;">
                                        <i class="fas fa-wallet fs-4"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="card-text-small mb-1 dark:text-gray-300">Balance</p>
                                        <p class="fw-bold fs-4 mb-1 text-dark dark:text-white text-truncate">Rp{{ number_format($balance / 1000, 0) }}k</p>
                                        <p class="card-text-muted mb-0">
                                            Pending activation
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-3 flex-grow-1 min-w-0">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle card-icon-bg-3" style="width:56px; height:56px;">
                                        <i class="fas fa-chart-line fs-4"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="card-text-small mb-1 dark:text-gray-300">Total Sales</p>
                                        <p class="fw-bold fs-4 mb-1 text-dark dark:text-white text-truncate">Rp{{ number_format($totalSalesThisWeek / 1000, 0) }}k</p>
                                        <p class="card-text-{{ $salesGrowth >= 0 ? 'green' : 'red' }} mb-0">
                                            <i class="fas fa-arrow-{{ $salesGrowth >= 0 ? 'up' : 'down' }}"></i> {{ number_format(abs($salesGrowth), 0) }}% this week
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- ============================================ -->
                    <!-- PAKET SIAP DIAKTIFKAN -->
                    <!-- ============================================ -->
                    <div class="mt-6">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-lg font-semibold text-dark dark:text-white">Paket Siap Diaktifkan</h3>

                            <!-- TOMBOL TANDAI SEMUA SELESAI -->
                            @if($orders->count() > 0)
                            <form method="POST" action="{{ route('admin.orders.markAllActivated') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menandai SEMUA paket ({{ $orders->count() }} paket) sebagai selesai?')"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold text-sm shadow-md hover:shadow-lg transition duration-200">
                                    ✅ Tandai Semua Selesai ({{ $orders->count() }})
                                </button>
                            </form>
                            @endif
                        </div>

                        @if (session('success'))
                        <div class="mb-3 p-3 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg border border-green-300 dark:border-green-700">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="mb-3 p-3 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-lg border border-red-300 dark:border-red-700">
                            {{ session('error') }}
                        </div>
                        @endif

                        @if($orders->count())
                        <table class="table-auto w-full border border-gray-300 dark:border-gray-700 text-sm">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700 text-left">
                                    <th class="p-2">Nama</th>
                                    <th class="p-2">Paket</th>
                                    <th class="p-2">Nomor HP</th>
                                    <th class="p-2">Total Bayar</th>
                                    <th class="p-2">Status</th>
                                    <th class="p-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr class="border-t border-gray-300 dark:border-gray-700">
                                    <td class="p-2">{{ $order->user->name ?? '-' }}</td>
                                    <td class="p-2">{{ $order->paket->nama_paket ?? '-' }}</td>
                                    <td class="p-2">{{ $order->user->phone ?? '-' }}</td>
                                    <td class="p-2">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</td>
                                    <td class="p-2 text-green-600 font-semibold">Pembayaran Selesai</td>
                                    <td class="p-2">
                                        <form method="POST" action="{{ route('admin.orders.markActivated', $order->id) }}">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                                Tandai Selesai
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-gray-500 dark:text-gray-400 text-center p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            ✨ Belum ada pesanan yang siap diaktifkan.
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>