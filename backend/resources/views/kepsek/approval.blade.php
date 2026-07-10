@extends('layouts.kepsek')
@section('content')
    <main class="flex-1 p-6 space-y-6 w-full max-w-[1600px] mx-auto">
        <div class="flex overflow-x-auto hide-scroll pb-2 -mx-6 px-6 lg:mx-0 lg:px-0">
            <div class="flex space-x-1 bg-slate-100 dark:bg-slate-800 p-1.5 rounded-xl min-w-max lg:min-w-0 lg:w-full">
                <button
                    class="flex-1 px-4 py-2 bg-white dark:bg-slate-700 text-emerald-700 dark:text-emerald-400 shadow-sm rounded-lg text-xs sm:text-sm font-bold transition-all border border-slate-200 dark:border-slate-600">
                    Approval RAB
                </button>
                <button
                    class="flex-1 px-4 py-2 text-slate-500 dark:text-slate-400 hover:bg-white/50 dark:hover:bg-slate-700/50 hover:text-slate-700 dark:hover:text-slate-200 rounded-lg text-xs sm:text-sm font-medium transition-all">
                    Approval Kegiatan
                </button>
                <button
                    class="flex-1 px-4 py-2 text-slate-500 dark:text-slate-400 hover:bg-white/50 dark:hover:bg-slate-700/50 hover:text-slate-700 dark:hover:text-slate-200 rounded-lg text-xs sm:text-sm font-medium transition-all">
                    Validasi Kelulusan
                </button>
                <button
                    class="flex-1 px-4 py-2 text-slate-500 dark:text-slate-400 hover:bg-white/50 dark:hover:bg-slate-700/50 hover:text-slate-700 dark:hover:text-slate-200 rounded-lg text-xs sm:text-sm font-medium transition-all">
                    Validasi Mutasi
                </button>
            </div>
        </div>
        <div class="flex flex-col gap-6">
            <div class="space-y-4">
                <h2 class="text-sm font-display font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wide px-1">
                    Pending Requests</h2>
                <div
                    class="bg-white dark:bg-surface-dark rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50 overflow-hidden relative transition-all duration-300 hover:shadow-lg group">
                    <label class="block cursor-pointer p-5">
                        <input checked="" class="peer hidden expand-trigger" type="checkbox" />
                        <div class="flex justify-between items-start card-header">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0">
                                    <i class="material-icons-round">computer</i>
                                </div>
                                <div>
                                    <div class="flex flex-wrap items-center gap-2 mb-1">
                                        <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Ust.
                                            Hanafi (Koord. IT)</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                                        <span class="text-xs text-slate-400">Today, 09:30 AM</span>
                                    </div>
                                    <h3
                                        class="text-lg font-display font-bold text-slate-800 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">
                                        IT Lab Upgrade (20 PCs)</h3>
                                    <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400 mt-1">Rp
                                        150.000.000</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Pending
                                </span>
                                <i
                                    class="material-icons-round text-slate-300 dark:text-slate-600 transition-transform duration-300 expand-icon">expand_more</i>
                            </div>
                        </div>
                        <div
                            class="expandable-content max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out border-t border-slate-100 dark:border-slate-700/50 -mt-0 pt-0">
                            <div class="space-y-4">
                                <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4 mt-2">
                                    <h4
                                        class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wide">
                                        Description</h4>
                                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                                        Pengajuan peremajaan perangkat komputer laboratorium TIK untuk menunjang
                                        kegiatan ANBK tahun ajaran 2024/2025. Spesifikasi terlampir dalam dokumen
                                        pendukung. Vendor yang diajukan adalah PT. Solusi Digital Edukasi.
                                    </p>
                                    <div class="flex items-center gap-2 mt-3">
                                        <button
                                            class="text-xs flex items-center gap-1 text-emerald-600 hover:text-emerald-700 font-medium">
                                            <i class="material-icons-round text-sm">attach_file</i> Lihat
                                            Proposal.pdf
                                        </button>
                                        <button
                                            class="text-xs flex items-center gap-1 text-emerald-600 hover:text-emerald-700 font-medium">
                                            <i class="material-icons-round text-sm">attach_file</i>
                                            Penawaran_Harga.pdf
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wide">Catatan
                                        Alasan / Feedback</label>
                                    <textarea
                                        class="w-full text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all resize-none h-24"
                                        placeholder="Tambahkan catatan untuk persetujuan atau penolakan..."></textarea>
                                </div>
                                <div class="flex gap-3 pt-2">
                                    <button
                                        class="flex-1 px-4 py-3 rounded-xl border-2 border-red-100 dark:border-red-900/30 text-red-600 dark:text-red-400 font-bold text-sm hover:bg-red-50 dark:hover:bg-red-900/20 transition-all flex items-center justify-center gap-2">
                                        <i class="material-icons-round text-lg">close</i>
                                        Reject
                                    </button>
                                    <button
                                        class="flex-1 px-4 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-lg shadow-emerald-600/20 transition-all flex items-center justify-center gap-2">
                                        <i class="material-icons-round text-lg">check</i>
                                        Approve
                                    </button>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50 overflow-hidden relative transition-all duration-300 hover:shadow-lg group">
                    <label class="block cursor-pointer p-5">
                        <input class="peer hidden expand-trigger" type="checkbox" />
                        <div class="flex justify-between items-start card-header">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0">
                                    <i class="material-icons-round">build</i>
                                </div>
                                <div>
                                    <div class="flex flex-wrap items-center gap-2 mb-1">
                                        <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Bpk.
                                            Ahmad (Sarpras)</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                                        <span class="text-xs text-slate-400">Yesterday, 14:20 PM</span>
                                    </div>
                                    <h3
                                        class="text-lg font-display font-bold text-slate-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                        Renovasi Atap Gedung B</h3>
                                    <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400 mt-1">Rp
                                        45.000.000</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Pending
                                </span>
                                <i
                                    class="material-icons-round text-slate-300 dark:text-slate-600 transition-transform duration-300 expand-icon">expand_more</i>
                            </div>
                        </div>
                        <div
                            class="expandable-content max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out border-t border-slate-100 dark:border-slate-700/50 -mt-0 pt-0">
                            <div class="space-y-4">
                                <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4 mt-2">
                                    <h4
                                        class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wide">
                                        Description</h4>
                                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                                        Perbaikan kebocoran atap di 3 ruang kelas Gedung B. Membutuhkan penanganan
                                        segera sebelum musim hujan.
                                    </p>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wide">Catatan
                                        Alasan / Feedback</label>
                                    <textarea
                                        class="w-full text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all resize-none h-24"
                                        placeholder="Tambahkan catatan..."></textarea>
                                </div>
                                <div class="flex gap-3 pt-2">
                                    <button
                                        class="flex-1 px-4 py-3 rounded-xl border-2 border-red-100 dark:border-red-900/30 text-red-600 dark:text-red-400 font-bold text-sm hover:bg-red-50 dark:hover:bg-red-900/20 transition-all flex items-center justify-center gap-2">
                                        <i class="material-icons-round text-lg">close</i>
                                        Reject
                                    </button>
                                    <button
                                        class="flex-1 px-4 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-lg shadow-emerald-600/20 transition-all flex items-center justify-center gap-2">
                                        <i class="material-icons-round text-lg">check</i>
                                        Approve
                                    </button>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50 overflow-hidden relative transition-all duration-300 hover:shadow-lg group">
                    <label class="block cursor-pointer p-5">
                        <input class="peer hidden expand-trigger" type="checkbox" />
                        <div class="flex justify-between items-start card-header">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 shrink-0">
                                    <i class="material-icons-round">menu_book</i>
                                </div>
                                <div>
                                    <div class="flex flex-wrap items-center gap-2 mb-1">
                                        <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Ibu
                                            Siti (Kurikulum)</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                                        <span class="text-xs text-slate-400">2 Days ago</span>
                                    </div>
                                    <h3
                                        class="text-lg font-display font-bold text-slate-800 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                                        Pengadaan Buku Perpustakaan</h3>
                                    <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400 mt-1">Rp
                                        12.500.000</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Pending
                                </span>
                                <i
                                    class="material-icons-round text-slate-300 dark:text-slate-600 transition-transform duration-300 expand-icon">expand_more</i>
                            </div>
                        </div>
                        <div
                            class="expandable-content max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out border-t border-slate-100 dark:border-slate-700/50 -mt-0 pt-0">
                            <div class="space-y-4">
                                <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4 mt-2">
                                    <h4
                                        class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wide">
                                        Description</h4>
                                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                                        Penambahan koleksi buku fiksi dan ensiklopedia anak untuk meningkatkan minat
                                        baca siswa.
                                    </p>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wide">Catatan
                                        Alasan / Feedback</label>
                                    <textarea
                                        class="w-full text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all resize-none h-24"
                                        placeholder="Tambahkan catatan..."></textarea>
                                </div>
                                <div class="flex gap-3 pt-2">
                                    <button
                                        class="flex-1 px-4 py-3 rounded-xl border-2 border-red-100 dark:border-red-900/30 text-red-600 dark:text-red-400 font-bold text-sm hover:bg-red-50 dark:hover:bg-red-900/20 transition-all flex items-center justify-center gap-2">
                                        <i class="material-icons-round text-lg">close</i>
                                        Reject
                                    </button>
                                    <button
                                        class="flex-1 px-4 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-lg shadow-emerald-600/20 transition-all flex items-center justify-center gap-2">
                                        <i class="material-icons-round text-lg">check</i>
                                        Approve
                                    </button>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between mb-4 mt-4 px-1">
                    <h2 class="text-sm font-display font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wide">
                        Recent History</h2>
                    <a class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1 hover:underline"
                        href="#">
                        View Audit Log <i class="material-icons-round text-sm">arrow_forward</i>
                    </a>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft border border-slate-100 dark:border-slate-700/50 overflow-hidden">
                    <div class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <div class="flex justify-between items-center mb-1">
                                <span
                                    class="text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-0.5 rounded-md">Approved</span>
                                <span class="text-[10px] text-slate-400">12 Feb 2024</span>
                            </div>
                            <h4 class="text-sm font-bold text-slate-800 dark:text-white mb-0.5">Pembelian ATK
                                Bulanan</h4>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="w-5 h-5 rounded-full overflow-hidden border border-slate-200">
                                    <img alt="User" class="w-full h-full object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDY7vamtqBK039NU-0nqRTIMnKS1DXXfPIgZoQWlUY9zjMpfq2cbTS7EK4_nCohiGjYdvjfUEKMLy6GRZHl7xQzJg7CG1TBYnfF_diFPXYMSgGZhTYOy274B_iiAjAVbxS1rCKOJDpGgHNNP8J9vFNqpZlogRkgvr-JyV98IgrI5LlncsQLcKW1XpWtfbJJeX021QhAzRhP2LlrpTkL_lSGhuPUFJMRQtor458xuRCydx9-U3zycCs1MS-gkniXyxYBrNBA_0XcKqs" />
                                </div>
                                <span class="text-xs text-slate-500 dark:text-slate-400">Approved by <span
                                        class="font-medium text-slate-700 dark:text-slate-300">Ust.
                                        Abdullah</span></span>
                            </div>
                        </div>
                        <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <div class="flex justify-between items-center mb-1">
                                <span
                                    class="text-xs font-bold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 px-2 py-0.5 rounded-md">Rejected</span>
                                <span class="text-[10px] text-slate-400">10 Feb 2024</span>
                            </div>
                            <h4 class="text-sm font-bold text-slate-800 dark:text-white mb-0.5">Pengajuan Cuti Guru
                                (Mendadak)</h4>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="w-5 h-5 rounded-full overflow-hidden border border-slate-200">
                                    <img alt="User" class="w-full h-full object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDY7vamtqBK039NU-0nqRTIMnKS1DXXfPIgZoQWlUY9zjMpfq2cbTS7EK4_nCohiGjYdvjfUEKMLy6GRZHl7xQzJg7CG1TBYnfF_diFPXYMSgGZhTYOy274B_iiAjAVbxS1rCKOJDpGgHNNP8J9vFNqpZlogRkgvr-JyV98IgrI5LlncsQLcKW1XpWtfbJJeX021QhAzRhP2LlrpTkL_lSGhuPUFJMRQtor458xuRCydx9-U3zycCs1MS-gkniXyxYBrNBA_0XcKqs" />
                                </div>
                                <span class="text-xs text-slate-500 dark:text-slate-400">Rejected by <span
                                        class="font-medium text-slate-700 dark:text-slate-300">Ust.
                                        Abdullah</span></span>
                            </div>
                        </div>
                        <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <div class="flex justify-between items-center mb-1">
                                <span
                                    class="text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-0.5 rounded-md">Approved</span>
                                <span class="text-[10px] text-slate-400">08 Feb 2024</span>
                            </div>
                            <h4 class="text-sm font-bold text-slate-800 dark:text-white mb-0.5">Honor Guru
                                Ekstrakurikuler</h4>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="w-5 h-5 rounded-full overflow-hidden border border-slate-200">
                                    <img alt="User" class="w-full h-full object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDY7vamtqBK039NU-0nqRTIMnKS1DXXfPIgZoQWlUY9zjMpfq2cbTS7EK4_nCohiGjYdvjfUEKMLy6GRZHl7xQzJg7CG1TBYnfF_diFPXYMSgGZhTYOy274B_iiAjAVbxS1rCKOJDpGgHNNP8J9vFNqpZlogRkgvr-JyV98IgrI5LlncsQLcKW1XpWtfbJJeX021QhAzRhP2LlrpTkL_lSGhuPUFJMRQtor458xuRCydx9-U3zycCs1MS-gkniXyxYBrNBA_0XcKqs" />
                                </div>
                                <span class="text-xs text-slate-500 dark:text-slate-400">Approved by <span
                                        class="font-medium text-slate-700 dark:text-slate-300">Ust.
                                        Abdullah</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

{{-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Premium Principal Approval Management - MI Nurul Huda 3</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;family=Lexend:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#10b981", // Emerald 500
                        "primary-dark": "#047857", // Emerald 700
                        "primary-light": "#d1fae5", // Emerald 100
                        "accent": "#f59e0b", // Amber 500 for Islamic warmth
                        "background-light": "#f8fafc", // Slate 50
                        "background-dark": "#0f172a", // Slate 900
                        "sidebar-bg": "#065f46", // Emerald 800
                        "sidebar-hover": "#047857", // Emerald 700
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b", // Slate 800
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"],
                        "body": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "2xl": "1.5rem",
                        "3xl": "2rem",
                        "full": "9999px"
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                        'card': '0 2px 10px rgba(0, 0, 0, 0.03)',
                        'glow': '0 0 20px rgba(16, 185, 129, 0.4)',
                        'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.07)',
                    },
                    backdropBlur: {
                        'xs': '2px',
                    }
                },
            },
        }
    </script>
    <style>
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #sidebar-toggle:checked~.sidebar-overlay {
            display: block;
        }

        #sidebar-toggle:checked~.sidebar-menu {
            transform: translateX(0);
        }

        .expand-trigger:checked~.expandable-content {
            max-height: 800px;
            opacity: 1;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
        }

        .expand-trigger:checked~.card-header .expand-icon {
            transform: rotate(180deg);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .dark .glass-card {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .segmented-control {
            background: rgba(241, 245, 249, 0.8);
            border-radius: 9999px;
            padding: 4px;
        }

        .dark .segmented-control {
            background: rgba(15, 23, 42, 0.6);
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body
    class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 font-body min-h-screen transition-colors duration-300 antialiased overflow-x-hidden selection:bg-emerald-200 dark:selection:bg-emerald-900">
    <input class="hidden" id="sidebar-toggle" type="checkbox" />
    <div class="sidebar-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity"
        onclick="document.getElementById('sidebar-toggle').checked = false"></div>
    <aside
        class="sidebar-menu fixed top-0 left-0 bottom-0 w-72 bg-emerald-900 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col shadow-2xl lg:shadow-none overflow-hidden border-r border-emerald-800">
        <div class="h-24 flex items-center gap-4 px-6 bg-emerald-950/30">
            <div
                class="w-10 h-10 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl flex items-center justify-center text-emerald-400 font-display font-bold text-sm shadow-glow shrink-0">
                NH
            </div>
            <div>
                <h1 class="text-lg font-display font-bold text-white leading-tight tracking-tight">MI Nurul Huda 3</h1>
                <p class="text-[11px] text-emerald-300/80 font-medium tracking-wide">Principal ERP System</p>
            </div>
        </div>
        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 hide-scroll">
            <div class="mb-6">
                <p class="px-4 text-[10px] font-bold text-emerald-400/50 uppercase tracking-widest mb-3">Main Menu</p>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-white/5 hover:text-white rounded-xl transition-all group"
                    href="#">
                    <i
                        class="material-icons-round text-emerald-400/70 group-hover:text-emerald-300 transition-colors">dashboard</i>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-white/5 hover:text-white rounded-xl transition-all group mt-1"
                    href="#">
                    <i
                        class="material-icons-round text-emerald-400/70 group-hover:text-emerald-300 transition-colors">school</i>
                    <span class="text-sm font-medium">Monitoring Akademik</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-white/5 hover:text-white rounded-xl transition-all group mt-1"
                    href="#">
                    <i
                        class="material-icons-round text-emerald-400/70 group-hover:text-emerald-300 transition-colors">people</i>
                    <span class="text-sm font-medium">Monitoring SDM</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-white/5 hover:text-white rounded-xl transition-all group mt-1"
                    href="#">
                    <i
                        class="material-icons-round text-emerald-400/70 group-hover:text-emerald-300 transition-colors">account_balance_wallet</i>
                    <span class="text-sm font-medium">Monitoring Keuangan</span>
                </a>
            </div>
            <div class="mb-6">
                <p class="px-4 text-[10px] font-bold text-emerald-400/50 uppercase tracking-widest mb-3">Operations</p>
                <a class="flex items-center justify-between px-4 py-3 bg-emerald-600 shadow-glow text-white rounded-xl transition-all group border border-emerald-500/50"
                    href="#">
                    <div class="flex items-center gap-3">
                        <i
                            class="material-icons-round text-white group-hover:text-white transition-colors">verified_user</i>
                        <span class="text-sm font-semibold">Approval &amp; Validasi</span>
                    </div>
                    <span
                        class="bg-white text-emerald-700 text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm">3</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-white/5 hover:text-white rounded-xl transition-all group mt-1"
                    href="#">
                    <i
                        class="material-icons-round text-emerald-400/70 group-hover:text-emerald-300 transition-colors">assignment</i>
                    <span class="text-sm font-medium">Laporan Terpadu</span>
                </a>
            </div>
            <div>
                <p class="px-4 text-[10px] font-bold text-emerald-400/50 uppercase tracking-widest mb-3">System</p>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-white/5 hover:text-white rounded-xl transition-all group"
                    href="#">
                    <i
                        class="material-icons-round text-emerald-400/70 group-hover:text-emerald-300 transition-colors">settings</i>
                    <span class="text-sm font-medium">Settings</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-rose-300 hover:bg-rose-900/20 hover:text-rose-100 rounded-xl transition-all group mt-1"
                    href="#">
                    <i
                        class="material-icons-round text-rose-400 group-hover:text-rose-200 transition-colors">logout</i>
                    <span class="text-sm font-medium">Logout</span>
                </a>
            </div>
        </nav>
        <div class="p-4 bg-emerald-950/30 border-t border-emerald-800">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-emerald-800 flex items-center justify-center overflow-hidden ring-2 ring-emerald-600 ring-offset-2 ring-offset-emerald-900">
                    <img alt="Profile" class="w-full h-full object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDY7vamtqBK039NU-0nqRTIMnKS1DXXfPIgZoQWlUY9zjMpfq2cbTS7EK4_nCohiGjYdvjfUEKMLy6GRZHl7xQzJg7CG1TBYnfF_diFPXYMSgGZhTYOy274B_iiAjAVbxS1rCKOJDpGgHNNP8J9vFNqpZlogRkgvr-JyV98IgrI5LlncsQLcKW1XpWtfbJJeX021QhAzRhP2LlrpTkL_lSGhuPUFJMRQtor458xuRCydx9-U3zycCs1MS-gkniXyxYBrNBA_0XcKqs" />
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">Ust. Abdullah</p>
                    <p class="text-[10px] text-emerald-400 truncate">Principal</p>
                </div>
            </div>
        </div>
    </aside>
    <div class="lg:ml-72 flex flex-col min-h-screen">
        <header
            class="sticky top-0 z-30 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200 dark:border-slate-800 px-6 py-4 flex justify-between items-center shadow-[0_1px_2px_rgba(0,0,0,0.05)]">
            <div class="flex items-center gap-4">
                <label
                    class="lg:hidden p-2 -ml-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 transition-colors cursor-pointer"
                    for="sidebar-toggle">
                    <i class="material-icons-round text-2xl">menu_open</i>
                </label>
                <div>
                    <h1
                        class="text-xl font-display font-bold text-slate-800 dark:text-white leading-none hidden lg:block tracking-tight">
                        Approval Management</h1>
                    <div class="flex items-center gap-3 lg:hidden">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-lg flex items-center justify-center text-white font-display font-bold text-xs shadow-glow">
                            NH</div>
                        <h1 class="text-sm font-display font-bold text-slate-800 dark:text-white leading-none">MI Nurul
                            Huda 3</h1>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button
                    class="relative p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 transition-colors group">
                    <i
                        class="material-icons-round text-xl group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">notifications</i>
                    <span
                        class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full ring-2 ring-white dark:ring-slate-900 animate-pulse"></span>
                </button>
                <div class="h-6 w-[1px] bg-slate-200 dark:bg-slate-700"></div>
                <button
                    class="flex items-center gap-3 hover:bg-slate-50 dark:hover:bg-slate-800 p-1.5 -mr-1.5 rounded-full pr-3 transition-colors group">
                    <div
                        class="w-9 h-9 rounded-full overflow-hidden ring-2 ring-slate-100 dark:ring-slate-700 group-hover:ring-emerald-200 dark:group-hover:ring-emerald-800 transition-all">
                        <img alt="Principal profile picture" class="w-full h-full object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDY7vamtqBK039NU-0nqRTIMnKS1DXXfPIgZoQWlUY9zjMpfq2cbTS7EK4_nCohiGjYdvjfUEKMLy6GRZHl7xQzJg7CG1TBYnfF_diFPXYMSgGZhTYOy274B_iiAjAVbxS1rCKOJDpGgHNNP8J9vFNqpZlogRkgvr-JyV98IgrI5LlncsQLcKW1XpWtfbJJeX021QhAzRhP2LlrpTkL_lSGhuPUFJMRQtor458xuRCydx9-U3zycCs1MS-gkniXyxYBrNBA_0XcKqs" />
                    </div>
                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-200 hidden md:block">Ust.
                        Abdullah</span>
                    <i class="material-icons-round text-slate-400 text-lg hidden md:block">expand_more</i>
                </button>
            </div>
        </header>
        <main class="flex-1 p-6 space-y-8 w-full max-w-[1200px] mx-auto pb-24">
            <div class="flex overflow-x-auto hide-scroll pb-2 lg:pb-0 -mx-6 px-6 lg:mx-0 lg:px-0">
                <div class="segmented-control flex p-1 w-full lg:w-auto min-w-max">
                    <button
                        class="relative flex-1 px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 text-emerald-800 dark:text-emerald-200 shadow-sm bg-white dark:bg-slate-800 border border-slate-200/50 dark:border-slate-700">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Approval RAB
                            <span
                                class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.6)]"></span>
                        </span>
                    </button>
                    <button
                        class="flex-1 px-5 py-2.5 rounded-full text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition-all duration-200">
                        Approval Kegiatan
                    </button>
                    <button
                        class="flex-1 px-5 py-2.5 rounded-full text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition-all duration-200">
                        Validasi Kelulusan
                    </button>
                    <button
                        class="flex-1 px-5 py-2.5 rounded-full text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition-all duration-200">
                        Validasi Mutasi
                    </button>
                </div>
            </div>
            <div class="flex flex-col gap-8">
                <div class="space-y-5">
                    <div class="flex items-center justify-between px-1">
                        <h2 class="text-base font-display font-bold text-slate-800 dark:text-slate-200 tracking-tight">
                            Pending Requests</h2>
                        <span
                            class="text-xs font-medium px-2 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400">3
                            Items</span>
                    </div>
                    <div
                        class="glass-card rounded-[2rem] shadow-glass relative transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-white/10 dark:from-emerald-900/10 dark:to-slate-900/50 pointer-events-none">
                        </div>
                        <label class="block cursor-pointer p-6 relative z-10">
                            <input checked="" class="peer hidden expand-trigger" type="checkbox" />
                            <div class="flex justify-between items-start card-header">
                                <div class="flex items-start gap-5">
                                    <div
                                        class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-emerald-900/40 dark:to-emerald-800/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0 shadow-sm border border-emerald-100 dark:border-emerald-800/50">
                                        <i class="material-icons-round text-2xl">computer</i>
                                    </div>
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                            <span
                                                class="text-[11px] font-bold tracking-wide uppercase text-slate-400 dark:text-slate-500">IT
                                                Dept</span>
                                            <span class="text-[11px] font-medium text-slate-400 dark:text-slate-500">•
                                                Today, 09:30 AM</span>
                                        </div>
                                        <h3
                                            class="text-lg font-display font-bold text-slate-800 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors leading-tight">
                                            IT Lab Upgrade (20 PCs)</h3>
                                        <p
                                            class="text-base font-display font-semibold text-emerald-600 dark:text-emerald-400 mt-1 tracking-tight">
                                            Rp 150.000.000</p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-3">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-100/80 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50 shadow-sm backdrop-blur-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Pending
                                    </span>
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center transition-transform duration-300 expand-icon border border-slate-100 dark:border-slate-700">
                                        <i
                                            class="material-icons-round text-slate-400 dark:text-slate-500">expand_more</i>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="expandable-content max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out border-t border-slate-100 dark:border-slate-700/50 -mt-0 pt-0">
                                <div class="flex flex-col lg:flex-row gap-6">
                                    <div class="flex-1 space-y-4">
                                        <div>
                                            <h4
                                                class="text-xs font-bold text-slate-400 dark:text-slate-500 mb-2 uppercase tracking-wider">
                                                Proposal Details</h4>
                                            <p
                                                class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-light">
                                                Pengajuan peremajaan perangkat komputer laboratorium TIK untuk menunjang
                                                kegiatan ANBK tahun ajaran 2024/2025. Spesifikasi terlampir dalam
                                                dokumen pendukung. Vendor yang diajukan adalah PT. Solusi Digital
                                                Edukasi.
                                            </p>
                                        </div>
                                        <div class="flex flex-wrap gap-2">
                                            <button
                                                class="pl-2 pr-3 py-1.5 rounded-full bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 text-xs font-medium hover:bg-emerald-100 dark:hover:bg-emerald-900/40 transition-colors flex items-center gap-1.5 border border-emerald-100 dark:border-emerald-800/30">
                                                <div
                                                    class="w-5 h-5 rounded-full bg-emerald-200 dark:bg-emerald-800 flex items-center justify-center">
                                                    <i class="material-icons-round text-[10px]">description</i>
                                                </div>
                                                Lihat Proposal.pdf
                                            </button>
                                            <button
                                                class="pl-2 pr-3 py-1.5 rounded-full bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 text-xs font-medium hover:bg-emerald-100 dark:hover:bg-emerald-900/40 transition-colors flex items-center gap-1.5 border border-emerald-100 dark:border-emerald-800/30">
                                                <div
                                                    class="w-5 h-5 rounded-full bg-emerald-200 dark:bg-emerald-800 flex items-center justify-center">
                                                    <i class="material-icons-round text-[10px]">attach_money</i>
                                                </div>
                                                Penawaran_Harga.pdf
                                            </button>
                                        </div>
                                    </div>
                                    <div class="hidden lg:block w-px bg-slate-200 dark:bg-slate-700"></div>
                                    <div class="flex-1 space-y-4">
                                        <div>
                                            <label
                                                class="block text-xs font-bold text-slate-400 dark:text-slate-500 mb-2 uppercase tracking-wider">Feedback
                                                &amp; Decision</label>
                                            <textarea
                                                class="w-full text-sm bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all resize-none h-24 placeholder:text-slate-300 dark:placeholder:text-slate-600"
                                                placeholder="Write your notes for approval or rejection here..."></textarea>
                                        </div>
                                        <div class="flex gap-3">
                                            <button
                                                class="flex-1 px-4 py-3 rounded-xl bg-rose-50 dark:bg-rose-900/10 border border-rose-100 dark:border-rose-900/30 text-rose-600 dark:text-rose-400 font-bold text-sm hover:bg-rose-100 dark:hover:bg-rose-900/20 transition-all flex items-center justify-center gap-2">
                                                <i class="material-icons-round text-lg">close</i>
                                                Reject
                                            </button>
                                            <button
                                                class="flex-1 px-4 py-3 rounded-xl bg-gradient-to-b from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-white font-bold text-sm shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/40 transition-all flex items-center justify-center gap-2 transform active:scale-95 duration-200">
                                                <i class="material-icons-round text-lg">check</i>
                                                Approve Request
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div
                        class="glass-card rounded-[2rem] shadow-glass relative transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group overflow-hidden">
                        <label class="block cursor-pointer p-6 relative z-10">
                            <input class="peer hidden expand-trigger" type="checkbox" />
                            <div class="flex justify-between items-start card-header">
                                <div class="flex items-start gap-5">
                                    <div
                                        class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/40 dark:to-blue-800/20 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0 shadow-sm border border-blue-100 dark:border-blue-800/50">
                                        <i class="material-icons-round text-2xl">build</i>
                                    </div>
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                            <span
                                                class="text-[11px] font-bold tracking-wide uppercase text-slate-400 dark:text-slate-500">Facility</span>
                                            <span class="text-[11px] font-medium text-slate-400 dark:text-slate-500">•
                                                Yesterday, 14:20 PM</span>
                                        </div>
                                        <h3
                                            class="text-lg font-display font-bold text-slate-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors leading-tight">
                                            Renovasi Atap Gedung B</h3>
                                        <p
                                            class="text-base font-display font-semibold text-emerald-600 dark:text-emerald-400 mt-1 tracking-tight">
                                            Rp 45.000.000</p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-3">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-100/80 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50 shadow-sm backdrop-blur-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Pending
                                    </span>
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center transition-transform duration-300 expand-icon border border-slate-100 dark:border-slate-700">
                                        <i
                                            class="material-icons-round text-slate-400 dark:text-slate-500">expand_more</i>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="expandable-content max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out border-t border-slate-100 dark:border-slate-700/50 -mt-0 pt-0">
                                <div class="flex flex-col lg:flex-row gap-6">
                                    <div class="flex-1 space-y-4">
                                        <div>
                                            <h4
                                                class="text-xs font-bold text-slate-400 dark:text-slate-500 mb-2 uppercase tracking-wider">
                                                Proposal Details</h4>
                                            <p
                                                class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-light">
                                                Perbaikan kebocoran atap di 3 ruang kelas Gedung B. Membutuhkan
                                                penanganan segera sebelum musim hujan. Vendor: CV. Bangun Jaya.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hidden lg:block w-px bg-slate-200 dark:bg-slate-700"></div>
                                    <div class="flex-1 space-y-4">
                                        <div>
                                            <label
                                                class="block text-xs font-bold text-slate-400 dark:text-slate-500 mb-2 uppercase tracking-wider">Feedback
                                                &amp; Decision</label>
                                            <textarea
                                                class="w-full text-sm bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all resize-none h-24 placeholder:text-slate-300 dark:placeholder:text-slate-600"
                                                placeholder="Write your notes..."></textarea>
                                        </div>
                                        <div class="flex gap-3">
                                            <button
                                                class="flex-1 px-4 py-3 rounded-xl bg-rose-50 dark:bg-rose-900/10 border border-rose-100 dark:border-rose-900/30 text-rose-600 dark:text-rose-400 font-bold text-sm hover:bg-rose-100 dark:hover:bg-rose-900/20 transition-all flex items-center justify-center gap-2">
                                                <i class="material-icons-round text-lg">close</i>
                                                Reject
                                            </button>
                                            <button
                                                class="flex-1 px-4 py-3 rounded-xl bg-gradient-to-b from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-white font-bold text-sm shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/40 transition-all flex items-center justify-center gap-2 transform active:scale-95 duration-200">
                                                <i class="material-icons-round text-lg">check</i>
                                                Approve Request
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div
                        class="glass-card rounded-[2rem] shadow-glass relative transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group overflow-hidden">
                        <label class="block cursor-pointer p-6 relative z-10">
                            <input class="peer hidden expand-trigger" type="checkbox" />
                            <div class="flex justify-between items-start card-header">
                                <div class="flex items-start gap-5">
                                    <div
                                        class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-100 to-purple-50 dark:from-purple-900/40 dark:to-purple-800/20 flex items-center justify-center text-purple-600 dark:text-purple-400 shrink-0 shadow-sm border border-purple-100 dark:border-purple-800/50">
                                        <i class="material-icons-round text-2xl">menu_book</i>
                                    </div>
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                            <span
                                                class="text-[11px] font-bold tracking-wide uppercase text-slate-400 dark:text-slate-500">Curriculum</span>
                                            <span class="text-[11px] font-medium text-slate-400 dark:text-slate-500">•
                                                2 Days ago</span>
                                        </div>
                                        <h3
                                            class="text-lg font-display font-bold text-slate-800 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors leading-tight">
                                            Pengadaan Buku Perpustakaan</h3>
                                        <p
                                            class="text-base font-display font-semibold text-emerald-600 dark:text-emerald-400 mt-1 tracking-tight">
                                            Rp 12.500.000</p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-3">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-100/80 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50 shadow-sm backdrop-blur-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Pending
                                    </span>
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center transition-transform duration-300 expand-icon border border-slate-100 dark:border-slate-700">
                                        <i
                                            class="material-icons-round text-slate-400 dark:text-slate-500">expand_more</i>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="expandable-content max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out border-t border-slate-100 dark:border-slate-700/50 -mt-0 pt-0">
                                <div class="flex flex-col lg:flex-row gap-6">
                                    <div class="flex-1 space-y-4">
                                        <div>
                                            <h4
                                                class="text-xs font-bold text-slate-400 dark:text-slate-500 mb-2 uppercase tracking-wider">
                                                Proposal Details</h4>
                                            <p
                                                class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-light">
                                                Penambahan koleksi buku fiksi dan ensiklopedia anak untuk meningkatkan
                                                minat baca siswa.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hidden lg:block w-px bg-slate-200 dark:bg-slate-700"></div>
                                    <div class="flex-1 space-y-4">
                                        <div>
                                            <label
                                                class="block text-xs font-bold text-slate-400 dark:text-slate-500 mb-2 uppercase tracking-wider">Feedback
                                                &amp; Decision</label>
                                            <textarea
                                                class="w-full text-sm bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all resize-none h-24 placeholder:text-slate-300 dark:placeholder:text-slate-600"
                                                placeholder="Write your notes..."></textarea>
                                        </div>
                                        <div class="flex gap-3">
                                            <button
                                                class="flex-1 px-4 py-3 rounded-xl bg-rose-50 dark:bg-rose-900/10 border border-rose-100 dark:border-rose-900/30 text-rose-600 dark:text-rose-400 font-bold text-sm hover:bg-rose-100 dark:hover:bg-rose-900/20 transition-all flex items-center justify-center gap-2">
                                                <i class="material-icons-round text-lg">close</i>
                                                Reject
                                            </button>
                                            <button
                                                class="flex-1 px-4 py-3 rounded-xl bg-gradient-to-b from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-white font-bold text-sm shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/40 transition-all flex items-center justify-center gap-2 transform active:scale-95 duration-200">
                                                <i class="material-icons-round text-lg">check</i>
                                                Approve Request
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between mb-4 px-1">
                        <h2 class="text-base font-display font-bold text-slate-800 dark:text-slate-200 tracking-tight">
                            Recent History</h2>
                        <a class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1 hover:underline group"
                            href="#">
                            View Audit Log
                            <i
                                class="material-icons-round text-sm group-hover:translate-x-0.5 transition-transform">arrow_forward</i>
                        </a>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800/50 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/50 overflow-hidden">
                        <div class="flex flex-col">
                            <div
                                class="p-4 flex items-center gap-4 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors border-b border-slate-50 dark:border-slate-700/50">
                                <div
                                    class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)] shrink-0">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-slate-800 dark:text-white truncate">Pembelian ATK
                                        Bulanan</h4>
                                    <div class="flex items-center gap-2 text-xs text-slate-500 mt-0.5">
                                        <span>12 Feb 2024</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                        <span>By Ust. Abdullah</span>
                                    </div>
                                </div>
                                <span
                                    class="px-2.5 py-1 rounded-lg bg-emerald-100/50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 text-[10px] font-bold uppercase">Approved</span>
                            </div>
                            <div
                                class="p-4 flex items-center gap-4 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors border-b border-slate-50 dark:border-slate-700/50">
                                <div
                                    class="w-2 h-2 rounded-full bg-rose-500 shadow-[0_0_8px_rgba(244,63,94,0.5)] shrink-0">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-slate-800 dark:text-white truncate">Pengajuan
                                        Cuti Guru (Mendadak)</h4>
                                    <div class="flex items-center gap-2 text-xs text-slate-500 mt-0.5">
                                        <span>10 Feb 2024</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                        <span>By Ust. Abdullah</span>
                                    </div>
                                </div>
                                <span
                                    class="px-2.5 py-1 rounded-lg bg-rose-100/50 dark:bg-rose-900/20 text-rose-700 dark:text-rose-400 text-[10px] font-bold uppercase">Rejected</span>
                            </div>
                            <div
                                class="p-4 flex items-center gap-4 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                <div
                                    class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)] shrink-0">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-slate-800 dark:text-white truncate">Honor Guru
                                        Ekstrakurikuler</h4>
                                    <div class="flex items-center gap-2 text-xs text-slate-500 mt-0.5">
                                        <span>08 Feb 2024</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                        <span>By Ust. Abdullah</span>
                                    </div>
                                </div>
                                <span
                                    class="px-2.5 py-1 rounded-lg bg-emerald-100/50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 text-[10px] font-bold uppercase">Approved</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        lucide.createIcons();
    </script>

</body>

</html> --}}
