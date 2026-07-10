import React, { useState, useEffect, useCallback, useMemo } from 'react';
import { kelasAPI } from '../../api/operator';

const KelasPage = () => {
  const [search, setSearch] = useState('');
  const [dataKelas, setDataKelas] = useState([]);
  const [dataGuru, setDataGuru] = useState([]);
  const [dataTahunAjaran, setDataTahunAjaran] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const [showModal, setShowModal] = useState(false);
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [selectedKelas, setSelectedKelas] = useState(null);
  const [form, setForm] = useState({ nama_kelas: '', tingkat: '1', wali_kelas_id: '', kapasitas: '32', tahun_ajaran_id: '' });

  const fetchData = useCallback(async () => {
    setLoading(true);
    setError(null);
    try {
        const response = await kelasAPI.getAll();
        const { kelas, guru, tahunAjaran } = response.data;
        setDataKelas(kelas || []);
        setDataGuru(guru || []);
        setDataTahunAjaran(tahunAjaran || []);
    } catch (err) {
        setError(err.response?.data?.message || err.message);
    } finally {
        setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchData();
  }, [fetchData]);

  const filtered = useMemo(() => {
    return dataKelas.filter(k =>
      k.nama_kelas?.toLowerCase().includes(search.toLowerCase()) ||
      k.wali_kelas?.nama?.toLowerCase().includes(search.toLowerCase()) ||
      k.tingkat?.toString().includes(search)
    );
  }, [dataKelas, search]);

  const openAdd = () => {
    setSelectedKelas(null);
    setForm({ nama_kelas: '', tingkat: '1', wali_kelas_id: '', kapasitas: '32', tahun_ajaran_id: '' });
    setShowModal(true);
  };

  const openEdit = (k) => {
    setSelectedKelas(k);
    setForm({ 
        nama_kelas: k.nama_kelas, 
        tingkat: String(k.tingkat), 
        wali_kelas_id: k.wali_kelas_id || '', 
        kapasitas: String(k.kapasitas), 
        tahun_ajaran_id: k.tahun_ajaran_id || '' 
    });
    setShowModal(true);
  };

  const tingkatColors = ['', 'bg-emerald-100 text-emerald-700', 'bg-blue-100 text-blue-700', 'bg-purple-100 text-purple-700', 'bg-orange-100 text-orange-700', 'bg-indigo-100 text-indigo-700', 'bg-pink-100 text-pink-700'];

  const stats = [
    { label: 'Total Kelas', value: dataKelas.length, icon: '🏫' },
    { label: 'Total Kapasitas', value: dataKelas.reduce((sum, k) => sum + (parseInt(k.kapasitas) || 0), 0), icon: '📊' },
    { label: 'Total Terisi', value: dataKelas.reduce((sum, k) => sum + (k.siswas?.length || 0), 0), icon: '👥' },
    { label: 'Sisa Kursi', value: dataKelas.reduce((sum, k) => sum + Math.max(0, (parseInt(k.kapasitas) || 0) - (k.siswas?.length || 0)), 0), icon: '💺' },
  ];

  return (
    <div className="p-4 lg:p-8 space-y-6">
      {/* Stats summary */}
      <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
        {stats.map(s => (
          <div key={s.label} className="bg-white p-4 rounded-[1.5rem] shadow-sm border border-slate-100">
            <div className="text-2xl mb-2">{s.icon}</div>
            <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">{s.label}</p>
            <h3 className="text-2xl font-bold text-slate-800 mt-0.5">{s.value}</h3>
          </div>
        ))}
      </div>

      {/* Table */}
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Data Kelas</h2>
            <p className="text-xs text-slate-400 mt-0.5">{filtered.length} kelas ditemukan</p>
          </div>
          <div className="flex gap-3 w-full sm:w-auto">
            <input
              type="text"
              placeholder="Cari kelas, wali kelas..."
              value={search}
              onChange={e => setSearch(e.target.value)}
              className="flex-1 sm:w-56 px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
            />
            <button onClick={openAdd} className="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all shadow-sm shadow-emerald-500/30 whitespace-nowrap">
              + Tambah Kelas
            </button>
          </div>
        </div>

        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                {['No', 'Kelas', 'Tingkat', 'Wali Kelas', 'Kapasitas', 'Terisi', 'Status', 'Aksi'].map(h => (
                  <th key={h} className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">{h}</th>
                ))}
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {loading ? (
                <tr><td colSpan={8} className="px-6 py-12 text-center text-slate-400 text-sm">Memuat data...</td></tr>
              ) : error ? (
                <tr><td colSpan={8} className="px-6 py-12 text-center text-rose-500 text-sm">{error}</td></tr>
              ) : filtered.length === 0 ? (
                <tr><td colSpan={8} className="px-6 py-12 text-center text-slate-400 text-sm">Tidak ada data kelas yang sesuai pencarian.</td></tr>
              ) : (
                filtered.map((k, i) => {
                  const terisi = k.siswas?.length || 0;
                  const kapasitas = parseInt(k.kapasitas) || 0;
                  const pct = kapasitas > 0 ? Math.round((terisi / kapasitas) * 100) : 0;
                  return (
                    <tr key={k.id} className="hover:bg-slate-50/50 transition-colors">
                      <td className="px-6 py-4 text-slate-400 text-xs">{i + 1}</td>
                      <td className="px-6 py-4 font-bold text-slate-800">{k.nama_kelas}</td>
                      <td className="px-6 py-4">
                        <span className={`px-2.5 py-1 rounded-full text-[10px] font-bold ${tingkatColors[k.tingkat] || 'bg-slate-100 text-slate-700'}`}>Kelas {k.tingkat}</span>
                      </td>
                      <td className="px-6 py-4 text-slate-600 text-xs">{k.wali_kelas?.nama || '-'}</td>
                      <td className="px-6 py-4 text-slate-600">{kapasitas}</td>
                      <td className="px-6 py-4">
                        <div className="space-y-1">
                          <div className="flex justify-between text-xs">
                            <span className="font-bold text-slate-700">{terisi}</span>
                            <span className="text-slate-400">{pct}%</span>
                          </div>
                          <div className="w-24 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div className={`h-full rounded-full ${pct >= 95 ? 'bg-rose-500' : pct >= 80 ? 'bg-amber-500' : 'bg-emerald-500'}`} style={{ width: `${pct}%` }}></div>
                          </div>
                        </div>
                      </td>
                      <td className="px-6 py-4">
                        <span className={`px-2.5 py-1 rounded-full text-[10px] font-bold ${pct >= 100 ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700'}`}>
                          {pct >= 100 ? 'Penuh' : 'Tersedia'}
                        </span>
                      </td>
                      <td className="px-6 py-4">
                        <div className="flex gap-2">
                          <button onClick={() => openEdit(k)} className="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold rounded-lg transition-all">Edit</button>
                          <button onClick={() => openDelete(k)} className="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold rounded-lg transition-all">Hapus</button>
                        </div>
                      </td>
                    </tr>
                  );
                })
              )}
            </tbody>
          </table>
        </div>
      </div>

      {/* Modal Add/Edit */}
      {showModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-lg overflow-hidden">
            <div className="p-6 border-b border-slate-100 flex justify-between items-center">
              <h3 className="text-lg font-bold text-slate-800">{selectedKelas ? 'Edit Data Kelas' : 'Tambah Kelas Baru'}</h3>
              <button onClick={() => setShowModal(false)} className="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">✕</button>
            </div>
            <div className="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
              {[
                { label: 'Nama Kelas (contoh: I-A)', key: 'nama' },
                { label: 'Kapasitas Siswa', key: 'kapasitas' },
                { label: 'Wali Kelas', key: 'wali' },
                { label: 'Tahun Ajaran', key: 'tahun' },
              ].map(f => (
                <div key={f.key}>
                  <label className="block text-xs font-bold text-slate-600 mb-1.5">{f.label}</label>
                  <input
                    type="text"
                    value={form[f.key]}
                    onChange={e => setForm({ ...form, [f.key]: e.target.value })}
                    className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
                  />
                </div>
              ))}
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Tingkat</label>
                <select value={form.tingkat} onChange={e => setForm({ ...form, tingkat: e.target.value })} className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white">
                  {[1, 2, 3, 4, 5, 6].map(t => <option key={t} value={t}>Kelas {t}</option>)}
                </select>
              </div>
            </div>
            <div className="p-6 border-t border-slate-100 flex justify-end gap-3">
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-all">
                {selectedKelas ? 'Simpan Perubahan' : 'Tambah Kelas'}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Modal Delete */}
      {showDeleteModal && selectedKelas && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm p-8 text-center">
            <div className="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🗑️</div>
            <h3 className="text-lg font-bold text-slate-800 mb-2">Hapus Kelas?</h3>
            <p className="text-sm text-slate-500 mb-6">Kelas <strong>{selectedKelas.nama}</strong> akan dihapus. Siswa yang ada akan perlu dipindah terlebih dahulu.</p>
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

export default KelasPage;
