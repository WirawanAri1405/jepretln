<body class="bg-gray-100 text-gray-800">
    <!-- Banner -->
    <section class="flex justify-center my-6 px-8">
        <img src="<?=BASEURL?>/assets/image/EDS.png" alt="Banner" class="rounded-md shadow-md max-w-full h-auto">
    </section>


    <!-- Icons Photography Tools -->
   <section class="flex justify-center my-6 filter drop-shadow-2xl px-4">
    <div class="bg-[#D6B49A] rounded-2xl p-6 shadow-xl grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-8 gap-8 text-center">

        <?php if (!empty($data['kategori_nav'])): ?>
            <?php foreach ($data['kategori_nav'] as $kategori): ?>
                <a href="<?= BASEURL; ?>/kategori/<?= htmlspecialchars($kategori['slug']); ?>" class="flex flex-col items-center hover:scale-105 transition">
                    <img src="<?= BASEURL; ?>/assets/kategori/<?= htmlspecialchars($kategori['image'] ?? 'default.jpg'); ?>" alt="<?= htmlspecialchars($kategori['name']); ?>" class="w-16 h-16 mb-2 object-contain">
                    <span class="text-sm font-medium"><?= htmlspecialchars($kategori['name']); ?></span>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</section>

</body>
</html>