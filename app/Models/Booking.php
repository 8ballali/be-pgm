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
    public function getBuktiUrlAttribute()
    {
        return url('storage/'. $this->bukti);
    }
    protected $appends = [
        'bukti_url',

    ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'cust_id');
    }
    public function status_booking(){
        return $this->belongsTo(status_booking::class,'status');
    }
}
