<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\AhsData;
use App\Models\AhsRealisasi;
use App\Models\Bahan;
use App\Models\Ppn;
use App\Models\QueryAhs;
use App\Models\QueryAhsHarga;
use App\Models\QueryAhsPake;
use App\Models\QueryHargaSatuanAlat;
use App\Models\QueryHargaSatuanBahan;
use App\Models\QueryHargaSatuanLain;
use App\Models\QueryHargaSatuanUpah;
use App\Models\QueryRab;
use App\Models\QueryRekapTotal;
use App\Models\Rab;
use App\Models\RabRealisasi;
use App\Http\Requests\StoreProyekRequest;
use App\Http\Requests\UpdateProyekRequest;
use Auth;

class ProyekController extends Controller
{
    public function viewProyek()
    {
        $Proyek = Proyek::where('id_user', Auth::user()->id)->get();
        return view('listProyek', ['proyek'=>$Proyek]);
    }

    public function viewAddProyek()
    {
        return view('add_proyek');
    }

    public function addProyek(Request $request)
    {
        $proyek = new Proyek();
        $proyek->id_user = Auth::user()->id;
        $proyek->nama_pemilik = $request->nama_pemilik;
        $proyek->alamat_pemilik = $request->alamat_pemilik;
        $proyek->no_tlp_pemilik = $request->no_tlp_pemilik;
        $proyek->no_tlp_rumah_pemilik = $request->no_tlp_rumah_pemilik;
        $proyek->no_tlp_kantor_pemilik = $request->no_tlp_kantor_pemilik;
        $proyek->fax = $request->fax;
        $proyek->email = $request->email_pemilik;
        $proyek->nama_proyek = $request->nama_proyek;
        $proyek->alamat_proyek = $request->alamat_proyek;
        $proyek->Kota_Kabupaten = $request->Kota_Kabupaten;
        $proyek->provinsi = $request->provinsi;
        $proyek->tgl_mulai_pengajuan = $request->tgl_mulai_pengajuan;
        $proyek->tgl_berakhir_pengajuan = $request->tgl_berakhir_pengajuan;
        $proyek->tgl_lelang = $request->tgl_lelang;
        $proyek->tgl_mulai_pelaksanaan = $request->tgl_mulai_pelaksanaan;
        $proyek->tgl_berakhir_pelaksanaan = $request->tgl_berakhir_pelaksanaan;
        $proyek->no_kontrak = $request->no_kontrak;
        $proyek->tgl_kontrak = $request->tgl_kontrak;
        $proyek->no_spk = $request->no_spk;
        $proyek->tanggal_spk = $request->tgl_spk;
        $proyek->save();

        return redirect()->route('viewProyek');
    }

    public function viewDetailProyek($id_proyek)
    {
        $rab_realisasi = RabRealisasi::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->selectRaw('SUM(budget) AS budget, SUM(bahan)+SUM(upah)+SUM(alat)+SUM(lain) AS harga_realisasi, SUM(persentase) AS actual')->first();
        $nama_proyek = Proyek::where('id', $id_proyek)->first();
        return view('proyek.proyek_dashboard', ['nama_proyek'=>$nama_proyek, 'id_proyek'=>$id_proyek, 'rab_realisasi'=>$rab_realisasi]);
    }

    public function viewEditProyek($id_proyek)
    {
        $proyek = Proyek::where('id', $id_proyek)->where('id_user', Auth::user()->id)->first();
        return view('editProyek', ['proyek'=>$proyek, 'id_proyek'=>$id_proyek]);
    }

    public function editProyek(Request $request, $id_proyek)
    {
        $proyek = Proyek::where('id', $id_proyek)->where('id_user', Auth::user()->id)->first();
        $proyek->id_user = Auth::user()->id;
        $proyek->nama_pemilik = $request->nama_pemilik;
        $proyek->alamat_pemilik = $request->alamat_pemilik;
        $proyek->no_tlp_pemilik = $request->no_tlp_pemilik;
        $proyek->no_tlp_rumah_pemilik = $request->no_tlp_rumah_pemilik;
        $proyek->no_tlp_kantor_pemilik = $request->no_tlp_kantor_pemilik;
        $proyek->fax = $request->fax;
        $proyek->email = $request->email_pemilik;
        $proyek->nama_proyek = $request->nama_proyek;
        $proyek->alamat_proyek = $request->alamat_proyek;
        $proyek->Kota_Kabupaten = $request->Kota_Kabupaten;
        $proyek->provinsi = $request->provinsi;
        $proyek->tgl_mulai_pengajuan = $request->tgl_mulai_pengajuan;
        $proyek->tgl_berakhir_pengajuan = $request->tgl_berakhir_pengajuan;
        $proyek->tgl_lelang = $request->tgl_lelang;
        $proyek->tgl_mulai_pelaksanaan = $request->tgl_mulai_pelaksanaan;
        $proyek->tgl_berakhir_pelaksanaan = $request->tgl_berakhir_pelaksanaan;
        $proyek->no_kontrak = $request->no_kontrak;
        $proyek->tgl_kontrak = $request->tgl_kontrak;
        $proyek->no_spk = $request->no_spk;
        $proyek->tanggal_spk = $request->tgl_spk;
        $proyek->update();

        return redirect()->route('viewProyek');
    }


    public function viewCloneProyek($id_proyek)
    {
        $proyek = Proyek::where('id', $id_proyek)->where('id_user', Auth::user()->id)->first();
        $Proyek = Proyek::where('id_user', Auth::user()->id)->get();
        return view('cloneProyek', ['proyek'=>$proyek, 'Proyek'=>$Proyek]);
    }

    public function cloneProyek(Request $request, $id_proyek)
    {

        $AhsData = AhsData::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $AhsRealisasi = AhsRealisasi::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $Bahan = Bahan::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $Ppn = Ppn::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $QueryAhs = QueryAhs::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $QueryAhsHarga = QueryAhsHarga::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $QueryAhsPake = QueryAhsPake::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $QueryHargaSatuanAlat = QueryHargaSatuanAlat::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $QueryHargaSatuanBahan = QueryHargaSatuanAlat::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $QueryHargaSatuanLain = QueryHargaSatuanLain::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $QueryHargaSatuanUpah = QueryHargaSatuanUpah::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $QueryRekapTotal = QueryRekapTotal::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();
        $Rab = Rab::where('id_proyek', $id_proyek)->where('id_user', Auth::user()->id)->get();

        foreach ($AhsData as $key => $value) {
            $ahs_data = new AhsData();
            $ahs_data->id_proyek = $request->target;
            $ahs_data->id_user = Auth::user()->id;
            $ahs_data->jenis_pekerjaan = $value->jenis_pekerjaan;
            $ahs_data->kode = $value->kode;
            $ahs_data->analisa_pekerjaan = $value->analisa_pekerjaan;
            $ahs_data->satuan = $value->satuan;
            $ahs_data->save();
        }

        foreach ($AhsRealisasi as $key => $value) {
            $ahs_realisasi = new AhsRealisasi();
            $ahs_realisasi->id_proyek = $request->target;
            $ahs_realisasi->id_user = Auth::user()->id;
            $ahs_realisasi->kelompok = $value->kelompok;
            $ahs_realisasi->kode = $value->kode;
            $ahs_realisasi->keterangan = $value->keterangan;
            $ahs_realisasi->id_bahan = $value->id_bahan;
            $ahs_realisasi->koefisien = $value->koefisien;
            $ahs_realisasi->save();
        }

        foreach ($Bahan as $key => $value) {
            $bahan = new Bahan();
            $bahan->id_proyek = $request->target;
            $bahan->id_user = Auth::user()->id;
            $bahan->kelompok = $value->kelompok;
            $bahan->sub_kelompok = $value->sub_kelompok;
            $bahan->kode = $value->kode;
            $bahan->nama = $value->nama;
            $bahan->satuan = $value->satuan;
            $bahan->harga = $value->harga;
            $bahan->keterangan = $value->keterangan;
            $bahan->save();
        }

        foreach ($Ppn as $key => $value) {
            $ppn = new Ppn();
            $ppn->id_proyek = $request->target;
            $ppn->id_user = Auth::user()->id_user;
            $ppn->ppn = $value->ppn;
            $ppn->kontraktor = $value->kontraktor;
            $ppn->save();
        }

        foreach ($QueryAhs as $key => $value) {
            $query_ahs = new QueryAhs();
            $query_ahs->id_proyek = $request->target;
            $query_ahs->id_user = Auth::user()->id;
            $query_ahs->kode = $value->kode;
            $query_ahs->keterangan = $value->keterangan;
            $query_ahs->id_bahan = $value->id_bahan;
            $query_ahs->nama = $value->nama;
            $query_ahs->satuan = $value->satuan;
            $query_ahs->harga = $value->harga;
            $query_ahs->koefisien = $value->koefisien;
            $query_ahs->jumlah = $value->jumlah;
            $query_ahs->save();
        }

        foreach ($QueryAhsHarga as $key => $value) {
            $query_ahs_harga = new QueryAhsHarga();
            $query_ahs_harga->id_proyek = $request->target;
            $query_ahs_harga->id_user = Auth::user()->id;
            $query_ahs_harga->kode = $value->kode;
            $query_ahs_harga->keterangan = $value->keterangan;
            $query_ahs_harga->id_bahan = $value->id_bahan;
            $query_ahs_harga->nama = $value->nama;
            $query_ahs_harga->satuan = $value->satuan;
            $query_ahs_harga->harga_satuan = $value->harga_satuan;
            $query_ahs_harga->koefisien = $value->koefisien;
            $query_ahs_harga->harga = $value->harga;
            $query_ahs_harga->save();
        }

        foreach ($QueryAhsPake as $key => $value) {
            $query_ahs_pake = new QueryAhsPake();
            $query_ahs_pake->id_proyek = $request->target;
            $query_ahs_pake->id_user = Auth::user()->id;
            $query_ahs_pake->jenis_pekerjaan = $value->jenis_pekerjaan;
            $query_ahs_pake->lantai = $value->lantai;
            $query_ahs_pake->kode_analisa = $value->kode_analisa;
            $query_ahs_pake->kode_pekerjaan = $value->kode_pekerjaan;
            $query_ahs_pake->analisa = $value->analisa;
            $query_ahs_pake->satuan_ahs = $value->satuan_ahs;
            $query_ahs_pake->nama_pekerjaan = $value->nama_pekerjaan;
            $query_ahs_pake->volume = $value->volume;
            $query_ahs_pake->id_bahan = $value->id_bahan;
            $query_ahs_pake->nama = $value->nama;
            $query_ahs_pake->satuan = $value->satuan;
            $query_ahs_pake->koefisien = $value->koefisien;
            $query_ahs_pake->harga_satuan = $value->harga_satuan;
            $query_ahs_pake->jumlah = $value->jumlah;
            $query_ahs_pake->save();
        }

        foreach ($QueryHargaSatuanBahan as $key => $value) {
            $query_harga_satuan_bahan = new QueryHargaSatuanBahan();
            $query_harga_satuan_bahan->id_proyek = $request->target;
            $query_harga_satuan_bahan->id_user = Auth::user()->id;
            $query_harga_satuan_bahan->kode = $value->kode;
            $query_harga_satuan_bahan->keterangan = $value->keterangan;
            $query_harga_satuan_bahan->kelompok = $value->kelompok;
            $query_harga_satuan_bahan->harga_satuan = $value->harga_satuan;
            $query_harga_satuan_bahan->save();
        }

        foreach ($QueryHargaSatuanLain as $key => $value) {
            $query_harga_satuan_lain = new QueryHargaSatuanLain();
            $query_harga_satuan_lain->id_proyek = $request->target;
            $query_harga_satuan_lain->id_user = Auth::user()->id;
            $query_harga_satuan_lain->kode = $value->kode;
            $query_harga_satuan_lain->keterangan = $value->keterangan;
            $query_harga_satuan_lain->kelompok = $value->kelompok;
            $query_harga_satuan_lain->harga_satuan = $value->harga_satuan;
            $query_harga_satuan_lain->save();
        }

        foreach ($QueryHargaSatuanUpah as $key => $value) {
            $query_harga_satuan_upah = new QueryHargaSatuanUpah();
            $query_harga_satuan_upah->id_proyek = $request->target;
            $query_harga_satuan_upah->id_user = Auth::user()->id;
            $query_harga_satuan_upah->kode = $value->kode;
            $query_harga_satuan_upah->keterangan = $value->keterangan;
            $query_harga_satuan_upah->kelompok = $value->kelompok;
            $query_harga_satuan_upah->harga_satuan = $value->harga_satuan;
            $query_harga_satuan_upah->save();
        }

        foreach ($QueryHargaSatuanAlat as $key => $value) {
            $query_harga_satuan_alat = new QueryHargaSatuanAlat();
            $query_harga_satuan_alat->id_proyek = $request->target;
            $query_harga_satuan_alat->id_user = Auth::user()->id;
            $query_harga_satuan_alat->kode = $value->kode;
            $query_harga_satuan_alat->keterangan = $value->keterangan;
            $query_harga_satuan_alat->kelompok = $value->kelompok;
            $query_harga_satuan_alat->harga_satuan = $value->harga_satuan;
            $query_harga_satuan_alat->save();
        }

        foreach ($QueryRekapTotal as $key => $value) {
            $query_rekap_total = new QueryRekapTotal();
            $query_rekap_total->id_proyek = $request->target;
            $query_rekap_total->id_user = Auth::user()->id;
            $query_rekap_total->jenis_pekerjaan = $value->jenis_pekerjaan;
            $query_rekap_total->s_bahan = $value->s_bahan;
            $query_rekap_total->s_upah = $value->s_upah;
            $query_rekap_total->s_alat = $value->s_alat;
            $query_rekap_total->s_lain = $value->s_lain;
            $query_rekap_total->s_jumlah = $value->s_jumlah;
            $query_rekap_total->j_bahan = $value->j_bahan;
            $query_rekap_total->j_upah = $value->j_upah;
            $query_rekap_total->j_alat = $value->j_alat;
            $query_rekap_total->j_lain = $value->j_lain;
            $query_rekap_total->j_jumlah = $value->j_jumlah;
            $query_rekap_total->save();
        }


        foreach ($Rab as $key => $value) {
            $rab = new Rab();
            $rab->id_proyek = $request->target;
            $rab->id_user = Auth::user()->id;
            $rab->jenis_pekerjaan = $value->jenis_pekerjaan;
            $rab->lantai = $value->lantai;
            $rab->kode_pekerjaan = $value->kode_pekerjaan;
            $rab->nama_pekerjaan = $value->nama_pekerjaan;
            $rab->kode_analisa = $value->kode_analisa;
            $rab->analisa = $value->analisa;
            $rab->volume = $value->volume;
            $rab->satuan = $value->satuan;
            $rab->save();
        }


        return redirect()->route('viewProyek');
    }
}
