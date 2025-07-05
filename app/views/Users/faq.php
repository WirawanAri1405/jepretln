<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['judul']); ?> - Jepretin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-['Poppins',_sans-serif]">


<main class="container mx-auto px-6 py-16">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800"><?= htmlspecialchars($data['judul']); ?></h1>
        <p class="text-gray-600 mt-2">Punya pertanyaan? Kami punya jawabannya.</p>
    </div>

    <div class="max-w-3xl mx-auto mb-8">
        <form method="GET" action=""> 
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input name="search" type="search" class="w-full py-3 pl-10 pr-4 text-gray-700 bg-white border rounded-md focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-amber-300" placeholder="Cari pertanyaan..." value="<?= htmlspecialchars($data['search_term'] ?? ''); ?>">
            </div>
        </form>
    </div>

    <div id="faq-content-wrapper">
        <div class="max-w-3xl mx-auto space-y-4" id="faq-container">
        <?php if (empty($data['faqs'])): ?>
            <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-600">
                <p>Mohon Maaf, pertanyaan yang Anda cari tidak ditemukan.</p>
            </div>
        <?php else: ?>
            <?php foreach ($data['faqs'] as $faq): ?>
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="accordion-header w-full flex justify-between items-center p-5 text-left focus:outline-none">
                        <span class="question-text text-lg font-semibold text-gray-800"><?= htmlspecialchars($faq['question']); ?></span>
                        <svg class="accordion-icon w-5 h-5 flex-shrink-0 text-gray-500 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="accordion-content hidden">
                        <div class="px-5 pb-5 pt-0 text-gray-700 answer-text">
                            <hr class="border-gray-200 mb-4">
                            <p class="leading-relaxed"><?= nl2br(htmlspecialchars($faq['answer'])); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>

        <?php if ($data['total_pages'] > 1): ?>
        <div id="pagination-controls" class="max-w-3xl mx-auto mt-8 flex justify-between items-center text-gray-600">
            <?php
               
                $prev_page = $data['current_page'] - 1;
                $search_query = isset($data['search_term']) ? '&search=' . urlencode($data['search_term']) : '';
                $is_disabled_prev = ($data['current_page'] <= 1) ? 'pointer-events-none opacity-50' : '';
            ?>
            <a href="?page=<?= $prev_page . $search_query; ?>" class="px-4 py-2 bg-white border rounded-md shadow-sm hover:bg-gray-100 <?= $is_disabled_prev; ?>">
                &lt; Previous
            </a>
            <div id="page-info">
                Halaman <?= $data['current_page']; ?> dari <?= $data['total_pages']; ?>
            </div>
            <?php
                $next_page = $data['current_page'] + 1;
                $is_disabled_next = ($data['current_page'] >= $data['total_pages']) ? 'pointer-events-none opacity-50' : '';
            ?>
            <a href="?page=<?= $next_page . $search_query; ?>" class="px-4 py-2 bg-white border rounded-md shadow-sm hover:bg-gray-100 <?= $is_disabled_next; ?>">
                Next &gt;
            </a>
        </div>
        <?php endif; ?>
    </div>
</main>