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
        Schema::create('drop_management', function (Blueprint $table) {
            $table->id();
            $table->string('categoryId')->nullable();
            $table->string('name')->nullable();
            $table->string('token')->nullable();
            $table->string('blockChain')->nullable();
            $table->integer('priceOfSale')->nullable();
            $table->date('saleDate')->nullable();
            $table->string('discordLink')->nullable();
            $table->string('twitterLink')->nullable();
            $table->string('websiteLink')->nullable();
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('logo')->nullable();
            $table->longText('slug')->nullable();
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
        Schema::dropIfExists('drop_management');
    }
};
