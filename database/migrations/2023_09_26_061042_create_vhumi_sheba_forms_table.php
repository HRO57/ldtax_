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
        Schema::create('vhumi_sheba_forms', function (Blueprint $table) {
            $table->id();
            
            $table->string('title')->comment('string, requried');
            $table->string('vhumi_sheba_form_pdf')->comment('PDF file, required');
            $table->tinyInteger('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vhumi_sheba_forms');
    }
};
