<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HrdController;
use App\Http\Controllers\KepalabagianController;
use App\Http\Controllers\GambargedungController;
use App\Http\Controllers\PelaksanaController;

// {{----------Role Pelaksana Route Start -----------}}

Route::middleware(['auth', 'role:pelaksana'])->group(function () {
    Route::get('/dashboard', [PelaksanaController::class, 'index'])->name('pelaksana.dashboard');
    
    // Apar Function Start 
    
    Route::get('/dashboard/dataapar', [PelaksanaController::class, 'dataapar'])->name('pelaksana.dataapar');
    Route::get('/dashboard/tambahapar', [PelaksanaController::class, 'createapar'])->name('pelaksana.tambahapar');
    Route::post('/dashboard/tambahapar', [PelaksanaController::class, 'storeapar'])->name('pelaksana.apars.store');
    Route::delete('/dashboard/dataapar/{id}', [PelaksanaController::class, 'destroyapar'])->name('pelaksana.apars.destroy');

    Route::get('dashboard/tambahapar/importapar', [PelaksanaController::class, 'viewimportapar'])->name('pelaksana.importapar');

    Route::get('dashboard/dataapar-export', [PelaksanaController::class, 'exportapar']);
    Route::post('dashboard/dataapar/tambahapar-import', [PelaksanaController::class, 'importapar'])->name('pelaksana.importfileapar');
    Route::get('/dataapar/search', [PelaksanaController::class, 'search'])->name('dataapar.search');
    // Apar Function End

    // Mapping Function Gambar Gedung Start

    Route::get('/dashboard/datamapping', [PelaksanaController::class, 'datamapping'])->name('pelaksana.datamapping');
    Route::get('/dashboard/tambahmapping/{id}/mapping', [PelaksanaController::class, 'getdataMapping']);
    Route::get('/dashboard/tambahgedung/', [PelaksanaController::class, 'creategedung'])->name('pelaksana.tambahlayoutgedung');
    Route::post('/dashboard/tambahgedung', [PelaksanaController::class, 'storegedung'])->name('pelaksana.gambargedungs.store');
    Route::delete('/dashboard/datamapping/{gambargedung}', [PelaksanaController::class, 'destroygedung'])->name('gambargedungs.destroy');


    Route::get('/dashboard/tambahmapping/{gambargedung_id}/create', [PelaksanaController::class, 'createmapping'])->name('pelaksana.tambahmapping');
    Route::post('/dashboard/tambahmapping/', [PelaksanaController::class, 'storemapping']);
    Route::get('/dashboard/datamapping/{gambargedungId}/mapping', [PelaksanaController::class, 'getMapping']);
    Route::put('/dashboard/tambahmapping/{gambargedungId}', [PelaksanaController::class, 'updatemapping']);
    Route::delete('/dashboard/tambahmapping/{id}', [PelaksanaController::class, 'destroymapping'])->name('gedungs.destroy');


    // Mapping Function Gambar Gedung End

    // laporan function start 
    Route::get('/dashboard/datalaporan', [PelaksanaController::class, 'datalaporan'])->name('pelaksana.datalaporan');
    Route::get('/dashboard/tambahlaporan', [PelaksanaController::class, 'createlaporan'])->name('pelaksana.tambahlaporan');
    Route::post('/dashboard/tambahlaporan', [PelaksanaController::class, 'storelaporan'])->name('pelaksana.laporans.store');
    Route::delete('/dashboard/tambahlaporan/{laporan}', [PelaksanaController::class, 'destroylaporan'])->name('laporans.destroy');


    Route::get('/dashboard/tambahkomponen/{id}', [PelaksanaController::class, 'createkomponen'])->name('pelaksana.tambahkomponen');
    Route::post('/dashboard/tambahkomponen/', [PelaksanaController::class, 'storekomponen'])->name('pelaksana.tambahkomponen.store');

    Route::get('/dashbboard/datalaporan/{id}/printlaporan', [PelaksanaController::class, 'printlaporan'])->name('pelaksana.cetaklaporan');

    Route::get('/dashboard/datakirimlaporan', [PelaksanaController::class, 'datakirimlaporan'])->name('pelaksana.datakirimlaporan');



    

    // laporan function end 
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// {{----------Role Pelaksana Route End -----------}}

// {{----------Role Kepala Bagian Route Start -----------}}

Route::middleware(['auth', 'role:kepalabagian'])->group(function () {
    Route::get('/kepalabagian/dashboard', [KepalabagianController::class, 'index'])->name('kepalabagian.dashboard');
   
    
    // Apar Function Start 
    
    Route::get('/kepalabagian/dataapar', [KepalaBagianController::class, 'dataapar'])->name('kepalabagian.dataapar');
    Route::get('/kepalabagian/tambahapar', [KepalaBagianController::class, 'createapar'])->name('kepalabagian.tambahapar');
    Route::post('/kepalabagian/tambahapar', [KepalaBagianController::class, 'storeapar'])->name('kepalabagian.apars.store');
    Route::delete('/kepalabagian/dataapar/{apar}', [KepalaBagianController::class, 'destroyapar'])->name('kepalabagian.apars.destroy');


    Route::get('kepalabagian/tambahapar/importapar', [KepalaBagianController::class, 'viewimportapar'])->name('kepalabagian.importapar');

    Route::get('kepalabagian/dataapar-export', [KepalaBagianController::class, 'exportapar']);
    Route::post('kepalabagian/dataapar/tambahapar-import', [KepalaBagianController::class, 'importapar'])->name('kepalabagian.importfileapar');
    Route::get('/kepalabagian/search', [KepalaBagianController::class, 'search'])->name('dataapar.search');
   
    // Apar Function End

   // Mapping Function Gambar Gedung Start

   Route::get('/kepalabagian/datamapping', [KepalaBagianController::class, 'datamapping'])->name('kepalabagian.datamapping');
   Route::get('/kepalabagian/tambahmapping/{id}/mapping', [KepalaBagianController::class, 'getdataMapping']);
   Route::get('/kepalabagian/tambahgedung/', [KepalaBagianController::class, 'creategedung'])->name('kepalabagian.tambahlayoutgedung');
   Route::post('/kepalabagian/tambahgedung', [KepalaBagianController::class, 'storegedung'])->name('kepalabagian.gambargedungs.store');
   Route::delete('/kepalabagian/datamapping/{gambargedung}', [KepalaBagianController::class, 'destroygedung'])->name('gambargedungs.destroy');


   Route::get('/kepalabagian/tambahmapping/{gambargedung_id}/create', [KepalaBagianController::class, 'createmapping'])->name('kepalabagian.tambahmapping');
   Route::post('/kepalabagian/tambahmapping/', [KepalaBagianController::class, 'storemapping']);
   Route::get('/kepalabagian/datamapping/{gambargedungId}/mapping', [KepalaBagianController::class, 'getMapping']);
   Route::put('/kepalabagian/tambahmapping/{gambargedungId}', [KepalaBagianController::class, 'updatemapping']);
   Route::delete('/kepalabagian/tambahmapping/{id}', [KepalaBagianController::class, 'destroymapping'])->name('gedungs.destroy');


   // Mapping Function Gambar Gedung End


   
    // laporan function start 
    Route::get('/kepalabagian/datalaporan', [KepalaBagianController::class, 'datalaporan'])->name('kepalabagian.datalaporan');
    Route::get('/kepalabagian/tambahlaporan', [KepalaBagianController::class, 'createlaporan'])->name('kepalabagian.tambahlaporan');
    Route::post('/kepalabagian/tambahlaporan', [KepalaBagianController::class, 'storelaporan'])->name('kepalabagian.laporans.store');
    Route::delete('/kepalabagian/tambahlaporan/{laporan}', [KepalaBagianController::class, 'destroylaporan'])->name('laporans.destroy');


    Route::get('/kepalabagian/tambahkomponen/{id}', [KepalaBagianController::class, 'createkomponen'])->name('kepalabagian.tambahkomponen');
    Route::post('/kepalabagian/tambahkomponen/', [KepalaBagianController::class, 'storekomponen'])->name('kepalabagian.tambahkomponen.store');

    Route::get('/kepalabagian/datalaporan/{id}/printlaporan', [KepalaBagianController::class, 'printlaporan'])->name('kepalabagian.cetaklaporan');

    Route::get('/kepalabagian/datakirimlaporan', [KepalaBagianController::class, 'datakirimlaporan'])->name('kepalabagian.datakirimlaporan');


    // laporan function end 
});
// {{----------Role Kepala Bagian Route End -----------}}

// {{----------Role HRD Route Start -----------}}

Route::middleware(['auth', 'role:hrd'])->group(function () {
    Route::get('/hrd/dashboard', [HrdController::class, 'dashboard'])->name('hrd.dashboard');
    Route::get('/hrd/dataapar', [HrdController::class, 'dataapar'])->name('hrd.dataapar');
    Route::get('/hrd/datamapping', [HrdController::class, 'hrddatamapping'])->name('hrd.datamapping');
    Route::get('/hrd/datamapping/{id}/mapping', [HrdController::class, 'hrdgetdataMapping']);
    

});

// {{----------Role HRD Route End -----------}}


require __DIR__.'/auth.php';
