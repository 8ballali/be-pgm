<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'feedback_deskripsi',
        'tindak_lanjut'
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
    public function getTindakLanjutUrlAttribute(){
        return url('storage/'. $this->tindak_lanjut);
    }
    protected $appends = [
        'bukti_url',
        'tindak_lanjut_url',

    ];
    public function customer(){
        return $this->belongsTo(Customer::class,'cust_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function getCustomerNameAttribute()
    {
        return $this->customer->name;
    }
    public function getCategoryNameAttribute()
    {
        return $this->category->name;
    }
}
