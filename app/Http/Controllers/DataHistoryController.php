<?php

namespace App\Http\Controllers;
use App\Models\SensorData;
use Illuminate\Http\Request;

class DataHistoryController extends Controller
{
    public function datahistory(Request $request){
        $query = SensorData::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('medan_magnet')) {
            $query->where('medan_magnet', $request->medan_magnet);
        }

        if ($request->filled('kecepatan')) {
            $query->where('kecepatan', $request->kecepatan);
        }

        if ($request->filled('roll')) {
            $query->where('roll', $request->roll);
        }

        if ($request->filled('pitch')) {
            $query->where('pitch', $request->pitch);
        }

        if ($request->filled('yaw')) {
            $query->where('yaw', $request->yaw);
        }

        $data = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());

        return view('pages.datahistory', compact('data'));   
    }
}
