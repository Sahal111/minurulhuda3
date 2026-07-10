<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    // =========================
    // HALAMAN LIST USER
    // =========================
    public function index(Request $r)
    {
        $query = User::query();

        // Filter role
        if ($r->role) {
            $query->where('role', $r->role);
        }

        // Search nama/email
        if ($r->search) {
            $query->where(function ($q) use ($r) {
                $q->where('name', 'like', "%{$r->search}%")
                    ->orWhere('email', 'like', "%{$r->search}%");
            });
        }

        $users = $query->latest()->paginate(10);

        return view('admin.guru', compact('users'));
    }

    // =========================
    // TAMBAH GURU BARU
    // =========================
    public function storeGuru(Request $r)
    {
        $r->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'nip' => 'required|unique:users,nip',
            'password' => 'nullable|min:6'
        ]);

        User::create([
            'name' => $r->name,
            'email' => $r->email,
            'nip' => $r->nip,
            'role' => 'guru',

            // kalau admin gak isi password → default aman
            'password' => Hash::make(
                $r->password ?: 'guru123'
            )
        ]);

        return back()->with('success', 'Guru berhasil ditambahkan');
    }

    // =========================
    // HAPUS USER (AMAN)
    // =========================
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        // 🔐 PENTING: Admin tidak boleh hapus dirinya sendiri
        if ($user->id == Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri');
        }

        // 🔐 Jangan hapus admin utama (opsional)
        if ($user->role == 'admin' && $user->id == 1) {
            return back()->with('error', 'Admin utama tidak boleh dihapus');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }
}