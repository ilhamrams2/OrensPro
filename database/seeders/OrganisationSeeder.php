<?php

namespace Database\Seeders;

use App\Models\Organisation;
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
                'description' => 'Lembaga Pendidikan Kejuruan Unggulan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Orens Network',
                'description' => 'Sekolah Menengah Atas Negeri',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Orens Digital',
                'description' => 'Sekolah Menengah Pertama Swasta',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
