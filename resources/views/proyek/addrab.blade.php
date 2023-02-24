@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-head">
            <h4 style="text-align:center; margin-top: 30px;"><b>Tambah Rab</b></h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('addRab', $id_proyek) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Kode Pekerjaan:</label>
                    <input type="text" name="kode_pekerjaan" placeholder="kode pekerjaan" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Nama Pekerjaan:</label>
                    <input type="text" name="nama_pekerjaan" placeholder="nama pekerjaan" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Lantai :</label>
                    <input type="text" name="lantai" placeholder="Lantai" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Analisa:</label>
                    <select class="form-control " name='kode'>
                        @foreach($data as $key=>$value)
                            <option value="{{$value->kode}}">{{$value->analisa_pekerjaan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Volume:</label>
                    <input type="text" name="volume" placeholder="Volume" required class="form-control">
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-primary w-100">submit</button>
                </div>
                <a href="{{route('viewRab', $id_proyek)}}" class="btn btn-primary w-100">kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
