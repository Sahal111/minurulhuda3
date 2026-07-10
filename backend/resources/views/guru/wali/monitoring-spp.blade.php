@extends('layouts.guru')

@section('content')
    <main class="flex-1 p-6 lg:p-10 custom-scrollbar overflow-y-auto h-screen bg-[#f8fafc]">

        <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-8 mb-12">
            <div class="space-y-1">
                <div class="flex items-center gap-2 text-rose-600 font-bold text-[10px] uppercase tracking-[0.2em]">
                    <i data-lucide="wallet" class="w-4 h-4"></i>
                    Financial Oversight
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Monitoring Iuran & SPP</h2>
                <p class="text-slate-500 font-medium">Monitoring status administrasi Kelas 6A secara real-time.</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-2">
                    <span class="pl-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Update
                        Terakhir:</span>
                    <span class="pr-4 text-[10px] font-black text-emerald-600 uppercase">Hari Ini, 12:05</span>
                </div>
                <button
                    class="bg-slate-900 text-white px-6 py-3 rounded-xl font-black text-xs flex items-center gap-2 hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    UNDUH LAPORAN
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div
                class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-white group transition-all hover:scale-[1.02]">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-4">Total Lunas</p>
                <div class="flex items-end justify-between">
                    <h3 class="text-4xl font-black text-slate-900">28<span class="text-sm text-slate-300 ml-1">/32</span>
                    </h3>
                    <div
                        class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all">
                        <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                    </div>
                </div>
                <div class="mt-4 h-1.5 w-full bg-slate-50 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 w-[87%] rounded-full"></div>
                </div>
            </div>

            <div
                class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-white group transition-all hover:scale-[1.02]">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-4">Siswa Menunggak</p>
                <div class="flex items-end justify-between">
                    <h3 class="text-4xl font-black text-rose-600">04</h3>
                    <div
                        class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition-all">
                        <i data-lucide="alert-circle" class="w-6 h-6"></i>
                    </div>
                </div>
                <p class="mt-4 text-[10px] font-bold text-rose-400 uppercase tracking-tighter italic">Perlu tindak lanjut
                    wali kelas</p>
            </div>

            <div
                class="bg-slate-900 p-8 rounded-[2.5rem] shadow-2xl shadow-slate-300 border border-slate-800 transition-all hover:scale-[1.02]">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.15em] mb-4">Total Tunggakan</p>
                <h3 class="text-2xl font-black text-white leading-none mb-2">Rp 1.450.000</h3>
                <p class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest flex items-center gap-1">
                    <i data-lucide="trending-down" class="w-3 h-3"></i> Turun 15% bln lalu
                </p>
            </div>

            <div
                class="bg-amber-500 p-8 rounded-[2.5rem] shadow-xl shadow-amber-200 border border-amber-400 transition-all hover:scale-[1.02]">
                <p class="text-[10px] font-black text-amber-100 uppercase tracking-[0.15em] mb-4">Risiko Pembayaran</p>
                <div class="flex items-end justify-between text-white">
                    <h3 class="text-4xl font-black">02</h3>
                    <i data-lucide="shield-alert" class="w-10 h-10 opacity-30"></i>
                </div>
                <p class="mt-4 text-[10px] font-black text-amber-900 uppercase tracking-tighter">Tunggakan > 3 Bulan</p>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] shadow-xl shadow-slate-200/50 border border-white overflow-hidden">
            <div class="p-10 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Daftar Tunggakan Siswa</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase mt-1 tracking-widest">Data ini hanya terlihat oleh
                        Wali Kelas & Bendahara</p>
                </div>
                <div class="relative">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" placeholder="Cari nama siswa..."
                        class="pl-11 pr-6 py-3 bg-slate-50 border-none rounded-2xl text-xs font-bold w-full md:w-64 focus:ring-2 focus:ring-emerald-500 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Siswa
                            </th>
                            <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Total
                                Tunggakan</th>
                            <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Bulan
                                Belum Bayar</th>
                            <th
                                class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                Status</th>
                            <th
                                class="px-10 py-6 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="group hover:bg-rose-50/30 transition-all">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-4">
                                    <img src="https://ui-avatars.com/api/?name=Zaki+F&background=f43f5e&color=fff"
                                        class="w-10 h-10 rounded-xl" alt="">
                                    <div>
                                        <p class="text-sm font-black text-slate-800">M. Zaki Fauzan</p>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">NIS:
                                            22091102</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <p class="text-sm font-black text-rose-600 tracking-tight">Rp 450.000</p>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex flex-wrap gap-1">
                                    <span
                                        class="px-2 py-1 bg-slate-100 text-slate-500 text-[8px] font-black rounded uppercase">Des</span>
                                    <span
                                        class="px-2 py-1 bg-slate-100 text-slate-500 text-[8px] font-black rounded uppercase">Jan</span>
                                    <span
                                        class="px-2 py-1 bg-rose-100 text-rose-600 text-[8px] font-black rounded uppercase">Feb</span>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span
                                    class="px-3 py-1 bg-rose-50 text-rose-500 text-[9px] font-black rounded-lg border border-rose-100">RISIKO
                                    TINGGI</span>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <button
                                    class="bg-white border border-rose-200 text-rose-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all flex items-center gap-2 ml-auto shadow-sm">
                                    <i data-lucide="bell" class="w-3 h-3"></i> REMINDER WA
                                </button>
                            </td>
                        </tr>

                        <tr class="group hover:bg-amber-50/30 transition-all">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-4">
                                    <img src="https://ui-avatars.com/api/?name=Budi+S&background=f59e0b&color=fff"
                                        class="w-10 h-10 rounded-xl" alt="">
                                    <div>
                                        <p class="text-sm font-black text-slate-800">Budi Santoso</p>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">NIS:
                                            22091144</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <p class="text-sm font-black text-amber-600 tracking-tight">Rp 150.000</p>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex flex-wrap gap-1">
                                    <span
                                        class="px-2 py-1 bg-amber-100 text-amber-600 text-[8px] font-black rounded uppercase">Feb</span>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span
                                    class="px-3 py-1 bg-amber-50 text-amber-500 text-[9px] font-black rounded-lg border border-amber-100">TERLAMBAT</span>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <button
                                    class="bg-white border border-slate-200 text-slate-400 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all flex items-center gap-2 ml-auto shadow-sm">
                                    <i data-lucide="message-square" class="w-3 h-3"></i> HUBUNGI
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-8 bg-slate-50/50 border-t border-slate-100">
                <div class="flex items-center gap-2 text-slate-400">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-500"></i>
                    <p class="text-[10px] font-bold italic">Wali kelas diharapkan melakukan pendekatan persuasif sebelum
                        melakukan penagihan formal.</p>
                </div>
            </div>
        </div>

    </main>
@endsection
