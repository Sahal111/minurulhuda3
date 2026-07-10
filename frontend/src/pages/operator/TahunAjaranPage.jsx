import React, { useState, useEffect, useCallback } from 'react';
import { tahunAjaranAPI } from '../../api/operator';

const TahunAjaranPage = () => {
  const [dataTahunAjaran, setDataTahunAjaran] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const [showModal, setShowModal] = useState(false);
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [selectedTA, setSelectedTA] = useState(null);
  const [form, setForm] = useState({ tahun: '', is_active: false });

  const fetchData = useCallback(async () => {
    setLoading(true);
    setError(null);
    try {
        const response = await tahunAjaranAPI.getAll();
        const { tahunAjarans } = response.data;
        setDataTahunAjaran(tahunAjarans || []);
    } catch (err) {
        setError(err.response?.data?.message || err.message);
    } finally {
        setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchData();
  }, [fetchData]);

  const openAdd = () => {
    setSelectedTA(null);
    setForm({ tahun: '', is_active: false });
    setShowModal(true);
  };

  const openEdit = (t) => {
    setSelectedTA(t);
    setForm({ tahun: t.tahun, is_active: t.is_active });
    setShowModal(true);
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Tahun Ajaran</h2>
            <p className="text-xs text-slate-400 mt-0.5">Kelola data tahun ajaran madrasah</p>
          </div>
          <button
            onClick={openAdd}
            className="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all shadow-sm shadow-emerald-500/30 whitespace-nowrap"
          >
            + Tambah Tahun Ajaran
          </button>
        </div>

        {/* Table */}
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider w-24">No</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Tahun Ajaran</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider w-48">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {loading ? (
                <tr><td colSpan={4} className="px-6 py-12 text-center text-slate-400 text-sm">Memuat data...</td></tr>
              ) : error ? (
                <tr><td colSpan={4} className="px-6 py-12 text-center text-rose-500 text-sm">{error}</td></tr>
              ) : dataTahunAjaran.length === 0 ? (
                <tr><td colSpan={4} className="px-6 py-12 text-center text-slate-400 text-sm">Tidak ada data tahun ajaran.</td></tr>
              ) : (
                dataTahunAjaran.map((t, i) => (
                  <tr key={t.id} className="hover:bg-slate-50/50 transition-colors">
                    <td className="px-6 py-4 text-slate-400 text-xs">{i + 1}</td>
                    <td className="px-6 py-4 font-bold text-slate-800">{t.tahun}</td>
                    <td className="px-6 py-4">
                    <span className={`inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold ${
                      t.is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500'
                    }`}>
                      {t.is_active && <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>}
                      {t.is_active ? 'Aktif' : 'Tidak Aktif'}
                    </span>
                  </td>
                  <td className="px-6 py-4">
                    <div className="flex gap-2">
                      <button onClick={() => openEdit(t)} className="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold rounded-lg transition-all">Edit</button>
                      <button onClick={() => { setSelectedTA(t); setShowDeleteModal(true); }} className="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold rounded-lg transition-all">Hapus</button>
                    </div>
                  </td>
                </tr>
                ))
              )}
            </tbody>
          </table>
        </div>
      </div>

      {/* Modal Tambah/Edit */}
      {showModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm overflow-hidden">
            <div className="p-6 border-b border-slate-100 flex justify-between items-center">
              <h3 className="text-lg font-bold text-slate-800">{selectedTA ? 'Edit Tahun Ajaran' : 'Tambah Tahun Ajaran'}</h3>
              <button onClick={() => setShowModal(false)} className="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">✕</button>
            </div>
            <div className="p-6 space-y-4">
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Tahun Ajaran (contoh: 2025/2026)</label>
                <input
                  type="text"
                  value={form.tahun}
                  onChange={e => setForm({ ...form, tahun: e.target.value })}
                  className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
                />
              </div>
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Status</label>
                <select
                  value={form.status}
                  onChange={e => setForm({ ...form, status: e.target.value })}
                  className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white"
                >
                  <option value="Aktif">Aktif</option>
                  <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
                <p className="text-[10px] text-amber-600 mt-2 bg-amber-50 p-2 rounded-lg border border-amber-100">
                  ⚠️ <strong>Perhatian:</strong> Hanya boleh ada 1 Tahun Ajaran yang berstatus Aktif. Jika Anda mengaktifkan ini, tahun ajaran lain akan otomatis dinonaktifkan.
                </p>
              </div>
            </div>
            <div className="p-6 border-t border-slate-100 flex justify-end gap-3">
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-all shadow-sm shadow-emerald-500/30">
                Simpan
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Modal Delete */}
      {showDeleteModal && selectedTA && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm p-8 text-center">
            <div className="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🗑️</div>
            <h3 className="text-lg font-bold text-slate-800 mb-2">Hapus Tahun Ajaran?</h3>
            <p className="text-sm text-slate-500 mb-6">Tahun ajaran <strong>{selectedTA.tahun}</strong> akan dihapus permanen.</p>
            <div className="flex gap-3">
              <button onClick={() => setShowDeleteModal(false)} className="flex-1 py-3 text-sm font-bold text-slate-600 bg-slate-100 rounded-xl">Batal</button>
              <button onClick={() => setShowDeleteModal(false)} className="flex-1 py-3 text-sm font-bold text-white bg-rose-600 hover:bg-rose-700 rounded-xl">Hapus</button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default TahunAjaranPage;
