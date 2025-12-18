<?php

namespace App\Http\Controllers;

use App\Models\Pakets;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Carbon\Carbon;

class AdminDashboardController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */

    public static function middleware()
    {
        return [
            new Middleware('permission:admin-access'),
        ];
    }

    public function index()
    {
        $pakets = Pakets::all();

        // Orders yang sudah settlement tapi belum diaktifkan
        $orders = Orders::where('transaction_status', 'settlement')
            ->where('is_activated', 'no')
            ->latest()
            ->get();

        // ===== TAMBAHAN BARU: ORDER PENDING (Belum Dibayar) =====
        // Ini untuk notifikasi order baru yang masuk
        $pendingOrders = Orders::where('transaction_status', 'unpaid')
            ->latest()
            ->take(10) // Ambil 10 order terbaru
            ->get();

        // Hitung jumlah total order pending
        $pendingCount = Orders::where('transaction_status', 'unpaid')->count();
        // ===== AKHIR TAMBAHAN BARU =====

        // ===== PERHITUNGAN DINAMIS UNTUK DASHBOARD =====

        // 1. Total Revenue (dari semua transaksi settlement)
        $totalRevenue = Orders::where('transaction_status', 'settlement')
            ->sum('gross_amount');

        // 2. Revenue Minggu Ini
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $revenueThisWeek = Orders::where('transaction_status', 'settlement')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('gross_amount');

        // 3. Revenue Minggu Lalu
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        $revenueLastWeek = Orders::where('transaction_status', 'settlement')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->sum('gross_amount');

        // 4. Hitung Persentase Pertumbuhan
        if ($revenueLastWeek > 0) {
            $growthPercentage = (($revenueThisWeek - $revenueLastWeek) / $revenueLastWeek) * 100;
        } else {
            $growthPercentage = $revenueThisWeek > 0 ? 100 : 0;
        }

        // 5. Total Earning Bulan Ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $earningThisMonth = Orders::where('transaction_status', 'settlement')
            ->where('created_at', '>=', $startOfMonth)
            ->sum('gross_amount');

        // 6. Earning Bulan Lalu
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        $earningLastMonth = Orders::where('transaction_status', 'settlement')
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('gross_amount');

        // 7. Persentase Earning Growth
        if ($earningLastMonth > 0) {
            $earningGrowth = (($earningThisMonth - $earningLastMonth) / $earningLastMonth) * 100;
        } else {
            $earningGrowth = $earningThisMonth > 0 ? 100 : 0;
        }

        // 8. Balance (Total yang belum diaktifkan)
        $balance = Orders::where('transaction_status', 'settlement')
            ->where('is_activated', 'no')
            ->sum('gross_amount');

        // 9. Total Sales Minggu Ini
        $totalSalesThisWeek = Orders::where('transaction_status', 'settlement')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('gross_amount');

        // 10. Total Sales Minggu Lalu (untuk persentase)
        $totalSalesLastWeek = Orders::where('transaction_status', 'settlement')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->sum('gross_amount');

        // 11. Persentase Sales Growth
        if ($totalSalesLastWeek > 0) {
            $salesGrowth = (($totalSalesThisWeek - $totalSalesLastWeek) / $totalSalesLastWeek) * 100;
        } else {
            $salesGrowth = $totalSalesThisWeek > 0 ? 100 : 0;
        }

        // 12. Data untuk Chart (12 hari terakhir)
        $chartData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dailySales = Orders::where('transaction_status', 'settlement')
                ->whereDate('created_at', $date)
                ->sum('gross_amount');

            $chartData[] = [
                'day' => $date->format('d'),
                'amount' => $dailySales
            ];
        }

        // 13. Tanggal range untuk display
        $salesDateRange = Carbon::now()->subDays(11)->format('d M') . ' - ' . Carbon::now()->format('d M, Y');

        // Kirim semua data ke view (TAMBAHKAN pendingOrders dan pendingCount)
        return view('admin.dashboard', compact(
            'pakets',
            'orders',
            'pendingOrders',      // BARU: Daftar order pending
            'pendingCount',       // BARU: Jumlah order pending
            'totalRevenue',
            'revenueThisWeek',
            'growthPercentage',
            'earningThisMonth',
            'earningGrowth',
            'balance',
            'totalSalesThisWeek',
            'salesGrowth',
            'chartData',
            'salesDateRange'
        ));
    }
}
