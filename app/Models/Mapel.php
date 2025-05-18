<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';
    protected $fillable = ['id_guru', 'mapel', 'deskripsi'];

    public function guru() { return $this->belongsTo(guru::class, 'id_guru'); }
    public function nilai() { return $this->hasMany(nilai::class, 'id_mapel'); }
}
