<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontaks';
    protected $primaryKey = 'id_kontak';
    protected $fillable = [
        'tiktok', 'facebook', 'instagram', 'whatsapp', 'email', 'youtube'
    ];
}
