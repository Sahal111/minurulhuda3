@extends('layouts.bendahara')
@section('content')
    <!-- Main Content -->
    <main class="lg:ml-64 min-h-screen sidebar-transition">

        <!-- Header -->
        <header
            class="sticky top-0 z-30 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button id="toggleSidebar"
                        class="lg:hidden p-2 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                    <div>
                        <h1 class="text-xl font-lexend font-bold text-slate-800 dark:text-white">Dashboard Bendahara
                        </h1>
                        <p class="text-xs text-slate-500">Selamat datang kembali, periksa ringkasan keuangan hari ini.
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button id="darkModeToggle"
                        class="p-2.5 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <i data-lucide="moon" id="moonIcon" class="w-5 h-5"></i>
                    </button>
                    <div class="relative group">
                        <button class="p-2.5 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                            <i data-lucide="bell" class="w-5 h-5"></i>
                            <span
                                class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                        </button>
                    </div>
                    <div class="h-8 w-px bg-slate-200 mx-2 hidden sm:block"></div>
                    <div class="hidden sm:flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-xs font-bold leading-none">Bendahara Utama</p>
                            <p class="text-[10px] text-emerald-600 font-medium mt-0.5 uppercase tracking-tighter">
                                Finance Dept</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="p-6 space-y-8">

            <!-- System Alert -->
            <div class="flex flex-col sm:flex-row items-center gap-4 p-4 bg-orange-50 border border-orange-100 rounded-2xl">
                <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 shrink-0">
                    <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <h4 class="text-sm font-bold text-orange-800">Perhatian: Tunggakan Belum Diverifikasi</h4>
                    <p class="text-xs text-orange-700">Terdapat 15 riwayat pembayaran SPP yang memerlukan validasi
                        manual.</p>
                </div>
                <button
                    class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold rounded-xl shadow-md transition-all">Verifikasi
                    Sekarang</button>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-emerald-500/5 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                            <i data-lucide="trending-up" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 px-2 py-1 bg-emerald-50 rounded-full">+12%
                            vs bln lalu</span>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Pemasukan Bulan Ini</h3>
                    <p class="text-2xl font-lexend font-bold mt-1">Rp 45.250.000</p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-red-500/5 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-red-50 dark:bg-red-900/30 rounded-xl flex items-center justify-center text-red-600 group-hover:scale-110 transition-transform">
                            <i data-lucide="trending-down" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-bold text-red-600 px-2 py-1 bg-red-50 rounded-full">-5% vs bln
                            lalu</span>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Pengeluaran Bulan Ini</h3>
                    <p class="text-2xl font-lexend font-bold mt-1">Rp 12.840.000</p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-blue-500/5 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                            <i data-lucide="wallet" class="w-6 h-6"></i>
                        </div>
                        <i data-lucide="info" class="w-4 h-4 text-slate-300"></i>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Saldo Kas (Current Balance)</h3>
                    <p class="text-2xl font-lexend font-bold mt-1">Rp 32.410.000</p>
                </div>

                <!-- Card 4 -->
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-emerald-500/5 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                            <i data-lucide="user-check" class="w-6 h-6"></i>
                        </div>
                        <div class="flex items-center gap-1 text-emerald-600">
                            <span class="text-xs font-bold">85%</span>
                            <div class="w-12 h-1.5 bg-emerald-100 rounded-full overflow-hidden">
                                <div class="bg-emerald-500 h-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Siswa Lunas SPP</h3>
                    <p class="text-2xl font-lexend font-bold mt-1">384 Siswa</p>
                </div>

                <!-- Card 5 -->
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-orange-500/5 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-orange-50 dark:bg-orange-900/30 rounded-xl flex items-center justify-center text-orange-600 group-hover:scale-110 transition-transform">
                            <i data-lucide="user-x" class="w-6 h-6"></i>
                        </div>
                        <button class="text-[10px] font-bold text-orange-600 hover:underline">Lihat Detail</button>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Siswa Menunggak</h3>
                    <p class="text-2xl font-lexend font-bold mt-1">66 Siswa</p>
                </div>

                <!-- Card 6 -->
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-indigo-500/5 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                            <i data-lucide="zap" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-bold text-indigo-600">LIVE</span>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Total Transaksi Hari Ini</h3>
                    <p class="text-2xl font-lexend font-bold mt-1">24 Transaksi</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Bar Chart -->
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-lexend font-bold text-slate-800 dark:text-white">Arus Kas Bulanan</h3>
                        <select
                            class="text-xs border-none bg-slate-50 dark:bg-slate-700 px-3 py-1.5 rounded-lg focus:ring-0">
                            <option>Tahun 2023/2024</option>
                            <option>Tahun 2022/2023</option>
                        </select>
                    </div>
                    <div class="h-[300px]">
                        <canvas id="mainChart"></canvas>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-lexend font-bold text-slate-800 dark:text-white">Sumber Pendapatan</h3>
                        <button class="text-emerald-600 hover:bg-emerald-50 p-2 rounded-lg transition-colors">
                            <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <div class="h-[300px] flex items-center justify-center">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div
                class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                <div
                    class="p-6 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h3 class="font-lexend font-bold text-slate-800 dark:text-white">Transaksi Terbaru</h3>
                        <p class="text-xs text-slate-500">Menampilkan 5 transaksi terakhir hari ini.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="showToast('Data disinkronkan!')"
                            class="p-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 transition-all">
                            <i data-lucide="refresh-cw" class="w-4 h-4 text-slate-600"></i>
                        </button>
                        <button onclick="openModal()"
                            class="flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl shadow-md transition-all">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span class="text-sm font-bold">Input Transaksi</span>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 dark:bg-slate-900/50">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Transaksi</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal
                                </th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nominal
                                </th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status
                                </th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                                            <i data-lucide="download" class="w-4 h-4"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold">SPP Februari - Ahmad Zaki</p>
                                            <p class="text-[10px] text-slate-400">ID: TRX-99212</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs px-2 py-1 bg-blue-50 text-blue-600 rounded-md font-medium">Siswa
                                        (SPP)</span>
                                </td>
                                <td class="px-6 py-4 text-xs">Hari ini, 09:30</td>
                                <td class="px-6 py-4 font-bold text-sm text-emerald-600">Rp 250.000</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-bold uppercase tracking-wider italic">
                                        <i data-lucide="check-circle-2" class="w-3 h-3"></i> Berhasil
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="p-2 hover:bg-slate-100 rounded-lg"><i data-lucide="more-vertical"
                                            class="w-4 h-4"></i></button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center text-red-600">
                                            <i data-lucide="upload" class="w-4 h-4"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold">Listrik & Internet Feb</p>
                                            <p class="text-[10px] text-slate-400">ID: TRX-99211</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-xs px-2 py-1 bg-orange-50 text-orange-600 rounded-md font-medium">Operasional</span>
                                </td>
                                <td class="px-6 py-4 text-xs">Hari ini, 08:15</td>
                                <td class="px-6 py-4 font-bold text-sm text-red-600">Rp 1.250.000</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-bold uppercase tracking-wider italic">
                                        <i data-lucide="check-circle-2" class="w-3 h-3"></i> Berhasil
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="p-2 hover:bg-slate-100 rounded-lg"><i data-lucide="more-vertical"
                                            class="w-4 h-4"></i></button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                                            <i data-lucide="download" class="w-4 h-4"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold">Donasi Pembangunan</p>
                                            <p class="text-[10px] text-slate-400">ID: TRX-99210</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-xs px-2 py-1 bg-purple-50 text-purple-600 rounded-md font-medium">Lain-lain</span>
                                </td>
                                <td class="px-6 py-4 text-xs">Kemarin, 16:45</td>
                                <td class="px-6 py-4 font-bold text-sm text-emerald-600">Rp 5.000.000</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 bg-orange-100 text-orange-700 rounded-full text-[10px] font-bold uppercase tracking-wider italic">
                                        <i data-lucide="clock" class="w-3 h-3"></i> Pending
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="p-2 hover:bg-slate-100 rounded-lg"><i data-lucide="more-vertical"
                                            class="w-4 h-4"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 text-center">
                    <button class="text-xs font-bold text-emerald-600 hover:text-emerald-700">Lihat Semua Riwayat
                        Transaksi</button>
                </div>
            </div>

            <!-- Footer -->
            <footer class="pt-8 pb-4 text-center">
                <p class="text-xs text-slate-400 uppercase tracking-widest font-medium">© 2026 MI Nurul Huda 3 — Sistem
                    ERP Manajemen Terintegrasi</p>
            </footer>
        </div>
    </main>

    <!-- Modal Input -->
    <div id="modalOverlay"
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div
            class="bg-white dark:bg-slate-800 w-full max-w-lg mx-4 rounded-2xl shadow-2xl transform scale-95 transition-transform duration-300">
            <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <h3 class="font-lexend font-bold text-lg">Input Transaksi Baru</h3>
                <button onclick="closeModal()" class="p-2 hover:bg-slate-100 rounded-full"><i data-lucide="x"
                        class="w-5 h-5"></i></button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Kategori</label>
                    <select
                        class="w-full bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all">
                        <option>Pemasukan (SPP)</option>
                        <option>Pemasukan (Donasi)</option>
                        <option>Pengeluaran (Operasional)</option>
                        <option>Pengeluaran (Gaji Guru)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Keterangan</label>
                    <input type="text" placeholder="Contoh: Bayar Listrik Bulan Maret"
                        class="w-full bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Nominal (Rp)</label>
                        <input type="number" placeholder="0"
                            class="w-full bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-3 text-sm font-bold text-emerald-600 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Tanggal</label>
                        <input type="date"
                            class="w-full bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all">
                    </div>
                </div>
                <div class="p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl flex items-start gap-3">
                    <i data-lucide="info" class="w-4 h-4 text-emerald-600 mt-0.5"></i>
                    <p class="text-[10px] text-emerald-700 leading-relaxed">Pastikan data yang Anda masukkan sudah
                        sesuai dengan bukti kuitansi fisik/digital. Transaksi yang disimpan akan langsung tercatat di
                        jurnal keuangan.</p>
                </div>
            </div>
            <div class="p-6 border-t border-slate-100 dark:border-slate-700 flex gap-3">
                <button onclick="closeModal()"
                    class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold rounded-xl transition-all">Batal</button>
                <button onclick="handleSave()" id="saveBtn"
                    class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-emerald-600/20 transition-all flex items-center justify-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Transaksi
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast"
        class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[100] transform translate-y-20 opacity-0 transition-all duration-500">
        <div class="bg-slate-900 text-white px-6 py-3 rounded-2xl shadow-2xl flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400"></i>
            <span id="toastMsg" class="text-sm font-medium">Berhasil disimpan!</span>
        </div>
    </div>
@endsection
