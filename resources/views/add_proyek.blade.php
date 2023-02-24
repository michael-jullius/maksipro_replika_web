@extends('layout')

@section('title', 'new proyek')

@section('content')
    <div class="container-fluid">
        <div class="card mt-5" style="margin:30px 30px 60px 30px;">
            <div class="card-head">
                <h4 style="text-align:center;" class="mt-4"><b>Tambah Proyek</b></h4>
            </div>
            <div class="card-body">
                <hr>
                <form class="form" method="post" action="{{ route('addProyek') }}">
                    @csrf
                    <h5 style="text-align:center; margin-bottom:20px;">Pemilik</h5>
                    <div class="d-flex">
                        <div style="margin: 10px; width:100%;">
                            <div class="form-group mt-2" >
                                <label>Nama Pemilik: </label>
                                <input class="form-control" type="text" name="nama_pemilik" required placeholder="nama pemilik">
                            </div>

                            <div class="form-group mt-2" >
                                <label>No Telephone Kantor: </label>
                                <input class="form-control" type="text" name="no_tlp_kantor_pemilik" required placeholder="no telephone kantor">
                            </div>


                        </div>

                        <div style="margin: 10px; width:100%;">

                            <div class="form-group mt-2" >
                                <label>No Telephone Rumah: </label>
                                <input class="form-control" type="text" name="no_tlp_rumah_pemilik" required placeholder="no telephone rumah">
                            </div>

                            <div class="form-group mt-2" >
                                <label>Email: </label>
                                <input class="form-control" type="text" name="email_pemilik" required placeholder="email">
                            </div>
                        </div>

                        <div style="margin: 10px; width:100%;">
                            <div class="form-group mt-2">
                                <label>No Handphone: </label>
                                <input class="form-control" type="text" name="no_tlp_pemilik" required placeholder="no handphone">
                            </div>

                            <div class="form-group mt-2">
                                <label>Fax: </label>
                                <input class="form-control" type="text" name="fax" required placeholder="fax">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin: 10px;">
                        <label>Alamat Pemilik: </label>
                        <textarea class="form-control"  style="height:100px;" name="alamat_pemilik" required></textarea>
                    </div>

                    <hr>
                    <h5 style="text-align:center; margin-bottom:20px;">Proyek</h5>

                    <div class="d-flex">
                        <div class="form-group mt-2 w-100">
                            <label>Nama Proyek: </label>
                            <input class="form-control" type="text" name="nama_proyek" required placeholder="nama proyek">
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-rigth: 10px;">
                            <label>Kota / Kabupaten: </label>
                            <input class="form-control" type="text" name="Kota_Kabupaten" required placeholder="kota / kabupaten">
                        </div>
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-left: 10px;">
                            <label>Provinsi: </label>
                            <input class="form-control" type="text" name="provinsi" required placeholder="Provinsi">
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group mt-2 w-100">
                            <label>alamat Proyek: </label>
                            <textarea class="form-control"  style="height:100px;" name="alamat_proyek" required></textarea>
                        </div>
                    </div>
                    <hr>
                    <h5 style="text-align:center; margin-bottom:20px;">Tanggal Pengajuan</h5>
                    <div class="d-flex">
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-rigth: 10px;">
                            <label>Tanggal Mulai Pengajuan: </label>
                            <input class="form-control" type="datetime-local" name="tgl_mulai_pengajuan" required>
                        </div>
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-left: 10px;">
                            <label>Tanggal Berakhir Pengajuan: </label>
                            <input class="form-control" type="datetime-local" name="tgl_berakhir_pengajuan" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mt-2 w-100">
                        <label>Tanggal Lelang: </label>
                        <input class="form-control" type="datetime-local" name="tgl_lelang" required>
                    </div>

                    <hr>

                    <h5 style="text-align:center; margin-bottom:20px;">Tanggal Pelaksanaan</h5>
                    <div class="d-flex">
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-rigth: 10px;">
                            <label>Tanggal Mulai Pelaksanaan: </label>
                            <input class="form-control" type="datetime-local" name="tgl_mulai_pelaksanaan" required>
                        </div>
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-left: 10px;">
                            <label>Tanggal Berakhir Pelaksanaan: </label>
                            <input class="form-control" type="datetime-local" name="tgl_berakhir_pelaksanaan" required>
                        </div>
                    </div>
                    <hr>    
                        

                    <div class="d-flex mt-2">
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-right:10px;">
                            <label>No SPK: </label>
                            <input class="form-control" type="text" name="no_spk" required placeholder="no spk">
                        </div>
                        <div class="form-group mt-2 w-100" style="margin-left: 10px;">
                            <label>Tanggal SPK: </label>
                            <input class="form-control" type="datetime-local" name="tgl_spk" required>
                        </div>
                    </div>


                    <div class="d-flex mt-2" style="margin-bottom: 30px">
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-right: 10px;">
                            <label>No Kontrak: </label>
                            <input class="form-control" type="text" name="no_kontrak" required placeholder="no spk">
                        </div>
                        <div class="form-group mt-2 w-100" style="margin-left: 10px;">
                            <label>Tanggal Kontrak: </label>
                            <input class="form-control" type="datetime-local" name="tgl_kontrak" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mt-4 mb-3" >
                        <button type="submit" class="btn btn-primary w-100">submit</button>
                    </div>
                    <a href="{{route('viewProyek')}}" class="btn btn-primary w-100">kembali</a>
                </form>
            </div>
        </div>
    </div>

@endsection