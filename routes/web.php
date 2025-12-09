<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RkiaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // RKIA Routes
    Route::get('/rkia/timeline', [RkiaController::class, 'timeline'])->name('rkia.timeline');
    Route::get('/rkia/program', [RkiaController::class, 'program'])->name('rkia.program');

    // Laporan Routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // User Management Routes
    Route::resource('users', UserController::class);

    // Role Management Routes
    Route::resource('roles', RoleController::class);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
