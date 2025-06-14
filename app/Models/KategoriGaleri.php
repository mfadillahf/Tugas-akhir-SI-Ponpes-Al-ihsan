<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriGaleri extends Model
{
    protected $fillable = ['nama_kategori'];

    public function galeris()
    {
        return $this->hasMany(Galeri::class);
    }
}
