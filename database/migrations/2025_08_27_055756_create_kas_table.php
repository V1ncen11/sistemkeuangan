<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // tanggal transaksi
            $table->enum('tipe', ['masuk', 'keluar']); // tipe transaksi
            $table->unsignedBigInteger('pembayaran_id')->nullable(); // relasi ke pembayaran
            $table->unsignedBigInteger('pengeluaran_id')->nullable(); // relasi ke pengeluaran
            $table->string('sumber')->nullable(); // contoh: Donasi Alumni, Sponsor, dll
            $table->string('deskripsi')->nullable(); // keterangan tambahan
            $table->decimal('jumlah', 15, 2); // jumlah uang
            $table->timestamps();

            // relasi
            $table->foreign('pembayaran_id')->references('id')->on('pembayaran')->onDelete('set null');
            $table->foreign('pengeluaran_id')->references('id')->on('pengeluaran')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kas');
    }
};
