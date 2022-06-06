<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dept_id'];

    public function complaint(){
     return $this->hasMany(Complaint::class,'category_id','id');
     }

     public function departemen(){
        return $this->belongsTo(Departemen::class);
    }
}
