        {{-- MODAL MUTASI / KELULUSAN --}}
        <div id="mutasiModal" class="fixed inset-0 z-[75] hidden overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative w-full max-w-lg bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden animate-up">

                    <div class="px-8 pt-8 pb-0 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tighter">
                                Proses <span class="text-amber-600">Mutasi</span>
                            </h3>
                            <p id="mutasi_siswa_nama"
                                class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">—</p>
                        </div>
                        <button @click="closeMutasiModal()"
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 rounded-full transition-all">
                            <i data-lucide="x" class="w-5 h-5 text-slate-500"></i>
                        </button>
                    </div>

                    <form id="formMutasi" method="POST" class="p-8 space-y-5">
                        @csrf
                        @method('PUT')
                        <div class="p-4 bg-amber-50 border border-amber-100 rounded-2xl flex items-start gap-3">
                            <i data-lucide="alert-triangle" class="w-4 h-4 text-amber-500 shrink-0 mt-0.5"></i>
                            <p class="text-xs text-amber-700 font-medium">Proses mutasi tidak dapat dibatalkan secara
                                otomatis. Pastikan data sudah benar.</p>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis
                                Mutasi</label>
                            <select name="jenis_mutasi" id="jenis_mutasi_select"
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm text-slate-700">
                                <option value="mutasi_keluar">Pindah Sekolah (Mutasi Keluar)</option>
                                <option value="lulus">Lulus / Tamat</option>
                                <option value="nonaktif">Non-Aktif / DO</option>
                            </select>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal
                                Keluar</label>
                            <input type="text" name="tanggal_keluar" id="tanggal_keluar_mutasi"
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm text-slate-700"
                                placeholder="Pilih tanggal" required>
                        </div>

                        <div class="flex flex-col gap-2" id="sekolah_tujuan_wrap">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sekolah
                                Tujuan</label>
                            <input type="text" name="sekolah_tujuan"
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm text-slate-700"
                                placeholder="Nama sekolah tujuan (untuk mutasi keluar)">
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">No. Surat
                                Mutasi</label>
                            <input type="text" name="no_surat"
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm text-slate-700"
                                placeholder="Nomor surat (opsional)">
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Alasan /
                                Keterangan <span class="text-rose-400">*</span></label>
                            <textarea rows="3" name="alasan_mutasi" required
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none resize-none text-sm text-slate-700"
                                placeholder="Jelaskan alasan mutasi..."></textarea>
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" @click="closeMutasiModal()"
                                class="px-5 py-3 text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-amber-600 hover:bg-amber-500 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-2">
                                <i data-lucide="log-out" class="w-4 h-4"></i> Proses Mutasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
