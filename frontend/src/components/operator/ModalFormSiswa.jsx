import React, { useState, useEffect, useRef, useCallback } from 'react';
import { X, Camera, ArrowLeft, ArrowRight, Save, CheckCircle, Info, AlertTriangle, Upload } from 'lucide-react';
import { siswaAPI } from '../../api/operator';

const STEPS = ['Identitas', 'Orang Tua', 'Periodik', 'Akademik', 'Konfirmasi'];

const INIT_FORM = {
    jenis_pendaftaran: 'baru', nisn: '', nis: '', nama: '', tempat_lahir: '', tanggal_lahir: '',
    jenis_kelamin: 'L', agama: 'Islam', kewarganegaraan: 'WNI', no_registrasi_akta_kelahiran: '',
    asal_sekolah: '', npsn_asal: '', no_surat_mutasi: '', alasan_mutasi: '',
    nama_ayah: '', pekerjaan_ayah: '', nik_ayah: '', tahun_lahir_ayah: '', pendidikan_ayah: '', penghasilan_ayah: '', kebutuhan_khusus_ayah: '',
    status_ayah: '', kewarganegaraan_ayah: '', tempat_lahir_ayah: '', no_hp_ayah: '',
    nama_ibu: '', pekerjaan_ibu: '', nik_ibu: '', tahun_lahir_ibu: '', pendidikan_ibu: '', penghasilan_ibu: '', kebutuhan_khusus_ibu: '',
    status_ibu: '', kewarganegaraan_ibu: '', tempat_lahir_ibu: '', no_hp_ibu: '',
    nama_wali: '', pekerjaan_wali: '', nik_wali: '', tahun_lahir_wali: '', penghasilan_wali: '', no_hp_wali: '', pendidikan_wali: '', alamat_wali: '',
    status_wali: '', kewarganegaraan_wali: '', tempat_lahir_wali: '',
    no_hp_ortu: '', alamat: '',
    alamat_siswa: '', rt: '', rw: '', kelurahan: '', kecamatan: '', kode_pos: '', lintang: '', bujur: '',
    anak_ke: '', jumlah_saudara: '', jarak_tempat_tinggal: '', waktu_tempuh: '', moda_transportasi: '',
    hobi: '', cita_cita: '', no_telp_siswa: '', hp_siswa: '', email_siswa: '',
    kelas_id: '', kelas_pararel: '', no_absen: '', tahun_ajaran_id: '', status: 'aktif', nik: '', no_kk: '', tanggal_masuk: '',
    nama_kepala_keluarga: '', pembiaya_sekolah: '', imunisasi: '',
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
    const [stepErrors, setStepErrors] = useState({});
    const [touchSteps, setTouchSteps] = useState({});
    const sliderRef = useRef(null);
    const isEdit = !!siswa;

    useEffect(() => {
        if (!isOpen) return;
        if (siswa) {
            const o = siswa.orang_tua || {};
            setForm({
                jenis_pendaftaran: siswa.jenis_pendaftaran || 'baru',
                nisn: siswa.nisn || '', nis: siswa.nis || '', nama: siswa.nama || '',
                tempat_lahir: siswa.tempat_lahir || '', tanggal_lahir: siswa.tanggal_lahir || '',
                jenis_kelamin: siswa.jenis_kelamin || 'L', agama: siswa.agama || 'Islam',
                kewarganegaraan: siswa.kewarganegaraan || 'WNI', no_registrasi_akta_kelahiran: siswa.no_registrasi_akta_kelahiran || '',
                asal_sekolah: siswa.asal_sekolah || '', npsn_asal: siswa.npsn_asal || '', no_surat_mutasi: siswa.no_surat_mutasi || '',
                alasan_mutasi: siswa.alasan_mutasi || '',
                nama_ayah: siswa.nama_ayah || o?.nama_ayah || '',
                pekerjaan_ayah: siswa.pekerjaan_ayah || o?.pekerjaan_ayah || '',
                nik_ayah: siswa.nik_ayah || o?.nik_ayah || '',
                tahun_lahir_ayah: siswa.tahun_lahir_ayah || o?.tahun_lahir_ayah || '',
                pendidikan_ayah: siswa.pendidikan_ayah || o?.pendidikan_ayah || '',
                penghasilan_ayah: siswa.penghasilan_ayah || o?.penghasilan_ayah || '',
                kebutuhan_khusus_ayah: siswa.kebutuhan_khusus_ayah || o?.kebutuhan_khusus_ayah || '',
                status_ayah: siswa.status_ayah || o?.status_ayah || '',
                kewarganegaraan_ayah: siswa.kewarganegaraan_ayah || o?.kewarganegaraan_ayah || '',
                tempat_lahir_ayah: siswa.tempat_lahir_ayah || o?.tempat_lahir_ayah || '',
                no_hp_ayah: siswa.no_hp_ayah || o?.no_hp_ayah || '',
                nama_ibu: siswa.nama_ibu || o?.nama_ibu || '',
                pekerjaan_ibu: siswa.pekerjaan_ibu || o?.pekerjaan_ibu || '',
                nik_ibu: siswa.nik_ibu || o?.nik_ibu || '',
                tahun_lahir_ibu: siswa.tahun_lahir_ibu || o?.tahun_lahir_ibu || '',
                pendidikan_ibu: siswa.pendidikan_ibu || o?.pendidikan_ibu || '',
                penghasilan_ibu: siswa.penghasilan_ibu || o?.penghasilan_ibu || '',
                kebutuhan_khusus_ibu: siswa.kebutuhan_khusus_ibu || o?.kebutuhan_khusus_ibu || '',
                status_ibu: siswa.status_ibu || o?.status_ibu || '',
                kewarganegaraan_ibu: siswa.kewarganegaraan_ibu || o?.kewarganegaraan_ibu || '',
                tempat_lahir_ibu: siswa.tempat_lahir_ibu || o?.tempat_lahir_ibu || '',
                no_hp_ibu: siswa.no_hp_ibu || o?.no_hp_ibu || '',
                no_hp_ortu: siswa.no_hp_ortu || o?.no_hp || '',
                alamat: siswa.alamat || o?.alamat || '',
                nama_wali: siswa.nama_wali || '', pekerjaan_wali: siswa.pekerjaan_wali || '',
                nik_wali: siswa.nik_wali || '', tahun_lahir_wali: siswa.tahun_lahir_wali || '',
                penghasilan_wali: siswa.penghasilan_wali || '', no_hp_wali: siswa.no_hp_wali || '',
                pendidikan_wali: siswa.pendidikan_wali || '', alamat_wali: siswa.alamat_wali || '',
                status_wali: siswa.status_wali || '', kewarganegaraan_wali: siswa.kewarganegaraan_wali || '',
                tempat_lahir_wali: siswa.tempat_lahir_wali || '',
                alamat_siswa: siswa.alamat_siswa || '', rt: siswa.rt || '', rw: siswa.rw || '',
                kelurahan: siswa.kelurahan || '', kecamatan: siswa.kecamatan || '',
                kode_pos: siswa.kode_pos || '', lintang: siswa.lintang || '', bujur: siswa.bujur || '',
                anak_ke: siswa.anak_ke || '', jumlah_saudara: siswa.jumlah_saudara || '',
                jarak_tempat_tinggal: siswa.jarak_tempat_tinggal || '', waktu_tempuh: siswa.waktu_tempuh || '',
                moda_transportasi: siswa.moda_transportasi || '',
                hobi: siswa.hobi || '', cita_cita: siswa.cita_cita || '',
                no_telp_siswa: siswa.no_telp_siswa || '', hp_siswa: siswa.hp_siswa || '',
                email_siswa: siswa.email_siswa || '',
                kelas_id: siswa.kelas_id || '', kelas_pararel: siswa.kelas_pararel || '', no_absen: siswa.no_absen || '',
                tahun_ajaran_id: siswa.tahun_ajaran_id || '',
                status: siswa.status || 'aktif', nik: siswa.nik || '', no_kk: siswa.no_kk || '',
                tanggal_masuk: siswa.tanggal_masuk || '',
                nama_kepala_keluarga: siswa.nama_kepala_keluarga || o?.nama_kepala_keluarga || '',
                pembiaya_sekolah: siswa.pembiaya_sekolah || '', imunisasi: siswa.imunisasi || '',
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
        setStepErrors({});
        setTouchSteps({});
    }, [isOpen, siswa]);

    const update = (key, val) => setForm(prev => ({ ...prev, [key]: val }));

    const handleFotoChange = (e) => {
        const file = e.target.files?.[0];
        if (file) {
            setFotoFile(file);
            setFotoPreview(URL.createObjectURL(file));
        }
    };

    const validateStep = (s) => {
        const f = form;
        const errs = [];

        const isDigit = v => /^\d+$/.test(v);
        const isFutureDate = d => d && new Date(d) > new Date(new Date().toDateString());
        const isNotValidDate = d => d && isNaN(new Date(d).getTime());

        if (s === 1) {
            if (!f.nama?.trim()) errs.push('Nama lengkap wajib diisi');
            if (!f.tempat_lahir?.trim()) errs.push('Tempat lahir wajib diisi');
            if (!f.tanggal_lahir) {
                errs.push('Tanggal lahir wajib diisi');
            } else {
                if (isNotValidDate(f.tanggal_lahir)) errs.push('Format tanggal lahir tidak valid');
                if (isFutureDate(f.tanggal_lahir)) errs.push('Tanggal lahir tidak boleh di masa depan');
            }
            if (!f.nis?.trim()) errs.push('NIS wajib diisi');
            if (f.jenis_kelamin !== 'L' && f.jenis_kelamin !== 'P') errs.push('Jenis kelamin tidak valid');
            if (!f.nisn?.trim() && !f.no_registrasi_akta_kelahiran?.trim()) {
                errs.push('NISN atau No Registrasi Akta Kelahiran wajib diisi');
            }
            if (f.nisn?.trim()) {
                if (!isDigit(f.nisn)) errs.push('NISN harus berupa angka');
                else if (f.nisn.length !== 10) errs.push('NISN harus 10 digit');
            }
            if (f.no_registrasi_akta_kelahiran?.trim() && !/^[\w\/-]+$/.test(f.no_registrasi_akta_kelahiran)) {
                errs.push('No Registrasi Akta Kelahiran tidak valid');
            }
            if (f.nik?.trim()) {
                if (!isDigit(f.nik)) errs.push('NIK harus berupa angka');
                else if (f.nik.length !== 16) errs.push('NIK harus 16 digit');
            }
            if (f.no_kk?.trim()) {
                if (!isDigit(f.no_kk)) errs.push('No KK harus berupa angka');
                else if (f.no_kk.length !== 16) errs.push('No KK harus 16 digit');
            }
            if (f.jenis_pendaftaran === 'pindahan') {
                if (!f.asal_sekolah?.trim()) errs.push('Asal sekolah wajib diisi');
                if (!f.no_surat_mutasi?.trim()) errs.push('No surat mutasi wajib diisi');
                if (!f.alasan_mutasi?.trim()) errs.push('Alasan pindah wajib diisi');
            }
        } else if (s === 2) {
            if (!f.nama_ayah?.trim()) errs.push('Nama ayah wajib diisi');
            if (f.nik_ayah?.trim()) {
                if (!isDigit(f.nik_ayah)) errs.push('NIK ayah harus berupa angka');
                else if (f.nik_ayah.length !== 16) errs.push('NIK ayah harus 16 digit');
            }
            if (f.no_hp_ayah?.trim() && !isDigit(f.no_hp_ayah)) errs.push('No HP ayah harus berupa angka');
            if (f.nik_ibu?.trim()) {
                if (!isDigit(f.nik_ibu)) errs.push('NIK ibu harus berupa angka');
                else if (f.nik_ibu.length !== 16) errs.push('NIK ibu harus 16 digit');
            }
            if (f.no_hp_ibu?.trim() && !isDigit(f.no_hp_ibu)) errs.push('No HP ibu harus berupa angka');
            if (f.nik_wali?.trim()) {
                if (!isDigit(f.nik_wali)) errs.push('NIK wali harus berupa angka');
                else if (f.nik_wali.length !== 16) errs.push('NIK wali harus 16 digit');
            }
            if (f.no_hp_wali?.trim() && !isDigit(f.no_hp_wali)) errs.push('No HP wali harus berupa angka');
            if (!f.no_hp_ortu?.trim()) errs.push('No HP orang tua wajib diisi');
            else if (!isDigit(f.no_hp_ortu)) errs.push('No HP orang tua harus berupa angka');
            if (!f.alamat?.trim()) errs.push('Alamat orang tua wajib diisi');
        } else if (s === 3) {
            if (!f.alamat_siswa?.trim()) errs.push('Alamat siswa wajib diisi');
            if (!f.kelurahan?.trim()) errs.push('Kelurahan wajib diisi');
            if (!f.kecamatan?.trim()) errs.push('Kecamatan wajib diisi');
            if (f.rt?.trim() && !isDigit(f.rt)) errs.push('RT harus berupa angka');
            if (f.rw?.trim() && !isDigit(f.rw)) errs.push('RW harus berupa angka');
            if (f.kode_pos?.trim() && !isDigit(f.kode_pos)) errs.push('Kode pos harus berupa angka');
            if (f.anak_ke?.trim() && !isDigit(f.anak_ke)) errs.push('Anak ke harus berupa angka');
            if (f.jumlah_saudara?.trim() && !isDigit(f.jumlah_saudara)) errs.push('Jumlah saudara harus berupa angka');
            if (f.tinggi_badan?.trim()) {
                const t = parseFloat(f.tinggi_badan);
                if (isNaN(t)) errs.push('Tinggi badan harus berupa angka');
                else if (t < 20 || t > 250) errs.push('Tinggi badan tidak masuk akal (20-250 cm)');
            }
            if (f.berat_badan?.trim()) {
                const b = parseFloat(f.berat_badan);
                if (isNaN(b)) errs.push('Berat badan harus berupa angka');
                else if (b < 2 || b > 300) errs.push('Berat badan tidak masuk akal (2-300 kg)');
            }
            if (f.lingkar_kepala?.trim()) {
                const lk = parseFloat(f.lingkar_kepala);
                if (isNaN(lk)) errs.push('Lingkar kepala harus berupa angka');
                else if (lk < 20 || lk > 80) errs.push('Lingkar kepala tidak masuk akal (20-80 cm)');
            }
            if (f.no_telp_siswa?.trim() && !isDigit(f.no_telp_siswa)) errs.push('No telepon siswa harus berupa angka');
            if (f.hp_siswa?.trim() && !isDigit(f.hp_siswa)) errs.push('No HP siswa harus berupa angka');
            if (f.email_siswa?.trim() && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(f.email_siswa)) {
                errs.push('Format email siswa tidak valid');
            }
        } else if (s === 4) {
            if (!f.tahun_ajaran_id) errs.push('Tahun ajaran wajib dipilih');
            if (!f.tanggal_masuk) {
                errs.push('Tanggal masuk wajib diisi');
            } else {
                if (isNotValidDate(f.tanggal_masuk)) errs.push('Format tanggal masuk tidak valid');
                if (isFutureDate(f.tanggal_masuk)) errs.push('Tanggal masuk tidak boleh di masa depan');
            }
        }

        setStepErrors(prev => ({ ...prev, [s]: errs }));
        setTouchSteps(prev => ({ ...prev, [s]: true }));
        return errs.length === 0;
    };

    const goToStep = (target) => {
        if (target < 1 || target > 5) return;
        const direction = target > step;
        if (direction) {
            if (!validateStep(step)) return;
        }
        setStep(target);
        if (sliderRef.current) {
            sliderRef.current.style.transform = `translateX(-${(target - 1) * 20}%)`;
        }
    };

    const apiUrl = import.meta.env.VITE_API_URL?.replace('/api', '') || 'http://localhost:8000';

    const handleSubmit = async () => {
        if (!validateStep(4)) {
            setStep(4);
            return;
        }
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

    const stepIndicator = (
        <div className="px-6 sm:px-10 pt-6 pb-4">
            <div className="relative max-w-2xl mx-auto">
                <div className="absolute top-5 left-5 right-5 h-[2px] bg-slate-100 z-0" />
                <div className="absolute top-5 left-5 h-[2px] bg-emerald-500 transition-all duration-500 z-0"
                    style={{ width: `${((step - 1) / (STEPS.length - 1)) * 100}%` }} />
                <div className="flex justify-between relative z-10">
                    {STEPS.map((s, i) => {
                        const n = i + 1;
                        const hasErr = touchSteps[n] && stepErrors[n]?.length > 0;
                        return (
                            <div key={s} className="flex flex-col items-center gap-2">
                                <div className={`w-10 h-10 rounded-full flex items-center justify-center font-bold ring-4 ring-white transition-all text-sm ${
                                    hasErr ? 'bg-rose-500 text-white shadow-lg shadow-rose-500/30' :
                                    n === step ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/30' :
                                    n < step ? 'bg-emerald-100 text-emerald-600' :
                                    'bg-white border-2 border-slate-200 text-slate-400'
                                }`}>
                                    {hasErr ? '!' : n}
                                </div>
                                <span className={`text-[9px] font-black uppercase tracking-wider hidden sm:block ${hasErr ? 'text-rose-500' : n === step ? 'text-emerald-600' : 'text-slate-400'}`}>
                                    {s}
                                </span>
                            </div>
                        );
                    })}
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
                                                    <FieldText form={form} update={update} label="Asal Sekolah *" name="asal_sekolah" placeholder="SD/MI asal" required />
                                                    <FieldText form={form} update={update} label="NPSN Sekolah Asal" name="npsn_asal" placeholder="NPSN" optional />
                                                    <FieldText form={form} update={update} label="No. Surat Mutasi *" name="no_surat_mutasi" placeholder="Nomor surat pindah" required />
                                                    <FieldText form={form} update={update} label="Alasan Pindah *" name="alasan_mutasi" placeholder="Alasan pindah ke sekolah ini" required />
                                                </div>
                                            )}

                                            <FieldText form={form} update={update} label="NISN" name="nisn" placeholder="Nomor Induk Siswa Nasional" optional />
                                            <FieldText form={form} update={update} label="NIS (Lokal) *" name="nis" placeholder="Nomor Induk Sekolah" required />
                                            <FieldText form={form} update={update} label="Nama Lengkap *" name="nama" placeholder="Nama lengkap tanpa singkatan" sm2 required />
                                            <FieldText form={form} update={update} label="Tempat Lahir *" name="tempat_lahir" placeholder="Kota Lahir" required />
                                            <FieldText form={form} update={update} label="Tanggal Lahir *" name="tanggal_lahir" type="date" required />
                                            <FieldSelect form={form} update={update} label="Jenis Kelamin *" name="jenis_kelamin" required
                                                options={{ L: 'Laki-laki', P: 'Perempuan' }} />
                                            <FieldSelect form={form} update={update} label="Agama *" name="agama" required
                                                options={{ Islam: 'Islam', Kristen: 'Kristen', Katolik: 'Katolik', Hindu: 'Hindu', Budha: 'Budha', Khonghucu: 'Khonghucu' }} />
                                            <FieldSelect form={form} update={update} label="Kewarganegaraan" name="kewarganegaraan" optional
                                                options={{ WNI: 'WNI', WNA: 'WNA' }} />
                                            <FieldText form={form} update={update} label="No Registrasi Akta Kelahiran" name="no_registrasi_akta_kelahiran" placeholder="Nomor seri/registrasi" sm2 optional />
                                            <FieldText form={form} update={update} label="No Absen" name="no_absen" placeholder="Nomor urut absen kelas" optional />
                                            <FieldSelect form={form} update={update} label="Yang Membiayai Sekolah" name="pembiaya_sekolah" optional
                                                options={{ 'Orang Tua': 'Orang Tua', 'Wali': 'Wali', 'Pemerintah': 'Pemerintah', 'Swasta': 'Swasta', 'Lainnya': 'Lainnya' }} />
                                        </div>
                                        <StepErrors errors={stepErrors[1]} />
                                        {stepNav(1, 5)}
                                    </div>
 
                                    {/* STEP 2: ORANG TUA */}
                                    <div className="flex flex-col justify-between pr-2" style={{ width: '20%' }}>
                                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2">
                                            <div className="sm:col-span-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Ayah <span className="normal-case font-normal">*</span></p>
                                            </div>
                                            <FieldText form={form} update={update} label="Nama Ayah" name="nama_ayah" placeholder="Nama lengkap ayah kandung" />
                                            <FieldText form={form} update={update} label="Pekerjaan Ayah" name="pekerjaan_ayah" placeholder="Contoh: Wiraswasta" />
                                            <FieldText form={form} update={update} label="NIK Ayah" name="nik_ayah" placeholder="16 digit NIK ayah" />
                                            <FieldText form={form} update={update} label="Tahun Lahir Ayah" name="tahun_lahir_ayah" type="number" placeholder="Contoh: 1975" />
                                            <FieldSelect form={form} update={update} label="Pendidikan Terakhir Ayah" name="pendidikan_ayah"
                                                options={{ 'Tidak Sekolah': 'Tidak Sekolah', 'SD / Sederajat': 'SD / Sederajat', 'SMP / Sederajat': 'SMP / Sederajat', 'SMA / Sederajat': 'SMA / Sederajat', D1: 'D1', D2: 'D2', D3: 'D3', 'D4 / S1': 'D4 / S1', S2: 'S2', S3: 'S3' }} />
                                            <FieldSelect form={form} update={update} label="Penghasilan Ayah" name="penghasilan_ayah"
                                                options={{
                                                    'Kurang dari Rp 500.000': 'Kurang dari Rp 500.000',
                                                    'Rp 500.000 - Rp 999.999': 'Rp 500.000 - Rp 999.999',
                                                    'Rp 1.000.000 - Rp 1.999.999': 'Rp 1.000.000 - Rp 1.999.999',
                                                    'Rp 2.000.000 - Rp 4.999.999': 'Rp 2.000.000 - Rp 4.999.999',
                                                    'Rp 5.000.000 - Rp 20.000.000': 'Rp 5.000.000 - Rp 20.000.000',
                                                    'Lebih dari Rp 20.000.000': 'Lebih dari Rp 20.000.000',
                                                    'Tidak Berpenghasilan': 'Tidak Berpenghasilan',
                                                }} />
                                            <FieldText form={form} update={update} label="Kebutuhan Khusus Ayah" name="kebutuhan_khusus_ayah" placeholder="Kosongkan jika tidak ada" />
                                            <FieldSelect form={form} update={update} label="Status Ayah" name="status_ayah" optional
                                                options={{ 'Hidup': 'Hidup', 'Meninggal': 'Meninggal', 'Cerai Hidup': 'Cerai Hidup', 'Cerai Mati': 'Cerai Mati' }} />
                                            <FieldSelect form={form} update={update} label="Kewarganegaraan Ayah" name="kewarganegaraan_ayah" optional
                                                options={{ WNI: 'WNI', WNA: 'WNA' }} />
                                            <FieldText form={form} update={update} label="Tempat Lahir Ayah" name="tempat_lahir_ayah" placeholder="Kota lahir ayah" optional />
                                            <FieldText form={form} update={update} label="No HP Ayah" name="no_hp_ayah" type="tel" placeholder="08xxxxxxxxxx" optional />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Ibu <span className="normal-case font-normal">(opsional)</span></p>
                                            </div>
                                            <FieldText form={form} update={update} label="Nama Ibu" name="nama_ibu" placeholder="Nama lengkap ibu kandung" />
                                            <FieldText form={form} update={update} label="Pekerjaan Ibu" name="pekerjaan_ibu" placeholder="Contoh: Ibu Rumah Tangga" />
                                            <FieldText form={form} update={update} label="NIK Ibu" name="nik_ibu" placeholder="16 digit NIK ibu" />
                                            <FieldText form={form} update={update} label="Tahun Lahir Ibu" name="tahun_lahir_ibu" type="number" placeholder="Contoh: 1980" />
                                            <FieldSelect form={form} update={update} label="Pendidikan Terakhir Ibu" name="pendidikan_ibu"
                                                options={{ 'Tidak Sekolah': 'Tidak Sekolah', 'SD / Sederajat': 'SD / Sederajat', 'SMP / Sederajat': 'SMP / Sederajat', 'SMA / Sederajat': 'SMA / Sederajat', D1: 'D1', D2: 'D2', D3: 'D3', 'D4 / S1': 'D4 / S1', S2: 'S2', S3: 'S3' }} />
                                            <FieldSelect form={form} update={update} label="Penghasilan Ibu" name="penghasilan_ibu"
                                                options={{
                                                    'Kurang dari Rp 500.000': 'Kurang dari Rp 500.000',
                                                    'Rp 500.000 - Rp 999.999': 'Rp 500.000 - Rp 999.999',
                                                    'Rp 1.000.000 - Rp 1.999.999': 'Rp 1.000.000 - Rp 1.999.999',
                                                    'Rp 2.000.000 - Rp 4.999.999': 'Rp 2.000.000 - Rp 4.999.999',
                                                    'Rp 5.000.000 - Rp 20.000.000': 'Rp 5.000.000 - Rp 20.000.000',
                                                    'Lebih dari Rp 20.000.000': 'Lebih dari Rp 20.000.000',
                                                    'Tidak Berpenghasilan': 'Tidak Berpenghasilan',
                                                }} />
                                            <FieldText form={form} update={update} label="Kebutuhan Khusus Ibu" name="kebutuhan_khusus_ibu" placeholder="Kosongkan jika tidak ada" />
                                            <FieldSelect form={form} update={update} label="Status Ibu" name="status_ibu" optional
                                                options={{ 'Hidup': 'Hidup', 'Meninggal': 'Meninggal', 'Cerai Hidup': 'Cerai Hidup', 'Cerai Mati': 'Cerai Mati' }} />
                                            <FieldSelect form={form} update={update} label="Kewarganegaraan Ibu" name="kewarganegaraan_ibu" optional
                                                options={{ WNI: 'WNI', WNA: 'WNA' }} />
                                            <FieldText form={form} update={update} label="Tempat Lahir Ibu" name="tempat_lahir_ibu" placeholder="Kota lahir ibu" optional />
                                            <FieldText form={form} update={update} label="No HP Ibu" name="no_hp_ibu" type="tel" placeholder="08xxxxxxxxxx" optional />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Kontak & Alamat</p>
                                            </div>
                                            <FieldText form={form} update={update} label="No HP Orang Tua *" name="no_hp_ortu" type="tel" placeholder="08xxxxxxxxxx" required />
                                            <FieldText form={form} update={update} label="Alamat Lengkap *" name="alamat" type="textarea" placeholder="Alamat domisili orang tua" sm2 required />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Data Wali <span className="normal-case font-normal">(isi jika yatim/piatu/merantau)</span>
                                                </p>
                                            </div>
                                            <div className="sm:col-span-2 bg-blue-50/50 p-4 rounded-2xl border border-blue-100">
                                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    <FieldText form={form} update={update} label="Nama Wali" name="nama_wali" placeholder="Nama lengkap wali" />
                                                    <FieldText form={form} update={update} label="Pekerjaan Wali" name="pekerjaan_wali" placeholder="Contoh: Wiraswasta" />
                                                    <FieldText form={form} update={update} label="NIK Wali" name="nik_wali" placeholder="16 digit NIK wali" />
                                                    <FieldText form={form} update={update} label="Tahun Lahir Wali" name="tahun_lahir_wali" type="number" placeholder="Contoh: 1980" />
                                                    <FieldSelect form={form} update={update} label="Penghasilan Wali" name="penghasilan_wali"
                                                        options={{
                                                            'Kurang dari Rp 500.000': 'Kurang dari Rp 500.000',
                                                            'Rp 500.000 - Rp 999.999': 'Rp 500.000 - Rp 999.999',
                                                            'Rp 1.000.000 - Rp 1.999.999': 'Rp 1.000.000 - Rp 1.999.999',
                                                            'Rp 2.000.000 - Rp 4.999.999': 'Rp 2.000.000 - Rp 4.999.999',
                                                            'Rp 5.000.000 - Rp 20.000.000': 'Rp 5.000.000 - Rp 20.000.000',
                                                            'Lebih dari Rp 20.000.000': 'Lebih dari Rp 20.000.000',
                                                            'Tidak Berpenghasilan': 'Tidak Berpenghasilan',
                                                        }} />
                                                    <FieldText form={form} update={update} label="No HP Wali" name="no_hp_wali" type="tel" placeholder="08xxxxxxxxxx" />
                                                    <FieldSelect form={form} update={update} label="Pendidikan Wali" name="pendidikan_wali"
                                                        options={{ 'Tidak Sekolah': 'Tidak Sekolah', 'SD / Sederajat': 'SD / Sederajat', 'SMP / Sederajat': 'SMP / Sederajat', 'SMA / Sederajat': 'SMA / Sederajat', D1: 'D1', D2: 'D2', D3: 'D3', 'D4 / S1': 'D4 / S1', S2: 'S2', S3: 'S3' }} />
                                                    <FieldText form={form} update={update} label="Alamat Wali" name="alamat_wali" type="textarea" placeholder="Alamat domisili wali" sm2 />
                                                    <FieldSelect form={form} update={update} label="Status Wali" name="status_wali" optional
                                                        options={{ 'Hidup': 'Hidup', 'Meninggal': 'Meninggal', 'Cerai Hidup': 'Cerai Hidup', 'Cerai Mati': 'Cerai Mati' }} />
                                                    <FieldSelect form={form} update={update} label="Kewarganegaraan Wali" name="kewarganegaraan_wali" optional
                                                        options={{ WNI: 'WNI', WNA: 'WNA' }} />
                                                    <FieldText form={form} update={update} label="Tempat Lahir Wali" name="tempat_lahir_wali" placeholder="Kota lahir wali" optional />
                                                </div>
                                            </div>
                                        </div>
                                        <StepErrors errors={stepErrors[2]} />
                                        {stepNav(2, 5)}
                                    </div>
 
                                    {/* STEP 3: PERIODIK & DOMISILI */}
                                    <div className="flex flex-col justify-between pr-2" style={{ width: '20%' }}>
                                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2">
                                            <div className="sm:col-span-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Alamat Tempat Tinggal Siswa</p>
                                            </div>
                                            <FieldText form={form} update={update} label="Alamat Lengkap Siswa *" name="alamat_siswa" type="textarea" placeholder="Alamat tempat tinggal siswa saat ini" sm2 required />
                                            <FieldText form={form} update={update} label="RT" name="rt" placeholder="Contoh: 003" />
                                            <FieldText form={form} update={update} label="RW" name="rw" placeholder="Contoh: 005" />
                                            <FieldText form={form} update={update} label="Desa / Kelurahan *" name="kelurahan" placeholder="Nama kelurahan" required />
                                            <FieldText form={form} update={update} label="Kecamatan *" name="kecamatan" placeholder="Nama kecamatan" required />
                                            <FieldText form={form} update={update} label="Kode Pos" name="kode_pos" placeholder="Contoh: 12345" />
                                            <FieldText form={form} update={update} label="Lintang (Latitude)" name="lintang" type="number" placeholder="Contoh: -6.26000000" />
                                            <FieldText form={form} update={update} label="Bujur (Longitude)" name="bujur" type="number" placeholder="Contoh: 106.81000000" />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Keluarga</p>
                                            </div>
                                            <FieldText form={form} update={update} label="Anak Ke-" name="anak_ke" type="number" placeholder="Contoh: 2" />
                                            <FieldText form={form} update={update} label="Jumlah Saudara Kandung" name="jumlah_saudara" type="number" placeholder="Contoh: 3" />
                                            <FieldText form={form} update={update} label="Nama Kepala Keluarga" name="nama_kepala_keluarga" placeholder="Nama kepala keluarga" sm2 optional />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Geografis ke Sekolah</p>
                                            </div>
                                            <FieldText form={form} update={update} label="Jarak ke Sekolah (km)" name="jarak_tempat_tinggal" type="number" placeholder="Contoh: 2.5" />
                                            <FieldText form={form} update={update} label="Waktu Tempuh (menit)" name="waktu_tempuh" type="number" placeholder="Contoh: 15" />
                                            <FieldSelect form={form} update={update} label="Moda Transportasi" name="moda_transportasi" sm2
                                                options={{
                                                    'Jalan Kaki': 'Jalan Kaki', Sepeda: 'Sepeda', 'Sepeda Motor': 'Sepeda Motor',
                                                    'Mobil Pribadi': 'Mobil Pribadi', 'Antar Jemput Sekolah': 'Antar Jemput Sekolah',
                                                    'Angkutan Umum': 'Angkutan Umum', 'Perahu / Sampan': 'Perahu / Sampan', Lainnya: 'Lainnya',
                                                }} />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Pendukung & Kontak Pribadi Siswa</p>
                                            </div>
                                            <FieldText form={form} update={update} label="Hobi" name="hobi" placeholder="Contoh: Membaca" />
                                            <FieldText form={form} update={update} label="Cita-cita" name="cita_cita" placeholder="Contoh: Dokter" />
                                            <FieldText form={form} update={update} label="No Telp Siswa" name="no_telp_siswa" type="tel" placeholder="Telepon rumah/pribadi" />
                                            <FieldText form={form} update={update} label="HP Siswa" name="hp_siswa" type="tel" placeholder="08xxxxxxxxxx" />
                                            <FieldText form={form} update={update} label="Email Siswa" name="email_siswa" type="email" placeholder="nama@email.com" sm2 />
                                            <FieldSelect form={form} update={update} label="Imunisasi (Terakhir)" name="imunisasi" optional
                                                options={{ 'Lengkap': 'Lengkap', 'Tidak Lengkap': 'Tidak Lengkap', 'Belum': 'Belum', 'Tidak Diketahui': 'Tidak Diketahui' }} />
                                        </div>
                                        <StepErrors errors={stepErrors[3]} />
                                        {stepNav(3, 5)}
                                    </div>
 
                                    {/* STEP 4: AKADEMIK */}
                                    <div className="flex flex-col justify-between pr-2" style={{ width: '20%' }}>
                                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2">
                                            <FieldSelect form={form} update={update} label="Kelas" name="kelas_id" sm2 placeholder="-- Belum Ditentukan (Opsional) --"
                                                options={kelas.reduce((acc, k) => ({ ...acc, [k.id]: `Kelas ${k.full_name || k.nama}` }), {})} />
                                            <FieldText form={form} update={update} label="Kelas Paralel" name="kelas_pararel" placeholder="Contoh: A, B, C..." optional />
                                            <FieldSelect form={form} update={update} label="Tahun Ajaran *" name="tahun_ajaran_id" required placeholder="-- Pilih Tahun Ajaran --"
                                                options={tahunAjarans.reduce((acc, ta) => ({ ...acc, [ta.id]: `${ta.tahun}${ta.is_active ? ' (Aktif)' : ''}` }), {})} />
                                            <FieldSelect form={form} update={update} label="Status Siswa *" name="status" required placeholder="Pilih"
                                                options={{ aktif: 'Aktif', nonaktif: 'Non-Aktif', pindah: 'Pindah Sekolah', lulus: 'Lulus' }} />
                                            <FieldText form={form} update={update} label="NIK" name="nik" placeholder="16 digit NIK" />
                                            <FieldText form={form} update={update} label="No. Kartu Keluarga (KK)" name="no_kk" placeholder="16 digit No. KK" />
                                            <FieldText form={form} update={update} label="Tanggal Masuk *" name="tanggal_masuk" type="date" required />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Data Fisik & Kesehatan</p>
                                            </div>
                                            <FieldSelect form={form} update={update} label="Golongan Darah" name="golongan_darah" placeholder="Tidak Diketahui"
                                                options={{ A: 'A', B: 'B', AB: 'AB', O: 'O' }} />
                                            <FieldText form={form} update={update} label="Tinggi Badan (cm)" name="tinggi_badan" type="number" placeholder="Contoh: 125" />
                                            <FieldText form={form} update={update} label="Berat Badan (kg)" name="berat_badan" type="number" placeholder="Contoh: 25" />
                                            <FieldText form={form} update={update} label="Lingkar Kepala (cm)" name="lingkar_kepala" type="number" placeholder="Contoh: 51.5" />
                                            <FieldText form={form} update={update} label="Kebutuhan Khusus / ABK" name="kebutuhan_khusus" placeholder="Kosongkan jika tidak ada" sm2 />
                                            <FieldText form={form} update={update} label="Riwayat Penyakit" name="riwayat_penyakit" type="textarea" placeholder="Riwayat penyakit / alergi (opsional)" sm2 />
                                            <FieldText form={form} update={update} label="Catatan Kesehatan (Semester Ini)" name="catatan_kesehatan" type="textarea" placeholder="Kondisi kesehatan untuk semester ini..." sm2 />

                                            <div className="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Program Kesejahteraan</p>
                                            </div>
                                            <FieldSelect form={form} update={update} label="Penerima KPS/PKH" name="penerima_kps_pkh" options={{ '0': 'Tidak', '1': 'Ya' }} />
                                            <FieldText form={form} update={update} label="No KPS/PKH" name="no_kps_pkh" placeholder="Nomor kartu/program" />
                                            <FieldSelect form={form} update={update} label="Layak PIP" name="layak_pip" options={{ '0': 'Tidak', '1': 'Ya' }} />
                                            <FieldText form={form} update={update} label="Alasan Layak PIP" name="alasan_layak_pip" type="textarea" placeholder="Alasan kelayakan PIP" sm2 />
                                            <FieldSelect form={form} update={update} label="Penerima KIP" name="penerima_kip" options={{ '0': 'Tidak', '1': 'Ya' }} />
                                            <FieldText form={form} update={update} label="No KIP" name="no_kip" placeholder="Nomor KIP" />
                                            <FieldText form={form} update={update} label="Nama Tertera di KIP" name="nama_tertera_di_kip" placeholder="Nama sesuai kartu KIP" sm2 />
                                        </div>
                                        <StepErrors errors={stepErrors[4]} />
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

const FieldText = ({ form, update, label, name, type = 'text', placeholder, required, optional, sm2 }) => (
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

const FieldSelect = ({ form, update, label, name, options, placeholder, required, optional, sm2 }) => (
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

const StepErrors = ({ errors }) => {
    if (!errors || errors.length === 0) return null;
    return (
        <div className="mt-4 p-3 rounded-2xl bg-rose-50 border border-rose-200">
            {errors.map((err, i) => (
                <p key={i} className="text-[11px] font-semibold text-rose-600 flex items-center gap-2">
                    <AlertTriangle className="w-3.5 h-3.5 shrink-0" /> {err}
                </p>
            ))}
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
