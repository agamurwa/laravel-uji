<?php

namespace App\Http\Controllers;

use App\Models\DataDokter;
use Illuminate\Http\Request;

class RawatJalanController extends Controller
{
    public function index(Request $request)
    {
        $items = DataDokter::get();

        return view('pages.layanan-rawat-jalan',[
            'items' => $items
        ]); 
    }
}
