<?php

use App\Http\Controllers\DosenResource;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaResource;
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

Route::get('/', function () {
    return redirect()->route('mahasiswa.login');
});

Route::prefix('mahasiswa/')->name('mahasiswa.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [MahasiswaController::class, 'showLogin'])->name('showLogin');
        Route::post('login', [MahasiswaController::class, 'login'])->name('login');
    });
    Route::get('/', function () {
        return redirect()->route('mahasiswa.login');
    });
    Route::post('logout', [MahasiswaController::class, 'logout'])->name('logout');
    Route::get('dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard')->middleware('auth:mahasiswa');
});

Route::prefix('pegawai/')->name('pegawai.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [PegawaiController::class, 'showLogin'])->name('showLogin');
        Route::post('login', [PegawaiController::class, 'login'])->name('login');
    });
    Route::get('/', function () {
        return redirect()->route('pegawai.login');
    });
    Route::middleware('auth:pegawai')->group(function () {
        Route::post('logout', [PegawaiController::class, 'logout']);
        Route::get('dashboard', [PegawaiController::class, 'dashboard'])->name('dashboard');
        // Route CRUD mahasiswa 
        Route::resource('mahasiswa', MahasiswaResource::class);
        // Route matakuliah
        Route::get('matakuliah', [PegawaiController::class, 'showTableMatakuliah'])->name('matakuliah-index');
        Route::get('matakuliah/create', [PegawaiController::class, 'showCreateFormMatakuliah'])->name('matakuliah-create');
        Route::post('matakuliah/create', [PegawaiController::class, 'storeMatakuliah'])->name('matakuliah-store');
        // Route CRUD dosen
        Route::resource('dosen', DosenResource::class);
    });
    // ini fernando
});