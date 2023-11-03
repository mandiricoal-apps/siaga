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
            $table->dateTime('tanggal_pesanan');
            $table->integer('jumlah_pesanan');
            $table->string('detail_karyawan');
            $table->text('catatan')->nullable();
            $table->string('status')->default('Menunggu');
            $table->text('lokasi_pengantaran');
            $table->text('alasan')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('id_menu');
            $table->unsignedBigInteger('id_user');
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
