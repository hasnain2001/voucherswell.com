<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'clicks',
        'order',
        'description',
        'code',
        'top_coupons',
        'ending_date',
        'status',
        'authentication',
        'user_id',
        'store_id',
        'updated_id',

    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'ending_date' => 'datetime',

    ];

    public function stores()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
     public function language()
    {
        return $this->belongsTo(language::class,);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }

}
