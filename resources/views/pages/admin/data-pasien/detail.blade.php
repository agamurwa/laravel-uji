@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Data {{ $item->nama_pasien }}</h1>
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
                        <th>Tempat Lahir</th>
                        <td>{{ $item->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ date('d F Y', strtotime($item->tgl_lahir)) }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $item->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Umur</th>
                        <td>{{ hitung_usia($item->tgl_lahir) }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $item->jns_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td>{{ $item->no_telp }}</td>
                    </tr>
                </table>
        </div>
    </div>
</div>
@endsection

