<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'cust_id',
        'category_id',
        'type',
        'judul',
        'deskripsi',
        'tanggal',
        'status',
        'bukti',
        'feedback_score',
        'feedback_deskripsi'
    ];
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
