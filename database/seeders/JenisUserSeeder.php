<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('jenis_users')->get()->count() == 0) {
            DB::table('jenis_users')->insert([
            ['id_jenis_user' => 1, 'jenis_user' => 'Admin'],
            ['id_jenis_user' => 2, 'jenis_user' => 'Guru'],
            ['id_jenis_user' => 3, 'jenis_user' => 'Donatur'],
            ['id_jenis_user' => 4, 'jenis_user' => 'Santri'],
            ]);
        }
    }
}
