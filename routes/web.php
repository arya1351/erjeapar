<?php

use App\Http\Controllers\AparController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HrdController;
use App\Http\Controllers\KepalabagianController;
use App\Http\Controllers\PelaksanaController;



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PelaksanaController::class, 'index'])->name('pelaksana.dashboard');
    Route::get('/dashboard/dataapar', [PelaksanaController::class, 'dataapar'])->name('pelaksana.dataapar');
    Route::get('/dashboard/tambahapar', [AparController::class, 'index'])->name('apar.tambah');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:kepalabagian'])->group(function(){
    Route::get('/kepalabagian/dashboard', [KepalabagianController::class, 'dashboard'])->name('kepalabagian.dashboard');
    Route::get('/kepalabagian/operatortable', [KepalabagianController::class, 'operatortable'])->name('kepalabagian.operatortable');
});

Route::middleware(['auth', 'role:hrd'])->group(function(){
    Route::get('/hrd/dashboard', [HrdController::class, 'dashboard'])->name('hrd.dashboard');
});

require __DIR__.'/auth.php';
