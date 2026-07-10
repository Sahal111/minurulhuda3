import React, { useState } from 'react';
import { X, Save, User, GraduationCap, MapPin, Phone } from 'lucide-react';
import { siswaAPI } from '../../../api/operator';

const formatDateForInput = (val) => {
    if (!val) return '';
    return typeof val === 'string' ? val.substring(0, 10) : '';
};

const ModalFormSiswa = ({ isOpen, onClose, onSuccess, siswa = null, readonly = false }) => {
    if (!isOpen) return null;

    const [activeTab, setActiveTab] = useState('pribadi');
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const [form, setForm] = useState({
    jenis_pendaftaran: siswa?.jenis_pendaftaran || 'baru',   // ← TAMBAH, required di backend
    nis: siswa?.nis || '',
    nisn: siswa?.nisn || '',
    nama: siswa?.nama || '',
    jenis_kelamin: siswa?.jenis_kelamin || '',
    tempat_lahir: siswa?.tempat_lahir || '',
    tanggal_lahir: formatDateForInput(siswa?.tanggal_lahir),
    agama: siswa?.agama || '',
    nik: siswa?.nik || '',
    no_kk: siswa?.no_kk || '',
    kebutuhan_khusus: siswa?.kebutuhan_khusus || '',
    asal_sekolah: siswa?.asal_sekolah || '',
    tanggal_masuk: formatDateForInput(siswa?.tanggal_masuk),
    kelas_id: siswa?.kelas_id || '',
    alamat_siswa: siswa?.alamat_siswa || '',
    rt: siswa?.rt || '',
    rw: siswa?.rw || '',
    kelurahan: siswa?.kelurahan || '',   // ← sudah ada, pastikan diisi user
    kecamatan: siswa?.kecamatan || '',  // ← sudah ada, pastikan diisi user
    kode_pos: siswa?.kode_pos || '',
    no_hp_ortu: siswa?.no_hp_ortu || '',    // ← TAMBAH, required di backend
    alamat: siswa?.alamat || '',             // ← TAMBAH, required di backend
    nama_ayah: siswa?.nama_ayah || '',
    nama_ibu: siswa?.nama_ibu || '',
    nama_wali: siswa?.nama_wali || '',
});

    const handleChange = (e) => {
        const { name, value } = e.target;
        setForm(prev => ({ ...prev, [name]: value }));
    };

    const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError(null);

    try {
        const formData = new FormData();
        Object.entries(form).forEach(([key, val]) => {
            // Kirim semua field termasuk yang kosong, biar Laravel yang validasi
            if (val !== null && val !== undefined) {
                formData.append(key, val);
            }
        });

        if (siswa) {
            await siswaAPI.update(siswa.id, formData);
        } else {
            await siswaAPI.store(formData);
        }

        onSuccess?.();
        onClose();
    } catch (err) {
        setError(err.response?.data?.message || err.message);
    } finally {
        setLoading(false);
    }
};

    const tabs = [
        { id: 'pribadi', label: 'Data Pribadi', icon: <User className="w-4 h-4" /> },
        { id: 'akademik', label: 'Akademik', icon: <GraduationCap className="w-4 h-4" /> },
        { id: 'alamat', label: 'Alamat', icon: <MapPin className="w-4 h-4" /> },
        { id: 'ortu', label: 'Orang Tua', icon: <Phone className="w-4 h-4" /> },
    ];

    const inputClass = `w-full px-4 py-2 border rounded-xl text-sm dark:text-white dark:placeholder-slate-400 ${
        readonly
            ? 'bg-slate-100 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 cursor-default'
            : 'bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500'
    }`;

    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 backdrop-blur-sm p-4 sm:p-6">
            <div
                className="relative w-full max-w-4xl bg-white dark:bg-slate-900 rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]"
                onClick={(e) => e.stopPropagation()}
            >
                <div className="flex items-center justify-between p-6 border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                    <div>
                        <h3 className="text-xl font-bold text-slate-800 dark:text-white">
                            {readonly ? 'Detail Siswa' : (siswa ? 'Edit Siswa' : 'Tambah Siswa Baru')}
                        </h3>
                        <p className="text-sm text-slate-500 mt-1">{readonly ? 'Informasi lengkap data diri siswa' : 'Lengkapi informasi data diri siswa'}</p>
                    </div>
                    <button
                        onClick={onClose}
                        className="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-xl transition-colors"
                    >
                        <X className="w-5 h-5" />
                    </button>
                </div>

                {error && (
                    <div className="mx-6 mt-4 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl text-sm text-red-700 dark:text-red-400">
                        {error}
                    </div>
                )}

                <div className="flex flex-col sm:flex-row flex-1 overflow-hidden">
                    <div className="w-full sm:w-48 bg-slate-50 dark:bg-slate-900/50 border-r border-slate-200 dark:border-slate-800 p-4 space-y-1 overflow-y-auto">
                        {tabs.map(tab => (
                            <button
                                key={tab.id}
                                onClick={() => setActiveTab(tab.id)}
                                className={`w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors ${
                                    activeTab === tab.id
                                        ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400'
                                        : 'text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800'
                                }`}
                            >
                                {tab.icon}
                                {tab.label}
                            </button>
                        ))}
                    </div>

                    <div className="flex-1 overflow-y-auto p-6 bg-white dark:bg-slate-900">
                        <form id="siswaForm" onSubmit={handleSubmit} className="space-y-6">
                            {activeTab === 'pribadi' && (
                                <div className="space-y-4">
                                    <h4 className="text-lg font-semibold text-slate-800 dark:text-white mb-4">Informasi Pribadi</h4>
                                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap {!readonly && <span className="text-red-500">*</span>}</label>
                                            <input type="text" name="nama" value={form.nama} onChange={handleChange} className={inputClass} placeholder="Nama lengkap siswa" required disabled={readonly} />
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Jenis Kelamin {!readonly && <span className="text-red-500">*</span>}</label>
                                            <select name="jenis_kelamin" value={form.jenis_kelamin} onChange={handleChange} className={inputClass} required={!readonly} disabled={readonly}>
                                                <option value="">Pilih...</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">NIS {!readonly && <span className="text-red-500">*</span>}</label>
                                            <input type="text" name="nis" value={form.nis} onChange={handleChange} className={inputClass} placeholder="Nomor Induk Siswa" required={!readonly} disabled={readonly} />
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">NISN</label>
                                            <input type="text" name="nisn" value={form.nisn} onChange={handleChange} className={inputClass} placeholder="Nomor Induk Siswa Nasional" disabled={readonly} />
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">NIK</label>
                                            <input type="text" name="nik" value={form.nik} onChange={handleChange} className={inputClass} placeholder="16 digit" disabled={readonly} />
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">No. KK</label>
                                            <input type="text" name="no_kk" value={form.no_kk} onChange={handleChange} className={inputClass} placeholder="16 digit" disabled={readonly} />
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" value={form.tempat_lahir} onChange={handleChange} className={inputClass} placeholder="Kota lahir" disabled={readonly} />
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" value={form.tanggal_lahir} onChange={handleChange} className={inputClass} disabled={readonly} />
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Agama {!readonly && <span className="text-red-500">*</span>}</label>
                                            <select name="agama" value={form.agama} onChange={handleChange} className={inputClass} required={!readonly} disabled={readonly}>
                                                <option value="">Pilih...</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Khonghucu">Khonghucu</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Kebutuhan Khusus</label>
                                            <input type="text" name="kebutuhan_khusus" value={form.kebutuhan_khusus} onChange={handleChange} className={inputClass} placeholder="Jika ada" disabled={readonly} />
                                        </div>
                                    </div>
                                </div>
                            )}

                            {activeTab === 'akademik' && (
                                <div className="space-y-4">
                                    <h4 className="text-lg font-semibold text-slate-800 dark:text-white mb-4">Data Akademik</h4>
                                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Asal Sekolah</label>
                                            <input type="text" name="asal_sekolah" value={form.asal_sekolah} onChange={handleChange} className={inputClass} placeholder="Nama sekolah sebelumnya" disabled={readonly} />
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tanggal Masuk {!readonly && <span className="text-red-500">*</span>}</label>
                                            <input type="date" name="tanggal_masuk" value={form.tanggal_masuk} onChange={handleChange} className={inputClass} required={!readonly} disabled={readonly} />
                                        </div>
                                    </div>
                                </div>
                            )}

                            {activeTab === 'alamat' && (
                                <div className="space-y-4">
                                    <h4 className="text-lg font-semibold text-slate-800 dark:text-white mb-4">Data Alamat</h4>
                                    <div className="grid grid-cols-1 gap-4">
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Alamat</label>
                                            <textarea name="alamat_siswa" value={form.alamat_siswa} onChange={handleChange} className={inputClass} rows="2" placeholder="Jalan, dusun, dsb." disabled={readonly} />
                                        </div>
                                    </div>
                                    <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">RT</label>
                                            <input type="text" name="rt" value={form.rt} onChange={handleChange} className={inputClass} disabled={readonly} />
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">RW</label>
                                            <input type="text" name="rw" value={form.rw} onChange={handleChange} className={inputClass} disabled={readonly} />
                                        </div>
                                        <div>
    <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
        Kelurahan {!readonly && <span className="text-red-500">*</span>}
    </label>
    <input type="text" name="kelurahan" value={form.kelurahan} onChange={handleChange} className={inputClass} required={!readonly} disabled={readonly} />
</div>
<div>
    <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
        Kecamatan {!readonly && <span className="text-red-500">*</span>}
    </label>
    <input type="text" name="kecamatan" value={form.kecamatan} onChange={handleChange} className={inputClass} required={!readonly} disabled={readonly} />
</div>
                                        <div>
                                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Kode Pos</label>
                                            <input type="text" name="kode_pos" value={form.kode_pos} onChange={handleChange} className={inputClass} disabled={readonly} />
                                        </div>
                                    </div>
                                </div>
                            )}

                            {activeTab === 'ortu' && (
    <div className="space-y-4">
        <h4 className="text-lg font-semibold text-slate-800 dark:text-white mb-4">Data Orang Tua / Wali</h4>
        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Ayah</label>
                <input type="text" name="nama_ayah" value={form.nama_ayah} onChange={handleChange} className={inputClass} placeholder="Nama ayah" disabled={readonly} />
            </div>
            <div>
                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Ibu</label>
                <input type="text" name="nama_ibu" value={form.nama_ibu} onChange={handleChange} className={inputClass} placeholder="Nama ibu" disabled={readonly} />
            </div>
            <div>
                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Wali</label>
                <input type="text" name="nama_wali" value={form.nama_wali} onChange={handleChange} className={inputClass} placeholder="Nama wali (jika ada)" disabled={readonly} />
            </div>
            {/* ← TAMBAH: field required oleh backend */}
            <div>
                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    No. HP Orang Tua {!readonly && <span className="text-red-500">*</span>}
                </label>
                <input type="text" name="no_hp_ortu" value={form.no_hp_ortu} onChange={handleChange} className={inputClass} placeholder="08xxxxxxxxxx" required={!readonly} disabled={readonly} />
            </div>
            <div className="sm:col-span-2">
                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    Alamat Orang Tua {!readonly && <span className="text-red-500">*</span>}
                </label>
                <textarea name="alamat" value={form.alamat} onChange={handleChange} className={inputClass} rows="2" placeholder="Alamat domisili orang tua" required={!readonly} disabled={readonly} />
            </div>
        </div>
    </div>
)}
                        </form>
                    </div>
                </div>

                <div className="p-6 border-t border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50 flex justify-end gap-3">
                    {readonly ? (
                        <button
                            onClick={onClose}
                            className="px-6 py-2.5 rounded-xl text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700"
                        >
                            Tutup
                        </button>
                    ) : (
                        <>
                            <button
                                onClick={onClose}
                                className="px-6 py-2.5 rounded-xl text-sm font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                form="siswaForm"
                                disabled={loading}
                                className="px-6 py-2.5 rounded-xl text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <Save className="w-4 h-4" />
                                {loading ? 'Menyimpan...' : 'Simpan Data'}
                            </button>
                        </>
                    )}
                </div>
            </div>
        </div>
    );
};

export default ModalFormSiswa;