<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'id_jenis_user',
        'username',
        'password',
    ];

    public function jenisUser() { return $this->belongsTo(JenisUser::class, 'id_jenis_user');}
    public function santri() { return $this->hasOne(santri::class, 'id_user');}
    public function guru() { return $this->hasOne(guru::class, 'id_user');}
    public function donatur() { return $this->hasOne(donatur::class, 'id_user');}
    public function berita() { return $this->hasMany(berita::class, 'id_user');}
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
