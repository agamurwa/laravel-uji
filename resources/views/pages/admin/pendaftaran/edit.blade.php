@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pendaftaran Pasien Sdr.{{ $item->nama_pasien }}</h1>
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
            <form action="{{ route('pendaftaran.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="Nama_Lengkap">No RM</label>
                        <input type="text" class="form-control " name="id_pasien" value="{{$item->id_pasien}}" readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="nama_pasien">Nama Pasien</label>
                        <input type="text" class="form-control " name="nama_pasien"  value="{{$item->nama_pasien}}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Dokter</label>
                    <select name="doctors_id" required class="form-control">
                        <option value="">Pilih Dokter</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">
                                {{ $doctor->nama_dokter }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form group">
                    <label for="tgl_pendaftaran">Tanggal Pendaftaran</label>
                    <input type="date" class="form-control" name="tgl_pendaftaran" placeholder="" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-block" name="simpan" value="simpan_edit">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

