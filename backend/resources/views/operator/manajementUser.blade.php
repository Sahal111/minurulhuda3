@extends('layouts.operator')

@section('content')
    <!-- Page Body -->
    <main x-data="userPanel()" class="flex-1 p-6 space-y-6">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-4">

            <div
                class="group relative overflow-hidden rounded-2xl bg-white border border-slate-100 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-500/10">
                <div
                    class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-blue-50/50 transition-transform duration-500 group-hover:scale-150">
                </div>

                <div class="relative">
                    <div class="flex items-center justify-between">
                        @php
                            $percentActive = $totalUsers > 0 ? ($activeUsers / $totalUsers) * 100 : 0;
                            $percentInactive = $totalUsers > 0 ? ($inactiveUsers / $totalUsers) * 100 : 0;
                        @endphp
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 shadow-lg shadow-blue-200">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total</span>
                            <span class="text-2xl font-black text-slate-800">{{ $totalUsers }}</span>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-sm font-semibold text-slate-500">Total Pengguna</h3>
                        <div class="mt-2 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full w-full bg-blue-500"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="group relative overflow-hidden rounded-2xl bg-white border border-slate-100 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-emerald-500/10">
                <div
                    class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-emerald-50/50 transition-transform duration-500 group-hover:scale-150">
                </div>

                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500 shadow-lg shadow-emerald-200">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Aktif</span>
                            <span class="text-2xl font-black text-slate-800">{{ $activeUsers }}</span>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-sm font-semibold text-slate-500">Akun Aktif</h3>
                        <div class="mt-2 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full bg-emerald-500" style="width: {{ $percentActive }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="group relative overflow-hidden rounded-2xl bg-white border border-slate-100 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-rose-500/10">
                <div
                    class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-rose-50/50 transition-transform duration-500 group-hover:scale-150">
                </div>

                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-500 shadow-lg shadow-rose-200">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Nonaktif</span>
                            <span class="text-2xl font-black text-slate-800">{{ $inactiveUsers }}</span>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-sm font-semibold text-slate-500">Akun Dinonaktifkan</h3>
                        <div class="mt-2 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full bg-rose-500" style="width: {{ $percentInactive }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative flex flex-col justify-between overflow-hidden rounded-2xl bg-slate-900 p-6 shadow-xl transition-all duration-300">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-blue-500/20 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 h-24 w-24 rounded-full bg-indigo-500/20 blur-2xl">
                </div>

                <div class="relative flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xl">
                        👋
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Halo, Admin</h3>
                        <p class="text-[11px] text-slate-400 uppercase tracking-widest">Operator Panel</p>
                    </div>
                </div>

                <div class="relative mt-4">
                    <p class="text-xs leading-relaxed text-slate-300">
                        <span class="font-bold text-blue-400">Tips:</span> Pastikan sinkronisasi data guru selesai
                        sebelum periode PPDB dimulai.
                    </p>
                </div>

                <div
                    class="relative mt-4 flex items-center justify-between border-t border-white/10 pt-4 text-[10px] font-medium text-slate-500">
                    <span class="flex items-center gap-1">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        MI Nurul Huda 3
                    </span>
                    <span class="bg-white/5 px-2 py-1 rounded text-slate-400">23 Feb 2026</span>
                </div>
            </div>

        </div>
        <!-- Table Section -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <!-- Table Header -->
            <div
                class="px-6 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100">
                <div>
                    <h3 class="font-lexend font-bold text-lg text-slate-800">Daftar Akun Pengguna</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Kelola akses dan peran semua pengguna sistem</p>
                </div>
                <div class="flex items-center gap-3 flex-wrap">
                    <!-- Role Filter -->
                    <select id="roleFilter" onchange="filterByRole()"
                        class="text-sm border border-slate-200 rounded-2xl px-4 py-2.5 text-slate-600 bg-slate-50 outline-none focus:border-emerald-400 transition-colors">
                        <option value="">Semua Role</option>
                        <option value="admin">Admin</option>
                        <option value="operator">Operator</option>
                        <option value="guru">Guru</option>
                        <option value="wali">Wali Murid</option>
                    </select>
                    <!-- Add Button -->
                    <button @click="showTambahModal = true"
                        class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-5 py-2.5 rounded-2xl transition-colors shadow-sm shadow-emerald-200">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        <span>Tambah Akun</span>
                    </button>
                </div>
            </div>

            <!-- Mobile search -->
            <div class="md:hidden px-6 py-3 border-b border-slate-100">
                <div class="flex items-center gap-2 bg-slate-50 rounded-2xl px-4 py-2.5">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                    <input type="text" id="search-user-mobile" placeholder="Cari akun..."
                        class="bg-transparent text-sm text-slate-600 outline-none w-full placeholder:text-slate-400"
                        oninput="filterTableMobile()">
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                            <th class="text-left px-6 py-4 font-semibold">Pengguna</th>
                            <th class="text-left px-6 py-4 font-semibold hidden md:table-cell">Email</th>
                            <th class="text-left px-6 py-4 font-semibold">Role</th>
                            <th class="text-left px-6 py-4 font-semibold hidden lg:table-cell">Login Terakhir</th>
                            <th class="text-left px-6 py-4 font-semibold">Status</th>
                            <th class="text-left px-6 py-4 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-user" class="divide-y divide-slate-50">

                        @foreach ($users as $user)
                            @php
                                $role = $user->primaryRole()?->name;
                            @endphp

                            <tr class="hover:bg-slate-50/70 transition-colors group" data-role="{{ $role }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="
                w-9 h-9 rounded-2xl flex items-center justify-center 
                font-bold text-sm shrink-0
                @if ($role == 'admin') bg-purple-100 text-purple-600
                @elseif($role == 'operator') bg-emerald-100 text-emerald-700
                @elseif($role == 'guru' || $role == 'wali_kelas') bg-blue-100 text-blue-600
                @elseif($role == 'ortu') bg-orange-100 text-orange-600
                @else bg-slate-100 text-slate-500 @endif
            ">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-800">{{ $user->name }}</p>
                                            <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-slate-500 hidden md:table-cell">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="
            text-xs font-semibold px-3 py-1 rounded-full
            @if ($role == 'admin') bg-purple-100 text-purple-700
            @elseif($role == 'operator') bg-emerald-100 text-emerald-700
            @elseif($role == 'guru' || $role == 'wali_kelas') bg-blue-100 text-blue-700
            @elseif($role == 'ortu') bg-orange-100 text-orange-700
            @else bg-slate-100 text-slate-700 @endif
        ">
                                        {{ ucfirst(str_replace('_', ' ', $role)) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-slate-400 text-xs hidden lg:table-cell">
                                    {{ $user->last_login ?? 'Belum pernah login' }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($user->is_active)
                                        <span class="flex items-center gap-1.5 text-xs text-emerald-600 font-medium">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="flex items-center gap-1.5 text-xs text-red-500 font-medium">
                                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div
                                        class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">

                                        {{-- EDIT --}}
                                        <button
                                            @click="openEditModal(
                                                '{{ $user->id }}',
                                                '{{ addslashes($user->name) }}',
                                                '{{ $user->email }}',
                                                '{{ $role }}'
                                            )"class="p-2 hover:bg-emerald-50 rounded-xl transition-colors text-emerald-600"
                                            title="Edit">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </button>

                                        {{-- RESET --}}
                                        <button @click="openResetModal('{{ $user->id }}')"
                                            class="p-2 hover:bg-amber-50 rounded-xl transition-colors text-amber-500"
                                            title="Reset Password">
                                            <i data-lucide="key-round" class="w-4 h-4"></i>
                                        </button>

                                        {{-- TOGGLE STATUS --}}
                                        <form action="{{ route('operator.manajemenAkun.toggle', $user->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" onclick="return confirm('Yakin ubah status akun ini?')"
                                                class="p-2 rounded-xl transition-colors
        {{ $user->is_active ? 'hover:bg-red-50 text-red-500' : 'hover:bg-emerald-50 text-emerald-600' }}"
                                                title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">

                                                @if ($user->is_active)
                                                    <i data-lucide="user-x" class="w-4 h-4"></i>
                                                @else
                                                    <i data-lucide="user-check" class="w-4 h-4"></i>
                                                @endif
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div
                class="px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <p class="text-xs text-slate-400">Menampilkan <span class="font-semibold text-slate-600">6</span> dari
                    <span class="font-semibold text-slate-600">24</span> akun
                </p>
                <div class="flex items-center gap-1">
                    <button
                        class="w-8 h-8 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-slate-50 transition-colors disabled:opacity-40"
                        disabled>
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    </button>
                    <button
                        class="w-8 h-8 rounded-xl bg-emerald-600 text-white text-xs font-semibold flex items-center justify-center">1</button>
                    <button
                        class="w-8 h-8 rounded-xl border border-slate-200 text-slate-600 text-xs font-medium hover:bg-slate-50 transition-colors">2</button>
                    <button
                        class="w-8 h-8 rounded-xl border border-slate-200 text-slate-600 text-xs font-medium hover:bg-slate-50 transition-colors">3</button>
                    <button
                        class="w-8 h-8 rounded-xl border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50 transition-colors">
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- ========== PREMIUM MULTI STEP MODAL ========== -->
    <div id="modalTambahAkun"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm overflow-y-auto">

        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl my-10 relative">

            <!-- HEADER -->
            <div class="px-8 pt-8 pb-6 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-slate-800">Tambah Akun Baru</h3>
                    <p class="text-sm text-slate-500 mt-1">Buat akun pengguna baru untuk sistem</p>
                </div>
                <button @click="showTambahModal = false"
                    class="w-10 h-10 rounded-2xl hover:bg-slate-100 flex items-center justify-center transition text-slate-500">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- STEP INDICATOR -->
            <div class="px-8 pt-6">
                <div class="flex items-center gap-4">
                    <div id="stepIndicator1" class="flex items-center gap-2 text-emerald-600 font-medium">
                        <div
                            class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center text-sm">
                            1</div>
                        Kredensial
                    </div>
                    <div class="flex-1 h-1 bg-slate-200 rounded">
                        <div id="progressBar" class="h-1 bg-emerald-600 rounded w-1/2 transition-all duration-500"></div>
                    </div>
                    <div id="stepIndicator2" class="flex items-center gap-2 text-slate-400 font-medium">
                        <div
                            class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-sm">
                            2</div>
                        Otoritas
                    </div>
                </div>
            </div>

            <form action="{{ route('operator.manajemenAkun.store') }}" method="POST" class="overflow-hidden">
                @csrf

                <!-- SLIDER CONTAINER -->
                <div id="stepWrapper" class="flex transition-transform duration-500 w-[200%]">

                    <!-- STEP 1 -->
                    <div class="w-1/2 px-8 py-10 space-y-8">

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs text-slate-500 font-medium">Nama Lengkap</label>
                                <input type="text" name="name"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs text-slate-500 font-medium">Email</label>
                                <input type="email" name="email"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs text-slate-500 font-medium">Password</label>
                                <div class="relative">
                                    <input id="passwordField" type="password" name="password"
                                        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10">
                                    <button type="button" @click="togglePassword('passwordField','eye1')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
                                        <i id="eye1" data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs text-slate-500 font-medium">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10">
                            </div>
                        </div>

                        <div class="flex items-center gap-3 bg-emerald-50 px-4 py-3 rounded-xl">
                            <i data-lucide="zap" class="w-4 h-4 text-emerald-500"></i>
                            <button type="button" @click="generatePassword()"
                                class="text-xs font-medium text-emerald-700 hover:underline">
                                Generate Password Otomatis
                            </button>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" @click="nextStep()"
                                class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-semibold">
                                Lanjut →
                            </button>
                        </div>

                    </div>
                    <!-- STEP 2 -->
                    <div class="w-1/2 px-8 py-10 space-y-8">

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @php
                                $roles = [
                                    ['val' => 'guru', 'icon' => 'graduation-cap', 'label' => 'Guru'],
                                    ['val' => 'wali_kelas', 'icon' => 'home', 'label' => 'Wali Kelas'],
                                    ['val' => 'kepsek', 'icon' => 'crown', 'label' => 'Kepsek'],
                                    ['val' => 'bendahara', 'icon' => 'banknote', 'label' => 'Bendahara'],
                                    ['val' => 'admin_ppdb', 'icon' => 'user-plus', 'label' => 'PPDB'],
                                    ['val' => 'operator', 'icon' => 'settings', 'label' => 'Operator'],
                                ];
                            @endphp

                            @foreach ($roles as $r)
                                <label class="cursor-pointer">
                                    <input type="radio" name="role" value="{{ $r['val'] }}"
                                        class="peer sr-only" onchange="toggleRoleLogic('{{ $r['val'] }}')">

                                    <div
                                        class="p-4 rounded-xl border border-slate-200 text-center
                peer-checked:border-emerald-500
                peer-checked:ring-2 peer-checked:ring-emerald-500/10">

                                        <i data-lucide="{{ $r['icon'] }}" class="w-5 h-5 mx-auto mb-2"></i>
                                        <p class="text-xs font-medium">{{ $r['label'] }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <!-- ================= LOGIC CONTAINER PREMIUM ================= -->
                        <div id="logicContainer"
                            class="hidden relative bg-gradient-to-br from-slate-50 to-white 
           border border-slate-200 rounded-3xl p-8 space-y-8
           transition-all duration-300">

                            <!-- HEADER -->
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-emerald-100 
                    flex items-center justify-center">
                                    <i data-lucide="briefcase" class="w-5 h-5 text-emerald-600"></i>
                                </div>

                                <div>
                                    <h5 class="text-sm font-semibold text-slate-800">
                                        Informasi Penugasan Lanjutan
                                    </h5>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Lengkapi detail sesuai peran yang dipilih
                                    </p>
                                </div>
                            </div>

                            <!-- FORM GRID -->
                            <div class="grid md:grid-cols-2 gap-6">

                                <!-- ================= NIP ================= -->
                                <div id="fieldNip" class="space-y-3">

                                    <label class="text-xs font-semibold text-slate-600 flex items-center gap-2">
                                        <i data-lucide="hash" class="w-4 h-4 text-slate-400"></i>
                                        Nomor Induk Pegawai (NIP)
                                    </label>

                                    <div class="relative group">
                                        <input type="text" name="nip" placeholder="Masukkan NIP resmi"
                                            class="w-full px-4 py-3 rounded-2xl
                           bg-white border border-slate-200
                           text-sm text-slate-700
                           focus:outline-none
                           focus:border-emerald-500
                           focus:ring-4 focus:ring-emerald-500/10
                           transition-all">

                                        <!-- subtle glow -->
                                        <div
                                            class="absolute inset-0 rounded-2xl 
                            bg-emerald-500/0 
                            group-focus-within:bg-emerald-500/5 
                            transition pointer-events-none">
                                        </div>
                                    </div>

                                    <p class="text-[11px] text-slate-400">
                                        Gunakan NIP sesuai data administrasi sekolah
                                    </p>
                                </div>


                                <!-- ================= DROPDOWN DINAMIS ================= -->
                                <div id="fieldSpesifik" class="space-y-3">

                                    <label id="labelSpesifik"
                                        class="text-xs font-semibold text-slate-600 flex items-center gap-2">
                                        <i data-lucide="list" class="w-4 h-4 text-slate-400"></i>
                                        Keterangan Spesifik
                                    </label>

                                    <div class="relative group">

                                        <select name="extra_info"
                                            class="w-full appearance-none
                           px-4 py-3 pr-10
                           rounded-2xl
                           bg-white border border-slate-200
                           text-sm text-slate-700
                           focus:outline-none
                           focus:border-emerald-500
                           focus:ring-4 focus:ring-emerald-500/10
                           transition-all">

                                            <option value="">Pilih Opsi...</option>
                                        </select>

                                        <!-- custom arrow -->
                                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                                        </div>

                                        <!-- subtle glow -->
                                        <div
                                            class="absolute inset-0 rounded-2xl 
                            bg-emerald-500/0 
                            group-focus-within:bg-emerald-500/5 
                            transition pointer-events-none">
                                        </div>

                                    </div>

                                    <p class="text-[11px] text-slate-400">
                                        Opsi akan menyesuaikan dengan role yang dipilih
                                    </p>

                                </div>

                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button type="button" @click="prevStep()"
                                class="px-6 py-3 bg-slate-100 hover:bg-slate-200 rounded-xl text-sm">
                                ← Kembali
                            </button>

                            <button type="submit" onclick="return confirm('Yakin ubah status akun ini?')"
                                class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-semibold">
                                Daftarkan Akun
                            </button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>

    <div id="editModal"
        class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-slate-900/40 backdrop-blur-md p-4 transition-all duration-300">

        <div
            class="relative w-full max-w-2xl transform overflow-hidden rounded-[2rem] bg-white shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-white/20 animate-modal">

            <div class="bg-gradient-to-r from-slate-50 to-white px-8 pt-8 pb-6 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <h3 class="text-2xl font-black text-slate-800 tracking-tight flex items-center gap-2">
                            Manajemen Profil
                            <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        </h3>
                        <p class="text-sm font-medium text-slate-500">Perbarui kredensial dan hak akses akun sistem.</p>
                    </div>
                    <button @click="closeEditModal()"
                        class="h-10 w-10 flex items-center justify-center rounded-full bg-white border border-slate-200 text-slate-400 hover:text-rose-500 hover:border-rose-100 hover:bg-rose-50 transition-all duration-300 shadow-sm">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" id="editUserId">

                <div class="px-8 py-8 space-y-9">
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                            <h4 class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Informasi Dasar</h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                            <div class="group space-y-2">
                                <label
                                    class="ml-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 group-focus-within:text-emerald-600 transition-colors">Nama
                                    Lengkap</label>
                                <input type="text" id="editName" name="name"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-5 py-3.5 text-sm font-medium transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-300 shadow-sm"
                                    placeholder="Masukkan nama lengkap...">
                            </div>

                            <div class="group space-y-2">
                                <label
                                    class="ml-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 group-focus-within:text-emerald-600 transition-colors">Alamat
                                    Email</label>
                                <input type="email" id="editEmail" name="email"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-5 py-3.5 text-sm font-medium transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-300 shadow-sm"
                                    placeholder="nama@email.com">
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="h-8 w-1 bg-blue-500 rounded-full"></div>
                            <h4 class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Otoritas & Role</h4>
                        </div>

                        <div class="space-y-5">
                            <div class="group space-y-2">
                                <label class="ml-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Pilih
                                    Role Pengguna</label>
                                <div class="relative">
                                    <select id="editRole" name="role" onchange="toggleEditExtra()"
                                        class="w-full appearance-none rounded-2xl border-slate-200 bg-slate-50/50 px-5 py-3.5 text-sm font-bold text-slate-700 transition-all focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 cursor-pointer shadow-sm">
                                        <option value="guru">Guru</option>
                                        <option value="wali_kelas">Wali Kelas</option>
                                        <option value="kepsek">Kepala Sekolah</option>
                                        <option value="bendahara">Bendahara</option>
                                        <option value="admin_ppdb">Admin PPDB</option>
                                        <option value="operator">Operator Sistem</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M19 9l-7 7-7-7" stroke-width="2.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div id="editExtraContainer"
                                class="hidden grid grid-cols-1 md:grid-cols-2 gap-6 animate-fadeIn">
                                <div class="space-y-2">
                                    <label class="ml-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Nomor
                                        Induk Pegawai</label>
                                    <input type="text" id="editNip" name="nip"
                                        class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3.5 text-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="ml-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Spesialisasi</label>
                                    <select id="editExtra" name="extra_info"
                                        class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3.5 text-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex items-center justify-end gap-4 border-t border-slate-100 pt-8 pb-8 px-8">
                    <button type="button" @click="closeEditModal()"
                        class="px-8 py-3.5 text-sm font-bold text-slate-400 transition-all hover:text-slate-600 hover:bg-slate-50 rounded-2xl">
                        Batal
                    </button>
                    <button type="submit" onclick="return confirm('Yakin ubah status akun ini?')"
                        class="group relative flex items-center gap-2 overflow-hidden rounded-2xl bg-slate-900 px-10 py-3.5 text-sm font-bold text-white shadow-xl shadow-slate-200 transition-all hover:bg-slate-800 active:scale-95">
                        <span class="relative z-10 flex items-center gap-2">
                            <svg class="h-4 w-4 text-emerald-400 transition-transform group-hover:rotate-12"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </span>
                        <div
                            class="absolute inset-0 translate-x-[-100%] bg-gradient-to-r from-transparent via-white/10 to-transparent transition-transform duration-1000 group-hover:translate-x-[100%]">
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- ===== RESET PASSWORD MODAL ===== --}}
    <div id="resetModal"
        class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-900/60 backdrop-blur-md p-4 transition-all">
        <div
            class="relative w-full max-w-md transform overflow-hidden rounded-[2.5rem] bg-white p-1 shadow-2xl animate-modal">

            <div class="bg-gradient-to-br from-slate-50 to-white rounded-[2.3rem] p-8">
                <div class="mb-8 flex flex-col items-center text-center">
                    <div
                        class="mb-4 flex h-16 w-16 items-center justify-center rounded-3xl bg-amber-50 text-amber-500 shadow-inner">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800">Ubah Password</h3>
                    <p class="mt-2 text-sm text-slate-500">Demi keamanan, gunakan minimal 8 karakter dengan kombinasi
                        angka.</p>
                </div>

                <form id="resetForm" method="POST" action="">
                    @csrf
                    @method('PATCH')

                    {{-- <div class="group relative">
                        <label
                            class="absolute -top-2 left-4 bg-white px-2 text-[10px] font-bold uppercase tracking-widest text-slate-400 group-focus-within:text-amber-500 transition-colors">Password
                            Lama</label>
                        <input type="password" id="editOldPassword"
                            class="w-full rounded-2xl border-slate-200 bg-transparent px-4 py-4 text-sm focus:border-amber-500 focus:ring-0">
                    </div> --}}

                    <div class="group relative">
                        <label
                            class="absolute -top-2 left-4 bg-white px-2 text-[10px] font-bold uppercase tracking-widest text-slate-400 group-focus-within:text-amber-500 transition-colors">Password
                            Baru</label>
                        <input type="password" id="editPassword" name="password"
                            class="w-full rounded-2xl border-slate-200 bg-transparent px-4 py-4 text-sm focus:border-amber-500 focus:ring-0">
                    </div>

                    <div class="group relative">
                        <label
                            class="absolute -top-2 left-4 bg-white px-2 text-[10px] font-bold uppercase tracking-widest text-slate-400 group-focus-within:text-amber-500 transition-colors">Konfirmasi
                            Password</label>
                        <input type="password" id="editPasswordConfirm" name="password_confirmation"
                            class="w-full rounded-2xl border-slate-200 bg-transparent px-4 py-4 text-sm focus:border-amber-500 focus:ring-0">
                    </div>

                    <div class="mt-8 flex flex-col gap-3">
                        <button type="submit" onclick="return confirm('Yakin ubah password akun ini?')"
                            class="w-full rounded-2xl bg-amber-500 py-4 text-sm font-bold text-white shadow-lg shadow-amber-200 transition-all hover:bg-amber-600 active:scale-[0.98]">
                            Simpan Password Baru
                        </button>
                        <button type="button" @click="closeResetModal()"
                            class="w-full py-2 text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors">
                            Mungkin Nanti
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ========== TOAST NOTIFICATION ========== -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 hidden">
        <div class="flex items-center gap-3 bg-slate-800 text-white px-5 py-3.5 rounded-2xl shadow-lg">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400"></i>
            <span id="toastMsg" class="text-sm font-medium"></span>
        </div>
    </div>

    @if (session('success'))
        @push('scripts')
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    showToast("{{ session('success') }}");
                });
            </script>
        @endpush
    @endif

    @if (session('error'))
        @push('scripts')
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    showToast("{{ session('error') }}", "error");
                });
            </script>
        @endpush
    @endif

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('userPanel', () => ({
                showTambahModal: false,
                openEditModal(id, name, email, role) {
                    var modal = document.getElementById('editModal');
                    var form = document.getElementById('editForm');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    form.action = '/operator/manajemen-akun/' + id;
                    document.getElementById('editUserId').value = id;
                    document.getElementById('editName').value = name;
                    document.getElementById('editEmail').value = email;
                    document.getElementById('editRole').value = role;
                },
                closeEditModal() {
                    var modal = document.getElementById('editModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                },
                openResetModal(id) {
                    var modal = document.getElementById('resetModal');
                    var form = document.getElementById('resetForm');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    form.action = '/operator/manajemen-akun/' + id + '/reset-password';
                },
                closeResetModal() {
                    var modal = document.getElementById('resetModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                },
                toggleRoleLogic(role) {
                    var container = document.getElementById('logicContainer');
                    var label = document.getElementById('labelSpesifik');
                    var select = document.querySelector('#fieldSpesifik select');
                    if (!container || !select) return;
                    var roleOptions = {
                        guru: { label: 'Mata Pelajaran Utama', data: ["Al-Qur'an Hadits", 'Akidah Akhlak', 'Bahasa Arab', 'Matematika'] },
                        wali_kelas: { label: 'Kelas Pengampuan', data: ['Kelas 1-A', 'Kelas 1-B', 'Kelas 2-A', 'Kelas 6-C'] },
                        bendahara: { label: 'Jenis Bendahara', data: ['Bendahara Umum', 'Bendahara SPP'] },
                        admin_ppdb: { label: 'Tahun Ajaran', data: ['2024/2025', '2025/2026'] }
                    };
                    if (!roleOptions[role]) { container.classList.add('hidden'); return; }
                    container.classList.remove('hidden');
                    label.innerText = roleOptions[role].label;
                    select.innerHTML = '<option value="">Pilih Opsi...</option>';
                    roleOptions[role].data.forEach(function (item) {
                        select.innerHTML += '<option value="' + item + '">' + item + '</option>';
                    });
                },
                nextStep() {
                    document.getElementById('stepWrapper').style.transform = 'translateX(-50%)';
                    document.getElementById('progressBar').style.width = '100%';
                },
                prevStep() {
                    document.getElementById('stepWrapper').style.transform = 'translateX(0%)';
                    document.getElementById('progressBar').style.width = '50%';
                },
                generatePassword() {
                    var random = Math.random().toString(36).slice(-8);
                    document.getElementById('passwordField').value = 'nh3+' + random;
                },
                togglePassword(fieldId, iconId) {
                    var field = document.getElementById(fieldId);
                    var icon = document.getElementById(iconId);
                    if (!field) return;
                    if (field.type === 'password') {
                        field.type = 'text';
                        if (icon) icon.setAttribute('data-lucide', 'eye-off');
                    } else {
                        field.type = 'password';
                        if (icon) icon.setAttribute('data-lucide', 'eye');
                    }
                    lucide.createIcons();
                }
            }));
        });
    </script>
    @endpush
@endsection
