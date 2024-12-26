<?php

namespace App\Models;

use App\Traits\MustUpdateProfile;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, HasUuids, MustVerifyEmail, MustUpdateProfile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'uid',
        'first_name',
        'last_name',
        'middle_name',
        'phone',
        'address',
        'lgas_id',
        'states_id',
        'nationalities_id',
        'gender',
        'dob',
        'role',
        'is_active',
        'email',
        'password',
        'profile_photo_path',
        'profile_updated_at',
        'virtual_account_number',
        'bank_name',
        'balance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        $username = ($this->first_name || $this->last_name) ? ($this->first_name . ' ' . $this->last_name) : $this->user_name;
        $name = trim(collect(explode(' ', $username))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function scopeSearch($query, $search)
    {
        $query->where('email', 'like', "%$search%")
            ->orWhere('user_name', 'like', "%$search%")
            ->orWhere('uid', 'like', "%$search%")
            ->orWhere('first_name', 'like', "%$search%")
            ->orWhere('last_name', 'like', "%$search%")
            ->orWhere('middle_name', 'like', "%$search%");
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function plans()
    {
        return $this->hasOne(Plan::class)->where('status', 'active');
    }

    public function dailyCheckin()
    {
        return $this->hasMany(DailyCheckin::class);
    }
}
