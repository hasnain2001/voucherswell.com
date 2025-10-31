<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
   use HasFactory;
       protected $fillable = [
        'title',
        'subtitle',
        'image',
        'link',
        'status',
        'sort_order',
        'button_text',
    ];
    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];
    public function language()
    {
        return $this->belongsTo(language::class);
    }
}
