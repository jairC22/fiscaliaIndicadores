<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'uuid' => Str::uuid(),
            'nombre' => 'Admin',
            'apellido' => 'User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'dni' => '12345678',
            'tipo_fiscal' => 'Admin',
            'activo' => true,
            'estado' => true,
            'fiscalia_fk' => null,
            'roles_fk' => null,
            'extension' => 'sin registrar',
        ]);
    }
}
