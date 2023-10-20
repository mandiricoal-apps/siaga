<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


//catering

Route::middleware(['auth', 'isCatering'])->group(function () {
    Route::prefix('catering')->group(function () {
        Route::get('/dashboard', [Controller::class, 'dashboard_catering'])->name('home.dashboard_catering'); //dashboard catering
        Route::get('/tambah-menu', [MenuController::class, 'tambah_menu'])->name('catering.tambahmenu'); //tambah menu
        Route::get('/data-snack', [MenuController::class, 'kelola_snack'])->name('catering.kelolasnack'); //kelola snack
        Route::get('/data-menu-spesial', [MenuController::class, 'kelola_menuspesial'])->name('catering.kelolamenuspesial'); //kelola menu spesial
        Route::get('/data-snack/ubah/{id}', [MenuController::class, 'ubah_snack'])->name('catering.ubahsnack'); //ubah snack
        Route::post('/data-snack/update/{id}', [MenuController::class, 'update_snack'])->name('catering.updatesnack'); //update snack
        Route::get('/data-menu-spesial/ubah/{id}', [MenuController::class, 'ubah_menuspesial'])->name('catering.ubahmenuspesial'); //ubah menu spesial
        Route::post('/data-menu-spesial/update/{id}', [MenuController::class, 'update_menuspesial'])->name('catering.updatemenuspesial'); //update menu spesial
        Route::get('/data-pesanan', [OrderController::class, 'data_pesanan'])->name('catering.datapesanan'); //data pesanan
        Route::post('/proses-tambah-menu', [MenuController::class, 'add_menu'])->name('catering.addmenu'); //tambah menu
    });
});

Route::middleware(['auth', 'isDepartemen'])->group(function () {
    Route::prefix('departemen')->group(function () {
        Route::get('/dashboard', [Controller::class, 'dashboard_departemen'])->name('home.dashboard_departemen'); //dashboard departemen
        Route::get('/pesan-menu', [OrderController::class, 'depart_pesan_menu'])->name('departemen.pesanmenu'); // request pesanan
        Route::get('/riwayat-pesanan', [OrderController::class, 'depart_riwayat_pesanan'])->name('departemen.riwayatpesanan'); // riwayat pesanan
        Route::get('/ubah-pesanan', [OrderController::class, 'depart_ubah_pesanan'])->name('departemen.ubahpesanan'); // ubah pesanan
        Route::get('/data-snack', [MenuController::class, 'depart_snack'])->name('departemen.datasnack'); //data snack departemen
        Route::get('/data-menu-spesial', [MenuController::class, 'depart_menuspesial'])->name('departemen.datamenuspesial'); //data menu spesial departemen
    });
});

Route::middleware(['auth', 'isGA'])->group(function () {
    Route::prefix('ga')->group(function () {
        Route::get('/dashboard', [Controller::class, 'dashboard_ga'])->name('home.dashboard_ga'); //dashboard departemen
        Route::get('/pesan-menu', [OrderController::class, 'ga_pesan_menu'])->name('ga.pesanmenu'); // request pesanan
        Route::get('/riwayat-pesanan', [OrderController::class, 'ga_riwayat_pesanan'])->name('ga.riwayatpesanan'); // riwayat pesanan
        Route::get('/ubah-pesanan', [OrderController::class, 'ga_ubah_pesanan'])->name('ga.ubahpesanan'); // ubah pesanan
        Route::get('/data-snack', [MenuController::class, 'ga_snack'])->name('ga.datasnack'); //data snack ga
        Route::get('/data-menu-spesial', [MenuController::class, 'ga_menuspesial'])->name('ga.datamenuspesial'); //data menu spesial ga
        Route::get('/permintaan-pesanan', [OrderController::class, 'ga_permintaan_pesanan'])->name('ga.permintaanpesanan'); //data menu spesial ga
    });
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
