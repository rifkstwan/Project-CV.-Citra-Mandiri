<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Konfirmasi Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-6 p-4 bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 text-2xl mr-3"></i>
                            <div>
                                <h3 class="font-semibold text-lg text-green-800 dark:text-green-200">Pesanan Berhasil Dibuat!</h3>
                                <p class="text-sm text-green-700 dark:text-green-300">Order ID: {{ $order->midtrans_order_id }}</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-xl font-semibold mb-4">Detail Pesanan</h3>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600 dark:text-gray-400">Paket</span>
                            <span class="font-semibold">{{ $paket->nama_paket }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600 dark:text-gray-400">Harga</span>
                            <span class="font-semibold">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600 dark:text-gray-400">Jumlah</span>
                            <span class="font-semibold">{{ $order->qty }}</span>
                        </div>
                        <div class="flex justify-between border-b-2 border-gray-300 pb-2 pt-2">
                            <span class="text-gray-800 dark:text-gray-200 font-semibold">Total Pembayaran</span>
                            <span class="font-bold text-lg text-blue-600">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="bg-yellow-50 dark:bg-yellow-900 border border-yellow-200 dark:border-yellow-700 rounded-lg p-4 mb-6">
                        <h4 class="font-semibold text-yellow-800 dark:text-yellow-200 mb-2">
                            <i class="fas fa-info-circle mr-2"></i>Instruksi Pembayaran
                        </h4>
                        <ol class="list-decimal list-inside space-y-2 text-sm text-yellow-700 dark:text-yellow-300">
                            <li>Transfer ke rekening: <strong>BCA 1234567890 a.n. CV. Citra Mandiri</strong></li>
                            <li>Nominal: <strong>Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</strong></li>
                            <li>Upload bukti transfer melalui WhatsApp atau email</li>
                            <li>Pesanan akan diproses setelah pembayaran dikonfirmasi admin</li>
                        </ol>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ url()->previous() }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition">
                            Kembali
                        </a>
                        <a href="https://wa.me/6282007755641?text=Halo,%20saya%20ingin%20konfirmasi%20pembayaran%20Order%20ID:%20{{ $order->midtrans_order_id }}"
                            target="_blank"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition">
                            <i class="fab fa-whatsapp mr-2"></i>Konfirmasi via WhatsApp
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>