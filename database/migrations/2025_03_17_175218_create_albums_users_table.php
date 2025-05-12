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
        Schema::create('albums_users', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('num_plays')->default(0);
            $table->datetime('last_played')->nullable();
            $table->timestamps();
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->dropColumn('num_plays');
            $table->dropColumn('last_played');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums_users');

        Schema::table('albums', function (Blueprint $table) {
            $table->smallInteger('num_plays')->default(0);
            $table->datetime('last_played')->nullable();
        });
    }
};
