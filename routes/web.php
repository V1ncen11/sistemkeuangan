<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\JenisPembayaranController;
use App\Http\Controllers\JenisPengeluaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HalutamaController;
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



Route::get('/', [HalutamaController::class, 'index'])->name('halutama');

//SISWA KELAS X
Route::get('/siswakelasX',[SiswaController::class, 'index'])->name('siswa');
Route::get('/tambahsiswa/{kelas}/{jurusan}', [SiswaController::class, 'tambah'])->name('tambahsiswa');
Route::post('/siswasimpan', [SiswaController::class, 'simpan'])->name('siswasimpan');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('editsiswa');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('updatesiswa');
//DELETE
Route::DELETE('/hapussiswa/{id}', [SiswaController::class, 'hapus'])->name('hapussiswa');
Route::patch('/siswa/{id}/naik-kelas-X', [SiswaController::class, 'naikkelasX'])->name('siswaXnaikkelas');


//SISWA KELAS XI
Route::get('/siswa/kelasXI',[SiswaController::class, 'indexXI'])->name('siswakelasXI');
Route::get('/tambahsiswa/kelasXI',[SiswaController::class, 'tambahXI'])->name('tambahsiswakelasXI');
Route::post('/simpansiswa/kelasXI',[SiswaController::class, 'simpanXI'])->name('simpansiswakelasXI');
Route::get('/siswaedit/{id}/kelasXI', [SiswaController::class, 'editXI'])->name('editsiswaXI');
Route::put('/siswaupdate/{id}', [SiswaController::class, 'updateXI'])->name('updatesiswaXI');
//DELETE
Route::DELETE('/hapussiswaXI/{id}', [SiswaController::class, 'hapusXI'])->name('hapussiswaXI');
Route::patch('/siswa/{id}/naik-kelas-XI', [SiswaController::class, 'naikkelasXI'])->name('siswaXInaikkelas');

//SISWA KELAS XII
Route::get('/siswa/kelasXII', [SiswaController::class, 'indexXII'])->name('siswakelasXII');
Route::get('/tambahsiswa/kelasXII', [SiswaController::class, 'tambahXII'])->name('tambahsiswaXII');
Route::post('/siswasimpan/kelasXII', [SiswaController::class, 'simpanXII'])->name('simpansiswaXII');
Route::get('/siswaedit/{id}/kelasXII', [SiswaController::class, 'editXII'])->name('editsiswaXII');
Route::put('/siswaupdate/{id}/kelasXII', [SiswaController::class, 'updateXII'])->name('updatesiswaXII');
Route::delete('/siswahapus/{id}/kelasXII', [SiswaController::class, 'hapusXII'])->name('hapussiswaXII');
Route::patch('/siswa/lulus/{id}', [SiswaController::class, 'lulus'])->name('lulusSiswa');


//Alumni
Route::get('data_alumni', [SiswaController::class, 'indexalumn'])->name('dataalumni');
Route::delete('/alumni/{id}', [SiswaController::class, 'hapusalumn'])->name('hapusalumni');

//transaksi
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
Route::get('/pembayaran/get-siswa/{id}', [PembayaranController::class, 'getPembayaran'])->name('getpembayaran');
Route::get('/pembayaran/get-tagihan/{siswa_id}/{jenis_id}', [PembayaranController::class, 'getTagihan'])->name('gettagihan');
Route::get('/pembayaran/filter', [PembayaranController::class, 'filter'])->name('pembayaran.filter');
Route::post('/pembayaran/save', [PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/pembayaran/detail/{nis}', [PembayaranController::class, 'getDetailPembayaran'])->name('detailpembayaran');
Route::get('/pembayaran/history/{nis}', [PembayaranController::class, 'getHistoryPembayaran'])->name('historypembayaran');

//jenis pembayaran
Route::get('/jenispembayaran', [JenisPembayaranController::class, 'index'])->name('jenispembayaran');
Route::get('/get-jenis-pembayaran/{nis}', [JenisPembayaranController::class, 'getJenisPembayaranByNIS'])->name('get.jenis-pembayaran');
Route::get('/jenis-pembayaran/create', [JenisPembayaranController::class, 'create'])->name('jenis-pembayaran.create');
Route::post('/jenis-pembayaran', [JenisPembayaranController::class, 'store'])->name('jenis-pembayaran.store');
Route::delete('/jenis-pembayaran/{id}', [JenisPembayaranController::class, 'destroy']) ->name('jenis-pembayaran.destroy');

//jenis pengeluaran
Route::get('/jenis-pengeluaran',[JenisPengeluaranController::class, 'index'])->name('jenis_pengeluaran');
Route::get('/jenis-pengeluaran/create',[JenisPengeluaranController::class, 'create'])->name('jenis_pengeluaran.create');
Route::post('/jenis-pengeluaran/save',[JenisPengeluaranController::class, 'store'])->name('jenis_pengeluaran.store');

//pengeluaran
Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
Route::post('/pengeluaran/store', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
//Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});




