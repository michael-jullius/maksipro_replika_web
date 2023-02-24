@extends('proyek.layout_proyek')

@section('title', '')

@section('content')
<div class="container-fluid mb-4">
    <div class="d-flex">
        <div style="width: 35%;" >
            <div class="card p-3" >
                <form class="form" method="post" action="{{route('viewAhsPekerjaanFilter', $id_proyek)}}">
                    @csrf
                    <div class="d-flex">
                        <label style="width:30%; margin:auto;" class="border border-dark  mr-1 ">Kelompok Pekerjaan : </label>
                        <select name="nama_pekerjaan" id="" style="width:70%;">
                            @foreach($jenis_pekerjaan as $key=>$value)
                            <option value="{{$value->jenis_pekerjaan}}" {{$value->jenis_pekerjaan != $nama_pekerjaan ?: 'selected'}} >{{$value->jenis_pekerjaan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex mt-1">
                        <label style="width:30%; margin:auto;" class="border border-dark  mr-1 ">Lantai : </label>
                        <select name="lantai" id="" style="width:70%;">
                            @foreach($lantai_data as $key=>$value)
                            <option value="{{$value->keterangan}}" {{ $value->lantai != $lantai ?: 'selected'}}>{{$value->keterangan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="text-center mt-1 w-100">submit</button>
                    <hr>
                </form>
            <form method="post" action="{{route('viewAhsPekerjaanFilterPreview',[$id_proyek, $nama_pekerjaan, $lantai])}}">
                @csrf
                    <table border="1" style="text-align: center;" class="table-responsive-sm">
                        <tr>
                            <th style="width: 30px; height:30px;"></th>
                            <th>Lantai</th>
                            <th>Kode</th>
                            <th>AHS Pekerjaan</th>
                            <th>Satuan</th>
                        </tr>
                        @foreach($data as $key=>$value)
                        <tr>
                            <td><input type="radio" name="radio" value="{{$value->kode}}" {{$value->kode != $radio ?: 'checked'}}></td>
                            <td>{{$value->keterangan}}</td>
                            <td>{{$value->kode}}</td>
                            <td>{{$value->analisa_pekerjaan}}</td>
                            <td>{{$value->satuan}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="card p-3 " style="width: 100%; margin-top: 10px" >
                    <div class="d-flex m-1">
                        <div class="dropdown w-100">
                              <button class="btn btn-primary dropdown-toggle w-100" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cetak
                              </button>
                              <div class="dropdown-menu m-2" style="width: 200px;" aria-labelledby="dropdownMenu2">
                                    <a href="{{route('cetakSemuaAhsPekerjaan', $id_proyek)}}" class="btn btn-primary w-100">Cetak Semua</a>
                                    <a href="{{route('cetakFilterFullAhsPekerjaan', [$id_proyek, $nama_pekerjaan, $lantai, $radio])}}" class="btn btn-primary w- mt-2">Cetak AHS yang di pilih</a>
                              </div>
                        </div>
                        <button class="w-100 ml-3 btn btn-primary" type="submit">preview</button>
                    </div>
                </div>
            </form>
        </div>
        <div style="width: 65%; margin-left: 10px;">
            <div class="card p-3" style="width: 100%; margin-bottom: 10px; text-align: center;">
                <p class="h5">{{$selected->analisa_pekerjaan}}</p>
                <div class="d-flex" style="text-align: center; margin: auto;">
                    <p>{{$selected->kode}}</p>
                    <p class="ml-3">{{$selected->satuan}}</p>
                </div>
            </div>
            <div class="card p-3" style="width: 100%; margin-bottom: 10px;">
                @foreach($total_persentase as $key=>$value)
                @if($value->kelompok == 'a. Bahan')
                <div class="d-flex text-dark" style="width: 100%; margin:auto;">
                    <div class="d-flex" style="margin: auto; width: 50%; padding-right: 1%;">
                        <label  style="margin: auto; width: 50%; padding-right: 1%;" >Bahan: </label>
                        <label  style="margin: auto; width: 50%; padding-right: 1%; text-align: right;"> {{number_format($value->jumlah,2)}}</label>
                    </div>
                    <progress  value="{{ number_format($value->jumlah / ($total->jumlah / 100),2) }}" max="100" class="w-100" style="margin: auto; color: black;">
                    </progress>
                    <label style="margin: auto; padding-left: 1%; width: 20%;">{{ number_format($value->jumlah / ($total->jumlah / 100),2) }}%</label>
                </div>
                @endif

                @if($value->kelompok == 'b. Upah')
                <div class="d-flex" style="width: 100%; margin:auto;">
                    <div class="d-flex text-primary" style="margin: auto; width: 50%; padding-right: 1%;">
                        <label  style="margin: auto; width: 50%; padding-right: 1%;" >Upah: </label>
                        <label  style="margin: auto; width: 50%; padding-right: 1%; text-align: right;" > {{number_format($value->jumlah,2)}}</label>
                    </div>
                    <progress  value="{{ number_format($value->jumlah / ($total->jumlah / 100),2) }}" max="100" class="w-100" style="margin: auto;">
                    </progress>
                    <label style="margin: auto; padding-left: 1%; width: 20%;">{{ number_format($value->jumlah / ($total->jumlah / 100),2) }}%</label>
                </div>
                @endif


                @if($value->kelompok == 'c. Alat Bantu')
                <div class="d-flex" style="width: 100%; margin:auto;">
                    <div class="d-flex" style="margin: auto; width: 50%; padding-right: 1%; color: purple;" >
                        <label  style="margin: auto; width: 50%; padding-right: 1%;">Alat Bantu: </label>
                        <label  style="margin: auto; width: 50%; padding-right: 1%; text-align: right;">{{number_format($value->jumlah,2)}}</label>
                    </div>
                    <progress  value="{{ number_format($value->jumlah / ($total->jumlah / 100),2) }}" max="100" class="w-100" style="margin: auto;">
                    </progress>
                    <label style="margin: auto; padding-left: 1%; width: 20%;">{{ number_format($value->jumlah / ($total->jumlah / 100),2) }}%</label>
                </div>
                @endif

                @if($value->kelompok == 'd. Lain-lain')
                <div class="d-flex" style="width: 100%; margin:auto;">
                    <div class="d-flex" style="margin: auto; width: 50%; padding-right: 1%; color: orange;">
                        <label  style="margin: auto; width: 50%; padding-right: 1%;" >Lain-lain: </label>
                        <label  style="margin: auto; width: 50%; padding-right: 1%; text-align: right;">{{number_format($value->jumlah,2)}}</label>
                    </div>
                    <progress  value="{{ number_format($value->jumlah / ($total->jumlah / 100),2) }}" max="100" class="w-100" style="margin: auto;">
                    </progress>
                    <label style="margin: auto; padding-left: 1%; width: 20%;">{{ number_format($value->jumlah / ($total->jumlah / 100),2) }}%</label>
                </div>
                @endif
                @endforeach
                <div class="d-flex" style="width: 100%; margin:auto;">
                    <div class="d-flex" style="margin: auto; width: 50%; padding-right: 1%;">
                        <label  style="margin: auto; width: 50%; padding-right: 1%;" class="text-danger">Jumlah: </label>
                        <label  style="margin: auto; width: 50%; padding-right: 1%; text-align: right;" class="text-danger"> {{number_format($total->jumlah,2)}}</label>
                    </div>
                    <progress  value="100" max="100" class="w-100" style="margin: auto;">
                    </progress>
                    <label style="margin: auto; padding-left: 1%; width: 20%;">100%</label>
                </div>
            </div>
            <div  class="card p-3" style="margin: auto;">
                <table border="1" style="text-align: center;" class="table-responsive-sm">
                    <tr>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Koefisien</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah Harga</th>
                        <th>Satuan</th>
                    </tr>

                    @foreach($data_preview as $key=>$value)
                    <tr>
                        <td>{{$value->id_bahan}}</td>
                        <td>{{$value->nama}}</td>
                        <td style="text-align: right;">{{$value->koefisien}}</td>
                        <td style="text-align: right;">{{number_format($value->harga,2)}}</td>
                        <td style="text-align: right;">{{number_format($value->harga * $value->koefisien)}}</td>
                        <td style="text-align: center;">{{$value->satuan}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="w-100"></div>
</div>
@endsection
