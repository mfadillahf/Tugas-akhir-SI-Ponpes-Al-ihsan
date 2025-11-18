<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spp extends Model
{
    use HasFactory;

    protected $table = 'spps';
    protected $primaryKey = 'id_spp';

    protected $fillable = [
        'id_santri',
        'bulan',
        'tahun',
        'status',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }
    
    public function getNamaBulanAttribute()
    {
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        return $bulan[$this->bulan] ?? '-';
    }
}
