<?php

namespace Database\Seeders;

use App\Models\user\roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        roles::create([
            'roles' => 'administrador',
            'descripcion' => 'Administra todas las funciones del sistema',
        ]);
    }
}
