<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sistem extends Model
{
    use HasFactory;
    protected $table = 'sistem';
    protected $primaryKey = 'id';
    protected $fillable = ['judul', 'deskripsi', 'no_telp', 'alamat', 'email'];
}
