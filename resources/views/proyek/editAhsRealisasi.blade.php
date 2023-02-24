@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-head">
            <h4 style="text-align:center; margin-top: 30px;"><b>Ubah AHS Realisasi</b></h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('editAhsRealisasi', [$id_proyek, $data->id] ) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Kelompok:</label>
                    <input type="text" name="kelompok" value="{{ $data->kelompok }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Kode:</label>
                    <select class="form-control" name="kode">
                        @foreach($ahs_data as $key=>$value)
                            <option value="{{$value->kode}}" {{$data->kode != $value->kode ?: 'selected'}}>{{$value->analisa_pekerjaan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan:</label>
                    <input type="text" name="keterangan" value="{{ $data->keterangan }}"  required class="form-control">
                </div>
                <div class="form-group">
                    <label>Bahan:</label>
                    <select class="form-control" name="id_bahan">
                        @foreach($bahan as $key=>$value)
                            <option value="{{$value->kode}}" {{$data->id_bahan != $value->kode ?: 'selected'}}>{{$value->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Koefisien:</label>
                    <input type="float" name="koefisien" value="{{ $data->koefisien }}"  required class="form-control">
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-primary w-100">submit</button>
                </div>
                <a href="{{route('viewAhsRealisasi', $id_proyek)}}" class="btn btn-primary w-100">kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
