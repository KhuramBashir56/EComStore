<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DepartmentsAndRolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Admin',
                'description' => 'Administrator',
                'status' => 'active'
            ],
            [
                'id' => 2,
                'name' => 'Manager',
                'description' => 'Management Department',
                'status' => 'active'
            ],
            [
                'id' => 3,
                'name' => 'Distributor',
                'description' => 'Distributution Management',
                'status' => 'active'
            ],
            [
                'id' => 4,
                'name' => 'Delivery Boy',
                'description' => 'Delivery Management',
                'status' => 'active'
            ],
            [
                'id' => 5,
                'name' => 'Supplier',
                'description' => 'Supply Management',
                'status' => 'active'
            ],
            [
                'id' => 6,
                'name' => 'Buyer',
                'description' => 'Buyer',
                'status' => 'active'
            ],
            [
                'id' => 7,
                'name' => 'Seller',
                'description' => 'Seller',
                'status' => 'active'
            ],
        ];
        $existing_role = Role::whereIn('name', array_column($roles, 'name'))->pluck('name')->toArray();
        foreach ($roles as $role) {
            if (!in_array($role['name'], $existing_role)) {
                Role::create([
                    'id' => $role['id'],
                    'name' => $role['name'],
                    'slug' => Str::slug($role['name']),
                    'description' => $role['description'],
                    'status' => $role['status'],
                ]);
            }
        }
    }
}
