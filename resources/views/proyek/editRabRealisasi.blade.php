@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-head">
            <h4 style="text-align:center; margin-top: 30px;"><b>Ubah Data AHS</b></h4>
        </div>
        <div class="card-body">
        	<form method="post" action="{{route('editRabRealisasi',[$id_proyek, $data->id])}}">
        		@csrf
        	<div class="form-group">
        		<label>nama pekerjaan</label>
        		<input type="text" name="nama_pekerjaan" class="form-control" value="{{$data->nama_pekerjaan}}">
        	</div>
        	<div class="form-group">
        		<label>budget</label>
        		<input type="number" name="budget" class="form-control" value="{{$data->budget}}">
        	</div>
        	<div class="form-group">
        		<label>bahan</label>
        		<input type="number" name="bahan" class="form-control" value="{{$data->bahan}}">
        	</div>
        	<div class="form-group">
        		<label>upah</label>
        		<input type="number" name="upah" class="form-control" value="{{$data->upah}}">
        	</div>
        	<div class="form-group">
        		<label>alat</label>
        		<input type="number" name="alat" class="form-control" value="{{$data->alat}}">
        	</div>
        	<div class="form-group">
        		<label>lain</label>
        		<input type="number" name="lain" class="form-control" value="{{$data->lain}}">
        	</div>
        	<div class="form-group">
        		<label>persentase</label>
        		<input type="number" name="persentase" class="form-control" value="{{$data->persentase}}">
        	</div>
        	<div class="form-group">
        		<label></label>
        		<button type="submit" class="btn btn-primary w-100">update</button>
        	</div>
        	</form>
        </div>

    </div>
</div>
@endsection
