<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spp extends Model
{
    //
    use HasFactory;
    protected $table = 'spps';
    protected $primaryKey = 'id_spp';
    protected $fillable = ['id_santri', 'bulan', 'tahun', 'status'];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }
}
