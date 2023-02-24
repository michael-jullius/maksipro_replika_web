@extends('proyek.layout_proyek')

@section('title', 'addRab')

@section('content')
<div class="container-fluid">
    <div class="d-flex">
        <div class="card p-3" style="width: 100%;">
            <form class="form" method="post" action="{{route('viewAddFilterDetailRab', $id_proyek)}}">
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
                    <th style="width: 30px; height:30px;"></th>
                    <th>Lantai</th>
                    <th>Kode</th>
                    <th>AHS Pekerjaan</th>
                    <th>Satuan</th>
                </tr>
            </table>
    	</div>
    </div>
</div>
@endsection
