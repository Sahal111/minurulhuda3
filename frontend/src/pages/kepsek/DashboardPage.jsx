import React from 'react';

const stats = [
  { label: 'Total Guru', value: '42', sub: 'Aktif mengajar', color: 'emerald', icon: '👨‍🏫' },
  { label: 'Total Siswa', value: '1,248', sub: 'Aktif belajar', color: 'blue', icon: '👥' },
  { label: 'Total Kelas', value: '18', sub: 'Aktif', color: 'purple', icon: '🏫' },
  { label: 'Kehadiran', value: '96%', sub: 'Rata-rata bulan ini', color: 'orange', icon: '📊' },
  { label: 'Nilai Rata-rata', value: '82.5', sub: 'Semester Ganjil', color: 'indigo', icon: '📝' },
  { label: 'Guru Teladan', value: '5', sub: 'Bulan ini', color: 'rose', icon: '⭐' },
];

const colorMap = {
  emerald: { bg: 'bg-emerald-50', text: 'text-emerald-600', sub: 'text-emerald-600' },
  blue: { bg: 'bg-blue-50', text: 'text-blue-600', sub: 'text-blue-600' },
  purple: { bg: 'bg-purple-50', text: 'text-purple-600', sub: 'text-purple-600' },
  orange: { bg: 'bg-orange-50', text: 'text-orange-600', sub: 'text-orange-600' },
  indigo: { bg: 'bg-indigo-50', text: 'text-indigo-600', sub: 'text-indigo-600' },
  rose: { bg: 'bg-rose-50', text: 'text-rose-600', sub: 'text-rose-600' },
};

const laporan = [
  { judul: 'Laporan Bulanan', status: 'Siap', tipe: 'Akademik', tgl: '10 Jul 2026' },
  { judul: 'Rekap Kehadiran', status: 'Proses', tipe: 'Kehadiran', tgl: '9 Jul 2026' },
  { judul: 'Statistik Nilai', status: 'Siap', tipe: 'Akademik', tgl: '8 Jul 2026' },
  { judul: 'Kinerja Guru', status: 'Draft', tipe: 'SDM', tgl: '7 Jul 2026' },
];

const KepsekDashboardPage = () => {
  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Dashboard Kepala Sekolah</h2>
          <p className="text-sm text-slate-500 mt-1">Overview kondisi sekolah</p>
        </div>
        <div className="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl text-sm font-semibold">
          TA 2025/2026 • Ganjil
        </div>
      </div>

      <div className="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-4">
        {stats.map((s) => {
          const c = colorMap[s.color];
          return (
            <div key={s.label} className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all group">
              <div className={`w-12 h-12 ${c.bg} rounded-2xl flex items-center justify-center mb-4 text-2xl`}>
                {s.icon}
              </div>
              <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">{s.label}</p>
              <h3 className="text-3xl font-bold text-slate-800 mt-1">{s.value}</h3>
              <p className={`text-[10px] font-bold mt-2 ${c.sub}`}>{s.sub}</p>
            </div>
          );
        })}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
          <div className="p-6 border-b border-slate-50">
            <h3 className="font-bold text-slate-800">Laporan Terbaru</h3>
          </div>
          <div className="p-6 space-y-4">
            {laporan.map((l, i) => (
              <div key={i} className="flex items-center justify-between p-4 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-colors">
                <div>
                  <p className="font-semibold text-slate-800 text-sm">{l.judul}</p>
                  <p className="text-xs text-slate-500">{l.tipe} • {l.tgl}</p>
                </div>
                <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                  l.status === 'Siap' ? 'bg-emerald-50 text-emerald-700' :
                  l.status === 'Proses' ? 'bg-blue-50 text-blue-700' :
                  'bg-amber-50 text-amber-700'
                }`}>
                  {l.status}
                </span>
              </div>
            ))}
          </div>
        </div>

        <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
          <h3 className="font-bold text-slate-800 mb-4">Statistik Cepat</h3>
          <div className="space-y-6">
            <div>
              <div className="flex justify-between text-sm mb-1.5">
                <span className="text-slate-600">Kehadiran Guru</span>
                <span className="font-semibold text-slate-800">94%</span>
              </div>
              <div className="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                <div className="h-full bg-emerald-500 rounded-full" style={{ width: '94%' }}></div>
              </div>
            </div>
            <div>
              <div className="flex justify-between text-sm mb-1.5">
                <span className="text-slate-600">Kehadiran Siswa</span>
                <span className="font-semibold text-slate-800">96%</span>
              </div>
              <div className="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                <div className="h-full bg-blue-500 rounded-full" style={{ width: '96%' }}></div>
              </div>
            </div>
            <div>
              <div className="flex justify-between text-sm mb-1.5">
                <span className="text-slate-600">Ketuntasan Belajar</span>
                <span className="font-semibold text-slate-800">78%</span>
              </div>
              <div className="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                <div className="h-full bg-purple-500 rounded-full" style={{ width: '78%' }}></div>
              </div>
            </div>
            <div>
              <div className="flex justify-between text-sm mb-1.5">
                <span className="text-slate-600">Target PPDB</span>
                <span className="font-semibold text-slate-800">85%</span>
              </div>
              <div className="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                <div className="h-full bg-orange-500 rounded-full" style={{ width: '85%' }}></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default KepsekDashboardPage;
