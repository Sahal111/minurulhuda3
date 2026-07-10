import React, { useState, useEffect, useCallback } from 'react';
import { guruAPI } from '../../api/operator';

const GuruPage = () => {
  const [search, setSearch] = useState('');
  const [dataGuru, setDataGuru] = useState([]);
  const [statsData, setStatsData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  
  const [showModal, setShowModal] = useState(false);
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [selectedGuru, setSelectedGuru] = useState(null);
  const [form, setForm] = useState({ nip: '', nama: '', jabatan: 'Guru Kelas', mapel: '', kelas: '', jk: 'L', status: 'Aktif' });

  const fetchData = useCallback(async () => {
    setLoading(true);
    setError(null);
    try {
        const response = await guruAPI.getAll({ q: search });
        const { guru, stats } = response.data;
        setDataGuru(guru?.data || []);
        setStatsData(stats || null);
    } catch (err) {
        setError(err.response?.data?.message || err.message);
    } finally {
        setLoading(false);
    }
  }, [search]);

  useEffect(() => {
    fetchData();
  }, [fetchData]);

  const openAdd = () => {
    setSelectedGuru(null);
    setForm({ nip: '', nama: '', jabatan: 'Guru Kelas', mapel: '', kelas: '', jk: 'L', status: 'Aktif' });
    setShowModal(true);
  };

  const openEdit = (g) => {
    setSelectedGuru(g);
    setForm({ ...g });
    setShowModal(true);
  };

  const openDelete = (g) => {
    setSelectedGuru(g);
    setShowDeleteModal(true);
  };

  const stats = [
    { label: 'Total Guru', value: statsData?.total ?? 0, icon: '👨‍🏫', color: 'blue' },
    { label: 'Guru Aktif', value: statsData?.aktif ?? 0, icon: '✅', color: 'green' },
    { label: 'Laki-Laki', value: statsData?.laki ?? 0, icon: '👨', color: 'blue' },
    { label: 'Perempuan', value: statsData?.perempuan ?? 0, icon: '👩', color: 'pink' },
  ];

  return (
    <div className="p-4 lg:p-8 space-y-6">
      {/* Stats */}
      <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
        {stats.map((s) => (
          <div key={s.label} className="bg-white p-4 rounded-[1.5rem] shadow-sm border border-slate-100 hover:shadow-md transition-all">
            <div className="text-2xl mb-2">{s.icon}</div>
            <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">{s.label}</p>
            <h3 className="text-2xl font-bold text-slate-800 mt-0.5">{s.value}</h3>
          </div>
        ))}
      </div>

      {/* Table Card */}
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Data Guru</h2>
            <p className="text-xs text-slate-400 mt-0.5">{dataGuru.length} guru ditemukan</p>
          </div>
          <div className="flex gap-3 w-full sm:w-auto">
            <input
              type="text"
              placeholder="Cari nama, NIP, mapel..."
              value={search}
              onChange={e => setSearch(e.target.value)}
              onKeyDown={e => e.key === 'Enter' && fetchData()}
              className="flex-1 sm:w-64 px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
            />
            <button
              onClick={openAdd}
              className="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all shadow-sm shadow-emerald-500/30 whitespace-nowrap"
            >
              + Tambah Guru
            </button>
          </div>
        </div>

        {/* Table */}
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">No</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">NIP</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Guru</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Jabatan</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Mata Pelajaran</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Kelas</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {loading ? (
                <tr><td colSpan={8} className="px-6 py-12 text-center text-slate-400 text-sm">Memuat data...</td></tr>
              ) : error ? (
                <tr><td colSpan={8} className="px-6 py-12 text-center text-rose-500 text-sm">{error}</td></tr>
              ) : dataGuru.length === 0 ? (
                <tr><td colSpan={8} className="px-6 py-12 text-center text-slate-400 text-sm">Tidak ada data guru yang sesuai pencarian.</td></tr>
              ) : (
                dataGuru.map((g, i) => (
                  <tr key={g.id} className="hover:bg-slate-50/50 transition-colors">
                    <td className="px-6 py-4 text-slate-400 text-xs">{i + 1}</td>
                    <td className="px-6 py-4 text-xs text-slate-500 font-mono">{g.nip || '-'}</td>
                    <td className="px-6 py-4">
                      <div className="flex items-center gap-3">
                        {g.foto ? (
                          <img src={`/storage/${g.foto}`} alt={g.nama} className="w-9 h-9 rounded-full object-cover" />
                        ) : (
                          <div className={`w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm ${g.jenis_kelamin === 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700'}`}>
                            {g.nama.charAt(0)}
                          </div>
                        )}
                        <div>
                          <p className="font-semibold text-slate-800">{g.nama}</p>
                          <p className="text-[10px] text-slate-400">{g.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</p>
                        </div>
                      </div>
                    </td>
                    <td className="px-6 py-4 text-slate-600 text-xs">{g.current_jabatan?.jabatan || 'Guru'}</td>
                    <td className="px-6 py-4 text-slate-600 text-xs">{g.sertifikasis?.[0]?.bidang_studi || '-'}</td>
                    <td className="px-6 py-4 text-slate-600 text-xs">{g.kelas_wali?.nama_kelas ? `Kelas ${g.kelas_wali.tingkat}${g.kelas_wali.nama_kelas}` : '-'}</td>
                    <td className="px-6 py-4">
                      <span className={`inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold ${
                        g.status === 'Aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500'
                      }`}>
                        {g.status || 'Aktif'}
                      </span>
                    </td>
                    <td className="px-6 py-4">
                      <div className="flex gap-2">
                        <button onClick={() => openEdit(g)} className="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold rounded-lg transition-all">Edit</button>
                        <button onClick={() => openDelete(g)} className="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold rounded-lg transition-all">Hapus</button>
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
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-2xl overflow-hidden">
            <div className="p-6 border-b border-slate-100 flex justify-between items-center">
              <h3 className="text-lg font-bold text-slate-800">{selectedGuru ? 'Edit Data Guru' : 'Tambah Guru Baru'}</h3>
              <button onClick={() => setShowModal(false)} className="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">✕</button>
            </div>
            <div className="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
              {[
                { label: 'NIP', key: 'nip', type: 'text' },
                { label: 'Nama Lengkap', key: 'nama', type: 'text' },
                { label: 'Mata Pelajaran', key: 'mapel', type: 'text' },
                { label: 'Kelas', key: 'kelas', type: 'text' },
              ].map(f => (
                <div key={f.key}>
                  <label className="block text-xs font-bold text-slate-600 mb-1.5">{f.label}</label>
                  <input
                    type={f.type}
                    value={form[f.key]}
                    onChange={e => setForm({ ...form, [f.key]: e.target.value })}
                    className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
                  />
                </div>
              ))}
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Jabatan</label>
                <select value={form.jabatan} onChange={e => setForm({ ...form, jabatan: e.target.value })} className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white">
                  <option>Guru Kelas</option>
                  <option>Guru Mapel</option>
                  <option>Kepala Sekolah</option>
                  <option>Wakil Kepala Sekolah</option>
                </select>
              </div>
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Jenis Kelamin</label>
                <select value={form.jk} onChange={e => setForm({ ...form, jk: e.target.value })} className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white">
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Status</label>
                <select value={form.status} onChange={e => setForm({ ...form, status: e.target.value })} className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white">
                  <option>Aktif</option>
                  <option>Tidak Aktif</option>
                </select>
              </div>
            </div>
            <div className="p-6 border-t border-slate-100 flex justify-end gap-3">
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-all shadow-sm shadow-emerald-500/30">
                {selectedGuru ? 'Simpan Perubahan' : 'Tambah Guru'}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Modal Delete */}
      {showDeleteModal && selectedGuru && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm p-8 text-center">
            <div className="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🗑️</div>
            <h3 className="text-lg font-bold text-slate-800 mb-2">Hapus Data Guru?</h3>
            <p className="text-sm text-slate-500 mb-6">Data guru <strong>{selectedGuru.nama}</strong> akan dihapus secara permanen.</p>
            <div className="flex gap-3">
              <button onClick={() => setShowDeleteModal(false)} className="flex-1 py-3 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
              <button onClick={() => setShowDeleteModal(false)} className="flex-1 py-3 text-sm font-bold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition-all">Hapus</button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default GuruPage;
