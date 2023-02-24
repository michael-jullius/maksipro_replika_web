@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-head">
            <h4 style="text-align:center; margin-top: 30px;"><b>Tambah Bahan</b></h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('addBahan', $id_proyek) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Kelompok:</label>
                    <select name="kelompok" class="form-control">
                        <option>a. Bahan</option>
                        <option>b. Upah</option>
                        <option>c. Alat Bantu</option>
                        <option>d. Lain-lain</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Sub Kelompok:</label>
                    <input type="text" name="sub_kelompok" placeholder="Sub Kelompok" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Kode:</label>
                    <input type="text" name="kode" placeholder="Kode" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Nama:</label>
                    <input type="text" name="nama" placeholder="Nama" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Satuan:</label>
                    <input type="text" name="satuan" placeholder="Satuan" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Harga:</label>
                    <input type="text" name="harga" placeholder="harga" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Keterangan:</label>
                    <input type="text" name="keterangan" placeholder="Keterangan" required class="form-control">
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
