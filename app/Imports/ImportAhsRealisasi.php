<?php

namespace App\Imports;

use App\Models\AhsRealisasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;
use App\Models\Bahan;
use App\Models\QueryAhs;
use App\Models\QueryHargaSatuanAlat;
use App\Models\QueryHargaSatuanBahan;
use App\Models\QueryHargaSatuanUpah;
use App\Models\QueryHargaSatuanLain;

class ImportAhsRealisasi implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct($id_proyek)
    {
        $this->id_proyek = $id_proyek;
    }
    public function model(array $row)
    {
        $bahan = Bahan::where('id_proyek', $this->id_proyek)->where('id_user', Auth::user()->id);

        $AhsRealisasi = new AhsRealisasi();
        $AhsRealisasi->id_user = Auth::user()->id;
        $AhsRealisasi->id_proyek = $this->id_proyek;
        $AhsRealisasi->kelompok = $row[0];
        $AhsRealisasi->kode = $row[1];
        $AhsRealisasi->keterangan = $row[2];
        $AhsRealisasi->id_bahan = $row[3];
        $AhsRealisasi->koefisien = $row[4];
        $AhsRealisasi->save();

        if ($AhsRealisasi) {
            $qahs = new QueryAhs();
            $qahs->id_proyek = $this->id_proyek;
            $qahs->id_user = Auth::user()->id;
            $qahs->kode = $AhsRealisasi->kode;
            $qahs->keterangan = $AhsRealisasi->keterangan;
            $qahs->id_bahan = $AhsRealisasi->id_bahan;
            $qahs->nama = $bahan->where('kode', $AhsRealisasi->id_bahan)->first()->nama;
            $qahs->satuan = $bahan->where('kode', $AhsRealisasi->id_bahan)->first()->satuan;
            $qahs->harga = $bahan->where('kode', $AhsRealisasi->id_bahan)->first()->harga;
            $qahs->koefisien = $AhsRealisasi->koefisien;
            $qahs->jumlah = (float)$bahan->where('kode', $AhsRealisasi->id_bahan)->first()->harga * (float)$AhsRealisasi->koefisien;
            $qahs->save();
            
        }
    }
}
