<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dept_id'];
        public $incrementing = false;

        protected $keyType = 'string';

        public static function boot(){
            parent::boot();

            static::creating(function ($issue) {
                $issue->id = Str::uuid(36);
            });
        }

    public function complaint(){
     return $this->hasMany(Complaint::class,'category_id','id');
     }

     public function department(){
        return $this->belongsTo(Department::class,'dept_id');
    }
    public function getDepartmentNameAttribute()
    {
        return $this->department->name;
    }
}
