<main class="p-6">
    <section>
        <div class="max-w-screen-md mx-auto">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Edit Kategori Produk</h2>

                <form class="space-y-6" method="POST" action="<?= BASEURL; ?>/Admin/ManajemenKategori/update">

                    <div>
                        <label for="id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID Kategori</label>
                        <input type="text" id="id" name="id" value="<?= $data['kategori']['id']; ?>" readonly
                            class="w-full p-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 border border-gray-300 dark:border-gray-600 text-sm cursor-not-allowed" />
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Kategori</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($data['kategori']['name']); ?>"
                            class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" required />
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug (URL)</label>
                        <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($data['kategori']['slug']); ?>" readonly
                            class="w-full p-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 border border-gray-300 dark:border-gray-600 text-sm cursor-not-allowed" />
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="<?= BASEURL; ?>/Admin/ManajemenKategori" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm dark:bg-gray-600 dark:text-white">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">Simpan Perubahan</button>
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