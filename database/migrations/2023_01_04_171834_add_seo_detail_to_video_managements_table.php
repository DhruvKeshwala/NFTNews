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
        Schema::table('video_managements', function (Blueprint $table) {
            $table->string('metaTitle')->nullable()->after('categoryId');
            $table->longText('description')->nullable()->after('metaTitle');
            $table->longText('keywords')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_managements', function (Blueprint $table) {
            $table->dropColumn(['metaTitle', 'description', 'keywords']);
        });
    }
};
