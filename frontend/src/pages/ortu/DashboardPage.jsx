import React from 'react';

const anak = {
  nama: 'Ahmad Fauzi',
  nis: '23101',
  kelas: '6A',
  foto: 'AF',
};

const stats = [
  { label: 'Rata-rata Nilai', value: '85', sub: 'Semester ini', color: 'emerald', icon: '📝' },
  { label: 'Kehadiran', value: '96%', sub: 'Bulan ini', color: 'blue', icon: '✅' },
  { label: 'Prestasi', value: '3', sub: 'Penghargaan', color: 'purple', icon: '🏆' },
  { label: 'Tagihan', value: 'Rp0', sub: 'Lunas', color: 'green', icon: '💰' },
];

const colorMap = {
  emerald: { bg: 'bg-emerald-50', text: 'text-emerald-600' },
  blue: { bg: 'bg-blue-50', text: 'text-blue-600' },
  purple: { bg: 'bg-purple-50', text: 'text-purple-600' },
  green: { bg: 'bg-green-50', text: 'text-green-600' },
};

const pengumuman = [
  { judul: 'Pembagian Rapor Semester', tgl: '25 Juli 2026', penting: true },
  { judul: 'Libur Semester Ganjil', tgl: '26 Jul - 15 Jul 2026', penting: false },
  { judul: 'Kegiatan Class Meeting', tgl: '20-24 Juli 2026', penting: false },
];

const OrtuDashboardPage = () => {
  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
        <div className="flex items-center gap-4">
          <div className="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl font-bold">
            {anak.foto}
          </div>
          <div>
            <h2 className="text-xl font-bold text-slate-800">{anak.nama}</h2>
            <p className="text-sm text-slate-500">NIS: {anak.nis} • Kelas: {anak.kelas}</p>
          </div>
        </div>
      </div>

      <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
        {stats.map((s) => {
          const c = colorMap[s.color];
          return (
            <div key={s.label} className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all">
              <div className={`w-12 h-12 ${c.bg} rounded-2xl flex items-center justify-center mb-4 text-2xl`}>
                {s.icon}
              </div>
              <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">{s.label}</p>
              <h3 className="text-3xl font-bold text-slate-800 mt-1">{s.value}</h3>
              <p className={`text-[10px] font-bold mt-2 ${c.text}`}>{s.sub}</p>
            </div>
          );
        })}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
          <div className="p-6 border-b border-slate-50">
            <h3 className="font-bold text-slate-800">Pengumuman Terbaru</h3>
          </div>
          <div className="p-6 space-y-4">
            {pengumuman.map((p, i) => (
              <div key={i} className="flex items-start gap-3">
                <div className={`w-2 h-2 rounded-full mt-2 ${p.penting ? 'bg-red-500' : 'bg-slate-300'}`}></div>
                <div>
                  <p className="text-sm font-semibold text-slate-800">{p.judul}</p>
                  <p className="text-xs text-slate-500">{p.tgl}</p>
                </div>
              </div>
            ))}
          </div>
        </div>

        <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
          <h3 className="font-bold text-slate-800 mb-4">Informasi Pembayaran</h3>
          <div className="flex items-center justify-between p-4 bg-emerald-50 rounded-2xl">
            <div>
              <p className="text-sm font-semibold text-emerald-800">Status Pembayaran</p>
              <p className="text-xs text-emerald-600">SPP Bulan Juli 2026</p>
            </div>
            <span className="px-4 py-1.5 bg-emerald-600 text-white rounded-xl text-xs font-bold">
              LUNAS
            </span>
          </div>
        </div>
      </div>
    </div>
  );
};

export default OrtuDashboardPage;
