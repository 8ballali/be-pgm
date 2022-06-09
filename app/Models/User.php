<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role_id'

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


public $incrementing = false;

protected $keyType = 'string';

public static function boot(){
    parent::boot();

    static::creating(function ($issue) {
        $issue->id = Str::uuid(36);
    });
}

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRoleNameAttribute()
    {
        return $this->roles->name;
    }


    public function customer()
    {
        return $this->hasOne(Customer::class,'user_id','id');
    }
    public function employee()
    {
        return $this->hasOne(Employee::class,'user_id','id');
    }
    public function roles()
    {
        return $this->hasOne(Roles::class,'id','role_id');
    }

}
