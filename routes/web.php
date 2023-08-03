<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('/persetujuan')->group(function() {
    Route::controller(App\Http\Controllers\AgreementController::class)->group(function() {
        Route::put('/{id}', 'agree')->name('persetujuan.terima');
        Route::get('/', 'index')->name('persetujuan');
    });
});

Route::prefix('/kendaraan')->group(function() {
    Route::controller(App\Http\Controllers\TransportUsageController::class)->group(function() {
        Route::post('/', 'create')->name('transport-usage.add');
        Route::get('/{id}', 'show')->name('transport-usage.show');
        Route::get('/', 'index')->name('transport-usage.riwayat');
        Route::post('/{id}', 'bbm')->name('transport-usage.update-BBM');
        Route::post('/{id}/penyetuju', 'update_penyetuju')->name('transport-usage.update-penyetuju');
    });
});

Route::prefix('/laporan')->group(function() {
    Route::controller(App\Http\Controllers\LaporanController::class)->group(function() {
        Route::get('/', 'index')->name('laporan.index');
    });
});

