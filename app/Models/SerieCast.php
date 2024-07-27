<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerieCast extends Model
{
    protected $fillable = ['name', 'character', 'profile_path', 'serie_id', 'actor_id'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
    
}
