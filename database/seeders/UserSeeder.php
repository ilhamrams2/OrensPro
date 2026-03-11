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

        // Additional Members for Orens Solution
        $members = [
            ['name' => 'Ilham Ramadani', 'email' => 'ilham@smkprestasiprima.sch.id', 'div' => 'Website'],
            ['name' => 'Rizky Fauzi', 'email' => 'rizky@smkprestasiprima.sch.id', 'div' => 'Cyber Security'],
            ['name' => 'Siti Aminah', 'email' => 'siti@smkprestasiprima.sch.id', 'div' => 'Game Development'],
            ['name' => 'Fajar Shidiq', 'email' => 'fajar@smkprestasiprima.sch.id', 'div' => 'E-sport'],
            ['name' => 'Putri Lestari', 'email' => 'putri@smkprestasiprima.sch.id', 'div' => 'Website'],
        ];

        foreach ($members as $m) {
            User::create([
                'name' => explode(' ', $m['name'])[0],
                'full_name' => $m['name'],
                'email' => $m['email'],
                'password' => Hash::make('password'),
                'role' => 'member',
                'organisation_id' => $org->id,
                'division_id' => Division::where('name', $m['div'])->first()->id ?? $div->id,
                'is_active' => true,
            ]);
        }
    }
}
