import React, { useState } from 'react';

const data = [
  { id: 'PDB001', nama: 'Andi Pratama', biaya: 'Pendaftaran', nominal: 250000, tgl: '10 Jul 2026', metode: 'Transfer', status: 'Lunas' },
  { id: 'PDB002', nama: 'Nurul Aisyah', biaya: 'Pendaftaran', nominal: 250000, tgl: '9 Jul 2026', metode: 'Tunai', status: 'Lunas' },
  { id: 'PDB003', nama: 'Rafi Ahmad', biaya: 'Pendaftaran', nominal: 250000, tgl: '8 Jul 2026', metode: 'Transfer', status: 'Lunas' },
  { id: 'PDB004', nama: 'Salsabila Putri', biaya: 'Pendaftaran', nominal: 250000, tgl: '8 Jul 2026', metode: 'Tunai', status: 'Menunggu' },
  { id: 'PDB005', nama: 'Dimas Aditya', biaya: 'Pendaftaran', nominal: 250000, tgl: '7 Jul 2026', metode: 'Transfer', status: 'Lunas' },
];

const AdminPPDBPembayaranPage = () => {
  const [filter, setFilter] = useState('semua');

  const filtered = filter === 'semua' ? data : data.filter((d) => d.status === filter);
  const total = data.filter((d) => d.status === 'Lunas').reduce((a, b) => a + b.nominal, 0);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Pembayaran PPDB</h2>
          <p className="text-sm text-slate-500 mt-1">Riwayat pembayaran pendaftaran</p>
        </div>
        <div className="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl text-sm font-semibold">
          Total: Rp{total.toLocaleString()}
        </div>
      </div>

      <div className="flex gap-4 items-center">
        <select value={filter} onChange={(e) => setFilter(e.target.value)}
          className="px-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white">
          <option value="semua">Semua</option>
          <option value="Lunas">Lunas</option>
          <option value="Menunggu">Menunggu</option>
        </select>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">ID</th>
                <th className="p-4 font-semibold">Nama</th>
                <th className="p-4 font-semibold">Biaya</th>
                <th className="p-4 font-semibold text-right">Nominal</th>
                <th className="p-4 font-semibold">Tgl Bayar</th>
                <th className="p-4 font-semibold">Metode</th>
                <th className="p-4 font-semibold text-center">Status</th>
                <th className="p-4 font-semibold text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              {filtered.map((d, i) => (
                <tr key={d.id} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-medium text-slate-700">{d.id}</td>
                  <td className="p-4 text-sm font-semibold text-slate-800">{d.nama}</td>
                  <td className="p-4 text-sm text-slate-500">{d.biaya}</td>
                  <td className="p-4 text-sm text-right font-medium text-slate-700">Rp{d.nominal.toLocaleString()}</td>
                  <td className="p-4 text-sm text-slate-500">{d.tgl}</td>
                  <td className="p-4 text-sm text-slate-500">{d.metode}</td>
                  <td className="p-4 text-center">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      d.status === 'Lunas' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'
                    }`}>{d.status}</span>
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

export default AdminPPDBPembayaranPage;
