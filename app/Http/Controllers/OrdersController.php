<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\User;
use App\Models\Pakets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Transaction;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class OrdersController extends Controller
{
    /**
     * Proses checkout user
     * Membuat order baru dengan status unpaid
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'qty'      => 'required|integer|min:1'
        ]);

        // Pastikan user login
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $paket = Pakets::findOrFail($request->paket_id);

        // Generate unique order_id
        $uniqueOrderId = 'ORDER-' . now()->format('YmdHis') . '-' . Str::random(10);

        // Hitung total harga
        $gross_amount = $request->qty * $paket->harga;

        // Buat data order
        $order = Orders::create([
            'user_id'             => $user->id,
            'paket_id'            => $request->paket_id,
            'qty'                 => $request->qty,
            'gross_amount'        => $gross_amount,
            'transaction_status'  => 'unpaid',
            'midtrans_order_id'   => $uniqueOrderId,
        ]);

        // ============================================================
        // MIDTRANS INTEGRATION (COMMENTED - Untuk dipakai nanti)
        // Uncomment kode di bawah jika sudah siap pakai Midtrans
        // ============================================================
        /*
        $params = [
            'transaction_details' => [
                'order_id'     => $uniqueOrderId,
                'gross_amount' => $gross_amount,
            ],
            'customer_details' => [
                'first_name'   => $user->name,
                'last_name'    => '',
                'email'        => $user->email,
                'phone'        => $user->phone,
                'billing_address' => [
                    'address' => $user->address,
                ],
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('admin.pakets.checkout', compact('snapToken', 'order', 'paket'));
        */

        // ============================================================
        // MODE MANUAL PAYMENT (Aktif untuk KP)
        // ============================================================
        return view('user.checkout-success', compact('order', 'paket'));
    }

    /**
     * Callback dari Midtrans setelah pembayaran
     */
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed    = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $order = Orders::where('midtrans_order_id', $request->order_id)->first();

            if ($order) {
                $vaBank   = null;
                $vaNumber = null;

                if (isset($request->va_numbers[0])) {
                    $vaBank   = $request->va_numbers[0]['bank'];
                    $vaNumber = $request->va_numbers[0]['va_number'];
                }

                $order->update([
                    'transaction_id'     => $request->transaction_id,
                    'transaction_status' => $request->transaction_status,
                    'payment_type'       => $request->payment_type,
                    'gross_amount'       => $request->gross_amount,
                    'fraud_status'       => $request->fraud_status ?? null,
                    'va_bank'            => $vaBank,
                    'va_number'          => $vaNumber,
                    'ewallet_type'       => $request->payment_type === 'qris' ? 'gopay/shopeepay' : null,
                    'bill_key'           => $request->bill_key ?? null,
                    'biller_code'        => $request->biller_code ?? null,
                ]);
            }
        }
    }

    /**
     * Sinkronisasi status transaksi dengan Midtrans
     */
    public function syncTransaction($id): RedirectResponse
    {
        $order = Orders::findOrFail($id);

        try {
            $status = Transaction::status($order->midtrans_order_id);

            $transactionStatus = is_object($status)
                ? $status->transaction_status
                : ($status['transaction_status'] ?? null);

            if ($transactionStatus) {
                $order->update([
                    'transaction_status' => $transactionStatus
                ]);

                return redirect()->back()->with('success', 'Status transaksi diperbarui dari Midtrans!');
            } else {
                return redirect()->back()->with('warning', 'Transaksi ada di database tapi Midtrans tidak balas status.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan di Midtrans (mungkin expired atau salah env).');
        }
    }

    /**
     * Notification handler dari Midtrans
     */
    public function notificationHandler(Request $request)
    {
        $notif = new \Midtrans\Notification();

        $transactionStatus = $notif->transaction_status;
        $orderId           = $notif->order_id;

        $order = Orders::where('midtrans_order_id', $orderId)->first();

        if ($order) {
            $order->update([
                'transaction_status' => $transactionStatus
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Tandai satu paket sebagai activated
     */
    public function markActivated($id)
    {
        $order = Orders::findOrFail($id);
        $order->update(['is_activated' => 'yes']);

        return redirect()->back()->with('success', 'Paket telah diaktifkan di Mikrotik dan ditandai selesai.');
    }

    /**
     * Tandai semua paket settlement sebagai activated
     * Aktivasi massal untuk efisiensi admin
     */
    public function markAllActivated()
    {
        // Ambil semua order yang settlement dan belum diaktifkan
        $orders = Orders::where('transaction_status', 'settlement')
            ->where('is_activated', 'no')
            ->get();

        // Validasi: Pastikan ada order yang perlu diaktifkan
        if ($orders->count() === 0) {
            return redirect()->back()->with('error', 'Tidak ada paket yang perlu diaktifkan!');
        }

        // Update semua order jadi activated
        $count = $orders->count();
        foreach ($orders as $order) {
            $order->update(['is_activated' => 'yes']);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('admin.index')->with(
            'success',
            "✅ Berhasil mengaktifkan {$count} paket sekaligus!"
        );
    }

    /**
     * Konfirmasi pembayaran manual oleh admin
     * Mengubah status dari 'unpaid' ke 'settlement'
     */
    public function confirmPayment($id)
    {
        // Cari order berdasarkan ID
        $order = Orders::findOrFail($id);

        // Validasi: Pastikan order masih unpaid
        if ($order->transaction_status !== 'unpaid') {
            return redirect()->back()->with(
                'error',
                'Order ini sudah dikonfirmasi sebelumnya!'
            );
        }

        // Update status jadi settlement (sudah dibayar)
        $order->update([
            'transaction_status' => 'settlement',
            'payment_type' => 'manual_transfer'
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.index')->with(
            'success',
            '✅ Pembayaran berhasil dikonfirmasi! Order ID: ' . $order->midtrans_order_id . ' - Customer: ' . ($order->user->name ?? 'N/A')
        );
    }

    /**
     * Tampilkan daftar transaksi dengan pagination
     */
    public function transactions()
    {
        $transactions = Orders::latest()->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Export transaksi ke PDF
     */
    public function exportPdf(Request $request)
    {
        try {
            $query = Orders::query();

            // Filter berdasarkan tanggal
            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->filled('end_date')) {
                $endDate = \Carbon\Carbon::parse($request->end_date)->endOfDay();
                $query->where('created_at', '<=', $endDate);
            }

            // Ambil semua data transaksi yang sudah difilter
            $transactions = $query->with('paket', 'user')->latest()->get();

            // Load view PDF transaksi
            $pdf = Pdf::loadView('admin.transactions.pdf', [
                'transactions' => $transactions
            ]);

            // Tampilkan di browser
            return $pdf->stream('transaksi-' . date('Ymd-His') . '.pdf');
        } catch (\Exception $e) {
            return redirect()->route('transactions')
                ->with('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }
}
