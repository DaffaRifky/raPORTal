<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nama
 * @property string $singkatan
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tugas> $tugas
 * @property-read int|null $tugas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mp query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mp whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mp whereSingkatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mp whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    protected static function booted()
    {
        static::created(function (Mp $mp) {
            Tugas::create([
                'nama'  => 'UTS',
                'tipe'  => 'UTS',
                'mp_id' => $mp->id,
            ]);
            Tugas::create([
                'nama'  => 'UAS',
                'tipe'  => 'UAS',
                'mp_id' => $mp->id,
            ]);
        });
    }
}
