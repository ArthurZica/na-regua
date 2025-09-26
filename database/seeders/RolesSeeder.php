<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['nome' => 'Administrador'],
            ['nome' => 'Gerente'],
            ['nome' => 'Barbeiro']
        ]);
    }
}
