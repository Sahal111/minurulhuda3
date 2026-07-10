import React, { useState } from 'react';

const hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

const jadwalData = {
  Senin: [
    { mapel: 'Matematika', kelas: '6A', jam: '07:30 - 08:30', ruang: 'R. 6A' },
    { mapel: 'Matematika', kelas: '6B', jam: '08:30 - 09:30', ruang: 'R. 6B' },
    { mapel: 'IPA', kelas: '5A', jam: '10:00 - 11:00', ruang: 'R. 5A' },
  ],
  Selasa: [
    { mapel: 'IPA', kelas: '5B', jam: '07:30 - 08:30', ruang: 'R. 5B' },
    { mapel: 'Matematika', kelas: '4A', jam: '08:30 - 09:30', ruang: 'R. 4A' },
  ],
  Rabu: [
    { mapel: 'Matematika', kelas: '4B', jam: '07:30 - 08:30', ruang: 'R. 4B' },
    { mapel: 'IPA', kelas: '6A', jam: '09:30 - 10:30', ruang: 'R. 6A' },
    { mapel: 'IPA', kelas: '6B', jam: '10:30 - 11:30', ruang: 'R. 6B' },
  ],
  Kamis: [
    { mapel: 'Matematika', kelas: '5A', jam: '07:30 - 08:30', ruang: 'R. 5A' },
  ],
  Jumat: [
    { mapel: 'Matematika', kelas: '5B', jam: '07:30 - 08:30', ruang: 'R. 5B' },
    { mapel: 'IPA', kelas: '4A', jam: '08:30 - 09:30', ruang: 'R. 4A' },
    { mapel: 'IPA', kelas: '4B', jam: '09:30 - 10:30', ruang: 'R. 4B' },
  ],
  Sabtu: [],
};

const GuruJadwalPage = () => {
  const [hariAktif, setHariAktif] = useState('Senin');

  return (
    <div className="p-4 lg:p-8 space-y-8">
      <div>
        <h2 className="text-2xl font-bold text-slate-800">Jadwal Mengajar</h2>
        <p className="text-sm text-slate-500 mt-1">Jadwal pelajaran Anda</p>
      </div>

      <div className="flex flex-wrap gap-2">
        {hariList.map((hari) => (
          <button
            key={hari}
            onClick={() => setHariAktif(hari)}
            className={`px-5 py-2.5 rounded-xl text-sm font-semibold transition-all ${
              hariAktif === hari
                ? 'bg-emerald-600 text-white shadow-md'
                : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200'
            }`}
          >
            {hari}
          </button>
        ))}
      </div>

      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50 flex justify-between items-center">
          <h3 className="font-bold text-slate-800">Jadwal {hariAktif}</h3>
          <span className="text-xs text-slate-400">{jadwalData[hariAktif].length} sesi</span>
        </div>
        <div className="p-6">
          {jadwalData[hariAktif].length === 0 ? (
            <p className="text-center text-slate-400 py-8">Tidak ada jadwal</p>
          ) : (
            <div className="space-y-3">
              {jadwalData[hariAktif].map((j, i) => (
                <div key={i} className="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-colors">
                  <div className="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-xl flex flex-col items-center justify-center font-bold shrink-0">
                    <span className="text-xs">{j.jam.split(' - ')[0]}</span>
                    <span className="text-[10px] text-emerald-500">-</span>
                    <span className="text-xs">{j.jam.split(' - ')[1]}</span>
                  </div>
                  <div className="flex-1">
                    <p className="font-semibold text-slate-800">{j.mapel}</p>
                    <p className="text-sm text-slate-500">Kelas {j.kelas}</p>
                  </div>
                  <div className="text-right">
                    <span className="text-xs text-slate-400 bg-white px-3 py-1 rounded-lg border border-slate-200">
                      {j.ruang}
                    </span>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default GuruJadwalPage;
