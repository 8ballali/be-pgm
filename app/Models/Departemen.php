<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function employee(){
        return $this->hasMany(Employee::class,'dept_id','id');
    }
    public function category()
    {
        return $this->hasMany(Category::class,'dept_id','id');
    }
}
