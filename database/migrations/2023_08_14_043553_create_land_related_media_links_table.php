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
        Schema::create('land_related_media_links', function (Blueprint $table) {
            $table->id();
            $table->integer('show_sl')->comment('optional');
            $table->string('link')->comment('requried, mustbe link');
            $table->string('title')->comment('requried, mustbe link');
            $table->tinyInteger('status')->default(true);
            $table->tinyInteger('type')->comment('1 => service_web_link, 2 => right_to_information');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_related_media_links');
    }
};
