<?php

namespace Database\Seeders;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $solution = Organisation::where('name','Orens Solution')->first();
        $network = Organisation::where('name','Network')->first();
        $digital = Organisation::where('name','Digital')->first();

        User::insert([

            [
                'organisation_id' => null,
                'name' => 'superadmin',
                'full_name' => 'Super Admin',
                'email' => 'superadmin@smkprestasiprima.sch.id',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'organisation_id' => $solution->id,
                'name' => 'admin.solution',
                'full_name' => 'Admin Solution',
                'email' => 'admin.solution@smkprestasiprima.sch.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'organisation_id' => $network->id,
                'name' => 'admin.network',
                'full_name' => 'Admin Network',
                'email' => 'admin.network@smkprestasiprima.sch.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'organisation_id' => $digital->id,
                'name' => 'admin.digital',
                'full_name' => 'Admin Digital',
                'email' => 'admin.digital@smkprestasiprima.sch.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }
}
