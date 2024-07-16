<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $fillable = ['name', 'character', 'profile_path', 'movie_id', 'actor_id'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
