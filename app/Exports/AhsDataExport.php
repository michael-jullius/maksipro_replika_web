<?php

namespace App\Exports;

use App\Models\AhsData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Auth;

class AhsDataExport implements FromCollection
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
        return AhsData::select('jenis_pekerjaan', 'kode', 'analisa_pekerjaan', 'satuan')->where('id_user', Auth::user()->id)->where('id_proyek', $this->id_proyek)->get();
    }
}
