import React from 'react';

const nilaiSiswa = [
  { mapel: 'Matematika', tugas: 85, uts: 78, uas: 92, akhir: 86, grade: 'B' },
  { mapel: 'IPA', tugas: 90, uts: 88, uas: 95, akhir: 91, grade: 'A' },
  { mapel: 'Bahasa Indonesia', tugas: 82, uts: 80, uas: 85, akhir: 83, grade: 'B' },
  { mapel: 'IPS', tugas: 75, uts: 78, uas: 80, akhir: 78, grade: 'C' },
  { mapel: 'Pendidikan Agama', tugas: 95, uts: 92, uas: 98, akhir: 95, grade: 'A' },
  { mapel: 'SBK', tugas: 88, uts: 85, uas: 90, akhir: 88, grade: 'B' },
  { mapel: 'Penjaskes', tugas: 80, uts: 82, uas: 85, akhir: 83, grade: 'B' },
];

const OrtuNilaiPage = () => {
  const rataAkhir = Math.round(nilaiSiswa.reduce((a, b) => a + b.akhir, 0) / nilaiSiswa.length);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Nilai Anak</h2>
        <p className="text-sm text-slate-500 mt-1">Ahmad Fauzi — Kelas 6A</p>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Rata-rata</p>
          <h3 className="text-3xl font-bold text-slate-800 mt-1">{rataAkhir}</h3>
          <p className="text-[10px] font-bold text-emerald-600 mt-2">Semua mapel</p>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Nilai Tertinggi</p>
          <h3 className="text-3xl font-bold text-slate-800 mt-1">95</h3>
          <p className="text-[10px] font-bold text-blue-600 mt-2">Pend. Agama</p>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Total Mapel</p>
          <h3 className="text-3xl font-bold text-slate-800 mt-1">{nilaiSiswa.length}</h3>
          <p className="text-[10px] font-bold text-purple-600 mt-2">Mata pelajaran</p>
        </div>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50">
          <h3 className="font-bold text-slate-800">Daftar Nilai — Semester Ganjil 2025/2026</h3>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">Mata Pelajaran</th>
                <th className="p-4 font-semibold text-center">Tugas</th>
                <th className="p-4 font-semibold text-center">UTS</th>
                <th className="p-4 font-semibold text-center">UAS</th>
                <th className="p-4 font-semibold text-center">Akhir</th>
                <th className="p-4 font-semibold text-center">Grade</th>
              </tr>
            </thead>
            <tbody>
              {nilaiSiswa.map((m, i) => (
                <tr key={i} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-semibold text-slate-800">{m.mapel}</td>
                  <td className="p-4 text-sm text-center text-slate-700">{m.tugas}</td>
                  <td className="p-4 text-sm text-center text-slate-700">{m.uts}</td>
                  <td className="p-4 text-sm text-center text-slate-700">{m.uas}</td>
                  <td className="p-4 text-sm text-center font-bold text-slate-800">{m.akhir}</td>
                  <td className="p-4 text-center">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      m.grade === 'A' ? 'bg-emerald-50 text-emerald-700' :
                      m.grade === 'B' ? 'bg-blue-50 text-blue-700' :
                      'bg-amber-50 text-amber-700'
                    }`}>
                      {m.grade}
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

export default OrtuNilaiPage;
