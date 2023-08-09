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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('club_id');
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('type', ['article', 'video']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
