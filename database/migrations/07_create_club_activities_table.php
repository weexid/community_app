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
        Schema::create('club_activities', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name');
            $table->text('description');
            $table->string('slug');
            $table->string('thumbnail');
            $table->unsignedBigInteger('club_id');
            
            $table->foreign('club_id')->references('id')->on('clubs');

            $table->integer('views');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_activities');
    }
};
