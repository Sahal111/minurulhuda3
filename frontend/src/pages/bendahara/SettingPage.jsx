import React, { useState } from 'react';

const BendaharaSettingPage = () => {
  const [profile, setProfile] = useState({
    nama: 'Bendahara Sekolah',
    nip: '1987654321',
    email: 'bendahara@minurulhuda3.sch.id',
    noTelp: '081234567890',
  });

  const handleChange = (e) => {
    setProfile({ ...profile, [e.target.name]: e.target.value });
  };

  return (
    <div className="p-4 lg:p-8 space-y-8 max-w-3xl">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Pengaturan</h2>
        <p className="text-sm text-slate-500 mt-1">Pengaturan akun bendahara</p>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
        <h3 className="font-bold text-slate-800 mb-6">Profil</h3>
        <div className="space-y-5">
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label className="block text-sm font-semibold text-slate-600 mb-1.5">Nama Lengkap</label>
              <input type="text" name="nama" value={profile.nama} onChange={handleChange} className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm" />
            </div>
            <div>
              <label className="block text-sm font-semibold text-slate-600 mb-1.5">NIP</label>
              <input type="text" name="nip" value={profile.nip} className="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-slate-50" readOnly />
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
          <button className="px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors">Simpan Perubahan</button>
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

export default BendaharaSettingPage;
