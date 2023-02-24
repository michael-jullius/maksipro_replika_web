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

		<p class="text-center mt-4 h5 mb-4"><b>AHS Pekerjaan Yang Digunakan Pada Proyek {{Auth::user()->Proyek->where('id', $id_proyek)->first()->nama_proyek}}</b></p>
	
		<table class="table table-bordered">
			<tr class="bg-dark text-light text-center">
				<th>Pekerjaan, Lantai dan Analisa Harga Satuan Pekerjaan</th>
				<th>Kode</th>
				<th>Satuan</th>
				<th>Koefisien</th>
				<th>Harga Satuan</th>
				<th>Jumlah Harga</th>
			</tr>
			@foreach($jenis_pekerjaan as $key_jenis_pekerjaan=>$value_jenis_pekerjaan)
			<tr class="table-active">
				<td colspan="6"><b>{{$value_jenis_pekerjaan->jenis_pekerjaan}}</b></td>
			</tr>


			@foreach($lantai->get() as $key_lantai=>$value_lantai)
			<tr>
				@php
				if($value_lantai->jenis_pekerjaan == $value_jenis_pekerjaan->jenis_pekerjaan){
					echo'<td colspan="6">'.'<b>'.$value_lantai->lantai.'</b>'.'</td>';
					foreach($analisa as $key_analisa=>$value_analisa){
						if($value_analisa->jenis_pekerjaan == $value_jenis_pekerjaan->jenis_pekerjaan and $value_analisa->lantai == $value_lantai->lantai){
							echo'<tr>';
								echo'<td style="font-weight: bold;">'.$value_analisa->analisa.'</td>';
								echo'<td style="font-weight: bold;">'.$value_analisa->kode_analisa.'</td>';
								echo'<td style="font-weight: bold;" colspan="3">'.$value_analisa->satuan_ahs.'</td>';
								echo'<td style="font-weight: bold; text-align: right;">'.$value_analisa->jumlah.'</td>';
							echo'</tr>';
							foreach($analisa_satuan as $key_analisa_satuan=>$value_analisa_satuan){
								if(($value_analisa_satuan->jenis_pekerjaan == $value_jenis_pekerjaan->jenis_pekerjaan and $value_analisa_satuan->lantai == $value_lantai->lantai) and $value_analisa_satuan->analisa == $value_analisa->analisa){
									echo'<tr>';
										echo'<td>'.$value_analisa_satuan->nama.'</td>';
										echo'<td>'.$value_analisa_satuan->id_bahan.'</td>';
										echo'<td style="text-align: center;">'.$value_analisa_satuan->satuan_ahs.'</td>';
										echo'<td style="text-align: right;">'.$value_analisa_satuan->koefisien.'</td>';
										echo'<td style="text-align: right;">'.$value_analisa_satuan->harga_satuan.'</td>';
										echo'<td style="text-align: right;">'.$value_analisa_satuan->jumlah.'</td>';
									echo'</tr>';
								}
							}
						}
					}
				}
				@endphp
			</tr>
		
			@endforeach
			@endforeach
		</table>
	</div>
</body>
</html>