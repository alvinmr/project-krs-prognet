<?php

use App\Http\Controllers\DosenResource;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaResource;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KRSController;
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

    /* krs */
    Route::get('krs', [KRSController::class, 'showTableKRS'])->name('krs-index')->middleware('auth:mahasiswa');

    /* krs detail */
    Route::get('krs/detail/{id}', [KRSController::class, 'showDetailMatakuliah'])->name('krs-detail', 'id')->middleware('auth:mahasiswa');

    /* krs-create */
    Route::get('krs/create', [KRSController::class, 'showCreateTableKRS'])->name('krs-create')->middleware('auth:mahasiswa');
    Route::post('krs/store/{id}', [KRSController::class, 'storeKRS'])->name('krs-store', 'id')->middleware('auth:mahasiswa');

    /* krs-edit */
    Route::get('krs/edit', [KRSController::class, 'showEditTableKRS'])->name('krs-edit')->middleware('auth:mahasiswa');
    Route::post('krs/storeedit', [KRSController::class, 'storeEditTableKRS'])->name('krs-store-edit')->middleware('auth:mahasiswa');

    /* krs-delete */
    Route::get('krs/delete', [KRSController::class, 'showDeleteTableKRS'])->name('krs-delete')->middleware('auth:mahasiswa');
    Route::post('krs/storedelete/{id}', [KRSController::class, 'storeDeleteTableKRS'])->name('krs-store-delete', 'id')->middleware('auth:mahasiswa');
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
