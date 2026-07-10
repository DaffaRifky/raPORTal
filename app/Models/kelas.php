<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $nomor_kelas
 * @property string $huruf_kelas
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $wali_kelas_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GuruMengajar> $gurumengajars
 * @property-read int|null $gurumengajars_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $gurus
 * @property-read int|null $gurus_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Siswa> $siswas
 * @property-read int|null $siswas_count
 * @property-read \App\Models\User|null $waliKelas
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereHurufKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereNomorKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereWaliKelasId($value)
 * @mixin \Eloquent
 */
class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = ['nomor_kelas', 'huruf_kelas'];
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }

    // A class has one homeroom teacher
    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id');
    }

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

        public $timestamps = false;
}
