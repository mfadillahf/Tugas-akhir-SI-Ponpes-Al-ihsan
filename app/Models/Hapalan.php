<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hapalan extends Model
{
    use HasFactory;
    protected $table = 'hapalans';
    protected $primaryKey = 'id_hapalan';
    protected $fillable = ['id_santri', 'id_guru', 'keterangan', 'juz', 'id_level_hapalan'];

    public function santri() { return $this->belongsTo(Santri::class, 'id_santri'); }
    public function guru() { return $this->belongsTo(Guru::class, 'id_guru'); }

    public function details()
    {
        return $this->hasMany(HapalanDetail::class, 'id_hapalan');
    }
	
	public function levelHapalan()
{
    return $this->belongsTo(LevelHapalan::class, 'id_level_hapalan');
}

}
