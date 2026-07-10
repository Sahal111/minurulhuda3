import React, { useState } from 'react';

const dummyLogs = [
  { id: 1, user: 'Operator Sekolah', action: 'CREATE', module: 'Data Siswa', desc: 'Menambahkan data siswa baru: Abdullah Azzam', time: '10:30 WIB, 25 Jun 2024', ip: '192.168.1.10' },
  { id: 2, user: 'Ahmad Fauzi, S.Pd', action: 'UPDATE', module: 'Nilai Rapor', desc: 'Mengubah nilai Matematika siswa kelas IV-A', time: '09:15 WIB, 25 Jun 2024', ip: '10.0.0.5' },
  { id: 3, user: 'Admin PPDB', action: 'LOGIN', module: 'Auth', desc: 'Berhasil login ke sistem', time: '08:00 WIB, 25 Jun 2024', ip: '114.125.10.22' },
  { id: 4, user: 'Operator Sekolah', action: 'DELETE', module: 'Tahun Ajaran', desc: 'Menghapus data tahun ajaran 2021/2022', time: '14:20 WIB, 24 Jun 2024', ip: '192.168.1.10' },
  { id: 5, user: 'Siti Aisyah, S.Pd.I', action: 'UPDATE', module: 'Kehadiran', desc: 'Mengisi absensi kelas I-A', time: '07:30 WIB, 24 Jun 2024', ip: '10.0.0.8' },
  { id: 6, user: 'System', action: 'BACKUP', module: 'Sistem', desc: 'Otomatis membuat backup database harian', time: '00:00 WIB, 24 Jun 2024', ip: 'localhost' },
];

const AuditLogPage = () => {
  const [search, setSearch] = useState('');
  const [filterAction, setFilterAction] = useState('Semua');

  const filtered = dummyLogs.filter(log => {
    const matchSearch = log.user.toLowerCase().includes(search.toLowerCase()) || log.module.toLowerCase().includes(search.toLowerCase()) || log.desc.toLowerCase().includes(search.toLowerCase());
    const matchAction = filterAction === 'Semua' || log.action === filterAction;
    return matchSearch && matchAction;
  });

  const getActionColor = (action) => {
    switch (action) {
      case 'CREATE': return 'bg-emerald-100 text-emerald-700 border-emerald-200';
      case 'UPDATE': return 'bg-blue-100 text-blue-700 border-blue-200';
      case 'DELETE': return 'bg-rose-100 text-rose-700 border-rose-200';
      case 'LOGIN': return 'bg-purple-100 text-purple-700 border-purple-200';
      case 'BACKUP': return 'bg-amber-100 text-amber-700 border-amber-200';
      default: return 'bg-slate-100 text-slate-700 border-slate-200';
    }
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Log Aktivitas Sistem</h2>
            <p className="text-xs text-slate-400 mt-0.5">Rekam jejak seluruh aktivitas pengguna di dalam sistem</p>
          </div>
          
          <div className="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <select
              value={filterAction}
              onChange={e => setFilterAction(e.target.value)}
              className="px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none bg-white font-bold text-slate-600"
            >
              <option value="Semua">Semua Aktivitas</option>
              <option value="CREATE">Tambah Data (CREATE)</option>
              <option value="UPDATE">Ubah Data (UPDATE)</option>
              <option value="DELETE">Hapus Data (DELETE)</option>
              <option value="LOGIN">Akses Sistem (LOGIN)</option>
            </select>
            <input
              type="text"
              placeholder="Cari user, modul, atau deskripsi..."
              value={search}
              onChange={e => setSearch(e.target.value)}
              className="flex-1 sm:w-64 px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none"
            />
            <button className="px-4 py-2.5 rounded-xl text-sm font-bold bg-slate-100 hover:bg-slate-200 text-slate-600 transition-all">
              Export Log
            </button>
          </div>
        </div>

        {/* Timeline View / Table */}
        <div className="p-6 overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Waktu</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Pengguna</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Modul</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Aktivitas</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Keterangan</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">IP Address</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {filtered.map(log => (
                <tr key={log.id} className="hover:bg-slate-50/50 transition-colors">
                  <td className="px-6 py-4 text-xs font-mono text-slate-500 whitespace-nowrap">{log.time}</td>
                  <td className="px-6 py-4 font-bold text-slate-700">{log.user}</td>
                  <td className="px-6 py-4">
                    <span className="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                      {log.module}
                    </span>
                  </td>
                  <td className="px-6 py-4">
                    <span className={`inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold border ${getActionColor(log.action)}`}>
                      {log.action}
                    </span>
                  </td>
                  <td className="px-6 py-4 text-slate-600">{log.desc}</td>
                  <td className="px-6 py-4 text-xs font-mono text-slate-400">{log.ip}</td>
                </tr>
              ))}
              {filtered.length === 0 && (
                <tr><td colSpan={6} className="px-6 py-12 text-center text-slate-400 text-sm">Tidak ada log aktivitas.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default AuditLogPage;
