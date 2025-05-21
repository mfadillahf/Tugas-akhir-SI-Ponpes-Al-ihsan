<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Santri extends Model
{
     use HasFactory;
    protected $table = 'santris';
    protected $primaryKey = 'id_santri';
    protected $fillable = ['id_user', 'id_kelas', 'nama_lengkap', 'nama_panggil', 'tanggal_lahir', 'alamat', 'no_telepon', 'email', 'jenis_kelamin', 'status', 'pendidikan_asal', 'nama_ayah', 'pekerjaan_ayah', 'no_hp_ayah', 'nama_ibu', 'pekerjaan_ibu', 'no_hp_ibu'];

    public function user() { return $this->belongsTo(User::class, 'id_user'); }
    public function kelas() { return $this->belongsTo(kelas::class, 'id_kelas'); }
    public function hapalan() { return $this->hasMany(hapalan::class, 'id_santri'); }
    public function nilai() { return $this->hasMany(nilai::class, 'id_santri'); }
}
