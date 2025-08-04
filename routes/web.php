<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
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

use Illuminate\Support\Facades\View;

Route::get('/halutama', [HalutamaController::class, 'index'])->name('halutama');

Route::get('/siswa',[SiswaController::class, 'index'])->name('siswa');
Route::get('/tambahsiswa/{kelas}/{jurusan}', [SiswaController::class, 'tambah'])->name('tambahsiswa');
Route::post('/siswasimpan', [SiswaController::class, 'simpan'])->name('siswasimpan');

//DELETE//
Route::DELETE('/hapussiswa/{id}', [SiswaController::class, 'hapus'])->name('hapussiswa');



