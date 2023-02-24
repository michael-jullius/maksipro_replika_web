<?php

namespace App\Exports;

use App\Models\Bahan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Auth;

class BahanExport implements FromCollection
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
        return Bahan::select('kelompok', 'sub_kelompok', 'kode', 'nama', 'satuan', 'harga', 'keterangan')->where('id_user', Auth::user()->id)->where('id_proyek', $this->id_proyek)->get();
    }
}
