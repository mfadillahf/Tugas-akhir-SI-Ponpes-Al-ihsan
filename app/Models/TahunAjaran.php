<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajarans';
    protected $primaryKey = 'id_tahun_ajaran';
    protected $fillable = ['tahun_ajaran'];

    public function santri() { return $this->hasMany(santri::class, 'id_tahun_ajaran'); }

    public function getRouteKeyName()
    {
        return 'id_tahun_ajaran';
    }

    
}
