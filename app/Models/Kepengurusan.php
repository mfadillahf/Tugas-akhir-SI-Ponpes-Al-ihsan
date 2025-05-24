<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kepengurusan extends Model
{
    use HasFactory;
    protected $table = 'kepengurusans';
    protected $primaryKey = 'id_kepengurusan';
    protected $fillable = ['nama', 'jabatan', 'mulai', 'akhir'];

}
