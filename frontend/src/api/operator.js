/**
 * Operator API Services
 * Centralized API calls for all operator modules
 */
import api from './axios';

// ─── SISWA ───────────────────────────────────────────────────────────────────
export const siswaAPI = {
    getAll: (params = {}) => api.get('/operator/data-siswa', { params }),
    show: (id) => api.get(`/operator/data-siswa/${id}/show`),
    store: (data) => api.post('/operator/data-siswa', data, {
        headers: { 'Content-Type': 'multipart/form-data' }
    }),
    update: (id, data) => api.post(`/operator/data-siswa/${id}`, data, {
        headers: { 'Content-Type': 'multipart/form-data' }
    }),
    destroy: (id) => api.delete(`/operator/data-siswa/${id}`),
    trash: (params = {}) => api.get('/operator/data-siswa/trash', { params }),
    restore: (id) => api.post(`/operator/data-siswa/${id}/restore`),
    forceDelete: (id) => api.delete(`/operator/data-siswa/${id}/force`),
    mutasi: (id, data) => api.put(`/operator/data-siswa/${id}/mutasi`, data),
    reactivate: (id, data) => api.put(`/operator/data-siswa/${id}/reactivate`, data),
    riwayatKelas: (id) => api.get(`/operator/data-siswa/${id}/riwayat-kelas`),
    // Berkas
    getBerkas: (siswaId) => api.get(`/operator/data-siswa/${siswaId}/berkas`),
    storeBerkas: (siswaId, data) => api.post(`/operator/data-siswa/${siswaId}/berkas`, data, {
        headers: { 'Content-Type': 'multipart/form-data' }
    }),
    destroyBerkas: (siswaId, berkasId) => api.delete(`/operator/data-siswa/${siswaId}/berkas/${berkasId}`),
    // Prestasi
    getPrestasi: (siswaId) => api.get(`/operator/data-siswa/${siswaId}/prestasi`),
    storePrestasi: (siswaId, data) => api.post(`/operator/data-siswa/${siswaId}/prestasi`, data, {
        headers: { 'Content-Type': 'multipart/form-data' }
    }),
    updatePrestasi: (siswaId, prestasiId, data) => api.post(`/operator/data-siswa/${siswaId}/prestasi/${prestasiId}`, data, {
        headers: { 'Content-Type': 'multipart/form-data' }
    }),
    destroyPrestasi: (siswaId, prestasiId) => api.delete(`/operator/data-siswa/${siswaId}/prestasi/${prestasiId}`),
    // Beasiswa
    getBeasiswa: (siswaId) => api.get(`/operator/data-siswa/${siswaId}/beasiswa`),
    storeBeasiswa: (siswaId, data) => api.post(`/operator/data-siswa/${siswaId}/beasiswa`, data),
    destroyBeasiswa: (siswaId, beasiswaId) => api.delete(`/operator/data-siswa/${siswaId}/beasiswa/${beasiswaId}`),
};

// ─── GURU ────────────────────────────────────────────────────────────────────
export const guruAPI = {
    getAll: (params = {}) => api.get('/operator/data-guru', { params }),
    store: (data) => api.post('/operator/data-guru', data, {
        headers: { 'Content-Type': 'multipart/form-data' }
    }),
    update: (id, data) => api.put(`/operator/data-guru/${id}`, data, {
        headers: { 'Content-Type': 'multipart/form-data' }
    }),
    show: (id) => api.get(`/operator/data-guru/${id}/show`),
    destroy: (id) => api.delete(`/operator/data-guru/${id}`),
    trash: () => api.get('/operator/data-guru/trash'),
    restore: (id) => api.patch(`/operator/data-guru/${id}/restore`),
    forceDelete: (id) => api.delete(`/operator/data-guru/${id}/force-delete`),
    assignUser: (id, data) => api.post(`/operator/data-guru/${id}/assign-user`, data),
    // Diklat
    getDiklat: (guruId) => api.get(`/operator/data-guru/${guruId}/diklat`),
    storeDiklat: (guruId, data) => api.post(`/operator/data-guru/${guruId}/diklat`, data),
    updateDiklat: (guruId, diklatId, data) => api.put(`/operator/data-guru/${guruId}/diklat/${diklatId}`, data),
    destroyDiklat: (guruId, diklatId) => api.delete(`/operator/data-guru/${guruId}/diklat/${diklatId}`),
    // Inpassing
    getInpassing: (guruId) => api.get(`/operator/data-guru/${guruId}/inpassing`),
    storeInpassing: (guruId, data) => api.post(`/operator/data-guru/${guruId}/inpassing`, data),
    setAktifInpassing: (guruId, inpassingId) => api.patch(`/operator/data-guru/${guruId}/inpassing/${inpassingId}/aktif`),
    destroyInpassing: (guruId, inpassingId) => api.delete(`/operator/data-guru/${guruId}/inpassing/${inpassingId}`),
    // Dokumen
    getDokumen: (id) => api.get(`/operator/data-guru/${id}/dokumen`),
    storeDokumen: (id, data) => api.post(`/operator/data-guru/${id}/dokumen`, data, {
        headers: { 'Content-Type': 'multipart/form-data' }
    }),
    updateDokumen: (id, dokumenId, data) => api.post(`/operator/data-guru/${id}/dokumen/${dokumenId}`, data, {
        headers: { 'Content-Type': 'multipart/form-data' }
    }),
    destroyDokumen: (id, dokumenId) => api.delete(`/operator/data-guru/${id}/dokumen/${dokumenId}`),
    verifyDokumen: (id, dokumenId) => api.patch(`/operator/data-guru/${id}/dokumen/${dokumenId}/verify`),
};

// ─── KELAS ───────────────────────────────────────────────────────────────────
export const kelasAPI = {
    getAll: () => api.get('/operator/data-kelas'),
    store: (data) => api.post('/operator/data-kelas/store', data),
    update: (id, data) => api.put(`/operator/data-kelas/${id}`, data),
    destroy: (id) => api.delete(`/operator/data-kelas/${id}`),
    getSiswa: (id) => api.get(`/operator/kelas/${id}/siswa`),
    getPenempatan: () => api.get('/operator/penempatan-siswa'),
    updatePenempatan: (data) => api.post('/operator/penempatan-siswa/update', data),
};

// ─── SEMESTER ────────────────────────────────────────────────────────────────
export const semesterAPI = {
    getAll: () => api.get('/operator/semester'),
    store: (data) => api.post('/operator/semester', data),
    update: (id, data) => api.put(`/operator/semester/${id}`, data),
    destroy: (id) => api.delete(`/operator/semester/${id}`),
    setActive: (id) => api.patch(`/operator/semester/${id}/aktif`),
};

// ─── TAHUN AJARAN ────────────────────────────────────────────────────────────
export const tahunAjaranAPI = {
    getAll: () => api.get('/operator/tahun-ajaran'),
    store: (data) => api.post('/operator/tahun-ajaran', data),
    update: (id, data) => api.put(`/operator/tahun-ajaran/${id}`, data),
    destroy: (id) => api.delete(`/operator/tahun-ajaran/${id}`),
    archive: (id) => api.patch(`/operator/tahun-ajaran/${id}/archive`),
    getKenaikanKelas: () => api.get('/operator/kenaikan-kelas'),
    promoteSiswa: (data) => api.post('/operator/tahun-ajaran/promote', data),
};

// ─── MANAJEMEN USER ──────────────────────────────────────────────────────────
export const userManagementAPI = {
    getAll: () => api.get('/operator/manajemen-akun'),
    store: (data) => api.post('/operator/manajemen-akun/store', data),
    update: (id, data) => api.put(`/operator/manajemen-akun/${id}`, data),
    destroy: (id) => api.delete(`/operator/manajemen-akun/${id}`),
    toggleStatus: (id) => api.patch(`/operator/manajemen-akun/${id}/toggle`),
    resetPassword: (id, data) => api.patch(`/operator/manajemen-akun/${id}/reset-password`, data),
};
