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
        Schema::create('tb_input_material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('tb_user')->onDelete('cascade');
            $table->date('tanggal_transaksi');
            $table->string('no_bukti');
            $table->string('nama_supplier');
            $table->string('keterangan');
            $table->string('kode_material');
            $table->string('nama_material');
            $table->string('satuan');
            $table->string('harga_satuan');
            $table->string('jumlah_masuk');
            $table->string('nama_pekerjaan');
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
        Schema::dropIfExists('tb_input_material');
    }
};
