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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('show_sl')->comment('optional');
            $table->string('title')->comment('string, requried');
            $table->text('short_description')->comment('requried');
            $table->string('link')->comment('requried, mustbe link');
            $table->string('app_link')->comment('requried, mustbe link');
            $table->string('image')->comment('requried');
            $table->text('long_description')->comment('requried');
            $table->string('sheba_praptir_somoy')->comment('requried');
            $table->string('proyojoniyo_fee')->comment('requried');
            $table->string('proyojoniyo_isthan')->comment('requried');
            $table->string('dayetto_praptto_kormokortta')->comment('requried');
            $table->text('proyojoniyo_kagojpotro')->comment('requried');
            $table->text('songlistho_aino_bodhi')->comment('requried');
            $table->text('sheba_prodane_bertho')->comment('requried');
            $table->text('sheba_prodane_proyojoniyo_link')->comment('requried');
            $table->tinyInteger('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
