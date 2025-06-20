 <main class="p-6">
     <section>
         <div class="max-w-screen-xl">
             <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                 <div class="overflow-x-auto ">
                     <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                         <main class="p-6">
                             <section>
                                 <div class="max-w-screen-xl">
                                     <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                                         <div class="overflow-x-auto">
                                             <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                 <main class="p-6">
                                                     <section>
                                                         <div class="max-w-screen-xl">
                                                             <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                                                                 <div class="overflow-x-auto">
                                                                     <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                                         <tbody>
                                                                             <tr>
                                                                                 <td colspan="7" class="px-4 py-6">
                                                                                     <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md max-w-4xl mx-auto">
                                                                                         <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Edit Data Produk</h2>

                                                                                         <form class="space-y-6" enctype="multipart/form-data">
                                                                                             <!-- Baris 1: ID (readonly) dan Nama -->
                                                                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                                                                 <div>
                                                                                                     <p class="text-sm text-gray-500 dark:text-gray-400">ID Produk</p>
                                                                                                     <p class="font-medium text-gray-900 dark:text-white">5617</p>
                                                                                                 </div>
                                                                                                 <div>
                                                                                                     <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Produk</label>
                                                                                                     <input type="text" id="name" value="Sony Alpha A7III" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                                                                 </div>
                                                                                             </div>

                                                                                             <!-- Slug dan Kategori -->
                                                                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                                                                 <div>
                                                                                                     <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug (URL)</label>
                                                                                                     <input type="text" id="slug" value="sony-alpha-a7iii" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                                                                 </div>
                                                                                                 <div>
                                                                                                     <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                                                                                     <select id="category_id" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm">
                                                                                                         <option value="1" selected>Kamera Mirrorless</option>
                                                                                                         <option value="2">DSLR</option>
                                                                                                         <option value="3">Aksesoris</option>
                                                                                                     </select>
                                                                                                 </div>
                                                                                             </div>

                                                                                             <!-- Merek dan Status -->
                                                                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                                                                 <div>
                                                                                                     <label for="brand_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Merek</label>
                                                                                                     <select id="brand_id" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm">
                                                                                                         <option value="1" selected>Sony</option>
                                                                                                         <option value="2">Canon</option>
                                                                                                         <option value="3">Nikon</option>
                                                                                                     </select>
                                                                                                 </div>
                                                                                                 <div>
                                                                                                     <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Produk</label>
                                                                                                     <select id="status" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm">
                                                                                                         <option value="available" selected>Available</option>
                                                                                                         <option value="maintenance">Maintenance</option>
                                                                                                         <option value="discontinued">Discontinued</option>
                                                                                                     </select>
                                                                                                 </div>
                                                                                             </div>

                                                                                             <!-- Harga dan Stok -->
                                                                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                                                                 <div>
                                                                                                     <label for="daily_rental_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Sewa/Hari</label>
                                                                                                     <input type="number" id="daily_rental_price" value="150000" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                                                                 </div>
                                                                                                 <div>
                                                                                                     <label for="stock_quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Stok</label>
                                                                                                     <input type="number" id="stock_quantity" value="10" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                                                                 </div>
                                                                                             </div>

                                                                                             <!-- Deskripsi -->
                                                                                             <div>
                                                                                                 <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi Produk</label>
                                                                                                 <textarea id="description" rows="3" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 text-sm">Kamera full-frame ideal untuk videografi dan fotografi profesional.</textarea>
                                                                                             </div>

                                                                                             <!-- Spesifikasi JSON -->
                                                                                             <div>
                                                                                                 <label for="specifications" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Spesifikasi (JSON)</label>
                                                                                                 <textarea id="specifications" rows="3" class="w-full p-2 font-mono rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 text-sm">

                                                                                                 </textarea>
                                                                                             </div>

                                                                                             <!-- Gambar -->
                                                                                             <div>
                                                                                                 <label for="product_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Gambar</label>
                                                                                                 <input type="file" id="product_image" accept="image/*" class="block mt-1 text-sm text-gray-500 dark:text-gray-400" />
                                                                                                 <p class="mt-2 text-xs text-gray-400">Format gambar .jpg, .png. Maks 2MB.</p>
                                                                                             </div>

                                                                                             <!-- Tombol -->
                                                                                             <div class="flex justify-end space-x-3 pt-4">
                                                                                                 <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">Simpan</button>
                                                                                                 <button type="button" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 text-sm">Batal</button>
                                                                                             </div>
                                                                                         </form>

                                                                                     </div>
                                                                                 </td>
                                                                             </tr>
                                                                         </tbody>
                                                                     </table>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </section>
                                                 </main>

                                             </table>
                                         </div>
                                     </div>
                                 </div>
                             </section>
                         </main>


                     </table>
                 </div>
             </div>
         </div>
     </section>
 </main>

 </div>
 </div>