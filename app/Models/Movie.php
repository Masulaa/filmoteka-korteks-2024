<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'director',
        'release_date',
        'genre',
        'rating',
        'image',
        'overview',
        'backdrop_path',
        'video_link',
        'cast' 
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    protected $casts = [
        'cast' => 'array',
    ];

    public function averageRating()
    {
        $totalRating = $this->ratings()->sum('rating');
        $countRatings = $this->ratings()->count();

        if ($countRatings > 0) {
            return round($totalRating / $countRatings, 1);
        }

        return 0;
    }
    public function countRatings()
    {
        $countRatings = $this->ratings()->count();
        return $countRatings | 0;
    }
}