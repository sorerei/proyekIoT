<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sensor_data', function (Blueprint $table) {
            $table->float('xaccel')->nullable();
            $table->float('yaccel')->nullable();
            $table->float('zaccel')->nullable();
            $table->float('xmagnet')->nullable();
            $table->float('ymagnet')->nullable();
            $table->float('zmagnet')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sensor_data', function (Blueprint $table) {
            //
        });
    }
};
