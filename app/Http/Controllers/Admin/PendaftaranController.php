<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PendaftaranRequest;
use App\Models\Pendaftaran;
use App\Models\DataPasien;
use App\Models\Gallery;
use App\Models\DataDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
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

        return view('pages.admin.pendaftaran.index',[
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
        return redirect()->route('data-pendaftaran.index');
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
        $doctors = DataDokter::all();
        $items = ambil_satudata('profil_klinik',1);

        return view('pages.admin.pendaftaran.edit',[
            'item' => $item,
            'items' => $items,
            'doctors' => $doctors
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

        return view('pages.admin.pendaftaran.edit',[
            'item' => $item
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

        return redirect()->route('pendaftaran.index');
    }
}
