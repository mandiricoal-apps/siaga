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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_pesanan');
            $table->json('makanan');
            $table->json('tanggal_pesanan');
            $table->time('waktu-pesanan');
            $table->string('shift');
            $table->json('jumlah_pesanan');
            $table->string('detail_karyawan');
            $table->text('catatan')->nullable();
            $table->string('status')->default('Menunggu');
            $table->text('lokasi_pengantaran');
            $table->text('alasan')->nullable();
            $table->text('alasan_pemesanan')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('id_user');
            $table->json('id_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
