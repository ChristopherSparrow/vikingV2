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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained()->onDelete('cascade'); // Foreign key to the seasons table
            $table->foreignId('competition_id')->constrained()->onDelete('cascade'); // Foreign key to the competitions table
            $table->foreignId('home_team_id')->constrained('teams')->onDelete('cascade'); // Foreign key to the teams table for home team
            $table->foreignId('away_team_id')->constrained('teams')->onDelete('cascade'); // Foreign key to the teams table for away team
            $table->date('date'); // Date of the game
            $table->integer('home_score')->nullable(); // Home team score
            $table->integer('away_score')->nullable(); // Away team score
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};