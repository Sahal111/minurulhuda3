import React, { useState } from 'react';

const dataGuru = [
  { nip: '198001012005011001', nama: 'Dr. H. Ahmad S.Pd.I', mapel: 'Pend. Agama', jk: 'L', status: 'Aktif' },
  { nip: '198002022005012002', nama: 'Siti Aminah, S.Pd.', mapel: 'Matematika', jk: 'P', status: 'Aktif' },
  { nip: '198003032005013003', nama: 'Bambang Supriyadi, S.Pd.', mapel: 'IPA', jk: 'L', status: 'Aktif' },
  { nip: '198004042005014004', nama: 'Dewi Sartika, S.Pd.', mapel: 'Bahasa Indonesia', jk: 'P', status: 'Aktif' },
  { nip: '198005052005015005', nama: 'Aris Setiawan, S.Pd.', mapel: 'Matematika', jk: 'L', status: 'Aktif' },
  { nip: '198006062005016006', nama: 'Fitriani, S.Pd.', mapel: 'IPS', jk: 'P', status: 'Cuti' },
];

const KepsekGuruPage = () => {
  const [search, setSearch] = useState('');

  const filtered = dataGuru.filter((g) =>
    g.nama.toLowerCase().includes(search.toLowerCase()) || g.nip.includes(search)
  );

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Data Guru</h2>
        <p className="text-sm text-slate-500 mt-1">Informasi seluruh guru</p>
      </div>

      <div className="flex flex-wrap gap-4 items-center">
        <div className="relative flex-1 max-w-md">
          <input
            type="text"
            placeholder="Cari nama atau NIP..."
            value={search}
            onChange={(e) => setSearch(e.target.value)}
            className="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
          />
          <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
        </div>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">No</th>
                <th className="p-4 font-semibold">NIP</th>
                <th className="p-4 font-semibold">Nama Guru</th>
                <th className="p-4 font-semibold">Mapel</th>
                <th className="p-4 font-semibold">JK</th>
                <th className="p-4 font-semibold">Status</th>
              </tr>
            </thead>
            <tbody>
              {filtered.map((g, i) => (
                <tr key={g.nip} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm text-slate-500">{i + 1}</td>
                  <td className="p-4 text-sm font-medium text-slate-700">{g.nip}</td>
                  <td className="p-4 text-sm font-semibold text-slate-800">{g.nama}</td>
                  <td className="p-4 text-sm text-slate-500">{g.mapel}</td>
                  <td className="p-4 text-sm text-slate-500">{g.jk}</td>
                  <td className="p-4">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      g.status === 'Aktif' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'
                    }`}>
                      {g.status}
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

export default KepsekGuruPage;
