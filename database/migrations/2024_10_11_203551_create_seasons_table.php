<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id(); // Unique ID for the season
            $table->string('name'); // Name of the season
            $table->date('start_date'); // Season start date
            $table->date('end_date'); // Season end date
            $table->enum('status', ['upcoming', 'active', 'completed'])->default('upcoming'); // Season status
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
