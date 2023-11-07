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
        Schema::create('poripotro_proggapons', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('string, requried');
            $table->string('poripotro_proggapon_pdf')->comment('PDF file, required');
            $table->string('poripotro_proggapon_doc')->comment('DOC file, required');
            $table->tinyInteger('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poripotro_proggapons');
    }
};
