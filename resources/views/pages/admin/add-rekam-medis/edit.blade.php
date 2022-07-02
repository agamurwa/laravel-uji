@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Rekam Medis Sdr.{{ $item->nama_pasien }}</h1>
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
            <form action="{{ route('add-rekam-medis.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="Nama_Lengkap">No Rekam Medis</label>
                        <input type="text" class="form-control " name="id_pasien" value="{{$item->id_pasien}}" readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="nama_pasien">Nama Pasien</label>
                        <input type="text" class="form-control " name="nama_pasien"  value="{{$item->nama_pasien}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0" hidden>
                        <label for="doctors_id">Id Dokter</label>
                        <input type="text" class="form-control " name="doctors_id" value="{{ Auth::user()->id }}" readonly>
                    </div>
                </div>
                <div class="form group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" class="form-control " name="nama_dokter" value="dr. {{ Auth::user()->name }}" readonly>
                </div>
                <div class="form group">
                    <label for="keluhan">Keluhan</label>
                    <textarea name="keluhan" rows="3" class="d-block w-100 form-control">{{ old('keluhan') }}</textarea>
                </div>
                <div class="form group">
                    <label for="anamnesis">Anamnesis</label>
                    <textarea name="anamnesis" rows="3" class="d-block w-100 form-control">{{ old('anamnesis') }}</textarea>
                </div>
                <div class="form group">
                    <label for="pemeriksaan_fisik">Pemeriksaan Fisik</label>
                    <textarea name="pemeriksaan_fisik" rows="3" class="d-block w-100 form-control">{{ old('pemeriksaan_fisik') }}</textarea>
                </div>
                <div class="form group">
                    <label for="diagnosa">Diagnosa</label>
                    <input type="text" class="form-control" name="diagnosa" placeholder="" value="{{ old('diagnosa') }}">
                </div>


                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="resep_obat">Resep Obat</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9 mb-0 mb-sm-0">
                        <select class="form-control" name="resep_obat" id="resep_obat">
                            <option value="" selected disabled>Pilih..</option>
                            @foreach ($obats as $obat)
                                <option value="{{$obat->id}}">{{$obat->nama_obat}} {{$obat->sediaan}} {{$obat->dosis}}{{$obat->satuan}}</option>
                            @endforeach
                        </select>
                    </div>                      
                    <div class="col-sm-3 mb-3">
                        <a href="javascript:;" onclick="addresep()" type="button" name="addresep" id="addresep" class="btn btn-primary btn-block">Tambahkan</a>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 mb-0 mb-sm-0">
                        <table width="100%" id="tabel_resep"></table>
                    </div>
                </div>


                <div class="form group">
                    <label for="tgl_periksa">Tanggal Periksa</label>
                    <input type="date" class="form-control" name="tgl_periksa" placeholder="" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-block" name="simpan" value="simpan_edit">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    var i = 0;
    var a = 0;
    
    function addresep() {    
        var res= $("#resep_obat option:selected").html();
        var resid= $("#resep_obat").val();
        if (resid !== null) {
            //code
            $("#tabel_resep").append('<tr><td><input type="hidden" name="resep['+a+'][id_obat]" value="'+resid+'" class="form-control" readonly><td width="70%"><input type="text" name="resep['+a+'][nama_obat]" value="'+res+'" class="form-control" readonly></td><td width ="10%"><input type="text" name="resep['+a+'][jumlah_obat]" placeholder="Jumlah" class="form-control" required><td width="20%"><input type="text" name="resep['+a+'][aturan_minum]" placeholder="Aturan minum" class="form-control" required></td><td><button type="button" class="btn btn-danger remove-res">Hapus</button></td></tr>');
        }
        ++a;
    };
    
    $(document).on('click', '.remove-res', function(){  
         $(this).parents('tr').remove();
    });  
</script>
@endsection

