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
            $table->date('tanggal_pesanan');
            $table->integer('jumlah_pesanan');
            $table->string('detail-karyawan');
            $table->text('catatan');
            $table->string('status');
            $table->date('tanggal_pemesanan');
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
