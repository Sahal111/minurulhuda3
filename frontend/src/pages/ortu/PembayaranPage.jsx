import React from 'react';

const riwayatPembayaran = [
  { bulan: 'Januari 2026', spp: 150000, status: 'Lunas', tglBayar: '5 Jan 2026' },
  { bulan: 'Februari 2026', spp: 150000, status: 'Lunas', tglBayar: '3 Feb 2026' },
  { bulan: 'Maret 2026', spp: 150000, status: 'Lunas', tglBayar: '7 Mar 2026' },
  { bulan: 'April 2026', spp: 150000, status: 'Lunas', tglBayar: '2 Apr 2026' },
  { bulan: 'Mei 2026', spp: 150000, status: 'Lunas', tglBayar: '6 Mei 2026' },
  { bulan: 'Juni 2026', spp: 150000, status: 'Lunas', tglBayar: '4 Jun 2026' },
  { bulan: 'Juli 2026', spp: 150000, status: 'Belum', tglBayar: '-' },
];

const totalBayar = riwayatPembayaran.filter((r) => r.status === 'Lunas').length * 150000;
const totalBelum = riwayatPembayaran.filter((r) => r.status === 'Belum').length * 150000;

const OrtuPembayaranPage = () => {
  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Pembayaran</h2>
        <p className="text-sm text-slate-500 mt-1">Riwayat pembayaran SPP</p>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Total Terbayar</p>
          <h3 className="text-2xl font-bold text-emerald-600 mt-1">Rp{totalBayar.toLocaleString()}</h3>
          <p className="text-[10px] font-bold text-slate-400 mt-2">7 bulan</p>
        </div>
        <div className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100">
          <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Tagihan Berjalan</p>
          <h3 className="text-2xl font-bold text-amber-600 mt-1">Rp{totalBelum.toLocaleString()}</h3>
          <p className="text-[10px] font-bold text-slate-400 mt-2">Juli 2026</p>
        </div>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50 flex justify-between items-center">
          <h3 className="font-bold text-slate-800">Riwayat Pembayaran SPP</h3>
          <button className="px-4 py-2 bg-emerald-600 text-white rounded-xl text-xs font-semibold hover:bg-emerald-700 transition-colors">
            Bayar Sekarang
          </button>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">Bulan</th>
                <th className="p-4 font-semibold text-right">Nominal</th>
                <th className="p-4 font-semibold text-center">Status</th>
                <th className="p-4 font-semibold text-right">Tgl Bayar</th>
              </tr>
            </thead>
            <tbody>
              {riwayatPembayaran.map((r, i) => (
                <tr key={i} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm font-semibold text-slate-800">{r.bulan}</td>
                  <td className="p-4 text-sm text-right font-medium text-slate-700">Rp{r.spp.toLocaleString()}</td>
                  <td className="p-4 text-center">
                    <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                      r.status === 'Lunas' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'
                    }`}>
                      {r.status}
                    </span>
                  </td>
                  <td className="p-4 text-sm text-right text-slate-500">{r.tglBayar}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default OrtuPembayaranPage;
