import React, { useState } from 'react';
import { NavLink } from 'react-router-dom';
import { 
    LayoutDashboard, Database, Users, UserCheck, Home, BookOpen, Users2, 
    Settings2, ChevronDown, Calendar, CalendarDays, ArrowRightLeft, UserCog, 
    TrendingUp, UserPlus, FileUp, Save, Settings, ScrollText, Link
} from 'lucide-react';

const OperatorSidebar = ({ sidebarOpen, setSidebarOpen, sidebarCollapsed }) => {
    const [submenus, setSubmenus] = useState({ 
        masterData: false, 
        akademik: false,
        manajemen: false,
        sistem: false
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
            {/* Mobile overlay */}
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
                            <p className="text-[10px] text-emerald-300 uppercase tracking-widest">Operator Portal</p>
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
                        to="/operator/dashboard"
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
                            onClick={() => toggleSubmenu('masterData')}
                            className="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-800/50 rounded-2xl transition-all text-emerald-100/80 hover:text-white group"
                        >
                            <Database className="w-5 h-5 shrink-0" />
                            {!sidebarCollapsed && (
                                <>
                                    <span className="text-sm flex-1 text-left">Master Data</span>
                                    <ChevronDown
                                        className={`w-4 h-4 transition-transform ${
                                            submenus.masterData ? 'rotate-180' : ''
                                        }`}
                                    />
                                </>
                            )}
                        </button>

                        {submenus.masterData && !sidebarCollapsed && (
                            <div className="pl-6 space-y-1 mt-1">
                                <NavLink to="/operator/siswa" className={linkClasses}>
                                    <Users className="w-4 h-4" /> Data Siswa
                                </NavLink>
                                <NavLink to="/operator/guru" className={linkClasses}>
                                    <UserCheck className="w-4 h-4" /> Data Guru
                                </NavLink>
                                <NavLink to="/operator/kelas" className={linkClasses}>
                                    <Home className="w-4 h-4" /> Data Kelas
                                </NavLink>
                                <NavLink to="/operator/mapel" className={linkClasses}>
                                    <BookOpen className="w-4 h-4" /> Mata Pelajaran
                                </NavLink>
                                <NavLink to="/operator/ortu" className={linkClasses}>
                                    <Users2 className="w-4 h-4" /> Orang Tua/Wali
                                </NavLink>
                            </div>
                        )}
                    </div>

                    <div className="space-y-1">
                        <button
                            type="button"
                            onClick={() => toggleSubmenu('akademik')}
                            className="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-800/50 rounded-2xl transition-all text-emerald-100/80 hover:text-white group"
                        >
                            <Settings2 className="w-5 h-5 shrink-0" />
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
                                <NavLink to="/operator/jadwal" className={linkClasses}>
                                    <Calendar className="w-4 h-4" /> Jadwal Pelajaran
                                </NavLink>
                                <NavLink to="/operator/tahun-ajaran" className={linkClasses}>
                                    <CalendarDays className="w-4 h-4" /> Tahun Ajaran
                                </NavLink>
                                <NavLink to="/operator/semester" className={linkClasses}>
                                    <CalendarDays className="w-4 h-4" /> Semester
                                </NavLink>
                                <NavLink to="/operator/penempatan" className={linkClasses}>
                                    <ArrowRightLeft className="w-4 h-4" /> Penempatan Siswa
                                </NavLink>
                                <NavLink to="/operator/pengampu" className={linkClasses}>
                                    <UserCog className="w-4 h-4" /> Guru Pengampu
                                </NavLink>
                                <NavLink to="/operator/kenaikan-kelas" className={linkClasses}>
                                    <TrendingUp className="w-4 h-4" /> Kenaikan Kelas
                                </NavLink>
                            </div>
                        )}
                    </div>

                    <div className="space-y-1">
                        <button
                            type="button"
                            onClick={() => toggleSubmenu('manajemen')}
                            className="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-800/50 rounded-2xl transition-all text-emerald-100/80 hover:text-white group"
                        >
                            <UserPlus className="w-5 h-5 shrink-0" />
                            {!sidebarCollapsed && (
                                <>
                                    <span className="text-sm flex-1 text-left">Manajemen</span>
                                    <ChevronDown
                                        className={`w-4 h-4 transition-transform ${
                                            submenus.manajemen ? 'rotate-180' : ''
                                        }`}
                                    />
                                </>
                            )}
                        </button>

                        {submenus.manajemen && !sidebarCollapsed && (
                            <div className="pl-6 space-y-1 mt-1">
                                <NavLink to="/operator/manajemen-user" className={linkClasses}>
                                    <UserCog className="w-4 h-4" /> Manajemen User
                                </NavLink>
                                <NavLink to="/operator/manajemen-ppdb" className={linkClasses}>
                                    <UserPlus className="w-4 h-4" /> Manajemen PPDB
                                </NavLink>
                            </div>
                        )}
                    </div>

                    <div className="space-y-1">
                        <button
                            type="button"
                            onClick={() => toggleSubmenu('sistem')}
                            className="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-800/50 rounded-2xl transition-all text-emerald-100/80 hover:text-white group"
                        >
                            <Settings className="w-5 h-5 shrink-0" />
                            {!sidebarCollapsed && (
                                <>
                                    <span className="text-sm flex-1 text-left">Sistem</span>
                                    <ChevronDown
                                        className={`w-4 h-4 transition-transform ${
                                            submenus.sistem ? 'rotate-180' : ''
                                        }`}
                                    />
                                </>
                            )}
                        </button>

                        {submenus.sistem && !sidebarCollapsed && (
                            <div className="pl-6 space-y-1 mt-1">
                                <NavLink to="/operator/import" className={linkClasses}>
                                    <FileUp className="w-4 h-4" /> Import Data
                                </NavLink>
                                <NavLink to="/operator/backup" className={linkClasses}>
                                    <Save className="w-4 h-4" /> Backup System
                                </NavLink>
                                <NavLink to="/operator/audit-log" className={linkClasses}>
                                    <ScrollText className="w-4 h-4" /> Audit Log
                                </NavLink>
                                <NavLink to="/operator/integrasi" className={linkClasses}>
                                    <Link className="w-4 h-4" /> Integrasi Sistem
                                </NavLink>
                                <NavLink to="/operator/setting" className={linkClasses}>
                                    <Settings className="w-4 h-4" /> Pengaturan
                                </NavLink>
                            </div>
                        )}
                    </div>
                </nav>
            </aside>
        </>
    );
};

export default OperatorSidebar;
