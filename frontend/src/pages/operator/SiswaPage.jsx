import React, { useState, useEffect, useCallback } from 'react';
import { siswaAPI } from '../../api/operator';
import { Users, Search, Plus, FileSpreadsheet, UserPlus, Filter, Edit2, Trash2, Eye, AlertCircle } from 'lucide-react';
import ModalFormSiswa from '../../components/operator/siswa/ModalFormSiswa';

const OperatorSiswaPage = () => {
    const [dataSiswa, setDataSiswa] = useState([]);
    const [stats, setStats] = useState(null);
    const [kelas, setKelas] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [searchQuery, setSearchQuery] = useState('');
    const [filterKelas, setFilterKelas] = useState('');
    const [filterStatus, setFilterStatus] = useState('');
    const [pagination, setPagination] = useState(null);
    const [isFormModalOpen, setIsFormModalOpen] = useState(false);
    const [editingSiswa, setEditingSiswa] = useState(null);
    const [viewingSiswa, setViewingSiswa] = useState(null);
    const [isViewModalOpen, setIsViewModalOpen] = useState(false);
    const [deletingId, setDeletingId] = useState(null);

    const fetchData = useCallback(async (params = {}) => {
        setLoading(true);
        setError(null);
        try {
            const response = await siswaAPI.getAll({
                q: searchQuery,
                kelas: filterKelas || undefined,
                status: filterStatus || undefined,
                ...params
            });
            const { siswa, stats: s, kelas: k } = response.data;
            setDataSiswa(siswa?.data || []);
            setPagination({
                current_page: siswa?.current_page,
                last_page: siswa?.last_page,
                total: siswa?.total,
                per_page: siswa?.per_page,
            });
            setStats(s || {});
            setKelas(k || []);
        } catch (err) {
            setError(err.response?.data?.message || err.message);
        } finally {
            setLoading(false);
        }
    }, [searchQuery, filterKelas, filterStatus]);

    useEffect(() => {
        fetchData();
    }, [fetchData]);

    const handleView = async (siswaId) => {
        try {
            const response = await siswaAPI.show(siswaId);
            setViewingSiswa(response.data.siswa);
            setIsViewModalOpen(true);
        } catch (err) {
            setError(err.response?.data?.message || err.message);
        }
    };

    const handleDelete = async (id) => {
        if (!window.confirm('Yakin ingin menghapus data siswa ini?')) return;
        setDeletingId(id);
        try {
            await siswaAPI.destroy(id);
            fetchData();
        } catch (err) {
            setError(err.response?.data?.message || err.message);
        } finally {
            setDeletingId(null);
        }
    };

    const handleEdit = (siswa) => {
        setEditingSiswa(siswa);
        setIsFormModalOpen(true);
    };

    const handleAdd = () => {
        setEditingSiswa(null);
        setIsFormModalOpen(true);
    };

    const handleModalSuccess = () => {
        fetchData();
    };

    return (
        <div className="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-500">
            {/* Header Section */}
            <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                <div>
                    <h1 className="text-2xl font-bold text-slate-800 dark:text-white flex items-center gap-2">
                        <Users className="w-8 h-8 text-emerald-500" />
                        Data Siswa
                    </h1>
                    <p className="text-slate-500 dark:text-slate-400 text-sm mt-1">
                        Kelola data siswa, mutasi, dan perkembangan akademik
                    </p>
                </div>

                <div className="flex gap-2">
                    <button className="flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 rounded-xl font-medium hover:bg-emerald-100 dark:hover:bg-emerald-500/20 transition-colors">
                        <FileSpreadsheet className="w-4 h-4" />
                        <span className="hidden sm:inline">Export Excel</span>
                    </button>
                    <button
                        onClick={handleAdd}
                        className="flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-xl font-medium hover:bg-emerald-700 transition-colors shadow-sm shadow-emerald-200 dark:shadow-none"
                    >
                        <UserPlus className="w-4 h-4" />
                        <span className="hidden sm:inline">Tambah Siswa</span>
                    </button>
                </div>
            </div>

            {/* Error Alert */}
            {error && (
                <div className="flex items-start gap-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-4 rounded-2xl text-sm text-red-700 dark:text-red-400">
                    <AlertCircle className="w-5 h-5 mt-0.5 shrink-0" />
                    <span>{error}</span>
                </div>
            )}

            {/* Stats Cards */}
            {stats && (
                <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div className="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800">
                        <div className="text-slate-500 dark:text-slate-400 text-xs font-medium mb-1">TOTAL SISWA</div>
                        <div className="text-2xl font-bold text-slate-800 dark:text-white">{stats.total}</div>
                    </div>
                    <div className="bg-emerald-50 dark:bg-emerald-900/20 p-5 rounded-2xl border border-emerald-100 dark:border-emerald-800/30">
                        <div className="text-emerald-600 dark:text-emerald-400 text-xs font-medium mb-1">SISWA AKTIF</div>
                        <div className="text-2xl font-bold text-emerald-700 dark:text-emerald-300">{stats.aktif}</div>
                    </div>
                    <div className="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 flex justify-between">
                        <div>
                            <div className="text-slate-500 dark:text-slate-400 text-xs font-medium mb-1">LAKI-LAKI</div>
                            <div className="text-2xl font-bold text-slate-800 dark:text-white">{stats.laki}</div>
                        </div>
                        <div className="text-right">
                            <div className="text-slate-500 dark:text-slate-400 text-xs font-medium mb-1">PEREMPUAN</div>
                            <div className="text-2xl font-bold text-slate-800 dark:text-white">{stats.perempuan}</div>
                        </div>
                    </div>
                    <div className="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 flex justify-between">
                        <div>
                            <div className="text-slate-500 dark:text-slate-400 text-xs font-medium mb-1">LULUS</div>
                            <div className="text-2xl font-bold text-slate-800 dark:text-white">{stats.lulus}</div>
                        </div>
                        <div className="text-right">
                            <div className="text-slate-500 dark:text-slate-400 text-xs font-medium mb-1">PINDAH</div>
                            <div className="text-2xl font-bold text-slate-800 dark:text-white">{stats.pindah}</div>
                        </div>
                    </div>
                </div>
            )}

            {/* Filter and Table Section */}
            <div className="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
                <div className="p-4 border-b border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row gap-4 justify-between bg-slate-50/50 dark:bg-slate-900/50">
                    <div className="relative flex-1 max-w-md">
                        <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" />
                        <input
                            type="text"
                            placeholder="Cari NIS, NISN, atau Nama Siswa..."
                            className="w-full pl-9 pr-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all dark:text-white"
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                        />
                    </div>
                    <div className="flex gap-2">
                        <button className="px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 flex items-center gap-2">
                            <Filter className="w-4 h-4" /> Filter
                        </button>
                    </div>
                </div>

                <div className="overflow-x-auto">
                    <table className="w-full text-left text-sm whitespace-nowrap">
                        <thead className="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase text-[11px] font-semibold tracking-wider">
                            <tr>
                                <th className="px-6 py-4">No</th>
                                <th className="px-6 py-4">Siswa</th>
                                <th className="px-6 py-4">Kelas</th>
                                <th className="px-6 py-4">L/P</th>
                                <th className="px-6 py-4">Status</th>
                                <th className="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-slate-100 dark:divide-slate-800">
                            {loading ? (
                                <tr>
                                    <td colSpan="6" className="px-6 py-10 text-center text-slate-500">
                                        Memuat data...
                                    </td>
                                </tr>
                            ) : dataSiswa.length === 0 ? (
                                <tr>
                                    <td colSpan="6" className="px-6 py-10 text-center text-slate-500">
                                        Tidak ada data siswa.
                                    </td>
                                </tr>
                            ) : (
                                dataSiswa.map((item, index) => (
                                    <tr key={item.id} className="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                        <td className="px-6 py-4 text-slate-500">{index + 1}</td>
                                        <td className="px-6 py-4">
                                            <div className="font-medium text-slate-900 dark:text-white">{item.nama}</div>
                                            <div className="text-xs text-slate-500">NIS: {item.nis} | NISN: {item.nisn}</div>
                                        </td>
                                        <td className="px-6 py-4">
                                            <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                                                {item.kelas_nama || '-'}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4">{item.jenis_kelamin}</td>
                                        <td className="px-6 py-4">
                                            <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                                                item.status === 'aktif' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' :
                                                'bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-400'
                                            }`}>
                                                {item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 text-right">
                                            <div className="flex items-center justify-end gap-2">
                                                <button
                                                    onClick={() => handleView(item.id)}
                                                    className="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                                    title="Detail"
                                                >
                                                    <Eye className="w-4 h-4" />
                                                </button>
                                                <button
                                                    onClick={() => handleEdit(item)}
                                                    className="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors"
                                                    title="Edit"
                                                >
                                                    <Edit2 className="w-4 h-4" />
                                                </button>
                                                <button
                                                    onClick={() => handleDelete(item.id)}
                                                    disabled={deletingId === item.id}
                                                    className="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors disabled:opacity-50"
                                                    title="Hapus"
                                                >
                                                    <Trash2 className="w-4 h-4" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                ))
                            )}
                        </tbody>
                    </table>
                </div>
            </div>

            {/* Modal Form */}
            <ModalFormSiswa
                isOpen={isFormModalOpen}
                onClose={() => { setIsFormModalOpen(false); setEditingSiswa(null); }}
                onSuccess={handleModalSuccess}
                siswa={editingSiswa}
            />

            {/* Modal Detail */}
            <ModalFormSiswa
                isOpen={isViewModalOpen}
                onClose={() => { setIsViewModalOpen(false); setViewingSiswa(null); }}
                siswa={viewingSiswa}
                readonly={true}
            />
        </div>
    );
};

export default OperatorSiswaPage;