<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Produk Baru
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form class="p-4 md:p-5" action="<?= BASEURL; ?>/Admin/ManajemenProduk/tambah" method="post" enctype="multipart/form-data">
                <div class="grid gap-6 mb-4 grid-cols-1 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Contoh: Sony Alpha A7 III" required>
                    </div>
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select name="category_id" id="category_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <?php if (isset($data['categories']) && is_array($data['categories'])): ?>
                                <?php foreach ($data['categories'] as $kategori) : ?>
                                    <option value="<?= $kategori['id']; ?>"><?= htmlspecialchars($kategori['name']); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div>
                        <label for="brand_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Merek</label>
                        <select name="brand_id" id="brand_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="" disabled selected>-- Pilih Merek --</option>
                            <?php if (isset($data['brands']) && is_array($data['brands'])): ?>
                                <?php foreach ($data['brands'] as $merek) : ?>
                                    <option value="<?= $merek['id']; ?>"><?= htmlspecialchars($merek['name']); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div>
                        <label for="daily_rental_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Sewa / Hari</label>
                        <input type="number" name="daily_rental_price" id="daily_rental_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Contoh: 150000" required min="0">
                    </div>
                    <div>
                        <label for="stock_quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Stok</label>
                        <input type="number" name="stock_quantity" id="stock_quantity"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Contoh: 10" required min="0">
                    </div>
                    <div class="md:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Deskripsi singkat produk..."></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label for="images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Produk</label>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Gambar pertama yang Anda pilih akan menjadi gambar utama.</p>
                        <input type="file" name="images[]" id="images" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" multiple required>
                        <div id="image-preview-container" class="mt-4 flex flex-wrap gap-4"></div>
                    </div>
                </div>

                <div>
                    <h3 class="text-md font-semibold mb-4 text-gray-900 dark:text-white">Spesifikasi Produk</h3>
                    <div id="specifications-container" class="space-y-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Pilih kategori terlebih dahulu untuk menampilkan field spesifikasi.</p>
                    </div>
                </div>

                <div class="border-t dark:border-gray-600 pt-4 mt-6 flex justify-end">
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Tambahkan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Menyatukan semua script dalam satu event listener untuk efisiensi
    document.addEventListener('DOMContentLoaded', function() {

        // --- Script untuk Image Preview ---
        const imageInput = document.getElementById('images');
        const previewContainer = document.getElementById('image-preview-container');

        if (imageInput && previewContainer) {
            imageInput.addEventListener('change', function(event) {
                previewContainer.innerHTML = ''; // Kosongkan preview saat ada perubahan
                if (this.files) {
                    Array.from(this.files).forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'relative w-24 h-24';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'w-full h-full object-cover rounded-lg border-2 dark:border-gray-600';

                            // Tandai gambar pertama sebagai gambar utama
                            if (index === 0) {
                                img.classList.add('border-blue-500');
                                const mainLabel = document.createElement('span');
                                mainLabel.className = 'absolute top-0 left-0 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-br-lg rounded-tl-lg';
                                mainLabel.textContent = 'Utama';
                                wrapper.appendChild(mainLabel);
                            }

                            wrapper.appendChild(img);
                            previewContainer.appendChild(wrapper);
                        }
                        reader.readAsDataURL(file);
                    });
                }
            });
        }

        // --- Script untuk Spesifikasi Dinamis ---
        const categorySelect = document.getElementById('category_id');
        const specsContainer = document.getElementById('specifications-container');

        if (categorySelect && specsContainer) {
            categorySelect.addEventListener('change', function() {
                const categoryId = this.value;
                specsContainer.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400">Memuat...</p>';

                if (!categoryId) {
                    specsContainer.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400">Pilih kategori terlebih dahulu.</p>';
                    return;
                }

                // Fetch template spesifikasi dari server
                fetch(`<?= BASEURL ?>/Admin/ManajemenKategori/getSpecTemplate/${categoryId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(specConfig => {
                        specsContainer.innerHTML = ''; // Kosongkan kontainer

                        if (specConfig && specConfig.fields && Object.keys(specConfig.fields).length > 0) {
                            // Buat grid untuk layout spesifikasi yang lebih rapi
                            const specGrid = document.createElement('div');
                            specGrid.className = 'grid grid-cols-1 md:grid-cols-2 gap-6';

                            for (const key in specConfig.fields) {
                                const labelText = specConfig.fields[key];

                                const fieldWrapper = document.createElement('div');
                                // Gunakan class yang konsisten dengan input lainnya
                                fieldWrapper.innerHTML = `
                                <label for="spec-${key}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">${labelText}</label>
                                <input type="text" id="spec-${key}" name="spesifikasi[${key}]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="${labelText}...">
                            `;
                                specGrid.appendChild(fieldWrapper);
                            }
                            specsContainer.appendChild(specGrid);
                        } else {
                            specsContainer.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada template spesifikasi untuk kategori ini.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching specifications:', error);
                        specsContainer.innerHTML = '<p class="text-sm text-red-500">Gagal memuat spesifikasi. Silakan coba lagi.</p>';
                    });
            });
        }
    });
</script>