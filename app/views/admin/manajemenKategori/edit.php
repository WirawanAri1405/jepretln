<main class="p-6">
    <section>
        <div class="max-w-screen-lg mx-auto">
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Edit Kategori: <?= htmlspecialchars($data['kategori']['name']); ?></h1>

            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-6">
                <form action="<?= BASEURL; ?>/Admin/ManajemenKategori/update" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $data['kategori']['id']; ?>">

                    <div class="grid gap-6 mb-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori</label>
                            <input type="text" name="name" id="name" autocomplete="off"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                required value="<?= htmlspecialchars($data['kategori']['name']); ?>">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ubah Gambar Kategori</label>
                            <div class="flex items-center flex-wrap gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Gambar Saat Ini:</p>
                                    <img src="<?= BASEURL; ?>/assets/kategori/<?= $data['kategori']['image']; ?>" class="w-24 h-24 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                </div>
                                <div class="flex-1 min-w-[200px]">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Pilih Gambar Baru (Opsional):</p>
                                    <input type="file" name="image" id="image-input" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                                </div>
                            </div>
                            <img id="image-preview" class="hidden mt-4 w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600" src="#" alt="Pratinjau Gambar Baru" />
                        </div>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Template Spesifikasi</h3>
                        <div id="spec-fields-container" class="space-y-4">
                        </div>
                        <button type="button" id="add-spec-field" class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">
                            <svg class="w-4 h-4 me-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Tambah Field Spesifikasi
                        </button>
                    </div>

                    <div class="flex items-center justify-end gap-4 border-t border-gray-200 dark:border-gray-700 mt-6 pt-6">
                        <a href="<?= BASEURL; ?>/Admin/ManajemenKategori" class="text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 py-2.5 px-5 rounded-lg">
                            Batal
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Update Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- FUNGSI UNTUK PRATINJAU GAMBAR ---
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');

        if (imageInput && imagePreview) {
            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

        // --- FUNGSI UNTUK TEMPLATE SPESIFIKASI DINAMIS ---
        const container = document.getElementById('spec-fields-container');
        const addButton = document.getElementById('add-spec-field');

        // Fungsi untuk membuat satu baris field spesifikasi
        function createSpecField(key = '', value = '') {
            const fieldBlock = document.createElement('div');
            // Menambahkan class 'spec-field-item' untuk mempermudah penghapusan
            fieldBlock.className = 'flex items-start gap-3 p-3 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-900/20 spec-field-item';

            // Menggunakan class styling yang konsisten untuk input
            const inputClasses = "bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white";

            fieldBlock.innerHTML = `
            <div class="flex-grow space-y-2">
                <div>
                    <label class="text-xs font-medium text-gray-600 dark:text-gray-400">Nama Teknis (Key)</label>
                    <input type="text" name="spec_keys[]" class="${inputClasses} mt-1" placeholder="cth: resolusi_sensor" value="${key}" required>
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 dark:text-gray-400">Label Tampil</label>
                    <input type="text" name="spec_values[]" class="${inputClasses} mt-1" placeholder="cth: Resolusi Sensor (MP)" value="${value}" required>
                </div>
            </div>
            <div class="pt-6">
                <button type="button" class="remove-spec-field text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-100 dark:hover:bg-red-900/50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        `;
            container.appendChild(fieldBlock);
        }

        // Event listener untuk tombol 'Tambah'
        if (addButton) {
            addButton.addEventListener('click', () => createSpecField());
        }

        // Event listener untuk tombol 'Hapus' (menggunakan event delegation)
        if (container) {
            container.addEventListener('click', function(e) {
                const removeButton = e.target.closest('.remove-spec-field');
                if (removeButton) {
                    removeButton.closest('.spec-field-item').remove();
                }
            });
        }

        // Memuat data template yang sudah ada saat halaman edit dibuka
        try {
            const existingTemplate = JSON.parse(<?= json_encode($data['kategori']['spec_template'] ?? '{}'); ?>);
            if (existingTemplate && existingTemplate.fields) {
                for (const key in existingTemplate.fields) {
                    createSpecField(key, existingTemplate.fields[key]);
                }
            }
        } catch (e) {
            console.error('Gagal mem-parsing spec_template JSON:', e);
        }
    });
</script>