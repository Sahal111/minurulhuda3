import React from 'react';

const stats = [
  { label: 'Jumlah Siswa', value: '32', sub: 'Kelas 6A', color: 'emerald', icon: '👥' },
  { label: 'Laki-laki', value: '18', sub: 'Aktif', color: 'blue', icon: '👦' },
  { label: 'Perempuan', value: '14', sub: 'Aktif', color: 'purple', icon: '👧' },
  { label: 'Kehadiran', value: '96%', sub: 'Bulan ini', color: 'orange', icon: '✅' },
];

const colorMap = {
  emerald: { bg: 'bg-emerald-50', text: 'text-emerald-600' },
  blue: { bg: 'bg-blue-50', text: 'text-blue-600' },
  purple: { bg: 'bg-purple-50', text: 'text-purple-600' },
  orange: { bg: 'bg-orange-50', text: 'text-orange-600' },
};

const prestasi = [
  { siswa: 'Ahmad Fauzi', kegiatan: 'Juara 1 Olimpiade Matematika', tgl: '5 Jul 2026' },
  { siswa: 'Siti Nurhaliza', kegiatan: 'Juara 2 Lomba Pidato', tgl: '3 Jul 2026' },
  { siswa: 'Dewi Lestari', kegiatan: 'Juara Harapan Kaligrafi', tgl: '28 Jun 2026' },
];

const WaliKelasDashboardPage = () => {
  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Dashboard Wali Kelas</h2>
          <p className="text-sm text-slate-500 mt-1">Kelas 6A — MI Nurul Huda 3</p>
        </div>
        <div className="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl text-sm font-semibold">Semester Ganjil 2025/2026</div>
      </div>

      <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
        {stats.map((s) => {
          const c = colorMap[s.color];
          return (
            <div key={s.label} className="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all">
              <div className={`w-12 h-12 ${c.bg} rounded-2xl flex items-center justify-center mb-4 text-2xl`}>{s.icon}</div>
              <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">{s.label}</p>
              <h3 className="text-3xl font-bold text-slate-800 mt-1">{s.value}</h3>
              <p className={`text-[10px] font-bold mt-2 ${c.text}`}>{s.sub}</p>
            </div>
          );
        })}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
          <div className="p-6 border-b border-slate-50"><h3 className="font-bold text-slate-800">Prestasi Siswa</h3></div>
          <div className="p-6 space-y-4">
            {prestasi.map((p, i) => (
              <div key={i} className="flex items-start gap-3 p-3 rounded-2xl bg-slate-50">
                <div className="w-10 h-10 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center text-lg">🏆</div>
                <div>
                  <p className="text-sm font-semibold text-slate-800">{p.siswa}</p>
                  <p className="text-xs text-slate-500">{p.kegiatan} • {p.tgl}</p>
                </div>
              </div>
            ))}
          </div>
        </div>

        <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
          <h3 className="font-bold text-slate-800 mb-4">Informasi Kelas</h3>
          <div className="space-y-4 text-sm">
            {[
              { label: 'Wali Kelas', value: 'Aris Setiawan, S.Pd.' },
              { label: 'Jumlah Siswa', value: '32' },
              { label: 'Laki-laki / Perempuan', value: '18 / 14' },
              { label: 'Ruangan', value: 'R. 6A' },
              { label: 'Walimurid', value: '26 Orang' },
            ].map((info, i) => (
              <div key={i} className="flex justify-between py-2 border-b border-slate-50 last:border-0">
                <span className="text-slate-500">{info.label}</span>
                <span className="font-semibold text-slate-800">{info.value}</span>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

export default WaliKelasDashboardPage;
