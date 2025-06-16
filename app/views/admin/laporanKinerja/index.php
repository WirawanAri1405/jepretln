<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 dark:text-slate-100">Laporan & Analitik</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Ringkasan performa bisnis dan wawasan penjualan.</p>
        </div>
        <div class="flex items-center gap-2">
            <form action="#" method="GET" id="reportFilterForm" class="flex items-center gap-2">
                <select name="period" onchange="this.form.submit()" class="w-full sm:w-auto px-4 py-2.5 text-sm border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 rounded-lg shadow-sm focus:ring-1 focus:ring-primary focus:border-primary">
                    <option value="7days">7 Hari Terakhir</option>
                    <option value="30days">30 Hari Terakhir</option>
                    <option value="1year">Tahun Ini</option>
                </select>
            </form>
            <a href="#" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg shadow-sm hover:bg-green-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm2 1v2h12V6H4zm0 4h12v2H4v-2zm0 4h12v2H4v-2z" /></svg>
                <span>Export Excel</span>
            </a>
        </div>
    </div> 

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 shadow-sm rounded-xl p-5">
            <div class="flex items-center justify-between"><p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Revenue</p><svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
            <p class="mt-2 text-3xl font-bold text-slate-800 dark:text-slate-100">Rp 1.500.000.000</p>
            <p class="text-xs mt-1 flex items-center text-green-500">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586l3.293-3.293a1 1 0 011.414 0l-3 3a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg><span>5.2% dari periode lalu</span>
            </p>
        </div>
        <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 shadow-sm rounded-xl p-5">
            <div class="flex items-center justify-between"><p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Orders</p><svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg></div>
            <p class="mt-2 text-3xl font-bold text-slate-800 dark:text-slate-100">1.250</p>
            <p class="text-xs mt-1 flex items-center text-green-500">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586l3.293-3.293a1 1 0 011.414 0l-3 3a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg><span>3.1% dari periode lalu</span>
            </p>
        </div>
        <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 shadow-sm rounded-xl p-5">
            <div class="flex items-center justify-between"><p class="text-sm font-medium text-slate-500 dark:text-slate-400">Active Customers</p><svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg></div>
            <p class="mt-2 text-3xl font-bold text-slate-800 dark:text-slate-100">800</p>
            <p class="text-xs mt-1 flex items-center text-red-500">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1v-5a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414l3.293 3.293a1 1 0 001.414 0l-3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                </svg><span>1.5% dari periode lalu</span>
            </p>
        </div>
        <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 shadow-sm rounded-xl p-5">
            <div class="flex items-center justify-between"><p class="text-sm font-medium text-slate-500 dark:text-slate-400">Avg Order Value</p><svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg></div>
            <p class="mt-2 text-3xl font-bold text-slate-800 dark:text-slate-100">Rp 1.200.000</p>
            <p class="text-xs mt-1 flex items-center text-green-500">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586l3.293-3.293a1 1 0 011.414 0l-3 3a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg><span>2.8% dari periode lalu</span>
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">
        <div class="lg:col-span-3 bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Tren Pendapatan</h3>
            <div class="h-80"><canvas id="revenueTrendChart"></canvas></div>
        </div>
        <div class="lg:col-span-2 bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Distribusi Kategori Produk</h3>
            <div class="h-80 flex items-center justify-center"><canvas id="categoryDistributionChart"></canvas></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Perbandingan Pendapatan (Tahun Ini vs Tahun Lalu)</h3>
            <div class="h-80"><canvas id="revenueComparisonChart"></canvas></div>
        </div>
        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 shadow-md rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Produk Terlaris</h3>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-6 h-6 text-xs font-bold text-slate-600 bg-slate-100 dark:bg-slate-700 dark:text-slate-300 rounded-full mr-3">1</span>
                            <div><p class="text-sm font-medium text-slate-800 dark:text-slate-100">Baju Kemeja Pria</p><p class="text-xs text-slate-500 dark:text-slate-400">150 terjual</p></div>
                        </div>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Rp 7.500.000</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-6 h-6 text-xs font-bold text-slate-600 bg-slate-100 dark:bg-slate-700 dark:text-slate-300 rounded-full mr-3">2</span>
                            <div><p class="text-sm font-medium text-slate-800 dark:text-slate-100">Celana Jeans Wanita</p><p class="text-xs text-slate-500 dark:text-slate-400">120 terjual</p></div>
                        </div>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Rp 6.000.000</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-6 h-6 text-xs font-bold text-slate-600 bg-slate-100 dark:bg-slate-700 dark:text-slate-300 rounded-full mr-3">3</span>
                            <div><p class="text-sm font-medium text-slate-800 dark:text-slate-100">Sepatu Olahraga</p><p class="text-xs text-slate-500 dark:text-slate-400">100 terjual</p></div>
                        </div>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Rp 5.000.000</span>
                    </li>
                    <li class="text-sm text-slate-500"></li> </ul>
            </div>
            <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 shadow-md rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Pelanggan Terbaik</h3>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-6 h-6 text-xs font-bold text-slate-600 bg-slate-100 dark:bg-slate-700 dark:text-slate-300 rounded-full mr-3">1</span>
                            <div><p class="text-sm font-medium text-slate-800 dark:text-slate-100">Toko Jaya Abadi</p><p class="text-xs text-slate-500 dark:text-slate-400">25 pesanan</p></div>
                        </div>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Rp 100.000.000</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-6 h-6 text-xs font-bold text-slate-600 bg-slate-100 dark:bg-slate-700 dark:text-slate-300 rounded-full mr-3">2</span>
                            <div><p class="text-sm font-medium text-slate-800 dark:text-slate-100">Bumi Fashion</p><p class="text-xs text-slate-500 dark:text-slate-400">20 pesanan</p></div>
                        </div>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Rp 80.000.000</span>
                    </li>
                    <li class="text-sm text-slate-500"></li> </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const isDarkMode = document.documentElement.classList.contains('dark');
    const gridColor = isDarkMode ? '#334155' : '#e2e8f0';
    const textColor = isDarkMode ? '#94a3b8' : '#64748b';

    // Data statis untuk contoh grafik (Anda perlu mengganti ini dengan data aktual dari server)
    const staticRevenueTrendLabels = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"];
    const staticRevenueTrendData = [50000000, 60000000, 75000000, 70000000, 85000000, 90000000];

    const staticCategoryDistributionLabels = ["Elektronik", "Pakaian", "Makanan", "Buku", "Rumah Tangga"];
    const staticCategoryDistributionData = [30, 25, 20, 15, 10];

    const staticRevenueComparisonLabels = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"];
    const staticRevenueComparisonCurrent = [50000000, 60000000, 75000000, 70000000, 85000000, 90000000];
    const staticRevenueComparisonPrevious = [45000000, 55000000, 68000000, 62000000, 78000000, 82000000];


    // 1. Grafik Tren Pendapatan
    const revenueTrendCtx = document.getElementById('revenueTrendChart');
    if (revenueTrendCtx) {
        new Chart(revenueTrendCtx, {
            type: 'line',
            data: {
                labels: staticRevenueTrendLabels, // Menggunakan data statis
                datasets: [{
                    label: 'Pendapatan',
                    data: staticRevenueTrendData, // Menggunakan data statis
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor,
                            callback: (v) => 'Rp ' + (v/1000000) + ' Jt'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: textColor
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // 2. Grafik Distribusi Kategori
    const categoryDistCtx = document.getElementById('categoryDistributionChart');
    if (categoryDistCtx) {
        new Chart(categoryDistCtx, {
            type: 'pie',
            data: {
                labels: staticCategoryDistributionLabels, // Menggunakan data statis
                datasets: [{
                    label: 'Distribusi',
                    data: staticCategoryDistributionData, // Menggunakan data statis
                    backgroundColor: ['#4f46e5', '#16a34a', '#f97316', '#dc2626', '#9333ea', '#06b6d4', '#d97706'],
                    borderColor: isDarkMode ? '#1e293b' : '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: textColor
                        }
                    }
                }
            }
        });
    }
    
    // 3. Grafik Perbandingan Pendapatan
    const revenueCompCtx = document.getElementById('revenueComparisonChart');
    if (revenueCompCtx) {
        new Chart(revenueCompCtx, {
            type: 'bar',
            data: {
                labels: staticRevenueComparisonLabels, // Menggunakan data statis
                datasets: [
                    {
                        label: 'Tahun Ini',
                        data: staticRevenueComparisonCurrent, // Menggunakan data statis
                        backgroundColor: '#4f46e5',
                        borderRadius: 4
                    },
                    {
                        label: 'Tahun Lalu',
                        data: staticRevenueComparisonPrevious, // Menggunakan data statis
                        backgroundColor: isDarkMode ? '#475569' : '#e2e8f0',
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor,
                            callback: (v) => 'Rp ' + (v/1000000) + ' Jt'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: textColor
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: textColor
                        }
                    }
                }
            }
        });
    }
});
</script>