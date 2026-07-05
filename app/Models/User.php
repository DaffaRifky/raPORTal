<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable, HasFactory;


    protected $table = 'users';

    protected $fillable = [
        'nip',
        'nama',
        'role',
        'no_hp',
        'email',
        'perguruan',
        'pendidikan',
        'alamat',
        'image',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = false;

    public function kelasWali()
    {
        return $this->hasOne(Kelas::class, 'wali_kelas_id');
    }
    public function mps()
    {
        return $this->belongsToMany(Mp::class, 'mp_user', 'user_id', 'mp_id');
    }
    public function mengajar()
    {
        return $this->hasMany(GuruMengajar::class, 'user_id');
    }
    // Role helpers based on your actual enum values
    public function isGuru(): bool
    {
        return $this->role === 'Guru';
    }
    public function isAdmin(): bool
    {
        return in_array($this->role, ['Admin TU', 'Kepala Sekolah']);
    }
}
