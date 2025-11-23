<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        Role::updateOrCreate(
            ['id' => 1],
            ['nome' => 'Administrador']
        );

        Role::updateOrCreate(
            ['id' => 2],
            ['nome' => 'Gerente']
        );

        Role::updateOrCreate(
            ['id' => 3],
            ['nome' => 'Barbeiro']
        );
    }

}
