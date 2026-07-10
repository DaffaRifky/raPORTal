<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $siswa_id
 * @property int $tugas_id
 * @property int $user_id
 * @property numeric|null $nilai
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Siswa $siswa
 * @property-read \App\Models\Tugas $tugas
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereNilai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereSiswaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereTugasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereUserId($value)
 * @mixin \Eloquent
 */
class Nilai extends Model
{
    protected $table    = 'nilai';
    protected $fillable = ['siswa_id', 'tugas_id', 'user_id', 'nilai'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

}
