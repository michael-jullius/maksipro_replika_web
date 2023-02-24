@extends('proyek.layout_proyek')

@section('title', 'Bahan')

@section('content')
<div class='container'>
    <div class='card' style="overflow-x:auto;">
        <div class="card-head mt-5 mr-5 ml-5">
            <h4 class="mr-auto">Management Bahan</h4>            
        </div>
        <div class="d-flex mt-3 mr-5 ml-5">
            <nav class="navbar navbar-light bg-light w-100 d-flex">
                <form class="form-inline mr-auto d-flex">
                    <select name="filter" class="form-control mr-2">
                        <option value="kelompok">Kelompok</option>
                        <option value="sub_kelompok">Sub Kelompok</option>
                        <option value="kode">Kode</option>
                        <option value="nama">Nama</option>
                        <option value="satuan">Satuan</option>
                        <option value="harga">harga</option>
                        <option value="keterangan">Keterangan</option>
                    </select>
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
                <div class="dropdown mr-3">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Export To
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: #DCDCDC;">
                        <a href="{{route('exportExcelBahan', $id_proyek)}}" class="btn btn-success" style="margin:10px; width: 200px;"><i class="bi bi-file-earmark-spreadsheet mr-2"></i>Export Excel</a>
                        <a href="" class="btn btn-danger" style="margin:10px; width:200px;"><i class="bi bi-file-earmark-pdf mr-2"></i>Export Pdf</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuAdd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        + Tambah Data
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuAdd" style="background: #DCDCDC;">
                        <a href="#" class="btn btn-primary" data-toggle="modal" style="margin:10px; width: 200px;" data-target="#ImportExcel"><i class="bi bi-upload mr-2"></i>Import Excel</a>
                        <a href="{{ route('viewAddBahan', $id_proyek) }}" style="margin:10px; width: 200px;" class="btn btn-primary">+ Tambah Manual</a>
                    </div>
                </div>
                <a href="{{ route('deleteAllBahan', $id_proyek) }}" class="btn btn-danger ml-3"><i class="bi bi-trash mr-2"></i>Delete All</a>
            </nav>
        </div>
        <div class="card-body">
            <table class="table mt-5">
                <tr>
                    <th>no</th>
                    <th>Kelompok</th>
                    <th>Sub Kelompok</th>
                    <th>kode</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Keterangan</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>

                @foreach($data as $key=>$value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->kelompok }}</td>
                    <td>{{ $value->sub_kelompok }}</td>
                    <td>{{ $value->kode }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->satuan }}</td>
                    <td>{{ $value->harga }}</td>
                    <td>{{ $value->keterangan }}</td>
                    <td class="d-flex">
                        <a class="btn btn-warning mr-2" href="{{  route('viewEditBahan', [$id_proyek, $value->id]) }}" ><b>Ubah</b></a>
                        <a class="btn btn-danger ml-2" href="{{ route('deleteBahan', [$id_proyek, $value->id]) }}" ><b>Hapus</b></a>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="d-flex justify-content-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="ImportExcel" tabindex="-1" role="dialog" aria-labelledby="ImportExel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Import Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" method="post" enctype="multipart/form-data" action="{{ route('importExcelBahan', $id_proyek)}}">
            @csrf 
            <div class="modal-body">
                <div class="form-group">
                    <input type="file" name="file" required>
                </div>
            </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

        </form>
    </div>
  </div>
</div>
</div>
@endsection

