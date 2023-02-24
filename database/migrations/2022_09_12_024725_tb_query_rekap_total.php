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
        Schema::create('tb_query_rekap_total', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proyek')->references('id')->on('tb_proyek')->onDelete('cascade');
            $table->foreignId('id_user')->references('id')->on('tb_user')->onDelete('cascade');
            $table->string('jenis_pekerjaan');
            $table->string('s_bahan');
            $table->string('s_upah');
            $table->string('s_alat');
            $table->string('s_lain');
            $table->string('s_jumlah');
            $table->string('j_bahan');
            $table->string('j_upah');
            $table->string('j_alat');
            $table->string('j_lain');
            $table->string('j_jumlah');
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
        Schema::dropIfExists('tb_query_rekap_total');
    }
};
