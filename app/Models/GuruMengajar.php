<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruMengajar extends Model
{
    protected $table    = 'guru_mengajar';
    protected $fillable = ['user_id', 'kelas_id', 'mp_id'];

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mp()
    {
        return $this->belongsTo(Mp::class, 'mp_id');
    }
}
