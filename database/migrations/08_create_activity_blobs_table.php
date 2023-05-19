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
        Schema::create('activity_blobs', function (Blueprint $table) {
            $table->id();
            $table->string('media_src');
            $table->string('alt_name');
            $table->unsignedBigInteger('activity_id');

            $table->foreign('activity_id')->references('id')->on('club_activities');

            $table->string('media_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_blobs');
    }
};
