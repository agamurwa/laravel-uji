@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Pasien</h1>
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
            <form action="{{ route('data-pasien.store') }}" method="POST">
                @csrf
                <div class="form group">
                    <label for="nama_pasien">Nama Pasien</label>
                    <input type="text" class="form-control" name="nama_pasien" placeholder="" value="{{ old('nama_pasien') }}">
                </div>
                <div class="form group">
                    <label for="id_pasien">No Rekam Medis</label> 
                    <input type="text" class="form-control" name="id_pasien" placeholder="" value="{{ $kd }}" readonly>
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
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" rows="3" class="d-block w-100 form-control">{{ old('alamat') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="jns_kelamin">Jenis Kelamin</label>

                    <div class="col-md-6">
                        <div class="form-check">
                            <input id="jns_kelamin" type="radio" class="form-check-input" value="Laki-laki" name="jns_kelamin" checked><label class="form-check-label" for="jns_kelamin">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input id="jns_kelamin" type="radio" class="form-check-input" value="Perempuan" name="jns_kelamin"><label class="form-check-label" for="jns_kelamin">Perempuan</label>
                        </div> 
                    </div>
                </div>
                <div class="form group">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="number" class="form-control" name="no_telp" placeholder="" value="{{ old('no_telp') }}">
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

