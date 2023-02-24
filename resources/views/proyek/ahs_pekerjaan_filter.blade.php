@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container-fluid mb-4">
    <div class="d-flex">
        <div class="card p-3" style="width: 35%;">
            <form class="form" method="post" action="{{route('viewAhsPekerjaanFilter', $id_proyek)}}">
                @csrf
                <div class="d-flex">
                    <label style="width:30%; margin:auto;" class="border border-dark  mr-1 ">Kelompok Pekerjaan : </label>
                    <select name="nama_pekerjaan" id="" style="width:70%;">
                        @foreach($jenis_pekerjaan as $key=>$value)
                        <option value="{{$value->jenis_pekerjaan}}" {{$value->jenis_pekerjaan != $nama_pekerjaan ?: 'selected'}} >{{$value->jenis_pekerjaan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex mt-1">
                    <label style="width:30%; margin:auto;" class="border border-dark  mr-1 ">Lantai : </label>
                    <select name="lantai" id="" style="width:70%;">
                        @foreach($lantai_data as $key=>$value)
                        <option value="{{$value->keterangan}}" {{ $value->keterangan != $lantai ?: 'selected'}}>{{$value->keterangan}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="text-center mt-1 w-100">submit</button>
                <hr>
            </form>
    <form method="post" action="{{route('viewAhsPekerjaanFilterPreview',[$id_proyek, $nama_pekerjaan, $lantai])}}">
        @csrf
            <table border="1" style="text-align: center;" class="table-responsive-sm">
                <tr>
                    <th style="width: 30px; height:30px;"></th>
                    <th>Lantai</th>
                    <th>Kode</th>
                    <th>AHS Pekerjaan</th>
                    <th>Satuan</th>
                </tr>
                @foreach($data as $key=>$value)
                <tr>
                    <td><input type="radio" name="radio" value="{{$value->kode}}"></td>
                    <td>{{$value->keterangan}}</td>
                    <td>{{$value->kode}}</td>
                    <td>{{$value->analisa_pekerjaan}}</td>
                    <td>{{$value->satuan}}</td>
                </tr>
                @endforeach
            </table>
        </div>

        <div style="width: 65%; margin-left: 10px;" class="card p-3">
            <table border="1" style="text-align: center;" class="table-responsive-sm">
                <tr>
                    <th>Kode</th>
                    <th>Deskripsi</th>
                    <th>Koefisien</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah Harga</th>
                </tr>
            </table>

        </div>
    </div>

    <div class="d-flex " style="margin-top: 10px;">
        <div class="card p-3 " style="width: 35%;">
            <div class="d-flex text-center">
                <div class="dropdown w-100">
                      <button class="btn btn-primary dropdown-toggle w-100" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Cetak
                      </button>
                      <div class="dropdown-menu m-2" style="width: 200px;" aria-labelledby="dropdownMenu2">
                            <a href="{{route('cetakSemuaAhsPekerjaan', $id_proyek)}}" class="btn btn-primary w-100">Cetak Semua</a>
                            <a href="{{route('cetakFilterAhsPekerjaan', [$id_proyek, $nama_pekerjaan, $lantai])}}" class="btn btn-primary w- mt-2">Cetak AHS yang di pilih</a>
                      </div>
                </div>              
                <button class="w-100 ml-3 btn btn-primary" type="submit">preview</button>
            </div>
        </div>    
    </form>
        <div class="card p-3" style="width: 65%; margin-left: 10px;">
            <div class="d-flex" style="width: 100%; margin:auto;">
                <label  style="margin: auto; width: 30%; padding-right: 1%;" class="text-dark">Bahan: </label>
                <progress  value="0" max="100" class="w-100" style="margin: auto; color: black;">
                </progress>
                <label style="margin: auto; padding-left: 1%; width: 10%;">0%</label>
            </div>
            <div class="d-flex" style="width: 100%; margin:auto;">
                <label  style="margin: auto; width: 30%; padding-right: 1%;" class="text-primary">Upah: </label>
                <progress  value="0" max="100" class="w-100" style="margin: auto;">
                </progress>
                <label style="margin: auto; padding-left: 1%; width: 10%;">0%</label>
            </div>
            <div class="d-flex" style="width: 100%; margin:auto;">
                <label  style="margin: auto; width: 30%; padding-right: 1%; color: purple;">Alat Bantu: </label>
                <progress  value="0" max="100" class="w-100" style="margin: auto;">
                </progress>
                <label style="margin: auto; padding-left: 1%; width: 10%;">0%</label>
            </div>
            <div class="d-flex" style="width: 100%; margin:auto;">
                <label  style="margin: auto; width: 30%; padding-right: 1%; color: orange;">Lain-lain: </label>
                <progress  value="0" max="100" class="w-100" style="margin: auto;">
                </progress>
                <label style="margin: auto; padding-left: 1%; width: 10%;">0%</label>
            </div>
            <div class="d-flex" style="width: 100%; margin:auto;">
                <label  style="margin: auto; width: 30%; padding-right: 1%;" class="text-danger">Jumlah: </label>
                <progress  value="0" max="100" class="w-100" style="margin: auto;">
                </progress>
                <label style="margin: auto; padding-left: 1%; width: 10%;">0%</label>
            </div>
        </div>
    </div>

</div>
@endsection
