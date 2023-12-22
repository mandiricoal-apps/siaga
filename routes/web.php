<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DataMakanController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RedirectController;
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



Route::get('/prasmanan', [DataMakanController::class, 'prasmanan'])->name('component.taping');
Route::get('/packmeal', [DataMakanController::class, 'packmeal'])->name('component.packmeal');
Route::post('/proses-taping', [DataMakanController::class, 'simpanTaping'])->name('component.simpantaping');
Route::post('/proses-packmeal', [DataMakanController::class, 'simpanPackmeal'])->name('component.simpanpackmeal');
//All

Route::middleware('auth')->group(function () {
    Route::get('/read-notification/{id}', [UserController::class, 'markAsRead'])->name('read.notification');

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('home.dashboard'); //dashboard catering

    Route::get('/kelola-menu', [MenuController::class, 'kelola_menu'])->name('data.kelolamenu'); //kelola menu
    Route::get('/export/snack', [MenuController::class, 'exportSnack'])->name('export.snack');
    Route::get('/export/menu-spesial', [MenuController::class, 'exportMenus'])->name('export.menuspesial');
    Route::get('/export/menu-reguler', [MenuController::class, 'exportMenur'])->name('export.menureguler');

    Route::get('/data-makan', [DataMakanController::class, 'datataping'])->name('datamakan'); // data makan
    Route::get('/export/data-makan', [MenuController::class, 'exportDatamakan'])->name('export.datamakan');
    Route::get('/export/pesanan', [MenuController::class, 'exportPesanan'])->name('export.pesanan');
    Route::get('/mark-as-read', [OrderController::class, 'markAsRead'])->name('mark-as-read');
    Route::get('/profile', [UserController::class, 'vprofile'])->name('profile');
    Route::post('update-password', [UserController::class, 'upPassword'])->name('updatepassword');

    //Catering
    Route::get('/tambah-menu', [MenuController::class, 'tambah_menu'])->name('catering.tambahmenu'); //tambah menu
    Route::post('/proses-tambah-menu', [MenuController::class, 'add_menu'])->name('catering.addmenu'); //tambah menu
    Route::get('/data-snack/ubah/{id}', [MenuController::class, 'ubah_snack'])->name('ubahsnack'); //ubah snack
    Route::post('/data-snack/update/{id}', [MenuController::class, 'update_snack'])->name('updatesnack'); //update snack
    Route::get('/data-menu-spesial/ubah/{id}', [MenuController::class, 'ubah_menuspesial'])->name('ubahmenuspesial'); //ubah menu spesial
    Route::post('/data-menu-spesial/update/{id}', [MenuController::class, 'update_menuspesial'])->name('updatemenuspesial'); //update menu spesial
    Route::get('/data-menu-reguler/ubah/{id}', [MenuController::class, 'ubah_menureguler'])->name('ubahmenureguler'); //ubah menu reguler
    Route::post('/data-menu-reguler/update/{id}', [MenuController::class, 'update_menureguler'])->name('updatemenureguler'); //update menu reguler


    Route::get('/data-pesanan', [OrderController::class, 'data_pesanan'])->name('datapesanan'); //data pesanan
    Route::get('/proses-selesai/{id}', [OrderController::class, 'selesai'])->name('catering.ubahselesai'); //selesai
    //Departemen

    //GA
    Route::get('/permintaan-pesanan', [OrderController::class, 'permintaan_pesanan'])->name('permintaanpesanan'); //permintaan pesanan
    Route::get('/proses-setuju/{id}', [OrderController::class, 'setuju'])->name('setuju'); //terima pesanan others
    Route::post('/proses-tolak/{id}', [OrderController::class, 'tolak'])->name('tolak'); //tolak pesanan others

    Route::get('/kelola-pengguna', [UserController::class, 'kelolapengguna'])->name('kelolapengguna'); //kelola pengguna
    Route::post('/proses-tambah-pengguna', [UserController::class, 'add_user'])->name('adduser'); //tambah user
    Route::post('/proses-ubah-pengguna/{id}', [UserController::class, 'update_user'])->name('updateuser'); //update user

    //Departemen & GA
    Route::get('/jadwal-menu', [MenuController::class, 'jadwal_menu'])->name('jadwalmenu'); //jadwal menu
    Route::get('/data-menu', [MenuController::class, 'kelola_menu'])->name('datamenu'); //data menu
    Route::get('/riwayat-pesanan', [OrderController::class, 'riwayat_pesanan'])->name('riwayatpesanan'); // riwayat pesanan
    Route::get('/ubah-pesanan/{id}', [OrderController::class, 'ubah_pesanan'])->name('ubahpesanan'); // ubah pesanan
    Route::get('/get-menu', [OrderController::class, 'getMenu'])->name('get.menu'); //mengambil menu yang tersedia pada form pesanan
    Route::post('/proses-pesanan', [OrderController::class, 'pesanan'])->name('pesan'); //pesan menu makanan
    Route::post('/cancel-pesanan/{id}', [OrderController::class, 'cancelpesanan'])->name('cancelpesan'); //cancel_pesanan
    Route::post('/update-pesanan/{id}', [OrderController::class, 'updatePesanan'])->name('update.pesanan'); //proses update pesanaan
    //HRD
    Route::get('/', function () {
        return redirect()->route('login');
    })->name('dashboard');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Auth::routes();
