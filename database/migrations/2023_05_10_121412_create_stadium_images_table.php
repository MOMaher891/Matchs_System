<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStadiumImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stadium_images', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->bigInteger('stadium_id')->unsigned();
            $table->foreign('stadium_id')->references('id')->on('stadiums')->onDelete('cascade'); 
           
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
        Schema::dropIfExists('stadium_images');
    }
}
