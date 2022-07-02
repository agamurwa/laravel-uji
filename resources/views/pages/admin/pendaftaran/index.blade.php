@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#PilihPasien" class="d-block card-header py-3" role="button" aria-controls="PilihPasien">
              <h6 class="m-0 font-weight-bold text-primary">Pilih pasien</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="table" id="PilihPasien" style="">
              <div class="card-body">
              <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                  <form action="pendaftaran" method="GET" class="form-inline">
                    <div class="form-group mb-2">
                      <input type="text" class="form-control" id="search" name="search" Placeholder="No Rekam Medis">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 mx-sm-3">Cari</button>
                  </form> 
                </div>
              </div>
                <div class="table-responsive">
                  <table class="table table-bordered table-sm table-striped mt-3" id="patients-table" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No Rekam Medis</th>
                        <th>Nama Lengkap</th>
                        <th>No. Hp</th>
                        <th>Tindakan</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $item)
                      <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->id_pasien }}</td>
                        <td>{{ $item->nama_pasien }}</td>
                        <td>{{ $item->no_telp }}</td>
                        <td width="120px">
                            <a href="{{route('pendaftaran.show',$item->id)}}" class="btn btn-primary btn-sm btn-icon-split">
                            <span class="icon text-white-50">
                            <i style="padding-top:4px"class="fas fa-check"></i>
                            </span>
                            <span class="text">Pilih</span>
                            </a>
                        </td>
                      </tr>
                    @endforeach
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

