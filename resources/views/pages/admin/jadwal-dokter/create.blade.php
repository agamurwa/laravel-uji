@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Jadwal Dokter</h1>
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
            <form action="{{ route('jadwal-dokter.store') }}" method="POST">
                @csrf
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
                    <label for="hari_praktek">Hari Praktek</label>
                    <input type="text" class="form-control" name="hari_praktek" placeholder="" value="{{ old('hari_praktek') }}">
                </div>
                <div class="form group">
                    <label for="jam_praktek">Jam Praktek</label>
                    <input type="text" class="form-control" name="jam_praktek" placeholder="" value="{{ old('jam_praktek') }}">
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

