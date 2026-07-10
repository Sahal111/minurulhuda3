import React, { createContext, useState, useEffect } from 'react';
import api from '../api/axios';

export const AuthContext = createContext();

const normalizeRole = (role) => {
    const map = {
        wali_kelas: 'wali-kelas',
        admin_ppdb: 'admin-ppdb',
    };
    return map[role] || role;
};

const normalizeUser = (u) => {
    if (!u) return null;
    return {
        ...u,
        role: normalizeRole(u.role),
        roles: u.roles?.map(normalizeRole) || [normalizeRole(u.role)],
    };
};

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const checkAuth = async () => {
            const token = localStorage.getItem('auth_token');
            if (token) {
                try {
                    const response = await api.get('/user');
                    setUser(normalizeUser(response.data));
                } catch (error) {
                    console.error("Auth check failed:", error);
                    localStorage.removeItem('auth_token');
                }
            }
            setLoading(false);
        };

        checkAuth();
    }, []);

    const login = async (credentials) => {
        const response = await api.post('/auth/login', credentials);
        if (response.data.token) {
            localStorage.setItem('auth_token', response.data.token);
            setUser(normalizeUser(response.data.user));
        }
        return {
            ...response.data,
            user: normalizeUser(response.data.user),
        };
    };

    const logout = async () => {
        try {
            await api.post('/auth/logout');
        } catch (error) {
            console.error("Logout failed:", error);
        } finally {
            localStorage.removeItem('auth_token');
            setUser(null);
        }
    };

    const switchRole = (newRole) => {
        if (!user) return;
        setUser((prev) => ({ ...prev, role: newRole }));
    };

    return (
        <AuthContext.Provider value={{ user, login, logout, loading, switchRole }}>
            {children}
        </AuthContext.Provider>
    );
};
