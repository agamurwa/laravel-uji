<?php

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

// Route::get('/', 'HomeController@index');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
Route::get('/detail/{nama_dokter}', [App\Http\Controllers\DetailController::class, 'index'])
    ->name('detail');
Route::get('/schedule/{doctors_id}', [App\Http\Controllers\ScheduleController::class, 'index'])
    ->name('schedule');
Route::get('/jadwal', [App\Http\Controllers\JadwalDokterController::class, 'index'])
    ->name('jadwal');
Route::get('/rawat-jalan', [App\Http\Controllers\RawatJalanController::class, 'index'])
    ->name('layanan');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/pasien/json', [App\Http\Controllers\Admin\AddRekamMedisController::class, 'data'])
    ->name('pasien.data');
Route::get('/add-rekam-medis', [App\Http\Controllers\Admin\AddRekamMedisController::class, 'index'])
    ->name('pages.admin.add-rekam-medis.index');

Route::prefix('office')
    ->namespace('Admin')
    ->middleware('auth','admin')
    ->group(function() {
        // Route::get('/', 'DashboardController@index')
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('dashboard');
        Route::get('/cetak-pendaftaran/{id}', [App\Http\Controllers\Admin\DataPendaftaranController::class, 'cetak_PDF'])
        ->name('cetak-pendaftaran');
        // Route::get('/tagihan/{id}', [App\Http\Controllers\Admin\RekamMedisController::class, 'tagihan'])
        // ->name('tagihan');
        Route::get('/cetak-tagihan/{id}', [App\Http\Controllers\Admin\RekamMedisController::class, 'cetak_PDF'])
        ->name('cetak-tagihan');

        Route::resource('data-dokter', '\App\Http\Controllers\Admin\DataDokterController');
        Route::resource('data-pasien', '\App\Http\Controllers\Admin\DataPasienController');
        Route::resource('rekam-medis', '\App\Http\Controllers\Admin\RekamMedisController');
        Route::resource('add-rekam-medis', '\App\Http\Controllers\Admin\AddRekamMedisController');
        Route::resource('gallery', '\App\Http\Controllers\Admin\GalleryController');
        Route::resource('jadwal-dokter', '\App\Http\Controllers\Admin\ScheduleController');
        Route::resource('pengguna', '\App\Http\Controllers\Admin\UserController');
        Route::resource('obat', '\App\Http\Controllers\Admin\ObatController');
        Route::resource('pendaftaran', '\App\Http\Controllers\Admin\PendaftaranController');
        Route::resource('data-pendaftaran', '\App\Http\Controllers\Admin\DataPendaftaranController');
        Route::resource('profil-klinik', '\App\Http\Controllers\Admin\ProfilKlinikController');
    });

Auth::routes(['verify' => true]);
