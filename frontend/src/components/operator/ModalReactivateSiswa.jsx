import React, { useState, useEffect } from 'react';
import { X, Undo2, CheckCircle, Info } from 'lucide-react';
import { siswaAPI } from '../../api/operator';

const ModalReactivateSiswa = ({ isOpen, onClose, onSuccess, siswa, kelas = [], tahunAjarans = [] }) => {
    const [form, setForm] = useState({ kelas_id: '', tahun_ajaran_id: '', semester: 'Ganjil', tanggal_masuk: '' });
    const [submitting, setSubmitting] = useState(false);

    useEffect(() => {
        if (isOpen) {
            const aktifTa = tahunAjarans.find(ta => ta.is_active);
            setForm({ kelas_id: '', tahun_ajaran_id: aktifTa?.id?.toString() || '', semester: 'Ganjil', tanggal_masuk: new Date().toISOString().slice(0, 10) });
        }
    }, [isOpen, tahunAjarans]);

    if (!isOpen || !siswa) return null;

    const handleSubmit = async (e) => {
        e.preventDefault();
        setSubmitting(true);
        try {
            await siswaAPI.reactivate(siswa.id, form);
            onSuccess(`Siswa "${siswa.nama}" berhasil diaktifkan kembali`);
            onClose();
        } catch (err) {
            alert(err.response?.data?.message || err.message || 'Gagal mengaktifkan kembali');
        } finally {
            setSubmitting(false);
        }
    };

    return (
        <div className="fixed inset-0 z-[75] overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div className="flex min-h-full items-center justify-center p-4">
                <div className="relative w-full max-w-lg bg-white rounded-[2rem] shadow-2xl overflow-hidden">
                    <div className="px-8 pt-8 pb-4 flex items-center justify-between">
                        <div>
                            <h3 className="text-xl font-black text-slate-800 uppercase tracking-tighter flex items-center gap-3">
                                <div className="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center">
                                    <Undo2 className="w-4 h-4 text-emerald-500" />
                                </div>
                                AKTIFKAN <span className="text-emerald-500">KEMBALI</span>
                            </h3>
                            <p className="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">{siswa.nama}</p>
                        </div>
                        <button onClick={onClose} className="w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-slate-100 rounded-full transition-all">
                            <X className="w-5 h-5 text-slate-500" />
                        </button>
                    </div>

                    <form onSubmit={handleSubmit} className="p-8 pt-4 space-y-5">
                        <div className="p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-start gap-3">
                            <Info className="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" />
                            <p className="text-xs text-emerald-700 font-medium">Siswa akan diaktifkan kembali. Seluruh data akademik, nilai, dan riwayat keuangan sebelumnya tetap aman.</p>
                        </div>

                        <div className="flex flex-col gap-2">
                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kelas Baru <span className="text-rose-400">*</span></label>
                            <select value={form.kelas_id} onChange={e => setForm({ ...form, kelas_id: e.target.value })} required
                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700">
                                <option value="">-- Pilih Kelas --</option>
                                {kelas.map(k => (
                                    <option key={k.id} value={k.id}>Kelas {k.full_name || k.nama}</option>
                                ))}
                            </select>
                        </div>

                        <div className="flex flex-col gap-2">
                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun Ajaran <span className="text-rose-400">*</span></label>
                            <select value={form.tahun_ajaran_id} onChange={e => setForm({ ...form, tahun_ajaran_id: e.target.value })} required
                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700">
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                {tahunAjarans.map(ta => (
                                    <option key={ta.id} value={ta.id}>{ta.tahun} {ta.is_active ? '(Aktif)' : ''}</option>
                                ))}
                            </select>
                        </div>

                        <div className="flex flex-col gap-2">
                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Semester <span className="text-rose-400">*</span></label>
                            <select value={form.semester} onChange={e => setForm({ ...form, semester: e.target.value })} required
                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700">
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>

                        <div className="flex flex-col gap-2">
                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Masuk Kembali <span className="text-rose-400">*</span></label>
                            <input type="date" value={form.tanggal_masuk} onChange={e => setForm({ ...form, tanggal_masuk: e.target.value })} required
                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-emerald-500 outline-none text-sm text-slate-700" />
                        </div>

                        <div className="flex justify-end gap-3 pt-2">
                            <button type="button" onClick={onClose}
                                className="px-5 py-3 text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">Batal</button>
                            <button type="submit" disabled={submitting}
                                className="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-2 disabled:opacity-50">
                                {submitting ? <span className="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin" /> : <CheckCircle className="w-4 h-4" />}
                                {submitting ? 'Memproses...' : 'Aktifkan Kembali'}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default ModalReactivateSiswa;
