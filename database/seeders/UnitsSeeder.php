<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;

class UnitsSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            [
                'name' => 'Kilogram',
                'code' => 'KG',
            ],
            [
                'name' => 'Gram',
                'code' => 'G',
            ],
            [
                'name' => 'Liter',
                'code' => 'L',
            ],
            [
                'name' => 'Milliliter',
                'code' => 'ML',
            ],
            [
                'name' => 'Piece',
                'code' => 'PC',
            ],
            [
                'name' => 'Dozen',
                'code' => 'DZ',
            ],
            [
                'name' => 'Box',
                'code' => 'BX',
            ],
            [
                'name' => 'Gallon',
                'code' => 'GL',
            ],
        ];

        $existing_unit = Unit::whereIn('name', array_column($units, 'name'))->pluck('name')->toArray();
        foreach ($units as $unit) {
            if (!in_array($unit['name'], $existing_unit)) {
                Unit::create([
                    'author_id' => User::where('role_id', Role::admin()->id)->first()->id,
                    'name' => $unit['name'],
                    'code' => $unit['code'],
                    'status' => 'published',
                ]);
            }
        }
    }
}
