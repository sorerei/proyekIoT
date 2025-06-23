<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;
    // Nama tabel jika tidak sesuai konvensi Laravel
    protected $table = 'sensor_data'; // opsional, jika tabelmu bernama lain

    // Kolom-kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'status_sistem',
        'posisi_sumbu',
        'kecepatan',
        'beban',
        'kemiringan',
        'roll',
        'pitch',    
        'yaw',
        'medan_magnet'
    ];
}
