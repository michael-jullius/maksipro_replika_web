@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-head">
            <h4 style="text-align:center; margin-top: 30px;"><b>Ubah Data AHS</b></h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('editAhsData', [$id_proyek, $data->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Jenis Pekerjaan:</label>
                    <input type="text" name="jenis_pekerjaan" value="{{ $data->jenis_pekerjaan }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Kode:</label>
                    <input type="text" name="Kode" value="{{ $data->kode }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Analisa Pekerjaan:</label>
                    <input type="text" name="analisa_pekerjaan" value="{{ $data->analisa_pekerjaan }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Satuan:</label>
                    <input type="text" name="satuan" value="{{ $data->satuan }}" required class="form-control">
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-primary w-100">submit</button>
                </div>
                <a href="{{route('viewAhsData', $id_proyek)}}" class="btn btn-primary w-100">kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
