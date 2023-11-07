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
        Schema::create('user_ask_questions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('string, requried');
            $table->string('number')->comment('string, requried');
            $table->text('question')->comment('text,requried');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ask_questions');
    }
};
