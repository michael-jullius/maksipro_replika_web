@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-head">
            <h4 style="text-align:center; margin-top: 30px;"><b>Tambah Data AHS Realisasi</b></h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('addAhsRealisasi', $id_proyek) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Kelompok:</label>
                    <input type="text" name="kelompok" placeholder="Kelompok" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Kode:</label>
                    <select name="kode" class="form-control">
                        @foreach($ahs_data as $key=>$value)
                        <option value="{{$value->kode}}">{{$value->analisa_pekerjaan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan:</label>
                    <input type="text" name="keterangan" placeholder="Keterangan" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Bahan:</label>
                    <select  class="selectpicker form-control" data-live-search="true" name="id_bahan">
                        @foreach($data as $key=>$value)
                            <option value="{{$value->kode}}">{{$value->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Satuan:</label>
                    <input type="text" name="satuan" placeholder="Satuan" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Koefisien:</label>
                    <input type="text" name="koefisien" placeholder="koefisien" required class="form-control">
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
