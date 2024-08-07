<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Admin\Support\Eloquent\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Enums\User\{Gender};
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements JWTSubject
{
    use HasRoles, Sluggable, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $columnSlug = 'fullname';

    protected $fillable = [
        /** Tài khoản đăng nhập */
        'username',
        /** Mật khẩu */
        'password',
        /** Họ và tên */
        'fullname',
        /** Số điện thoại */
        'phone',
        /** Email */
        'email',
        /** Ảnh đại diện */
        'avatar',
        /** Ngày sinh */
        'birthday',
        /** Giới tính */
        'gender',
        /** Địa chỉ */
        'address',
        /** Kinh độ */
        'longitude',
        /** Vĩ độ đăng nhập */
        'latitude',
        /** device_token */
        'device_token',
        /** Thời gian cập nhật gần nhất device_token */
        'device_token_updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'gender' => Gender::class,
        'active' => 'boolean',

    ];

    public function sumEarningPoint()
    {
        return DB::table('order_earning_point')
            ->where('user_id', $this->id)
            ->sum('point');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id')
            ->withPivot('model_type')
            ->wherePivot('model_type', self::class);
    }


    public function checkPermissions($permissionsArr): bool
    {
        foreach ($permissionsArr as $permission) {
            if ($this->can($permission)) {
                return true;
            }
        }
        return false;
    }

    public function parent()
    {
        return $this->hasOne(MenusParent::class, 'user_id', 'id');
    }
    public function driver()
    {
        return $this->hasOne(Driver::class, 'user_id', 'id');
    }
    public function nany()
    {
        return $this->hasOne(Nany::class, 'user_id', 'id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
