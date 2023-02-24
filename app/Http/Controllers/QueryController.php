<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\QueryRekapTotal;
use App\Models\Bahan;
use Auth;
use Session;

class QueryController extends Controller
{
    public function resetQuery($id_proyek)
    {
    	QueryAhs::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->delete();
    	$AhsRealisasi = AhsRealisasi::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
    	foreach ($AhsRealisasi as $key => $value) {
    		$qahs = new QueryAhs();
            $qahs->id_proyek = $id_proyek;
            $qahs->id_user = Auth::user()->id;
            $qahs->kode = $value->kode;
            $qahs->keterangan = $value->keterangan;
            $qahs->id_bahan = $value->id_bahan;
            $qahs->nama = Bahan::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode', '=', $value->id_bahan)->first()->nama;
            $qahs->satuan = Bahan::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode', $value->id_bahan)->first()->satuan;
            $qahs->harga = Bahan::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode', $value->id_bahan)->first()->harga;
            $qahs->koefisien = $value->koefisien;
            $qahs->jumlah = (float)Bahan::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->where('kode', $value->id_bahan)->first()->harga * (float)$value->koefisien;
            $qahs->save();
    	}
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
        Session::flash('success', 'Berhasil Memperbaharui Query');
        return redirect()->route('ViewSetting', $id_proyek);
    }
}
