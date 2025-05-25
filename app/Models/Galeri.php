<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galeri extends Model
{
    use HasFactory;
    protected $table = 'galeris';
    protected $primaryKey = 'id_galeri';
    protected $fillable = ['deskripsi', 'foto', 'tanggal'];
}
