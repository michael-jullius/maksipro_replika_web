<?php

namespace App\Imports;

use App\Models\Bahan;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class ImportBahan implements ToModel
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
        return new Bahan([
            'id_proyek'=>$this->id_proyek,
            'id_user'=>Auth::user()->id,
            'kelompok'=>$row[0],
            'sub_kelompok'=>$row[1],
            'kode'=>$row[2],
            'nama'=>$row[3],
            'satuan'=>$row[4],
            'harga'=>$row[5],
            'keterangan'=>$row[6],
        ]);
    }
}
