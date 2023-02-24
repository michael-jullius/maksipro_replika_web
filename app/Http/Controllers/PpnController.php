<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppn;
use App\Http\Requests\StorePpnRequest;
use App\Http\Requests\UpdatePpnRequest;
use Auth;

class PpnController extends Controller
{
    public function insert_ppn(Request $request, $id_proyek)
    {
        if(is_null(Ppn::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->first())){
            $ppn = new Ppn();
            $ppn->id_user = Auth::user()->id;
            $ppn->id_proyek = Auth::user()->Proyek->where('id', $id_proyek)->first()->id;
            $ppn->kontraktor = $request->jasa_kontraktor;
            $ppn->ppn = $request->ppn;
            $ppn->save();
        }else {
            $ppn = Ppn::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->first();
            $ppn->id_user = Auth::user()->id;
            $ppn->id_proyek = Auth::user()->Proyek->where('id', $id_proyek)->first()->id;
            $ppn->kontraktor = $request->jasa_kontraktor;
            $ppn->ppn = $request->ppn;
            $ppn->update();
        }
        

        return redirect()->route('view_preview_rab', $id_proyek);
    }
}
