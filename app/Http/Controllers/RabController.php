<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Rab;
use App\Models\AhsData;
use App\Models\AhsRealisasi;
use App\Models\QueryAhs;
use App\Exports\RabExport;
use App\Models\QueryAhsHarga;
use App\Models\QueryAhsPake;
use App\Models\QueryRab;
use App\Models\QueryHargaSatuanAlat;
use App\Models\QueryHargaSatuanBahan;
use App\Models\QueryHargaSatuanLain;
use App\Models\QueryHargaSatuanUpah;
use App\Imports\ImportRab;
use App\Models\QueryRekapTotal;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRabRequest;
use App\Http\Requests\UpdateRabRequest;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class RabController extends Controller
{
    public function createRab(Request $request ,$id_proyek,$jenis_pekerjaan,$lantai )
    {
        QueryAhsPake::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->delete();
        $data_satuan_alat = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'c. Alat Bantu'")->get();
        $data_satuan_bahan = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'a. Bahan'")->get();
        $data_satuan_lain = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'd. Lain-lain'")->get();
        $data_satuan_upah = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'b. Upah'")->get();

        QueryHargaSatuanAlat::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();
        QueryHargaSatuanBahan::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();
        QueryHargaSatuanLain::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();
        QueryHargaSatuanUpah::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();

        foreach ($data_satuan_alat as $key => $value) {
            $q_harga_satuan_alat = new QueryHargaSatuanAlat();
            $q_harga_satuan_alat->id_proyek = $id_proyek;
            $q_harga_satuan_alat->id_user = Auth::user()->id;
            $q_harga_satuan_alat->kode = $value->kode;
            $q_harga_satuan_alat->keterangan = $value->keterangan;
            $q_harga_satuan_alat->kelompok = $value->kelompok;
            $q_harga_satuan_alat->harga_satuan = $value->jumlah;
            $q_harga_satuan_alat->save();
        }

        foreach ($data_satuan_bahan as $key => $value) {
            $q_harga_satuan_bahan = new QueryHargaSatuanBahan();
            $q_harga_satuan_bahan->id_proyek = $id_proyek;
            $q_harga_satuan_bahan->id_user = Auth::user()->id;
            $q_harga_satuan_bahan->kode = $value->kode;
            $q_harga_satuan_bahan->keterangan = $value->keterangan;
            $q_harga_satuan_bahan->kelompok = $value->kelompok;
            $q_harga_satuan_bahan->harga_satuan = $value->jumlah;
            $q_harga_satuan_bahan->save();
        }

        foreach ($data_satuan_lain as $key => $value) {
            $q_harga_satuan_lain = new QueryHargaSatuanLain();
            $q_harga_satuan_lain->id_proyek = $id_proyek;
            $q_harga_satuan_lain->id_user = Auth::user()->id;
            $q_harga_satuan_lain->kode = $value->kode;
            $q_harga_satuan_lain->keterangan = $value->keterangan;
            $q_harga_satuan_lain->kelompok = $value->kelompok;
            $q_harga_satuan_lain->harga_satuan = $value->jumlah;
            $q_harga_satuan_lain->save();
        }

        foreach ($data_satuan_upah as $key => $value) {
            $q_harga_satuan_upah = new QueryHargaSatuanUpah();
            $q_harga_satuan_upah->id_proyek = $id_proyek;
            $q_harga_satuan_upah->id_user = Auth::user()->id;
            $q_harga_satuan_upah->kode = $value->kode;
            $q_harga_satuan_upah->keterangan = $value->keterangan;
            $q_harga_satuan_upah->kelompok = $value->kelompok;
            $q_harga_satuan_upah->harga_satuan = $value->jumlah;
            $q_harga_satuan_upah->save();
        }

        $qahs = QueryAhs::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->selectRaw('kode, keterangan, id_bahan, nama, satuan, harga, koefisien, SUM(jumlah) as jumlah')->groupByRaw('kode, keterangan, id_bahan, nama, satuan, harga, koefisien')->get();

        QueryAhsHarga::where('id_proyek', $id_proyek)->where('id_user',Auth::user()->id)->delete();
        foreach ($qahs as $key => $value) {
            $qahs_harga = new QueryAhsHarga();
            $qahs_harga->id_proyek = $id_proyek;
            $qahs_harga->id_user = Auth::user()->id;
            $qahs_harga->kode = $value->kode;
            $qahs_harga->keterangan = $value->keterangan;
            $qahs_harga->id_bahan = $value->id_bahan;
            $qahs_harga->nama = $value->nama;
            $qahs_harga->satuan = $value->satuan;
            $qahs_harga->harga_satuan = $value->harga;
            $qahs_harga->koefisien = $value->koefisien;
            $qahs_harga->harga = $value->jumlah;
            $qahs_harga->save();
        }
        $rab = new Rab();
        $rab->id_proyek = $id_proyek;
        $rab->id_user = Auth::user()->id;
        $rab->jenis_pekerjaan = $jenis_pekerjaan;
        $rab->lantai = $lantai;
        $rab->kode_pekerjaan = $request->kode_pekerjaan;
        $rab->nama_pekerjaan = $request->nama_pekerjaan;
        $rab->kode_analisa = $request->kode_analisa;
        $rab->analisa = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode',$request->kode_analisa)->first()->analisa_pekerjaan;
        $rab->volume = $request->volume;
        $rab->satuan = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode',$request->kode_analisa)->first()->satuan;
        $rab->save();

        if ($rab) {
            foreach (Rab::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get() as $key_rab => $value_rab) {
                $data_qahs_pake = QueryAhsHarga::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('keterangan', $value_rab->lantai)->where('kode', $value_rab->kode_analisa)->get();
                foreach ($data_qahs_pake as $key => $value) {
                    $qahs_pake = new QueryAhsPake();
                    $qahs_pake->id_proyek = $id_proyek;
                    $qahs_pake->id_user = Auth::user()->id;
                    $qahs_pake->jenis_pekerjaan = $value_rab->jenis_pekerjaan;
                    $qahs_pake->lantai = $value_rab->lantai;
                    $qahs_pake->kode_analisa = $value_rab->kode_analisa;
                    $qahs_pake->kode_pekerjaan = $value_rab->kode_pekerjaan;
                    $qahs_pake->analisa = $value_rab->analisa;
                    $qahs_pake->satuan_ahs = $value_rab->satuan;
                    $qahs_pake->nama_pekerjaan = $value_rab->nama_pekerjaan;
                    $qahs_pake->volume = $value_rab->volume;
                    $qahs_pake->id_bahan = $value->id_bahan;
                    $qahs_pake->nama = $value->nama;
                    $qahs_pake->satuan = $value->satuan;
                    $qahs_pake->koefisien = $value->koefisien;
                    $qahs_pake->harga_satuan = $value->harga_satuan;
                    $qahs_pake->jumlah = (float)$value_rab->volume * (float)$value->koefisien * (float)$value->harga_satuan;
                    $qahs_pake->save();
                }
            }   
        }
        return redirect()->route('viewRab', $id_proyek);
    }

    public function import_from_ahs_data($id_proyek)
    {
	set_time_limit(0);
        QueryAhsPake::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->delete();
        $data_satuan_alat = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'c. Alat Bantu'")->get();
        $data_satuan_bahan = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'a. Bahan'")->get();
        $data_satuan_lain = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'd. Lain-lain'")->get();
        $data_satuan_upah = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'b. Upah'")->get();

        QueryHargaSatuanAlat::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();
        QueryHargaSatuanBahan::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();
        QueryHargaSatuanLain::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();
        QueryHargaSatuanUpah::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();

        foreach ($data_satuan_alat as $key => $value) {
            $q_harga_satuan_alat = new QueryHargaSatuanAlat();
            $q_harga_satuan_alat->id_proyek = $id_proyek;
            $q_harga_satuan_alat->id_user = Auth::user()->id;
            $q_harga_satuan_alat->kode = $value->kode;
            $q_harga_satuan_alat->keterangan = $value->keterangan;
            $q_harga_satuan_alat->kelompok = $value->kelompok;
            $q_harga_satuan_alat->harga_satuan = $value->jumlah;
            $q_harga_satuan_alat->save();
        }

        foreach ($data_satuan_bahan as $key => $value) {
            $q_harga_satuan_bahan = new QueryHargaSatuanBahan();
            $q_harga_satuan_bahan->id_proyek = $id_proyek;
            $q_harga_satuan_bahan->id_user = Auth::user()->id;
            $q_harga_satuan_bahan->kode = $value->kode;
            $q_harga_satuan_bahan->keterangan = $value->keterangan;
            $q_harga_satuan_bahan->kelompok = $value->kelompok;
            $q_harga_satuan_bahan->harga_satuan = $value->jumlah;
            $q_harga_satuan_bahan->save();
        }

        foreach ($data_satuan_lain as $key => $value) {
            $q_harga_satuan_lain = new QueryHargaSatuanLain();
            $q_harga_satuan_lain->id_proyek = $id_proyek;
            $q_harga_satuan_lain->id_user = Auth::user()->id;
            $q_harga_satuan_lain->kode = $value->kode;
            $q_harga_satuan_lain->keterangan = $value->keterangan;
            $q_harga_satuan_lain->kelompok = $value->kelompok;
            $q_harga_satuan_lain->harga_satuan = $value->jumlah;
            $q_harga_satuan_lain->save();
        }

        foreach ($data_satuan_upah as $key => $value) {
            $q_harga_satuan_upah = new QueryHargaSatuanUpah();
            $q_harga_satuan_upah->id_proyek = $id_proyek;
            $q_harga_satuan_upah->id_user = Auth::user()->id;
            $q_harga_satuan_upah->kode = $value->kode;
            $q_harga_satuan_upah->keterangan = $value->keterangan;
            $q_harga_satuan_upah->kelompok = $value->kelompok;
            $q_harga_satuan_upah->harga_satuan = $value->jumlah;
            $q_harga_satuan_upah->save();
        }
        $qahs = QueryAhs::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->selectRaw('kode, keterangan, id_bahan, nama, satuan, harga, koefisien, SUM(jumlah) as jumlah')->groupByRaw('kode, keterangan, id_bahan, nama, satuan, harga, koefisien')->get();

        QueryAhsHarga::where('id_proyek', $id_proyek)->where('id_user',Auth::user()->id)->delete();
        foreach ($qahs as $key => $value) {
            $qahs_harga = new QueryAhsHarga();
            $qahs_harga->id_proyek = $id_proyek;
            $qahs_harga->id_user = Auth::user()->id;
            $qahs_harga->kode = $value->kode;
            $qahs_harga->keterangan = $value->keterangan;
            $qahs_harga->id_bahan = $value->id_bahan;
            $qahs_harga->nama = $value->nama;
            $qahs_harga->satuan = $value->satuan;
            $qahs_harga->harga_satuan = $value->harga;
            $qahs_harga->koefisien = $value->koefisien;
            $qahs_harga->harga = $value->jumlah;
            $qahs_harga->save();
        }
        $ahs_sample_data = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        foreach ($ahs_sample_data as $key_sample_ahs_data=>$value_sample_ahs){
            $rab = new Rab();
            $rab->id_proyek = $id_proyek;
            $rab->id_user = Auth::user()->id;
            $rab->jenis_pekerjaan = $value_sample_ahs->jenis_pekerjaan;
            $rab->lantai = "LANTAI 1";
            $rab->kode_pekerjaan = substr($value_sample_ahs->jenis_pekerjaan,0,1).$key_sample_ahs_data++;
            $rab->nama_pekerjaan = $value_sample_ahs->analisa_pekerjaan;
            $rab->kode_analisa = $value_sample_ahs->kode;
            $rab->analisa = $value_sample_ahs->analisa_pekerjaan;
            $rab->volume = 1;
            $rab->satuan = $value_sample_ahs->satuan;
            $rab->save();
    
            $data_qahs_pake = QueryAhsHarga::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->where('keterangan', $rab->lantai)->where('kode', $rab->kode_analisa)->get();
            error_log(count($data_qahs_pake));
            foreach ($data_qahs_pake as $key => $value) {
                $qahs_pake = new QueryAhsPake();
                $qahs_pake->id_proyek = $id_proyek;
                $qahs_pake->id_user = Auth::user()->id;
                $qahs_pake->jenis_pekerjaan = $rab->jenis_pekerjaan;
                $qahs_pake->lantai = $rab->lantai;
                $qahs_pake->kode_analisa = $rab->kode_analisa;
                $qahs_pake->kode_pekerjaan = $rab->kode_pekerjaan;
                $qahs_pake->analisa = $rab->analisa;
                $qahs_pake->satuan_ahs = $rab->satuan;
                $qahs_pake->nama_pekerjaan = $rab->nama_pekerjaan;
                $qahs_pake->volume = $rab->volume;
                $qahs_pake->id_bahan = $value->id_bahan;
                $qahs_pake->nama = $value->nama;
                $qahs_pake->satuan = $value->satuan;
                $qahs_pake->koefisien = $value->koefisien;
                $qahs_pake->harga_satuan = $value->harga_satuan;
                $qahs_pake->jumlah = (float)$rab->volume * (float)$value->koefisien * (float)$value->harga_satuan;
                $qahs_pake->save();
            }
            
        }
        return redirect()->back();
    }
    
    public function viewAddFilterRab($id_proyek)
    {
        $lantai = AhsRealisasi::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->selectRaw('keterangan')->groupBy('keterangan')->orderBy('keterangan')->get();
        $jenis_pekerjaan = AhsRealisasi::where('tb_ahs_realisasi.id_proyek', $id_proyek)->where('tb_ahs_realisasi.id_user', Auth::user()->id)->join('tb_ahs_data', function ($join) {$join->on('tb_ahs_realisasi.kode', '=', 'tb_ahs_data.kode')->whereRaw('tb_ahs_realisasi.id_proyek = tb_ahs_data.id_proyek');})->selectRaw('jenis_pekerjaan')->groupBy('jenis_pekerjaan')->get();
        $data = array('kode'=>'', 'lantai'=>'', 'pekerjaan'=>'', 'satuan'=>'');
        $nama_proyek = Proyek::where('id_user', Auth::user()->id)->where('id', $id_proyek)->first();
        return view('proyek.addFilterRab', ['nama_proyek'=>$nama_proyek, 'id_proyek'=>$id_proyek, 'data'=>$data, 'jenis_pekerjaan'=>$jenis_pekerjaan, 'lantai'=>$lantai]);
    }

    public function viewAddFilterDetailRab(Request $request, $id_proyek)
    {
        $data = AhsRealisasi::where('tb_ahs_realisasi.id_proyek', $id_proyek)->where('tb_ahs_realisasi.id_user', Auth::user()->id)->selectRaw('tb_ahs_realisasi.keterangan, tb_ahs_realisasi.kode, tb_ahs_data.analisa_pekerjaan, tb_ahs_data.satuan')->join('tb_ahs_data', function ($join) {$join->on('tb_ahs_realisasi.kode', '=', 'tb_ahs_data.kode')->whereRaw('tb_ahs_realisasi.id_proyek = tb_ahs_data.id_proyek');})->where('tb_ahs_data.jenis_pekerjaan', $request->nama_pekerjaan)->where('tb_ahs_realisasi.keterangan', $request->lantai)->groupByRaw('tb_ahs_realisasi.keterangan, tb_ahs_realisasi.kode, tb_ahs_data.analisa_pekerjaan, tb_ahs_data.satuan')->get();
        $lantai_data = AhsRealisasi::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->selectRaw('keterangan')->groupBy('keterangan')->orderBy('keterangan')->get();
        $jenis_pekerjaan = AhsRealisasi::where('tb_ahs_realisasi.id_proyek', $id_proyek)->where('tb_ahs_realisasi.id_user', Auth::user()->id)->join('tb_ahs_data', function ($join) {$join->on('tb_ahs_realisasi.kode', '=', 'tb_ahs_data.kode')->whereRaw('tb_ahs_realisasi.id_proyek = tb_ahs_data.id_proyek');})->selectRaw('jenis_pekerjaan')->groupBy('jenis_pekerjaan')->get();
        $nama_proyek = Proyek::where('id_user', Auth::user()->id)->where('id', $id_proyek)->first();

        $nama_pekerjaan = $request->nama_pekerjaan;
        $lantai = $request->lantai;

        return view('proyek.addDetailFilterRab', ['nama_proyek'=>$nama_proyek, 'id_proyek'=>$id_proyek, 'jenis_pekerjaan'=>$jenis_pekerjaan, 'lantai'=>$lantai, 'data'=>$data, 'lantai_data'=>$lantai_data, 'nama_pekerjaan'=>$nama_pekerjaan]);
    }

    public function viewRabFilter($id_proyek, $filter, $search)
    {
        $nama_proyek = Proyek::where('id_user', Auth::user()->id)->where('id', $id_proyek)->first();
        $data = Rab::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where($filter, 'LIKE', '%'.$search.'%')->paginate(10);
        return view('proyek.rab', ['data'=>$data, 'id_proyek'=>$id_proyek, 'nama_proyek'=>$nama_proyek]);
    }
    public function viewRab(Request $request, $id_proyek)
    {
        if($request->has('search')){
            return redirect()->route('viewRabFilter', [$id_proyek ,$request->filter, $request->search]);
        }else{
            $nama_proyek = Proyek::where('id_user', Auth::user()->id)->where('id', $id_proyek)->first();
            $data = Rab::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->paginate(10);
            return view('proyek.rab', ['data'=>$data, 'id_proyek'=>$id_proyek, 'nama_proyek'=>$nama_proyek]);
        }
    }


    public function viewAddRab($id_proyek)
    {
        $data = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        if (is_null(AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->first())) {
            return redirect()->back()->with('alert', 'harus mengisi AhsData terlebih dahulu');
        }else{
            $nama_proyek = Proyek::where('id_user', Auth::user()->id)->where('id', $id_proyek)->first();
            return view('proyek.addrab', ['data'=>$data, 'id_proyek'=>$id_proyek, 'nama_proyek'=>$nama_proyek]);
        }
    }

    public function addRab(Request $request, $id_proyek)
    {
        QueryAhsPake::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->delete();
        $data_satuan_alat = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'c. Alat Bantu'")->get();
        $data_satuan_bahan = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'a. Bahan'")->get();
        $data_satuan_lain = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'd. Lain-lain'")->get();
        $data_satuan_upah = QueryAhs::selectRaw('tb_query_ahs.kode AS kode, tb_query_ahs.keterangan AS keterangan, tb_bahan.kelompok AS kelompok, SUM(tb_query_ahs.jumlah) AS jumlah')->where('tb_query_ahs.id_proyek', $id_proyek)->where('tb_query_ahs.id_user', Auth::user()->id)->leftJoin('tb_bahan', function ($join) {$join->on('id_bahan', '=', 'tb_bahan.kode')->whereRaw('tb_query_ahs.id_proyek = tb_bahan.id_proyek');})->groupBy('tb_query_ahs.kode', 'tb_query_ahs.keterangan', 'tb_bahan.kelompok')->havingRaw("tb_bahan.kelompok = 'b. Upah'")->get();

        QueryHargaSatuanAlat::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();
        QueryHargaSatuanBahan::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();
        QueryHargaSatuanLain::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();
        QueryHargaSatuanUpah::where('id_proyek',$id_proyek)->where('id_user', Auth::user()->id)->delete();

        foreach ($data_satuan_alat as $key => $value) {
            $q_harga_satuan_alat = new QueryHargaSatuanAlat();
            $q_harga_satuan_alat->id_proyek = $id_proyek;
            $q_harga_satuan_alat->id_user = Auth::user()->id;
            $q_harga_satuan_alat->kode = $value->kode;
            $q_harga_satuan_alat->keterangan = $value->keterangan;
            $q_harga_satuan_alat->kelompok = $value->kelompok;
            $q_harga_satuan_alat->harga_satuan = $value->jumlah;
            $q_harga_satuan_alat->save();
        }

        foreach ($data_satuan_bahan as $key => $value) {
            $q_harga_satuan_bahan = new QueryHargaSatuanBahan();
            $q_harga_satuan_bahan->id_proyek = $id_proyek;
            $q_harga_satuan_bahan->id_user = Auth::user()->id;
            $q_harga_satuan_bahan->kode = $value->kode;
            $q_harga_satuan_bahan->keterangan = $value->keterangan;
            $q_harga_satuan_bahan->kelompok = $value->kelompok;
            $q_harga_satuan_bahan->harga_satuan = $value->jumlah;
            $q_harga_satuan_bahan->save();
        }

        foreach ($data_satuan_lain as $key => $value) {
            $q_harga_satuan_lain = new QueryHargaSatuanLain();
            $q_harga_satuan_lain->id_proyek = $id_proyek;
            $q_harga_satuan_lain->id_user = Auth::user()->id;
            $q_harga_satuan_lain->kode = $value->kode;
            $q_harga_satuan_lain->keterangan = $value->keterangan;
            $q_harga_satuan_lain->kelompok = $value->kelompok;
            $q_harga_satuan_lain->harga_satuan = $value->jumlah;
            $q_harga_satuan_lain->save();
        }

        foreach ($data_satuan_upah as $key => $value) {
            $q_harga_satuan_upah = new QueryHargaSatuanUpah();
            $q_harga_satuan_upah->id_proyek = $id_proyek;
            $q_harga_satuan_upah->id_user = Auth::user()->id;
            $q_harga_satuan_upah->kode = $value->kode;
            $q_harga_satuan_upah->keterangan = $value->keterangan;
            $q_harga_satuan_upah->kelompok = $value->kelompok;
            $q_harga_satuan_upah->harga_satuan = $value->jumlah;
            $q_harga_satuan_upah->save();
        }

        $qahs = QueryAhs::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->selectRaw('kode, keterangan, id_bahan, nama, satuan, harga, koefisien, SUM(jumlah) as jumlah')->groupByRaw('kode, keterangan, id_bahan, nama, satuan, harga, koefisien')->get();

        QueryAhsHarga::where('id_proyek', $id_proyek)->where('id_user',Auth::user()->id)->delete();
        foreach ($qahs as $key => $value) {
            $qahs_harga = new QueryAhsHarga();
            $qahs_harga->id_proyek = $id_proyek;
            $qahs_harga->id_user = Auth::user()->id;
            $qahs_harga->kode = $value->kode;
            $qahs_harga->keterangan = $value->keterangan;
            $qahs_harga->id_bahan = $value->id_bahan;
            $qahs_harga->nama = $value->nama;
            $qahs_harga->satuan = $value->satuan;
            $qahs_harga->harga_satuan = $value->harga;
            $qahs_harga->koefisien = $value->koefisien;
            $qahs_harga->harga = $value->jumlah;
            $qahs_harga->save();
        }
        $rab = new Rab();
        $rab->id_proyek = $id_proyek;
        $rab->id_user = Auth::user()->id;
        $rab->jenis_pekerjaan = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode',$request->kode)->first()->jenis_pekerjaan;
        $rab->lantai = $request->lantai;
        $rab->kode_pekerjaan = $request->kode_pekerjaan;
        $rab->nama_pekerjaan = $request->nama_pekerjaan;
        $rab->kode_analisa = $request->kode;
        $rab->analisa = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode',$request->kode)->first()->analisa_pekerjaan;
        $rab->volume = $request->volume;
        $rab->satuan = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode',$request->kode)->first()->satuan;
        $rab->save();

        if ($rab) {
            foreach (Rab::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get() as $key_rab => $value_rab) {
                $data_qahs_pake = QueryAhsHarga::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('keterangan', $value_rab->lantai)->where('kode', $value_rab->kode_analisa)->get();
                foreach ($data_qahs_pake as $key => $value) {
                    $qahs_pake = new QueryAhsPake();
                    $qahs_pake->id_proyek = $id_proyek;
                    $qahs_pake->id_user = Auth::user()->id;
                    $qahs_pake->jenis_pekerjaan = $value_rab->jenis_pekerjaan;
                    $qahs_pake->lantai = $value_rab->lantai;
                    $qahs_pake->kode_analisa = $value_rab->kode_analisa;
                    $qahs_pake->kode_pekerjaan = $value_rab->kode_pekerjaan;
                    $qahs_pake->analisa = $value_rab->analisa;
                    $qahs_pake->satuan_ahs = $value_rab->satuan;
                    $qahs_pake->nama_pekerjaan = $value_rab->nama_pekerjaan;
                    $qahs_pake->volume = $value_rab->volume;
                    $qahs_pake->id_bahan = $value->id_bahan;
                    $qahs_pake->nama = $value->nama;
                    $qahs_pake->satuan = $value->satuan;
                    $qahs_pake->koefisien = $value->koefisien;
                    $qahs_pake->harga_satuan = $value->harga_satuan;
                    $qahs_pake->jumlah = (float)$value_rab->volume * (float)$value->koefisien * (float)$value->harga_satuan;
                    $qahs_pake->save();
                }
            }   
        }

        return redirect()->route('viewRab',$id_proyek);

    }

    public function viewEditRab($id_proyek, $id)
    {
        $data = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $nama_proyek = Proyek::where('id_user', Auth::user()->id)->where('id', $id_proyek)->first();
        $rab = Rab::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('id', $id)->first();
        return view('proyek.editrab', ['id_proyek'=>$id_proyek, 'data'=>$data, 'rab'=>$rab, 'nama_proyek'=>$nama_proyek]);
    }

    public function editRab(Request $request, $id_proyek, $id)
    {
        $rab = Rab::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('id', $id)->first();
        $rab->id_proyek = $id_proyek;
        $rab->id_user = Auth::user()->id;
        $rab->jenis_pekerjaan = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode',$request->kode)->first()->jenis_pekerjaan;
        $rab->lantai = $request->lantai;
        $rab->kode_pekerjaan = $request->kode_pekerjaan;
        $rab->nama_pekerjaan = $request->nama_pekerjaan;
        $rab->kode_analisa = $request->kode;
        $rab->analisa = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode',$request->kode)->first()->analisa_pekerjaan;
        $rab->volume = $request->volume;
        $rab->satuan = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode',$request->kode)->first()->satuan;
        $rab->update();

        if ($rab) {
            QueryAhsPake::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->delete();
            $data_qahs_pake = QueryAhsHarga::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('keterangan', $rab->lantai)->where('kode', $rab->kode_analisa)->get();
            foreach ($data_qahs_pake as $key => $value) {
                $qahs_pake = new QueryAhsPake();
                $qahs_pake->id_proyek = $id_proyek;
                $qahs_pake->id_user = Auth::user()->id;
                $qahs_pake->jenis_pekerjaan = $rab->jenis_pekerjaan;
                $qahs_pake->lantai = $rab->lantai;
                $qahs_pake->kode_analisa = $rab->kode_analisa;
                $qahs_pake->kode_pekerjaan = $rab->kode_pekerjaan;
                $qahs_pake->analisa = $rab->analisa;
                $qahs_pake->satuan_ahs = $rab->satuan;
                $qahs_pake->nama_pekerjaan = $rab->nama_pekerjaan;
                $qahs_pake->volume = $rab->volume;
                $qahs_pake->id_bahan = $value->id_bahan;
                $qahs_pake->nama = $value->nama;
                $qahs_pake->satuan = $value->satuan;
                $qahs_pake->koefisien = $value->koefisien;
                $qahs_pake->harga_satuan = $value->harga_satuan;
                $qahs_pake->jumlah = (float)$rab->volume * (float)$value->koefisien * (float)$value->harga_satuan;
                $qahs_pake->save();
            }
        }
        return redirect()->route('viewRab', $id_proyek);

    }

    public function deleteRab($id_proyek, $id)
    {
        Rab::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('id', $id)->delete();

        return redirect()->route('viewRab', $id_proyek);
    }

    public function deleteAllRab($id_proyek)
    {
        Rab::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->delete();

        return redirect()->route('viewRab', $id_proyek);
    }

    public function importExcelRab(Request $request, $id_proyek)
    {
        $file = $request->file('file');

        $namafile = $file->getClientOriginalName();

        $file->move('Rab', $namafile);

        Excel::import(new ImportRab($id_proyek), \public_path('/Rab/'.$namafile));

        return redirect()->route('viewRab', $id_proyek);
    }

    public function exportExcelRab($id_proyek)
    {
        return Excel::download(new RabExport($id_proyek), 'Rab.xlsx');
    }
}
