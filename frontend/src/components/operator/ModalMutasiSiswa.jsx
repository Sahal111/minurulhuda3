import React, { useState, useEffect } from 'react';
import { X, LogOut, AlertTriangle } from 'lucide-react';
import { siswaAPI } from '../../api/operator';

const ModalMutasiSiswa = ({ isOpen, onClose, onSuccess, siswa }) => {
    const [form, setForm] = useState({ jenis_mutasi: 'mutasi_keluar', tanggal_keluar: '', sekolah_tujuan: '', no_surat: '', alasan_mutasi: '' });
    const [submitting, setSubmitting] = useState(false);

    useEffect(() => {
        if (isOpen) setForm({ jenis_mutasi: 'mutasi_keluar', tanggal_keluar: '', sekolah_tujuan: '', no_surat: '', alasan_mutasi: '' });
    }, [isOpen]);

    if (!isOpen || !siswa) return null;

    const handleSubmit = async (e) => {
        e.preventDefault();
        setSubmitting(true);
        try {
            await siswaAPI.mutasi(siswa.id, form);
            onSuccess(`Siswa "${siswa.nama}" berhasil diproses`);
            onClose();
        } catch (err) {
            alert(err.response?.data?.message || err.message || 'Gagal memproses mutasi');
        } finally {
            setSubmitting(false);
        }
    };

    return (
        <div className="fixed inset-0 z-[75] overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div className="flex min-h-full items-center justify-center p-4">
                <div className="relative w-full max-w-lg bg-white rounded-[2rem] shadow-2xl overflow-hidden">
                    <div className="px-8 pt-8 pb-0 flex items-center justify-between">
                        <div>
                            <h3 className="text-xl font-black text-slate-800 uppercase tracking-tighter">
                                Proses <span className="text-amber-600">Mutasi</span>
                            </h3>
                            <p className="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">{siswa.nama}</p>
                        </div>
                        <button onClick={onClose} className="w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-slate-100 rounded-full transition-all">
                            <X className="w-5 h-5 text-slate-500" />
                        </button>
                    </div>

                    <form onSubmit={handleSubmit} className="p-8 space-y-5">
                        <div className="p-4 bg-amber-50 border border-amber-100 rounded-2xl flex items-start gap-3">
                            <AlertTriangle className="w-4 h-4 text-amber-500 shrink-0 mt-0.5" />
                            <p className="text-xs text-amber-700 font-medium">Proses mutasi tidak dapat dibatalkan secara otomatis. Pastikan data sudah benar.</p>
                        </div>

                        <div className="flex flex-col gap-2">
                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Mutasi</label>
                            <select value={form.jenis_mutasi} onChange={e => setForm({ ...form, jenis_mutasi: e.target.value })}
                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm text-slate-700">
                                <option value="mutasi_keluar">Pindah Sekolah (Mutasi Keluar)</option>
                                <option value="lulus">Lulus / Tamat</option>
                                <option value="nonaktif">Non-Aktif / DO</option>
                            </select>
                        </div>

                        <div className="flex flex-col gap-2">
                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Keluar</label>
                            <input type="date" value={form.tanggal_keluar} onChange={e => setForm({ ...form, tanggal_keluar: e.target.value })} required
                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm text-slate-700" />
                        </div>

                        {form.jenis_mutasi === 'mutasi_keluar' && (
                            <div className="flex flex-col gap-2">
                                <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sekolah Tujuan</label>
                                <input type="text" value={form.sekolah_tujuan} onChange={e => setForm({ ...form, sekolah_tujuan: e.target.value })}
                                    placeholder="Nama sekolah tujuan"
                                    className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm text-slate-700" />
                            </div>
                        )}

                        <div className="flex flex-col gap-2">
                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">No. Surat Mutasi</label>
                            <input type="text" value={form.no_surat} onChange={e => setForm({ ...form, no_surat: e.target.value })}
                                placeholder="Nomor surat (opsional)"
                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none text-sm text-slate-700" />
                        </div>

                        <div className="flex flex-col gap-2">
                            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Alasan / Keterangan <span className="text-rose-400">*</span></label>
                            <textarea rows={3} value={form.alasan_mutasi} onChange={e => setForm({ ...form, alasan_mutasi: e.target.value })} required
                                placeholder="Jelaskan alasan mutasi..."
                                className="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl focus:border-amber-500 outline-none resize-none text-sm text-slate-700" />
                        </div>

                        <div className="flex justify-end gap-3 pt-2">
                            <button type="button" onClick={onClose}
                                className="px-5 py-3 text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">Batal</button>
                            <button type="submit" disabled={submitting}
                                className="px-6 py-3 bg-amber-600 hover:bg-amber-500 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-2 disabled:opacity-50">
                                {submitting ? <span className="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin" /> : <LogOut className="w-4 h-4" />}
                                {submitting ? 'Memproses...' : 'Proses Mutasi'}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default ModalMutasiSiswa;
