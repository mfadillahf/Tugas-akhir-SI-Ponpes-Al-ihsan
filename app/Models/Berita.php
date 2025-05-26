<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'beritas';
    protected $primaryKey = 'id_berita';
    protected $fillable = ['id_user', 'id_jenis_berita', 'judul', 'isi', 'tanggal', 'foto'];

    public function jenisBerita() { return $this->belongsTo(JenisBerita::class, 'id_jenis_berita'); }
    public function user() { return $this->belongsTo(User::class, 'id_user'); }
}
