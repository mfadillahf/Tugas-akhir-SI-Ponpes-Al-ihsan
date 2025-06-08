<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Infaq extends Model
{
    use HasFactory;
    protected $table = 'infaqs';
    protected $primaryKey = 'id_infaq';
    protected $fillable = ['id_donatur', 'nominal', 'tanggal', 'keterangan', 'status'];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function donatur() { return $this->belongsTo(Donatur::class, 'id_donatur'); }
}
