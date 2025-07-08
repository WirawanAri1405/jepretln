<body class="bg-gray-100">
    <main class="container mx-auto mt-10 px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Riwayat Pesanan Saya</h1>

        <?php Flasher::flash(); ?>

        <div class="space-y-4">
            <?php if (empty($data['orders'])): ?>
                <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-500">
                    <p>Anda belum memiliki riwayat pesanan.</p>
                </div>
            <?php else: ?>
                <?php foreach ($data['orders'] as $order): ?>
                    <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md border border-gray-200">
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center border-b pb-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-500">Nomor Pesanan</p>
                                <p class="font-mono font-semibold text-gray-800"><?= htmlspecialchars($order['order_number']); ?></p>
                            </div>
                            <div class="mt-2 sm:mt-0 sm:text-right">
                                <p class="text-sm text-gray-500">Tanggal Pesanan</p>
                                <p class="text-gray-800"><?= date('d F Y', strtotime($order['created_at'])); ?></p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                            <div>
                                <p class="text-sm text-gray-500">Total Pembayaran</p>
                                <p class="text-xl font-bold text-gray-900">Rp <?= number_format($order['total_amount'], 0, ',', '.'); ?></p>
                                <p class="text-sm text-gray-500 mt-2">
                                    Sewa dari <?= date('d M Y', strtotime($order['rental_start_date'])); ?>
                                    sampai <?= date('d M Y', strtotime($order['rental_end_date'])); ?>
                                </p>
                            </div>
                            <div class="mt-4 sm:mt-0 flex items-center space-x-4">
                                <div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        <?php
                                        switch ($order['status']) {
                                            case 'completed':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'rented':
                                                echo 'bg-blue-100 text-blue-800';
                                                break;
                                            case 'cancelled':
                                                echo 'bg-red-100 text-red-800';
                                                break;
                                            default:
                                                echo 'bg-yellow-100 text-yellow-800';
                                        }
                                        ?>">
                                        <?= ucfirst(str_replace('_', ' ', $order['status'])); ?>
                                    </span>
                                </div>
                                <a href="#" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-900">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
</body>