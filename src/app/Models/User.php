<?php

namespace App\Models;


use App\Enums\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Enums;

class User extends Authenticatable
{
    use Notifiable, CanResetPassword, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'provider_user_id',
        'provider',
        'level',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'provider_user_id', 'provider'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getStatusAttribute($value) {

        $status = Enums\UserStatus::fromValue($value);

        return ["id" => $status->value, "name" => $status->description];

    }

    public function setPasswordAttribute(string $password): void {
        $this->attributes['password'] = Hash::make($password);
    }

    public function scopeLevel($query,$type) {
        $query->where('level',$type);
    }

    public function appraiser()
    {
        return $this->hasOne('App\Models\Appraiser');
    }

    public function isAdmin()
    {
        return $this->level == UserType::ADMINISTRATOR;
    }

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

}
