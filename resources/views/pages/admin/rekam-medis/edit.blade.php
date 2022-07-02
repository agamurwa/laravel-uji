@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Rekam Medis {{ $item->nama_pasien }}</h1>
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
            <form action="{{ route('rekam-medis.update', $item->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form group">
                    <label for="id_pasien">No Rm</label>
                    <input type="text" class="form-control" name="id_pasien" placeholder="id_pasien" value="{{ ($item->id_pasien) }}" readonly>
                </div>
                <div class="form group">
                    <label for="nama_pasien">Nama Pasien</label>
                    <input type="text" class="form-control" name="nama_pasien" placeholder="nama_pasien" value="{{ $item->nama_pasien }}" readonly>
                </div>
                <div class="form group">
                    <label for="doctors_id" hidden>Id Dokter</label>
                    <input type="text" class="form-control" name="doctors_id" placeholder="doctors_id" value="{{ ($item->doctors_id) }}" hidden>
                </div>
                <div class="form group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" class="form-control" name="nama_dokter" placeholder="nama_dokter" value="{{ $item->nama_dokter }}" readonly>
                </div>
                <div class="form group">
                    <label for="keluhan">Keluhan</label>
                    <textarea name="keluhan" rows="3" class="d-block w-100 form-control">{{ $item->keluhan }}</textarea>
                </div>
                <div class="form group">
                    <label for="anamnesis">Anamnesis</label>
                    <textarea name="anamnesis" rows="3" class="d-block w-100 form-control">{{ $item->anamnesis }}</textarea>
                </div>
                <div class="form group">
                    <label for="pemeriksaan_fisik">Pemeriksaan Fisik</label>
                    <textarea name="pemeriksaan_fisik" rows="3" class="d-block w-100 form-control">{{ $item->pemeriksaan_fisik }}</textarea>
                </div>
                <div class="form group">
                    <label for="diagnosa">Diagnosa</label>
                    <input type="text" class="form-control" name="diagnosa" placeholder="diagnosa" value="{{ $item->diagnosa }}">
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="resep_obat">Resep</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9 mb-0 mb-sm-0">
                    <select num="{{$num['resep']}}" class="form-control " name="resep_obat" id="resep_obat" >
                        <option value="" selected disabled>Pilih satu</option>
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
                    <table width="100%" id="tabel_resep">
                        @if ($data->id_obat != NULL)
                        @for ($i=0;$i<$num['resep'];$i++)
                        <tr>
                            <td><input type="hidden" name="resep[{{$i}}][id_obat]" value="{{array_keys($data->allresep)[$i]}}" class="form-control" readonly></td>
                            <td width="70%"><input type="text" name="resep[{{$i}}][nama_obat]" value="{{get_value('obat',array_keys($data->allresep)[$i],'nama_obat')}} {{get_value('obat',array_keys($data->allresep)[$i],'sediaan')}} {{get_value('obat',array_keys($data->allresep)[$i],'dosis')}} {{get_value('obat',array_keys($data->allresep)[$i],'satuan')}}" class="form-control" readonly></td>
                            <td width="10%"><input type="text" name="resep[{{$i}}][jumlah_obat]" value="{{$data->jum[$i]}}" placeholder="Jumlah Obat" class="form-control" required></td>
                            <td width ="20%"><input type="text" name="resep[{{$i}}][aturan_minum]" value="{{$data->allresep[array_keys($data->allresep)[$i]]}}" placeholder="Aturan Minum" class="form-control" required></td>
                            <td><button type="button" class="btn btn-danger remove-pen">Hapus</button></td>
                        </tr>
                        @endfor
                        @endif
                    </table>
                </div>
                </div>
                <div class="form group">
                    <label for="tgl_periksa">Tanggal Periksa</label>
                    <input type="date" class="form-control" name="tgl_periksa" placeholder="Tanggal Periksa" value="{{ $item->tgl_periksa }}">
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-block" name="simpan" value="simpan_edit">
                    Ubah
                </button>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    var a = $("#resep_obat").attr('num');
    
     function addresep() {
        
        var res= $("#resep_obat option:selected").html();
        var resid= $("#resep_obat").val();
        if (resid !== null) {
            //code
            $("#tabel_resep").append('<tr><td><input type="hidden" name="resep['+a+'][id_obat]" value="'+resid+'" class="form-control" readonly></td><td><input type="text" name="resep['+a+'][nama_obat]" value="'+res+'" class="form-control" readonly></td><td><input type="text" name="resep['+a+'][jumlah_obat]" placeholder="Jumlah" class="form-control" required><td><input type="text" name="resep['+a+'][aturan_minum]" placeholder="Aturan pakai" class="form-control" required></td><td><button type="button" class="btn btn-danger remove-res">Hapus</button></td></tr>');
        }
        ++a;
    };
    
    $(document).on('click', '.remove-pen', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>
    
{{--  <script type="text/javascript">
     function deleteData(id){
         var id = id;
         var url = '{{ route("rm.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit(){
         $("#deleteForm").submit();
     }
</script>  --}}
@endsection

