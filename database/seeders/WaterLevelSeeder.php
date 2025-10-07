<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Water;
use App\Models\Curah;
use App\Models\Debit;

class WaterLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create sample water level data
        Water::create([
            'level' => 150.50, // Water level in cm
        ]);
        
        Water::create([
            'level' => 175.25,
        ]);
        
        Water::create([
            'level' => 200.75,
        ]);
        
        // Create sample rainfall data
        Curah::create([
            'curah' => 25.5, // Rainfall in mm
        ]);
        
        Curah::create([
            'curah' => 30.2,
        ]);
        
        Curah::create([
            'curah' => 18.8,
        ]);
        
        // Create sample water flow data
        Debit::create([
            'debit' => 45.3, // Water flow rate
        ]);
        
        Debit::create([
            'debit' => 52.1,
        ]);
        
        Debit::create([
            'debit' => 38.7,
        ]);
    }
}
