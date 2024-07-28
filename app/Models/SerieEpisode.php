<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerieEpisode extends Model
{
    protected $fillable = [
        "serie_id",
        "season_number",
        "episode_number",
        "title",
        "video_id",
    ];

    // Definišite relaciju sa serijom
    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
