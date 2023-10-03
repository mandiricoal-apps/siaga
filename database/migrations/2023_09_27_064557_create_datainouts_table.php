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
        Schema::create('datainouts', function (Blueprint $table) {
            $table->id();
            $table->string('verifikasi');
            $table->string('mesin');
            $table->timestamp('tanggal_jam');

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
        Schema::dropIfExists('datainouts');
    }
};
