<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'home_player_id',
        'away_player_id',
        'frame_number',
        'home_score',
        'away_score',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function homePlayer()
    {
        return $this->belongsTo(Player::class, 'home_player_id');
    }

    public function awayPlayer()
    {
        return $this->belongsTo(Player::class, 'away_player_id');
    }
}