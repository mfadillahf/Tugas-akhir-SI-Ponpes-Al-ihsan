<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'gurus';
    protected $primaryKey = 'id_guru';
    protected $fillable = ['id_user', 'nama', 'no_telepon', 'email', 'nip', 'tanggal_lahir', 'jenis_kelamin'];

    public function user() { return $this->belongsTo(User::class, 'id_user'); }
    public function hapalan() { return $this->hasMany(Hapalan::class, 'id_guru'); }
    public function mapel() { return $this->hasMany(Mapel::class, 'id_guru'); }
}
