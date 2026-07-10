import React, { useState } from 'react';

const dummySiswa = [
  { id: 1, nis: '242501001', nama: 'Abdullah Azzam', jk: 'L', asal_sekolah: 'TK Tunas Bangsa', status: 'Diterima' },
  { id: 2, nis: '242501002', nama: 'Aisyah Putri', jk: 'P', asal_sekolah: 'TK Islam Mutiara', status: 'Diterima' },
  { id: 3, nis: '242501003', nama: 'Bintang Pratama', jk: 'L', asal_sekolah: 'PAUD Ceria', status: 'Diterima' },
  { id: 4, nis: '242501004', nama: 'Cinta Lestari', jk: 'P', asal_sekolah: 'TK Al-Hidayah', status: 'Diterima' },
  { id: 5, nis: '242501005', nama: 'Daffa Aryasetya', jk: 'L', asal_sekolah: 'TK Tunas Bangsa', status: 'Diterima' },
];

const dummyKelas = [
  { id: 1, nama: 'I-A', wali: 'Siti Aisyah, S.Pd.I', kapasitas: 32, terisi: 30 },
  { id: 2, nama: 'I-B', wali: 'Nurul Fitria, S.Pd', kapasitas: 32, terisi: 31 },
];

const PenempatanSiswaPage = () => {
  const [selectedKelas, setSelectedKelas] = useState('');
  const [search, setSearch] = useState('');
  const [selectedSiswa, setSelectedSiswa] = useState([]);

  const filteredSiswa = dummySiswa.filter(s => 
    s.nama.toLowerCase().includes(search.toLowerCase()) || 
    s.nis.includes(search)
  );

  const toggleSiswa = (id) => {
    setSelectedSiswa(prev => 
      prev.includes(id) ? prev.filter(x => x !== id) : [...prev, id]
    );
  };

  const toggleAll = () => {
    if (selectedSiswa.length === filteredSiswa.length) {
      setSelectedSiswa([]);
    } else {
      setSelectedSiswa(filteredSiswa.map(s => s.id));
    }
  };

  const handlePenempatan = () => {
    if (!selectedKelas) {
      alert('Pilih kelas tujuan terlebih dahulu!');
      return;
    }
    if (selectedSiswa.length === 0) {
      alert('Pilih minimal 1 siswa!');
      return;
    }
    alert(`Berhasil menempatkan ${selectedSiswa.length} siswa ke kelas ${dummyKelas.find(k => k.id === parseInt(selectedKelas))?.nama}`);
    setSelectedSiswa([]);
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Penempatan Siswa Baru</h2>
            <p className="text-xs text-slate-400 mt-0.5">Plotting siswa baru ke dalam kelas</p>
          </div>
          
          <div className="flex flex-col sm:flex-row gap-3 w-full md:w-auto p-3 bg-slate-50 rounded-2xl border border-slate-100">
            <select
              value={selectedKelas}
              onChange={e => setSelectedKelas(e.target.value)}
              className="px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white font-bold text-slate-700 min-w-[200px]"
            >
              <option value="">-- Pilih Kelas Tujuan --</option>
              {dummyKelas.map(k => (
                <option key={k.id} value={k.id}>{k.nama} (Sisa: {k.kapasitas - k.terisi} kursi)</option>
              ))}
            </select>
            <button
              onClick={handlePenempatan}
              className={`px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm whitespace-nowrap ${
                selectedSiswa.length > 0 && selectedKelas
                  ? 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-500/30'
                  : 'bg-slate-200 text-slate-400 cursor-not-allowed'
              }`}
            >
              Tempatkan {selectedSiswa.length > 0 ? `(${selectedSiswa.length} Siswa)` : ''}
            </button>
          </div>
        </div>

        {/* Search Bar */}
        <div className="p-4 border-b border-slate-50 bg-slate-50/50">
          <input
            type="text"
            placeholder="Cari nama siswa atau NIS..."
            value={search}
            onChange={e => setSearch(e.target.value)}
            className="w-full max-w-md px-4 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
          />
        </div>

        {/* Table */}
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                <th className="px-6 py-4 w-12">
                  <input
                    type="checkbox"
                    checked={selectedSiswa.length === filteredSiswa.length && filteredSiswa.length > 0}
                    onChange={toggleAll}
                    className="w-4 h-4 text-emerald-600 border-slate-300 rounded focus:ring-emerald-500"
                  />
                </th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">NIS</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Siswa</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">L/P</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Asal Sekolah</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Status PPDB</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {filteredSiswa.map(s => (
                <tr key={s.id} className={`hover:bg-slate-50/50 transition-colors ${selectedSiswa.includes(s.id) ? 'bg-emerald-50/30' : ''}`}>
                  <td className="px-6 py-4">
                    <input
                      type="checkbox"
                      checked={selectedSiswa.includes(s.id)}
                      onChange={() => toggleSiswa(s.id)}
                      className="w-4 h-4 text-emerald-600 border-slate-300 rounded focus:ring-emerald-500"
                    />
                  </td>
                  <td className="px-6 py-4 text-xs text-slate-500 font-mono">{s.nis}</td>
                  <td className="px-6 py-4 font-bold text-slate-800">{s.nama}</td>
                  <td className="px-6 py-4">
                    <span className={`px-2 py-1 rounded text-xs font-bold ${s.jk === 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700'}`}>
                      {s.jk}
                    </span>
                  </td>
                  <td className="px-6 py-4 text-slate-600 text-xs">{s.asal_sekolah}</td>
                  <td className="px-6 py-4">
                    <span className="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700">
                      {s.status}
                    </span>
                  </td>
                </tr>
              ))}
              {filteredSiswa.length === 0 && (
                <tr><td colSpan={6} className="px-6 py-12 text-center text-slate-400 text-sm">Tidak ada siswa yang belum ditempatkan.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default PenempatanSiswaPage;
