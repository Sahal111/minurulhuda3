import React, { useState } from 'react';

const dataSiswa = [
  { nis: '23101', nama: 'Ahmad Fauzi', hadir: true },
  { nis: '23102', nama: 'Siti Nurhaliza', hadir: true },
  { nis: '23103', nama: 'Budi Santoso', hadir: false },
  { nis: '23104', nama: 'Dewi Lestari', hadir: true },
  { nis: '23105', nama: 'Rizky Pratama', hadir: true },
  { nis: '23106', nama: 'Fitri Handayani', hadir: false },
  { nis: '23107', nama: 'Agus Wijaya', hadir: true },
  { nis: '23108', nama: 'Rina Marlina', hadir: true },
];

const WaliKelasAbsensiPage = () => {
  const [data, setData] = useState(dataSiswa);
  const [tgl, setTgl] = useState('2026-07-10');

  const toggleHadir = (nis) => {
    setData((prev) => prev.map((s) => (s.nis === nis ? { ...s, hadir: !s.hadir } : s)));
  };

  const hadirCount = data.filter((s) => s.hadir).length;

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Absensi Kelas 6A</h2>
          <p className="text-sm text-slate-500 mt-1">Catat kehadiran siswa</p>
        </div>
        <div className="flex items-center gap-3">
          <input type="date" value={tgl} onChange={(e) => setTgl(e.target.value)}
            className="px-4 py-2 rounded-xl border border-slate-200 text-sm" />
          <button className="px-5 py-2 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700">Simpan</button>
        </div>
      </div>

      <div className="bg-emerald-50 rounded-[2rem] p-4 flex items-center justify-between">
        <p className="text-sm font-semibold text-emerald-800">Kehadiran Hari Ini</p>
        <span className="text-2xl font-bold text-emerald-700">{hadirCount}/{data.length}</span>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">No</th>
                <th className="p-4 font-semibold">NIS</th>
                <th className="p-4 font-semibold">Nama</th>
                <th className="p-4 font-semibold text-center">Hadir</th>
              </tr>
            </thead>
            <tbody>
              {data.map((s, i) => (
                <tr key={s.nis} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm text-slate-500">{i + 1}</td>
                  <td className="p-4 text-sm font-medium text-slate-700">{s.nis}</td>
                  <td className="p-4 text-sm font-semibold text-slate-800">{s.nama}</td>
                  <td className="p-4 text-center">
                    <button onClick={() => toggleHadir(s.nis)}
                      className={`px-4 py-1.5 rounded-xl text-xs font-bold transition-all ${
                        s.hadir ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700'
                      }`}>
                      {s.hadir ? 'Hadir' : 'Tidak'}
                    </button>
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

export default WaliKelasAbsensiPage;
