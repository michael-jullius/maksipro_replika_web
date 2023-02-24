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

    <script type="text/javascript">
        $(document).ready(function () {
              $('select').selectize({
                  sortField: 'text'
              });
        });
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }

    </script>
</head>
<body onload="window.print()">
	<div class="container-fluid" id="laporan">
		<h3><b>{{Auth::user()->nama_perusahaan}}</b></h3>
		<h6><b>{{Auth::user()->alamat_perusahaan}}</b></h6>
		<h6>NPWP : {{Auth::user()->npwp}} | SIUP/TDP : {{Auth::user()->nomor_siup_tdp}}</h6>

		<p class="text-center mt-4 h5 mb-1"><b>KEBUTUHAN SUMBER DAYA PROYEK PER ITEM</b></p>

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
		<div class="d-flex" style="font-weight: bold;">
			<div class="w-100 d-flex">
				<p style="margin-right: 30px;">Item Deskripsi: </p>
				<p class="text-danger">{{$item->id_bahan.' '.$item->nama}}</p>
			</div>
			<div class="d-flex"></div>
			<p style="margin-right: 10px;">Harga </p>
			<p style="margin-right: 20px;">Rp.:</p>
			<p style="margin-right: 30px;" class="text-danger"> {{number_format($item->harga_satuan)}}</p>
		</div>
		<table class="table table-bordered">
			<tr class="bg-dark text-light">
				<th style="text-align: center;">Kode</th>
				<th style="text-align: center;">Pekerjaan</th>
				<th style="text-align: center;">Volume</th>
				<th style="text-align: center;">Satuan</th>
				<th style="text-align: center;">Nilai Kebutuhan</th>
			</tr>
			@foreach($jenis_pekerjaan as $key_jenis_pekerjaan=>$value_jenis_pekerjaan)
			<tr style="font-weight: bold;">
				<td colspan="2">{{$value_jenis_pekerjaan->jenis_pekerjaan}}</td>
				<td style="text-align: right;">{{number_format($value_jenis_pekerjaan->volume,2)}}</td>
				<td style="text-align: center;">{{$value_jenis_pekerjaan->satuan}}</td>
				<td style="text-align: right;">{{number_format($value_jenis_pekerjaan->jumlah,2)}}</td>
			</tr>
			@foreach($lantai as $key_lantai=>$value_lantai)
			@if($value_lantai->jenis_pekerjaan == $value_jenis_pekerjaan->jenis_pekerjaan)
			<tr style="font-weight: bold;">
				<td colspan="2">{{$value_lantai->lantai}}</td>
				<td style="text-align: right;">{{number_format($value_lantai->volume,2)}}</td>
				<td style="text-align: center;">{{$value_lantai->satuan}}</td>
				<td style="text-align: right;">{{number_format($value_lantai->jumlah,2)}}</td>
			</tr>
			@foreach($pekerjaan as $key_pekerjaan=>$value_pekerjaan)
			@if($value_pekerjaan->jenis_pekerjaan == $value_jenis_pekerjaan->jenis_pekerjaan and $value_pekerjaan->lantai == $value_lantai->lantai)
			<tr>
				<td>{{$value_pekerjaan->kode_pekerjaan}}</td>
				<td>{{$value_pekerjaan->nama_pekerjaan}}</td>
				<td style="text-align: right;">{{number_format($value_pekerjaan->volume,2)}}</td>
				<td style="text-align: center;">{{$value_pekerjaan->satuan}}</td>
				<td style="text-align: right;">{{number_format($value_pekerjaan->jumlah,2)}}</td>
			</tr>
			@endif
			@endforeach
			@endif
			@endforeach
			@endforeach

			<tr>
				<td colspan="6"></td>
			</tr>
			<tr>

				<td colspan="2"><b>GRAND TOTAL:</b></td>
				<td style="text-align: right; font-weight: bold;">{{number_format($total->volume,2)}}</td>
				<td style="text-align: center; font-weight: bold;">{{$total->satuan}}</td>
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
