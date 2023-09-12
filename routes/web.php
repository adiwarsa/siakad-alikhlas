<?php

use App\Http\Controllers\AbsenSantriController;
use App\Http\Controllers\DashboardController;
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
Route::get('/asd/{id}', [RapotController::class, 'create'])->middleware(['auth', 'verified']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/permissions', [PermissionController::class, 'index'])->middleware('auth');
Route::post('/permissions', [PermissionController::class, 'store'])->middleware('auth');
Route::get('/permissions/{id}', [PermissionController::class, 'edit'])->middleware('auth');
Route::patch('/permissions/{permission}', [PermissionController::class, 'update'])->middleware('auth');
Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->middleware('auth');
Route::resource('/roles', RoleController::class)->middleware('auth');
Route::resource('/users', UserController::class)->middleware('auth');
Route::resource('/kelas', KelasController::class)->middleware('auth');
Route::resource('/santri', SantriController::class)->middleware('auth');
Route::get('/mapel/{id}', [MataPelajaranController::class, 'createnilai'])->middleware('auth')->name('nilai.create');
Route::post('/mapel/{id}', [MataPelajaranController::class, 'storenilai'])->middleware('auth')->name('nilai.store');
Route::resource('/mapel', MataPelajaranController::class)->middleware('auth');
Route::resource('/jadwal', JadwalController::class)->middleware('auth');
Route::get('/jadwal/{id}/absen', [AbsenSantriController::class, 'create'])->middleware('auth')->name('absen.create');
Route::get('/jadwal/{id}/absen/edit', [AbsenSantriController::class, 'edit'])->middleware('auth')->name('absen.edit');
Route::post('/jadwal/{id}/absen', [AbsenSantriController::class, 'store'])->middleware('auth')->name('absensisantri');
Route::delete('/jadwal/{id}/absen/edit', [AbsenSantriController::class, 'destroy'])->name('absen.destroy');
Route::get('/my-account', [MyAccountController::class, 'show'])->middleware('auth');
Route::post('/my-account', [MyAccountController::class, 'updateAccount'])->middleware('auth');
Route::post('/my-account/update-password', [MyAccountController::class, 'updatePassword'])->middleware('auth');