import React, { useState } from 'react';

const dataNilai = [
  { nis: '23101', nama: 'Ahmad Fauzi', kelas: '6A', tugas: 85, uts: 78, uas: 92 },
  { nis: '23102', nama: 'Siti Nurhaliza', kelas: '6A', tugas: 90, uts: 88, uas: 95 },
  { nis: '23103', nama: 'Budi Santoso', kelas: '6A', tugas: 72, uts: 65, uas: 70 },
  { nis: '23104', nama: 'Dewi Lestari', kelas: '6A', tugas: 88, uts: 82, uas: 85 },
  { nis: '23105', nama: 'Rizky Pratama', kelas: '6A', tugas: 78, uts: 80, uas: 75 },
  { nis: '23106', nama: 'Fitri Handayani', kelas: '6A', tugas: 95, uts: 90, uas: 96 },
];

const GuruNilaiPage = () => {
  const [kelas, setKelas] = useState('6A');
  const [mapel, setMapel] = useState('Matematika');

  const hitungAkhir = (tugas, uts, uas) =>
    Math.round(tugas * 0.3 + uts * 0.3 + uas * 0.4);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Input Nilai</h2>
        <p className="text-sm text-slate-500 mt-1">Kelola nilai siswa</p>
      </div>

      <div className="flex flex-wrap gap-4 items-center">
        <div className="flex items-center gap-2">
          <label className="text-sm font-semibold text-slate-600">Kelas:</label>
          <select
            value={kelas}
            onChange={(e) => setKelas(e.target.value)}
            className="px-4 py-2 rounded-xl border border-slate-200 text-sm bg-white"
          >
            <option>6A</option>
            <option>6B</option>
            <option>5A</option>
            <option>5B</option>
          </select>
        </div>
        <div className="flex items-center gap-2">
          <label className="text-sm font-semibold text-slate-600">Mapel:</label>
          <select
            value={mapel}
            onChange={(e) => setMapel(e.target.value)}
            className="px-4 py-2 rounded-xl border border-slate-200 text-sm bg-white"
          >
            <option>Matematika</option>
            <option>IPA</option>
            <option>Bahasa Indonesia</option>
          </select>
        </div>
        <button className="px-6 py-2 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors ml-auto">
          Simpan Nilai
        </button>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50">
          <h3 className="font-bold text-slate-800">
            Nilai {mapel} — Kelas {kelas}
          </h3>
          <p className="text-xs text-slate-400 mt-1">
            Bobot: Tugas 30% | UTS 30% | UAS 40%
          </p>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">No</th>
                <th className="p-4 font-semibold">NIS</th>
                <th className="p-4 font-semibold">Nama</th>
                <th className="p-4 font-semibold text-center">Tugas</th>
                <th className="p-4 font-semibold text-center">UTS</th>
                <th className="p-4 font-semibold text-center">UAS</th>
                <th className="p-4 font-semibold text-center">Akhir</th>
                <th className="p-4 font-semibold text-center">Grade</th>
              </tr>
            </thead>
            <tbody>
              {dataNilai.filter(s => s.kelas === kelas).map((s, i) => {
                const akhir = hitungAkhir(s.tugas, s.uts, s.uas);
                const grade = akhir >= 90 ? 'A' : akhir >= 80 ? 'B' : akhir >= 70 ? 'C' : 'D';
                const gradeColor =
                  grade === 'A' ? 'text-emerald-600 bg-emerald-50' :
                  grade === 'B' ? 'text-blue-600 bg-blue-50' :
                  grade === 'C' ? 'text-amber-600 bg-amber-50' :
                  'text-red-600 bg-red-50';

                return (
                  <tr key={s.nis} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                    <td className="p-4 text-sm text-slate-500">{i + 1}</td>
                    <td className="p-4 text-sm font-medium text-slate-700">{s.nis}</td>
                    <td className="p-4 text-sm font-semibold text-slate-800">{s.nama}</td>
                    <td className="p-4 text-center">
                      <input
                        type="number"
                        defaultValue={s.tugas}
                        className="w-16 px-2 py-1 text-sm text-center rounded-lg border border-slate-200"
                      />
                    </td>
                    <td className="p-4 text-center">
                      <input
                        type="number"
                        defaultValue={s.uts}
                        className="w-16 px-2 py-1 text-sm text-center rounded-lg border border-slate-200"
                      />
                    </td>
                    <td className="p-4 text-center">
                      <input
                        type="number"
                        defaultValue={s.uas}
                        className="w-16 px-2 py-1 text-sm text-center rounded-lg border border-slate-200"
                      />
                    </td>
                    <td className="p-4 text-center font-bold text-slate-800">{akhir}</td>
                    <td className="p-4 text-center">
                      <span className={`px-3 py-1 rounded-lg text-xs font-bold ${gradeColor}`}>
                        {grade}
                      </span>
                    </td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default GuruNilaiPage;
