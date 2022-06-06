<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'cust_id',
        'product_id',
        'bukti',
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
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function status_booking(){
        return $this->belongsTo(status_booking::class);
    }
}
