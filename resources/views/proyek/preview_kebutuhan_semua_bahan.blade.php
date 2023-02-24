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

		<p class="text-center mt-4 h5 mb-1"><b>RINCIAN KEBUTUHAN SUMBER DAYA PROYEK PER AHS PEKERJAAN</b></p>

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
				<th style="text-align: center;">Pekerjaan, AHS PEKERJAAN dan Material</th>
				<th style="text-align: center;">kode</th>
				<th style="text-align: center;">Harga</th>
				<th style="text-align: center;">Volume</th>
				<th style="text-align: center;">Satuan</th>
				<th style="text-align: center;">Nilai Kebutuhan</th>
			</tr>
			@foreach($jenis_pekerjaan as $key_jenis_pekerjaan=>$value_jenis_pekerjaan)
			<tr class="table-active">
				<td colspan="5"><b>{{$value_jenis_pekerjaan->jenis_pekerjaan}}</b></td>
				<td style="text-align: right; font-weight: bold;">{{number_format($value_jenis_pekerjaan->jumlah,2)}}</td>
			</tr>


			@foreach($lantai->get() as $key_lantai=>$value_lantai)
			<tr>
				@if($value_lantai->jenis_pekerjaan == $value_jenis_pekerjaan->jenis_pekerjaan)
				<td colspan="5"><b>{{$value_lantai->lantai}}</b></td>
				<td style="text-align: right; font-weight: bold;">{{number_format($value_lantai->jumlah)}}</td>
				@endif
			</tr>
			@foreach($nama_pekerjaan as $key_nama_pekerjaan=>$value_nama_pekerjaan)
				@php if(($value_nama_pekerjaan->jenis_pekerjaan == $value_jenis_pekerjaan->jenis_pekerjaan and $value_nama_pekerjaan->jenis_pekerjaan == $value_lantai->jenis_pekerjaan) and $value_nama_pekerjaan->lantai == $value_lantai->lantai){
					echo'<tr>';
						echo'<td>'.'<b>'.$value_nama_pekerjaan->nama_pekerjaan.'</b>'.'</td>';
						echo'<td colspan="4" >'.'<b>'.$value_nama_pekerjaan->kode_pekerjaan.'</b>'.'</td>';
						echo'<td style="text-align: right; font-weight: bold;">'.number_format($value_nama_pekerjaan->jumlah).'</td>';
					echo'</tr>';
					foreach($analisa as $key_analisa=>$value_analisa){
						if($value_analisa->nama_pekerjaan == $value_nama_pekerjaan->nama_pekerjaan){
							echo'<tr style="font-weight: bold;">';
								echo'<td>'.$value_analisa->analisa.'</td>';
								echo'<td>'.$value_analisa->kode_analisa.'</td>';
								echo'<td style="text-align: right;">'.number_format($value_analisa->jumlah / $value_analisa->volume,2).'</td>';
								echo'<td style="text-align: right;">'.$value_analisa->volume.'</td>';
								echo'<td style="text-align: center;">'.$value_analisa->satuan_ahs.'</td>';

								echo'<td style="text-align: right;">'.number_format($value_analisa->jumlah,2).'</td>';
							echo'</tr>';
							foreach($analisa_satuan as $key_analisa_satuan=>$value_analisa_satuan){
								if(($value_analisa_satuan->jenis_pekerjaan == $value_jenis_pekerjaan->jenis_pekerjaan and $value_analisa_satuan->lantai == $value_lantai->lantai) and ($value_analisa_satuan->nama_pekerjaan == $value_nama_pekerjaan->nama_pekerjaan and $value_analisa_satuan->analisa ==  $value_analisa->analisa)){
									echo'<tr>';
										echo'<td>'.$value_analisa_satuan->nama.'</td>';
										echo'<td>'.$value_analisa_satuan->id_bahan.'</td>';
										echo'<td style="text-align: right;">'.number_format($value_analisa_satuan->harga_satuan,2).'</td>';
										echo'<td style="text-align: right;">'.$value_analisa_satuan->volume.'</td>';
										echo'<td style="text-align: center;">'.$value_analisa_satuan->satuan_ahs.'</td>';
										echo'<td style="text-align: right;">'.number_format($value_analisa_satuan->jumlah,2).'</td>';
									echo'</tr>';
								}
							}
						}
					}

				}
				@endphp


			@endforeach
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
