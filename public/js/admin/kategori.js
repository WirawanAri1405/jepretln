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
    //prevew image
    if (typeof imagePreviewInitialized === 'undefined') {
    var imagePreviewInitialized = true;

    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');

        // Pastikan elemennya ada sebelum menambahkan event listener
        if (imageInput && imagePreview) {
            
            imageInput.addEventListener('change', function(event) {
                // Ambil file yang dipilih oleh pengguna
                const file = event.target.files[0];

                if (file) {
                    // Jika ada file yang dipilih, buat URL sementara untuk file tersebut
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // Tampilkan gambar di elemen <img>
                        imagePreview.src = e.target.result;
                        // Hapus kelas 'hidden' agar gambar terlihat
                        imagePreview.classList.remove('hidden');
                    };
                    
                    // Baca file sebagai Data URL
                    reader.readAsDataURL(file);
                } else {
                    // Jika tidak ada file yang dipilih (misal: pengguna klik cancel)
                    // Sembunyikan kembali elemen <img>
                    imagePreview.classList.add('hidden');
                    imagePreview.src = '#';
                }
            });
        }
    });
}