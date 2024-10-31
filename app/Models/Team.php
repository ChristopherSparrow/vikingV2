<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['season_id', 'name', 'captain', 'vicecaptain'];

    /**
     * Get the season that owns the team.
     */
    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    
public function players()
{
    return $this->hasMany(Player::class);
}

public function games()
{
    return $this->hasMany(Game::class, 'home_team_id')->orWhere('away_team_id', $this->id);
}
}
