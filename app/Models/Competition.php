<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = ['season_id', 'name', 'type'];

    /**
     * Get the season that owns the competition.
     */
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
