<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nip
 * @property string $nama
 * @property string $role
 * @property int|null $no_hp
 * @property string|null $email
 * @property string|null $perguruan
 * @property string|null $pendidikan
 * @property string|null $alamat
 * @property string|null $image
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Kelas|null $kelasWali
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GuruMengajar> $mengajar
 * @property-read int|null $mengajar_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Mp> $mps
 * @property-read int|null $mps_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePendidikan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePerguruan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HasFactory;


    protected $table = 'users';

    protected $fillable = [
        'nip',
        'nama',
        'role',
        'no_hp',
        'email',
        'perguruan',
        'pendidikan',
        'alamat',
        'image',
        'tanda_tangan',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = false;

    public function kelasWali()
    {
        return $this->hasOne(Kelas::class, 'wali_kelas_id');
    }
    public function mps()
    {
        return $this->belongsToMany(Mp::class, 'mp_user', 'user_id', 'mp_id');
    }
    public function mengajar()
    {
        return $this->hasMany(GuruMengajar::class, 'user_id');
    }
    // Role helpers based on your actual enum values
    public function isGuru(): bool
    {
        return $this->role === 'Guru';
    }
    public function isAdmin(): bool
    {
        return in_array($this->role, ['Admin TU', 'Kepala Sekolah']);
    }
}
