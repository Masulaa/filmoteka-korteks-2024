<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MovieReview[] $moviereviews
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SerieReview[] $seriereviews
 * @property-read int|null $reviews_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name", "email", "password"];

    protected $casts = [
        "is_admin" => "boolean",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    /**
     * Get the reviews written by this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviewsMovie()
    {
        return $this->hasMany(MovieReview::class);
    }

    /**
     * Get the movreviews written by this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviewsSerie()
    {
        return $this->hasMany(SerieReview::class);
    }
    /**
     * Get favorite movies by this user.
     *
     ** @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoriteMovies()
    {
        return $this->belongsToMany(
            Movie::class,
            "movie_favorites"
        )->withTimestamps();
    }
    /**
     * Get favorite movies by this user.
     *
     ** @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoriteSeries()
    {
        return $this->belongsToMany(
            Serie::class,
            "serie_favorites"
        )->withTimestamps();
    }
}
