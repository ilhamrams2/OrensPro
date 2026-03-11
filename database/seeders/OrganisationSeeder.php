<?php

namespace Database\Seeders;

use App\Models\Organisation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organisation::insert([
            [
                'name' => 'Orens Solution',
                'description' => 'Organisasi teknologi Orens Solution',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Network',
                'description' => 'Organisasi Network',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Digital',
                'description' => 'Organisasi Digital',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
