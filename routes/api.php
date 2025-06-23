<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\SensorData;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/motor-control', function(Request $request){
    $direction = $request->query('dir');
    return response()->json(['status'=>'Motor bergerak ke $direction']);
});

Route::post('/send-data', function(Request $request) {
    $data = SensorData::create([
        'status_sistem' => $request->status_sistem,
        'posisi_sumbu' => $request->posisi_sumbu,
        'kecepatan' => $request->kecepatan,
        'beban' => $request->beban,
        'kemiringan' => $request->kemiringan,
        'roll' => $request->roll,
        'pitch' => $request->pitch,
        'yaw' => $request->yaw,
        'medan_magnet' => $request->medan_magnet
    ]);

    return response()->json(['message' => 'Data received', 'data' => $data], 201);
});

Route::get('/sumbu-chart-data', function () {
    $data = SensorData::orderBy('created_at', 'desc')->take(20)->get(['created_at', 'roll', 'pitch', 'yaw'])->reverse();

    return response()->json([
        'labels' => $data->pluck('created_at')->map(function ($time) {
            return \Carbon\Carbon::parse($time)->format('H:i:s');
        }),
        'roll' => $data->pluck('roll'),
        'pitch' => $data->pluck('pitch'),
        'yaw' => $data->pluck('yaw'),
    ]);
});
