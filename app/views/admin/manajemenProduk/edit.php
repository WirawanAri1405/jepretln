<main class="p-6">
    <section>
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Edit Data Produk</h2>

                <form action="<?= BASEURL; ?>/Admin/ManajemenProduk/update" method="post">
                    <input type="hidden" name="id" value="<?= $data['product']['id']; ?>">

                    <div class="space-y-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">ID Produk</p>
                                <p class="font-medium text-gray-900 dark:text-white mt-1"><?= $data['product']['id']; ?></p>
                            </div>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Produk</label>
                                <input type="text" name="name" id="name" value="<?= htmlspecialchars($data['product']['name']); ?>" class="mt-1 w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="category_id_edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                <select name="category_id" id="category_id_edit" class="mt-1 w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($data['categories'] as $category): ?>
                                        <?php
                                        $selected = ($category['id'] == $data['product']['category_id']) ? 'selected' : '';
                                        $templateJson = htmlspecialchars($category['spec_template'] ?? '{}', ENT_QUOTES, 'UTF-8');
                                        ?>
                                        <option value="<?= $category['id']; ?>" data-template='<?= $templateJson ?>' <?= $selected ?>>
                                            <?= htmlspecialchars($category['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="brand_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Merek</label>
                                <select name="brand_id" id="brand_id" class="mt-1 w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" required>
                                    <option value="">Pilih Merek</option>
                                    <?php foreach ($data['brands'] as $brand): ?>
                                        <option value="<?= $brand['id']; ?>" <?= ($brand['id'] == $data['product']['brand_id']) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($brand['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="daily_rental_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Sewa/Hari</label>
                                <input type="number" name="daily_rental_price" id="daily_rental_price" value="<?= htmlspecialchars($data['product']['daily_rental_price']); ?>" class="mt-1 w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" required>
                            </div>
                            <div>
                                <label for="stock_quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Stok</label>
                                <input type="number" name="stock_quantity" id="stock_quantity" value="<?= htmlspecialchars($data['product']['stock_quantity']); ?>" class="mt-1 w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" required>
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Produk</label>
                            <select name="status" id="status" class="mt-1 w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" required>
                                <option value="available" <?= ($data['product']['status'] == 'available') ? 'selected' : ''; ?>>Available</option>
                                <option value="maintenance" <?= ($data['product']['status'] == 'maintenance') ? 'selected' : ''; ?>>Maintenance</option>
                                <option value="discontinued" <?= ($data['product']['status'] == 'discontinued') ? 'selected' : ''; ?>>Discontinued</option>
                            </select>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi Produk</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 text-sm"><?= htmlspecialchars($data['product']['description']); ?></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Spesifikasi Detail</label>
                            <div id="dynamic-spec-fields-container-edit" class="space-y-4 p-4 mt-1 w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm">
                                <p class="text-gray-500 text-sm">Pilih kategori untuk menampilkan field spesifikasi.</p>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 pt-4 border-t mt-6 dark:border-gray-600">
                            <a href="<?= BASEURL; ?>/Admin/ManajemenProduk" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm font-medium dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm font-medium">
                                Simpan Perubahan
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_id_edit');
        const specContainer = document.getElementById('dynamic-spec-fields-container-edit');

        const existingSpecsJson = <?= json_encode($data['product']['specifications'] ?? '{}'); ?>;
        const existingSpecs = JSON.parse(existingSpecsJson);

        function generateSpecFields() {
            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            const templateData = selectedOption.getAttribute('data-template');

            specContainer.innerHTML = '';

            if (!templateData) {
                specContainer.innerHTML = '<p class="text-gray-500 text-sm">Template tidak ditemukan untuk kategori ini.</p>';
                return;
            }

            try {
                const template = JSON.parse(templateData);
                const fields = template.fields;

                if (Object.keys(fields).length === 0) {
                    specContainer.innerHTML = '<p class="text-gray-500 text-sm">Tidak ada template spesifikasi untuk kategori ini.</p>';
                    return;
                }

                for (const key in fields) {
                    const labelText = fields[key];
                    const existingValue = existingSpecs[key] || '';

                    const fieldHtml = `
                    <div>
                        <label for="spec_${key}" class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">${labelText}</label>
                        <input type="text" 
                               id="spec_${key}" 
                               name="specifications[${key}]" 
                               value="${existingValue.replace(/"/g, '&quot;')}"
                               class="w-full p-2 border rounded-md text-sm bg-white dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                               placeholder="Masukkan ${labelText}...">
                    </div>
                `;
                    specContainer.innerHTML += fieldHtml;
                }
            } catch (e) {
                specContainer.innerHTML = '<p class="text-red-500 text-sm">Error: Format template JSON tidak valid.</p>';
                console.error("JSON Parse Error:", e);
            }
        }

        categorySelect.addEventListener('change', generateSpecFields);

        if (categorySelect.value) {
            generateSpecFields();
        }
    });
</script>