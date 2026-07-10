import React from 'react';

const dataKinerja = [
  { guru: 'Dr. H. Ahmad S.Pd.I', mapel: 'Pend. Agama', kehadiran: '98%', kinerja: 'A', status: 'Sangat Baik' },
  { guru: 'Siti Aminah, S.Pd.', mapel: 'Matematika', kehadiran: '95%', kinerja: 'A', status: 'Sangat Baik' },
  { guru: 'Bambang Supriyadi, S.Pd.', mapel: 'IPA', kehadiran: '92%', kinerja: 'B', status: 'Baik' },
  { guru: 'Dewi Sartika, S.Pd.', mapel: 'Bahasa Indonesia', kehadiran: '88%', kinerja: 'B', status: 'Baik' },
  { guru: 'Aris Setiawan, S.Pd.', mapel: 'Matematika', kehadiran: '96%', kinerja: 'A', status: 'Sangat Baik' },
  { guru: 'Fitriani, S.Pd.', mapel: 'IPS', kehadiran: '85%', kinerja: 'C', status: 'Cukup' },
];

const KepsekLaporanKinerjaPage = () => {
  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Laporan Kinerja Guru</h2>
        <p className="text-sm text-slate-500 mt-1">Evaluasi kinerja guru periode ini</p>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50 flex justify-between items-center">
          <h3 className="font-bold text-slate-800">Kinerja Guru — Semester Ganjil 2025/2026</h3>
          <button className="px-4 py-2 bg-emerald-600 text-white rounded-xl text-xs font-semibold hover:bg-emerald-700 transition-colors">
            Cetak Laporan
          </button>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">No</th>
                <th className="p-4 font-semibold">Nama Guru</th>
                <th className="p-4 font-semibold">Mapel</th>
                <th className="p-4 font-semibold text-center">Kehadiran</th>
                <th className="p-4 font-semibold text-center">Nilai Kinerja</th>
                <th className="p-4 font-semibold text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              {dataKinerja.map((k, i) => (
                <tr key={i} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm text-slate-500">{i + 1}</td>
                  <td className="p-4 text-sm font-semibold text-slate-800">{k.guru}</td>
                  <td className="p-4 text-sm text-slate-500">{k.mapel}</td>
                  <td className="p-4 text-sm text-center font-medium text-slate-700">{k.kehadiran}</td>
                  <td className="p-4 text-center">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      k.kinerja === 'A' ? 'bg-emerald-50 text-emerald-700' :
                      k.kinerja === 'B' ? 'bg-blue-50 text-blue-700' :
                      'bg-amber-50 text-amber-700'
                    }`}>
                      {k.kinerja}
                    </span>
                  </td>
                  <td className="p-4 text-center">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      k.status === 'Sangat Baik' ? 'bg-emerald-50 text-emerald-700' :
                      k.status === 'Baik' ? 'bg-blue-50 text-blue-700' :
                      'bg-amber-50 text-amber-700'
                    }`}>
                      {k.status}
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

export default KepsekLaporanKinerjaPage;
