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
        Schema::create('manage_pages', function (Blueprint $table) {
            $table->id();
            $table->string('fieldId')->nullable();
            $table->longText('image1')->nullable();
            $table->longText('image2')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('metaTitle')->nullable();
            $table->longText('description')->nullable();
            $table->longText('keywords')->nullable();
            $table->longText('contents')->nullable();
            $table->longText('selectTemplate')->nullable();
            $table->longText('slug')->nullable();
            $table->longText('uploadSocialBanner')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_pages');
    }
};
