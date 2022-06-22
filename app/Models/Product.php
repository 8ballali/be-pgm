<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'blok',
        'no_kavling',
        'type',
        'luas_tanah',
        'price',
        'status',
        'tanah_lebih',
        'discount',
        'image'
    ];
    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot(){
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }
    public function getImageUrlAttribute(){
        return url('storage/'. $this->image);
    }
    protected $appends = [
        'image_url',

    ];
    public function booking()
    {
        return $this->hasOne(Booking::class,'product_id','id');
    }


}
