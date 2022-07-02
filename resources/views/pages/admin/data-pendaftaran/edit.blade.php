@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tagihan Pendaftaran Pasien Sdr.{{ $items->nama_pasien }}</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="print" class="card shadow mb-4">
        <a href="#tambahrm" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="tambahrm">
            <h6 class="m-0 font-weight-bold text-primary">Tagihan Pendaftaran Pasien</h6></a>
        <div class="collapse show" id="tambahrm">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <table width="200%">
                            <tr>
                                <td width="10" align="center"><img src="{{ url('../frontend/images/klinik.png') }}" width="60%"></td>
                                <td width="100" align="center"><h4>Klinik Praktek Mandiri Bidan Lestari</h4>
                                <h6>Buran Wetan Rt08/Rw02, Kranggan, Buran, Kec. Tasikmadu, Kabupaten Karanganyar, Jawa Tengah 57722</h6>
                                <h6>Telp:0813-3278-7147</h6></td>
                            </tr>
                        </table>
                        <hr class="style2">
                        <table width="190%">
                            <tr>
                                <td width="100" align="center">
                                    <h5>Kwitansi</h5>
                                </td>
                            </tr>
                        </table>
                        <h6 class="mb-3">Kepada:</h6>
                        <div>
                            <strong>{{$items->nama_pasien}}</strong>
                        </div>
                        <div><strong>No. Rekam Medis:</strong> {{$items->id_pasien}}</div>
                        <div><strong>Nama Dokter:</strong> {{$items->doctors->first()->nama_dokter}}</div>
                        <div><strong>Bidang:</strong> {{$items->doctors->first()->bidang}}</div>
                        <div><strong>Jam Praktek:</strong> {{$items->doctors_schedules->first()->jam_praktek}}</div>
                        <div><strong>Tanggal Pendaftaran:</strong> {{format_date($items->tgl_pendaftaran)}}</div>
                        <div><strong>Alamat Pasien:</strong> {{$items->patients->first()->alamat}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th class="right">Jasa Dokter</th>
                                <th class="right">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profils as $profil)
                                <tr>
                                    <td>Jasa Dokter</td>
                                    <td>{{ formatrupiah($profil->jasa_dokter) }}</td>
                                    <td>{{ formatrupiah($profil->jasa_dokter) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row align-items-center">
                    <a href="{{ route('cetak-pendaftaran', $items->id) }}" class="btn btn-block btn-success">
                    <span class="icon"><i class="fa  fa-print" ></i></span><span class="text"> Cetak</span></a>
                </div>   
            </div>
        </div>
    </div>
</div>
<style>
     hr.style2 {
        border-top: 3px double;
        margin-right: -560px;
    }
</style>
@endsection

