import React from 'react';

const stats = [
  { label: 'Total Pemasukan', value: 'Rp156.8jt', sub: 'Bulan ini', color: 'emerald', icon: '💰' },
  { label: 'Total Pengeluaran', value: 'Rp89.2jt', sub: 'Bulan ini', color: 'red', icon: '💸' },
  { label: 'Tagihan Aktif', value: '42', sub: 'Belum dibayar', color: 'orange', icon: '📋' },
  { label: 'Saldo', value: 'Rp67.6jt', sub: 'Tersedia', color: 'blue', icon: '🏦' },
];

const colorMap = {
  emerald: { bg: 'bg-emerald-50', text: 'text-emerald-600', sub: 'text-emerald-600' },
  red: { bg: 'bg-red-50', text: 'text-red-600', sub: 'text-red-600' },
  orange: { bg: 'bg-orange-50', text: 'text-orange-600', sub: 'text-orange-600' },
  blue: { bg: 'bg-blue-50', text: 'text-blue-600', sub: 'text-blue-600' },
};

const transaksi = [
  { tgl: '10 Jul 2026', keterangan: 'Pembayaran SPP Juni', jumlah: 150000, jenis: 'Masuk' },
  { tgl: '9 Jul 2026', keterangan: 'Pembelian ATK', jumlah: 850000, jenis: 'Keluar' },
  { tgl: '8 Jul 2026', keterangan: 'Pembayaran SPP Juli', jumlah: 150000, jenis: 'Masuk' },
  { tgl: '7 Jul 2026', keterangan: 'Biaya Listrik', jumlah: 1200000, jenis: 'Keluar' },
  { tgl: '6 Jul 2026', keterangan: 'Pendaftaran PPDB', jumlah: 250000, jenis: 'Masuk' },
];

const BendaharaDashboardPage = () => {
  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Dashboard Bendahara</h2>
        <p className="text-sm text-slate-500 mt-1">Overview keuangan sekolah</p>
      </div>

      <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
        {stats.map((s) => {
          const c = colorMap[s.color];
          return (
            <div key={s.label} className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all">
              <div className={`w-12 h-12 ${c.bg} rounded-2xl flex items-center justify-center mb-4 text-2xl`}>{s.icon}</div>
              <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">{s.label}</p>
              <h3 className="text-2xl font-bold text-slate-800 mt-1">{s.value}</h3>
              <p className={`text-[10px] font-bold mt-2 ${c.sub}`}>{s.sub}</p>
            </div>
          );
        })}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
          <div className="p-6 border-b border-slate-50">
            <h3 className="font-bold text-slate-800">Transaksi Terbaru</h3>
          </div>
          <div className="p-6 space-y-4">
            {transaksi.map((t, i) => (
              <div key={i} className="flex items-center justify-between p-3 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-colors">
                <div>
                  <p className="text-sm font-semibold text-slate-800">{t.keterangan}</p>
                  <p className="text-xs text-slate-500">{t.tgl}</p>
                </div>
                <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                  t.jenis === 'Masuk' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'
                }`}>
                  {t.jenis === 'Masuk' ? '+' : '-'} Rp{t.jumlah.toLocaleString()}
                </span>
              </div>
            ))}
          </div>
        </div>

        <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
          <h3 className="font-bold text-slate-800 mb-4">Rekap Pemasukan vs Pengeluaran</h3>
          <div className="space-y-6">
            <div>
              <div className="flex justify-between text-sm mb-1.5">
                <span className="text-slate-600">Pemasukan</span>
                <span className="font-semibold text-emerald-600">Rp156.8jt</span>
              </div>
              <div className="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                <div className="h-full bg-emerald-500 rounded-full" style={{ width: '64%' }}></div>
              </div>
            </div>
            <div>
              <div className="flex justify-between text-sm mb-1.5">
                <span className="text-slate-600">Pengeluaran</span>
                <span className="font-semibold text-red-600">Rp89.2jt</span>
              </div>
              <div className="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                <div className="h-full bg-red-500 rounded-full" style={{ width: '36%' }}></div>
              </div>
            </div>
            <div className="p-4 bg-emerald-50 rounded-2xl mt-4">
              <p className="text-sm font-semibold text-emerald-800">Saldo Akhir Bulan</p>
              <p className="text-2xl font-bold text-emerald-700 mt-1">Rp67.600.000</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default BendaharaDashboardPage;
