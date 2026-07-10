import React, { useState } from 'react';

const dataSiswa = [
  { nis: '23101', nama: 'Ahmad Fauzi', jk: 'L', tglLahir: '15 Jan 2014', alamat: 'Jl. Merdeka No. 45', status: 'Aktif' },
  { nis: '23102', nama: 'Siti Nurhaliza', jk: 'P', tglLahir: '20 Mar 2014', alamat: 'Jl. Sudirman No. 12', status: 'Aktif' },
  { nis: '23103', nama: 'Budi Santoso', jk: 'L', tglLahir: '5 Jul 2014', alamat: 'Jl. Ahmad Yani No. 8', status: 'Aktif' },
  { nis: '23104', nama: 'Dewi Lestari', jk: 'P', tglLahir: '12 Sep 2014', alamat: 'Jl. Diponegoro No. 23', status: 'Aktif' },
  { nis: '23105', nama: 'Rizky Pratama', jk: 'L', tglLahir: '28 Nov 2013', alamat: 'Jl. Pahlawan No. 5', status: 'Aktif' },
  { nis: '23106', nama: 'Fitri Handayani', jk: 'P', tglLahir: '3 Feb 2014', alamat: 'Jl. Kartini No. 17', status: 'Aktif' },
  { nis: '23107', nama: 'Agus Wijaya', jk: 'L', tglLahir: '19 Apr 2014', alamat: 'Jl. Gajah Mada No. 30', status: 'Aktif' },
  { nis: '23108', nama: 'Rina Marlina', jk: 'P', tglLahir: '7 Jun 2014', alamat: 'Jl. Siliwangi No. 2', status: 'Aktif' },
];

const WaliKelasSiswaPage = () => {
  const [search, setSearch] = useState('');

  const filtered = dataSiswa.filter((s) =>
    s.nama.toLowerCase().includes(search.toLowerCase()) || s.nis.includes(search)
  );

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Data Siswa</h2>
        <p className="text-sm text-slate-500 mt-1">Kelas 6A</p>
      </div>

      <div className="relative max-w-md">
        <input type="text" placeholder="Cari nama atau NIS..." value={search} onChange={(e) => setSearch(e.target.value)}
          className="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" />
        <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">No</th>
                <th className="p-4 font-semibold">NIS</th>
                <th className="p-4 font-semibold">Nama</th>
                <th className="p-4 font-semibold">JK</th>
                <th className="p-4 font-semibold">Tgl Lahir</th>
                <th className="p-4 font-semibold">Alamat</th>
                <th className="p-4 font-semibold text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              {filtered.map((s, i) => (
                <tr key={s.nis} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm text-slate-500">{i + 1}</td>
                  <td className="p-4 text-sm font-medium text-slate-700">{s.nis}</td>
                  <td className="p-4 text-sm font-semibold text-slate-800">{s.nama}</td>
                  <td className="p-4 text-sm text-slate-500">{s.jk}</td>
                  <td className="p-4 text-sm text-slate-500">{s.tglLahir}</td>
                  <td className="p-4 text-sm text-slate-500 max-w-[200px] truncate">{s.alamat}</td>
                  <td className="p-4 text-center">
                    <span className="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-lg text-xs font-bold">{s.status}</span>
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

export default WaliKelasSiswaPage;
