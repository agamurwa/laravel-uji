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
            <h6 class="m-0 font-weight-bold text-primary">Tagihan Pendaftaran Pasien</h6></a>
        <div class="collapse show" id="tambahrm">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <table width="200%">
                            <tr>
                                {{--  <td width="10" align="center"><img src="{{ url('../frontend/images/klinik.png') }}" width="60%"></td>  --}}
                                <td width="100" align="center">
                                    <h4>Klinik Praktek Mandiri Bidan Lestari</h4>
                                    <h6>Buran Wetan Rt08/Rw02, Kranggan, Buran, Kec. Tasikmadu, Kabupaten Karanganyar,</h6> 
                                    <h6>Jawa Tengah 57722 Telp:0813-3278-7147</h6>
                                </td>
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
                            <strong>{{$items->nama_pasien}}</strong>
                        </div>
                        <div><strong>No. Rekam Medis:</strong> {{$items->id_pasien}}</div>
                        <div><strong>Nama Dokter:</strong> {{$items->doctors->first()->nama_dokter}}</div>
                        {{--  <div><strong>Bidang:</strong> {{$items->doctors->first()->bidang}}</div>  --}}
                        <div><strong>Jam Praktek:</strong> {{$items->doctors_schedules->first()->jam_praktek}}</div>
                        <div><strong>Tanggal Pendaftaran:</strong> {{format_date($items->tgl_pendaftaran)}}</div>
                        <div><strong>No. Hp:</strong> {{$items->patients->first()->no_telp}}</div>
                        <div><strong>Alamat Pasien:</strong> {{$items->patients->first()->alamat}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Jasa Dokter</th>
                                <th scope="col">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profils as $profil)
                                <tr>
                                    <th scope="row">1</th>
                                    <td class="text-center">Jasa Dokter</td>
                                    <td class="text-center">{{ formatrupiah($profil->jasa_dokter) }}</td>
                                    <td class="text-center">{{ formatrupiah($profil->jasa_dokter) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table width="100%">
                        <tr>
                            <td width="80" align="center">
                                
                            </td>
                            <td width="20" align="center">
                                <h6>Karanganyar, {{format_date($items->tgl_pendaftaran)}}</h6>
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

