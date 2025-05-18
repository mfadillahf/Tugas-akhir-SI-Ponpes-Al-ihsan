<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'id_jenis_user' => 1,
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // Guru
        $guru = User::create([
            'id_jenis_user' => 2,
            'username' => 'guru',
            'password' => Hash::make('password'),
        ]);
        $guru->assignRole('guru');

        // Donatur
        $donatur = User::create([
            'id_jenis_user' => 3,
            'username' => 'donatur',
            'password' => Hash::make('password'),
        ]);
        $donatur->assignRole('donatur');

        // Santri
        $santri = User::create([
            'id_jenis_user' => 4,
            'username' => 'santri',
            'password' => Hash::make('password'),
        ]);
        $santri->assignRole('santri');
    }
}
