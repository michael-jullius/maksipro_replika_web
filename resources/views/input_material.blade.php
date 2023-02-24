@extends('layout')
@section('content')
    <div class="container">
        <div class="card">
            <h3 class="text-center mt-3"><b>Input Material</b></h3>
            <hr class="m-3">
            <div class="w-100 bg-light d-flex">
                <div class="d-flex p-3 w-100" style="width:50%;zoom:90%;">
                    <label class="mr-2" style="margin: auto">from</label>
                    <input type="date" name="from" class="form-control" id="fr" required>
                    <label class="mr-2 ml-2" style="margin: auto;">to</label>
                    <input type="date" name="to" class="form-control" id="to" required>
                </div>
                <div class="d-flex p-3 w-100" style="zoom:90%; width:50%;">
                    <a href="{{ route('viewaddmaterial') }}" class="btn btn-primary w-100 mr-5">+Tambah Material</a>
                    <a href="{{ route('exportexcelmaterial') }}" class="btn btn-success w-100"><i
                            class="bi bi-file-earmark-spreadsheet mr-2"></i>Export Excel</a>
                </div>
            </div>
            <div class="d-flex">
                <div class="bg-light d-flex" style="width: 50%; ">
                    <div class="p-3">
                        <div class="d-flex w-100">
                            <label style="margin: auto;" class="mr-2">bahan</label>
                            <select class="form-control select2 w-100" id="mySelect" name="kode">
                                <option value=""></option>
                                @foreach ($bahan as $item)
                                    <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-light d-flex p-3" style="width: 50%; zoom:90%;">
                    <a href="#" class="btn btn-primary w-100 mr-5" id="terapkan">Terapkan Filter</a>
                    <a href="#" class="btn btn-danger w-100" id="cetak_pdf"><i
                            class="bi bi-file-earmark-pdf mr-2"></i>Cetak Pdf</a>
                </div>
            </div>

            <div class="p-3" style="overflow-x:auto;">
                <table class="table" style="zoom: 70%;">
                    <tr class="text-center">
                        <th>no</th>
                        <th>tanggal transaksi</th>
                        <th>no bukti</th>
                        <th>nama supplier</th>
                        <th>nama pekerjaan</th>
                        <th>keterangan</th>
                        <th>nama material</th>
                        <th>satuan</th>
                        <th>harga satuan</th>
                        <th>jumlah masuk</th>
                        <th>nilai material masuk</th>
                        <th>aksi</th>
                    </tr>
                    @foreach ($data as $key => $item)
                        <form action="{{ route('editmaterial', $item->id) }}" method="post">
                            @csrf
                            <tr>
                                <td>{{ $key++ }}</td>
                                <td>
                                    <div class="form-group">
                                        <input type="date" name="tanggal_transaksi" id="" class="form-control"
                                            value="{{ $item->tanggal_transaksi }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="no_bukti" id="" class="form-control" readonly
                                            value="{{ $item->no_bukti }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="nama_supplier" id="" class="form-control"
                                            value="{{ $item->nama_supplier }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="nama_pekerjaan" id="" class="form-control"
                                            value="{{ $item->nama_pekerjaan }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="keterangan" id="" class="form-control"
                                            value="{{ $item->keterangan }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control w-100" name="kode">
                                            @foreach ($bahan as $bhn)
                                                <option value="{{ $bhn->kode }}"
                                                    {{ $item->kode_material != $bhn->kode ?: 'selected' }}>
                                                    {{ $bhn->nama }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="satuan" id="" class="form-control" readonly
                                            value="{{ $item->satuan }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="harga_satuan" id="" class="form-control"
                                            value="{{ $item->harga_satuan }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="jumlah_masuk" id="" class="form-control"
                                            value="{{ $item->jumlah_masuk }}">
                                    </div>
                                </td>
                                <td>
                                    <p>{{ number_format($item->harga_satuan * $item->jumlah_masuk) }}</p>
                                </td>
                                <td>
                                    <div class="form-group d-flex">
                                        <button type="submit" class="btn btn-warning mr-2">Ubah</button>
                                        <a href="{{ route('deletematerial', $item->id) }}"
                                            class="btn btn-danger ml-2">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                </table>
            </div>
            <div class="pagination text-center justify-content-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#terapkan').click(function() {
                var from = $('#fr').val();
                var to = $('#to').val();
                var bahan = $('#mySelect').val();

                $(this).attr("href",
                    `http://localhost:8000/input_material/filter/${from}/${to}/${bahan}`);
                console.log(from, to, bahan);
                console.log("Button terapkan diklik");
            });
            $('#cetak_pdf').click(function() {
                var from = $('#fr').val();
                var to = $('#to').val();
                var bahan = $('#mySelect').val();

                $(this).attr("href",
                    `http://localhost:8000/CetakMaterial/${from}/${to}/${bahan}`);
                console.log(from, to, bahan);
                console.log("Button cetak diklik");
            });
        });
    </script>
@endsection
