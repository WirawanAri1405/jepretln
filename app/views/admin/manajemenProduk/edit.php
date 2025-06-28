<main class="p-6">
    <section>
        <div class="max-w-screen-lg mx-auto">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Edit Produk: <?= htmlspecialchars($data['produk']['product_name']); ?></h1>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <form id="edit-product-form" action="<?= BASEURL; ?>/Admin/ManajemenProduk/update" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $data['produk']['id']; ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div class="md:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?= htmlspecialchars($data['produk']['product_name']); ?>">
                        </div>
                        <div>
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                            <select name="category_id" id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php foreach ($data['kategori'] as $kategori) : ?>
                                    <option value="<?= $kategori['id']; ?>" <?= ($kategori['id'] == $data['produk']['category_id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($kategori['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="brand_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Merek</label>
                            <select name="brand_id" id="brand_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php foreach ($data['merek'] as $merek) : ?>
                                    <option value="<?= $merek['id']; ?>" <?= ($merek['id'] == $data['produk']['brand_id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($merek['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="daily_rental_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Sewa / Hari</label>
                            <input type="number" name="daily_rental_price" id="daily_rental_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?= $data['produk']['daily_rental_price']; ?>">
                        </div>
                        <div>
                            <label for="stock_quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Stok</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?= $data['produk']['stock_quantity']; ?>">
                        </div>
                        <div class="md:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea name="description" id="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?= htmlspecialchars($data['produk']['description']); ?></textarea>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <div>
                        <h3 class="text-md font-semibold mb-2 text-gray-900 dark:text-white">Spesifikasi Produk</h3>
                        <div id="specifications-container" class="space-y-4"></div>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <div>
                        <h3 class="text-md font-semibold mb-2 text-gray-900 dark:text-white">Gambar Produk</h3>
                        <div id="existing-images-container" class="flex flex-wrap gap-4 mb-4">
                            <?php foreach ($data['produk']['images'] as $img): ?>
                                <div class="relative w-24 h-24 group">
                                    <img src="<?= BASEURL; ?>/assets/produk/<?= $img['image_path']; ?>" class="w-full h-full object-cover rounded-lg border dark:border-gray-600 <?= $img['is_primary'] ? 'border-2 border-blue-500' : 'border-gray-300' ?>">
                                    <?php if (!$img['is_primary']): ?>
                                        <button type="button" data-image-id="<?= $img['id']; ?>" class="delete-image-btn absolute top-0 right-0 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center -mt-2 -mr-2 opacity-0 group-hover:opacity-100 transition-opacity">&times;</button>
                                    <?php endif; ?>
                                    <?php if ($img['is_primary']): ?>
                                        <span class="absolute top-0 left-0 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-br-lg">Utama</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <label for="images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tambah Gambar Baru</label>
                        <input type="file" name="images[]" id="images" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" multiple>
                        <div id="image-preview-container" class="mt-4 flex flex-wrap gap-4"></div>
                    </div>

                    <div class="flex justify-end items-center gap-4 pt-6 border-t border-gray-200 dark:border-gray-700 mt-6">
                        <a href="<?= BASEURL; ?>/Admin/ManajemenProduk" class="text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 py-2 px-4 rounded-lg">Batal</a>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
    // Fungsionalitas JavaScript tetap sama, hanya warna pada HTML yang diubah.
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('edit-product-form');

        // --- Logika untuk Hapus Gambar yang Sudah Ada ---
        document.getElementById('existing-images-container').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('delete-image-btn')) {
                const imageId = e.target.dataset.imageId;
                if (confirm('Yakin ingin menghapus gambar ini secara permanen?')) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'delete_images[]';
                    hiddenInput.value = imageId;
                    form.appendChild(hiddenInput);
                    e.target.parentElement.remove();
                }
            }
        });

        // --- Logika untuk Preview Gambar Baru ---
        document.getElementById('images').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('image-preview-container');
            previewContainer.innerHTML = '';
            if (this.files) {
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-24 h-24 object-cover rounded-lg border border-gray-300 dark:border-gray-600';
                        previewContainer.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        });

        // --- Logika untuk Spesifikasi Dinamis ---
        const specsContainer = document.getElementById('specifications-container');
        const existingSpecs = JSON.parse(<?= json_encode($data['produk']['specifications'] ?? '{}'); ?>);
        const templateSpecs = JSON.parse(<?= json_encode($data['produk']['spec_template'] ?? '{}'); ?>);

        function renderSpecFields() {
            specsContainer.innerHTML = '';
            const labels = templateSpecs.fields || {};

            if (Object.keys(labels).length > 0) {
                for (const key in labels) {
                    const labelText = labels[key];
                    const value = existingSpecs[key] || '';

                    const fieldWrapper = document.createElement('div');
                    // Menambahkan kelas warna yang konsisten pada input dinamis
                    fieldWrapper.innerHTML = `
                    <label for="spec-${key}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">${labelText}</label>
                    <input type="text" id="spec-${key}" name="spesifikasi[${key}]" value="${value}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                `;
                    specsContainer.appendChild(fieldWrapper);
                }
            } else {
                specsContainer.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada template spesifikasi untuk kategori ini.</p>';
            }
        }

        renderSpecFields();
    });
</script>