<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\JenisPembayaranController;
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

//SISWA KELAS XI
Route::get('/siswa/kelasXI',[SiswaController::class, 'indexXI'])->name('siswakelasXI');
Route::get('/tambahsiswa/kelasXI',[SiswaController::class, 'tambahXI'])->name('tambahsiswakelasXI');
Route::post('/simpansiswa/kelasXI',[SiswaController::class, 'simpanXI'])->name('simpansiswakelasXI');
Route::get('/siswaedit/{id}/kelasXI', [SiswaController::class, 'editXI'])->name('editsiswaXI');
Route::put('/siswaupdate/{id}', [SiswaController::class, 'updateXI'])->name('updatesiswaXI');
//DELETE
Route::DELETE('/hapussiswaXI/{id}', [SiswaController::class, 'hapusXI'])->name('hapussiswaXI');

//SISWA KELAS XII
Route::get('/siswa/kelasXII', [SiswaController::class, 'indexXII'])->name('siswakelasXII');
Route::get('/tambahsiswa/kelasXII', [SiswaController::class, 'tambahXII'])->name('tambahsiswaXII');
Route::post('/siswasimpan/kelasXII', [SiswaController::class, 'simpanXII'])->name('simpansiswaXII');
Route::get('/siswaedit/{id}/kelasXII', [SiswaController::class, 'editXII'])->name('editsiswaXII');
Route::put('/siswaupdate/{id}/kelasXII', [SiswaController::class, 'updateXII'])->name('updatesiswaXII');
Route::delete('/siswahapus/{id}/kelasXII', [SiswaController::class, 'hapusXII'])->name('hapussiswaXII');

//transaksi
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');

//jenis pembayaran
Route::get('/jenispembayaran', [JenisPembayaranController::class, 'index'])->name('jenispembayaran');
Route::get('/get-jenis-pembayaran/{nis}', [JenisPembayaranController::class, 'getJenisPembayaranByNIS'])->name('get.jenis-pembayaran');
Route::get('/jenis-pembayaran/create', [JenisPembayaranController::class, 'create'])->name('jenis-pembayaran.create');
Route::post('/jenis-pembayaran', [JenisPembayaranController::class, 'store'])->name('jenis-pembayaran.store');




