<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'creator',
        'release_date',
        'genre',
        'image',
        'overview',
        'backdrop_path',
        'seasons',
        'episodes',
        'cast'
    ];

    protected $casts = [
        'cast' => 'array',
    ];

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'ratable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating') ?: 0;
    }

    public function countRatings()
    {
        return $this->ratings()->count();
    }
}