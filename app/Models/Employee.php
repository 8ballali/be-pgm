<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'dept_id',
        'user_id',
        'avatar'

    ];
    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot(){
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }
    public function getAvatarUrlAttribute(){
        return url('storage/'. $this->avatar);
    }
    protected $appends = [
        'avatar_url',

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function department(){
        return $this->hasOne(Department::class, 'id', 'dept_id');
    }
    public function meeting(){
        return $this->hasMany(Meeting::class,'employee_id','id');
    }
    public function pengirim(){
        return $this->hasMany(Memo::class,'employee_id_pengirim','id');
    }
    public function penerima(){
        return $this->hasMany(Memo::class,'employee_id_penerima','id');
    }
}
