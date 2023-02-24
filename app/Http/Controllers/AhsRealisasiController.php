<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAhsRealisasiRequest;
use App\Http\Requests\UpdateAhsRealisasiRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AhsRealisasiExport;
use App\Imports\ImportAhsRealisasi;
use App\Models\AhsRealisasi;
use App\Models\AhsData;
use App\Models\Proyek;
use App\Models\QueryAhs;
use App\Models\Bahan;
use Illuminate\Http\Request;
use Auth;


class AhsRealisasiController extends Controller
{
    public function viewAhsRealisasiFilter($id_proyek, $filter, $search)
    {
        $nama_proyek = Proyek::where('id_user', Auth::user()->id)->where('id', $id_proyek)->first();
        $data = AhsRealisasi::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->where($filter, 'LIKE', '%'.$search.'%')->paginate('10');
        return view('proyek.AhsRealisasi', ['data'=>$data, 'id_proyek'=>$id_proyek, 'nama_proyek'=>$nama_proyek]);
    }
    public function viewAhsRealisasi(Request $request, $id_proyek)
    {
        if($request->has('search')){
            return redirect()->route('viewAhsRealisasiFilter', [$id_proyek, $request->filter, $request->search]);
        }else{
            $nama_proyek = Proyek::where('id_user', Auth::user()->id)->where('id', $id_proyek)->first();
            $data = AhsRealisasi::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->paginate('10');
            return view('proyek.AhsRealisasi', ['data'=>$data, 'id_proyek'=>$id_proyek, 'nama_proyek'=>$nama_proyek]);
        }

    }

    public function importExcelAhsRealisasi(Request $request, $id_proyek)
    {
        if (is_null(Bahan::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->first())) {
            return redirect()->back()->with('alert', 'masukan bahan terlebih dahulu');
        }else{
            $file = $request->file('file');

            $namafile = $file->getClientOriginalName();

            $file->move('AhsRealisasiData', $namafile);

            Excel::import(new ImportAhsRealisasi($id_proyek), \public_path('/AhsRealisasiData/'.$namafile));

            return redirect()->route('viewAhsRealisasi', $id_proyek);
        }
    }

    public function exportExcelAhsRealisasi($id_proyek)
    {
        return Excel::download(new AhsRealisasiExport($id_proyek), 'ahsRealisasi.xlsx');
    }

    public function exportPDFAhsRealisasi()
    {

    }



    public function viewAddAhsRealisasi($id_proyek)
    {

        if (is_null(Bahan::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->first()) or is_null($ahs_data = AhsData::where('id_proyek', $id_proyek)->where('id_user',Auth::user()->id))) {
            return redirect()->back()->with('alert', 'masukan bahan terlebih dahulu');
        }else{
            $nama_proyek = $nama_proyek = Proyek::where('id', $id_proyek)->first();
            $data = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->get();
            $ahs_data = AhsData::where('id_proyek', $id_proyek)->where('id_user',Auth::user()->id)->get();
            return view('proyek.addAhsRealisasi', ['data'=>$data, 'id_proyek'=>$id_proyek, 'nama_proyek'=>$nama_proyek, 'ahs_data'=>$ahs_data]);
        }
    }


    public function addAhsRealisasi(Request $request, $id_proyek)
    {
        $bahan = Bahan::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();

        $data = new AhsRealisasi();
        $data->id_user = Auth::user()->id;
        $data->id_proyek = $id_proyek;
        $data->kelompok = $request->kelompok;
        $data->kode = $request->kode;
        $data->keterangan = $request->keterangan;
        $data->id_bahan = $request->id_bahan;
        $data->koefisien = $request->koefisien;
        $data->save();

        if ($data) {
            $qahs = new QueryAhs();
            $qahs->id_proyek = $id_proyek;
            $qahs->id_user = Auth::user()->id;
            $qahs->kode = $data->kode;
            $qahs->keterangan = $data->keterangan;
            $qahs->id_bahan = $data->id_bahan;
            $qahs->nama = $bahan->where('kode', $data->id_bahan)->first()->nama;
            $qahs->satuan = $bahan->where('kode', $data->id_bahan)->first()->satuan;
            $qahs->harga = $bahan->where('kode', $data->id_bahan)->first()->harga;
            $qahs->koefisien = $data->koefisien;
            $qahs->jumlah = (float)$bahan->where('kode', $data->id_bahan)->first()->harga * (float)$data->koefisien;
            $qahs->save();
        }

        return redirect()->route('viewAhsRealisasi', ['id_proyek'=>$id_proyek]);
    }

    public function viewEditAhsRealisasi($id_proyek, $id)
    {
        $nama_proyek = $nama_proyek = Proyek::where('id_user', Auth::user()->id)->where('id', $id_proyek)->first();
        $data = AhsRealisasi::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->where('id', $id)->first();
        $bahan = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->get();
        $ahs_data = AhsData::where('id_proyek', $id_proyek)->where('id_user',Auth::user()->id)->get();
        return view('proyek.editAhsRealisasi', ['data'=>$data, 'id_proyek'=>$id_proyek, 'bahan'=>$bahan, 'nama_proyek'=>$nama_proyek, 'ahs_data'=>$ahs_data]);
    }

    public function editAhsRealisasi(Request $request, $id_proyek, $id)
    {
        $data = AhsRealisasi::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->where('id', $id)->first();
        $data->kelompok = $request->kelompok;
        $data->kode = $request->kode;
        $data->keterangan = $request->keterangan;
        $data->id_bahan = $request->id_bahan;
        $data->koefisien = $request->koefisien;
        $data->save();

        return redirect()->route('viewAhsRealisasi', ['id_proyek'=>$id_proyek]);
    }

    public function deleteAhsRealisasi($id_proyek, $id)
    {
        $data = AhsRealisasi::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->where('id', $id)->first();
        $data->delete();

        return redirect()->route('viewAhsRealisasi', $id_proyek);
    }

    public function deleteAllAhsRealisasi($id_proyek)
    {
        AhsRealisasi::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->delete();

        return redirect()->route('viewAhsRealisasi', ['id_proyek'=>$id_proyek]);
    }
}
