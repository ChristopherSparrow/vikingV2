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
        Schema::table('frames', function (Blueprint $table) {
            $table->boolean('HomeFirst')->nullable()->default(null);
            $table->boolean('AwayFirst')->nullable()->default(null);
            $table->boolean('Home8')->nullable()->default(null);
            $table->boolean('Away8')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('frames', function (Blueprint $table) {
            $table->dropColumn(['HomeFirst', 'AwayFirst', 'Home8', 'Away8']);
        });
    }
};