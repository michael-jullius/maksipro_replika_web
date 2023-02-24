@extends('proyek.layout_proyek')

@section('content')
<div class="container-fluid">
	<div class="card p-3">
		<h2 class="text-center mt-4">Setting</h2>
		<hr class="mt-4 mb-4">
		@if(Session::has('success'))
		<div class="p-3 rounded mb-5" style="background-color: #24d13e;">
			<h4 class="text-center text-light">{{Session::get('success')}}</h4>
		</div>
		@endif
		<div class="d-flex">
			<div style="width: 50%">
				<h3>Query</h3>
			</div>
			<div style="width: 50%">
				<a href="{{route('resetQuery',$id_proyek)}}" class="btn btn-primary">Reset Query</a>	
			</div>
		</div>
	</div>
</div>
@endsection