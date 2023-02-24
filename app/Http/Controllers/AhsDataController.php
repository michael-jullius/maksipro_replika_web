<?php

namespace App\Http\Controllers;

use App\Exports\AhsDataExport;
use App\Models\AhsData;
use App\Imports\ImportAhsData;
use App\Http\Requests\StoreAhsDataRequest;
use App\Http\Requests\UpdateAhsDataRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Proyek;


class AhsDataController extends Controller
{
    public function viewAhsDataFilter($id_proyek, $filter, $search)
    {
        $nama_proyek = Proyek::where('id_user', Auth::user()->id)->where('id', $id_proyek)->first();
        $data = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where($filter, 'LIKE', '%'.$search.'%')->paginate(10);
        return view('proyek.ahsdata', ['data'=>$data, 'id_proyek'=>$id_proyek, 'nama_proyek'=>$nama_proyek]);
    }
    public function viewAhsData(Request $request, $id_proyek)
    {
        if($request->has('search')){
            return redirect()->route('viewAhsDataFilter', [$id_proyek, $request->filter, $request->search]);
        }else{
            $nama_proyek = Proyek::where('id_user', Auth::user()->id)->where('id', $id_proyek)->first();
            $data = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->paginate(10);
            return view('proyek.ahsdata', ['data'=>$data, 'id_proyek'=>$id_proyek, 'nama_proyek'=>$nama_proyek]);
        }
    }

    public function viewAddAhsData($id_proyek)
    {
        $nama_proyek = Proyek::where('id', $id_proyek)->where('id_user', Auth::user()->id)->first();
        return view('proyek.addAhsData', ['id_proyek'=>$id_proyek,'nama_proyek'=>$nama_proyek]);
    }


    public function viewEditAhsData($id_proyek, $id)
    {
        $data = AhsData::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->where('id', $id)->first();
        $nama_proyek = Proyek::where('id', $id_proyek)->where('id_user', Auth::user()->id)->first();
        return view('proyek.editAhsData', ['data'=>$data, 'id_proyek'=>$id_proyek, 'id'=>$id, 'nama_proyek'=>$nama_proyek]);
    }

    public function editAhsData(Request $request, $id_proyek, $id)
    {
        $ahsData = AhsData::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->where('id', $id)->first();
        $ahsData->jenis_pekerjaan = $request->jenis_pekerjaan;
        $ahsData->kode = $request->Kode;
        $ahsData->analisa_pekerjaan = $request->analisa_pekerjaan;
        $ahsData->satuan = $request->satuan;
        $ahsData->update();

        return redirect()->route('viewAhsData', ['id_proyek'=>$id_proyek, 'id'=>$id]);
    }

    public function deleteAhsData($id_proyek, $id)
    {
        $ahsData = AhsData::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->where('id', $id)->first();
        $ahsData->delete();

        return redirect()->route('viewAhsData', ['id_proyek'=>$id_proyek]);
    }

    public function addAhsData(Request $request, $id_proyek)
    {
        $ahsData = new AhsData();
        $ahsData->id_proyek = $id_proyek;
        $ahsData->id_user = Auth::user()->id;
        $ahsData->jenis_pekerjaan = $request->jenis_pekerjaan;
        $ahsData->kode = $request->Kode;
        $ahsData->analisa_pekerjaan = $request->analisa_pekerjaan;
        $ahsData->satuan = $request->satuan;
        $ahsData->save();

        return redirect()->route('viewAhsData', ['id_proyek'=>$id_proyek]);
    }

    public function importExcelAhsData(Request $request, $id_proyek)
    {
        $file = $request->file('file');

        $namafile = $file->getClientOriginalName();

        $file->move('AhsData', $namafile);

        Excel::import(new ImportAhsData($id_proyek), \public_path('/AhsData/'.$namafile));

        return redirect()->route('viewAhsData', $id_proyek);
    }

    public function deleteAllAhsData($id_proyek)
    {
        AhsData::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->delete();
        return redirect()->route('viewAhsData', $id_proyek);
    }

    public function exportExcelAhsData($id_proyek)
    {
        return Excel::download(new AhsDataExport($id_proyek), 'ahsData.xlsx');
    }
}
