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
    
    // Apar Function Start 
    
    Route::get('/dashboard/dataapar', [PelaksanaController::class, 'dataapar'])->name('pelaksana.dataapar');
    Route::get('/dashboard/tambahapar', [PelaksanaController::class, 'createapar'])->name('pelaksana.tambahapar');
    Route::post('/dashboard/tambahapar', [PelaksanaController::class, 'storeapar'])->name('pelaksana.apars.store');
    Route::delete('/dashboard/dataapar/{apar}', [PelaksanaController::class, 'destroyapar'])->name('apars.destroy');

    // Apar Function End

    // Mapping Function Gambar Gedung Start

    Route::get('/dashboard/datamapping', [GambargedungController::class, 'pelaksana'])->name('pelaksana.datagedung');
    Route::get('/dashboard/tambahgedung', [PelaksanaController::class, 'creategedung'])->name('pelaksana.tambahlayoutgedung');
    Route::post('/dashboard/tambahgedung', [GambargedungController::class, 'store'])->name('gambargedungs.store');
    Route::delete('/dashboard/datagedung/{gambargedung}', [GambargedungController::class, 'destroy'])->name('gambargedungs.destroy');
    Route::get('/dashboard/tambahmapping', [PelaksanaController::class, 'createmapping'])->name('pelaksana.tambahmapping');
    Route::post('/dashboard/tambahmapping', [PelaksanaController::class, 'storemapping'])->name('mapping.store');
    // Mapping Function Gambar Gedung End

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
    Route::get('/hrd/dataapar', [HrdController::class, 'dataapar'])->name('hrd.dataapar');
    Route::get('/hrd/datamapping', [HrdController::class, 'datamapping'])->name('hrd.datamapping');
});

// {{----------Role HRD Route End -----------}}


require __DIR__.'/auth.php';
