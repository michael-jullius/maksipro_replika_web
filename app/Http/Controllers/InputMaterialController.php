<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\InputMaterial;
use App\Http\Requests\StoreInputMaterialRequest;
use App\Http\Requests\UpdateInputMaterialRequest;
use Illuminate\Http\Request;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InputMaterialExport;
use Illuminate\Support\Facades\Log;

class InputMaterialController extends Controller
{
    public function viewinputmaterial()
    {
        $bahan = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', 5)->get();
        $data = InputMaterial::where('id_user', Auth::user()->id)->paginate(10);
        return view('input_material', ['data'=>$data, 'bahan'=>$bahan]);
    }

    public function inputmaterial(Request $request)
    {
        $data = new inputmaterial();
        $data->id_user = Auth::user()->id;
        $data->tanggal_transaksi = $request->tanggal_transaksi;
        $data->no_bukti = $request->no_bukti;
        $data->nama_supplier = $request->nama_supplier;
        $data->keterangan = $request->keterangan;
        $bahan = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', 5)->where('kode', $request->kode)->first();
        $data->kode_material = $bahan->kode;
        $data->nama_material = $bahan->nama;
        $data->satuan = $bahan->satuan;
        $data->harga_satuan = $request->harga_satuan;
        $data->jumlah_masuk = $request->jumlah_masuk;
        $data->nama_pekerjaan = $request->nama_pekerjaan;
        $data->save();

        $date =$request->tanggal_transaksi;
        return redirect()->back()->with('date',$date);
    }

    public function editmaterial(Request $request, $id)
    {
        $data = inputmaterial::where('id', $id)->first();
        $data->id_user = Auth::user()->id;
        $data->tanggal_transaksi = $request->tanggal_transaksi;
        $data->no_bukti = $request->no_bukti;
        $data->nama_supplier = $request->nama_supplier;
        $data->keterangan = $request->keterangan;
        $bahan = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', 5)->where('kode', $request->kode)->first();
        $data->kode_material = $bahan->kode;
        $data->nama_material = $bahan->nama;
        $data->satuan = $bahan->satuan;
        $data->harga_satuan = $request->harga_satuan;
        $data->jumlah_masuk = $request->jumlah_masuk;
        $data->nama_pekerjaan = $request->nama_pekerjaan;
        $data->update();

        return redirect()->back();
    }

    public function viewfilterinputmaterial($from = null, $to = null, $kode = null)
    {
        $bahan = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', 5)->get();
        $data = InputMaterial::where('id_user', Auth::user()->id);
        if(!empty($from) && !empty($to)){
            $data->whereBetween('tanggal_transaksi', [$from, $to]);
        }
        if (!empty($kode)) {
            $data->where('kode_material', $kode);
        }
        $data = $data->paginate(10);
        return view('input_material', ['data'=>$data, 'bahan'=>$bahan]);
    }

    public function deletematerial($id)
    {
        inputmaterial::where('id', $id)->delete();
        return redirect()->back();
    }

    public function exportexcelmaterial()
    {
        return Excel::download(new InputMaterialExport(), 'Material.xlsx');
        return redirect()->back();
    }

    public function viewaddmaterial()
    {
        $bahan = Bahan::where('id_user', Auth::user()->id)->where('id_proyek', 5)->get();
        return view('add_input_material', ['bahan'=>$bahan]);
    }

    public function cetakmaterial($from = null, $to = null, $kode = null)
    {
        $data = InputMaterial::where('id_user', Auth::user()->id);
        $data_total = InputMaterial::where('id_user', Auth::user()->id);
        $data_pekerjaan = InputMaterial::where('id_user', Auth::user()->id);
        if(!empty($from) && !empty($to)){
            $data->whereBetween('tanggal_transaksi', [$from, $to]);
            $data_total->whereBetween('tanggal_transaksi', [$from, $to]);
            $data_pekerjaan->whereBetween('tanggal_transaksi', [$from, $to]);
        }
        if (!empty($kode)) {
            $data_total->where('kode_material', $kode);
            $data->where('kode_material', $kode);
            $data_pekerjaan->where('kode_material', $kode);
        }
        $data_pekerjaan = $data_pekerjaan->select('nama_pekerjaan')->groupBy('nama_pekerjaan')->orderBy('nama_pekerjaan')->get();
        $data_total =  $data_total->selectRaw('nama_pekerjaan, nama_material, nama_supplier, SUM(jumlah_masuk) as jumlah, SUM((jumlah_masuk*harga_satuan)) as jumlah_total')->groupBy('nama_supplier', 'nama_material', 'nama_pekerjaan')->orderBy('nama_material')->get();
        $data = $data->get();

        return view('cetak_material', ['data_total'=>$data_total, 'data'=>$data, 'from'=>$from, 'to'=>$to, 'data_pekerjaan'=>$data_pekerjaan]);
    }
}
