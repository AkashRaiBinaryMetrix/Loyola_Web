<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Permissions\HasPermissionsTrait;
use App\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasPermissionsTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'twitter_id',
        'provider',
        'profile_pic'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'user_id',
        'provider_user_id',
        'provider'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //  protected $appends = [
    //     'profile_photo_url',
    // ];

    public function users() {

       return $this->belongsToMany(User::class,'users');
           
    }
    public function roles() {

       return $this->belongsToMany(Role::class,'roles');
           
    }
}
