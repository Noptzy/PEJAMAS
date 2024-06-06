<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{ 
    public function run(): void
    {
        $roles = ['admin', 'petugas', 'warga'];
        foreach ($roles as $role) {
            Role::create([
                'role' => $role
            ]);
        }
    }
}
