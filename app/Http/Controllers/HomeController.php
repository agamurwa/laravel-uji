<?php

namespace App\Http\Controllers;

use App\Models\DataDokter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $items = DataDokter::with(['galleries'])->get();
        return view('pages.home',[
            'items' => $items
        ]);
    }
}
