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
        Schema::create('tb_ahs_realisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('tb_user')->onDelete('cascade');
            $table->foreignId('id_proyek')->references('id')->on('tb_proyek')->onDelete('cascade');
            $table->string('kelompok', 100);
            $table->string('kode', 100);
            $table->string('keterangan', 100);
            $table->string('id_bahan', 100);
            $table->string('koefisien');
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
        Schema::dropIfExists('tb_ahs_realisasi');
    }
};
