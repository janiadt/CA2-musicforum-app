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
        Schema::create('song_user', function (Blueprint $table) {
            $table->id();
            // Changing to foreignId
            $table->foreignId('user_id');
            $table->foreignId('song_id');
            // Creating a pivot table in the migration, which will hold the ids of both the users and songs. This will create a many-to-many relationship that will let us see both ids.
            // Added constraints
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('song_id')->references('id')->on('songs')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('song_user');
    }
};
