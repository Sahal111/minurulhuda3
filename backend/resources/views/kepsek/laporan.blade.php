@extends('layouts.kepsek')
@section('content')
        <main class="flex-1 p-4 lg:p-6 space-y-6 w-full max-w-[1600px] mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex flex-col">
                    <span
                        class="text-xs font-semibold text-primary dark:text-primary mb-1 uppercase tracking-wider">Comprehensive
                        Reports</span>
                    <h2 class="text-2xl font-display font-bold text-slate-900 dark:text-white leading-tight">Laporan
                        Custom</h2>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="flex items-center gap-2 bg-white dark:bg-surface-dark hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm transition-all text-sm font-medium">
                        <i class="material-icons-round text-base">print</i>
                        <span class="hidden sm:inline">Print</span>
                    </button>
                    <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-700"></div>
                    <button
                        class="flex items-center gap-2 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 dark:bg-emerald-900/30 dark:text-emerald-300 dark:hover:bg-emerald-900/50 px-4 py-2.5 rounded-xl border border-emerald-200 dark:border-emerald-700/50 shadow-sm transition-all text-sm font-medium group">
                        <i
                            class="material-icons-round text-base group-hover:scale-110 transition-transform">table_view</i>
                        <span>Excel</span>
                    </button>
                    <button
                        class="flex items-center gap-2 bg-red-50 text-red-700 hover:bg-red-100 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50 px-4 py-2.5 rounded-xl border border-red-200 dark:border-red-700/50 shadow-sm transition-all text-sm font-medium group">
                        <i
                            class="material-icons-round text-base group-hover:scale-110 transition-transform">picture_as_pdf</i>
                        <span>PDF</span>
                    </button>
                </div>
            </div>
            <div class="border-b border-slate-200 dark:border-slate-700">
                <nav aria-label="Tabs" class="-mb-px flex space-x-6 overflow-x-auto hide-scroll">
                    <a class="border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-200 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                        href="#">
                        Laporan Bulanan
                    </a>
                    <a class="border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-200 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                        href="#">
                        Laporan Semester
                    </a>
                    <a class="border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-200 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                        href="#">
                        Laporan Tahunan
                    </a>
                    <a class="border-emerald-500 text-emerald-600 dark:text-emerald-400 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2"
                        href="#">
                        <i class="material-icons-round text-base">tune</i>
                        Laporan Custom
                    </a>
                </nav>
            </div>
            <div
                class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                <div class="flex items-center gap-2 mb-4">
                    <div
                        class="p-1.5 bg-emerald-100 dark:bg-emerald-900/50 rounded-lg text-emerald-600 dark:text-emerald-400">
                        <i class="material-icons-round text-lg">filter_alt</i>
                    </div>
                    <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Filter &amp; Custom
                        Date</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-500 dark:text-slate-400 ml-1">Date Range</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="material-icons-round text-slate-400 text-lg">date_range</i>
                            </div>
                            <input
                                class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl leading-5 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm shadow-sm transition-shadow"
                                placeholder="Select date range" type="text" value="01 Jan 2024 - 31 Jan 2024" />
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-500 dark:text-slate-400 ml-1">Data
                            Category</label>
                        <div class="relative">
                            <select
                                class="block w-full pl-3 pr-10 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl leading-5 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm shadow-sm appearance-none cursor-pointer">
                                <option>All Categories</option>
                                <option>Academic Performance</option>
                                <option>Financial Records</option>
                                <option>Staff Attendance</option>
                                <option>Student Enrollment</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="material-icons-round text-slate-400 text-lg">expand_more</i>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end">
                        <button
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2.5 px-4 rounded-xl shadow-lg shadow-emerald-200 dark:shadow-none transition-all flex items-center justify-center gap-2">
                            <i class="material-icons-round text-sm">refresh</i>
                            Generate Report
                        </button>
                    </div>
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span
                        class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 border border-emerald-100 dark:border-emerald-800">
                        Class: All Classes
                        <button class="ml-1.5 text-emerald-500 hover:text-emerald-700 focus:outline-none">
                            <i class="material-icons-round text-sm">close</i>
                        </button>
                    </span>
                    <span
                        class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 border border-emerald-100 dark:border-emerald-800">
                        Status: Active
                        <button class="ml-1.5 text-emerald-500 hover:text-emerald-700 focus:outline-none">
                            <i class="material-icons-round text-sm">close</i>
                        </button>
                    </span>
                    <button class="text-xs text-slate-500 hover:text-emerald-600 underline px-2 py-1">Clear all
                        filters</button>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft border border-slate-100 dark:border-slate-700/50 overflow-hidden">
                <div
                    class="p-6 border-b border-slate-100 dark:border-slate-700/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50/50 dark:bg-slate-800/20">
                    <div>
                        <h3 class="font-display font-bold text-slate-800 dark:text-white text-lg">Report Preview</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Generated on <span
                                class="font-medium text-slate-700 dark:text-slate-300">Jan 31, 2024 at 10:30 AM</span>
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-medium text-slate-500">View:</span>
                        <button
                            class="p-1.5 rounded-lg bg-white dark:bg-slate-700 shadow-sm text-emerald-600 dark:text-emerald-400 border border-slate-200 dark:border-slate-600">
                            <i class="material-icons-round text-lg">grid_view</i>
                        </button>
                        <button
                            class="p-1.5 rounded-lg hover:bg-white dark:hover:bg-slate-700 text-slate-400 dark:text-slate-500 border border-transparent hover:border-slate-200 dark:hover:border-slate-600 transition-all">
                            <i class="material-icons-round text-lg">bar_chart</i>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead
                            class="text-xs text-slate-500 uppercase bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th class="px-6 py-4 font-semibold" scope="col">KPI Indicator</th>
                                <th class="px-6 py-4 font-semibold" scope="col">Current Value</th>
                                <th class="px-6 py-4 font-semibold" scope="col">Target</th>
                                <th class="px-6 py-4 font-semibold" scope="col">Variance</th>
                                <th class="px-6 py-4 font-semibold" scope="col">Status</th>
                                <th class="px-6 py-4 font-semibold text-right" scope="col">Trend</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                            <tr
                                class="bg-white dark:bg-surface-dark hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400">
                                            <i class="material-icons-round text-base">school</i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-slate-800 dark:text-slate-200">Student
                                                Attendance</div>
                                            <div class="text-[10px] text-slate-500">Daily Average</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-700 dark:text-slate-300">96.5%</td>
                                <td class="px-6 py-4 text-slate-500">95.0%</td>
                                <td class="px-6 py-4 text-emerald-600 font-medium">+1.5%</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                        Excellent
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex items-center justify-end gap-1 text-emerald-500 text-xs font-bold">
                                        <i class="material-icons-round text-sm">trending_up</i>
                                        Up
                                    </div>
                                </td>
                            </tr>
                            <tr
                                class="bg-white dark:bg-surface-dark hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="p-2 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400">
                                            <i class="material-icons-round text-base">payments</i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-slate-800 dark:text-slate-200">SPP
                                                Collection</div>
                                            <div class="text-[10px] text-slate-500">Monthly Revenue</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-700 dark:text-slate-300">Rp 42.5M</td>
                                <td class="px-6 py-4 text-slate-500">Rp 45.0M</td>
                                <td class="px-6 py-4 text-red-500 font-medium">-2.5M</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">
                                        Attention
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1 text-red-500 text-xs font-bold">
                                        <i class="material-icons-round text-sm">trending_down</i>
                                        Down
                                    </div>
                                </td>
                            </tr>
                            <tr
                                class="bg-white dark:bg-surface-dark hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="p-2 rounded-lg bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400">
                                            <i class="material-icons-round text-base">menu_book</i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-slate-800 dark:text-slate-200">Avg. Grade
                                                (Math)</div>
                                            <div class="text-[10px] text-slate-500">Academic Perf.</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-700 dark:text-slate-300">78.4</td>
                                <td class="px-6 py-4 text-slate-500">75.0</td>
                                <td class="px-6 py-4 text-emerald-600 font-medium">+3.4</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                        On Track
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex items-center justify-end gap-1 text-emerald-500 text-xs font-bold">
                                        <i class="material-icons-round text-sm">trending_flat</i>
                                        Stable
                                    </div>
                                </td>
                            </tr>
                            <tr
                                class="bg-white dark:bg-surface-dark hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="p-2 rounded-lg bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400">
                                            <i class="material-icons-round text-base">person_add</i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-slate-800 dark:text-slate-200">New
                                                Enrollments</div>
                                            <div class="text-[10px] text-slate-500">PPDB 2024</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-700 dark:text-slate-300">128</td>
                                <td class="px-6 py-4 text-slate-500">150</td>
                                <td class="px-6 py-4 text-slate-400 font-medium">-22</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                        In Progress
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex items-center justify-end gap-1 text-emerald-500 text-xs font-bold">
                                        <i class="material-icons-round text-sm">trending_up</i>
                                        Up
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="p-4 border-t border-slate-100 dark:border-slate-700/50 bg-slate-50 dark:bg-slate-800/20 flex justify-between items-center">
                    <span class="text-xs text-slate-500 dark:text-slate-400">Showing 1 to 4 of 12 entries</span>
                    <div class="flex gap-1">
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 text-sm">
                            <i class="material-icons-round text-base">chevron_left</i>
                        </button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-emerald-600 text-white text-xs font-bold shadow-md shadow-emerald-200 dark:shadow-none">1</button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 text-xs font-medium">2</button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 text-xs font-medium">3</button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 text-sm">
                            <i class="material-icons-round text-base">chevron_right</i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div
                    class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                    <h4 class="font-display font-bold text-slate-800 dark:text-white text-sm mb-4">Department
                        Performance Breakdown</h4>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-600 dark:text-slate-400">Academic Affairs</span>
                                <span class="font-bold text-slate-800 dark:text-white">88%</span>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 88%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-600 dark:text-slate-400">Financial
                                    Management</span>
                                <span class="font-bold text-slate-800 dark:text-white">92%</span>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: 92%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-600 dark:text-slate-400">Human Resources</span>
                                <span class="font-bold text-slate-800 dark:text-white">75%</span>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2">
                                <div class="bg-amber-500 h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-emerald-900 to-slate-900 rounded-2xl shadow-lg p-6 relative overflow-hidden text-white">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10 blur-2xl pointer-events-none">
                    </div>
                    <h4 class="font-display font-bold text-lg mb-2 relative z-10">Report Notes</h4>
                    <p class="text-xs text-slate-300 mb-6 leading-relaxed relative z-10">
                        The current report indicates a slight dip in SPP collection for January due to holiday season
                        delays. Academic performance remains strong across all levels.
                    </p>
                    <button
                        class="bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-bold py-2 px-4 rounded-lg transition-colors relative z-10">
                        Add Annotation
                    </button>
                </div>
            </div>
        </main>
   @endsection