<?php

use App\Http\Controllers\DosenResource;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaResource;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KRSController;
use App\Http\Controllers\KRSPegawaiController;
use App\Http\Controllers\MatakuliahResource;
use App\Models\Matakuliah;
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
        Route::resource('matakuliah', MatakuliahResource::class);
        Route::resource('dosen', DosenResource::class);

        /* Route::post('matakuliah/create', [PegawaiController::class, 'storeMatakuliah'])->name('matakuliah-store'); */
        // Route CRUD dosen
        /* Route::resource('dosen', DosenResource::class)->name('dosen-index'); */

        /* krs pegawai*/
        Route::get('krs', [KRSPegawaiController::class, 'showTableKRS'])->name('krs-index');

        /* krs detail pegawai*/
        Route::get('krs/detail/{id}', [KRSPegawaiController::class, 'showDetailMatakuliah'])->name('krs-detail', 'id');

        /* krs-create pegawai */
        Route::get('krs/create', [KRSPegawaiController::class, 'showCreateTableKRS'])->name('krs-create');
        Route::post('krs/store/{id}', [KRSPegawaiController::class, 'storeKRS'])->name('krs-store', 'id');
        Route::post('krs/approve/{id}', [KRSPegawaiController::class, 'approve'])->name('krs-approve', 'id');
        Route::post('krs/decline/{id}', [KRSPegawaiController::class, 'decline'])->name('krs-decline', 'id');

        /* krs-edit pegawai */
        /* Route::get('krs/edit', [KRSPegawaiController::class, 'showEditTableKRS'])->name('krs-edit');*/
        /* Route::post('krs/storeedit', [KRSPegawaiController::class, 'storeEditTableKRS'])->name('krs-store-edit');*/

        /* krs-delete pegawai */
        /* Route::get('krs/delete', [KRSPegawaiController::class, 'showDeleteTableKRS'])->name('krs-delete');*/
        Route::post('krs/storedelete/{id}', [KRSPegawaiController::class, 'storeDeleteTableKRS'])->name('krs-store-delete', 'id');
        // ini fernando
        Route::post('logout', [PegawaiController::class, 'logout']);
        Route::get('dashboard', [PegawaiController::class, 'dashboard'])->name('dashboard');
        // Route CRUD mahasiswa 
        Route::resource('mahasiswa', MahasiswaResource::class);
        // Route matakuliah
        Route::resource('matakuliah', MatakuliahResource::class);
        Route::resource('dosen', DosenResource::class);

        /* Route::post('matakuliah/create', [PegawaiController::class, 'storeMatakuliah'])->name('matakuliah-store'); */
        // Route CRUD dosen
        /* Route::resource('dosen', DosenResource::class)->name('dosen-index'); */

        /* krs pegawai*/
        Route::get('krs', [KRSPegawaiController::class, 'showTableKRS'])->name('krs-index');

        /* krs detail pegawai*/
        Route::get('krs/detail/{id}', [KRSPegawaiController::class, 'showDetailMatakuliah'])->name('krs-detail', 'id');

        /* krs-create pegawai */
        Route::get('krs/create', [KRSPegawaiController::class, 'showCreateTableKRS'])->name('krs-create');
        Route::post('krs/store/{id}', [KRSPegawaiController::class, 'storeKRS'])->name('krs-store', 'id');
        Route::post('krs/approve/{id}', [KRSPegawaiController::class, 'approve'])->name('krs-approve', 'id');

        /* krs-edit pegawai */
        /* Route::get('krs/edit', [KRSPegawaiController::class, 'showEditTableKRS'])->name('krs-edit');*/
        /* Route::post('krs/storeedit', [KRSPegawaiController::class, 'storeEditTableKRS'])->name('krs-store-edit');*/

        /* krs-delete pegawai */
        /* Route::get('krs/delete', [KRSPegawaiController::class, 'showDeleteTableKRS'])->name('krs-delete');*/
        Route::post('krs/storedelete/{id}', [KRSPegawaiController::class, 'storeDeleteTableKRS'])->name('krs-store-delete', 'id');
        // ini fernando
    });
});
