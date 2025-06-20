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
                                                 <tbody>
                                                     <tr>
                                                         <td colspan="7" class="px-4 py-6">
                                                             <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md max-w-4xl mx-auto">
                                                                 <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Edit Data Pengguna</h2>

                                                                 <form class="space-y-6">
                                                                     <!-- ID (Read Only) & Name -->
                                                                     <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                                         <div>
                                                                             <p class="text-sm text-gray-500 dark:text-gray-400">ID</p>
                                                                             <p class="font-medium text-gray-900 dark:text-white">5617</p>
                                                                         </div>
                                                                         <div>
                                                                             <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                                                                             <input type="text" id="name" value="Abdi Wicaksono" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                                         </div>
                                                                     </div>

                                                                     <!-- Email & Password -->
                                                                     <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                                         <div>
                                                                             <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                                                             <input type="email" id="email" value="abdiwicak71@gmail.com" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                                         </div>
                                                                         <div>
                                                                             <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                                                                             <!-- Ganti type="text" ke type="password" agar ke blur -->
                                                                             <input type="text" id="password" value="Wireng1234" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                                         </div>
                                                                     </div>

                                                                     <!-- Phone & Status -->
                                                                     <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                                                         <div>
                                                                             <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. Handphone</label>
                                                                             <input type="tel" id="phone_number" value="08988325718" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                                                                         </div>
                                                                         <div>
                                                                             <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                                                             <select id="status" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm">
                                                                                 <option value="active" selected>Active</option>
                                                                                 <option value="blocked">Blocked</option>
                                                                             </select>
                                                                         </div>
                                                                     </div>

                                                                     <!-- Address -->
                                                                     <div>
                                                                         <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                                                                         <textarea id="address" rows="2" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm">Jl. Godean Km 7, Sleman</textarea>
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

 </div>
 </div>