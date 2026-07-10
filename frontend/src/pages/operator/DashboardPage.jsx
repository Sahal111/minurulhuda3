import React, { useState } from 'react';

const stats = [
  { label: 'Total Siswa', value: '1,248', sub: '+12 bulan ini', color: 'emerald', icon: '👥' },
  { label: 'Total Guru', value: '42', sub: 'Aktif mengajar', color: 'blue', icon: '👨‍🏫' },
  { label: 'Total Kelas', value: '18', sub: 'Kapasitas penuh', color: 'purple', icon: '🏫' },
  { label: 'User Aktif', value: '156', sub: 'Login hari ini', color: 'orange', icon: '🛡️' },
  { label: 'TA Aktif', value: '24/25', sub: 'Semester Ganjil', color: 'indigo', icon: '📅' },
  { label: 'Data Error', value: '24', sub: 'Validasi segera', color: 'rose', icon: '⚠️' },
];

const colorMap = {
  emerald: { bg: 'bg-emerald-50', text: 'text-emerald-600', sub: 'text-emerald-600' },
  blue: { bg: 'bg-blue-50', text: 'text-blue-600', sub: 'text-blue-600' },
  purple: { bg: 'bg-purple-50', text: 'text-purple-600', sub: 'text-purple-600' },
  orange: { bg: 'bg-orange-50', text: 'text-orange-600', sub: 'text-orange-600' },
  indigo: { bg: 'bg-indigo-50', text: 'text-indigo-600', sub: 'text-indigo-600' },
  rose: { bg: 'bg-rose-50', text: 'text-rose-600', sub: 'text-rose-600' },
};

const activities = [
  { icon: '➕', bg: 'bg-emerald-100', text: 'text-emerald-600', title: 'Siswa Baru Ditambahkan', desc: 'Operator Aris mendaftarkan Muhammad Rehan (NIS: 23144)', time: 'Baru saja' },
  { icon: '✅', bg: 'bg-blue-100', text: 'text-blue-600', title: 'Import Berhasil', desc: 'Berhasil mengimpor 45 data Nilai Semester dari file template_nilai.xlsx', time: '12 menit lalu' },
  { icon: '🔒', bg: 'bg-orange-100', text: 'text-orange-600', title: 'Perubahan Hak Akses', desc: "Role 'Guru Piket' ditambahkan ke user Fatimah Az-Zahra", time: '1 jam lalu' },
  { icon: '☁️', bg: 'bg-purple-100', text: 'text-purple-600', title: 'Backup Otomatis Selesai', desc: 'Database berhasil dicadangkan ke Google Drive (Size: 24.5 MB)', time: '04:00 AM' },
];

const OperatorDashboardPage = () => {
  const [filterOpen, setFilterOpen] = useState(false);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      {/* System Alert */}
      <div className="bg-amber-50 border border-amber-200 border-l-4 border-l-amber-500 rounded-3xl p-5 flex items-start gap-4 shadow-sm">
        <div className="p-2.5 bg-amber-100 text-amber-600 rounded-2xl shrink-0">⚠️</div>
        <div>
          <h4 className="font-bold text-amber-800 text-sm">System Alert (Action Required)</h4>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
            <div className="flex items-center gap-2 text-xs text-amber-700">
              <span className="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
              12 Siswa belum punya kelas
            </div>
            <div className="flex items-center gap-2 text-xs text-amber-700">
              <span className="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
              5 Guru belum assign mapel
            </div>
            <div className="flex items-center gap-2 text-xs text-amber-700">
              <span className="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
              Tahun Ajaran 2025/2026 Belum Aktif
            </div>
          </div>
        </div>
      </div>

      {/* Summary Cards */}
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

      {/* Charts / Feeds */}
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {/* Aktivitas Sistem */}
        <div className="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col">
          <div className="p-6 border-b border-slate-50 flex justify-between items-center">
            <h3 className="font-bold text-slate-800">Aktivitas Sistem Terbaru</h3>
            <div className="flex gap-2">
              <button className="p-2 hover:bg-slate-50 rounded-xl transition-all">🔄</button>
              <button
                onClick={() => setFilterOpen(!filterOpen)}
                className="text-xs font-bold text-emerald-600 hover:bg-emerald-50 px-4 py-2 rounded-xl transition-all"
              >
                Filter
              </button>
            </div>
          </div>
          <div className="p-6 flex-1 overflow-y-auto max-h-[450px] space-y-6">
            {activities.map((a, i) => (
              <div key={i} className="flex gap-4">
                <div className={`w-10 h-10 ${a.bg} ${a.text} rounded-xl flex items-center justify-center shrink-0 text-lg`}>
                  {a.icon}
                </div>
                <div className={`flex-1 ${i < activities.length - 1 ? 'border-b border-slate-50 pb-4' : ''}`}>
                  <div className="flex justify-between items-center">
                    <p className="text-sm font-bold text-slate-800">{a.title}</p>
                    <span className="text-[10px] text-slate-400 font-medium">{a.time}</span>
                  </div>
                  <p className="text-xs text-slate-500 mt-1">{a.desc}</p>
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Sidebar Kanan */}
        <div className="space-y-6">
          {/* Integrasi Dapodik */}
          <div className="bg-emerald-900 text-white rounded-[2rem] p-8 shadow-xl relative overflow-hidden group">
            <div className="absolute -right-4 -top-4 w-24 h-24 bg-emerald-800 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
            <h4 className="text-lg font-bold mb-4 relative z-10">Integrasi Dapodik</h4>
            <div className="space-y-4 relative z-10">
              <div className="flex justify-between items-center text-xs">
                <span className="text-emerald-300">Terakhir Sinkron</span>
                <span className="font-bold">Hari ini, 08:30</span>
              </div>
              <div className="flex justify-between items-center text-xs">
                <span className="text-emerald-300">Status Koneksi</span>
                <span className="flex items-center gap-1.5 font-bold text-emerald-400">
                  <span className="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                  Terhubung
                </span>
              </div>
              <button className="w-full py-3 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl text-xs font-bold transition-all backdrop-blur-sm mt-4">
                Sinkronisasi Sekarang
              </button>
            </div>
          </div>

          {/* Storage Usage */}
          <div className="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100">
            <div className="flex items-center justify-between mb-4">
              <h4 className="text-sm font-bold text-slate-800">Storage Usage</h4>
              <span className="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-lg">Optimized</span>
            </div>
            <div className="space-y-4">
              <div className="w-full h-3 bg-slate-100 rounded-full overflow-hidden flex">
                <div className="h-full bg-emerald-500" style={{ width: '65%' }}></div>
                <div className="h-full bg-blue-500" style={{ width: '15%' }}></div>
              </div>
              <div className="grid grid-cols-2 gap-2">
                <div className="flex items-center gap-2 text-[10px] text-slate-500">
                  <span className="w-2 h-2 bg-emerald-500 rounded-full"></span> Database (15GB)
                </div>
                <div className="flex items-center gap-2 text-[10px] text-slate-500">
                  <span className="w-2 h-2 bg-blue-500 rounded-full"></span> Files (3.2GB)
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default OperatorDashboardPage;
