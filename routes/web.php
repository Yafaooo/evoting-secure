<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Artisan;

// 1. Halaman Utama (Daftar Kandidat & Hasil)
Route::get('/', [VoteController::class, 'index'])->name('home');

// 2. Proses Kirim Suara (Tombol Vote)
Route::post('/vote', [VoteController::class, 'store'])->name('votes.store');

// 3. JALUR RAHASIA: Ketik ini di browser untuk reset database di Railway
// Contoh: https://evoting-secure-production.up.railway.app/gas-reset-db
Route::get('/gas-reset-db', function() {
    try {
        // Menjalankan perintah reset & isi ulang data secara otomatis
        Artisan::call('migrate:fresh --seed --force');
        
        return "<h1>MANTAP PAK YAFAO!</h1>
                <p>Database Online sudah BERSIH dan data KANDIDAT sudah muncul kembali.</p>
                <a href='/'>KEMBALI KE HALAMAN DEPAN</a>";
    } catch (\Exception $e) {
        return "Waduh Gagal Pak: " . $e->getMessage();
    }
});