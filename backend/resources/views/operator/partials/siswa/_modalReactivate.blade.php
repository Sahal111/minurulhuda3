        {{-- MODAL AKTIFKAN KEMBALI (REACTIVATE) --}}
        <div id="reactivateModal" class="fixed inset-0 z-[75] hidden overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative w-full max-w-lg bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden animate-up">

                    {{-- Header --}}
                    <div class="px-8 pt-8 pb-4 flex items-center justify-between">
                        <div>
                            <h3
                                class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tighter flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center">
                                    <i data-lucide="undo-2" class="w-4 h-4 text-emerald-500"></i>
                                </div>
                                AKTIFKAN <span class="text-emerald-500">KEMBALI</span>
                            </h3>
                            <p id="reactivate_nama"
                                class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">—</p>
                        </div>
                        <button @click="closeReactivateModal()"
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 rounded-full transition-all">
                            <i data-lucide="x" class="w-5 h-5 text-slate-500"></i>
                        </button>
                    </div>

                    <form id="formReactivate" method="POST" class="p-8 pt-4 space-y-5">
                        @csrf
                        @method('PUT')

                        <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-start gap-3">
                            <i data-lucide="info" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                            <p class="text-xs text-emerald-700 font-medium">Siswa akan diaktifkan kembali. Seluruh data
                                akademik, nilai, dan riwayat keuangan sebelumnya tetap aman.</p>
                        </div>

                        {{-- Kelas Baru --}}
                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kelas Baru <span
                                    class="text-rose-400">*</span></label>
                            <select name="kelas_id" required
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">Kelas {{ $k->full_name }}
                                @endforeach
                            </select>
                        </div>

                        {{-- Tahun Ajaran --}}
                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun Ajaran
                                <span class="text-rose-400">*</span></label>
                            <select name="tahun_ajaran_id" required
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700">
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                @foreach ($tahunAjarans as $ta)
                                    <option value="{{ $ta->id }}" {{ $ta->is_active ? 'selected' : '' }}>
                                        {{ $ta->tahun }} {{ $ta->is_active ? '(Aktif)' : '' }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Semester --}}
                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Semester <span
                                    class="text-rose-400">*</span></label>
                            <select name="semester" required
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700">
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>

                        {{-- Tanggal Masuk Kembali --}}
                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Masuk
                                Kembali <span class="text-rose-400">*</span></label>
                            <input type="text" name="tanggal_masuk" id="tanggal_masuk_reactivate" required
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700"
                                placeholder="Pilih tanggal">
                        </div>

                        {{-- Action --}}
                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" @click="closeReactivateModal()"
                                class="px-5 py-3 text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4"></i> Aktifkan Kembali
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
