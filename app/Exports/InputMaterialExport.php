<?php

namespace App\Exports;

use App\Models\InputMaterial;
use Maatwebsite\Excel\Concerns\FromCollection;
use Auth;

class InputMaterialExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return InputMaterial::where('id_user', Auth::user()->id)->orderBy('tanggal_transaksi')->get();
    }
}
