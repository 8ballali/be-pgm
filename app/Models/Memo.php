<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Memo extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id_pengirim',
        'employee_id_penerima',
        'meeting_id',
        'judul',
        'deskripsi',
        'tanggal',
        'status'
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot(){
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }
    public function getPengirimNameAttribute()
    {
        return $this->pengirim->name;
    }
    public function getPenerimaNameAttribute()
    {
        return $this->penerima->name;
    }
    public function getMeetingJudulAttribute()
    {
        return $this->meeting->judul;
    }
    public function pengirim(){
        return $this->belongsTo(Employee::class,'employee_id_pengirim');
    }
    public function penerima()
    {
        return $this->belongsTo(Employee::class,'employee_id_penerima');
    }
    public function history_memo(){
        return $this->hasMany(history_memo::class,'memo_id','id');
      }
    public function meeting(){
        return $this->belongsTo(Meeting::class,'meeting_id');
    }
}
