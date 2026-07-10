import React, { useState } from 'react';

const dummyBackups = [
  { id: 1, filename: 'backup-db-2024-06-25-10-30.sql', size: '14.5 MB', type: 'Database', date: '25 Jun 2024, 10:30 WIB', status: 'Selesai' },
  { id: 2, filename: 'backup-files-2024-06-01-08-00.zip', size: '256.2 MB', type: 'File Uploads', date: '01 Jun 2024, 08:00 WIB', status: 'Selesai' },
  { id: 3, filename: 'backup-full-2024-05-15-23-00.zip', size: '271.8 MB', type: 'Full System', date: '15 Mei 2024, 23:00 WIB', status: 'Selesai' },
  { id: 4, filename: 'backup-db-2024-04-30-10-15.sql', size: '13.2 MB', type: 'Database', date: '30 Apr 2024, 10:15 WIB', status: 'Gagal' },
];

const BackupPage = () => {
  const [isBackingUp, setIsBackingUp] = useState(false);
  const [progress, setProgress] = useState(0);

  const handleBackup = (type) => {
    setIsBackingUp(true);
    setProgress(0);
    
    const interval = setInterval(() => {
      setProgress(prev => {
        if (prev >= 100) {
          clearInterval(interval);
          setIsBackingUp(false);
          alert(`Backup ${type} berhasil diselesaikan!`);
          return 100;
        }
        return prev + Math.floor(Math.random() * 20) + 5;
      });
    }, 500);
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        {/* Backup Database */}
        <div className="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col items-center text-center hover:shadow-md transition-shadow">
          <div className="w-16 h-16 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center text-3xl mb-4">🗄️</div>
          <h3 className="text-lg font-bold text-slate-800 mb-2">Backup Database</h3>
          <p className="text-xs text-slate-500 mb-6">Mencadangkan seluruh data tabel (siswa, guru, nilai, dll) dalam format SQL.</p>
          <button 
            onClick={() => handleBackup('Database')}
            disabled={isBackingUp}
            className="mt-auto w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-sm transition-all shadow-sm shadow-blue-500/30 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            Mulai Backup
          </button>
        </div>
        
        {/* Backup File */}
        <div className="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col items-center text-center hover:shadow-md transition-shadow">
          <div className="w-16 h-16 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center text-3xl mb-4">📁</div>
          <h3 className="text-lg font-bold text-slate-800 mb-2">Backup File Upload</h3>
          <p className="text-xs text-slate-500 mb-6">Mencadangkan file yang diupload pengguna seperti foto profil dan dokumen bukti.</p>
          <button 
            onClick={() => handleBackup('File Upload')}
            disabled={isBackingUp}
            className="mt-auto w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-sm transition-all shadow-sm shadow-emerald-500/30 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            Mulai Backup
          </button>
        </div>

        {/* Backup Full */}
        <div className="bg-white p-6 rounded-[2rem] shadow-sm border border-amber-200 bg-amber-50/30 flex flex-col items-center text-center hover:shadow-md transition-shadow">
          <div className="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center text-3xl mb-4">📦</div>
          <h3 className="text-lg font-bold text-amber-900 mb-2">Full Backup (System)</h3>
          <p className="text-xs text-amber-700/70 mb-6">Mencadangkan seluruh sistem termasuk source code, database, dan file. Memakan waktu lebih lama.</p>
          <button 
            onClick={() => handleBackup('Full System')}
            disabled={isBackingUp}
            className="mt-auto w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl text-sm transition-all shadow-sm shadow-amber-500/30 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            Backup Keseluruhan
          </button>
        </div>
      </div>

      {/* Progress Bar */}
      {isBackingUp && (
        <div className="bg-white p-6 rounded-[2rem] shadow-sm border border-blue-100">
          <div className="flex justify-between items-center mb-2">
            <span className="text-sm font-bold text-blue-800 flex items-center gap-2">
              <span className="w-4 h-4 border-2 border-blue-600 border-t-transparent rounded-full animate-spin"></span>
              Proses pencadangan sedang berlangsung...
            </span>
            <span className="text-sm font-bold text-blue-600">{progress}%</span>
          </div>
          <div className="w-full h-3 bg-blue-50 rounded-full overflow-hidden">
            <div className="h-full bg-blue-500 transition-all duration-300" style={{ width: `${progress}%` }}></div>
          </div>
          <p className="text-[10px] text-slate-400 mt-2">Mohon jangan menutup halaman ini atau mematikan koneksi internet.</p>
        </div>
      )}

      {/* Riwayat Backup Table */}
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50 flex justify-between items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Riwayat Backup</h2>
            <p className="text-xs text-slate-400 mt-0.5">Daftar file backup yang tersedia di server</p>
          </div>
          <button className="text-sm font-bold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-xl transition-colors">
            Refresh
          </button>
        </div>

        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Nama File</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Tipe</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Ukuran</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal & Waktu</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-right w-40">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {dummyBackups.map(b => (
                <tr key={b.id} className="hover:bg-slate-50/50 transition-colors">
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-3">
                      <div className="text-xl">{b.filename.endsWith('.sql') ? '🗄️' : '📦'}</div>
                      <span className="font-mono text-xs font-bold text-slate-700">{b.filename}</span>
                    </div>
                  </td>
                  <td className="px-6 py-4 text-xs font-bold text-slate-600">{b.type}</td>
                  <td className="px-6 py-4 text-xs text-slate-500">{b.size}</td>
                  <td className="px-6 py-4 text-xs text-slate-500">{b.date}</td>
                  <td className="px-6 py-4">
                    <span className={`inline-flex items-center px-2 py-1 rounded text-[10px] font-bold ${
                      b.status === 'Selesai' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700'
                    }`}>
                      {b.status}
                    </span>
                  </td>
                  <td className="px-6 py-4">
                    <div className="flex justify-end gap-2">
                      {b.status === 'Selesai' && (
                        <button className="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-lg transition-all" title="Download">⬇️</button>
                      )}
                      <button className="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold rounded-lg transition-all" title="Hapus Permanen">🗑️</button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default BackupPage;
