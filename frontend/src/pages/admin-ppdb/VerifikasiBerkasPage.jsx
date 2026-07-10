import React, { useState } from 'react';

const dataBerkas = [
  { id: 'PDB001', nama: 'Andi Pratama', asal: 'SDN 1 Malang', ijazah: true, akta: true, kk: true, foto: false, status: 'Belum Lengkap' },
  { id: 'PDB002', nama: 'Nurul Aisyah', asal: 'SD Islam Al-Azhar', ijazah: true, akta: true, kk: true, foto: true, status: 'Lengkap' },
  { id: 'PDB003', nama: 'Rafi Ahmad', asal: 'SDN 2 Sukun', ijazah: true, akta: true, kk: true, foto: true, status: 'Lengkap' },
  { id: 'PDB004', nama: 'Salsabila Putri', asal: 'SDIT Bina Insan', ijazah: false, akta: true, kk: true, foto: false, status: 'Belum Lengkap' },
  { id: 'PDB005', nama: 'Dimas Aditya', asal: 'SDN 4 Klojen', ijazah: true, akta: true, kk: false, foto: true, status: 'Belum Lengkap' },
  { id: 'PDB006', nama: 'Fatimah Az-Zahra', asal: 'SD Muhammadiyah', ijazah: true, akta: true, kk: true, foto: true, status: 'Lengkap' },
];

const AdminPPDBVerifikasiPage = () => {
  const [search, setSearch] = useState('');
  const [filter, setFilter] = useState('semua');

  const filtered = dataBerkas.filter((b) => {
    const matchSearch = b.nama.toLowerCase().includes(search.toLowerCase()) || b.id.includes(search);
    const matchFilter = filter === 'semua' || b.status === filter;
    return matchSearch && matchFilter;
  });

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Verifikasi Berkas</h2>
        <p className="text-sm text-slate-500 mt-1">Periksa kelengkapan berkas pendaftar</p>
      </div>

      <div className="flex flex-wrap gap-4 items-center">
        <div className="relative flex-1 max-w-md">
          <input type="text" placeholder="Cari nama atau ID..." value={search} onChange={(e) => setSearch(e.target.value)}
            className="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" />
          <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
        </div>
        <select value={filter} onChange={(e) => setFilter(e.target.value)}
          className="px-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white">
          <option value="semua">Semua</option>
          <option value="Lengkap">Lengkap</option>
          <option value="Belum Lengkap">Belum Lengkap</option>
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
                <th className="p-4 font-semibold text-center">Ijazah</th>
                <th className="p-4 font-semibold text-center">Akta</th>
                <th className="p-4 font-semibold text-center">KK</th>
                <th className="p-4 font-semibold text-center">Foto</th>
                <th className="p-4 font-semibold text-center">Status</th>
                <th className="p-4 font-semibold text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              {filtered.map((b, i) => (
                <tr key={b.id} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-medium text-slate-700">{b.id}</td>
                  <td className="p-4 text-sm font-semibold text-slate-800">{b.nama}</td>
                  <td className="p-4 text-sm text-slate-500">{b.asal}</td>
                  {[b.ijazah, b.akta, b.kk, b.foto].map((v, j) => (
                    <td key={j} className="p-4 text-center">
                      <span className={`inline-block w-6 h-6 rounded-full text-xs flex items-center justify-center ${
                        v ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-400'
                      }`}>
                        {v ? '✓' : '✗'}
                      </span>
                    </td>
                  ))}
                  <td className="p-4 text-center">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      b.status === 'Lengkap' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'
                    }`}>{b.status}</span>
                  </td>
                  <td className="p-4 text-center">
                    <button className="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-semibold hover:bg-emerald-700">Verifikasi</button>
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

export default AdminPPDBVerifikasiPage;
