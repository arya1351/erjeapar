<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HrdController;
use App\Http\Controllers\KepalabagianController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('pelaksana.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/kepalabagian/dashboard', [KepalabagianController::class, 'dashboard'])->name('kepalabagian.dashboard');
    Route::get('/admin/operatortable', [KepalabagianController::class, 'operatortable'])->name('kepalabagian.operatortable');
});

Route::middleware(['auth', 'role:hrd'])->group(function(){
    Route::get('/hrd/dashboard', [HrdController::class, 'dashboard'])->name('hrd.dashboard');
});

require __DIR__.'/auth.php';
