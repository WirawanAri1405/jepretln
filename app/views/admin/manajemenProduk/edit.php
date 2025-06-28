<main class="p-6">
    <section>
        <div class="max-w-screen-lg mx-auto">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Edit Produk: <?= htmlspecialchars($data['produk']['product_name']); ?></h1>
            
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <form id="edit-product-form" action="<?= BASEURL; ?>/Admin/ManajemenProduk/update" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $data['produk']['id']; ?>">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium">Nama Produk</label>
                            <input type="text" name="name" id="name" class="w-full p-2 mt-1 rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600" required value="<?= htmlspecialchars($data['produk']['product_name']); ?>">
                        </div>
                        <div>
                            <label for="category_id" class="block text-sm font-medium">Kategori</label>
                            <select name="category_id" id="category_id" class="w-full p-2 mt-1 rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                                <?php foreach ($data['kategori'] as $kategori) : ?>
                                    <option value="<?= $kategori['id']; ?>" <?= ($kategori['id'] == $data['produk']['category_id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($kategori['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="brand_id" class="block text-sm font-medium">Merek</label>
                            <select name="brand_id" id="brand_id" class="w-full p-2 mt-1 rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                                <?php foreach ($data['merek'] as $merek) : ?>
                                    <option value="<?= $merek['id']; ?>" <?= ($merek['id'] == $data['produk']['brand_id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($merek['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="daily_rental_price" class="block text-sm font-medium">Harga Sewa / Hari</label>
                            <input type="number" name="daily_rental_price" id="daily_rental_price" class="w-full p-2 mt-1 rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600" required value="<?= $data['produk']['daily_rental_price']; ?>">
                        </div>
                        <div>
                            <label for="stock_quantity" class="block text-sm font-medium">Jumlah Stok</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" class="w-full p-2 mt-1 rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600" required value="<?= $data['produk']['stock_quantity']; ?>">
                        </div>
                         <div class="md:col-span-2">
                             <label for="description" class="block text-sm font-medium">Deskripsi</label>
                             <textarea name="description" id="description" rows="4" class="w-full p-2 mt-1 rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600"><?= htmlspecialchars($data['produk']['description']); ?></textarea>
                        </div>
                    </div>
                    
                    <hr class="my-6 dark:border-gray-600">

                    <div>
                        <h3 class="text-md font-semibold mb-2">Spesifikasi Produk</h3>
                        <div id="specifications-container" class="space-y-4"></div>
                    </div>
                    
                    <hr class="my-6 dark:border-gray-600">

                    <div>
                        <h3 class="text-md font-semibold mb-2">Gambar Produk</h3>
                        <div id="existing-images-container" class="flex flex-wrap gap-4 mb-4">
                            <?php foreach($data['produk']['images'] as $img): ?>
                                <div class="relative w-24 h-24 group">
                                    <img src="<?= BASEURL; ?>/assets/produk/<?= $img['image_path']; ?>" class="w-full h-full object-cover rounded-lg border <?= $img['is_primary'] ? 'border-2 border-blue-500' : '' ?>">
                                    <?php if(!$img['is_primary']): // Jangan beri tombol hapus pada gambar utama ?>
                                        <button type="button" data-image-id="<?= $img['id']; ?>" class="delete-image-btn absolute top-0 right-0 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center -mt-2 -mr-2 opacity-0 group-hover:opacity-100 transition-opacity">&times;</button>
                                    <?php endif; ?>
                                    <?php if($img['is_primary']): ?>
                                        <span class="absolute top-0 left-0 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-br-lg">Utama</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <label for="images" class="block text-sm font-medium">Tambah Gambar Baru</label>
                        <input type="file" name="images[]" id="images" class="block w-full text-sm..." multiple>
                        <div id="image-preview-container" class="mt-4 flex flex-wrap gap-4"></div>
                    </div>

                    <div class="flex justify-end pt-6 border-t mt-6">
                        <a href="<?= BASEURL; ?>/Admin/ManajemenProduk" class="px-4 py-2 bg-gray-200 ... rounded-md">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md ... ms-3">Update Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('edit-product-form');
    
    // --- Logika untuk Hapus Gambar yang Sudah Ada ---
    document.getElementById('existing-images-container').addEventListener('click', function(e){
        if(e.target && e.target.classList.contains('delete-image-btn')){
            const imageId = e.target.dataset.imageId;
            if(confirm('Yakin ingin menghapus gambar ini secara permanen?')){
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
                    img.className = 'w-24 h-24 object-cover rounded-lg border';
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
                fieldWrapper.innerHTML = `
                    <label for="spec-${key}" class="block text-sm font-medium text-gray-700">${labelText}</label>
                    <input type="text" id="spec-${key}" name="spesifikasi[${key}]" value="${value}" class="w-full p-2 mt-1 rounded-md border-gray-300">
                `;
                specsContainer.appendChild(fieldWrapper);
            }
        } else {
            specsContainer.innerHTML = '<p class="text-sm text-gray-500">Tidak ada template spesifikasi untuk kategori ini.</p>';
        }
    }
    
    renderSpecFields(); // Panggil saat halaman pertama kali dimuat
});
</script>