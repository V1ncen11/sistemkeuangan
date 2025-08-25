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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_pengeluaran_id');
            $table->string('deskripsi');
            $table->decimal('jumlah', 15, 2);
            $table->date('tanggal');
            $table->timestamps();
        
            $table->foreign('jenis_pengeluaran_id')
                  ->references('id')
                  ->on('jenis_pengeluaran')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluaran');
    }
};
