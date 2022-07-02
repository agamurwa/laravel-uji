<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ScheduleRequest;
use App\Models\Schedule;
use App\Models\DataDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $items = Schedule::where('doctors_id','LIKE','%' .$request->search.'%')->simplePaginate(5);
        }else {
            $items = Schedule::with(['doctor'])->simplePaginate(5);
        }

        return view('pages.admin.jadwal-dokter.index',[
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = DataDokter::all();
        return view('pages.admin.jadwal-dokter.create',[
            'doctors' => $doctors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);
        
        Schedule::create($data);
        return redirect()->route('jadwal-dokter.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Schedule::findOrFail($id);

        return view('pages.admin.jadwal-dokter.detail',[
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
        $item = Schedule::findOrFail($id);
        $doctors = DataDokter::all();

        return view('pages.admin.jadwal-dokter.edit',[
            'item' => $item,
            'doctors' => $doctors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, $id)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);
        
        $item = Schedule::findOrFail($id);

        $item->update($data);

        return redirect()->route('jadwal-dokter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Schedule::findOrFail($id);
        $item->delete();

        return redirect()->route('jadwal-dokter.index');
    }
}
