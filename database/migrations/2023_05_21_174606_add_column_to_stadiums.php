<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToStadiums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stadiums', function (Blueprint $table) {
            $table->integer('num_of_player')->default(10)->nullable(true);
            $table->boolean('clothes')->default(0)->nullable(true);
            $table->boolean('bathroom')->default(0)->nullable(true);
            $table->boolean('s_bathroom')->default(0)->nullable(true);
            $table->string('period')->default(null)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stadiums', function (Blueprint $table) {
            //
        });
    }
}
