import React from 'react';
import { NavLink } from 'react-router-dom';
import {
    LayoutDashboard, DollarSign, FileText, Settings, Receipt
} from 'lucide-react';

const BendaharaSidebar = ({ sidebarOpen, setSidebarOpen, sidebarCollapsed }) => {
    const linkClasses = ({ isActive }) =>
        `flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group ${
            isActive
                ? 'bg-emerald-600 text-white shadow-md'
                : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white'
        }`;

    return (
        <>
            {sidebarOpen && (
                <div className="fixed inset-0 bg-black/50 z-40 lg:hidden" onClick={() => setSidebarOpen(false)} />
            )}
            <aside className={`fixed top-0 left-0 h-full bg-emerald-900 text-white z-50 transition-all duration-300 ease-in-out overflow-hidden flex flex-col shadow-2xl ${
                sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
            } ${sidebarCollapsed ? 'w-20' : 'w-72'}`}>
                <div className="p-6 flex items-center gap-4 border-b border-emerald-800">
                    <div className="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg shrink-0">
                        <span className="text-emerald-800 font-bold text-xl">NH</span>
                    </div>
                    {!sidebarCollapsed && (
                        <div className="truncate">
                            <h1 className="font-bold text-sm leading-tight">MI Nurul Huda 3</h1>
                            <p className="text-[10px] text-emerald-300 uppercase tracking-widest">Bendahara</p>
                        </div>
                    )}
                </div>
                <nav className="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                    {!sidebarCollapsed && (
                        <p className="px-4 text-[10px] font-semibold text-emerald-400 uppercase tracking-widest mb-2 mt-2">Dashboard</p>
                    )}
                    <NavLink to="/bendahara/dashboard" className={linkClasses}>
                        <LayoutDashboard className="w-5 h-5 shrink-0" />
                        {!sidebarCollapsed && <span className="font-medium text-sm">Dashboard</span>}
                    </NavLink>
                    {!sidebarCollapsed && (
                        <p className="px-4 text-[10px] font-semibold text-emerald-400 uppercase tracking-widest mb-2 mt-6">Keuangan</p>
                    )}
                    <NavLink to="/bendahara/tagihan" className={linkClasses}>
                        <Receipt className="w-5 h-5 shrink-0" />
                        {!sidebarCollapsed && <span className="font-medium text-sm">Tagihan</span>}
                    </NavLink>
                    <NavLink to="/bendahara/pembayaran" className={linkClasses}>
                        <DollarSign className="w-5 h-5 shrink-0" />
                        {!sidebarCollapsed && <span className="font-medium text-sm">Pembayaran</span>}
                    </NavLink>
                    <NavLink to="/bendahara/laporan" className={linkClasses}>
                        <FileText className="w-5 h-5 shrink-0" />
                        {!sidebarCollapsed && <span className="font-medium text-sm">Laporan</span>}
                    </NavLink>
                    {!sidebarCollapsed && <div className="border-t border-emerald-800 my-4"></div>}
                    <NavLink to="/bendahara/setting" className={linkClasses}>
                        <Settings className="w-5 h-5 shrink-0" />
                        {!sidebarCollapsed && <span className="font-medium text-sm">Pengaturan</span>}
                    </NavLink>
                </nav>
            </aside>
        </>
    );
};

export default BendaharaSidebar;
