<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RekamMedisRequest;
use App\Models\RekamMedis;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\MessageBag;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = 5;
        if (auth()->user()->profesi=='Dokter'){

        $items = RekamMedis::with(['user'])->where('doctors_id', Auth::user()->id)->where('id_pasien','LIKE','%' .$request->search.'%')->simplePaginate($pagination);

        }else {
            $items = RekamMedis::where('id_pasien','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }

        return view('pages.admin.rekam-medis.index',[
            'items' => $items
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.rekam-medis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RekamMedisRequest $request)
    {
        $data = $request->all();
        
        RekamMedis::create($data);
        return redirect()->route('rekam-medis.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = RekamMedis::findOrFail($id);
        $datas= ambil_satudata('medical_records',$id);
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        foreach ($datas as $data) {
            //mencari id pasien dari id RM
             $idpasien = $data->id_pasien;
             if ($data->id_obat != NULL) {
                $data->allresep=array_combine(encode($data->id_obat),encode($data->aturan_minum));
                $data->jum=encode($data->jumlah_obat);
                $num['resep']=sizeof($data->allresep);
             }
             else {
                $num['resep']=0;
             }
        }
        $obats = ambil_semuadata('obat');

        return view('pages.admin.rekam-medis.detail',[
            'item' => $item,
            'datas' => $datas,
            'num' => $num
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = RekamMedis::findOrFail($id);
        // $metadatas = ambil_satudata('metadata',13);
        $datas= ambil_satudata('medical_records',$id);
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        foreach ($datas as $data) {
            //mencari id pasien dari id RM
             if ($data->id_pasien != NULL) {$id_pasien = $data->id_pasien;  $idens=DB::table('patients')->where('id_pasien',$id_pasien)->get();}
             
             if ($data->id_obat != NULL) {
                $data->allresep=array_combine(encode($data->id_obat),encode($data->aturan_minum));
                $data->jum=encode($data->jumlah_obat);
                $num['resep']=sizeof($data->allresep);
             }
             else {
                $num['resep']=0;
             }
        }
        $obats = ambil_semuadata('obat');

        return view('pages.admin.rekam-medis.edit',[
            'item' => $item,
            'num' => $num,
            'obats' => $obats,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $data = $request->all();
        // $item = RekamMedis::findOrFail($id);
        // $item->update($data);
        $this->validate($request, [
            'id_pasien' =>'required|exists:patients,id_pasien',
            'nama_pasien' =>'required|max:225',
            'doctors_id' =>'required|integer|exists:users,id',
            'nama_dokter' =>'required|max:225',
            'keluhan' =>'required',
            'anamnesis' =>'required',
            'pemeriksaan_fisik' =>'required',
            'diagnosa' =>'required|max:225',
            'tgl_periksa' =>'required|date',
        ]);

       // Decoding array input resep
       if (isset($request->resep))
        {
            if (has_dupes(array_column($request->resep,'id_obat'))){
                $errors = new MessageBag(['resep'=>['resep yang sama tidak boleh dimasukan berulang']]);
                return back()->withErrors($errors);
            }
            $this->validate($request, [
                'resep.*.jumlah_obat' => 'required|numeric|digits_between:1,3',
                'resep.*.aturan_minum' => 'required',
            ]);
            $resep_id = decode('resep','id_obat',$request->resep);
            $resep_jumlah = decode('resep','jumlah_obat',$request->resep);
            $resep_dosis = decode('resep','aturan_minum',$request->resep); 
        }
        else {
            $resep_id = "";
            $resep_jumlah = "";
            $resep_dosis = "";
        }
        
        $newresep = array();

        $oldresep=array_combine(encode(get_value('medical_records',$request->id,'id_obat')),encode(get_value('medical_records',$request->id,'jumlah_obat')));
        foreach ($request->resep as $resep){
            $newresep[$resep['id_obat']] = $resep['jumlah_obat'];
            
        }
        if (empty($oldresep)) {
            $resultanresep = resultan_resep($oldresep,$newresep);
        }
        else {$resultanresep=$newresep;}
        $errors = validasi_stok($resultanresep);
        if ($errors !== NULL) {
          return  back()->withErrors($errors);
        }
  
        // foreach ($resultanresep as $key => $value) {
        //     $perintah=kurangi_stok($key,$value);
        //     if ($perintah === false) { $habis = array_push($habis,$key); }
        // }
   
   
        DB::table('medical_records')->where('id',$id)->update([
            'id_pasien' => $request->id_pasien,
            'nama_pasien' => $request->nama_pasien,
            'doctors_id' => $request->doctors_id,
            'nama_dokter' => $request->nama_dokter,
            'keluhan' => $request->keluhan,
            'anamnesis' => $request->anamnesis,
            'pemeriksaan_fisik' => $request->pemeriksaan_fisik,
            'diagnosa' => $request->diagnosa,
            'id_obat' => $resep_id,
            'jumlah_obat' => $resep_jumlah,
            'aturan_minum' => $resep_dosis,
            'tgl_periksa' => $request->tgl_periksa,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
           
            switch($request->simpan) {
                case 'simpan_edit': 
                    $buka=route('add-rekam-medis.index',$request->id);
                    $pesan='Data Rekam Medis berhasil disimpan!';
                break;    
            }

        return redirect()->route('rekam-medis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RekamMedis::findOrFail($id);
        $item->delete();

        return redirect()->route('rekam-medis.index');
    }

    // public function tagihan($id)
    // {
    //     $datas= ambil_satudata('medical_records',$id);
    //     foreach ($datas as $data) {
    //         //mencari id pasien dari id RM
    //          $id_pasien = $data->id_pasien;
    //          $id_obat=encode($data->id_obat);
    //          $jumlah_obat=encode($data->jumlah_obat);
    //     }             
    //     $idens=DB::table('patients')->where('id',$id_pasien)->get();
        
    //     $items = array();
    //     $jasa=DB::table('profil_klinik')->select('jasa_dokter')->first();
    //     foreach ($jasa as $j) {
    //         $items['Jasa Dokter'] = [$j,1,$j * 1];
    //     }
        
    //     for ($i=0;$i<sizeof($id_obat);$i++) {
    //         $entries = ambil_satudata ('obat',$id_obat[$i]);
    //             foreach ($entries as $entry) {
    //                 $items[$entry->nama_obat] = [$entry->harga, $n=$jumlah_obat[$i], $entry->harga * $n];
    //             }
                
    //     }
        

    //     return view('pages.admin.rekam-medis.tagihan',compact('idens','items'));      
        
    // }

    public function cetak_PDF($id)
    {
        $datas= ambil_satudata('medical_records',$id);
        foreach ($datas as $data) {
            //mencari id pasien dari id RM
             $id_pasien = $data->id_pasien;
             $id_obat=encode($data->id_obat);
             $jumlah_obat=encode($data->jumlah_obat);
        }             
        $idens=DB::table('patients')->where('id',$id)->get();
        
        $items = array();
        $jasa=DB::table('profil_klinik')->select('jasa_dokter')->first();
        foreach ($jasa as $j) {
            $items['Jasa Dokter'] = [$j,1,$j * 1];
        }
        
        
        for ($i=0;$i<sizeof($id_obat);$i++) {
            $entries = ambil_satudata ('obat',$id_obat[$i]);
                foreach ($entries as $entry) {
                    $items[$entry->nama_obat] = [$entry->harga, $n=$jumlah_obat[$i], $entry->harga * $n];
                }
        }

        $item = RekamMedis::with(['doctors'])->with(['doctors_schedules'])->findOrFail($id);

        $data = PDF::loadview('pages.admin.rekam-medis.cetak-tagihan',[
            'items' => $items,
            'idens' => $idens,
            'item' => $item
        ]);

        //mendownload laporan.pdf
    	return $data->stream('cetak_tagihan.pdf');
    }
}
