<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    KelasController,
    SiswaController,
    TahunAjaranController,
};

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
    return view('welcome');
});

Route::group([
    'middleware' => ['auth', 'role:admin|guru|siswa|ortu']
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group([
        'middleware' => 'role:admin'
    ], function () {
        // Tahun Pelajaran
        Route::get('tahun-ajaran/data', [TahunAjaranController::class, 'data'])->name('tahun-ajaran.data');
        Route::resource('tahun-ajaran', TahunAjaranController::class)->except('create', 'edit');
        Route::put('/tahun-ajaran/{id}/update-status', [TahunAjaranController::class, 'updateStatus'])->name('tahun-ajaran.updateStatus');

        // Kelas
        Route::get('kelas/data', [KelasController::class, 'data'])->name('kelas.data');
        Route::resource('kelas', KelasController::class)->except('create', 'edit');

        // Siswa
        Route::get('kesiswaan/data', [SiswaController::class, 'data'])->name('kesiswaan.data');
        Route::resource('kesiswaan', SiswaController::class)->except('create', 'edit');
        Route::get('kesiswaan/{id}/detail', [SiswaController::class, 'detail'])->name('kesiswaan.detail');
    });
});
