<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'cust_id',
        'product_id',
        'bukti',
        'status'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function status_booking(){
        return $this->belongsTo(status_booking::class);
    }
}
