import React, { useState } from 'react';

const dataSiswa = [
  { nis: '23101', nama: 'Ahmad Fauzi', kelas: '6A' },
  { nis: '23102', nama: 'Siti Nurhaliza', kelas: '6A' },
  { nis: '23103', nama: 'Budi Santoso', kelas: '6A' },
  { nis: '23104', nama: 'Dewi Lestari', kelas: '6A' },
];

const mapelNilai = [
  { mapel: 'Matematika', nilai: 88, grade: 'B' },
  { mapel: 'IPA', nilai: 92, grade: 'A' },
  { mapel: 'Bahasa Indonesia', nilai: 85, grade: 'B' },
  { mapel: 'IPS', nilai: 78, grade: 'C' },
  { mapel: 'Pendidikan Agama', nilai: 95, grade: 'A' },
];

const GuruRaporPage = () => {
  const [selectedSiswa, setSelectedSiswa] = useState(dataSiswa[0]);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Rapor Siswa</h2>
          <p className="text-sm text-slate-500 mt-1">Lihat rapor dan hasil belajar siswa</p>
        </div>
        <button className="px-6 py-2 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors">
          Cetak Rapor
        </button>
      </div>

      <div className="flex flex-wrap gap-2">
        {dataSiswa.map((s) => (
          <button
            key={s.nis}
            onClick={() => setSelectedSiswa(s)}
            className={`px-4 py-2 rounded-xl text-sm font-semibold transition-all ${
              selectedSiswa.nis === s.nis
                ? 'bg-emerald-600 text-white shadow-md'
                : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200'
            }`}
          >
            {s.nama}
          </button>
        ))}
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50">
          <div className="flex items-center gap-4">
            <div className="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl font-bold">
              {selectedSiswa.nama.charAt(0)}
            </div>
            <div>
              <h3 className="font-bold text-slate-800 text-lg">{selectedSiswa.nama}</h3>
              <p className="text-sm text-slate-500">
                NIS: {selectedSiswa.nis} • Kelas: {selectedSiswa.kelas}
              </p>
            </div>
          </div>
        </div>
        <div className="p-6">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-100">
                <th className="pb-3 font-semibold">Mata Pelajaran</th>
                <th className="pb-3 font-semibold text-center">Nilai</th>
                <th className="pb-3 font-semibold text-center">Grade</th>
              </tr>
            </thead>
            <tbody>
              {mapelNilai.map((m, i) => (
                <tr key={i} className="border-b border-slate-50">
                  <td className="py-3 text-sm font-medium text-slate-700">{m.mapel}</td>
                  <td className="py-3 text-sm text-center font-semibold text-slate-800">{m.nilai}</td>
                  <td className="py-3 text-center">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      m.grade === 'A' ? 'text-emerald-600 bg-emerald-50' :
                      m.grade === 'B' ? 'text-blue-600 bg-blue-50' :
                      'text-amber-600 bg-amber-50'
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

export default GuruRaporPage;
