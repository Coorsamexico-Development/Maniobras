<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TurnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                //
                DB::table('turnos')->insert([
                    'id' => 1,
                    'name' => "MATUTINO",
                    'cant_personal' => 55,
                    'hora_inicio' => now(),
                    'hora_fin' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        
                DB::table('turnos')->insert([
                    'id' => 2,
                    'name' => "VESPERTINO",
                    'cant_personal' => 55,
                    'hora_inicio' => now(),
                    'hora_fin' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    }
}
