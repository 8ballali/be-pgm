<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function departemen(){
        return $this->belongsTo(Departemen::class);
    }
    public function meeting(){
        return $this->hasMany(Meeting::class,'employee_id','id');
        }
    public function memo(){
        return $this->hasMany(Memo::class,'employee_id_pengirim','id');
            }
    public function memos(){
        return $this->hasMany(Memo::class,'employee_id_penerima','id');
                    }
}
