<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisAgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('jenis_agendas')->get()->count() == 0) {
            DB::table('jenis_agendas')->insert([
            ['id_jenis_agenda' => 1, 'jenis_agenda' => 'Internal'],
            ['id_jenis_agenda' => 2, 'jenis_agenda' => 'Eksternal'],
            ]);
        }
    }
}
