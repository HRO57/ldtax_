<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToMenuLists extends Migration
{
    public function up()
    {
        Schema::table('menu_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('is_main');
            $table->foreign('parent_id')->references('id')->on('menu_lists')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('menu_lists', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
}
    