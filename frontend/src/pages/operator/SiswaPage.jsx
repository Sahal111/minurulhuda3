import React, { useState, useEffect, useCallback, useRef } from 'react';
import {
    Users, UserCheck, User, LogOut, GraduationCap,
    Search, Plus, Upload, Download, Trash2, Archive,
    Edit3, Eye, FileText, Undo2, ChevronDown,
    AlertCircle, CheckCircle, AlertTriangle, Loader2,
    ArrowRightCircle, Filter,
} from 'lucide-react';
import { siswaAPI } from '../../api/operator';
import ModalFormSiswa from '../../components/operator/ModalFormSiswa';
import ModalMutasiSiswa from '../../components/operator/ModalMutasiSiswa';
import ModalReactivateSiswa from '../../components/operator/ModalReactivateSiswa';
import ModalImportSiswa from '../../components/operator/ModalImportSiswa';
import ModalTrashSiswa from '../../components/operator/ModalTrashSiswa';
import ModalDetailSiswa from '../../components/operator/ModalDetailSiswa';

// ─── KONSTANTA ────────────────────────────────────────────────────────────────
const STATUS_MAP = {
    aktif:    { label: 'Aktif',     dot: 'bg-emerald-500', text: 'text-emerald-600 dark:text-emerald-400' },
    lulus:    { label: 'Lulus',     dot: 'bg-blue-500',    text: 'text-blue-600 dark:text-blue-400' },
    pindah:   { label: 'Pindah',    dot: 'bg-amber-500',   text: 'text-amber-600 dark:text-amber-400' },
    nonaktif: { label: 'Non-Aktif', dot: 'bg-rose-500',    text: 'text-rose-600 dark:text-rose-400' },
};

const STAT_ITEMS = [
    { key: 'total',     label: 'Total Siswa', icon: Users,          color: 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' },
    { key: 'aktif',     label: 'Aktif',       icon: UserCheck,      color: 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400' },
    { key: 'laki',      label: 'Laki-laki',   icon: User,           color: 'bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400' },
    { key: 'perempuan', label: 'Perempuan',   icon: User,           color: 'bg-pink-50 dark:bg-pink-500/10 text-pink-600 dark:text-pink-400' },
    { key: 'lulus',     label: 'Lulus',       icon: GraduationCap,  color: 'bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400' },
    { key: 'pindah',    label: 'Pindah',      icon: LogOut,         color: 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400' },
];

// ─── KOMPONEN KECIL ───────────────────────────────────────────────────────────
const Toast = ({ msg, color = 'emerald', onDone }) => {
    useEffect(() => {
        const t = setTimeout(onDone, 3500);
        return () => clearTimeout(t);
    }, [onDone]);
    const cls = {
        emerald: 'bg-emerald-50 border-emerald-200 text-emerald-700',
        rose:    'bg-rose-50 border-rose-200 text-rose-700',
        amber:   'bg-amber-50 border-amber-200 text-amber-700',
    };
    return (
        <div className={`fixed bottom-6 right-6 z-[999] px-5 py-3.5 rounded-2xl border shadow-lg text-sm font-bold flex items-center gap-2 ${cls[color] ?? cls.emerald}`}>
            <CheckCircle className="w-4 h-4 shrink-0" />
            {msg}
        </div>
    );
};

const StatusBadge = ({ status }) => {
    const s = STATUS_MAP[status] ?? { label: status, dot: 'bg-slate-400', text: 'text-slate-500' };
    return (
        <span className={`flex items-center gap-1.5 text-[10px] font-black uppercase tracking-widest ${s.text}`}>
            <span className={`w-1.5 h-1.5 rounded-full ${s.dot}`} />
            {s.label}
        </span>
    );
};

const AvatarFallback = () => (
    <div className="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center">
        <User className="w-5 h-5 text-emerald-400" />
    </div>
);

// ─── KOMPONEN UTAMA ───────────────────────────────────────────────────────────
const OperatorSiswaPage = () => {
    // Data
    const [dataSiswa, setDataSiswa]   = useState([]);
    const [stats, setStats]           = useState(null);
    const [kelas, setKelas]           = useState([]);
    const [tahunAjarans, setTahunAjarans] = useState([]);
    const [pagination, setPagination] = useState(null);

    // Filter
    const [q, setQ]                   = useState('');
    const [filterKelas, setFilterKelas]       = useState('all');
    const [filterStatus, setFilterStatus]     = useState('all');
    const [filterJenisMasuk, setFilterJenisMasuk] = useState('all');
    const [currentPage, setCurrentPage]       = useState(1);

    // Modals
    const [showFormModal, setShowFormModal] = useState(false);
    const [editSiswa, setEditSiswa]         = useState(null);
    const [mutasiSiswa, setMutasiSiswa]     = useState(null);
    const [reactivateSiswa, setReactivateSiswa] = useState(null);
    const [kartuSiswa, setKartuSiswa]       = useState(null);
    const [showImport, setShowImport]       = useState(false);
    const [showTrash, setShowTrash]         = useState(false);

    // UI state
    const [loading, setLoading]       = useState(true);
    const [deletingId, setDeletingId] = useState(null);
    const [toast, setToast]           = useState(null);
    const [openExport, setOpenExport] = useState(false);
    const exportRef                   = useRef(null);

    // ── Fetch ────────────────────────────────────────────────────────────────
    const fetchData = useCallback(async (page = 1) => {
        setLoading(true);
        try {
            const params = { page };
            if (q)                              params.q            = q;
            if (filterKelas !== 'all')          params.kelas        = filterKelas;
            if (filterStatus !== 'all')         params.status       = filterStatus;
            if (filterJenisMasuk !== 'all')     params.jenis_masuk  = filterJenisMasuk;

            const res = await siswaAPI.getAll(params);
            const { siswa, stats: s, kelas: k, tahunAjarans: ta } = res.data;

            setDataSiswa(siswa?.data || []);
            setPagination({
                current_page: siswa?.current_page ?? 1,
                last_page:    siswa?.last_page ?? 1,
                total:        siswa?.total ?? 0,
                from:         siswa?.from ?? 0,
                to:           siswa?.to ?? 0,
            });
            setStats(s ?? {});
            setKelas(k ?? []);
            setTahunAjarans(ta ?? []);
        } catch (err) {
            showToast(err.response?.data?.message || 'Gagal memuat data', 'rose');
        } finally {
            setLoading(false);
        }
    }, [q, filterKelas, filterStatus, filterJenisMasuk]);

    useEffect(() => {
        setCurrentPage(1);
        fetchData(1);
    }, [fetchData]);

    // close export dropdown on outside click
    useEffect(() => {
        const handler = (e) => {
            if (exportRef.current && !exportRef.current.contains(e.target)) setOpenExport(false);
        };
        document.addEventListener('mousedown', handler);
        return () => document.removeEventListener('mousedown', handler);
    }, []);

    // ── Helpers ──────────────────────────────────────────────────────────────
    const showToast = (msg, color = 'emerald') => setToast({ msg, color });

    const handleDelete = async (id, nama) => {
        if (!window.confirm(`Hapus data siswa "${nama}"?`)) return;
        setDeletingId(id);
        try {
            await siswaAPI.destroy(id);
            showToast('Data siswa berhasil dihapus', 'rose');
            fetchData(currentPage);
        } catch (err) {
            showToast(err.response?.data?.message || 'Gagal menghapus data', 'rose');
        } finally {
            setDeletingId(null);
        }
    };

    const handlePageChange = (page) => {
        setCurrentPage(page);
        fetchData(page);
    };

    const handleSearch = (e) => {
        e.preventDefault();
        setCurrentPage(1);
        fetchData(1);
    };

    // Export URL builder
    const buildExportUrl = (mode) => {
        const base = (import.meta.env.VITE_API_URL || 'http://localhost:8000/api').replace('/api', '');
        const params = new URLSearchParams({ mode });
        if (q)                          params.set('q', q);
        if (filterKelas !== 'all')      params.set('kelas', filterKelas);
        if (filterStatus !== 'all')     params.set('status', filterStatus);
        return `${base}/operator/data-siswa/export?${params.toString()}`;
    };

    // ── Render ───────────────────────────────────────────────────────────────
    return (
        <div className="p-4 lg:p-8 space-y-6 animate-up">

            {/* ── STATS ── */}
            <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
                {STAT_ITEMS.map(({ key, label, icon: Icon, color }) => (
                    <div key={key} className="bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-100 dark:border-slate-800 flex items-center gap-3 shadow-sm">
                        <div className={`p-2.5 rounded-xl shrink-0 ${color}`}>
                            <Icon className="w-4 h-4" />
                        </div>
                        <div>
                            <p className="text-xl font-black text-slate-900 dark:text-white">
                                {stats ? (stats[key] ?? 0) : '—'}
                            </p>
                            <p className="text-[9px] font-black uppercase tracking-widest text-slate-400">{label}</p>
                        </div>
                    </div>
                ))}
            </div>

            {/* ── ACTION BAR ── */}
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <h2 className="font-black text-xl text-slate-900 dark:text-white tracking-tight">Data Siswa</h2>

                <div className="flex items-center gap-2 flex-wrap">
                    {/* Import */}
                    <button onClick={() => setShowImport(true)}
                        className="group px-5 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:border-blue-500/50 transition-all shadow-sm">
                        <Upload className="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors" />
                        <span className="text-slate-600 dark:text-slate-400">Import</span>
                    </button>

                    {/* Recycle Bin */}
                    <button onClick={() => setShowTrash(true)}
                        className="group relative px-5 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:border-rose-500/50 transition-all shadow-sm">
                        <Trash2 className="w-4 h-4 text-slate-400 group-hover:text-rose-500 transition-colors" />
                        <span className="text-slate-600 dark:text-slate-400">Recycle Bin</span>
                    </button>

                    {/* Export Dropdown */}
                    <div className="relative" ref={exportRef}>
                        <button
                            onClick={() => setOpenExport(!openExport)}
                            className="group px-5 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:border-emerald-500/50 transition-all shadow-sm"
                        >
                            <Download className="w-4 h-4 text-slate-400 group-hover:text-emerald-500 transition-colors" />
                            <span className="text-slate-600 dark:text-slate-400">Export</span>
                            <ChevronDown className={`w-3.5 h-3.5 text-slate-400 transition-transform duration-200 ${openExport ? 'rotate-180' : ''}`} />
                        </button>

                        {openExport && (
                            <div className="absolute right-0 top-full mt-2 w-72 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl z-50 overflow-hidden">
                                <div className="px-4 py-3 border-b border-slate-100 dark:border-slate-800">
                                    <p className="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pilih Format Export</p>
                                    <p className="text-[10px] text-slate-400 mt-0.5">Filter aktif akan ikut diterapkan</p>
                                </div>

                                <a
                                    href={buildExportUrl('zip')}
                                    onClick={() => setOpenExport(false)}
                                    className="flex items-start gap-3 px-4 py-4 hover:bg-emerald-50 dark:hover:bg-emerald-500/5 transition-colors group"
                                >
                                    <div className="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center shrink-0">
                                        <Archive className="w-4 h-4 text-emerald-600 dark:text-emerald-400" />
                                    </div>
                                    <div>
                                        <p className="text-xs font-black text-slate-800 dark:text-white">Export ZIP</p>
                                        <p className="text-[10px] text-slate-400 mt-0.5 leading-relaxed">
                                            File <code className="bg-slate-100 dark:bg-slate-800 px-1 rounded">.zip</code> berisi Excel + folder <code className="bg-slate-100 dark:bg-slate-800 px-1 rounded">foto/</code> per siswa.
                                        </p>
                                    </div>
                                </a>

                                <div className="mx-4 border-t border-slate-100 dark:border-slate-800" />

                                <a
                                    href={buildExportUrl('pdf')}
                                    onClick={() => setOpenExport(false)}
                                    className="flex items-start gap-3 px-4 py-4 hover:bg-purple-50 dark:hover:bg-purple-500/5 transition-colors group"
                                >
                                    <div className="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-500/10 flex items-center justify-center shrink-0">
                                        <FileText className="w-4 h-4 text-purple-600 dark:text-purple-400" />
                                    </div>
                                    <div>
                                        <p className="text-xs font-black text-slate-800 dark:text-white">Export PDF Kartu Identitas</p>
                                        <p className="text-[10px] text-slate-400 mt-0.5 leading-relaxed">
                                            PDF berisi kartu identitas lengkap semua siswa. 2 kartu per halaman A4.
                                        </p>
                                    </div>
                                </a>

                                <div className="px-4 py-3 bg-slate-50/50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800">
                                    <p className="text-[10px] text-slate-400 flex items-center gap-1.5">
                                        <FileText className="w-3 h-3 shrink-0" />
                                        PDF satu siswa: klik ikon di baris tabel.
                                    </p>
                                </div>
                            </div>
                        )}
                    </div>

                    {/* Tambah Siswa */}
                    <button
                        onClick={() => { setEditSiswa(null); setShowFormModal(true); }}
                        className="px-8 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-600/20 hover:-translate-y-0.5 active:scale-95 transition-all flex items-center gap-3"
                    >
                        <Plus className="w-4 h-4" />
                        Tambah Siswa
                    </button>
                </div>
            </div>

            {/* ── SEARCH & FILTER ── */}
            <form
                onSubmit={handleSearch}
                className="bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm p-3 rounded-[2.5rem] border border-slate-200/50 dark:border-slate-800/50 flex flex-col md:flex-row gap-3 items-center"
            >
                {/* Search input */}
                <div className="relative flex-1 w-full group">
                    <Search className="absolute left-6 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors" />
                    <input
                        type="text"
                        value={q}
                        onChange={(e) => setQ(e.target.value)}
                        placeholder="Cari berdasarkan Nama, NISN, NIS, atau NIK..."
                        className="w-full pl-14 pr-6 py-4 bg-white dark:bg-slate-950 border border-slate-100 dark:border-slate-800 focus:border-emerald-500/50 rounded-[1.8rem] text-sm focus:ring-4 focus:ring-emerald-500/5 outline-none transition-all placeholder:text-slate-400 dark:text-white"
                    />
                </div>

                <div className="flex items-center gap-3 w-full md:w-auto pr-2">
                    {/* Filter Kelas */}
                    <div className="relative flex-1 md:w-44">
                        <select
                            value={filterKelas}
                            onChange={(e) => setFilterKelas(e.target.value)}
                            className="w-full pl-5 pr-10 py-4 bg-white dark:bg-slate-950 border border-slate-100 dark:border-slate-800 rounded-[1.5rem] text-xs font-bold text-slate-600 dark:text-slate-400 outline-none appearance-none cursor-pointer focus:border-emerald-500/50"
                        >
                            <option value="all">Semua Kelas</option>
                            {kelas.map((k) => (
                                <option key={k.id} value={k.id}>Kelas {k.full_name ?? k.nama}</option>
                            ))}
                        </select>
                        <ChevronDown className="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" />
                    </div>

                    {/* Filter Status */}
                    <div className="relative flex-1 md:w-44">
                        <select
                            value={filterStatus}
                            onChange={(e) => setFilterStatus(e.target.value)}
                            className="w-full pl-5 pr-10 py-4 bg-white dark:bg-slate-950 border border-slate-100 dark:border-slate-800 rounded-[1.5rem] text-xs font-bold text-slate-600 dark:text-slate-400 outline-none appearance-none cursor-pointer focus:border-emerald-500/50"
                        >
                            <option value="all">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="lulus">Lulus</option>
                            <option value="pindah">Pindah</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
                        <ChevronDown className="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" />
                    </div>

                    {/* Filter Jenis Masuk */}
                    <div className="relative flex-1 md:w-44">
                        <select
                            value={filterJenisMasuk}
                            onChange={(e) => setFilterJenisMasuk(e.target.value)}
                            className="w-full pl-5 pr-10 py-4 bg-white dark:bg-slate-950 border border-slate-100 dark:border-slate-800 rounded-[1.5rem] text-xs font-bold text-slate-600 dark:text-slate-400 outline-none appearance-none cursor-pointer focus:border-emerald-500/50"
                        >
                            <option value="all">Semua Jenis</option>
                            <option value="baru">Siswa Baru</option>
                            <option value="mutasi">Mutasi Masuk</option>
                        </select>
                        <ChevronDown className="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" />
                    </div>

                    {/* Submit */}
                    <button
                        type="submit"
                        className="px-5 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-[1.5rem] text-xs font-black uppercase tracking-widest transition-all flex items-center gap-2 shrink-0"
                    >
                        <Search className="w-4 h-4" />
                        <span className="hidden sm:inline">Cari</span>
                    </button>
                </div>
            </form>

            {/* ── TABEL ── */}
            <div className="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-200/60 dark:border-slate-800/60 overflow-hidden hover:shadow-2xl hover:shadow-slate-200/50 dark:hover:shadow-none transition-all duration-300">
                <div className="overflow-x-auto">
                    <table className="w-full text-left">
                        <thead>
                            <tr className="bg-slate-50/50 dark:bg-slate-800/30 border-b border-slate-100 dark:border-slate-800">
                                <th className="pl-10 pr-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">Siswa</th>
                                <th className="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">Identitas</th>
                                <th className="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">Kelas</th>
                                <th className="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">Gender</th>
                                <th className="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">Status</th>
                                <th className="pl-6 pr-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] text-right">Manajemen</th>
                            </tr>
                        </thead>
                        <tbody>
                            {loading ? (
                                <tr>
                                    <td colSpan="6" className="py-20 text-center">
                                        <div className="flex flex-col items-center gap-3 text-slate-400">
                                            <Loader2 className="w-8 h-8 animate-spin" />
                                            <p className="text-sm font-medium">Memuat data siswa...</p>
                                        </div>
                                    </td>
                                </tr>
                            ) : dataSiswa.length === 0 ? (
                                <tr>
                                    <td colSpan="6" className="py-20 text-center">
                                        <div className="flex flex-col items-center gap-3 text-slate-400">
                                            <Users className="w-12 h-12 opacity-30" />
                                            <p className="font-bold text-sm">Tidak ada data siswa ditemukan</p>
                                            <p className="text-xs">Coba ubah filter pencarian</p>
                                        </div>
                                    </td>
                                </tr>
                            ) : (
                                dataSiswa.map((s) => {
                                    const gender = s.jenis_kelamin === 'L'
                                        ? { label: 'Laki-laki', cls: 'bg-sky-50 text-sky-600 dark:bg-sky-500/10 dark:text-sky-400' }
                                        : { label: 'Perempuan', cls: 'bg-pink-50 text-pink-600 dark:bg-pink-500/10 dark:text-pink-400' };
                                    const apiBase = (import.meta.env.VITE_API_URL || 'http://localhost:8000/api').replace('/api', '');
                                    const pdfUrl = `${apiBase}/operator/data-siswa/${s.id}/pdf`;

                                    return (
                                        <tr key={s.id} className="border-b border-slate-50 dark:border-slate-800/50 last:border-0 hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">

                                            {/* SISWA */}
                                            <td className="pl-10 pr-6 py-5">
                                                <div className="flex items-center gap-4">
                                                    {s.foto ? (
                                                        <img
                                                            src={`${apiBase}/storage/${s.foto}`}
                                                            alt={s.nama}
                                                            className="w-10 h-10 rounded-xl object-cover border border-slate-200 dark:border-slate-700"
                                                        />
                                                    ) : (
                                                        <AvatarFallback />
                                                    )}
                                                    <div>
                                                        <div className="flex items-center gap-2">
                                                            <p className="text-sm font-bold text-slate-900 dark:text-white">{s.nama}</p>
                                                            {s.is_mutasi_masuk && (
                                                                <span className="px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 flex items-center gap-1">
                                                                    <ArrowRightCircle className="w-3 h-3" />
                                                                    MUTASI
                                                                </span>
                                                            )}
                                                        </div>
                                                        <p className="text-[10px] text-slate-400 font-medium">{s.nisn ?? '—'}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            {/* IDENTITAS */}
                                            <td className="px-6 py-5">
                                                <p className="text-xs font-mono font-bold text-slate-600 dark:text-slate-400">{s.nis ?? '—'}</p>
                                                <p className="text-[10px] text-slate-400 italic">NIS</p>
                                            </td>

                                            {/* KELAS */}
                                            <td className="px-6 py-5">
                                                <span className="px-3 py-1 rounded-lg text-[10px] font-bold bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                                                    {s.kelas_nama ?? 'Belum ada'}
                                                </span>
                                            </td>

                                            {/* GENDER */}
                                            <td className="px-6 py-5">
                                                <span className={`px-3 py-1 rounded-lg text-[10px] font-bold ${gender.cls}`}>
                                                    {gender.label}
                                                </span>
                                            </td>

                                            {/* STATUS */}
                                            <td className="px-6 py-5">
                                                <StatusBadge status={s.status} />
                                            </td>

                                            {/* MANAJEMEN */}
                                            <td className="pl-6 pr-10 py-5 text-right">
                                                <div className="flex items-center justify-end gap-1">
                                                    {/* Cetak PDF satu siswa */}
                                                    <a
                                                        href={pdfUrl}
                                                        target="_blank"
                                                        rel="noreferrer"
                                                        className="p-2 hover:bg-purple-50 dark:hover:bg-purple-500/10 text-slate-400 hover:text-purple-500 rounded-lg transition-colors"
                                                        title="Cetak Kartu PDF"
                                                    >
                                                        <FileText className="w-4 h-4" />
                                                    </a>

                                                    {/* Lihat Kartu Identitas */}
                                                    <button
                                                        onClick={() => setKartuSiswa(s)}
                                                        className="p-2 hover:bg-blue-50 dark:hover:bg-blue-500/10 text-slate-400 hover:text-blue-500 rounded-lg transition-colors"
                                                        title="Kartu Identitas"
                                                    >
                                                        <Eye className="w-4 h-4" />
                                                    </button>

                                                    {/* Mutasi — hanya jika aktif */}
                                                    {s.status === 'aktif' && (
                                                        <button
                                                            onClick={() => setMutasiSiswa(s)}
                                                            className="p-2 hover:bg-amber-50 dark:hover:bg-amber-500/10 text-slate-400 hover:text-amber-500 rounded-lg transition-colors"
                                                            title="Mutasi / Kelulusan"
                                                        >
                                                            <LogOut className="w-4 h-4" />
                                                        </button>
                                                    )}

                                                    {/* Aktifkan Kembali — hanya jika non-aktif/pindah/lulus */}
                                                    {['pindah', 'lulus', 'nonaktif'].includes(s.status) && (
                                                        <button
                                                            onClick={() => setReactivateSiswa(s)}
                                                            className="p-2 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors"
                                                            title="Aktifkan Kembali"
                                                        >
                                                            <Undo2 className="w-4 h-4" />
                                                        </button>
                                                    )}

                                                    {/* Edit */}
                                                    <button
                                                        onClick={() => { setEditSiswa(s); setShowFormModal(true); }}
                                                        className="p-2 hover:bg-amber-50 dark:hover:bg-amber-500/10 text-slate-400 hover:text-amber-500 rounded-lg transition-colors"
                                                        title="Edit Data"
                                                    >
                                                        <Edit3 className="w-4 h-4" />
                                                    </button>

                                                    {/* Hapus */}
                                                    <button
                                                        onClick={() => handleDelete(s.id, s.nama)}
                                                        disabled={deletingId === s.id}
                                                        className="p-2 hover:bg-rose-50 dark:hover:bg-rose-500/10 text-slate-400 hover:text-rose-500 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                                        title="Hapus"
                                                    >
                                                        {deletingId === s.id
                                                            ? <Loader2 className="w-4 h-4 animate-spin" />
                                                            : <Trash2 className="w-4 h-4" />
                                                        }
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    );
                                })
                            )}
                        </tbody>
                    </table>
                </div>

                {/* ── PAGINATION ── */}
                {pagination && (
                    <div className="px-10 py-8 bg-slate-50/30 dark:bg-slate-800/20 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <p className="text-[10px] text-slate-400 font-black uppercase tracking-widest">
                            Menampilkan{' '}
                            <span className="text-slate-900 dark:text-white">
                                {pagination.total > 0 ? `${pagination.from}–${pagination.to}` : '0'}
                            </span>{' '}
                            dari {pagination.total.toLocaleString('id-ID')} Siswa
                        </p>

                        <div className="flex items-center gap-1.5">
                            <button
                                onClick={() => handlePageChange(currentPage - 1)}
                                disabled={currentPage <= 1 || loading}
                                className="px-4 py-2 text-xs font-bold rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:border-emerald-500/50 disabled:opacity-40 disabled:cursor-not-allowed transition-all"
                            >
                                ← Prev
                            </button>

                            {Array.from({ length: pagination.last_page }, (_, i) => i + 1)
                                .filter((p) => p === 1 || p === pagination.last_page || Math.abs(p - currentPage) <= 1)
                                .reduce((acc, p, idx, arr) => {
                                    if (idx > 0 && p - arr[idx - 1] > 1) acc.push('...');
                                    acc.push(p);
                                    return acc;
                                }, [])
                                .map((p, idx) =>
                                    p === '...' ? (
                                        <span key={`ellipsis-${idx}`} className="px-2 text-slate-400 text-xs">…</span>
                                    ) : (
                                        <button
                                            key={p}
                                            onClick={() => handlePageChange(p)}
                                            disabled={loading}
                                            className={`w-9 h-9 text-xs font-bold rounded-xl border transition-all ${
                                                p === currentPage
                                                    ? 'bg-emerald-600 text-white border-emerald-600 shadow-sm shadow-emerald-200'
                                                    : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:border-emerald-500/50'
                                            }`}
                                        >
                                            {p}
                                        </button>
                                    )
                                )
                            }

                            <button
                                onClick={() => handlePageChange(currentPage + 1)}
                                disabled={currentPage >= pagination.last_page || loading}
                                className="px-4 py-2 text-xs font-bold rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:border-emerald-500/50 disabled:opacity-40 disabled:cursor-not-allowed transition-all"
                            >
                                Next →
                            </button>
                        </div>
                    </div>
                )}
            </div>

            {/* ── TOAST ── */}
            {toast && (
                <Toast msg={toast.msg} color={toast.color} onDone={() => setToast(null)} />
            )}

            {/* ── MODALS ── */}
            <ModalFormSiswa
                isOpen={showFormModal}
                onClose={() => { setShowFormModal(false); setEditSiswa(null); }}
                onSuccess={(msg) => { showToast(msg); fetchData(currentPage); }}
                siswa={editSiswa}
                kelas={kelas}
                tahunAjarans={tahunAjarans}
            />

            <ModalMutasiSiswa
                isOpen={!!mutasiSiswa}
                onClose={() => setMutasiSiswa(null)}
                onSuccess={(msg) => { showToast(msg); fetchData(currentPage); }}
                siswa={mutasiSiswa}
            />

            <ModalReactivateSiswa
                isOpen={!!reactivateSiswa}
                onClose={() => setReactivateSiswa(null)}
                onSuccess={(msg) => { showToast(msg); fetchData(currentPage); }}
                siswa={reactivateSiswa}
                kelas={kelas}
                tahunAjarans={tahunAjarans}
            />

            <ModalDetailSiswa
                isOpen={!!kartuSiswa}
                onClose={() => setKartuSiswa(null)}
                siswa={kartuSiswa}
                onSuccess={(msg) => showToast(msg)}
            />

            <ModalImportSiswa
                isOpen={showImport}
                onClose={() => setShowImport(false)}
                onSuccess={(msg) => { showToast(msg); fetchData(currentPage); }}
            />

            <ModalTrashSiswa
                isOpen={showTrash}
                onClose={() => setShowTrash(false)}
                onSuccess={(msg) => { showToast(msg); fetchData(currentPage); }}
                kelas={kelas}
            />
        </div>
    );
};

export default OperatorSiswaPage;