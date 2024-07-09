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
        'first_air_date',
        'genre',
        'image',
        'overview',
        'backdrop_path',
        'number_of_seasons',
        'number_of_episodes',
        'homepage',
        'status',
        'seasons',
        'cast',
        'trailer_link'
    ];

    protected $casts = [
        'cast' => 'array',
        'seasons' => 'array',
    ];

    // public function ratings()
    // {
    //     return $this->hasMany(Rating::class);
    // }

    // public function reviews()
    // {
    //     return $this->hasMany(Review::class);
    // }

    // public function averageRating()
    // {
    //     $totalRating = $this->ratings()->sum('rating');
    //     $countRatings = $this->ratings()->count();

    //     if ($countRatings > 0) {
    //         return round($totalRating / $countRatings, 1);
    //     }

    //     return 0;
    // }

    // public function countRatings()
    // {
    //     return $this->ratings()->count();
    // }
}
