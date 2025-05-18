<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisAgenda extends Model
{
    use HasFactory;
    protected $table = 'jenis_agenda';
    protected $primaryKey = 'id_jenis_agenda';
    protected $fillable = ['jenis_agenda'];

    public function agenda() { return $this->hasMany(agenda::class, 'id_jenis_agenda'); }
}
