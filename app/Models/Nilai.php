<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';
    protected $fillable = ['id_mapel', 'id_santri', 'nilai', 'tahun_ajaran'];

    public function mapel() { return $this->belongsTo(mapel::class, 'id_mapel'); }
    public function santri() { return $this->belongsTo(santri::class, 'id_santri'); }
}
