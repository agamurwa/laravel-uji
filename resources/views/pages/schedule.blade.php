@extends('layouts.schedule')


@section('title')
    Schedule
@stop


@section('content')
    <main>
        <section class="section section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    Home
                                </li>
                                <li class="breadcrumb-item">
                                    Profil
                                </li>
                                <li class="breadcrumb-item active">
                                    Schedule
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 pl-lg-0">
                        <div class="card card-details">
                            <h1>
                                Jadwal Dokter
                            </h1>
                            <p>
                                {{ $item->nama_dokter }}
                            </p>
                            <div class="attendee">
                                <table class="table table-responsive-sm text-center">
                                    <thead>
                                        <tr>
                                            <td>Picture</td>
                                            <td>Name</td>
                                            <td>Bidang</td>
                                            <td>Hari</td>
                                            <td>Waktu</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ Storage::url($item->galleries->first()->image) }}" class="avatar" height="60" alt="Avatar">
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop

@push('prepend-style')
    <link rel="stylesheet" href="frontend/libraries/gijgo/css/gijgo.min.css">
@endpush

@push('addon-script')
    <script src="frontend/libraries/gijgo/js/gijgo.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.datepicker').datepicker({
                uiLibrary: 'bootstrap4',
                icons: {
                    rightIcon:'<img src="frontend/images/ic_doe.png"/>'
                }
            });
        });
    </script>
@endpush
