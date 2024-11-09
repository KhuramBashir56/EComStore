<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DepartmentsAndRolesSeeder::class
        ]);

        User::create([
            'ref_id' => User::refId(),
            'role_id' => Role::admin()->id,
            'name' => 'Admin Account',
            'email' => 'admin@admin.com',
            'phone' => '03456789321',
            'password' => Hash::make('123456789'),
            'status' => 'active',
            'created_at' => now()->format('Y-m-d H:i:s.u'),
        ]);

        $this->call([
            UnitsSeeder::class
        ]);
    }
}
