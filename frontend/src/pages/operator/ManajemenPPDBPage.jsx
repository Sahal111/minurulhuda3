import React, { useState } from 'react';

const dummyPPDB = [
  { id: 1, no_daftar: 'PPDB-2024-001', nama: 'Abdullah Azzam', jk: 'L', asal_sekolah: 'TK Tunas Bangsa', ortu: 'Budi Darmawan', status: 'Diterima' },
  { id: 2, no_daftar: 'PPDB-2024-002', nama: 'Aisyah Putri', jk: 'P', asal_sekolah: 'TK Islam Mutiara', ortu: 'Ahmad Supendi', status: 'Diterima' },
  { id: 3, no_daftar: 'PPDB-2024-003', nama: 'Bintang Pratama', jk: 'L', asal_sekolah: 'PAUD Ceria', ortu: 'Ridwan Kamil', status: 'Cadangan' },
  { id: 4, no_daftar: 'PPDB-2024-004', nama: 'Cinta Lestari', jk: 'P', asal_sekolah: 'TK Al-Hidayah', ortu: 'Dedi Mulyadi', status: 'Ditolak' },
  { id: 5, no_daftar: 'PPDB-2024-005', nama: 'Daffa Aryasetya', jk: 'L', asal_sekolah: 'TK Tunas Bangsa', ortu: 'Hendro', status: 'Menunggu' },
];

const ManajemenPPDBPage = () => {
  const [search, setSearch] = useState('');
  const [filterStatus, setFilterStatus] = useState('Semua');
  const [selectedPendaftar, setSelectedPendaftar] = useState(null);
  const [showModal, setShowModal] = useState(false);

  const filtered = dummyPPDB.filter(p => {
    const matchSearch = p.nama.toLowerCase().includes(search.toLowerCase()) || p.no_daftar.toLowerCase().includes(search.toLowerCase());
    const matchStatus = filterStatus === 'Semua' || p.status === filterStatus;
    return matchSearch && matchStatus;
  });

  const handleStatusChange = (p, status) => {
    alert(`Status pendaftaran ${p.nama} berhasil diubah menjadi ${status}`);
    setShowModal(false);
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
        {[
          { label: 'Total Pendaftar', value: '150', icon: '📝', color: 'blue' },
          { label: 'Menunggu Verifikasi', value: '45', icon: '⏳', color: 'amber' },
          { label: 'Diterima', value: '90', icon: '✅', color: 'emerald' },
          { label: 'Ditolak', value: '15', icon: '❌', color: 'rose' },
        ].map(s => (
          <div key={s.label} className="bg-white p-4 rounded-[1.5rem] shadow-sm border border-slate-100">
            <div className="text-2xl mb-2">{s.icon}</div>
            <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">{s.label}</p>
            <h3 className="text-2xl font-bold text-slate-800 mt-0.5">{s.value}</h3>
          </div>
        ))}
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Manajemen PPDB</h2>
            <p className="text-xs text-slate-400 mt-0.5">Tahun Ajaran 2024/2025</p>
          </div>
          
          <div className="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <select
              value={filterStatus}
              onChange={e => setFilterStatus(e.target.value)}
              className="px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none bg-white font-bold text-slate-600"
            >
              <option value="Semua">Semua Status</option>
              <option value="Menunggu">Menunggu Verifikasi</option>
              <option value="Diterima">Diterima</option>
              <option value="Cadangan">Cadangan</option>
              <option value="Ditolak">Ditolak</option>
            </select>
            <input
              type="text"
              placeholder="Cari nama, no. daftar..."
              value={search}
              onChange={e => setSearch(e.target.value)}
              className="flex-1 sm:w-64 px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none"
            />
            <button className="px-5 py-2.5 rounded-xl text-sm font-bold bg-blue-50 text-blue-700 hover:bg-blue-100 transition-all flex items-center gap-2 whitespace-nowrap">
              📄 Export Excel
            </button>
          </div>
        </div>

        {/* Table */}
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider w-16">No</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">No. Daftar</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Calon Siswa</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">L/P</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Asal Sekolah</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Orang Tua</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {filtered.map((p, i) => (
                <tr key={p.id} className="hover:bg-slate-50/50 transition-colors">
                  <td className="px-6 py-4 text-slate-400 text-xs">{i + 1}</td>
                  <td className="px-6 py-4 text-xs font-mono text-slate-500">{p.no_daftar}</td>
                  <td className="px-6 py-4 font-bold text-slate-800">{p.nama}</td>
                  <td className="px-6 py-4">
                    <span className={`px-2 py-1 rounded text-xs font-bold ${p.jk === 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700'}`}>
                      {p.jk}
                    </span>
                  </td>
                  <td className="px-6 py-4 text-slate-600 text-xs">{p.asal_sekolah}</td>
                  <td className="px-6 py-4 text-slate-600 text-xs">{p.ortu}</td>
                  <td className="px-6 py-4">
                    <span className={`inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold ${
                      p.status === 'Diterima' ? 'bg-emerald-100 text-emerald-700' :
                      p.status === 'Ditolak' ? 'bg-rose-100 text-rose-700' :
                      p.status === 'Cadangan' ? 'bg-blue-100 text-blue-700' :
                      'bg-amber-100 text-amber-700'
                    }`}>
                      {p.status}
                    </span>
                  </td>
                  <td className="px-6 py-4">
                    <div className="flex justify-center">
                      <button onClick={() => { setSelectedPendaftar(p); setShowModal(true); }} className="px-4 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-lg transition-all">Verifikasi</button>
                    </div>
                  </td>
                </tr>
              ))}
              {filtered.length === 0 && (
                <tr><td colSpan={8} className="px-6 py-12 text-center text-slate-400 text-sm">Tidak ada data pendaftar.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      </div>

      {/* Modal Verifikasi */}
      {showModal && selectedPendaftar && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-md overflow-hidden">
            <div className="p-6 border-b border-slate-100 flex justify-between items-center">
              <h3 className="text-lg font-bold text-slate-800">Verifikasi Pendaftar</h3>
              <button onClick={() => setShowModal(false)} className="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">✕</button>
            </div>
            <div className="p-6">
              <div className="bg-slate-50 p-4 rounded-xl mb-6">
                <div className="text-xs text-slate-500 font-mono mb-1">{selectedPendaftar.no_daftar}</div>
                <div className="font-bold text-slate-800 text-lg">{selectedPendaftar.nama}</div>
                <div className="text-sm text-slate-600 mt-1">Asal: {selectedPendaftar.asal_sekolah}</div>
              </div>
              
              <p className="text-xs font-bold text-slate-500 mb-3 text-center uppercase tracking-wider">Ubah Status Menjadi</p>
              
              <div className="grid grid-cols-2 gap-3">
                <button onClick={() => handleStatusChange(selectedPendaftar, 'Diterima')} className="py-3 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold rounded-xl text-sm transition-all border border-emerald-200">
                  ✅ Diterima
                </button>
                <button onClick={() => handleStatusChange(selectedPendaftar, 'Cadangan')} className="py-3 bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold rounded-xl text-sm transition-all border border-blue-200">
                  📝 Cadangan
                </button>
                <button onClick={() => handleStatusChange(selectedPendaftar, 'Ditolak')} className="py-3 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold rounded-xl text-sm transition-all border border-rose-200">
                  ❌ Ditolak
                </button>
                <button onClick={() => handleStatusChange(selectedPendaftar, 'Menunggu')} className="py-3 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-xl text-sm transition-all border border-amber-200">
                  ⏳ Menunggu
                </button>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default ManajemenPPDBPage;
