@extends('layout')

@section('title', '')

@section('content')
<div class="container">
	<form class="form" method="post" action="{{route('cloneProyek', $proyek->id)}}">	
		@csrf
		<div class="card p-4">
		<h1 style="text-align: center;">Clone Proyek</h1>
		<h2>Dari: {{$proyek->nama_proyek}}</h2>
		<h5>Ke</h5>
		<select class="form-control" name="target">
			@foreach($Proyek as $key=>$value)
			<option value="{{$value->id}}">{{$value->nama_proyek}}</option>
			@endforeach
		</select>
		<button type="submit" class="btn btn-primary mt-3">submit</button>
		<a href="{{route('viewProyek')}}" class=" btn btn-primary mt-3">kembali</a>
	</div>

</form>
</div>
@endsection