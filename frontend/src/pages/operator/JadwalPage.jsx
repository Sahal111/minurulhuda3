import React, { useState } from 'react';

const dummyJadwal = [
  { id: 1, hari: 'Senin', jam: '07:00 - 08:30', mapel: 'Upacara Bendera', kelas: 'Semua Kelas', guru: '-' },
  { id: 2, hari: 'Senin', jam: '08:30 - 10:00', mapel: 'Matematika', kelas: 'IV-A', guru: 'Ahmad Fauzi, S.Pd' },
  { id: 3, hari: 'Senin', jam: '10:00 - 10:30', mapel: 'Istirahat', kelas: 'Semua Kelas', guru: '-' },
  { id: 4, hari: 'Senin', jam: '10:30 - 12:00', mapel: 'Bahasa Indonesia', kelas: 'IV-A', guru: 'Budi Santoso, M.Pd' },
  { id: 5, hari: 'Selasa', jam: '07:30 - 09:00', mapel: 'Pendidikan Agama Islam', kelas: 'IV-A', guru: 'Siti Aisyah, S.Pd.I' },
  { id: 6, hari: 'Selasa', jam: '09:00 - 10:30', mapel: 'IPA', kelas: 'IV-A', guru: 'Nurul Hidayah, S.Pd' },
];

const JadwalPage = () => {
  const [selectedKelas, setSelectedKelas] = useState('IV-A');
  const [showModal, setShowModal] = useState(false);
  const [form, setForm] = useState({ hari: 'Senin', jam: '', mapel: '', guru: '', kelas: 'IV-A' });

  const hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

  const filtered = dummyJadwal.filter(j => j.kelas === selectedKelas || j.kelas === 'Semua Kelas');

  return (
    <div className="p-4 lg:p-8 space-y-6">
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Jadwal Pelajaran</h2>
            <p className="text-xs text-slate-400 mt-0.5">Kelola jadwal pelajaran tiap kelas</p>
          </div>
          <div className="flex gap-3 w-full sm:w-auto">
            <select
              value={selectedKelas}
              onChange={e => setSelectedKelas(e.target.value)}
              className="px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white font-bold text-emerald-700"
            >
              <option value="I-A">Kelas I-A</option>
              <option value="I-B">Kelas I-B</option>
              <option value="II-A">Kelas II-A</option>
              <option value="III-A">Kelas III-A</option>
              <option value="IV-A">Kelas IV-A</option>
              <option value="V-A">Kelas V-A</option>
              <option value="VI-A">Kelas VI-A</option>
            </select>
            <button
              onClick={() => setShowModal(true)}
              className="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all shadow-sm shadow-emerald-500/30 whitespace-nowrap"
            >
              + Tambah Jadwal
            </button>
          </div>
        </div>

        {/* Schedule View */}
        <div className="p-6 overflow-x-auto">
          <div className="min-w-[800px] flex gap-4">
            {hariList.map(hari => {
              const jadwalHariIni = filtered.filter(j => j.hari === hari).sort((a, b) => a.jam.localeCompare(b.jam));
              return (
                <div key={hari} className="flex-1 bg-slate-50 rounded-2xl border border-slate-100 p-4">
                  <h3 className="text-sm font-bold text-slate-700 text-center mb-4 uppercase tracking-wider">{hari}</h3>
                  <div className="space-y-3">
                    {jadwalHariIni.length > 0 ? (
                      jadwalHariIni.map(j => (
                        <div key={j.id} className="bg-white p-3 rounded-xl shadow-sm border border-slate-100 border-l-4 border-l-emerald-500 hover:shadow-md transition-all cursor-pointer group">
                          <div className="text-[10px] font-bold text-slate-400 mb-1">{j.jam}</div>
                          <div className="font-bold text-slate-800 text-sm leading-tight mb-1">{j.mapel}</div>
                          {j.guru !== '-' && (
                            <div className="text-[10px] text-slate-500 flex items-center gap-1">
                              <span className="w-1 h-1 bg-blue-400 rounded-full"></span>
                              {j.guru}
                            </div>
                          )}
                          <div className="mt-2 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button className="text-[10px] font-bold text-blue-600 hover:bg-blue-50 px-2 py-0.5 rounded">Edit</button>
                            <button className="text-[10px] font-bold text-rose-600 hover:bg-rose-50 px-2 py-0.5 rounded">Hapus</button>
                          </div>
                        </div>
                      ))
                    ) : (
                      <div className="text-center p-4 text-slate-400 text-xs border-2 border-dashed border-slate-200 rounded-xl">
                        Libur / Kosong
                      </div>
                    )}
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      </div>

      {/* Modal Tambah Jadwal */}
      {showModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-lg overflow-hidden">
            <div className="p-6 border-b border-slate-100 flex justify-between items-center">
              <h3 className="text-lg font-bold text-slate-800">Tambah Jadwal Pelajaran</h3>
              <button onClick={() => setShowModal(false)} className="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">✕</button>
            </div>
            <div className="p-6 space-y-4">
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className="block text-xs font-bold text-slate-600 mb-1.5">Hari</label>
                  <select value={form.hari} onChange={e => setForm({ ...form, hari: e.target.value })} className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white">
                    {hariList.map(h => <option key={h} value={h}>{h}</option>)}
                  </select>
                </div>
                <div>
                  <label className="block text-xs font-bold text-slate-600 mb-1.5">Jam Pelajaran (contoh: 07:00 - 08:30)</label>
                  <input type="text" value={form.jam} onChange={e => setForm({ ...form, jam: e.target.value })} className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none" />
                </div>
              </div>
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Mata Pelajaran</label>
                <input type="text" value={form.mapel} onChange={e => setForm({ ...form, mapel: e.target.value })} className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none" />
              </div>
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Guru Pengajar</label>
                <input type="text" value={form.guru} onChange={e => setForm({ ...form, guru: e.target.value })} className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none" />
              </div>
            </div>
            <div className="p-6 border-t border-slate-100 flex justify-end gap-3">
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-all shadow-sm shadow-emerald-500/30">
                Simpan Jadwal
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default JadwalPage;
