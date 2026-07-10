import React from 'react';

const dataLaporan = [
  { gelombang: 'Gelombang 1', pendaftar: 98, diverifikasi: 85, diterima: 72, ditolak: 5 },
  { gelombang: 'Gelombang 2', pendaftar: 58, diverifikasi: 42, diterima: 13, ditolak: 3 },
];

const AdminPPDBLaporanPage = () => {
  const totalPendaftar = dataLaporan.reduce((a, b) => a + b.pendaftar, 0);
  const totalDiterima = dataLaporan.reduce((a, b) => a + b.diterima, 0);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Laporan PPDB</h2>
          <p className="text-sm text-slate-500 mt-1">Rekap penerimaan peserta didik baru</p>
        </div>
        <button className="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors">
          Cetak Laporan
        </button>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Total Pendaftar</p>
          <h3 className="text-3xl font-bold text-slate-800 mt-1">{totalPendaftar}</h3>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Diterima</p>
          <h3 className="text-3xl font-bold text-emerald-600 mt-1">{totalDiterima}</h3>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Persentase</p>
          <h3 className="text-3xl font-bold text-blue-600 mt-1">{Math.round((totalDiterima / totalPendaftar) * 100)}%</h3>
        </div>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50">
          <h3 className="font-bold text-slate-800">Rekap per Gelombang</h3>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">Gelombang</th>
                <th className="p-4 font-semibold text-center">Pendaftar</th>
                <th className="p-4 font-semibold text-center">Diverifikasi</th>
                <th className="p-4 font-semibold text-center">Diterima</th>
                <th className="p-4 font-semibold text-center">Ditolak</th>
              </tr>
            </thead>
            <tbody>
              {dataLaporan.map((l, i) => (
                <tr key={i} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-semibold text-slate-800">{l.gelombang}</td>
                  <td className="p-4 text-sm text-center text-slate-700">{l.pendaftar}</td>
                  <td className="p-4 text-sm text-center text-blue-600 font-medium">{l.diverifikasi}</td>
                  <td className="p-4 text-sm text-center text-emerald-600 font-medium">{l.diterima}</td>
                  <td className="p-4 text-sm text-center text-red-600 font-medium">{l.ditolak}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default AdminPPDBLaporanPage;
