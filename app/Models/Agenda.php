<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;
    protected $table = 'agenda';
    protected $primaryKey = 'id_agenda';
    protected $fillable = ['id_jenis_agenda', 'judul', 'tanggal', 'deskripsi'];

    public function jenisAgenda() { return $this->belongsTo(jenisAgenda::class, 'id_jenis_agenda'); }
}
