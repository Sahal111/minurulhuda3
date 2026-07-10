import React, { useState } from 'react';

const riwayat = [
  { id: 'PMT001', siswa: 'Ahmad Fauzi', tgl: '10 Jul 2026', jenis: 'SPP', nominal: 150000, metode: 'Tunai', status: 'Diverifikasi' },
  { id: 'PMT002', siswa: 'Siti Nurhaliza', tgl: '9 Jul 2026', jenis: 'SPP', nominal: 150000, metode: 'Transfer', status: 'Diverifikasi' },
  { id: 'PMT003', siswa: 'Dewi Lestari', tgl: '8 Jul 2026', jenis: 'SPP', nominal: 150000, metode: 'Tunai', status: 'Diverifikasi' },
  { id: 'PMT004', siswa: 'Rizky Pratama', tgl: '7 Jul 2026', jenis: 'Daftar Ulang', nominal: 500000, metode: 'Transfer', status: 'Menunggu' },
  { id: 'PMT005', siswa: 'Fitri Handayani', tgl: '6 Jul 2026', jenis: 'SPP', nominal: 130000, metode: 'Tunai', status: 'Diverifikasi' },
];

const BendaharaPembayaranPage = () => {
  const [search, setSearch] = useState('');
  const [filter, setFilter] = useState('semua');

  const filtered = riwayat.filter((r) => {
    const matchSearch = r.siswa.toLowerCase().includes(search.toLowerCase()) || r.id.includes(search);
    const matchFilter = filter === 'semua' || r.status === filter;
    return matchSearch && matchFilter;
  });

  const totalPemasukan = riwayat.filter(r => r.status === 'Diverifikasi').reduce((a, b) => a + b.nominal, 0);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Pembayaran</h2>
          <p className="text-sm text-slate-500 mt-1">Riwayat pembayaran</p>
        </div>
        <div className="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl text-sm font-semibold">
          Total: Rp{totalPemasukan.toLocaleString()}
        </div>
      </div>

      <div className="flex flex-wrap gap-4 items-center">
        <div className="relative flex-1 max-w-md">
          <input type="text" placeholder="Cari siswa atau ID..." value={search} onChange={(e) => setSearch(e.target.value)}
            className="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" />
          <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
        </div>
        <select value={filter} onChange={(e) => setFilter(e.target.value)}
          className="px-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white">
          <option value="semua">Semua Status</option>
          <option value="Diverifikasi">Diverifikasi</option>
          <option value="Menunggu">Menunggu</option>
        </select>
        <button className="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700">Catat Pembayaran</button>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">ID</th>
                <th className="p-4 font-semibold">Siswa</th>
                <th className="p-4 font-semibold">Tanggal</th>
                <th className="p-4 font-semibold">Jenis</th>
                <th className="p-4 font-semibold text-right">Nominal</th>
                <th className="p-4 font-semibold">Metode</th>
                <th className="p-4 font-semibold text-center">Status</th>
                <th className="p-4 font-semibold text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              {filtered.map((r, i) => (
                <tr key={r.id} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-medium text-slate-700">{r.id}</td>
                  <td className="p-4 text-sm font-semibold text-slate-800">{r.siswa}</td>
                  <td className="p-4 text-sm text-slate-500">{r.tgl}</td>
                  <td className="p-4 text-sm text-slate-500">{r.jenis}</td>
                  <td className="p-4 text-sm text-right font-medium text-slate-700">Rp{r.nominal.toLocaleString()}</td>
                  <td className="p-4 text-sm text-slate-500">{r.metode}</td>
                  <td className="p-4 text-center">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      r.status === 'Diverifikasi' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'
                    }`}>{r.status}</span>
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

export default BendaharaPembayaranPage;
