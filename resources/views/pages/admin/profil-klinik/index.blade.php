@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profil Klinik</h1>
    </div>

    <div class="row">
        <div class="card-body">
        <div class="row g-3 align-items-center mt-2">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Klinik</th>
                            <th>Slogan</th>
                            <th>Jasa Dokter</th>
                            @if (auth()->user()->profesi=='Staff')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama_klinik }}</td>
                                <td>{{ $item->slogan }}</td>
                                <td>{{ formatrupiah($item->jasa_dokter) }}</td>
                                @if (auth()->user()->profesi=='Staff')
                                    <th width="120px">
                                        {{--  <a href="{{ route('profil-klinik.show', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                            <span class="text">Lihat</span>
                                        </a>  --}}
                                        <a href="{{ route('profil-klinik.edit', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-pencil-alt"></i>
                                            <span class="text">Edit</span>
                                        </a>
                                        <form action="{{ route('profil-klinik.destroy', $item->id) }}" method="POST" class="d-inline">
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

