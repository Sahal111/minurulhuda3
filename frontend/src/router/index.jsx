import React from 'react';
import { createBrowserRouter, Navigate } from 'react-router-dom';
import { useAuth } from '../hooks/useAuth';

// Layouts
import PublicLayout from '../components/layouts/PublicLayout';
import DashboardLayout from '../components/layouts/DashboardLayout';

// Auth Pages
import LoginPage from '../pages/auth/LoginPage';
import RegisterPage from '../pages/auth/RegisterPage';

// Public Pages
import HomePage from '../pages/public/HomePage';
import ProfilePage from '../pages/public/ProfilePage';
import ProgramPage from '../pages/public/ProgramPage';
import GalleryPage from '../pages/public/GalleryPage';
import PPDBPage from '../pages/public/PPDBPage';

// Operator Pages
import OperatorDashboardPage from '../pages/operator/DashboardPage';
import OperatorSiswaPage from '../pages/operator/SiswaPage';
import OperatorGuruPage from '../pages/operator/GuruPage';
import OperatorKelasPage from '../pages/operator/KelasPage';
import OperatorOrangTuaPage from '../pages/operator/OrangTuaPage';
import OperatorJadwalPage from '../pages/operator/JadwalPage';
import OperatorTahunAjaranPage from '../pages/operator/TahunAjaranPage';
import OperatorSemesterPage from '../pages/operator/SemesterPage';
import OperatorMataPelajaranPage from '../pages/operator/MataPelajaranPage';
import OperatorPenempatanSiswaPage from '../pages/operator/PenempatanSiswaPage';
import OperatorPengampuMapelPage from '../pages/operator/PengampuMapelPage';
import OperatorKenaikanKelasPage from '../pages/operator/KenaikanKelasPage';
import OperatorManajemenUserPage from '../pages/operator/ManajemenUserPage';
import OperatorManajemenPPDBPage from '../pages/operator/ManajemenPPDBPage';
import OperatorImportPage from '../pages/operator/ImportPage';
import OperatorBackupPage from '../pages/operator/BackupPage';
import OperatorSettingPage from '../pages/operator/SettingPage';
import OperatorAuditLogPage from '../pages/operator/AuditLogPage';
import OperatorIntegrasiSistemPage from '../pages/operator/IntegrasiSistemPage';

// Guru Pages
import GuruDashboardPage from '../pages/guru/DashboardPage';
import GuruJadwalPage from '../pages/guru/JadwalPage';
import GuruAbsensiPage from '../pages/guru/AbsensiPage';
import GuruNilaiPage from '../pages/guru/NilaiPage';
import GuruRaporPage from '../pages/guru/RaporPage';
import GuruSiswaPage from '../pages/guru/SiswaPage';
import GuruSettingPage from '../pages/guru/SettingPage';

// Kepsek Pages
import KepsekDashboardPage from '../pages/kepsek/DashboardPage';
import KepsekGuruPage from '../pages/kepsek/GuruPage';
import KepsekSiswaPage from '../pages/kepsek/SiswaPage';
import KepsekLaporanAkademikPage from '../pages/kepsek/LaporanAkademikPage';
import KepsekLaporanKinerjaPage from '../pages/kepsek/LaporanKinerjaPage';
import KepsekMonitoringPage from '../pages/kepsek/MonitoringPage';
import KepsekSettingPage from '../pages/kepsek/SettingPage';

// Ortu Pages
import OrtuDashboardPage from '../pages/ortu/DashboardPage';
import OrtuAnakPage from '../pages/ortu/AnakPage';
import OrtuNilaiPage from '../pages/ortu/NilaiPage';
import OrtuAbsensiPage from '../pages/ortu/AbsensiPage';
import OrtuPembayaranPage from '../pages/ortu/PembayaranPage';
import OrtuSettingPage from '../pages/ortu/SettingPage';

// Protected Route Component
const ProtectedRoute = ({ children, allowedRoles }) => {
    const { user, loading } = useAuth();

    if (loading) {
        return (
            <div className="flex min-h-screen items-center justify-center">
                <div className="w-8 h-8 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        );
    }

    if (!user) {
        return <Navigate to="/login" replace />;
    }

    if (allowedRoles && !allowedRoles.includes(user.role)) {
        return <Navigate to={`/${user.role}/dashboard`} replace />;
    }

    return children;
};

// Public Route Component (redirects to dashboard if already logged in)
const PublicRoute = ({ children }) => {
    const { user, loading } = useAuth();

    if (loading) {
        return (
            <div className="flex min-h-screen items-center justify-center">
                <div className="w-8 h-8 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        );
    }

    if (user) {
        return <Navigate to={`/${user.role}/dashboard`} replace />;
    }

    return children;
};

export const router = createBrowserRouter([
    // ============ PUBLIC ROUTES (dengan Navbar & Footer) ============
    {
        element: <PublicLayout />,
        children: [
            { path: '/', element: <HomePage /> },
            { path: '/profile', element: <ProfilePage /> },
            { path: '/program', element: <ProgramPage /> },
            { path: '/gallery', element: <GalleryPage /> },
            { path: '/ppdb', element: <PPDBPage /> },
        ]
    },

    // ============ AUTH ROUTES ============
    {
        path: '/login',
        element: (
            <PublicRoute>
                <LoginPage />
            </PublicRoute>
        )
    },
    {
        path: '/register',
        element: (
            <PublicRoute>
                <RegisterPage />
            </PublicRoute>
        )
    },

    // ============ OPERATOR ROUTES ============
    {
        path: '/operator',
        element: (
            <ProtectedRoute allowedRoles={['operator']}>
                <DashboardLayout />
            </ProtectedRoute>
        ),
        children: [
            { index: true, element: <Navigate to="dashboard" replace /> },
            { path: 'dashboard', element: <OperatorDashboardPage /> },
            { path: 'siswa', element: <OperatorSiswaPage /> },
            { path: 'guru', element: <OperatorGuruPage /> },
            { path: 'kelas', element: <OperatorKelasPage /> },
            { path: 'ortu', element: <OperatorOrangTuaPage /> },
            { path: 'mapel', element: <OperatorMataPelajaranPage /> },
            { path: 'jadwal', element: <OperatorJadwalPage /> },
            { path: 'tahun-ajaran', element: <OperatorTahunAjaranPage /> },
            { path: 'semester', element: <OperatorSemesterPage /> },
            { path: 'penempatan', element: <OperatorPenempatanSiswaPage /> },
            { path: 'pengampu', element: <OperatorPengampuMapelPage /> },
            { path: 'kenaikan-kelas', element: <OperatorKenaikanKelasPage /> },
            { path: 'manajemen-user', element: <OperatorManajemenUserPage /> },
            { path: 'manajemen-ppdb', element: <OperatorManajemenPPDBPage /> },
            { path: 'import', element: <OperatorImportPage /> },
            { path: 'backup', element: <OperatorBackupPage /> },
            { path: 'setting', element: <OperatorSettingPage /> },
            { path: 'audit-log', element: <OperatorAuditLogPage /> },
            { path: 'integrasi', element: <OperatorIntegrasiSistemPage /> },
        ]
    },

    // ============ GURU ROUTES ============
    {
        path: '/guru',
        element: (
            <ProtectedRoute allowedRoles={['guru']}>
                <DashboardLayout />
            </ProtectedRoute>
        ),
        children: [
            { index: true, element: <Navigate to="dashboard" replace /> },
            { path: 'dashboard', element: <GuruDashboardPage /> },
            { path: 'jadwal', element: <GuruJadwalPage /> },
            { path: 'absensi', element: <GuruAbsensiPage /> },
            { path: 'nilai', element: <GuruNilaiPage /> },
            { path: 'rapor', element: <GuruRaporPage /> },
            { path: 'siswa', element: <GuruSiswaPage /> },
            { path: 'setting', element: <GuruSettingPage /> },
        ]
    },

    // ============ KEPSEK ROUTES ============
    {
        path: '/kepsek',
        element: (
            <ProtectedRoute allowedRoles={['kepsek']}>
                <DashboardLayout />
            </ProtectedRoute>
        ),
        children: [
            { index: true, element: <Navigate to="dashboard" replace /> },
            { path: 'dashboard', element: <KepsekDashboardPage /> },
            { path: 'guru', element: <KepsekGuruPage /> },
            { path: 'siswa', element: <KepsekSiswaPage /> },
            { path: 'laporan-akademik', element: <KepsekLaporanAkademikPage /> },
            { path: 'laporan-kinerja', element: <KepsekLaporanKinerjaPage /> },
            { path: 'monitoring', element: <KepsekMonitoringPage /> },
            { path: 'setting', element: <KepsekSettingPage /> },
        ]
    },

    // ============ ORTU ROUTES ============
    {
        path: '/ortu',
        element: (
            <ProtectedRoute allowedRoles={['ortu']}>
                <DashboardLayout />
            </ProtectedRoute>
        ),
        children: [
            { index: true, element: <Navigate to="dashboard" replace /> },
            { path: 'dashboard', element: <OrtuDashboardPage /> },
            { path: 'anak', element: <OrtuAnakPage /> },
            { path: 'nilai', element: <OrtuNilaiPage /> },
            { path: 'absensi', element: <OrtuAbsensiPage /> },
            { path: 'pembayaran', element: <OrtuPembayaranPage /> },
            { path: 'setting', element: <OrtuSettingPage /> },
        ]
    },

    // ============ CATCH ALL ============
    {
        path: '*',
        element: <Navigate to="/" replace />
    }
]);
