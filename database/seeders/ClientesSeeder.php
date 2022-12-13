<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('clientes')->insert([
            'name' => "P&G",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('clientes')->insert([
            'name' => "DHL",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('clientes')->insert([
            'name' => "UNILEVER",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
