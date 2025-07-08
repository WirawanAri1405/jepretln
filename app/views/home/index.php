<body class="bg-gray-100 text-gray-800">
    <!-- Banner -->
    <section class="flex justify-center my-6 px-8">
        <img src="<?=BASEURL?>/assets/image/EDS.png" alt="Banner" class="rounded-md shadow-md max-w-full h-auto">
    </section>


    
<section class="flex justify-center my-6 filter drop-shadow-2xl px-4">
    <div class="bg-[#D6B49A] rounded-2xl p-6 shadow-xl">
        <div class="flex flex-wrap justify-center gap-4 ">

            <?php if (!empty($data['kategori_nav'])): ?>
                <?php foreach ($data['kategori_nav'] as $kategori): ?>
                    <a href="<?= BASEURL; ?>/kategori/index/<?= htmlspecialchars($kategori['slug']); ?>" 
                       class="flex flex-col items-center justify-center w-24 p-2 rounded-lg hover:bg-white/20 hover:scale-105 transition text-center">
                        
                        <img src="<?= BASEURL; ?>/assets/kategori/<?= htmlspecialchars($kategori['image'] ?? 'default.jpg'); ?>" 
                             alt="<?= htmlspecialchars($kategori['name']); ?>" 
                             class="w-16 h-16 object-contain mb-1">
                             
                        <span class="text-sm font-medium text-gray-800">
                            <?= htmlspecialchars($kategori['name']); ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>


</body>
</html>