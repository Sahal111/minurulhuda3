import React from 'react';

const aktivitasKelas = [
  { kelas: '6A', wali: 'Dr. H. Ahmad S.Pd.I', kehadiran: '96%', aktivitas: 'Baik', catatan: 'Pembelajaran kondusif' },
  { kelas: '6B', wali: 'Siti Aminah, S.Pd.', kehadiran: '94%', aktivitas: 'Baik', catatan: 'Persiapan ujian' },
  { kelas: '5A', wali: 'Bambang Supriyadi, S.Pd.', kehadiran: '92%', aktivitas: 'Cukup', catatan: 'Beberapa siswa perlu perhatian' },
  { kelas: '5B', wali: 'Dewi Sartika, S.Pd.', kehadiran: '95%', aktivitas: 'Baik', catatan: 'Proyek kelas berjalan' },
  { kelas: '4A', wali: 'Aris Setiawan, S.Pd.', kehadiran: '90%', aktivitas: 'Cukup', catatan: 'Adaptasi kelas baru' },
  { kelas: '4B', wali: 'Fitriani, S.Pd.', kehadiran: '88%', aktivitas: 'Kurang', catatan: 'Perlu evaluasi metode ajar' },
];

const KepsekMonitoringPage = () => {
  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Monitoring Kelas</h2>
        <p className="text-sm text-slate-500 mt-1">Pantau aktivitas belajar mengajar</p>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-4 gap-4">
        {[
          { label: 'Kelas Aktif', value: '18', color: 'text-emerald-600', bg: 'bg-emerald-50' },
          { label: 'Aktivitas Baik', value: '12', color: 'text-blue-600', bg: 'bg-blue-50' },
          { label: 'Perlu Perhatian', value: '4', color: 'text-amber-600', bg: 'bg-amber-50' },
          { label: 'Evaluasi', value: '2', color: 'text-red-600', bg: 'bg-red-50' },
        ].map((item) => (
          <div key={item.label} className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
            <div className={`w-10 h-10 ${item.bg} rounded-xl flex items-center justify-center mb-3`}>
              <span className={`text-lg font-bold ${item.color}`}>{item.value}</span>
            </div>
            <p className="text-xs font-semibold text-slate-500">{item.label}</p>
          </div>
        ))}
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50">
          <h3 className="font-bold text-slate-800">Aktivitas per Kelas</h3>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">Kelas</th>
                <th className="p-4 font-semibold">Wali Kelas</th>
                <th className="p-4 font-semibold text-center">Kehadiran</th>
                <th className="p-4 font-semibold text-center">Aktivitas</th>
                <th className="p-4 font-semibold">Catatan</th>
              </tr>
            </thead>
            <tbody>
              {aktivitasKelas.map((a, i) => (
                <tr key={i} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-semibold text-slate-800">Kelas {a.kelas}</td>
                  <td className="p-4 text-sm text-slate-600">{a.wali}</td>
                  <td className="p-4 text-sm text-center font-medium text-slate-700">{a.kehadiran}</td>
                  <td className="p-4 text-center">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      a.aktivitas === 'Baik' ? 'bg-emerald-50 text-emerald-700' :
                      a.aktivitas === 'Cukup' ? 'bg-amber-50 text-amber-700' :
                      'bg-red-50 text-red-700'
                    }`}>
                      {a.aktivitas}
                    </span>
                  </td>
                  <td className="p-4 text-sm text-slate-500">{a.catatan}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default KepsekMonitoringPage;
