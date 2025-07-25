<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengeluaran extends Model
{
    //
    use HasFactory;
    protected $table = 'pengeluarans';
    protected $primaryKey = 'id_pengeluaran';
    protected $fillable = ['tanggal', 'nominal', 'keterangan'];

    public function getRouteKeyName()
    {
        return 'id_pengeluaran';
    }
}
