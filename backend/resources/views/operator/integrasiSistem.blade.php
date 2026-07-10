@extends('layouts.operator')
@section('content')
    <div x-data="integrasiPanel()" class="space-y-8 max-w-6xl mx-auto w-full">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Left Column: Service Status -->
                <div class="md:col-span-1 space-y-6">
                    <div class="glass-card p-8 rounded-[2.5rem] shadow-xl border border-slate-100 dark:border-slate-800">
                        <h3
                            class="font-lexend font-black text-sm text-slate-900 dark:text-white uppercase tracking-widest mb-6">
                            Status Koneksi</h3>

                        <div class="space-y-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-emerald-50 dark:bg-emerald-500/10 rounded-lg">
                                        <i data-lucide="globe" class="w-4 h-4 text-emerald-600"></i>
                                    </div>
                                    <span class="text-xs font-bold">Server Pusat</span>
                                </div>
                                <span class="flex items-center gap-2 text-[10px] font-black text-emerald-600 uppercase">
                                    <span class="status-dot bg-emerald-500 animate-pulse"></span> Terhubung
                                </span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-blue-50 dark:bg-blue-500/10 rounded-lg">
                                        <i data-lucide="message-square" class="w-4 h-4 text-blue-600"></i>
                                    </div>
                                    <span class="text-xs font-bold">WA Gateway</span>
                                </div>
                                <span class="flex items-center gap-2 text-[10px] font-black text-rose-500 uppercase">
                                    <span class="status-dot bg-rose-500"></span> Terputus
                                </span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-amber-50 dark:bg-amber-500/10 rounded-lg">
                                        <i data-lucide="database" class="w-4 h-4 text-amber-600"></i>
                                    </div>
                                    <span class="text-xs font-bold">Sinkron EMIS</span>
                                </div>
                                <span class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase">
                                    <span class="status-dot bg-slate-300"></span> Standby
                                </span>
                            </div>
                        </div>

                        <button
                            class="w-full mt-8 py-3 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-100 transition-all border border-slate-100 dark:border-slate-700">
                            Refresh Semua Status
                        </button>
                    </div>

                    <div
                        class="glass-card p-8 rounded-[2.5rem] shadow-xl border border-slate-100 dark:border-slate-800 bg-emerald-600 text-white">
                        <i data-lucide="zap" class="w-8 h-8 mb-4 opacity-50"></i>
                        <h4 class="font-lexend font-bold text-lg leading-tight">Sinkronisasi Terjadwal</h4>
                        <p class="text-xs text-emerald-100 mt-2 leading-relaxed">Sistem melakukan pencadangan dan
                            sinkronisasi otomatis setiap pukul 02:00 WIB.</p>
                        <button
                            class="mt-6 px-5 py-2.5 bg-white text-emerald-700 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg">Cek
                            Jadwal</button>
                    </div>
                </div>

                <!-- Right Column: Integration Settings -->
                <div class="md:col-span-2 space-y-8">
                    <!-- WhatsApp Gateway -->
                    <div
                        class="glass-card rounded-[2.5rem] shadow-xl overflow-hidden border border-slate-100 dark:border-slate-800">
                        <div class="p-8 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-[#25D366] text-white rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3
                                        class="font-lexend font-black text-slate-900 dark:text-white uppercase tracking-tight">
                                        WhatsApp Gateway</h3>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                        Pengiriman Notifikasi Otomatis</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div
                                    class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-emerald-500">
                                </div>
                            </label>
                        </div>

                        <div class="p-8 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">API
                                        Key / Token</label>
                                    <div class="relative">
                                        <input type="password" value="sk_live_51MzS2H8J2kLx9..."
                                            class="w-full pl-5 pr-12 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-mono focus:ring-4 focus:ring-emerald-500/10 outline-none">
                                        <button
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-500"><i
                                                data-lucide="eye" class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor
                                        Pengirim</label>
                                    <input type="text" value="6281234567890"
                                        class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none">
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-3 pt-2">
                                <button
                                    class="px-5 py-3 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-slate-800 transition-all">
                                    <i data-lucide="qr-code" class="w-4 h-4"></i> Scan QR Code
                                </button>
                                <button
                                    class="px-5 py-3 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all">
                                    Kirim Pesan Uji Coba
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Cloud Storage & Sync -->
                    <div
                        class="glass-card rounded-[2.5rem] shadow-xl overflow-hidden border border-slate-100 dark:border-slate-800">
                        <div class="p-8 border-b border-slate-50 dark:border-slate-800 flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-blue-500 text-white rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                                <i data-lucide="cloud" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="font-lexend font-black text-slate-900 dark:text-white uppercase tracking-tight">
                                    Sinkronisasi EMIS & Dapodik</h3>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Integrasi
                                    Data Pusat</p>
                            </div>
                        </div>

                        <div class="p-8 space-y-6">
                            <div
                                class="p-6 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border border-slate-100 dark:border-slate-800">
                                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 bg-white dark:bg-slate-800 rounded-2xl flex items-center justify-center border border-slate-100 dark:border-slate-700">
                                            <i data-lucide="refresh-cw" class="w-6 h-6 text-blue-500"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold">Sinkronisasi Terakhir</p>
                                            <p class="text-[10px] text-slate-400 font-medium">12 Februari 2026 — 23:45
                                                WIB</p>
                                        </div>
                                    </div>
                                    <button
                                        class="px-6 py-3 bg-blue-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-600/20 hover:-translate-y-1 transition-all">
                                        Mulai Sinkron Manual
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Username
                                        Portal EMIS</label>
                                    <input type="text" value="MI_NH3_BOGOR"
                                        class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-500/10 outline-none">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Password
                                        Portal</label>
                                    <input type="password" value="********"
                                        class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-500/10 outline-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="flex items-center justify-end gap-4 pb-10">
                <button
                    class="px-8 py-4 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-slate-200 dark:border-slate-800 hover:bg-slate-50 transition-all">Reset
                    Default</button>
                <button @click="saveConfig()" id="saveBtn"
                    class="px-10 py-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-emerald-600/30 hover:-translate-y-1 transition-all flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4"></i> Terapkan Konfigurasi
                </button>
            </div>

    </div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('integrasiPanel', () => ({
            saveConfig() {
                alert('Konfigurasi integrasi berhasil disimpan!');
            }
        }));
    });
</script>
@endpush
@endsection
