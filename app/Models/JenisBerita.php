<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisBerita extends Model
{
    use HasFactory;
    protected $table = 'jenis_beritas';
    protected $primaryKey = 'id_jenis_berita';
    protected $fillable = ['kategori'];

    public function berita() { return $this->hasMany(Berita::class, 'id_jenis_berita'); }

}
