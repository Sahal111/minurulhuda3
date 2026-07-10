@extends('layouts.ortu')

@section('content')
    <main class="flex-1 lg:ml-72 p-4 lg:p-10 bg-[#F8FAFC]" x-data="{ activeTab: 'semua' }">

        <div class="max-w-5xl mx-auto mb-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <nav class="flex items-center gap-2 text-xs font-bold text-emerald-600 uppercase tracking-[0.2em] mb-3">
                        <i data-lucide="layers" class="w-3 h-3"></i>
                        <span>Monitoring Siswa</span>
                    </nav>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight">Jurnal Perkembangan</h2>
                    <p class="text-slate-500 mt-2 text-lg font-medium">Laporan interaksi dan evaluasi guru terhadap Ananda.
                    </p>
                </div>

                <div class="flex bg-white/80 backdrop-blur-md p-1.5 rounded-2xl shadow-sm border border-slate-200 w-fit">
                    @foreach (['semua', 'prestasi', 'evaluasi'] as $tab)
                        <button @click="activeTab = '{{ $tab }}'"
                            :class="activeTab === '{{ $tab }}' ? 'bg-slate-900 text-white shadow-lg' :
                                'text-slate-500 hover:bg-slate-50'"
                            class="px-5 py-2 rounded-xl text-sm font-bold capitalize transition-all duration-300">
                            {{ $tab }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto relative">
            <div
                class="absolute left-8 md:left-1/2 top-0 bottom-0 w-[2px] bg-gradient-to-b from-emerald-500 via-slate-200 to-transparent -translate-x-1/2 hidden md:block">
            </div>

            <div class="space-y-16">
                <div class="relative flex flex-col md:flex-row items-center group"
                    x-show="activeTab === 'semua' || activeTab === 'prestasi'">
                    <div class="hidden md:block flex-1 pr-16 text-right">
                        <span
                            class="inline-block px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                            Achievement
                        </span>
                        <h3 class="mt-2 text-2xl font-black text-slate-800 tracking-tight">Capaian Akademik</h3>
                        <p class="text-sm font-bold text-slate-400">Rabu, 18 Februari 2026</p>
                    </div>

                    <div
                        class="absolute left-8 md:left-1/2 w-5 h-5 bg-white border-4 border-emerald-500 rounded-full -translate-x-1/2 z-10 shadow-[0_0_20px_rgba(16,185,129,0.5)] group-hover:scale-150 transition-transform duration-500">
                    </div>

                    <div class="flex-1 pl-16 md:pl-16 w-full">
                        <div
                            class="bg-white p-8 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-slate-100 relative overflow-hidden transition-all duration-500 hover:shadow-emerald-100/50 hover:-translate-y-2">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full -mr-16 -mt-16 opacity-50">
                            </div>

                            <div class="relative">
                                <div class="flex items-center gap-4 mb-6">
                                    <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=10b981&color=fff"
                                        class="w-12 h-12 rounded-2xl shadow-sm" />
                                    <div>
                                        <p class="font-black text-slate-800">Ibu Siti Aminah</p>
                                        <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-tighter">Wali
                                            Kelas 4A</p>
                                    </div>
                                </div>
                                <p class="text-slate-600 text-lg leading-relaxed font-medium italic">
                                    "Ananda menunjukkan penguasaan materi literasi yang sangat matang. Analisis ceritanya
                                    tajam dan berani berpendapat di depan kelas."
                                </p>
                                <div class="mt-8 flex items-center justify-between">
                                    <div class="flex -space-x-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 border-2 border-white">
                                            <i data-lucide="star" class="w-4 h-4 fill-current"></i></div>
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 border-2 border-white">
                                            <i data-lucide="thumbs-up" class="w-4 h-4 fill-current"></i></div>
                                    </div>
                                    <button
                                        class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400 hover:text-emerald-600 transition-colors">
                                        Berikan Apresiasi <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative flex flex-col md:flex-row items-center group"
                    x-show="activeTab === 'semua' || activeTab === 'evaluasi'">
                    <div class="hidden md:block flex-1 order-2 pl-16">
                        <span
                            class="inline-block px-4 py-1.5 bg-rose-50 text-rose-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-rose-100">
                            Discipline
                        </span>
                        <h3 class="mt-2 text-2xl font-black text-slate-800 tracking-tight">Catatan Kedisiplinan</h3>
                        <p class="text-sm font-bold text-slate-400">Senin, 16 Februari 2026</p>
                    </div>

                    <div
                        class="absolute left-8 md:left-1/2 w-5 h-5 bg-white border-4 border-rose-500 rounded-full -translate-x-1/2 z-10 shadow-[0_0_20px_rgba(244,63,94,0.5)] group-hover:scale-150 transition-transform duration-500">
                    </div>

                    <div class="flex-1 pr-0 md:pr-16 w-full md:text-right">
                        <div
                            class="bg-white p-8 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-slate-100 relative overflow-hidden transition-all duration-500 hover:shadow-rose-100/50 hover:-translate-y-2">
                            <div class="absolute top-0 left-0 w-32 h-32 bg-rose-50 rounded-full -ml-16 -mt-16 opacity-50">
                            </div>

                            <div class="relative">
                                <div class="flex items-center md:flex-row-reverse gap-4 mb-6">
                                    <img src="https://ui-avatars.com/api/?name=Ahmad+Subarjo&background=f43f5e&color=fff"
                                        class="w-12 h-12 rounded-2xl shadow-sm" />
                                    <div>
                                        <p class="font-black text-slate-800">Bpk. Ahmad Subarjo</p>
                                        <p
                                            class="text-[10px] font-bold text-rose-600 uppercase tracking-tighter md:text-right text-left">
                                            Guru PJOK</p>
                                    </div>
                                </div>
                                <p class="text-slate-600 text-lg leading-relaxed font-medium">
                                    "Ananda tidak membawa atribut lengkap saat upacara hari Senin. Mohon bimbingan orang tua
                                    untuk memastikan persiapan atribut di malam hari."
                                </p>
                                <div class="mt-8 flex items-center justify-between md:flex-row-reverse">
                                    <div
                                        class="px-4 py-1.5 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-tighter">
                                        Perlu Perhatian Khusus
                                    </div>
                                    <button
                                        class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400 hover:text-rose-600 transition-colors">
                                        <i data-lucide="check-circle" class="w-3 h-3"></i> Tandai Sudah Baca
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-20 text-center">
                <div
                    class="inline-flex items-center gap-3 px-6 py-3 bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
                    <p class="text-xs font-bold text-slate-500 tracking-tight">Sistem diupdate secara otomatis oleh Guru
                        Mata Pelajaran</p>
                </div>
            </div>
        </div>
    </main>

    <style>
        body {
            background-color: #F8FAFC;
        }

        /* Custom smoothing for fonts */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
@endsection
