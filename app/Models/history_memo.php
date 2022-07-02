<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class history_memo extends Model
{
    use HasFactory;

    protected $fillable = [
        'memo_id',
        'catatan',
        'bukti'
    ];
    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot(){
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }

    public function getBuktiUrlAttribute(){
        return url('storage/'. $this->bukti);
    }
    protected $appends = [
        'bukti_url',

    ];
    public function memo(){
        return $this->belongsTo(Memo::class,'memo_id');
    }
}
