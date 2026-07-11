import React, { useState, useEffect } from 'react';
import { X, Trash2, Undo2, ChevronLeft, ChevronRight, Info, GraduationCap } from 'lucide-react';
import { semesterAPI } from '../../api/operator';

const ModalTrashSemester = ({ isOpen, onClose, onSuccess }) => {
    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [pagination, setPagination] = useState({ current_page: 1, last_page: 1, total: 0, from: 0, to: 0 });
    const [page, setPage] = useState(1);
    const [processing, setProcessing] = useState(null);

    const fetchTrash = async (p = 1) => {
        setLoading(true);
        try {
            const res = await semesterAPI.trash({ page: p });
            const { semesters } = res.data;
            setData(semesters?.data || []);
            setPagination({
                current_page: semesters?.current_page ?? 1,
                last_page: semesters?.last_page ?? 1,
                total: semesters?.total ?? 0,
                from: semesters?.from ?? 0,
                to: semesters?.to ?? 0,
            });
        } catch (err) {
            console.error(err);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        if (isOpen) { setPage(1); fetchTrash(1); }
    }, [isOpen]);

    const handleRestore = async (id, nama) => {
        if (!window.confirm(`Pulihkan semester "${nama}"?`)) return;
        setProcessing(id);
        try {
            await semesterAPI.restore(id);
            onSuccess?.(`Semester "${nama}" berhasil dipulihkan`);
            fetchTrash(page);
        } catch (err) {
            alert(err.response?.data?.message || 'Gagal memulihkan data');
        } finally {
            setProcessing(null);
        }
    };

    const handleForceDelete = async (id, nama) => {
        if (!window.confirm(`Hapus permanen "${nama}"? Data TIDAK dapat dipulihkan!`)) return;
        setProcessing(id);
        try {
            await semesterAPI.forceDelete(id);
            onSuccess?.(`Semester "${nama}" dihapus permanen`);
            fetchTrash(page);
        } catch (err) {
            alert(err.response?.data?.message || 'Gagal menghapus permanen');
        } finally {
            setProcessing(null);
        }
    };

    if (!isOpen) return null;

    return (
        <div className="fixed inset-0 z-[80] overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div className="flex min-h-full items-center justify-center p-4">
                <div className="relative w-full max-w-2xl bg-white rounded-[2rem] shadow-2xl overflow-hidden max-h-[85vh] flex flex-col">
                    <div className="px-8 pt-8 pb-6 flex items-center justify-between shrink-0 border-b border-slate-100">
                        <div>
                            <h3 className="text-xl font-black text-slate-800 uppercase tracking-tighter flex items-center gap-3">
                                <div className="w-9 h-9 rounded-xl bg-rose-100 flex items-center justify-center">
                                    <Trash2 className="w-4 h-4 text-rose-500" />
                                </div>
                                RECYCLE <span className="text-rose-500">BIN</span>
                            </h3>
                            <p className="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Semester yang dihapus — dapat dipulihkan</p>
                        </div>
                        <button onClick={onClose} className="w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-slate-100 rounded-full transition-all">
                            <X className="w-5 h-5 text-slate-500" />
                        </button>
                    </div>

                    <div className="flex-1 overflow-y-auto p-8">
                        {loading ? (
                            <div className="flex justify-center py-10">
                                <span className="w-6 h-6 border-2 border-rose-500 border-t-transparent rounded-full animate-spin" />
                            </div>
                        ) : data.length === 0 ? (
                            <div className="text-center py-12 text-slate-400">
                                <div className="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <Trash2 className="w-8 h-8 opacity-30" />
                                </div>
                                <p className="font-bold text-sm">Recycle Bin kosong</p>
                                <p className="text-xs mt-1">Tidak ada semester yang dihapus</p>
                            </div>
                        ) : (
                            <div className="space-y-3">
                                {data.map(item => (
                                    <div key={item.id} className="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                        <div className="w-10 h-10 rounded-xl bg-slate-200 flex items-center justify-center shrink-0">
                                            <GraduationCap className="w-5 h-5 text-slate-400" />
                                        </div>
                                        <div className="flex-1 min-w-0">
                                            <p className="text-sm font-bold text-slate-800 truncate">{item.nama} — {item.tahun_ajaran}</p>
                                            <p className="text-[10px] text-slate-400">Dihapus: {item.deleted_at}</p>
                                        </div>
                                        <div className="flex gap-2 shrink-0">
                                            <button onClick={() => handleRestore(item.id, `${item.nama} — ${item.tahun_ajaran}`)} disabled={processing === item.id}
                                                className="px-3 py-2 bg-emerald-100 hover:bg-emerald-200 text-emerald-700 rounded-xl text-[10px] font-bold transition-all flex items-center gap-1 disabled:opacity-50">
                                                <Undo2 className="w-3 h-3" /> Pulihkan
                                            </button>
                                            <button onClick={() => handleForceDelete(item.id, `${item.nama} — ${item.tahun_ajaran}`)} disabled={processing === item.id}
                                                className="px-3 py-2 bg-rose-100 hover:bg-rose-200 text-rose-700 rounded-xl text-[10px] font-bold transition-all flex items-center gap-1 disabled:opacity-50">
                                                <Trash2 className="w-3 h-3" /> Hapus
                                            </button>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        )}

                        {pagination.last_page > 1 && (
                            <div className="mt-6 flex items-center justify-between">
                                <p className="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                    Menampilkan {pagination.from}–{pagination.to} dari {pagination.total}
                                </p>
                                <div className="flex items-center gap-2">
                                    <button onClick={() => { setPage(p => p - 1); fetchTrash(page - 1); }} disabled={page <= 1}
                                        className="px-3 py-2 text-xs font-bold text-slate-500 bg-slate-100 rounded-xl hover:bg-slate-200 transition-all flex items-center gap-1 disabled:opacity-40">
                                        <ChevronLeft className="w-4 h-4" /> Sebelumnya
                                    </button>
                                    <button onClick={() => { setPage(p => p + 1); fetchTrash(page + 1); }} disabled={page >= pagination.last_page}
                                        className="px-3 py-2 text-xs font-bold text-slate-500 bg-slate-100 rounded-xl hover:bg-slate-200 transition-all flex items-center gap-1 disabled:opacity-40">
                                        Berikutnya <ChevronRight className="w-4 h-4" />
                                    </button>
                                </div>
                            </div>
                        )}
                    </div>

                    <div className="px-8 py-5 bg-slate-50/50 border-t border-slate-100 shrink-0">
                        <p className="text-[10px] text-slate-400 flex items-center gap-1.5">
                            <Info className="w-3 h-3 shrink-0" />
                            Data yang dihapus permanen <strong>tidak dapat dipulihkan</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ModalTrashSemester;
