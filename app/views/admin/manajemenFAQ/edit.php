<main class="p-6">
    <section>
        <div class="max-w-screen-lg mx-auto">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Edit FAQ</h1>
            
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <form action="<?= BASEURL; ?>/Admin/ManajemenFAQ/update" method="post">
                    <input type="hidden" name="id" value="<?= $data['faq']['id']; ?>">
                    
                    <div class="grid gap-6 mb-6">
                        <div class="col-span-2">
                            <label for="question" class="block mb-2 text-sm font-medium">Pertanyaan</label>
                            <input type="text" name="question" id="question" class="bg-gray-50 border w-full p-2.5 rounded-lg" required value="<?= htmlspecialchars($data['faq']['question']); ?>">
                        </div>

                        <div class="col-span-2">
                            <label for="answer" class="block mb-2 text-sm font-medium">Jawaban</label>
                            <textarea name="answer" id="answer" rows="6" class="bg-gray-50 border w-full p-2.5 rounded-lg" required><?= htmlspecialchars($data['faq']['answer']); ?></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="is_published" class="block mb-2 text-sm font-medium">Status</label>
                                <select id="is_published" name="is_published" class="bg-gray-50 border w-full p-2.5 rounded-lg">
                                    <option value="1" <?= ($data['faq']['is_published'] == 1) ? 'selected' : ''; ?>>Published</option>
                                    <option value="0" <?= ($data['faq']['is_published'] == 0) ? 'selected' : ''; ?>>Draft</option>
                                </select>
                            </div>
                            <div>
                                <label for="sort_order" class="block mb-2 text-sm font-medium">Urutan Tampil</label>
                                <input type="number" name="sort_order" id="sort_order" class="bg-gray-50 border w-full p-2.5 rounded-lg" required value="<?= $data['faq']['sort_order']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t">
                        <a href="<?= BASEURL; ?>/Admin/ManajemenFAQ" class="px-4 py-2 bg-gray-200 rounded-md text-sm">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md ms-3 text-sm">Update FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>