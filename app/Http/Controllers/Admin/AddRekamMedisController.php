<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddRekamMedisRequest;
use App\Models\AddRekamMedis;
use App\Models\DataPasien;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AddRekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = 5;
        if($request->has('search')){
            $items = DataPasien::where('id_pasien','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
            $items = DataPasien::simplePaginate($pagination);
        }

        return view('pages.admin.add-rekam-medis.index',[
            'items' => $items
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);

        // $patients = DataPasien::all();

        // return view('pages.admin.add-rekam-medis.index',[
        //     'patients' => $patients
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.add-rekam-medis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TAMBAH DATA KE RM
        // $data = $request->all();
        // AddRekamMedis::create($data);

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
        $oldresep=array();
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
  
        foreach ($resultanresep as $key => $value) {
            $perintah=kurangi_stok($key,$value);
            if ($perintah === false) { $habis = array_push($habis,$key); }
        }
   
        DB::table('medical_records')->insert([
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
    
           $ids= DB::table('medical_records')->latest('created_at')->first();         
            switch($request->simpan) {
                case 'simpan_edit': 
                    $buka=route('add-rekam-medis.index',$ids->id);
                    $pesan='Data Rekam Medis berhasil disimpan!';
                break;
            }

        return redirect()->route('add-rekam-medis.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = DataPasien::findOrFail($id);
        $obats = Obat::all();

        return view('pages.admin.add-rekam-medis.edit',[
            'item' => $item,
            'obats' => $obats
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
        $item = DataPasien::findOrFail($id);

        return view('pages.admin.add-rekam-medis.edit',[
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddRekamMedisRequest $request, $id)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);
        
        $item = AddRekamMedis::findOrFail($id);

        $item->update($data);

        return redirect()->route('add-rekam-medis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AddRekamMedis::findOrFail($id);
        $item->delete();

        return redirect()->route('add-rekam-medis.index');
    }

    public function data()
    {
        return DataTables::of(DataPasien::query())->toJson();
    }
}
