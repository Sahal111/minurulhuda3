import React from 'react';

const dataAnak = [
  {
    nama: 'Ahmad Fauzi',
    nis: '23101',
    kelas: '6A',
    jk: 'L',
    tempatLahir: 'Malang',
    tglLahir: '15 Jan 2014',
    alamat: 'Jl. Merdeka No. 45, Malang',
    wali: 'Sahalan Anwar Hadi',
  },
];

const OrtuAnakPage = () => {
  const anak = dataAnak[0];

  return (
    <div className="p-4 lg:p-8 space-y-8 max-w-4xl">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Data Anak</h2>
        <p className="text-sm text-slate-500 mt-1">Informasi lengkap putra/putri Anda</p>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50">
          <div className="flex items-center gap-4">
            <div className="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl font-bold">
              {anak.nama.charAt(0)}
            </div>
            <div>
              <h3 className="text-xl font-bold text-slate-800">{anak.nama}</h3>
              <p className="text-sm text-slate-500">NIS: {anak.nis} • Kelas: {anak.kelas}</p>
            </div>
          </div>
        </div>
        <div className="p-6">
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label className="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">NIS</label>
              <p className="text-sm font-medium text-slate-800">{anak.nis}</p>
            </div>
            <div>
              <label className="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Kelas</label>
              <p className="text-sm font-medium text-slate-800">{anak.kelas}</p>
            </div>
            <div>
              <label className="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Jenis Kelamin</label>
              <p className="text-sm font-medium text-slate-800">{anak.jk === 'L' ? 'Laki-laki' : 'Perempuan'}</p>
            </div>
            <div>
              <label className="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Tempat, Tgl Lahir</label>
              <p className="text-sm font-medium text-slate-800">{anak.tempatLahir}, {anak.tglLahir}</p>
            </div>
            <div className="sm:col-span-2">
              <label className="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Alamat</label>
              <p className="text-sm font-medium text-slate-800">{anak.alamat}</p>
            </div>
            <div>
              <label className="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Wali</label>
              <p className="text-sm font-medium text-slate-800">{anak.wali}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default OrtuAnakPage;
