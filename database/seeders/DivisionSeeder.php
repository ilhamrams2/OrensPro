<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Organisation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orens = Organisation::where('name','Orens Solution')->first();

        Division::insert([
            [
                'organisation_id' => $orens->id,
                'name' => 'Cyber',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'organisation_id' => $orens->id,
                'name' => 'Game',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'organisation_id' => $orens->id,
                'name' => 'Web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'organisation_id' => $orens->id,
                'name' => 'Esport',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
