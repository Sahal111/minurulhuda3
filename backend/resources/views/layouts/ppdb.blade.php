<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB Dashboard - MI Nurul Huda 3</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-700">

    <div class="flex min-h-screen">
        <aside class="w-72 bg-emerald-900 text-white flex flex-col hidden lg:flex">
            <div class="p-6 flex items-center gap-3 border-b border-emerald-800">
                <div class="bg-white p-2 rounded-lg text-emerald-900 font-bold text-xl">NH</div>
                <div>
                    <h1 class="text-sm font-bold leading-none">MI Nurul Huda 3</h1>
                    <span class="text-[10px] text-emerald-300 uppercase tracking-widest">PPDB Admin</span>
                </div>
            </div>

            <nav class="flex-1 p-4 space-y-1 overflow-y-auto custom-scrollbar">
                <p class="px-4 py-2 text-[10px] font-semibold text-emerald-400 uppercase tracking-widest">Main Menu</p>
                <a href="{{ route('adminPpdb.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-700/50 rounded-xl text-white">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard PPDB
                </a>
                <a href="{{ route('adminPpdb.tambahPendaftar') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-emerald-800 rounded-xl transition-all">
                    <i data-lucide="user-plus" class="w-5 h-5"></i> Tambah Pendaftar
                </a>
                <a href="{{ route('adminPpdb.dataPendaftar') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-emerald-800 rounded-xl transition-all">
                    <i data-lucide="users" class="w-5 h-5"></i> Data Pendaftar
                </a>
                <a href="{{ route('adminPpdb.uploadImport') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-emerald-800 rounded-xl transition-all">
                    <i data-lucide="file-up" class="w-5 h-5"></i> Upload & Import
                </a>
                <a href="{{ route('adminPpdb.verifikasiBerkas') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-emerald-800 rounded-xl transition-all">
                    <i data-lucide="clipboard-check" class="w-5 h-5"></i> Verifikasi Berkas
                </a>
                <a href="{{ route('adminPpdb.seleksi') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-emerald-800 rounded-xl transition-all">
                    <i data-lucide="award" class="w-5 h-5"></i> Seleksi & Ranking
                </a>
                <a href="{{ route('adminPpdb.pembayaran') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-emerald-800 rounded-xl transition-all">
                    <i data-lucide="wallet" class="w-5 h-5"></i> Pembayaran PPDB
                </a>
                <a href="{{ route('adminPpdb.konversi') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-emerald-800 rounded-xl transition-all">
                    <i data-lucide="user-check" class="w-5 h-5"></i> Konversi Siswa
                </a>

                <p class="px-4 py-2 mt-4 text-[10px] font-semibold text-emerald-400 uppercase tracking-widest">Insights
                </p>
                <a href="{{ route('adminPpdb.stastistikLaporan') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-emerald-800 rounded-xl transition-all">
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i> Statistik & Laporan
                </a>
                <a href="{{ route('adminPpdb.setting') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-emerald-800 rounded-xl transition-all">
                    <i data-lucide="settings" class="w-5 h-5"></i> Pengaturan
                </a>
            </nav>

            <div class="p-4 border-t border-emerald-800">
                <button
                    class="flex items-center gap-3 px-4 py-3 w-full text-rose-300 hover:bg-rose-900/30 rounded-xl transition-all">
                    <i data-lucide="log-out" class="w-5 h-5"></i> Keluar Sistem
                </button>
            </div>
        </aside>

      @yield('content')
    </div>

    <script src="/js/shared/utils.js"></script>
    @stack('scripts')
</body>

</html>
