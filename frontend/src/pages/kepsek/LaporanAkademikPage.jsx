import React from 'react';

const dataLaporan = [
  { kelas: '6A', rataNilai: 84.5, tertinggi: 98, terendah: 65, tuntas: 28, total: 32 },
  { kelas: '6B', rataNilai: 82.0, tertinggi: 95, terendah: 60, tuntas: 26, total: 30 },
  { kelas: '5A', rataNilai: 79.5, tertinggi: 92, terendah: 58, tuntas: 24, total: 30 },
  { kelas: '5B', rataNilai: 81.0, tertinggi: 94, terendah: 62, tuntas: 25, total: 28 },
  { kelas: '4A', rataNilai: 78.5, tertinggi: 90, terendah: 55, tuntas: 22, total: 28 },
  { kelas: '4B', rataNilai: 80.0, tertinggi: 91, terendah: 60, tuntas: 23, total: 26 },
];

const KepsekLaporanAkademikPage = () => {
  const totalSiswa = dataLaporan.reduce((a, b) => a + b.total, 0);
  const totalTuntas = dataLaporan.reduce((a, b) => a + b.tuntas, 0);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Laporan Akademik</h2>
        <p className="text-sm text-slate-500 mt-1">Rekap nilai per kelas</p>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Total Siswa</p>
          <h3 className="text-3xl font-bold text-slate-800 mt-1">{totalSiswa}</h3>
          <p className="text-[10px] font-bold text-emerald-600 mt-2">Semua kelas</p>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Tuntas Belajar</p>
          <h3 className="text-3xl font-bold text-slate-800 mt-1">{totalTuntas}</h3>
          <p className="text-[10px] font-bold text-blue-600 mt-2">{Math.round((totalTuntas / totalSiswa) * 100)}% ketuntasan</p>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Rata-rata Nilai</p>
          <h3 className="text-3xl font-bold text-slate-800 mt-1">
            {(dataLaporan.reduce((a, b) => a + b.rataNilai, 0) / dataLaporan.length).toFixed(1)}
          </h3>
          <p className="text-[10px] font-bold text-purple-600 mt-2">Seluruh kelas</p>
        </div>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50 flex justify-between items-center">
          <h3 className="font-bold text-slate-800">Rekap Nilai per Kelas</h3>
          <button className="px-4 py-2 bg-emerald-600 text-white rounded-xl text-xs font-semibold hover:bg-emerald-700 transition-colors">
            Cetak Laporan
          </button>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">Kelas</th>
                <th className="p-4 font-semibold text-center">Rata-rata</th>
                <th className="p-4 font-semibold text-center">Tertinggi</th>
                <th className="p-4 font-semibold text-center">Terendah</th>
                <th className="p-4 font-semibold text-center">Tuntas</th>
                <th className="p-4 font-semibold text-center">Total</th>
                <th className="p-4 font-semibold text-center">Ketuntasan</th>
              </tr>
            </thead>
            <tbody>
              {dataLaporan.map((l, i) => (
                <tr key={i} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-semibold text-slate-800">Kelas {l.kelas}</td>
                  <td className="p-4 text-sm text-center text-slate-700">{l.rataNilai}</td>
                  <td className="p-4 text-sm text-center text-emerald-600 font-semibold">{l.tertinggi}</td>
                  <td className="p-4 text-sm text-center text-red-600 font-semibold">{l.terendah}</td>
                  <td className="p-4 text-sm text-center text-slate-700">{l.tuntas}</td>
                  <td className="p-4 text-sm text-center text-slate-700">{l.total}</td>
                  <td className="p-4 text-center">
                    <span className="px-3 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700">
                      {Math.round((l.tuntas / l.total) * 100)}%
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

export default KepsekLaporanAkademikPage;
