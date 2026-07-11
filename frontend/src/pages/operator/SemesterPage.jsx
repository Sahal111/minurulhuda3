import React, { useState, useEffect, useCallback } from 'react';
import { semesterAPI } from '../../api/operator';
import ModalTrashSemester from '../../components/operator/ModalTrashSemester';

const SemesterPage = () => {
  const [dataSemester, setDataSemester] = useState([]);
  const [dataTahunAjaran, setDataTahunAjaran] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [formError, setFormError] = useState(null);

  const [showModal, setShowModal] = useState(false);
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [showTrash, setShowTrash] = useState(false);
  const [toast, setToast] = useState(null);
  const [selectedSemester, setSelectedSemester] = useState(null);
  const [form, setForm] = useState({ nama: 'Ganjil', tahun_ajaran_id: '', is_active: false });

  const fetchData = useCallback(async () => {
    setLoading(true);
    setError(null);
    try {
        const response = await semesterAPI.getAll();
        const { semesters, tahunAjarans } = response.data;
        setDataSemester(semesters || []);
        setDataTahunAjaran(tahunAjarans || []);
    } catch (err) {
        setError(err.response?.data?.message || err.message);
    } finally {
        setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchData();
  }, [fetchData]);

  const showToast = (msg) => {
    setToast(msg);
    setTimeout(() => setToast(null), 3000);
  };

  const openAdd = () => {
    setSelectedSemester(null);
    // Default to the first Tahun Ajaran if available
    const defaultTA = dataTahunAjaran.length > 0 ? dataTahunAjaran[0].id : '';
    setForm({ nama: 'Ganjil', tahun_ajaran_id: defaultTA, is_active: false });
    setFormError(null);
    setShowModal(true);
  };

  const openEdit = (s) => {
    setSelectedSemester(s);
    setForm({ 
        nama: s.nama, 
        tahun_ajaran_id: s.tahun_ajaran_id || '', 
        is_active: !!s.is_active 
    });
    setFormError(null);
    setShowModal(true);
  };

  const handleSave = async () => {
    setFormError(null);
    if (!form.tahun_ajaran_id) {
      setFormError('Tahun Ajaran wajib dipilih.');
      return;
    }
    if (!form.nama) {
      setFormError('Nama Semester wajib dipilih.');
      return;
    }

    setLoading(true);
    try {
      if (selectedSemester) {
        await semesterAPI.update(selectedSemester.id, form);
      } else {
        await semesterAPI.store(form);
      }
      setShowModal(false);
      fetchData();
    } catch (err) {
      setFormError(err.response?.data?.message || err.message);
    } finally {
      setLoading(false);
    }
  };

  const handleDelete = async () => {
    if (!selectedSemester) return;
    setLoading(true);
    setError(null);
    try {
      await semesterAPI.destroy(selectedSemester.id);
      setShowDeleteModal(false);
      setSelectedSemester(null);
      showToast('Semester berhasil dipindahkan ke Recycle Bin');
      fetchData();
    } catch (err) {
      setError(err.response?.data?.message || err.message);
      setShowDeleteModal(false);
    } finally {
      setLoading(false);
    }
  };

  const handleSetActive = async (id) => {
    setLoading(true);
    setError(null);
    try {
      await semesterAPI.setActive(id);
      fetchData();
    } catch (err) {
      setError(err.response?.data?.message || err.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      {toast && (
        <div className="fixed top-4 right-4 z-[100] px-5 py-3 bg-emerald-600 text-white rounded-2xl shadow-2xl text-sm font-bold animate-up">
          {toast}
        </div>
      )}
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div className="p-6 border-b border-slate-50 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Manajemen Semester</h2>
            <p className="text-xs text-slate-400 mt-0.5">Atur semester aktif untuk proses akademik</p>
          </div>
          <div className="flex gap-2">
            <button
              onClick={() => setShowTrash(true)}
              className="flex items-center gap-2 bg-white hover:bg-rose-50 text-slate-600 hover:text-rose-600 border border-slate-200 hover:border-rose-300 font-bold px-4 py-2.5 rounded-xl text-sm transition-all whitespace-nowrap"
            >
              Recycle Bin
            </button>
            <button
              onClick={openAdd}
              className="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all shadow-sm shadow-emerald-500/30 whitespace-nowrap"
            >
              + Tambah Semester
            </button>
          </div>
        </div>

        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-slate-50 text-left">
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider w-24">No</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Semester</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Tahun Ajaran</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                <th className="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider w-48">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-50">
              {loading && dataSemester.length === 0 ? (
                <tr><td colSpan={5} className="px-6 py-12 text-center text-slate-400 text-sm">Memuat data...</td></tr>
              ) : error ? (
                <tr><td colSpan={5} className="px-6 py-12 text-center text-rose-500 text-sm">{error}</td></tr>
              ) : dataSemester.length === 0 ? (
                <tr><td colSpan={5} className="px-6 py-12 text-center text-slate-400 text-sm">Tidak ada data semester.</td></tr>
              ) : (
                dataSemester.map((s, i) => (
                  <tr key={s.id} className="hover:bg-slate-50/50 transition-colors">
                    <td className="px-6 py-4 text-slate-400 text-xs">{i + 1}</td>
                    <td className="px-6 py-4 font-bold text-slate-800">{s.nama}</td>
                    <td className="px-6 py-4 text-slate-600">{s.tahun_ajaran}</td>
                    <td className="px-6 py-4">
                      <span className={`inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold ${
                        s.is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500'
                      }`}>
                        {s.is_active && <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>}
                        {s.is_active ? 'Aktif' : 'Tidak Aktif'}
                      </span>
                    </td>
                    <td className="px-6 py-4">
                      <div className="flex gap-2">
                        {!s.is_active && (
                          <button 
                            onClick={() => handleSetActive(s.id)} 
                            disabled={loading}
                            className="px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold rounded-lg transition-all disabled:opacity-50"
                          >
                            Set Aktif
                          </button>
                        )}
                        <button onClick={() => openEdit(s)} className="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold rounded-lg transition-all">Edit</button>
                        <button onClick={() => { setSelectedSemester(s); setShowDeleteModal(true); }} className="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold rounded-lg transition-all">Hapus</button>
                      </div>
                    </td>
                  </tr>
                ))
              )}
            </tbody>
          </table>
        </div>
      </div>

      {showModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm overflow-hidden">
            <div className="p-6 border-b border-slate-100 flex justify-between items-center">
              <h3 className="text-lg font-bold text-slate-800">{selectedSemester ? 'Edit Semester' : 'Tambah Semester'}</h3>
              <button onClick={() => setShowModal(false)} className="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">✕</button>
            </div>

            {formError && (
              <div className="mx-6 mt-4 p-3 bg-rose-50 border border-rose-100 rounded-xl text-rose-600 text-xs font-semibold">
                ⚠️ {formError}
              </div>
            )}

            <div className="p-6 space-y-4">
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Tahun Ajaran</label>
                <select
                  value={form.tahun_ajaran_id}
                  onChange={e => setForm({ ...form, tahun_ajaran_id: e.target.value })}
                  className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white"
                >
                  <option value="">Pilih Tahun Ajaran</option>
                  {dataTahunAjaran.map(ta => (
                    <option key={ta.id} value={ta.id}>{ta.tahun}</option>
                  ))}
                </select>
              </div>
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Semester</label>
                <select
                  value={form.nama}
                  onChange={e => setForm({ ...form, nama: e.target.value })}
                  className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white"
                >
                  <option value="Ganjil">Ganjil</option>
                  <option value="Genap">Genap</option>
                </select>
              </div>
              <div>
                <label className="block text-xs font-bold text-slate-600 mb-1.5">Status</label>
                <select
                  value={form.is_active ? 'true' : 'false'}
                  onChange={e => setForm({ ...form, is_active: e.target.value === 'true' })}
                  className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 outline-none bg-white"
                >
                  <option value="true">Aktif</option>
                  <option value="false">Tidak Aktif</option>
                </select>
                <p className="text-[10px] text-amber-600 mt-2 bg-amber-50 p-2 rounded-lg border border-amber-100">
                  ⚠️ <strong>Perhatian:</strong> Hanya boleh ada 1 Semester yang berstatus Aktif. Jika Anda mengaktifkan ini, semester lain akan otomatis dinonaktifkan.
                </p>
              </div>
            </div>
            <div className="p-6 border-t border-slate-100 flex justify-end gap-3">
              <button onClick={() => setShowModal(false)} className="px-6 py-2.5 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
              <button 
                onClick={handleSave} 
                disabled={loading}
                className="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 disabled:bg-emerald-400 rounded-xl transition-all shadow-sm shadow-emerald-500/30"
              >
                {loading ? 'Menyimpan...' : 'Simpan'}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Modal Recycle Bin */}
      <ModalTrashSemester
        isOpen={showTrash}
        onClose={() => setShowTrash(false)}
        onSuccess={(msg) => { showToast(msg); fetchData(); }}
      />

      {showDeleteModal && selectedSemester && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm p-8 text-center">
            <div className="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🗑️</div>
            <h3 className="text-lg font-bold text-slate-800 mb-2">Hapus Semester?</h3>
            <p className="text-sm text-slate-500 mb-6">Semester <strong>{selectedSemester.nama} ({selectedSemester.tahun_ajaran})</strong> akan dipindahkan ke Recycle Bin.</p>
            <div className="flex gap-3">
              <button onClick={() => setShowDeleteModal(false)} className="flex-1 py-3 text-sm font-bold text-slate-600 bg-slate-100 rounded-xl">Batal</button>
              <button 
                onClick={handleDelete} 
                disabled={loading}
                className="flex-1 py-3 text-sm font-bold text-white bg-rose-600 hover:bg-rose-700 disabled:bg-rose-400 rounded-xl"
              >
                {loading ? 'Menghapus...' : 'Hapus'}
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default SemesterPage;
