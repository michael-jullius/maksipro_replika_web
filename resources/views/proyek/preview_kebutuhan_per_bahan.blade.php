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
<body onload="window.print()">
	<div class="container-fluid" id="laporan">
		<h3><b>{{Auth::user()->nama_perusahaan}}</b></h3>
		<h6><b>{{Auth::user()->alamat_perusahaan}}</b></h6>
		<h6>NPWP : {{Auth::user()->npwp}} | SIUP/TDP : {{Auth::user()->nomor_siup_tdp}}</h6>

		<p class="text-center mt-4 h5 mb-1"><b>TOTAL KEBUTUHAN SUMBER DAYA</b></p>

		<div class="border  border-dark mt-4 mb-1 p-3">
			<p class="text-center h5 mb-4">Indentitas Proyek</p>
			<div class="d-flex">
				<div style="margin-right: 20px;" class="w-50" >
					<p>Nama Proyek:</p>
					<p>{{Auth::user()->Proyek->where('id', $id_proyek)->first()->nama_proyek}}</p>
				</div>
				<div style="margin-right: 20px; " class="w-50">
					<p>Alamat Proyek:</p>
					<p>{{Auth::user()->Proyek->where('id', $id_proyek)->first()->alamat_proyek}}</p>
				</div>
				<div style="margin-right: 20px;" class="w-100">
					<p>No Kontrak : {{Auth::user()->Proyek->where('id', $id_proyek)->first()->no_kontrak}}</p>
					<p>Tanggal Kontrak : {{Auth::user()->Proyek->where('id', $id_proyek)->first()->tgl_kontrak}}</p>
					<p>No SPK : {{Auth::user()->Proyek->where('id', $id_proyek)->first()->no_spk}}</p>
					<p>Tanggal SPK : {{Auth::user()->Proyek->where('id', $id_proyek)->first()->tanggal_spk}}</p>
					<p>Tanggal Pelaksanaan : {{Auth::user()->Proyek->where('id', $id_proyek)->first()->tgl_mulai_pelaksanaan}} s/d {{Auth::user()->Proyek->where('id', $id_proyek)->first()->tgl_berakhir_pelaksanaan}}</p>
				</div>
			</div>
		</div>
		<table class="table table-bordered">
			<tr class="bg-dark text-light">
				<th style="text-align: center;">KODE</th>
				<th style="text-align: center;">DESKRIPSI</th>
				<th style="text-align: center;">HARGA</th>
				<th style="text-align: center;">JUMLAH</th>
				<th style="text-align: center;">SATUAN</th>
				<th style="text-align: center;">Nilai Kebutuhan</th>
			</tr>
			@foreach($sumber_daya as $key_sumber_daya=>$value_sumber_daya)
			<tr class="table-active">
				<td colspan="5" style="font-weight: bold;">{{$value_sumber_daya->kelompok}}</td>
				<td style="text-align: right; font-weight: bold;">{{number_format($value_sumber_daya->jumlah,2)}}</td>
			</tr>

			@foreach($sumber_daya_detail as $key_sumber_daya_detail=>$value_sumber_daya_detail)
			@if($value_sumber_daya_detail->kelompok == $value_sumber_daya->kelompok)
			<tr>
				<td>{{$value_sumber_daya_detail->id_bahan}}</td>
				<td>{{$value_sumber_daya_detail->nama}}</td>
				<td style="text-align: right;">{{number_format($value_sumber_daya_detail->harga_satuan,2)}}</td>
				<td style="text-align: right;">{{$value_sumber_daya_detail->volume}}</td>
				<td style="text-align: center;">{{$value_sumber_daya_detail->satuan}}</td>
				<td style="text-align: right;">{{$value_sumber_daya_detail->jumlah}}</td>
			</tr>
			@endif
			@endforeach
			@endforeach
			<tr>
				<td colspan="6"></td>
			</tr>
			<tr>

				<td colspan="5"><b>GRAND TOTAL:</b></td>
				<td style="text-align: right; font-weight: bold;">{{number_format($total->jumlah,2)}}</td>
			</tr>
		</table>
	<div class="d-flex">
			<div class="w-100 m-3">
				<p>menyetujui,</p>
				<p>Direktur:</p>
				<br><br><br>
				<p>{{Auth::user()->nama_direktur}}</p>
			</div>
			<div class="w-100 m-3">
				<p>{{Auth::user()->kota_kabupaten}}, {{date("Y/m/d")}}</p>
				<p>Estimator:</p>
				<br><br><br>

				<p>{{Auth::user()->nama_direktur}}</p>
			</div>
		</div>
	</div>
</body>
</html>
