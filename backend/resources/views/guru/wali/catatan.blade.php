@extends('layouts.guru')

@section('content')
    <main class="flex-1 p-6 lg:p-12 custom-scrollbar overflow-y-auto h-screen bg-[#f1f5f9]/50">

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 mb-16">
            <div class="relative">
                <div class="flex items-center gap-3 mb-3">
                    <span
                        class="px-3 py-1 bg-slate-900 text-white text-[9px] font-black rounded-full tracking-[0.2em] uppercase">Anecdotal
                        Record</span>
                    <span class="h-px w-10 bg-emerald-500"></span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Q1 Phase • 2026</span>
                </div>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight">Log Perkembangan <span
                        class="text-emerald-600">Siswa</span></h2>
                <p class="text-slate-500 font-medium mt-2 flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4 text-emerald-500"></i>
                    Klik pada kartu untuk melihat detail intervensi wali kelas.
                </p>
            </div>

            <div
                class="flex flex-col sm:flex-row items-center gap-4 bg-white/80 backdrop-blur-md p-3 rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-white">
                <div class="flex items-center gap-3 px-6 py-3 bg-slate-50 rounded-2xl border border-slate-100">
                    <i data-lucide="users" class="w-4 h-4 text-emerald-600"></i>
                    <select
                        class="bg-transparent border-none text-[11px] font-black text-slate-800 outline-none cursor-pointer min-w-[120px]">
                        <option>Semua Siswa (6A)</option>
                        <option>Ahmad Rafliansyah</option>
                        <option>Siti Zahra</option>
                    </select>
                </div>
                <button
                    class="w-full sm:w-auto bg-emerald-600 hover:bg-slate-900 text-white px-10 py-4 rounded-[1.5rem] font-black text-[11px] transition-all flex items-center justify-center gap-3 shadow-xl shadow-emerald-200 group">
                    <i data-lucide="plus" class="w-4 h-4 group-hover:rotate-90 transition-transform"></i>
                    BUAT JURNAL BARU
                </button>
            </div>
        </div>

        <div class="max-w-5xl mx-auto relative">

            <div
                class="absolute left-4 md:left-1/2 top-0 bottom-0 w-[2px] bg-gradient-to-b from-emerald-500 via-slate-200 to-transparent -translate-x-1/2 hidden md:block">
            </div>

            <div class="space-y-20">

                <div class="relative flex flex-col md:flex-row-reverse items-start justify-between group">
                    <div class="hidden md:block w-[45%]"></div>
                    <div
                        class="absolute left-4 md:left-1/2 -translate-x-1/2 w-12 h-12 rounded-2xl bg-white shadow-xl border border-slate-100 flex items-center justify-center z-10 transition-all duration-500 group-hover:rotate-[360deg] group-hover:bg-rose-500">
                        <i data-lucide="shield-alert" class="w-5 h-5 text-rose-500 group-hover:text-white"></i>
                    </div>

                    <div class="w-full md:w-[45%] pl-12 md:pl-0">
                        <div
                            class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-white relative overflow-hidden transition-all hover:translate-y-[-5px]">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Zaki+F&background=f43f5e&color=fff"
                                        class="w-10 h-10 rounded-xl" alt="">
                                    <div>
                                        <h4 class="text-sm font-black text-slate-900">M. Zaki Fauzan</h4>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">18
                                            Februari 2026 • 09:15 AM</p>
                                    </div>
                                </div>
                                <span
                                    class="px-3 py-1 bg-rose-50 text-rose-600 text-[8px] font-black rounded-full border border-rose-100 uppercase tracking-widest">Behavioral</span>
                            </div>

                            <div class="bg-slate-50 rounded-2xl p-5 mb-6">
                                <h5 class="text-[10px] font-black text-slate-400 uppercase mb-2 tracking-widest">Isi
                                    Catatan:</h5>
                                <p class="text-xs text-slate-600 leading-relaxed font-medium italic">
                                    "Siswa menunjukkan sikap kurang kooperatif saat diskusi kelompok di kelas IPA.
                                    Dibutuhkan pendekatan personal untuk memacu motivasi belajarnya kembali."
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                <div class="flex -space-x-2">
                                    <div class="w-6 h-6 rounded-full bg-slate-900 text-white text-[8px] font-black flex items-center justify-center border-2 border-white"
                                        title="Wali Kelas">WK</div>
                                    <div class="w-6 h-6 rounded-full bg-blue-500 text-white text-[8px] font-black flex items-center justify-center border-2 border-white"
                                        title="Guru BK">BK</div>
                                </div>
                                <button
                                    class="text-[10px] font-black text-emerald-600 hover:text-slate-900 transition-colors uppercase tracking-widest">Follow
                                    Up <i data-lucide="arrow-right" class="inline w-3 h-3"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative flex flex-col md:flex-row items-start justify-between group">
                    <div class="hidden md:block w-[45%]"></div>
                    <div
                        class="absolute left-4 md:left-1/2 -translate-x-1/2 w-12 h-12 rounded-2xl bg-white shadow-xl border border-slate-100 flex items-center justify-center z-10 transition-all duration-500 group-hover:scale-125 group-hover:bg-emerald-500">
                        <i data-lucide="award" class="w-5 h-5 text-emerald-500 group-hover:text-white"></i>
                    </div>

                    <div class="w-full md:w-[45%] pl-12 md:pl-0">
                        <div
                            class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-white relative overflow-hidden transition-all hover:translate-y-[-5px]">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Siti+Z&background=10b981&color=fff"
                                        class="w-10 h-10 rounded-xl" alt="">
                                    <div>
                                        <h4 class="text-sm font-black text-slate-900">Siti Zahra Al-Munawaroh</h4>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">15
                                            Februari 2026 • 02:00 PM</p>
                                    </div>
                                </div>
                                <span
                                    class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[8px] font-black rounded-full border border-emerald-100 uppercase tracking-widest">Achievement</span>
                            </div>

                            <div class="bg-emerald-50/50 rounded-2xl p-5 mb-6 border border-emerald-100/50">
                                <h5 class="text-[10px] font-black text-emerald-600 uppercase mb-2 tracking-widest">Capaian
                                    Luar Biasa:</h5>
                                <p class="text-xs text-slate-700 leading-relaxed font-bold">
                                    "Lulus setoran Juz 30 dengan tajwid sempurna. Menunjukkan dedikasi tinggi dalam program
                                    Tahfidz MI Nurul Huda 3."
                                </p>
                            </div>

                            <div class="flex items-center gap-4">
                                <div
                                    class="px-4 py-2 bg-slate-900 text-white rounded-xl text-[9px] font-black uppercase tracking-widest">
                                    Sertifikat Terbit</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative flex flex-col md:flex-row-reverse items-start justify-between group">
                    <div class="hidden md:block w-[45%]"></div>

                    <div
                        class="absolute left-4 md:left-1/2 -translate-x-1/2 w-12 h-12 rounded-2xl bg-white shadow-xl border border-slate-100 flex items-center justify-center z-10 group-hover:bg-indigo-600 transition-all">
                        <i data-lucide="message-square" class="w-5 h-5 text-indigo-600 group-hover:text-white"></i>
                    </div>

                    <div class="w-full md:w-[45%] pl-12 md:pl-0">
                        <div
                            class="bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl shadow-slate-300 border border-slate-800 text-white relative overflow-hidden transition-all hover:translate-y-[-5px]">
                            <div class="flex items-center justify-between mb-6 relative z-10">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-indigo-500/20 flex items-center justify-center text-indigo-400 font-black">
                                        BS</div>
                                    <div>
                                        <h4 class="text-sm font-black text-white">Budi Santoso</h4>
                                        <p class="text-[9px] font-bold text-slate-500 uppercase tracking-tighter">12
                                            Februari 2026 • Home Visit</p>
                                    </div>
                                </div>
                                <span
                                    class="px-3 py-1 bg-white/10 text-white text-[8px] font-black rounded-full border border-white/20 uppercase tracking-widest text-[8px]">Parental</span>
                            </div>

                            <p class="text-xs text-slate-400 leading-relaxed font-medium italic relative z-10 mb-6">
                                "Diskusi dengan orang tua mengenai manajemen waktu belajar di rumah. Orang tua sangat
                                suportif terhadap program kelas tambahan."
                            </p>

                            <div class="flex items-center gap-2 relative z-10">
                                <span class="w-2 h-2 bg-indigo-500 rounded-full animate-ping"></span>
                                <span class="text-[9px] font-black text-indigo-400 uppercase tracking-widest">On-going
                                    Monitoring</span>
                            </div>

                            <i data-lucide="home" class="absolute -right-6 -bottom-6 w-32 h-32 text-white/5 -rotate-12"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-24 text-center">
                <button
                    class="group relative px-12 py-5 bg-white border border-slate-200 rounded-[2rem] overflow-hidden transition-all hover:border-emerald-500 shadow-xl shadow-slate-200/50">
                    <span
                        class="relative z-10 text-[11px] font-black text-slate-900 uppercase tracking-widest group-hover:text-emerald-600 transition-colors">Lihat
                        Arsip Tahun Lalu</span>
                    <div
                        class="absolute inset-0 bg-emerald-50 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                    </div>
                </button>
            </div>
        </div>

    </main>
@endsection
