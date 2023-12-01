<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // This is a migration which creates the users table in the database. This user is used for authentication, but I will add my own entities, which will be used for the forum.
    public function up(): void
    {
        // This method of the schema class creates a table. 
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            // Timestamps creates the created_at and updated_at entities
            $table->timestamps();
            // Here are my own entities. the enum function will create the membership enum entity, with these three options. The post_amount will update each time the user creates a post
            // I realised that I needed a default value here and that it would throw an error. I fixed it now.
            $table->enum('membership', ['member', 'subscriber', 'administrator'])->default('member');
            $table->integer('post_amount')->default(0);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
