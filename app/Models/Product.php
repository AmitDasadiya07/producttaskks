<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'type',
        'look',
        'finish',
        'size',
        'color',
        'description',
        'collection',
        'technical_spec',
        'gallery',
    ];

    protected $casts = [
        'gallery' => 'array',
    ];

    // Relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
