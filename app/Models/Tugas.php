<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nama
 * @property string $tipe
 * @property int $mp_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Mp $mp
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Nilai> $nilais
 * @property-read int|null $nilais_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tugas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tugas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tugas query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tugas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tugas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tugas whereMpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tugas whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tugas whereTipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tugas whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
