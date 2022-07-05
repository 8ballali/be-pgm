<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'address',
        'avatar',
        'phone',
        'user_id'
    ];
    protected $appends = [
        'avatar_url',

    ];
    public function getAvatarUrlAttribute(){
        return url('storage/'. $this->avatar);
    }
    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot(){
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function complaint(){
        return $this->hasMany(Complaint::class,'cust_id','id');
    }
    public function booking()
    {
        return $this->hasMany(Booking::class,'cust_id','id');
    }
}
