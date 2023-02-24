<?php

namespace App\Exports;

use App\Models\AhsRealisasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Auth;

class AhsRealisasiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($id_proyek)
    {
    	return $this->id_proyek = $id_proyek;
    }
    public function collection()
    {
        return AhsRealisasi::select('kelompok', 'kode', 'keterangan', 'id_bahan', 'koefisien')->where('id_user', Auth::user()->id)->where('id_proyek', $this->id_proyek)->get();
    }
}
