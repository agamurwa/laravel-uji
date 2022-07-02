@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Obat</h1>
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
            <form action="{{ route('obat.store') }}" method="POST">
                @csrf
                <div class="form group">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" class="form-control" name="nama_obat" placeholder="" value="{{ old('nama_obat') }}">
                </div>
                <div class="form group">
                    <label for="nama_obat">Bentuk Sediaan</label>
                    <select class="form-control" name="sediaan" placeholder="Bentuk Sediaan">
                        <option value="" selected disabled>Pilih..</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Kapsul">Kapsul</option>
                        <option value="Syrup">Syrup</option>
                        <option value="Ampul">Ampul</option>
                        <option value="Flask">Flask</option>
                    </select>
                </div>
                <div class="form group">
                    <label for="dosis">Dosis</label>
                    <input type="number" class="form-control" name="dosis" placeholder="" value="{{ old('dosis') }}">
                </div>
                <div class="form group">
                    <label for="dosis">Satuan</label>
                    <select class="form-control " name="satuan" placeholder="satuan">
                        <option value="" selected disabled>Pilih..</option>
                        <option value="g">g</option>
                        <option value="mg">mg</option>
                        <option value="mcg">mcg</option>
                        <option value="IU">IU</option>
                        <option value="mg/5ml">mg/5ml</option>
                    </select>                                
                </div>
                <div class="form group">
                    <label for="stok">Stok</label>
                    <input type="number" class="form-control" name="stok" placeholder="" value="{{ old('stok') }}">
                </div>
                <div class="form group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" placeholder="" value="{{ old('harga') }}">
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

