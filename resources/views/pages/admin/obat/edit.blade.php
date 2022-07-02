@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Obat {{ $item->nama_obat }}</h1>
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
            <form action="{{ route('obat.update', $item->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form group">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" class="form-control" name="nama_obat" placeholder="Nama Obat" value="{{ $item->nama_obat }}">
                </div>
                <div class="form group">
                    <label for="nama_obat">Sediaan Obat</label>
                    <select class="form-control " name="sediaan" placeholder="Bentuk Sediaan">
                        <option value="" disabled></option>
                        <option value="Tablet" {{ $item->sediaan == 'Tablet' ? 'selected' : ''  }}>Tablet</option>
                        <option value="Kapsul" {{ $item->sediaan == 'Kapsul' ? 'selected' : ''  }}>Kapsul</option>
                        <option value="Syrup" {{ $item->sediaan == 'Syrup' ? 'selected' : ''  }}>Syrup</option>
                        <option value="Ampul" {{ $item->sediaan == 'Ampul' ? 'selected' : ''  }}>Ampul</option>
                        <option value="Flask" {{ $item->sediaan == 'Flask' ? 'selected' : ''  }}>Flask</option>
                    </select>
                </div>
                <div class="form group">
                    <label for="dosis">Dosis</label>
                    <input type="number" class="form-control" name="dosis" placeholder="Dosis" value="{{ $item->dosis }}">
                </div>
                <div class="form group">
                    <label for="nama_obat">Satuan</label>
                    <select class="form-control " name="satuan" placeholder="satuan">
                        <option value="" disabled></option>
                        <option value="g" {{ $item->satuan == 'g' ? 'selected' : ''  }}>g</option>
                        <option value="mg" {{ $item->satuan == 'mg' ? 'selected' : ''  }}>mg</option>
                        <option value="mcg" {{ $item->satuan == 'mcg' ? 'selected' : ''  }}>mcg</option>
                        <option value="IU"{{ $item->satuan == 'IU' ? 'selected' : ''  }}>IU</option>
                        <option value="mg/5ml" {{ $item->satuan == 'mg/5ml' ? 'selected' : ''  }}>mg/5ml</option>
                    </select>                                
                </div>
                <div class="form group">
                    <label for="stok">Stok</label>
                    <input type="number" class="form-control" name="stok" placeholder="Stok" value="{{ $item->stok }}">
                </div>
                <div class="form group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" placeholder="Harga" value="{{ $item->harga }}">
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

