<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HrdController;
use App\Http\Controllers\KepalabagianController;
use App\Http\Controllers\PelaksanaController;

// {{-- --------Role Pelaksana Route Start --------- --}}

Route::middleware(['auth', 'role:pelaksana'])->group(function () {
    Route::get('/dashboard', [PelaksanaController::class, 'index'])->name('pelaksana.dashboard');
    Route::get('/dashboard/{gambargedungId}/mapping', [PelaksanaController::class, 'dashboardgetMapping']);

    // Apar Function Start

    Route::get('/dashboard/dataapar', [PelaksanaController::class, 'dataapar'])->name('pelaksana.dataapar');
    Route::get('/dashboard/tambahapar', [PelaksanaController::class, 'createapar'])->name('pelaksana.tambahapar');
    Route::post('/dashboard/tambahapar', [PelaksanaController::class, 'storeapar'])->name('pelaksana.apars.store');
    Route::get('/dashboard/editapar/{id}', [PelaksanaController::class, 'editapar'])->name('pelaksana.editapar');
    Route::put('/dashboard/editapar/{id}', [PelaksanaController::class, 'updateapar'])->name('pelaksana.apars.update');
    Route::delete('/dashboard/dataapar/{id}', [PelaksanaController::class, 'destroyapar'])->name('pelaksana.apars.destroy');

    Route::get('dashboard/tambahapar/importapar', [PelaksanaController::class, 'viewimportapar'])->name('pelaksana.importapar');

    Route::get('/dataapar/export', [PelaksanaController::class, 'exportapar'])->name('dataapar.export');
    Route::post('dashboard/dataapar/tambahapar-import', [PelaksanaController::class, 'importapar'])->name('pelaksana.importfileapar');
    Route::get('/dataapar/search', [PelaksanaController::class, 'search'])->name('dataapar.search');
    // Apar Function End

    // Mapping Function Gambar Gedung Start

    Route::get('/dashboard/datamapping', [PelaksanaController::class, 'datamapping'])->name('pelaksana.datamapping');
    Route::get('/dashboard/tambahmapping/{id}/mapping', [PelaksanaController::class, 'getdataMapping']);
    Route::get('/dashboard/tambahgedung/', [PelaksanaController::class, 'creategedung'])->name('pelaksana.tambahlayoutgedung');
    Route::post('/dashboard/tambahgedung', [PelaksanaController::class, 'storegedung'])->name('pelaksana.gambargedungs.store');
    Route::delete('/dashboard/datamapping/{id}', [PelaksanaController::class, 'destroygedung'])->name('gambargedungs.destroy');

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
    Route::get('/dashboard/editlaporan/{id}', [PelaksanaController::class, 'editlaporan'])->name('pelaksana.editlaporan');
    Route::put('/dashboard/editlaporan/{id}/update', [PelaksanaController::class, 'updatelaporan'])->name('pelaksana.laporans.update');
    Route::delete('/dashboard/datalaporan/{id}', [PelaksanaController::class, 'destroylaporan'])->name('pelaksana.laporans.destroy');

    Route::get('/dashboard/tambahkomponen/{id}', [PelaksanaController::class, 'createkomponen'])->name('pelaksana.tambahkomponen');
    Route::post('/dashboard/tambahkomponen/', [PelaksanaController::class, 'storekomponen'])->name('pelaksana.tambahkomponen.store');
    Route::delete('/dashboard/datalaporan/komponen/{id}', [PelaksanaController::class, 'destroykomponen'])->name('komponens.destroy');

    Route::get('/dashbboard/datalaporan/{id}/printlaporan', [PelaksanaController::class, 'printlaporan'])->name('pelaksana.cetaklaporan');


    // laporan function end
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// {{-- --------Role Pelaksana Route End --------- --}}

// {{-- --------Role Kepala Bagian Route Start --------- --}}

Route::middleware(['auth', 'role:kepalabagian'])->group(function () {
    Route::get('/kepalabagian/dashboard', [KepalabagianController::class, 'index'])->name('kepalabagian.dashboard');
    Route::get('/kepalabagian/dashboard/{gambargedungId}/mapping', [KepalaBagianController::class, 'dashboardgetMapping']);

    // Apar Function Start

    Route::get('/kepalabagian/dataapar', [KepalaBagianController::class, 'dataapar'])->name('kepalabagian.dataapar');
    Route::get('/kepalabagian/dataapar/export', [KepalabagianController::class, 'exportapar'])->name('kepalabagian.dataapar.export');

    Route::get('kepalabagian/tambahapar/importapar', [KepalaBagianController::class, 'viewimportapar'])->name('kepalabagian.importapar');

    Route::get('/kepalabagian/search', [KepalaBagianController::class, 'search'])->name('kepalabagian.dataapar.search');

    // Apar Function End

    // Mapping Function Gambar Gedung Start

    Route::get('/kepalabagian/datamapping', [KepalaBagianController::class, 'datamapping'])->name('kepalabagian.datamapping');

    Route::get('/kepalabagian/datamapping/{gambargedungId}/mapping', [KepalaBagianController::class, 'getMapping']);

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
    Route::get('/kepalabagian/datakirimlaporan/{id}', action: [KepalaBagianController::class, 'showpdf'])->name('kepalabagian.showpdf');
    Route::delete('/kepalabagian/datakirimlaporan/{id}', [KepalaBagianController::class, 'destroyfilelaporan'])->name('filelaporans.destroy');
    Route::post('/kepalabagian/kirimlaporan', [KepalaBagianController::class, 'storekirimlaporan'])->name('kepalabagian.kirimlaporans.store');


    Route::get('/kepalabagian/kirimlaporan', [KepalaBagianController::class, 'kirimlaporan'])->name('kepalabagian.kirimlaporan');

    // laporan function end
});
// {{-- --------Role Kepala Bagian Route End --------- --}}

// {{-- --------Role HRD Route Start --------- --}}

Route::middleware(['auth', 'role:hrd'])->group(function () {
    Route::get('/hrd/dashboard', [HrdController::class, 'dashboard'])->name('hrd.dashboard');
    Route::get('/hrd/dashboard/{gambargedungId}/mapping', [HrdController::class, 'dashboardgetMapping']);

    Route::get('/hrd/dataapar', [HrdController::class, 'dataapar'])->name('hrd.dataapar');
    Route::get('/hrd/search', [HrdController::class, 'search'])->name('hrd.dataapar.search');
    Route::get('/hrd/datamapping', [HrdController::class, 'hrddatamapping'])->name('hrd.datamapping');
    Route::get('/hrd/datamapping/{id}/mapping', [HrdController::class, 'hrdgetdataMapping']);

    Route::get('/hrd/pengajuanlaporan', [HrdController::class, 'pengajuanlaporan'])->name('hrd.datapengajuan');
    Route::get('/hrd/pengajuanlaporan/{id}', action: [HrdController::class, 'showpdf'])->name('hrd.showpdf');
});

// {{-- --------Role HRD Route End --------- --}}

require __DIR__ . '/auth.php';
