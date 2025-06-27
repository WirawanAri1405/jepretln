<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full"> <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Buat Kategori Baru
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form class="p-4 md:p-5" action="<?= BASEURL; ?>/Admin/ManajemenKategori/tambah" method="post">
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori</label>
                        <input type="text" name="name" id="name" autocomplete="off"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Contoh: Kamera Mirrorless" required>
                    </div>

                    <div>
                        <h3 class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-2 border-t pt-4">Template Spesifikasi</h3>
                        
                        <div id="spec-fields-container-modal" class="space-y-3">
                            </div>

                        <button type="button" id="add-spec-field-modal" class="mt-4 text-sm text-blue-600 hover:text-blue-800">
                            + Tambah Spesifikasi Baru
                        </button>
                    </div>
                </div>

                <div class="border-t pt-4 mt-4">
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Tambahkan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Pastikan script ini hanya berjalan satu kali, bahkan jika file modal dimuat beberapa kali.
if (typeof specModalInitialized === 'undefined') {
    var specModalInitialized = true;

    document.addEventListener('DOMContentLoaded', function() {
        // Gunakan ID yang unik untuk elemen di dalam modal
        const container = document.getElementById('spec-fields-container-modal');
        const addButton = document.getElementById('add-spec-field-modal');
        
        // Fungsi untuk membuat satu blok input spesifikasi baru (tampilan atas-bawah)
        function createSpecFieldModal(key = '', value = '') {
            const fieldBlock = document.createElement('div');
            fieldBlock.className = 'flex items-start gap-3 p-3 border rounded-lg bg-gray-50 dark:bg-gray-800';

            fieldBlock.innerHTML = `
                <div class="flex-grow space-y-2">
                    <div>
                        <label class="text-xs font-medium text-gray-600 dark:text-gray-400">Nama Teknis</label>
                        <input type="text" name="spec_keys[]" class="w-full p-2 border rounded-md text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="cth: resolusi_mp" value="${key}">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-600 dark:text-gray-400">Label Tampil</label>
                        <input type="text" name="spec_values[]" class="w-full p-2 border rounded-md text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="cth: Resolusi (MP)" value="${value}">
                    </div>
                </div>
                <div class="pt-6">
                    <button type="button" class="remove-spec-field text-red-500 hover:text-red-700 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            `;

            fieldBlock.querySelector('.remove-spec-field').addEventListener('click', function() {
                fieldBlock.remove();
            });

            container.appendChild(fieldBlock);
        }

        // Pastikan addButton ada sebelum menambahkan event listener
        if (addButton) {
            addButton.addEventListener('click', function() {
                createSpecFieldModal();
            });
        }
    });
}
</script>