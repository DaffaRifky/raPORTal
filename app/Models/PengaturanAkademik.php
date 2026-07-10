<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanAkademik extends Model
{
    protected $table = 'pengaturan_akademik';

    protected $fillable = [
        'nama_sekolah',
        'alamat_sekolah',
        'tahun_ajaran',
        'semester',
    ];
}
