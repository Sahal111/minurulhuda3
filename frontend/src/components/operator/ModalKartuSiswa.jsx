import React, { useState, useEffect } from 'react';
import { X, Eye, Download, Trash2, Plus, Award, Gem, FolderOpen, Loader2, User } from 'lucide-react';
import { siswaAPI } from '../../api/operator';

const TABS = [
    { key: 'prestasi', label: 'Prestasi', icon: Award },
    { key: 'beasiswa', label: 'Beasiswa', icon: Gem },
    { key: 'berkas', label: 'Berkas Digital', icon: FolderOpen },
];

const ModalKartuSiswa = ({ isOpen, onClose, siswa, onSuccess }) => {
    const [activeTab, setActiveTab] = useState('prestasi');
    const [prestasi, setPrestasi] = useState([]);
    const [beasiswa, setBeasiswa] = useState([]);
    const [berkas, setBerkas] = useState([]);
    const [loadingTab, setLoadingTab] = useState(false);

    // Form Prestasi
    const [prestasiForm, setPrestasiForm] = useState({ nama: '', jenis: '', tingkat: '', tahun: '', penyelenggara: '', keterangan: '' });
    const [prestasiFile, setPrestasiFile] = useState(null);
    const [editPrestasiId, setEditPrestasiId] = useState(null);

    // Form Beasiswa
    const [beasiswaForm, setBeasiswaForm] = useState({ nama: '', jenis: '', nominal: '', tahun_mulai: '', tahun_selesai: '', keterangan: '' });

    // Form Berkas
    const [berkasJenis, setBerkasJenis] = useState('');
    const [berkasFile, setBerkasFile] = useState(null);

    const [submitting, setSubmitting] = useState(false);

    useEffect(() => {
        if (isOpen && siswa) {
            setActiveTab('prestasi');
            loadPrestasi();
        }
    }, [isOpen, siswa?.id]);

    const apiBase = (import.meta.env.VITE_API_URL || 'http://localhost:8000/api').replace('/api', '');

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

    // ── Prestasi ──
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

    const handleDeletePrestasi = async (id) => {
        if (!window.confirm('Hapus prestasi ini?')) return;
        try {
            await siswaAPI.destroyPrestasi(siswa.id, id);
            loadPrestasi();
        } catch (err) { alert('Gagal menghapus'); }
    };

    const handleEditPrestasi = (p) => {
        setPrestasiForm({ nama: p.nama, jenis: p.jenis || '', tingkat: p.tingkat || '', tahun: p.tahun || '', penyelenggara: p.penyelenggara || '', keterangan: p.keterangan || '' });
        setEditPrestasiId(p.id);
    };

    // ── Beasiswa ──
    const handleSubmitBeasiswa = async (e) => {
        e.preventDefault();
        setSubmitting(true);
        try {
            await siswaAPI.storeBeasiswa(siswa.id, beasiswaForm);
            setBeasiswaForm({ nama: '', jenis: '', nominal: '', tahun_mulai: '', tahun_selesai: '', keterangan: '' });
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

    // ── Berkas ──
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

    if (!isOpen || !siswa) return null;

    return (
        <div className="fixed inset-0 z-[90] overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div className="flex min-h-full items-center justify-center p-4">
                <div className="relative w-full max-w-5xl bg-white rounded-[2rem] shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
                    <div className="px-8 pt-8 pb-4 flex items-center justify-between border-b border-slate-100 shrink-0">
                        <div>
                            <h3 className="text-xl font-black text-slate-800 uppercase tracking-tighter flex items-center gap-3">
                                <div className="w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center">
                                    <Eye className="w-4 h-4 text-blue-500" />
                                </div>
                                KARTU IDENTITAS <span className="text-blue-500">SISWA</span>
                            </h3>
                            <p className="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">{siswa.nama}</p>
                        </div>
                        <button onClick={onClose} className="w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-slate-100 rounded-full transition-all">
                            <X className="w-5 h-5 text-slate-500" />
                        </button>
                    </div>

                    {/* Profile Header */}
                    <div className="px-8 py-6 bg-gradient-to-br from-blue-50 to-white border-b border-slate-100">
                        <div className="flex items-center gap-6">
                            {siswa.foto ? (
                                <img src={`${apiBase}/storage/${siswa.foto}`} alt={siswa.nama} className="w-20 h-20 rounded-2xl object-cover border-2 border-white shadow-lg" />
                            ) : (
                                <div className="w-20 h-20 rounded-2xl bg-blue-100 flex items-center justify-center border-2 border-white shadow-lg">
                                    <User className="w-8 h-8 text-blue-500" />
                                </div>
                            )}
                            <div className="flex-1">
                                <div className="flex items-center gap-2">
                                    <h2 className="text-lg font-black text-slate-800">{siswa.nama}</h2>
                                    {siswa.is_mutasi_masuk && (
                                        <span className="px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider bg-amber-100 text-amber-700">MUTASI</span>
                                    )}
                                </div>
                                <p className="text-sm text-slate-500 mt-0.5">NISN: {siswa.nisn || '-'} &middot; NIS: {siswa.nis || '-'}</p>
                                <div className="flex gap-3 mt-2">
                                    <span className="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-blue-100 text-blue-700">{siswa.kelas_nama || 'Belum ada kelas'}</span>
                                    <span className="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 capitalize">{siswa.status}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Tabs */}
                    <div className="flex gap-1 px-8 pt-4 border-b border-slate-100">
                        {TABS.map(tab => (
                            <button key={tab.key} onClick={() => handleTabChange(tab.key)}
                                className={`flex items-center gap-2 px-4 py-3 text-[10px] font-black uppercase tracking-widest rounded-t-xl transition-all ${activeTab === tab.key ? 'bg-white text-slate-800 border-2 border-b-white border-slate-100 -mb-[2px] z-10' : 'text-slate-400 hover:text-slate-600'}`}>
                                <tab.icon className="w-3.5 h-3.5" />
                                {tab.label}
                            </button>
                        ))}
                    </div>

                    {/* Tab Content */}
                    <div className="flex-1 overflow-y-auto p-8">
                        {loadingTab ? (
                            <div className="flex justify-center py-10">
                                <Loader2 className="w-6 h-6 text-blue-500 animate-spin" />
                            </div>
                        ) : activeTab === 'prestasi' ? (
                            <div className="space-y-6">
                                <div className="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                                    <form onSubmit={handleSubmitPrestasi} className="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                                        <div className="flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Prestasi <span className="text-rose-400">*</span></label>
                                            <input value={prestasiForm.nama} onChange={e => setPrestasiForm({ ...prestasiForm, nama: e.target.value })} required placeholder="Contoh: Juara 1 Lomba Pidato"
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm" />
                                        </div>
                                        <div className="flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis</label>
                                            <select value={prestasiForm.jenis} onChange={e => setPrestasiForm({ ...prestasiForm, jenis: e.target.value })}
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm">
                                                <option value="">Pilih...</option>
                                                <option value="Akademik">Akademik</option>
                                                <option value="Non Akademik">Non Akademik</option>
                                            </select>
                                        </div>
                                        <div className="flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tingkat</label>
                                            <select value={prestasiForm.tingkat} onChange={e => setPrestasiForm({ ...prestasiForm, tingkat: e.target.value })}
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm">
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
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm" />
                                        </div>
                                        <div className="flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Penyelenggara</label>
                                            <input value={prestasiForm.penyelenggara} onChange={e => setPrestasiForm({ ...prestasiForm, penyelenggara: e.target.value })} placeholder="Contoh: Kemdikbud"
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm" />
                                        </div>
                                        <div className="flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Keterangan</label>
                                            <input value={prestasiForm.keterangan} onChange={e => setPrestasiForm({ ...prestasiForm, keterangan: e.target.value })} placeholder="Keterangan tambahan"
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm" />
                                        </div>
                                        <div className="flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Bukti (Opsional)</label>
                                            <input type="file" accept=".jpg,.jpeg,.png,.pdf" onChange={e => setPrestasiFile(e.target.files?.[0] || null)}
                                                className="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-2xl text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100" />
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
                                                <Plus className="w-4 h-4" /> {editPrestasiId ? 'Simpan' : 'Tambah Data'}
                                            </button>
                                        </div>
                                    </form>
                                </div>

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
                                                            <Award className="w-4 h-4 text-amber-500 shrink-0" />
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
                                                                <a href={`${apiBase}/storage/${p.file_bukti}`} target="_blank" className="p-2 hover:bg-blue-50 text-slate-400 hover:text-blue-500 rounded-lg transition-colors" title="Lihat Bukti">
                                                                    <Eye className="w-4 h-4" />
                                                                </a>
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
                            </div>
                        ) : activeTab === 'beasiswa' ? (
                            <div className="space-y-6">
                                <div className="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                                    <form onSubmit={handleSubmitBeasiswa} className="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                                        <div className="flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Beasiswa <span className="text-rose-400">*</span></label>
                                            <input value={beasiswaForm.nama} onChange={e => setBeasiswaForm({ ...beasiswaForm, nama: e.target.value })} required placeholder="Contoh: PIP, BSM"
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm" />
                                        </div>
                                        <div className="flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis</label>
                                            <select value={beasiswaForm.jenis} onChange={e => setBeasiswaForm({ ...beasiswaForm, jenis: e.target.value })}
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm">
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
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm" />
                                        </div>
                                        <div className="flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun Mulai</label>
                                            <input value={beasiswaForm.tahun_mulai} onChange={e => setBeasiswaForm({ ...beasiswaForm, tahun_mulai: e.target.value })} maxLength={4} placeholder="Contoh: 2022"
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm" />
                                        </div>
                                        <div className="flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun Selesai</label>
                                            <input value={beasiswaForm.tahun_selesai} onChange={e => setBeasiswaForm({ ...beasiswaForm, tahun_selesai: e.target.value })} maxLength={4} placeholder="Contoh: 2023"
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm" />
                                        </div>
                                        <div className="flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Keterangan</label>
                                            <input value={beasiswaForm.keterangan} onChange={e => setBeasiswaForm({ ...beasiswaForm, keterangan: e.target.value })} placeholder="Keterangan tambahan"
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm" />
                                        </div>
                                        <div className="md:col-span-3 flex justify-end">
                                            <button type="submit" disabled={submitting}
                                                className="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-2 disabled:opacity-50">
                                                <Plus className="w-4 h-4" /> Tambah Data
                                            </button>
                                        </div>
                                    </form>
                                </div>

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
                                                        <button onClick={() => handleDeleteBeasiswa(b.id)} className="p-2 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-lg transition-colors">
                                                            <Trash2 className="w-4 h-4" />
                                                        </button>
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        ) : (
                            <div className="space-y-6">
                                <div className="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                                    <form onSubmit={handleSubmitBerkas} className="flex flex-col sm:flex-row items-end gap-4">
                                        <div className="w-full sm:w-1/3 flex flex-col gap-2">
                                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Berkas <span className="text-rose-400">*</span></label>
                                            <select value={berkasJenis} onChange={e => setBerkasJenis(e.target.value)} required
                                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-violet-500 outline-none text-sm">
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
                                                className="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-2xl focus:border-violet-500 outline-none text-sm file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                                        </div>
                                        <button type="submit" disabled={submitting || !berkasJenis || !berkasFile}
                                            className="w-full sm:w-auto px-6 py-3 bg-violet-600 hover:bg-violet-500 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center justify-center gap-2 h-11 shrink-0 disabled:opacity-50">
                                            <Upload className="w-4 h-4" /> Unggah
                                        </button>
                                    </form>
                                </div>

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
                                                            <a href={`${apiBase}/operator/data-siswa/${siswa.id}/berkas/${b.id}/view`} target="_blank" className="p-2 hover:bg-blue-50 text-slate-400 hover:text-blue-500 rounded-lg transition-colors" title="Lihat">
                                                                <Eye className="w-4 h-4" />
                                                            </a>
                                                            <a href={`${apiBase}/operator/data-siswa/${siswa.id}/berkas/${b.id}/download`} className="p-2 hover:bg-emerald-50 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors" title="Unduh">
                                                                <Download className="w-4 h-4" />
                                                            </a>
                                                            <button onClick={async () => { if (!window.confirm('Hapus berkas ini?')) return; try { await siswaAPI.destroyBerkas(siswa.id, b.id); loadBerkas(); onSuccess?.('Berkas dihapus'); } catch (e) { alert('Gagal'); } }}
                                                                className="p-2 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-lg transition-colors" title="Hapus">
                                                                <Trash2 className="w-4 h-4" />
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ModalKartuSiswa;
