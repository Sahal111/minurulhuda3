        {{-- MODAL BEASISWA SISWA --}}
        <div id="beasiswaSiswaModal" class="fixed inset-0 z-[90] hidden overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative w-full max-w-5xl bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden animate-up">

                    {{-- Header --}}
                    <div
                        class="px-8 pt-8 pb-4 flex items-center justify-between border-b border-slate-100 dark:border-slate-800">
                        <div>
                            <h3
                                class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tighter flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center">
                                    <i data-lucide="gem" class="w-4 h-4 text-emerald-500"></i>
                                </div>
                                BEASISWA <span class="text-emerald-500">SISWA</span>
                            </h3>
                            <p id="beasiswa_siswa_nama"
                                class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">—</p>
                        </div>
                        <button @click="closeBeasiswaSiswaModal()"
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 rounded-full transition-all">
                            <i data-lucide="x" class="w-5 h-5 text-slate-500"></i>
                        </button>
                    </div>

                    <div class="p-8 space-y-6">
                        {{-- Form Tambah Beasiswa --}}
                        <div
                            class="bg-slate-50 dark:bg-slate-800/50 p-5 rounded-2xl border border-slate-100 dark:border-slate-700">
                            <form id="formTambahBeasiswa" method="POST"
                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 items-end">
                                @csrf
                                <input type="hidden" name="siswa_id" id="beasiswa_siswa_id">

                                <div class="flex flex-col gap-2">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama
                                        Beasiswa <span class="text-rose-400">*</span></label>
                                    <input type="text" name="nama" required placeholder="Contoh: PIP, BSM, dsb"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700 dark:text-slate-300">
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis</label>
                                    <select name="jenis"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700 dark:text-slate-300">
                                        <option value="">Pilih Jenis...</option>
                                        <option value="Pemerintah Pusat">Pemerintah Pusat</option>
                                        <option value="Pemerintah Daerah">Pemerintah Daerah</option>
                                        <option value="Swasta/Yayasan">Swasta/Yayasan</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nominal
                                        (Rp)</label>
                                    <input type="number" name="nominal" placeholder="Contoh: 1000000"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700 dark:text-slate-300">
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun
                                        Mulai</label>
                                    <input type="text" name="tahun_mulai" placeholder="Contoh: 2022" maxlength="4"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700 dark:text-slate-300">
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun
                                        Selesai</label>
                                    <input type="text" name="tahun_selesai" placeholder="Contoh: 2023" maxlength="4"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700 dark:text-slate-300">
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Keterangan</label>
                                    <input type="text" name="keterangan" placeholder="Keterangan tambahan"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700 dark:text-slate-300">
                                </div>

                                <div class="md:col-span-2 lg:col-span-3 flex justify-end mt-2">
                                    <button type="submit"
                                        class="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center justify-center gap-2 shrink-0">
                                        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Data
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Tabel List Beasiswa --}}
                        <div class="border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr
                                            class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                                            <th
                                                class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">
                                                Periode</th>
                                            <th
                                                class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">
                                                Nama Beasiswa</th>
                                            <th
                                                class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">
                                                Nominal</th>
                                            <th
                                                class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap text-right">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="beasiswaTableBody">
                                        <tr>
                                            <td colspan="4" class="px-5 py-10 text-center">
                                                <div class="flex flex-col items-center justify-center gap-2">
                                                    <i data-lucide="loader-2"
                                                        class="w-6 h-6 text-emerald-500 animate-spin"></i>
                                                    <p class="text-xs text-slate-500 font-medium">Memuat data...</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
