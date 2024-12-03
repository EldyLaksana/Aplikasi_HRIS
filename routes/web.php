<?php


use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\CutiKaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\IzinSakitController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KaryawanKeluarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeringatanController;
use App\Http\Controllers\SakitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index']);

    // Karyawan
    Route::resource('karyawan', KaryawanController::class);

    Route::get('/karyawan/{id}/cetak_pdf', [KaryawanController::class, 'cetak_pdf']);

    Route::get('/karyawan/{id}/info', [KaryawanController::class, 'info']);

    Route::get('/karyawan/{id}/perbaruikontrak', [KaryawanController::class, 'kontrak']);

    Route::put('/perbaruikontrak/{id}', [KaryawanController::class, 'perbarui']);

    Route::get('/exportkaryawan', [ExportController::class, 'export_karyawan']);

    // End

    // Cuti Karyawan
    Route::get('/cutikaryawan/{id}', [CutiKaryawanController::class, 'index'])->name('cuti.index');

    Route::get('/cutikaryawan/{id}/create', [CutiKaryawanController::class, 'create']);

    Route::post('/cutikaryawan', [CutiKaryawanController::class, 'store']);

    Route::get('/cutikaryawan/{id}/edit', [CutiKaryawanController::class, 'edit']);

    Route::put('/cutikaryawan/{id}', [CutiKaryawanController::class, 'update']);

    Route::post('/cutikaryawan/{id}/reset', [CutiKaryawanController::class, 'destroy']);

    Route::get('/exportcutikaryawan/{id}', [ExportController::class, 'export_cutikaryawan']);
    // End

    // Absensi
    Route::get('/absensikaryawan/{id}', [AbsensiController::class, 'index']);

    Route::get('/absensikaryawan/{id}/create', [AbsensiController::class, 'create']);

    Route::post('/absensikaryawan', [AbsensiController::class, 'store']);

    Route::get('/absensikaryawan/{id}/edit', [AbsensiController::class, 'edit']);

    Route::put('/absensikaryawan/{id}', [AbsensiController::class, 'update']);

    Route::delete('/absensikaryawan/{id}', [AbsensiController::class, 'destroy']);
    // Route::post('/absensi/{id}/reset', [AbsensiController::class, 'destroy']);

    Route::get('/exportabsensi/{id}', [ExportController::class, 'export_absensi']);
    // End


    // Sakit
    Route::get('/sakitkaryawan/{id}', [SakitController::class, 'index'])->name('sakit.index');

    Route::get('/sakitkaryawan/{id}/create', [SakitController::class, 'create']);

    Route::post('/sakitkaryawan', [SakitController::class, 'store']);

    Route::get('/sakitkaryawan/{id}/edit', [SakitController::class, 'edit']);

    Route::put('/sakitkaryawan/{id}', [SakitController::class, 'update']);

    Route::delete('/sakitkaryawan/{id}', [SakitController::class, 'destroy']);

    Route::get('/exportsakit/{id}', [ExportController::class, 'export_sakit']);
    // End

    // Izin
    Route::get('/izinkaryawan/{id}', [IzinController::class, 'index'])->name('izin.index');

    Route::get('/izinkaryawan/{id}/create', [IzinController::class, 'create']);

    Route::post('/izinkaryawan', [IzinController::class, 'store']);

    Route::get('/izinkaryawan/{id}/edit', [IzinController::class, 'edit']);

    Route::put('/izinkaryawan/{id}', [IzinController::class, 'update']);

    Route::get('/exportizin/{id}', [ExportController::class, 'export_izin']);

    Route::delete('/izinkaryawan/{id}', [IzinController::class, 'destroy']);
    // End

    // Peringatan
    Route::get('/peringatankaryawan/{id}', [PeringatanController::class, 'index'])->name('peringatan.index');

    Route::get('/peringatankaryawan/{id}/create', [PeringatanController::class, 'create']);

    Route::post('/peringatankaryawan', [PeringatanController::class, 'store']);

    Route::get('/peringatankaryawan/{id}/edit', [PeringatanController::class, 'edit']);
    // Karyawan keluar
    Route::resource('/karyawankeluar', KaryawanKeluarController::class);

    Route::post('/karyawankeluar/{id}', [KaryawanKeluarController::class, 'store']);

    Route::get('/karyawankeluar/{id}/cetak_pdf', [KaryawanKeluarController::class, 'cetak_pdf']);

    Route::get('/exportkaryawankeluar', [ExportController::class, 'export_karyawankeluar']);
    // End

    Route::resource('/divisi', DivisiController::class);

    Route::resource('/jabatan', JabatanController::class);

    Route::resource('/cuti', CutiController::class);

    Route::resource('/departemen', DepartemenController::class);
});
