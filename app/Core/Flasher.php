<?php

class Flasher
{
    public static function setFlash($pesan, $aksi, $type)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'type' => $type
        ];
    }
    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            $pesan = $_SESSION['flash']['pesan'];
            $aksi = $_SESSION['flash']['aksi'];
            $type = $_SESSION['flash']['type'];

            // Array untuk mendefinisikan style berdasarkan tipe notifikasi
            $alertStyles = [
                'success' => [
                    'div' => 'text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400',
                    'button' => 'bg-green-50 text-green-500 focus:ring-green-400 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700'
                ],
                'danger' => [
                    'div' => 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400',
                    'button' => 'bg-red-50 text-red-500 focus:ring-red-400 hover:bg-red-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700'
                ],
                'warning' => [
                    'div' => 'text-yellow-800 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300',
                    'button' => 'bg-yellow-50 text-yellow-500 focus:ring-yellow-400 hover:bg-yellow-200 dark:bg-gray-800 dark:text-yellow-300 dark:hover:bg-gray-700'
                ],
                'info' => [
                    'div' => 'text-blue-800 bg-blue-50 dark:bg-gray-800 dark:text-blue-400',
                    'button' => 'bg-blue-50 text-blue-500 focus:ring-blue-400 hover:bg-blue-200 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700'
                ]
            ];

            // Pilih style berdasarkan tipe, jika tipe tidak ada, default ke 'info'
            $currentStyle = $alertStyles[$type] ?? $alertStyles['info'];

            // Cetak HTML untuk alert
            echo '
            <div id="flash-alert" class="flex items-center p-4 mb-4 rounded-lg' . $currentStyle['div'] . '" role="alert">
                <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    ' . htmlspecialchars($pesan) . ' <strong>' . htmlspecialchars($aksi) . '</strong>
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8 ' . $currentStyle['button'] . '" data-dismiss-target="#flash-alert" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            ';

            // Hapus flash message dari session agar tidak muncul lagi
            unset($_SESSION['flash']);
        }
    }
}
