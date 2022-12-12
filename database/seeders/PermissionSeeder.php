<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions')->insert([
            'name' => "users.manager",
            'descripcion' => "ADMINISTRAR USUARIOS",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('permissions')->insert([
            'name' => "roles.manager",
            'descripcion' => "ADMINISTRAR ROLES",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('permissions')->insert([
            'name' => "maniobristas.create",
            'descripcion' => "IMPORTAR MANIOBRISTAS",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('permissions')->insert([
            'name' => "maniobristas.update",
            'descripcion' => "ACTUALIZAR DATOS DEL MANIOBRISTA",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('permissions')->insert([
            'name' => "maniobristas.delete",
            'descripcion' => "ELIMINAR UN MANIOBRISTA",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
