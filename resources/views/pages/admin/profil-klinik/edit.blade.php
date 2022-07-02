@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Profil Klinik {{ $items->nama_klinik }}</h1>
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
            <form action="{{ route('profil-klinik.update', $items->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form group">
                    <label for="nama_klinik">Nama Klinik</label>
                    <input type="text" class="form-control" name="nama_klinik" placeholder="Nama Klinik" value="{{ $items->nama_klinik }}">
                </div>
                <div class="form group">
                    <label for="slogan">Slogan</label>
                    <input type="text" class="form-control" name="slogan" placeholder="Slogan" value="{{ $items->slogan }}">
                </div>
                <div class="form-group">
                    <label for="nama_klinik">Jasa Dokter</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp. </div>
                        </div>
                        <input type="text" class="form-control" name="jasa_dokter" value="{{ $items->jasa_dokter }}" placeholder="Jasa Dokter">
                    </div>
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

