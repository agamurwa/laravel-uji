@extends('layouts.admin')

@section('content')
<div class="row">
        <div class="card-body">
        <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                  <form action="data-pendaftaran" method="GET" class="form-inline">
                    <div class="form-group mb-2">
                      <input type="text" class="form-control" id="search" name="search" Placeholder="No Rekam Medis">
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
                            <th>No Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $item->id_pasien }}</td>
                                <td>{{ $item->nama_pasien }}</td>
                                <td>{{ $item->doctors->first()->nama_dokter }}</td>
                                <td>{{ date('d F Y', strtotime($item->tgl_pendaftaran)) }}</td>
                                <th width="170px">
                                    @if (auth()->user()->profesi== 'Staff')
                                    <a href="{{route('data-pendaftaran.edit', $item->id)}}" class="btn btn-secondary btn-sm">
                                        <span class="icon">
                                            <i style="padding-top:4px"class="fas fa-cart-plus"></i>
                                        </span>
                                        <span class="text">Cetak Tagihan</span>
                                    </a>
                                    @endif
                                    @if (auth()->user()->roles== 1)
                                        <form action="{{ route('data-pendaftaran.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                                <span class="text">Hapus</span></a>
                                            </button>
                                        </form>
                                    @endif
                                </th>
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
@endsection

