@extends('layout')

@section('title', '')

@section('content')
<div class='container'>
    <div class='card' style="overflow-x:auto;">
        <div class="card-head d-flex mt-5 mr-5 ml-5">
            <h4 class="mr-auto">Management Proyek</h4>
            <a href="{{route('viewAddProyek')}}" class="btn btn-primary" style="float: right;">+ tambah</a>
        </div>
        <div class="card-body">
            <table class="table mt-5"> 
                <tr>
                    <th>no</th>
                    <th>Nama Proyek</th>
                    <th>Detail</th>
                </tr>

                @foreach($proyek as $key=>$value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->nama_proyek }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('viewDetailProyek', $value->id)}}">Detail</a>
                        <a class="btn btn-warning" href="{{route('viewEditProyek', $value->id)}}">Ubah</a>
                        <a href="{{route('viewCloneProyek', $value->id)}}" type="button" class="btn btn-primary">
                            Clone Proyek
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>



@endsection

