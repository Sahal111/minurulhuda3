import React from 'react';

const rekapAbsensi = [
  { bulan: 'Januari 2026', hadir: 22, sakit: 1, izin: 0, alpha: 0, persen: '96%' },
  { bulan: 'Februari 2026', hadir: 20, sakit: 0, izin: 1, alpha: 0, persen: '95%' },
  { bulan: 'Maret 2026', hadir: 23, sakit: 0, izin: 0, alpha: 0, persen: '100%' },
  { bulan: 'April 2026', hadir: 21, sakit: 1, izin: 0, alpha: 0, persen: '95%' },
  { bulan: 'Mei 2026', hadir: 22, sakit: 0, izin: 0, alpha: 0, persen: '100%' },
  { bulan: 'Juni 2026', hadir: 18, sakit: 0, izin: 1, alpha: 0, persen: '95%' },
];

const OrtuAbsensiPage = () => {
  const totalHadir = rekapAbsensi.reduce((a, b) => a + b.hadir, 0);
  const totalHari = rekapAbsensi.reduce((a, b) => a + b.hadir + b.sakit + b.izin + b.alpha, 0);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Absensi Anak</h2>
        <p className="text-sm text-slate-500 mt-1">Ahmad Fauzi — Kelas 6A</p>
      </div>

      <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Hadir</p>
          <h3 className="text-3xl font-bold text-emerald-600 mt-1">{totalHadir}</h3>
          <p className="text-[10px] font-bold text-slate-400 mt-2">Total hari</p>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Sakit</p>
          <h3 className="text-3xl font-bold text-amber-600 mt-1">{rekapAbsensi.reduce((a, b) => a + b.sakit, 0)}</h3>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Izin</p>
          <h3 className="text-3xl font-bold text-blue-600 mt-1">{rekapAbsensi.reduce((a, b) => a + b.izin, 0)}</h3>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Alpha</p>
          <h3 className="text-3xl font-bold text-red-600 mt-1">{rekapAbsensi.reduce((a, b) => a + b.alpha, 0)}</h3>
        </div>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50">
          <h3 className="font-bold text-slate-800">Rekap Absensi Bulanan</h3>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">Bulan</th>
                <th className="p-4 font-semibold text-center">Hadir</th>
                <th className="p-4 font-semibold text-center">Sakit</th>
                <th className="p-4 font-semibold text-center">Izin</th>
                <th className="p-4 font-semibold text-center">Alpha</th>
                <th className="p-4 font-semibold text-center">Persentase</th>
              </tr>
            </thead>
            <tbody>
              {rekapAbsensi.map((r, i) => (
                <tr key={i} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-semibold text-slate-800">{r.bulan}</td>
                  <td className="p-4 text-sm text-center text-slate-700">{r.hadir}</td>
                  <td className="p-4 text-sm text-center text-amber-600">{r.sakit}</td>
                  <td className="p-4 text-sm text-center text-blue-600">{r.izin}</td>
                  <td className="p-4 text-sm text-center text-red-600">{r.alpha}</td>
                  <td className="p-4 text-center">
                    <span className="px-3 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700">
                      {r.persen}
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

export default OrtuAbsensiPage;
