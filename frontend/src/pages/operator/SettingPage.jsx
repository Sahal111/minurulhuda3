import React, { useState } from 'react';

const SettingPage = () => {
  const [activeTab, setActiveTab] = useState('profil');
  const [isSaving, setIsSaving] = useState(false);

  // Form states
  const [profilForm, setProfilForm] = useState({
    nama_sekolah: 'MI Nurul Huda 3',
    npsn: '20212345',
    alamat: 'Jl. Merdeka No. 123, Kota Contoh',
    telepon: '021-12345678',
    email: 'info@minurulhuda3.sch.id',
    website: 'www.minurulhuda3.sch.id',
    kepala_sekolah: 'H. Ahmad Sobari, M.Pd.I'
  });

  const [sistemForm, setSistemForm] = useState({
    maintenance_mode: false,
    ppdb_active: true,
    pengumuman_kelulusan: false,
    session_timeout: '60'
  });

  const handleSave = (e) => {
    e.preventDefault();
    setIsSaving(true);
    setTimeout(() => {
      setIsSaving(false);
      alert('Pengaturan berhasil disimpan!');
    }, 1000);
  };

  return (
    <div className="p-4 lg:p-8 space-y-6 max-w-5xl">
      <div className="flex items-center gap-4">
        <div className="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-slate-100 text-2xl">
          ⚙️
        </div>
        <div>
          <h2 className="text-xl font-bold text-slate-800">Pengaturan Sistem</h2>
          <p className="text-sm text-slate-500">Konfigurasi profil sekolah dan preferensi aplikasi</p>
        </div>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col md:flex-row">
        {/* Sidebar Tabs */}
        <div className="w-full md:w-64 bg-slate-50 border-b md:border-b-0 md:border-r border-slate-100 p-4 space-y-2">
          {[
            { id: 'profil', label: 'Profil Sekolah', icon: '🏫' },
            { id: 'sistem', label: 'Preferensi Sistem', icon: '🖥️' },
            { id: 'logo', label: 'Logo & Tema', icon: '🎨' },
          ].map(tab => (
            <button
              key={tab.id}
              onClick={() => setActiveTab(tab.id)}
              className={`w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all text-left ${
                activeTab === tab.id
                  ? 'bg-white text-emerald-700 shadow-sm border border-emerald-100'
                  : 'text-slate-600 hover:bg-slate-100'
              }`}
            >
              <span className="text-lg">{tab.icon}</span>
              {tab.label}
            </button>
          ))}
        </div>

        {/* Content Area */}
        <div className="flex-1 p-6 md:p-8">
          <form onSubmit={handleSave} className="space-y-6">
            
            {/* Tab: Profil Sekolah */}
            {activeTab === 'profil' && (
              <div className="space-y-6 animate-fade-in">
                <h3 className="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Profil Instansi / Sekolah</h3>
                
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div className="md:col-span-2">
                    <label className="block text-xs font-bold text-slate-600 mb-1.5">Nama Sekolah</label>
                    <input type="text" value={profilForm.nama_sekolah} onChange={e => setProfilForm({...profilForm, nama_sekolah: e.target.value})} className="w-full px-4 py-3 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none" />
                  </div>
                  
                  <div>
                    <label className="block text-xs font-bold text-slate-600 mb-1.5">NPSN</label>
                    <input type="text" value={profilForm.npsn} onChange={e => setProfilForm({...profilForm, npsn: e.target.value})} className="w-full px-4 py-3 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none font-mono" />
                  </div>
                  
                  <div>
                    <label className="block text-xs font-bold text-slate-600 mb-1.5">Nama Kepala Sekolah</label>
                    <input type="text" value={profilForm.kepala_sekolah} onChange={e => setProfilForm({...profilForm, kepala_sekolah: e.target.value})} className="w-full px-4 py-3 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none" />
                  </div>

                  <div className="md:col-span-2">
                    <label className="block text-xs font-bold text-slate-600 mb-1.5">Alamat Lengkap</label>
                    <textarea value={profilForm.alamat} onChange={e => setProfilForm({...profilForm, alamat: e.target.value})} rows="3" className="w-full px-4 py-3 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none resize-none"></textarea>
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-slate-600 mb-1.5">Telepon</label>
                    <input type="text" value={profilForm.telepon} onChange={e => setProfilForm({...profilForm, telepon: e.target.value})} className="w-full px-4 py-3 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none font-mono" />
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-slate-600 mb-1.5">Email Resmi</label>
                    <input type="email" value={profilForm.email} onChange={e => setProfilForm({...profilForm, email: e.target.value})} className="w-full px-4 py-3 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none" />
                  </div>
                </div>
              </div>
            )}

            {/* Tab: Preferensi Sistem */}
            {activeTab === 'sistem' && (
              <div className="space-y-6 animate-fade-in">
                <h3 className="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Preferensi Sistem & Keamanan</h3>
                
                <div className="space-y-6">
                  {/* Maintenance Mode */}
                  <div className="flex items-center justify-between p-4 rounded-2xl border border-rose-200 bg-rose-50/50">
                    <div>
                      <h4 className="font-bold text-rose-900">Mode Perbaikan (Maintenance Mode)</h4>
                      <p className="text-xs text-rose-700/70 mt-1">Hanya Operator yang dapat login jika mode ini diaktifkan.</p>
                    </div>
                    <label className="relative inline-flex items-center cursor-pointer">
                      <input type="checkbox" className="sr-only peer" checked={sistemForm.maintenance_mode} onChange={e => setSistemForm({...sistemForm, maintenance_mode: e.target.checked})} />
                      <div className="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-rose-600"></div>
                    </label>
                  </div>

                  {/* PPDB Status */}
                  <div className="flex items-center justify-between p-4 rounded-2xl border border-slate-200">
                    <div>
                      <h4 className="font-bold text-slate-800">Buka Pendaftaran PPDB</h4>
                      <p className="text-xs text-slate-500 mt-1">Mengizinkan pendaftar baru untuk membuat akun dan mengisi formulir.</p>
                    </div>
                    <label className="relative inline-flex items-center cursor-pointer">
                      <input type="checkbox" className="sr-only peer" checked={sistemForm.ppdb_active} onChange={e => setSistemForm({...sistemForm, ppdb_active: e.target.checked})} />
                      <div className="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                    </label>
                  </div>

                  {/* Session Timeout */}
                  <div>
                    <label className="block text-xs font-bold text-slate-600 mb-1.5">Waktu Habis Sesi Login (Menit)</label>
                    <select value={sistemForm.session_timeout} onChange={e => setSistemForm({...sistemForm, session_timeout: e.target.value})} className="w-full sm:w-64 px-4 py-3 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none bg-white">
                      <option value="15">15 Menit</option>
                      <option value="30">30 Menit</option>
                      <option value="60">1 Jam</option>
                      <option value="120">2 Jam</option>
                    </select>
                    <p className="text-[10px] text-slate-400 mt-2">Waktu sebelum sistem otomatis me-logout pengguna yang tidak aktif.</p>
                  </div>
                </div>
              </div>
            )}

            {/* Tab: Logo */}
            {activeTab === 'logo' && (
              <div className="space-y-6 animate-fade-in">
                <h3 className="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Logo & Tampilan Visual</h3>
                
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                  {/* Logo Sekolah */}
                  <div className="space-y-4">
                    <label className="block text-sm font-bold text-slate-700">Logo Sekolah</label>
                    <div className="flex items-center gap-6">
                      <div className="w-24 h-24 bg-slate-100 rounded-2xl flex items-center justify-center border-2 border-dashed border-slate-300">
                        <span className="text-3xl">🏫</span>
                      </div>
                      <div className="flex-1 space-y-2">
                        <input type="file" accept="image/*" className="text-xs file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer w-full" />
                        <p className="text-[10px] text-slate-500">Format: PNG transparan. Ukuran ideal: 256x256 px. Maks 1 MB.</p>
                      </div>
                    </div>
                  </div>

                  {/* Kop Surat */}
                  <div className="space-y-4">
                    <label className="block text-sm font-bold text-slate-700">Logo Surat / Cetak (Kop)</label>
                    <div className="flex items-center gap-6">
                      <div className="w-24 h-24 bg-slate-100 rounded-2xl flex items-center justify-center border-2 border-dashed border-slate-300">
                        <span className="text-3xl">📄</span>
                      </div>
                      <div className="flex-1 space-y-2">
                        <input type="file" accept="image/*" className="text-xs file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer w-full" />
                        <p className="text-[10px] text-slate-500">Digunakan untuk dokumen PDF/Cetak (Rapor, Surat Keterangan).</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            )}

            {/* Action Footer */}
            <div className="pt-6 border-t border-slate-100 flex justify-end gap-3 mt-8">
              <button type="button" className="px-6 py-3 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">
                Reset
              </button>
              <button type="submit" disabled={isSaving} className="px-8 py-3 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-all shadow-sm shadow-emerald-500/30 flex items-center gap-2">
                {isSaving ? (
                  <><span className="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span> Menyimpan...</>
                ) : (
                  'Simpan Pengaturan'
                )}
              </button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  );
};

export default SettingPage;
