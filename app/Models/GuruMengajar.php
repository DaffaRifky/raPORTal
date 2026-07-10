<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $kelas_id
 * @property int $mp_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $guru
 * @property-read \App\Models\Kelas $kelas
 * @property-read \App\Models\Mp $mp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GuruMengajar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GuruMengajar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GuruMengajar query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GuruMengajar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GuruMengajar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GuruMengajar whereKelasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GuruMengajar whereMpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GuruMengajar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GuruMengajar whereUserId($value)
 * @mixin \Eloquent
 */
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
