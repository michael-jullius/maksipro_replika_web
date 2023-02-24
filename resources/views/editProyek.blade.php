@extends('layout')

@section('title', 'ubah proyek')

@section('content')
    <div class="container-fluid">
        <div class="card mt-5" style="margin:30px 30px 60px 30px;">
            <div class="card-head">
                <h4 style="text-align:center;" class="mt-4"><b>Ubah Proyek</b></h4>
            </div>
            <div class="card-body">
                <hr>
                <form class="form" method="post" action="{{ route('editProyek', $id_proyek) }}">
                    @csrf
                    <h5 style="text-align:center; margin-bottom:20px;">Pemilik</h5>
                    <div class="d-flex">
                        <div style="margin: 10px; width:100%;">
                            <div class="form-group mt-2" >
                                <label>Nama Pemilik: </label>
                                <input class="form-control" type="text" name="nama_pemilik" required value="{{$proyek->nama_pemilik}}">
                            </div>

                            <div class="form-group mt-2" >
                                <label>No Telephone Kantor: </label>
                                <input class="form-control" type="text" name="no_tlp_kantor_pemilik" required value="{{$proyek->no_tlp_kantor_pemilik}}">
                            </div>


                        </div>

                        <div style="margin: 10px; width:100%;">

                            <div class="form-group mt-2" >
                                <label>No Telephone Rumah: </label>
                                <input class="form-control" type="text" name="no_tlp_rumah_pemilik" required value="{{$proyek->no_tlp_rumah_pemilik}}">
                            </div>

                            <div class="form-group mt-2" >
                                <label>Email: </label>
                                <input class="form-control" type="text" name="email_pemilik" required value="{{$proyek->email}}">
                            </div>
                        </div>

                        <div style="margin: 10px; width:100%;">
                            <div class="form-group mt-2">
                                <label>No Handphone: </label>
                                <input class="form-control" type="text" name="no_tlp_pemilik" required value="{{$proyek->no_tlp_pemilik}}">
                            </div>

                            <div class="form-group mt-2">
                                <label>Fax: </label>
                                <input class="form-control" type="text" name="fax" required value="{{$proyek->fax}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin: 10px;">
                        <label>Alamat Pemilik: </label>
                        <textarea class="form-control"  style="height:100px;" name="alamat_pemilik" required>{{$proyek->alamat_pemilik}}</textarea>
                    </div>

                    <hr>
                    <h5 style="text-align:center; margin-bottom:20px;">Proyek</h5>

                    <div class="d-flex">
                        <div class="form-group mt-2 w-100">
                            <label>Nama Proyek: </label>
                            <input class="form-control" type="text" name="nama_proyek" required value="{{$proyek->nama_proyek}}">
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-rigth: 10px;">
                            <label>Kota / Kabupaten: </label>
                            <input class="form-control" type="text" name="Kota_Kabupaten" required value="{{$proyek->Kota_Kabupaten}}">
                        </div>
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-left: 10px;">
                            <label>Provinsi: </label>
                            <input class="form-control" type="text" name="provinsi" required value="{{$proyek->provinsi}}">
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group mt-2 w-100">
                            <label>alamat Proyek: </label>
                            <textarea class="form-control"  style="height:100px;" name="alamat_proyek" required>{{$proyek->alamat_proyek}}</textarea>
                        </div>
                    </div>
                    <hr>
                    <h5 style="text-align:center; margin-bottom:20px;">Tanggal Pengajuan</h5>
                    <div class="d-flex">
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-rigth: 10px;">
                            <label>Tanggal Mulai Pengajuan: </label>
                            <input class="form-control" type="datetime-local" name="tgl_mulai_pengajuan" required value="{{$proyek->tgl_mulai_pengajuan}}">
                        </div>
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-left: 10px;">
                            <label>Tanggal Berakhir Pengajuan: </label>
                            <input class="form-control" type="datetime-local" name="tgl_berakhir_pengajuan" value="{{$proyek->tgl_berakhir_pengajuan}}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mt-2 w-100">
                        <label>Tanggal Lelang: </label>
                        <input class="form-control" type="datetime-local" name="tgl_lelang" value="{{$proyek->tgl_lelang}}" required>
                    </div>

                    <hr>

                    <h5 style="text-align:center; margin-bottom:20px;">Tanggal Pelaksanaan</h5>
                    <div class="d-flex">
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-rigth: 10px;">
                            <label>Tanggal Mulai Pelaksanaan: </label>
                            <input class="form-control" type="datetime-local" name="tgl_mulai_pelaksanaan" value="{{$proyek->tgl_mulai_pelaksanaan}}" required>
                        </div>
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-left: 10px;">
                            <label>Tanggal Berakhir Pelaksanaan: </label>
                            <input class="form-control" type="datetime-local" name="tgl_berakhir_pelaksanaan" value="{{$proyek->tgl_berakhir_pelaksanaan}}" required>
                        </div>
                    </div>
                    <hr>    
                        

                    <div class="d-flex mt-2">
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-right:10px;">
                            <label>No SPK: </label>
                            <input class="form-control" type="text" name="no_spk" required value="{{$proyek->no_spk}}">
                        </div>
                        <div class="form-group mt-2 w-100" style="margin-left: 10px;">
                            <label>Tanggal SPK: </label>
                            <input class="form-control" type="datetime-local" name="tgl_spk" value="{{$proyek->tanggal_spk}}" required>
                        </div>
                    </div>


                    <div class="d-flex mt-2" style="margin-bottom: 30px">
                        <div class="form-group mt-2 w-100" style="height: 60px; margin-right: 10px;">
                            <label>No Kontrak: </label>
                            <input class="form-control" type="text"  name="no_kontrak" required value="{{$proyek->no_kontrak}}">
                        </div>
                        <div class="form-group mt-2 w-100" style="margin-left: 10px;">
                            <label>Tanggal Kontrak: </label>
                            <input class="form-control" type="datetime-local" value="{{$proyek->tgl_kontrak}}" name="tgl_kontrak" required>
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