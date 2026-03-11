<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organisation;
use App\Models\Division;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $org = Organisation::first();
        $div = Division::where('organisation_id', $org->id)->first();

        // Super Admin (Developer/System)
        User::create([
            'name' => 'Admin Orens',
            'full_name' => 'Administrator OrensPro',
            'email' => 'admin@smkprestasiprima.sch.id',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        // School Admin (Pembina)
        User::create([
            'name' => 'Pembina Pramuka',
            'full_name' => 'Drs. Haji Slamet',
            'email' => 'pembina@smkprestasiprima.sch.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'organisation_id' => $org->id,
            'division_id' => $div->id, // Pramuka
            'is_active' => true,
        ]);

        // Leader (Ketua Ekskul)
        User::create([
            'name' => 'Ketua Basket',
            'full_name' => 'Andika Pratama',
            'email' => 'ketua@smkprestasiprima.sch.id',
            'password' => Hash::make('password'),
            'role' => 'leader',
            'organisation_id' => $org->id,
            'division_id' => Division::where('name', 'Basket')->first()->id ?? $div->id,
            'is_active' => true,
        ]);

        // Student (Anggota)
        User::create([
            'name' => 'Siswa Aktif',
            'full_name' => 'Budi Setiawan',
            'email' => 'siswa@smkprestasiprima.sch.id',
            'password' => Hash::make('password'),
            'role' => 'member',
            'organisation_id' => $org->id,
            'division_id' => $div->id,
            'is_active' => true,
        ]);
    }
}
