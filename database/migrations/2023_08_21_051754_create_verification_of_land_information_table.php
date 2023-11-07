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
        Schema::create('verification_of_land_information', function (Blueprint $table) {
            $table->id();
            $table->integer('show_sl')->comment('optional');
            $table->string('image')->comment('requried');
            $table->string('title')->comment('string, requried');
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
        Schema::dropIfExists('verification_of_land_information');
    }
};
