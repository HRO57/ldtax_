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
        Schema::create('prokolpo_poricaloks', function (Blueprint $table) {
            $table->id();
            $table->string('image')->comment('requried');
            $table->string('title')->comment('string, requried');
            $table->text('short_description')->comment('requried');
            $table->text('long_description')->comment('requried');
            $table->tinyInteger('status')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prokolpo_poricaloks');
    }
};
