<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    KelasController,
    RombelController,
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
        Route::get('kesiswaan/kesiswaan-detail/{id}', [SiswaController::class, 'detail'])->name('kesiswaan.detail');
        Route::post('/kesiswaan/upload_excel', [SiswaController::class, 'importSiswaExcel'])->name('kesiswaan.import.excel');

        // Rombel
        Route::get('rombel/data', [RombelController::class, 'data'])->name('rombel.data');
        Route::get('rombel/data-siswa', [RombelController::class, 'getAllSiswa'])->name('rombel.siswa.data');
        Route::resource('rombel', RombelController::class)->except('create', 'edit');
        Route::get('/rombel/rombel-detail/{id}', [RombelController::class, 'detail'])->name('rombel.detail');
        Route::post('/rombel/{id}/tambah-siswa/', [RombelController::class, 'siswaStore'])->name('rombel.tambah.siswa');
        Route::delete('/rombel/delete-siswa/{id}', [RombelController::class, 'siswaDestroy'])->name('rombel.siswa.destroy');
    });
});
