<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataDokterRequest;
use App\Models\DataDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DataDokterController extends Controller
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
            $items = DataDokter::where('id','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
            $items = DataDokter::simplePaginate($pagination);
        }

        return view('pages.admin.data-dokter.index',[
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
        return view('pages.admin.data-dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataDokterRequest $request)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);
        
        DataDokter::create($data);
        return redirect()->route('data-dokter.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = DataDokter::findOrFail($id);

        return view('pages.admin.data-dokter.detail',[
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
        $item = DataDokter::findOrFail($id);

        return view('pages.admin.data-dokter.edit',[
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
    public function update(DataDokterRequest $request, $id)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);
        
        $item = DataDokter::findOrFail($id);

        $item->update($data);

        return redirect()->route('data-dokter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = DataDokter::findOrFail($id);
        $item->delete();

        return redirect()->route('data-dokter.index');
    }
}
