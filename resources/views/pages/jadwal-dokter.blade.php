@extends('layouts.app')


@section('title')
    Jadwal Dokter
@stop


@section('content')
    <main>
        <section class="section section-details-header"></section>
        <section class="section-details-content">
            <div class="container">

            {{--  <!-- Page Heading -->  --}}
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Cari Jadwal Dokter</h1>
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
                    {{--  <form action="jadwal" method="GET">
                        @csrf
                        <div class="form-group">
                            <label for="title">Pilih Dokter</label>
                            <select name="doctors_id" required class="form-control">
                                <option value="">Pilih Dokter</option>
                                @foreach($item as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_dokter }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">
                            Lihat Jadwal
                        </button>
                    </form>  --}}
                    <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                  <form action="jadwal" method="GET" class="form-inline">
                    <div class="form-group mb-2">
                      {{--  <input type="text" class="form-control" id="doctors_id" name="doctors_id" Placeholder="Id Dokter">  --}}
                      <select name="doctors_id" required class="form-control" style="width: 250px;">
                            <option value="">Pilih Dokter</option>
                            @foreach($dokter as $dokter)
                                <option value="{{ $dokter->id }}">
                                    {{ $dokter->nama_dokter }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 mx-sm-3">Lihat Jadwal</button>
                  </form> 
                </div>
              </div>
                </div>
                <div class="attendee">
                    <table class="table table-responsive-sm text-center">
                        <thead>
                            <tr>
                                <td>Id Dokter</td>
                                <td>Nama Dokter</td>
                                <td>Bidang</td>
                                <td>Hari</td>
                                <td>Waktu</td>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td class="align-middle">
                                    {{ $item->id }}
                                </td>
                                <td class="align-middle">
                                    {{ $item->nama_dokter }}
                                </td>
                                <td class="align-middle">
                                    {{ $item->bidang }}
                                </td>
                                <td class="align-middle">
                                    {{ $item->doctors_schedules->first()->hari_praktek }}
                                </td>
                                <td class="align-middle">
                                    {{ $item->doctors_schedules->first()->jam_praktek }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Data Kosong
                                </td> 
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </section>
    </main>
@stop