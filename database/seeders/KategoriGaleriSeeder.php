<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriGaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_galeris')->insert([
            ['nama_kategori' => 'Pengasuh'],
            ['nama_kategori' => 'Kegiatan santri'],
            ['nama_kategori' => 'Pesantren'],
            ['nama_kategori' => 'Acara'],
        ]);
    }
}
