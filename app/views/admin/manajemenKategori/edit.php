<main class="p-6">
    <section>
        <div class="max-w-screen-lg mx-auto">
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Edit Kategori</h1>

            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-6">
                <form action="<?= BASEURL; ?>/Admin/ManajemenKategori/update" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $data['kategori']['id']; ?>">

                    <div class="grid gap-6 mb-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori</label>
                            <input type="text" name="name" id="name" autocomplete="off"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required value="<?= htmlspecialchars($data['kategori']['name']); ?>">
                        </div>
                        <label for="image-input" class="block mb-2 text-sm font-medium">Ubah Gambar Kategori</label>
                        <div class="flex items-center gap-4">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Gambar Saat Ini:</p>
                                <img src="<?= BASEURL; ?>/assets/kategori/<?= $data['kategori']['image']; ?>" class="w-24 h-24 object-cover rounded-lg border">
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 mb-1">Pilih Gambar Baru (Opsional):</p>
                                <input type="file" name="image" id="image-input" class="block w-full text-sm text-gray-900 border ...">
                                <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                            </div>
                        </div>
                        <img id="image-preview" class="hidden mt-4 w-32 h-32 object-cover rounded-lg border" src="#" alt="Pratinjau Gambar Baru" />
                    </div>

                    <div>
                        <h3 class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-2 border-t pt-4 mt-4">Template Spesifikasi</h3>
                        <div id="spec-fields-container" class="space-y-3">
                        </div>
                        <button type="button" id="add-spec-field" class="mt-4 text-sm text-blue-600 hover:text-blue-800">
                            + Tambah Spesifikasi Baru
                        </button>
                    </div>
            </div>

            <div class="flex items-center">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update Kategori
                </button>
                <a href="<?= BASEURL; ?>/Admin/ManajemenKategori" class="ms-3 py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">
                    Batal
                </a>
            </div>
            </form>
        </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('spec-fields-container');
        const addButton = document.getElementById('add-spec-field');

        function createSpecField(key = '', value = '') {
            const fieldBlock = document.createElement('div');
            fieldBlock.className = 'flex items-start gap-3 p-3 border rounded-lg bg-gray-50 dark:bg-gray-800';
            fieldBlock.innerHTML = `
            <div class="flex-grow space-y-2">
                <div>
                    <label class="text-xs font-medium text-gray-600 dark:text-gray-400">Nama Teknis</label>
                    <input type="text" name="spec_keys[]" class="w-full p-2 border rounded-md text-sm" placeholder="cth: resolusi_mp" value="${key}">
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 dark:text-gray-400">Label Tampil</label>
                    <input type="text" name="spec_values[]" class="w-full p-2 border rounded-md text-sm" placeholder="cth: Resolusi (MP)" value="${value}">
                </div>
            </div>
            <div class="pt-6">
                <button type="button" class="remove-spec-field text-red-500 hover:text-red-700 p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        `;
            fieldBlock.querySelector('.remove-spec-field').addEventListener('click', () => fieldBlock.remove());
            container.appendChild(fieldBlock);
        }

        addButton.addEventListener('click', () => createSpecField());

        // Memuat data template yang sudah ada saat halaman edit dibuka
        try {
            const existingTemplate = JSON.parse(<?= json_encode($data['kategori']['spec_template'] ?? '{}'); ?>);
            if (existingTemplate && existingTemplate.fields) {
                for (const key in existingTemplate.fields) {
                    createSpecField(key, existingTemplate.fields[key]);
                }
            }
        } catch (e) {
            console.error('Could not parse spec_template JSON:', e);
        }
    });
</script>