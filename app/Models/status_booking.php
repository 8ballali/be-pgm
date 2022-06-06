<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_booking extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function booking()
    {
        return $this->hasOne(Booking::class,'status','id');
    }

}
