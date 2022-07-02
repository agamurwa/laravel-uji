@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Data {{ $item->nama_dokter }}</h1>
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
                        <th width="200px">ID</th>
                        <td>{{ $item->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama Dokter</th>
                        <td>{{ $item->nama_dokter }}</td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td>{{ $item->no_telp }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $item->alamat }}</td>
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
                        <th>Spesialis</th>
                        <td>{{ $item->bidang }}</td>
                    </tr>
                    <tr>
                        <th>Tentang Dokter</th>
                        <td>{{ $item->tentang_dokter }}</td>
                    </tr>
                    <tr>
                        <th>Riwayat Pendidikan</th>
                        <td>{{ $item->riwayat_pendidikan }}</td>
                    </tr>
                    <tr>
                        <th>Riwayat Pekerjaan</th>
                        <td>{{ $item->riwayat_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <th>Organisasi</th>
                        <td>{{ $item->organisasi }}</td>
                    </tr>
                </table>
        </div>
    </div>
</div>
@endsection

