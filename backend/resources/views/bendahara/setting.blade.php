@extends('layouts.bendahara')

@section('content')
    <main class="lg:ml-64 min-h-screen p-4 md:p-8 transition-all duration-300">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold font-lexend text-slate-800 dark:text-white">Pengaturan Sistem</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Kelola biaya operasional dan konfigurasi akun
                    bendahara.</p>
            </div>
            <div class="flex items-center gap-3">
                <button id="darkModeToggle"
                    class="p-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm hover:bg-slate-50 transition-all">
                    <i id="moonIcon" data-lucide="moon" class="w-5 h-5 text-emerald-600"></i>
                </button>
                <button onclick="handleSaveSettings()" id="saveBtn"
                    class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-medium shadow-lg shadow-emerald-200 dark:shadow-none transition-all">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Perubahan
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @push('scripts')
                <script src="/js/bendahara/setting.js"></script>
            @endpush
            <div class="lg:col-span-2 space-y-6">
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h3 class="font-lexend font-semibold text-slate-800 dark:text-white flex items-center gap-2">
                            <i data-lucide="coins" class="w-5 h-5 text-emerald-500"></i>
                            Konfigurasi Biaya Sekolah
                        </h3>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-600 dark:text-slate-300">Nominal SPP Default
                                    (Bulanan)</label>
                                <div class="relative">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-medium">Rp</span>
                                    <input type="number" value="150000"
                                        class="w-full pl-12 pr-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-600 dark:text-slate-300">Nominal Daftar
                                    Ulang</label>
                                <div class="relative">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-medium">Rp</span>
                                    <input type="number" value="500000"
                                        class="w-full pl-12 pr-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h3 class="font-lexend font-semibold text-slate-800 dark:text-white flex items-center gap-2">
                            <i data-lucide="landmark" class="w-5 h-5 text-emerald-500"></i>
                            Informasi Rekening & Pembayaran
                        </h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-600 dark:text-slate-300">Nama Bank /
                                    E-Wallet</label>
                                <input type="text" value="Bank Syariah Indonesia (BSI)"
                                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-600 dark:text-slate-300">Nomor Rekening</label>
                                <input type="text" value="7123445566"
                                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-sm font-medium text-slate-600 dark:text-slate-300">Metode Pembayaran
                                Aktif</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <label
                                    class="flex items-center gap-3 p-3 border border-emerald-100 dark:border-emerald-900/30 bg-emerald-50/50 dark:bg-emerald-900/10 rounded-xl cursor-pointer">
                                    <input type="checkbox" checked
                                        class="w-4 h-4 text-emerald-600 rounded focus:ring-emerald-500">
                                    <span class="text-sm font-medium">Tunai</span>
                                </label>
                                <label
                                    class="flex items-center gap-3 p-3 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer">
                                    <input type="checkbox" checked
                                        class="w-4 h-4 text-emerald-600 rounded focus:ring-emerald-500">
                                    <span class="text-sm font-medium">Transfer</span>
                                </label>
                                <label
                                    class="flex items-center gap-3 p-3 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-emerald-600 rounded focus:ring-emerald-500">
                                    <span class="text-sm font-medium">QRIS</span>
                                </label>
                                <label
                                    class="flex items-center gap-3 p-3 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-emerald-600 rounded focus:ring-emerald-500">
                                    <span class="text-sm font-medium">Tabungan</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700 text-center">
                        <div class="relative w-24 h-24 mx-auto mb-4">
                            <img src="/assets/default-avatar.svg" alt="avatar"
                                class="rounded-full border-4 border-emerald-50 dark:border-slate-700">
                            <button
                                class="absolute bottom-0 right-0 p-1.5 bg-emerald-500 text-white rounded-full shadow-lg hover:bg-emerald-600 transition-all">
                                <i data-lucide="camera" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <h3 class="font-lexend font-bold text-slate-800 dark:text-white">Usth. Siti Aminah</h3>
                        <p
                            class="text-xs text-emerald-600 font-medium bg-emerald-50 dark:bg-emerald-900/30 px-3 py-1 rounded-full inline-block mt-1">
                            Bendahara Utama</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-slate-500 uppercase">Email</label>
                            <div
                                class="flex items-center gap-3 px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl">
                                <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                                <span class="text-sm">siti.aminah@nuhada.sch.id</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-slate-500 uppercase">Username</label>
                            <input type="text" value="siti_aminah3"
                                class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <hr class="border-slate-100 dark:border-slate-700 my-2">
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-slate-500 uppercase">Password Baru</label>
                            <input type="password" placeholder="••••••••"
                                class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500">
                            <p class="text-[10px] text-slate-400 italic">*Kosongkan jika tidak ingin mengubah password</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-emerald-600 rounded-2xl p-6 text-white shadow-lg shadow-emerald-200 dark:shadow-none relative overflow-hidden">
                    <i data-lucide="help-circle" class="absolute -right-4 -bottom-4 w-24 h-24 text-emerald-500/50"></i>
                    <h4 class="font-lexend font-bold mb-2 relative z-10">Butuh Bantuan?</h4>
                    <p class="text-emerald-100 text-xs mb-4 relative z-10 leading-relaxed">Jika Anda mengalami kendala pada
                        sistem keuangan, silakan hubungi tim IT Madrasah.</p>
                    <button
                        class="w-full py-2 bg-white/20 hover:bg-white/30 rounded-lg text-sm font-medium backdrop-blur-sm transition-all">
                        Buka Tiket Support
                    </button>
                </div>
            </div>
        </div>

        <div id="toast"
            class="fixed bottom-8 right-8 flex items-center gap-3 bg-slate-900 dark:bg-emerald-600 text-white px-6 py-4 rounded-2xl shadow-2xl translate-y-20 opacity-0 transition-all duration-500 z-[100]">
            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                <i data-lucide="check" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="font-bold text-sm">Berhasil!</p>
                <p id="toastMsg" class="text-xs text-slate-300 dark:text-emerald-100">Pengaturan telah diperbarui.</p>
            </div>
        </div>
    </main>

@endsection
