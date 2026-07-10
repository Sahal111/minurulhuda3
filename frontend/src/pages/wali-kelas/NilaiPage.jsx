import React, { useState } from 'react';

const dataNilai = [
  { nis: '23101', nama: 'Ahmad Fauzi', mtk: 85, ipa: 90, bIndo: 78, ag: 95, ips: 80 },
  { nis: '23102', nama: 'Siti Nurhaliza', mtk: 90, ipa: 88, bIndo: 85, ag: 92, ips: 82 },
  { nis: '23103', nama: 'Budi Santoso', mtk: 72, ipa: 75, bIndo: 68, ag: 80, ips: 70 },
  { nis: '23104', nama: 'Dewi Lestari', mtk: 88, ipa: 82, bIndo: 80, ag: 90, ips: 78 },
  { nis: '23105', nama: 'Rizky Pratama', mtk: 78, ipa: 80, bIndo: 75, ag: 85, ips: 72 },
  { nis: '23106', nama: 'Fitri Handayani', mtk: 95, ipa: 92, bIndo: 88, ag: 96, ips: 90 },
  { nis: '23107', nama: 'Agus Wijaya', mtk: 70, ipa: 72, bIndo: 65, ag: 78, ips: 68 },
  { nis: '23108', nama: 'Rina Marlina', mtk: 82, ipa: 78, bIndo: 80, ag: 85, ips: 76 },
];

const WaliKelasNilaiPage = () => {
  const [semester, setSemester] = useState('Ganjil');

  const hitungRata = (s) => Math.round((s.mtk + s.ipa + s.bIndo + s.ag + s.ips) / 5);

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-slate-800">Nilai Siswa</h2>
          <p className="text-sm text-slate-500 mt-1">Kelas 6A</p>
        </div>
        <div className="flex items-center gap-3">
          <select value={semester} onChange={(e) => setSemester(e.target.value)}
            className="px-4 py-2 rounded-xl border border-slate-200 text-sm bg-white">
            <option>Ganjil</option>
            <option>Genap</option>
          </select>
          <button className="px-5 py-2 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700">Cetak</button>
        </div>
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50">
          <h3 className="font-bold text-slate-800">Daftar Nilai — Semester {semester} 2025/2026</h3>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="text-left text-xs text-slate-500 border-b border-slate-50">
                <th className="p-4 font-semibold">No</th>
                <th className="p-4 font-semibold">NIS</th>
                <th className="p-4 font-semibold">Nama</th>
                <th className="p-4 font-semibold text-center">MTK</th>
                <th className="p-4 font-semibold text-center">IPA</th>
                <th className="p-4 font-semibold text-center">B.Indo</th>
                <th className="p-4 font-semibold text-center">Ag</th>
                <th className="p-4 font-semibold text-center">IPS</th>
                <th className="p-4 font-semibold text-center">Rata</th>
              </tr>
            </thead>
            <tbody>
              {dataNilai.map((s, i) => {
                const rata = hitungRata(s);
                return (
                  <tr key={s.nis} className="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                    <td className="p-4 text-sm text-slate-500">{i + 1}</td>
                    <td className="p-4 text-sm font-medium text-slate-700">{s.nis}</td>
                    <td className="p-4 text-sm font-semibold text-slate-800">{s.nama}</td>
                    <td className="p-4 text-sm text-center">{s.mtk}</td>
                    <td className="p-4 text-sm text-center">{s.ipa}</td>
                    <td className="p-4 text-sm text-center">{s.bIndo}</td>
                    <td className="p-4 text-sm text-center">{s.ag}</td>
                    <td className="p-4 text-sm text-center">{s.ips}</td>
                    <td className="p-4 text-center font-bold text-slate-800">{rata}</td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default WaliKelasNilaiPage;
