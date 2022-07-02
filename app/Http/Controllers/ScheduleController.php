<?php

namespace App\Http\Controllers;

use App\Models\DataDokter;
use App\Models\Schedule;
use App\Models\Gallery;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request, $doctors_id)
    {
        $item = DataDokter::with(['doctors_schedules'])->where('id', $doctors_id)->firstOrFail();
        $gallery = Gallery::all();

        return view('pages.schedule',[
            'item' => $item,
            'gallery' => $gallery
        ]); 
    }

    public function success(Request $request)
    {
        return view('pages.success');
    }
}
