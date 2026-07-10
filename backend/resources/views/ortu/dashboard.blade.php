@extends('layouts.ortu')
@section('content')
    <main class="flex-1 lg:ml-72 p-4 lg:p-10">

        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Assalamu'alaikum, Ibu Fatimah</h2>
                <p class="text-slate-500">Memantau perkembangan belajar <b>Ahmad Fathoni</b></p>
            </div>
            <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                    <i data-lucide="smile" class="text-emerald-600 w-6 h-6"></i>
                </div>
                <div class="pr-4">
                    <p class="text-[10px] uppercase font-bold text-slate-400 leading-none">Anak</p>
                    <p class="text-sm font-bold text-slate-700">Kelas 4-A (Ganjil)</p>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-rose-100 border border-rose-200 p-4 rounded-2xl flex items-start gap-4 shadow-sm">
                <div class="bg-rose-500 p-2 rounded-xl text-white">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="font-bold text-rose-800 text-sm">SPP Belum Lunas</h4>
                    <p class="text-rose-700 text-xs mt-1">Tagihan Februari Rp250.000,- segera selesaikan.</p>
                </div>
            </div>
            <div class="bg-blue-100 border border-blue-200 p-4 rounded-2xl flex items-start gap-4 shadow-sm">
                <div class="bg-blue-500 p-2 rounded-xl text-white">
                    <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="font-bold text-blue-800 text-sm">Tugas Belum Selesai</h4>
                    <p class="text-blue-700 text-xs mt-1">Matematika: "Pecahan Campuran" dikumpul besok.</p>
                </div>
            </div>
            <div class="bg-amber-100 border border-amber-200 p-4 rounded-2xl flex items-start gap-4 shadow-sm">
                <div class="bg-amber-500 p-2 rounded-xl text-white">
                    <i data-lucide="user-x" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="font-bold text-amber-800 text-sm">Kehadiran</h4>
                    <p class="text-amber-700 text-xs mt-1">Ahmad tidak hadir 2 hari minggu ini (Sakit).</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-10">
            <div
                class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="award" class="text-emerald-600 w-6 h-6"></i>
                </div>
                <span class="text-3xl font-bold text-slate-800">88.5</span>
                <p class="text-xs font-medium text-slate-400 uppercase mt-1">Rata-rata Nilai</p>
            </div>
            <div
                class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="calendar" class="text-emerald-600 w-6 h-6"></i>
                </div>
                <span class="text-3xl font-bold text-slate-800">94%</span>
                <p class="text-xs font-medium text-slate-400 uppercase mt-1">Kehadiran</p>
            </div>
            <div
                class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="check-circle" class="text-emerald-600 w-6 h-6"></i>
                </div>
                <span class="text-sm font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full uppercase">Lunas</span>
                <p class="text-xs font-medium text-slate-400 uppercase mt-4">Status SPP</p>
            </div>
            <div
                class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="message-circle" class="text-emerald-600 w-6 h-6"></i>
                </div>
                <span class="text-3xl font-bold text-slate-800">3</span>
                <p class="text-xs font-medium text-slate-400 uppercase mt-1">Catatan Baru</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <i data-lucide="trending-up" class="w-5 h-5 text-emerald-600"></i> Tren Nilai Anak
                    </h3>
                    <select class="text-xs bg-slate-50 border-none rounded-lg focus:ring-emerald-500">
                        <option>3 Bulan Terakhir</option>
                    </select>
                </div>
                <div class="h-48 w-full bg-emerald-50/50 rounded-xl flex items-end justify-between px-4 pb-2 pt-10 gap-2">
                    <div class="w-full bg-emerald-200 rounded-t-lg transition-all hover:bg-emerald-400"
                        style="height: 70%;"></div>
                    <div class="w-full bg-emerald-300 rounded-t-lg transition-all hover:bg-emerald-400"
                        style="height: 85%;"></div>
                    <div class="w-full bg-emerald-400 rounded-t-lg transition-all hover:bg-emerald-400"
                        style="height: 60%;"></div>
                    <div class="w-full bg-emerald-500 rounded-t-lg transition-all hover:bg-emerald-400"
                        style="height: 90%;"></div>
                    <div class="w-full bg-emerald-600 rounded-t-lg transition-all hover:bg-emerald-400"
                        style="height: 95%;"></div>
                </div>
                <div class="flex justify-between mt-3 px-2 text-[10px] font-bold text-slate-400 uppercase">
                    <span>Sep</span><span>Okt</span><span>Nov</span><span>Des</span><span>Jan</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50">
                <h3 class="font-bold text-slate-800 flex items-center gap-2 mb-6">
                    <i data-lucide="calendar" class="w-5 h-5 text-emerald-600"></i> Absensi Bulan Ini
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span
                                class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">18</span>
                            <div>
                                <p class="text-sm font-bold text-slate-700 leading-none">Hadir Tepat Waktu</p>
                                <p class="text-[10px] text-slate-400 mt-1">Persentase: 90%</p>
                            </div>
                        </div>
                        <div class="w-24 bg-slate-200 h-2 rounded-full overflow-hidden">
                            <div class="bg-emerald-500 h-full" style="width: 90%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span
                                class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-xs">02</span>
                            <div>
                                <p class="text-sm font-bold text-slate-700 leading-none">Izin/Sakit</p>
                                <p class="text-[10px] text-slate-400 mt-1">Persentase: 8%</p>
                            </div>
                        </div>
                        <div class="w-24 bg-slate-200 h-2 rounded-full overflow-hidden">
                            <div class="bg-amber-500 h-full" style="width: 8%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span
                                class="w-8 h-8 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center font-bold text-xs">00</span>
                            <div>
                                <p class="text-sm font-bold text-slate-700 leading-none">Tanpa Keterangan</p>
                                <p class="text-[10px] text-slate-400 mt-1">Persentase: 0%</p>
                            </div>
                        </div>
                        <div class="w-24 bg-slate-200 h-2 rounded-full overflow-hidden">
                            <div class="bg-rose-500 h-full" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
