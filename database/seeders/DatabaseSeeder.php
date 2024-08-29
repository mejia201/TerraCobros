<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


     // Crear roles si no existen
     $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
     $roleInvitado = Role::firstOrCreate(['name' => 'invitado']);

     // Crear usuarios y asignar roles
     $userAdmin = User::factory()->administrador()->create();
     $userAdmin->assignRole($roleAdmin);

     $userGuest = User::factory()->invitado()->create();
     $userGuest->assignRole($roleInvitado);



    }
}
