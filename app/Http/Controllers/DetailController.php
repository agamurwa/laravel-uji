<?php

namespace App\Http\Controllers;

use App\Models\DataDokter;
use App\Models\Schedule;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(Request $request, $nama_dokter)
    {
        $item = DataDokter::with(['galleries'])->where('nama_dokter', $nama_dokter)->firstOrFail();
        $schedules = Schedule::all();

        return view('pages.detail',[
            'item' => $item,
            'schedules' => $schedules,
        ]);
    }
}
