<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DataBarangController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/export', [App\Http\Controllers\HomeController::class, 'export'])->name('export.excel');

Route::prefix('barang')->group(function () {
    // Data Barang
    Route::get('/dataBarang', [DataBarangController::class, 'index'])->name('barang.view');
    Route::post('/dataBarang/store', [DataBarangController::class, 'store'])->name('barang.store');
    Route::post('/dataBarang/update/{id}', [DataBarangController::class, 'update'])->name('barang.update');
    Route::get('/dataBarang/destroy/{id}', [DataBarangController::class, 'destroy'])->name('barang.destroy');
    
    // Barang Masuk
    Route::get('/masuk', [BarangMasukController::class, 'index'])->name('masuk.view');
    Route::post('/masuk/store', [BarangMasukController::class, 'store'])->name('masuk.store');
    Route::post('/masuk/update/{id}', [BarangMasukController::class, 'update'])->name('masuk.update');
    Route::get('/masuk/destroy/{id}', [BarangMasukController::class, 'destroy'])->name('masuk.destroy');
    
    // Barang Keluar
    Route::get('/keluar', [BarangKeluarController::class, 'index'])->name('keluar.view');
    Route::post('/keluar/store', [BarangKeluarController::class, 'store'])->name('keluar.store');
    Route::post('/keluar/update/{id}', [BarangKeluarController::class, 'update'])->name('keluar.update');
    Route::get('/keluar/destroy/{id}', [BarangKeluarController::class, 'destroy'])->name('keluar.destroy');
});
