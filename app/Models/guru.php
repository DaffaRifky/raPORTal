<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Authenticatable
{
    use Notifiable, HasFactory;


    protected $table = 'gurus';

    protected $fillable = [
        'nip',
        'nama',
        'role',
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

        public $timestamps = false;

}
