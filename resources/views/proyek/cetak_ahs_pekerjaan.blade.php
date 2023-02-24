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
				<th style="text-align: center;">Pekerjaan, Lantai, dan Analisa Harga Satuan Pekerjaan</th>
				<th style="text-align: center;">kode</th>
				<th style="text-align: center;">Satuan</th>
				<th style="text-align: center;">Koefisien</th>
				<th style="text-align: center;">Harga Satuan</th>
				<th style="text-align: center;">Nilai Kebutuhan</th>
			</tr>
			@foreach($jenis_pekerjaan as $key_jenis_pekerjaan=>$value_jenis_pekerjaan)
			<tr class="table-active">
				<td colspan="6"><b>{{$value_jenis_pekerjaan->jenis_pekerjaan}}</b></td>
			</tr>


			@foreach($lantai as $key_lantai=>$value_lantai)
			@php
			if($value_lantai->jenis_pekerjaan == $value_jenis_pekerjaan->jenis_pekerjaan){
				echo'<tr>';
					echo'<td colspan="6">'.'<b>'.$value_lantai->keterangan.'</b>'.'</td>';
				echo'</tr>';
				foreach($analisa as $key_analisa=>$value_analisa){
					if($value_analisa->jenis_pekerjaan == $value_jenis_pekerjaan->jenis_pekerjaan AND $value_analisa->keterangan == $value_lantai->keterangan){
						echo'<tr>';
							echo'<td>'.'<b>'.$value_analisa->analisa_pekerjaan.'</b>'.'</td>';	
							echo'<td>'.'<b>'.$value_analisa->kode.'</b>'.'</td>';	
							echo'<td colspan="3">'.'<b>'.$value_analisa->satuan.'</b>'.'</td>';	
							echo'<td style="text-align: right;">'.'<b>'.number_format($value_analisa->jumlah,2).'</b>'.'</td>';	
						echo'</tr>';
						foreach($analisa_satuan as $key_analisa_satuan=>$value_analisa_satuan){
							if(($value_analisa_satuan->jenis_pekerjaan == $value_jenis_pekerjaan->jenis_pekerjaan AND $value_analisa_satuan->keterangan == $value_lantai->keterangan) and $value_analisa_satuan->analisa_pekerjaan == $value_analisa->analisa_pekerjaan){
								echo'<tr>';
									echo'<td >'.$value_analisa_satuan->nama.'</td>';
									echo'<td >'.$value_analisa_satuan->kode.'</td>';
									echo'<td style="text-align: center;">'.$value_analisa_satuan->satuan.'</td>';
									echo'<td style="text-align: right;">'.$value_analisa_satuan->koefisien.'</td>';
									echo'<td style="text-align: right;">'.number_format($value_analisa_satuan->harga,2).'</td>';
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
			<tr>
				<td colspan="6"></td>
			</tr>
			@foreach($total_persentase as $key=>$value)
			<tr>
				<td colspan="4"><b>{{$value->kelompok}}</b></td>
				<td style="font-weight: bold; text-align: right;">{{ number_format($value->jumlah / ($total->jumlah / 100),2) }}%</td>
				<td style="font-weight: bold; text-align: right;">{{ $value->jumlah }}</td>
			</tr>
			@endforeach
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
