import React, { useState, useEffect, useRef, useCallback } from 'react';
import { X, Camera, ArrowLeft, ArrowRight, Save, CheckCircle, Info, AlertTriangle, Upload } from 'lucide-react';
import { siswaAPI } from '../../api/operator';

const STEPS = ['Identitas', 'Orang Tua', 'Periodik', 'Akademik', 'Konfirmasi'];

const INIT_FORM = {
    jenis_pendaftaran: 'baru', nisn: '', nis: '', nama: '', tempat_lahir: '', tanggal_lahir: '',
    jenis_kelamin: 'L', agama: 'Islam', kewarganegaraan: 'WNI', no_registrasi_akta_kelahiran: '',
    asal_sekolah: '', npsn_asal: '', no_surat_mutasi: '', alasan_mutasi: '',
    nama_ayah: '', pekerjaan_ayah: '', nik_ayah: '', tahun_lahir_ayah: '', pendidikan_ayah: '', penghasilan_ayah: '', kebutuhan_khusus_ayah: '',
    nama_ibu: '', pekerjaan_ibu: '', nik_ibu: '', tahun_lahir_ibu: '', pendidikan_ibu: '', penghasilan_ibu: '', kebutuhan_khusus_ibu: '',
    nama_wali: '', pekerjaan_wali: '', nik_wali: '', tahun_lahir_wali: '', penghasilan_wali: '', no_hp_wali: '', pendidikan_wali: '', alamat_wali: '',
    no_hp_ortu: '', alamat: '',
    alamat_siswa: '', rt: '', rw: '', kelurahan: '', kecamatan: '', kode_pos: '', lintang: '', bujur: '',
    anak_ke: '', jumlah_saudara: '', jarak_tempat_tinggal: '', waktu_tempuh: '', moda_transportasi: '',
    hobi: '', cita_cita: '', no_telp_siswa: '', hp_siswa: '', email_siswa: '',
    kelas_id: '', tahun_ajaran_id: '', status: 'aktif', nik: '', no_kk: '', tanggal_masuk: '',
    golongan_darah: '', tinggi_badan: '', berat_badan: '', lingkar_kepala: '',
    kebutuhan_khusus: '', riwayat_penyakit: '', catatan_kesehatan: '',
    penerima_kps_pkh: '0', no_kps_pkh: '', layak_pip: '0', alasan_layak_pip: '',
    penerima_kip: '0', no_kip: '', nama_tertera_di_kip: '',
    user_id: '',
};

const ModalFormSiswa = ({ isOpen, onClose, onSuccess, siswa, kelas = [], tahunAjarans = [] }) => {
    const [step, setStep] = useState(1);
    const [form, setForm] = useState(INIT_FORM);
    const [fotoPreview, setFotoPreview] = useState(null);
    const [fotoFile, setFotoFile] = useState(null);
    const [submitting, setSubmitting] = useState(false);
    const sliderRef = useRef(null);
    const isEdit = !!siswa;

    useEffect(() => {
        if (!isOpen) return;
        if (siswa) {
            setForm({
                jenis_pendaftaran: siswa.jenis_pendaftaran || 'baru',
                nisn: siswa.nisn || '', nis: siswa.nis || '', nama: siswa.nama || '',
                tempat_lahir: siswa.tempat_lahir || '', tanggal_lahir: siswa.tanggal_lahir || '',
                jenis_kelamin: siswa.jenis_kelamin || 'L', agama: siswa.agama || 'Islam',
                kewarganegaraan: siswa.kewarganegaraan || 'WNI', no_registrasi_akta_kelahiran: siswa.no_registrasi_akta_kelahiran || '',
                asal_sekolah: siswa.asal_sekolah || '', npsn_asal: siswa.npsn_asal || '', no_surat_mutasi: siswa.no_surat_mutasi || '',
                alasan_mutasi: siswa.alasan_mutasi || '',
                nama_ayah: siswa.nama_ayah || siswa.orang_tua?.nama_ayah || '',
                pekerjaan_ayah: siswa.pekerjaan_ayah || siswa.orang_tua?.pekerjaan_ayah || '',
                nik_ayah: siswa.nik_ayah || siswa.orang_tua?.nik_ayah || '',
                tahun_lahir_ayah: siswa.tahun_lahir_ayah || siswa.orang_tua?.tahun_lahir_ayah || '',
                pendidikan_ayah: siswa.pendidikan_ayah || siswa.orang_tua?.pendidikan_ayah || '',
                penghasilan_ayah: siswa.penghasilan_ayah || siswa.orang_tua?.penghasilan_ayah || '',
                kebutuhan_khusus_ayah: siswa.kebutuhan_khusus_ayah || siswa.orang_tua?.kebutuhan_khusus_ayah || '',
                nama_ibu: siswa.nama_ibu || siswa.orang_tua?.nama_ibu || '',
                pekerjaan_ibu: siswa.pekerjaan_ibu || siswa.orang_tua?.pekerjaan_ibu || '',
                nik_ibu: siswa.nik_ibu || siswa.orang_tua?.nik_ibu || '',
                tahun_lahir_ibu: siswa.tahun_lahir_ibu || siswa.orang_tua?.tahun_lahir_ibu || '',
                pendidikan_ibu: siswa.pendidikan_ibu || siswa.orang_tua?.pendidikan_ibu || '',
                penghasilan_ibu: siswa.penghasilan_ibu || siswa.orang_tua?.penghasilan_ibu || '',
                kebutuhan_khusus_ibu: siswa.kebutuhan_khusus_ibu || siswa.orang_tua?.kebutuhan_khusus_ibu || '',
                no_hp_ortu: siswa.no_hp_ortu || siswa.orang_tua?.no_hp || '',
                alamat: siswa.alamat || siswa.orang_tua?.alamat || '',
                nama_wali: siswa.nama_wali || '', pekerjaan_wali: siswa.pekerjaan_wali || '',
                nik_wali: siswa.nik_wali || '', tahun_lahir_wali: siswa.tahun_lahir_wali || '',
                penghasilan_wali: siswa.penghasilan_wali || '', no_hp_wali: siswa.no_hp_wali || '',
                pendidikan_wali: siswa.pendidikan_wali || '', alamat_wali: siswa.alamat_wali || '',
                alamat_siswa: siswa.alamat_siswa || '', rt: siswa.rt || '', rw: siswa.rw || '',
                kelurahan: siswa.kelurahan || '', kecamatan: siswa.kecamatan || '',
                kode_pos: siswa.kode_pos || '', lintang: siswa.lintang || '', bujur: siswa.bujur || '',
                anak_ke: siswa.anak_ke || '', jumlah_saudara: siswa.jumlah_saudara || '',
                jarak_tempat_tinggal: siswa.jarak_tempat_tinggal || '', waktu_tempuh: siswa.waktu_tempuh || '',
                moda_transportasi: siswa.moda_transportasi || '',
                hobi: siswa.hobi || '', cita_cita: siswa.cita_cita || '',
                no_telp_siswa: siswa.no_telp_siswa || '', hp_siswa: siswa.hp_siswa || '',
                email_siswa: siswa.email_siswa || '',
                kelas_id: siswa.kelas_id || '', tahun_ajaran_id: siswa.tahun_ajaran_id || '',
                status: siswa.status || 'aktif', nik: siswa.nik || '', no_kk: siswa.no_kk || '',
                tanggal_masuk: siswa.tanggal_masuk || '',
                golongan_darah: siswa.golongan_darah || '', tinggi_badan: siswa.tinggi_badan || '',
                berat_badan: siswa.berat_badan || '', lingkar_kepala: siswa.lingkar_kepala || '',
                kebutuhan_khusus: siswa.kebutuhan_khusus || '', riwayat_penyakit: siswa.riwayat_penyakit || '',
                catatan_kesehatan: siswa.catatan_kesehatan || '',
                penerima_kps_pkh: siswa.penerima_kps_pkh ?? '0', no_kps_pkh: siswa.no_kps_pkh || '',
                layak_pip: siswa.layak_pip ?? '0', alasan_layak_pip: siswa.alasan_layak_pip || '',
                penerima_kip: siswa.penerima_kip ?? '0', no_kip: siswa.no_kip || '',
                nama_tertera_di_kip: siswa.nama_tertera_di_kip || '',
                user_id: siswa.user_id || '',
            });
            setFotoPreview(siswa.foto ? `${import.meta.env.VITE_API_URL?.replace('/api', '') || 'http://localhost:8000'}/storage/${siswa.foto}` : null);
            setFotoFile(null);
        } else {
            setForm(INIT_FORM);
            setFotoPreview(null);
            setFotoFile(null);
        }
        setStep(1);
    }, [isOpen, siswa]);

    const update = (key, val) => setForm(prev => ({ ...prev, [key]: val }));

    const handleFotoChange = (e) => {
        const file = e.target.files?.[0];
        if (file) {
            setFotoFile(file);
            setFotoPreview(URL.createObjectURL(file));
        }
    };

    const goToStep = (target) => {
        if (target < 1 || target > 5) return;
        setStep(target);
        if (sliderRef.current) {
            sliderRef.current.style.transform = `translateX(-${(target - 1) * 20}%)`;
        }
    };

    const apiUrl = import.meta.env.VITE_API_URL?.replace('/api', '') || 'http://localhost:8000';

    const handleSubmit = async () => {
        setSubmitting(true);
        try {
            const fd = new FormData();
            Object.entries(form).forEach(([k, v]) => {
                if (v !== '' && v !== null) fd.append(k, v);
            });
            if (fotoFile) fd.append('foto', fotoFile);

            let res;
            if (isEdit) {
                fd.append('_method', 'PUT');
                res = await siswaAPI.update(siswa.id, fd);
            } else {
                res = await siswaAPI.store(fd);
            }
            onSuccess?.(res.data.message || 'Data siswa berhasil disimpan');
            onClose();
        } catch (err) {
            alert(err.response?.data?.message || err.message || 'Gagal menyimpan data');
        } finally {
            setSubmitting(false);
        }
    };

    if (!isOpen) return null;

    const isPindahan = form.jenis_pendaftaran === 'pindahan';
    const FieldText = ({ label, name, type = 'text', placeholder, required, optional, sm2 }) => (
        <div className={sm2 ? 'sm:col-span-2' : ''}>
            <label className="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">
                {label} {required && <span className="text-rose-400 normal-case">*</span>}
                {optional && <span className="text-slate-300 normal-case font-normal">(opsional)</span>}
            </label>
            {type === 'textarea' ? (
                <textarea value={form[name] || ''} onChange={e => update(name, e.target.value)}
                    placeholder={placeholder} rows={3}
                    className="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 outline-none text-sm text-slate-700 resize-none" />
            ) : (
                <input type={type} value={form[name] || ''} onChange={e => update(name, e.target.value)}
                    placeholder={placeholder}
                    className="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 outline-none text-sm text-slate-700" />
            )}
        </div>
    );
    const FieldSelect = ({ label, name, options, placeholder, required, optional, sm2 }) => (
        <div className={sm2 ? 'sm:col-span-2' : ''}>
            <label className="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">
                {label} {required && <span className="text-rose-400 normal-case">*</span>}
                {optional && <span className="text-slate-300 normal-case font-normal">(opsional)</span>}
            </label>
            <select value={form[name] || ''} onChange={e => update(name, e.target.value)}
                className="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 outline-none text-sm text-slate-700">
                {placeholder && <option value="">{placeholder}</option>}
                {Object.entries(options).map(([val, lbl]) => (
                    <option key={val} value={val}>{lbl}</option>
                ))}
            </select>
        </div>
    );

    const stepIndicator = (
        <div className="px-6 sm:px-10 pt-6 pb-4">
            <div className="relative max-w-2xl mx-auto">
                <div className="absolute top-5 left-5 right-5 h-[2px] bg-slate-100 z-0" />
                <div className="absolute top-5 left-5 h-[2px] bg-emerald-500 transition-all duration-500 z-0"
                    style={{ width: `${((step - 1) / (STEPS.length - 1)) * 100}%` }} />
                <div className="flex justify-between relative z-10">
                    {STEPS.map((s, i) => (
                        <div key={s} className="flex flex-col items-center gap-2">
                            <div className={`w-10 h-10 rounded-full flex items-center justify-center font-bold ring-4 ring-white transition-all text-sm ${
                                i + 1 === step ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/30' :
                                i + 1 < step ? 'bg-emerald-100 text-emerald-600' :
                                'bg-white border-2 border-slate-200 text-slate-400'
                            }`}>
                                {i + 1}
                            </div>
                            <span className={`text-[9px] font-black uppercase tracking-wider hidden sm:block ${i + 1 === step ? 'text-emerald-600' : 'text-slate-400'}`}>
                                {s}
                            </span>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );

    const stepNav = (current, max) => (
        <div className="flex justify-between items-center mt-6">
            {current > 1 ? (
                <button type="button" onClick={() => goToStep(current - 1)}
                    className="text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest flex items-center gap-1">
                    <ArrowLeft className="w-4 h-4" /> Kembali
                </button>
            ) : <div />}
            {current < max ? (
                <button type="button" onClick={() => goToStep(current + 1)}
                    className="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-lg shadow-emerald-500/30 active:scale-95 transition-all flex items-center gap-2">
                    Berikutnya <ArrowRight className="w-4 h-4" />
                </button>
            ) : null}
        </div>
    );

    return (
        <div className="fixed inset-0 z-[70] overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div className="flex min-h-full items-start sm:items-center justify-center p-2 sm:p-4 py-4">
                <div className="relative w-full max-w-5xl bg-white rounded-[1.5rem] sm:rounded-[2.5rem] shadow-2xl overflow-hidden">
                    {/* Header */}
                    <div className="flex items-center justify-between px-6 sm:px-10 pt-8 pb-0">
                        <div>
                            <h3 className="text-xl sm:text-2xl font-black text-slate-800 uppercase tracking-tighter">
                                MASTER DATA <span className="text-emerald-600">SISWA</span>
                            </h3>
                            <p className="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">
                                {isEdit ? 'Edit Informasi Peserta Didik' : 'Input Informasi Autentik Peserta Didik'}
                            </p>
                        </div>
                        <button onClick={onClose}
                            className="w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-slate-100 text-slate-500 rounded-full transition-all shrink-0 ml-4">
                            <X className="w-5 h-5" />
                        </button>
                    </div>

                    {stepIndicator}

                    {/* Form */}
                    <form onSubmit={e => { e.preventDefault(); handleSubmit(); }}>
                        <div className="flex flex-col lg:flex-row gap-6 px-6 sm:px-10 pb-10">
                            {/* Foto Upload */}
                            <div className="w-full lg:w-[200px] shrink-0">
                                <div className="w-full h-36 lg:h-auto lg:aspect-[3/4] rounded-[1.5rem] border-2 border-dashed border-slate-200 bg-slate-50/50 flex items-center justify-center relative overflow-hidden">
                                    {fotoPreview ? (
                                        <img src={fotoPreview} alt="Preview" className="absolute inset-0 w-full h-full object-cover" />
                                    ) : (
                                        <div className="flex flex-col items-center gap-2 px-4 text-center">
                                            <Camera className="w-10 h-10 text-slate-300" />
                                            <span className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Foto Siswa</span>
                                            <span className="text-[9px] text-slate-300">JPG/PNG, maks 2MB</span>
                                        </div>
                                    )}
                                    <input type="file" accept="image/jpeg,image/png,image/jpg"
                                        onChange={handleFotoChange}
                                        className="absolute inset-0 opacity-0 cursor-pointer z-[60]" />
                                </div>
                            </div>

                            {/* Steps Content */}
                            <div className="flex-1 min-w-0 overflow-hidden flex flex-col">
                                <div ref={sliderRef} className="flex transition-transform duration-700 ease-in-out" style={{ width: '500%' }}>

                                    {/* STEP 1: IDENTITAS */}
                                    <div className="flex flex-col justify-between pr-2" style={{ width: '20%' }}>
                                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2">
                                            <div className="sm:col-span-2 mb-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Jenis Pendaftaran <span className="normal-case font-normal">*</span>
                                                </p>
                                                <div className="flex items-center gap-4">
                                                    <label className="flex items-center gap-2 cursor-pointer">
                                                        <input type="radio" name="jenis_pendaftaran" value="baru"
                                                            checked={!isPindahan}
                                                            onChange={() => update('jenis_pendaftaran', 'baru')}
                                                            className="w-4 h-4 text-emerald-600 border-slate-300 focus:ring-emerald-500" />
                                                        <span className="text-sm font-bold text-slate-700">Siswa Baru (Kelas 1)</span>
                                                    </label>
                                                    <label className="flex items-center gap-2 cursor-pointer">
                                                        <input type="radio" name="jenis_pendaftaran" value="pindahan"
                                                            checked={isPindahan}
                                                            onChange={() => update('jenis_pendaftaran', 'pindahan')}
                                                            className="w-4 h-4 text-amber-500 border-slate-300 focus:ring-amber-500" />
                                                        <span className="text-sm font-bold text-slate-700">Siswa Pindahan (Mutasi)</span>
                                                    </label>
                                                </div>
                                            </div>

                                            {isPindahan && (
                                                <div className="sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4 bg-amber-50/50 p-4 rounded-2xl border border-amber-100 mb-2">
                                                    <div className="sm:col-span-2">
                                                        <p className="text-[10px] font-black uppercase tracking-widest text-amber-600 mb-3">Data Sekolah Asal & Mutasi</p>
                                                    </div>
                                                    <FieldText label="Asal Sekolah *" name="asal_sekolah" placeholder="SD/MI asal" required />
                                                    <FieldText label="NPSN Sekolah Asal" name="npsn_asal" placeholder="NPSN" optional />
                                                    <FieldText label="No. Surat Mutasi *" name="no_surat_mutasi" placeholder="Nomor surat pindah" required />
                                                    <FieldText label="Alasan Pindah *" name="alasan_mutasi" placeholder="Alasan pindah ke sekolah ini" required />
                                                </div>
                                            )}

                                            <FieldText label="NISN" name="nisn" placeholder="Nomor Induk Siswa Nasional" optional />
                                            <FieldText label="NIS (Lokal) *" name="nis" placeholder="Nomor Induk Sekolah" required />
                                            <FieldText label="Nama Lengkap *" name="nama" placeholder="Nama lengkap tanpa singkatan" sm2 required />
                                            <FieldText label="Tempat Lahir *" name="tempat_lahir" placeholder="Kota Lahir" required />
                                            <FieldText label="Tanggal Lahir *" name="tanggal_lahir" type="date" required />
                                            <FieldSelect label="Jenis Kelamin *" name="jenis_kelamin" required
                                                options={{ L: 'Laki-laki', P: 'Perempuan' }} />
                                            <FieldSelect label="Agama *" name="agama" required
                                                options={{ Islam: 'Islam', Kristen: 'Kristen', Katolik: 'Katolik', Hindu: 'Hindu', Budha: 'Budha', Khonghucu: 'Khonghucu' }} />
                                            <FieldSelect label="Kewarganegaraan" name="kewarganegaraan" optional
                                                options={{ WNI: 'WNI', WNA: 'WNA' }} />
                                            <FieldText label="No Registrasi Akta Kelahiran" name="no_registrasi_akta_kelahiran" placeholder="Nomor seri/registrasi" sm2 optional />
                                        </div>
                                        {stepNav(1, 5)}
                                    </div>

                                    {/* STEP 2: ORANG TUA */}
                                    <div className="flex flex-col justify-between pr-2" style={{ width: '20%' }}>
                                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2">
                                            <div className="sm:col-span-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Ayah <span className="normal-case font-normal">*</span></p>
                                            </div>
                                            <FieldText label="Nama Ayah" name="nama_ayah" placeholder="Nama lengkap ayah kandung" />
                                            <FieldText label="Pekerjaan Ayah" name="pekerjaan_ayah" placeholder="Contoh: Wiraswasta" />
                                            <FieldText label="NIK Ayah" name="nik_ayah" placeholder="16 digit NIK ayah" />
                                            <FieldText label="Tahun Lahir Ayah" name="tahun_lahir_ayah" type="number" placeholder="Contoh: 1975" />
                                            <FieldSelect label="Pendidikan Terakhir Ayah" name="pendidikan_ayah"
                                                options={{ 'Tidak Sekolah': 'Tidak Sekolah', 'SD / Sederajat': 'SD / Sederajat', 'SMP / Sederajat': 'SMP / Sederajat', 'SMA / Sederajat': 'SMA / Sederajat', D1: 'D1', D2: 'D2', D3: 'D3', 'D4 / S1': 'D4 / S1', S2: 'S2', S3: 'S3' }} />
                                            <FieldSelect label="Penghasilan Ayah" name="penghasilan_ayah"
                                                options={{
                                                    'Kurang dari Rp 500.000': 'Kurang dari Rp 500.000',
                                                    'Rp 500.000 - Rp 999.999': 'Rp 500.000 - Rp 999.999',
                                                    'Rp 1.000.000 - Rp 1.999.999': 'Rp 1.000.000 - Rp 1.999.999',
                                                    'Rp 2.000.000 - Rp 4.999.999': 'Rp 2.000.000 - Rp 4.999.999',
                                                    'Rp 5.000.000 - Rp 20.000.000': 'Rp 5.000.000 - Rp 20.000.000',
                                                    'Lebih dari Rp 20.000.000': 'Lebih dari Rp 20.000.000',
                                                    'Tidak Berpenghasilan': 'Tidak Berpenghasilan',
                                                }} />
                                            <FieldText label="Kebutuhan Khusus Ayah" name="kebutuhan_khusus_ayah" placeholder="Kosongkan jika tidak ada" />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Ibu <span className="normal-case font-normal">(opsional)</span></p>
                                            </div>
                                            <FieldText label="Nama Ibu" name="nama_ibu" placeholder="Nama lengkap ibu kandung" />
                                            <FieldText label="Pekerjaan Ibu" name="pekerjaan_ibu" placeholder="Contoh: Ibu Rumah Tangga" />
                                            <FieldText label="NIK Ibu" name="nik_ibu" placeholder="16 digit NIK ibu" />
                                            <FieldText label="Tahun Lahir Ibu" name="tahun_lahir_ibu" type="number" placeholder="Contoh: 1980" />
                                            <FieldSelect label="Pendidikan Terakhir Ibu" name="pendidikan_ibu"
                                                options={{ 'Tidak Sekolah': 'Tidak Sekolah', 'SD / Sederajat': 'SD / Sederajat', 'SMP / Sederajat': 'SMP / Sederajat', 'SMA / Sederajat': 'SMA / Sederajat', D1: 'D1', D2: 'D2', D3: 'D3', 'D4 / S1': 'D4 / S1', S2: 'S2', S3: 'S3' }} />
                                            <FieldSelect label="Penghasilan Ibu" name="penghasilan_ibu"
                                                options={{
                                                    'Kurang dari Rp 500.000': 'Kurang dari Rp 500.000',
                                                    'Rp 500.000 - Rp 999.999': 'Rp 500.000 - Rp 999.999',
                                                    'Rp 1.000.000 - Rp 1.999.999': 'Rp 1.000.000 - Rp 1.999.999',
                                                    'Rp 2.000.000 - Rp 4.999.999': 'Rp 2.000.000 - Rp 4.999.999',
                                                    'Rp 5.000.000 - Rp 20.000.000': 'Rp 5.000.000 - Rp 20.000.000',
                                                    'Lebih dari Rp 20.000.000': 'Lebih dari Rp 20.000.000',
                                                    'Tidak Berpenghasilan': 'Tidak Berpenghasilan',
                                                }} />
                                            <FieldText label="Kebutuhan Khusus Ibu" name="kebutuhan_khusus_ibu" placeholder="Kosongkan jika tidak ada" />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Kontak & Alamat</p>
                                            </div>
                                            <FieldText label="No HP Orang Tua *" name="no_hp_ortu" type="tel" placeholder="08xxxxxxxxxx" required />
                                            <FieldText label="Alamat Lengkap *" name="alamat" type="textarea" placeholder="Alamat domisili orang tua" sm2 required />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Data Wali <span className="normal-case font-normal">(isi jika yatim/piatu/merantau)</span>
                                                </p>
                                            </div>
                                            <div className="sm:col-span-2 bg-blue-50/50 p-4 rounded-2xl border border-blue-100">
                                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    <FieldText label="Nama Wali" name="nama_wali" placeholder="Nama lengkap wali" />
                                                    <FieldText label="Pekerjaan Wali" name="pekerjaan_wali" placeholder="Contoh: Wiraswasta" />
                                                    <FieldText label="NIK Wali" name="nik_wali" placeholder="16 digit NIK wali" />
                                                    <FieldText label="Tahun Lahir Wali" name="tahun_lahir_wali" type="number" placeholder="Contoh: 1980" />
                                                    <FieldSelect label="Penghasilan Wali" name="penghasilan_wali"
                                                        options={{
                                                            'Kurang dari Rp 500.000': 'Kurang dari Rp 500.000',
                                                            'Rp 500.000 - Rp 999.999': 'Rp 500.000 - Rp 999.999',
                                                            'Rp 1.000.000 - Rp 1.999.999': 'Rp 1.000.000 - Rp 1.999.999',
                                                            'Rp 2.000.000 - Rp 4.999.999': 'Rp 2.000.000 - Rp 4.999.999',
                                                            'Rp 5.000.000 - Rp 20.000.000': 'Rp 5.000.000 - Rp 20.000.000',
                                                            'Lebih dari Rp 20.000.000': 'Lebih dari Rp 20.000.000',
                                                            'Tidak Berpenghasilan': 'Tidak Berpenghasilan',
                                                        }} />
                                                    <FieldText label="No HP Wali" name="no_hp_wali" type="tel" placeholder="08xxxxxxxxxx" />
                                                    <FieldSelect label="Pendidikan Wali" name="pendidikan_wali"
                                                        options={{ 'Tidak Sekolah': 'Tidak Sekolah', 'SD / Sederajat': 'SD / Sederajat', 'SMP / Sederajat': 'SMP / Sederajat', 'SMA / Sederajat': 'SMA / Sederajat', D1: 'D1', D2: 'D2', D3: 'D3', 'D4 / S1': 'D4 / S1', S2: 'S2', S3: 'S3' }} />
                                                    <FieldText label="Alamat Wali" name="alamat_wali" type="textarea" placeholder="Alamat domisili wali" sm2 />
                                                </div>
                                            </div>
                                        </div>
                                        {stepNav(2, 5)}
                                    </div>

                                    {/* STEP 3: PERIODIK & DOMISILI */}
                                    <div className="flex flex-col justify-between pr-2" style={{ width: '20%' }}>
                                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2">
                                            <div className="sm:col-span-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Alamat Tempat Tinggal Siswa</p>
                                            </div>
                                            <FieldText label="Alamat Lengkap Siswa *" name="alamat_siswa" type="textarea" placeholder="Alamat tempat tinggal siswa saat ini" sm2 required />
                                            <FieldText label="RT" name="rt" placeholder="Contoh: 003" />
                                            <FieldText label="RW" name="rw" placeholder="Contoh: 005" />
                                            <FieldText label="Desa / Kelurahan *" name="kelurahan" placeholder="Nama kelurahan" required />
                                            <FieldText label="Kecamatan *" name="kecamatan" placeholder="Nama kecamatan" required />
                                            <FieldText label="Kode Pos" name="kode_pos" placeholder="Contoh: 12345" />
                                            <FieldText label="Lintang (Latitude)" name="lintang" type="number" placeholder="Contoh: -6.26000000" />
                                            <FieldText label="Bujur (Longitude)" name="bujur" type="number" placeholder="Contoh: 106.81000000" />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Keluarga</p>
                                            </div>
                                            <FieldText label="Anak Ke-" name="anak_ke" type="number" placeholder="Contoh: 2" />
                                            <FieldText label="Jumlah Saudara Kandung" name="jumlah_saudara" type="number" placeholder="Contoh: 3" />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Geografis ke Sekolah</p>
                                            </div>
                                            <FieldText label="Jarak ke Sekolah (km)" name="jarak_tempat_tinggal" type="number" placeholder="Contoh: 2.5" />
                                            <FieldText label="Waktu Tempuh (menit)" name="waktu_tempuh" type="number" placeholder="Contoh: 15" />
                                            <FieldSelect label="Moda Transportasi" name="moda_transportasi" sm2
                                                options={{
                                                    'Jalan Kaki': 'Jalan Kaki', Sepeda: 'Sepeda', 'Sepeda Motor': 'Sepeda Motor',
                                                    'Mobil Pribadi': 'Mobil Pribadi', 'Antar Jemput Sekolah': 'Antar Jemput Sekolah',
                                                    'Angkutan Umum': 'Angkutan Umum', 'Perahu / Sampan': 'Perahu / Sampan', Lainnya: 'Lainnya',
                                                }} />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Pendukung & Kontak Pribadi Siswa</p>
                                            </div>
                                            <FieldText label="Hobi" name="hobi" placeholder="Contoh: Membaca" />
                                            <FieldText label="Cita-cita" name="cita_cita" placeholder="Contoh: Dokter" />
                                            <FieldText label="No Telp Siswa" name="no_telp_siswa" type="tel" placeholder="Telepon rumah/pribadi" />
                                            <FieldText label="HP Siswa" name="hp_siswa" type="tel" placeholder="08xxxxxxxxxx" />
                                            <FieldText label="Email Siswa" name="email_siswa" type="email" placeholder="nama@email.com" sm2 />
                                        </div>
                                        {stepNav(3, 5)}
                                    </div>

                                    {/* STEP 4: AKADEMIK */}
                                    <div className="flex flex-col justify-between pr-2" style={{ width: '20%' }}>
                                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2">
                                            <FieldSelect label="Kelas" name="kelas_id" sm2 placeholder="-- Belum Ditentukan (Opsional) --"
                                                options={kelas.reduce((acc, k) => ({ ...acc, [k.id]: `Kelas ${k.full_name || k.nama}` }), {})} />
                                            <FieldSelect label="Tahun Ajaran *" name="tahun_ajaran_id" required placeholder="-- Pilih Tahun Ajaran --"
                                                options={tahunAjarans.reduce((acc, ta) => ({ ...acc, [ta.id]: `${ta.tahun}${ta.is_active ? ' (Aktif)' : ''}` }), {})} />
                                            <FieldSelect label="Status Siswa *" name="status" required placeholder="Pilih"
                                                options={{ aktif: 'Aktif', nonaktif: 'Non-Aktif', pindah: 'Pindah Sekolah', lulus: 'Lulus' }} />
                                            <FieldText label="NIK" name="nik" placeholder="16 digit NIK" />
                                            <FieldText label="No. Kartu Keluarga (KK)" name="no_kk" placeholder="16 digit No. KK" />
                                            <FieldText label="Tanggal Masuk *" name="tanggal_masuk" type="date" required />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Fisik & Kesehatan</p>
                                            </div>
                                            <FieldSelect label="Golongan Darah" name="golongan_darah" placeholder="Tidak Diketahui"
                                                options={{ A: 'A', B: 'B', AB: 'AB', O: 'O' }} />
                                            <FieldText label="Tinggi Badan (cm)" name="tinggi_badan" type="number" placeholder="Contoh: 125" />
                                            <FieldText label="Berat Badan (kg)" name="berat_badan" type="number" placeholder="Contoh: 25" />
                                            <FieldText label="Lingkar Kepala (cm)" name="lingkar_kepala" type="number" placeholder="Contoh: 51.5" />
                                            <FieldText label="Kebutuhan Khusus / ABK" name="kebutuhan_khusus" placeholder="Kosongkan jika tidak ada" sm2 />
                                            <FieldText label="Riwayat Penyakit" name="riwayat_penyakit" type="textarea" placeholder="Riwayat penyakit / alergi (opsional)" sm2 />
                                            <FieldText label="Catatan Kesehatan (Semester Ini)" name="catatan_kesehatan" type="textarea" placeholder="Kondisi kesehatan untuk semester ini..." sm2 />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Program Kesejahteraan</p>
                                            </div>
                                            <FieldSelect label="Penerima KPS/PKH" name="penerima_kps_pkh" options={{ '0': 'Tidak', '1': 'Ya' }} />
                                            <FieldText label="No KPS/PKH" name="no_kps_pkh" placeholder="Nomor kartu/program" />
                                            <FieldSelect label="Layak PIP" name="layak_pip" options={{ '0': 'Tidak', '1': 'Ya' }} />
                                            <FieldText label="Alasan Layak PIP" name="alasan_layak_pip" type="textarea" placeholder="Alasan kelayakan PIP" sm2 />
                                            <FieldSelect label="Penerima KIP" name="penerima_kip" options={{ '0': 'Tidak', '1': 'Ya' }} />
                                            <FieldText label="No KIP" name="no_kip" placeholder="Nomor KIP" />
                                            <FieldText label="Nama Tertera di KIP" name="nama_tertera_di_kip" placeholder="Nama sesuai kartu KIP" sm2 />
                                        </div>
                                        {stepNav(4, 5)}
                                    </div>

                                    {/* STEP 5: KONFIRMASI */}
                                    <div className="flex flex-col justify-between pr-2" style={{ width: '20%' }}>
                                        <div className="space-y-4 overflow-y-auto max-h-[55vh] pr-2">
                                            <div className="bg-emerald-50 border border-emerald-200 rounded-2xl p-4">
                                                <p className="text-xs font-bold text-emerald-700 flex items-center gap-2 mb-1">
                                                    <CheckCircle className="w-3.5 h-3.5" /> Konfirmasi Data Siswa
                                                </p>
                                                <p className="text-[11px] text-emerald-600/80">Periksa kembali sebelum menyimpan. Data dapat diedit kembali.</p>
                                            </div>

                                            {/* Ringkasan Identitas */}
                                            <div className="rounded-2xl border border-slate-100 overflow-hidden">
                                                <div className="bg-slate-50 px-4 py-2.5 border-b border-slate-100">
                                                    <p className="text-[10px] font-black uppercase tracking-widest text-slate-500">Identitas Siswa</p>
                                                </div>
                                                <div className="p-4 grid grid-cols-2 gap-3">
                                                    <ReviewItem label="Nama Lengkap" value={form.nama} />
                                                    <ReviewItem label="NISN / NIS" value={`${form.nisn || '—'} / ${form.nis || '—'}`} />
                                                    <ReviewItem label="Tempat, Tgl Lahir" value={`${form.tempat_lahir}, ${form.tanggal_lahir}`} />
                                                    <ReviewItem label="Jenis Kelamin" value={form.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'} />
                                                </div>
                                            </div>

                                            {/* Ringkasan Orang Tua */}
                                            <div className="rounded-2xl border border-slate-100 overflow-hidden">
                                                <div className="bg-slate-50 px-4 py-2.5 border-b border-slate-100">
                                                    <p className="text-[10px] font-black uppercase tracking-widest text-slate-500">Data Orang Tua</p>
                                                </div>
                                                <div className="p-4 grid grid-cols-2 gap-3">
                                                    <ReviewItem label="Ayah" value={form.nama_ayah || '—'} />
                                                    <ReviewItem label="Ibu" value={form.nama_ibu || '—'} />
                                                    <ReviewItem label="Pendidikan Ayah" value={form.pendidikan_ayah || '—'} />
                                                    <ReviewItem label="Pendidikan Ibu" value={form.pendidikan_ibu || '—'} />
                                                    <ReviewItem label="No HP" value={form.no_hp_ortu || '—'} sm2 />
                                                </div>
                                            </div>

                                            {/* Ringkasan Domisili */}
                                            <div className="rounded-2xl border border-slate-100 overflow-hidden">
                                                <div className="bg-slate-50 px-4 py-2.5 border-b border-slate-100">
                                                    <p className="text-[10px] font-black uppercase tracking-widest text-slate-500">Domisili & Periodik</p>
                                                </div>
                                                <div className="p-4 grid grid-cols-2 gap-3">
                                                    <ReviewItem label="Alamat Siswa" value={form.alamat_siswa || '—'} sm2 />
                                                    <ReviewItem label="Kelurahan" value={form.kelurahan || '—'} />
                                                    <ReviewItem label="Kecamatan" value={form.kecamatan || '—'} />
                                                    <ReviewItem label="Anak Ke / Saudara" value={[form.anak_ke, form.jumlah_saudara].filter(Boolean).join(' / ') || '—'} />
                                                    <ReviewItem label="Transportasi" value={form.moda_transportasi || '—'} />
                                                    <ReviewItem label="Hobi / Cita-cita" value={[form.hobi, form.cita_cita].filter(Boolean).join(' / ') || '—'} />
                                                </div>
                                            </div>

                                            {/* Ringkasan Akademik */}
                                            <div className="rounded-2xl border border-slate-100 overflow-hidden">
                                                <div className="bg-slate-50 px-4 py-2.5 border-b border-slate-100">
                                                    <p className="text-[10px] font-black uppercase tracking-widest text-slate-500">Data Akademik</p>
                                                </div>
                                                <div className="p-4 grid grid-cols-2 gap-3">
                                                    <ReviewItem label="Kelas" value={kelas.find(k => k.id == form.kelas_id)?.full_name || kelas.find(k => k.id == form.kelas_id)?.nama || '—'} />
                                                    <ReviewItem label="Status" value={form.status || '—'} />
                                                    <ReviewItem label="Tahun Ajaran" value={tahunAjarans.find(ta => ta.id == form.tahun_ajaran_id)?.tahun || '—'} />
                                                    <ReviewItem label="Tgl Masuk" value={form.tanggal_masuk || '—'} />
                                                </div>
                                            </div>

                                            <div className="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start gap-2">
                                                <Info className="w-4 h-4 text-amber-500 shrink-0 mt-0.5" />
                                                <p className="text-[11px] text-amber-700">Pastikan data yang diinput sudah benar. Data dapat diedit kembali setelah disimpan.</p>
                                            </div>
                                        </div>

                                        <div className="flex justify-between items-center mt-6">
                                            <button type="button" onClick={() => goToStep(4)}
                                                className="text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest flex items-center gap-1">
                                                <ArrowLeft className="w-4 h-4" /> Kembali
                                            </button>
                                            <button type="submit" disabled={submitting}
                                                className="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-lg shadow-emerald-500/30 active:scale-95 transition-all flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                                                {submitting ? (
                                                    <span className="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin" />
                                                ) : <Save className="w-4 h-4" />}
                                                {submitting ? 'Menyimpan...' : 'Simpan Data'}
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
};

const ReviewItem = ({ label, value, sm2 }) => (
    <div className={sm2 ? 'col-span-2' : ''}>
        <p className="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{label}</p>
        <p className="text-sm font-bold text-slate-700 mt-0.5">{value || '—'}</p>
    </div>
);

export default ModalFormSiswa;
