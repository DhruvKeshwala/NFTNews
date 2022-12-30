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
        Schema::create('video_managements', function (Blueprint $table) {
            $table->id();
            $table->string('categoryId');
            $table->string('authorId')->nullable();
            $table->string('title')->nullable();
            $table->longText('shortDescription')->nullable();
            $table->longText('fullDescription')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('code')->nullable();
            $table->longText('videoType');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('fld_status',['Active','Inactive'])->default('Active');
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
        Schema::dropIfExists('video_managements');
    }
};
