<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Models\SensorData;
use App\Http\Controllers\SensorDataController;

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

Route::get('/rotation', [SensorDataController::class, 'getLatestRotation']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/motor-control', function (Request $request) {
    $direction = $request->query('dir');
    return response()->json(['status' => 'Motor bergerak ke $direction']);
});

Route::post('/send-data', function (Request $request) {
    $data = SensorData::create([
        'roll' => $request->roll,
        'pitch' => $request->pitch,
        'yaw' => $request->yaw,
        'xaccel' => $request->xaccel,
        'yaccel' => $request->yaccel,
        'zaccel' => $request->zaccel,
        'xmagnet' => $request->xmagnet,
        'ymagnet' => $request->ymagnet,
        'zmagnet' => $request->zmagnet,
    ]);

    return response()->json(['message' => 'Data received', 'data' => $data], 201);
});

Route::get('/sumbu-chart-data', function () {
    $data = SensorData::orderBy('created_at', 'desc')->take(20)->get(['created_at', 'roll', 'pitch', 'yaw', 'xmagnet', 'ymagnet', 'zmagnet', 'xaccel', 'yaccel', 'zaccel',])->reverse();

    return response()->json([
        'labels' => $data->pluck('created_at')->map(function ($time) {
            return \Carbon\Carbon::parse($time)->format('H:i:s');
        }),
        'roll' => $data->pluck('roll'),
        'pitch' => $data->pluck('pitch'),
        'yaw' => $data->pluck('yaw'),

        'xmagnet' => $data->pluck('xmagnet'),
        'ymagnet' => $data->pluck('ymagnet'),
        'zmagnet' => $data->pluck('zmagnet'),

        'xaccel' => $data->pluck('xaccel'),
        'yaccel' => $data->pluck('yaccel'),
        'zaccel' => $data->pluck('zaccel'),
    ]); 
});

Route::post('/send-command', function(Request $request){
    $validated = $request->validate([
        'command' => 'required|string|max:20',
    ]);

    Cache::put('latest_command', $validated['command'], 
    now()->addMinutes(5));

    return response()->json([
        'message' => 'Command sent successfully', 
        'command' => $validated['command']
    ]);
});

Route::get('/razor-command', function(){
    $command = Cache::pull('latest_command', '');
    return response($command, 200);
});
