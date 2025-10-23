<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HapalanKitab extends Model
{
    use HasFactory;

    protected $table = 'hapalan_kitab';
    protected $primaryKey = 'id_hapalan_kitab';
    protected $fillable = [
        'id_hapalan',
        'id_santri',
        'id_guru',
        'keterangan_1',
        'keterangan_2',
        'keterangan_3',
        'keterangan_4',
        'waktu',
    ];

    /**
     * Relasi ke tabel Hapalan (many to one)
     */
    public function hapalan()
    {
        return $this->belongsTo(Hapalan::class, 'id_hapalan', 'id_hapalan');
    }

    /**
     * Relasi ke tabel Santri
     */
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri', 'id_santri');
    }

    /**
     * Relasi ke tabel Guru
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
}
