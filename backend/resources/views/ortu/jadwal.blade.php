@extends('layouts.ortu') {{-- Asumsi nama layout utama anda --}}

@section('content')
    <main class="flex-1 lg:ml-72 p-4 lg:p-8" x-data="{ viewMode: 'daily', activeDay: 'Senin' }">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Jadwal Pelajaran</h2>
                <p class="text-slate-500 text-sm">Tahun Ajaran 2023/2024 - Semester Ganjil</p>
            </div>

            <div class="flex bg-white p-1 rounded-xl shadow-sm border border-slate-200 w-fit">
                <button @click="viewMode = 'daily'"
                    :class="viewMode === 'daily' ? 'bg-emerald-600 text-white' : 'text-slate-500 hover:text-emerald-600'"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all">
                    <i data-lucide="calendar" class="w-4 h-4"></i> Harian
                </button>
                <button @click="viewMode = 'weekly'"
                    :class="viewMode === 'weekly' ? 'bg-emerald-600 text-white' : 'text-slate-500 hover:text-emerald-600'"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all">
                    <i data-lucide="layout-grid" class="w-4 h-4"></i> Mingguan
                </button>
            </div>
        </div>

        <div x-show="viewMode === 'daily'" x-transition class="space-y-6">
            <div class="flex gap-2 overflow-x-auto pb-2 no-scrollbar">
                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                    <button @click="activeDay = '{{ $hari }}'"
                        :class="activeDay === '{{ $hari }}' ? 'bg-emerald-100 text-emerald-700 border-emerald-200' :
                            'bg-white text-slate-500 border-slate-200'"
                        class="px-6 py-2 rounded-full border text-sm font-semibold whitespace-nowrap transition-all shadow-sm">
                        {{ $hari }}
                    </button>
                @endforeach
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Jam</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Mata Pelajaran
                            </th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider hidden md:table-cell">
                                Guru Pengampu</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        {{-- Loop data nantinya di sini, ini adalah dummy --}}
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span
                                    class="text-sm font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg">07:00
                                    - 08:30</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-700">Matematika</div>
                                <div class="text-xs text-slate-400 md:hidden italic">Bpk. Ahmad Subarjo</div>
                            </td>
                            <td class="px-6 py-4 hidden md:table-cell text-sm text-slate-600">Bpk. Ahmad Subarjo</td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-slate-400 hover:text-emerald-600"><i data-lucide="info"
                                        class="w-5 h-5"></i></button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span
                                    class="text-sm font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg">08:30
                                    - 10:00</span>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-700">Bahasa Indonesia</td>
                            <td class="px-6 py-4 hidden md:table-cell text-sm text-slate-600">Ibu Siti Aminah</td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-slate-400 hover:text-emerald-600"><i data-lucide="info"
                                        class="w-5 h-5"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="viewMode === 'weekly'" x-transition class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                        <h3 class="font-bold text-emerald-800 flex items-center gap-2">
                            <i data-lucide="calendar-days" class="w-5 h-5"></i> {{ $hari }}
                        </h3>
                        <span class="text-xs text-slate-400">4 Pelajaran</span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-1 bg-emerald-500 rounded-full self-stretch"></div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">07:00 - 08:30</p>
                                <p class="text-sm font-bold text-slate-700">Matematika</p>
                                <p class="text-xs text-slate-500">Bpk. Ahmad</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-1 bg-blue-500 rounded-full self-stretch"></div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">08:30 - 10:00</p>
                                <p class="text-sm font-bold text-slate-700">Bahasa Indonesia</p>
                                <p class="text-xs text-slate-500">Ibu Siti</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <style>
        /* Menghilangkan scrollbar di Chrome/Safari tapi tetap bisa scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection
