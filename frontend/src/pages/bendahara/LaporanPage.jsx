import React from 'react';

const dataLaporan = [
  { bulan: 'Januari 2026', pemasukan: 28500000, pengeluaran: 18200000, saldo: 10300000 },
  { bulan: 'Februari 2026', pemasukan: 27300000, pengeluaran: 19500000, saldo: 7800000 },
  { bulan: 'Maret 2026', pemasukan: 29100000, pengeluaran: 17800000, saldo: 11300000 },
  { bulan: 'April 2026', pemasukan: 26800000, pengeluaran: 20100000, saldo: 6700000 },
  { bulan: 'Mei 2026', pemasukan: 30200000, pengeluaran: 18800000, saldo: 11400000 },
  { bulan: 'Juni 2026', pemasukan: 27900000, pengeluaran: 19200000, saldo: 8700000 },
];

const BendaharaLaporanPage = () => {
  const totalPemasukan = dataLaporan.reduce((a, b) => a + b.pemasukan, 0);
  const totalPengeluaran = dataLaporan.reduce((a, b) => a + b.pengeluaran, 0);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Laporan Keuangan</h2>
          <p className="text-sm text-slate-500 mt-1">Rekap laporan keuangan periode</p>
        </div>
        <button className="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors">
          Cetak Laporan
        </button>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Total Pemasukan</p>
          <h3 className="text-2xl font-bold text-emerald-600 mt-1">Rp{totalPemasukan.toLocaleString()}</h3>
          <p className="text-[10px] font-bold text-slate-400 mt-2">6 bulan</p>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Total Pengeluaran</p>
          <h3 className="text-2xl font-bold text-red-600 mt-1">Rp{totalPengeluaran.toLocaleString()}</h3>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Saldo Bersih</p>
          <h3 className="text-2xl font-bold text-blue-600 mt-1">Rp{(totalPemasukan - totalPengeluaran).toLocaleString()}</h3>
        </div>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50">
          <h3 className="font-bold text-slate-800">Laporan Bulanan — TA 2025/2026</h3>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">Bulan</th>
                <th className="p-4 font-semibold text-right">Pemasukan</th>
                <th className="p-4 font-semibold text-right">Pengeluaran</th>
                <th className="p-4 font-semibold text-right">Saldo</th>
              </tr>
            </thead>
            <tbody>
              {dataLaporan.map((l, i) => (
                <tr key={i} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-semibold text-slate-800">{l.bulan}</td>
                  <td className="p-4 text-sm text-right text-emerald-600 font-medium">Rp{l.pemasukan.toLocaleString()}</td>
                  <td className="p-4 text-sm text-right text-red-600 font-medium">Rp{l.pengeluaran.toLocaleString()}</td>
                  <td className="p-4 text-sm text-right font-bold text-slate-800">Rp{l.saldo.toLocaleString()}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default BendaharaLaporanPage;
