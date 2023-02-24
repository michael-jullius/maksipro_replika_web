<!DOCTYPE html>
<html>
<head>
	<title>rekap preview</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
	<style type="text/css">
		
		@media print {
		    @page {
		        margin-top: 72;
		        margin-bottom: 72;
		    }
		    tr, td {
			  page-break-inside: avoid;
			}
		}
	</style>
</head>
<body onload="">
	<div class="container-fluid" id="laporan">
		<h3><b>{{Auth::user()->nama_perusahaan}}</b></h3>
		<h6><b>{{Auth::user()->alamat_perusahaan}}</b></h6>
		<h6>NPWP : {{Auth::user()->npwp}} | SIUP/TDP : {{Auth::user()->nomor_siup_tdp}}</h6>

		<p class="mt-4 h5"><b>Rencana Anggaran Biaya Proyek {{Auth::user()->Proyek->where('id', $id_proyek)->first()->nama_proyek}}</b></p>
	
		<table class="table table-bordered">
			<tr class="text-center">
				<th rowspan="2">Kode</th>
				<th rowspan="2">Pekerjaan</th>
				<th rowspan="2">Volume</th>
				<th rowspan="2">Satuan</th>
				<th colspan="5">Harga Satuan</th>
				<th colspan="5">Jumlah Harga</th>
			</tr>
			<tr class="text-center">
				<th>Bahan</th>
				<th>Upah</th>
				<th>Alat Bantu</th>
				<th>Lain-Lain</th>
				<th>Jumlah</th>
				<th>Bahan</th>
				<th>Upah</th>
				<th>Alat Bantu</th>
				<th>Lain-Lain</th>
				<th>Jumlah</th>
			</tr>
			@php
			$jenis_pekerjaan_data = '';
			@endphp
			@foreach($jenis_pekerjaan as $key_jenis_pekerjaan=>$value_jenis_pekerjaan)
			@if($value_jenis_pekerjaan->jenis_pekerjaan != $jenis_pekerjaan_data)
			<tr>
				<td></td>
				<td colspan="8">{{$value_jenis_pekerjaan->jenis_pekerjaan}}</td>
				@php
				if($value_jenis_pekerjaan->kelompok == 'a. Bahan'){
					echo'<td >'.$value_jenis_pekerjaan->jumlah.'</td>';
				}else{
					echo'<td>0,00</td>';
				}
				if($value_jenis_pekerjaan->kelompok == 'b. Upah'){
					echo'<td >'.$value_jenis_pekerjaan->jumlah.'</td>';
				}
				@endphp
				@php $jenis_pekerjaan_data = $value_jenis_pekerjaan->jenis_pekerjaan; @endphp
			@elseif($value_jenis_pekerjaan->jenis_pekerjaan == $jenis_pekerjaan_data)
				@php
				if($value_jenis_pekerjaan->kelompok == 'b. Upah'){
					echo'<td >'.$value_jenis_pekerjaan->jumlah.'</td>';
				}else{
					echo'<td>0,00</td>';
				}
				
				@endphp
			</tr>
			@endif
			@endforeach
		</table>
	</div>
</body>
</html>