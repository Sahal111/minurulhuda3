import React, { useState } from 'react';
import { NavLink } from 'react-router-dom';
import {
    LayoutDashboard, BookOpen, Users, ClipboardCheck, UserCheck,
    FileText, ChevronDown, Settings
} from 'lucide-react';

const GuruSidebar = ({ sidebarOpen, setSidebarOpen, sidebarCollapsed }) => {
    const [submenus, setSubmenus] = useState({
        akademik: false,
        penilaian: false,
    });

    const toggleSubmenu = (menu) => {
        setSubmenus((prev) => ({ ...prev, [menu]: !prev[menu] }));
    };

    const linkClasses = ({ isActive }) =>
        `flex items-center gap-2 py-2 text-xs ${
            isActive ? 'text-white font-medium bg-emerald-800/30 px-3 rounded-xl' : 'text-emerald-200/70 hover:text-white px-3'
        }`;

    return (
        <>
            {sidebarOpen && (
                <div
                    className="fixed inset-0 bg-black/50 z-40 lg:hidden"
                    onClick={() => setSidebarOpen(false)}
                />
            )}

            <aside
                className={`fixed top-0 left-0 h-full bg-emerald-900 text-white z-50 transition-all duration-300 ease-in-out overflow-hidden flex flex-col shadow-2xl ${
                    sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
                } ${sidebarCollapsed ? 'w-20' : 'w-72'}`}
            >
                <div className="p-6 flex items-center gap-4 border-b border-emerald-800">
                    <div className="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg shrink-0">
                        <span className="text-emerald-800 font-bold text-xl">NH</span>
                    </div>
                    {!sidebarCollapsed && (
                        <div className="truncate transition-opacity duration-300">
                            <h1 className="font-bold text-sm leading-tight">MI Nurul Huda 3</h1>
                            <p className="text-[10px] text-emerald-300 uppercase tracking-widest">Guru Portal</p>
                        </div>
                    )}
                </div>

                <nav className="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                    {!sidebarCollapsed && (
                        <p className="px-4 text-[10px] font-semibold text-emerald-400 uppercase tracking-widest mb-2 mt-2">
                            Dashboard
                        </p>
                    )}

                    <NavLink
                        to="/guru/dashboard"
                        className={({ isActive }) =>
                            `flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group ${
                                isActive
                                    ? 'bg-emerald-600 text-white shadow-md'
                                    : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white'
                            }`
                        }
                    >
                        <LayoutDashboard className="w-5 h-5 shrink-0" />
                        {!sidebarCollapsed && <span className="font-medium text-sm">Dashboard</span>}
                    </NavLink>

                    {!sidebarCollapsed && (
                        <p className="px-4 text-[10px] font-semibold text-emerald-400 uppercase tracking-widest mb-2 mt-6">
                            Main Menu
                        </p>
                    )}

                    <div className="space-y-1">
                        <button
                            type="button"
                            onClick={() => toggleSubmenu('akademik')}
                            className="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-800/50 rounded-2xl transition-all text-emerald-100/80 hover:text-white group"
                        >
                            <BookOpen className="w-5 h-5 shrink-0" />
                            {!sidebarCollapsed && (
                                <>
                                    <span className="text-sm flex-1 text-left">Akademik</span>
                                    <ChevronDown
                                        className={`w-4 h-4 transition-transform ${
                                            submenus.akademik ? 'rotate-180' : ''
                                        }`}
                                    />
                                </>
                            )}
                        </button>

                        {submenus.akademik && !sidebarCollapsed && (
                            <div className="pl-6 space-y-1 mt-1">
                                <NavLink to="/guru/jadwal" className={linkClasses}>
                                    <ClipboardCheck className="w-4 h-4" /> Jadwal Mengajar
                                </NavLink>
                                <NavLink to="/guru/absensi" className={linkClasses}>
                                    <UserCheck className="w-4 h-4" /> Absensi Siswa
                                </NavLink>
                            </div>
                        )}
                    </div>

                    <div className="space-y-1">
                        <button
                            type="button"
                            onClick={() => toggleSubmenu('penilaian')}
                            className="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-800/50 rounded-2xl transition-all text-emerald-100/80 hover:text-white group"
                        >
                            <ClipboardCheck className="w-5 h-5 shrink-0" />
                            {!sidebarCollapsed && (
                                <>
                                    <span className="text-sm flex-1 text-left">Penilaian</span>
                                    <ChevronDown
                                        className={`w-4 h-4 transition-transform ${
                                            submenus.penilaian ? 'rotate-180' : ''
                                        }`}
                                    />
                                </>
                            )}
                        </button>

                        {submenus.penilaian && !sidebarCollapsed && (
                            <div className="pl-6 space-y-1 mt-1">
                                <NavLink to="/guru/nilai" className={linkClasses}>
                                    <FileText className="w-4 h-4" /> Input Nilai
                                </NavLink>
                                <NavLink to="/guru/rapor" className={linkClasses}>
                                    <FileText className="w-4 h-4" /> Rapor Siswa
                                </NavLink>
                            </div>
                        )}
                    </div>

                    <NavLink
                        to="/guru/siswa"
                        className={({ isActive }) =>
                            `flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group ${
                                isActive
                                    ? 'bg-emerald-600 text-white shadow-md'
                                    : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white'
                            }`
                        }
                    >
                        <Users className="w-5 h-5 shrink-0" />
                        {!sidebarCollapsed && <span className="font-medium text-sm">Data Siswa</span>}
                    </NavLink>

                    {!sidebarCollapsed && <div className="border-t border-emerald-800 my-4"></div>}

                    <NavLink
                        to="/guru/setting"
                        className={({ isActive }) =>
                            `flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group ${
                                isActive
                                    ? 'bg-emerald-600 text-white shadow-md'
                                    : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white'
                            }`
                        }
                    >
                        <Settings className="w-5 h-5 shrink-0" />
                        {!sidebarCollapsed && <span className="font-medium text-sm">Pengaturan</span>}
                    </NavLink>
                </nav>
            </aside>
        </>
    );
};

export default GuruSidebar;
