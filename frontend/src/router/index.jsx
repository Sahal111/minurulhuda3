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

// Dashboard Pages
import DashboardPage from '../pages/operator/DashboardPage'; // Assuming DashboardPage was moved to operator/ or is just DashboardPage

// Operator Pages
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
            { path: 'dashboard', element: <DashboardPage /> },
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

    // ============ CATCH ALL ============
    {
        path: '*',
        element: <Navigate to="/" replace />
    }
]);
