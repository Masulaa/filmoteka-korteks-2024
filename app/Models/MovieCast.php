<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieCast extends Model
{
    protected $fillable = ['name', 'character', 'profile_path', 'movie_id', 'actor_id'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
