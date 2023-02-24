<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <style>
        @media print {
            @page {
                margin-top: 72;
                margin-bottom: 72;
            }

            tr,
            td {
                page-break-inside: avoid;
            }
        }
    </style>
    <title>Document</title>
</head>

<body style="background: white; font-family: 'Times New Roman', Times, serif;" onload="window.print()">
    <div class="container-flex">
        <div class="text-center m-4">
            <img src="{{ asset('asset/img/logo.png') }}" style="width: 200px;">
            <h1>Laporan Pembelian Material</h1>
            <h5>Periode {{ $from }} - {{ $to }}</h5>
        </div>
        <div class="p-3">
            <table class="table table-bordered text-center">
                <thead class="bg-dark text-light">
                    <tr>
                        <td rowspan="2">Material</td>
                        <td rowspan="2">Tanggal Transaksi</td>
                        <td colspan="3">Nilai Material</td>
                        <td rowspan="2">Keterangan</td>
                    </tr>
                    <tr>
                        <td>Qty</td>
                        <td>harga satuan</td>
                        <td>total</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pekerjaan as $dt_pkr)
                        <tr>
                            <td colspan="6" class="bg-primary text-white h4"><b>{{ $dt_pkr->nama_pekerjaan }}</b>
                            </td>
                        </tr>
                        @foreach ($data_total as $row)
                            @if ($dt_pkr->nama_pekerjaan == $row->nama_pekerjaan)
                                <tr class="bg-secondary text-white">
                                    <td colspan="2">{{ $row->nama_material }} - {{ $row->nama_supplier }}</td>
                                    <td>{{ $row->jumlah }}</td>
                                    <td></td>
                                    <td>{{ number_format($row->jumlah_total) }}</td>
                                    <td></td>
                                </tr>
                                @foreach ($data as $item)
                                    @if (
                                        $row->nama_material == $item->nama_material and
                                            $row->nama_supplier == $item->nama_supplier and
                                            $item->nama_pekerjaan == $dt_pkr->nama_pekerjaan)
                                        <tr>
                                            <td>-</td>
                                            <td>{{ $item->tanggal_transaksi }}</td>
                                            <td>{{ $item->jumlah_masuk }}</td>
                                            <td>{{ number_format($item->harga_satuan) }}</td>
                                            <td>{{ number_format($item->jumlah_masuk * $item->harga_satuan) }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
