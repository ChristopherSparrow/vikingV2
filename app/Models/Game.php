<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'competition_id',
        'home_team_id',
        'away_team_id',
        'date',
        'home_score',
        'away_score',
        'home_player_id',
        'away_player_id',
    ];

    /**
     * Get the season that owns the game.
     */
    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    /**
     * Get the competition that owns the game.
     */
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    /**
     * Get the home team of the game.
     */
    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    /**
     * Get the away team of the game.
     */
    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function homePlayer()
    {
        return $this->belongsTo(Player::class, 'home_player_id');
    }

    /**
     * Get the away team of the game.
     */
    public function awayPlayer()
    {
        return $this->belongsTo(Player::class, 'away_player_id');
    }


}