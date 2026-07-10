import React, { useState } from 'react';

const dummyMapel = [
  { id: 1, kode: 'MP001', nama: 'Pendidikan Agama Islam', kelompok: 'Wajib', kkm: 75, status: 'Aktif' },
  { id: 2, kode: 'MP002', nama: 'Pendidikan Kewarganegaraan', kelompok: 'Wajib', kkm: 70, status: 'Aktif' },
  { id: 3, kode: 'MP003', nama: 'Bahasa Indonesia', kelompok: 'Wajib', kkm: 75, status: 'Aktif' },
  { id: 4, kode: 'MP004', nama: 'Matematika', kelompok: 'Wajib', kkm: 70, status: 'Aktif' },
  { id: 5, kode: 'MP005', nama: 'Ilmu Pengetahuan Alam', kelompok: 'Wajib', kkm: 75, status: 'Aktif' },
  { id: 6, kode: 'MP006', nama: 'Ilmu Pengetahuan Sosial', kelompok: 'Wajib', kkm: 75, status: 'Aktif' },
  { id: 7, kode: 'MP007', nama: 'Seni Budaya dan Prakarya', kelompok: 'Muatan Lokal', kkm: 75, status: 'Aktif' },
  { id: 8, kode: 'MP008', nama: 'Pendidikan Jasmani, Olahraga, dan Kesehatan', kelompok: 'Wajib', kkm: 75, status: 'Aktif' },
  { id: 9, kode: 'MP009', nama: 'Bahasa Arab', kelompok: 'Muatan Lokal', kkm: 70, status: 'Aktif' },
  { id: 10, kode: 'MP010', nama: 'Sejarah Kebudayaan Islam', kelompok: 'Muatan Lokal', kkm: 75, status: 'Aktif' },
];

const MataPelajaranPage = () => {
  const [search, setSearch] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [selectedMapel, setSelectedMapel] = useState(null);
  const [form, setForm] = useState({ kode: '', nama: '', kelompok: 'Wajib', kkm: 75, status: 'Aktif' });

  const filtered = dummyMapel.filter(m =>
    m.nama.toLowerCase().includes(search.toLowerCase()) ||
    m.kode.toLowerCase().includes(search.toLowerCase()) ||
    m.kelompok.toLowerCase().includes(search.toLowerCase())
  );

  const openAdd = () => {
    setSelectedMapel(null);
    setForm({ kode: '', nama: '', kelompok: 'Wajib', kkm: 75, status: 'Aktif' });
    setShowModal(true);
  };

  const openEdit = (m) => {
    setSelectedMapel(m);
    setForm({ ...m });
    setShowModal(true);
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Mata Pelajaran</h2>
            <p className="text-xs text-slate-400 mt-0.5">{filtered.length} mata pelajaran ditemukan</p>
          </div>
          <div className="flex gap-3 w-full sm:w-auto">
            <input
              type="text"
              placeholder="Cari mapel, kode, kelompok..."
              value={search}
              onChange={e => setSearch(e.target.value)}
              className="flex-1 sm:w-64 px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
            />
            <button
              onClick={openAdd}
              className="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all shadow-sm shadow-emerald-500/30 whitespace-nowrap"
            >
              + Tambah Mapel
            </button>
          </div>
        </div>

        {/* Table */}
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider w-16">No</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Kode</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Mata Pelajaran</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Kelompok</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">KKM</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider w-40">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {filtered.map((m, i) => (
                <tr key={m.id} className="hover:bg-slate-50/50 transition-colors">
                  <td className="px-6 py-4 text-slate-400 text-xs">{i + 1}</td>
                  <td className="px-6 py-4 text-xs text-slate-500 font-mono">{m.kode}</td>
                  <td className="px-6 py-4 font-bold text-slate-800">{m.nama}</td>
                  <td className="px-6 py-4">
                    <span className={`px-2.5 py-1 rounded-full text-[10px] font-bold ${
                      m.kelompok === 'Wajib' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700'
                    }`}>
                      {m.kelompok}
                    </span>
                  </td>
                  <td className="px-6 py-4 font-mono text-slate-600">{m.kkm}</td>
                  <td className="px-6 py-4">
                    <span className={`inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold ${
                      m.status === 'Aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500'
                    }`}>
                      {m.status}
                    </span>
                  </td>
                  <td className="px-6 py-4">
                    <div className="flex gap-2">
                      <button onClick={() => openEdit(m)} className="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold rounded-lg transition-all">Edit</button>
                      <button onClick={() => { setSelectedMapel(m); setShowDeleteModal(true); }} className="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold rounded-lg transition-all">Hapus</button>
                    </div>
                  </td>
                </tr>
              ))}
              {filtered.length === 0 && (
                <tr><td colSpan={7} className="px-6 py-12 text-center text-slate-400 text-sm">Tidak ada mata pelajaran yang sesuai pencarian.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      </div>

      {/* Modal Tambah/Edit */}
      {showModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-lg overflow-hidden">
            <div className="p-6 border-b border-slate-100 flex justify-between items-center">
              <h3 className="text-lg font-bold text-slate-800">{selectedMapel ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran'}</h3>
              <button onClick={() => setShowModal(false)} className="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">✕</button>
            </div>
            <div className="p-6 space-y-4">
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className="block text-xs font-bold text-slate-600 mb-1.5">Kode Mapel</label>
                  <input
                    type="text"
                    value={form.kode}
                    onChange={e => setForm({ ...form, kode: e.target.value })}
                    className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
                  />
                </div>
                <div>
                  <label className="block text-xs font-bold text-slate-600 mb-1.5">KKM</label>
                  <input
                    type="number"
                    value={form.kkm}
                    onChange={e => setForm({ ...form, kkm: e.target.value })}
                    className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
                  />
                </div>
              </div>
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Nama Mata Pelajaran</label>
                <input
                  type="text"
                  value={form.nama}
                  onChange={e => setForm({ ...form, nama: e.target.value })}
                  className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
                />
              </div>
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className="block text-xs font-bold text-slate-600 mb-1.5">Kelompok</label>
                  <select
                    value={form.kelompok}
                    onChange={e => setForm({ ...form, kelompok: e.target.value })}
                    className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white"
                  >
                    <option value="Wajib">Wajib</option>
                    <option value="Muatan Lokal">Muatan Lokal</option>
                  </select>
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
                </div>
              </div>
            </div>
            <div className="p-6 border-t border-slate-100 flex justify-end gap-3">
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-all shadow-sm shadow-emerald-500/30">
                {selectedMapel ? 'Simpan Perubahan' : 'Tambah Mapel'}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Modal Delete */}
      {showDeleteModal && selectedMapel && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm p-8 text-center">
            <div className="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🗑️</div>
            <h3 className="text-lg font-bold text-slate-800 mb-2">Hapus Mata Pelajaran?</h3>
            <p className="text-sm text-slate-500 mb-6">Mata pelajaran <strong>{selectedMapel.nama}</strong> akan dihapus permanen.</p>
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

export default MataPelajaranPage;
