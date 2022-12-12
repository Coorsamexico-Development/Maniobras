<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'role_id' => 1,
            'name' => "admin",
            'ap_paterno' => 'Coorsamexico',
            'ap_materno' => 'Querétaro',
            'email' => "admin@coorsamexico.com",
            'password' => Hash::make("12345678")
        ]);
    }
}
