<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelHapalan extends Model
{
	protected $table = 'level_hapalans';
    protected $primaryKey = 'id_level_hapalan';
    protected $fillable = ['nama_level'];

    public function hapalans()
    {
        return $this->hasMany(Hapalan::class);
    }
}
