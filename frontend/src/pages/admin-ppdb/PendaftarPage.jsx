import React, { useState } from 'react';

const dataPendaftar = [
  { id: 'PDB001', nama: 'Andi Pratama', asal: 'SDN 1 Malang', tgl: '10 Jul 2026', jalur: 'Afirmasi', status: 'Menunggu' },
  { id: 'PDB002', nama: 'Nurul Aisyah', asal: 'SD Islam Al-Azhar', tgl: '9 Jul 2026', jalur: 'Prestasi', status: 'Diverifikasi' },
  { id: 'PDB003', nama: 'Rafi Ahmad', asal: 'SDN 2 Sukun', tgl: '8 Jul 2026', jalur: 'Zonasi', status: 'Diterima' },
  { id: 'PDB004', nama: 'Salsabila Putri', asal: 'SDIT Bina Insan', tgl: '8 Jul 2026', jalur: 'Zonasi', status: 'Menunggu' },
  { id: 'PDB005', nama: 'Dimas Aditya', asal: 'SDN 4 Klojen', tgl: '7 Jul 2026', jalur: 'Prestasi', status: 'Diverifikasi' },
  { id: 'PDB006', nama: 'Fatimah Az-Zahra', asal: 'SD Muhammadiyah', tgl: '6 Jul 2026', jalur: 'Afirmasi', status: 'Diterima' },
  { id: 'PDB007', nama: 'Herman Saputra', asal: 'SDN 3 Lowokwaru', tgl: '5 Jul 2026', jalur: 'Mutasi', status: 'Ditolak' },
  { id: 'PDB008', nama: 'Aisyah Putri', asal: 'SDIT Permata', tgl: '4 Jul 2026', jalur: 'Zonasi', status: 'Diverifikasi' },
];

const AdminPPDBPendaftarPage = () => {
  const [search, setSearch] = useState('');
  const [filter, setFilter] = useState('semua');

  const filtered = dataPendaftar.filter((p) => {
    const matchSearch = p.nama.toLowerCase().includes(search.toLowerCase()) || p.id.includes(search);
    const matchFilter = filter === 'semua' || p.status === filter;
    return matchSearch && matchFilter;
  });

  const total = dataPendaftar.length;
  const diterima = dataPendaftar.filter((p) => p.status === 'Diterima').length;

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Pendaftar</h2>
          <p className="text-sm text-slate-500 mt-1">Daftar peserta didik baru</p>
        </div>
        <div className="bg-emerald-50 px-4 py-2 rounded-xl text-sm font-semibold">
          Diterima: {diterima}/{total}
        </div>
      </div>

      <div className="flex flex-wrap gap-4 items-center">
        <div className="relative flex-1 max-w-md">
          <input type="text" placeholder="Cari nama atau ID..." value={search} onChange={(e) => setSearch(e.target.value)}
            className="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" />
          <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
        </div>
        <select value={filter} onChange={(e) => setFilter(e.target.value)}
          className="px-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white">
          <option value="semua">Semua Status</option>
          <option value="Menunggu">Menunggu</option>
          <option value="Diverifikasi">Diverifikasi</option>
          <option value="Diterima">Diterima</option>
          <option value="Ditolak">Ditolak</option>
        </select>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">ID</th>
                <th className="p-4 font-semibold">Nama</th>
                <th className="p-4 font-semibold">Asal Sekolah</th>
                <th className="p-4 font-semibold">Tgl Daftar</th>
                <th className="p-4 font-semibold">Jalur</th>
                <th className="p-4 font-semibold text-center">Status</th>
                <th className="p-4 font-semibold text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              {filtered.map((p, i) => (
                <tr key={p.id} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-medium text-slate-700">{p.id}</td>
                  <td className="p-4 text-sm font-semibold text-slate-800">{p.nama}</td>
                  <td className="p-4 text-sm text-slate-500">{p.asal}</td>
                  <td className="p-4 text-sm text-slate-500">{p.tgl}</td>
                  <td className="p-4 text-sm text-slate-500">{p.jalur}</td>
                  <td className="p-4 text-center">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      p.status === 'Diterima' ? 'bg-emerald-50 text-emerald-700' :
                      p.status === 'Diverifikasi' ? 'bg-blue-50 text-blue-700' :
                      p.status === 'Ditolak' ? 'bg-red-50 text-red-700' :
                      'bg-amber-50 text-amber-700'
                    }`}>{p.status}</span>
                  </td>
                  <td className="p-4 text-center">
                    <button className="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-semibold hover:bg-emerald-700">Detail</button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default AdminPPDBPendaftarPage;
