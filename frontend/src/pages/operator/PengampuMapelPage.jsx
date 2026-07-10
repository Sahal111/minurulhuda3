import React, { useState } from 'react';

const dummyPengampu = [
  { id: 1, kelas: 'IV-A', mapel: 'Matematika', guru: 'Ahmad Fauzi, S.Pd', status: 'Aktif' },
  { id: 2, kelas: 'IV-A', mapel: 'Pendidikan Agama Islam', guru: 'Siti Aisyah, S.Pd.I', status: 'Aktif' },
  { id: 3, kelas: 'V-B', mapel: 'Bahasa Indonesia', guru: 'Budi Santoso, M.Pd', status: 'Aktif' },
  { id: 4, kelas: 'VI-A', mapel: 'IPA', guru: 'Nurul Hidayah, S.Pd', status: 'Aktif' },
  { id: 5, kelas: 'IV-A', mapel: 'Fiqih', guru: 'Hasan Basri, S.Pd.I', status: 'Aktif' },
];

const PengampuMapelPage = () => {
  const [selectedKelas, setSelectedKelas] = useState('IV-A');
  const [showModal, setShowModal] = useState(false);
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [selectedData, setSelectedData] = useState(null);
  const [form, setForm] = useState({ kelas: 'IV-A', mapel: '', guru: '', status: 'Aktif' });

  const filtered = dummyPengampu.filter(p => p.kelas === selectedKelas);

  const openAdd = () => {
    setSelectedData(null);
    setForm({ kelas: selectedKelas, mapel: '', guru: '', status: 'Aktif' });
    setShowModal(true);
  };

  const openEdit = (d) => {
    setSelectedData(d);
    setForm({ ...d });
    setShowModal(true);
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Guru Pengampu Mata Pelajaran</h2>
            <p className="text-xs text-slate-400 mt-0.5">Atur guru pengajar untuk setiap mapel di kelas</p>
          </div>
          <div className="flex gap-3 w-full sm:w-auto">
            <select
              value={selectedKelas}
              onChange={e => setSelectedKelas(e.target.value)}
              className="px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white font-bold text-emerald-700"
            >
              <option value="I-A">Kelas I-A</option>
              <option value="II-A">Kelas II-A</option>
              <option value="III-A">Kelas III-A</option>
              <option value="IV-A">Kelas IV-A</option>
              <option value="V-B">Kelas V-B</option>
              <option value="VI-A">Kelas VI-A</option>
            </select>
            <button
              onClick={openAdd}
              className="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all shadow-sm shadow-emerald-500/30 whitespace-nowrap"
            >
              + Tambah Pengampu
            </button>
          </div>
        </div>

        {/* Table */}
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider w-16">No</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Mata Pelajaran</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Guru Pengampu</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider w-40">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {filtered.map((p, i) => (
                <tr key={p.id} className="hover:bg-slate-50/50 transition-colors">
                  <td className="px-6 py-4 text-slate-400 text-xs">{i + 1}</td>
                  <td className="px-6 py-4 font-bold text-slate-800">{p.mapel}</td>
                  <td className="px-6 py-4 text-slate-600">{p.guru}</td>
                  <td className="px-6 py-4">
                    <span className={`inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold ${
                      p.status === 'Aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500'
                    }`}>
                      {p.status}
                    </span>
                  </td>
                  <td className="px-6 py-4">
                    <div className="flex gap-2">
                      <button onClick={() => openEdit(p)} className="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold rounded-lg transition-all">Edit</button>
                      <button onClick={() => { setSelectedData(p); setShowDeleteModal(true); }} className="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold rounded-lg transition-all">Hapus</button>
                    </div>
                  </td>
                </tr>
              ))}
              {filtered.length === 0 && (
                <tr><td colSpan={5} className="px-6 py-12 text-center text-slate-400 text-sm">Belum ada data pengampu untuk kelas ini.</td></tr>
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
              <h3 className="text-lg font-bold text-slate-800">{selectedData ? 'Edit Pengampu' : 'Tambah Pengampu'}</h3>
              <button onClick={() => setShowModal(false)} className="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">✕</button>
            </div>
            <div className="p-6 space-y-4">
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Kelas</label>
                <input type="text" value={form.kelas} disabled className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl bg-slate-50 text-slate-500 outline-none" />
              </div>
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Mata Pelajaran</label>
                <select value={form.mapel} onChange={e => setForm({ ...form, mapel: e.target.value })} className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white">
                  <option value="">-- Pilih Mapel --</option>
                  <option value="Matematika">Matematika</option>
                  <option value="Pendidikan Agama Islam">Pendidikan Agama Islam</option>
                  <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                </select>
              </div>
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Guru Pengajar</label>
                <select value={form.guru} onChange={e => setForm({ ...form, guru: e.target.value })} className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white">
                  <option value="">-- Pilih Guru --</option>
                  <option value="Ahmad Fauzi, S.Pd">Ahmad Fauzi, S.Pd</option>
                  <option value="Siti Aisyah, S.Pd.I">Siti Aisyah, S.Pd.I</option>
                  <option value="Budi Santoso, M.Pd">Budi Santoso, M.Pd</option>
                </select>
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
      {showDeleteModal && selectedData && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm p-8 text-center">
            <div className="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🗑️</div>
            <h3 className="text-lg font-bold text-slate-800 mb-2">Hapus Pengampu?</h3>
            <p className="text-sm text-slate-500 mb-6">Akses guru <strong>{selectedData.guru}</strong> untuk mapel <strong>{selectedData.mapel}</strong> akan dihapus.</p>
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

export default PengampuMapelPage;
