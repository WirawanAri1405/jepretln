 <main class="p-6">
     <section>
         <div class="max-w-screen-xl">
             <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                 <div class="overflow-x-auto ">
                     <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                         <tbody>
                             <tr>
                                 <td colspan="7" class="px-4 py-6">
                                     <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md max-w-7xl mx-auto">
                                         <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Edit Data Pesanan</h2>

                                         <form class="space-y-6">
                                             <!-- Baris 1: ID & Order Number -->
                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                 <div>
                                                     <p class="text-sm text-gray-500 dark:text-gray-400">ID</p>
                                                     <p class="font-medium text-gray-900 dark:text-white">1025</p>
                                                 </div>
                                                 <div>
                                                     <label for="order_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Order</label>
                                                     <input type="text" id="order_number" value="ORD-20250601-001" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                 </div>
                                             </div>

                                             <!-- Baris 2: User ID & Status -->
                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                 <div>
                                                     <p class="text-sm text-gray-500 dark:text-gray-400">User ID</p>
                                                     <p class="font-medium text-gray-900 dark:text-white">56</p>
                                                 </div>
                                                 <div>
                                                     <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                                     <select id="status" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm">
                                                         <option selected>Pending</option>
                                                         <option>Confirmed</option>
                                                         <option>Completed</option>
                                                         <option>Cancelled</option>
                                                     </select>
                                                 </div>
                                             </div>

                                             <!-- Baris 3: Rental Dates -->
                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                 <div>
                                                     <label for="rental_start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Mulai Sewa</label>
                                                     <input type="datetime-local" id="rental_start_date" value="2025-06-21T08:00" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                 </div>
                                                 <div>
                                                     <label for="rental_end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Selesai Sewa</label>
                                                     <input type="datetime-local" id="rental_end_date" value="2025-06-23T17:00" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                 </div>
                                             </div>

                                             <!-- Baris 4: Pickup & Return Location -->
                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                 <div>
                                                     <label for="pickup_location_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lokasi Pengambilan</label>
                                                     <select id="pickup_location_id" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm">
                                                         <option value="">-- Pilih --</option>
                                                         <option selected value="1">Bantul</option>
                                                         <option selected value="2">Sleman</option>
                                                         <option selected value="3">Kota Yogyakarta</option>
                                                         <option selected value="4">Kulon Progo</option>
                                                         <option selected value="5">Palu</option>
                                                     </select>
                                                 </div>
                                                 <div>
                                                     <label for="return_location_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lokasi Pengembalian</label>
                                                     <select id="return_location_id" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm">
                                                         <option value="">-- Pilih --</option>
                                                         <option selected value="1">Bantul</option>
                                                         <option selected value="2">Sleman</option>
                                                         <option selected value="3">Kota Yogyakarta</option>
                                                         <option selected value="4">Kulon Progo</option>
                                                         <option selected value="5">Palu</option>
                                                     </select>
                                                 </div>
                                             </div>

                                             <!-- Baris 5: Subtotal, Discount -->
                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                 <div>
                                                     <label for="subtotal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subtotal</label>
                                                     <input type="number" step="0.01" id="subtotal" value="300000.00" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                 </div>
                                                 <div>
                                                     <label for="discount_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Diskon</label>
                                                     <input type="number" step="0.01" id="discount_amount" value="20000.00" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                 </div>
                                             </div>

                                             <!-- Baris 6: Insurance, Deposit -->
                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                 <div>
                                                     <label for="insurance_fee" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Biaya Asuransi</label>
                                                     <input type="number" step="0.01" id="insurance_fee" value="10000.00" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                 </div>
                                                 <div>
                                                     <label for="deposit_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Uang Jaminan</label>
                                                     <input type="number" step="0.01" id="deposit_amount" value="100000.00" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                 </div>
                                             </div>

                                             <!-- Baris 7: Total, Kupon -->
                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                 <div>
                                                     <label for="total_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Bayar</label>
                                                     <input type="number" step="0.01" id="total_amount" value="290000.00" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                 </div>
                                                 <div>
                                                     <label for="coupon_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID Kupon</label>
                                                     <input type="number" id="coupon_id" value="3" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                 </div>
                                             </div>

                                             <!-- Baris 8: Catatan -->
                                             <div>
                                                 <label for="customer_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan Pelanggan</label>
                                                 <textarea id="customer_notes" rows="2" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 text-sm">Tolong siapkan kamera sebelum jam 8.</textarea>
                                             </div>
                                             <div>
                                                 <label for="internal_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan Internal</label>
                                                 <textarea id="internal_notes" rows="2" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 text-sm">Tambahkan tripod cadangan.</textarea>
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

 </div>
 </div>