@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Rekam Medis {{ $item->nama_pasien }}</h1>
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
    
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                    <tr>
                        <th width="200px">Nomor Rekam Medis</th>
                        <td>{{ $item->id_pasien }}</td>
                    </tr>
                    <tr>
                        <th>Nama Pasien</th>
                        <td>{{ $item->nama_pasien }}</td>
                    </tr>
                    <tr>
                        <th>Dokter Pemeriksa</th>
                        <td>{{ $item->nama_dokter }}</td>
                    </tr>
                    <tr>
                        <th>Keluhan</th>
                        <td>{{ $item->keluhan }}</td>
                    </tr>
                    <tr>
                        <th>Anamnesis</th>
                        <td>{{ $item->anamnesis }}</td>
                    </tr>
                    <tr>
                        <th>Pemeriksaan Fisik</th>
                        <td>{{ $item->pemeriksaan_fisik }}</td>
                    </tr>
                    <tr>
                        <th>Diagnosa</th>
                        <td>{{ $item->diagnosa }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Periksa</th>
                        <td>{{ date('d F Y', strtotime($item->tgl_periksa)) }}</td>
                    </tr>
                    <tr>
                        <th>Resep Obat</th>
                        <td>
                        @foreach ($datas as $data)
                            @if ($data->id_obat != NULL)                          
                                @for ($i=0;$i<$num['resep'];$i++)
                                    <li class="text-md-left">
                                        {{get_value('obat',array_keys($data->allresep)[$i],'nama_obat')}}
                                        @if ($jumlah_obat=encode($item->jumlah_obat))
                                            {{$jumlah_obat[$i]}}
                                        @endif
                                        {{get_value('obat',array_keys($data->allresep)[$i],'sediaan')}} 
                                        {{get_value('obat',array_keys($data->allresep)[$i],'dosis')}} 
                                        {{get_value('obat',array_keys($data->allresep)[$i],'satuan')}}  
                                        {{$data->allresep[array_keys($data->allresep)[$i]]}}
                                    </li>
                                @endfor
                            @endif
                        @endforeach
                        </td>
                    </tr>
                </table>
        </div>
    </div>
</div>
@endsection

