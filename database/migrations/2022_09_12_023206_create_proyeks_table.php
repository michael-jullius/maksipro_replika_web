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
        Schema::create('tb_proyek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('tb_user')->onDelete('cascade');
            $table->string('nama_pemilik');
            $table->string('alamat_pemilik');
            $table->string('no_tlp_rumah_pemilik');
            $table->string('no_tlp_pemilik');
            $table->string('no_tlp_kantor_pemilik');
            $table->string('fax');
            $table->string('email');
            $table->string('nama_proyek');
            $table->string('alamat_proyek');
            $table->string('Kota_Kabupaten');
            $table->string('provinsi');
            $table->datetime('tgl_mulai_pengajuan');
            $table->datetime('tgl_berakhir_pengajuan');
            $table->datetime('tgl_lelang');
            $table->datetime('tgl_mulai_pelaksanaan');
            $table->datetime('tgl_berakhir_pelaksanaan');
            $table->string('no_kontrak');
            $table->datetime('tgl_kontrak');
            $table->string('no_spk');
            $table->datetime('tanggal_spk');
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
        Schema::dropIfExists('tb_proyek');
    }
};
