import React, { useState, useRef } from 'react';
import { X, Upload, Download, FileSpreadsheet, Archive, CheckCircle, Info } from 'lucide-react';
import { siswaAPI } from '../../api/operator';

const ModalImportSiswa = ({ isOpen, onClose, onSuccess }) => {
    const [mode, setMode] = useState('excel');
    const [fileName, setFileName] = useState('');
    const [submitting, setSubmitting] = useState(false);
    const [downloading, setDownloading] = useState(false);
    const fileRef = useRef(null);

    if (!isOpen) return null;

    const handleDownloadTemplate = async () => {
        setDownloading(true);
        try {
            const res = await siswaAPI.exportTemplate();
            const blob = new Blob([res.data], { type: res.headers['content-type'] || 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Template_Import_Siswa.xlsx';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        } catch (err) {
            alert(err.response?.data?.message || 'Gagal mengunduh template');
        } finally {
            setDownloading(false);
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const file = fileRef.current?.files?.[0];
        if (!file) return;
        setSubmitting(true);
        try {
            const fd = new FormData();
            fd.append('file_import', file);
            const res = await siswaAPI.import(fd);
            onSuccess?.(res.data.message || 'Data siswa berhasil diimport');
            onClose();
        } catch (err) {
            alert(err.response?.data?.message || err.message || 'Gagal import data');
        } finally {
            setSubmitting(false);
        }
    };

    return (
        <div className="fixed inset-0 z-[75] overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div className="flex min-h-full items-center justify-center p-4">
                <div className="relative w-full max-w-xl bg-white rounded-[2rem] shadow-2xl overflow-hidden">
                    <div className="px-8 pt-8 pb-0 flex items-center justify-between">
                        <div>
                            <h3 className="text-xl font-black text-slate-800 uppercase tracking-tighter">
                                Import <span className="text-blue-600">Data Siswa</span>
                            </h3>
                            <p className="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Excel biasa atau ZIP dengan foto</p>
                        </div>
                        <button onClick={onClose} className="w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-slate-100 rounded-full transition-all">
                            <X className="w-5 h-5 text-slate-500" />
                        </button>
                    </div>

                    <form onSubmit={handleSubmit} className="p-8 space-y-5">
                        <div className="flex gap-2 p-1 bg-slate-100 rounded-2xl">
                            <button type="button" onClick={() => setMode('excel')}
                                className={`flex-1 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all flex items-center justify-center gap-2 ${mode === 'excel' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-400'}`}>
                                <FileSpreadsheet className="w-3.5 h-3.5" /> Excel / CSV
                            </button>
                            <button type="button" onClick={() => setMode('zip')}
                                className={`flex-1 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all flex items-center justify-center gap-2 ${mode === 'zip' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-400'}`}>
                                <Archive className="w-3.5 h-3.5" /> ZIP + Foto
                            </button>
                        </div>

                        {mode === 'excel' && (
                            <div className="p-4 bg-blue-50 border border-blue-100 rounded-2xl flex items-start gap-3">
                                <Info className="w-4 h-4 text-blue-500 shrink-0 mt-0.5" />
                                <div className="text-xs text-blue-700 flex-1">
                                    <p className="font-bold mb-1">Import data siswa tanpa foto.</p>
                                    <p>Foto akan ditampilkan sebagai avatar otomatis dari inisial nama.</p>
                                    <button type="button" onClick={handleDownloadTemplate} disabled={downloading}
                                        className="inline-flex items-center gap-1 font-black text-blue-600 hover:underline mt-2 disabled:opacity-50">
                                        {downloading ? (
                                            <span className="w-3 h-3 border-2 border-blue-600 border-t-transparent rounded-full animate-spin" />
                                        ) : (
                                            <Download className="w-3 h-3" />
                                        )}
                                        {downloading ? 'Mengunduh...' : 'Download Template Excel'}
                                    </button>
                                </div>
                            </div>
                        )}

                        {mode === 'zip' && (
                            <div className="p-4 bg-purple-50 border border-purple-100 rounded-2xl">
                                <p className="text-[10px] font-black text-purple-600 uppercase tracking-widest flex items-center gap-2 mb-3">
                                    <Archive className="w-3.5 h-3.5" /> Struktur ZIP yang benar
                                </p>
                                <div className="bg-white rounded-xl border border-purple-100 p-4 font-mono text-xs text-slate-600 space-y-1">
                                    <p>📦 <span className="text-slate-800 font-bold">import_siswa.zip</span></p>
                                    <p className="pl-5">├── 📄 <span className="text-emerald-600 font-bold">data_siswa.xlsx</span></p>
                                    <p className="pl-5">└── 📁 <span className="text-blue-600 font-bold">foto/</span></p>
                                    <p className="pl-12 text-slate-400">├── 🖼 <span className="text-amber-600">0012345678.jpg</span></p>
                                    <p className="pl-12 text-slate-400">├── 🖼 <span className="text-amber-600">0012345679.jpg</span></p>
                                    <p className="pl-12 text-slate-400">└── 🖼 <span className="text-amber-600">0012345680.jpg</span></p>
                                </div>
                            </div>
                        )}

                        <div className={`border-2 border-dashed border-slate-200 rounded-2xl p-8 flex flex-col items-center gap-3 transition-colors ${mode === 'zip' ? 'hover:border-purple-400' : 'hover:border-blue-400'}`}>
                            <div className={`w-12 h-12 rounded-2xl flex items-center justify-center ${mode === 'zip' ? 'bg-purple-50' : 'bg-blue-50'}`}>
                                {mode === 'zip' ? <Archive className="w-6 h-6 text-purple-500" /> : <FileSpreadsheet className="w-6 h-6 text-blue-500" />}
                            </div>
                            <div className="text-center">
                                <p className="text-sm font-bold text-slate-600">Drag & drop file di sini</p>
                                <p className="text-[10px] text-slate-400 mt-0.5">
                                    {mode === 'zip' ? 'Format: .zip — Maks. 20MB' : 'Format: .xlsx, .xls, .csv — Maks. 20MB'}
                                </p>
                            </div>
                            <label className={`px-5 py-2.5 rounded-xl text-xs font-bold cursor-pointer hover:opacity-90 transition-all text-white ${mode === 'zip' ? 'bg-purple-600' : 'bg-blue-600'}`}>
                                Pilih File
                                <input type="file" ref={fileRef}
                                    accept={mode === 'zip' ? '.zip' : '.xlsx,.xls,.csv'} className="hidden"
                                    onChange={e => setFileName(e.target.files[0]?.name || '')} />
                            </label>
                            {fileName && (
                                <div className="flex items-center gap-2 px-3 py-2 bg-emerald-50 border border-emerald-200 rounded-xl">
                                    <CheckCircle className="w-4 h-4 text-emerald-500 shrink-0" />
                                    <p className="text-xs text-emerald-700 font-bold truncate max-w-xs">{fileName}</p>
                                </div>
                            )}
                        </div>

                        <div className="flex justify-end gap-3">
                            <button type="button" onClick={onClose}
                                className="px-5 py-3 text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">Batal</button>
                            <button type="submit" disabled={!fileName || submitting}
                                className={`px-6 py-3 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-2 ${!fileName ? 'opacity-40 cursor-not-allowed' : 'hover:opacity-90'}`}
                                style={{ background: mode === 'zip' ? '#7c3aed' : '#2563eb' }}>
                                {submitting ? <span className="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin" /> : <Upload className="w-4 h-4" />}
                                {submitting ? 'Memproses...' : mode === 'zip' ? 'Upload ZIP & Proses' : 'Upload & Proses'}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default ModalImportSiswa;
