<?php

namespace App\Http\Controllers;
use App\Models\SensorData; // Pastikan modelnya sesuai


use Illuminate\Http\Request;

class SensorDataController extends Controller
{
    public function getLatestRotation()
    {
        $latest = SensorData::latest()->first();

        if (!$latest) {
            return response()->json(['error' => 'No data found'], 404);
        }

        return response()->json([
            'x' => $latest->roll,   // rotasi X
            'y' => $latest->pitch,  // rotasi Y
            'z' => $latest->yaw     // rotasi Z
        ]);
    }
}
