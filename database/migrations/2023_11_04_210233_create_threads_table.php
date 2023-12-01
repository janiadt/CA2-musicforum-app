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
        // Creating a migration for my threads table
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('body');
            $table->enum('music_category', ['Pop', 'Rock', 'Jazz', 'EDM', 'Country', 'Punk Rock', 'Indie', 'Progressive Rock', 'Dance', 'Disco']);
            $table->string('image')->nullable();
            $table->timestamps();
            // Adding page views, which I will increment server-side
            $table->integer('views')->default(0);
            // Creating a foreign key which holds the user id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threads');
    }
};
