<body class="bg-gray-100">
    <main class="container mx-auto mt-10 px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Checkout</h1>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Detail Penyewaan</h2>

                <form action="<?= BASEURL; ?>/order/create" method="POST">
                    <input type="hidden" name="product_id" value="<?= $data['product']['id']; ?>">
                    <input type="hidden" name="daily_rental_price" value="<?= $data['product']['daily_rental_price']; ?>">

                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="rental_start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai Sewa</label>
                            <input type="date" id="rental_start_date" name="rental_start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="rental_end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai Sewa</label>
                            <input type="date" id="rental_end_date" name="rental_end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="pickup_location_id" class="block text-sm font-medium text-gray-700">Lokasi Pengambilan</label>
                            <select id="pickup_location_id" name="pickup_location_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">Pilih Lokasi</option>
                                <?php foreach ($data['locations'] as $location): ?>
                                    <option value="<?= $location['id']; ?>"><?= htmlspecialchars($location['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="return_location_id" class="block text-sm font-medium text-gray-700">Lokasi Pengembalian</label>
                            <select id="return_location_id" name="return_location_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">Pilih Lokasi</option>
                                <?php foreach ($data['locations'] as $location): ?>
                                    <option value="<?= $location['id']; ?>"><?= htmlspecialchars($location['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-300">
                            Lanjutkan ke Pembayaran
                        </button>
                    </div>
                </form>
            </div>

            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold border-b pb-2 mb-4">Ringkasan Sewa</h3>
                    <div class="flex items-center space-x-4">
                        <?php
                        $gambarUtama = !empty($data['product']['images']) ? $data['product']['images'][0]['image_path'] : 'default.jpg';
                        ?>
                        <img src="<?= BASEURL; ?>/assets/produk/<?= htmlspecialchars($gambarUtama); ?>" class="w-24 h-24 object-cover rounded-lg">
                        <div>
                            <h4 class="font-semibold text-gray-800"><?= htmlspecialchars($data['product']['product_name']); ?></h4>
                            <p class="text-sm text-gray-500">1 x Rp <?= number_format($data['product']['daily_rental_price'], 0, ',', '.'); ?> / hari</p>
                        </div>
                    </div>
                    <div id="summary" class="mt-6 border-t pt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Durasi Sewa:</span>
                            <span id="summary_duration">Pilih tanggal</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span id="summary_subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between font-bold text-base mt-2">
                            <span>Total:</span>
                            <span id="summary_total">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('rental_start_date');
            const endDateInput = document.getElementById('rental_end_date');
            const dailyPrice = parseFloat(<?= $data['product']['daily_rental_price']; ?>);

            function calculateTotal() {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);

                if (startDateInput.value && endDateInput.value && endDate >= startDate) {
                    // Hitung selisih hari
                    const timeDiff = endDate.getTime() - startDate.getTime();
                    let days = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    days = days === 0 ? 1 : days; // Minimal sewa 1 hari

                    const subtotal = days * dailyPrice;

                    // Update ringkasan
                    document.getElementById('summary_duration').textContent = `${days} hari`;
                    document.getElementById('summary_subtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
                    document.getElementById('summary_total').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
                } else {
                    // Reset jika tanggal tidak valid
                    document.getElementById('summary_duration').textContent = 'Pilih tanggal';
                    document.getElementById('summary_subtotal').textContent = 'Rp 0';
                    document.getElementById('summary_total').textContent = 'Rp 0';
                }
            }

            startDateInput.addEventListener('change', calculateTotal);
            endDateInput.addEventListener('change', calculateTotal);
        });
    </script>
</body>