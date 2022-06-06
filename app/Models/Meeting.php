<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'judul',
        'notulensi',
        'employee_id'
    ];
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function memo(){
        return $this->hasMany(Memo::class,'meeting_id','id');
      }
}
