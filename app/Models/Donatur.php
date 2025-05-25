<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donatur extends Model
{
    use HasFactory;
    protected $table = 'donaturs';
    protected $primaryKey = 'id_donatur';
    protected $fillable = ['id_user', 'nama', 'alamat', 'no_telepon', 'email'];

    public function user() { return $this->belongsTo(User::class, 'id_user'); }
    public function infaq() { return $this->hasMany(infaq::class, 'id_donatur'); }
}
