        {{-- ==================== MODAL FORM SISWA (4 STEP) ==================== --}}
        <div id="siswaModal" class="fixed inset-0 z-[70] hidden overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div class="flex min-h-full items-start sm:items-center justify-center p-2 sm:p-4 py-4">
                <div
                    class="relative w-full max-w-5xl bg-white dark:bg-slate-900 rounded-[1.5rem] sm:rounded-[2.5rem] shadow-2xl overflow-hidden animate-up">

                    {{-- Header --}}
                    <div class="flex items-center justify-between px-6 sm:px-10 pt-8 pb-0">
                        <div>
                            <h3
                                class="text-xl sm:text-2xl font-black text-slate-800 dark:text-white uppercase tracking-tighter">
                                MASTER DATA <span class="text-emerald-600">SISWA</span>
                            </h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Input Informasi
                                Autentik Peserta Didik</p>
                        </div>
                        <button @click="closeSiswaModal()"
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 text-slate-500 rounded-full transition-all shrink-0 ml-4">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>

                    {{-- Step Indicator --}}
                    <div class="px-6 sm:px-10 pt-6 pb-4">
                        <div class="relative max-w-2xl mx-auto">
                            <div class="absolute top-5 left-5 right-5 h-[2px] bg-slate-100 dark:bg-slate-800 z-0"></div>
                            <div id="activeLineSiswa"
                                class="absolute top-5 left-5 w-0 h-[2px] bg-emerald-500 transition-all duration-500 z-0">
                            </div>
                            <div class="flex justify-between relative z-10">
                                @foreach ([['1', 'Identitas'], ['2', 'Orang Tua'], ['3', 'Periodik'], ['4', 'Akademik'], ['5', 'Konfirmasi']] as $s)
                                    <div class="step-item-siswa flex flex-col items-center gap-2">
                                        <div
                                            class="step-circle-siswa w-10 h-10 rounded-full {{ $loop->first ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/30' : 'bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-400' }} flex items-center justify-center font-bold ring-4 ring-white dark:ring-slate-900 transition-all text-sm">
                                            {{ $s[0] }}
                                        </div>
                                        <span
                                            class="text-[9px] font-black uppercase {{ $loop->first ? 'text-emerald-600' : 'text-slate-400' }} tracking-wider hidden sm:block">{{ $s[1] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form id="formSiswaMaster" action="{{ route('operator.dataSiswa.store') }}" method="POST"
                        enctype="multipart/form-data" @submit.prevent="validateSubmitSiswa">
                        @csrf

                        <div class="flex flex-col lg:flex-row gap-6 px-6 sm:px-10 pb-10">

                            {{-- Foto Upload --}}
                            <div class="w-full lg:w-[200px] shrink-0">
                                <div
                                    class="w-full h-36 lg:h-auto lg:aspect-[3/4] rounded-[1.5rem] border-2 border-dashed border-slate-200 dark:border-slate-700 bg-slate-50/50 flex items-center justify-center relative overflow-hidden">
                                    <img id="previewFotoSiswa" class="absolute inset-0 w-full h-full object-cover hidden">
                                    <div id="placeholderFotoSiswa"
                                        class="flex flex-col items-center gap-2 px-4 text-center">
                                        <i data-lucide="camera" class="w-10 h-10 text-slate-300"></i>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Foto
                                            Siswa</span>
                                        <span class="text-[9px] text-slate-300">JPG/PNG, maks 2MB</span>
                                    </div>
                                    <input type="file" name="foto" id="inputFotoSiswa"
                                        class="absolute inset-0 opacity-0 cursor-pointer z-[60]"
                                        accept="image/jpeg,image/png,image/jpg"
                                        @change="previewImageSiswa($event.target)">
                                </div>
                                <script>
                                    function previewImageSiswa(input) {
                                        const preview = document.getElementById('previewFotoSiswa');
                                        const placeholder = document.getElementById('placeholderFotoSiswa');
                                        if (input.files && input.files[0]) {
                                            const reader = new FileReader();
                                            reader.onload = function(e) {
                                                preview.src = e.target.result;
                                                preview.classList.remove('hidden');
                                                placeholder.classList.add('hidden');
                                            };
                                            reader.readAsDataURL(input.files[0]);
                                        } else {
                                            preview.src = '';
                                            preview.classList.add('hidden');
                                            placeholder.classList.remove('hidden');
                                        }
                                    }

                                    function toggleMutasiFields() {
                                        const isPindahan = document.querySelector('input[name="jenis_pendaftaran"]:checked').value === 'pindahan';
                                        
                                        // Toggle field data mutasi
                                        const container = document.getElementById('mutasiFieldsContainer');
                                        if (isPindahan) {
                                            container.classList.remove('hidden');
                                        } else {
                                            container.classList.add('hidden');
                                            // Clear fields if returning to 'baru'
                                            container.querySelectorAll('input').forEach(el => el.value = '');
                                        }

                                        // Toggle berkas mutasi
                                        const berkasContainer = document.getElementById('mutasiBerkasContainer');
                                        if (berkasContainer) {
                                            if (isPindahan) {
                                                berkasContainer.classList.remove('hidden');
                                            } else {
                                                berkasContainer.classList.add('hidden');
                                                berkasContainer.querySelectorAll('input').forEach(el => el.value = '');
                                            }
                                        }

                                        // Filter dropdown kelas
                                        const kelasSelect = document.querySelector('#formSiswaMaster select[name="kelas_id"]');
if (kelasSelect) {
    // Simpan semua options asli di data attribute pertama kali
    if (!kelasSelect.dataset.allOptions) {
        kelasSelect.dataset.allOptions = JSON.stringify(
            Array.from(kelasSelect.options).map(o => ({ value: o.value, text: o.text }))
        );
    }

    const allOptions = JSON.parse(kelasSelect.dataset.allOptions);
    const currentVal = kelasSelect.value;
    
    // Rebuild options
    kelasSelect.innerHTML = '';
    allOptions.forEach(o => {
        if (!o.value) {
            kelasSelect.add(new Option(o.text, o.value));
            return;
        }
        if (isPindahan || o.text.includes('Kelas 1')) {
            kelasSelect.add(new Option(o.text, o.value));
        }
    });

    // Pertahankan value jika masih ada
    if (Array.from(kelasSelect.options).some(o => o.value === currentVal)) {
        kelasSelect.value = currentVal;
    } else {
        kelasSelect.value = '';
    }
}
                                    }
                                    
                                    // Panggil sekali saat inisialisasi agar state awal sesuai radio yang terpilih
                                    document.addEventListener('DOMContentLoaded', () => {
                                        setTimeout(toggleMutasiFields, 100);
                                    });
                                </script>
                            </div>

                            {{-- Slider Steps (5 step, width 500%) --}}
                            <div class="flex-1 min-w-0 overflow-hidden flex flex-col">
                                <div id="sliderSiswa" class="flex transition-transform duration-700 ease-in-out"
                                    style="width:500%">


                                    {{-- STEP 1: IDENTITAS --}}
                                    <div class="flex flex-col justify-between pr-2" style="width:20%">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2 custom-scrollbar">
                                            
                                            {{-- Jenis Pendaftaran --}}
                                            <div class="sm:col-span-2 mb-2">
                                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Jenis Pendaftaran <span class="normal-case font-normal">*</span>
                                                </p>
                                                <div class="flex items-center gap-4">
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="radio" name="jenis_pendaftaran" value="baru" checked onchange="toggleMutasiFields()" class="w-4 h-4 text-emerald-600 border-slate-300 focus:ring-emerald-500">
                                                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200">Siswa Baru (Kelas 1)</span>
                                                    </label>
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="radio" name="jenis_pendaftaran" value="pindahan" onchange="toggleMutasiFields()" class="w-4 h-4 text-amber-500 border-slate-300 focus:ring-amber-500">
                                                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200">Siswa Pindahan (Mutasi)</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div id="mutasiFieldsContainer" class="sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4 hidden bg-amber-50/50 dark:bg-amber-500/5 p-4 rounded-2xl border border-amber-100 dark:border-amber-500/10 mb-2">
                                                <div class="sm:col-span-2">
                                                    <p class="text-[10px] font-black uppercase tracking-widest text-amber-600 dark:text-amber-500 mb-3">Data Sekolah Asal & Mutasi</p>
                                                </div>
                                                @include('operator.partials._formField', [
    'name' => 'asal_sekolah',
    'label' => 'Asal Sekolah *',
    'placeholder' => 'SD/MI asal',
    'type' => 'text',
])
                                                @include('operator.partials._formField', [
    'name' => 'npsn_asal',
    'label' => 'NPSN Sekolah Asal',
    'placeholder' => 'NPSN',
    'type' => 'text',
    'optional' => true,
])
                                                @include('operator.partials._formField', [
    'name' => 'no_surat_mutasi',
    'label' => 'No. Surat Mutasi / Pindah *',
    'placeholder' => 'Nomor surat pindah',
    'type' => 'text',
])
                                                @include('operator.partials._formField', [
    'name' => 'alasan_mutasi',
    'label' => 'Alasan Pindah *',
    'placeholder' => 'Alasan pindah ke sekolah ini',
    'type' => 'text',
])
                                            </div>

                                            @include('operator.partials._formField', [
    'name' => 'nisn',
    'label' => 'NISN',
    'placeholder' => 'Nomor Induk Siswa Nasional',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'nis',
    'label' => 'NIS (Lokal) *',
    'placeholder' => 'Nomor Induk Sekolah',
    'type' => 'text',
])
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
    'name' => 'nama',
    'label' => 'Nama Lengkap *',
    'placeholder' => 'Nama lengkap tanpa singkatan',
    'type' => 'text',
])
                                            </div>
                                            @include('operator.partials._formField', [
    'name' => 'tempat_lahir',
    'label' => 'Tempat Lahir *',
    'placeholder' => 'Kota Lahir',
    'type' => 'text',
])
                                            @include('operator.partials._formField', [
    'name' => 'tanggal_lahir',
    'label' => 'Tanggal Lahir *',
    'placeholder' => 'HH/BB/TTTT',
    'type' => 'text',
    'id' => 'tanggal_lahir_siswa',
])
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'jenis_kelamin',
    'label' => 'Jenis Kelamin *',
    'id' => 'jenisKelaminSiswa',
    'placeholder' => 'Pilih',
    'options' => [
        'L' => 'Laki-laki',
        'P' => 'Perempuan',
    ],
])
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'agama',
    'label' => 'Agama *',
    'id' => 'agamaSiswa',
    'placeholder' => 'Pilih',
    'options' => [
        'Islam' => 'Islam',
        'Kristen' => 'Kristen',
        'Katolik' => 'Katolik',
        'Hindu' => 'Hindu',
        'Budha' => 'Budha',
        'Khonghucu' => 'Khonghucu',
    ],
])
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'kewarganegaraan',
    'label' => 'Kewarganegaraan',
    'placeholder' => '-- Pilih --',
    'options' => [
        'WNI' => 'WNI',
        'WNA' => 'WNA',
    ],
    'optional' => true,
])

                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
    'name' => 'no_registrasi_akta_kelahiran',
    'label' => 'No Registrasi Akta Kelahiran',
    'placeholder' => 'Nomor seri/registrasi akta kelahiran',
    'type' => 'text',
    'optional' => true,
])
                                            </div>
                                        </div>
                                        @include('operator.partials._stepNavSiswa', [
    'step' => 1,
    'max' => 5,
])
                                    </div>

                                    {{-- STEP 2: ORANG TUA --}}
                                    <div class="flex flex-col justify-between pr-2" style="width:20%">
                                        <div
                                            class="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2 custom-scrollbar">

                                            {{-- Data Ayah --}}
                                            <div class="sm:col-span-2">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Data Ayah <span class="normal-case font-normal">*</span>
                                                </p>
                                            </div>
                                            @include('operator.partials._formField', [
    'name' => 'nama_ayah',
    'label' => 'Nama Ayah',
    'placeholder' => 'Nama lengkap ayah kandung',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'pekerjaan_ayah',
    'label' => 'Pekerjaan Ayah',
    'placeholder' => 'Contoh: Wiraswasta',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'nik_ayah',
    'label' => 'NIK Ayah',
    'placeholder' => '16 digit NIK ayah',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'tahun_lahir_ayah',
    'label' => 'Tahun Lahir Ayah',
    'placeholder' => 'Contoh: 1975',
    'type' => 'number',
    'optional' => true,
    'min' => 1940,
    'max' => date('Y'),
])
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'pendidikan_ayah',
    'label' => 'Pendidikan Terakhir Ayah',
    'placeholder' => '-- Pilih --',
    'options' => [
        'Tidak Sekolah' => 'Tidak Sekolah',
        'SD / Sederajat' => 'SD / Sederajat',
        'SMP / Sederajat' => 'SMP / Sederajat',
        'SMA / Sederajat' => 'SMA / Sederajat',
        'D1' => 'D1',
        'D2' => 'D2',
        'D3' => 'D3',
        'D4 / S1' => 'D4 / S1',
        'S2' => 'S2',
        'S3' => 'S3',
    ],
    'optional' => true,
])
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'penghasilan_ayah',
    'label' => 'Penghasilan Ayah',
    'placeholder' => '-- Pilih --',
    'options' => [
        'Kurang dari Rp 500.000' => 'Kurang dari Rp 500.000',
        'Rp 500.000 - Rp 999.999' => 'Rp 500.000 - Rp 999.999',
        'Rp 1.000.000 - Rp 1.999.999' =>
            'Rp 1.000.000 - Rp 1.999.999',
        'Rp 2.000.000 - Rp 4.999.999' =>
            'Rp 2.000.000 - Rp 4.999.999',
        'Rp 5.000.000 - Rp 20.000.000' =>
            'Rp 5.000.000 - Rp 20.000.000',
        'Lebih dari Rp 20.000.000' => 'Lebih dari Rp 20.000.000',
        'Tidak Berpenghasilan' => 'Tidak Berpenghasilan',
    ],
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'kebutuhan_khusus_ayah',
    'label' => 'Kebutuhan Khusus Ayah',
    'placeholder' => 'Kosongkan jika tidak ada',
    'type' => 'text',
    'optional' => true,
])

                                            {{-- Data Ibu --}}
                                            <div
                                                class="sm:col-span-2 border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Data Ibu <span class="normal-case font-normal">(opsional)</span>
                                                </p>
                                            </div>
                                            @include('operator.partials._formField', [
    'name' => 'nama_ibu',
    'label' => 'Nama Ibu',
    'placeholder' => 'Nama lengkap ibu kandung',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'pekerjaan_ibu',
    'label' => 'Pekerjaan Ibu',
    'placeholder' => 'Contoh: Ibu Rumah Tangga',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'nik_ibu',
    'label' => 'NIK Ibu',
    'placeholder' => '16 digit NIK ibu',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'tahun_lahir_ibu',
    'label' => 'Tahun Lahir Ibu',
    'placeholder' => 'Contoh: 1980',
    'type' => 'number',
    'optional' => true,
    'min' => 1940,
    'max' => date('Y'),
])
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'pendidikan_ibu',
    'label' => 'Pendidikan Terakhir Ibu',
    'placeholder' => '-- Pilih --',
    'options' => [
        'Tidak Sekolah' => 'Tidak Sekolah',
        'SD / Sederajat' => 'SD / Sederajat',
        'SMP / Sederajat' => 'SMP / Sederajat',
        'SMA / Sederajat' => 'SMA / Sederajat',
        'D1' => 'D1',
        'D2' => 'D2',
        'D3' => 'D3',
        'D4 / S1' => 'D4 / S1',
        'S2' => 'S2',
        'S3' => 'S3',
    ],
    'optional' => true,
])
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'penghasilan_ibu',
    'label' => 'Penghasilan Ibu',
    'placeholder' => '-- Pilih --',
    'options' => [
        'Kurang dari Rp 500.000' => 'Kurang dari Rp 500.000',
        'Rp 500.000 - Rp 999.999' => 'Rp 500.000 - Rp 999.999',
        'Rp 1.000.000 - Rp 1.999.999' =>
            'Rp 1.000.000 - Rp 1.999.999',
        'Rp 2.000.000 - Rp 4.999.999' =>
            'Rp 2.000.000 - Rp 4.999.999',
        'Rp 5.000.000 - Rp 20.000.000' =>
            'Rp 5.000.000 - Rp 20.000.000',
        'Lebih dari Rp 20.000.000' => 'Lebih dari Rp 20.000.000',
        'Tidak Berpenghasilan' => 'Tidak Berpenghasilan',
    ],
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'kebutuhan_khusus_ibu',
    'label' => 'Kebutuhan Khusus Ibu',
    'placeholder' => 'Kosongkan jika tidak ada',
    'type' => 'text',
    'optional' => true,
])

                                            {{-- Kontak & Alamat --}}
                                            <div
                                                class="sm:col-span-2 border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Kontak & Alamat
                                                </p>
                                            </div>
                                            @include('operator.partials._formField', [
    'name' => 'no_hp_ortu',
    'label' => 'No HP Orang Tua *',
    'placeholder' => '08xxxxxxxxxx',
    'type' => 'tel',
])
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
    'name' => 'alamat',
    'label' => 'Alamat Lengkap *',
    'placeholder' => 'Alamat domisili orang tua',
    'type' => 'textarea',
])
                                            </div>

                                            {{-- Data Wali --}}
                                            <div
                                                class="sm:col-span-2 border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Data Wali
                                                    <span class="normal-case font-normal">(isi jika
                                                        yatim/piatu/merantau)</span>
                                                </p>
                                            </div>
                                            <div id="dataWaliSection" class="sm:col-span-2">
                                                <div
                                                    class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 bg-blue-50 dark:bg-blue-500/10 rounded-2xl border border-blue-100 dark:border-blue-500/20">
                                                    @include('operator.partials._formField', [
    'name' => 'nama_wali',
    'label' => 'Nama Wali',
    'placeholder' => 'Nama lengkap wali',
    'type' => 'text',
    'optional' => true,
])
                                                    @include('operator.partials._formField', [
    'name' => 'pekerjaan_wali',
    'label' => 'Pekerjaan Wali',
    'placeholder' => 'Contoh: Wiraswasta',
    'type' => 'text',
    'optional' => true,
])
                                                    @include('operator.partials._formField', [
    'name' => 'nik_wali',
    'label' => 'NIK Wali',
    'placeholder' => '16 digit NIK wali',
    'type' => 'text',
    'optional' => true,
])
                                                    @include('operator.partials._formField', [
    'name' => 'tahun_lahir_wali',
    'label' => 'Tahun Lahir Wali',
    'placeholder' => 'Contoh: 1980',
    'type' => 'number',
    'optional' => true,
    'min' => 1940,
    'max' => date('Y'),
])
                                                    @include('operator.partials._formFieldSelect', [
    'name' => 'penghasilan_wali',
    'label' => 'Penghasilan Wali',
    'placeholder' => '-- Pilih --',
    'options' => [
        'Kurang dari Rp 500.000' => 'Kurang dari Rp 500.000',
        'Rp 500.000 - Rp 999.999' =>
            'Rp 500.000 - Rp 999.999',
        'Rp 1.000.000 - Rp 1.999.999' =>
            'Rp 1.000.000 - Rp 1.999.999',
        'Rp 2.000.000 - Rp 4.999.999' =>
            'Rp 2.000.000 - Rp 4.999.999',
        'Rp 5.000.000 - Rp 20.000.000' =>
            'Rp 5.000.000 - Rp 20.000.000',
        'Lebih dari Rp 20.000.000' =>
            'Lebih dari Rp 20.000.000',
        'Tidak Berpenghasilan' => 'Tidak Berpenghasilan',
    ],
    'optional' => true,
])
                                                    @include('operator.partials._formField', [
    'name' => 'no_hp_wali',
    'label' => 'No HP Wali',
    'placeholder' => '08xxxxxxxxxx',
    'type' => 'tel',
    'optional' => true,
])
                                                    @include('operator.partials._formFieldSelect', [
    'name' => 'pendidikan_wali',
    'label' => 'Pendidikan Terakhir Wali',
    'placeholder' => '-- Pilih --',
    'options' => [
        'Tidak Sekolah' => 'Tidak Sekolah',
        'SD / Sederajat' => 'SD / Sederajat',
        'SMP / Sederajat' => 'SMP / Sederajat',
        'SMA / Sederajat' => 'SMA / Sederajat',
        'D1' => 'D1',
        'D2' => 'D2',
        'D3' => 'D3',
        'D4 / S1' => 'D4 / S1',
        'S2' => 'S2',
        'S3' => 'S3',
    ],
    'optional' => true,
])
                                                    <div class="sm:col-span-2">
                                                        @include('operator.partials._formField', [
    'name' => 'alamat_wali',
    'label' => 'Alamat Wali',
    'placeholder' => 'Alamat domisili wali',
    'type' => 'textarea',
    'optional' => true,
])
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        @include('operator.partials._stepNavSiswa', [
    'step' => 2,
    'max' => 5,
])
                                    </div>

                                    {{-- STEP 3: PERIODIK & DOMISILI --}}
                                    <div class="flex flex-col justify-between pr-2" style="width:20%">
                                        <div
                                            class="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2 custom-scrollbar">

                                            {{-- Alamat Tempat Tinggal Siswa --}}
                                            <div class="sm:col-span-2">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Alamat Tempat Tinggal Siswa
                                                </p>
                                            </div>
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
    'name' => 'alamat_siswa',
    'label' => 'Alamat Lengkap Siswa *',
    'placeholder' => 'Alamat tempat tinggal siswa saat ini',
    'type' => 'textarea',
])
                                            </div>
                                            @include('operator.partials._formField', [
    'name' => 'rt',
    'label' => 'RT',
    'placeholder' => 'Contoh: 003',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'rw',
    'label' => 'RW',
    'placeholder' => 'Contoh: 005',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'kelurahan',
    'label' => 'Desa / Kelurahan *',
    'placeholder' => 'Nama kelurahan',
    'type' => 'text',
])
                                            @include('operator.partials._formField', [
    'name' => 'kecamatan',
    'label' => 'Kecamatan *',
    'placeholder' => 'Nama kecamatan',
    'type' => 'text',
])
                                            @include('operator.partials._formField', [
    'name' => 'kode_pos',
    'label' => 'Kode Pos',
    'placeholder' => 'Contoh: 12345',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'lintang',
    'label' => 'Lintang (Latitude)',
    'placeholder' => 'Contoh: -6.26000000',
    'type' => 'number',
    'optional' => true,
    'min' => -90,
    'max' => 90,
])
                                            @include('operator.partials._formField', [
    'name' => 'bujur',
    'label' => 'Bujur (Longitude)',
    'placeholder' => 'Contoh: 106.81000000',
    'type' => 'number',
    'optional' => true,
    'min' => -180,
    'max' => 180,
])

                                            {{-- Data Keluarga --}}
                                            <div
                                                class="sm:col-span-2 border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Data Keluarga
                                                </p>
                                            </div>
                                            @include('operator.partials._formField', [
    'name' => 'anak_ke',
    'label' => 'Anak Ke-',
    'placeholder' => 'Contoh: 2',
    'type' => 'number',
    'optional' => true,
    'min' => 1,
    'max' => 20,
])
                                            @include('operator.partials._formField', [
    'name' => 'jumlah_saudara',
    'label' => 'Jumlah Saudara Kandung',
    'placeholder' => 'Contoh: 3',
    'type' => 'number',
    'optional' => true,
    'min' => 0,
    'max' => 20,
])

                                            {{-- Data Geografis --}}
                                            <div
                                                class="sm:col-span-2 border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Data Geografis ke Sekolah
                                                </p>
                                            </div>
                                            @include('operator.partials._formField', [
    'name' => 'jarak_tempat_tinggal',
    'label' => 'Jarak ke Sekolah (km)',
    'placeholder' => 'Contoh: 2.5',
    'type' => 'number',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'waktu_tempuh',
    'label' => 'Waktu Tempuh (menit)',
    'placeholder' => 'Contoh: 15',
    'type' => 'number',
    'optional' => true,
    'min' => 0,
    'max' => 999,
])
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formFieldSelect', [
    'name' => 'moda_transportasi',
    'label' => 'Moda Transportasi',
    'placeholder' => '-- Pilih --',
    'options' => [
        'Jalan Kaki' => 'Jalan Kaki',
        'Sepeda' => 'Sepeda',
        'Sepeda Motor' => 'Sepeda Motor',
        'Mobil Pribadi' => 'Mobil Pribadi',
        'Antar Jemput Sekolah' => 'Antar Jemput Sekolah',
        'Angkutan Umum' => 'Angkutan Umum',
        'Perahu / Sampan' => 'Perahu / Sampan',
        'Lainnya' => 'Lainnya',
    ],
    'optional' => true,
])
                                            </div>

                                            {{-- Data Pendukung & Kontak Siswa --}}
                                            <div
                                                class="sm:col-span-2 border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Data Pendukung & Kontak Pribadi Siswa
                                                </p>
                                            </div>
                                            @include('operator.partials._formField', [
    'name' => 'hobi',
    'label' => 'Hobi',
    'placeholder' => 'Contoh: Membaca',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'cita_cita',
    'label' => 'Cita-cita',
    'placeholder' => 'Contoh: Dokter',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'no_telp_siswa',
    'label' => 'No Telp Siswa',
    'placeholder' => 'Telepon rumah/pribadi',
    'type' => 'tel',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'hp_siswa',
    'label' => 'HP Siswa',
    'placeholder' => '08xxxxxxxxxx',
    'type' => 'tel',
    'optional' => true,
])
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
    'name' => 'email_siswa',
    'label' => 'Email Siswa',
    'placeholder' => 'nama@email.com',
    'type' => 'email',
    'optional' => true,
])
                                            </div>
                                        </div>
                                        @include('operator.partials._stepNavSiswa', [
    'step' => 3,
    'max' => 5,
])
                                    </div>

                                    {{-- STEP 4: AKADEMIK --}}
                                    <div class="flex flex-col justify-between pr-2" style="width:20%">
                                        <div
                                            class="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2 custom-scrollbar">
                                            @php
$opsiKelas = [];
foreach ($kelas as $k) {
    $opsiKelas[$k->id] =
        'Kelas ' . $k->full_name;
}
$opsiTA = [];
foreach ($tahunAjarans as $ta) {
    $opsiTA[$ta->id] = $ta->tahun . ($ta->is_active ? ' (Aktif)' : '');
}
                                            @endphp

                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formFieldSelect', [
    'name' => 'kelas_id',
    'label' => 'Kelas',
    'placeholder' => '-- Belum Ditentukan (Opsional) --',
    'options' => $opsiKelas,
    'optional' => true,
])
                                            </div>
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'tahun_ajaran_id',
    'label' => 'Tahun Ajaran *',
    'placeholder' => '-- Pilih Tahun Ajaran --',
    'options' => $opsiTA,
])
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'status',
    'label' => 'Status Siswa *',
    'placeholder' => 'Pilih',
    'options' => [
        'aktif' => 'Aktif',
        'nonaktif' => 'Non-Aktif',
        'pindah' => 'Pindah Sekolah',
        'lulus' => 'Lulus',
    ],
])
                                            @include('operator.partials._formField', [
    'name' => 'nik',
    'label' => 'NIK',
    'placeholder' => '16 digit NIK',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'no_kk',
    'label' => 'No. Kartu Keluarga (KK)',
    'placeholder' => '16 digit No. KK',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'tanggal_masuk',
    'label' => 'Tanggal Masuk *',
    'placeholder' => 'HH/BB/TTTT',
    'type' => 'text',
    'id' => 'tanggal_masuk_siswa',
])
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'golongan_darah',
    'label' => 'Golongan Darah',
    'placeholder' => 'Tidak Diketahui',
    'options' => [
        'A' => 'A',
        'B' => 'B',
        'AB' => 'AB',
        'O' => 'O',
    ],
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'tinggi_badan',
    'label' => 'Tinggi Badan (cm)',
    'placeholder' => 'Contoh: 125',
    'type' => 'number',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'berat_badan',
    'label' => 'Berat Badan (kg)',
    'placeholder' => 'Contoh: 25',
    'type' => 'number',
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'lingkar_kepala',
    'label' => 'Lingkar Kepala (cm)',
    'placeholder' => 'Contoh: 51.5',
    'type' => 'number',
    'optional' => true,
    'min' => 0,
    'max' => 99.99,
])
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
    'name' => 'kebutuhan_khusus',
    'label' => 'Kebutuhan Khusus / ABK',
    'placeholder' => 'Kosongkan jika tidak ada',
    'type' => 'text',
    'optional' => true,
])
                                            </div>
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
    'name' => 'riwayat_penyakit',
    'label' => 'Riwayat Penyakit',
    'placeholder' => 'Riwayat penyakit / alergi (opsional)',
    'type' => 'textarea',
    'optional' => true,
])
                                            </div>
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
    'name' => 'catatan_kesehatan',
    'label' => 'Catatan Kesehatan (Semester Ini)',
    'placeholder' =>
        'Kondisi kesehatan/fisik untuk periode semester ini...',
    'type' => 'textarea',
    'optional' => true,
])
                                            </div>

                                            {{-- Program Kesejahteraan Dapodik --}}
                                            <div
                                                class="sm:col-span-2 border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Program Kesejahteraan
                                                </p>
                                            </div>
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'penerima_kps_pkh',
    'label' => 'Penerima KPS/PKH',
    'placeholder' => '-- Pilih --',
    'options' => [
        '0' => 'Tidak',
        '1' => 'Ya',
    ],
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'no_kps_pkh',
    'label' => 'No KPS/PKH',
    'placeholder' => 'Nomor kartu/program',
    'type' => 'text',
    'optional' => true,
])
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'layak_pip',
    'label' => 'Layak PIP',
    'placeholder' => '-- Pilih --',
    'options' => [
        '0' => 'Tidak',
        '1' => 'Ya',
    ],
    'optional' => true,
])
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
    'name' => 'alasan_layak_pip',
    'label' => 'Alasan Layak PIP',
    'placeholder' => 'Alasan kelayakan PIP',
    'type' => 'textarea',
    'optional' => true,
])
                                            </div>
                                            @include('operator.partials._formFieldSelect', [
    'name' => 'penerima_kip',
    'label' => 'Penerima KIP',
    'placeholder' => '-- Pilih --',
    'options' => [
        '0' => 'Tidak',
        '1' => 'Ya',
    ],
    'optional' => true,
])
                                            @include('operator.partials._formField', [
    'name' => 'no_kip',
    'label' => 'No KIP',
    'placeholder' => 'Nomor KIP',
    'type' => 'text',
    'optional' => true,
])
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
    'name' => 'nama_tertera_di_kip',
    'label' => 'Nama Tertera di KIP',
    'placeholder' => 'Nama sesuai kartu KIP',
    'type' => 'text',
    'optional' => true,
])
                                            </div>

                                            {{-- Berkas Digital Tambahan (Opsional) --}}
                                            <div
                                                class="sm:col-span-2 border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Berkas Digital <span class="normal-case font-normal">(opsional -
                                                        pdf/jpg)</span>
                                                </p>
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <label
                                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kartu
                                                    Keluarga (KK)</label>
                                                <input type="file" name="berkas_kk" accept=".pdf,.jpg,.jpeg,.png"
                                                    class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700
                                            file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <label
                                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akte
                                                    Kelahiran</label>
                                                <input type="file" name="berkas_akte" accept=".pdf,.jpg,.jpeg,.png"
                                                    class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700
                                            file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <label
                                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Ijazah
                                                    Sebelumnya</label>
                                                <input type="file" name="berkas_ijazah" accept=".pdf,.jpg,.jpeg,.png"
                                                    class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700
                                            file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                            </div>

                                            <div id="mutasiBerkasContainer" class="sm:col-span-2 hidden bg-amber-50/50 dark:bg-amber-500/5 p-4 rounded-2xl border border-amber-100 dark:border-amber-500/10 mb-2">
                                                <div class="sm:col-span-2 mb-3">
                                                    <p class="text-[10px] font-black uppercase tracking-widest text-amber-600 dark:text-amber-500">Berkas Mutasi (Khusus Siswa Pindahan)</p>
                                                </div>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    <div class="flex flex-col gap-2">
                                                        <label class="text-[10px] font-bold text-amber-600 dark:text-amber-500 uppercase tracking-widest">Surat Pindah (Wajib) *</label>
                                                        <input type="file" name="berkas_surat_mutasi" accept=".pdf,.jpg,.jpeg,.png"
                                                            class="w-full px-4 py-2 bg-white border border-amber-200 rounded-xl focus:border-amber-500 outline-none text-sm text-slate-700
                                                    file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-amber-100 file:text-amber-700 hover:file:bg-amber-200">
                                                    </div>
                                                    <div class="flex flex-col gap-2">
                                                        <label class="text-[10px] font-bold text-amber-600 dark:text-amber-500 uppercase tracking-widest">Rapor Asal (Opsional)</label>
                                                        <input type="file" name="berkas_rapor_asal" accept=".pdf,.jpg,.jpeg,.png"
                                                            class="w-full px-4 py-2 bg-white border border-amber-200 rounded-xl focus:border-amber-500 outline-none text-sm text-slate-700
                                                    file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-amber-100 file:text-amber-700 hover:file:bg-amber-200">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Link Akun Login --}}
                                            <div
                                                class="sm:col-span-2 flex flex-col gap-2 pt-2 border-t border-slate-100 dark:border-slate-800">
                                                <label
                                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                                    Akun Login <span
                                                        class="normal-case font-normal text-slate-300">(opsional)</span>
                                                </label>
                                                <select name="user_id" class="field-input">
                                                    <option value="">— Belum dihubungkan ke akun —</option>
                                                    @foreach ($userSiswa as $u)
                                                        <option value="{{ $u->id }}">{{ $u->name }}
                                                            ({{ $u->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="text-[10px] text-slate-400">Hubungkan siswa ini ke akun user agar
                                                    bisa login ke sistem.</p>
                                            </div>
                                        </div>
                                        @include('operator.partials._stepNavSiswa', [
    'step' => 4,
    'max' => 5,
])
                                    </div>

                                    {{-- STEP 5: KONFIRMASI --}}
                                    <div class="flex flex-col justify-between pr-2" style="width:20%">
                                        <div class="space-y-4 overflow-y-auto max-h-[55vh] pr-2 custom-scrollbar">

                                            {{-- Info Banner --}}
                                            <div
                                                class="bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 rounded-2xl p-4">
                                                <p
                                                    class="text-xs font-bold text-emerald-700 dark:text-emerald-400 flex items-center gap-2 mb-1">
                                                    <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Konfirmasi Data
                                                    Siswa
                                                </p>
                                                <p class="text-[11px] text-emerald-600/80 dark:text-emerald-400/70">Periksa
                                                    kembali sebelum menyimpan. Data yang sudah tersimpan dapat diedit
                                                    kembali.</p>
                                            </div>

                                            {{-- Ringkasan Identitas --}}
                                            <div
                                                class="rounded-2xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                                                <div
                                                    class="bg-slate-50 dark:bg-slate-800/60 px-4 py-2.5 border-b border-slate-100 dark:border-slate-800">
                                                    <p
                                                        class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">
                                                        Identitas Siswa</p>
                                                </div>
                                                <div class="p-4 grid grid-cols-2 gap-3">
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Nama Lengkap</p>
                                                        <p id="review_nama_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            NISN / NIS</p>
                                                        <p id="review_nisn_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Tempat, Tgl Lahir</p>
                                                        <p id="review_ttl_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Jenis Kelamin</p>
                                                        <p id="review_jk_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Ringkasan Orang Tua --}}
                                            <div
                                                class="rounded-2xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                                                <div
                                                    class="bg-slate-50 dark:bg-slate-800/60 px-4 py-2.5 border-b border-slate-100 dark:border-slate-800">
                                                    <p
                                                        class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">
                                                        Data Orang Tua</p>
                                                </div>
                                                <div class="p-4 grid grid-cols-2 gap-3">
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Ayah</p>
                                                        <p id="review_ayah_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Ibu</p>
                                                        <p id="review_ibu_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Pendidikan Ayah</p>
                                                        <p id="review_pendidikan_ayah"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Pendidikan Ibu</p>
                                                        <p id="review_pendidikan_ibu"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            No HP</p>
                                                        <p id="review_hp_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Ringkasan Domisili & Periodik --}}
                                            <div
                                                class="rounded-2xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                                                <div
                                                    class="bg-slate-50 dark:bg-slate-800/60 px-4 py-2.5 border-b border-slate-100 dark:border-slate-800">
                                                    <p
                                                        class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">
                                                        Domisili & Periodik</p>
                                                </div>
                                                <div class="p-4 grid grid-cols-2 gap-3">
                                                    <div class="col-span-2">
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Alamat Siswa</p>
                                                        <p id="review_alamat_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Kelurahan</p>
                                                        <p id="review_kelurahan"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Kecamatan</p>
                                                        <p id="review_kecamatan"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Anak Ke / Saudara</p>
                                                        <p id="review_anak_saudara"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Transportasi</p>
                                                        <p id="review_transportasi"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Koordinat</p>
                                                        <p id="review_koordinat"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Hobi / Cita-cita</p>
                                                        <p id="review_hobi_cita"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Ringkasan Akademik --}}
                                            <div
                                                class="rounded-2xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                                                <div
                                                    class="bg-slate-50 dark:bg-slate-800/60 px-4 py-2.5 border-b border-slate-100 dark:border-slate-800">
                                                    <p
                                                        class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">
                                                        Data Akademik</p>
                                                </div>
                                                <div class="p-4 grid grid-cols-2 gap-3">
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Kelas</p>
                                                        <p id="review_kelas_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Status</p>
                                                        <p id="review_status_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Tahun Ajaran</p>
                                                        <p id="review_ta_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                            Tgl Masuk</p>
                                                        <p id="review_masuk_siswa"
                                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">
                                                            —</p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Warning --}}
                                            <div
                                                class="bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20 rounded-2xl p-4 flex items-start gap-2">
                                                <i data-lucide="info" class="w-4 h-4 text-amber-500 shrink-0 mt-0.5"></i>
                                                <p class="text-[11px] text-amber-700 dark:text-amber-400">
                                                    Pastikan data yang diinput sudah benar. Data dapat diedit kembali
                                                    setelah disimpan.
                                                </p>
                                            </div>
                                        </div>

                                        {{-- Final Step Nav --}}
                                        <div class="flex justify-between items-center mt-6">
                                            <button type="button" @click="goToStepSiswa(5, 4)"
                                                class="text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest flex items-center gap-1">
                                                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                                            </button>
                                            <button type="button" @click="validateSubmitSiswa()"
                                                class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-lg shadow-emerald-500/30 active:scale-95 transition-all flex items-center gap-2">
                                                <i data-lucide="save" class="w-4 h-4"></i> Simpan Data
                                            </button>
                                        </div>
                                    </div>

                                </div>{{-- /sliderSiswa --}}
                            </div>
                        </div>
                    </form>

                    <div id="toastErrorSiswa"
                        class="fixed top-4 right-4 z-[999] hidden bg-rose-500 text-white px-5 py-3 rounded-2xl shadow-lg text-sm font-bold max-w-xs">
                    </div>
                </div>
            </div>
        </div>
