<?php

namespace App\Models;

use App\Traits\Status;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use Status;

    /**
     * @var int
     */
    public static $role_superadmin = 1; // Admin panelga kirish uchun superadmin hisoblanadi

    /**
     * @var int
     */
    public static $role_admin = 2;  // Klinika uchun admin hisoblanadi

    /**
     * @var int
     */
    public static $role_doctor = 3;  // Klinika uchun doctor hisoblanadi

    /**
     * @var int
     */
    public static $role_reception = 4;  // Klinika uchun qabulxona hisoblanadi

    /**
     * @var int
     */
    public static $role_technic = 5;  // Klinika uchun texnik hisoblanadi

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'polyclinic_id',
        'phone',
        'username',
        'role',
        'percent_treatment',
        'color',
        'sort_order',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * @return BelongsTo|BelongsTo
     */
    public function polyclinic()
    {
        return $this->belongsTo(Polyclinic::class, 'polyclinic_id', 'id');
    }

    /**
     * @return array
     */
    public static function userRoles()
    {
        return [
            self::$role_superadmin => 'Super Admin',
            self::$role_admin => 'Admin',
            self::$role_doctor => 'Doktor',
            self::$role_reception => 'Qabulxona',
            self::$role_technic => 'Texnik',
        ];
    }

    /**
     * @return array|\ArrayAccess|mixed
     */
    public function getUserRoleName()
    {
        return Arr::get(self::userRoles(), $this->role);
    }

    /**
     * @return bool
     */
    public function isApiAdmin()
    {
        return $this->role == self::$role_admin;
    }
}
