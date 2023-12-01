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
        // In the song migration, I will create the entities shown in my ERD. The timestamp entities aren't necessarily in my ERD, but I will keep them anyway, as they are useful.
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->decimal('duration', $precision = 5, $scale = 2);
            $table->string('link', 255);
            $table->string('title', 100);
            $table->string('artist', 100);
            $table->string('album', 100);
            $table->date('date_published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
