<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = ['nomor_kelas', 'huruf_kelas'];
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
    public $timestamps = false;

    // All teaching assignments for this class
    public function gurumengajars()
    {
        return $this->hasMany(GuruMengajar::class, 'kelas_id');
    }
    // All teachers who teach this class
    public function gurus()
    {
        return $this->belongsToMany(User::class, 'guru_mengajar', 'kelas_id', 'user_id')
                    ->withPivot('mp_id');
    }
}
