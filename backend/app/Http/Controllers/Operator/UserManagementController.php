<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{
    /* ======================================================
       INDEX
    ====================================================== */

    public function index()
    {
        $users = User::with('roles')->latest()->get();

        return response()->json([
            'users' => $users,
            'totalUsers' => User::count(),
            'activeUsers' => User::where('is_active', true)->count(),
            'inactiveUsers' => User::where('is_active', false)->count(),
        ]);
    }

    /* ======================================================
       STORE (REDIRECT VERSION - PRODUCTION SAFE)
    ====================================================== */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|exists:roles,name',
            'nip' => 'nullable|string',
            'extra_info' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'], // auto hashed via model cast
            ]);

            $role = Role::where('name', $validated['role'])->first();
            $user->roles()->sync([$role->id]);

            $this->handleRoleProfile($user, $validated);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Akun berhasil dibuat!', 'data' => $user], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()], 500);
        }
    }

    /* ======================================================
       UPDATE (REDIRECT VERSION)
    ====================================================== */

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|exists:roles,name',
            'nip' => 'nullable|string',
            'extra_info' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $user = User::findOrFail($id);
            $oldRole = $user->roles->first()?->name;

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            $role = Role::where('name', $validated['role'])->first();
            $user->roles()->sync([$role->id]);

            if ($oldRole !== $validated['role']) {
                $this->deleteAllProfiles($user);
            }

            $this->handleRoleProfile($user, $validated);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui.']);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()], 500);
        }
    }

    /* ======================================================
       RESET PASSWORD (REDIRECT)
    ====================================================== */

    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'password' => $request->password
        ]);

        return response()->json(['success' => true, 'message' => 'Password berhasil direset.']);
    }

    /* ======================================================
       TOGGLE STATUS (AJAX ONLY)
    ====================================================== */

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // 🚫 Proteksi agar tidak bisa nonaktifkan diri sendiri
        if ($user->id === auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Tidak bisa menonaktifkan akun sendiri.'], 403);
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        return response()->json(['success' => true, 'message' => 'Status akun berhasil diperbarui.', 'is_active' => $user->is_active]);
    }

    /* ======================================================
       DELETE (REDIRECT VERSION)
    ====================================================== */

    public function destroy($id)
    {
        try {

            $user = User::findOrFail($id);

            $this->deleteAllProfiles($user);

            $user->roles()->detach();
            $user->delete();

            return response()->json(['success' => true, 'message' => 'User berhasil dihapus.']);

        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => 'Gagal menghapus user.'], 500);
        }
    }

    /* ======================================================
       PRIVATE HELPERS
    ====================================================== */

    private function handleRoleProfile($user, $data)
    {
        if (in_array($data['role'], ['guru', 'wali_kelas'])) {

            $user->guru()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nip' => $data['nip'] ?? null,
                    'extra_info' => $data['extra_info'] ?? null
                ]
            );
        }

        if ($data['role'] === 'bendahara') {

            $user->bendahara()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'jenis_bendahara' => $data['extra_info'] ?? null
                ]
            );
        }

        if ($data['role'] === 'admin_ppdb') {

            $user->adminPpdb()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'tahun_ajaran' => $data['extra_info'] ?? null
                ]
            );
        }
    }

    private function deleteAllProfiles($user)
    {
        $user->guru()->delete();
        $user->bendahara()->delete();
        $user->adminPpdb()->delete();
    }
}