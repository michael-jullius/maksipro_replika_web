@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container-fluid mb-4">
	<form class="form" method="post" action="{{ route('viewPreviewRabMenu', $id_proyek)}}">
		@csrf
		<div class="card w-100">
			<div class="border border-dark" style="margin: 30px; padding-top: 20px; padding-bottom: 20px;">

				<div class="d-flex">
					<div class="w-100 container-fluid">

						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="PrintPreview" id="exampleRadios1" value="previewRab" checked>
								<label class="form-check-label" for="exampleRadios1">
									Print Preview RAB :
								</label>
							</div>
						</div>

						<div class="form-group d-flex">
							<label style="padding:5px; width: 60%;">Tampilan:</label>
							<select name="Tampilan" class="form-control w-100">
								<option value="singkat">singkat</option>
								<option value="penuh">penuh</option>
							</select>
						</div>

					</div>

					<div class="w-100 container-fluid">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="PrintPreview" id="exampleRadios2" value="ahs_pekerjaan_yang_dipakai" >
							<label class="form-check-label" for="exampleRadios2">
								Print AHS Pekerjaan Yang Dipakai di RAB :
							</label>
						</div>
					</div>
				</div>

				<div class="d-flex">
					<div class="container-fluid w-100">
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="PrintPreview" id="exampleRadios3" value="Print_Preview_Kebutuhan_Semua_Bahan" >
								<label class="form-check-label" for="exampleRadios3">
									Print Preview Kebutuhan Semua Bahan :
								</label>
							</div>
						</div>

						<div class=" d-flex">
							<label style="padding:5px; width: 60%;">Kelompok Pekerjaan:</label>
							<select class="form-control w-100" name="Print_Preview_Kebutuhan_Semua_Bahan_jenis_pekerjaan">
								<option value="semua" >semua</option>
								@foreach($jenis_pekerjaan as $key=>$value)
								<option value="{{$value->jenis_pekerjaan}}" >{{$value->jenis_pekerjaan}}</option>
								@endforeach
							</select>
						</div>
						<div class=" d-flex">
							<label style="padding:5px; width: 60%;">Nama Pekerjaan:</label>
							<select class="form-control" name="Print_Preview_Kebutuhan_Semua_Bahan_nama_pekerjaan">
								<option value="semua" >semua</option>
								@foreach($nama_pekerjaan as $key=>$value)
								<option value="{{$value->nama_pekerjaan}}" >{{$value->nama_pekerjaan}}</option>
								@endforeach
							</select>
						</div>
						<div class=" d-flex">
							<label style="padding:5px; width: 60%;">Lantai:</label>
							<select class="form-control" name="Print_Preview_Kebutuhan_Semua_Bahan_lantai">
								<option value="semua" >semua</option>
								@foreach($lantai as $key=>$value)
								<option value="{{$value->lantai}}" >{{$value->lantai}}</option>
								@endforeach
							</select>
						</div>
						<div class=" d-flex">
							<label style="padding:5px; width: 60%;">Element Biaya:</label>
							<select class="form-control" name="Print_Preview_Kebutuhan_Semua_Bahan_kelompok">
								<option value="semua" >semua</option>
								@foreach($kelompok as $key=>$value)
								<option value="{{$value->kelompok}}" >{{$value->kelompok}}</option>
								@endforeach
							</select>
						</div>

					</div>

					<div class="container-fluid w-100">
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="PrintPreview" id="exampleRadios4" value="Print_Preview_Kebutuhan_Per_Bahan" >
								<label class="form-check-label" for="exampleRadios4">
									Print Preview Kebutuhan Per Bahan :
								</label>
							</div>
						</div>


						<div class=" d-flex">
							<label style="padding:5px; width: 60%;">Nama Bahan:</label>
							<select class="form-control w-100" name="nama_bahan">
								<option value="semua" >semua</option>
								@foreach($nama_bahan as $key=>$value)
								<option value="{{$value->id_bahan}}">{{$value->nama}}</option>
								@endforeach
							</select>
						</div>
						<div class=" d-flex">
							<label style="padding:5px; width: 60%;">Kelompok Pekerjaan:</label>
							<select class="form-control" name="kelompok_pekerjaan_data">
								<option value="semua" >semua</option>
								@foreach($jenis_pekerjaan as $key=>$value)
								<option value="{{$value->jenis_pekerjaan}}" >{{$value->jenis_pekerjaan}}</option>
								@endforeach
							</select>
						</div>
						<div class=" d-flex">
							<label style="padding:5px; width: 60%;">Nama Pekerjaan:</label>
							<select class="form-control" name="nama_pekerjaan_data">
								<option value="semua" >semua</option>
								@foreach($nama_pekerjaan as $key=>$value)
								<option value="{{$value->nama_pekerjaan}}" >{{$value->nama_pekerjaan}}</option>
								@endforeach
							</select>
						</div>
						<div class=" d-flex">
							<label style="padding:5px; width: 60%;">Lantai:</label>
							<select class="form-control" name="lantai_data">
								<option value="semua" >semua</option>
								@foreach($lantai as $key=>$value)
								<option value="{{$value->lantai}}" >{{$value->lantai}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<hr class="bg-dark">

				<div class="d-flex">
					<div class="container-fluid w-100">
						<div class="d-flex">
							<label style="padding-left: 5px; width: 60%;">Nama Pekerjaan:</label>
							<div class="form-check w-100">
							  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
							  <label class="form-check-label" for="flexCheckDefault">
							    Tampilkan indentitas Proyek
							  </label>
							</div>
						</div>
						<div class=" d-flex">
							<label style="padding:5px; width: 60%;">Nama Kota:</label>
							<input class="form-control w-100" type="" name="nama_kota" value="{{Auth::user()->Proyek->where('id', $id_proyek)->first()->Kota_Kabupaten}}" placeholder="{{Auth::user()->Proyek->where('id', $id_proyek)->first()->Kota_Kabupaten}}" disabled>
						</div>
						<div class=" d-flex">
							<label style="padding:5px; width: 60%;">Tanggal Laporan:</label>
							<input class="form-control" type="datetime-local" name="tanggal_laporan" >
						</div>
					</div>

					<div class="container-fluid w-100 text-center" style="padding: 5px;">
						<button class="btn btn-outline-primary" style="height:105px; width:200px;"><i class="bi bi-printer mr-2"></i>Print Preview</button>
					</div>

				</div>

			</div>
		</div>
	</form>
	<div class="card mt-3">
		<div class="border border-dark" style="margin: 30px; padding-top: 20px; padding-bottom: 20px;">

				<div class="d-flex">
					<form class="container-fluid w-100 mt-2 mb-2" method="post" action="{{route('insert_ppn', $id_proyek)}}">
						@csrf
						<div class="container-fluid w-100 mt-2 mb-2">
							<div class=" d-flex">
								<label style="padding:5px; width: 60%;">Jasa Kontraktor:</label>
								<input type="number" name="jasa_kontraktor" class="form-control" placeholder="{{$nama_proyek->Ppn->first()->kontraktor ?? '0'}}">
								<label class="ml-2 text-center">%</label>
							</div>
							<div class=" d-flex">
								<label style="padding:5px; width: 60%;">PPN :</label>
								<input type="number" name="ppn" class="form-control" placeholder="{{$nama_proyek->Ppn->first()->ppn ?? '0' }}" required>
								<label class="ml-2 text-center">%</label>
							</div>
							<button class="btn btn-primary w-100 mt-2">simpan</button>
						</div>
					</form>
					<div class="container-fluid w-100 text-center" style="padding: 5px;">
						<form method="get" action="{{route('viewPreviewRekap', $id_proyek)}}">
							<button type="submit" class="btn btn-outline-primary mt-4 mb-4" style="height:105px; width:200px;"><i class="bi bi-printer mr-2"></i>Preview Rekap</button>
						</form>
					</div>

				</div>

		</div>
	</div>
</div>
@endsection
