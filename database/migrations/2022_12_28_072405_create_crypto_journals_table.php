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
        Schema::create('crypto_journals', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('shortDescription')->nullable();
            $table->longText('fullDescription')->nullable();
            $table->string('image')->nullable();
            $table->string('pdf')->nullable();
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
        Schema::dropIfExists('crypto_journals');
    }
};
