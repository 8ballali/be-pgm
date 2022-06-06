<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
