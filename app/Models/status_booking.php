<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class status_booking extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot(){
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }
    protected $fillable = ['name'];

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }

}
