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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->Integer('countryId');
            $table->Integer('p1');
            $table->Integer('p2');
            $table->Integer('p3');
            $table->Integer('p4');
            $table->Integer('p5');
            $table->Integer('p6');
            $table->Integer('p7');
            $table->Integer('p8');
            $table->Integer('p9');
            $table->Integer('p10');
            $table->Integer('p11');
            $table->Integer('captain');
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
        Schema::dropIfExists('teams');
    }
};
