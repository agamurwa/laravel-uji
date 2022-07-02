<?php

namespace App\Http\Controllers;

use App\Models\DataDokter;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('doctors_id')){
            $items = DataDokter::where('id','LIKE','%' .$request->doctors_id.'%')->get();
        }else {
            $items = DataDokter::get();
        }
        
        $dokter = DataDokter::get();

        return view('pages.jadwal-dokter',[
            'items' => $items,
            'dokter' => $dokter
        ]); 
    }

    public function success(Request $request)
    {
        return view('pages.success');
    }
}
