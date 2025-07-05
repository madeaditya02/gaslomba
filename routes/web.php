<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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

Route::get('/dashboard', [PesertaController::class, 'profile'])->name('profile');
Route::get('/dashboard/lomba', [PesertaController::class, 'lomba'])->name('lomba');
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
