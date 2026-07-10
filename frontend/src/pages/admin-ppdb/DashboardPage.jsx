import React from 'react';

const stats = [
  { label: 'Total Pendaftar', value: '156', sub: 'Gelombang 1', color: 'emerald', icon: '📋' },
  { label: 'Sudah Verifikasi', value: '98', sub: 'Berkas lengkap', color: 'blue', icon: '✅' },
  { label: 'Menunggu', value: '42', sub: 'Verifikasi berkas', color: 'orange', icon: '⏳' },
  { label: 'Diterima', value: '85', sub: 'Siswa baru', color: 'purple', icon: '🎉' },
];

const colorMap = {
  emerald: { bg: 'bg-emerald-50', text: 'text-emerald-600' },
  blue: { bg: 'bg-blue-50', text: 'text-blue-600' },
  orange: { bg: 'bg-orange-50', text: 'text-orange-600' },
  purple: { bg: 'bg-purple-50', text: 'text-purple-600' },
};

const pendaftarBaru = [
  { nama: 'Andi Pratama', asal: 'SDN 1 Malang', tgl: '10 Jul 2026', status: 'Menunggu' },
  { nama: 'Nurul Aisyah', asal: 'SD Islam Al-Azhar', tgl: '9 Jul 2026', status: 'Diverifikasi' },
  { nama: 'Rafi Ahmad', asal: 'SDN 2 Sukun', tgl: '8 Jul 2026', status: 'Diterima' },
  { nama: 'Salsabila Putri', asal: 'SDIT Bina Insan', tgl: '8 Jul 2026', status: 'Menunggu' },
  { nama: 'Dimas Aditya', asal: 'SDN 4 Klojen', tgl: '7 Jul 2026', status: 'Diverifikasi' },
];

const AdminPPDBDashboardPage = () => {
  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Dashboard PPDB</h2>
          <p className="text-sm text-slate-500 mt-1">Penerimaan Peserta Didik Baru</p>
        </div>
        <div className="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl text-sm font-semibold">Gelombang 1 • TA 2026/2027</div>
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
          <div className="p-6 border-b border-slate-50"><h3 className="font-bold text-slate-800">Pendaftar Terbaru</h3></div>
          <div className="p-6 space-y-4">
            {pendaftarBaru.map((p, i) => (
              <div key={i} className="flex items-center justify-between p-3 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-colors">
                <div>
                  <p className="text-sm font-semibold text-slate-800">{p.nama}</p>
                  <p className="text-xs text-slate-500">{p.asal} • {p.tgl}</p>
                </div>
                <span className={`px-3 py-1 rounded-lg text-xs font-bold ${
                  p.status === 'Diterima' ? 'bg-emerald-50 text-emerald-700' :
                  p.status === 'Diverifikasi' ? 'bg-blue-50 text-blue-700' :
                  'bg-amber-50 text-amber-700'
                }`}>{p.status}</span>
              </div>
            ))}
          </div>
        </div>

        <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
          <h3 className="font-bold text-slate-800 mb-4">Statistik PPDB</h3>
          <div className="space-y-6">
            <div>
              <div className="flex justify-between text-sm mb-1.5">
                <span className="text-slate-600">Target Penerimaan</span>
                <span className="font-semibold text-slate-800">120 siswa</span>
              </div>
              <div className="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                <div className="h-full bg-emerald-500 rounded-full" style={{ width: '71%' }}></div>
              </div>
              <p className="text-xs text-slate-500 mt-1">85 dari 120 siswa (71%)</p>
            </div>
            <div className="grid grid-cols-2 gap-4">
              <div className="p-4 bg-blue-50 rounded-2xl text-center">
                <p className="text-2xl font-bold text-blue-700">42</p>
                <p className="text-xs text-blue-600">Menunggu</p>
              </div>
              <div className="p-4 bg-emerald-50 rounded-2xl text-center">
                <p className="text-2xl font-bold text-emerald-700">16</p>
                <p className="text-xs text-emerald-600">Hari tersisa</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AdminPPDBDashboardPage;
