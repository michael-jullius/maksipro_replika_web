@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container-fluid">
    <div class="d-flex">
        <div class="card p-3" style="width: 35%;">
            <form class="form" method="post" action="{{route('viewAhsPekerjaanFilter', $id_proyek)}}">
                @csrf
                <div class="d-flex">
                    <label style="width:30%; margin:auto;" class="border border-dark  mr-1 ">Kelompok Pekerjaan : </label>
                    <select name="nama_pekerjaan" id="" style="width:70%;">
                        @foreach($jenis_pekerjaan as $key=>$value)
                        <option value="{{$value->jenis_pekerjaan}}" >{{$value->jenis_pekerjaan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex mt-1">
                    <label style="width:30%; margin:auto;" class="border border-dark  mr-1 ">Lantai : </label>
                    <select name="lantai" id="" style="width:70%;">
                        @foreach($lantai as $key=>$value)
                        <option value="{{$value->keterangan}}" >{{$value->keterangan}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="text-center mt-1 w-100">submit</button>
                <hr>
            </form>

            <table border="1" style="text-align: center;" class="table-responsive-sm">
                <tr>
                    <th>Lantai</th>
                    <th>Kode</th>
                    <th>AHS Pekerjaan</th>
                    <th>Satuan</th>
                </tr>
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
        <div class="card p-3" style="width: 35%;">
            <div class="d-flex m-5">
                <a href="{{route('cetakSemuaAhsPekerjaan', $id_proyek)}}" class="w-100 mr-1 btn btn-primary">cetak</a>
                <button class="w-100 ml-1 btn btn-primary">preview</button>
            </div>
        </div>
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
