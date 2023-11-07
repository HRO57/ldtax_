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
        Schema::create('land_related_video_links', function (Blueprint $table) {
            $table->id();
            $table->integer('show_sl')->comment('optional');
            $table->string('title')->comment('string');
            $table->string('link')->comment('requried, mustbe link');
            $table->tinyInteger('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_related_video_links');
    }
};
