@extends('proyek.layout_proyek')

@section('title', 'new proyek')

@section('content')
<div class="container">
	<div class="card p-5">
		<h3 class="text-center">Progress</h3>
		<div class="d-flex">
			<label class="w-100">Budget</label>
			@if(is_null($rab_realisasi->budget))
			<label>Rp.0</label>
			@else
			<label>Rp.{{number_format($rab_realisasi->budget,2)}}</label>
			@endif
		</div>

		<hr>
		<div class="d-flex">
			<label class="w-100">Realisasi</label>
			<label>Rp.{{number_format($rab_realisasi->harga_realisasi,2)}}</label>
		</div>
		<div class="progress">
			@if(is_null($rab_realisasi->budget))
			<div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
			@elseif(($rab_realisasi->budget + $rab_realisasi->harga_realisasi - $rab_realisasi->budget) / ($rab_realisasi->budget / 100 ) > 100)
		  <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
		  <div class="progress-bar bg-danger" role="progressbar" style="width: {{($rab_realisasi->budget + $rab_realisasi->harga_realisasi - $rab_realisasi->budget) / ($rab_realisasi->budget / 100 ) - 100}}%" aria-valuenow="{{($rab_realisasi->budget + $rab_realisasi->harga_realisasi - $rab_realisasi->budget) / ($rab_realisasi->budget / 100 ) - 100}}" aria-valuemin="0" aria-valuemax="100">{{number_format(($rab_realisasi->budget + $rab_realisasi->harga_realisasi - $rab_realisasi->budget) / ($rab_realisasi->budget / 100 ) - 100)}}%</div>
		  @else
		  <div class="progress-bar" role="progressbar" style="width: {{($rab_realisasi->budget + $rab_realisasi->harga_realisasi - $rab_realisasi->budget) / ($rab_realisasi->budget / 100 )}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{number_format(($rab_realisasi->budget + $rab_realisasi->harga_realisasi - $rab_realisasi->budget) / ($rab_realisasi->budget / 100 ))}}%</div>
		  @endif
		</div>
		
		<label class="w-100">Actual</label>
		@if(is_null($rab_realisasi->actual))
		<div class="progress">
			<div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
		</div>
		@else
		<div class="progress">
		  <div class="progress-bar" role="progressbar" style="width: {{$rab_realisasi->actual}}%;" aria-valuenow="{{$rab_realisasi->actual}}" aria-valuemin="0" aria-valuemax="100">{{$rab_realisasi->actual}}%</div>
		</div>
		@endif
	</div>
</div>
@endsection
