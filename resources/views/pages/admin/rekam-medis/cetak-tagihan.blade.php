<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
<div id="print" class="card shadow mb-4">
    <a href="#tambahrm" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="tambahrm">
    <h6 class="m-0 font-weight-bold text-primary">Tagihan Kunjungan Pasien</h6></a>
        <div class="collapse show" id="tambahrm">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <table width="200%">
                            <tr>
                                {{--  <td width="10" align="center"><img src="{{ url('../frontend/images/klinik.png') }}" width="60%"></td>  --}}
                                <td width="100" align="center"><h4>Klinik Praktek Mandiri Bidan Lestari</h4>
                                <h6>Buran Wetan Rt08/Rw02, Kranggan, Buran, Kec. Tasikmadu, Kabupaten Karanganyar,</h6>
                                <h6>Jawa Tengah 57722 Telp:0813-3278-7147</h6></td>
                                </tr>
                        </table>
                        <hr class="style2">
                        <table width="190%">
                            <tr>
                                <td width="100" align="center">
                                    <h6>Kwitansi</h6>
                                </td>
                            </tr>
                        </table>
                            <h6 class="mb-3">Kepada:</h6>
                        <div>
                            <strong>{{$item->patients->first()->nama_pasien}}</strong>
                        </div>
                        <div><strong>No. Rekam Medis:</strong> {{$item->id_pasien}}</div>
                        <div><strong>Nama Dokter:</strong> {{$item->nama_dokter}}</div>
                        <div><strong>Tanggal Periksa:</strong> {{format_date($item->tgl_periksa)}}</div>
                        <div><strong>No. Hp:</strong> {{$item->patients->first()->no_telp}}</div>
                        <div><strong>Alamat :</strong> {{$item->patients->first()->alamat}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th class="right">Harga Satuan</th>
                                <th class="center">Kuantitas</th>
                                <th class="right">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($n=0;$n<sizeof($items);$n++)
                            <tr>
                                <td class="text-center">{{$n + 1}}</td>
                                <td class="text-center">{{$item=array_keys($items)[$n]}}</td>
                                @for ($i=0;$i<3;$i++)
                                    @if ($i != 1)
                                        <td class="text-center">{{formatrupiah($items[$item][$i])}}</td>
                                    @else
                                        <td class="text-center">{{$items[$item][$i]}}</td>
                                    @endif
                                @endfor
                            </tr>
                            @endfor
                            <tr>
                                <th class="text-center"></th>
                                <th>Jumlah Harga</th>
                                <th class="right"></th>
                                <th class="text-center"></th>
                                <th class="right">{{formatrupiah(jumlah_harga($items))}}</th>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%">
                        <tr>
                            <td width="80" align="center">
                                
                            </td>
                            <td width="20" align="center">
                                <h6>Karanganyar, <?php echo date('d M Y'); ?></h6>
                                <h6>Kasir</h6>
                                <br>
                                <br>
                                <h6>{{ Auth::user()->name }}</h6>
                            </td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>
</div>
</body>
<style>
     hr.style2 {
        border-top: 3px double;
        margin-right: -320px;
    }
</style>
</html>