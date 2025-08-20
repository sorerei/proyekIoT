<?php

use App\Http\Controllers\EulerGraphController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileUpdateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataHistoryController;
use App\Http\Controllers\KontrolController;
use Illuminate\Support\Facades\Http;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/pages/home', function(){
    return view('pages.home');
})->name('pages.home');

Route::get('/pages/about', function(){
    return view('pages.about');
})->name('pages.about');

Route::get('/pages/register', function(){
    return view('pages.register');
})->name('pages.register');

Route::get('/pages/feature', function(){
    return view('pages.feature');
})->name('pages.feature');

Route::get('/pages/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('pages.dashboard');

Route::get('/pages/eulergraph', [EulerGraphController::class, 'index'])->middleware(['auth', 'verified'])->name('pages.eulergraph');


Route::get('/pages/model', function () {
    return view('pages.model');
})->middleware(['auth', 'verified'])->name('pages.model');


Route::middleware(['auth'])->group(function () {
    Route::get('/pages/editprofile', [ProfileUpdateController::class, 'editProfile'])->name('pages.editprofile');
    Route::post('/pages/updateprofile', [ProfileUpdateController::class, 'updateProfile'])->name('pages.updateprofile');
});

Route::get('/api/dashboard-data', function() {
    $data = \App\Models\SensorData::latest()->first();
    return response()->json($data);
});

Route::get('/pages/teskontrol', [KontrolController::class, 'index']);

Route::post('/api/control',[KontrolController::class, 'update']);

Route::get('/pages/datahistory', [DataHistoryController::class, 'datahistory'])
    ->middleware(['auth', 'verified'])
    ->name('pages.datahistory');

    
Route::get('/pages/camera', function(){
    return view('/pages/camera');
})->middleware(['auth', 'verified'])->name('pages.camera');

Route::get('/camera-snapshot', function () {
    try {
        $response = Http::timeout(2)->get('http://10.17.83.146:8080/?action=snapshot'); //Alamat IP Raspberry Pi disesuaikan.

        return response($response->body(), 200)
            ->header('Content-Type', 'image/jpeg')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    } catch (\Exception $e) {
        abort(504, 'Snapshot timeout');
    }
});

require __DIR__.'/auth.php';
