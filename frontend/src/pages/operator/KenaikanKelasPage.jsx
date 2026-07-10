import React, { useState } from 'react';

const dummySiswa = [
  { id: 1, nis: '232401001', nama: 'Aditya Pratama', kelas_asal: 'I-A', rata_rata: 85, kehadiran: 95 },
  { id: 2, nis: '232401002', nama: 'Bella Safira', kelas_asal: 'I-A', rata_rata: 92, kehadiran: 100 },
  { id: 3, nis: '232401003', nama: 'Citra Kirana', kelas_asal: 'I-A', rata_rata: 78, kehadiran: 85 },
  { id: 4, nis: '232401004', nama: 'Dimas Anggara', kelas_asal: 'I-A', rata_rata: 88, kehadiran: 92 },
  { id: 5, nis: '232401005', nama: 'Eka Saputra', kelas_asal: 'I-A', rata_rata: 65, kehadiran: 70 }, // tidak naik kriteria
];

const KenaikanKelasPage = () => {
  const [selectedKelasAsal, setSelectedKelasAsal] = useState('I-A');
  const [selectedKelasTujuan, setSelectedKelasTujuan] = useState('II-A');
  const [search, setSearch] = useState('');
  const [siswaStatus, setSiswaStatus] = useState(
    dummySiswa.reduce((acc, curr) => ({ ...acc, [curr.id]: curr.rata_rata >= 70 ? 'Naik' : 'Tinggal' }), {})
  );

  const filtered = dummySiswa.filter(s =>
    s.kelas_asal === selectedKelasAsal &&
    (s.nama.toLowerCase().includes(search.toLowerCase()) || s.nis.includes(search))
  );

  const handleStatusChange = (id, status) => {
    setSiswaStatus(prev => ({ ...prev, [id]: status }));
  };

  const handleProses = () => {
    if (!selectedKelasTujuan) {
      alert('Pilih kelas tujuan terlebih dahulu!');
      return;
    }
    const naikCount = Object.values(siswaStatus).filter(s => s === 'Naik').length;
    const tinggalCount = Object.values(siswaStatus).filter(s => s === 'Tinggal').length;
    
    if (confirm(`Proses kenaikan kelas dari ${selectedKelasAsal} ke ${selectedKelasTujuan}?\n\n- ${naikCount} siswa naik kelas\n- ${tinggalCount} siswa tinggal kelas`)) {
      alert('Proses kenaikan kelas berhasil disimpan!');
    }
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Proses Kenaikan Kelas</h2>
            <p className="text-xs text-slate-400 mt-0.5">Tahun Ajaran Aktif: 2023/2024 Semester Genap</p>
          </div>
          <button
            onClick={handleProses}
            className="w-full md:w-auto px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-sm transition-all shadow-sm shadow-emerald-500/30 whitespace-nowrap"
          >
            Proses Kenaikan Kelas
          </button>
        </div>

        {/* Filter Bar */}
        <div className="p-6 border-b border-slate-50 bg-slate-50/50 flex flex-col sm:flex-row gap-6">
          <div className="flex-1 space-y-1.5">
            <label className="text-xs font-bold text-slate-500">Kelas Asal</label>
            <select
              value={selectedKelasAsal}
              onChange={e => setSelectedKelasAsal(e.target.value)}
              className="w-full px-4 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none bg-white font-bold text-slate-700"
            >
              <option value="I-A">Kelas I-A</option>
              <option value="II-A">Kelas II-A</option>
            </select>
          </div>
          
          <div className="flex items-center justify-center pt-5 hidden sm:flex">
            <span className="text-2xl text-slate-300">➡️</span>
          </div>
          
          <div className="flex-1 space-y-1.5">
            <label className="text-xs font-bold text-slate-500">Kelas Tujuan (Naik Ke)</label>
            <select
              value={selectedKelasTujuan}
              onChange={e => setSelectedKelasTujuan(e.target.value)}
              className="w-full px-4 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none bg-white font-bold text-emerald-700"
            >
              <option value="II-A">Kelas II-A</option>
              <option value="II-B">Kelas II-B</option>
            </select>
          </div>
        </div>

        <div className="p-4 border-b border-slate-50">
          <input
            type="text"
            placeholder="Cari nama siswa atau NIS..."
            value={search}
            onChange={e => setSearch(e.target.value)}
            className="w-full max-w-md px-4 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none"
          />
        </div>

        {/* Table */}
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider w-16">No</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">NIS</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Siswa</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Rata-rata Nilai</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Kehadiran</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Status Keputusan</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {filtered.map((s, i) => (
                <tr key={s.id} className={`hover:bg-slate-50/50 transition-colors ${siswaStatus[s.id] === 'Tinggal' ? 'bg-rose-50/30' : ''}`}>
                  <td className="px-6 py-4 text-slate-400 text-xs">{i + 1}</td>
                  <td className="px-6 py-4 text-xs text-slate-500 font-mono">{s.nis}</td>
                  <td className="px-6 py-4 font-bold text-slate-800">{s.nama}</td>
                  <td className="px-6 py-4">
                    <span className={`font-bold ${s.rata_rata >= 70 ? 'text-emerald-600' : 'text-rose-600'}`}>{s.rata_rata}</span>
                  </td>
                  <td className="px-6 py-4">
                    <span className="text-slate-600">{s.kehadiran}%</span>
                  </td>
                  <td className="px-6 py-4">
                    <div className="flex justify-center gap-2">
                      <button
                        onClick={() => handleStatusChange(s.id, 'Naik')}
                        className={`px-4 py-1.5 rounded-lg text-xs font-bold transition-all border ${
                          siswaStatus[s.id] === 'Naik'
                            ? 'bg-emerald-100 border-emerald-200 text-emerald-700 shadow-sm'
                            : 'bg-white border-slate-200 text-slate-400 hover:border-emerald-200'
                        }`}
                      >
                        Naik Kelas
                      </button>
                      <button
                        onClick={() => handleStatusChange(s.id, 'Tinggal')}
                        className={`px-4 py-1.5 rounded-lg text-xs font-bold transition-all border ${
                          siswaStatus[s.id] === 'Tinggal'
                            ? 'bg-rose-100 border-rose-200 text-rose-700 shadow-sm'
                            : 'bg-white border-slate-200 text-slate-400 hover:border-rose-200'
                        }`}
                      >
                        Tinggal Kelas
                      </button>
                    </div>
                  </td>
                </tr>
              ))}
              {filtered.length === 0 && (
                <tr><td colSpan={6} className="px-6 py-12 text-center text-slate-400 text-sm">Tidak ada data siswa.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default KenaikanKelasPage;
