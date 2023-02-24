@extends('layout')
@section('content')
    <div class="container">
        <div class="card p-3">
            <h3 class="text-center">Input Material</h3>
            <hr class="mt-3 mb-3">
            <form action="{{ route('inputmaterial') }}" method="post">
                @csrf
                <div class="d-flex">
                    <div style="width:50%;" class="mr-3">
                        <div class="d-flex ml-3">
                            <label style="width:33%;">Tgl. Transaksi</label>
                            <p class="mr-3">:</p>
                            <div class="form-group w-100">
                                <input type="date" class="form-control w-100" required name="tanggal_transaksi"
                                    value="{{ Session()->get('date') }}">
                            </div>
                        </div>
                        <div class="d-flex ml-3">
                            <label style="width:33%;">No. Bukti</label>
                            <p class="mr-3">:</p>
                            <div class="form-group w-100">
                                <input type="text" class="form-control w-100" required name="no_bukti" readonly
                                    value="TRX-{{ date('dmYHis') }}">
                            </div>
                        </div>
                        <div class="d-flex ml-3">
                            <label style="width:33%;">Nama Pekerjaan</label>
                            <p class="mr-3">:</p>
                            <div class="form-group w-100">
                                <input type="text" class="form-control w-100" required name="nama_pekerjaan">
                            </div>
                        </div>
                        <div class="d-flex ml-3">
                            <label style="width:33%;">Nama Supplier</label>
                            <p class="mr-3">:</p>
                            <div class="form-group w-100">
                                <input type="text" class="form-control w-100" required name="nama_supplier">
                            </div>
                        </div>
                    </div>
                    <div style="width: 50%;" class="mr-3 ml-3">
                        <div class="d-flex ml-3">
                            <label style="width:33%;">Nama Bahan</label>
                            <p class="mr-3">:</p>
                            <div class="form-group w-100">
                                <select class="form-control select2 w-100" id="mySelect" name="kode">
                                    @foreach ($bahan as $item)
                                        <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="d-flex ml-3">
                            <label style="width:33%;">Harga Satuan</label>
                            <p class="mr-3">:</p>
                            <div class="form-group w-100">
                                <input type="text" class="form-control w-100" id="harga_satuan" required
                                    name="harga_satuan">
                            </div>
                        </div>
                        <div class="d-flex ml-3">
                            <label style="width:33%;">Jumlah Masuk</label>
                            <p class="mr-3">:</p>
                            <div class="form-group w-100">
                                <input type="text" class="form-control w-100" required name="jumlah_masuk">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group w-100 p-3">
                    <label style="width:13%;">Keterangan :</label>
                    <input type="text" class="form-control w-100" required name="keterangan">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100">submit</button>
                </div>
                <div class="form-group">
                    <a href="{{ route('viewinputmaterial') }}" class="btn btn-primary w-100">kembali</a>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on('change', '#mySelect', function() {
            var data;
            var bahan = <?php echo json_encode($bahan); ?>;
            var value = $(this).val();
            const hrg_st = $("#harga_satuan");
            for (dt in bahan) {
                if (bahan[dt].kode == value) {
                    data = bahan[dt];
                }
            }
            hrg_st.val(data.harga);
        });
    </script>
@endsection
