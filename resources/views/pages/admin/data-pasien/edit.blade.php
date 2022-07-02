@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Pasien {{ $item->nama_pasien }}</h1>
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
            <form action="{{ route('data-pasien.update', $item->id_pasien) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form group">
                    <label for="id_pasien">No Rekam Medis</label>
                    <input type="text" class="form-control" name="id_pasien" placeholder="Nama Pasien" value="{{ $item->id_pasien }}" readonly>
                </div>
                <div class="form group">
                    <label for="nama_pasien">Nama Pasien</label>
                    <input type="text" class="form-control" name="nama_pasien" placeholder="Nama Pasien" value="{{ $item->nama_pasien }}">
                </div>
                <div class="form group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ $item->tempat_lahir }}">
                </div>
                <div class="form group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir" value="{{ $item->tgl_lahir }}">
                </div>
                <div class="form group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" rows="3" class="d-block w-100 form-control">{{ $item->alamat }}</textarea>
                </div>
                <div class="form-group">
                    <label   class="col-md-3 col-form-label text-md-end">Jenis Kelamin</label>
                
                    <div class="col-md-6">
                        <div class="form-check">
                            <input id="jns_kelamin" type="radio" class="form-check-input" value="Laki-laki" name="jns_kelamin" {{$item->jns_kelamin == 'Laki-laki' ? 'checked':''}}><label class="form-check-label" for="roles"> Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input id="jns_kelamin" type="radio" class="form-check-input" value="Perempuan" name="jns_kelamin" {{$item->jns_kelamin == 'Perempuan' ? 'checked':''}}><label class="form-check-label" for="roles"> Perempuan</label>
                        </div> 
                    </div>
                </div>
                <div class="form group">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="number" class="form-control" name="no_telp" placeholder="Nomor Telepon" value="{{ $item->no_telp }}">
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-block">
                    Ubah
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

