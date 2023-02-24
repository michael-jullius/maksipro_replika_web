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
        Schema::create('tb_query_ahs_pake', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proyek')->references('id')->on('tb_proyek')->onDelete('cascade');
            $table->foreignId('id_user')->references('id')->on('tb_user')->onDelete('cascade');
            $table->string('jenis_pekerjaan');
            $table->string('lantai');
            $table->string('kode_analisa');
            $table->string('kode_pekerjaan');
            $table->string('analisa');
            $table->string('satuan_ahs');
            $table->string('nama_pekerjaan');
            $table->string('volume');
            $table->string('id_bahan');
            $table->string('nama');
            $table->string('satuan');
            $table->string('koefisien');
            $table->string('harga_satuan');
            $table->string('jumlah');
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
        Schema::dropIfExists('tb_query_ahs_pake');
    }
};
