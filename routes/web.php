<?php

use App\Http\Controllers\AbsenSantriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RapotController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::get('/', function() {
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/permissions', [PermissionController::class, 'index'])->middleware('auth');
Route::post('/permissions', [PermissionController::class, 'store'])->middleware('auth');
Route::get('/permissions/{id}', [PermissionController::class, 'edit'])->middleware('auth');
Route::patch('/permissions/{permission}', [PermissionController::class, 'update'])->middleware('auth');
Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->middleware('auth');
Route::resource('/roles', RoleController::class)->middleware('auth');
Route::get('/users/guru', [GuruController::class, 'create'])->middleware('auth')->name('guru.create');
Route::post('/users/guru', [GuruController::class, 'store'])->middleware('auth')->name('guru.store');
Route::get('/users/guru/{id}/edit', [GuruController::class, 'edit'])->middleware('auth')->name('guru.edit');
Route::put('/users/guru/{id}edit', [GuruController::class, 'update'])->middleware('auth')->name('guru.update');
Route::get('/users/ortu', [UserController::class, 'createortu'])->middleware('auth')->name('ortu.create');
Route::post('/users/ortu', [UserController::class, 'storeortu'])->middleware('auth')->name('ortu.store');
Route::get('/users/ortu/{id}/edit', [UserController::class, 'editortu'])->middleware('auth')->name('ortu.edit');
Route::put('/users/ortu/{id}edit', [UserController::class, 'updateortu'])->middleware('auth')->name('ortu.update');
Route::resource('/users', UserController::class)->middleware('auth');
Route::resource('/kelas', KelasController::class)->middleware('auth');
Route::resource('/santri', SantriController::class)->middleware('auth');
Route::get('/mapelnilai/{id}', [MataPelajaranController::class, 'createnilai'])->middleware('auth')->name('nilai.create');
Route::post('/mapelnilai/{id}', [MataPelajaranController::class, 'storenilai'])->middleware('auth')->name('nilai.store');
Route::get('/mapelnilaiedit/{id}', [MataPelajaranController::class, 'editnilai'])->middleware('auth')->name('nilai.edit');
Route::put('/mapelnilaiedit/{id}', [MataPelajaranController::class, 'updatenilai'])->middleware('auth')->name('nilai.update');
Route::resource('/mapel', MataPelajaranController::class)->middleware('auth');
Route::resource('/jadwal', JadwalController::class)->middleware('auth');
Route::get('/rapot/santri', [RapotController::class, 'ortusantri'])->middleware('auth')->name('ortu.santri');
Route::resource('/rapot', RapotController::class)->middleware('auth');
Route::get('/rapot/{kelasId}/santri', [RapotController::class, 'listsantri'])->middleware('auth')->name('list.santri');
Route::get('/rapot/{kelasId}/santri/{santriId}', [RapotController::class, 'createRapot'])->middleware('auth')->name('createrapot.santri');
Route::post('/rapot/{kelasId}/santri/{santriId}', [RapotController::class, 'storeRapot'])->middleware('auth')->name('storerapot.santri');
Route::get('/rapot/showrapot/{santriId}/{semester}', [RapotController::class, 'rapotSantri'])->middleware('auth')->name('showrapot.santri');
Route::get('/jadwal/{id}/absen', [AbsenSantriController::class, 'create'])->middleware('auth')->name('absen.create');
Route::get('/jadwal/{id}/absen/edit', [AbsenSantriController::class, 'edit'])->middleware('auth')->name('absen.edit');
Route::post('/jadwal/{id}/absen', [AbsenSantriController::class, 'store'])->middleware('auth')->name('absensisantri');
Route::delete('/jadwal/{id}/absen/edit', [AbsenSantriController::class, 'destroy'])->name('absen.destroy');
Route::get('/my-account', [MyAccountController::class, 'show'])->middleware('auth');
Route::post('/my-account', [MyAccountController::class, 'updateAccount'])->middleware('auth');
Route::post('/my-account/update-password', [MyAccountController::class, 'updatePassword'])->middleware('auth');