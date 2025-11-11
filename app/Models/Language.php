<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;
 use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'flag',
        'status',
        'user_id',
        'updated_at',
        'created_id',
        'updated_id',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }
    /**
     * Get the user that owns the Language
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // ✅ Optional: Thumbnail URL (you can use same filename)
          public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(storage_path('app/public/' . $this->image))) {
            return asset('storage/' . $this->image);
        }

        // Optional: fallback image if none exists
        return asset('assets/img/default-store.png');
    }

}
