<?php

use Inertia\Inertia;
use App\Http\Controllers\ListPeserta;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LombaPenyelenggara;
use App\Http\Controllers\ProfilPenyelenggara;
use App\Http\Controllers\EditPerlombaanPenyelenggara;
use App\Http\Controllers\TambahPerlombaanPenyelenggara;
use App\Http\Controllers\PesertaController;

Route::get('/', [MainController::class, 'index'])->name('home');

Route::get('/admin', function () {
    return Inertia::render('admin/Dashboard');
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/explore', [MainController::class, 'explore'])->name('explore');
Route::get('/lomba/{id}', [MainController::class, 'details'])->name('details');
Route::get('/lomba/{id}/daftar', [MainController::class, 'daftar'])->middleware('auth')->name('daftar_lomba');
Route::post('/lomba/{id}/daftar', [MainController::class, 'submitDaftar'])->middleware('auth')->name('submit_daftar');

Route::get('/dashboard/lomba/tambah', [LombaPenyelenggara::class, 'TambahLomba']);

Route::get('/dashboard/lomba/profil',[ProfilPenyelenggara::class, 'Profil']);

Route::get('/dashboard/lomba/peserta',[ListPeserta::class,'listPeserta']);

Route::get('/dashboard/lomba/TambahPerlombaan',[TambahPerlombaanPenyelenggara::class,'TambahPerlombaan']);

Route::get('/dashboard/lomba/EditPerlombaan',[EditPerlombaanPenyelenggara::class,'EditPerlombaan']);

Route::get('/dashboard', [PesertaController::class, 'profile'])->name('profile');
Route::get('/dashboard/lomba', [PesertaController::class, 'lomba'])->name('lomba');
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';


