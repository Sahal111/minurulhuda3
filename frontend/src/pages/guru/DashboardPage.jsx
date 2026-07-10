import React from 'react';

const stats = [
  { label: 'Jadwal Hari Ini', value: '4', sub: 'Mapel aktif', color: 'emerald', icon: '📚' },
  { label: 'Total Siswa', value: '128', sub: 'Diampu', color: 'blue', icon: '👥' },
  { label: 'Belum Dinilai', value: '12', sub: 'Tugas terbaru', color: 'orange', icon: '📝' },
  { label: 'Absensi', value: '96%', sub: 'Rata-rata kehadiran', color: 'purple', icon: '✅' },
];

const colorMap = {
  emerald: { bg: 'bg-emerald-50', text: 'text-emerald-600', sub: 'text-emerald-600' },
  blue: { bg: 'bg-blue-50', text: 'text-blue-600', sub: 'text-blue-600' },
  orange: { bg: 'bg-orange-50', text: 'text-orange-600', sub: 'text-orange-600' },
  purple: { bg: 'bg-purple-50', text: 'text-purple-600', sub: 'text-purple-600' },
};

const jadwalHariIni = [
  { mapel: 'Matematika', kelas: '6A', jam: '07:30 - 08:30', ruang: 'R. 6A' },
  { mapel: 'Matematika', kelas: '6B', jam: '08:30 - 09:30', ruang: 'R. 6B' },
  { mapel: 'IPA', kelas: '5A', jam: '10:00 - 11:00', ruang: 'R. 5A' },
  { mapel: 'IPA', kelas: '5B', jam: '11:00 - 12:00', ruang: 'R. 5B' },
];

const GuruDashboardPage = () => {
  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Dashboard Guru</h2>
          <p className="text-sm text-slate-500 mt-1">Selamat datang di portal guru</p>
        </div>
        <div className="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl text-sm font-semibold">
          Semester Ganjil 2025/2026
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
              <p className={`text-[10px] font-bold mt-2 ${c.sub}`}>{s.sub}</p>
            </div>
          );
        })}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
          <div className="p-6 border-b border-slate-50">
            <h3 className="font-bold text-slate-800">Jadwal Mengajar Hari Ini</h3>
          </div>
          <div className="p-6 space-y-4">
            {jadwalHariIni.map((j, i) => (
              <div key={i} className="flex items-center gap-4 p-3 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-colors">
                <div className="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center font-bold text-sm">
                  {j.jam.split(' ')[0]}
                </div>
                <div className="flex-1">
                  <p className="font-semibold text-slate-800 text-sm">{j.mapel}</p>
                  <p className="text-xs text-slate-500">Kelas {j.kelas} • {j.ruang}</p>
                </div>
                <span className="text-xs text-slate-400">{j.jam}</span>
              </div>
            ))}
          </div>
        </div>

        <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
          <h3 className="font-bold text-slate-800 mb-4">Pengumuman</h3>
          <div className="space-y-4">
            <div className="p-4 bg-blue-50 rounded-2xl border-l-4 border-l-blue-500">
              <p className="text-sm font-semibold text-blue-800">Rapat Guru</p>
              <p className="text-xs text-blue-600 mt-1">Jumat, 14 Juli 2026 • Pukul 14:00</p>
            </div>
            <div className="p-4 bg-amber-50 rounded-2xl border-l-4 border-l-amber-500">
              <p className="text-sm font-semibold text-amber-800">Pengumpulan Nilai</p>
              <p className="text-xs text-amber-600 mt-1">Batas akhir input nilai: 20 Juli 2026</p>
            </div>
            <div className="p-4 bg-emerald-50 rounded-2xl border-l-4 border-l-emerald-500">
              <p className="text-sm font-semibold text-emerald-800">Libur Semester</p>
              <p className="text-xs text-emerald-600 mt-1">Libur semester dimulai 25 Juli 2026</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default GuruDashboardPage;
