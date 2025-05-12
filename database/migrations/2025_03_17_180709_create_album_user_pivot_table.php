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
        Schema::dropIfExists('album_user');

        Schema::create('album_user', function (Blueprint $table) {
            $table->foreignID('album_id')->constrained()->onDelete('cascade');
            $table->foreignID('user_id')->constrained()->onDelete('cascade');
            $table->primary(['album_id', 'user_id']);
            $table->smallInteger('num_plays')->default(0);
            $table->datetime('last_played')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_user');
    }
};
