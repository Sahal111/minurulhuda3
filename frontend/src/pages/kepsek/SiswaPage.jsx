import React, { useState } from 'react';

const dataSiswa = [
  { nis: '23101', nama: 'Ahmad Fauzi', kelas: '6A', jk: 'L', status: 'Aktif' },
  { nis: '23102', nama: 'Siti Nurhaliza', kelas: '6A', jk: 'P', status: 'Aktif' },
  { nis: '23103', nama: 'Budi Santoso', kelas: '6A', jk: 'L', status: 'Aktif' },
  { nis: '23104', nama: 'Dewi Lestari', kelas: '6A', jk: 'P', status: 'Aktif' },
  { nis: '23105', nama: 'Rizky Pratama', kelas: '5A', jk: 'L', status: 'Aktif' },
  { nis: '23106', nama: 'Fitri Handayani', kelas: '5A', jk: 'P', status: 'Aktif' },
  { nis: '23107', nama: 'Agus Wijaya', kelas: '5B', jk: 'L', status: 'Aktif' },
  { nis: '23108', nama: 'Rina Marlina', kelas: '5B', jk: 'P', status: 'Aktif' },
  { nis: '23109', nama: 'Herman, S.Pd.', kelas: '4A', jk: 'L', status: 'Aktif' },
  { nis: '23110', nama: 'Nurul Hidayah', kelas: '4A', jk: 'P', status: 'Aktif' },
];

const KepsekSiswaPage = () => {
  const [search, setSearch] = useState('');
  const [kelasFilter, setKelasFilter] = useState('semua');

  const filtered = dataSiswa.filter((s) => {
    const matchSearch = s.nama.toLowerCase().includes(search.toLowerCase()) || s.nis.includes(search);
    const matchKelas = kelasFilter === 'semua' || s.kelas === kelasFilter;
    return matchSearch && matchKelas;
  });

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Data Siswa</h2>
        <p className="text-sm text-slate-500 mt-1">Informasi seluruh siswa</p>
      </div>

      <div className="flex flex-wrap gap-4 items-center">
        <div className="relative flex-1 max-w-md">
          <input
            type="text"
            placeholder="Cari nama atau NIS..."
            value={search}
            onChange={(e) => setSearch(e.target.value)}
            className="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
          />
          <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
        </div>
        <select
          value={kelasFilter}
          onChange={(e) => setKelasFilter(e.target.value)}
          className="px-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white"
        >
          <option value="semua">Semua Kelas</option>
          <option>6A</option>
          <option>6B</option>
          <option>5A</option>
          <option>5B</option>
          <option>4A</option>
          <option>4B</option>
        </select>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">No</th>
                <th className="p-4 font-semibold">NIS</th>
                <th className="p-4 font-semibold">Nama Siswa</th>
                <th className="p-4 font-semibold">Kelas</th>
                <th className="p-4 font-semibold">JK</th>
                <th className="p-4 font-semibold">Status</th>
              </tr>
            </thead>
            <tbody>
              {filtered.map((s, i) => (
                <tr key={s.nis} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm text-slate-500">{i + 1}</td>
                  <td className="p-4 text-sm font-medium text-slate-700">{s.nis}</td>
                  <td className="p-4 text-sm font-semibold text-slate-800">{s.nama}</td>
                  <td className="p-4 text-sm text-slate-500">{s.kelas}</td>
                  <td className="p-4 text-sm text-slate-500">{s.jk}</td>
                  <td className="p-4">
                    <span className="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-lg text-xs font-bold">
                      {s.status}
                    </span>
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

export default KepsekSiswaPage;
