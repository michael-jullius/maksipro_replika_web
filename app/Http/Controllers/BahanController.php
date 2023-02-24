<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Imports\ImportBahan;
use App\Exports\BahanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Proyek;
use App\Http\Requests\StoreBahanRequest;
use App\Http\Requests\UpdateBahanRequest;
use Auth;

class BahanController extends Controller
{
    public function viewBahanFilter($id_proyek, $filter, $search)
    {
        $nama_proyek = $nama_proyek = Proyek::where('id', $id_proyek)->where('id_user', Auth::user()->id)->first();
        $data = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->where($filter, 'LIKE', '%'.$search.'%')->paginate(10);
        return view('proyek.Bahan', ['data'=>$data, 'nama_proyek'=>$nama_proyek, 'id_proyek'=>$id_proyek]);
    }
    public function viewBahan(Request $request, $id_proyek)
    {
        if($request->has('search')){
            return redirect()->route('viewBahanFilter', [$id_proyek ,$request->filter, $request->search]);
        }else{
            $nama_proyek = $nama_proyek = Proyek::where('id', $id_proyek)->where('id_user', Auth::user()->id)->first();
            $data = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->paginate(10);

            return view('proyek.Bahan', ['data'=>$data, 'nama_proyek'=>$nama_proyek, 'id_proyek'=>$id_proyek]);
        }

    }
    public function viewAddBahan($id_proyek)
    {
        $nama_proyek = $nama_proyek = Proyek::where('id', $id_proyek)->where('id_user', Auth::user()->id)->first();
        return view('proyek.addBahan', ['id_proyek'=>$id_proyek, 'nama_proyek'=>$nama_proyek]);
    }

    public function viewEditBahan($id_proyek,$id)
    {
        $nama_proyek = $nama_proyek = Proyek::where('id', $id_proyek)->where('id_user', Auth::user()->id)->first();
        $data = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->where('id', $id)->first();
        return view('proyek.editBahan', ['data'=>$data, 'id_proyek'=>$id_proyek, 'nama_proyek'=>$nama_proyek]);
    }

    public function deleteBahan($id_proyek,$id)
    {
        $Bahan = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->where('id', $id)->first();
        $Bahan->delete();

        return redirect()->route('viewBahan', ['id_proyek'=>$id_proyek]);
    }

    public function addBahan(Request $request, $id_proyek)
    {
        $Bahan = new Bahan();
        $Bahan->id_user = Auth::user()->id;
        $Bahan->id_proyek = $id_proyek;
        $Bahan->kelompok = $request->kelompok;
        $Bahan->sub_kelompok = $request->sub_kelompok;
        $Bahan->kode = $request->kode;
        $Bahan->nama = $request->nama;
        $Bahan->satuan = $request->satuan;
        $Bahan->harga = $request->harga;
        $Bahan->keterangan = $request->keterangan;
        $Bahan->save();

        return redirect()->route('viewBahan', ['id_proyek'=>$id_proyek]);
    }

    public function editBahan(Request $request, $id_proyek, $id)
    {
        $Bahan = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->where('id', $id)->first();
        $Bahan->kelompok = $request->kelompok;
        $Bahan->sub_kelompok = $request->sub_kelompok;
        $Bahan->kode = $request->kode;
        $Bahan->nama = $request->nama;
        $Bahan->satuan = $request->satuan;
        $Bahan->harga = $request->harga;
        $Bahan->keterangan = $request->keterangan;
        $Bahan->update();

        return redirect()->route('viewBahan', ['id_proyek'=>$id_proyek]);
    }



    public function deleteAllBahan($id_proyek)
    {
        $bahan = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', $id_proyek)->delete();
        return redirect()->route('viewBahan', ['id_proyek'=>$id_proyek]);
    }

    public function importExcelBahan($id_proyek, Request $request)
    {
        $file = $request->file('file');

        $namafile = $file->getClientOriginalName();

        $file->move('BahanData', $namafile);

        Excel::import(new ImportBahan($id_proyek), \public_path('/BahanData/'.$namafile));

        return redirect()->route('viewBahan', ['id_proyek'=>$id_proyek]);
    }

    public function exportExcelBahan($id_proyek)
    {
        return Excel::download(new BahanExport($id_proyek), 'Bahan.xlsx');
    }

    public function getBahan1($id)
    {
        $data = Bahan::where('kode', $id)->where('id_proyek', 5)->first();
        return response()->json($data);
    }
}
