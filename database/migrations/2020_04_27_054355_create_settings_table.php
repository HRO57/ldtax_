<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('value')->comment('string, requried');
            $table->string('key')->comment('string, requried');
            $table->string('application_name')->comment('string, requried');
            $table->string('application_logo')->comment('string, requried');
            $table->string('application_title')->comment('string, requried');
            $table->integer('application_slider_limit')->comment('number, requried');
            $table->integer('application_main_menu_limit')->comment('number, requried');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
