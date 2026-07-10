import React, { useState } from 'react';
import { Outlet } from 'react-router-dom';
import OperatorSidebar from './OperatorSidebar';
import { useAuth } from '../../hooks/useAuth';
import { Menu, LogOut, Moon, Sun, ChevronRight } from 'lucide-react';

const DashboardLayout = () => {
    const { user, logout } = useAuth();
    const [sidebarOpen, setSidebarOpen] = useState(false);
    const [sidebarCollapsed, setSidebarCollapsed] = useState(false);
    const [isDarkMode, setIsDarkMode] = useState(false); // Could be handled by context later

    return (
        <div className={`min-h-screen flex flex-col bg-slate-50 text-slate-800 transition-colors duration-300 ${isDarkMode ? 'dark bg-slate-950 text-slate-100' : ''}`}>
            
            {/* Sidebar Component */}
            <OperatorSidebar 
                sidebarOpen={sidebarOpen} 
                setSidebarOpen={setSidebarOpen} 
                sidebarCollapsed={sidebarCollapsed} 
            />

            {/* Main Content Area */}
            <div className={`flex-1 flex flex-col min-w-0 transition-all duration-300 ease-in-out ${sidebarCollapsed ? 'lg:pl-20' : 'lg:pl-72'}`}>
                
                {/* Header */}
                <header className="sticky top-0 z-30 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
                    <div className="flex items-center justify-between px-4 sm:px-6 h-16">
                        <div className="flex items-center gap-4">
                            {/* Mobile menu button */}
                            <button 
                                onClick={() => setSidebarOpen(true)}
                                className="p-2 -ml-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl lg:hidden"
                            >
                                <Menu className="w-5 h-5" />
                            </button>

                            {/* Desktop collapse button */}
                            <button 
                                onClick={() => setSidebarCollapsed(!sidebarCollapsed)}
                                className="hidden lg:flex p-2 -ml-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-transform"
                            >
                                <Menu className="w-5 h-5" />
                            </button>

                            {/* Breadcrumbs (Optional/Dynamic) */}
                            <div className="hidden sm:flex items-center gap-2 text-sm text-slate-500 font-medium">
                                <span>Dashboard</span>
                                <ChevronRight className="w-4 h-4" />
                                <span className="text-slate-800 dark:text-slate-200">Data Siswa</span>
                            </div>
                        </div>

                        <div className="flex items-center gap-3">
                            <button 
                                onClick={() => setIsDarkMode(!isDarkMode)}
                                className="p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-colors"
                            >
                                {isDarkMode ? <Sun className="w-5 h-5" /> : <Moon className="w-5 h-5" />}
                            </button>
                            
                            <div className="h-8 w-px bg-slate-200 dark:bg-slate-700 mx-1"></div>
                            
                            <div className="flex items-center gap-3 pl-1 cursor-pointer hover:opacity-80 transition-opacity">
                                <div className="hidden sm:block text-right">
                                    <p className="text-sm font-semibold text-slate-700 dark:text-slate-200 leading-none mb-1">{user?.name}</p>
                                    <p className="text-[10px] text-slate-500 font-medium uppercase tracking-wider">{user?.role}</p>
                                </div>
                                <div className="w-9 h-9 rounded-full bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center text-emerald-600 dark:text-emerald-400 font-bold border-2 border-white dark:border-slate-800 shadow-sm">
                                    {user?.name?.charAt(0) || 'U'}
                                </div>
                            </div>
                            
                            <button 
                                onClick={logout}
                                className="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-colors ml-2"
                                title="Logout"
                            >
                                <LogOut className="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                </header>

                {/* Main Page Content */}
                <main className="flex-1 p-4 sm:p-6 lg:p-8">
                    <Outlet />
                </main>
            </div>
        </div>
    );
};

export default DashboardLayout;
