        {{-- MODAL BERKAS DIGITAL SISWA --}}
        <div id="berkasSiswaModal" class="fixed inset-0 z-[90] hidden overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative w-full max-w-4xl bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden animate-up">

                    {{-- Header --}}
                    <div
                        class="px-8 pt-8 pb-4 flex items-center justify-between border-b border-slate-100 dark:border-slate-800">
                        <div>
                            <h3
                                class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tighter flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-violet-100 dark:bg-violet-500/10 flex items-center justify-center">
                                    <i data-lucide="folder-open" class="w-4 h-4 text-violet-500"></i>
                                </div>
                                BERKAS DIGITAL <span class="text-violet-500">SISWA</span>
                            </h3>
                            <p id="berkas_siswa_nama"
                                class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">—</p>
                        </div>
                        <button @click="closeBerkasModal()"
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 rounded-full transition-all">
                            <i data-lucide="x" class="w-5 h-5 text-slate-500"></i>
                        </button>
                    </div>

                    <div class="p-8 space-y-6">
                        {{-- Form Upload Berkas --}}
                        <div
                            class="bg-slate-50 dark:bg-slate-800/50 p-5 rounded-2xl border border-slate-100 dark:border-slate-700">
                            <form id="formUploadBerkas" method="POST" enctype="multipart/form-data"
                                class="flex flex-col sm:flex-row items-end gap-4">
                                @csrf
                                <input type="hidden" name="siswa_id" id="berkas_siswa_id">

                                <div class="w-full sm:w-1/3 flex flex-col gap-2">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis
                                        Berkas <span class="text-rose-400">*</span></label>
                                    <select name="jenis_berkas" required
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:border-violet-500 outline-none text-sm text-slate-700 dark:text-slate-300">
                                        <option value="">Pilih Jenis...</option>
                                        <option value="kartu_keluarga">Kartu Keluarga (KK)</option>
                                        <option value="akte_kelahiran">Akte Kelahiran</option>
                                        <option value="ktp_orang_tua">KTP Orang Tua</option>
                                        <option value="ijazah_sebelumnya">Ijazah Sebelumnya</option>
                                        <option value="kip_pkh_kks">KIP / PKH / KKS</option>
                                        <option value="pas_foto">Pas Foto Berwarna</option>
                                        <option value="surat_mutasi">Surat / Berkas Mutasi</option>
                                    </select>
                                </div>

                                <div class="w-full sm:w-1/2 flex flex-col gap-2">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">File
                                        Berkas (PDF/JPG/PNG) <span class="text-rose-400">*</span></label>
                                    <input type="file" name="berkas_file" required accept=".pdf,.jpg,.jpeg,.png"
                                        class="w-full px-4 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:border-violet-500 outline-none text-sm text-slate-700 dark:text-slate-300
                                    file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                                </div>

                                <button type="submit"
                                    class="w-full sm:w-auto px-6 py-3 bg-violet-600 hover:bg-violet-500 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center justify-center gap-2 h-11 shrink-0">
                                    <i data-lucide="upload-cloud" class="w-4 h-4"></i> Unggah
                                </button>
                            </form>
                        </div>

                        {{-- Tabel List Berkas --}}
                        <div class="border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr
                                            class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                                            <th
                                                class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">
                                                Jenis Berkas</th>
                                            <th
                                                class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">
                                                Nama File</th>
                                            <th
                                                class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">
                                                Ukuran</th>
                                            <th
                                                class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap text-right">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="berkasTableBody">
                                        <tr>
                                            <td colspan="4" class="px-5 py-10 text-center">
                                                <div class="flex flex-col items-center justify-center gap-2">
                                                    <i data-lucide="loader-2"
                                                        class="w-6 h-6 text-violet-500 animate-spin"></i>
                                                    <p class="text-xs text-slate-500 font-medium">Memuat data berkas...</p>
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
