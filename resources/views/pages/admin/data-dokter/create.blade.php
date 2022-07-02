@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Dokter</h1>
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
            <form action="{{ route('data-dokter.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" class="form-control" name="nama_dokter" placeholder="" value="{{ old('nama_dokter') }}">
                </div>
                <div class="form group">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="number" class="form-control" name="no_telp" placeholder="" value="{{ old('no_telp') }}">
                </div>
                <div class="form group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" rows="3" class="d-block w-100 form-control">{{ old('alamat') }}</textarea>
                </div>
                <div class="form group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="" value="{{ old('tempat_lahir') }}">
                </div>
                <div class="form group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tgl_lahir" placeholder="" value="{{ old('tgl_lahir') }}">
                </div>
                <div class="form group">
                    <label for="bidang">Bidang</label>
                    <input type="text" class="form-control" name="bidang" placeholder="" value="{{ old('bidang') }}">
                </div>
                <div class="form group">
                    <label for="tentang_dokter">Tentang Dokter</label>
                    <textarea name="tentang_dokter" rows="3" class="d-block w-100 form-control">{{ old('tentang_dokter') }}</textarea>
                </div>
                <div class="form group">
                    <label for="riwayat_pendidikan">Riwayat Pendidikan</label>
                    <textarea name="riwayat_pendidikan" rows="3" class="d-block w-100 form-control">{{ old('riwayat_pendidikan') }}</textarea>
                </div>
                <div class="form group">
                    <label for="riwayat_pekerjaan">Riwayat Pekerjaan</label>
                    <textarea name="riwayat_pekerjaan" rows="3" class="d-block w-100 form-control">{{ old('riwayat_pekerjaan') }}</textarea>
                </div>
                <div class="form group">
                    <label for="organisasi">Organisasi</label>
                    <textarea name="organisasi" rows="3" class="d-block w-100 form-control">{{ old('organisasi') }}</textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-block">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

