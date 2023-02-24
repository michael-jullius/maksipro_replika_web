<?php

namespace App\Imports;

use App\Models\AhsData;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class ImportAhsData implements ToModel
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
        return new AhsData([
            'id_proyek' => $this->id_proyek,
            'id_user' => Auth::user()->id,
            'jenis_pekerjaan' => $row[0],
            'kode' => $row[1],
            'analisa_pekerjaan' => $row[2],
            'satuan' => $row[3],
        ]);
    }
}
