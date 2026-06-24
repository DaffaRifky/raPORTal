<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mp extends Model
{
    use HasFactory;

    protected $table = 'mps';   // tell Laravel the table name explicitly
    protected $fillable = ['nama'];  // or whatever columns mps has
    public function users()
    {
        return $this->belongsToMany(User::class, 'mp_user', 'mp_id', 'user_id');
    }
    public $timestamps = false;

    public function tugas()
    {
        return $this->hasMany(\App\Models\Tugas::class, 'mp_id');
    }
}
