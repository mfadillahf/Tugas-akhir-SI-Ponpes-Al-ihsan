<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'id_jenis_user',
        'username',
        'password',
    ];

    public function jenisUser() 
    { 
        return $this->belongsTo(JenisUser::class, 'id_jenis_user');
    }
    public function santri() 
    {
        return $this->hasOne(Santri::class, 'id_user');
    }
    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_user', 'id_user');
    }
    public function donatur() 
    { 
        return $this->hasOne(Donatur::class, 'id_user');
    }
    public function berita() 
    { 
        return $this->hasMany(Berita::class, 'id_user');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
