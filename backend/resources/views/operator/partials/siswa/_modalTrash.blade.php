        {{-- MODAL RECYCLE BIN (SISWA TERHAPUS) --}}
        <div id="trashModal" class="fixed inset-0 z-[80] hidden overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative w-full max-w-2xl bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden animate-up max-h-[85vh] flex flex-col">

                    {{-- Header --}}
                    <div
                        class="px-8 pt-8 pb-6 flex items-center justify-between shrink-0 border-b border-slate-100 dark:border-slate-800">
                        <div>
                            <h3
                                class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tighter flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-rose-100 dark:bg-rose-500/10 flex items-center justify-center">
                                    <i data-lucide="trash-2" class="w-4 h-4 text-rose-500"></i>
                                </div>
                                RECYCLE <span class="text-rose-500">BIN</span>
                            </h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Data siswa yang
                                dihapus — dapat dipulihkan</p>
                        </div>
                        <button onclick="closeTrashModal()"
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 rounded-full transition-all">
                            <i data-lucide="x" class="w-5 h-5 text-slate-500"></i>
                        </button>
                    </div>

                    {{-- Body --}}
                    <div class="flex-1 overflow-y-auto p-8">
                        {{-- Loading --}}
                        <div id="trash_loading" class="flex justify-center py-10">
                            <div class="w-6 h-6 border-2 border-rose-500 border-t-transparent rounded-full animate-spin">
                            </div>
                        </div>

                        {{-- Empty State --}}
                        <div id="trash_empty" class="hidden text-center py-12 text-slate-400">
                            <div
                                class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="trash-2" class="w-8 h-8 opacity-30"></i>
                            </div>
                            <p class="font-bold text-sm">Recycle Bin kosong</p>
                            <p class="text-xs mt-1">Tidak ada data siswa yang dihapus</p>
                        </div>

                        {{-- List --}}
                        <div id="trash_list" class="hidden space-y-3"></div>

                        {{-- Pagination --}}
                        <div id="trash_pagination" class="hidden mt-6 flex items-center justify-between">
                            <p id="trash_info" class="text-[10px] text-slate-400 font-bold uppercase tracking-widest"></p>
                            <div class="flex items-center gap-2">
                                <button id="trash_prev" onclick="loadTrash(trashCurrentPage - 1)"
                                    class="px-3 py-2 text-xs font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 rounded-xl hover:bg-slate-200 transition-all flex items-center gap-1">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i> Sebelumnya
                                </button>
                                <button id="trash_next" onclick="loadTrash(trashCurrentPage + 1)"
                                    class="px-3 py-2 text-xs font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 rounded-xl hover:bg-slate-200 transition-all flex items-center gap-1">
                                    Berikutnya <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div
                        class="px-8 py-5 bg-slate-50/50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800 shrink-0">
                        <p class="text-[10px] text-slate-400 flex items-center gap-1.5">
                            <i data-lucide="info" class="w-3 h-3 shrink-0"></i>
                            Data yang dihapus permanen <strong>tidak dapat dipulihkan</strong>. Gunakan fitur "Hapus
                            Permanen" dengan hati-hati.
                        </p>
                    </div>
                </div>
            </div>
        </div>
