import React, { useState } from 'react';

const dataCatatan = [
  { nis: '23101', nama: 'Ahmad Fauzi', catatan: 'Siswa aktif dan rajin. Perlu ditingkatkan dalam kedisiplinan waktu.', prestasi: 'Juara 1 Olimpiade Matematika' },
  { nis: '23102', nama: 'Siti Nurhaliza', catatan: 'Siswa berprestasi dan memiliki kepemimpinan yang baik.', prestasi: 'Juara 2 Lomba Pidato' },
  { nis: '23103', nama: 'Budi Santoso', catatan: 'Nilai akademik perlu ditingkatkan. Sering tidak mengerjakan PR.', prestasi: '-' },
  { nis: '23104', nama: 'Dewi Lestari', catatan: 'Siswa rajin dan sopan. Aktif dalam kegiatan ekstrakurikuler.', prestasi: 'Juara Harapan Kaligrafi' },
  { nis: '23105', nama: 'Rizky Pratama', catatan: 'Perlu bimbingan dalam pelajaran Matematika.', prestasi: '-' },
  { nis: '23106', nama: 'Fitri Handayani', catatan: 'Siswa teladan. Nilai konsisten tinggi.', prestasi: 'Peringkat 1 Kelas' },
];

const WaliKelasCatatanPage = () => {
  const [search, setSearch] = useState('');

  const filtered = dataCatatan.filter((s) =>
    s.nama.toLowerCase().includes(search.toLowerCase()) || s.nis.includes(search)
  );

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Catatan Wali Kelas</h2>
        <p className="text-sm text-slate-500 mt-1">Catatan perkembangan siswa — Kelas 6A</p>
      </div>

      <div className="relative max-w-md">
        <input type="text" placeholder="Cari siswa..." value={search} onChange={(e) => setSearch(e.target.value)}
          className="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" />
        <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-4">
        {filtered.map((s, i) => (
          <div key={s.nis} className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow">
            <div className="flex items-center gap-3 mb-4">
              <div className="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center font-bold">
                {s.nama.charAt(0)}
              </div>
              <div>
                <h4 className="font-semibold text-slate-800 text-sm">{s.nama}</h4>
                <p className="text-xs text-slate-500">NIS: {s.nis}</p>
              </div>
            </div>
            <div className="space-y-3">
              <div>
                <label className="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Catatan</label>
                <p className="text-sm text-slate-700 mt-1">{s.catatan}</p>
              </div>
              <div>
                <label className="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Prestasi</label>
                <p className="text-sm text-emerald-700 font-medium mt-1">{s.prestasi}</p>
              </div>
            </div>
            <button className="mt-4 text-xs font-semibold text-emerald-600 hover:text-emerald-700">Edit Catatan</button>
          </div>
        ))}
      </div>
    </div>
  );
};

export default WaliKelasCatatanPage;
