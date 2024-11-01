<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('frames', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->onDelete('cascade'); // Foreign key to the games table
            $table->foreignId('home_player_id')->constrained('players')->onDelete('cascade'); // Foreign key to the players table for home player
            $table->foreignId('away_player_id')->constrained('players')->onDelete('cascade'); // Foreign key to the players table for away player
            $table->integer('frame_number'); // Frame number (1 to 12)
            $table->integer('home_score')->nullable(); // Home player score
            $table->integer('away_score')->nullable(); // Away player score
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frames');
    }
};