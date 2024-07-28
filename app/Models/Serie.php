<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'director',
        'release_date',
        'genre_ids',
        'rating',
        'image',
        'overview',
        'backdrop_path',
        'trailer_link',
        'video_id',
        'views',
    ];

    /**
     * Get the ratings for the serie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(SerieRating::class);
    }

    /**
     * Get the reviews for the serie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(SerieReview::class);
    }

    /**
     * Calculate the average rating for the serie.
     *
     * @return float
     */
    public function averageRating()
    {
        $totalRating = $this->ratings()->sum('rating');
        $countRatings = $this->ratings()->count();

        if ($countRatings > 0) {
            return round($totalRating / $countRatings, 1);
        }

        return 0;
    }

    /**
     * Get the count of ratings for the serie.
     *
     * @return int
     */
    public function countRatings()
    {
        return $this->ratings()->count();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'serie_genre', 'serie_id', 'genre_id');
    }
    public function cast()
    {
        return $this->hasMany(SerieCast::class);
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}
