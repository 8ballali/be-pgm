<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function complaint(){
        return $this->hasMany(Complaint::class,'cust_id','id');
    }
}
