@extends('proyek.layout_proyek')

@section('title', 'addRab')

@section('content')
<div class="container-fluid mb-4">
    <div class="d-flex">
        <div class="card p-3" style="width: 100%;">
            <form class="form" method="post" action="{{route('viewAddFilterDetailRab', $id_proyek)}}">
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
        <form method="post" action="{{route('createRab', [$id_proyek,$nama_pekerjaan,$lantai])}}">
            @csrf
                <table border="1" style="text-align: center; width:100%;" class="table-responsive-sm">
                    <tr>
                        <th style="width:30px; height:30px;"></th>
                        <th>Lantai</th>
                        <th>Kode</th>
                        <th>AHS Pekerjaan</th>
                        <th>Satuan</th>
                    </tr>
                    @foreach($data as $key=>$value)
                    <tr>
                        <td><input type="radio" name="kode_analisa" value="{{$value->kode}}"></td>
                        <td>{{$value->keterangan}}</td>
                        <td>{{$value->kode}}</td>
                        <td>{{$value->analisa_pekerjaan}}</td>
                        <td>{{$value->satuan}}</td>
                    </tr>
                    @endforeach
                </table>
                <div class="form-group mt-3">
                    <input type="text" name="kode_pekerjaan" placeholder="kode pekerjaan" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="nama_pekerjaan" placeholder="nama pekerjaan" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="volume" placeholder="Volume" required class="form-control">
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-primary w-100">Simpan</button>
                </div>
        </form>
    	</div>
    </div>
</div>
@endsection
