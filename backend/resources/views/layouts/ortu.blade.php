<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Panel - MI Nurul Huda 3</title>
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

    <div class="lg:hidden bg-white px-4 py-3 flex items-center justify-between shadow-sm sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                NH</div>
            <span class="font-bold text-emerald-800 text-sm">MI Nurul Huda 3</span>
        </div>
        <button class="p-2 bg-slate-100 rounded-xl">
            <i data-lucide="menu" class="w-6 h-6 text-emerald-600"></i>
        </button>
    </div>

    <div class="flex min-h-screen">
        <aside class="hidden lg:flex flex-col w-72 bg-white border-r border-slate-200 p-6 fixed h-full shadow-sm">
            <div class="flex items-center gap-3 mb-10 px-2">
                <div
                    class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-emerald-200">
                    NH</div>
                <div>
                    <h1 class="font-bold text-emerald-900 leading-tight">MI Nurul Huda 3</h1>
                    <p class="text-xs text-slate-400">Parent Information System</p>
                </div>
            </div>

            <nav class="flex-1 space-y-2">
                <a href="{{ route('ortu.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-600 rounded-2xl font-medium transition-all group">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
                </a>
                <a href="{{ route('ortu.nilai') }}"
                    class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-emerald-600 rounded-2xl transition-all">
                    <i data-lucide="graduation-cap" class="w-5 h-5"></i> Nilai Anak
                </a>
                <a href="{{ route('ortu.absensi') }}"
                    class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-emerald-600 rounded-2xl transition-all">
                    <i data-lucide="calendar-check" class="w-5 h-5"></i> Absensi
                </a>
                <a href="{{ route('ortu.jadwal') }}"
                    class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-emerald-600 rounded-2xl transition-all">
                    <i data-lucide="book-open" class="w-5 h-5"></i> Jadwal Pelajaran
                </a>
                <a href="{{ route('ortu.pembayaran') }}"
                    class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-emerald-600 rounded-2xl transition-all">
                    <i data-lucide="wallet" class="w-5 h-5"></i> Tagihan & Bayar
                </a>
                <a href="{{ route('ortu.catatan') }}"
                    class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-emerald-600 rounded-2xl transition-all">
                    <i data-lucide="message-square" class="w-5 h-5"></i> Catatan Guru
                </a>
                {{-- <a href="#"
                    class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-emerald-600 rounded-2xl transition-all">
                    <i data-lucide="file-text" class="w-5 h-5"></i> Rapor
                </a> --}}
                <a href="{{ route('ortu.setting') }}"
                    class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-emerald-600 rounded-2xl transition-all border-t mt-4 pt-6">
                    <i data-lucide="user" class="w-5 h-5"></i> Profil Anak
                </a>
            </nav>

            <button
                class="flex items-center gap-3 px-4 py-3 text-rose-500 hover:bg-rose-50 rounded-2xl transition-all mt-auto font-medium">
                <i data-lucide="log-out" class="w-5 h-5"></i> Keluar
            </button>
        </aside>
        @yield('content')
    </div>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script src="/js/shared/utils.js"></script>
    @stack('scripts')
</body>

</html>
