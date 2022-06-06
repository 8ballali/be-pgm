<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history_memo extends Model
{
    use HasFactory;

    protected $fillable = [
        'memo_id',
        'catatan',
        'bukti'
    ];
    public function memo(){
        return $this->belongsTo(Memo::class);
    }
}
