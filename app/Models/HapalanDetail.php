<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HapalanDetail extends Model
{
    //
    use HasFactory;

    protected $table = 'hapalan_details';

    protected $primaryKey = 'id_hapalan_detail';

    protected $fillable = [
        'id_hapalan',
        'keterangan',
    ];

    public function hapalan()
    {
        return $this->belongsTo(Hapalan::class, 'id_hapalan');
    }
}
