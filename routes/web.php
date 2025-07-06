<?php

use Inertia\Inertia;
use App\Http\Controllers\ListPeserta;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\LombaPenyelenggara;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilPenyelenggara;
use App\Http\Controllers\EditPerlombaanPenyelenggara;
use App\Http\Controllers\TambahPerlombaanPenyelenggara;

Route::get('/', [MainController::class, 'index'])->name('home');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/explore', [MainController::class, 'explore'])->name('explore');
Route::get('/lomba/{id}', [MainController::class, 'details'])->name('details');
Route::get('/lomba/{id}/daftar', [MainController::class, 'daftar'])->middleware('auth')->name('daftar_lomba');
Route::post('/lomba/{id}/daftar', [MainController::class, 'submitDaftar'])->middleware('auth')->name('submit_daftar');
Route::get('/lomba/perbaikan/{id}', [MainController::class, 'perbaikan'])->middleware('auth')->name('perbaikan_pendaftaran');
Route::post('/lomba/perbaikan/{id}', [MainController::class, 'submitPerbaikan'])->middleware('auth')->name('submit_perbaikan');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'profile'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'updateProfile'])->name('update-profile');
    Route::get('/dashboard/lomba', [LombaController::class, 'index'])->name('lomba');
    Route::get('/dashboard/lomba/{id}/peserta', [LombaController::class, 'detail']);
    Route::post('/dashboard/lomba/{id}/peserta/{id_daftar}', [LombaController::class, 'updateStatus']);
    Route::get('/dashboard/lomba/tambah', [LombaController::class, 'tambah']);
    Route::post('/dashboard/lomba/tambah', [LombaController::class, 'simpan']);
    Route::get('/dashboard/lomba/{id}/edit', [LombaController::class, 'edit']);
    Route::post('/dashboard/lomba/{id}/edit', [LombaController::class, 'update']);
    Route::delete('/dashboard/lomba/{id}', [LombaController::class, 'delete']);
});
// require __DIR__.'/settings.php';
require __DIR__.'/auth.php';


