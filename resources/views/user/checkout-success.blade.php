<x-guest-layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">CV. Citra Mandiri</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Konfirmasi Pesanan</p>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8">

                    <!-- Success Message -->
                    <div class="mb-8 p-6 bg-green-50 dark:bg-green-900 border-2 border-green-300 dark:border-green-700 rounded-xl">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-green-800 dark:text-green-200">Pesanan Berhasil Dibuat!</h3>
                                <p class="text-sm text-green-700 dark:text-green-300 mt-1">
                                    Order ID: <span class="font-mono font-semibold">{{ $order->midtrans_order_id }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Detail Pesanan</h3>

                    <!-- Order Details -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 mb-8 space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200 dark:border-gray-600">
                            <span class="text-gray-600 dark:text-gray-400">Paket</span>
                            <span class="font-semibold text-lg text-gray-900 dark:text-white">{{ $paket->nama_paket }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200 dark:border-gray-600">
                            <span class="text-gray-600 dark:text-gray-400">Harga per bulan</span>
                            <span class="font-semibold text-gray-900 dark:text-white">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200 dark:border-gray-600">
                            <span class="text-gray-600 dark:text-gray-400">Durasi</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $order->qty }} bulan</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t-2 border-gray-300 dark:border-gray-500">
                            <span class="text-gray-800 dark:text-gray-200 font-bold text-xl">Total Pembayaran</span>
                            <span class="font-bold text-2xl text-blue-600">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Payment Instructions -->
                    <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 dark:from-yellow-900 dark:to-yellow-800 border-l-4 border-yellow-500 p-6 mb-8 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <h4 class="text-lg font-bold text-yellow-900 dark:text-yellow-100 mb-4">
                                    📋 Instruksi Pembayaran
                                </h4>
                                <div class="text-sm text-yellow-900 dark:text-yellow-100 space-y-3">
                                    <div class="bg-white dark:bg-yellow-800 p-4 rounded-lg">
                                        <p class="font-semibold mb-2">1️⃣ Transfer ke rekening:</p>
                                        <div class="ml-4 space-y-1">
                                            <p>🏦 Bank: <span class="font-bold">BCA</span></p>
                                            <p>💳 No. Rekening: <span class="font-bold text-lg">1234567890</span></p>
                                            <p>👤 Atas Nama: <span class="font-bold">CV. Citra Mandiri</span></p>
                                        </div>
                                    </div>
                                    <div class="bg-white dark:bg-yellow-800 p-4 rounded-lg">
                                        <p class="font-semibold">2️⃣ Nominal Transfer:</p>
                                        <p class="ml-4 text-2xl font-bold text-blue-600 dark:text-blue-400">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="bg-white dark:bg-yellow-800 p-4 rounded-lg">
                                        <p class="font-semibold">3️⃣ Kirim bukti transfer via WhatsApp</p>
                                    </div>
                                    <div class="bg-white dark:bg-yellow-800 p-4 rounded-lg">
                                        <p class="font-semibold">4️⃣ Pesanan diproses dalam max 1x24 jam</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons - IMPROVED VERSION -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <!-- Tombol Kembali ke Beranda -->
                        <a href="/"
                            class="flex-1 text-white font-bold py-4 px-6 rounded-xl text-center transition-all duration-300 shadow-lg"
                            style="background-color: #4b5563;"
                            onmouseover="this.style.backgroundColor='#1f2937'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.3)';"
                            onmouseout="this.style.backgroundColor='#4b5563'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';"
                            ontouchstart="this.style.backgroundColor='#1f2937'; this.style.transform='scale(0.98)';"
                            ontouchend="this.style.backgroundColor='#4b5563'; this.style.transform='scale(1)';">
                            <svg class="inline-block w-5 h-5 mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            🏠 Kembali ke Beranda
                        </a>

                        <!-- Tombol WhatsApp -->
                        <a href="https://wa.me/6285743447364?text=Halo,%20saya%20ingin%20konfirmasi%20pembayaran%0A%0AOrder%20ID:%20{{ $order->midtrans_order_id }}%0ATotal:%20Rp%20{{ number_format($order->gross_amount, 0, ',', '.') }}%0APaket:%20{{ $paket->nama_paket }}%20({{ $order->qty }}%20bulan)"
                            target="_blank"
                            class="flex-1 text-white font-bold py-4 px-6 rounded-xl text-center transition-all duration-300 shadow-lg"
                            style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);"
                            onmouseover="this.style.background='linear-gradient(135deg, #16a34a 0%, #15803d 100%)'; this.style.transform='translateY(-3px) scale(1.02)'; this.style.boxShadow='0 15px 30px rgba(34,197,94,0.4)';"
                            onmouseout="this.style.background='linear-gradient(135deg, #22c55e 0%, #16a34a 100%)'; this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';"
                            ontouchstart="this.style.background='linear-gradient(135deg, #16a34a 0%, #15803d 100%)'; this.style.transform='scale(0.98)';"
                            ontouchend="this.style.background='linear-gradient(135deg, #22c55e 0%, #16a34a 100%)'; this.style.transform='scale(1)';">
                            <svg class="inline-block w-5 h-5 mr-2 -mt-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                            💬 Konfirmasi via WhatsApp
                        </a>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Butuh bantuan? Hubungi kami di <a href="tel:085743447364" class="text-blue-600 hover:underline font-semibold">0857-4344-7364</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>