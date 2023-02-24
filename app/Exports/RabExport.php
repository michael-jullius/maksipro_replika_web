<?php

namespace App\Exports;

use App\Models\Rab;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class RabExport implements FromCollection
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
        return Rab::select('jenis_pekerjaan', 'lantai', 'kode_pekerjaan', 'nama_pekerjaan', 'kode_analisa', 'analisa', 'volume', 'satuan')->where('id_proyek', $this->id_proyek)->where('id_user', Auth::user()->id)->get();
    }
}
