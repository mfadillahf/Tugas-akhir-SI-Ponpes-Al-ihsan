<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisUser extends Model
{
    use HasFactory;
    protected $table = 'jenis_users';
    protected $primaryKey = 'id_jenis_user';
    protected $fillable = ['jenis_user'];

    public function users() { return $this->hasMany(User::class, 'id_jenis_user'); }
}
