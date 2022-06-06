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
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function history_memo(){
        return $this->hasMany(history_memo::class,'memo_id','id');
      }
    public function meeting(){
        return $this->belongsTo(Meeting::class);
    }
}
