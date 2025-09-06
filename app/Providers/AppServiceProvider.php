<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Kas;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Pagination pakai Bootstrap 5
        Paginator::useBootstrapFive();

        // View Composer: otomatis kirim data ke semua view
        View::composer('*', function ($view) {
            // Variabel lain
            $jumlahSiswa = Siswa::count();
            $totalTransaksi = Pembayaran::sum('jumlah');
        
            $kasMasuk = Kas::where('tipe', 'masuk')->sum('jumlah');
            $kasKeluar = Kas::where('tipe', 'keluar')->sum('jumlah');
            $kasSekolah = $kasMasuk - $kasKeluar;
            $totalPengeluaran = $kasKeluar;
        
            // Transaksi terbaru (5 terakhir)
            $transaksiTerbaru = Pembayaran::latest()->take(5)->get();
        
            $view->with(compact(
                'jumlahSiswa',
                'totalTransaksi',
                'kasMasuk',
                'kasKeluar',
                'kasSekolah',
                'totalPengeluaran',
                'transaksiTerbaru'
            ));
        });
    }
}
