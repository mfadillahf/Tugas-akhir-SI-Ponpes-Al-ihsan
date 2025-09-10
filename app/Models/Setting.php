<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['show_laporan_infaq', 'show_laporan_pengeluaran'];
}
