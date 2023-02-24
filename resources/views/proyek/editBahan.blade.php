@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-head">
            <h4 style="text-align:center; margin-top: 30px;"><b>Rubah Bahan</b></h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('editBahan', [$id_proyek, $data->id]) }}" method="post">
                @csrf

                <div class="form-group">
                    <label>Kelompok:</label>
                    <input type="text" name="kelompok" value="{{ $data->kelompok }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Sub Kelompok:</label>
                    <input type="text" name="sub_kelompok" value="{{ $data->sub_kelompok }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Kode:</label>
                    <input type="text" name="kode" value="{{ $data->kode }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Nama:</label>
                    <input type="text" name="nama" value="{{ $data->nama }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Satuan:</label>
                    <input type="text" name="satuan" value="{{ $data->satuan }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Harga:</label>
                    <input type="text" name="harga" value="{{ $data->harga }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Keterangan:</label>
                    <input type="text" name="keterangan" value="{{ $data->keterangan }}" required class="form-control">
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-primary w-100">submit</button>
                </div>
                <a href="{{route('viewBahan', $id_proyek)}}" class="btn btn-primary w-100">kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
