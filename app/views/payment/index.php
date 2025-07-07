<body class="bg-gray-100">
    <main class="container mx-auto mt-10 px-4">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-gray-800">Selesaikan Pembayaran</h1>
                    <p class="text-gray-600 mt-2">Nomor Pesanan Anda: <strong class="font-mono"><?= htmlspecialchars($data['order']['order_number']); ?></strong></p>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 my-6">
                        <p class="text-lg font-semibold text-blue-800">Total Pembayaran</p>
                        <p class="text-3xl font-bold text-blue-900">Rp <?= number_format($data['order']['total_amount'], 0, ',', '.'); ?></p>
                    </div>
                </div>

                <form action="<?= BASEURL; ?>/payment/chooseMethod" method="POST">
                    <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
                    <h2 class="text-xl font-semibold mb-4">Pilih Metode Pembayaran</h2>
                    <div class="space-y-4">
                        <label for="transfer" class="flex items-center p-4 border rounded-lg has-[:checked]:bg-blue-50 has-[:checked]:border-blue-300 cursor-pointer">
                            <input type="radio" id="transfer" name="payment_method" value="Transfer Bank" class="h-4 w-4 text-blue-600 border-gray-300" checked>
                            <span class="ml-3 text-sm">
                                <strong class="font-semibold block text-gray-900">Transfer Bank</strong>
                                <span class="text-gray-600">Transfer manual ke rekening BCA atau Mandiri. Perlu konfirmasi manual.</span>
                            </span>
                        </label>
                        <label for="cod" class="flex items-center p-4 border rounded-lg has-[:checked]:bg-blue-50 has-[:checked]:border-blue-300 cursor-pointer">
                            <input type="radio" id="cod" name="payment_method" value="Cash di Tempat" class="h-4 w-4 text-blue-600 border-gray-300">
                            <span class="ml-3 text-sm">
                                <strong class="font-semibold block text-gray-900">Bayar di Tempat (COD)</strong>
                                <span class="text-gray-600">Bayar dengan uang tunai saat Anda mengambil barang di lokasi kami.</span>
                            </span>
                        </label>
                    </div>
                    <div class="mt-8 border-t pt-6">
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-300">
                            Konfirmasi Metode Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>