<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PendaftaranRequest;
use App\Models\Pendaftaran;
use App\Models\DataPasien;
use App\Models\ProfilKlinik;
use App\Models\DataDokter;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataPendaftaranController extends Controller
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
            $items = Pendaftaran::with(['doctors'])->where('id_pasien','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
            $items = Pendaftaran::orderBy('id', 'desc')->simplePaginate($pagination);
        }

        return view('pages.admin.data-pendaftaran.index',[
            'items' => $items,
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function cetak_PDF($id)
    {
        //mengambil data dan tampilan dari halaman edit.blade.php
        $items = Pendaftaran::with(['doctors'])->with(['doctors_schedules'])->findOrFail($id);
        $profils = ambil_satudata('profil_klinik',1);

        $data = PDF::loadview('pages.admin.data-pendaftaran.cetak-pendaftaran',[
            'items' => $items,
            'profils' => $profils
        ]);

        //mendownload laporan.pdf
    	return $data->stream('cetak_pendaftaran.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.pendaftaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PendaftaranRequest $request)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);
        
        Pendaftaran::create($data);
        return redirect()->route('pendaftaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Pendaftaran::with(['doctors'])->with(['doctors_schedules'])->with(['patients'])->findOrFail($id);
        // $items = DataPasien::findOrFail($id);
        $profils = ambil_satudata('profil_klinik',1);

        return view('pages.admin.data-pendaftaran.edit',[
            'items' => $items,
            'profils' => $profils
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PendaftaranRequest $request, $id)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);
        
        $item = Pendaftaran::findOrFail($id);

        $item->update($data);

        return redirect()->route('pendaftaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pendaftaran::findOrFail($id);
        $item->delete();

        return redirect()->route('data-pendaftaran.index');
    }
}
