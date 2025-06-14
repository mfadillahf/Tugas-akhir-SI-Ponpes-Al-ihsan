<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hapalan extends Model
{
    use HasFactory;
    protected $table = 'hapalans';
    protected $primaryKey = 'id_hapalan';
    protected $fillable = ['id_santri', 'id_guru', 'keterangan'];

    public function santri() { return $this->belongsTo(Santri::class, 'id_santri'); }
    public function guru() { return $this->belongsTo(Guru::class, 'id_guru'); }

    public function detail()
{
    return $this->hasMany(HapalanDetail::class, 'id_hapalan');
}

}
