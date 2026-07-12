import React, { useState, useEffect } from 'react';
import {
    X, User, Loader2, BookOpen, Users, MapPin,
    Award, Gem, FolderOpen, Plus, Award as AwardIcon,
    Trash2, Upload, Eye, Download, ChevronRight
} from 'lucide-react';
import { siswaAPI } from '../../api/operator';

const TABS = [
    { key: 'identitas', label: 'Identitas', icon: User },
    { key: 'ortu', label: 'Orang Tua', icon: Users },
    { key: 'periodik', label: 'Periodik', icon: MapPin },
    { key: 'akademik', label: 'Akademik & Riwayat', icon: BookOpen },
    { key: 'prestasi', label: 'Prestasi', icon: Award },
    { key: 'beasiswa', label: 'Beasiswa', icon: Gem },
    { key: 'berkas', label: 'Berkas Digital', icon: FolderOpen },
];

const DetailField = ({ label, value, sm2 }) => (
    <div className={sm2 ? 'sm:col-span-2' : ''}>
        <p className="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{label}</p>
        <p className="text-sm font-bold text-slate-700 mt-0.5">{value !== null && value !== undefined && value !== '' ? value : '—'}</p>
    </div>
);

const DetailCard = ({ title, children }) => (
    <div className="rounded-2xl border border-slate-100 overflow-hidden">
        <div className="bg-slate-50 px-5 py-3 border-b border-slate-100">
            <p className="text-[10px] font-black uppercase tracking-widest text-slate-500">{title}</p>
        </div>
        <div className="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
            {children}
        </div>
    </div>
);

const ModalDetailSiswa = ({ isOpen, onClose, siswa, onSuccess }) => {
    const [activeTab, setActiveTab] = useState('identitas');
    const [detail, setDetail] = useState(null);
    const [loading, setLoading] = useState(false);
    const [loadingTab, setLoadingTab] = useState(false);

    const [prestasi, setPrestasi] = useState([]);
    const [beasiswa, setBeasiswa] = useState([]);
    const [berkas, setBerkas] = useState([]);

    const [prestasiForm, setPrestasiForm] = useState({ nama: '', jenis: '', tingkat: '', tahun: '', penyelenggara: '', keterangan: '' });
    const [prestasiFile, setPrestasiFile] = useState(null);
    const [editPrestasiId, setEditPrestasiId] = useState(null);

    const [beasiswaForm, setBeasiswaForm] = useState({ nama: '', jenis: '', nominal: '', tahun_mulai: '', tahun_selesai: '', keterangan: '' });
    const [editBeasiswaId, setEditBeasiswaId] = useState(null);
    const [detailBeasiswa, setDetailBeasiswa] = useState(null);

    const [berkasJenis, setBerkasJenis] = useState('');
    const [berkasFile, setBerkasFile] = useState(null);

    const [submitting, setSubmitting] = useState(false);

    const apiBase = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';
    const storageBase = apiBase.replace('/api', '');

    useEffect(() => {
        if (isOpen && siswa?.id) {
            setActiveTab('identitas');
            setDetail(null);
            fetchDetail(siswa.id);
        }
    }, [isOpen, siswa?.id]);

    useEffect(() => {
        if (!isOpen) {
            setPrestasiForm({ nama: '', jenis: '', tingkat: '', tahun: '', penyelenggara: '', keterangan: '' });
            setPrestasiFile(null);
            setEditPrestasiId(null);
            setBeasiswaForm({ nama: '', jenis: '', nominal: '', tahun_mulai: '', tahun_selesai: '', keterangan: '' });
            setBerkasJenis('');
            setBerkasFile(null);
            setSubmitting(false);
        }
    }, [isOpen]);

    const fetchDetail = async (id) => {
        setLoading(true);
        try {
            const res = await siswaAPI.show(id);
            setDetail(res.data.siswa);
        } catch (err) {
            console.error('Gagal memuat detail siswa', err);
        } finally {
            setLoading(false);
        }
    };

    const loadPrestasi = async () => {
        if (!siswa) return;
        setLoadingTab(true);
        try {
            const res = await siswaAPI.getPrestasi(siswa.id);
            setPrestasi(res.data.prestasi || res.data || []);
        } catch (e) { setPrestasi([]); }
        finally { setLoadingTab(false); }
    };

    const loadBeasiswa = async () => {
        if (!siswa) return;
        setLoadingTab(true);
        try {
            const res = await siswaAPI.getBeasiswa(siswa.id);
            setBeasiswa(res.data.beasiswa || res.data || []);
        } catch (e) { setBeasiswa([]); }
        finally { setLoadingTab(false); }
    };

    const loadBerkas = async () => {
        if (!siswa) return;
        setLoadingTab(true);
        try {
            const res = await siswaAPI.getBerkas(siswa.id);
            setBerkas(res.data.berkas || res.data || []);
        } catch (e) { setBerkas([]); }
        finally { setLoadingTab(false); }
    };

    const handleTabChange = (key) => {
        setActiveTab(key);
        if (key === 'prestasi') loadPrestasi();
        else if (key === 'beasiswa') loadBeasiswa();
        else if (key === 'berkas') loadBerkas();
    };

    const handleSubmitPrestasi = async (e) => {
        e.preventDefault();
        setSubmitting(true);
        try {
            const fd = new FormData();
            Object.entries(prestasiForm).forEach(([k, v]) => { if (v) fd.append(k, v); });
            if (prestasiFile) fd.append('file_bukti', prestasiFile);

            if (editPrestasiId) {
                await siswaAPI.updatePrestasi(siswa.id, editPrestasiId, fd);
            } else {
                await siswaAPI.storePrestasi(siswa.id, fd);
            }
            setPrestasiForm({ nama: '', jenis: '', tingkat: '', tahun: '', penyelenggara: '', keterangan: '' });
            setPrestasiFile(null);
            setEditPrestasiId(null);
            onSuccess?.('Prestasi berhasil disimpan');
            loadPrestasi();
        } catch (err) {
            alert(err.response?.data?.message || 'Gagal menyimpan prestasi');
        } finally { setSubmitting(false); }
    };

    const handleViewPrestasiBukti = async (prestasiId) => {
        try {
            const res = await siswaAPI.viewPrestasiBukti(siswa.id, prestasiId);
            const blob = new Blob([res.data], { type: res.headers['content-type'] });
            const url = URL.createObjectURL(blob);
            window.open(url, '_blank');
        } catch (err) { alert('Gagal membuka bukti'); }
    };

    const handleViewBerkas = async (berkasId) => {
        try {
            const res = await siswaAPI.viewBerkas(siswa.id, berkasId);
            const blob = new Blob([res.data], { type: res.headers['content-type'] });
            const url = URL.createObjectURL(blob);
            window.open(url, '_blank');
        } catch (err) { alert('Gagal membuka berkas'); }
    };

    const handleDownloadBerkas = async (berkasId) => {
        try {
            const res = await siswaAPI.downloadBerkas(siswa.id, berkasId);
            const blob = new Blob([res.data], { type: res.headers['content-type'] });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            const disposition = res.headers['content-disposition'];
            const match = disposition && disposition.match(/filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/);
            a.download = match ? match[1].replace(/['"]/g, '') : 'berkas';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        } catch (err) { alert('Gagal mengunduh berkas'); }
    };

    const handleDeletePrestasi = async (id) => {
        if (!window.confirm('Hapus prestasi ini?')) return;
        try {
            await siswaAPI.destroyPrestasi(siswa.id, id);
            loadPrestasi();
        } catch (err) { alert('Gagal menghapus'); }
    };

    const handleEditPrestasi = (p) => {
        setPrestasiForm({
            nama: p.nama, jenis: p.jenis || '', tingkat: p.tingkat || '',
            tahun: p.tahun || '', penyelenggara: p.penyelenggara || '', keterangan: p.keterangan || ''
        });
        setEditPrestasiId(p.id);
    };

    const handleEditBeasiswa = (b) => {
        setBeasiswaForm({
            nama: b.nama, jenis: b.jenis || '', nominal: b.nominal || '',
            tahun_mulai: b.tahun_mulai || '', tahun_selesai: b.tahun_selesai || '', keterangan: b.keterangan || ''
        });
        setEditBeasiswaId(b.id);
    };

    const handleSubmitBeasiswa = async (e) => {
        e.preventDefault();
        setSubmitting(true);
        try {
            if (editBeasiswaId) {
                await siswaAPI.updateBeasiswa(siswa.id, editBeasiswaId, beasiswaForm);
            } else {
                await siswaAPI.storeBeasiswa(siswa.id, beasiswaForm);
            }
            setBeasiswaForm({ nama: '', jenis: '', nominal: '', tahun_mulai: '', tahun_selesai: '', keterangan: '' });
            setEditBeasiswaId(null);
            onSuccess?.('Beasiswa berhasil disimpan');
            loadBeasiswa();
        } catch (err) {
            alert(err.response?.data?.message || 'Gagal menyimpan beasiswa');
        } finally { setSubmitting(false); }
    };

    const handleDeleteBeasiswa = async (id) => {
        if (!window.confirm('Hapus beasiswa ini?')) return;
        try {
            await siswaAPI.destroyBeasiswa(siswa.id, id);
            loadBeasiswa();
        } catch (err) { alert('Gagal menghapus'); }
    };

    const handleSubmitBerkas = async (e) => {
        e.preventDefault();
        if (!berkasJenis || !berkasFile) return;
        setSubmitting(true);
        try {
            const fd = new FormData();
            fd.append('jenis_berkas', berkasJenis);
            fd.append('berkas_file', berkasFile);
            await siswaAPI.storeBerkas(siswa.id, fd);
            setBerkasJenis('');
            setBerkasFile(null);
            onSuccess?.('Berkas berhasil diunggah');
            loadBerkas();
        } catch (err) {
            alert(err.response?.data?.message || 'Gagal mengunggah berkas');
        } finally { setSubmitting(false); }
    };

    const handleDeleteBerkas = async (id) => {
        if (!window.confirm('Hapus berkas ini?')) return;
        try {
            await siswaAPI.destroyBerkas(siswa.id, id);
            loadBerkas();
            onSuccess?.('Berkas dihapus');
        } catch (e) { alert('Gagal'); }
    };

    if (!isOpen || !siswa) return null;

    const s = detail || siswa;

    const statusColor = {
        aktif: 'bg-emerald-100 text-emerald-700',
        lulus: 'bg-blue-100 text-blue-700',
        pindah: 'bg-amber-100 text-amber-700',
        nonaktif: 'bg-rose-100 text-rose-700',
    }[s.status] || 'bg-slate-100 text-slate-600';

    const renderEmpty = (msg) => (
        <div className="flex flex-col items-center justify-center py-12 text-slate-400">
            <p className="text-sm font-bold">{msg}</p>
        </div>
    );

    const renderLoader = () => (
        <div className="flex justify-center items-center h-64">
            <Loader2 className="w-6 h-6 text-emerald-500 animate-spin" />
        </div>
    );

    const TabContent = () => {
        if (activeTab === 'identitas' || activeTab === 'ortu' || activeTab === 'periodik' || activeTab === 'akademik') {
            if (loading) return renderLoader();
            if (!detail) return renderEmpty('Gagal memuat data');
        }

        switch (activeTab) {
            case 'identitas':
                return (
                    <div className="space-y-5">
                        <DetailCard title="Data Pribadi">
                            <DetailField label="Nama Lengkap" value={s.nama} sm2 />
                            <DetailField label="NISN" value={s.nisn} />
                            <DetailField label="NIS" value={s.nis} />
                            <DetailField label="NIK" value={s.nik} />
                            <DetailField label="No. KK" value={s.no_kk} />
                            <DetailField label="Tempat Lahir" value={s.tempat_lahir} />
                            <DetailField label="Tanggal Lahir" value={s.tanggal_lahir} />
                            <DetailField label="Jenis Kelamin" value={s.jenis_kelamin === 'L' ? 'Laki-laki' : s.jenis_kelamin === 'P' ? 'Perempuan' : s.jenis_kelamin} />
                            <DetailField label="Agama" value={s.agama} />
                            <DetailField label="Kewarganegaraan" value={s.kewarganegaraan} />
                            <DetailField label="No. Registrasi Akta" value={s.no_registrasi_akta_kelahiran} />
                        </DetailCard>
                        <DetailCard title="Pendaftaran">
                            <DetailField label="Jenis Pendaftaran" value={s.jenis_pendaftaran === 'pindahan' ? 'Siswa Pindahan' : 'Siswa Baru'} />
                            <DetailField label="Asal Sekolah" value={s.asal_sekolah} sm2 />
                            <DetailField label="Tanggal Masuk" value={s.tanggal_masuk} />
                            <DetailField label="No. Absen" value={s.no_absen} />
                            <DetailField label="Pembiaya Sekolah" value={s.pembiaya_sekolah} />
                        </DetailCard>
                    </div>
                );

            case 'ortu':
                return (
                    <div className="space-y-5">
                        <DetailCard title="Data Ayah">
                            <DetailField label="Nama Ayah" value={s.nama_ayah} sm2 />
                            <DetailField label="NIK Ayah" value={s.nik_ayah} />
                            <DetailField label="Tahun Lahir" value={s.tahun_lahir_ayah} />
                            <DetailField label="Pendidikan" value={s.pendidikan_ayah} />
                            <DetailField label="Pekerjaan" value={s.pekerjaan_ayah} />
                            <DetailField label="Penghasilan" value={s.penghasilan_ayah} />
                            <DetailField label="Status" value={s.status_ayah} />
                            <DetailField label="Kewarganegaraan" value={s.kewarganegaraan_ayah} />
                            <DetailField label="Tempat Lahir" value={s.tempat_lahir_ayah} />
                            <DetailField label="No. HP" value={s.no_hp_ayah} />
                            <DetailField label="Kebutuhan Khusus" value={s.kebutuhan_khusus_ayah} />
                        </DetailCard>
                        <DetailCard title="Data Ibu">
                            <DetailField label="Nama Ibu" value={s.nama_ibu} sm2 />
                            <DetailField label="NIK Ibu" value={s.nik_ibu} />
                            <DetailField label="Tahun Lahir" value={s.tahun_lahir_ibu} />
                            <DetailField label="Pendidikan" value={s.pendidikan_ibu} />
                            <DetailField label="Pekerjaan" value={s.pekerjaan_ibu} />
                            <DetailField label="Penghasilan" value={s.penghasilan_ibu} />
                            <DetailField label="Status" value={s.status_ibu} />
                            <DetailField label="Kewarganegaraan" value={s.kewarganegaraan_ibu} />
                            <DetailField label="Tempat Lahir" value={s.tempat_lahir_ibu} />
                            <DetailField label="No. HP" value={s.no_hp_ibu} />
                            <DetailField label="Kebutuhan Khusus" value={s.kebutuhan_khusus_ibu} />
                        </DetailCard>
                        <DetailCard title="Data Wali">
                            {s.nama_wali ? (
                                <>
                                    <DetailField label="Nama Wali" value={s.nama_wali} sm2 />
                                    <DetailField label="NIK Wali" value={s.nik_wali} />
                                    <DetailField label="Tahun Lahir" value={s.tahun_lahir_wali} />
                                    <DetailField label="Pendidikan" value={s.pendidikan_wali} />
                                    <DetailField label="Pekerjaan" value={s.pekerjaan_wali} />
                                    <DetailField label="Penghasilan" value={s.penghasilan_wali} />
                                    <DetailField label="Status" value={s.status_wali} />
                                    <DetailField label="Kewarganegaraan" value={s.kewarganegaraan_wali} />
                                    <DetailField label="Tempat Lahir" value={s.tempat_lahir_wali} />
                                    <DetailField label="No. HP" value={s.no_hp_wali} />
                                    <DetailField label="Alamat" value={s.alamat_wali} sm2 />
                                </>
                            ) : (
                                <div className="sm:col-span-2 py-4 text-center text-slate-400 text-sm">
                                    Tidak ada data wali
                                </div>
                            )}
                        </DetailCard>
                        <DetailCard title="Kontak & Alamat Orang Tua">
                            <DetailField label="No. HP Orang Tua" value={s.no_hp_ortu} />
                            <DetailField label="Alamat" value={s.alamat} sm2 />
                        </DetailCard>
                    </div>
                );

            case 'periodik':
                return (
                    <div className="space-y-5">
                        <DetailCard title="Alamat Domisili">
                            <DetailField label="Alamat Siswa" value={s.alamat_siswa} sm2 />
                            <DetailField label="RT" value={s.rt} />
                            <DetailField label="RW" value={s.rw} />
                            <DetailField label="Kelurahan" value={s.kelurahan} />
                            <DetailField label="Kecamatan" value={s.kecamatan} />
                            <DetailField label="Kode Pos" value={s.kode_pos} />
                            <DetailField label="Lintang" value={s.lintang} />
                            <DetailField label="Bujur" value={s.bujur} />
                        </DetailCard>
                        <DetailCard title="Data Keluarga">
                            <DetailField label="Anak Ke-" value={s.anak_ke} />
                            <DetailField label="Jumlah Saudara" value={s.jumlah_saudara} />
                            <DetailField label="Nama Kepala Keluarga" value={s.nama_kepala_keluarga} sm2 />
                        </DetailCard>
                        <DetailCard title="Akses ke Sekolah">
                            <DetailField label="Jarak Tempat Tinggal" value={s.jarak_tempat_tinggal ? `${s.jarak_tempat_tinggal} km` : null} />
                            <DetailField label="Waktu Tempuh" value={s.waktu_tempuh ? `${s.waktu_tempuh} menit` : null} />
                            <DetailField label="Moda Transportasi" value={s.moda_transportasi} />
                        </DetailCard>
                        <DetailCard title="Data Pendukung">
                            <DetailField label="Hobi" value={s.hobi} />
                            <DetailField label="Cita-cita" value={s.cita_cita} />
                            <DetailField label="No. Telepon" value={s.no_telp_siswa} />
                            <DetailField label="No. HP" value={s.hp_siswa} />
                            <DetailField label="Email" value={s.email_siswa} sm2 />
                            <DetailField label="Imunisasi" value={s.imunisasi} />
                        </DetailCard>
                    </div>
                );

            case 'akademik':
                return (
                    <div className="space-y-5">
                        <DetailCard title="Data Akademik">
                            <DetailField label="Kelas" value={s.kelas_nama} />
                            <DetailField label="Tingkat" value={s.kelas_level} />
                            <DetailField label="Kelas Paralel" value={s.kelas_pararel} />
                            <DetailField label="Wali Kelas" value={s.wali_kelas} sm2 />
                            <DetailField label="Tahun Ajaran" value={s.tahun_ajaran} />
                            <DetailField label="Status" value={s.status} />
                            <DetailField label="Tanggal Masuk" value={s.tanggal_masuk} />
                        </DetailCard>
                        <DetailCard title="Data Fisik & Kesehatan">
                            <DetailField label="Golongan Darah" value={s.golongan_darah} />
                            <DetailField label="Tinggi Badan" value={s.tinggi_badan ? `${s.tinggi_badan} cm` : null} />
                            <DetailField label="Berat Badan" value={s.berat_badan ? `${s.berat_badan} kg` : null} />
                            <DetailField label="Lingkar Kepala" value={s.lingkar_kepala ? `${s.lingkar_kepala} cm` : null} />
                            <DetailField label="Kebutuhan Khusus" value={s.kebutuhan_khusus} sm2 />
                            <DetailField label="Riwayat Penyakit" value={s.riwayat_penyakit} sm2 />
                            <DetailField label="Catatan Kesehatan" value={s.catatan_kesehatan} sm2 />
                        </DetailCard>
                        <DetailCard title="Program Kesejahteraan">
                            <DetailField label="Penerima KPS/PKH" value={s.penerima_kps_pkh == 1 ? 'Ya' : 'Tidak'} />
                            <DetailField label="No. KPS/PKH" value={s.no_kps_pkh} />
                            <DetailField label="Layak PIP" value={s.layak_pip == 1 ? 'Ya' : 'Tidak'} />
                            <DetailField label="Alasan Layak PIP" value={s.alasan_layak_pip} sm2 />
                            <DetailField label="Penerima KIP" value={s.penerima_kip == 1 ? 'Ya' : 'Tidak'} />
                            <DetailField label="No. KIP" value={s.no_kip} />
                            <DetailField label="Nama di KIP" value={s.nama_tertera_di_kip} sm2 />
                        </DetailCard>
                        <DetailCard title="Riwayat Kelas">
                            {s.riwayat_kelas && s.riwayat_kelas.length > 0 ? (
                                <div className="sm:col-span-2 space-y-3">
                                    {s.riwayat_kelas.map((rk, i) => (
                                        <div key={rk.id || i} className="flex items-start gap-4 p-3 bg-slate-50 rounded-xl">
                                            <div className="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 mt-0.5">
                                                <ChevronRight className="w-4 h-4 text-emerald-600" />
                                            </div>
                                            <div className="flex-1">
                                                <p className="text-sm font-bold text-slate-700">{rk.nama_kelas_snapshot || rk.kelas?.full_name || '-'}</p>
                                                <div className="flex flex-wrap gap-x-4 gap-y-1 mt-1 text-[11px] text-slate-500">
                                                    <span>Tahun Ajaran: {rk.tahun_ajaran?.tahun || rk.tahun_ajaran_id || '-'}</span>
                                                    <span>Semester: {rk.semester || '-'}</span>
                                                    <span>Tgl Masuk: {rk.tanggal_masuk || '-'}</span>
                                                </div>
                                                {rk.catatan && (
                                                    <p className="text-[11px] text-slate-400 italic mt-1">{rk.catatan}</p>
                                                )}
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="sm:col-span-2 py-4 text-center text-slate-400 text-sm">
                                    Belum ada riwayat kelas
                                </div>
                            )}
                        </DetailCard>
                        <DetailCard title="Mutasi Masuk">
                            {s.is_mutasi_masuk ? (
                                <>
                                    <DetailField label="Sekolah Asal" value={s.sekolah_asal_mutasi} sm2 />
                                    <DetailField label="No. Surat Masuk" value={s.no_surat_masuk} />
                                    <DetailField label="Tanggal Mutasi" value={s.tanggal_mutasi_masuk} />
                                    <DetailField label="Alasan" value={s.alasan_mutasi_masuk} sm2 />
                                </>
                            ) : (
                                <div className="sm:col-span-2 py-4 text-center text-slate-400 text-sm">
                                    Bukan siswa pindahan / mutasi masuk
                                </div>
                            )}
                        </DetailCard>
                        <DetailCard title="Mutasi Keluar">
                            {s.jenis_mutasi_keluar ? (
                                <>
                                    <DetailField label="Jenis Mutasi" value={s.jenis_mutasi_keluar} />
                                    <DetailField label="Sekolah Tujuan" value={s.sekolah_tujuan} sm2 />
                                    <DetailField label="Tanggal Keluar" value={s.tanggal_keluar} />
                                    <DetailField label="No. Surat" value={s.no_surat_mutasi} />
                                    <DetailField label="Alasan" value={s.alasan_mutasi} sm2 />
                                </>
                            ) : (
                                <div className="sm:col-span-2 py-4 text-center text-slate-400 text-sm">
                                    Belum ada mutasi keluar
                                </div>
                            )}
                        </DetailCard>
                        <DetailCard title="Statistik Akademik">
                            <DetailField label="Rata-rata Nilai" value={s.rata_nilai !== '-' ? s.rata_nilai : 'Belum ada nilai'} />
                            <DetailField label="Persentase Kehadiran" value={s.persen_kehadiran !== undefined ? `${s.persen_kehadiran}%` : '100%'} />
                        </DetailCard>
                    </div>
                );

            case 'prestasi':
                return (
                    <div className="space-y-6">
                        <div className="bg-amber-50/50 p-5 rounded-2xl border border-amber-100">
                            <form onSubmit={handleSubmitPrestasi} className="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Prestasi <span className="text-rose-400">*</span></label>
                                    <input value={prestasiForm.nama} onChange={e => setPrestasiForm({ ...prestasiForm, nama: e.target.value })} required placeholder="Contoh: Juara 1 Lomba Pidato"
                                        className="w-full px-4 py-3 bg-white border border-amber-200 rounded-2xl focus:border-amber-500 outline-none text-sm" />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis</label>
                                    <select value={prestasiForm.jenis} onChange={e => setPrestasiForm({ ...prestasiForm, jenis: e.target.value })}
                                        className="w-full px-4 py-3 bg-white border border-amber-200 rounded-2xl focus:border-amber-500 outline-none text-sm">
                                        <option value="">Pilih...</option>
                                        <option value="Akademik">Akademik</option>
                                        <option value="Non Akademik">Non Akademik</option>
                                    </select>
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tingkat</label>
                                    <select value={prestasiForm.tingkat} onChange={e => setPrestasiForm({ ...prestasiForm, tingkat: e.target.value })}
                                        className="w-full px-4 py-3 bg-white border border-amber-200 rounded-2xl focus:border-amber-500 outline-none text-sm">
                                        <option value="">Pilih...</option>
                                        <option value="Sekolah">Sekolah</option>
                                        <option value="Kecamatan">Kecamatan</option>
                                        <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                                        <option value="Provinsi">Provinsi</option>
                                        <option value="Nasional">Nasional</option>
                                        <option value="Internasional">Internasional</option>
                                    </select>
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun</label>
                                    <input value={prestasiForm.tahun} onChange={e => setPrestasiForm({ ...prestasiForm, tahun: e.target.value })} maxLength={4} placeholder="Contoh: 2023"
                                        className="w-full px-4 py-3 bg-white border border-amber-200 rounded-2xl focus:border-amber-500 outline-none text-sm" />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Penyelenggara</label>
                                    <input value={prestasiForm.penyelenggara} onChange={e => setPrestasiForm({ ...prestasiForm, penyelenggara: e.target.value })} placeholder="Contoh: Kemdikbud"
                                        className="w-full px-4 py-3 bg-white border border-amber-200 rounded-2xl focus:border-amber-500 outline-none text-sm" />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Keterangan</label>
                                    <input value={prestasiForm.keterangan} onChange={e => setPrestasiForm({ ...prestasiForm, keterangan: e.target.value })} placeholder="Keterangan tambahan"
                                        className="w-full px-4 py-3 bg-white border border-amber-200 rounded-2xl focus:border-amber-500 outline-none text-sm" />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Bukti (Opsional)</label>
                                    <input type="file" accept=".jpg,.jpeg,.png,.pdf" onChange={e => setPrestasiFile(e.target.files?.[0] || null)}
                                        className="w-full px-4 py-2.5 bg-white border border-amber-200 rounded-2xl text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100" />
                                </div>
                                <div className="flex justify-end gap-2 md:col-span-3 mt-2">
                                    {editPrestasiId && (
                                        <button type="button" onClick={() => { setEditPrestasiId(null); setPrestasiForm({ nama: '', jenis: '', tingkat: '', tahun: '', penyelenggara: '', keterangan: '' }); setPrestasiFile(null); }}
                                            className="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all">
                                            Batal Edit
                                        </button>
                                    )}
                                    <button type="submit" disabled={submitting}
                                        className="px-6 py-3 bg-amber-600 hover:bg-amber-500 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-2 disabled:opacity-50">
                                        <Plus className="w-4 h-4" /> {editPrestasiId ? 'Simpan' : 'Tambah Prestasi'}
                                    </button>
                                </div>
                            </form>
                        </div>
                        {loadingTab ? renderLoader() : (
                            <div className="border border-slate-100 rounded-2xl overflow-hidden">
                                <table className="w-full text-left">
                                    <thead>
                                        <tr className="bg-slate-50 border-b border-slate-100">
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun</th>
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Prestasi</th>
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tingkat</th>
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {prestasi.length === 0 ? (
                                            <tr><td colSpan={4} className="px-5 py-10 text-center text-slate-400 text-sm">Belum ada data prestasi</td></tr>
                                        ) : prestasi.map(p => (
                                            <tr key={p.id} className="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                                <td className="px-5 py-4 text-xs font-bold text-slate-600">{p.tahun || '-'}</td>
                                                <td className="px-5 py-4">
                                                    <div className="flex items-center gap-2">
                                                        <AwardIcon className="w-4 h-4 text-amber-500 shrink-0" />
                                                        <span className="text-sm font-semibold text-slate-800">{p.nama}</span>
                                                    </div>
                                                    <p className="text-[10px] text-slate-400 mt-0.5">{p.penyelenggara || ''}</p>
                                                </td>
                                                <td className="px-5 py-4">
                                                    <span className="px-2 py-1 rounded-md bg-amber-50 text-amber-700 text-[10px] font-bold">{p.tingkat || '-'}</span>
                                                </td>
                                                <td className="px-5 py-4 text-right">
                                                    <div className="flex justify-end gap-1">
                                                        {p.file_bukti && (
                                                            <button onClick={() => handleViewPrestasiBukti(p.id)} className="p-2 hover:bg-blue-50 text-slate-400 hover:text-blue-500 rounded-lg transition-colors" title="Lihat Bukti">
                                                                <Eye className="w-4 h-4" />
                                                            </button>
                                                        )}
                                                        <button onClick={() => handleEditPrestasi(p)} className="p-2 hover:bg-amber-50 text-slate-400 hover:text-amber-500 rounded-lg transition-colors" title="Edit">
                                                            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                        </button>
                                                        <button onClick={() => handleDeletePrestasi(p.id)} className="p-2 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-lg transition-colors" title="Hapus">
                                                            <Trash2 className="w-4 h-4" />
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        )}
                    </div>
                );

            case 'beasiswa':
                return (
                    <div className="space-y-6">
                        <div className="bg-emerald-50/50 p-5 rounded-2xl border border-emerald-100">
                            <form onSubmit={handleSubmitBeasiswa} className="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Beasiswa <span className="text-rose-400">*</span></label>
                                    <input value={beasiswaForm.nama} onChange={e => setBeasiswaForm({ ...beasiswaForm, nama: e.target.value })} required placeholder="Contoh: PIP, BSM"
                                        className="w-full px-4 py-3 bg-white border border-emerald-200 rounded-2xl focus:border-emerald-500 outline-none text-sm" />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis</label>
                                    <select value={beasiswaForm.jenis} onChange={e => setBeasiswaForm({ ...beasiswaForm, jenis: e.target.value })}
                                        className="w-full px-4 py-3 bg-white border border-emerald-200 rounded-2xl focus:border-emerald-500 outline-none text-sm">
                                        <option value="">Pilih...</option>
                                        <option value="Pemerintah Pusat">Pemerintah Pusat</option>
                                        <option value="Pemerintah Daerah">Pemerintah Daerah</option>
                                        <option value="Swasta/Yayasan">Swasta/Yayasan</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nominal (Rp)</label>
                                    <input type="number" value={beasiswaForm.nominal} onChange={e => setBeasiswaForm({ ...beasiswaForm, nominal: e.target.value })} placeholder="Contoh: 1000000"
                                        className="w-full px-4 py-3 bg-white border border-emerald-200 rounded-2xl focus:border-emerald-500 outline-none text-sm" />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun Mulai</label>
                                    <input value={beasiswaForm.tahun_mulai} onChange={e => setBeasiswaForm({ ...beasiswaForm, tahun_mulai: e.target.value })} maxLength={4} placeholder="Contoh: 2022"
                                        className="w-full px-4 py-3 bg-white border border-emerald-200 rounded-2xl focus:border-emerald-500 outline-none text-sm" />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun Selesai</label>
                                    <input value={beasiswaForm.tahun_selesai} onChange={e => setBeasiswaForm({ ...beasiswaForm, tahun_selesai: e.target.value })} maxLength={4} placeholder="Contoh: 2023"
                                        className="w-full px-4 py-3 bg-white border border-emerald-200 rounded-2xl focus:border-emerald-500 outline-none text-sm" />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Keterangan</label>
                                    <input value={beasiswaForm.keterangan} onChange={e => setBeasiswaForm({ ...beasiswaForm, keterangan: e.target.value })} placeholder="Keterangan tambahan"
                                        className="w-full px-4 py-3 bg-white border border-emerald-200 rounded-2xl focus:border-emerald-500 outline-none text-sm" />
                                </div>
                                <div className="md:col-span-3 flex justify-end gap-2">
                                    {editBeasiswaId && (
                                        <button type="button" onClick={() => { setEditBeasiswaId(null); setBeasiswaForm({ nama: '', jenis: '', nominal: '', tahun_mulai: '', tahun_selesai: '', keterangan: '' }); }}
                                            className="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all">
                                            Batal Edit
                                        </button>
                                    )}
                                    <button type="submit" disabled={submitting}
                                        className="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-2 disabled:opacity-50">
                                        <Plus className="w-4 h-4" /> {editBeasiswaId ? 'Simpan' : 'Tambah Beasiswa'}
                                    </button>
                                </div>
                            </form>
                        </div>
                        {detailBeasiswa && (
                            <div className="bg-white p-5 rounded-2xl border border-emerald-200 shadow-sm">
                                <div className="flex items-center justify-between mb-4">
                                    <h3 className="text-xs font-bold text-slate-400 uppercase tracking-widest">Detail Beasiswa</h3>
                                    <button onClick={() => setDetailBeasiswa(null)} className="p-1 hover:bg-slate-100 rounded-lg transition-colors">
                                        <X className="w-4 h-4 text-slate-400" />
                                    </button>
                                </div>
                                <div className="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                    <div><span className="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Nama</span><span className="font-semibold text-slate-800">{detailBeasiswa.nama}</span></div>
                                    <div><span className="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Jenis</span><span className="text-slate-700">{detailBeasiswa.jenis || '-'}</span></div>
                                    <div><span className="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Nominal</span><span className="font-semibold text-emerald-600">{detailBeasiswa.nominal ? `Rp ${Number(detailBeasiswa.nominal).toLocaleString('id-ID')}` : '-'}</span></div>
                                    <div><span className="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Periode</span><span className="text-slate-700">{detailBeasiswa.tahun_mulai || '-'}{detailBeasiswa.tahun_selesai ? ` – ${detailBeasiswa.tahun_selesai}` : ''}</span></div>
                                    <div className="md:col-span-2"><span className="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Keterangan</span><span className="text-slate-700">{detailBeasiswa.keterangan || '-'}</span></div>
                                </div>
                            </div>
                        )}
                        {loadingTab ? renderLoader() : (
                            <div className="border border-slate-100 rounded-2xl overflow-hidden">
                                <table className="w-full text-left">
                                    <thead>
                                        <tr className="bg-slate-50 border-b border-slate-100">
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Periode</th>
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Beasiswa</th>
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nominal</th>
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {beasiswa.length === 0 ? (
                                            <tr><td colSpan={4} className="px-5 py-10 text-center text-slate-400 text-sm">Belum ada data beasiswa</td></tr>
                                        ) : beasiswa.map(b => (
                                            <tr key={b.id} className="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                                <td className="px-5 py-4 text-xs font-bold text-slate-600">{b.tahun_mulai || '-'}{b.tahun_selesai ? ` – ${b.tahun_selesai}` : ''}</td>
                                                <td className="px-5 py-4">
                                                    <div className="flex items-center gap-2">
                                                        <Gem className="w-4 h-4 text-emerald-500 shrink-0" />
                                                        <span className="text-sm font-semibold text-slate-800">{b.nama}</span>
                                                    </div>
                                                </td>
                                                <td className="px-5 py-4 text-sm font-bold text-emerald-600">{b.nominal ? `Rp ${Number(b.nominal).toLocaleString('id-ID')}` : '-'}</td>
                                                <td className="px-5 py-4 text-right">
                                                    <div className="flex justify-end gap-1">
                                                        <button onClick={() => setDetailBeasiswa(b)} className="p-2 hover:bg-blue-50 text-slate-400 hover:text-blue-500 rounded-lg transition-colors" title="Detail">
                                                            <Eye className="w-4 h-4" />
                                                        </button>
                                                        <button onClick={() => { setEditBeasiswaId(b.id); handleEditBeasiswa(b); }} className="p-2 hover:bg-emerald-50 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors" title="Edit">
                                                            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                        </button>
                                                        <button onClick={() => handleDeleteBeasiswa(b.id)} className="p-2 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-lg transition-colors">
                                                            <Trash2 className="w-4 h-4" />
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        )}
                    </div>
                );

            case 'berkas':
                return (
                    <div className="space-y-6">
                        <div className="bg-violet-50/50 p-5 rounded-2xl border border-violet-100">
                            <form onSubmit={handleSubmitBerkas} className="flex flex-col sm:flex-row items-end gap-4">
                                <div className="w-full sm:w-1/3 flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Berkas <span className="text-rose-400">*</span></label>
                                    <select value={berkasJenis} onChange={e => setBerkasJenis(e.target.value)} required
                                        className="w-full px-4 py-3 bg-white border border-violet-200 rounded-2xl focus:border-violet-500 outline-none text-sm">
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
                                <div className="w-full sm:w-1/2 flex flex-col gap-2">
                                    <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">File (PDF/JPG/PNG) <span className="text-rose-400">*</span></label>
                                    <input type="file" required accept=".pdf,.jpg,.jpeg,.png"
                                        onChange={e => setBerkasFile(e.target.files?.[0] || null)}
                                        className="w-full px-4 py-2.5 bg-white border border-violet-200 rounded-2xl focus:border-violet-500 outline-none text-sm file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                                </div>
                                <button type="submit" disabled={submitting || !berkasJenis || !berkasFile}
                                    className="w-full sm:w-auto px-6 py-3 bg-violet-600 hover:bg-violet-500 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center justify-center gap-2 h-11 shrink-0 disabled:opacity-50">
                                    <Upload className="w-4 h-4" /> Unggah
                                </button>
                            </form>
                        </div>
                        {loadingTab ? renderLoader() : (
                            <div className="border border-slate-100 rounded-2xl overflow-hidden">
                                <table className="w-full text-left">
                                    <thead>
                                        <tr className="bg-slate-50 border-b border-slate-100">
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Berkas</th>
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama File</th>
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Ukuran</th>
                                            <th className="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {berkas.length === 0 ? (
                                            <tr><td colSpan={4} className="px-5 py-10 text-center text-slate-400 text-sm">Belum ada berkas digital</td></tr>
                                        ) : berkas.map(b => (
                                            <tr key={b.id} className="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                                <td className="px-5 py-4">
                                                    <div className="flex items-center gap-3">
                                                        <div className="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center shrink-0">
                                                            <FolderOpen className="w-4 h-4 text-violet-500" />
                                                        </div>
                                                        <span className="text-xs font-bold text-slate-700 uppercase tracking-widest">{b.jenis_label || b.jenis_berkas}</span>
                                                    </div>
                                                </td>
                                                <td className="px-5 py-4">
                                                    <p className="text-sm text-slate-700 truncate max-w-[250px]" title={b.nama_file_asli}>{b.nama_file_asli || '-'}</p>
                                                </td>
                                                <td className="px-5 py-4">
                                                    <span className="px-2 py-1 rounded-md bg-slate-100 text-[10px] font-bold text-slate-500">{b.ukuran || '-'}</span>
                                                </td>
                                                <td className="px-5 py-4 text-right">
                                                    <div className="flex justify-end gap-1">
                                                        <button onClick={() => handleViewBerkas(b.id)} className="p-2 hover:bg-blue-50 text-slate-400 hover:text-blue-500 rounded-lg transition-colors" title="Lihat">
                                                            <Eye className="w-4 h-4" />
                                                        </button>
                                                        <button onClick={() => handleDownloadBerkas(b.id)} className="p-2 hover:bg-emerald-50 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors" title="Unduh">
                                                            <Download className="w-4 h-4" />
                                                        </button>
                                                        <button onClick={() => handleDeleteBerkas(b.id)} className="p-2 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-lg transition-colors" title="Hapus">
                                                            <Trash2 className="w-4 h-4" />
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        )}
                    </div>
                );

            default:
                return null;
        }
    };

    return (
        <div className="fixed inset-0 z-[90] overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div className="flex min-h-full items-center justify-center p-4">
                <div className="relative w-full max-w-6xl bg-white rounded-[2rem] shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
                    {/* Header */}
                    <div className="px-8 pt-8 pb-4 flex items-center justify-between border-b border-slate-100 shrink-0">
                        <div>
                            <h3 className="text-xl font-black text-slate-800 uppercase tracking-tighter flex items-center gap-3">
                                <div className="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center">
                                    <User className="w-4 h-4 text-emerald-600" />
                                </div>
                                DETAIL DATA <span className="text-emerald-600">SISWA</span>
                            </h3>
                            <p className="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">
                                {siswa.nama} &middot; {siswa.nisn || siswa.nis || '-'}
                            </p>
                        </div>
                        <button onClick={onClose}
                            className="w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-slate-100 rounded-full transition-all">
                            <X className="w-5 h-5 text-slate-500" />
                        </button>
                    </div>

                    {/* Body */}
                    <div className="flex flex-col lg:flex-row flex-1 overflow-hidden">
                        {/* Left Panel — Identity Card */}
                        <div className="w-full lg:w-[220px] shrink-0 bg-gradient-to-b from-slate-50 to-white border-r border-slate-100 p-6 flex flex-col items-center gap-4">
                            {siswa.foto ? (
                                <img src={`${storageBase}/storage/${siswa.foto}`} alt={siswa.nama}
                                    className="w-28 h-28 rounded-2xl object-cover border-2 border-white shadow-lg" />
                            ) : (
                                <div className="w-28 h-28 rounded-2xl bg-emerald-50 flex items-center justify-center border-2 border-white shadow-lg">
                                    <User className="w-10 h-10 text-emerald-400" />
                                </div>
                            )}
                            <div className="text-center">
                                <h2 className="text-base font-black text-slate-800 leading-tight">{siswa.nama}</h2>
                                <p className="text-[11px] text-slate-500 font-mono font-bold mt-1">{siswa.nisn || '-'}</p>
                            </div>
                            <div className="flex flex-wrap justify-center gap-2">
                                <span className="px-3 py-1.5 rounded-lg text-[10px] font-bold bg-blue-50 text-blue-700">
                                    {siswa.kelas_nama || 'Belum ada kelas'}
                                </span>
                                <span className={`px-3 py-1.5 rounded-lg text-[10px] font-bold capitalize ${statusColor}`}>
                                    {siswa.status}
                                </span>
                            </div>
                            {detail?.tahun_ajaran && (
                                <p className="text-[10px] text-slate-400 font-bold">
                                    TA. {detail.tahun_ajaran}
                                </p>
                            )}
                            {detail?.wali_kelas && (
                                <div className="w-full pt-3 border-t border-slate-200 text-center">
                                    <p className="text-[9px] text-slate-400 uppercase tracking-widest font-bold">Wali Kelas</p>
                                    <p className="text-xs font-bold text-slate-600 mt-0.5">{detail.wali_kelas}</p>
                                </div>
                            )}
                        </div>

                        {/* Right Panel — Tabs & Content */}
                        <div className="flex-1 flex flex-col overflow-hidden">
                            {/* Tab Bar */}
                            <div className="flex gap-1 px-6 pt-4 border-b border-slate-100 overflow-x-auto shrink-0">
                                {TABS.map(tab => (
                                    <button key={tab.key} onClick={() => handleTabChange(tab.key)}
                                        className={`flex items-center gap-2 px-4 py-3 text-[10px] font-black uppercase tracking-widest rounded-t-xl transition-all whitespace-nowrap ${
                                            activeTab === tab.key
                                                ? 'bg-white text-slate-800 border-2 border-b-white border-slate-100 -mb-[2px] z-10'
                                                : 'text-slate-400 hover:text-slate-600'
                                        }`}>
                                        <tab.icon className="w-3.5 h-3.5" />
                                        {tab.label}
                                    </button>
                                ))}
                            </div>

                            {/* Tab Content */}
                            <div className="flex-1 overflow-y-auto p-6">
                                {TabContent()}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ModalDetailSiswa;
