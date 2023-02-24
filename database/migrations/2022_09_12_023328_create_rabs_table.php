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
        Schema::create('tb_rab', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proyek')->references('id')->on('tb_proyek')->onDelete('cascade');
            $table->foreignId('id_user')->references('id')->on('tb_user')->onDelete('cascade');
            $table->string('jenis_pekerjaan');
            $table->string('lantai');
            $table->string('kode_pekerjaan');
            $table->string('nama_pekerjaan');
            $table->string('kode_analisa');
            $table->string('analisa');
            $table->string('volume');
            $table->string('satuan');
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
        Schema::dropIfExists('tb_rab');
    }
};
