<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusManiobrasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('status_maniobras')->insert([
            'id' => 1,
            'name' => "COMPLETA",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('status_maniobras')->insert([
            'id' => 2,
            'name' => "PENDIENTE",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('status_maniobras')->insert([
            'id' => 3,
            'name' => "INCOMPLETA",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
