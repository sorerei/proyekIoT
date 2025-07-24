<?php

namespace App\Http\Controllers;
use App\Models\SensorData;
use Illuminate\Http\Request;

class EulerGraphController extends Controller
{
    public function index()
    {
        $data = SensorData::latest()->first(); // Ambil data terbaru
        return view('pages.eulergraph', compact('data'));
    }
}
