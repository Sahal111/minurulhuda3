import React, { useState } from 'react';

const AdminPPDBSettingPage = () => {
  const [profile, setProfile] = useState({
    nama: 'Admin PPDB',
    email: 'ppdb@minurulhuda3.sch.id',
    noTelp: '081234567893',
  });

  const [gelombang, setGelombang] = useState({
    nama: 'Gelombang 1',
    mulai: '2026-06-01',
    selesai: '2026-07-31',
    kuota: 120,
    aktif: true,
  });

  const handleChange = (e) => {
    setProfile({ ...profile, [e.target.name]: e.target.value });
  };

  return (
    <div className="p-4 lg:p-8 space-y-8 max-w-3xl">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Pengaturan PPDB</h2>
        <p className="text-sm text-slate-500 mt-1">Pengaturan akun dan konfigurasi PPDB</p>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
        <h3 className="font-bold text-slate-800 mb-6">Profil Admin</h3>
        <div className="space-y-5">
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label className="block text-sm font-semibold text-slate-600 mb-1.5">Nama Lengkap</label>
              <input type="text" name="nama" value={profile.nama} onChange={handleChange} className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm" />
            </div>
            <div>
              <label className="block text-sm font-semibold text-slate-600 mb-1.5">Email</label>
              <input type="email" name="email" value={profile.email} onChange={handleChange} className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm" />
            </div>
            <div>
              <label className="block text-sm font-semibold text-slate-600 mb-1.5">No. Telepon</label>
              <input type="text" name="noTelp" value={profile.noTelp} onChange={handleChange} className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm" />
            </div>
          </div>
          <button className="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors">Simpan</button>
        </div>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
        <h3 className="font-bold text-slate-800 mb-6">Konfigurasi Gelombang</h3>
        <div className="space-y-5">
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label className="block text-sm font-semibold text-slate-600 mb-1.5">Nama Gelombang</label>
              <input type="text" value={gelombang.nama} className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm" />
            </div>
            <div>
              <label className="block text-sm font-semibold text-slate-600 mb-1.5">Kuota</label>
              <input type="number" value={gelombang.kuota} className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm" />
            </div>
            <div>
              <label className="block text-sm font-semibold text-slate-600 mb-1.5">Tanggal Mulai</label>
              <input type="date" value={gelombang.mulai} className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm" />
            </div>
            <div>
              <label className="block text-sm font-semibold text-slate-600 mb-1.5">Tanggal Selesai</label>
              <input type="date" value={gelombang.selesai} className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm" />
            </div>
          </div>
          <div className="flex items-center gap-3">
            <label className="text-sm font-semibold text-slate-600">Aktif</label>
            <input type="checkbox" checked={gelombang.aktif} className="w-5 h-5 rounded border-slate-300 text-emerald-600" readOnly />
          </div>
          <button className="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors">Simpan Konfigurasi</button>
        </div>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
        <h3 className="font-bold text-slate-800 mb-6">Ubah Password</h3>
        <div className="space-y-5 max-w-md">
          <div>
            <label className="block text-sm font-semibold text-slate-600 mb-1.5">Password Lama</label>
            <input type="password" className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm" />
          </div>
          <div>
            <label className="block text-sm font-semibold text-slate-600 mb-1.5">Password Baru</label>
            <input type="password" className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm" />
          </div>
          <div>
            <label className="block text-sm font-semibold text-slate-600 mb-1.5">Konfirmasi Password Baru</label>
            <input type="password" className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm" />
          </div>
          <button className="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors">Ubah Password</button>
        </div>
      </div>
    </div>
  );
};

export default AdminPPDBSettingPage;
