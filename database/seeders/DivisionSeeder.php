<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Organisation;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orgs = Organisation::all();


        Division::insert([
            [
                'organisation_id' => 1,
                'name' => 'Website',
                'description' => 'Pengembangan website',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'organisation_id' => 1,
                'name' => 'Cyber Security',
                'description' => 'Pengembangan website',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'organisation_id' => 1,
                'name' => 'Game Development',
                'description' => 'Pengembangan game',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'organisation_id' => 1,
                'name' => 'E-sport',
                'description' => 'Pengembangan website',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}
