<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Network extends Model
{
    protected $fillable = [
        'title',
        'status',
        'user_id',
        'updated_at',
        'created_id',
        'updated_id',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function user()
    {
    return $this->belongsTo(User::class,'user_id');
    }
    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }
}
