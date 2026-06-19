<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table    = 'tugas';
    protected $fillable = ['nama', 'tipe', 'mp_id'];

    public function mp()
    {
        return $this->belongsTo(Mp::class, 'mp_id');
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'tugas_id');
    }
}
