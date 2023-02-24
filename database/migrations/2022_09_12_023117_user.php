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
        Schema::create('tb_user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->text('password');
            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('kota_kabupaten');
            $table->string('no_tlp');
            $table->string('npwp');
            $table->string('nomor_siup_tdp');
            $table->string('nama_direktur');
            $table->string('nama_estimator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_user');
    }
};
