<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'judul',
        'notulensi',
        'employee_id'
    ];
    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot(){
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function memo(){
        return $this->hasMany(Memo::class,'meeting_id','id');
      }
}
