<?php

use App\Http\Controllers\AparController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HrdController;
use App\Http\Controllers\KepalabagianController;


use App\Http\Controllers\GambargedungController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\PelaksanaController;

// {{----------Role Pelaksana Route Start -----------}}

Route::middleware(['auth', 'role:pelaksana'])->group(function () {
    Route::get('/dashboard', [PelaksanaController::class, 'index'])->name('pelaksana.dashboard');
    Route::get('/dashboard/dataapar', [AparController::class, 'pelaksana'])->name('pelaksana.dataapar');
    Route::get('/dashboard/tambahapar', [AparController::class, 'create'])->name('apar.tambah');
    Route::post('/dashboard/tambahapar', [AparController::class, 'store'])->name('apars.store');
    Route::delete('/dashboard/dataapar/{apar}', [AparController::class, 'destroy'])->name('apars.destroy');

    Route::get('/dashboard/datagedung', [GambargedungController::class, 'pelaksana'])->name('pelaksana.datagedung');
    Route::get('/dashboard/tambahgedung', [GambargedungController::class, 'create'])->name('gedung.tambah');
    Route::post('/dashboard/tambahgedung', [GambargedungController::class, 'store'])->name('gambargedungs.store');
    Route::delete('/dashboard/datagedung/{gambargedung}', [GambargedungController::class, 'destroy'])->name('gambargedungs.destroy');

    Route::get('/dashboard/tambahlayout', [GedungController::class, 'create'])->name('layoutgedung.tambah');
    Route::post('/dashboard/tambahlayout', [GedungController::class, 'store'])->name('layoutgedung.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// {{----------Role Pelaksana Route End -----------}}

// {{----------Role Kepala Bagian Route Start -----------}}

Route::middleware(['auth', 'role:kepalabagian'])->group(function () {
    Route::get('/kepalabagian/dashboard', [KepalabagianController::class, 'dashboard'])->name('kepalabagian.dashboard');
    Route::get('/kepalabagian/dataapar', [AparController::class, 'kepalabagian'])->name('kepalabagian.dataapar');
    Route::get('/kepalabagian/datagedung', [GambargedungController::class, 'kepalabagian'])->name('kepalabagian.datagedung');
});
// {{----------Role Kepala Bagian Route End -----------}}

// {{----------Role HRD Route Start -----------}}

Route::middleware(['auth', 'role:hrd'])->group(function () {
    Route::get('/hrd/dashboard', [HrdController::class, 'dashboard'])->name('hrd.dashboard');
    Route::get('/hrd/dataapar', [AparController::class, 'hrd'])->name('hrd.dataapar');
    Route::get('/hrd/datagedung', [GambargedungController::class, 'hrd'])->name('hrd.datagedung');
});

// {{----------Role HRD Route End -----------}}


require __DIR__.'/auth.php';
