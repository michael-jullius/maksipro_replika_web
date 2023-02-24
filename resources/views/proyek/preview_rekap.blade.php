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

		<p class="text-center mt-4 h5 mb-4"><b>REKAPITULASI RENCANA ANGGARAN DAN BIAYA</b></p>

		<div class="border  border-dark mt-4 mb-4 p-3">
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
			<tr class="text-center" style="background-color: black; color: white;">
				<th>KELOMPOK PEKERJAAN</th>
				<th>BAHAN</th>
				<th>UPAH</th>
				<th>ALAT</th>
				<th>LAIN LAIN</th>
				<th>JUMLAH</th>
			</tr>
			@foreach($data as $key=>$value)
			<tr>
				<td>{{ $value->jenis_pekerjaan}}</td>
				<td style="text-align: right;">{{ number_format($value->bahan ,2)}}</td>
				<td style="text-align: right;">{{ number_format($value->upah ,2)}}</td>
				<td style="text-align: right;">{{ number_format($value->alat ,2)}}</td>
				<td style="text-align: right;">{{ number_format($value->lain ,2)}}</td>
				<td style="text-align: right;">{{ number_format((float)$value->bahan  + (float)$value->upah + (float)$value->alat + (float)$value->lain, 2) }}</td>
			</tr>
			@endforeach
			<tr class="table-active">
				<td><b>JUMLAH</b></td>
				<td style="text-align: right;">{{number_format($jumlah->bahan,2)}}</td>
				<td style="text-align: right;">{{number_format($jumlah->upah,2)}}</td>
				<td style="text-align: right;">{{number_format($jumlah->alat,2)}}</td>
				<td style="text-align: right;">{{number_format($jumlah->lain,2)}}</td>
				<td style="text-align: right;">{{number_format($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain,2)}}</td>
			</tr>
			<tr>
				<td><b>JASA KONTRAKTOR</b></td>
				<td style="text-align: right;">{{ number_format($jumlah->bahan == 0 ? 0:  $jumlah->bahan / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0),2)}}</td>
				<td style="text-align: right;">{{ number_format($jumlah->upah == 0 ? 0: $jumlah->upah / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0), 2)}}</td>
				<td style="text-align: right;">{{ number_format($jumlah->alat == 0 ? 0: $jumlah->alat / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0), 2)}}</td>
				<td style="text-align: right;">{{ number_format($jumlah->lain == 0 ? 0: $jumlah->lain / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0) , 2)}}</td>
				<td style="text-align: right;">{{ number_format(($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain) == 0 ? 0: ($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0) , 2)}}</td>
			</tr>
			<tr>
				<td><b>JUMLAH + JASA KONTRAKTOR</b></td>
				<td style="text-align: right;">{{ number_format($jumlah->bahan == 0 ? 0: $jumlah->bahan + $jumlah->bahan / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0), 2)}}</td>
				<td style="text-align: right;">{{ number_format($jumlah->upah == 0 ? 0: $jumlah->upah + $jumlah->upah / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0),2 )}}</td>
				<td style="text-align: right;">{{ number_format($jumlah->alat == 0 ? 0: $jumlah->alat + $jumlah->alat / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0),2 )}}</td>
				<td style="text-align: right;">{{ number_format($jumlah->lain == 0 ? 0: $jumlah->lain + $jumlah->lain / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0),2 )}}</td>
				<td style="text-align: right;">{{ number_format(($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain) == 0 ? 0: ($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0) + ($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain)  ,2 )}}</td>
			</tr>
			<tr>
				<td><b>PPN</b></td>
				<td style="text-align: right;">{{ number_format(($jumlah->bahan == 0 ? 0: $jumlah->bahan + $jumlah->bahan / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0)) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->ppn ?? 0), 2)}}</td>
				<td style="text-align: right;">{{ number_format(($jumlah->upah == 0 ? 0: $jumlah->upah + $jumlah->upah / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0)) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->ppn ?? 0), 2)}}</td>
				<td style="text-align: right;">{{ number_format(($jumlah->alat == 0 ? 0: $jumlah->alat + $jumlah->alat / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0)) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->ppn ?? 0), 2)}}</td>
				<td style="text-align: right;">{{ number_format(($jumlah->lain == 0 ? 0: $jumlah->lain + $jumlah->lain / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0)) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->ppn ?? 0) , 2)}}</td>
				<td style="text-align: right;">{{ number_format((($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain) == 0 ? 0: ($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0) + ($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain)) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->ppn ?? 0) , 2)}}</td>
			</tr>
			<tr>
				<td><b>GRAND TOTAL</b></td>
				<td style="text-align: right;">{{ number_format($jumlah->bahan == 0 ? 0: $jumlah->bahan + $jumlah->bahan / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0) + (($jumlah->bahan == 0 ? 0: $jumlah->bahan + $jumlah->bahan / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0)) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->ppn ?? 0)) , 2) }}</td>
				<td style="text-align: right;">{{ number_format($jumlah->upah == 0 ? 0: $jumlah->upah + $jumlah->upah / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0) + (($jumlah->upah == 0 ? 0: $jumlah->upah + $jumlah->upah / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0)) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->ppn ?? 0)),2 )}}</td>
				<td style="text-align: right;">{{ number_format($jumlah->alat == 0 ? 0: $jumlah->alat + $jumlah->alat / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0) + (($jumlah->alat == 0 ? 0: $jumlah->alat + $jumlah->alat / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0)) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->ppn ?? 0)),2 ) }}</td>
				<td style="text-align: right;">{{ number_format($jumlah->lain == 0 ? 0: $jumlah->lain + $jumlah->lain / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0) + (($jumlah->lain == 0 ? 0: $jumlah->lain + $jumlah->lain / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0)) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->ppn ?? 0)) ,2 ) }}</td>
				<td style="text-align: right;">{{ number_format((($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain) == 0 ? 0: ($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain)) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0) + ((($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->kontraktor ?? 0) + ($jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain)) / 100 * (Auth::user()->ppn->where('id_proyek', $id_proyek)->first()->ppn ?? 0)) + $jumlah->bahan+$jumlah->upah+$jumlah->alat+$jumlah->lain ,2 )
				}}</td>
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