@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container">
    <div class="card" style="overflow-x:auto;">
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr class="text-center">
                    <th rowspan="2">no</th>
                    <th rowspan="2">nama pekerjaan</th>
                    <th rowspan="2">budget</th>
                    <th colspan="4">realisasi</th>
                    <th rowspan="2">total</th>
                    <th rowspan="2">actual</th>
                    <th rowspan="2">action</th>
                </tr>
                <tr class="text-center">
                    <th>bahan</th>
                    <th>upah</th>
                    <th>alat</th>
                    <th>lain</th>
                </tr>
            </thead>
            @foreach($data as $key=>$value)
            <tr>
                <td>{{$key++}}</td>
                <td>{{$value->nama_pekerjaan}}</td>
                <td>{{number_format($value->budget,2)}}</td>
                <td>{{number_format($value->bahan,2)}}</td>
                <td>{{number_format($value->upah,2)}}</td>
                <td>{{number_format($value->alat,2)}}</td>
                <td>{{number_format($value->lain,2)}}</td>
                <td>{{number_format($value->bahan + $value->upah + $value->alat + $value->lain,2)}}</td>
                <td>{{$value->persentase}}%</td>
                <td class="d-flex"><a class="btn btn-warning mr-2" href="{{route('viewEditRabRealisasi', [$id_proyek, $value->id])}}">edit</a><a class="btn btn-danger" href="{{route('deleteRabRealisasi', [$id_proyek, $value->id])}}">hapus</a></td>
            </tr>
            @endforeach
            <form class="form" method="post" action="{{route('addRabRealisasi', $id_proyek)}}">
            @csrf
            <tr>
                <td></td>
                <td><input type="text" name="nama_pekerjaan" class="form-control" style="width: 300px" required></td>
                <td><input type="number" name="budget" class="form-control" required style="width: 300px"></td>
                <td><input type="number" name="bahan" class="form-control" style="width: 300px" required></td>
                <td><input type="number" name="upah" class="form-control" style="width: 300px" required></td>
                <td><input type="number" name="alat" class="form-control" style="width: 300px" required></td>
                <td><input type="number" name="lain" class="form-control" style="width: 300px" required></td>
                <td></td>
                <td><input type="number" name="persentase" class="form-control" style="width: 300px" required></td>
                <td><button type="submit" class="btn btn-primary w-100">save</button></td>
            </tr>
            </form>
        </table>

    </div>
</div>
@endsection
