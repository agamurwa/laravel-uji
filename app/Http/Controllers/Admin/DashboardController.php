<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataDokter;
use App\Models\DataPasien;
use App\Models\Obat;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.admin.dashboard', [
            'doctor' => DataDokter::count(),
            'patient' => DataPasien::count(),
            'obat' => Obat::count(),
            'pendaftaran' => Pendaftaran::count(),
        ]);
    }
}
