import React, { useState } from 'react';

const siswa = [
  { nis: '23101', nama: 'Ahmad Fauzi', kelas: '6A', hadir: true },
  { nis: '23102', nama: 'Siti Nurhaliza', kelas: '6A', hadir: true },
  { nis: '23103', nama: 'Budi Santoso', kelas: '6A', hadir: false },
  { nis: '23104', nama: 'Dewi Lestari', kelas: '6A', hadir: true },
  { nis: '23105', nama: 'Rizky Pratama', kelas: '6A', hadir: false },
  { nis: '23106', nama: 'Fitri Handayani', kelas: '6A', hadir: true },
  { nis: '23107', nama: 'Agus Wijaya', kelas: '6A', hadir: true },
  { nis: '23108', nama: 'Rina Marlina', kelas: '6A', hadir: false },
];

const GuruAbsensiPage = () => {
  const [dataSiswa, setDataSiswa] = useState(siswa);
  const [kelasFilter, setKelasFilter] = useState('6A');
  const [mapelFilter, setMapelFilter] = useState('Matematika');

  const toggleHadir = (nis) => {
    setDataSiswa((prev) =>
      prev.map((s) => (s.nis === nis ? { ...s, hadir: !s.hadir } : s))
    );
  };

  const filtered = dataSiswa.filter((s) => s.kelas === kelasFilter);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Absensi Siswa</h2>
        <p className="text-sm text-slate-500 mt-1">Catat kehadiran siswa</p>
      </div>

      <div className="flex flex-wrap gap-4">
        <div className="flex items-center gap-2">
          <label className="text-sm font-semibold text-slate-600">Kelas:</label>
          <select
            value={kelasFilter}
            onChange={(e) => setKelasFilter(e.target.value)}
            className="px-4 py-2 rounded-xl border border-slate-200 text-sm bg-white"
          >
            <option>6A</option>
            <option>6B</option>
            <option>5A</option>
            <option>5B</option>
          </select>
        </div>
        <div className="flex items-center gap-2">
          <label className="text-sm font-semibold text-slate-600">Mapel:</label>
          <select
            value={mapelFilter}
            onChange={(e) => setMapelFilter(e.target.value)}
            className="px-4 py-2 rounded-xl border border-slate-200 text-sm bg-white"
          >
            <option>Matematika</option>
            <option>IPA</option>
            <option>Bahasa Indonesia</option>
          </select>
        </div>
        <button className="px-6 py-2 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors ml-auto">
          Simpan Absensi
        </button>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50">
          <h3 className="font-bold text-slate-800">Kelas {kelasFilter} — {mapelFilter}</h3>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">No</th>
                <th className="p-4 font-semibold">NIS</th>
                <th className="p-4 font-semibold">Nama Siswa</th>
                <th className="p-4 font-semibold">Kelas</th>
                <th className="p-4 font-semibold text-center">Hadir</th>
              </tr>
            </thead>
            <tbody>
              {filtered.map((s, i) => (
                <tr key={s.nis} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                  <td className="p-4 text-sm text-slate-500">{i + 1}</td>
                  <td className="p-4 text-sm font-medium text-slate-700">{s.nis}</td>
                  <td className="p-4 text-sm font-semibold text-slate-800">{s.nama}</td>
                  <td className="p-4 text-sm text-slate-500">{s.kelas}</td>
                  <td className="p-4 text-center">
                    <button
                      onClick={() => toggleHadir(s.nis)}
                      className={`px-4 py-1.5 rounded-xl text-xs font-bold transition-all ${
                        s.hadir
                          ? 'bg-emerald-100 text-emerald-700'
                          : 'bg-red-100 text-red-700'
                      }`}
                    >
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

export default GuruAbsensiPage;
