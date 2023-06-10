<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'content',
      'featured_image',
      'author',
      'category_id',
      'source',
      'content_url'
    ];

    public function scopeWithImage($query){
        return $query->whereNotNull('featured_image');
    }

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
}
