<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataPasienRequest;
use App\Models\DataPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataPasienController extends Controller
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
            $items = DataPasien::where('nrm','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
            $items = DataPasien::simplePaginate($pagination);
        }

        return view('pages.admin.data-pasien.index',[
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
        $q = DB::table('patients')->select(DB::raw('MAX(RIGHT(id_pasien,6)) as kode'));
        $kd = "";
        if ($q->count()>0){
            foreach($q->get() as $k){
                $tmp = ((int)$k->kode)+1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        // dd($kd);

        return view('pages.admin.data-pasien.create',[
            'kd' => $kd
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataPasienRequest $request)
    {
        $data = $request->all();
        DataPasien::create($data);
        
        return redirect()->route('data-pasien.index');
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

        return view('pages.admin.data-pasien.detail',[
            'item' => $item
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

        return view('pages.admin.data-pasien.edit',[
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
    public function update(DataPasienRequest $request, $id)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);
        
        $item = DataPasien::findOrFail($id);

        $item->update($data);

        return redirect()->route('data-pasien.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = DataPasien::findOrFail($id);
        $item->delete();

        return redirect()->route('data-pasien.index');
    }
}
