import React, { useState } from 'react';

const dummyOrangTua = [
  { id: 1, no_kk: '3201010101010101', nama_ayah: 'Budi Darmawan', nama_ibu: 'Siti Aminah', no_hp: '081234567890', alamat: 'Jl. Merdeka No. 10', jml_anak: 2 },
  { id: 2, no_kk: '3201010101010102', nama_ayah: 'Ahmad Supendi', nama_ibu: 'Nur Hasanah', no_hp: '085712345678', alamat: 'Jl. Kenanga Blok C4', jml_anak: 1 },
  { id: 3, no_kk: '3201010101010103', nama_ayah: 'Ridwan Kamil', nama_ibu: 'Atalia Praratya', no_hp: '081199998888', alamat: 'Perum Gading Arcadia', jml_anak: 3 },
  { id: 4, no_kk: '3201010101010104', nama_ayah: 'Dedi Mulyadi', nama_ibu: 'Ratna M', no_hp: '082233445566', alamat: 'Jl. Pahlawan No. 45', jml_anak: 1 },
];

const OrangTuaPage = () => {
  const [search, setSearch] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [selectedOrtu, setSelectedOrtu] = useState(null);
  const [form, setForm] = useState({ no_kk: '', nama_ayah: '', nama_ibu: '', no_hp: '', alamat: '' });

  const filtered = dummyOrangTua.filter(o =>
    o.nama_ayah.toLowerCase().includes(search.toLowerCase()) ||
    o.nama_ibu.toLowerCase().includes(search.toLowerCase()) ||
    o.no_kk.includes(search)
  );

  const openAdd = () => {
    setSelectedOrtu(null);
    setForm({ no_kk: '', nama_ayah: '', nama_ibu: '', no_hp: '', alamat: '' });
    setShowModal(true);
  };

  const openEdit = (o) => {
    setSelectedOrtu(o);
    setForm({ ...o });
    setShowModal(true);
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      {/* Table Card */}
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Data Orang Tua / Wali</h2>
            <p className="text-xs text-slate-400 mt-0.5">{filtered.length} data ditemukan</p>
          </div>
          <div className="flex gap-3 w-full sm:w-auto">
            <input
              type="text"
              placeholder="Cari nama, No. KK..."
              value={search}
              onChange={e => setSearch(e.target.value)}
              className="flex-1 sm:w-64 px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
            />
            <button
              onClick={openAdd}
              className="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all shadow-sm shadow-emerald-500/30 whitespace-nowrap"
            >
              + Tambah Data
            </button>
          </div>
        </div>

        {/* Table */}
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">No</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">No. KK</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Ayah</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Ibu</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">No. HP</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Jml Anak</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {filtered.map((o, i) => (
                <tr key={o.id} className="hover:bg-slate-50/50 transition-colors">
                  <td className="px-6 py-4 text-slate-400 text-xs">{i + 1}</td>
                  <td className="px-6 py-4 text-xs text-slate-500 font-mono">{o.no_kk}</td>
                  <td className="px-6 py-4 font-semibold text-slate-800">{o.nama_ayah}</td>
                  <td className="px-6 py-4 font-semibold text-slate-800">{o.nama_ibu}</td>
                  <td className="px-6 py-4 text-slate-600 text-xs">{o.no_hp}</td>
                  <td className="px-6 py-4 text-slate-600 text-xs">{o.jml_anak} Siswa</td>
                  <td className="px-6 py-4">
                    <div className="flex gap-2">
                      <button onClick={() => openEdit(o)} className="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold rounded-lg transition-all">Edit</button>
                      <button onClick={() => { setSelectedOrtu(o); setShowDeleteModal(true); }} className="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold rounded-lg transition-all">Hapus</button>
                    </div>
                  </td>
                </tr>
              ))}
              {filtered.length === 0 && (
                <tr><td colSpan={7} className="px-6 py-12 text-center text-slate-400 text-sm">Tidak ada data yang sesuai pencarian.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      </div>

      {/* Modal Tambah/Edit */}
      {showModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-2xl overflow-hidden">
            <div className="p-6 border-b border-slate-100 flex justify-between items-center">
              <h3 className="text-lg font-bold text-slate-800">{selectedOrtu ? 'Edit Data Orang Tua' : 'Tambah Data Orang Tua'}</h3>
              <button onClick={() => setShowModal(false)} className="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">✕</button>
            </div>
            <div className="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div className="sm:col-span-2">
                <label className="block text-xs font-bold text-slate-600 mb-1.5">No. Kartu Keluarga (KK)</label>
                <input
                  type="text"
                  value={form.no_kk}
                  onChange={e => setForm({ ...form, no_kk: e.target.value })}
                  className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
                />
              </div>
              {[
                { label: 'Nama Ayah', key: 'nama_ayah', type: 'text' },
                { label: 'Nama Ibu', key: 'nama_ibu', type: 'text' },
                { label: 'No. HP / WhatsApp', key: 'no_hp', type: 'text' },
              ].map(f => (
                <div key={f.key}>
                  <label className="block text-xs font-bold text-slate-600 mb-1.5">{f.label}</label>
                  <input
                    type={f.type}
                    value={form[f.key]}
                    onChange={e => setForm({ ...form, [f.key]: e.target.value })}
                    className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none"
                  />
                </div>
              ))}
              <div className="sm:col-span-2">
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Alamat Lengkap</label>
                <textarea
                  value={form.alamat}
                  onChange={e => setForm({ ...form, alamat: e.target.value })}
                  rows={3}
                  className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none resize-none"
                ></textarea>
              </div>
            </div>
            <div className="p-6 border-t border-slate-100 flex justify-end gap-3">
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-all shadow-sm shadow-emerald-500/30">
                {selectedOrtu ? 'Simpan Perubahan' : 'Tambah Data'}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Modal Delete */}
      {showDeleteModal && selectedOrtu && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm p-8 text-center">
            <div className="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🗑️</div>
            <h3 className="text-lg font-bold text-slate-800 mb-2">Hapus Data?</h3>
            <p className="text-sm text-slate-500 mb-6">Data KK <strong>{selectedOrtu.no_kk}</strong> akan dihapus secara permanen.</p>
            <div className="flex gap-3">
              <button onClick={() => setShowDeleteModal(false)} className="flex-1 py-3 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
              <button onClick={() => setShowDeleteModal(false)} className="flex-1 py-3 text-sm font-bold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition-all">Hapus</button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default OrangTuaPage;
