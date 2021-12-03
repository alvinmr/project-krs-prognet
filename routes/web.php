<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('mahasiswa/')->name('mahasiswa.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [MahasiswaController::class, 'showLogin'])->name('showLogin');
        Route::post('login', [MahasiswaController::class, 'login'])->name('login');
    });
    Route::post('logout', [MahasiswaController::class, 'logout'])->name('logout');
    Route::get('dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard')->middleware('auth:mahasiswa');
});

Route::prefix('pegawai/')->name('pegawai.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [PegawaiController::class, 'showLogin'])->name('showLogin');
        Route::post('login', [PegawaiController::class, 'login'])->name('login');
    });
    Route::post('logout', [PegawaiController::class, 'logout'])->middleware('auth:pegawai');
    Route::get('dashboard', [PegawaiController::class, 'dashboard'])->name('dashboard')->middleware('auth:pegawai');
    Route::get('matakuliah', [PegawaiController::class, 'showTableMatakuliah'])->name('matakuliah-index')->middleware('auth:pegawai');
    Route::get('matakuliah/create', [PegawaiController::class, 'showCreateFormMatakuliah'])->name('matakuliah-create')->middleware('auth:pegawai');
    Route::post('matakuliah/create', [PegawaiController::class, 'storeMatakuliah'])->name('matakuliah-store')->middleware('auth:pegawai');
    // ini fernando
});
