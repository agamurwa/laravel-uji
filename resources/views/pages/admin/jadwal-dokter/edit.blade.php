@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Jadwal Praktek </h1>
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
            <form action="{{ route('jadwal-dokter.update', $item->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title">Dokter</label>
                    <select name="doctors_id" required class="form-control">
                        <option value="{{ $item->doctors_id }}">Jangan Diubah</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">
                                {{ $doctor->nama_dokter }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form group">
                    <label for="hari_praktek">Hari Praktek</label>
                    <input type="text" class="form-control" name="hari_praktek" placeholder="Hari Praktek" value="{{ $item->hari_praktek }}">
                </div>
                <div class="form group">
                    <label for="jam_praktek">Jam Praktek</label>
                    <input type="text" class="form-control" name="jam_praktek" placeholder="jam Praktek" value="{{ $item->jam_praktek }}">
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

