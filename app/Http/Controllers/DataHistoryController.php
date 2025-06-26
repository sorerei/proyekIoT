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

        if ($request->filled('xmagnet')) {
            $query->where('xmagnet', $request->xmagnet);
        }

        if ($request->filled('ymagnet')) {
            $query->where('ymagnet', $request->ymagnet);
        }

        if ($request->filled('zmagnet')) {
            $query->where('zmagnet', $request->zmagnet);
        }

        if ($request->filled('xaccel')) {
            $query->where('xaccel', $request->xaccel);
        }

        if ($request->filled('yaccel')) {
            $query->where('yaccel', $request->yaccel);
        }

        if ($request->filled('zaccel')) {
            $query->where('zaccel', $request->zaccel);
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
