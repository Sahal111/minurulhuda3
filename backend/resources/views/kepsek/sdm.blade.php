@extends('layouts.kepsek')
@section('content')
    <main class="flex-1 p-6 space-y-6 w-full max-w-[1600px] mx-auto">
        <div class="space-y-4">
            <div class="flex justify-between items-end">
                <div class="flex flex-col">
                    <span class="text-xs font-semibold text-primary dark:text-primary mb-1 uppercase tracking-wider">Human
                        Resources</span>
                    <h2 class="text-2xl font-display font-bold text-slate-900 dark:text-white leading-tight">
                        Faculty Analytics</h2>
                </div>
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Semester 2 - 2023/2024</p>
                </div>
            </div>
            <div class="flex overflow-x-auto hide-scroll gap-2 border-b border-slate-200 dark:border-slate-700 pb-1">
                <button
                    class="px-4 py-2 text-sm font-medium text-emerald-600 dark:text-emerald-400 border-b-2 border-emerald-500 whitespace-nowrap bg-emerald-50/50 dark:bg-emerald-900/10 rounded-t-lg">
                    Kehadiran Guru
                </button>
                <button
                    class="px-4 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 whitespace-nowrap transition-colors">
                    Beban Mengajar
                </button>
                <button
                    class="px-4 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 whitespace-nowrap transition-colors">
                    Kinerja Guru
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="lg:col-span-2 bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h3 class="font-display font-bold text-slate-800 dark:text-white text-base flex items-center gap-2">
                            <i class="material-icons-round text-emerald-500">calendar_month</i>
                            Monthly Faculty Attendance
                        </h3>
                        <p class="text-[11px] text-slate-400">Average attendance percentage per month</p>
                    </div>
                    <div class="flex gap-2">
                        <select
                            class="text-xs bg-slate-50 dark:bg-background-dark border-slate-200 dark:border-slate-700 rounded-lg py-1.5 pl-3 pr-8 text-slate-600 dark:text-slate-300 focus:ring-1 focus:ring-primary shadow-sm font-medium">
                            <option>2023/2024</option>
                            <option>2022/2023</option>
                        </select>
                        <select
                            class="text-xs bg-slate-50 dark:bg-background-dark border-slate-200 dark:border-slate-700 rounded-lg py-1.5 pl-3 pr-8 text-slate-600 dark:text-slate-300 focus:ring-1 focus:ring-primary shadow-sm font-medium">
                            <option>Semester 2</option>
                            <option>Semester 1</option>
                        </select>
                    </div>
                </div>
                <div class="relative h-64 w-full">
                    <svg class="w-full h-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 100 50">
                        <defs>
                            <linearGradient id="attendanceGradientMain" x1="0" x2="0" y1="0"
                                y2="1">
                                <stop offset="0%" stop-color="#10b981" stop-opacity="0.2"></stop>
                                <stop offset="100%" stop-color="#10b981" stop-opacity="0"></stop>
                            </linearGradient>
                        </defs>
                        <line stroke="#e2e8f0" stroke-width="0.2" x1="0" x2="100" y1="10"
                            y2="10"></line>
                        <line stroke="#e2e8f0" stroke-width="0.2" x1="0" x2="100" y1="20"
                            y2="20"></line>
                        <line stroke="#e2e8f0" stroke-width="0.2" x1="0" x2="100" y1="30"
                            y2="30"></line>
                        <line stroke="#e2e8f0" stroke-width="0.2" x1="0" x2="100" y1="40"
                            y2="40"></line>
                        <path d="M0,25 Q16,20 32,15 T64,18 T100,10 V50 H0 Z" fill="url(#attendanceGradientMain)">
                        </path>
                        <path class="chart-line" d="M0,25 Q16,20 32,15 T64,18 T100,10" fill="none" stroke="#10b981"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        </path>
                        <circle cx="0" cy="25" fill="white" r="1.5" stroke="#10b981" stroke-width="1.5">
                        </circle>
                        <circle cx="32" cy="15" fill="white" r="1.5" stroke="#10b981" stroke-width="1.5">
                        </circle>
                        <circle cx="64" cy="18" fill="white" r="1.5" stroke="#10b981" stroke-width="1.5">
                        </circle>
                        <circle cx="100" cy="10" fill="white" r="1.5" stroke="#10b981" stroke-width="1.5">
                        </circle>
                        <g transform="translate(64, 10)">
                            <rect fill="#0f172a" height="10" opacity="0.8" rx="3" width="20" x="-10"
                                y="-12"></rect>
                            <text fill="white" font-size="4" font-weight="bold" text-anchor="middle" x="0"
                                y="-4">96%</text>
                        </g>
                    </svg>
                    <div class="flex justify-between text-[11px] text-slate-400 mt-4 font-medium px-0">
                        <span>Jan</span>
                        <span>Feb</span>
                        <span>Mar</span>
                        <span>Apr</span>
                        <span>May</span>
                        <span>Jun</span>
                    </div>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50 flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Guru Paling
                            Disiplin</h3>
                        <p class="text-[11px] text-emerald-500 font-medium">Top Performers of the Month</p>
                    </div>
                    <i
                        class="material-icons-round text-yellow-400 bg-yellow-50 dark:bg-yellow-900/20 p-1.5 rounded-lg">emoji_events</i>
                </div>
                <div class="flex-1 space-y-4">
                    <div
                        class="flex items-center gap-3 p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700 group hover:shadow-md transition-all">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-yellow-400 shadow-sm">
                                <img alt="Ahmad" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDEeabceT-zaivVfUPYEpwYS44NOSJIweUKx9HbeOlv1-WsPgFJRivHQrwiDw_E3Y1hTHHXs01zA_8RHIjYUoljW6ohLHqpfGXkgwYCc42WbR5sq2263t9OZ5j72QN_HMpTwkbdbKNpcMFZx7sXuv9ZQ3haldzVdOvUcdTvQ_P9PSFK_gvCqzjg-DX8UhjwEAhmmcdTgnfJk8tyfThQ7ytYXBeGe5ck07otbRBjMb0IWR3pskD_wmpWhE9TedEcxmG7hUhNsmbEB88" />
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 w-5 h-5 bg-yellow-400 rounded-full flex items-center justify-center text-[10px] font-bold text-white border-2 border-white dark:border-slate-800">
                                1</div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-slate-800 dark:text-white">Ust. Ahmad Fauzi</h4>
                            <p class="text-[10px] text-slate-500">Matematika</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-bold text-emerald-600">100%</span>
                            <p class="text-[9px] text-slate-400">Attendance</p>
                        </div>
                    </div>
                    <div
                        class="flex items-center gap-3 p-3 rounded-2xl bg-white dark:bg-surface-dark border border-slate-100 dark:border-slate-700/50 group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all">
                        <div class="relative">
                            <div
                                class="w-10 h-10 rounded-full overflow-hidden border-2 border-slate-200 dark:border-slate-600">
                                <img alt="Siti" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAikwhJdXjKiCIeGQZaLKtDWN0jEafXLI598o-B_hFhixfun7iRp0b2LzI0UkTEHlvG-wkv48m26thjNByzu-MiUfuatTqC2YYR8yAEdJPe_VeQqxmHsZBNlChRn5DRek-BQFmHVUAdHHVeG9dqfR2Rmfd4wOxTPoUA3Bh30JHH8B85Ddk20b_zWAOOW4DVJWFKj_Z7cZYcN9BxWdvQGxp0Ao_FQcx7b_dysyTkKTFipuCBGXHWqCBwjmtaNE2opO8OgIjAStxWlkQ" />
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 w-4 h-4 bg-slate-300 rounded-full flex items-center justify-center text-[9px] font-bold text-white border-2 border-white dark:border-slate-800">
                                2</div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xs font-bold text-slate-800 dark:text-white">Usth. Siti Aminah</h4>
                            <p class="text-[9px] text-slate-500">Bahasa Arab</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-bold text-emerald-600">99.2%</span>
                        </div>
                    </div>
                    <div
                        class="flex items-center gap-3 p-3 rounded-2xl bg-white dark:bg-surface-dark border border-slate-100 dark:border-slate-700/50 group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all">
                        <div class="relative">
                            <div
                                class="w-10 h-10 rounded-full overflow-hidden border-2 border-slate-200 dark:border-slate-600">
                                <img alt="Rudi" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJMcBOVqIne3V17xrEEuRZvvA59JvkQPFMZAS5XGbPzgnIHYNEuyMAVLIXiMaV4C4S-sVbdHWnMe9F_HOYgOxqsPE5AfJHadK0o-sOsIt29BpA6zDBvpbocmF8FzZItQCEifNOLIoFzwtbLlJ006ibTm2-Uyeer6FEjUcr-Ori-h0jy3dL80-CVK7Iv3lnSoD7JwOGjFzlSejzl6qOWCUWtJR2PN88e9PHV2MUTx2HG-Tzz6t6GnMMXVrckdlYAHmfzz7UDtMV46M" />
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 w-4 h-4 bg-orange-300 rounded-full flex items-center justify-center text-[9px] font-bold text-white border-2 border-white dark:border-slate-800">
                                3</div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xs font-bold text-slate-800 dark:text-white">Ust. Rudi Hartono</h4>
                            <p class="text-[9px] text-slate-500">Olahraga</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-bold text-emerald-600">98.5%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="bg-gradient-to-br from-red-50 to-white dark:from-red-900/10 dark:to-surface-dark rounded-3xl shadow-soft p-6 border border-red-100 dark:border-red-900/30">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-display font-bold text-slate-800 dark:text-white text-base flex items-center gap-2">
                        <i class="material-icons-round text-red-500">warning_amber</i>
                        Critical Alerts
                    </h3>
                    <span
                        class="bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-300 text-[10px] font-bold px-2 py-1 rounded-full border border-red-200 dark:border-red-800">Action
                        Required</span>
                </div>
                <div
                    class="p-4 bg-white dark:bg-surface-dark rounded-2xl border border-red-100 dark:border-red-900/30 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-red-500"></div>
                    <h4 class="text-sm font-bold text-slate-800 dark:text-white mb-1">Guru Belum Input Nilai</h4>
                    <p class="text-xs text-slate-500 mb-3">Deadline: Tomorrow, 17:00 WIB</p>
                    <div class="flex -space-x-2 overflow-hidden mb-3">
                        <img alt=""
                            class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-surface-dark"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMmMwYvq8JID5wYRlE0bCxJNfppAeMojMuzhZ3iGZjnFPdwi4_vltFHZ5i0VZCfV5aslXZgUteazbbqhEycKSua30vvfe_53QmGpjZQ1Bk8HILqu81WQR9u9NdZc3c-EhiL5PrC-jErGj6c3yH4pu2kuGHyzPJQKWioP6yxhZI2WLY0GJw3gL96582qY_uiX5telB-IOiHTnsPYFViiG3Zud8azhQbMhs3rucUh14qVIomm-_as0PCYri5zfI7GnAmwK4RlxtnakA" />
                        <img alt=""
                            class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-surface-dark"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDW2bhuSmeFw7KTrtoeE8uqzAaqKUBZCkIOZXRZL6aZ1blt6wLXLVSSdtrxcSftykrQ3DeTUuhHBD-b_0pxexxmj28CAHaOGDF_y5WGxcHJ9_MNSjLDEjDnZ5AFbJZLJZjG7QWCKS9bj7yCLk7IhDLbqRkqxRQeHZ0UuBjeBzsFuvhS59K5q5492MeLGwAdz690IWQVJwSwlyAOvawfP5Ca0yg-yqhvaA2naolKZ2GE_iP4H8ZW_ad0kO4Ul4AkmzC1KYaIj_mMCV4" />
                        <div
                            class="h-8 w-8 rounded-full ring-2 ring-white dark:ring-surface-dark bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500">
                            +3</div>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="flex-1 bg-red-50 hover:bg-red-100 text-red-600 dark:bg-red-900/30 dark:hover:bg-red-900/50 dark:text-red-300 text-xs font-semibold py-2 rounded-lg transition-colors border border-red-200 dark:border-red-800">
                            Remind All
                        </button>
                        <button
                            class="flex-1 bg-white hover:bg-slate-50 text-slate-600 dark:bg-surface-dark dark:hover:bg-slate-800 dark:text-slate-300 text-xs font-semibold py-2 rounded-lg transition-colors border border-slate-200 dark:border-slate-700">
                            View List
                        </button>
                    </div>
                </div>
            </div>
            <div
                class="lg:col-span-2 bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Teaching Hours
                        Distribution</h3>
                    <button class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold flex items-center gap-1">
                        View Full Schedule <i class="material-icons-round text-sm">arrow_forward</i>
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="text-[11px] text-slate-400 uppercase tracking-wider border-b border-slate-100 dark:border-slate-800">
                                <th class="pb-3 pl-2 font-medium">Faculty Name</th>
                                <th class="pb-3 font-medium">Subject</th>
                                <th class="pb-3 font-medium text-center">Total Hours</th>
                                <th class="pb-3 pr-2 font-medium w-1/3">Load Efficiency</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <tr
                                class="group border-b border-slate-50 dark:border-slate-800/50 last:border-0 hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="py-3 pl-2">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                                            AF</div>
                                        <div>
                                            <p class="font-bold text-slate-700 dark:text-slate-200 text-xs">Ust.
                                                Ahmad Fauzi</p>
                                            <p class="text-[10px] text-slate-400">NIP: 1982001</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-slate-500 dark:text-slate-400 text-xs">Matematika</td>
                                <td class="py-3 text-center font-semibold text-slate-700 dark:text-white">24 Jam
                                </td>
                                <td class="py-3 pr-2">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="flex-1 h-2 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-emerald-500 w-[100%] rounded-full"></div>
                                        </div>
                                        <span class="text-[10px] font-bold text-emerald-600">Optimal</span>
                                    </div>
                                </td>
                            </tr>
                            <tr
                                class="group border-b border-slate-50 dark:border-slate-800/50 last:border-0 hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="py-3 pl-2">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-xs">
                                            SA</div>
                                        <div>
                                            <p class="font-bold text-slate-700 dark:text-slate-200 text-xs">Usth.
                                                Siti Aminah</p>
                                            <p class="text-[10px] text-slate-400">NIP: 1985004</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-slate-500 dark:text-slate-400 text-xs">B. Arab</td>
                                <td class="py-3 text-center font-semibold text-slate-700 dark:text-white">28 Jam
                                </td>
                                <td class="py-3 pr-2">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="flex-1 h-2 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-orange-400 w-[85%] rounded-full"></div>
                                        </div>
                                        <span class="text-[10px] font-bold text-orange-500">Overload</span>
                                    </div>
                                </td>
                            </tr>
                            <tr
                                class="group border-b border-slate-50 dark:border-slate-800/50 last:border-0 hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="py-3 pl-2">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center font-bold text-xs">
                                            RH</div>
                                        <div>
                                            <p class="font-bold text-slate-700 dark:text-slate-200 text-xs">Ust.
                                                Rudi Hartono</p>
                                            <p class="text-[10px] text-slate-400">NIP: 1990021</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-slate-500 dark:text-slate-400 text-xs">PJOK</td>
                                <td class="py-3 text-center font-semibold text-slate-700 dark:text-white">18 Jam
                                </td>
                                <td class="py-3 pr-2">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="flex-1 h-2 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-blue-400 w-[60%] rounded-full"></div>
                                        </div>
                                        <span class="text-[10px] font-bold text-blue-500">Light</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="py-3 pl-2">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center font-bold text-xs">
                                            DW</div>
                                        <div>
                                            <p class="font-bold text-slate-700 dark:text-slate-200 text-xs">Usth.
                                                Dewi</p>
                                            <p class="text-[10px] text-slate-400">NIP: 1992015</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-slate-500 dark:text-slate-400 text-xs">Tematik</td>
                                <td class="py-3 text-center font-semibold text-slate-700 dark:text-white">22 Jam
                                </td>
                                <td class="py-3 pr-2">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="flex-1 h-2 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-emerald-500 w-[90%] rounded-full"></div>
                                        </div>
                                        <span class="text-[10px] font-bold text-emerald-600">Optimal</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
