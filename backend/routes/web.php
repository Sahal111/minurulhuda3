<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ===================== PUBLIC =====================
// Semua halaman publik sekolah sekarang di-handle React (frontend/)
// Backend hanya menjawab permintaan API, bukan melayani HTML

// ===================== AUTH (Blade-based login dihapus) =====================
// Login/logout/register sudah dipindah ke API → routes/api.php
// Tidak ada lagi GET /login atau GET /register di sini

// Fallback: redirect semua request web ke frontend (opsional, 
// berguna saat backend di-deploy terpisah dari frontend)
Route::get('/{any}', function () {
    return response()->json(['message' => 'Use the API at /api/*'], 404);
})->where('any', '.*');