@extends('layouts.ortu')

@section('content')
    <main class="flex-1 lg:ml-72 p-4 lg:p-10">

        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Monitoring Absensi</h2>
                <p class="text-slate-500">Laporan kehadiran <b>Ahmad Fathoni</b> di sekolah</p>
            </div>

            <div class="flex items-center gap-3">
                <select
                    class="bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl px-4 py-2.5 shadow-sm focus:ring-emerald-500 focus:border-emerald-500 outline-none cursor-pointer">
                    <option value="2">Februari 2026</option>
                    <option value="1">Januari 2026</option>
                    <option value="12">Desember 2025</option>
                </select>
            </div>
        </header>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="user-check" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Hadir</span>
                </div>
                <div class="flex items-baseline gap-1">
                    <span class="text-3xl font-bold text-slate-800">18</span>
                    <span class="text-sm text-slate-400 font-medium">Hari</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-8 h-8 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Izin/Sakit</span>
                </div>
                <div class="flex items-baseline gap-1">
                    <span class="text-3xl font-bold text-slate-800">02</span>
                    <span class="text-sm text-slate-400 font-medium">Hari</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-8 h-8 bg-rose-100 text-rose-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="user-x" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Alfa</span>
                </div>
                <div class="flex items-baseline gap-1">
                    <span class="text-3xl font-bold text-slate-800">00</span>
                    <span class="text-sm text-slate-400 font-medium">Hari</span>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50 bg-gradient-to-br from-emerald-600 to-emerald-700">
                <div class="flex items-center gap-3 mb-3 text-emerald-100">
                    <i data-lucide="pie-chart" class="w-5 h-5"></i>
                    <span class="text-[10px] font-bold uppercase tracking-wider">Persentase</span>
                </div>
                <div class="flex items-baseline gap-1">
                    <span class="text-3xl font-bold text-white">96.4%</span>
                </div>
                <div class="w-full bg-emerald-800/50 h-1.5 rounded-full mt-3 overflow-hidden">
                    <div class="bg-white h-full" style="width: 96%"></div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                <h3 class="font-bold text-slate-800 tracking-tight">Riwayat Absensi Bulanan</h3>
                <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase">
                    <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Hadir</span>
                    <span class="flex items-center gap-1 ml-2"><span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        Izin</span>
                    <span class="flex items-center gap-1 ml-2"><span class="w-2 h-2 rounded-full bg-rose-500"></span>
                        Alfa</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-400 text-[11px] uppercase tracking-widest font-bold">
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4">Keterangan / Alasan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-700">Kamis, 12 Feb 2026</p>
                                <p class="text-[10px] text-slate-400 uppercase font-medium">Jam Masuk: 06:55 WIB</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">Hadir</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 italic">Tepat waktu</td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-700">Rabu, 11 Feb 2026</p>
                                <p class="text-[10px] text-slate-400 uppercase font-medium">Jam Masuk: -</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">Izin</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                Sakit (Surat Dokter Terlampir)
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 border-l-4 border-rose-500">
                                <p class="font-bold text-slate-700">Selasa, 10 Feb 2026</p>
                                <p class="text-[10px] text-slate-400 uppercase font-medium">Jam Masuk: -</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-rose-100 text-rose-700 text-xs font-bold rounded-full">Alfa</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-rose-500 font-medium italic">
                                Tanpa keterangan
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-700">Senin, 09 Feb 2026</p>
                                <p class="text-[10px] text-slate-400 uppercase font-medium">Jam Masuk: 07:05 WIB</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">Hadir</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 italic">Terlambat 5 menit</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div
                class="p-6 bg-slate-50/50 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-slate-400 font-medium">Menampilkan data absensi 1 bulan terakhir</p>
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 text-xs font-bold bg-white border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-50 shadow-sm">Sebelumnya</button>
                    <button
                        class="px-4 py-2 text-xs font-bold bg-white border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-50 shadow-sm">Berikutnya</button>
                </div>
            </div>
        </div>
    </main>
@endsection
