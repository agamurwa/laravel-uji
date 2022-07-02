@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Jadwal Praktek {{ $item->doctor->nama_dokter }}</h1>
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
                        <th width="200px">Id Dokter</th>
                        <td>{{ $item->doctors_id }}</td>
                    </tr>
                    <tr>
                        <th>Nama Dokter</th>
                        <td>{{ $item->doctor->nama_dokter }}</td>
                    </tr>
                    <tr>
                        <th>Hari Praktek</th>
                        <td>{{ $item->hari_praktek }}</td>
                    </tr>
                    <tr>
                        <th>Jam Praktek</th>
                        <td>{{ $item->jam_praktek }}</td>
                    </tr>
                </table>
        </div>
    </div>
</div>
@endsection

