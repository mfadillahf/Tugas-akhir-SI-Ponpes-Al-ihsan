<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisBeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
        if (DB::table('jenis_beritas')->count() === 0) {
            DB::table('jenis_beritas')->insert([
                ['id_jenis_berita' => 1, 'kategori' => 'acara'],
                ['id_jenis_berita' => 2, 'kategori' => 'pengumuman'],
                ['id_jenis_berita' => 3, 'kategori' => 'prestasi'],
                ['id_jenis_berita' => 4, 'kategori' => 'kegiatan santri'],
                ['id_jenis_berita' => 5, 'kategori' => 'kegiatan guru'],
                ['id_jenis_berita' => 6, 'kategori' => 'informasi umum'],
                ['id_jenis_berita' => 7, 'kategori' => 'dakwah'],
                ['id_jenis_berita' => 8, 'kategori' => 'kunjungan'],
                ['id_jenis_berita' => 9, 'kategori' => 'renovasi / pembangunan'],
                ['id_jenis_berita' => 10, 'kategori' => 'kerja sama / donasi'],
            ]);
        }
    }
}
