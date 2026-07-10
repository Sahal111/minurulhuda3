import React, { useState } from 'react';

const dataTagihan = [
  { id: 'TGH001', siswa: 'Ahmad Fauzi', kelas: '6A', jenis: 'SPP', nominal: 150000, jatuhTempo: '15 Jul 2026', status: 'Belum' },
  { id: 'TGH002', siswa: 'Siti Nurhaliza', kelas: '6A', jenis: 'SPP', nominal: 150000, jatuhTempo: '15 Jul 2026', status: 'Lunas' },
  { id: 'TGH003', siswa: 'Budi Santoso', kelas: '6A', jenis: 'SPP', nominal: 150000, jatuhTempo: '15 Jul 2026', status: 'Belum' },
  { id: 'TGH004', siswa: 'Dewi Lestari', kelas: '6A', jenis: 'SPP', nominal: 150000, jatuhTempo: '15 Jul 2026', status: 'Lunas' },
  { id: 'TGH005', siswa: 'Rizky Pratama', kelas: '5A', jenis: 'SPP', nominal: 130000, jatuhTempo: '15 Jul 2026', status: 'Belum' },
  { id: 'TGH006', siswa: 'Fitri Handayani', kelas: '5A', jenis: 'Daftar Ulang', nominal: 500000, jatuhTempo: '20 Jul 2026', status: 'Belum' },
];

const BendaharaTagihanPage = () => {
  const [search, setSearch] = useState('');
  const [filter, setFilter] = useState('semua');

  const filtered = dataTagihan.filter((t) => {
    const matchSearch = t.siswa.toLowerCase().includes(search.toLowerCase()) || t.id.toLowerCase().includes(search.toLowerCase());
    const matchFilter = filter === 'semua' || t.status === filter;
    return matchSearch && matchFilter;
  });

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Tagihan</h2>
        <p className="text-sm text-slate-500 mt-1">Kelola tagihan siswa</p>
      </div>

      <div className="flex flex-wrap gap-4 items-center">
        <div className="relative flex-1 max-w-md">
          <input
            type="text" placeholder="Cari siswa atau ID tagihan..." value={search}
            onChange={(e) => setSearch(e.target.value)}
            className="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
          />
          <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
        </div>
        <select value={filter} onChange={(e) => setFilter(e.target.value)}
          className="px-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white">
          <option value="semua">Semua Status</option>
          <option value="Lunas">Lunas</option>
          <option value="Belum">Belum</option>
        </select>
        <button className="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors">
          + Buat Tagihan
        </button>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">ID</th>
                <th className="p-4 font-semibold">Siswa</th>
                <th className="p-4 font-semibold">Kelas</th>
                <th className="p-4 font-semibold">Jenis</th>
                <th className="p-4 font-semibold text-right">Nominal</th>
                <th className="p-4 font-semibold">Jatuh Tempo</th>
                <th className="p-4 font-semibold text-center">Status</th>
                <th className="p-4 font-semibold text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              {filtered.map((t, i) => (
                <tr key={t.id} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-medium text-slate-700">{t.id}</td>
                  <td className="p-4 text-sm font-semibold text-slate-800">{t.siswa}</td>
                  <td className="p-4 text-sm text-slate-500">{t.kelas}</td>
                  <td className="p-4 text-sm text-slate-500">{t.jenis}</td>
                  <td className="p-4 text-sm text-right font-medium text-slate-700">Rp{t.nominal.toLocaleString()}</td>
                  <td className="p-4 text-sm text-slate-500">{t.jatuhTempo}</td>
                  <td className="p-4 text-center">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      t.status === 'Lunas' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'
                    }`}>{t.status}</span>
                  </td>
                  <td className="p-4 text-center">
                    <button className="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-semibold hover:bg-emerald-700">Bayar</button>
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

export default BendaharaTagihanPage;
