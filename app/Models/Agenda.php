<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;
    protected $table = 'agendas';
    protected $primaryKey = 'id_agenda';
    protected $fillable = ['id_jenis_agenda', 'judul', 'tanggal_mulai','tanggal_akhir', 'deskripsi'];

    public function jenisAgenda() { return $this->belongsTo(JenisAgenda::class, 'id_jenis_agenda'); }
}
