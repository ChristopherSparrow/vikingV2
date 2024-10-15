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
    return $this->belongsToMany(Player::class, 'team_player', 'team_id', 'player_id')->withTimestamps();
}
}
