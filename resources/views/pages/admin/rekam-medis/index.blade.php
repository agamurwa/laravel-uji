@extends('layouts.admin')

@section('content')
    <!--Modal Konfirmasi Delete-->
    <div id="DeleteModal" class="modal fade text-danger" role="dialog">
   <div class="modal-dialog modal-dialog modal-dialog-centered ">
     <!-- Modal content-->
     <form action="" id="deleteForm" method="post">
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <h4 class="modal-title text-center text-white" >Konfirmasi Penghapusan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{ method_field('DELETE') }}
                 <p class="text-center">Apakah anda yakin untuk menghapus Rekam Medis? Data yang sudah dihapus tidak bisa kembali</p>
             </div>
             <div class="modal-footer">
                 <center>
                     <button type="button" class="btn btn-success" data-dismiss="modal">Tidak, Batal</button>
                     <button type="button" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Ya, Hapus</button>
                 </center>
             </div>
         </div>
     </form>
   </div>
  </div>
<!--End Modal-->
        
    <div class="card shadow mb-4">
    
                <!-- Card Header - Accordion -->
                <a href="#ListRM" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="ListRM">
                  <h6 class="m-0 font-weight-bold text-primary">Jejak Rekam Medis</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="ListRM" style="">
                  <div class="card-body">
                  <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                  <form action="rekam-medis" method="GET" class="form-inline">
                    <div class="form-group mb-2">
                      <input type="text" class="form-control" id="search" name="search" Placeholder="No Rekam Medis">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 mx-sm-3">Cari</button>
                  </form> 
                </div>
              </div>
                   <div class="table-responsive">
                <table class="table table-bordered table-striped" id="pasien" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Rekam Medis</th>
                      <th>Nama Pasien</th>
                      <th>Dokter Pemeriksa</th>
                      <th>Diagnosa</th>
                      <th>Resep Obat</th>
                      <th>Tanggal Periksa</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($items as $item)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $item->id_pasien }}</td>
                      <td>{{ $item->nama_pasien }} </td>
                      <td>{{ $item->nama_dokter }} </td>
                      <td>{{ $item->diagnosa }} </td>
                      <td>
                          @if ($item->id_obat != NULL)
                            @for ($i=0;$i<sizeof($id_obat=encode($item->id_obat));$i++)
                                @if ($aturan_minum=encode($item->aturan_minum))
                                    <li>
                                      {{ get_value('obat',$id_obat[$i],'nama_obat')}} 
                                      @if ($jumlah_obat=encode($item->jumlah_obat))
                                        {{$jumlah_obat[$i]}}
                                      @endif
                                        {{ get_value('obat',$id_obat[$i],'sediaan')}}  
                                        {{ get_value('obat',$id_obat[$i],'dosis')}} 
                                        {{ get_value('obat',$id_obat[$i],'satuan')}} : {{$aturan_minum[$i]}}
                                    </li>
                                @endif
                            @endfor
                          @endif
                      </td>
                      <td>{{ format_date($item->tgl_periksa) }}</td> 
                      <td width="155x">
                        <a href="{{route('cetak-tagihan', $item->id)}}" class="btn btn-secondary btn-sm">
                            <span class="icon">
                                <i style="padding-top:4px"class="fas fa-cart-plus"></i>
                            </span>
                            <span class="text">Cetak Tagihan</span>
                        </a>

                        <a href="{{ route('rekam-medis.show', $item->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-eye"></i>
                            <span class="text">Lihat</span>
                        </a>

                        @if (auth()->user()->roles== 1)
                        <a href="{{ route('rekam-medis.edit', $item->id) }}" class="btn btn-info btn-sm">
                            <i class="fa fa-pencil-alt"></i>
                            <span class="text">Edit</span>
                        </a>
                        <form action="{{ route('rekam-medis.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                                <span class="text">Hapus</span>
                            </button>
                        </form> 
                        @endif
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
    {{--  <script>
    $(document).ready( function () {
  var table = $('#pasien').DataTable( {
    pageLength : 10,
    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
  } )
} );
    </script>
<script type="text/javascript">
   
    var i = 0;
    var a = 0;
       
    function addpenunjang() {
        
        ++i;
        var pen= $("#penunjang option:selected").html();
        var penid= $("#penunjang").val();
        if (penid !== null) {
            //code
            $("#dynamicTable").append('<tr><td><input type="hidden" name="lab['+i+'][id]" value="'+penid+'" class="form-control" readonly></td><td><input type="text" name="lab['+i+'][nama]" value="'+pen+'" class="form-control" readonly></td><td><input type="text" name="lab['+i+'][hasil]" placeholder="Hasil" class="form-control" required></td><td><button type="button" class="btn btn-danger remove-pen">Hapus</button></td></tr>');
        }    
    };
    
     function addresep() {
        
        ++a;
        var res= $("#reseplist option:selected").html();
        var resid= $("#reseplist").val();
        if (resid !== null) {
            //code
            $("#reseps").append('<tr><td><input type="hidden" name="resep['+a+'][id]" value="'+resid+'" class="form-control" readonly></td><td><input type="text" name="resep['+a+'][nama]" value="'+res+'" class="form-control" readonly></td><td><input type="text" name="resep['+a+'][jumlah]" placeholder="Jumlah" class="form-control" required><td><input type="text" name="resep['+a+'][aturan]" placeholder="Aturan pakai" class="form-control" required></td><td><button type="button" class="btn btn-danger remove-res">Hapus</button></td></tr>');
        }    
    };
   
    $(document).on('click', '.remove-pen', function(){  
         $(this).parents('tr').remove();
    });
    
    $(document).on('click', '.remove-res', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>
    <script>
         function deleteData(id)
     {
         var id = id;
         var url = '{{ route("rekam-medis.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
  </script>  --}}
@endsection

