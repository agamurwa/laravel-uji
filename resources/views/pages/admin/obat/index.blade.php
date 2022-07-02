@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Obat</h1>
        <a href="{{ route('obat.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Obat
        </a>
    </div>

    <div class="row">
        <div class="card-body">
        <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                  <form action="obat" method="GET" class="form-inline">
                    <div class="form-group mb-2">
                      <input type="text" class="form-control" id="search" name="search" Placeholder="Nama Obat">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 mx-sm-3">Cari</button>
                  </form> 
                </div>
              </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Sediaan</th>
                            <th>Dosis</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            @if (auth()->user()->profesi=='Staff')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $item->nama_obat }}</td>
                                <td>{{ $item->sediaan }}</td>
                                <td>{{ $item->dosis }} {{$item->satuan}} </td>
                                <td>{{ $item->stok }}</td>
                                <td>{{ formatrupiah($item->harga) }}</td>
                                @if (auth()->user()->profesi=='Staff')
                                    <th width="120px">
                                        {{--  <a href="{{ route('obat.show', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                            <span class="text">Lihat</span>
                                        </a>  --}}
                                        <a href="{{ route('obat.edit', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-pencil-alt"></i>
                                            <span class="text">Edit</span>
                                        </a>
                                        <form action="{{ route('obat.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                                <span class="text">Hapus</span>
                                            </button>
                                        </form>
                                    </th>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    Data Kosong
                                </td> 
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="form-group float-right">
                  {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

