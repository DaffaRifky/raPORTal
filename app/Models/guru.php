<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class guru extends Authenticatable
{
    use Notifiable;

    protected $table = 'gurus';

    protected $fillable = [
        'nip',
        'nama',
        'no_hp',
        'email',
        'perguruan',
        'pendidikan',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
